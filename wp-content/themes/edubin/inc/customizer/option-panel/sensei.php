<?php
/*----------------------------
Sensei Archive Page
----------------------------*/
 Kirki::add_section( 'edubin_sensei_archive_page_section', array(
    'title'    =>  esc_html__( 'Course Archive Page', 'edubin' ),
    'panel' =>  'edubin_sensei_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'sensei_archive_page_title',
    'label'       => esc_html__( 'Custom Archive Page Title', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => esc_html__('Courses', 'edubin'),
    'transport'   => 'refresh',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_course_archive_style',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'sensei_course_archive_style',
    'label'       => esc_html__( 'Course Style', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
    'multiple'    => false,
    'choices'     => [
        '1' => esc_html__('Style 01', 'edubin'),
        '2' => esc_html__('Style 02', 'edubin'),
        '3' => esc_html__('Style 03', 'edubin'),
        '4' => esc_html__('Style 04', 'edubin'),
        '5' => esc_html__('Style 05', 'edubin'),
        '6' => esc_html__('Style 06', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_intro_video_position',
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'sensei_intro_video_position',
    'label'       => esc_html__( 'Intro Image/Video Preview', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => 'intro_video_content',
    'multiple'    => false,
    'choices'     => [
        'none' => esc_html__('Off', 'edubin'),
        'intro_video_content' => esc_html__('Content Area', 'edubin'),
        'intro_video_sidebar' => esc_html__('Sidebar Area', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_intor_video_image',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'sensei_course_per_page',
    'label'       => esc_html__( 'Course Count', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => 6,
    'choices'     => [
        'min'  => 1,
        'step' => 1,
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_archive_course_limit',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'sensei_course_archive_clm',
    'label'       => esc_html__( 'Courses Columns', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '4',
    'choices'     => [
        '6' => esc_html__('2', 'edubin'),
        '4' => esc_html__('3', 'edubin'),
        '3' => esc_html__('4', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_course_masonry_layout',
    'label'       => esc_html__( 'Masonry Layout?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_course_archive_clm',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );


Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_archive_media_show',
    'label'       => esc_html__( 'Media?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_custom_placeholder_image',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'image',
    'settings'    => 'sensei_custom_placeholder_image',
    'label'       => esc_html__( 'Custom Placeholder Image', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_archive_image_height',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'slider',
    'settings'    => 'sensei_archive_image_height',
    'label'       => esc_html__( 'Fixed Image Height', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '',
    'choices'     => [
        'min'  => 100,
        'max'  => 450,
        'step' => 1,
    ],
    'output'      => array(
            array(
                'element'  => '.edubin-course .course__media img',
                'property' => 'height',
                'units' => 'px',
            )
    )
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_archive_image_size',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'sensei_archive_image_size',
    'label'       => esc_html__( 'Select Image Size', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => 'edubin-post-thumb',
    'multiple'    => false,
    'placeholder' => esc_html__( 'Select a image size', 'edubin' ),
    'choices'     => edubin_get_thumbnail_sizes(),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_header_top',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_intor_video_image',
    'label'       => esc_html__( 'Intro Video?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_archive_title_show',
    'label'       => esc_html__( 'Title?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_course_title_height',
    'label'       => esc_html__( 'Fixed Title Height?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => false,
    'active_callback'   =>  [
        [
            'setting'   =>  'sensei_archive_title_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_excerpt_show',
    'label'       => esc_html__( 'Excerpt?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_price_show',
    'label'       => esc_html__( 'Price?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_lesson_show',
    'label'       => esc_html__( 'Lesson?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_lesson_text_show',
    'label'       => esc_html__( 'Lesson Text?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'sensei_lesson_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_cat_show',
    'label'       => esc_html__( 'Categories?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_wishlist_show',
    'label'       => esc_html__( 'Wishlist?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_instructor_name_on_off',
    'label'       => esc_html__( 'Create by Name?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_instructor_img_on_off',
    'label'       => esc_html__( 'Instructor Avatar?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_instructor_name_on_off',
    'label'       => esc_html__( 'Instructor Name?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_see_more_btn',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_see_more_btn',
    'label'       => esc_html__( 'See More Button?', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'See More - Custom Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'sensei_see_more_btn_text',
    'section' =>  'edubin_sensei_archive_page_section',
    'default'     => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'see_more_btn_or_icon',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_hide_archive_text',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Free - Custom Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'free_custom_text',
    'section' =>  'edubin_sensei_archive_page_section',
    'default'     => '',
    'transport' =>  'postMessage',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_free_custom_text',
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'sensei_archive_pagi_aligment',
    'label'       => esc_html__( 'pagination', 'edubin' ),
    'section'     => 'edubin_sensei_archive_page_section',
    'default'     => 'center',
    'choices'     => [
        'flex-start'  => esc_html__('Left', 'edubin'),
        'center' => esc_html__('Center', 'edubin'),
        'flex-end' => esc_html__('Right', 'edubin'),
    ],
] );
/*----------------------------
Sensei Single Page
----------------------------*/
 Kirki::add_section( 'edubin_sensei_single_page_section', array(
    'title'    =>  esc_html__( 'Course Single Page', 'edubin' ),
    'panel' =>  'edubin_sensei_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'sensei_single_page_layout',
    'label'       => esc_html__( 'Page Style', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
    'multiple'    => false,
    'choices'     => [
        '1' => esc_html__('Style 01', 'edubin'),
        '2' => esc_html__('Style 02', 'edubin'),
        '3' => esc_html__('Style 03', 'edubin'),
        '4' => esc_html__('Style 04', 'edubin'),
        '5' => esc_html__('Style 05', 'edubin'),
    ],
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'sensei_course_header_style',
    'label'       => esc_html__( 'Header Style', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
    'multiple'    => false,
    'choices'     => [
        '1' => esc_html__('Style 01', 'edubin'),
        '2' => esc_html__('Style 02', 'edubin'),
    ],
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sensei_single_page_layout',
                'operator' => '==',
                'value'    => '1',
            ),
            // OR
            array(
                array(
                    'setting'  => 'sensei_single_page_layout',
                    'operator' => '==',
                    'value'    => '3',
                ),
            ),
        ),
    ),
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_intro_video_position',
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'sensei_intro_video_position',
    'label'       => esc_html__( 'Intro Image/Video Preview', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => 'intro_video_content',
    'multiple'    => false,
    'choices'     => [
        'none' => esc_html__('Off', 'edubin'),
        'intro_video_content' => esc_html__('Content Area', 'edubin'),
        'intro_video_sidebar' => esc_html__('Sidebar Area', 'edubin'),
    ],
    // 'active_callback' => array(
    //     array(
    //         array(
    //             'setting'  => 'sensei_single_page_layout',
    //             'operator' => '==',
    //             'value'    => '1',
    //         ),
    //         // OR
    //         array(
    //             array(
    //                 'setting'  => 'sensei_single_page_layout',
    //                 'operator' => '==',
    //                 'value'    => '2',
    //             ),
    //         ),
    //         // OR
    //         array(
    //             array(
    //                 'setting'  => 'sensei_single_page_layout',
    //                 'operator' => '==',
    //                 'value'    => '3',
    //             ),
    //         ),
    //         // OR
    //         array(
    //             array(
    //                 'setting'  => 'sensei_single_page_layout',
    //                 'operator' => '==',
    //                 'value'    => '4',
    //             ),
    //         ),
    //     ),
    // ),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_single_breadcrumb',
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_breadcrumb',
    'label'       => esc_html__( 'Breadcrumb?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_single_sidebar_sticky',
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_course_info',
    'label'       => esc_html__( 'Course Info?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_single_course_info',
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_sidebar_sticky',
    'label'       => esc_html__( 'Sidebar Sticky?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_single_course_graduation',
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '<hr>',
] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'sensei_single_course_graduation',
//     'label'       => esc_html__( 'Course Graduation?', 'edubin' ),
//     'section'     => 'edubin_sensei_single_page_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'sensei_single_course_time',
//     'label'       => esc_html__( 'Course Time?', 'edubin' ),
//     'section'     => 'edubin_sensei_single_page_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'sensei_single_progress',
//     'label'       => esc_html__( 'Progress?', 'edubin' ),
//     'section'     => 'edubin_sensei_single_page_section',
//     'default'     => '1',
// ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_lesson',
    'label'       => esc_html__( 'Lesson?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_cat',
    'label'       => esc_html__( 'Category?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_social_shear',
    'label'       => esc_html__( 'Social Share?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_instructor_single',
    'label'       => esc_html__( 'Created By?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_course_cat',
    'label'       => esc_html__( 'Category?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_short_text',
    'label'       => esc_html__( 'Short Text?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom Heading', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'sensei_single_info_heading',
    'section' =>  'edubin_sensei_related_course_section',
    'default'   => esc_html__( 'Course Info', 'edubin' ),
    'transport' =>  'postMessage',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_last_update',
    'label'       => esc_html__( 'Last Updated?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_created_by',
    'label'       => esc_html__( 'Created By?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_single_language',
    'label'       => esc_html__( 'Language?', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'sensei_custom_features_position',
    'label'       => esc_html__( 'Custom Features List Position', 'edubin' ),
    'section'     => 'edubin_sensei_single_page_section',
    'default'     => 'bottom',
    'choices'     => [
        'top'    => esc_html__('Top', 'edubin'),
        'bottom' => esc_html__('Buttom', 'edubin'),
    ],
] );


/*----------------------------
Sensei Related Courses
----------------------------*/
 Kirki::add_section( 'edubin_sensei_related_course_section', array(
    'title'    =>  esc_html__( 'Related Courses', 'edubin' ),
    'panel' =>  'edubin_sensei_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'sensei_related_course_position',
    'label'       => esc_html__( 'Custom Features List Position', 'edubin' ),
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => 'content',
    'choices'     => [
        'none' => esc_html__('None', 'edubin'),
        'sidebar' => esc_html__('Sidebar Area', 'edubin'),
        'content' => esc_html__('Content Area', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_related_course_style',
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => '<hr>',
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sensei_related_course_style',
                'operator' => '==',
                'value'    => 'sidebar',
            ),
        ),
    ),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'sensei_related_course_style',
    'label'       => esc_html__( 'Related Course Style', 'edubin' ),
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => 'square',
    'choices'     => [
        'round' => esc_html__('Round', 'edubin'),
        'square' => esc_html__('Square', 'edubin'),
    ],
    'active_callback' => array(
        array(
            array(
                'setting'  => 'sensei_related_course_style',
                'operator' => '==',
                'value'    => 'sidebar',
            ),
        ),
    ),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_related_course_title',
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom Heading', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'sensei_related_course_title',
    'section' =>  'edubin_sensei_related_course_section',
    'default'   => 'Related Courses',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'sensei_course_feature_cat_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_related_course_items',
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'sensei_related_course_items',
    'label'       => esc_html__( 'Number of Courses', 'edubin' ),
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => 3,
    'choices'     => [
        'min'  => 1,
        'step' => 1,
    ],
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'sensei_related_course_columns',
    'label'       => esc_html__( 'Related Course Columns', 'edubin' ),
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => '4',
    'choices'     => [
        '3' => __('4 Columns', 'edubin'),
        '4' => __('3 Columns', 'edubin'),
        '6' => __('2 Columns', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_sensei_related_course_by',
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'sensei_related_course_by',
    'label'       => esc_html__( 'Related Course By', 'edubin' ),
    'section'     => 'edubin_sensei_related_course_section',
    'default'     => 'tags',
    'choices'     => [
        'category' => esc_html__('Category', 'edubin'),
        'tags' => esc_html__('Tags', 'edubin'),
    ],
] );

/*----------------------------
Sensei Utilities
----------------------------*/
 Kirki::add_section( 'edubin_sensei_utilities_section', array(
    'title'    =>  esc_html__( 'Utilities', 'edubin' ),
    'panel' =>  'edubin_sensei_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'sensei_layout_override',
    'label'       => esc_html__( 'Custom Lesson Style?', 'edubin' ),
    'section'     => 'edubin_sensei_utilities_section',
    'default'     => false,
] );
