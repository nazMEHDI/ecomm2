<?php

/**
 * Melis Technology (http://www.melistechnology.com]
 *
 * @copyright Copyright (c] 2015 Melis Technology (http://www.melistechnology.com]
 *
 */

return [
    'plugins' => [
        'users' => [
            'tools' => [
                'users_tools' => [
                    'conf' => [
                        'title' => 'tr_users_templates',
                        'id' => 'id_users_templates',
                    ],
                    'table' => [
                        // table ID
                        'target' => '#tableToolUsers',
                        'ajaxUrl' => '/melis/Users/List/getList',
                        'dataFunction' => '',
                        'ajaxCallback' => '',
                        'filters' => [
                            'left' => [
                                'users-tbl-filter-limit' => [
                                    'module' => 'Users',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-limit',
                                ],
                            ],
                            'center' => [
                                'users-tbl-filter-search' => [
                                    'module' => 'Users',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-search',
                                ],
                            ],
                            'right' => [
                                'users-tbl-filter-refresh' => [
                                    'module' => 'Users',
                                    'controller' => 'List',
                                    'action' => 'render-table-filter-refresh',
                                ],
                            ],
                        ],
                        'columns' => [
                            'DT_RowId' => [
								'text' => 'tr_users_input_id',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'username' => [
								'text' => 'tr_users_input_username',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'phone' => [
								'text' => 'tr_users_input_phone',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'email' => [
								'text' => 'tr_users_input_email',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'password' => [
								'text' => 'tr_users_input_password',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'role' => [
								'text' => 'tr_users_input_role',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'status' => [
								'text' => 'tr_users_input_status',
								'css' => ['width' => '14%'],
								'sortable' => true
							],
                            'created_at' => [
								'text' => 'tr_users_input_created_at',
								'css' => ['width' => '14%'],
								'sortable' => true
							]
                        ],
                        // define what columns can be used in searching
                        'searchables' => [
							'id',
							'username',
                            'phone',
							'email',
							'password',
							'role',
							'status',
							'created_at'
                        ],
                        'actionButtons' => [
                            'edit' => [
                                  'module' => 'Users',
                                  'controller' => 'List',
                                  'action' => 'render-table-action-edit',
                            ],
                            'delete' => [
                                'module' => 'Users',
                                'controller' => 'List',
                                'action' => 'render-table-action-delete',
                            ],
                        ]
                    ],
                    'forms' => [
                        'users_property_form' => [
                            'attributes' => [
                                'name' => 'usersForm',
                                'id' => 'usersForm',
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
                                            'label' => 'tr_users_input_id',
                                            'tooltip' => 'tr_users_input_id_tooltip',
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
                                        'name' => 'username',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_users_input_username',
                                            'tooltip' => 'tr_users_input_username_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'username',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'phone',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_users_input_phone',
                                            'tooltip' => 'tr_users_input_phone_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'phone',
                                            'class' => 'form-control',
                                            'required' => true,
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'email',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_users_input_email',
                                            'tooltip' => 'tr_users_input_email_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'email',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'password',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_users_input_password',
                                            'tooltip' => 'tr_users_input_password_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'password',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'role',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_users_input_role',
                                            'tooltip' => 'tr_users_input_role_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'role',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ],
                                [
                                    'spec' => [
                                        'name' => 'status',
                                        'type' => 'MelisText',
                                        'options' => [
                                            'label' => 'tr_users_input_status',
                                            'tooltip' => 'tr_users_input_status_tooltip',
                                        ],
                                        'attributes' => [
                                            'id' => 'status',
                                            'class' => 'form-control',
                                            'required' => true,
                                            
                                        ],
                                    ],
                                ]
                            ],
                            'input_filter' => [
                                'username' => [
                                    'name'     => 'username',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_users_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 4,
                                                'max'      => 20,
                                                'messages' => [
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_users_input_username_too_long',
                                                    \Laminas\Validator\StringLength::TOO_SHORT => 'tr_users_input_username_too_short',
                                                ],
                                            ],
                                        ],
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],

                                'phone' => [
                                    'name'     => 'phone',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_users_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 10,
                                                'max'      => 10,
                                                'messages' => [
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_users_input_phone_too_long',
                                                    \Laminas\Validator\StringLength::TOO_SHORT => 'tr_users_input_phone_too_short',
                                                ],
                                            ],
                                        ],
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],


                                'email' => [
                                    'name'     => 'email',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_users_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name' => 'EmailAddress',
                                            'options' => [
                                                'domain'   => 'true',
                                                'hostname' => 'true',
                                                'mx'       => 'true',
                                                'deep'     => 'true',
                                                'message'  => 'tr_users_input_email_invalid_domain',
                                            ],
                                        ],
                                        [
                                            'name' => 'regex', false,
                                            'options' => [
                                                'pattern' => '/^[a-zA-Z0-9_.+-]+([._@]?[a-zA-Z0-9])*$/',
                                                'messages' => [\Laminas\Validator\Regex::NOT_MATCH => 'tr_users_input_email_invalid'],
                                                'encoding' => 'UTF-8',
                                            ],
                                        ],
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'max'      => 255,
                                                'messages' => [
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_users_input_email_invalid_too_long'
                                                ],
                                            ],
                                        ],
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],
                                'password' => [
                                    'name'     => 'password',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_users_value_must_not_is_empty',
                                                ],
                                            ],
                                        ],
                                        [
                                            'name' => 'regex',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'pattern' => '/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/',
                                                'messages' => [
                                                    \Laminas\Validator\Regex::NOT_MATCH => 'tr_users_input_password_ivalid_char',
                                                ]
                                            ],
                                        ],
                                        [
                                            'name'    => 'StringLength',
                                            'options' => [
                                                'encoding' => 'UTF-8',
                                                'min'      => 8,
                                                'max'      => 255,
                                                'messages' => [
                                                    \Laminas\Validator\StringLength::TOO_LONG => 'tr_users_input_password_too_long',
                                                    \Laminas\Validator\StringLength::TOO_SHORT => 'tr_users_input_password_too_short',
                                                ],
                                            ],
                                        ],
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],
                                'role' => [
                                    'name'     => 'role',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_users_value_must_not_is_empty',
                                                ],
                                            ],
                                        ]
                                    ],
                                    'filters'  => [
                                        ['name' => 'StripTags'],
                                        ['name' => 'StringTrim'],
                                    ],
                                ],
                                'status' => [
                                    'name'     => 'status',
                                    'required' => true,
                                    'validators' => [
                                        [
                                            'name' => 'NotEmpty',
                                            'options' => [
                                                'messages' => [
                                                    \Laminas\Validator\NotEmpty::IS_EMPTY => 'tr_users_value_must_not_is_empty',
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