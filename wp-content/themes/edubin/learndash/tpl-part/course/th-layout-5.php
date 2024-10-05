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

echo '<div class="edubin-course layout__5 review__show col__3">';
    echo '  <div class="course__container">';
        echo '    <div class="course__media">';

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

            if ( $ld_cat_show && !empty( get_the_term_list(get_the_ID(), 'ld_course_category') )) {
                echo '<div class="course__categories">';
                    echo get_the_term_list(get_the_ID(), 'ld_course_category');
                echo '</div>';
            }

            if ($ld_price_show) {
                echo '<div class="price__2">';
                get_template_part( 'learndash/tpl-part/price');
                echo '</div>';
            }
 
            echo '<div class="course__content--meta layout__5">';

                if ( $ld_instructor_img_on_off || $ld_instructor_name_on_off): 

                    echo '<div class="author__name ' . esc_attr( $args['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                    if ( $ld_instructor_img_on_off ) {
                        echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $ld_instructor_name_on_off ) {
                        the_author();
                    }  
                    echo '</div>';

                endif; 

                if ( function_exists( 'ldcr_course_rating_stars' ) && $ld_review_show ) :
                    echo '<div class="edubin-course-rate">';
                        ldcr_course_rating_stars();
                    echo '</div>';
                endif;

              echo '</div>';
            echo '</div>';

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

            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

