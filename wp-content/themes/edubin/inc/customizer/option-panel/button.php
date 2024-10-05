<?php

/*----------------------------
Button 
----------------------------*/
Kirki::add_section( 'edubin_button_section', array(
    'title'    =>  esc_html__( 'Buttons', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'edubin_button_style',
    'label'       => esc_html__( 'Button Style', 'edubin' ),
    'section'     => 'edubin_button_section',
    'default'     => '1',
    'multiple'    => false,
    'choices'     => [
        '1' => esc_html__('Style 01', 'edubin'),
        '2' => esc_html__('Style 02', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Button Text', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'btn_text_color',
    'section' =>  'edubin_button_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => 'button, input[type="button"], input[type="submit"]',
            'property' => 'color',
        ),
        array(
            'element'  => 'button, input[type="button"], input[type="submit"]',
            'property' => 'color',
        ),
        array(
            'element'  => '.edubin-main-btn a',
            'property' => 'color',
        ),
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Button Text Hover Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'btn_text_hover_color',
    'section' =>  'edubin_button_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => 'button:hover, button:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus',
            'property' => 'color',
        ),
        array(
            'element'  => '.edubin-main-btn:hover',
            'property' => 'border-color',
        ),
        array(
            'element'  => '.edubin-main-btn:hover a',
            'property' => 'color',
        ),
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Button Background', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'btn_color',
    'section' =>  'edubin_button_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => 'button, input[type="button"], input[type="submit"]',
            'property' => 'border-color',
        ),
        array(
            'element'  => 'button, input[type="button"], input[type="submit"]',
            'property' => 'background',
        ),
        array(
            'element'  => '.edubin-main-btn',
            'property' => 'background',
        ),
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Button Background Hover', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'btn_hover_color',
    'section' =>  'edubin_button_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => 'button:hover, button:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.edubin-main-btn:hover',
            'property' => 'background-color',
        ),
    )
) );