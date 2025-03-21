<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'Roles Bahia Motors',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => true,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => '<b>Bahia</b> Motors Group',
    'logo_img' => 'images/icono-de-bahia.png',
    'logo_img_class' => 'brand-image elevation-3',
    'logo_img_xl' => null,
    'logo_img_xl_class' => 'brand-image-xs',
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/icono_logo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => true,
        'img' => [
            'path' => 'vendor/adminlte/dist/img/LogoBahiaMotors.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-info',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => null,
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-info',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '',
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-info',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-custom navbar-dark',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => null,
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 600,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Mix
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Mix option for the admin panel.
    |
    | For detailed instructions you can look the laravel mix section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'enabled_laravel_mix' => false,
    'laravel_mix_css_path' => 'css/app.css',
    'laravel_mix_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'menu' => [
        // Navbar items:
        [
            'type'         => 'navbar-search',
            'text'         => 'buscar',
            'topnav_right' => true,
        ],


        [
            'type'         => 'fullscreen-widget',
            'topnav_right' => true,
        ],

        // Sidebar items:
          [
            'type' => 'sidebar-menu-search',
            'text' => 'buscar',
        ],
        // [
        //     'text' => 'Newsletters',
        //     'url'  => 'admin/newsletters',
        //     'icon'    => 'fas fa-file-lines ',
        //     'can'         => 'ver-departamentos',
        // ],
        [
            'text' => 'Tallas',
            'url'  => 'admin/sizes',
            'icon'    => 'fas fa-fw fa-up-right-and-down-left-from-center ',
            'can'         => 'ver-tallas',
        ],
        [
            'text' => 'Uniformes',
            'url'  => 'admin/uniforms',
            'icon'    => 'fas fa-fw fa-up-right-and-down-left-from-center ',
            'can'         => 'ver-uniformes',
        ],
        [
            'text' => 'Departamentos',
            'url'  => 'admin/departments',
            'icon'    => 'fas fa-fw fa-building ',
            'can'         => 'ver-departamentos',
        ],
        [
            'text' => 'Colaboradores',
            'url'  => 'admin/employees',
            'icon'    => 'fas fa-fw fa-address-card',
            'can'         => 'ver-colaboradores',
        ],
        [
            'text' => 'Cargos',
            'url'  => 'admin/jobtitles',
            'icon'    => 'fas fa-fw fa-file ',
            'can'         => 'ver-cargos',
        ],

        [
            'text' => 'Cuentas',
            'url'  => 'admin/accounts',
            'icon'    => 'fas fa-fw fa-tag',
            'can'         => 'ver-cuentas',
        ],
        [
            'text' => 'Sucursales',
            'url'  => 'admin/branchoffices',
            'icon'    => 'fas fa-fw fa-code-branch',
            'can'         => 'ver-sucursales',
        ],
        [
            'text' => 'Direcciones IP',
            'url'  => 'admin/ipaddresses',
            'icon'    => 'fas fa-fw fa-map-pin',
            'can'         => 'ver-direccionesip',
        ],
        // [
        //     'text' => 'Dispositivos',
        //     'url'  => 'admin/devices',
        //     'icon'    => 'fas fa-fw fa-desktop',
        //     'can'         => 'ver-dispositivos',
        // ],
        [
            'text' => 'Tipos de Discos',
            'url'  => 'admin/disktypes',
            'icon'    => 'fas fa-fw fa-disease',
            'can'         => 'ver-tipodiscos',
        ],
        // [
        //     'text' => 'Marcas',
        //     'url'  => 'admin/brands',
        //     'icon'    => 'fas fa-regular fa-copyright',
        //     'can'         => 'ver-marcas',
        // ],
        // [
        //     'text' => 'Modelos',
        //     'url'  => 'admin/carmodels',
        //     'icon'    => 'fas fa-solid fa-briefcase',
        //     'can'         => 'ver-modelos',
        // ],
        [
            'text' => 'Sistema Operativo',
            'url'  => 'admin/operatingsystems',
            'icon'    => 'fas fa-brands fa-windows',
            'can'         => 'ver-sistemaoperativos',
        ],
        // [
        //     'text' => 'Tamaño de disco',
        //     'url'  => 'admin/diskstorages',
        //     'icon'    => 'fas fa-box-archive',
        //     'can'         => 'ver-tamanodiscos',
        // ],
        [
            'text' => 'Office',
            'url'  => 'admin/microsoftoffices',
            'icon'    => 'fas fa-brands fa-microsoft',
            'can'         => 'ver-licenciaoffices',
        ],
        [
            'text'    => 'Config. Dispositivos',
            'icon'    => 'fas fa-fw  fa-wrench',
               'submenu' =>
               [
                   [
                       'text' => 'Marcas',
                       'url'  => 'admin/brands',
                       'icon'    => 'fas fa-regular fa-copyright',
                       'can'         => 'ver-marcas',
                   ],
                   [
                       'text' => 'Modelos',
                       'url'  => 'admin/carmodels',
                       'icon'    => 'fas fa-solid fa-briefcase',
                       'can'         => 'ver-modelos',
                   ],
                   [
                       'text' => 'Tamaño de disco',
                       'url'  => 'admin/diskstorages',
                       'icon'    => 'fas fa-box-archive',
                       'can'         => 'ver-tamanio_de_discos',
                   ],
                   [
                        'text' => 'Dispositivos',
                        'url'  => 'admin/devices',
                        'icon'    => 'fas fa-fw fa-desktop',
                        'can'         => 'ver-dispositivos',

                   ],
                   [
                    'text' => 'Tipos de Dispositivos',
                    'url'  => 'admin/typedevices',
                    'icon'    => 'fas fa-fw fa-keyboard',
                    'can'         => 'ver-tipodispositivos',
                ],

               ]
                ],
 /*
        [
            'text'    => 'multilevel',
            'icon'    => 'fas fa-fw fa-share',
            'submenu' => [
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
                [
                    'text'    => 'level_one',
                    'url'     => '#',
                    'submenu' => [
                        [
                            'text' => 'level_two',
                            'url'  => '#',
                        ],
                        [
                            'text'    => 'level_two',
                            'url'     => '#',
                            'submenu' => [
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                                [
                                    'text' => 'level_three',
                                    'url'  => '#',
                                ],
                            ],
                        ],
                    ],
                ],
                [
                    'text' => 'level_one',
                    'url'  => '#',
                ],
            ],
        ],
        ['header' => 'labels'],
        [
            'text'       => 'important',
            'icon_color' => 'red',
            'url'        => '#',
        ],
        [
            'text'       => 'warning',
            'icon_color' => 'yellow',
            'url'        => '#',
        ],
        [
            'text'       => 'information',
            'icon_color' => 'cyan',
            'url'        => '#',
        ],   */
        [
             'text'    => 'CONFIGURACION',
             'icon'    => 'fas fa-fw fa-lock',
                'submenu' =>
                [
                    [
                        'text' => 'Usuarios',
                        'url'  => 'admin/users',
                        'icon'    => 'fas fa-users-cog',
                        'can'         => 'ver-usuarios',
                    ],
                    [
                        'text' => 'Roles',
                        'url'  => 'admin/roles',
                        'icon'    => 'fas fa-dice-d20',
                        'can'         => 'ver-roles',
                    ],
                    [
                        'text' => 'Permisos',
                        'url'  => 'admin/permissions',
                        'icon'    => 'fas fa-lock',
                        'can'         => 'ver-permisos',
                    ],

                ]
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://adminlte.io/themes/v3/plugins/datatables/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://adminlte.io/themes/v3/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://adminlte.io/themes/v3/plugins/datatables-responsive/js/dataTables.responsive.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://adminlte.io/themes/v3/plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://adminlte.io/themes/v3/plugins/datatables-buttons/js/dataTables.buttons.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/buttons.bootstrap4.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://adminlte.io/themes/v3/plugins/jszip/jszip.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/pdfmake.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/vfs_fonts.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/buttons.html5.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/buttons.print.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/buttons.colVis.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://adminlte.io/themes/v3/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/datatables/buttons.bootstrap4.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'https://unpkg.com/dropzone@5/dist/min/dropzone.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'vendor/datatables/moment.min.js',
                ],

                [
                    'type' => 'js',
                    'asset' => true,
                    'location' => 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
                ],


            ],
        ],
        'Select2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],

                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/select2/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],

        'Sweetalert2' => [
            'active' => true,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
        'fontawesome' =>
        [
            'active'=>true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css',
                ],
            ],

        ],
        'animate' =>
        [
            'active'=>true,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css',
                ],
                [
                    'type' => 'css',
                    'asset' => true,
                    'location' => 'vendor/users/animate/style.css',
                ],


            ],

        ]


    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
