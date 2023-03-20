<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

namespace MelisCmsProspects\Controller\DashboardPlugins;

use MelisCore\Controller\DashboardPlugins\MelisCoreDashboardTemplatingPlugin;
use Laminas\View\Model\ViewModel;
use Laminas\Session\Container;
use Laminas\View\Model\JsonModel;


class MelisCmsProspectsStatisticsPlugin extends MelisCoreDashboardTemplatingPlugin
{
    public function __construct()
    {
        $this->pluginModule = 'meliscmsprospects';
        parent::__construct();
    }
    
    public function prospectsStatistics()
    {
        $melisProspects = $this->getServiceManager()->get('MelisProspects');
        $melisTool = $this->getServiceManager()->get('MelisCoreTool');
        $melisProspectsService = $this->getServiceManager()->get('MelisProspectsService');

        /**
         * Check user's accessibility(rights) for this plugin
         * @var \MelisCore\Service\MelisCoreDashboardPluginsRightsService $dashboardPluginsService
         */
        $dashboardPluginsService = $this->getServiceManager()->get('MelisCoreDashboardPluginsService');
        $path = explode('\\', __CLASS__);
        $className = array_pop($path);
        $isAccessible = $dashboardPluginsService->canAccess($className);

        // Get Total number Prospects
        $numPropects = $melisProspectsService->getProspectsDataForWidgets('numPropects');
        
        // Get Total Recent Prospects
        $recentPropects = $melisProspects->getDashboardRecentProspectData(5)->toArray();
        $prosData = $recentPropects;
        
        for($x = 0; $x < count($prosData); $x++) 
        {
            foreach($prosData[$x] as $vKey => $vValue)
            {
                $prosData[$x][$vKey] = $melisTool->limitedText($vValue);
            }
        }
        
        // Get Current Language
        $container = new Container('meliscore');
        $locale = $container['melis-lang-locale'];
        $dateFormat = ($locale=='en_EN') ? 'm/d/Y' : 'd/m/Y';
        
        $view = new ViewModel();
        $view->setTemplate('melis-cmsprospects/dashboard/prospects-statistics');
        $view->numPropects = $numPropects;
        $view->recentPropects = (!empty($prosData)) ? $prosData : array();
        $view->dateFormat = $dateFormat;
        $view->toolIsAccessible = $isAccessible;
        
        return $view;
    }
    
    /**
     * Returns JSon datas for the graphs on the dashboard
     */
    public function getDashboardStats()
    {
        // Graph Range X-Axis Limit to this value
        $limit = 10;
        $success = 1;
        // Values hanler
        $values = array();
        
        if($this->getController()->getRequest()->isPost()) {
            
            $chartFor = $this->getController()->getRequest()->getPost()->toArray();
            $chartFor = isset($chartFor['chartFor']) ? $chartFor['chartFor'] : 'monthly';
            
            $melisProspectsService = $this->getServiceManager()->get('MelisProspectsService');
            
            // Last Date/value of the Graph will be the Current Date
            $curdate = date('Y-m-d');
            for ($ctr = $limit ; $ctr > 0 ;$ctr--)
            {
                // Retreve Prospects Values from database
                $nb = $melisProspectsService->getProspectsDataByDate($chartFor,$curdate);
                
                // Checking type of report
                switch ($chartFor) {
                    case 'daily':
                        $values[] = array($curdate, $nb);
                        // Deduct 1 Day every loop
                        $curdate = date('Y-m-d',strtotime($curdate.' -1 days'));
                        break;
                    case 'monthly':
                        $values[] = array($curdate, $nb);
                        // Deduct 1 Month every loop
                        $curdate = date('Y-m-d',strtotime($curdate.' -1 months'));
                        break;
                    case 'yearly':
                        $values[] = array($curdate, $nb);
                        // Deduct 1 Year every loop
                        $curdate = date('Y-m-d',strtotime($curdate.' -1 years'));
                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        
        return new JsonModel(array(
            'date' => date('Y-m-d'),
            'success' => $success,
            'values' => $values,
        ));
        
    }
}