<?php
$event = new WPEMS_Event( get_the_ID() );


    echo '<div class="edubin-single-event">';
    //echo '<span>';

    if ( $start_time ) :
        echo '<span class="edubin-event-date">';
            echo '<i class="flaticon-calendar"></i>' . esc_html( wp_date( get_option( 'date_format' ), $start_time ) );
        echo '</span>';

    endif;

        echo '<span class="edubin-event-time">';
            echo '<i class="flaticon-start"></i>' . esc_html( $time_start );
        echo '</span>';

        the_title( '<h4 style="wpem-event-title"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h4>' );

        if ( $location ) :
            echo '<span class="edubin-event-location">';
                echo '<i class="flaticon-location"></i>' . esc_html( $location );
            echo '</span>';
        endif;


     //echo '</span>';
    echo '</div>';


