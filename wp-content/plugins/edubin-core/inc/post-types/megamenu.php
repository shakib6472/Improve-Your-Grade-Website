<?php
/**
 * Mega Menu manager for Edubin
 *
 * @since 1.0.0
 */
 
 if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Edubin_Mega_Menu {

  	public static function init() {
    	add_action( 'init', array( __CLASS__, 'register_mega_menu_post_type' ) );
    	add_action( 'wp_update_nav_menu_item', array( __CLASS__, 'update_custom_megamenu_options' ),10, 3);
	    add_filter( 'wp_edit_nav_menu_walker', array( __CLASS__, 'extend_nav_walker'), 100 );
    	add_filter( 'edubin_custom_options_for_megamenu', array( __CLASS__,'custom_options_for_megamenu' ), 10, 5 );
  	}

  	public static function register_mega_menu_post_type() {
	    $labels = array(
			'name'                  => __( 'Mega Menu', 'edubin-core' ),
			'singular_name'         => __( 'Mega Menu', 'edubin-core' ),
			'add_new'               => __( 'Add New Mega Menu', 'edubin-core' ),
			'add_new_item'          => __( 'Add New Mega Menu', 'edubin-core' ),
			'edit_item'             => __( 'Edit Mega Menu', 'edubin-core' ),
			'new_item'              => __( 'New Mega Menu', 'edubin-core' ),
			'all_items'             => __( 'All Mega Menu', 'edubin-core' ),
			'view_item'             => __( 'View Mega Menu', 'edubin-core' ),
			'search_items'          => __( 'Search Mega Menu', 'edubin-core' ),
			'not_found'             => __( 'No Mega Menu found', 'edubin-core' ),
			'not_found_in_trash'    => __( 'No Mega Menu found in Trash', 'edubin-core' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Mega Menu', 'edubin-core' ),
	    );

	    register_post_type( 'edubin_megamenu',
	      	array(
		        'labels'            => apply_filters( 'edubin_postype_mega_menu_labels' , $labels ),
		        'supports'          => array( 'title', 'editor' ),
		        'public'            => true,
		        'show_in_nav_menus' => false,
		        'has_archive'       => false,
		        'menu_position'     => 8,
		        'menu_icon'         => 'dashicons-list-view'
	      	)
	    );
  	}
  	
  	public static function extend_nav_walker() {
        require_once EDUBIN_PLUGIN_DIR . 'inc/edubin-megamenu-extend.php';
		return 'Edubin_Mega_Menu_Extend';
    }

  	public static function custom_options_for_megamenu( $item_id, $item, $depth, $args, $id ) {
	    $posts_array = self::get_sub_megamenus();
	    $mega_menu = get_post_meta( $item_id, 'edubin_mega_menu', true );
	    $edubin_menu_custom_width = get_post_meta( $item_id, 'edubin_menu_custom_width', true );
	    $edubin_menu_alignment = get_post_meta( $item_id, 'edubin_menu_alignment', true );
		echo '<p class="field-addclass description description-wide">';
            echo '<label for="edit-menu-item-edubin_mega_menu-' . esc_attr( $item_id ) . '">'; 
			    _e( 'Mega Menu' );
                echo '<select name="menu-item-edubin_mega_menu[' . esc_attr( $item_id ) . ']">';
                    echo '<option value="">' . __( 'Disable', 'edubin-core' ). '</option>';
                    foreach( $posts_array as $_post ) :
                        echo '<option  value="' . esc_attr( $_post->post_name ) . '" ' . selected( esc_attr( $mega_menu ), $_post->post_name ) . '>' . esc_html( $_post->post_title ). '</option>';
                    endforeach;
                echo '</select>';
            echo '</label>';
            
            echo '<br>';
			echo '<a href="' . esc_url( admin_url( 'edit.php?post_type=edubin_megamenu') ) . '" target="_blank" title="' . __( 'Manage Sub Mega Menu', 'edubin-core' ) . '">' . __( 'Manage Sub Mega Menu', 'edubin-core' ) . '</a>';
            echo ' ';
			echo '<span>' . __( 'By enabling Mega Menu, its Sub Menus( if have any ) will be disabled.', 'edubin-core' ) . '</span>';
        echo '</p>';

        $alignment = array(
            'left' => __('Left Align', 'edubin-core'),
            'right' => __('Right Align', 'edubin-core'),
            'fullwidth' => __('Fullwidth', 'edubin-core')
        ); 
         
		echo '<p class="field-edubin_menu_alignment description description-wide">';  
            echo '<label for="edit-menu-item-edubin_menu_alignment-' . esc_attr( $item_id ) . '">' . __( 'Alignment:', 'edubin-core' ) . '<br>';
                echo '<select name="menu-item-edubin_menu_alignment[' . esc_attr( $item_id ) . ']">';
					foreach( $alignment as $key => $align ) :
					    echo '<option ' . selected( esc_attr( $edubin_menu_alignment), $key ) . ' value="' . esc_attr( $key ) . '">' . esc_html( $align ) . '</option>';
					endforeach;
                echo '</select>';
            echo '</label>';
        echo '</p>';

        echo '<p class="field-edubin_menu_custom_width description description-wide">';
            echo '<label for="edit-menu-item-edubin_menu_custom_width-' . esc_attr( $item_id ) . '">' . __( 'Width:', 'edubin-core' );
                echo '<br>';
			    echo '<input type="number" name="menu-item-edubin_menu_custom_width[' . esc_attr( $item_id ) . ']" value="' . esc_attr( $edubin_menu_custom_width ) . '">';
            echo '</label>';
            echo '<br>';
            echo '<span>' . __( 'This option won\'t work if the value of Alignment is fullwidth. The unit is in Pixel(px).', 'edubin-core' ) . '</span>';
        echo '</p>';
	}

    public static function update_custom_megamenu_options($menu_id, $menu_item_db_id, $args ) {
		$items = array( 'edubin_mega_menu', 'edubin_menu_alignment', 'edubin_menu_custom_width' );
		foreach ( $items as $item ) :
			if ( isset( $_POST['menu-item-'.$item][$menu_item_db_id] ) ) :
				$custom_value = $_POST['menu-item-'.$item][$menu_item_db_id];
				update_post_meta( $menu_item_db_id, $item, $custom_value );
            endif;
		endforeach;
    }

    public static function get_sub_megamenus() {
	   $args = array(
	      'posts_per_page'   => -1,
	      'offset'           => 0,
	      'category'         => '',
	      'category_name'    => '',
	      'orderby'          => 'post_date',
	      'order'            => 'DESC',
	      'include'          => '',
	      'exclude'          => '',
	      'meta_key'         => '',
	      'meta_value'       => '',
	      'post_type'        => 'edubin_megamenu',
	      'post_mime_type'   => '',
	      'post_parent'      => '',
	      'suppress_filters' => true 
	    );
	    return get_posts( $args );  
	}

}

Edubin_Mega_Menu::init();
