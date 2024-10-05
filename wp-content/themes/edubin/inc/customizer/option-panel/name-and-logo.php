<?php

/*----------------------------
Name & Logo
----------------------------*/

 // section for Header customization
 Kirki::add_section( 'title_tagline', array(
    'title'    =>  esc_html__( 'Site Name & Logo', 'edubin' ),
    'description'    =>  esc_html__( 'Customize all the settings related to Header', 'edubin' ),
    'panel' =>  'header_naviation_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_header_white_logo',
    'section'     => 'title_tagline',
    'default'     => '<hr>',
    'priority'       => 9,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'image',
    'settings'    => 'header_white_logo',
    'label'       => esc_html__( 'Transparent Header Logo', 'edubin' ),
    'section'     => 'title_tagline',
    'default'     => '',
    'priority'       => 9,
] );

// divider before logo_size
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_logo_size',
    'section'     => 'title_tagline',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'logo_size',
    'label'       => esc_html__( 'Custom Logo Size', 'edubin' ),
    'section'     => 'title_tagline',
    'default'     => 180,
    'choices'     => [
        'min'  => 10,
        'max'  => 400,
        'step' => 1,
    ],
    'output'      => array(
        array(
            'element'  => '.site-branding img.site-logo',
            'property' => 'max-width',
            'units' => 'px',
        )
    )
] );

// Mobile Logo Size
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'mobile_logo_size',
    'label'       => esc_html__( 'Mobile Logo Size', 'edubin' ),
    'section'     => 'title_tagline',
    'default'     => 180,
    'choices'     => [
        'min'  => 50,
        'max'  => 300,
        'step' => 1,
    ]

] );

// Mobile Logo Screen Width
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'mobile_logo_screen_width',
    'label'       => esc_html__( 'Mobile Logo Screen Width', 'edubin' ),
    'section'     => 'title_tagline',
    'default'     => 786,
    'choices'     => [
        'min'  => 480,
        'max'  => 992,
        'step' => 1,
    ]
] );