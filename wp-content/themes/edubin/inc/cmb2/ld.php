<?php

// Edubin course features metabox
add_action('cmb2_admin_init', 'tpc_edubin_ld_course_features_metabox');
function tpc_edubin_ld_course_features_metabox()
{
    $prefix                = '_edubin_';
    $cmb_ld_course_metabox = new_cmb2_box(array(
        'id'           => $prefix . 'edubin_ld_course_metabox',
        'title'        => __('<span>Course Options</span>', 'edubin'),
        'object_types' => array('sfwd-courses', 'groups'), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ));
   $cmb_ld_course_metabox->add_field(array(
        'name' => 'Add Intro Video URL',
        'id'   => 'edubin_ld_video',
        'type' => 'oembed',
        'description'  => __( 'It will not work if you add video in the option Settings -> Video URL or Embed Code', 'edubin' )
    ));
    $cmb_ld_course_metabox->add_field( array(
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

    $cmb_ld_course_metabox->add_field(array(
        'name' => __('Excerpt', 'edubin'),
        'desc' => __('Add course short description', 'edubin'),
        'id'   =>  $prefix . 'ld_excerpt',
        'type' => 'textarea_small',
    ));   

    $cmb_ld_course_metabox->add_field( array(
        'name'             => 'Course Levels',
        'id'               => 'edubin_ld_course_level_key',
        'type'             => 'radio',
        'default'          => 'all_levels',
        // 'show_option_none' => true,
        'options'          => array(
            'all_levels' => __( 'All Levels', 'edubin' ),
            'beginner' => __( 'Beginner', 'edubin' ),
            'intermediate'   => __( 'Intermediate', 'edubin' ),
            'expert'     => __( 'Expert', 'edubin' ),
        ),
    ) );

    $cmb_ld_course_metabox->add_field( array(
        'id'      => $prefix . 'ld_certificate_show',
        'name'    => 'Certificate?',
        'type'    => 'radio_inline',
        'default' => 'no',
        'options' => array(
            'yes'  => __( 'Yes', 'edubin' ),
            'no' => __( 'No', 'edubin' ),
        ),
    ) );
}

// ========= LearnDash course custom features metxbox ========

add_action('cmb2_admin_init', 'tpc_edubin_ld_course_feature_metaboxes');
function tpc_edubin_ld_course_feature_metaboxes()
{
    $prefix                = '_edubin_';
    
    $cmb = new_cmb2_box(array(
        'id'           => 'edubin_ld_course_feature_repeater', 
        'title'        => 'Custom Course Features',
        'object_types' => array('sfwd-courses', 'groups'), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ));

    $ld_custom_feature_group_id = $cmb->add_field(array(
        'id'         => 'ld_custom_feature_group',
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
    $cmb->add_group_field($ld_custom_feature_group_id, array(
        'name' => __('Add Icon', 'edubin'),
        'desc' => __('Here you can add icon classes such as Dashicon, Elementor, etc. Learn more about the icons class. <a target="_blank" href="https://thepixelcurve.com/support/docs/edubin/#icons">go here</a>', 'edubin'),
        'id'   => 'ld_custom_feature_group_icon',
        'type' => 'text', // This field type
    ));
    $cmb->add_group_field($ld_custom_feature_group_id, array(
        'name' => __('Label', 'edubin'),
        'desc' => __('Add your custom course feature label', 'edubin'),
        'id'   => 'ld_custom_feature_group_label',
        'type' => 'text',
    ));
    $cmb->add_group_field($ld_custom_feature_group_id, array(
        'name' => __('Value', 'edubin'),
        'desc' => __('Add your custom course feature label value', 'edubin'),
        'id'   => 'ld_custom_feature_group_value',
        'type' => 'text',
    ));
}
