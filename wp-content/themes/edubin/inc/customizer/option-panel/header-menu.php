<?php

/*----------------------------
Header Menu
----------------------------*/
 Kirki::add_section( 'edubin_header_menu_section', array(
    'title'    =>  esc_html__( 'Header Menu', 'edubin' ),
    'panel'          => 'header_naviation_panel',
) );

// // Sub Menu Right Align
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'sub_menu_right_align',
//     'label'       => esc_html__( 'Sub Menu Right Align', 'edubin' ),
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '1',
// ] );

// // Home Menu Active Color
// // Kirki::add_field( 'edubin_theme_config', [
// //     'type'        => 'toggle',
// //     'settings'    => 'home_menu_acive_color',
// //     'label'       => esc_html__( 'Home Menu Active Color', 'edubin' ),
// //     'section'     => 'edubin_header_menu_section',
// //     'default'     => '0',
// // ] );

// // divider before top_cart_enable
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'divider_before_edubin_menu_top_space',
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '<hr>',
// ] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'edubin_menu_left_rught_space',
    'label'       => esc_html__( 'Menu Left/Right Space', 'edubin' ),
    'section'     => 'edubin_header_menu_section',
    'default'     => '28',
    'choices'     => [
        'min'  => 0,
        'max'  => 60,
        'step' => 1,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li>a.nav-link, .edubin-header-area ul.edubin-navbar-nav>li>a',
            'property' => 'padding-left',
            'suffix' => 'px',
        ),
        array(
            'element'  => '.edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li>a.nav-link, .edubin-header-area ul.edubin-navbar-nav>li>a',
            'property' => 'padding-right',
            'suffix' => 'px',
        ),
    )
] );
// // Menu Top Space
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'edubin_menu_top_space',
//     'label'       => esc_html__( 'Menu Top Space', 'edubin' ),
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 100,
//         'step' => 1,
//     ],
// ] );

// // Menu Top Space
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'edubin_menu_button_space',
//     'label'       => esc_html__( 'Menu Button Space', 'edubin' ),
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 100,
//         'step' => 1,
//     ],
// ] );

// // Menu Left Space
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'edubin_menu_left_space',
//     'label'       => esc_html__( 'Menu Left Space', 'edubin' ),
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 30,
//         'step' => 1,
//     ],
// ] );

// // Menu Right Space
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'edubin_menu_right_space',
//     'label'       => esc_html__( 'Menu Right Space', 'edubin' ),
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 30,
//         'step' => 1,
//     ],
// ] );

// // divider before edubin_header_menu_section
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'divider_before_edubin_header_menu_section',
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '<hr>',
// ] );

// Submenu Wrap Width
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'sub_menu_width',
    'label'       => esc_html__( 'Submenu Wrap Width', 'edubin' ),
    'section'     => 'edubin_header_menu_section',
    'default'     => 270,
    'choices'     => [
        'min'  => 0,
        'max'  => 400,
        'step' => 1,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area .main-navigation ul ul.edubin-dropdown-menu',
            'property' => 'min-width',
            'suffix' => 'px',
        ),
    )
] );

// Sub Menu Space
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'slider',
//     'settings'    => 'edubin_submenu_space',
//     'label'       => esc_html__( 'Sub Menu Space', 'edubin' ),
//     'section'     => 'edubin_header_menu_section',
//     'default'     => '',
//     'choices'     => [
//         'min'  => 0,
//         'max'  => 20,
//         'step' => 1,
//     ],
// ] );



