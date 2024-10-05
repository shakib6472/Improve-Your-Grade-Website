<?php

// Edubin sensei course features metabox
add_action('cmb2_admin_init', 'tpc_edubin_sensei_course_video');

function tpc_edubin_sensei_course_video()
{
    $prefix                = '_edubin_';
    $cmb_sensei_course_metabox = new_cmb2_box(array(
        'id'           => $prefix . 'edubin_sensei_course_video_metabox',
        'title'        => __('Course Intro Video', 'edubin'),
        'object_types' => array('course'), // Post type
        'context'      => 'normal', //  'normal', 'advanced', or 'side'
        'priority'     => 'core', //  'high', 'core', 'default' or 'low'
        'show_names'   => true, // Show field names on the left
    ));
    $cmb_sensei_course_metabox->add_field(array(
        'name' => 'Add Intro Video URL',
        'id'   => 'edubin_sensei_video',
        'type' => 'oembed',
    ));
    $cmb_sensei_course_metabox->add_field( array(
        'name'    => __( 'Header Image', 'edubin' ),
        'id'      => $prefix . 'header_img',
        'type'    => 'file',
        'options' => array(
            'url' => false
        ),
        'text'    => array(
            'add_upload_file_text' => __( 'Add Image', 'edubin' )
        ),
        'description'  => __( 'This image will be shown at the course single page header section.', 'edubin' )
    ) );
}

// Edubin sensei course features metabox
add_action('cmb2_admin_init', 'tpc_edubin_sensei_course_levels');

function tpc_edubin_sensei_course_levels()
{
    $prefix                = '_edubin_';
    $cmb_sensei_course_metabox = new_cmb2_box(array(
        'id'           => $prefix . 'sensei_course_levels_metabox',
        'title'        => __('Course Levels', 'edubin'),
        'object_types' => array('course'), // Post type
        'context'      => 'normal', //  'normal', 'advanced', or 'side'
        'priority'     => 'core', //  'high', 'core', 'default' or 'low'
        'show_names'   => true, // Show field names on the left
    ));

    $cmb_sensei_course_metabox->add_field( array(
        'name'             => 'Course Levels',
        'id'               => 'edubin_sensei_course_level_key',
        'type'             => 'radio',
        // 'show_option_none' => true,
        'options'          => array(
            'all_levels' => __( 'All Levels', 'edubin' ),
            'beginner' => __( 'Beginner', 'edubin' ),
            'intermediate'   => __( 'Intermediate', 'edubin' ),
            'expert'     => __( 'Expert', 'edubin' ),
        ),
    ) );
}

// ========= Sensei course custom features metxbox ========

add_action('cmb2_admin_init', 'tpc_edubin_sensei_course_feature_metaboxes');
function tpc_edubin_sensei_course_feature_metaboxes()
{
    $prefix                = '_edubin_';
    
    $cmb = new_cmb2_box(array(
        'id'           => 'edubin_sensei_course_feature_repeater', 
        'title'        => 'Custom Course Features',
        'object_types' => array('course'), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ));

    $sensei_custom_feature_group_id = $cmb->add_field(array(
        'id'         => 'sensei_custom_feature_group',
        'type'       => 'group',
        'repeatable' => true,
        'options'    => array(
            'group_title'   => 'Course Features {#}',
            'add_button'    => 'Add Another Feature',
            'remove_button' => 'Remove Feature',
            'closed'        => true, // Repeater fields closed by default - neat & compact.
            'sortable'      => true, // Allow changing the order of repeated groups.
        ),
    ));
    $cmb->add_group_field($sensei_custom_feature_group_id, array(
        'name' => __('Add Icon', 'edubin'),
        'desc' => __('You can add Dashicon or Elementor icon class here. <a target="_blank" href="https://thepixelcurve.com/support/docs/edubin/#icons">More info</a>', 'edubin'),
        'id'   => 'sensei_custom_feature_group_icon',
        'type' => 'text', // This field type
    ));
    $cmb->add_group_field($sensei_custom_feature_group_id, array(
        'name' => __('Label', 'edubin'),
        'desc' => __('Add your custom course feature label', 'edubin'),
        'id'   => 'sensei_custom_feature_group_label',
        'type' => 'text',
    ));
    $cmb->add_group_field($sensei_custom_feature_group_id, array(
        'name' => __('Value', 'edubin'),
        'desc' => __('Add your custom course feature label value', 'edubin'),
        'id'   => 'sensei_custom_feature_group_value',
        'type' => 'text',
    ));
}