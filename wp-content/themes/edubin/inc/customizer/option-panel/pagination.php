<?php

/*----------------------------
Pagination 
----------------------------*/
Kirki::add_section( 'edubin_pagination', array(
    'title'    =>  esc_html__( 'Pagination', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'pagination_style',
    'label'       => esc_html__( 'Pagination Style', 'edubin' ),
    'section'     => 'edubin_pagination',
    'default'     => '1',
    'multiple'    => false,
    'choices'     => [
        '1' => esc_html__('Style 01', 'edubin'),
        '2' => esc_html__('Style 02', 'edubin'),
    ],
] );