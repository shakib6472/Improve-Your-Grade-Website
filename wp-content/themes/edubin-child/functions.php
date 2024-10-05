<?php

function edubin_child_enqueue_styles() {
	wp_enqueue_style( 'edubin-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'edubin_child_enqueue_styles', 100 );