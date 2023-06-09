<?php
/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2015 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisAssetManager\Service;

use Composer\Composer;
use Composer\Factory;
use Composer\IO\NullIO;
use Composer\Package\CompletePackage;
use Laminas\Config\Config;
use Laminas\Config\Writer\PhpArray;
use Laminas\ServiceManager\ServiceManager;
use MelisCore\Service\MelisServiceManager;

class MelisModulesService extends MelisServiceManager
{
    /**
     * @var Composer
     */
    protected $composer;


    public function getMelisActiveModules()
    {
        return \MelisCore\MelisModuleManager::getModules();
    }

    /**
     * Returns the module name, module package, and its' version
     *
     * @param null $moduleName - provide the module name if you want to get the package specific information
     *
     * @return array
     */
    public function getModulesAndVersions($moduleName = null)
    {
        $tmpModules = [];

        $melisComposer = new \MelisComposerDeploy\MelisComposer();
        $melisInstalledPackages = $melisComposer->getInstalledPackages();

        foreach ($melisInstalledPackages as $package) {
            $packageModuleName = isset($package->extra) ? (array) $package->extra : null;
            $module = null;
            if (isset($packageModuleName['module-name'])) {
                $module = $packageModuleName['module-name'];
            }

            if ($module) {
                $tmpModules[$module] = [
                    'package' => $package->name,
                    'module' => $module,
                    'version' => $package->version,
                ];

                if ($module == $moduleName) {
                    break;
                }
            }
        }

        $userModules = $this->getUserModules();
        $exclusions = ['MelisModuleConfig', 'MelisSites'];

        foreach ($userModules as $module) {
            if (!in_array($module, $exclusions)) {
                $class = $_SERVER['DOCUMENT_ROOT'] . '/../module/' . $module . '/Module.php';
                if (!file_exists($class))
                    continue;

                $class = file_get_contents($class);

                $package = $module;
                $version = '1.0';

                if (preg_match_all('/@(\w+)\s+(.*)\r?\n/m', $class, $matches)) {

                    $result = array_combine($matches[1], $matches[2]);
                    $version = isset($result['version']) ? $result['version'] : '1.0';
                    $package = isset($result['module']) ? $result['module'] : $module;

                }
                $tmpModules[$package] = [
                    'package' => $package,
                    'module' => $package,
                    'version' => $version,
                ];
            }
        }


        $modules = $tmpModules;


        if (!is_null($moduleName)) {
            return isset($modules[$moduleName]) ? $modules[$moduleName] : null;
        }

        return $modules;
    }

    /**
     * @return \Composer\Composer
     */
    public function getComposer()
    {
        if (is_null($this->composer)) {
            $composer = new \MelisComposerDeploy\MelisComposer();
            $this->composer = $composer->getComposer();
        }

        return $this->composer;
    }

    /**
     * @param Composer $composer
     *
     * @return $this
     */
    public function setComposer(Composer $composer)
    {
        $this->composer = $composer;

        return $this;
    }

    /**
     * @return array
     */
    public function getUserModules()
    {
        $userModules = $_SERVER['DOCUMENT_ROOT'] . '/../module';

        $modules = [];
        if ($this->checkDir($userModules)) {
            $modules = $this->getDir($userModules);
        }

        return $modules;
    }

    /**
     * This will check if directory exists and it's a valid directory
     *
     * @param $dir
     *
     * @return bool
     */
    protected function checkDir($dir)
    {
        if (file_exists($dir) && is_dir($dir)) {
            return true;
        }

        return false;
    }

    /**
     * Returns all the sub-folders in the provided path
     *
     * @param String $dir
     * @param array $excludeSubFolders
     *
     * @return array
     */
    protected function getDir($dir, $excludeSubFolders = [])
    {
        $directories = [];
        if (file_exists($dir)) {
            $excludeDir = array_merge(['.', '..', '.gitignore'], $excludeSubFolders);
            $directory = array_diff(scandir($dir), $excludeDir);

            foreach ($directory as $d) {
                if (is_dir($dir . '/' . $d)) {
                    $directories[] = $d;
                }
            }

        }

        return $directories;
    }

    /**
     * @return array
     */
    public function getSitesModules()
    {
        $userModules = $_SERVER['DOCUMENT_ROOT'] . '/../module/MelisSites';

        $modules = [];
        if ($this->checkDir($userModules)) {
            $modules = $this->getDir($userModules);
        }

        return $modules;
    }

    /**
     * Returns all the modules that has been created by Melis
     *
     * @return array
     */
    public function getMelisModules()
    {
        $modules = [];
        foreach ($this->getAllModules() as $module) {
            if (strpos($module, 'Melis') !== false || strpos($module, 'melis') !== false) {
                $modules[] = $module;
            }
        }

        return $modules;
    }

    /**
     * Returns all the modules
     */
    public function getAllModules()
    {
        return array_merge($this->getUserModules(), $this->getVendorModules());
    }

    /**
     * Returns all melisplatform-module packages loaded by composer
     * @return array
     */
    public function getVendorModules()
    {
        $melisComposer = new \MelisComposerDeploy\MelisComposer();
        $melisInstalledPackages = $melisComposer->getInstalledPackages();

        $packages = array_filter($melisInstalledPackages, function ($package) {

            $type = $package->type;
            $extra = $package->extra ?? [];
            $isMelisModule = true;

                
            if (!empty($extra)) {

                if (property_exists($extra, 'melis-module')) {
                    $tmp = (array)$extra;
                    $modulePath = null;
                    if (! empty($tmp)) {
                        $moduleName = isset($tmp['module-name']) ? $tmp['module-name'] : null;
                        $modulePath = $this->getModulePath($moduleName);
                    }
                    $key = 'melis-module';
                    if (!$extra->$key && empty($modulePath))
                        $isMelisModule = false;
                }

                /** @var CompletePackage $package */
                return $type === 'melisplatform-module' &&
                    property_exists($extra, 'module-name') && $isMelisModule;
            }
        });

        $modules = array_map(function ($package) {
            $extra = (array) $package->extra;
            /** @var CompletePackage $package */
            return $extra['module-name'];
        }, $packages);

        sort($modules);

        return $modules;
    }

    /**
     * Returns an array of modules or packages that is dependent to the module name provided
     *
     * @param $moduleName
     * @param bool $convertPackageNameToNamespace
     * @param bool $getOnlyActiveModules - returns only the active modules
     *
     * @return array
     */
    public function getChildDependencies($moduleName, $convertPackageNameToNamespace = true, $getOnlyActiveModules = true)
    {
        $modules = $this->getAllModules();
        $matchModule = $convertPackageNameToNamespace ? $moduleName : $this->convertToPackageName($moduleName);
        $dependents = [];

        foreach ($modules as $module) {
            $dependencies = $this->getDependencies($module, $convertPackageNameToNamespace);

            if ($dependencies) {
                if (in_array($matchModule, $dependencies)) {
                    $dependents[] = $convertPackageNameToNamespace ? $module : $this->convertToPackageName($module);
                }
            }
        }

        if (true === $getOnlyActiveModules) {

            $activeModules = $this->getActiveModules();
            $modules = [];

            foreach ($dependents as $module) {
                $modules[] = $module;
            }

            $dependents = $modules;
        }

        return $dependents;
    }

    /**
     * convert module name into package name, example: MelisCore will become melis-core
     *
     * @param $module
     *
     * @return string
     */
    private function convertToPackageName($module)
    {
        $moduleName = strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $module));

        return $moduleName;
    }

    /**
     * Returns the dependencies of the module
     *
     * @param $moduleName
     * @param bool $convertPackageNameToNamespace - set to "true" to convert all package name into their actual Module name
     *
     * @return array
     */
    public function getDependencies($moduleName, $convertPackageNameToNamespace = true)
    {
        $modulePath = $this->getModulePath($moduleName);
        $dependencies = [];

        if ($modulePath) {

            $defaultDependencies = ['melis-core'];
            $dependencies = $defaultDependencies;
            $composerPossiblePath = [$modulePath . '/composer.json'];
            $composerFile = null;

            // search for the composer.json file
            foreach ($composerPossiblePath as $file) {
                if (file_exists($file)) {
                    $composerFile = file_get_contents($file);
                }
            }

            // if composer.json is found
            if ($composerFile) {

                $composer = json_decode($composerFile, true);
                $requires = isset($composer['require']) ? $composer['require'] : null;
                if ($requires) {
                    $requires = array_map(function ($a) {
                        // remove melisplatform prefix
                        return str_replace(['melisplatform/', ' '], '', trim($a));
                    }, array_keys($requires));

                    $dependencies = $requires;
                }
            }

            if ($convertPackageNameToNamespace) {
                $tmpDependencies = [];
                $toolSvc = $this->getServiceManager()->get('MelisCoreTool');

                foreach ($dependencies as $dependency) {
                    $tmpDependencies[] = ucfirst($toolSvc->convertToNormalFunction($dependency));
                }

                $dependencies = $tmpDependencies;
            }
        }

        return $dependencies;
    }

    /**
     * Returns the full path of the module
     *
     * @param $moduleName
     * @param bool $returnFullPath
     *
     * @return string
     */
    public function getModulePath($moduleName, $returnFullPath = true)
    {
        $path = $this->getUserModulePath($moduleName, $returnFullPath);
        if ($path == '') {
            $path = $this->getComposerModulePath($moduleName, $returnFullPath);
        }

        return $path;
    }

    public function getUserModulePath($moduleName, $returnFullPath = true)
    {
        $path = '';
        $userModules = $_SERVER['DOCUMENT_ROOT'] . '/../';

        if (in_array($moduleName, $this->getUserModules())) {
            if ($this->checkDir($userModules . 'module/' . $moduleName)) {
                if (!$returnFullPath) {
                    $path = '/module/' . $moduleName;
                } else {
                    $path = $userModules . 'module/' . $moduleName;
                }
            }
        }

        return $path;
    }

    public function getComposerModulePath($moduleName, $returnFullPath = true)
    {
        $melisComposer = new \MelisComposerDeploy\MelisComposer();
        return $melisComposer->getComposerModulePath($moduleName, $returnFullPath);
    }

    /**
     * Returns all the modules that has been loaded in laminas
     *
     * @param array $exclude
     *
     * @return array
     */
    public function getActiveModules($exclude = [])
    {
        $mm = $this->getServiceManager()->get('ModuleManager');
        $loadedModules = array_keys($mm->getLoadedModules());
        $pluginModules = $this->getModulePlugins();
        $modules = [];
        foreach ($loadedModules as $module) {
            if (in_array($module, $pluginModules)) {
                if (!in_array($module, $exclude)) {
                    $modules[] = $module;
                }
            }
        }

        return $modules;
    }

    /**
     * Returns all modules plugins that does not belong or treated as core modules
     *
     * @param array $excludeModulesOnReturn
     *
     * @return array
     */
    public function getModulePlugins($excludeModulesOnReturn = [])
    {
        $modules = [];
        $excludeModules = array_values($this->getCoreModules());
        foreach ($this->getAllModules() as $module) {
            if (!in_array($module, array_merge($excludeModules, $excludeModulesOnReturn))) {
                $modules[] = $module;
            }
        }

        return $modules;

    }

    /**
     * Returns all the important modules
     *
     * @param array $excludeModulesOnReturn | exclude some modules that you don't want to be included in return
     *
     * @return array
     */
    public function getCoreModules($excludeModulesOnReturn = [])
    {
        $modules = [
            'melisassetmanager' => 'MelisAssetManager',
            'melisdbdeploy' => 'MelisDbDeploy',
            'meliscomposerdeploy' => 'MelisComposerDeploy',
            'meliscore' => 'MelisCore',
            // 'melissites' => 'MelisSites',
        ];

        if ($excludeModulesOnReturn) {
            foreach ($excludeModulesOnReturn as $exMod) {
                if (isset($modules[$exMod]) && $modules[$exMod]) {
                    unset($modules[$exMod]);
                }
            }
        }

        return $modules;
    }

    /**
     * This method activating a single module
     * and store to the module.load.php of the platform
     *
     * @param $module
     *
     * @return bool
     */
    public function activateModule(
        $module,
        $defaultModules = ['MelisAssetManager', 'MelisComposerDeploy', 'MelisDbDeploy', 'MelisCore'],
        $excludeModule = ['MelisModuleConfig'])
    {
        // Default melis modules
        $activeModules = $this->getActiveModules($defaultModules);

        // Removing "MelisModuleConfig" if exist on activated modules
        foreach ($activeModules as $key => $mod) {
            if (in_array($mod, $excludeModule)) {
                unset($activeModules[$key]);
            }
        }

        array_push($activeModules, $module);

        // Creating/updating module.load.php including new module
        return $this->createModuleLoader('config/', $activeModules, $defaultModules);
    }

    /**
     * Creates module loader file
     *
     * @param $pathToStore
     * @param array $modules
     * @param array $topModules
     * @param array $bottomModules
     *
     * @return bool
     */
    public function createModuleLoader($pathToStore, $modules = [],
                                    $topModules = ['melisassetmanager', 'melisdbdeploy', 'meliscomposerdeploy', 'meliscore'],
                                    $bottomModules = ['MelisModuleConfig'])
    {
        $tmpFileName = 'melis.module.load.php.tmp';
        $fileName = 'melis.module.load.php';
        if ($this->checkDir($pathToStore)) {
            // Core modules
            $coreModules = $this->getCoreModules();

            $melisModules = array_values($coreModules);

            // Removing  core top modules from $modules
            $modules = array_filter($modules, function($module) use ($coreModules) {
                if (!in_array($module, $coreModules)) {
                    return $module;
                }
            });

            // Adding non-top core modules to list of modules
            foreach ($topModules as $module) 
                if (!isset($coreModules[$module]) && !in_array($module, $melisModules)) 
                    $melisModules[] = $module;

            // Adding modules to list of modules to be store on melis.module.load.php
            foreach ($modules As $module)
                if(!in_array($module, $melisModules))
                    $melisModules[] = $module;

            // Removing  bottom modules from $modules
            foreach ($bottomModules As $module)
                if(!in_array($module, $melisModules))
                    $melisModules[] = $module;

            // Adding MelisModuleConfig as  bottom module
            $melisModuleConfig = 'MelisModuleConfig';
            // Removing first MelisModuleConfig from the list to make sure this will be added to the last 
            if (($modKey = array_search($melisModuleConfig, $melisModules)) !== false) 
                unset($melisModules[$modKey]);
            // Bottom module
            $melisModules[] = $melisModuleConfig;

            $config = new Config($melisModules, true);
            $writer = new PhpArray();
            $writer->setUseBracketArraySyntax(true);
            $conf = $writer->toString($config);
            $conf = preg_replace('/    \d+/u', '', $conf); // remove the number index
            $conf = str_replace('=>', '', $conf); // remove the => characters.
            file_put_contents($pathToStore . '/' . $tmpFileName, $conf);

            if (file_exists($pathToStore . '/' . $tmpFileName)) {
                // check if the array is not empty
                $checkConfig = include($pathToStore . '/' . $tmpFileName);
                if (count($checkConfig) > 1) {
                    // delete the current module loader file
                    unlink($pathToStore . '/' . $fileName);
                    // rename the module loader tmp file into module.load.php
                    rename($pathToStore . '/' . $tmpFileName, $pathToStore . '/' . $fileName);
                    // Adding permission access
                    chmod($pathToStore . '/' . $fileName, 0777);
                    // if everything went well
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * @param $module
     *
     * @return bool
     */
    public function loadModule($module)
    {
        $trgtModule = $module;
        if (is_array($module) && !empty($module)) {
            $trgtModule = $module[count($module)-1];
        }

        if (!in_array($trgtModule, $this->getActiveModules())) {
            $moduleLoadFile = $_SERVER['DOCUMENT_ROOT'] . '/../config/melis.module.load.php';
            if (file_exists($moduleLoadFile)) {
                $modules = include $_SERVER['DOCUMENT_ROOT'] . '/../config/melis.module.load.php';

                $moduleCount = count($modules);
                $insertAtIdx = $moduleCount - 1;
                array_splice($modules, $insertAtIdx, 0, $module);

                // create the module.load file
                $this->createModuleLoader('config/', $modules, [], []);
            }
        }

        return $this->isModuleLoaded($trgtModule);
    }

    /**
     * @param $module
     *
     * @return bool
     */
    public function unloadModule($module)
    {
        $modules = $module;
        if (!is_array($module)) {
            $modules = [];
            $modules[] = $module;
        }

        $moduleLoadFile = $_SERVER['DOCUMENT_ROOT'] . '/../config/melis.module.load.php';

        if (file_exists($moduleLoadFile)) {
            $loadModules = include $moduleLoadFile;

            foreach ($loadModules as $idx => $loadedModule) {
                if (in_array($loadedModule, $modules)) {
                    unset($loadModules[$idx]);
                }
            }

            $this->createModuleLoader('config/', $loadModules, [], []);
        }

        return false;
    }

    /**
     * @param $module
     *
     * @return bool
     */
    public function isModuleLoaded($module)
    {
        $modules = include $_SERVER['DOCUMENT_ROOT'] . '/../config/melis.module.load.php';
        if (in_array($module, $modules)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param $module
     *
     * @return bool
     */
    public function isSiteModule($module)
    {
        $melisComposer = new \MelisComposerDeploy\MelisComposer();
        $packages = $melisComposer->getInstalledPackages();

        $repo = null;

        foreach ($packages as $package) {
            $packageModuleName = isset($package->extra) ? (array) $package->extra : null;

            if (isset($packageModuleName['module-name']) && $packageModuleName['module-name'] == $module) {
                $repo = (array) $package->extra;
                break;
            }
        }

        if (isset($repo['melis-site'])) {
            return (bool) $repo['melis-site'] ?? false;
        }

        return false;
    }
}
