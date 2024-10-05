<?php

/*----------------------------
WP Events Manager Archive Page
----------------------------*/
 Kirki::add_section( 'edubin_archive_page_tp_event_section', array(
    'title'    =>  esc_html__( 'Event Archive Page', 'edubin' ),
    'panel'          => 'edubin_tp_event_panel',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'tp_event_archive_page_title',
    'label'       => esc_html__( 'Custom Archive Page Title', 'edubin' ),
    'section'     => 'edubin_archive_page_tp_event_section',
    'default'     => esc_html__('Events', 'edubin'),
    'transport'   => 'refresh',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'edubin_archive_page_tp_event_clm',
    'label'       => esc_html__( 'Events Columns', 'edubin' ),
    'section'     => 'edubin_archive_page_tp_event_section',
    'default'     => '4',
    'choices'     => [
        '6' => esc_html__('2', 'edubin'),
        '4' => esc_html__('3', 'edubin'),
        '3' => esc_html__('4', 'edubin'),
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_archive_tp_event_date',
    'label'       => esc_html__( 'Event Date?', 'edubin' ),
    'section'     => 'edubin_archive_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_archive_tp_event_price',
    'label'       => esc_html__( 'Event Price?', 'edubin' ),
    'section'     => 'edubin_archive_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_archive_tp_event_excerpt',
    'label'       => esc_html__( 'Excerpt?', 'edubin' ),
    'section'     => 'edubin_archive_page_tp_event_section',
    'default'     => '0',
] );

/*----------------------------
WP Events Manager Single
----------------------------*/
 Kirki::add_section( 'edubin_single_page_tp_event_section', array(
    'title'    =>  esc_html__( 'Event Single Page', 'edubin' ),
    'panel'          => 'edubin_tp_event_panel',
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_sidebar',
    'label'       => esc_html__( 'Sidebar?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_cost',
    'label'       => esc_html__( 'Cost?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_date',
    'label'       => esc_html__( 'Event Date?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'edubin_tp_events_start_date_format',
    'label'       => esc_html__( 'Start Date Format', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => 'd F, Y',
    'transport'   => 'refresh',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_single_tp_event_date',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'edubin_tp_events_end_date_format',
    'label'       => esc_html__( 'End Date Format', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => 'd F, Y',
    'transport'   => 'refresh',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_single_tp_event_date',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_time',
    'label'       => esc_html__( 'Event Time?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'edubin_tp_events_time_format',
    'label'       => esc_html__( 'Time Format', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => 'g:i A',
    'transport'   => 'refresh',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_single_tp_event_time',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ],
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_seat',
    'label'       => esc_html__( 'Total Seat?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_booking',
    'label'       => esc_html__( 'Seat Booking?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_speaker',
    'label'       => esc_html__( 'Speaker?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_comment',
    'label'       => esc_html__( 'Comments?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_single_tp_event_countdown',
    'label'       => esc_html__( 'Countdown?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_tp_single_event_btn',
    'label'       => esc_html__( 'Booking Button?', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'radio-buttonset',
    'settings'    => 'edubin_single_tp_event_booking_btn_type',
    'label'       => esc_html__( 'Booking Button Type', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => 'default',
    'choices'     => [
        'default'   => esc_html__( 'Default', 'edubin' ),
        'custom'   => esc_html__( 'Custom', 'edubin' ),
    ],
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_tp_single_event_btn',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ]
 ] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'edubin_single_tp_event_booking_btn_text',
    'label'       => esc_html__( 'Book Now', 'edubin' ),
    'section'     => 'edubin_single_page_tp_event_section',
    'default'     => esc_html__('Book Now', 'edubin'),
    'transport'   => 'refresh',
    'active_callback'   =>  [
        [
            'setting'   =>  'edubin_tp_single_event_btn',
            'operator'  =>  '===',
            'value'     =>  true,
        ],
    ]
] );
