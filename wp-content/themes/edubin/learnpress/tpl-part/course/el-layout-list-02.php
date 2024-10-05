<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

    $lp_archive_media_show = Edubin::setting( 'lp_archive_media_show' );
    $lp_archive_title_show = Edubin::setting( 'lp_archive_title_show' );
    $lp_excerpt_show = Edubin::setting( 'lp_excerpt_show' );
    $lp_cat_show = Edubin::setting( 'lp_cat_show' );
    $lp_wishlist_show = Edubin::setting( 'lp_wishlist_show' );
    $lp_instructor_img_on_off = Edubin::setting( 'lp_instructor_img_on_off' );
    $lp_instructor_name_on_off = Edubin::setting( 'lp_instructor_name_on_off' );
    $lp_lesson_show = Edubin::setting( 'lp_lesson_show' );
    $lp_quiz_show = Edubin::setting( 'lp_quiz_show' );
    $lp_price_show = Edubin::setting( 'lp_price_show' );
    $lp_enroll_show = Edubin::setting( 'lp_enroll_show' );
    $lp_review_show = Edubin::setting( 'lp_review_show' );
    $lp_review_text_show = Edubin::setting( 'lp_review_text_show' );
    $lp_level_show = Edubin::setting( 'lp_level_show' );
    $lp_see_more_btn = Edubin::setting( 'lp_see_more_btn' );
    $lp_see_more_btn_text = Edubin::setting( 'lp_see_more_btn_text' );

echo '<div class="edubin-course layout-' . esc_attr( $layout_data['style'] ) . '">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

            echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                echo '<img class="w-100" src="' . esc_url( $layout_data['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
            echo '</a>';

            echo '<div class="course__meta-top">';

                if ( $tutor_cat_show && !empty( get_the_term_list(get_the_ID(), 'course_category') )) {
                    echo '<div class="course__categories">';
                        echo get_the_term_list(get_the_ID(), 'course_category');
                    echo '</div>';
                }
                if ( $lp_wishlist_show ) {
                     edubin_lp_wishlist_icon( get_the_ID() );
                }
            echo '</div>';


        echo '</div>';

        echo '<div class="course__content">';

            if ($lp_price_show) {
                echo '<div class="price__1">';
                    get_template_part( 'learnpress/tpl-part/price');
                echo '</div>';
            }

           // if ( $tutor_archive_title_show ) {
                echo edubin_get_title();
           // }

            if ( class_exists( 'LP_Addon_Course_Review_Preload' ) && $lp_review_show ) :
                echo '<div class="edubin-course-rate">';
                    edubin_lp_course_ratings();
                echo '</div>';
            endif;


          //  if ( $tutor_list_excerpt_show ) :
                echo '<div class="course-excerpt course-excerpt-list">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
                echo '</div>';
          //  endif;

         echo '<div class="course__content--meta">';

                if ( $lp_enroll_show || $lp_lesson_show || $lp_quiz_show ) {
                    echo '<div class="course__meta-left">';

                        if ( $lp_enroll_show ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo esc_html( $layout_data['enrolled'] );
                                _e( ' Students', 'edubin' );
                            echo '</span>';
                        }

                        if ( $lp_lesson_show ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                echo esc_html( $layout_data['lessons'] );
                                _e( ' Lessons', 'edubin' );
                            echo '</span>';
                        }
                        if ( $lp_quiz_show ) {
                            echo '<span class="course-quiz"><i class="flaticon-pin"></i>';
                                  $course = \LP_Global::course();
                                  $lessons = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
                                  printf('%s', $lessons);
                                _e( ' quiz', 'edubin' );
                            echo '</span>';
                        }

                    echo '</div>';
                }

           echo '</div>';

        echo '</div>';
    echo '</div>';


echo '</div>';
