<?php
/*----------------------------
Header Top
----------------------------*/
 Kirki::add_section( 'edubin_header_top_section', array(
    'title'    =>  esc_html__( 'Header Top', 'edubin' ),
    'panel'          => 'header_naviation_panel',
) );

// header top
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'header_top_show',
    'label'       => esc_html__( 'Header Top?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => 0,
] );
// Header Top Layouts
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'header_top_bar_style',
    'label'       => esc_html__( 'Header Top Style', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '2',
    'choices'     => [
        '1' => esc_html__( 'Style 01', 'edubin' ),
        '2' => esc_html__( 'Style 02', 'edubin' ),
        '3' => esc_html__( 'Style 03', 'edubin' ),
    ],
] );
//Email?
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Email?', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'top_email',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'refresh',
) );

// Email on Small devices
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'email_small_device',
    'label'       => esc_html__( 'Email on Small Devices?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '0',
] );

// divider before rtl_header_menu_align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_top_phone',
    'section'     => 'edubin_header_top_section',
    'default'     => '<hr>',
] );

//Number?
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Phone Number?', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'top_phone',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'refresh',
) );

//Phone Number URL
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Phone Number URL', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'top_phone_link',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
) );

// Phone Number on Small devices
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'phone_small_device',
    'label'       => esc_html__( 'Phone Number on Small Devices?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '0',
] );

// divider before rtl_header_menu_align
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_before_top_massage',
    'section'     => 'edubin_header_top_section',
    'default'     => '<hr>',
] );

// Top Message
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Top Message', 'edubin' ),
    'type' =>  'textarea',
    'settings' =>  'top_massage',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'refresh',
) );

// Top Message Animation?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'top_massage_animation_show',
    'label'       => esc_html__( 'Top Message Animation?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'top_massage_animation_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// Top Message Area Width
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'top_massage_area_width',
    'label'       => esc_html__( 'Top Message Area Width', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => 300,
    'choices'     => [
        'min'  => 80,
        'max'  => 450,
        'step' => 1,
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'top_massage_animation_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
] );

// Message on Small Devices
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'message_small_device',
    'label'       => esc_html__( 'Message on Small Devices', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '0',
] );

// Top Widget Position
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'top_widget_position',
    'label'       => esc_html__( 'Top Widget Position', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => 'before_social',
    'choices'     => [
        'before_social'   => esc_html__( 'Before Social', 'edubin' ),
        'after_social' => esc_html__( 'After Social', 'edubin' ),
    ],
] );

// Login/Register
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'login_reg_show',
    'label'       => esc_html__( 'Show Login | Register?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'login_popup_active',
    'label'       => esc_html__( 'Popup Login | Register?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '0',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'login_reg_small_device',
    'label'       => esc_html__( 'Login | Register on Small Devices?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '0',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
] );

// Custom Login Page URL
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Login Page URL', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'custom_login_link',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'login_popup_active',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
) );

// Login Button Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Login Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'top_login_button_text',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'login_popup_active',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
) );

// Login Button Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Register Page URL', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'custom_register_link',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
       [
            'setting'   =>  'login_popup_active',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
) );

// Register Button Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Register Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'top_register_button_text',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'login_popup_active',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
) );

// Custom Logout Page URL
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Logout Page URL', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'custom_logout_link',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
       [
            'setting'   =>  'login_popup_active',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
) );

// Logout Button Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Logout Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'top_logout_button_text',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'login_popup_active',
            'operator'  =>  '===',
            'value'     =>  false,
        ],
    ],
) );

// Login/Register
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'profile_show',
    'label'       => esc_html__( 'Profile', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'profile_small_device',
    'label'       => esc_html__( 'Profile on Small Devices?', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => false,
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'profile_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

// Custom Logout Page URL
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Profile Page URL', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'custom_profile_page_link',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'profile_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );

// Profile Button Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom - Profile Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'top_profile_button_text',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'login_reg_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'profile_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );


// divider primary_color
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_header_top_text_color1',
    'section'     => 'edubin_header_top_section',
    'default'     => '<hr>',
] );

// divider primary_color
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_header_top_text_color',
    'section'     => 'edubin_header_top_section',
    'default'     => '<h3 style="padding:10px 20px; background:#ffffff; color:#000000; margin:0; border-radius: 3px;">' . esc_html__( 'Header Top Colors', 'edubin' ) . '</h3>',
] );

// Header Top Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Text Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'header_top_text_color',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.tpc-header-top-bar',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar a',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar i',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar.tpc-top-bar-style-2 a',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar .header-top-social-share a i',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar.tpc-top-bar-style-2 i',
            'property' => 'color',
        ),
    )
) );

// Header Top Link
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Link Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'header_top_link_color',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.tpc-header-top-bar.tpc-top-bar-style-2 a:hover',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar.tpc-top-bar-style-2 a:hover',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar .header-top-social-share a:hover i',
            'property' => 'color',
        ),
        array(
            'element'  => '.tpc-header-top-bar a:hover',
            'property' => 'color',
        ),
    )
) );

// Header Top Background
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'header_top_bg_color',
    'section' =>  'edubin_header_top_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.tpc-header-top-bar',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.tpc-header-top-bar.tpc-top-bar-style-2',
            'property' => 'background-color',
        )
    )
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'header_top_button_show',
    'label'       => esc_html__( 'Header Top Button', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => false,
    // 'priority'       => 9,
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Header Button Text', 'edubin' ),
    'type' =>  'textarea',
    'settings' =>  'header_top_button_text',
    'section' =>  'edubin_header_top_section',
    'default'   => esc_html__('Try for free', 'edubin'),
    'transport' =>  'refresh',
    'active_callback'   =>  [
        [
            'setting'   =>  'header_top_button_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
) );
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Header Button URL', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'header_top_button_url',
    'section' =>  'edubin_header_top_section',
    // 'default'   => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'header_top_button_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
) );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'header_button_top_open_same_tab',
    'label'       => esc_html__( 'Open In Same Tab', 'edubin' ),
    'section'     => 'edubin_header_top_section',
    'default'     => '1',
    // 'priority'       => 9,
    'active_callback'   =>  [
        [
            'setting'   =>  'header_top_button_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ]
    ],
] );
