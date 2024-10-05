<?php
/**
 * Template part for displaying sfwd-courses content in archive.php.
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
    $style = Edubin::setting( 'ld_course_archive_style' );
endif;

if ( isset( $_GET['course_preset'] ) ) :
    $style = Filter::grid_layout_keys();
endif;

$default_data = array(
    'style' => $style
);

$edubin_course_container = array();
$masonry_status = Edubin::setting( 'ld_course_masonry' );
$wrapper = 'edubin-lms-courses-grid edubin-row edubin-course-archive';

if ( $masonry_status || isset( $_GET['masonry'] ) ) :
	$wrapper = $wrapper . ' ' . 'tpc-masonry-grid-wrapper';
    $edubin_course_container[] = 'tpc-masonry-item';
endif;

if ( ! isset( $column ) ) :
    $column = apply_filters( 'edubin_course_archive_grid_column', array( 'edubin-col-lg-6 edubin-col-md-6 edubin-col-sm-12' ) );
endif;

$edubin_course_container = array_merge( $edubin_course_container, $column );

$args = wp_parse_args( $get_options, $default_data );
if ( have_posts() ) :
	echo '<div class="' . esc_attr( $wrapper ) . '">';
        while ( have_posts() ) : the_post(); 
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'edubin_course_loop_classes', $edubin_course_container ) ); ?>>
                <?php get_template_part( 'learndash/tpl-part/th-layout/layouts', '', $args );
            echo '</div>';
        endwhile;
	echo '</div>';
else :
	get_template_part( 'template-parts/content', 'none' );
endif;
