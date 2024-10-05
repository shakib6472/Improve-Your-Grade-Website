<?php

/*----------------------------
Sidebar
----------------------------*/
 Kirki::add_section( 'edubin_sidebar_section', array(
    'title'    =>  esc_html__( 'Sidebar', 'edubin' ),
    'panel'          => 'edubin_sidebar_panel',
) );

// Sidebars repeater
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'repeater',
    'label'       => esc_html__( 'Register Sidebars', 'edubin' ),
    'section'     => 'edubin_sidebar_section',
    'settings'     => 'sidebars',
    'row_label' => [
        'type'  => 'text',
        'value' => esc_html__( 'Sidebar', 'edubin' ),
    ],
    'button_label' => esc_html__('Add Sidebar', 'edubin' ),
    'fields' => [
        'edubin_sidebar_name'  => [
            'type'        => 'text',
            'label'       => esc_html__( 'Sidebar', 'edubin' ),
            'default'     => ['Main Sidebar'],
        ],

    ],

] );




