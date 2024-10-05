<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__5 review__show col__3">';
    echo '<div class="course__container">';
        if ( $get_options['show_media'] ) {
            echo '<div class="course__media">';

                    $edubin_ms_video = get_post_meta(get_the_ID(), 'edubin_ms_video', 1); 

                    if ( !empty( $edubin_ms_video ) && $get_options['show_intor_video'] ) : 

                        echo '<div class="intro-video-sidebar">';
                            echo '<div class="intro-video" style="background-image:url('. esc_url( $get_options['thumb_url'] ) .')">';
                                echo '<a href="' . esc_url( $edubin_ms_video ) . '" class="edubin-popup-videos bla-2"><i class="flaticon-play-button"></i></a>';
                            echo '</div>';
                        echo '</div>';
                   
                    else :

                    echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                        echo '<img class="w-100" src="' . esc_url( $get_options['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
                    echo '</a>';

                   endif;

                if ( $get_options['show_title'] && !empty( get_the_term_list(get_the_ID(), 'stm_lms_course_taxonomy') )) {
                    echo '<div class="course__categories">';
                        echo get_the_term_list(get_the_ID(), 'stm_lms_course_taxonomy');
                    echo '</div>';
                }

                 if ( $get_options['show_price'] ) {
                    echo '<div class="price__2">';
                       Edubin_MS_LMS_Price::course_price();
                    echo '</div>';
                }
     
                echo '<div class="course__content--meta layout__5">';

                     if ( $get_options['show_author_img'] || $get_options['show_author_name'] ): 
                        
                       echo '<div class="author__name">';
                       if ( $get_options['show_author_img'] ) {
                               echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                       } 
                       if ( $get_options['show_author_name'] ) {
                            the_author();
                       }  
                     echo '</div>';

                    endif;

                    if ( function_exists( 'edubin_ms_course_rating' ) && $get_options['show_review'] ) :
                       echo '<div class="edubin-course-rate">';
                                edubin_ms_course_rating( 'text' );
                        echo '</div>';
                    endif;

                  echo '</div>';
                echo '</div>';

                echo '<div class="course__content">';
                  echo '<div class="course__content--info">';

                    if ( $get_options['show_title'] ) {
                        echo '<div class="course__title--info">';
                            echo edubin_get_title();
                        echo '</div>';
                    }
                    
                    if ( $get_options['show_excerpt'] ) :
                        echo '<div class="course-excerpt course-excerpt-grid">';
                            echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length'] ), esc_html( $get_options['excerpt_end'] ) ) );
                        echo '</div>';
                    endif;

                echo '</div>';
            echo '</div>';
        }
    echo '</div>';
echo '</div>';

