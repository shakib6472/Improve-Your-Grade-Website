<?php

$tpc_tp_event_speakers = get_the_terms( get_the_ID(), 'tp_event_speaker' );

if ( is_array( $tpc_tp_event_speakers ) ) :
    echo '<div class="tpc-event-speaker-section">';

        echo '<h3 class="heading-title">' .  __( 'Event Speakers', 'edubin' ) . '</h3>';
        
        echo '<div class="edubin-row">';
            foreach ( $tpc_tp_event_speakers as $key => $term ) :
                $designation = get_term_meta( $term->term_id, 'edubin_tp_event_speaker_designation', true );
                $image_url   = get_term_meta( $term->term_id, 'edubin_tp_event_speaker_image', true );
                $fb_profile  = get_term_meta( $term->term_id, 'edubin_tp_event_speaker_fb_profile', true );
                $tw_profile  = get_term_meta( $term->term_id, 'edubin_tp_event_speaker_tw_profile', true );
                $lk_profile  = get_term_meta( $term->term_id, 'edubin_tp_event_speaker_lk_profile', true );
                echo '<div class="edubin-team-1-widget edubin-slider-item edubin-col-lg-3">';
                    echo '<div class="edubin-teacher-item edubin-teacher-style-2">';

                        if ( $image_url ) :
                            echo '<div class="teacher-img-wrap">';
                                echo '<a href="#" target="_blank">';
                                    echo '<div class="teacher-img">';
                                        echo '<img src="' . esc_url( $image_url ) . '" alt="">';
                                    echo '</div>';
                                echo '</a>';

                                if ( $fb_profile || $tw_profile || $lk_profile ) :
                                    echo '<div class="teacher-social">';
                                        if ( $fb_profile ) :
                                            echo '<a class="social-link" href="' . esc_url( $fb_profile ) . '" target="_blank">';
                                                echo '<i class="flaticon-facebook-logo" aria-hidden="true"></i>';
                                            echo '</a>';
                                        endif;

                                        if ( $tw_profile ) :
                                            echo '<a class="social-link" href="' . esc_url( $tw_profile ) . '" target="_blank">';
                                                echo '<i class="flaticon-twitter" aria-hidden="true"></i>';
                                            echo '</a>';
                                        endif;

                                        if ( $lk_profile ) :
                                            echo '<a class="social-link" href="' . esc_url( $lk_profile ) . '" target="_blank">';
                                                echo '<i class="flaticon-linkedin" aria-hidden="true"></i>';
                                            echo '</a>';
                                        endif;
                                    echo '</div>';
                                endif;
                            echo '</div>';
                        endif;

                        echo '<div class="teacher-content">';
                            if ( $term->name ) :
                                echo '<h5 class="title">';
                                    echo '<a href="#" target="_blank">' . esc_html( $term->name ) . '</a>';
                                echo '</h5>';
                            endif;

                            if ( $designation ) :
                                echo '<span class="teacher-degree">' . esc_html( $designation ). '</span>';
                            endif;
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            endforeach;
        echo '</div>';

    echo '</div>';
endif;