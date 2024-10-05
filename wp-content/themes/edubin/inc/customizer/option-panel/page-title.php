<?php

/*----------------------------
Page Title
----------------------------*/
 Kirki::add_section( 'header_image', array(
    'title'    =>  esc_html__( 'Page Title', 'edubin' ),
    'theme_supports' => 'custom-header',
    'priority'       => 200,
    'panel'          => 'header_naviation_panel',
) );

// Page Header
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'page_header_show',
    'label'       => esc_html__( 'Page Title', 'edubin' ),
    'section'     => 'header_image',
    'default'     => '1',
    'priority'       => 9,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'top_bottom_space_show',
    'label'       => esc_html__( 'Page Top/Bottom Space', 'edubin' ),
    'section'     => 'header_image',
    'default'     => '1',
    'priority'       => 9,
] );

// Header Title Tag
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'page_title_style',
    'label'       => esc_html__( 'Page Title Style', 'edubin' ),
    'section'     => 'header_image',
    'default'     => '1',
    'priority'       => 9,
    'multiple'    => false,
    'choices'     => [
        '1' => esc_html__( 'Style 01', 'edubin' ),
        '2' => esc_html__( 'Style 02', 'edubin' ),
        'default' => esc_html__( 'Style 03', 'edubin' ),
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );
// Header Title Tag
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'header_title_tag',
    'label'       => esc_html__( 'Header Title Tag', 'edubin' ),
    'section'     => 'header_image',
    'default'     => 'h1',
    'priority'       => 9,
    'placeholder' => esc_html__( 'Select an tag...', 'edubin' ),
    'multiple'    => false,
    'choices'     => [
        'h1' => esc_html__( 'H1', 'edubin' ),
        'h2' => esc_html__( 'H2', 'edubin' ),
        'h3' => esc_html__( 'H3', 'edubin' ),
        'h4' => esc_html__( 'H4', 'edubin' ),
        'h5' => esc_html__( 'H5', 'edubin' ),
        'h6' => esc_html__( 'H6', 'edubin' ),
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );
// divider before header_page_title_align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_header_page_title_aligne',
    'section'     => 'header_image',
    'default'     => '<hr>',
    'priority'       => 9,
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// Header Page Title Align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'header_page_title_align',
    'label'       => esc_html__( 'Header Page Title Align', 'edubin' ),
    'section'     => 'header_image',
    'default'     => 'center',
    'priority'       => 9,
    'choices'     => [
        'left'   => esc_html__( 'Left', 'edubin' ),
        'center'   => esc_html__( 'Center', 'edubin' ),
        'right'   => esc_html__( 'Right', 'edubin' ),
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// divider before header_title_font_size
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_header_title_font_size',
    'section'     => 'header_image',
    'priority'       => 9,
    'default'     => '<hr>',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ], 
] );

// // 'Header Title Font Size
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'number',
//     'settings'    => 'header_title_font_size',
//     'label'       => esc_html__( 'Header Title Font Size', 'edubin' ),
//     'section'     => 'header_image',
//     'default'     => '',
//     'priority'       => 9,
//     'choices'     => [
//         'min'  => 35,
//         'max'  => 70,
//         'step' => 1,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// // 'Header Title Font Size (Small Devices)
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'number',
//     'settings'    => 'header_title_font_size_small_device',
//     'label'       => esc_html__( 'Header Title Font Size (Small Devices)', 'edubin' ),
//     'section'     => 'header_image',
//     'default'     => '',
//     'priority'       => 9,
//     'choices'     => [
//         'min'  => 14,
//         'max'  => 70,
//         'step' => 1,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// //Page Title Font Size Small Screen Width
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'header_title_font_size_small_device_width',
//     'label'       => esc_html__( 'Page Title Font Size Small Screen Width', 'edubin' ),
//     'section'     => 'header_image',
//     'default'     => '480',
//     'priority'       => 9,
//     'choices'     => [
//         'min'  => 480,
//         'max'  => 992,
//         'step' => 1,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// // divider before page_top_bottom_space
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'divider_before_page_top_bottom_space',
//     'section'     => 'header_image',
//     'default'     => '<hr>',
//     'priority'       => 9,
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// // Page Top & Bottom Space
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'page_top_bottom_space',
//     'label'       => esc_html__( 'Page Top & Bottom Space', 'edubin' ),
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => 80,
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 150,
//         'step' => 1,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// //Page Top & Bottom Space (Small Devices)
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'page_top_bottom_space_small',
//     'label'       => esc_html__( 'Page Top & Bottom Space (Small Devices)', 'edubin' ),
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 150,
//         'step' => 1,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// //Page Top & Bottom Space (Small Devices Screen Size)
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'page_top_bottom_space_screen_width',
//     'label'       => esc_html__( 'Page Top & Bottom Space (Small Devices Screen Size)', 'edubin' ),
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 150,
//         'step' => 1,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// divider before page_header_height
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'divider_before_page_header_height',
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => '<hr>',
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// Page Header Height
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'page_header_height',
//     'label'       => esc_html__( 'Page Header Height', 'edubin' ),
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 150,
//         'step' => 1000,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// Page Header Height (Small Devices)
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'page_header_height_small_screen',
//     'label'       => esc_html__( 'Page Header Height (Small Devices)', 'edubin' ),
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 50,
//         'step' => 900,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// Header Hight Small Screen Width
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'page_header_height_small_screen_width',
//     'label'       => esc_html__( 'Header Hight Small Screen Width', 'edubin' ),
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => '480',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 992,
//         'step' => 1,
//     ],
//     // 'active_callback'   =>  [
//     //     [
//     //         'setting'   =>  'page_header_show',
//     //         'operator'  =>  '===',
//     //         'value'     =>  true,
//     //     ],
//     // ],
// ] );

// Header Banner Overlay
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Title Background Overlay Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'header_banner_overlay_color',
    'section' =>  'header_image',
    'priority'       => 9,
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
    'output'      => array(
        array(
            'element'  => '.page-header:before',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.edubin-page-title-area.edubin-breadcrumb-style-1.edubin-breadcrumb-has-bg:before',
            'property' => 'background-color',
        ),
    )
) );

// Header Title Color
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Title Text Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'header_title_color',
    'section' =>  'header_image',
    'priority'       => 9,
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
    'output'      => array(
        array(
            'element'  => '.page-header .page-title',
            'property' => 'color',
        )
    )
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'page_title_bg_type',
    'label'       => esc_html__( 'Page Title Type', 'edubin' ),
    'section'     => 'header_image',
    'default'     => 'image',
    'priority'       => 9,
    'choices'     => [
        'image'   => esc_html__( 'Image', 'edubin' ),
        'color'   => esc_html__( 'Color', 'edubin' ),
    ],
] );


// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'global_breadcrumb_bg_image_overlay',
//     'label'       => esc_html__( 'Breadcrumb Overlay Opacity (in %)', 'edubin' ),
//     'section'     => 'header_image',
//     'priority'       => 9,
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 100,
//         'step' => 1,
//     ],
// ] );

// divider before header_page_title_align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_breadcrumb_show',
    'section'     => 'header_image',
    'default'     => '<hr>',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );


// divider primary_color
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_breadcrumb_text_color',
    'section'     => 'header_image',
    'default'     => '<h3 style="padding:10px 20px; background:#ffffff; color:#000000; margin:0; border-radius: 3px;">' . esc_html__( 'Breadcrumb', 'edubin' ) . '</h3>',
    'active_callback'   =>  [
        // [
        //     'setting'   =>  'page_header_show',
        //     'operator'  =>  '===',
        //     'value'     =>  true,
        // ],
        [
            'setting'   =>  'breadcrumb_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// Breadcrumb?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'breadcrumb_show',
    'label'       => esc_html__( 'Breadcrumb?', 'edubin' ),
    'section'     => 'header_image',
    'default'     => '1',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'page_header_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// divider before shortcode_breadcrumb
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_shortcode_breadcrumb',
    'section'     => 'header_image',
    'default'     => '<hr>',
    'active_callback'   =>  [
        // [
        //     'setting'   =>  'page_header_show',
        //     'operator'  =>  '===',
        //     'value'     =>  true,
        // ],
        [
            'setting'   =>  'breadcrumb_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// Breadcrumbs Shortcode
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Breadcrumbs Shortcode', 'edubin' ),
    'description'    =>  esc_html__( 'Add third party plugin breadcrumbs shortcode here', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'shortcode_breadcrumb',
    'section' =>  'header_image',
    'default'   => '',
    'active_callback'   =>  [
        // [
        //     'setting'   =>  'page_header_show',
        //     'operator'  =>  '===',
        //     'value'     =>  true,
        // ],
        [
            'setting'   =>  'breadcrumb_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );


Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Breadcrumb Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'breadcrumb_text_color',
    'section' =>  'header_image',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'breadcrumb_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
    'output'      => array(
        array(
            'element'  => '.edubin-breadcrumb-style-1 .edubin-breadcrumb-wrapper ul li, .edubin-breadcrumb-style-1 .edubin-breadcrumb-wrapper ul li a',
            'property' => 'color',
        ), 
        array(
            'element'  => '.edubin-breadcrumb-wrapper ul li span',
            'property' => 'color',
        ), 
        array(
            'element'  => '.edubin-breadcrumb-style-1 .edubin-breadcrumb-wrapper ul li:after',
            'property' => 'color',
        ), 

    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Breadcrumb Hover Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'breadcrumb_text_hover_color',
    'section' =>  'header_image',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-breadcrumb-style-1 .edubin-breadcrumb-wrapper ul li a:hover, .edubin-breadcrumb-style-2 .edubin-breadcrumb-wrapper ul li a:hover, .edubin-page-title-area.edubin-default-breadcrumb .edubin-breadcrumb-wrapper ul li a:hover',
            'property' => 'color',
        ), 
    )
) );
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Breadcrumb Active Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'breadcrumb_text_active_color',
    'section' =>  'header_image',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-breadcrumb-wrapper ul li span.active',
            'property' => 'color',
        ), 
    )
) );
