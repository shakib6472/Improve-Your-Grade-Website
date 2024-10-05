<?php

/*----------------------------
Preloader 
----------------------------*/

 // section for Preloader Settings
 Kirki::add_section( 'edubin_preloader_section', array(
    'title'    =>  esc_html__( 'Preloader', 'edubin' ),
    'description'    =>  esc_html__( 'Preloader Settings', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

// Preloader?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'preloader_show',
    'label'       => esc_html__( 'Preloader?', 'edubin' ),
    'section'     => 'edubin_preloader_section',
    'default'     => '1',
] );

// divider before Preloader Type
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_preloader_styles',
    'section'     => 'edubin_preloader_section',
    'default'     => '<hr>',
    'active_callback'   =>  [
        [
            'setting'   =>  'preloader_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// Show post type
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'preloader_styles',
    'label'       => esc_html__( 'Preloader Type', 'edubin' ),
    'section'     => 'edubin_preloader_section',
    'default'     => 'preloader_1',
    'placeholder' => esc_html__( 'Select preloader type', 'edubin' ),
    'multiple'    => false,
    'choices'     => [
        'preloader_1' => esc_html__( 'Style 01', 'edubin' ),
        'preloader_2' => esc_html__( 'Style 02', 'edubin' ),
        'image_preloader' => esc_html__( 'Image/.gif Animation Preloader', 'edubin' ),
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'preloader_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// preloader_image_url
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'image',
    'settings'    => 'preloader_image_url',
    'label'       => esc_html__( 'Preloader Image', 'edubin' ),
    'description'    =>  esc_html__( 'Upload your custom .gif image preloader', 'edubin' ),
    'section'     => 'edubin_preloader_section',
    'default'     => '',
    'active_callback'   =>  [
        [
            'setting'   =>  'preloader_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'preloader_styles',
            'operator'  =>  '===',
            'value'     =>  'image_preloader',
        ],
        
    ],
] );


// divider Preloader
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_preloader_color_primary',
    'section'     => 'edubin_preloader_section',
    'default'     => '<hr>',
    'active_callback'   =>  [
        [
            'setting'   =>  'preloader_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// Placeholder primary 
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Primary Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'preloader_color_primary',
    'section' =>  'edubin_preloader_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'preloader_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
    'output'      => array(
        array(
            'element'  => '.preloader .color-1',
            'property' => 'background-color',
            'units'           => '!important',
        ),
        array(
            'element'  => '#preloader_two .preloader_two span',
            'property' => 'background-color',
        ),
    )
) );

// Placeholder Secondary 
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Secondary Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'preloader_color_secondary',
    'section' =>  'edubin_preloader_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'preloader_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
    'output'      => array(
        array(
            'element'  => '.preloader .rubix-cube .layer',
            'property' => 'background-color',
        )
    )
) );


// Placeholder Background 
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'preloader_bg_color',
    'section' =>  'edubin_preloader_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'preloader_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
    'output'      => array(
        array(
            'element'  => '.preloader',
            'property' => 'background-color',
        ),
        array(
            'element'  => '#preloader_two',
            'property' => 'background-color',
        ),
    )
) );

