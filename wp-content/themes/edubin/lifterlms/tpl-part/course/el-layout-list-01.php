<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

echo '<div class="edubin-course layout-' . esc_attr( $args['style'] ) . '">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

            echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                echo '<img class="w-100" src="' . esc_url( $args['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
            echo '</a>';

            echo '<div class="course__meta-top">';

                if ( $args['show_cat_list']  && !empty( get_the_term_list(get_the_ID(), 'lif_course_category') )) {
                    echo '<div class="course__categories">';
                        echo get_the_term_list(get_the_ID(), 'lif_course_category');
                    echo '</div>';
                }
                if ( $args['show_wishlist_list'] ) {
                     Edubin_Wishlist::content( $post );
                }
            echo '</div>';


        echo '</div>';

        echo '<div class="course__content">';

            if ( $args['show_price'] ) {
                echo '<div class="price__1">';
                   get_template_part( 'lifterlms/tpl-part/price');
                echo '</div>';
            }

            if ( $args['show_title'] ) {
                echo edubin_get_title();
            }

            if ( function_exists( 'lifcr_course_rating' ) && $args['show_review_list'] ) :
                echo '<div class="edubin-course-rate">';
                    lifcr_course_rating_stars();
                echo '</div>';
            endif;

            if ( $args['show_excerpt_list'] ) :
                echo '<div class="course-excerpt course-excerpt-list">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
            endif;

         echo '<div class="course__content--meta">';

                if ( $args['show_lessons_list'] || $args['show_topic_list'] ) {
                    echo '<div class="course__meta-left">';

                        $lessons      = lifterlms_get_course_steps( get_the_ID(), array( 'sfwd-lessons' ) );
                        $lessons      = $lessons ? count($lessons) : 0;
                        $lessons_text = ($lessons == '1') ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');
                        
                        if ( $args['show_lessons_list'] ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                 echo '<span class="value">';

                                    echo esc_attr($lessons);

                                    if ( $args['show_lessons_text_list'] ) {
                                        echo esc_html($lessons_text);
                                    }
                                 echo '</span>';
                            echo '</span>';
                        }

                        $topic      = lifterlms_get_course_steps(get_the_ID(), array('sfwd-topic'));
                        $topic      = $topic ? count($topic) : 0;
                        $topic_text = ($topic == '1') ? esc_html__(' Topic', 'edubin') : esc_html__(' Topics', 'edubin');

                        if ( $args['show_topic_list'] && !empty($topic ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo '<span class="value">';
                                    echo esc_attr($topic);
                                        if ( $args['show_topic_text_list'] ) {
                                            echo esc_html($topic_text); 
                                        }
                                echo '</span>';
                            echo '</span>';
                        }

                        $quiz      = lifterlms_course_get_steps_by_type( get_the_ID(), 'sfwd-quiz' );
                        $quiz      = $quiz ? count($quiz) : 0;
                        $quiz_text = ($quiz == '1') ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quiz', 'edubin');

                       if ( $args['show_quiz_list'] && !empty($quiz ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-pin"></i>';
                                echo '<span class="value">';
                                    echo esc_attr($quiz);
                                        if ( $args['show_quiz_text_list'] ) {
                                            echo esc_html($quiz_text); 
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
