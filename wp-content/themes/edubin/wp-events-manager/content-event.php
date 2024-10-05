<?php
/**
 * The Template for displaying content events.
 *
 * Override this template by copying it to yourtheme/wp-events-manager/content-event.php
 *
 * @author        ThimPress, leehld
 * @package       WP-Events-Manager/Template
 * @version       2.1.7
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$edubin_archive_tp_event_date = Edubin::setting( 'edubin_archive_tp_event_date' );
$edubin_archive_tp_event_price = Edubin::setting( 'edubin_archive_tp_event_price' );
$edubin_archive_tp_event_excerpt = Edubin::setting( 'edubin_archive_tp_event_excerpt' );

$event           = new WPEMS_Event( get_the_ID() );

$edubin_tp_event_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'edubin-post-thumb' );
if ( isset( $edubin_tp_event_thumb_src ) && ! empty( $edubin_tp_event_thumb_src ) ) :
    $edubin_tp_event_thumb_url = $edubin_tp_event_thumb_src[0];
else :
    $edubin_tp_event_thumb_url = '';
endif;

$tpc_tp_event_start_time = get_post_meta( get_the_ID(), 'tp_event_date_start', true ) ? strtotime( get_post_meta( get_the_ID(), 'tp_event_date_start', true ) ) : '';
$tpc_tp_event_location = get_post_meta( get_the_ID(), 'tp_event_location', true ) ? get_post_meta( get_the_ID(), 'tp_event_location', true ) : '';
$tpc_tp_event_time_start = wpems_event_start( get_option( 'time_format' ) );
$tpc_tp_event_time_end   = wpems_event_end( get_option( 'time_format' ) );
$tpc_tp_event_starting_date   = wp_date( 'F j, Y', $tpc_tp_event_start_time );
$tpc_tp_event_start_date   = explode( '/', $tpc_tp_event_starting_date );

echo '<div class="tpc-event-item tpc-event-style-2">';
    echo '<div class="inner">';
        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
            echo '<div class="thumbnail">';
                echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                    echo '<img src="' . esc_url( $edubin_tp_event_thumb_url ). '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '" >';
                echo '</a>';

                if ( $tpc_tp_event_start_time && $edubin_archive_tp_event_date ) :
                    echo '<div class="event-time">';
                        echo '<span><i class="flaticon-time"></i>' . esc_html( $tpc_tp_event_starting_date) . '</span>';
                    echo '</div>';
                endif;
            echo '</div>';
        endif;

        echo '<div class="content">';

            if ( $edubin_archive_tp_event_price ) :
                echo '<div class="event-date">';
                    printf( '%s', $event->is_free() ? __( 'Free', 'edubin' ) : wpems_format_price( $event->get_price() ) );
                echo '</div>';
            endif;

            the_title( '<h5 class="event-title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );

            if ( $edubin_archive_tp_event_excerpt ) :
                echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), 15 ) );
            endif;

            if ( $tpc_tp_event_location ) :

                echo '<div class="edubin-event-meta">';
                    echo '<span class="course-enroll"><i class="flaticon-location"></i>'. esc_html( $tpc_tp_event_location ).'</span>';
                echo '</div>';

            endif;

        echo '</div>';
    echo '</div>';
echo '</div>';