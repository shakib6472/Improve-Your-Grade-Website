<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

    $tutor_archive_media_show = Edubin::setting( 'tutor_archive_media_show' );
    $tutor_archive_title_show = Edubin::setting( 'tutor_archive_title_show' );
    $tutor_excerpt_show = Edubin::setting( 'tutor_excerpt_show' );
    $tutor_cat_show = Edubin::setting( 'tutor_cat_show' );
    $tutor_wishlist_show = Edubin::setting( 'tutor_wishlist_show' );
    $tutor_instructor_img_on_off = Edubin::setting( 'tutor_instructor_img_on_off' );
    $tutor_instructor_name_on_off = Edubin::setting( 'tutor_instructor_name_on_off' );
    $tutor_lesson_show = Edubin::setting( 'tutor_lesson_show' );
    $tutor_lesson_text_show = Edubin::setting( 'tutor_lesson_text_show' );
    $tutor_price_show = Edubin::setting( 'tutor_price_show' );
    $tutor_enroll_show = Edubin::setting( 'tutor_enroll_show' );
    $tutor_enroll_text_show = Edubin::setting( 'tutor_enroll_text_show' );
    $tutor_review_show = Edubin::setting( 'tutor_review_show' );
    $tutor_review_text_show = Edubin::setting( 'tutor_review_text_show' );
    $tutor_level_show = Edubin::setting( 'tutor_level_show' );
    $tutor_see_more_btn = Edubin::setting( 'tutor_see_more_btn' );
    $tutor_see_more_btn_text = Edubin::setting( 'tutor_see_more_btn_text' );
    $tutor_intro_video = Edubin::setting( 'tutor_intro_video' );
    $tutor_quiz_show = Edubin::setting( 'tutor_quiz_show' );
    $tutor_quiz_text_show = Edubin::setting( 'tutor_quiz_text_show' );


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

        if ( $tutor_archive_media_show ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                    if ( $tutor_wishlist_show ) {
                         edubin_tutor_wishlist_icon( get_the_ID() );
                    }

                echo '</div>';

            if ( $tutor_archive_title_show ) {
                echo '<div class="top--title">';
                     echo edubin_get_title();
                echo '</div>';
            }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

           if ( $tutor_review_show ) :
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

          if ( $tutor_excerpt_show ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length'] ), esc_html( $get_options['excerpt_end'] ) ) );
                echo '</div>';
         endif;
            
            if ( $tutor_instructor_img_on_off || $tutor_instructor_name_on_off): 
                 echo '<div class="author__name tpc_mt_15">';
                    if ( $tutor_instructor_img_on_off ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $tutor_instructor_name_on_off ) {
                        the_author();
                    }  
                 echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $tutor_price_show ) {
                    echo '<div class="course__meta-left">';

                        if ($tutor_price_show) {
                            echo '<div class="course__meta-right">';
                                echo '<div class="price__1">';
                                        get_template_part( 'tutor/tpl-part/price');
                                echo '</div>';
                            echo '</div>';
                        }

                    echo '</div>';
                }

                    if ( $tutor_see_more_btn ) {
                        echo '<div class="course__meta-right">';
                            echo '<div class="view-more-btn">';
                                if (!empty($tutor_see_more_btn_text)) {
                                    echo '<a href="' . esc_url( get_permalink() ) . '">'. $tutor_see_more_btn_text .'</a>';
                                } else {
                                    echo '<a href="' . esc_url( get_permalink() ) . '">'. esc_html__('View Details', 'edubin').'</a>';
                                }   
                            echo '</div>';
                        echo '</div>';
                    }

                echo '</div>';
        echo '</div>';
    echo '</div>';


echo '</div>';