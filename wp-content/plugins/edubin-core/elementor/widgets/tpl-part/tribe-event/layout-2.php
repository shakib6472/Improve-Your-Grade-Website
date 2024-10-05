<?php


echo '<div class="inner">';
    if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
        echo '<div class="thumbnail">';
            echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                echo $this->render_image( get_post_thumbnail_id( get_the_id() ), $settings ); 
            echo '</a>';

            if ( $time_on_off && $label_on_off != 'yes' ) :
                echo '<div class="event-time">';
                    echo '<span><i class="flaticon-time"></i>' . esc_html( $formatted_start_time . ' - ' . $formatted_end_time ) . '</span>';
                echo '</div>';
            endif;
            if ( $label_on_off == 'yes' ) :
                echo '<div class="event-label">';
                    echo '<span>' . esc_html( $label_text ) . '</span>';
                echo '</div>';
            endif;


        echo '</div>';
    endif;

    echo '<div class="content">';
        echo '<div class="event-date">';
        
            // printf( '%s', $event->is_free() ? __( 'Free', 'edubin' ) : tribe_get_formatted_cost( $event->tribe_get_formatted_cost() ) );
            $event_cost = tribe_get_formatted_cost($event);
            if (empty($event_cost)) {
                echo 'Free';
            } else {
                echo esc_html($event_cost);
            }
        echo '</div>';

        the_title( '<h4 class="event-title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h4>' );

        if ( $settings['enable_excerpt'] === 'yes' ) : 
            echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $settings['excerpt_length'] ), esc_html( $settings['excerpt_end'] ) ) );
        endif;

        if ( $event_vanue ) :
            
            echo '<div class="edubin-event-meta">';
                echo '<span class="course-enroll"><i class="flaticon-location"></i>'. esc_html( $event_vanue ).'</span>';
            echo '</div>';

        endif;
        

    echo '</div>';
echo '</div>';