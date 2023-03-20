<?php

return [
    'router' => [
        'routes' => [
            'Ecom-home' => [
                'type'    => 'regex',
                'options' => [
                    'regex'    => '.*/Ecom/.*/id/(?<idpage>[0-9]+)',
                    'defaults' => [
                        'controller' => 'Ecom\Controller\Index',
                        'action'     => 'indexsite',
                    ],
                    'spec' => '%idpage'
                ]
            ],
            'Ecom-homepage' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller'     => 'MelisFront\Controller\Index',
                        'action'         => 'index',
                        'renderType'     => 'melis_zf2_mvc',
                        'renderMode'     => 'front',
                        'preview'        => false,
                        'idpage'         => 1
                    ]
                ],
            ],
            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'applicationEcom' => [
                'type'    => 'Literal',
                'options' => [
                    'route'    => '/Ecom',
                    'defaults' => [
                        '__NAMESPACE__' => 'Ecom\Controller',
                        'controller'    => 'Index',
                        'action'        => 'indexsite',
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
                            'defaults' => [],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'Ecom\Controller\Home'    => Ecom\Controller\HomeController::class,
            'Ecom\Controller\Shop'    => Ecom\Controller\ShopController::class,
            'Ecom\Controller\Contact' => Ecom\Controller\ContactController::class,
            'Ecom\Controller\Blog' => Ecom\Controller\BlogController::class,
            'Ecom\Controller\Product' => Ecom\Controller\ProductController::class,
            'Ecom\Controller\Checkout' => Ecom\Controller\CheckoutController::class,
            'Ecom\Controller\Cart' => Ecom\Controller\CartController::class,
            'Ecom\Controller\Blogdts' => Ecom\Controller\BlogdtsController::class,
            'Ecom\Controller\Page404' => Ecom\Controller\Page404Controller::class
        ],
    ],
    'view_manager' => [
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'controller_map' => [
            'Ecom' => true,
        ],
        'template_map' => [
            'Ecom/defaultLayout'  => __DIR__ . '/../view/layout/defaultLayout.phtml',
            'Dekra/plugins/header' => __DIR__ . '/../view/plugins/header.phtml',
            'Dekra/plugins/footer' => __DIR__ . '/../view/plugins/footer.phtml',
            'layout/errorLayout'        => __DIR__ . '/../view/error/404.phtml',

            // Errors layout
            'error/404'     => __DIR__ . '/../view/error/404.phtml',
            'error/index'   => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];