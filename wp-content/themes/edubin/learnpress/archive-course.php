<?php
/**
 * Template for displaying content of single course.
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 4.0.0
 */

use \Edubin\Filter;
get_header();

if ( ! isset( $layout_data ) ) :
    $layout_data = array();
endif;

if ( ! isset( $style ) ) :
    $style = Edubin::setting( 'lp_course_archive_style' );
endif;

if ( isset( $_GET['course_preset'] ) ) :
    $style = Filter::grid_layout_keys();
endif;

$default_data = array(
    'style' => $style
);

$layout_data = wp_parse_args( $layout_data, $default_data );

$edubin_course_container = array();
$masonry_status =  Edubin::setting( 'lp_course_masonry_layout' );
$wrapper = 'edubin-lms-courses-grid edubin-row edubin-course-archive';

if ( $masonry_status || isset( $_GET['masonry'] ) ) :
	$wrapper = $wrapper . ' ' . 'tpc-masonry-grid-wrapper';
    $edubin_course_container[] = 'tpc-masonry-item';
endif;

if ( ! isset( $column ) ) :
    $column = apply_filters( 'edubin_course_archive_grid_column', array( 'edubin-col-lg-4 edubin-col-md-6 edubin-col-sm-12' ) );
endif;

if ( isset( $_GET['column'] ) ) :
    if ( $_GET['column'] == 2 ) :
        $column = array( 'edubin-col-lg-6 edubin-col-md-6 edubin-col-sm-12' );
    endif;
endif;

$edubin_course_container[] = 'edubin-course-style-' . esc_attr( $style );

$edubin_course_container = array_merge( $edubin_course_container, $column );

$args = array( 
    'post_type'      => LP_COURSE_CPT,
    'order'          => 'DESC',
    'paged'          => get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1,
    'posts_per_page' => LP()->settings->get( 'learn_press_archive_course_limit' ) 
);

$args = apply_filters( 'edubin_lp_course_archive_args', $args );
$query = new WP_Query( $args );

echo '<div class="tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
	do_action( 'edubin_before_content' );

    edubin_lp_course_header_top_bar( $query );

    if ( $query->have_posts() ) :
        echo '<div class="' . esc_attr( $wrapper ) . '">';
            while ( $query->have_posts() ) : $query->the_post(); ?>
                <div id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'edubin_course_loop_classes', $edubin_course_container ) ); ?> data-sal>
                    <?php
                        learn_press_get_template( 'tpl-part/course/th-layouts.php', compact( 'layout_data' ) );
                    ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        echo '</div>';
        
        $GLOBALS['wp_query']->max_num_pages = $query->max_num_pages;
        edubin_numeric_pagination();
    else :
        _e( 'Sorry, No Course Found.', 'edubin' );
    endif;

    do_action( 'edubin_after_content' );
echo '</div>';

get_footer();