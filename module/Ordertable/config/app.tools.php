<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'plugins' => [
        'ordertable' => [
            'tools' => [
                'ordertable_tools' => [
                    'conf' => [
                        'title' => 'tr_ordertable_templates',
                        'id' => 'id_ordertable_templates',
                    ],
                    'table' => [
                        // table ID
                        'target' => '#tableToolOrdertable',
                        'ajaxUrl' => '/melis/Ordertable/List/getList',
                        'dataFunction' => '',
                        'ajaxCallback' => '',
                        'filters' => [
                            'left' => [
                                'ordertable-tbl-filter-limit' => [
                                    'module' => 'Ordertable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-limit',
                                ],
                            ],
                            'center' => [
                                'ordertable-tbl-filter-search' => [
                                    'module' => 'Ordertable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-search',
                                ],
                            ],
                            'right' => [
                                'ordertable-tbl-filter-refresh' => [
                                    'module' => 'Ordertable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-refresh',
                                ],
                            ],
                        ],
                        'columns' => [
                            'DT_RowId' => [
								'text' => 'tr_ordertable_input_id',
								'css' => ['width' => '33%'],
								'sortable' => true
							],
                            'quntity' => [
                                'text' => 'tr_ordertable_input_quntity',
                                'css' => ['width' => '33%'],
                                'sortable' => true
                            ],
                            'price' => [
								'text' => 'tr_ordertable_input_price',
								'css' => ['width' => '33%'],
								'sortable' => true
							],
                        ],
                        // define what columns can be used in searching
                        'searchables' => [
							'id',
							'price',
                            'quntity',
                        ],
                        'actionButtons' => [
                            'edit' => [
                                  'module' => 'Ordertable',
                                  'controller' => 'List',
                                  'action' => 'render-table-action-edit',
                            ],
                            'delete' => [
                                'module' => 'Ordertable',
                                'controller' => 'List',
                                'action' => 'render-table-action-delete',
                            ],
                        ]
                    ],
                    'forms' => [
                        'ordertable_property_form' => [
                            'attributes' => [
                                'name' => 'ordertableForm',
                                'id' => 'ordertableForm',
                                'method' => 'POST',
                                'action' => '',
                            ],
                            'hydrator'  => 'Laminas\Hydrator\ArraySerializableHydrator',
                            'elements' => [
                                [
                                    'spec' => [
                                        'name' => 'id',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_ordertable_input_id',
                                            'tooltip' => 'tr_ordertable_input_id_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'id',
                                            'class' => 'form-control',
                                            'required' => false,
                                            'disabled' => 'disabled'
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'quntity',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_ordertable_input_quntity',
                                            'tooltip' => 'tr_ordertable_input_quntity_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'quntity',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'price',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_ordertable_input_price',
                                            'tooltip' => 'tr_ordertable_input_price_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'price',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ]
                            ],
                            'input_filter' => [
                                'quntity' => [
                                    'name'     => 'quntity',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_ordertable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name' => 'Regex',
                                            'options' => [
                                                // 'pattern' => '/^[-0-9]+(.[0-9]{1,2})?$/',
                                                'pattern' => '/^[1-9]\d*$/',
                                                'messages' => [
                                                    \Laminas\Validator\Regex::NOT_MATCH => 'tr_ordertable_input_quntity_must_numeric',
                                                ],
                                                'encoding' => 'UTF-8',
                                            ],
                                        ],
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],
                                'price' => [
                                    'name'     => 'price',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_ordertable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name' => 'Regex',
                                            'options' => [
                                                'pattern' => '/^[0-9]+(.[0-9]{1,2})?$/',
                                                'messages' => [
                                                    \Laminas\Validator\Regex::NOT_MATCH => 'tr_ordertable_input_price_must_numeric'
                                                ],
                                                'encoding' => 'UTF-8',
                                            ],
                                        ]
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ]
                            ]
                        ],

                    ]
                ]
            ]
        ]
    ]
];