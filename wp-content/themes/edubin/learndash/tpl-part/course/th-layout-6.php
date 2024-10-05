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

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                    if ( $ld_wishlist_show ) {
                        Edubin_Wishlist::content( $post );
                    }

                echo '</div>';

            if ( $ld_archive_title_show ) {
                echo '<div class="top--title">';
                     echo edubin_get_title();
                echo '</div>';
            }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( function_exists( 'ldcr_course_rating' ) && $ld_review_show ) :
                echo '<div class="edubin-course-rate">';
                    ldcr_course_rating_stars();
                echo '</div>';
            endif;

          //  if ( $ld_excerpt_show ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
         //   endif;
            
            if ( $ld_instructor_img_on_off || $ld_instructor_name_on_off): 
                 echo '<div class="author__name tpc_mt_15">';
                    if ( $ld_instructor_img_on_off ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $ld_instructor_name_on_off ) {
                        the_author();
                    }  
                 echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $ld_price_show ) {
                    echo '<div class="course__meta-left">';

                        if ($ld_price_show) {
                            echo '<div class="course__meta-right">';
                                echo '<div class="price__1">';
                                    get_template_part( 'learndash/tpl-part/price');
                                echo '</div>';
                            echo '</div>';
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