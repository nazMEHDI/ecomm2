<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'plugins' => [
        'productstable' => [
            'tools' => [
                'productstable_tools' => [
                    'conf' => [
                        'title' => 'tr_productstable_templates',
                        'id' => 'id_productstable_templates',
                    ],
                    'table' => [
                        // table ID
                        'target' => '#tableToolProductstable',
                        'ajaxUrl' => '/melis/Productstable/List/getList',
                        'dataFunction' => '',
                        'ajaxCallback' => '',
                        'filters' => [
                            'left' => [
                                'productstable-tbl-filter-limit' => [
                                    'module' => 'Productstable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-limit',
                                ],
                            ],
                            'center' => [
                                'productstable-tbl-filter-search' => [
                                    'module' => 'Productstable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-search',
                                ],
                            ],
                            'right' => [
                                'productstable-tbl-filter-refresh' => [
                                    'module' => 'Productstable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-refresh',
                                ],
                            ],
                        ],
                        'columns' => [
                            'DT_RowId' => [
								'text' => 'tr_productstable_input_id',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'name' => [
								'text' => 'tr_productstable_input_name',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'description' => [
								'text' => 'tr_productstable_input_description',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'price' => [
								'text' => 'tr_productstable_input_price',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'image' => [
								'text' => 'tr_productstable_input_image',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'quantity' => [
								'text' => 'tr_productstable_input_quantity',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'category' => [
								'text' => 'tr_productstable_input_category',
								'css' => ['width' => '14%'],
								'sortable' => true
							]
                        ],
                        // define what columns can be used in searching
                        'searchables' => [
							'id',
							'name',
							'description',
							'price',
							'image',
							'quantity',
							'category'
                        ],
                        'actionButtons' => [
                            'edit' => [
                                  'module' => 'Productstable',
                                  'controller' => 'List',
                                  'action' => 'render-table-action-edit',
                            ],
                            'delete' => [
                                'module' => 'Productstable',
                                'controller' => 'List',
                                'action' => 'render-table-action-delete',
                            ],
                        ]
                    ],
                    'forms' => [
                        'productstable_property_form' => [
                            'attributes' => [
                                'name' => 'productstableForm',
                                'id' => 'productstableForm',
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
                                            'label' => 'tr_productstable_input_id',
                                            'tooltip' => 'tr_productstable_input_id_tooltip',
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
                                        'name' => 'name',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_productstable_input_name',
                                            'tooltip' => 'tr_productstable_input_name_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'name',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'description',
                                        'type' => 'Textarea',
                                        'options' => [
                                            'label' => 'tr_productstable_input_description',
                                            'tooltip' => 'tr_productstable_input_description_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'description',
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
                                            'label' => 'tr_productstable_input_price',
                                            'tooltip' => 'tr_productstable_input_price_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'price',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'image',
                                        'type' => 'file',
                                        'attributes' => [
                                            'id' => 'image',
                                            'class' => 'filestyle',
                                            'required' => true,
                                            'label' => 'Upload',
                                            
                                        ],
                                        'options' => [
                                            'label' => 'tr_productstable_input_image',
                                            'tooltip' => 'tr_productstable_input_image_tooltip',
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'quantity',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_productstable_input_quantity',
                                            'tooltip' => 'tr_productstable_input_quantity_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'quantity',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'category',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_productstable_input_category',
                                            'tooltip' => 'tr_productstable_input_category_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'category',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ]
                            ],
                            'input_filter' => [
                                'name' => [
                                    'name'     => 'name',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_productstable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 4,
                                                'max'      => 255,
                                                'messages' => [
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_productstable_input_name_too_long',
                                                    \Laminas\Validator\StringLength::TOO_SHORT => 'tr_productstable_input_name_too_short',
                                                ],
                                            ],
                                        ],
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],
                                
                                'description' => [
                                    'name'     => 'description',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_productstable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 16,
                                                'max'      => 255,
                                                'messages' => [
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_productstable_input_description_too_long',
                                                    \Laminas\Validator\StringLength::TOO_SHORT => 'tr_productstable_input_description_too_short',
                                                ],
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
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_productstable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name' => 'Regex',
                                            'options' => [
                                                'pattern' => '/^[0-9]+(.[0-9]{1,2})?$/',
                                                'messages' => [
                                                    \Laminas\Validator\Regex::NOT_MATCH => 'tr_productstable_input_price_must_numeric',
                                                ],
                                                'encoding' => 'UTF-8',
                                            ],
                                        ]
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],
                                
                                'image' => [
                                    'name'     => 'image',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_productstable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ]
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],
                                'quantity' => [
                                    'name'     => 'quantity',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_productstable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name' => 'Regex',
                                            'options' => [
                                                // 'pattern' => '/^[-0-9]+(.[0-9]{1,2})?$/',
                                                'pattern' => '/^[1-9]\d*$/',
                                                'messages' => [
                                                    \Laminas\Validator\Regex::NOT_MATCH => 'tr_productstable_input_quantity_must_numeric',
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
                                'category' => [
                                    'name'     => 'category',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_productstable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name' => 'Regex',
                                            'options' => [
                                                'pattern' => '/^[1-9]\d*$/',
                                                'messages' => [
                                                    \Laminas\Validator\Regex::NOT_MATCH => 'tr_productstable_value_must_numeric_category'
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