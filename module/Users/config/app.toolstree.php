<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'plugins' => [
        'meliscore' => [
            'interface' => [
                'meliscore_leftmenu' => [
                    'interface' => [
                        'meliscustom_toolstree_section' => [
                            'interface' => [
                                'users_conf' => [
                                    'conf' => [
                                        'id' => 'id_users_leftmenu',
                                        'melisKey' => 'users_leftmenu',
                                        'name' => 'tr_users_title',
                                        'icon' => 'fa fa-puzzle-piece',
                                    ],
                                    'interface' => [
                                        'users_tool' => [
                                            'conf' => [
                                                'id' => 'id_users_tool',
                                                'melisKey' => 'users_tool',
                                                'name' => 'tr_users_title',
                                                'icon' => 'fa fa-puzzle-piece',
                                            ],
                                            'forward' => [
                                                'module' => 'Users',
                                                'controller' => 'List',
                                                'action' => 'render-tool',
                                                'jscallback' => '',
                                                'jsdatas' => []
                                            ],
                                            'interface' => [
                                                'users_header' => [
                                                    'conf' => [
                                                        'id' => 'id_users_header',
                                                        'melisKey' => 'users_header',
                                                        'name' => 'tr_users_header',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Users',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-header',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                ],
                                                'users_content' => [
                                                    'conf' => [
                                                        'id' => 'id_users_content',
                                                        'melisKey' => 'users_content',
                                                        'name' => 'tr_users_content',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Users',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-content',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                    'interface' => [
                                                        'users_modal' => [
                                                            'conf' => [
                                                                'id' => 'id_users_modal',
                                                                'melisKey' => 'users_modal',
                                                                'name' => 'tr_users_modal',
                                                            ],
                                                            'forward' => [
                                                                'module' => 'Users',
                                                                'controller' => 'List',
                                                                'action' => 'render-modal-form',
                                                                'jscallback' => '',
                                                                'jsdatas' => []
                                                            ],
                                                            'interface' => [
                                                                'users_properties_form' => [
                                                                    'conf' => [
                                                                        'id' => 'id_users_properties_form',
                                                                        'melisKey' => 'users_properties_form',
                                                                        'name' => 'tr_users_properties',
                                                                        'icon' => 'cogwheel'
                                                                    ],
                                                                    'forward' => [
                                                                        'module' => 'Users',
                                                                        'controller' => 'Properties',
                                                                        'action' => 'render-properties-form',
                                                                        'jscallback' => '',
                                                                        'jsdatas' => []
                                                                    ]
                                                                ],
#TCTOOLINTERFACE
                                                            ]
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ]
];