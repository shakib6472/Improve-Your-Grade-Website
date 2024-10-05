<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr(  $layout_data['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $layout_data['lp_archive_media_show'] ) {
            echo '<div class="course__media">';


                $edubin_lp_video = get_post_meta(get_the_ID(), 'edubin_lp_video', 1); 

                if ( !empty( $edubin_lp_video ) && $layout_data['lp_intor_video'] ) : 

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

                    $level = learn_press_get_post_level( get_the_ID() );

                   if ( $layout_data['lp_level_show'] && !empty($level)) {
                        echo '<div class="course__levels">';
                           echo esc_html($level);
                        echo '</div>';
                   }
                               
                    if ( $layout_data['lp_wishlist_show'] ) {
                         edubin_lp_wishlist_icon( get_the_ID() );
                    }

                echo '</div>';

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( $layout_data['lp_cat_show']  && !empty( get_the_term_list(get_the_ID(), 'course_category') )) {
                echo '<div class="course__categories__2">';
                    echo get_the_term_list(get_the_ID(), 'course_category');
                echo '</div>';
            }

            if ( $layout_data['lp_archive_title_show'] ) {
                echo '<div class="course__title--info">';
                    echo edubin_get_title();
                echo '</div>';
            }

            if ( $layout_data['lp_excerpt_show'] ) :
                echo '<div class="course-excerpt course-excerpt-grid">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
                echo '</div>';
            endif;

            if ( class_exists( 'LP_Addon_Course_Review_Preload' ) && $layout_data['lp_review_show'] ) :
                echo '<div class="edubin-course-rate">';
                    edubin_lp_course_ratings();
                echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__content--meta">';
   
                 if ( $layout_data['lp_lesson_show'] || $layout_data['lp_enroll_show'] || $layout_data['lp_quiz_show'] ) {
                        echo '<div class="course__meta-left">';

                        if ( $layout_data['lp_lesson_show'] ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                echo esc_html( $layout_data['lessons'] );
                                if ( $layout_data['lp_lesson_text_show'] ) {
                                    _e( ' Lessons', 'edubin' );
                                }
                            echo '</span>';
                        }

                        if ( $layout_data['lp_enroll_show'] ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo esc_html( $layout_data['enrolled'] );
                                if ( $layout_data['lp_enroll_text_show'] ) {
                                    _e( ' Students', 'edubin' );
                                }
                            echo '</span>';
                        }

                        if ( $layout_data['lp_quiz_show'] ) {
                            echo '<span class="course-quiz"><i class="flaticon-pin"></i>';
                                $course = \LP_Global::course();
                                $lessons = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
                                printf('%s', $lessons);
                                if ( $layout_data['lp_quiz_text_show'] ) {
                                    _e( ' quiz', 'edubin' );
                                }
                            echo '</span>';
                        }

                        echo '</div>';
                    }

            echo '</div>';

            if ( $layout_data['lp_instructor_name_on_off'] ): 
             echo '<div class="author__name ' . esc_attr( $layout_data['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                if ( $layout_data['lp_instructor_name_on_off'] ) {
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

        if ( $layout_data['lp_price_show'] ) {
            echo '<div class="price__0">';
               get_template_part( 'learnpress/tpl-part/price');
            echo '</div>';
        }

    echo '</div>';

echo '</div>';