<?php
if ( ! defined( 'ABSPATH' ) ) exit; 


echo '<div class="edubin-course layout-' . esc_attr( $get_options['style'] ) . '">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

            echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                echo '<img class="w-100" src="' . esc_url( $get_options['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
            echo '</a>';

            echo '<div class="course__meta-top">';

                if ( $get_options['show_cat_list'] && !empty( get_the_term_list(get_the_ID(), 'course-category') )) {
                    echo '<div class="course__categories">';
                        echo get_the_term_list(get_the_ID(), 'course-category');
                    echo '</div>';
                }
                if ( $get_options['show_wishlist_list'] ) {
                      Edubin_Wishlist::content( $post );
                }
            echo '</div>';


        echo '</div>';

        echo '<div class="course__content">';

            if ($get_options['show_price']) {
                echo '<div class="price__1">';
                   get_template_part( 'tutor/tpl-part/price');
                echo '</div>';
            }

            if ( $get_options['show_title'] ) {
                echo edubin_get_title();
            }

           if ( $get_options['show_review_list'] ) :
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
                             echo esc_attr(' /');
                             echo esc_html( $course_rating->rating_count > 0 ? $course_rating->rating_count : 0 );

                             if ( $get_options['show_review_list_text'] ) {
                                echo esc_html($total_text);
                             }
                             echo esc_attr(')');
                        echo '</span>';

                     echo '</div>'; // End .edubin-rating-wrap
                     
                     echo '</div>';
                echo '</div>';
          endif;

          if ( $get_options['show_excerpt_list'] ) :
                echo '<div class="course-excerpt course-excerpt-list">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length_list'] ), esc_html( $get_options['excerpt_end'] ) ) );
                echo '</div>';
          endif;

         echo '<div class="course__content--meta">';


                 if ( $get_options['show_enrolled_list'] || $get_options['show_lessons_list'] || $get_options['show_quiz_list'] ) {
                    echo '<div class="course__metß-left">';

                    $students      = tutor_utils()->count_enrolled_users_by_course();
                    $students      = $students ? $students : 0; // Ensure $students is an integer
                    $students_text = ($students == 1) ? esc_html__(' Student', 'edubin') : esc_html__(' Students', 'edubin');

                    if ($get_options['show_enrolled_list'] && $students > 0) { // Check if there are students
                        echo '<span class="course-enroll"><i class="flaticon-user"></i>';
                            echo '<span class="value">';
                                echo esc_attr($students);
                                if ($get_options['show_enrolled_text_list']) {
                                    echo esc_html($students_text);
                                }
                            echo '</span>';
                        echo '</span>';
                    }

                    $lessons = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                    $lessons = $lessons ? $lessons : 0; // Ensure $lessons is an integer
                    $lessons_text = ($lessons == 1) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');

                    if ($get_options['show_lessons_list']) {
                        echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                        echo '<span class="value">';
                        echo esc_attr($lessons);

                       // if ($get_options['show_lessons_list_text']) {
                            echo esc_html($lessons_text);
                       // }
                        echo '</span>';
                        echo '</span>';
                    }

                    $quiz = tutor_utils()->get_quiz_count_by_course(get_the_ID());
                    $quiz = $quiz ? $quiz : 0; // Ensure $quiz is an integer
                    $quiz_text = ($quiz == 1) ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quiz', 'edubin');

                    if ($get_options['show_quiz_list'] && $quiz > 0) {
                        echo '<span class="course-enroll"><i class="flaticon-pin"></i>';
                        echo '<span class="value">';
                        echo esc_attr($quiz);
                      //  if ($get_options['show_quiz_list_text']) {
                            echo esc_html($quiz_text);
                      //  }
                        echo '</span>';
                        echo '</span>';
                    }


                    echo '</div>';
                }

           echo '</div>';

        echo '</div>';
    echo '</div>';


echo '</div>';
