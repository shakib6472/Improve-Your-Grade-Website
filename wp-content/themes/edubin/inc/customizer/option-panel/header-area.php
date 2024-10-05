<?php

/*----------------------------
Header Area
----------------------------*/
 Kirki::add_section( 'edubin_main_header_section', array(
    'title'    =>  esc_html__( 'Header Area', 'edubin' ),
    'panel'          => 'header_naviation_panel',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'edubin_get_elementor_header',
    'label'       => esc_html__( 'Select Header', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => 'theme-default-header',
    'placeholder' => esc_html__( 'Select a Header...', 'edubin' ),
    'multiple'    => false,
    'choices'     => edubin_fetch_header_layouts(),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_dark_header_enable',
    'section'     => 'edubin_main_header_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'dark_header_enable',
    'label'       => esc_html__( 'Dark Header?', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => false,
] );

// divider before top_cart_enable
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_sticky_header_enable',
    'section'     => 'edubin_main_header_section',
    'default'     => '<hr>',
] );

// Sticky Header
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sticky_header_enable',
    'label'       => esc_html__( 'Sticky Header?', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_top_search_enable',
    'section'     => 'edubin_main_header_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'header_category_show',
    'label'       => esc_html__( 'Header Category?', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => '1',
    // 'priority'       => 9,
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Category Title', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'heading_category_title',
    'section' =>  'edubin_main_header_section',
    'default'   => '',
    'transport' =>  'refresh',
    'active_callback'   =>  [
        [
            'setting'   =>  'header_category_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'heading_category_items',
    'label'       => esc_html__( 'Number of Courses Categories', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => 10,
    'choices'     => [
        'min'  => 1,
        'max'  => 20,
        'step' => 1,
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'header_category_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'header_button_show',
    'label'       => esc_html__( 'Header Button', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => false,
    // 'priority'       => 9,
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Header Button Text', 'edubin' ),
    'type' =>  'textarea',
    'settings' =>  'header_button_text',
    'section' =>  'edubin_main_header_section',
    'default'   => esc_html__('Try for free', 'edubin'),
    'transport' =>  'refresh',
    'active_callback'   =>  [
        [
            'setting'   =>  'header_button_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
) );
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Header Button URL', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'header_button_url',
    'section' =>  'edubin_main_header_section',
    // 'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'header_button_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
) );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'header_button_open_same_tab',
    'label'       => esc_html__( 'Open In Same Tab', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => '1',
    // 'priority'       => 9,
    'active_callback'   =>  [
        [
            'setting'   =>  'header_button_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'top_search_enable',
    'label'       => esc_html__( 'Search?', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'edubin_search_style',
    'label'       => esc_html__( 'Search Query', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => 'tpc_wp_search',
    'multiple'    => false,
    'choices'     => [
        'tpc_wp_search' => esc_html__( 'Search by Enter Site', 'edubin' ),
        'tpc_lp_search' => esc_html__( 'Search by LearnPress LMS', 'edubin' ),
        'tpc_tutor_search' => esc_html__( 'Search by Tutor LMS', 'edubin' ),
        'tpc_ld_search' => esc_html__( 'Search by LearnDash LMS', 'edubin' ),
        // 'tpc_ms_search' => esc_html__( 'Search by Masterstudy LMS', 'edubin' ),
        'tpc_sen_search' => esc_html__( 'Search by Sensei LMS', 'edubin' ),
        // 'tpc_lif_search' => esc_html__( 'Search by Lifter LMS', 'edubin' ),
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'top_search_enable',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// Search Popup Overlay
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Search Popup Overlay?', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'search_popup_bg_color',
    'section' =>  'edubin_main_header_section',
    'default'   => '',
    'active_callback'   =>  [
        [
            'setting'   =>  'top_search_enable',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-search-box',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.edubin-search-box',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.edubin-search-box .edubin-search-form input',
            'property' => 'border-color',
        ),
        array(
            'element'  => '.edubin-search-box .edubin-search-form input',
            'property' => 'color',
        ),
        array(
            'element'  => '.edubin-search-box .edubin-search-form input[type="text"]:focus',
            'property' => 'border-color',
        ),
        array(
            'element'  => '.edubin-search-box .edubin-search-form button',
            'property' => 'color',
        ),
    )
) );

// divider before cart_serach_top_space
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_top_cart_enable',
    'section'     => 'edubin_main_header_section',
    'default'     => '<hr>',
] );

// Shop Cart
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'top_cart_enable',
    'label'       => esc_html__( 'Shop Cart?', 'edubin' ),
    'section'     => 'edubin_main_header_section',
    'default'     => '1',
] );




