<?php
/**
 * The template for displaying archive pages
 * @package Edubin
 * Version: 1.0.0
 */

get_header(); 
echo '<div class="tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
	do_action( 'edubin_before_content' );
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();
                echo '<div class="edubin-col-lg-12">';
                    the_title();
                echo '</div>';
            endwhile;
            the_posts_pagination();
        else :
            _e( 'Sorry, No Course Found.', 'edubin' );
        endif;
echo '</div>';

get_footer();
