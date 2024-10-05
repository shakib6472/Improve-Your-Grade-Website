<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

  $ld_archive_media_show = Edubin::setting( 'ld_archive_media_show' );
    $ld_intor_video = Edubin::setting( 'ld_intor_video' );
    $ld_archive_title_show = Edubin::setting( 'ld_archive_title_show' );
    $ld_excerpt_show = Edubin::setting( 'ld_excerpt_show' );
    $ld_cat_show = Edubin::setting( 'ld_cat_show' );
    $ld_wishlist_show = Edubin::setting( 'ld_wishlist_show' );
    $ld_topic_show = Edubin::setting( 'ld_topic_show' );
    $ld_instructor_img_on_off = Edubin::setting( 'ld_instructor_img_on_off' );
    $ld_instructor_name_on_off = Edubin::setting( 'ld_instructor_name_on_off' );
    $ld_lesson_show = Edubin::setting( 'ld_lesson_show' );
    $ld_lesson_text_show = Edubin::setting( 'ld_lesson_text_show' );
    $ld_price_show = Edubin::setting( 'ld_price_show' );
    $ld_review_show = Edubin::setting( 'ld_review_show' );
    $ld_review_text_show = Edubin::setting( 'ld_review_text_show' );
    $ld_topic_show = Edubin::setting( 'ld_topic_show' );
    $ld_topic_text_show = Edubin::setting( 'ld_topic_text_show' );
    $ld_quiz_show = Edubin::setting( 'ld_quiz_show' );
    $ld_quiz_text_show = Edubin::setting( 'ld_quiz_text_show' );
    $ld_level_show = Edubin::setting( 'ld_level_show' );
    $ld_see_more_btn = Edubin::setting( 'ld_see_more_btn' );
    $ld_see_more_btn_text = Edubin::setting( 'ld_see_more_btn_text' );

echo '<div class="edubin-course layout__' . esc_attr( $args['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $ld_archive_media_show ) {
            echo '<div class="course__media">';

                $edubin_ld_video = get_post_meta(get_the_ID(), 'edubin_ld_video', 1); 

                if ( !empty( $edubin_ld_video ) && $ld_intor_video ) : 

                    echo '<div class="intro-video-sidebar">';
                        echo '<div class="intro-video" style="background-image:url('. esc_url( $args['thumb_url'] ) .')">';
                            echo '<a href="' . esc_url( $edubin_ld_video ) . '" class="edubin-popup-videos bla-2"><i class="flaticon-play-button"></i></a>';
                        echo '</div>';
                    echo '</div>';
               
                else :

                echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                    echo '<img class="w-100" src="' . esc_url( $args['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
                echo '</a>';

                endif;

                echo '<div class="course__meta-top">';

                 if ($ld_price_show) {
                    echo '<div class="price__4">';
                       get_template_part( 'learndash/tpl-part/price');
                    echo '</div>';
                }

                if ( $ld_wishlist_show ) {
                    echo '<div class="wishlist-4">';
                        Edubin_Wishlist::content( $post );
                     echo '</div>';
                 }

                echo '</div>';

                    if ( $ld_instructor_img_on_off ): 
                     echo '<div class="author__name">';
                        if ( $ld_instructor_img_on_off ) {
                               echo get_avatar( get_the_author_meta( 'ID' ), 50 ); 
                        } 
                     echo '</div>';
                    endif; 

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( $ld_archive_title_show ) {
                echo '<div class="course__title--info">';
                    echo edubin_get_title();
                echo '</div>';
            }

            if ( $ld_excerpt_show ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
            endif;

            if ( function_exists( 'ldcr_course_rating_stars' ) && $ld_review_show ) :
                echo '<div class="edubin-course-rate">';
                    ldcr_course_rating_stars();
                echo '</div>';
            endif;


            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                    if ( $ld_topic_show || $ld_lesson_show ) {
                        echo '<div class="course__meta-left">';

                        $lessons      = learndash_get_course_steps( get_the_ID(), array( 'sfwd-lessons' ) );
                        $lessons      = $lessons ? count($lessons) : 0;
                        $lessons_text = ($lessons == '1') ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');
                        
                        if ( $ld_lesson_show ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                 echo '<span class="value">';

                                    echo esc_attr($lessons);

                                    if ($ld_lesson_text_show) {
                                        echo esc_html($lessons_text);
                                    }
                                 echo '</span>';
                            echo '</span>';
                        }

                        $topic      = learndash_get_course_steps(get_the_ID(), array('sfwd-topic'));
                        $topic      = $topic ? count($topic) : 0;
                        $topic_text = ($topic == '1') ? esc_html__(' Topic', 'edubin') : esc_html__(' Topics', 'edubin');

                        if ( $ld_topic_show && !empty($topic ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo '<span class="value">';
                                    echo esc_attr($topic);
                                        if ($ld_topic_text_show) {
                                            echo esc_html($topic_text); 
                                        }
                                echo '</span>';
                            echo '</span>';
                        }

                        $quiz      = learndash_course_get_steps_by_type( get_the_ID(), 'sfwd-quiz' );
                        $quiz      = $quiz ? count($quiz) : 0;
                        $quiz_text = ($quiz == '1') ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quiz', 'edubin');

                        if ( $ld_quiz_show && !empty($quiz ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-pin"></i>';
                                echo '<span class="value">';
                                    echo esc_attr($quiz);
                                        if ($ld_quiz_text_show) {
                                            echo esc_html($quiz_text); 
                                        }
                                echo '</span>';
                            echo '</span>';
                        }
                        
                        echo '</div>';
                    }

                    if ( $ld_see_more_btn ) {
                        echo '<div class="course__meta-right">';
                            echo '<div class="view-more-btn">';
                                if (!empty($ld_see_more_btn_text)) {
                                    echo '<a href="' . esc_url( get_permalink() ) . '">'. $ld_see_more_btn_text .'</a>';
                                } else {
                                    echo '<a href="' . esc_url( get_permalink() ) . '">'. esc_html__('View Details', 'edubin').'</a>';
                                }   
                            echo '</div>';
                        echo '</div>';
                    }

                echo '</div>';
        echo '</div>';
    echo '</div>';


echo '</div>';