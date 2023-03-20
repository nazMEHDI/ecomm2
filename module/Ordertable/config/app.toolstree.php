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
                                'ordertable_conf' => [
                                    'conf' => [
                                        'id' => 'id_ordertable_leftmenu',
                                        'melisKey' => 'ordertable_leftmenu',
                                        'name' => 'tr_ordertable_title',
                                        'icon' => 'fa fa-puzzle-piece',
                                    ],
                                    'interface' => [
                                        'ordertable_tool' => [
                                            'conf' => [
                                                'id' => 'id_ordertable_tool',
                                                'melisKey' => 'ordertable_tool',
                                                'name' => 'tr_ordertable_title',
                                                'icon' => 'fa fa-puzzle-piece',
                                            ],
                                            'forward' => [
                                                'module' => 'Ordertable',
                                                'controller' => 'List',
                                                'action' => 'render-tool',
                                                'jscallback' => '',
                                                'jsdatas' => []
                                            ],
                                            'interface' => [
                                                'ordertable_header' => [
                                                    'conf' => [
                                                        'id' => 'id_ordertable_header',
                                                        'melisKey' => 'ordertable_header',
                                                        'name' => 'tr_ordertable_header',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Ordertable',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-header',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                ],
                                                'ordertable_content' => [
                                                    'conf' => [
                                                        'id' => 'id_ordertable_content',
                                                        'melisKey' => 'ordertable_content',
                                                        'name' => 'tr_ordertable_content',
                                                    ],
                                                    'forward' => [
                                                        'module' => 'Ordertable',
                                                        'controller' => 'List',
                                                        'action' => 'render-tool-content',
                                                        'jscallback' => '',
                                                        'jsdatas' => []
                                                    ],
                                                    'interface' => [
                                                        'ordertable_modal' => [
                                                            'conf' => [
                                                                'id' => 'id_ordertable_modal',
                                                                'melisKey' => 'ordertable_modal',
                                                                'name' => 'tr_ordertable_modal',
                                                            ],
                                                            'forward' => [
                                                                'module' => 'Ordertable',
                                                                'controller' => 'List',
                                                                'action' => 'render-modal-form',
                                                                'jscallback' => '',
                                                                'jsdatas' => []
                                                            ],
                                                            'interface' => [
                                                                'ordertable_properties_form' => [
                                                                    'conf' => [
                                                                        'id' => 'id_ordertable_properties_form',
                                                                        'melisKey' => 'ordertable_properties_form',
                                                                        'name' => 'tr_ordertable_properties',
                                                                        'icon' => 'cogwheel'
                                                                    ],
                                                                    'forward' => [
                                                                        'module' => 'Ordertable',
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