<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

    $video = tutor_utils()->get_video();
    $videoSource    = tutor_utils()->avalue_dot( 'source', $video );

    if (! empty( $video['source_youtube'] ) && $videoSource == 'youtube') {
        $tutor_intro_video_url =    $video["source_youtube"];
    }
    elseif(! empty( $video['source_vimeo'] ) && $videoSource == 'vimeo'){
        $tutor_intro_video_url =    $video["source_vimeo"];
    }
    else{
        $tutor_intro_video_url =    '';
    }

echo '<div class="edubin-course layout__' . esc_attr( $get_options['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $get_options['show_media'] ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                    if ( $get_options['show_wishlist'] ) {
                         edubin_tutor_wishlist_icon( get_the_ID() );
                    }

                echo '</div>';

            if ( $get_options['show_title'] ) {
                echo '<div class="top--title">';
                     echo edubin_get_title();
                echo '</div>';
            }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

           if ( $get_options['show_review'] ) :
                echo '<div class="edubin-course-rate">';
                     echo '<div class="course-rating">';

                     $course_rating  = tutor_utils()->get_course_rating( get_the_ID() );

                     echo '<div class="edubin-rating-wrap">';

                         echo '<span class="edubin-ratings-stars">';
                              echo tutor_utils()->star_rating_generator_v2( $course_rating->rating_avg, null, false, '', 'lg' );
                        echo '</span>';

                         echo '<span class="edubin-ratings-total">';
                             $total_text = ('1' == $course_rating) ? esc_html__(' Review', 'edubin') : esc_html__(' Reviews', 'edubin');
                             echo esc_attr(' (');
                            echo esc_html( apply_filters( 'tutor_course_rating_average', $course_rating->rating_avg ) );
                             echo esc_attr('/');
                             echo esc_html( $course_rating->rating_count > 0 ? $course_rating->rating_count : 0 );
                            if ($tutor_review_text_show) {
                                echo esc_html($total_text);
                            }
                             echo esc_attr(')');
                        echo '</span>';

                     echo '</div>'; // End .edubin-rating-wrap
                     
                     echo '</div>';
                echo '</div>';
          endif;

          if ( $get_options['show_excerpt'] ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length'] ), esc_html( $get_options['excerpt_end'] ) ) );
                echo '</div>';
         endif;
            
            if ( $get_options['show_author_img'] || $get_options['show_author_name']): 
                 echo '<div class="author__name tpc_mt_15">';
                    if ( $get_options['show_author_img'] ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $get_options['show_author_name'] ) {
                        the_author();
                    }  
                 echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $get_options['show_price'] ) {
                    echo '<div class="course__meta-left">';

                        if ($get_options['show_price']) {
                            echo '<div class="course__meta-right">';
                                echo '<div class="price__1">';
                                        get_template_part( 'tutor/tpl-part/price');
                                echo '</div>';
                            echo '</div>';
                        }

                    echo '</div>';
                }

                    // if ( $get_options['tutor_see_more_btn'] ) {
                    //     echo '<div class="course__meta-right">';
                    //         echo '<div class="view-more-btn">';
                    //             if ($get_options['tutor_see_more_btn']) {
                    //                 echo '<a href="' . esc_url( get_permalink() ) . '">'. $get_options['tutor_see_more_btn_text'] .'</a>';
                    //             } else {
                    //                 echo '<a href="' . esc_url( get_permalink() ) . '">'. esc_html__('View Details', 'edubin').'</a>';
                    //             }   
                    //         echo '</div>';
                    //     echo '</div>';
                    // }

                echo '</div>';
        echo '</div>';
    echo '</div>';


echo '</div>';