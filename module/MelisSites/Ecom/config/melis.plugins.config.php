<?php
return [
    'plugins' => [
        'melisfront' => [
            'plugins' => [
                'MelisFrontMenuPlugin' => [
                    'front' => [
                        'template_path' => [
                            'Dekra/plugins/header',
                            'Dekra/plugins/footer',
                        ],
                    ],
                ],
                'MelisFrontGdprBannerPlugin' => [
                    'front' => [
                        'template_path' => [
                            'Dekra/plugins/gdpr-banner'
                        ]
                    ],
                ],
            ],
        ],
    ]
];