<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

    $lif_archive_media_show = Edubin::setting( 'lif_archive_media_show' );
    $lif_intor_video = Edubin::setting( 'lif_intor_video' );
    $lif_archive_title_show = Edubin::setting( 'lif_archive_title_show' );
    $lif_excerpt_show = Edubin::setting( 'lif_excerpt_show' );
    $lif_cat_show = Edubin::setting( 'lif_cat_show' );
    $lif_wishlist_show = Edubin::setting( 'lif_wishlist_show' );
    $lif_instructor_img_on_off = Edubin::setting( 'lif_instructor_img_on_off' );
    $lif_instructor_name_on_off = Edubin::setting( 'lif_instructor_name_on_off' );
    $lif_lesson_show = Edubin::setting( 'lif_lesson_show' );
    $lif_lesson_text_show = Edubin::setting( 'lif_lesson_text_show' );    
    $lif_enroll_show = Edubin::setting( 'lif_enroll_show' );
    $lif_enroll_text_show = Edubin::setting( 'lif_enroll_text_show' );
    $lif_price_show = Edubin::setting( 'lif_price_show' );
    $lif_level_show = Edubin::setting( 'lif_level_show' );
    $lif_see_more_btn = Edubin::setting( 'lif_see_more_btn' );
    $lif_see_more_btn_text = Edubin::setting( 'lif_see_more_btn_text' );

echo '<div class="edubin-course layout__' . esc_attr(  $args['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $lif_archive_media_show ) {
            echo '<div class="course__media">';

                $edubin_lif_video = get_post_meta(get_the_ID(), 'edubin_lif_video', 1); 

                if ( !empty( $edubin_lif_video ) && $lif_intor_video ) : 

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

                   if ( !empty($skill) && $lif_level_show ) {
                        echo '<div class="course__levels">';
                          echo esc_html($skill);
                        echo '</div>';
                   }

                    if ( $lif_wishlist_show ) {
                        Edubin_Wishlist::content( $post );
                    }
                echo '</div>';

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( $lif_cat_show && !empty( get_the_term_list(get_the_ID(), 'course_cat') )) {
                echo '<div class="course__categories__2">';
                    echo get_the_term_list(get_the_ID(), 'course_cat');
                echo '</div>';
            }

            if ( $lif_archive_title_show ) {
                echo '<div class="course__title--info">';
                    echo edubin_get_title();
                echo '</div>';
            }

            if ( $lif_excerpt_show ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__content--meta">';
   
                if ( $lif_enroll_show || $lif_lesson_show ) {
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

            if ( $lif_instructor_name_on_off): 
             echo '<div class="author__name ' . esc_attr( $args['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                if ( $lif_instructor_name_on_off ) {
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

        if ($lif_price_show) {
            echo '<div class="price__0">';
                echo wp_kses_post( Edubin_LIF_LMS_Helper::course_price() );
            echo '</div>';
        }
            
        // if ( function_exists( 'lifcr_course_rating_stars' ) && $lif_review_show ) :
        //     echo '<div class="edubin-course-rate">';
        //         lifcr_course_rating_stars();
        //     echo '</div>';
        // endif;

    echo '</div>';

echo '</div>';