<?php

// Edubin tutor course features metabox
add_action('cmb2_admin_init', 'edubin_tutor_course_video');
function edubin_tutor_course_video()
{
    $prefix                = '_edubin_';
    $cmb_tutor_course_metabox = new_cmb2_box(array(
        'id'           => $prefix . 'edubin_tutor_course_video_metabox',
        'title'        => __('Course Intro Video', 'edubin'),
        'object_types' => array('courses'), // Post type
        'context'      => 'normal', //  'normal', 'advanced', or 'side'
        'priority'     => 'core', //  'high', 'core', 'default' or 'low'
        'show_names'   => true, // Show field names on the left
    ));
    // $cmb_tutor_course_metabox->add_field(array(
    //     'name' => 'Add Intro Video URL',
    //     'id'   => 'edubin_tutor_video',
    //     'type' => 'oembed',
    // ));
    $cmb_tutor_course_metabox->add_field( array(
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

// ========= Tutor course custom features metxbox ========
add_action('cmb2_admin_init', 'edubin_tutor_course_feature_metaboxes');
function edubin_tutor_course_feature_metaboxes()
{
    $prefix                = '_edubin_';
    
    $cmb = new_cmb2_box(array(
        'id'           => 'edubin_tutor_course_feature_repeater', 
        'title'        => 'Custom Course Features',
        'object_types' => array('courses'), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ));

    $tutor_custom_feature_group_id = $cmb->add_field(array(
        'id'         => 'tutor_custom_feature_group',
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
    $cmb->add_group_field($tutor_custom_feature_group_id, array(
        'name' => __('Add Icon', 'edubin'),
        'desc' => __('Here you can add icon classes such as Dashicon, Elementor, etc. Learn more about the icons class. <a target="_blank" href="https://thepixelcurve.com/support/docs/edubin/#icons">go here</a>', 'edubin'),
        'id'   => 'tutor_custom_feature_group_icon',
        'type' => 'text', // This field type
    ));
    $cmb->add_group_field($tutor_custom_feature_group_id, array(
        'name' => __('Label', 'edubin'),
        'desc' => __('Add your custom course feature label', 'edubin'),
        'id'   => 'tutor_custom_feature_group_label',
        'type' => 'text',
    ));
    $cmb->add_group_field($tutor_custom_feature_group_id, array(
        'name' => __('Value', 'edubin'),
        'desc' => __('Add your custom course feature label value', 'edubin'),
        'id'   => 'tutor_custom_feature_group_value',
        'type' => 'text',
    ));
}