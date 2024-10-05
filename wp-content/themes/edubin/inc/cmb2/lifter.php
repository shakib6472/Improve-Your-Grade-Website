<?php

//Edubin course features metabox
add_action('cmb2_admin_init', 'tpc_edubin_lif_course_features_metabox');
function tpc_edubin_lif_course_features_metabox()
{
    $prefix                = '_edubin_';
    $cmb_lif_course_metabox = new_cmb2_box(array(
        'id'           => $prefix . 'edubin_lif_course_metabox',
        'title'        => __('<span>Course Options</span>', 'edubin'),
        'object_types' => array('course'), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ));
   $cmb_lif_course_metabox->add_field(array(
        'name' => 'Add Intro Video URL',
        'id'   => 'edubin_lif_video',
        'type' => 'oembed',
        // 'description'  => __( 'It will not work if you add video in the option Settings -> Video URL or Embed Code', 'edubin' )
    ));
    // $cmb_lif_course_metabox->add_field( array(
    //     'name'    => __( 'Header Image', 'edubin' ),
    //     'id'      => $prefix . 'header_img',
    //     'type'    => 'file',
    //     'options' => array(
    //         'url' => false
    //     ),
    //     'text'    => array(
    //         'add_upload_file_text' => __( 'Add Image', 'edubin' )
    //     ),
    //     'description'  => __( 'This image will be shown at the course single page header section.', 'edubin' )
    // ) );

    $cmb_lif_course_metabox->add_field(array(
        'name' => __('Excerpt', 'edubin'),
        'desc' => __('Add course short description', 'edubin'),
        'id'   =>  $prefix . 'lif_excerpt',
        'type' => 'textarea_small',
    ));   


}

// ========= LearnDash course custom features metxbox ========

add_action('cmb2_admin_init', 'tpc_edubin_lif_course_feature_metaboxes');
function tpc_edubin_lif_course_feature_metaboxes()
{
    $prefix                = '_edubin_';
    
    $cmb = new_cmb2_box(array(
        'id'           => 'edubin_lif_course_feature_repeater', 
        'title'        => 'Custom Course Features',
        'object_types' => array('course'), // Post type
        'context'      => 'normal',
        'priority'     => 'low',
        'show_names'   => true, // Show field names on the left
    ));

    $lif_custom_feature_group_id = $cmb->add_field(array(
        'id'         => 'lif_custom_feature_group',
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
    $cmb->add_group_field($lif_custom_feature_group_id, array(
        'name' => __('Add Icon', 'edubin'),
        'desc' => __('Here you can add icon classes such as Dashicon, Elementor, etc. Learn more about the icons class. <a target="_blank" href="https://thepixelcurve.com/support/docs/edubin/#icons">go here</a>', 'edubin'),
        'id'   => 'lif_custom_feature_group_icon',
        'type' => 'text', // This field type
    ));
    $cmb->add_group_field($lif_custom_feature_group_id, array(
        'name' => __('Label', 'edubin'),
        'desc' => __('Add your custom course feature label', 'edubin'),
        'id'   => 'lif_custom_feature_group_label',
        'type' => 'text',
    ));
    $cmb->add_group_field($lif_custom_feature_group_id, array(
        'name' => __('Value', 'edubin'),
        'desc' => __('Add your custom course feature label value', 'edubin'),
        'id'   => 'lif_custom_feature_group_value',
        'type' => 'text',
    ));
}
