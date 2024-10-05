<?php

/*----------------------------
Back to Top 
----------------------------*/

 // section for Back To Top
 Kirki::add_section( 'edubin_back_to_top_section', array(
    'title'    =>  esc_html__( 'Back To Top', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'back_to_top_show',
    'label'       => esc_html__( 'Back To Top?', 'edubin' ),
    'section'     => 'edubin_back_to_top_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_bakc_to_top_icon_color',
    'section'     => 'edubin_back_to_top_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Icon Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'bakc_to_top_icon_color',
    'section' =>  'edubin_back_to_top_section',
    'choices'     => [
        'alpha' => true,
    ],
    'default'   => '',
    'output'      => array(
        array(
            'element'  => 'body .pixelcurve-progress-parent::after',
            'property' => 'color',
        )
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'bakc_to_top_bg_color',
    'section' =>  'edubin_back_to_top_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => 'body .pixelcurve-progress-parent',
            'property' => 'background',
        )
    )
) );
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Progress Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'bakc_to_top_progress_color',
    'section' =>  'edubin_back_to_top_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.pixelcurve-progress-parent svg.pixelcurve-back-circle path',
            'property' => 'stroke',
        )
    )
) );