<?php

// The events calender metabox
add_action('cmb2_admin_init', 'tpc_edubin_tribe_events_map_metabox');
function tpc_edubin_tribe_events_map_metabox()
{
    $prefix               = '_edubin_';
    $cmb_tribe_events_map = new_cmb2_box(array(
        'id'           => $prefix . 'tribe_events_metabox',
        'title'        => __('Location Maps', 'edubin'),
        'object_types' => array('tribe_events'), // Post type
        'context'      => 'normal',
        'priority'     => 'high',
        'show_names'   => true, // Show field names on the left
    ));
   $cmb_tribe_events_map->add_field(array(
        'name' => 'Add Intro Video URL',
        'id'   => 'edubin_tribe_events_video',
        'type' => 'oembed',
    ));
    $cmb_tribe_events_map->add_field(array(
        'name' => __('Google Maps HTML Code', 'edubin'),
        'desc' => 'Add your google maps HTML code', 'edubin-core',
        'id'   => 'edubin_cmb2_tribe_events_map_html_code',
        'type' => 'textarea_code',
    ));
}
