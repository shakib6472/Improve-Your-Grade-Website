<?php

/*----------------------------
Zoom Meeting
----------------------------*/
 Kirki::add_section( 'edubin_zoom_meeting_archive_page_section', array(
    'title'    =>  esc_html__( 'Zoom Archive Page', 'edubin' ),
    'panel'          => 'edubin_zoom_meeting_panel',
) );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'text',
    'settings'    => 'zoom_archive_page_title',
    'label'       => esc_html__( 'Custom Archive Page Title', 'edubin' ),
    'section'     => 'edubin_zoom_meeting_archive_page_section',
    'default'     => esc_html__('Zoom Meeting', 'edubin'),
    'transport'   => 'refresh',
] );
Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_zm_archive_hotted',
    'label'       => esc_html__( 'Hosted?', 'edubin' ),
    'section'     => 'edubin_zoom_meeting_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_zm_archive_start_date',
    'label'       => esc_html__( 'Start Date?', 'edubin' ),
    'section'     => 'edubin_zoom_meeting_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_zm_archive_time_zone',
    'label'       => esc_html__( 'Timezone?', 'edubin' ),
    'section'     => 'edubin_zoom_meeting_archive_page_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'edubin_zm_excerpt',
    'label'       => esc_html__( 'Excerpt?', 'edubin' ),
    'section'     => 'edubin_zoom_meeting_archive_page_section',
    'default'     => false,
] );


