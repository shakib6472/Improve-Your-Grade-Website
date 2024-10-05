<?php

/*----------------------------
The Events Candler Archive Page
----------------------------*/
 Kirki::add_section( 'edubin_tribe_events_section', array(
    'title'    =>  esc_html__( 'Archive Page', 'edubin' ),
    'description'    =>  esc_html__( 'Events archive page settings', 'edubin' ),
    'panel' =>  'tribe_customizer',
    'priority' => 1,
) );

// Custom Page archive title
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'tribe_events_archive_page_title',
    'label'       => esc_html__( 'Custom Page Title', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => esc_html__('Events', 'edubin'),
    'transport'   => 'auto',
] );

// Section divider before No tribe_events_archive_page_title
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tribe_events_archive_page_title',
    'section'     => 'edubin_tribe_events_section',
    'default'     => '<hr>',
] );

// Enable pagination
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'edubin_archive_events_layout',
    'label'       => esc_html__( 'Page Style', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => 'layout_2',
    'choices'     => [
        'default'   => esc_html__( 'Plugin Default', 'edubin' ),
        'layout_2' => esc_html__( 'Grid Layout', 'edubin' ),
    ],
] );

// event show count
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'number',
    'settings'    => 'events_course_per_page',
    'label'       => esc_html__( 'Events Count', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => 6,
    'choices'     => [
        'min'  => 1,
        'step' => 1,
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

// Enable pagination
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'events_columns',
    'label'       => esc_html__( 'Event Columns', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => '4',
    'choices'     => [
        '12' => esc_html__('1', 'edubin'),
        '6' => esc_html__('2', 'edubin'),
        '4' => esc_html__('3', 'edubin'),
        '3' => esc_html__('4', 'edubin'),
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

// Section divider before event_intor_video_image
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_event_intor_video_image',
    'section'     => 'edubin_tribe_events_section',
    'default'     => '<hr>',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'show_event_excerpt',
    'label'       => esc_html__( 'Event Excerpt?', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

// Event Date?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'show_event_date',
    'label'       => esc_html__( 'Event Date?', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

// Event Venue?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'show_event_vanue',
    'label'       => esc_html__( 'Event Venue?', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

// Event Price?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_price',
    'label'       => esc_html__( 'Event Price?', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => '1',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );


// divider before edubin_events_date_format?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_edubin_events_date_format',
    'section'     => 'edubin_tribe_events_section',
    'default'     => '<hr>',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

// Event date format
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'edubin_events_date_format',
    'label'       => esc_html__( 'Date Format', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => 'd. F',
    'transport'   => 'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'edubin_events_time_format',
    'label'       => esc_html__( 'Time Format', 'edubin' ),
    'section'     => 'edubin_tribe_events_section',
    'default'     => 'g:i A',
    'transport'   => 'postMessage',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_archive_events_layout',
            'operator'  =>  '===',
            'value'     =>  'layout_2',
        ],
    ],
] );

/*----------------------------
The Events Candler Single Page
----------------------------*/
 Kirki::add_section( 'edubin_tribe_events_single_section', array(
    'title'    =>  esc_html__( 'Single Page', 'edubin' ),
    // 'description'    =>  esc_html__( 'Events single page settings', 'edubin' ),
    'panel' =>  'tribe_customizer',
    'priority' => 1,
) );

// select single page layour
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'select',
//     'settings'    => 'edubin_tribe_events_layout',
//     'label'       => esc_html__( 'Page Style', 'edubin' ),
//     'section'     => 'edubin_tribe_events_single_section',
//     'multiple'    => false,
//     'default'     => 'layout_1',
//     'choices'     => [
//         'default'   => esc_html__( 'Plugin Default', 'edubin' ),
//         'layout_1' => esc_html__( 'Layout 01', 'edubin' ),
//         'layout_2' => esc_html__( 'Layout 02', 'edubin' ),
//     ],
// ] );

// divider before tbe_event_countdown?
// Kirki::add_field( 'edubin_theme_config', [
//     'type'        => 'custom',
//     'settings'    => 'divider_tbe_event_countdown',
//     'section'     => 'edubin_tribe_events_single_section',
//     'default'     => '<hr>',
// ] );

// Countdown?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_event_countdown',
    'label'       => esc_html__( 'Countdown?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Event Cost?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_event_cost',
    'label'       => esc_html__( 'Event Cost?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Start Time?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_start_time',
    'label'       => esc_html__( 'Start Time?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// End Time?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_end_time',
    'label'       => esc_html__( 'End Time?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Website?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_website',
    'label'       => esc_html__( 'Website?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Phone?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_phone',
    'label'       => esc_html__( 'Phone?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Email?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_email',
    'label'       => esc_html__( 'Email?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Organizer?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_organizer_ids',
    'label'       => esc_html__( 'Organizer?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Location?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_location',
    'label'       => esc_html__( 'Location?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// Maps?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_event_maps',
    'label'       => esc_html__( 'Maps?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '0',
] );

// divider before tbe_content_before_massage?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'custom',
    'settings'    => 'divider_tbe_content_before_massage',
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '<hr>',
] );

// Before Content?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_content_before_massage',
    'label'       => esc_html__( 'Before Content?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );

// After Content?
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'tbe_content_after_massage',
    'label'       => esc_html__( 'After Content?', 'edubin' ),
    'section'     => 'edubin_tribe_events_single_section',
    'default'     => '1',
] );
