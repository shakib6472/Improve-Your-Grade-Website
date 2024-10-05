<?php

$show_event_excerpt = Edubin::setting( 'show_event_excerpt' );
$tbe_price = Edubin::setting( 'tbe_price' );
$show_event_date = Edubin::setting( 'show_event_date' );
$show_event_vanue = Edubin::setting( 'show_event_vanue' );
$events_columns = Edubin::setting( 'events_columns' );


$date_format = Edubin::setting( 'edubin_events_date_format' );
$time_format = Edubin::setting( 'edubin_events_time_format' );
$date_separator = Edubin::setting( 'edubin_events_date_separator' );
$time_separator = Edubin::setting( 'edubin_events_time_separator' );

$event_id = get_the_ID();
$start_date = tribe_get_start_time ( $event_id, $date_format);
$end_date = tribe_get_end_time ( $event_id, $date_format);

$start_time = tribe_get_start_date( null, false, $time_format );
$end_time = tribe_get_end_date( null, false, $time_format );

$event_vanue = tribe_get_venue();

$organizer_ids = tribe_get_organizer_ids();
$multiple      = count($organizer_ids) > 1;

$edubin_tribe_event_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'edubin-post-thumb' );
if ( isset( $edubin_tribe_event_thumb_src ) && ! empty( $edubin_tribe_event_thumb_src ) ) :
    $edubin_tribe_event_thumb_url = $edubin_tribe_event_thumb_src[0];
else :
    $edubin_tribe_event_thumb_url = '';
endif;

echo '<div class="tpc-event-item tpc-event-style-2">';
    echo '<div class="inner">';
        if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
            echo '<div class="thumbnail">';
                echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                    echo '<img src="' . esc_url( $edubin_tribe_event_thumb_url ). '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '" >';
                echo '</a>';

            if ( $show_event_date ) :
                echo '<div class="event-time">';
                    echo '<span><i class="flaticon-time"></i>' . esc_html( $start_date) . '</span>';
                echo '</div>';
            endif;

            echo '</div>';
        endif;

        echo '<div class="content">';

            $cost = tribe_get_formatted_cost();

            if ( $tbe_price ) :
                echo '<div class="event-date">';
                   
                   if ( $cost ) {
                       echo esc_html( $cost );
                   } else {
                      echo __( 'Free', 'edubin' );
                   }
                echo '</div>';
            endif;

        the_title( '<h5 class="event-title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h5>' );

        if ( $show_event_excerpt ) :
            echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), 15 ) );
        endif;

        if ( $show_event_vanue && !empty( $organizer_ids ) ) :

            foreach ( $organizer_ids as $organizer ) {

                if (!$organizer) {
                    continue;
                }

            if ( tribe_get_organizer_link( $organizer ) ) {

                echo '<div class="edubin-event-meta">';
                    echo '<span class="course-enroll"><i class="flaticon-location"></i>'. tribe_get_organizer_link( $organizer ) .'</span>';
                echo '</div>';
            }

            } // End foreach

        endif;

        echo '</div>';

    echo '</div>';
echo '</div>';