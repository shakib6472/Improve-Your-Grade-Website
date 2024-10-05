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

echo '<div class="edubin-course layout__5 review__show col__3">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

                if ( !empty( $tutor_intro_video_url ) && $tutor_intro_video ) : 

                    echo '<div class="intro-video-sidebar">';
                        echo '<div class="intro-video" style="background-image:url('. esc_url( $get_options['thumb_url'] ) .')">';
                            echo '<a href="' . esc_url( $tutor_intro_video_url ) . '" class="edubin-popup-videos bla-2"><i class="flaticon-play-button"></i></a>';
                        echo '</div>';
                    echo '</div>';
               
                else :

                    echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                        echo '<img class="w-100" src="' . esc_url( $get_options['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
                    echo '</a>';

                endif;

            if ( $get_options['show_cat'] && !empty( get_the_term_list(get_the_ID(), 'course-category') )) {
                echo '<div class="course__categories">';
                    echo get_the_term_list(get_the_ID(), 'course-category');
                echo '</div>';
            }

            if ($get_options['show_price']) {
                echo '<div class="price__2">';
                    get_template_part( 'tutor/tpl-part/price');
                echo '</div>';
            }
 
            echo '<div class="course__content--meta layout__5">';

                if ( $get_options['show_author_img'] || $get_options['show_author_name']): 

                    echo '<div class="author__name ' . esc_attr( $get_options['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                    if ( $get_options['show_author_img'] ) {
                        echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $get_options['show_author_name'] ) {
                        the_author();
                    }  
                    echo '</div>';

                endif; 

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
                    echo '<div class="course-excerpt">';
                        echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length'] ), esc_html( $get_options['excerpt_end'] ) ) );
                    echo '</div>';
                endif;

            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

