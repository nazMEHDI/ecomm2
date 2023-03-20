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
                    'application-Ordertable' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => 'Ordertable',
                            'defaults' => [
                                '__NAMESPACE__' => 'Ordertable\Controller',
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
            'OrdertableService' => \Ordertable\Service\OrdertableService::class,
            // Table
            'OrdertableTable' => \Ordertable\Model\Tables\OrdertableTable::class
        ]
    ],
    'controllers' => [
        'invokables' => [
            'Ordertable\Controller\List'         => \Ordertable\Controller\ListController::class,
            'Ordertable\Controller\Properties'   => \Ordertable\Controller\PropertiesController::class,
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
