<?php
/**
 * View: Default Template for Events
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/default-template.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @version 5.0.0
 */

use Tribe\Events\Views\V2\Template_Bootstrap;

get_header(); 

// Customizer option
$edubin_archive_events_layout = Edubin::setting( 'edubin_archive_events_layout' );
$events_course_per_page = Edubin::setting( 'events_course_per_page' );

$edubin_archive_page_tp_event_clm = '4';

 if ( $edubin_archive_events_layout == 'layout_2' && is_post_type_archive( 'tribe_events' ) ):

echo '<div class="tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
    do_action( 'edubin_before_content' );

    //if ( have_posts() ) :
        echo '<div class="tpc-event-archive-wrapper edubin-row">';

            $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $posts_query = new WP_Query(
            array(
                'post_type' => 'tribe_events',
                'post_status' => 'publish',
                'posts_per_page' => $events_course_per_page,
                'paged' => $paged
            ) ); 

            if ( $posts_query->have_posts() ) :

                while ( $posts_query->have_posts() ) :
                    $posts_query->the_post(); 

                    echo '<div class="tpc-event-single-item edubin-col-lg-'. esc_attr( $edubin_archive_page_tp_event_clm ) .' edubin-col-md-6 edubin-col-sm-12" data-sal>';
                        get_template_part( 'tribe/tpl-part/layout', '1');   
                    echo '</div>';

                endwhile;

            else :
                _e( 'No Event Found.', 'edubin' );
            endif;

            wp_reset_postdata();

        echo '</div>';

  
                
        $total_pages = $posts_query->max_num_pages;

        if ( $total_pages > 1) {

            $current_page = max(1, get_query_var("paged"));

            echo '<nav class="edubin-pagination-wrapper tpc-custom-pagination">';
                echo '<div class="page-number">';
                    echo paginate_links(array(
                        "base" => get_pagenum_link(1) . "%_%",
                        "format" => "page/%#%",
                        "current" => $current_page,
                        "total" => $total_pages,
                        'prev_text' => '<i class="edubin-pagination-icon flaticon-back-1" aria-hidden="true"></i>',
                        'next_text' => '<i class="edubin-pagination-icon flaticon-next" aria-hidden="true"></i>',
                    ));
                echo '</div>';
            echo '</nav>';
        }

    do_action( 'edubin_after_content' );

echo '</div>';


    else :
        // Get default plugin template
        echo tribe( Template_Bootstrap::class )->get_view_html();

    endif;

get_footer();

