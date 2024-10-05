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

echo '<div class="edubin-course layout__' . esc_attr( $args['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $lif_archive_media_show ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                    if ( $lif_wishlist_show ) {
                        Edubin_Wishlist::content( $post );
                    }

                echo '</div>';

            if ( $lif_archive_title_show ) {
                echo '<div class="top--title">';
                     echo edubin_get_title();
                echo '</div>';
            }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            // if ( function_exists( 'lifcr_course_rating' ) && $lif_review_show ) :
            //     echo '<div class="edubin-course-rate">';
            //         lifcr_course_rating_stars();
            //     echo '</div>';
            // endif;

            if ( $lif_excerpt_show ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
            endif;
            
            if ( $lif_instructor_img_on_off || $lif_instructor_name_on_off): 
                 echo '<div class="author__name tpc_mt_15">';
                    if ( $lif_instructor_img_on_off ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $lif_instructor_name_on_off ) {
                        the_author();
                    }  
                 echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $lif_price_show ) {
                    echo '<div class="course__meta-left">';

                        if ($lif_price_show) {
                            echo '<div class="course__meta-right">';
                                echo '<div class="price__1">';
                                     echo wp_kses_post( Edubin_LIF_LMS_Helper::course_price() );
                                echo '</div>';
                            echo '</div>';
                        }

                    echo '</div>';
                }

               if ( $lif_see_more_btn ) {
                    echo '<div class="course__meta-right">';
                        echo '<div class="view-more-btn">';
                            if (!empty($lif_see_more_btn_text)) {
                                echo '<a href="' . esc_url( get_permalink() ) . '">'. $lif_see_more_btn_text .'</a>';
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