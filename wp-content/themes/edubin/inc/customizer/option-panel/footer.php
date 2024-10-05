<?php

/*----------------------------
Footer Global
----------------------------*/

 // Section for footer global
 Kirki::add_section( 'edubin_footer_global_section', array(
    'title'    =>  esc_html__( 'Footer Global', 'edubin' ),
    'description'    =>  esc_html__( 'Footer global settings', 'edubin' ),
    'panel' =>  'edubin_footer_panel'
) );

// Show post type
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'edubin_get_elementor_footer',
    'label'       => esc_html__( 'Select Footer', 'edubin' ),
    'section'     => 'edubin_footer_global_section',
    'default'     => '',
    'placeholder' => esc_html__( 'Select a Footer...', 'edubin' ),
    'multiple'    => false,
    'choices'     => edubin_get_footer_layouts(),
    // 'choices'     => Kirki_Helper::get_posts(
    //     array(
    //         'posts_per_page' => -1,
    //         'post_type'      => 'eb_footer'
    //     ) ,
    // ),
    // 'active_callback'   =>  [
    //     [
    //         'setting'   =>  'edubin_footer_type',
    //         'operator'  =>  '===',
    //         'value'     =>  'edubin_elementor_footer',
    //     ],
    // ],
] );
// infinite scroll behavior
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'footer_variations',
    'label'       => esc_html__( 'Theme Footer Variations', 'edubin' ),
    'section'     => 'edubin_footer_global_section',
    'multiple'    => false,
    'default'     => '1',
    'choices'     => [
        '1'   => esc_html__( 'Style 01', 'edubin' ),
        '2' => esc_html__( 'Style 02', 'edubin' ),
    ],

] );
/*----------------------------
Footer Area
----------------------------*/

 // Section for footer widgets
 Kirki::add_section( 'edubin_footer_section', array(
    'title'    =>  esc_html__( 'Footer Area', 'edubin' ),
    'panel' =>  'edubin_footer_panel'
) );

// pagination visibility
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'kirki-radio-image',
    'settings'    => 'footer_widget_area_column',
    'label'       => esc_html__( 'Footer Widget Columns', 'edubin' ),
    'section'     => 'edubin_footer_section',
    'default'     => '3_3_3_3',
    'choices'     => [
        '12'      => EDUBIN_URI . 'admin/assets/images/footer-1.png',
        '6_6'     => EDUBIN_URI . 'admin/assets/images/footer-2.png',
        '4_4_4'   => EDUBIN_URI . 'admin/assets/images/footer-3.png',
        '3_3_3_3' => EDUBIN_URI . 'admin/assets/images/footer-4.png',
        '3_6_3'   => EDUBIN_URI . 'admin/assets/images/footer-5.png',
        '4_3_2_3' => EDUBIN_URI . 'admin/assets/images/footer-6.png',
        '4_2_2_4' => EDUBIN_URI . 'admin/assets/images/footer-7.png',
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'show_home_all_post_section',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
        [
            'setting'   =>  'section_three_enable_pagination',
            'operator'  =>  '===',
            'value'     =>  'enable',
        ],
    ],
] );


// divider Footer
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'header_divider_footer_text_color',
    'section'     => 'edubin_footer_section',
    'default'     => '<hr>',
] );

// Footer Text
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Text Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'footer_text_color',
    'section' =>  'edubin_footer_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.site-footer .widget a',
            'property' => 'color',
        ),            
        array(
            'element'  => '.site-footer .widget ul li a',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer .widget p',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer .widget .widget-title',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer .edubin-quickinfo',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer .widget ul li',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer .widget_rss .rss-date, .site-footer .widget_rss li cite',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer .widget_calendar th, .site-footer .widget_calendar td',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer .calendar_wrap table#wp-calendar caption',
            'property' => 'color',
        ),           
        array(
            'element'  => '.site-footer tr',
            'property' => 'border-color',
        ),           
        array(
            'element'  => '.site-footer .calendar_wrap table#wp-calendar caption',
            'property' => 'border-color',
        ),           
        array(
            'element'  => '.site-footer thead th',
            'property' => 'border-color',
        ),           
    )
) );

// Footer Link
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Link Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'footer_link_color',
    'section' =>  'edubin_footer_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.site-footer .widget.widget_nav_menu ul li a:hover',
            'property' => 'color',
        ),
        array(
            'element'  => '.site-footer .widget a:hover',
            'property' => 'color',
        ),
        array(
            'element'  => '.site-footer .widget ul.menu li:before',
            'property' => 'color',
        ),
    )
) );

// Footer Button/Submit
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Button/Submit Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'footer_btn_submit_color',
    'section' =>  'edubin_footer_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.colors-light .widget .tag-cloud-link',
            'property' => 'background-color',
        ),
        array(
            'element'  => '.site-footer button, .site-footer input[type="button"], .site-footer input[type="submit"]',
            'property' => 'background-color',
        ),
    )
) );

// Footer Background
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Background Color', 'edubin' ),
    'type' =>  'color',
    'settings' =>  'footer_bg_color',
    'section' =>  'edubin_footer_section',
    'default'   => '',
    'choices'     => [
        'alpha' => true,
    ],
    'output'      => array(
        array(
            'element'  => '.site-footer .footer-top',
            'property' => 'background',
        )
    )
) );
