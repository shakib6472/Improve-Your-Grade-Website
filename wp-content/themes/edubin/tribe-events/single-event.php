<?php

defined( 'ABSPATH' ) || exit;

get_header();

$tbe_event_countdown = Edubin::setting( 'tbe_event_countdown' );

$edubin_tribe_events_video = get_post_meta( get_the_ID(), 'edubin_tribe_events_video', true);

echo '<div class="tpc-event-details tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
    echo '<div class="edubin-main-content-inner">';

            $tpc_tp_content_column = 'edubin-col-lg-8';


            echo '<div class="tpc-event-contaner-wrapper">';
                echo '<div class="edubin-row">';
                    echo '<div class="' . esc_attr( $tpc_tp_content_column ) . '">';

                        $edubin_tribe_events_video = get_post_meta( get_the_ID(), 'edubin_tribe_events_video', true);

                        if ( $edubin_tribe_events_video ) : 

                            echo '<div class="intro-video-sidebar intro-video-content main-thumbnail">';  
                                echo '<div class="intro-video-content">';  
                                    echo '<div class="intro-video" style="background-image: url(' . esc_url( get_the_post_thumbnail_url(get_the_ID(),'full') ) . ')">';

                                        echo '<a href="' . esc_url( $edubin_tribe_events_video ) . '" class="edubin-popup-videos bla-2">';
                                            echo '<i class="flaticon-play-button"></i>';
                                        echo '</a>';

                                    echo '</div>';   
                                echo '</div>';   
                            echo '</div>'; // End intro-video-sidebar
                           
                        elseif( has_post_thumbnail() ) : 

                            echo '<div class="main-thumbnail">';
                                echo tribe_event_featured_image( get_the_ID(), 'full', false);
                            echo '</div>';

                        endif;

                        do_action( 'tribe_events_single_event_before_the_content' ); 

                        the_content();

                        do_action( 'tribe_events_single_event_after_the_content' );

                    echo '</div>';
                
                   // if ( $edubin_single_tp_event_sidebar ) :
                        echo '<div class="edubin-col-lg-4">';

                            get_template_part( 'tribe/tpl-part/sidebar' );

                        echo '</div>';
                    //endif;


                echo '</div>';
                
                // if ( $edubin_single_tp_event_speaker ) :
                //     wpems_get_template_part( 'tpl-part/event', 'speaker' );
                // endif;

                // if ( $edubin_single_tp_event_comment && ( comments_open() || get_comments_number() ) ) :
                //     comments_template();
                // endif;

                if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template();

            echo '</div>';

    echo '</div>';
echo '</div>';

get_footer();