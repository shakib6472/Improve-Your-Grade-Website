<?php

get_header();

$edubin_archive_page_tp_event_clm = Edubin::setting( 'edubin_archive_page_tp_event_clm' );

echo '<div class="tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
    do_action( 'edubin_before_content' );
    if ( have_posts() ) :
        echo '<div class="tpc-event-archive-wrapper edubin-row">';
            while ( have_posts() ) : the_post();
                echo '<div class="tpc-event-single-item edubin-col-lg-'. esc_attr( $edubin_archive_page_tp_event_clm ) .' edubin-col-md-6 edubin-col-sm-12" data-sal>';
                    wpems_get_template_part( 'content', 'event' );
                echo '</div>';
            endwhile;
            wp_reset_postdata();
        echo '</div>';

        edubin_numeric_pagination();
    else :
        _e( 'No Event Found.', 'edubin' );
    endif;

    do_action( 'edubin_after_content' );
echo '</div>';
    
get_footer();