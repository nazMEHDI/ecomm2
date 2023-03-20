<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'plugins' => [
        'categoriestable' => [
            'tools' => [
                'categoriestable_tools' => [
                    'conf' => [
                        'title' => 'tr_categoriestable_templates',
                        'id' => 'id_categoriestable_templates',
                    ],
                    'table' => [
                        // table ID
                        'target' => '#tableToolCategoriestable',
                        'ajaxUrl' => '/melis/Categoriestable/List/getList',
                        'dataFunction' => '',
                        'ajaxCallback' => '',
                        'filters' => [
                            'left' => [
                                'categoriestable-tbl-filter-limit' => [
                                    'module' => 'Categoriestable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-limit',
                                ],
                            ],
                            'center' => [
                                'categoriestable-tbl-filter-search' => [
                                    'module' => 'Categoriestable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-search',
                                ],
                            ],
                            'right' => [
                                'categoriestable-tbl-filter-refresh' => [
                                    'module' => 'Categoriestable',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-refresh',
                                ],
                            ],
                        ],
                        'columns' => [
                            'DT_RowId' => [
								'text' => 'tr_categoriestable_input_id',
								'css' => ['width' => '33%'],
								'sortable' => true
							],
                            'name' => [
								'text' => 'tr_categoriestable_input_name',
								'css' => ['width' => '33%'],
								'sortable' => true
							],
                            'description' => [
								'text' => 'tr_categoriestable_input_description',
								'css' => ['width' => '33%'],
								'sortable' => true
							]
                        ],
                        // define what columns can be used in searching
                        'searchables' => [
							'id',
							'name',
							'description'
                        ],
                        'actionButtons' => [
                            'edit' => [
                                  'module' => 'Categoriestable',
                                  'controller' => 'List',
                                  'action' => 'render-table-action-edit',
                            ],
                            'delete' => [
                                'module' => 'Categoriestable',
                                'controller' => 'List',
                                'action' => 'render-table-action-delete',
                            ],
                        ]
                    ],
                    'forms' => [
                        'categoriestable_property_form' => [
                            'attributes' => [
                                'name' => 'categoriestableForm',
                                'id' => 'categoriestableForm',
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
                                            'label' => 'tr_categoriestable_input_id',
                                            'tooltip' => 'tr_categoriestable_input_id_tooltip',
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
                                            'label' => 'tr_categoriestable_input_name',
                                            'tooltip' => 'tr_categoriestable_input_name_tooltip',
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
                                            'label' => 'tr_categoriestable_input_description',
                                            'tooltip' => 'tr_categoriestable_input_description_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'description',
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
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_categoriestable_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 3,
                                                'max'      => 20,
                                                'messages' => [
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_categoriestable_input_name_too_long',
                                                    \Laminas\Validator\StringLength::TOO_SHORT => 'tr_categoriestable_input_name_too_short',
                                                ],
                                            ],
                                        ]
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
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_categoriestable_value_must_not_is_empty',
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
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_categoriestable_input_description_too_long',
                                                    \Laminas\Validator\StringLength::TOO_SHORT => 'tr_categoriestable_input_description_too_short',
                                                ],
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