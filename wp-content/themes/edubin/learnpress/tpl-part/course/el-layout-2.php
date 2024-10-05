<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $layout_data['style'] ) . ' col__3">';
    echo '<div class="course__container">';

       if ( $layout_data['show_media'] ) {

            echo '<div class="course__media">';

                $edubin_lp_video = get_post_meta(get_the_ID(), 'edubin_lp_video', 1); 

                if ( !empty( $edubin_lp_video ) && $layout_data['show_intor_video'] ) : 

                    echo '<div class="intro-video-sidebar">';
                        echo '<div class="intro-video" style="background-image:url('. esc_url( $layout_data['thumb_url'] ) .')">';
                            echo '<a href="' . esc_url( $edubin_lp_video ) . '" class="edubin-popup-videos bla-2"><i class="flaticon-play-button"></i></a>';
                        echo '</div>';
                    echo '</div>';
               
                else :

                    echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                        echo '<img class="w-100" src="' . esc_url( $layout_data['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
                    echo '</a>';

                endif;

                echo '<div class="course__meta-top">';

                    if ( $layout_data['show_cat']  && !empty( get_the_term_list(get_the_ID(), 'course_category') )) {
                        echo '<div class="course__categories">';
                            echo get_the_term_list(get_the_ID(), 'course_category');
                        echo '</div>';
                    }
                    if ( $layout_data['show_wishlist'] ) {
                         edubin_lp_wishlist_icon( get_the_ID() );
                    }
                echo '</div>';

                if ( $layout_data['show_price'] ) {
                    echo '<div class="price__2">';
                       get_template_part( 'learnpress/tpl-part/price');
                    echo '</div>';
                }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( $layout_data['show_title'] ) {
                echo '<div class="course__title--info">';
                    echo edubin_get_title();
                echo '</div>';
            }

            if ( $layout_data['show_excerpt'] ) :
                echo '<div class="course-excerpt course-excerpt-grid">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
                echo '</div>';
            endif;

            if ( class_exists( 'LP_Addon_Course_Review_Preload' ) && $layout_data['show_review'] ) :
                echo '<div class="edubin-course-rate">';
                    edubin_lp_course_ratings();
                echo '</div>';
            endif;


            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';
       
                    if ( $layout_data['show_author_img']  || $layout_data['show_author_name'] ): 
                        
                     echo '<div class="author__name ' . esc_attr( $layout_data['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                        if ( $layout_data['show_author_img'] ) {
                               echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                        } 
                        if ( $layout_data['show_author_name'] ) {
                            the_author();
                        }  
                     echo '</div>';;
                    endif; 
          
                  if ( $layout_data['show_lessons'] || $layout_data['show_enrolled'] || $layout_data['show_quiz'] ) {
                        echo '<div class="course__meta-left">';
                            
                        if ( $layout_data['show_lessons'] ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                echo esc_html( $layout_data['lessons'] );
                                if ( $layout_data['show_lessons_text'] ) {
                                    _e( ' Lessons', 'edubin' );
                                }
                            echo '</span>';
                        }

                        if ( $layout_data['show_enrolled'] ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo esc_html( $layout_data['enrolled'] );
                                if ( $layout_data['show_enrolled_text'] ) {
                                    _e( ' Students', 'edubin' );
                                }
                            echo '</span>';
                        }

                        if ( $layout_data['show_quiz'] ) {
                            echo '<span class="course-quiz"><i class="flaticon-pin"></i>';
                                $course = \LP_Global::course();
                                $lessons = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
                                printf('%s', $lessons);
                                if ( $layout_data['show_quiz_text'] ) {
                                    _e( ' quiz', 'edubin' );
                                }
                            echo '</span>';
                        }

                        echo '</div>';
                    }

                echo '</div>';
        echo '</div>';
    echo '</div>';


echo '</div>';