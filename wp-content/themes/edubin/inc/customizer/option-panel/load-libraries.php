<?php

/*----------------------------
Load Libraries
----------------------------*/
 Kirki::add_section( 'edubin_load_libraries_section', array(
    'title'    =>  esc_html__( 'Libraries', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

// Section Custom Title
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'section_before_load_bootstrap_css',
    'section'     => 'edubin_load_libraries_section',
    'default'     => '<h3 style="padding:13px 20px; background:#ffffff; color:#000000; margin:0; border-radius:20px;">' . esc_html__( 'CSS Libraries', 'edubin' ) . '</h3>',
] );

// Load Bootstrap CSS?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_bootstrap_css',
    'label'       => esc_html__( 'Load Bootstrap CSS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Load Bootstrap RTL CSS
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_bootstrap_rtl_css',
    'label'       => esc_html__( 'Load Bootstrap RTL CSS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Load Fontawesome CSS
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_fontawesome_css',
    'label'       => esc_html__( 'Load Fontawesome CSS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Load Owl Carousel CSS?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_owl_carousel_css',
    'label'       => esc_html__( 'Load Owl Carousel CSS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Load AOS CSS?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_aos_css',
    'label'       => esc_html__( 'Load AOS CSS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Load Animate CSS
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_animate_css',
    'label'       => esc_html__( 'Load Animate CSS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Section Custom Title
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'section_before_load_bootstrap_js',
    'section'     => 'edubin_load_libraries_section',
    'default'     => '<h3 style="padding:13px 20px; background:#ffffff; color:#000000; margin:0; border-radius:20px;">' . esc_html__( 'JS Libraries', 'edubin' ) . '</h3>',
] );

// Load Bootstrap JS?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_bootstrap_js',
    'label'       => esc_html__( 'Load Bootstrap JS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Load Owl Carousel JS
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_owl_carousel_js',
    'label'       => esc_html__( 'Load Owl Carousel JS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

// Load AOS JS?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'load_aos_js',
    'label'       => esc_html__( 'Load AOS JS?', 'edubin' ),
    'section'     => 'edubin_load_libraries_section',
    'default'     => '1',
] );

