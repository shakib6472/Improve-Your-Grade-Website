<?php
if ( ! defined( 'ABSPATH' ) ) exit; 

$sensei_price_show = Edubin::setting( 'sensei_price_show' );
$sensei_archive_title_show = Edubin::setting( 'sensei_archive_title_show' );
$sensei_review_show = Edubin::setting( 'sensei_review_show' );
$sensei_list_excerpt_show = Edubin::setting( 'sensei_list_excerpt_show' );
$sensei_cat_show = Edubin::setting( 'sensei_cat_show' );
$sensei_wishlist_show = Edubin::setting( 'sensei_wishlist_show' );
$sensei_topic_show = Edubin::setting( 'sensei_topic_show' );
$sensei_lesson_show = Edubin::setting( 'sensei_lesson_show' );

echo '<div class="edubin-course layout-' . esc_attr( $args['style'] ) . '">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

            echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                echo '<img class="w-100" src="' . esc_url( $args['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
            echo '</a>';

            echo '<div class="course__meta-top">';

                if ( $sensei_cat_show && !empty( get_the_term_list(get_the_ID(), 'course-category') )) {
                    echo '<div class="course__categories">';
                        echo get_the_term_list(get_the_ID(), 'course-category');
                    echo '</div>';
                }
                if ( $sensei_wishlist_show ) {
                    Edubin_Wishlist::content( $post );
                }
            echo '</div>';


        echo '</div>';

        echo '<div class="course__content">';

                $wooproductID = get_post_meta(get_the_ID(), '_course_woocommerce_product', true);
                if ( class_exists( 'WooCommerce' ) && $wooproductID != '-' && !empty($wooproductID) ) {
                    echo '<div class="price__1">';
                        echo get_woocommerce_currency_symbol() . get_post_meta($wooproductID, '_regular_price', true);
                    echo '</div>';
                } else {
                    echo '<div class="price__1">';
                        echo esc_html__('Free', 'edubin');
                    echo '</div>';
                }

            if ( $sensei_archive_title_show ) {
                echo edubin_get_title();
            }

            if ( function_exists( 'ldcr_course_rating' ) && $sensei_review_show ) :
                echo '<div class="edubin-course-rate">';
                    ldcr_course_rating_stars();
                echo '</div>';
            endif;

          //  if ( $sensei_list_excerpt_show ) :
                echo '<div class="course-excerpt course-excerpt-list">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
          //  endif;

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
           echo '</div>';

        echo '</div>';
    echo '</div>';


echo '</div>';
