<?php

/*----------------------------
Colors
----------------------------*/
 Kirki::add_section( 'colors', array(
    'title'    =>  esc_html__( 'Colors', 'edubin' ),
    'description'    =>  esc_html__( 'Customize theme colors here', 'edubin' ),
    'panel' =>  'edubin_general_panel',
    // 'priority' => 40,
) );

 // Kirki::add_section( 'colors', array(
 //           'title'    => esc_html__('Colors', 'edubin'),
 //            'priority' => 40,
 //            'panel'    => 'edubin_general_panel',
 // ) );

// divider primary_color
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_primary_color',
    'section'     => 'colors',
    'priority' => 8,
    'default'     => '<h3 style="padding:10px 20px; background:#ffffff; color:#000000; margin:0; border-radius: 3px;">' . esc_html__( 'Theme Colors', 'edubin' ) . '</h3>',
] );

// Primary Color
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Primary Color', 'edubin' ),
    'description'    =>  esc_html__( 'default: #ffc600', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'primary_color',
    'section' =>  'colors',
    'priority' => 8,
    'default'   => '#ffc600',
    'transport' =>  'refresh',
    'choices'     => [
        'alpha' => true,
    ],
    // 'js_vars'   =>  [
    //     [
    //         'element'   =>  ':root',
    //         'function'  =>  'css',
    //         'property'  =>  '--edubin-primary-color',
    //     ]
    // ]
) );

// Secondary Color
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Secondary Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'secondary_color',
    'section' =>  'colors',
    'priority' => 8,
    'default'   => '#021e40',
    'transport' =>  'refresh',
    'choices'     => [
        'alpha' => true,
    ],
    // 'js_vars'   =>  [
    //     [
    //         'element'   =>  ':root',
    //         'function'  =>  'css',
    //         'property'  =>  '--edubin-color-secondary',
    //     ]
    // ]
) );

// Primary Color
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Primary Color(Alter)', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'tpc_primary_color_alter',
    'section' =>  'colors',
    'priority' => 8,
    'default'   => '#ff4830',
    'transport' =>  'refresh',
    'choices'     => [
        'alpha' => true,
    ],
    // 'js_vars'   =>  [
    //     [
    //         'element'   =>  ':root',
    //         'function'  =>  'css',
    //         'property'  =>  '--edubin-primary-color',
    //     ]
    // ]
) );
// divider Buttons
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'header_divider_button_color',
//     'section'     => 'colors',
//     'priority' => 8,
//     'default'     => '<h3 style="padding:10px 20px; background:#ffffff; color:#000000; margin:0; border-radius: 3px;">' . esc_html__( 'Buttons', 'edubin' ) . '</h3>',
// ] );


// divider link_color
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'header_divider_link_color',
//     'section'     => 'colors',
//     'priority' => 8,
//     'default'     => '<h3 style="padding:10px 20px; background:#ffffff; color:#000000; margin:0; border-radius: 3px;">' . esc_html__( 'Links/Anchor', 'edubin' ) . '</h3>',
// ] );

// Link Color
// Kirki::add_field( 'edubin_theme_config', array(
//     'label' =>  esc_html__( 'Link Color', 'edubin' ),
//     'type' =>  'color',
//     'settings' =>  'link_color',
//     'section' =>  'colors',
//     'priority' => 8,
//     'default'   => '',
//     'choices'     => [
//         'alpha' => true,
//     ],
//     // 'output'      => array(
//     //         array(
//     //             'element'  => '.site-footer .footer-bottom',
//     //             'property' => 'background-color',
//     //         )
//     // )
// ) );

// Link Hover Color
// Kirki::add_field( 'edubin_theme_config', array(
//     'label' =>  esc_html__( 'Link Hover Color', 'edubin' ),
//     'type' =>  'color',
//     'settings' =>  'link_hover_color',
//     'section' =>  'colors',
//     'priority' => 8,
//     'default'   => '',
//     'choices'     => [
//         'alpha' => true,
//     ],
//     // 'output'      => array(
//     //         array(
//     //             'element'  => '.site-footer .footer-bottom',
//     //             'property' => 'background-color',
//     //         )
//     // )
// ) );

// divider primary_color
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_placeholder_color',
    'section'     => 'colors',
    'priority' => 8,
    'default'     => '<h3 style="padding:10px 20px; background:#ffffff; color:#000000; margin:0; border-radius: 3px;">' . esc_html__( 'Placeholder', 'edubin' ) . '</h3>',
] );


// Placeholder
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Placeholder', 'edubin' ),
    'type' =>  'color',
    'priority' => 8,
    'settings' =>  'placeholder_color',
    'section' =>  'colors',
    'choices'     => [
        'alpha' => true,
    ],
    'default'   => '',
        'output'      => array(
            array(
                'element'  => '::-webkit-input-placeholder',
                'property' => 'color',
            ),
            array(
                'element'  => ':-moz-placeholder',
                'property' => 'color',
            ),
            array(
                'element'  => '::-moz-placeholder',
                'property' => 'color',
            ),
            array(
                'element'  => ':-ms-input-placeholder',
                'property' => 'color',
            ),
    )
) );


// divider Other
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_others_colors',
    'section'     => 'colors',
    'priority' => 8,
    'default'     => '<h3 style="padding:10px 20px; background:#ffffff; color:#000000; margin:0; border-radius: 3px;">' . esc_html__( 'Default WordPress Colors', 'edubin' ) . '</h3>',
] );

