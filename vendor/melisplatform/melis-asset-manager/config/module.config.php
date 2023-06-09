<?php

/**
 * Melis Technology (http://www.melistechnology.com)
 *
 * @copyright Copyright (c) 2016 Melis Technology (http://www.melistechnology.com)
 *
 */

use MelisAssetManager\Service\Factory\AbstractFactory;
use MelisAssetManager\Service\MelisModulesService;
use MelisAssetManager\Service\MelisWebPackService;
use MelisAssetManager\Service\MelisConfigService;

return [
     'router' => [
         'routes' => [
             'melis-backoffice' => [
                 'child_routes' => [
                     'webpack_builder' => [
                         'type' => 'Segment',
                         'options' => [
                             'route' => 'build-webpack',
                             'defaults' => [
                                 'controller' => 'MelisAssetManager\Controller\WebPack',
                                 'action' => 'buildWebpack',
                             ],
                         ],
                     ],
                     'view_assets' => [
                         'type' => 'Segment',
                         'options' => [
                             'route' => 'view-assets',
                             'defaults' => [
                                 'controller' => 'MelisAssetManager\Controller\WebPack',
                                 'action' => 'viewAssets',
                             ],
                         ],
                     ],
                 ],
             ],
         ],
     ],
    'service_manager' => [
        'aliases' => [
            'MelisAssetManagerModulesService'   => MelisModulesService::class,
            'MelisAssetManagerWebPack'          => MelisWebPackService::class,
            'MelisConfig'                       => MelisConfigService::class,
        ],
    ],
    'controllers' => [
        'invokables' => [
            'MelisAssetManager\Controller\WebPack' => \MelisAssetManager\Controller\WebPackController::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'melisCoreIcon' => \MelisAssetManager\View\Helper\MelisCoreIconHelper::class,
            'melisCmsIcon' => \MelisAssetManager\View\Helper\MelisCmsIconHelper::class,
            'melisMarketingIcon' => \MelisAssetManager\View\Helper\MelisMarketingIconHelper::class,
            'melisCommerceIcon' => \MelisAssetManager\View\Helper\MelisCommerceIconHelper::class,
            'melisOthersIcon' => \MelisAssetManager\View\Helper\MelisOthersIconHelper::class,
            'melisCustomIcon' => \MelisAssetManager\View\Helper\MelisCustomIconHelper::class,
        ],
    ]
];
