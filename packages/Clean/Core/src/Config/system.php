<?php

return [
    [
        'key'  => 'clean',
        'name' => 'Clean',
        'sort' => 1,
        'fields' => [
            [
                'key'    => 'clean.general',
                'name'   => 'General',
                'sort'   => 1,
                'fields' => [
                    [
                        'key'          => 'clean.general.enabled',
                        'name'         => 'Enabled',
                        'type'         => 'boolean',
                        'default'      => true,
                        'channel_based' => false,
                        'locale_based'  => false,
                    ],
                    [
                        'key'          => 'clean.general.company_name',
                        'name'         => 'Company Name',
                        'type'         => 'text',
                        'default'      => 'Clean Products Store',
                        'channel_based' => true,
                        'locale_based'  => false,
                    ],
                    [
                        'key'          => 'clean.general.support_email',
                        'name'         => 'Support Email',
                        'type'         => 'text',
                        'default'      => 'support@cleanstore.com',
                        'channel_based' => true,
                        'locale_based'  => false,
                    ],
                ],
            ],
            [
                'key'    => 'clean.catalog',
                'name'   => 'Catalog Settings',
                'sort'   => 2,
                'fields' => [
                    [
                        'key'          => 'clean.catalog.default_category',
                        'name'         => 'Default Category for Clean Products',
                        'type'         => 'select',
                        'default'      => null,
                        'channel_based' => true,
                        'locale_based'  => false,
                    ],
                    [
                        'key'          => 'clean.catalog.show_eco_badge',
                        'name'         => 'Show Eco-Friendly Badge',
                        'type'         => 'boolean',
                        'default'      => true,
                        'channel_based' => true,
                        'locale_based'  => false,
                    ],
                ],
            ],
        ],
    ],
];