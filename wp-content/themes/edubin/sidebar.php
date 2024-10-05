<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Edubin
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar = apply_filters( 'edubin_get_sidebar', 'sidebar-default' );

if ( ! is_active_sidebar( $sidebar ) || isset( $_GET['sidebar_disable'] ) ) :
	return;
endif;

echo '<aside id="secondary" class="widget-area tpc-sidebar-widget ' . esc_attr( apply_filters( 'edubin_get_widget_class', 'edubin-col-lg-3' ) ) . '">';
	echo '<div class="widget-area-wrapper ' . esc_attr( apply_filters( 'edubin_get_widget_sticky_class', 'no-sticky' ) ) . '">';
		do_action( 'edubin_sidebar_before' );
		dynamic_sidebar( $sidebar );
		do_action( 'edubin_sidebar_after' );
	echo '</div>';
echo '</aside>';