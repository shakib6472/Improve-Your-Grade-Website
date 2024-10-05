<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $args['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $args['show_media'] ) {
            echo '<div class="course__media">';

                $edubin_ld_video = get_post_meta(get_the_ID(), 'edubin_ld_video', 1); 

                if ( !empty( $edubin_ld_video ) && $args['show_intor_video'] ) : 

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

                    if ( $args['show_cat'] && !empty( get_the_term_list(get_the_ID(), 'ld_course_category') )) {
                        echo '<div class="course__categories">';
                            echo get_the_term_list(get_the_ID(), 'ld_course_category');
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

            if ( function_exists( 'ldcr_course_rating' ) && $args['show_review'] ) :
                echo '<div class="edubin-course-rate">';
                    ldcr_course_rating_stars();
                echo '</div>';
            endif;

            if ( $args['show_title'] ) {
                echo '<div class="course__title--info">';
                    echo edubin_get_title();
                echo '</div>';
            }

            if ( $args['show_excerpt'] ) :
                echo '<div class="course-excerpt course-excerpt-grid">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
            endif;
       
            if ( $args['show_author_img'] || $args['show_author_name'] ): 
            echo '<div class="course__meta-left">';

                 echo '<div class="author__name ' . esc_attr( $args['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                    if ( $args['show_author_img'] ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $args['show_author_name'] ) {
                        the_author();
                    }  
                 echo '</div>';

            echo '</div>';
            endif; 

            echo '</div>';

            if ( $args['show_lessons'] || $args['show_topic'] || $args['show_price'] || $args['show_quiz'] ) {
                echo '<div class="course__border"></div>';

                echo '<div class="course__content--meta">';

                if ( $args['show_lessons'] || $args['show_topic'] ) {
                    echo '<div class="course__meta-left">';

                        $lessons      = learndash_get_course_steps( get_the_ID(), array( 'sfwd-lessons' ) );
                        $lessons      = $lessons ? count($lessons) : 0;
                        $lessons_text = ($lessons == '1') ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');
                        
                        if ( $args['show_lessons']) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                 echo '<span class="value">';

                                    echo esc_attr($lessons);

                                    if ( $args['show_lessons_text'] ) {
                                        echo esc_html($lessons_text);
                                    }
                                 echo '</span>';
                            echo '</span>';
                        }

                        $topic      = learndash_get_course_steps(get_the_ID(), array('sfwd-topic'));
                        $topic      = $topic ? count($topic) : 0;
                        $topic_text = ($topic == '1') ? esc_html__(' Topic', 'edubin') : esc_html__(' Topics', 'edubin');

                        if ( $args['show_topic'] && !empty($topic ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-study"></i>';
                                echo '<span class="value">';
                                    echo esc_attr($topic);
                                        if ( $args['show_topic_text'] ) {
                                            echo esc_html($topic_text); 
                                        }
                                echo '</span>';
                            echo '</span>';
                        }


                        $quiz      = learndash_course_get_steps_by_type( get_the_ID(), 'sfwd-quiz' );
                        $quiz      = $quiz ? count($quiz) : 0;
                        $quiz_text = ($quiz == '1') ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quiz', 'edubin');

                       if ( $args['show_quiz'] && !empty($quiz ) ) {
                            echo '<span class="course-enroll"><i class="flaticon-pin"></i>';
                                echo '<span class="value">';
                                    echo esc_attr($quiz);
                                        if ( $args['show_quiz_text'] ) {
                                            echo esc_html($quiz_text); 
                                        }
                                echo '</span>';
                            echo '</span>';
                      }


                    echo '</div>';
                }

                if ( $args['show_price'] ) {
                    echo '<div class="course__meta-right">';
                        echo '<div class="price__1">';
                           get_template_part( 'learndash/tpl-part/price');
                        echo '</div>';
                    echo '</div>';
                }

                echo '</div>';
            }
        echo '</div>';
    echo '</div>';


echo '</div>';