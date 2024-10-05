<?php

/*----------------------------
Footer Copyright
----------------------------*/

 // section for Edubin home template
 Kirki::add_section( 'edubin_footer_copyright_section', array(
    'title'    =>  esc_html__( 'Copyright', 'edubin' ),
    'panel' =>  'edubin_footer_panel'
) );

// edit footer copyright?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'copyright_show',
    'label'       => esc_html__( 'Show Copyright?', 'edubin' ),
    'section'     => 'edubin_footer_copyright_section',
    'default'     => '1',
] );

// copyright text
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'copyright_text',
    'label'       => esc_html__( 'Custom Copyright Text', 'edubin' ),
    'section'     => 'edubin_footer_copyright_section',
    'default'     => esc_html__('&copy; 2024 Pixelcurve. All rights reserved.', 'edubin'),
    'transport'   => 'postMessage',
    'js_vars'     => [
        [
            'element'   =>  '.site-info p',
            'function'  =>  'html',
        ],
    ],
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'copyright_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );
// Section divider before No Copyright mobile menu
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_copyright_mobile_menu',
    'section'     => 'edubin_footer_copyright_section',
    'default'     => '<hr>',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'copyright_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// edit footer copyright?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'show_copyright_menu',
    'label'       => esc_html__( 'Show Copyright Menu On Small Device?', 'edubin' ),
    'section'     => 'edubin_footer_copyright_section',
    'default'     => '0',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'copyright_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// divider Copyright
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_copyright_text_color',
    'section'     => 'edubin_footer_copyright_section',
    'default'     => '<hr>',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'copyright_show',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// Footer Copyright Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Copyright Text Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'copyright_text_color',
    'section' =>  'edubin_footer_copyright_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
            array(
                'element'  => '.edubin-footer-default-wrapper',
                'property' => 'color',
            )
    )
) );

// Footer Copyright Link
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Copyright Link Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'copyright_link_color',
    'section' =>  'edubin_footer_copyright_section',
    'default'   => '',
    'transport' =>  'auto',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
            array(
                'element'  => '.edubin-footer-default-wrapper a:hover',
                'property' => 'color',
            )
 
    )
) );

// Footer Copyright Background
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Copyright Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'copyright_bg_color',
    'section' =>  'edubin_footer_copyright_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
            array(
                'element'  => '.edubin-footer-default-wrapper',
                'property' => 'background-color',
                'suffix'   => ' !important',
            )
    )
) );
