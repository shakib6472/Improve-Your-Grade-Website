<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

echo '<div class="edubin-course layout-' . esc_attr( $layout_data['style'] ) . '">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

            echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                echo '<img class="w-100" src="' . esc_url( $layout_data['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
            echo '</a>';


            echo '<div class="course__meta-top">';

                if ( $layout_data['show_cat_list']  && !empty( get_the_term_list(get_the_ID(), 'course_category') )) {
                    echo '<div class="course__categories">';
                        echo get_the_term_list(get_the_ID(), 'course_category');
                    echo '</div>';
                }
                if ( $layout_data['show_wishlist_list'] ) {
                     edubin_lp_wishlist_icon( get_the_ID() );
                }
            echo '</div>';


        echo '</div>';

        echo '<div class="course__content">';

            if ( $layout_data['show_price'] ) {
                echo '<div class="price__1">';
                    get_template_part( 'learnpress/tpl-part/price');
                echo '</div>';
            }

           if ( $layout_data['show_title'] ) {
                echo edubin_get_title();
           }

            if ( class_exists( 'LP_Addon_Course_Review_Preload' ) && $layout_data['show_review_list'] ) :
                echo '<div class="edubin-course-rate">';
                    edubin_lp_course_ratings();
                echo '</div>';
            endif;

            if ( $layout_data['show_excerpt_list']  ) :
                echo '<div class="course-excerpt course-excerpt-list">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
                echo '</div>';
            endif;

         echo '<div class="course__content--meta">';

                if ( $layout_data['show_lessons_list'] || $layout_data['show_enrolled_list'] || $layout_data['show_quiz_list'] ) {
                    echo '<div class="course__meta-left">';

                        if ( $layout_data['show_lessons_list'] ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                echo esc_html( $layout_data['lessons'] );
                                if ( $layout_data['show_lessons_text_list'] ) {
                                    _e( ' Lessons', 'edubin' );
                                }
                            echo '</span>';
                        }

                        if ( $layout_data['show_enrolled_list'] ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo esc_html( $layout_data['enrolled'] );
                                if ( $layout_data['show_enrolled_text_list'] ) {
                                    _e( ' Students', 'edubin' );
                                }
                            echo '</span>';
                        }

                        if ( $layout_data['show_quiz_list'] ) {
                            echo '<span class="course-quiz"><i class="flaticon-pin"></i>';
                                $course = \LP_Global::course();
                                $lessons = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
                                printf('%s', $lessons);
                                if ( $layout_data['show_quiz_text_list'] ) {
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
