<?php



    echo '<div class="edubin-single-event">';
    //echo '<span>';

    if ( $start_time ) :
        echo '<span class="edubin-event-date">';
            echo '<i class="flaticon-calendar"></i>' . $formatted_start_date;
        echo '</span>';

    endif;

        echo '<span class="edubin-event-time">';
            echo '<i class="flaticon-start"></i> ';
            echo $start_time;                                        
            echo esc_attr( $separator_time );
            echo $end_time;
         
            
        echo '</span>';

        the_title( '<h4 style="wpem-event-title"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h4>' );

        if ( $event_vanue ) :
            echo '<span class="edubin-event-location">';
                echo '<i class="flaticon-location"></i>' . esc_html( $event_vanue );
            echo '</span>';
        endif;


     //echo '</span>';
    echo '</div>';


