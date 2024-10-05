<?php
/**
 * Template part for displaying course content in archive.php.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edubin
 * @since   1.0.0
 */
defined( 'ABSPATH' ) || exit();
use \Edubin\Filter;

if ( ! isset( $get_options ) ) :
    $get_options = array();
endif;

if ( ! isset( $style ) ) :
    $style = Edubin::setting( 'sensei_course_archive_style' );
endif;

if ( isset( $_GET['course_preset'] ) ) :
    $style = Filter::grid_layout_keys();
endif;

$default_data = array(
    'style' => $style
);

$edubin_course_container = array();
$masonry_status = Edubin::setting( 'sensei_course_masonry_layout' );
$wrapper = 'edubin-lms-courses-grid edubin-row edubin-course-archive';

if ( $masonry_status || isset( $_GET['masonry'] ) ) :
	$wrapper = $wrapper . ' ' . 'tpc-masonry-grid-wrapper';
    $edubin_course_container[] = 'tpc-masonry-item';
endif;

if ( ! isset( $column ) ) :
    $column = apply_filters( 'edubin_course_archive_grid_column', array( 'edubin-col-lg-4 edubin-col-md-6 edubin-col-sm-12' ) );
endif;

$edubin_course_container = array_merge( $edubin_course_container, $column );

$query_args = array( 
    'post_type' => 'course',
    'order' => 'DESC',
    'paged' => get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1,
    'posts_per_page' => Edubin::setting( 'sensei_course_per_page' ) ? Edubin::setting( 'sensei_course_per_page' ) : 9
);

$query_args = apply_filters( 'edubin_sensei_course_archive_args', $query_args );

$fetch_query = new WP_Query( $query_args );

$args = wp_parse_args( $get_options, $default_data );
if ( $fetch_query->have_posts() ) :
	echo '<div class="' . esc_attr( $wrapper ) . '">';
        while ( $fetch_query->have_posts() ) : $fetch_query->the_post(); 
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'edubin_course_loop_classes', $edubin_course_container ) ); ?> data-sal>
                <?php get_template_part( 'sensei/tpl-part/course/course-layouts', '', $args );
            echo '</div>';
        endwhile;
        wp_reset_postdata();
	echo '</div>';
    
    $GLOBALS['wp_query']->max_num_pages = $fetch_query->max_num_pages;
    edubin_numeric_pagination();
else :
	_e( 'Sorry, No Course Found.', 'edubin' );
endif;
