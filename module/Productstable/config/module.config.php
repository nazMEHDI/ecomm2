<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'router' => [
        'routes' => [
        	'melis-backoffice' => [
                'child_routes' => [
                    'application-Productstable' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => 'Productstable',
                            'defaults' => [
                                '__NAMESPACE__' => 'Productstable\Controller',
                            ],
                        ],
                        'may_terminate' => true,
                        'child_routes' => [
                            'default' => [
                                'type'    => 'Segment',
                                'options' => [
                                    'route'    => '/[:controller[/:action]]',
                                    'constraints' => [
                                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                                    ],
                                    'defaults' => [
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
        	],
        ],
    ],
    'service_manager' => [
        'aliases' => [
            // Service
            'ProductstableService' => \Productstable\Service\ProductstableService::class,
            // Table
            'ProductstableTable' => \Productstable\Model\Tables\ProductstableTable::class
        ]
    ],
    'controllers' => [
        'invokables' => [
            'Productstable\Controller\List'         => \Productstable\Controller\ListController::class,
            'Productstable\Controller\Properties'   => \Productstable\Controller\PropertiesController::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
