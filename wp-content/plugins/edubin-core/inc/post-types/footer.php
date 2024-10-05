<?php
/**
 * Footer manager for Edubin
 *
 * @since 1.0.0
 */

namespace EdubinCore\Post_Types;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Footer {

  	public static function init() {
    	add_action( 'init', array( __CLASS__, 'register_post_type' ) );
    	add_action( 'init', array( __CLASS__, 'register_footer_elementor' ) );
    	add_action( 'admin_init', array( __CLASS__, 'add_role_caps' ) );
    	add_filter( 'enter_title_here', array( __CLASS__, 'change_title_placeholder' ) );
  	}

  	public static function register_post_type() {
	    $labels = array(
			'name'                  => __( 'Footers', 'edubin-core' ),
			'singular_name'         => __( 'Footer', 'edubin-core' ),
			'add_new'               => __( 'Add New Footer', 'edubin-core' ),
			'add_new_item'          => __( 'Add New Footer', 'edubin-core' ),
			'edit_item'             => __( 'Edit Footer', 'edubin-core' ),
			'new_item'              => __( 'New Footer', 'edubin-core' ),
			'all_items'             => __( 'Footers', 'edubin-core' ),
			'view_item'             => __( 'View Footer', 'edubin-core' ),
			'search_items'          => __( 'Search Footer', 'edubin-core' ),
			'not_found'             => __( 'No Footers found', 'edubin-core' ),
			'not_found_in_trash'    => __( 'No Footers found in Trash', 'edubin-core' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Footers', 'edubin-core' )
	    );

	    $type = 'eb_footer';

	    register_post_type( $type,
	      	array(
		        'labels'            => apply_filters( 'edubin_postype_footer_labels' , $labels ),
		        'supports'          => array( 'title', 'revisions' ),
		        'public'            => true,
		        'has_archive'       => true,
		        'menu_icon' 		=> 'dashicons-welcome-widgets-menus',
		        'show_in_menu'      => true,
		        'menu_position'     => 5,
				'capability_type'   => array($type,'{$type}s'),
				'map_meta_cap'      => true  	
			)
	    );

  	}

  	public static function add_role_caps() {
 
		 // Add the roles you'd like to administer the custom post types
		 $roles = array('administrator');

		 $type  = 'eb_footer';
		 
		 // Loop through each role and assign capabilities
		 foreach($roles as $the_role) :
		 
		    $role = get_role($the_role);
		 
			$role->add_cap( 'read' );
			$role->add_cap( 'read_{$type}');
			$role->add_cap( 'read_private_{$type}s' );
			$role->add_cap( 'edit_{$type}' );
			$role->add_cap( 'edit_{$type}s' );
			$role->add_cap( 'edit_others_{$type}s' );
			$role->add_cap( 'edit_published_{$type}s' );
			$role->add_cap( 'publish_{$type}s' );
			$role->add_cap( 'delete_others_{$type}s' );
			$role->add_cap( 'delete_private_{$type}s' ); 
			$role->add_cap( 'delete_published_{$type}s' );
		 
		endforeach;
	}
 

  	public static function register_footer_elementor() {
	    $options = get_option( 'wpb_js_content_types' );
	    if ( is_array( $options ) && ! in_array( 'eb_footer', $options ) ) :
	      	$options[] = 'eb_footer';
	      	update_option( 'wpb_js_content_types', $options );
	    endif;
  	}

  	public static function change_title_placeholder( $title ){
	    $screen = get_current_screen();
	    if  ( 'eb_footer' == $screen->post_type ) :
          	$title = 'Enter Footer Name';
	    endif;	  
	    return $title;
	}  
}

Footer::init();