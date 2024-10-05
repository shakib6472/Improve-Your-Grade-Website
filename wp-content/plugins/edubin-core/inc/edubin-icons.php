<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// ENQUEUE // Enqueueing Frontend stylesheet and scripts.
add_action( 'elementor/editor/after_enqueue_scripts', 'edubin_elementor_icons_css' );
// FRONTEND // After Elementor registers all styles.
add_action( 'elementor/frontend/after_register_styles', 'edubin_elementor_icons_css' );
// EDITOR // Before the editor scripts enqueuing.
add_action( 'elementor/editor/before_enqueue_scripts', 'edubin_elementor_icons_css' );
	
/**
 * Enqueueing icons
 */
if ( ! function_exists( 'edubin_elementor_icons_css' ) ) :
	function edubin_elementor_icons_css() {
		wp_enqueue_style( 'edubin-custom-icons' );
	}
endif;


add_filter( 'elementor/icons_manager/additional_tabs', 'edubin_elementor_custom_icons_tab' );
if ( ! function_exists( 'edubin_elementor_custom_icons_tab' ) ) :
	function edubin_elementor_custom_icons_tab( $tabs = array() ) {

		/*
		 * Edubin Custom Icons
		 */
		$edubin_custom_icons   = [];
		$custom_icons_pack = include EDUBIN_PLUGIN_DIR . '/assets/custom-icons/custom-icons.php';

		foreach ( $custom_icons_pack as $education_icon ) :
		    $edubin_custom_icons[] = $education_icon;
		endforeach;

		$tabs['edubin-custom-icons'] = array(
			'name'          => 'edubin-custom-icons',
			'label'         => __( 'Edubin Icons', 'edubin-core' ),
			'labelIcon'     => 'edubin flaticon-star',
			'prefix'        => 'flaticon-',
			'displayPrefix' => 'edubin',
			'url'           => get_template_directory_uri() . '/assets/fonts/flaticon_edubin.css',
			'icons'         => $edubin_custom_icons,
			'ver'           => '1.0.0'
		);

		return $tabs;
	}
endif;