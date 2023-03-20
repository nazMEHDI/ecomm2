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
                    'application-Categoriestable' => [
                        'type'    => 'Literal',
                        'options' => [
                            'route'    => 'Categoriestable',
                            'defaults' => [
                                '__NAMESPACE__' => 'Categoriestable\Controller',
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
            'CategoriestableService' => \Categoriestable\Service\CategoriestableService::class,
            // Table
            'CategoriestableTable' => \Categoriestable\Model\Tables\CategoriestableTable::class
        ]
    ],
    'controllers' => [
        'invokables' => [
            'Categoriestable\Controller\List'         => \Categoriestable\Controller\ListController::class,
            'Categoriestable\Controller\Properties'   => \Categoriestable\Controller\PropertiesController::class,
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
