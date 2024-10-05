<?php

$tbe_event_countdown = Edubin::setting( 'tbe_event_countdown' );
$tbe_event_cost = Edubin::setting( 'tbe_event_cost' );
$tbe_start_time = Edubin::setting( 'tbe_start_time' );
$tbe_end_time = Edubin::setting( 'tbe_end_time' );
$tbe_email = Edubin::setting( 'tbe_email' );
$tbe_phone = Edubin::setting( 'tbe_phone' );
$tbe_website = Edubin::setting( 'tbe_website' );
$tbe_organizer_ids = Edubin::setting( 'tbe_organizer_ids' );
$tbe_location = Edubin::setting( 'tbe_location' );
$tbe_event_maps = Edubin::setting( 'tbe_event_maps' ); 
$date_format = Edubin::setting( 'edubin_events_date_format' );
$time_format = Edubin::setting( 'edubin_events_time_format' );
$date_separator = Edubin::setting( 'edubin_events_date_separator' );
$time_separator = Edubin::setting( 'edubin_events_time_separator' );


$event_id = get_the_ID();
$start_date = tribe_get_start_time ( $event_id, $date_format);
$end_date = tribe_get_end_time ( $event_id, $date_format);



$start_time = tribe_get_start_date( null, false, $time_format );
$end_time = tribe_get_end_date( null, false, $time_format );


$organizer_ids = tribe_get_organizer_ids();
$multiple_organize      = count($organizer_ids) > 1;

$venue_ids = tec_get_venue_ids();
$multiple_venue      = count($venue_ids) > 1;

$phone      = tribe_get_organizer_phone();
$email      = tribe_get_organizer_email();

$website = tribe_get_event_website_link( $event_id );

echo '<div class="tpc-event-sidebar sidebar tpc-sidebar-get-sticky">';
    echo '<div class="inner">';
        echo '<div class="content">';

        if ( $tbe_event_countdown ) {
            echo '<div class="edubin-events-countdown" data-overlay="8" style="background-image: url(\'' . esc_url(get_the_post_thumbnail_url($event_id, 'thumbnail')) . '\')">'; ?>

                        <script>
                                (function($) {
                                    "use strict";
                                var timer;
                                var compareDate = new Date("<?php echo tribe_get_start_date($event_id, false, 'Y/m/d'); ?>");
                                compareDate.setDate(compareDate.getDate()); 

                                timer = setInterval(function() {
                                  timeBetweenDates(compareDate);
                                }, 1000);

                                function timeBetweenDates(toDate) {
                                  var dateEntered = toDate;
                                  var now = new Date();
                                  var difference = dateEntered.getTime() - now.getTime();

                                  if (difference <= 0) {
                                    // Timer done
                                    clearInterval(timer);
                                  } else {
                                    
                                    var seconds = Math.floor(difference / 1000);
                                    var minutes = Math.floor(seconds / 60);
                                    var hours = Math.floor(minutes / 60);
                                    var days = Math.floor(hours / 24);

                                    hours %= 24;
                                    minutes %= 60;
                                    seconds %= 60;

                                    $("#days").text(days);
                                    $("#hours").text(hours);
                                    $("#minutes").text(minutes);
                                    $("#seconds").text(seconds);
                                  }
                                }

                                })(jQuery);
                        </script>
                <?php
            echo '<div class="count-down-time">';
                echo '<div class="single-count">';
                    echo '<div class="number" id="days"></div>';
                    echo '<span class="title">' . esc_html__('Days', 'edubin') . '</span>';
                echo '</div>';
                echo '<div class="single-count">';
                    echo '<div class="number" id="hours"></div>';
                    echo '<span class="title">' . esc_html__('Hours', 'edubin') . '</span>';
                echo '</div>';
                echo '<div class="single-count">';
                    echo '<div class="number" id="minutes"></div>';
                    echo '<span class="title">' . esc_html__('Minutes', 'edubin') . '</span>';
                echo '</div>';
                echo '<div class="single-count">';
                    echo '<div class="number" id="seconds"></div>';
                    echo '<span class="title">' . esc_html__('Seconds', 'edubin') . '</span>';
                echo '</div>';
            echo '</div>';


            echo '</div>'; // End edubin-events-countdown
        }

           // echo '<h4 class="widget-title">' . esc_html__( 'Event Info', 'edubin' ) . '</h4>';


            echo '<ul class="event-meta">';
               if ( $tbe_event_cost  ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-price-tag"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap price-meta">';
                            echo '<h5 class="label">' . esc_html__( 'Event Cost', 'edubin' ) . '</h5>';
                            echo '<span class="value price">';
                                $cost = tribe_get_formatted_cost();
                                if ( $cost ) {
                                    echo esc_html( $cost );
                                } else {
                                    echo __( 'Free', 'edubin' );
                                }
                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };

              if ( $tbe_start_time ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-start"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Event Start', 'edubin' ) . '</h5>';
                            echo '<span class="value">';

                                echo esc_html( $start_date );
                                echo esc_attr( ' @ ' );
                                echo esc_html( $start_time );

                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };


             if ( $tbe_end_time ) {
                if ( $start_date  !== $end_date || $start_time !== $end_time ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-alarm-clock"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Event Ends', 'edubin' ) . '</h5>';
                            echo '<span class="value">';

                                echo esc_html( $end_date );
                                echo esc_attr( ' @ ' );
                                echo esc_html( $end_time );

                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };
            };


             if ( $tbe_phone ) {
                if ( $phone ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-phone-call"></i>';
                        echo '</div>';
                        
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Phone', 'edubin' ) . '</h5>';
                            echo '<span class="value">';

                                echo wp_kses_post( $phone );

                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };
            };



             if ( $tbe_email ) {
                if ( $email ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-message"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Email', 'edubin' ) . '</h5>';
                        
                            echo '<span class="value">';
                            
                            echo wp_kses_post( $email );
                            
                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };
              };


             if ( $tbe_website ) {
                if ( $website ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-link"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Website', 'edubin' ) . '</h5>';
                        
                            echo '<span class="value">';
                            
                            $remove_http = array("http://","https://", "www.");
                            $get_website = str_replace( $remove_http, "", $website);
                            echo wp_kses_post( $get_website );
                            
                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };
              };


            if ( $tbe_organizer_ids ) {
               if ( empty( $organizer_ids ) ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-organization"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Event Organizer', 'edubin' ) . '</h5>';
                        
                            echo '<span class="value edubin-value-block">';
                            
                            foreach ($organizer_ids as $organizer) {
                                    if (!$organizer) {
                                        continue;
                                    }
                                    echo '<span>'. tribe_get_organizer_link( $organizer ) .'</span>';
                                }

                                echo '</span>';
                        echo '</div>';
                    echo '</li>';
                };
            };

            if ( $tbe_location ) {
              if ( !empty( $venue_ids ) ) {
                    echo '<li>';
                        echo '<div class="icon-wrap">';
                            echo '<i class="flaticon-location"></i>';
                        echo '</div>';
                        echo '<div class="meta-wrap">';
                            echo '<h5 class="label">' . esc_html__( 'Event Location', 'edubin' ) . '</h5>';
                        
                            echo '<span class="value edubin-value-block">';
                            
                            foreach ($venue_ids as $venue) {
                                if (!$venue) {
                                    continue;
                                }
                                echo '<span>'. tribe_get_venue_link( $venue ) .'</span>';
                            }
                            
                            echo '</span>';
                        echo '</div>';
                    echo '</li>';
              };
            };
            echo '</ul>';

            if ($tbe_event_maps == true) : 
                echo '<div class="edubin-events-maps">';
                    if (get_post_meta(get_the_ID(), 'edubin_cmb2_tribe_events_map_html_code', true)) {
                        echo wpautop(get_post_meta(get_the_ID(), 'edubin_cmb2_tribe_events_map_html_code', true));
                    } else {
                        $map = tribe_get_embedded_map();
                        if (!empty($map)) {
                            echo '<div id="contact-map">';
                            echo '<div class="tribe-events-venue-map">';
                            // Display the map.
                            do_action('tribe_events_single_meta_map_section_start');
                            echo esc_html($map);
                            do_action('tribe_events_single_meta_map_section_end');
                            echo '</div>'; // tribe-events-venue-map
                            echo '</div>'; // contact-map
                        }
                    }
                 echo '</div>';
            endif;

            echo '<div class="edubin-events-registration-btn pt-30">';

            if (shortcode_exists('rtec-registration-form')) {
                echo '<div class="edubin-event-register-from">';
                // Notices
                echo tribe_the_notices();
                    echo do_shortcode('[rtec-registration-form]');
                echo '</div>';
            }

            echo '<div class="tribe-events-single-event-description tribe-events-content">';
                do_action('tribe_events_single_event_meta_primary_section_end');
            echo '</div>';

            echo '</div>';

           
        echo '</div>';
    echo '</div>';
echo '</div>';