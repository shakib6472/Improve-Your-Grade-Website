<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Edubin
 */

if ( 'sfwd-courses' === get_post_type() ) :
	get_template_part( 'learndash/tpl-part/single/content', 'sfwd-courses' );
	return;
elseif( 'course' === get_post_type() && class_exists('Sensei_Main' ) ) :
	get_template_part( 'sensei/tpl-part/single/single');
	return;
elseif( 'course' === get_post_type() && class_exists('LifterLMS' ) ) :
	get_template_part( 'lifterlms/tpl-part/single/single');
	return;
elseif( is_singular( edubin_header_footer_blank_single_post_array() ) ) :
	get_template_part( 'template-parts/single', 'header-blank' ); 
	return;
endif;

get_header();

$single_layout = apply_filters( 'edubin_single_sidebar_layout', Edubin::setting( 'blog_single_sidebar' ) );
echo '<div class="tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
	do_action( 'edubin_before_content' );

	echo '<div id="primary" class="content-area ' . esc_attr( apply_filters( 'edubin_content_area_class', 'edubin-col-lg-9' ) ) . '">';
		echo '<main id="main" class="site-main tpc-post-details-page">';
			if ( 'simple_team' === get_post_type() ) :
				get_template_part( 'template-parts/single/content', 'simple_team' );
			else :
				get_template_part( 'template-parts/single', 'post' );
			endif;
		echo '</main>';
	echo '</div>';
	if ( 'no-sidebar' !== $single_layout && 'simple_team' !== get_post_type() ) :
		get_sidebar();
	endif;
	
	do_action( 'edubin_after_content' );
echo '</div>';

get_footer();