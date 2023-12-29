<?php

if (! function_exists('get_menu')) {
    function get_menu($current_page = ''): array
    {
        return [
            [
                'active' => 'active',
                'url' => '/',
                'name' => 'Головна',
            ],
            [
                'active' => '',
                'url' => '/carpatian-hikes',
                'name' => 'Походи в Карпати',
            ],
            [
                'active' => '',
                'url' => '/foreign-hikes',
                'name' => 'Мандрівки закордон',
            ],
            [
                'active' => '',
                'url' => '/page/useful',
                'name' => 'Корисне',
            ],
            [
                'active' => '',
                'url' => '/page/contact-form',
                'name' => 'Контакти',
            ],
        ];
    }

}

if (! function_exists('get_admin_menu')) {
    function get_admin_menu(): array
    {
        $db = \Config\Database::connect();
        $builder = $db->table('static-page');
        $output = $builder->get();
        $static_pages = $output->getResultArray();
        $static_pages_params = [];
        foreach ($static_pages as $page) {
            $static_pages_params[] = [
                'title' => $page['title'],
                'url' => $page['alias'],
            ];
        }
        
        $builder = $db->table('dynamic');
        $output = $builder->get();
        $dynamic_pages = $output->getResultArray();
        $dynamic_pages_params = [];
        foreach ($dynamic_pages as $page) {
            $dynamic_pages_params[] = [
                'title' => $page['caption'],
                'url' => 'dynamic/' . $page['alias'],
            ];
        }
        
        array_unshift($dynamic_pages_params, [
            'title' => 'Додати сторінку',
            'url' => 'dynamic/add',
        ]);
        
        return [
            [
                'block_title' => 'Меню',
                'links' => [
                    [
                        'icon' => 'fa fa-home',
                        'title' => 'Дім',
                        'url' => '/home',
                        'links' => [],
                    ],
                    [
                        'icon' => 'fa fa-edit',
                        'title' => 'Сторінки',
                        'links' => $static_pages_params,
                        'url' => '',
                    ],
                    [
                        'icon' => 'fa fa-plus',
                        'title' => 'Допоміжні сторінки',
                        'links' => $dynamic_pages_params,
                        'url' => '',
                    ],
                    [
                        'icon' => 'fa fa-table',
                        'title' => 'Каталог',
                        'links' => [
                            [
                                'title' => 'Походи в Карпати',
                                'url' => '/hike/carpatian'
                            ],
                            [
                                'title' => 'Мандрівки закордон',
                                'url' => '/hike/foreign'
                            ],
                        ],
                        'url' => '',
                    ],
                    [
                        'icon' => 'fa fa-gear',
                        'title' => 'Сайт',
                        'links' => [
                            [
                                'title' => 'Налаштування',
                                'url' => '/settings',
                            ]
                        ],
                        'url' => '',
                    ],
                ],
            ],
        ];
    }

}
