<?php
/**
 * The template for displaying LearnDashh category page template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edubin
 */
get_header();
use \Edubin\Filter;

if ( ! isset( $get_options ) ) :
    $get_options = array();
endif;

if ( ! isset( $style ) ) :
    $style = Edubin::setting('ld_course_archive_style');
endif;

if ( isset( $_GET['course_preset'] ) ) :
    $style = Filter::grid_layout_keys();
endif;

$default_data = array(
    'style' => $style
);

$edubin_course_container = array();

if ( ! isset( $column ) ) :
    $column = apply_filters( 'edubin_course_archive_grid_column', array( 'edubin-col-lg-4 edubin-col-md-6 edubin-col-sm-12' ) );
endif;

$edubin_course_container = array_merge( $edubin_course_container, $column );
$args = wp_parse_args( $get_options, $default_data );

echo '<div class="site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
    do_action( 'edubin_before_content' );
    echo '<div id="primary" class="edubin-' . get_post_type() . '-archive-wrapper content-area ' . esc_attr( apply_filters( 'edubin_content_area_class', 'edubin-col-lg-8' ) ) . '">';
        echo '<main id="main" class="site-main">';
            if ( have_posts() ) :
                echo '<div class="edubin-lms-courses-grid edubin-row edubin-course-archive">';
                    while ( have_posts() ) : the_post(); 
                        ?>
                        <div id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'edubin_course_loop_classes', $edubin_course_container ) ); ?> data-sal>
                            <?php get_template_part( 'learndash/tpl-part/course/th-layouts', '', $args );
                        echo '</div>';
                    endwhile;
                    wp_reset_postdata();
                echo '</div>';
            else :
                _e( 'Sorry, No Course Found.', 'edubin' );
            endif;
        echo '</main>';
    echo '</div>';
    do_action( 'edubin_after_content' );
echo '</div>';

get_footer();