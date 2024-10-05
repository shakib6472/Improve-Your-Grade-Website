<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $get_options['style'] ) . ' col__3">';
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

                echo '<div class="course__meta-top">';

                    if ( $get_options['show_cat'] && !empty( get_the_term_list(get_the_ID(), 'stm_lms_course_taxonomy') )) {
                        echo '<div class="course__categories">';
                            echo get_the_term_list(get_the_ID(), 'stm_lms_course_taxonomy');
                        echo '</div>';
                    }
                  if ( $get_options['show_wishlist'] ) {
                        echo '<div class="edubin-wishlist-wrapper-ms">';
                            STM_LMS_Templates::show_lms_template( 'global/wish-list', array( 'course_id' => get_the_ID() ) );
                        echo '</div>';
                   }

                echo '</div>';

                if ( $get_options['show_price'] ) {
                    echo '<div class="price__2">';
                       Edubin_MS_LMS_Price::course_price();
                    echo '</div>';
                }

            echo '</div>';

        } // == End media

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

            if ( function_exists( 'edubin_ms_course_rating' ) && $get_options['show_review'] ) :
               echo '<div class="edubin-course-rate">';
                        edubin_ms_course_rating( 'text' );
                echo '</div>';
            endif;

            echo '</div>';

            if ( $get_options['show_author_img'] || $get_options['show_author_name'] || $get_options['show_enrolled'] || $get_options['show_lessons'] || $get_options['show_quiz']): 
            echo '<div class="course__border"></div>';

                echo '<div class="course__content--meta">';
       
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
          
                   if ( $get_options['show_enrolled'] || $get_options['show_lessons'] || $get_options['show_quiz']  ) {
                     echo '<div class="course__meta-left">';

                        $meta_info = \STM_LMS_Helpers::parse_meta_field( get_the_ID() );
                        $total_current_students = isset($meta_info['current_students']) && is_array($meta_info['current_students']) ? count($meta_info['current_students']) : 0;
                        $total_current_students_text = ($total_current_students == 1) ? esc_html__(' Student', 'edubin') : esc_html__(' Students', 'edubin');

                        if ( $get_options['show_enrolled'] && !empty($meta_info['current_students'] ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo '<span class="value">';

                                    echo esc_attr($meta_info['current_students']);

                                    if ( $get_options['show_enrolled_text'] ) {
                                        echo esc_html($total_current_students_text); 
                                    }
                                echo '</span>';
                            echo '</span>';
                        }

                        $curriculum_info = \STM_LMS_Course::curriculum_info( get_the_ID() );
                        $total_lessons = isset($curriculum_info['lessons']) && is_array($curriculum_info['lessons']) ? count($curriculum_info['lessons']) : 0;
                        $total_lessons_text = ($total_lessons == 1) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');
                        
                        if ( $get_options['show_lessons'] && !empty($curriculum_info['lessons']) ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                 echo '<span class="value">';

                                    echo esc_attr($curriculum_info['lessons']);

                                    if ( $get_options['show_lessons_text'] ) {
                                        echo esc_html($total_lessons_text);
                                    }
                                 echo '</span>';
                            echo '</span>';
                        }

                        $total_quiz = isset($curriculum_info['quizzes']) && is_array($curriculum_info['quizzes']) ? count($curriculum_info['quizzes']) : 0;
                        $total_quiz_text = ($total_quiz == 1) ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quiz', 'edubin');

                       if ( $get_options['show_quiz'] && !empty($curriculum_info['quizzes']) ) {
                            echo '<span class="course-enroll"><i class="flaticon-pin"></i>';
                                echo '<span class="value">';
                                    echo esc_attr($curriculum_info['quizzes']);
                                        if ( $get_options['show_quiz_text'] ) {
                                            echo esc_html($total_quiz_text); 
                                        }
                                echo '</span>';
                            echo '</span>';
                      }
                        
                        echo '</div>';
                    }

                echo '</div>';
            endif;    
        echo '</div>';
    echo '</div>';


echo '</div>';