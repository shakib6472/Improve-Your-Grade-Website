<?php
defined( 'ABSPATH' ) || exit;

// return if it's not an admin page.
if ( ! is_admin() ) :
	return;
endif;

/**
 * Enqueue Admin scripts and styles.
 */
function edubin_admin_scripts() {
	wp_enqueue_style( 'edubin-admin', get_template_directory_uri() . '/assets/css/admin-main.css', array(), EDUBIN_THEME_VERSION );

	wp_add_inline_style( 'edubin-admin', html_entity_decode( edubin_theme_base_css(), ENT_QUOTES ) );
}

add_action( 'admin_enqueue_scripts', 'edubin_admin_scripts' );

function edubin_admin_classes( $classes ) {
    $classes .= ' edubin-admin-wrapper ';
    return $classes;
}

add_filter( 'admin_body_class', 'edubin_admin_classes' );