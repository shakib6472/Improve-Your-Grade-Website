<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

echo '<div class="edubin-course layout-' . esc_attr( $get_options['style'] ) . '">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

            echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                echo '<img class="w-100" src="' . esc_url( $get_options['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
            echo '</a>';

            echo '<div class="course__meta-top">';

                if ( $get_options['show_cat_list'] && !empty( get_the_term_list(get_the_ID(), 'stm_lms_course_taxonomy') )) {
                    echo '<div class="course__categories">';
                        echo get_the_term_list(get_the_ID(), 'stm_lms_course_taxonomy');
                    echo '</div>';
                }
                
              if ( $get_options['show_wishlist_list'] ) {
                    echo '<div class="edubin-wishlist-wrapper-ms">';
                        STM_LMS_Templates::show_lms_template( 'global/wish-list', array( 'course_id' => get_the_ID() ) );
                    echo '</div>';
               }

            echo '</div>';


        echo '</div>';

        echo '<div class="course__content">';

           if ( $get_options['show_price'] ) {
                echo '<div class="price__1">';
                   Edubin_MS_LMS_Price::course_price();
                echo '</div>';
           }

            if ( $get_options['show_title'] ) {
                echo edubin_get_title();
            }

            if ( function_exists( 'edubin_ms_course_rating' ) && $get_options['show_review_list'] ) :
               echo '<div class="edubin-course-rate">';
                        edubin_ms_course_rating( 'text' );
                echo '</div>';
            endif;

            if ( $get_options['show_excerpt_list'] ) :
                echo '<div class="course-excerpt course-excerpt-list">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length'] ), esc_html( $get_options['excerpt_end'] ) ) );
                echo '</div>';
            endif;

         echo '<div class="course__content--meta">';

                if ( $get_options['show_enrolled_list'] || $get_options['show_lessons_list'] || $get_options['show_quiz_list']  ) {
                     echo '<div class="course__meta-left">';

                        $meta_info = \STM_LMS_Helpers::parse_meta_field( get_the_ID() );
                        $total_current_students = isset($meta_info['current_students']) && is_array($meta_info['current_students']) ? count($meta_info['current_students']) : 0;
                        $total_current_students_text = ($total_current_students == 1) ? esc_html__(' Student', 'edubin') : esc_html__(' Students', 'edubin');

                        if ( $get_options['show_enrolled_list'] && !empty($meta_info['current_students'] ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo '<span class="value">';

                                    echo esc_attr($meta_info['current_students']);

                                    if ( $get_options['show_enrolled_text_list'] ) {
                                        echo esc_html($total_current_students_text); 
                                    }
                                echo '</span>';
                            echo '</span>';
                        }

                        $curriculum_info = \STM_LMS_Course::curriculum_info( get_the_ID() );
                        $total_lessons = isset($curriculum_info['lessons']) && is_array($curriculum_info['lessons']) ? count($curriculum_info['lessons']) : 0;
                        $total_lessons_text = ($total_lessons == 1) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');
                        
                        if ( $get_options['show_lessons_list'] && !empty($curriculum_info['lessons']) ) {
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

                       if ( $get_options['show_quiz_list'] && !empty($curriculum_info['quizzes']) ) {
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

        echo '</div>';
    echo '</div>';


echo '</div>';
