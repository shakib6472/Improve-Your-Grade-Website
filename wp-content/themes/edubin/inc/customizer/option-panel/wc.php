<?php
/*----------------------------
Shop Settings
----------------------------*/
 Kirki::add_section( 'edubin_wc_shop_settings_section', array(
    'title'    =>  esc_html__( 'Shop Settings', 'edubin' ),
    'panel'          => 'woocommerce',
) );

// Product show count
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'show_shop_breadcrumb',
    'label'       => esc_html__( 'Breadcrumbs', 'edubin' ),
    'section'     => 'edubin_wc_shop_settings_section',
    'default'     => '1',
] );
// Product show count
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'default_breadcrumb_at_shop',
    'label'       => esc_html__( 'Default Breadcrumb Settings', 'edubin' ),
    'section'     => 'edubin_wc_shop_settings_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'show_shop_breadcrumb',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'image',
    'settings'    => 'shop_breadcrumb_image',
    'label'       => esc_html__( 'Breadcrumbs Background', 'edubin' ),
    'section'     => 'edubin_wc_shop_settings_section',
    'default'     => '',
    'active_callback'   =>  [
        [
            'setting'   =>  'show_shop_breadcrumb',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'default_breadcrumb_at_shop',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Products Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'shop_breadcrumb_color',
    'section' =>  'edubin_wc_shop_settings_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'transport' =>  'auto',
    'active_callback'   =>  [
        [
            'setting'   =>  'show_shop_breadcrumb',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'default_breadcrumb_at_shop',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
    // 'js_vars'   =>  [
    //     [
    //         'element'   =>  '.woocommerce ul.products.columns-4 li.product a img',
    //         'function'  =>  'css',
    //         'property'  =>  'background',
    //     ]
    // ]
) );
/*----------------------------
Product Archive Page
----------------------------*/
 Kirki::add_section( 'edubin_wc_products_section', array(
    'title'    =>  esc_html__( 'Products Archive', 'edubin' ),
    'panel'          => 'woocommerce',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'wp_archive_page_title',
    'label'       => esc_html__( 'Custom Shop Page Title', 'edubin' ),
    'section'     => 'edubin_wc_products_section',
    'default'     => esc_html__('Shop', 'edubin'),
    'transport'   => 'auto',
] );

// Product show count
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'woo_shop_per_page',
    'label'       => esc_html__( 'Number of Product', 'edubin' ),
    'section'     => 'edubin_wc_products_section',
    'default'     => 12,
    'choices'     => [
        'min'  => 0,
        'max'  => 100,
        'step' => 1,
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'shop_related_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'woo_shop_columns',
    'label'       => esc_html__( 'Product Columns', 'edubin' ),
    'section'     => 'edubin_wc_products_section',
    'default'     => '4',
    'choices'     => [
        '1' => esc_html__('1', 'edubin'),
        '2' => esc_html__('2', 'edubin'),
        '3' => esc_html__('3', 'edubin'),
        '4' => esc_html__('4', 'edubin'),
    ],
] );

// Secondary Color
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Products Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'edubin_wc_products_bg_color',
    'section' =>  'edubin_wc_products_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'transport' =>  'auto',
    'js_vars'   =>  [
        [
            'element'   =>  '.woocommerce ul.products.columns-4 li.product a img',
            'function'  =>  'css',
            'property'  =>  'background',
        ]
    ]
) );


/*----------------------------
Sidebar
----------------------------*/
 Kirki::add_section( 'edubin_wc_section', array(
    'title'    =>  esc_html__( 'Sidebar', 'edubin' ),
    'panel'          => 'woocommerce',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'edubin_wc_sidebar',
    'label'       => esc_html__( 'Sidebar', 'edubin' ),
    'description' => esc_html__( 'Select your sidebar position', 'edubin' ),
    'section'     => 'edubin_wc_section',
    'default'     => 'alignright',
    'choices'     => [
        'sidebarleft'   => esc_html__( 'Left', 'edubin' ),
        'sidebarnone'   => esc_html__( 'No Sidebar', 'edubin' ),
        'alignright'   => esc_html__( 'Right', 'edubin' ),
    ],
 ] );

// divider before page_header_height
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_shop_sidebar_width',
    'section'     => 'edubin_wc_section',
    'default'     => '<hr>',
] );

// Sidebar Width
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'woo_sidebar_width',
    'label'       => esc_html__( 'Sidebar Width', 'edubin' ),
    'section'     => 'edubin_wc_section',
    'default'     => 'sidebar_big',
    'choices'     => [
        'sidebar_small'  => esc_html__('25%', 'edubin'),
        'sidebar_big' => esc_html__('33%', 'edubin'),
    ],

] );


/*----------------------------
Reviews
----------------------------*/
 Kirki::add_section( 'edubin_wc_review_section', array(
    'title'    =>  esc_html__( 'Reviews', 'edubin' ),
    'panel'          => 'woocommerce',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'woo_review_tab_show',
    'label'       => esc_html__( 'Reviews?', 'edubin' ),
    'section'     => 'edubin_wc_review_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'woo_review_tab_login_user_show',
    'label'       => esc_html__( 'Publicly/Login User only', 'edubin' ),
    'section'     => 'edubin_wc_review_section',
    'default'     => '1',
] );


/*----------------------------
Related Product
----------------------------*/
 Kirki::add_section( 'edubin_related_products_section', array(
    'title'    =>  esc_html__( 'Related Product', 'edubin' ),
    'panel'          => 'woocommerce',
) );

 // Related Product
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'shop_related_show',
    'label'       => esc_html__( 'Related Product', 'edubin' ),
    'section'     => 'edubin_related_products_section',
    'default'     => '1',
] );

// Related Products
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'label'       => esc_html__('Related Products', 'edubin'),
    'settings'    => 'shop_related_title',
    'section'     => 'edubin_related_products_section',
    'default'     => esc_html('Related Products'),
    'active_callback'   =>  [
        [
            'setting'   =>  'shop_related_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// divider before related_post_columns
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_wc_related_total_posts',
    'section'     => 'edubin_related_products_section',
    'default'     => '<hr>',
] );

// posts show count
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'shop_related_total_posts',
    'label'       => esc_html__( 'Number of Related Product', 'edubin' ),
    'section'     => 'edubin_related_products_section',
    'default'     => 3,
    'choices'     => [
        'min'  => 0,
        'max'  => 10,
        'step' => 1,
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'shop_related_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// divider before related_post_columns
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_shop_related_post_columns',
    'section'     => 'edubin_related_products_section',
    'default'     => '<hr>',
] );

// Related Products Columns
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'shop_related_post_columns',
    'label'       => esc_html__( 'Related Products Columns', 'edubin' ),
    'section'     => 'edubin_related_products_section',
    'default'     => '4',
    'choices'     => [
        '12' => esc_html__('1', 'edubin'),
        '6' => esc_html__('2', 'edubin'),
        '4' => esc_html__('3', 'edubin'),
        '3' => esc_html__('4', 'edubin'),
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'shop_related_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// divider before related_posts_by
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_shop_related_posts_by',
    'section'     => 'edubin_related_products_section',
    'default'     => '<hr>',
] );

// Related Products By
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'related_products_by',
    'label'       => esc_html__( 'Related Products By', 'edubin' ),
    'section'     => 'edubin_related_products_section',
    'default'     => 'product_tag',
    'choices'     => [
        'product_cat' => esc_html__('Category', 'edubin'),
        'product_tag' => esc_html__('Tags', 'edubin'),
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'shop_related_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );


/*----------------------------
Shop Single
----------------------------*/
 Kirki::add_section( 'edubin_shop_single_section', array(
    'title'    =>  esc_html__( 'Shop Single', 'edubin' ),
    'panel'          => 'woocommerce',
) );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'remove_gallery_on_variable_product',
    'label'       => esc_html__( 'Remove Gallery on Variable Product', 'edubin' ),
    'section'     => 'edubin_shop_single_section',
    'default'     => '1',
] );
