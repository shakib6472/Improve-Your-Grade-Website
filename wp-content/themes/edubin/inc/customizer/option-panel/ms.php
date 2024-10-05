<?php
/*----------------------------
MasterStudy Archive Page
----------------------------*/
 Kirki::add_section( 'edubin_ms_archive_page_section', array(
    'title'    =>  esc_html__( 'Course Archive Page', 'edubin' ),
    'panel' =>  'edubin_ms_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'ms_archive_page_title',
    'label'       => esc_html__( 'Custom Archive Page Title', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => esc_html__('Courses', 'edubin'),
    'transport'   => 'refresh',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_course_archive_style',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'ms_course_archive_style',
    'label'       => esc_html__( 'Course Style', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'multiple'    => false,
    'default'     => '1',
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
    'settings'    => 'divider_ms_course_per_page',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'ms_course_per_page',
    'label'       => esc_html__( 'Course Count', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => 6,
    'choices'     => [
        'min'  => 1,
        'step' => 1,
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'ms_course_archive_clm',
    'label'       => esc_html__( 'Courses Columns', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '4',
    'choices'     => [
        '6' => esc_html__('2', 'edubin'),
        '4' => esc_html__('3', 'edubin'),
        '3' => esc_html__('4', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_course_masonry',
    'label'       => esc_html__( 'Masonry Layout?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_intor_video',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_archive_media_show',
    'label'       => esc_html__( 'Media?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_intor_video',
    'label'       => esc_html__( 'PopUp Intro Video?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'ms_archive_image_size',
    'label'       => esc_html__( 'Select Image Size', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => 'edubin-post-thumb',
    'multiple'    => false,
    'placeholder' => esc_html__( 'Select a image size', 'edubin' ),
    'choices'     => edubin_get_thumbnail_sizes(),
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_archive_title_show',
    'label'       => esc_html__( 'Title?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );


Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_excerpt_show',
    'label'       => esc_html__( 'Excerpt?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_price_show',
    'label'       => esc_html__( 'Price?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_enrolled_show',
    'label'       => esc_html__( 'Enrolled Student?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_enrolled_text_show',
    'label'       => esc_html__( 'Student Text?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'ms_enrolled_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_lesson_show',
    'label'       => esc_html__( 'Lesson?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => true,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_lesson_text_show',
    'label'       => esc_html__( 'Lesson Text?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'ms_lesson_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_quiz_show',
    'label'       => esc_html__( 'Quiz?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_quiz_text_show',
    'label'       => esc_html__( 'Quiz Text?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'ms_quiz_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_cat_show',
    'label'       => esc_html__( 'Categories?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_review_show',
    'label'       => esc_html__( 'Review?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_review_average_show',
    'label'       => esc_html__( 'Review Average?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => true,
    'active_callback'   =>  [
        [
            'setting'   =>  'ms_review_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_review_text_show',
    'label'       => esc_html__( 'Review Text?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => false,
    'active_callback'   =>  [
        [
            'setting'   =>  'ms_review_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_instructor_img_on_off',
    'label'       => esc_html__( 'Instructor Avatar?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_instructor_name_on_off',
    'label'       => esc_html__( 'Instructor Name?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_wishlist_show',
    'label'       => esc_html__( 'Wishlist?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '0',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_level_show',
    'label'       => esc_html__( 'Course Level?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '0',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_see_more_btn',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_see_more_btn',
    'label'       => esc_html__( 'See More Button?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'See More - Custom Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'ms_see_more_btn_text',
    'section' =>  'edubin_ms_archive_page_section',
    'default'     => '',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'see_more_btn',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_custom_closed_btn_url',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'custom_closed_btn_url',
    'label'       => esc_html__( 'Custom Closed Button URL?', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '1',
] );


Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Free - Custom Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'free_custom_text',
    'section' =>  'edubin_ms_archive_page_section',
    'default'     => '',
    'transport' =>  'postMessage',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_free_custom_text',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Enrolled - Custom Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'enrolled_custom_text',
    'section' =>  'edubin_ms_archive_page_section',
    'default'     => '',
    'transport' =>  'postMessage',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_completed_custom_text',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Completed - Custom Text', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'completed_custom_text',
    'section' =>  'edubin_ms_archive_page_section',
    'default'     => '',
    'transport' =>  'postMessage',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_archive_pagi_aligment',
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'ms_archive_pagi_aligment',
    'label'       => esc_html__( 'pagination', 'edubin' ),
    'section'     => 'edubin_ms_archive_page_section',
    'default'     => 'center',
    'choices'     => [
        'flex-start'  => esc_html__('Left', 'edubin'),
        'center' => esc_html__('Center', 'edubin'),
        'flex-end' => esc_html__('Right', 'edubin'),
    ],
] );
/*----------------------------
MasterStudy Single Page
----------------------------*/
 Kirki::add_section( 'edubin_ms_single_page_section', array(
    'title'    =>  esc_html__( 'Course Single Page', 'edubin' ),
    'panel' =>  'edubin_ms_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'ms_single_page_layout',
    'label'       => esc_html__( 'Page Style', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
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
    'settings'    => 'ms_course_header_style',
    'label'       => esc_html__( 'Header Style', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
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
                'setting'  => 'ms_single_page_layout',
                'operator' => '==',
                'value'    => '1',
            ),
            // OR
            array(
                array(
                    'setting'  => 'ms_single_page_layout',
                    'operator' => '==',
                    'value'    => '3',
                ),
            ),
        ),
    ),
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_intro_video_position',
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'ms_intro_video_position',
    'label'       => esc_html__( 'Intro Image/Video Preview', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
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
//     'settings'    => 'divider_ms_single_header_meta',
//     'section'     => 'edubin_ms_single_page_section',
//     'default'     => '<hr>',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'ms_single_header_meta',
//     'label'       => esc_html__( 'Header Meta?', 'edubin' ),
//     'section'     => 'edubin_ms_single_page_section',
//     'default'     => false,
// ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_single_breadcrumb',
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_breadcrumb',
    'label'       => esc_html__( 'Breadcrumb?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_single_sidebar_sticky',
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_course_info',
    'label'       => esc_html__( 'Course Info?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_single_course_info',
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '<hr>',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'ms_custom_features_position',
    'label'       => esc_html__( 'Custom Features List Position', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => 'bottom',
    'choices'     => [
        'top'    => esc_html__('Top', 'edubin'),
        'bottom' => esc_html__('Buttom', 'edubin'),
    ],
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_single_sidebar_sticky',
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '<hr>',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_sidebar_sticky',
    'label'       => esc_html__( 'Sidebar Sticky?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_ms_single_course_graduation',
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '<hr>',
] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'ms_single_course_graduation',
//     'label'       => esc_html__( 'Course Graduation?', 'edubin' ),
//     'section'     => 'edubin_ms_single_page_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'ms_single_course_time',
//     'label'       => esc_html__( 'Course Time?', 'edubin' ),
//     'section'     => 'edubin_ms_single_page_section',
//     'default'     => '1',
// ] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'ms_single_progress',
//     'label'       => esc_html__( 'Progress?', 'edubin' ),
//     'section'     => 'edubin_ms_single_page_section',
//     'default'     => '1',
// ] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom Heading', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'ms_single_info_heading',
    'section' =>  'edubin_ms_single_page_section',
    'default'   => esc_html__( 'Course Info', 'edubin' ),
    'transport' =>  'postMessage',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_last_update',
    'label'       => esc_html__( 'Last Updated?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_instructor_single',
    'label'       => esc_html__( 'Instructor?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_lesson_single',
    'label'       => esc_html__( 'Lesson?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_enrolled',
    'label'       => esc_html__( 'Enrolled Students?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'toggle',
//     'settings'    => 'ms_single_duration',
//     'label'       => esc_html__( 'Duration?', 'edubin' ),
//     'section'     => 'edubin_ms_single_page_section',
//     'default'     => '1',
// ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_cat',
    'label'       => esc_html__( 'Category?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_social_shear',
    'label'       => esc_html__( 'Social Share?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_course_cat',
    'label'       => esc_html__( 'Category List?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_review',
    'label'       => esc_html__( 'Reviews?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_excerpt',
    'label'       => esc_html__( 'Excerpt/Short Text?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'ms_single_language',
    'label'       => esc_html__( 'Language?', 'edubin' ),
    'section'     => 'edubin_ms_single_page_section',
    'default'     => '1',
] );


/*----------------------------
MasterStudy Related Courses
----------------------------*/
 
 Kirki::add_section( 'edubin_ms_related_course_section', array(
    'title'    =>  esc_html__( 'Related Courses', 'edubin' ),
    'panel' =>  'edubin_ms_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'ms_related_course_position',
    'label'       => esc_html__( 'Related Course Preview', 'edubin' ),
    'section'     => 'edubin_ms_related_course_section',
    'default'     => 'content',
    'multiple'    => false,
    'choices'     => [
        'none' => esc_html__('Off', 'edubin'),
        'sidebar' => esc_html__('Sidebar Area', 'edubin'),
        'content' => esc_html__('Content Area', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'select',
    'settings'    => 'ms_related_course_style',
    'label'       => esc_html__( 'Related Course Style', 'edubin' ),
    'section'     => 'edubin_ms_related_course_section',
    'default'     => 'square',
    'choices'     => [
        'round' => esc_html__('Round', 'edubin'),
        'square' => esc_html__('Square', 'edubin'),
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'ms_related_course_position',
            'operator'  =>  '===',
            'value'     =>  'sidebar',
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', array(
    'label' =>  esc_html__( 'Custom Heading', 'edubin' ),
    'type' =>  'text',
    'settings' =>  'ms_related_course_title',
    'section' =>  'edubin_ms_related_course_section',
    'default'   => 'Related Courses',
    'transport' =>  'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'ms_course_feature_cat_show',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'ms_related_course_by',
    'label'       => esc_html__( 'Related Course Query By', 'edubin' ),
    'section'     => 'edubin_ms_related_course_section',
    'default'     => 'tags',
    'choices'     => [
        'category' => esc_html__('Category', 'edubin'),
        'tags' => esc_html__('Tags', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'ms_related_course_items',
    'label'       => esc_html__( 'Number of Courses', 'edubin' ),
    'section'     => 'edubin_ms_related_course_section',
    'default'     => 3,
    'choices'     => [
        'min'  => 1,
        'step' => 1,
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'ms_related_course_columns',
    'label'       => esc_html__( 'Related Course Columns', 'edubin' ),
    'section'     => 'edubin_ms_related_course_section',
    'default'     => '4',
    'choices'     => [
        '3' => __('4 Columns', 'edubin'),
        '4' => __('3 Columns', 'edubin'),
        '6' => __('2 Columns', 'edubin'),
    ],
] );
