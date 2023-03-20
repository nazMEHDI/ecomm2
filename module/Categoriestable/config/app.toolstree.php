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
                                'categoriestable_conf' => [
                                    'conf' => [
                                        'id' => 'id_categoriestable_leftmenu',
                                        'melisKey' => 'categoriestable_leftmenu',
                                        'name' => 'tr_categoriestable_title',
                                        'icon' => 'fa fa-puzzle-piece',
                                    ],
                                    'interface' => [
                                        'categoriestable_tool' => [
                                            'conf' => [
                                                'id' => 'id_categoriestable_tool',
                                                'melisKey' => 'categoriestable_tool',
                                                'name' => 'tr_categoriestable_title',
                                                'icon' => 'fa fa-puzzle-piece',
                                            ],
                                            'forward' => [
                                                'module' => 'Categoriestable',
                                                'controller' => 'List',
                                                'action' => 'render-tool',
                                                'jscallback' => '',
                                                'jsdatas' => []
                                            ],
                                            'interface' => [
                                                'categoriestable_header' => [
                                                    'conf' => [
                                                        'id' => 'id_categoriestable_header',
                                                        'melisKey' => 'categoriestable_header',
                                                        'name' => 'tr_categoriestable_header',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Categoriestable',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-header',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                ],
                                                'categoriestable_content' => [
                                                    'conf' => [
                                                        'id' => 'id_categoriestable_content',
                                                        'melisKey' => 'categoriestable_content',
                                                        'name' => 'tr_categoriestable_content',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Categoriestable',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-content',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                    'interface' => [
                                                        'categoriestable_modal' => [
                                                            'conf' => [
                                                                'id' => 'id_categoriestable_modal',
                                                                'melisKey' => 'categoriestable_modal',
                                                                'name' => 'tr_categoriestable_modal',
                                                            ],
                                                            'forward' => [
                                                                'module' => 'Categoriestable',
                                                                'controller' => 'List',
                                                                'action' => 'render-modal-form',
                                                                'jscallback' => '',
                                                                'jsdatas' => []
                                                            ],
                                                            'interface' => [
                                                                'categoriestable_properties_form' => [
                                                                    'conf' => [
                                                                        'id' => 'id_categoriestable_properties_form',
                                                                        'melisKey' => 'categoriestable_properties_form',
                                                                        'name' => 'tr_categoriestable_properties',
                                                                        'icon' => 'cogwheel'
                                                                    ],
                                                                    'forward' => [
                                                                        'module' => 'Categoriestable',
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