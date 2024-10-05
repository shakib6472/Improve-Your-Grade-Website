<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

    $course              = get_post( get_the_ID() );
    $lesson_count        = Sensei()->course->course_lesson_count( get_the_ID() );

    $sensei_archive_media_show = Edubin::setting( 'sensei_archive_media_show' );
    $sensei_archive_title_show = Edubin::setting( 'sensei_archive_title_show' );
    $sensei_excerpt_show = Edubin::setting( 'sensei_excerpt_show' );
    $sensei_cat_show = Edubin::setting( 'sensei_cat_show' );
    $sensei_wishlist_show = Edubin::setting( 'sensei_wishlist_show' );
    $sensei_instructor_img_on_off = Edubin::setting( 'sensei_instructor_img_on_off' );
    $sensei_instructor_name_on_off = Edubin::setting( 'sensei_instructor_name_on_off' );
    $sensei_lesson_show = Edubin::setting( 'sensei_lesson_show' );
    $sensei_price_show = Edubin::setting( 'sensei_price_show' );
    $sensei_course_archive_clm = Edubin::setting( 'sensei_course_archive_clm' );
    $sensei_see_more_btn = Edubin::setting( 'sensei_see_more_btn' );
    $sensei_see_more_btn_text = Edubin::setting( 'sensei_see_more_btn_text' );

echo '<div class="edubin-course layout__' . esc_attr( $args['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $sensei_archive_media_show ) {
            echo '<div class="course__media">';

                echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                    echo '<img class="w-100" src="' . esc_url( $args['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
                echo '</a>';

                echo '<div class="course__meta-top">';

                 if ($sensei_price_show) {
                    echo '<div class="price__4">';
                            $wooproductID = get_post_meta(get_the_ID(), '_course_woocommerce_product', true);
                            if ( class_exists( 'WooCommerce' ) && $wooproductID != '-' && !empty($wooproductID) ) {
                                echo '<div class="price">';
                                    echo get_woocommerce_currency_symbol() . get_post_meta($wooproductID, '_regular_price', true);
                                echo '</div>';

                            } else {
                                echo '<div class="price">';
                                    echo esc_html__('Free', 'edubin');
                                echo '</div>';
                            }
                    echo '</div>';
                }


                if ( $sensei_wishlist_show ) {
                    echo '<div class="wishlist-4">';
                        Edubin_Wishlist::content( $post );
                     echo '</div>';
                 }

                echo '</div>';

                    if ( $sensei_instructor_img_on_off ): 
                     echo '<div class="author__name">';
                        if ( $sensei_instructor_img_on_off ) {
                               echo get_avatar( get_the_author_meta( 'ID' ), 50 ); 
                        } 
                     echo '</div>';
                    endif; 

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( $sensei_archive_title_show ) {
                echo '<div class="course__title--info">';
                    echo edubin_get_title();
                echo '</div>';
            }

            if ( $sensei_excerpt_show ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
            endif;

            // if ( function_exists( 'ldcr_course_rating_stars' ) && $sensei_review_show ) :
            //     echo '<div class="edubin-course-rate">';
            //         ldcr_course_rating_stars();
            //     echo '</div>';
            // endif;


            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                    if ( $sensei_lesson_show ) {
                        echo '<div class="course__meta-left">';

                        if ( $sensei_lesson_show ) {
                            echo '<span class="course-lessons"><i class="flaticon-book"></i>';
                                echo esc_html( $args['lessons'] );
                                _e( ' Lessons', 'edubin' );
                            echo '</span>';
                        }

                        echo '</div>';
                    }

                    if ( $sensei_see_more_btn ) {
                        echo '<div class="course__meta-right">';
                            echo '<div class="view-more-btn">';
                                if (!empty($sensei_see_more_btn_text)) {
                                    echo '<a href="' . esc_url( get_permalink() ) . '">'. $sensei_see_more_btn_text .'</a>';
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