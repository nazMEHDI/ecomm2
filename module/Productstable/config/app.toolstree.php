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
                                'productstable_conf' => [
                                    'conf' => [
                                        'id' => 'id_productstable_leftmenu',
                                        'melisKey' => 'productstable_leftmenu',
                                        'name' => 'tr_productstable_title',
                                        'icon' => 'fa fa-puzzle-piece',
                                    ],
                                    'interface' => [
                                        'productstable_tool' => [
                                            'conf' => [
                                                'id' => 'id_productstable_tool',
                                                'melisKey' => 'productstable_tool',
                                                'name' => 'tr_productstable_title',
                                                'icon' => 'fa fa-puzzle-piece',
                                            ],
                                            'forward' => [
                                                'module' => 'Productstable',
                                                'controller' => 'List',
                                                'action' => 'render-tool',
                                                'jscallback' => '',
                                                'jsdatas' => []
                                            ],
                                            'interface' => [
                                                'productstable_header' => [
                                                    'conf' => [
                                                        'id' => 'id_productstable_header',
                                                        'melisKey' => 'productstable_header',
                                                        'name' => 'tr_productstable_header',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Productstable',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-header',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                ],
                                                'productstable_content' => [
                                                    'conf' => [
                                                        'id' => 'id_productstable_content',
                                                        'melisKey' => 'productstable_content',
                                                        'name' => 'tr_productstable_content',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Productstable',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-content',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                    'interface' => [
                                                        'productstable_modal' => [
                                                            'conf' => [
                                                                'id' => 'id_productstable_modal',
                                                                'melisKey' => 'productstable_modal',
                                                                'name' => 'tr_productstable_modal',
                                                            ],
                                                            'forward' => [
                                                                'module' => 'Productstable',
                                                                'controller' => 'List',
                                                                'action' => 'render-modal-form',
                                                                'jscallback' => '',
                                                                'jsdatas' => []
                                                            ],
                                                            'interface' => [
                                                                'productstable_properties_form' => [
                                                                    'conf' => [
                                                                        'id' => 'id_productstable_properties_form',
                                                                        'melisKey' => 'productstable_properties_form',
                                                                        'name' => 'tr_productstable_properties',
                                                                        'icon' => 'cogwheel'
                                                                    ],
                                                                    'forward' => [
                                                                        'module' => 'Productstable',
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