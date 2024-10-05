<?php
/*----------------------------
Social Share
----------------------------*/

 Kirki::add_section( 'edubin_social_shear_section', array(
    'title'    =>  esc_html__( 'Social Share', 'edubin' ),
    'panel' =>  'edubin_general_panel'
) );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'social_shear_show',
    'label'       => esc_html__( 'Enable Social Share?', 'edubin' ),
    'section'     => 'edubin_social_shear_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'social_shear_tooltip',
    'label'       => esc_html__( 'Enable Tooltip?', 'edubin' ),
    'section'     => 'edubin_social_shear_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'social_shear_facebook',
    'label'       => esc_html__( 'Facebook?', 'edubin' ),
    'section'     => 'edubin_social_shear_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'social_shear_twitter',
    'label'       => esc_html__( 'Twitter?', 'edubin' ),
    'section'     => 'edubin_social_shear_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'social_shear_tumblr',
    'label'       => esc_html__( 'Tumblr?', 'edubin' ),
    'section'     => 'edubin_social_shear_section',
    'default'     => false,
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'social_shear_linkedin',
    'label'       => esc_html__( 'Linkedin?', 'edubin' ),
    'section'     => 'edubin_social_shear_section',
    'default'     => '1',
] );

Kirki::add_field( 'edubin_theme_config', [
    'type'        => 'toggle',
    'settings'    => 'social_shear_email',
    'label'       => esc_html__( 'Email?', 'edubin' ),
    'section'     => 'edubin_social_shear_section',
    'default'     => '1',
] );
