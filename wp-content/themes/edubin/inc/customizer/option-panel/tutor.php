<?php
/*----------------------------
Tutor Archive Page
----------------------------*/
 Kirki::add_section( 'edubin_tutor_archive_page_section', array(
    'title'    =>  esc_html__( 'Course Archive Page', 'edubin' ),
    'panel' =>  'edubin_tutor_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'tutor_archive_page_title',
    'label'       => esc_html__( 'Custom Archive Page Title', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => esc_html__('Courses', 'edubin'),
    'transport'   => 'refresh',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'tutor_course_archive_style',
    'label'       => esc_html__( 'Course Style', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
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
    'type'        => 'toggle',
    'settings'    => 'tutor_archive_media_show',
    'label'       => esc_html__( 'Media?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_intro_video',
    'label'       => esc_html__( 'PopUp Intro Video?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => false,
    'active_callback'   =>  [
        [
            'setting'   =>  'tutor_archive_media_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'tutor_archive_image_size',
    'label'       => esc_html__( 'Select Image Size', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => 'edubin-post-thumb',
    'multiple'    => false,
    'placeholder' => esc_html__( 'Select a image size', 'edubin' ),
    'choices'     => edubin_get_thumbnail_sizes(),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_header_top',
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_archive_title_show',
    'label'       => esc_html__( 'Title?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_excerpt_show',
    'label'       => esc_html__( 'Excerpt?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_price_show',
    'label'       => esc_html__( 'Price?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => true,
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_enroll_show',
    'label'       => esc_html__( 'Students?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_enroll_text_show',
    'label'       => esc_html__( 'Students Text?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
    'active_callback' => array(
        array(
            array(
                'setting'  => 'tutor_enroll_show',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    )

] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_lesson_show',
    'label'       => esc_html__( 'Lesson?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => true,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_lesson_text_show',
    'label'       => esc_html__( 'Lesson Text?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => 1,
    'active_callback' => array(
        array(
            array(
                'setting'  => 'tutor_lesson_show',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    )
] );


// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_duration_show',
//     'label'       => esc_html__( 'Duration?', 'edubin' ),
//     'section'     => 'edubin_tutor_archive_page_section',
//     'default'     => false,
// ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_quiz_show',
    'label'       => esc_html__( 'Quiz?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_quiz_text_show',
    'label'       => esc_html__( 'Quiz Text?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
    'active_callback' => array(
        array(
            array(
                'setting'  => 'tutor_quiz_show',
                'operator' => '==',
                'value'    => true,
            ),
        ),
    )
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_cat_show',
    'label'       => esc_html__( 'Categories?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_review_show',
    'label'       => esc_html__( 'Review?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_review_text_show',
    'label'       => esc_html__( 'Review Text?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_level_show',
    'label'       => esc_html__( 'Level?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => true,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_wishlist_show',
    'label'       => esc_html__( 'Wishlist?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_pagZe_section',
    'default'     => true,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_instructor_img_on_off',
    'label'       => esc_html__( 'Instructor Avatar?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_instructor_name_on_off',
    'label'       => esc_html__( 'Instructor Name?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_permalink_type',
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '<hr>',
] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'select',
//     'settings'    => 'tutor_permalink_type',
//     'label'       => esc_html__( 'Permalink Type', 'edubin' ),
//     'section'     => 'edubin_tutor_archive_page_section',
//     'default'     => 'tutor_archive_price',
//     'multiple'    => false,
//     'choices'     => [
//         'tutor_archive_price' => esc_html__( 'Price', 'edubin' ),
//         'tutor_archive_permalink' => esc_html__( 'See More', 'edubin' ),
//         'tutor_archive_dynamic_url' => esc_html__( 'Tutor Dynamic URL', 'edubin' ),
//     ],
// ] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_see_more_btn',
    'label'       => esc_html__( 'See More Button?', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'See More - Custom Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'tutor_see_more_btn_text',
    'section' =>  'edubin_tutor_archive_page_section',
    'default'     => esc_html__('See More', 'edubin'),
    'transport' =>  'refresh',
) );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'divider_tutor_hide_archive_text',
//     'section'     => 'edubin_tutor_archive_page_section',
//     'default'     => '<hr>',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_hide_archive_text',
//     'label'       => esc_html__( 'Hide Archive: Text?', 'edubin' ),
//     'section'     => 'edubin_tutor_archive_page_section',
//     'default'     => false,
// ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'tutor_archive_pagi_aligment',
    'label'       => esc_html__( 'Pagination', 'edubin' ),
    'section'     => 'edubin_tutor_archive_page_section',
    'default'     => 'center',
    'choices'     => [
        'flex-start'  => esc_html__('Left', 'edubin'),
        'center' => esc_html__('Center', 'edubin'),
        'flex-end' => esc_html__('Right', 'edubin'),
    ],
] );
/*----------------------------
Tutor Single Page
----------------------------*/
 Kirki::add_section( 'edubin_tutor_single_page_section', array(
    'title'    =>  esc_html__( 'Course Single Page', 'edubin' ),
    'panel' =>  'edubin_tutor_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'tutor_single_page_layout',
    'label'       => esc_html__( 'Page Style', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
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
    'settings'    => 'tutor_course_header_style',
    'label'       => esc_html__( 'Header Style', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
    'multiple'    => false,
    'choices'     => [
        '1' => esc_html__('Style 01', 'edubin'),
        '2' => esc_html__('Style 02', 'edubin'),
        // '3' => esc_html__('Style 03', 'edubin'),
        // '4' => esc_html__('Style 04', 'edubin'),
    ],
    'active_callback' => array(
        array(
            array(
                'setting'  => 'tutor_single_page_layout',
                'operator' => '==',
                'value'    => '1',
            ),
            // OR
            array(
                array(
                    'setting'  => 'tutor_single_page_layout',
                    'operator' => '==',
                    'value'    => '3',
                ),
            ),
        ),
    ),
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_intro_video_position',
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'tutor_intro_video_position',
    'label'       => esc_html__( 'Intro Image/Video Preview', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => 'intro_video_sidebar',
    'multiple'    => false,
    'choices'     => [
        'none' => esc_html__('Off', 'edubin'),
        'intro_video_content' => esc_html__('Content Area', 'edubin'),
        'intro_video_sidebar' => esc_html__('Sidebar Area', 'edubin'),
    ],
] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'divider_tutor_single_header_meta',
//     'section'     => 'edubin_tutor_single_page_section',
//     'default'     => '<hr>',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_single_header_meta',
//     'label'       => esc_html__( 'Header Meta?', 'edubin' ),
//     'section'     => 'edubin_tutor_single_page_section',
//     'default'     => true,
// ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_single_breadcrumb',
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_breadcrumb',
    'label'       => esc_html__( 'Breadcrumb?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_single_sidebar_sticky',
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_sidebar_sticky',
    'label'       => esc_html__( 'Sidebar Sticky?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_single_course_graduation',
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '<hr>',
] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_single_course_graduation',
//     'label'       => esc_html__( 'Course Graduation?', 'edubin' ),
//     'section'     => 'edubin_tutor_single_page_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_single_course_time',
//     'label'       => esc_html__( 'Course Time?', 'edubin' ),
//     'section'     => 'edubin_tutor_single_page_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_single_progress',
//     'label'       => esc_html__( 'Progress?', 'edubin' ),
//     'section'     => 'edubin_tutor_single_page_section',
//     'default'     => '1',
// ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_last_update',
    'label'       => esc_html__( 'Last Updated?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_enroll_btn',
    'label'       => esc_html__( 'Enrolled Button?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_price',
    'label'       => esc_html__( 'Price?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_excerpt',
    'label'       => esc_html__( 'Excerpt?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_enroll',
    'label'       => esc_html__( 'Enrolled?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_duration_single',
    'label'       => esc_html__( 'Duration?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_lesson_single',
    'label'       => esc_html__( 'Lesson?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_quiz',
    'label'       => esc_html__( 'Quiz?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => true,
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_skill_level',
    'label'       => esc_html__( 'Skill Level?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => true,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_language',
    'label'       => esc_html__( 'Language?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_cat',
    'label'       => esc_html__( 'Category?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'tutor_custom_features_position',
    'label'       => esc_html__( 'Custom Features List Position', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => 'bottom',
    'choices'     => [
        'top'    => esc_html__('Top', 'edubin'),
        'bottom' => esc_html__('Buttom', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_tags',
    'label'       => esc_html__( 'Tags?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_social_shear',
    'label'       => esc_html__( 'Social Share?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_instructor_single',
    'label'       => esc_html__( 'Instructor?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_review',
    'label'       => esc_html__( 'Reviews?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => true,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_single_cat_list',
    'label'       => esc_html__( 'Sidebar Category List?', 'edubin' ),
    'section'     => 'edubin_tutor_single_page_section',
    'default'     => false,
] );
/*----------------------------
Tutor Related Courses
----------------------------*/
 Kirki::add_section( 'edubin_tutor_related_course_section', array(
    'title'    =>  esc_html__( 'Related Courses', 'edubin' ),
    'panel' =>  'edubin_tutor_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'tutor_related_course_position',
    'label'       => esc_html__( 'Custom Features List Position', 'edubin' ),
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => 'content',
    'multiple'    => false,
    'choices'     => [
        'none' => esc_html__('None', 'edubin'),
        'sidebar' => esc_html__('Sidebar Area', 'edubin'),
        'content' => esc_html__('Content Area', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_related_course_style',
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => '<hr>',
    'active_callback' => array(
        array(
            array(
                'setting'  => 'tutor_related_course_position',
                'operator' => '==',
                'value'    => 'sidebar',
            ),
        ),
    ),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'tutor_related_course_style',
    'label'       => esc_html__( 'Related Course Style', 'edubin' ),
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => 'square',
    'choices'     => [
        'round' => esc_html__('Round', 'edubin'),
        'square' => esc_html__('Square', 'edubin'),
    ],
    'active_callback' => array(
        array(
            array(
                'setting'  => 'tutor_related_course_position',
                'operator' => '==',
                'value'    => 'sidebar',
            ),
        ),
    ),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_related_course_title',
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom Heading', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'tutor_related_course_title',
    'section' =>  'edubin_tutor_related_course_section',
    'default'   => 'Related Courses',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'tutor_course_feature_cat_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_related_course_items',
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'tutor_related_course_items',
    'label'       => esc_html__( 'Number of Courses', 'edubin' ),
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => 3,
    'choices'     => [
        'min'  => 1,
        'step' => 1,
    ],
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'tutor_related_course_columns',
    'label'       => esc_html__( 'Related Course Columns', 'edubin' ),
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => '4',
    'choices'     => [
        '3' => __('4 Columns', 'edubin'),
        '4' => __('3 Columns', 'edubin'),
        '6' => __('2 Columns', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tutor_related_course_by',
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'tutor_related_course_by',
    'label'       => esc_html__( 'Related Course By', 'edubin' ),
    'section'     => 'edubin_tutor_related_course_section',
    'default'     => 'tags',
    'choices'     => [
        'category' => esc_html__('Category', 'edubin'),
        'tags' => esc_html__('Tags', 'edubin'),
    ],
] );

/*----------------------------
Tutor Login Page 
----------------------------*/
 Kirki::add_section( 'edubin_tutor_login_page_section', array(
    'title'    =>  esc_html__( 'Login Page', 'edubin' ),
    'panel' =>  'edubin_tutor_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'tutor_login_form_widget_align',
    'label'       => esc_html__( 'Widget Align', 'edubin' ),
    'section'     => 'edubin_tutor_login_page_section',
    'default'     => 'center',
    'choices'     => [
        'flex-start'  => esc_html__('Left', 'edubin'),
        'center' => esc_html__('Center', 'edubin'),
        'flex-end' => esc_html__('Right', 'edubin'),
    ],
] );


/*----------------------------
Tutor Utilities 
----------------------------*/
 Kirki::add_section( 'edubin_tutor_utilities_section', array(
    'title'    =>  esc_html__( 'Utilities', 'edubin' ),
    'panel' =>  'edubin_tutor_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_settings_color',
    'label'       => esc_html__( 'Override Tutor Settings Color?', 'edubin' ),
    'section'     => 'edubin_tutor_utilities_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tutor_hide_profile_page_header',
    'label'       => esc_html__( 'Hide Profile Page Header?', 'edubin' ),
    'section'     => 'edubin_tutor_utilities_section',
    'default'     => false,
] );

/*----------------------------
Course Filter 
// ----------------------------*/
//  Kirki::add_section( 'edubin_tutor_course_filter_section', array(
//     'title'    =>  esc_html__( 'Course Filter ', 'edubin' ),
//     'panel' =>  'edubin_tutor_panel'
// ) );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'number',
//     'settings'    => 'tutor_course_filter_per_page',
//     'label'       => esc_html__( 'Course Count', 'edubin' ),
//     'section'     => 'edubin_tutor_course_filter_section',
//     'default'     => 9,
//     'choices'     => [
//         'min'  => 1,
//         'step' => 1,
//     ],
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'number',
//     'settings'    => 'tutor_course_filter_column',
//     'label'       => esc_html__( 'Course Filter Column', 'edubin' ),
//     'section'     => 'edubin_tutor_course_filter_section',
//     'default'     => 3,
//     'choices'     => [
//         'min'  => 1,
//         'step' => 1,
//     ],
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'filter_course_search_show',
//     'label'       => esc_html__( 'Course Search?', 'edubin' ),
//     'section'     => 'edubin_tutor_course_filter_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_filter_results_show',
//     'label'       => esc_html__( 'Filter Results?', 'edubin' ),
//     'section'     => 'edubin_tutor_course_filter_section',
//     'default'     => false,
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_filter_select_show',
//     'label'       => esc_html__( 'Filter Select?', 'edubin' ),
//     'section'     => 'edubin_tutor_course_filter_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'tutor_sidebar_filter_show',
//     'label'       => esc_html__( 'Sidebar Filter?', 'edubin' ),
//     'section'     => 'edubin_tutor_course_filter_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'radio-buttonset',
//     'settings'    => 'tutor_filter_sidebar_position',
//     'label'       => esc_html__( 'Sidebar Position', 'edubin' ),
//     'section'     => 'edubin_tutor_course_filter_section',
//     'default'     => 'left',
//     'choices'     => [
//         'left' => esc_html__( 'Left', 'edubin' ),
//         'right' => esc_html__( 'Right', 'edubin' ),
//     ],
// ] );