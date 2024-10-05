<?php
/**
 * The template for displaying sensei lms archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Edubin
 */

get_header();

echo '<div class="tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
    do_action( 'edubin_before_content' );

    echo '<div id="primary" class="edubin-' . get_post_type() . '-archive-wrapper content-area edubin-col-lg-12' . '">';
        echo '<main id="main" class="site-main">';
            if ( 'course' === get_post_type() ) :
                get_template_part( 'sensei/tpl-part/content', 'course' );
            endif;
        echo '</main>';
    echo '</div>';

    do_action( 'edubin_after_content' );
echo '</div>';

get_footer();