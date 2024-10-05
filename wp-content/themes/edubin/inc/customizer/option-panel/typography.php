<?php

/*----------------------------
Typography 
----------------------------*/
Kirki::add_section( 'edubin_typography', array(
    'title'    =>  esc_html__( 'Typography', 'edubin' ),
    'description'    =>  esc_html__( 'Site wide typography settings', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

// Body Typography
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Body Typography', 'edubin' ),
    'type'  =>  'typography',
    'settings'  => 'edubin_body_text_font',
    'section'   =>  'edubin_typography',
    'default'   =>  [
        'font-family'   =>  'Heebo',
        'variant'       =>  'regular',
        'font-size'     =>  '16px',
        'line-height'   =>  '26px',
        'letter-spacing'    =>  '0',
        // 'color'         =>  '#696868',
        'text-transform'    =>  'none',
    ],
    'transport'     =>  'auto',
    'output'        =>  [
        [
            'element'   =>  'body'
        ],
    ],
) );

// Content color
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'content_color',
    'section' =>  'edubin_typography',
    'default'   => '#696868',
    'choices'     => [
        'alpha' => true,
    ],
    'transport' =>  'auto',
    'js_vars'   =>  [
        [
            'element'   =>  ':root',
            'function'  =>  'css',
            'property'  =>  '--edubin-content-color',
        ]
    ]
) );
/*----------------------------
Typography Heading
----------------------------*/

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'section__divider_one_typo',
    'section'     => 'edubin_typography',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Heading Typography', 'edubin' ),
    'type'  =>  'typography',
    'settings'  => 'edubin_heading_font',
    'section'   =>  'edubin_typography',
    'default'   =>  [
        'font-family'   =>  'Heebo',
        'variant'       =>  '700',
        // 'line-height'   =>  'inherit',
        'letter-spacing'    =>  'inherit',
        'text-transform'    =>  'none',
        'subsets'       => array( 'latin' ),
        // 'color'         =>  '#07294d',
    ],
    'choices'       => [
        'variant' => array(
            'regular',
            '300',
            '500',
            '600',
            '700',
        ),
    ],
    'transport'     =>  'auto',
    'output'        =>  [
        [
            'element'   =>  'h1, h2, h3, h4, h5, h6, .widget .widget-title, .learnpress .lp-single-course .widget-title, .tribe-common--breakpoint-medium.tribe-common .tribe-common-h6--min-medium'
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'tertiary_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => 'h1, h2, h3, h4, h5, h6',
            'property' => 'color',
        )
    )
) );
/*----------------------------
Typography Menu
----------------------------*/
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'section_divider_menu_typo',
    'section'     => 'edubin_typography',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Menu Typography', 'edubin' ),
    'type'  =>  'typography',
    'settings'  => 'edubin_menu_font',
    'section'   =>  'edubin_typography',
    'default'   =>  [
        'font-family'   =>  'Heebo',
        'variant'       =>  '600',
        // 'line-height'   =>  'inherit',
        'letter-spacing'    =>  'inherit',
        'text-transform'    =>  'none',
        'subsets'       => array( 'latin' ),
        // 'color'         =>  '#07294d',
    ],
    'choices'       => [
        'variant' => array(
            'regular',
            '300',
            '500',
            '600',
            '700',
        ),
    ],
    'transport'     =>  'auto',
    'output'        =>  [
        [
            'element'   =>  '.edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li>a.nav-link, .edubin-header-area ul.edubin-navbar-nav>li>a'
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Menu Text Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'menu_text_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li>a.nav-link, .edubin-header-area ul.edubin-navbar-nav>li>a',
            'property' => 'color',
        ),
        array(
            'element'  => '.edubin-header-area ul.edubin-navbar-nav>li.menu-item-has-children>a:before',
            'property' => 'color',
        ),
 
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Menu Hover Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'menu_hover_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li:hover>a.nav-link, .edubin-header-area ul.edubin-navbar-nav>li:hover>a',
            'property' => 'color',
        ),
        array(
            'element'  => '.edubin-header-area ul.edubin-navbar-nav>li.menu-item-has-children:hover>a:before, .edubin-header-area ul li:not(.mega-menu) ul.edubin-dropdown-menu li.menu-item-has-children:hover:after, .edubin-header-area ul.edubin-navbar-nav>li:hover>a:before, .edubin-header-area ul.edubin-navbar-nav>li.active>a, .edubin-header-area ul.edubin-navbar-nav .menu-item-has-children li:hover>a, .edubin-header-area ul.edubin-navbar-nav>li:hover>a',
            'property' => 'color',
        ),
       
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Menu Active', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'menu_active_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li.current-menu-parent >a',
            'property' => 'color',
        ),

        array(
            'element'  => '.edubin-header-area.edubin-navbar-expand-lg ul.edubin-navbar-nav>li.current_page_item >a',
            'property' => 'color',
        ),

    )
) );

/*----------------------------
Typography Sub Menu
----------------------------*/

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'section_divider_submenu_typo',
    'section'     => 'edubin_typography',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Sub Menu Typography', 'edubin' ),
    'type'  =>  'typography',
    'settings'  => 'edubin_submenu_font',
    'section'   =>  'edubin_typography',
    'default'   =>  [
        'font-family'   =>  'Heebo',
        'variant'       =>  '600',
        // 'line-height'   =>  'inherit',
        'letter-spacing'    =>  'inherit',
        'text-transform'    =>  'none',
        'subsets'       => array( 'latin' ),
        // 'color'         =>  '#07294d',
    ],
    'choices'       => [
        'variant' => array(
            'regular',
            '300',
            '500',
            '600',
            '700',
        ),
    ],
    'transport'     =>  'auto',
    'output'        =>  [
        [
            'element'   =>  '.edubin-header-area ul.edubin-navbar-nav .dropdown ul.edubin-dropdown-menu li a'
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Sub Menu Text Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'sub_menu_text_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area ul.edubin-navbar-nav .dropdown ul.edubin-dropdown-menu li a',
            'property' => 'color',
        ),
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Sub Menu Text Hover Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'sub_menu_text_hover_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area ul.edubin-navbar-nav .dropdown ul.edubin-dropdown-menu li:hover> a',
            'property' => 'color',
        ),
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Sub Menu Arrow Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'sub_menu_arrow_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area.edubin-navbar-expand-lg ul li:not(.mega-menu) ul.edubin-dropdown-menu li.menu-item-has-children:after',
            'property' => 'color',
        )
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Sub Menu Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'sub_menu_bg_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area .main-navigation ul ul.edubin-dropdown-menu',
            'property' => 'background',
        ),
    )
) );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Sub Menu Border Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'sub_menu_border_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-header-area .main-navigation ul ul.edubin-dropdown-menu',
            'property' => 'border-top-color',
        ),
    ) 
) );

// Kirki::add_field( 'edubin_theme_config', array(
//     'label' =>  esc_html__( 'Menu Background', 'edubin' ),
//     'type' =>  'color',
//     'settings' =>  'header_menu_bg_color',
//     'section' =>  'edubin_typography',
//     'default'   => '',
//     'choices'     => [
//         'alpha' => true,
//     ],
//     'output'      => array(
//         array(
//             'element'  => '.is-header-sticky',
//             'property' => 'background',
//         )
//     )
// ) );

// Kirki::add_field( 'edubin_theme_config', array(
//     'label' =>  esc_html__( 'Sticky Menu Background', 'edubin' ),
//     'type' =>  'color',
//     'settings' =>  'header_menu_sticky_bg_color',
//     'section' =>  'edubin_typography',
//     'default'   => '',
//     'choices'     => [
//         'alpha' => true,
//     ],
//     'output'      => array(
//         array(
//             'element'  => '.is-header-sticky.sticky-active',
//             'property' => 'background',
//         )
//     )
// ) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'section_divider_mobile_menu',
    'section'     => 'edubin_typography',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Mobile Menu Icon Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'mobile_menu_icon_color',
    'section' =>  'edubin_typography',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.edubin-mobile-hamburger-menu i',
            'property' => 'color',
        ),
    )
) );