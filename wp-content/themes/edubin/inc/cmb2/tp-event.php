<?php

// WP Event Manager Meta
add_action('cmb2_admin_init', 'edubin_tp_event_sidebar_meta');
function edubin_tp_event_sidebar_meta()
{
		$tp_event_sidebar_meta = new_cmb2_box( array(
			'id'           => 'edubin_tp_event_metabox',
			'title'        => __( 'Event Meta', 'edubin' ),
			'object_types' => array( 'tp_event' ),
			'context'      => 'advanced',
			'priority'     => 'default', 
			'show_names'   => true
		) );

		$tp_event_sidebar_meta->add_field(array(
		    'name' => 'Add Event Intro Video',
		    'id'   => 'edubin_tp_event_video',
		    'type' => 'oembed',
		));

		$tp_event_sidebar_meta->add_field( array(
			'id'           => 'edubin_tp_event_extra_meta_fields',
			'type'         => 'group',
			'name'         => __( 'Event Sidebar Meta', 'edubin' ),
			'options'      => array(
				'group_title'      => __( 'Event Meta {#}', 'edubin' ),
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
	                'name' => __( 'Icon Class', 'edubin' ),
	                'id'   => 'icon_class',
	                'type' => 'text',
					'description' => __( 'Here you can add icon classes such as Dashicon, Elementor, etc. Learn more about the icons class. <a target="_blank" href="https://thepixelcurve.com/support/docs/edubin/#icons">go here</a>', 'edubin' )
	            ),
	        )
		) );
}


add_action('cmb2_admin_init', 'edubin_tp_event_speaker_meta');
function edubin_tp_event_speaker_meta()
{
		$tp_event_speaker_meta = new_cmb2_box( array(
			'id'           => 'edubin_tp_event_speaker_metabox',
			'title'        => __( 'Speaker Meta', 'edubin' ),
			'object_types' => array( 'term' ),
			'taxonomies'   => array( 'tp_event_speaker' ),
			'context'      => 'normal',
			'priority'     => 'low', 
			'show_names'   => true
		) );

		$tp_event_speaker_meta->add_field( array(
			'name'    => __( 'Designation', 'edubin' ),
			'id'      => 'edubin_tp_event_speaker_designation',
			'type' => 'text'
		) );

		$tp_event_speaker_meta->add_field( array(
			'name'    => __( 'Speaker Image', 'edubin' ),
			'id'      => 'edubin_tp_event_speaker_image',
			'type'    => 'file',
			'text'    => array(
				'add_upload_file_text' => __( 'Add Speaker Image', 'edubin' )
			)
		) );

		$tp_event_speaker_meta->add_field( array(
			'name'    => __( 'Facebook URL', 'edubin' ),
			'id'      => 'edubin_tp_event_speaker_fb_profile',
			'type'    => 'text',
			'default' => '#'
		) );

		$tp_event_speaker_meta->add_field( array(
			'name'    => __( 'Twitter URL', 'edubin' ),
			'id'      => 'edubin_tp_event_speaker_tw_profile',
			'type'    => 'text',
			'default' => '#'
		) );

		$tp_event_speaker_meta->add_field( array(
			'name'    => __( 'Linkedin URL', 'edubin' ),
			'id'      => 'edubin_tp_event_speaker_lk_profile',
			'type'    => 'text',
			'default' => '#'
		) );
}


