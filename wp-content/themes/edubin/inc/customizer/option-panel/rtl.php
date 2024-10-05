<?php

/*----------------------------
RTL
----------------------------*/
 Kirki::add_section( 'edubin_rtl_section', array(
    'title'    =>  esc_html__( 'RTL', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

// RTL
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'rtl_enable',
    'label'       => esc_html__( 'RTL?', 'edubin' ),
    'section'     => 'edubin_rtl_section',
    'default'     => '0',
] );

// divider before rtl_header_logo_align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_rtl_header_logo_align',
    'section'     => 'edubin_rtl_section',
    'default'     => '<hr>',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'rtl_enable',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// RTL
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'rtl_header_logo_align',
    'label'       => esc_html__( 'Logo Left Align?', 'edubin' ),
    'section'     => 'edubin_rtl_section',
    'default'     => '0',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'rtl_enable',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// divider before rtl_header_menu_align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_rtl_header_menu_align',
    'section'     => 'edubin_rtl_section',
    'default'     => '<hr>',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'rtl_enable',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// Menu Right Align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'rtl_header_menu_align',
    'label'       => esc_html__( 'Menu Right Align?', 'edubin' ),
    'section'     => 'edubin_rtl_section',
    'default'     => '0',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'rtl_enable',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// divider before rtl_header_cart_align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_rtl_header_cart_align',
    'section'     => 'edubin_rtl_section',
    'default'     => '<hr>',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'rtl_enable',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

// Menu Right Align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'rtl_header_cart_align',
    'label'       => esc_html__( 'Cart Left Align?', 'edubin' ),
    'section'     => 'edubin_rtl_section',
    'default'     => '0',
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'rtl_enable',
    //         'operator'  =>  '===',
    //         'value'     =>  true,
    //     ],
    // ],
] );

