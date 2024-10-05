<?php

// Zoom Meeting 
add_action('cmb2_admin_init', 'edubin_zoom_meeting');
function edubin_zoom_meeting()
{
   $prefix = 'edubin_zoom_';

    $zoom_meta = new_cmb2_box( array(
        'id'           => $prefix . 'metabox',
        'title'        => __( 'Zoom Meta', 'edubin' ),
        'object_types' => array( 'zoom-meetings' ),
        'context'      => 'advanced',
        'priority'     => 'default', 
        'show_names'   => true
    ) );

    $zoom_meta->add_field( array(
        'id'           => $prefix . 'extra_meta_fields',
        'type'         => 'group',
        'name'         => __( 'Zoom Sidebar Extra Meta Information', 'edubin' ),
        'options'      => array(
            'group_title'      => __( 'Meta Information{#}', 'edubin' ),
            'add_button'       => __( 'Add Another Meta Information', 'edubin' ),
            'remove_button'    => __( 'Remove Meta', 'edubin' ),
            'sortable'         => true
        ),
        'fields'       => array(
            array(
                'name' => __( 'Meta Label', 'edubin' ),
                'id'   => 'label',
                'type' => 'text'
            ),
            array(
                'name' => __( 'Meta Value', 'edubin' ),
                'id'   => 'value',
                'type' => 'text'
            ),
            array(
                'name' => __( 'Meta Wrapper Class', 'edubin' ),
                'id'   => 'wrapper_class',
                'type' => 'text'
            )
        )
    ) );
}
