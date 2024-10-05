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

echo '<div class="edubin-course layout__5 review__show col__3">';
    echo '<div class="course__container">';
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

            if ( $lif_cat_show && !empty( get_the_term_list(get_the_ID(), 'course_cat') )) {
                echo '<div class="course__categories">';
                    echo get_the_term_list(get_the_ID(), 'course_cat');
                echo '</div>';
            }

            if ($lif_price_show) {
                echo '<div class="price__2">';
                    echo wp_kses_post( Edubin_LIF_LMS_Helper::course_price() );
                echo '</div>';
            }
 
            echo '<div class="course__content--meta layout__5">';

                if ( $lif_instructor_img_on_off || $lif_instructor_name_on_off): 

                    echo '<div class="author__name ' . esc_attr( $args['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                    if ( $lif_instructor_img_on_off ) {
                        echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $lif_instructor_name_on_off ) {
                        the_author();
                    }  
                    echo '</div>';

                endif; 

                // if ( function_exists( 'lifcr_course_rating_stars' ) && $lif_review_show ) :
                //     echo '<div class="edubin-course-rate">';
                //         lifcr_course_rating_stars();
                //     echo '</div>';
                // endif;

              echo '</div>';
            echo '</div>';

            echo '<div class="course__content">';
              echo '<div class="course__content--info">';

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
        echo '</div>';
    echo '</div>';
echo '</div>';

