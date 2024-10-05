<?php
/*----------------------------
404 page
----------------------------*/
 Kirki::add_section( 'edubin_404_page_section', array(
    'title'    =>  esc_html__( '404 Not Found Page', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

// 404 Image
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'image',
    'settings'    => 'error_404_img',
    'label'       => esc_html__( '404 Image', 'edubin' ),
    'section'     => 'edubin_404_page_section',
    'default'     => '',
] );

// divider before error_404_heading
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_error_404_heading',
    'section'     => 'edubin_404_page_section',
    'default'     => '<hr>',
] );

// 404 Title
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( '404 Title', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'error_404_heading',
    'section' =>  'edubin_404_page_section',
    'default'   => esc_html__( '404 ERROR!', 'edubin' ),
    'transport' =>  'postMessage',
) );

// divider before error_404_heading
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_error_404_text',
    'section'     => 'edubin_404_page_section',
    'default'     => '<hr>',
] );

// 404 Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( '404 Text', 'edubin' ),
    'type' =>  'textarea',
    'settings' =>  'error_404_text',
    'section' =>  'edubin_404_page_section',
    'default'   => esc_html__( 'Oops! The page you are looking for does not exist.', 'edubin' ),
    'transport' =>  'postMessage',
) );

// divider before error_404_heading
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_error_404_link_text',
    'section'     => 'edubin_404_page_section',
    'default'     => '<hr>',
] );

// Go Home Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Go Home Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'error_404_link_text',
    'section' =>  'edubin_404_page_section',
    'default'   => esc_html__( 'Go home', 'edubin' ),
    'transport' =>  'postMessage',
) );
