<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr(  $args['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $args['show_media'] ) {
            echo '<div class="course__media">';

                $edubin_lif_video = get_post_meta(get_the_ID(), 'edubin_lif_video', 1); 

                if ( !empty( $edubin_lif_video ) && $args['show_intor_video'] ) : 

                    echo '<div class="intro-video-sidebar">';
                        echo '<div class="intro-video" style="background-image:url('. esc_url( $args['thumb_url'] ) .')">';
                            echo '<a href="' . esc_url( $edubin_lif_video ) . '" class="edubin-popup-videos bla-2"><i class="flaticon-play-button"></i></a>';
                        echo '</div>';
                    echo '</div>';
               
                else :

                echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                    echo '<img class="w-100" src="' . esc_url( $args['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
                echo '</a>';

                endif;

                echo '<div class="course__meta-top">';

                 
                   $skill = str_replace('_', ' ', get_post_meta( get_the_ID(), 'edubin_lif_course_level_key', true ));

                   if ( !empty($skill) && $args['show_level'] ) {
                        echo '<div class="course__levels">';
                           echo esc_html($skill);
                        echo '</div>';
                   }
                               
                    if ( $args['show_wishlist'] ) {
                         Edubin_Wishlist::content( $post );
                     }

                echo '</div>';

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( $args['show_cat']&& !empty( get_the_term_list(get_the_ID(), 'lif_course_category') )) {
                echo '<div class="course__categories__2">';
                    echo get_the_term_list(get_the_ID(), 'lif_course_category');
                echo '</div>';
            }

            if ( $args['show_title'] ) {
                echo '<div class="course__title--info">';
                    echo edubin_get_title();
                echo '</div>';
            }

            if ( $args['show_excerpt'] ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__content--meta">';
   
                if ( $args['show_topic']|| $args['show_lessons'] || $args['show_quiz'] ) {
                    echo '<div class="course__meta-right">';

                        $course = new \LLMS_Course( $post );

                        $students = $course->get_student_count();
                        $students_text = esc_html__(' Enrolled', 'edubin');

                        if ( $lif_enroll_show && !empty($students ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo '<span class="value">';
                                        echo esc_attr($students);
                                        if ($lif_enroll_text_show) {
                                            echo esc_html($students_text); 
                                        }
                                echo '</span>';
                            echo '</span>';
                        }

                        $lessons = $course->get_lessons_count();
                        $lessons = $lessons ? $lessons : 0; // Ensure $lessons is an integer
                        $lessons_text = ($lessons == 1) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');

                        if ( $lif_lesson_show ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                 echo '<span class="value">';
                                    echo esc_attr($lessons);
                                    if ($lif_lesson_text_show) {
                                        echo esc_html($lessons_text);
                                    }
                                 echo '</span>';
                            echo '</span>';
                        }


                    echo '</div>';
                }

            echo '</div>';

            if ( $args['show_author_name']): 
             echo '<div class="author__name ' . esc_attr( $args['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                if ( $args['show_author_name'] ) {
                    echo '<span class="author--by">';
                        echo esc_html__('By : ', 'edubin');
                    echo '</span>';
                    echo '<span class="author--name">';
                         the_author();
                    echo '</span>';
                   
                }  
             echo '</div>';
            endif; 

        echo '</div>';

        if ($args['show_price']) {
            echo '<div class="price__0">';
               get_template_part( 'lifterlms/tpl-part/price');
            echo '</div>';
        }
            
        if ( function_exists( 'lifcr_course_rating_stars' ) && $args['show_review']) :
            echo '<div class="edubin-course-rate">';
                lifcr_course_rating_stars();
            echo '</div>';
        endif;

    echo '</div>';

echo '</div>';