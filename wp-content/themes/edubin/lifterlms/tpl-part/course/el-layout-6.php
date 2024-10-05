<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $args['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $args['show_media'] ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                    if ( $args['show_wishlist'] ) {
                        Edubin_Wishlist::content( $post );
                    }

                echo '</div>';

            if ( $args['show_title'] ) {
                echo '<div class="top--title">';
                     echo edubin_get_title();
                echo '</div>';
            }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( function_exists( 'lifcr_course_rating' ) && $args['show_review']) :
                echo '<div class="edubin-course-rate">';
                    lifcr_course_rating_stars();
                echo '</div>';
            endif;

          //  if ( $args['show_excerpt'] ) :
                echo '<div class="course-excerpt">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                echo '</div>';
         //   endif;
            
            if ( $args['show_author_img'] || $args['show_author_name']): 
                 echo '<div class="author__name tpc_mt_15">';
                    if ( $args['show_author_img'] ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $args['show_author_name'] ) {
                        the_author();
                    }  
                 echo '</div>';
            endif;

            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $args['show_price'] ) {
                    echo '<div class="course__meta-left">';

                        if ($args['show_price']) {
                            echo '<div class="course__meta-right">';
                                echo '<div class="price__1">';
                                    get_template_part( 'lifterlms/tpl-part/price');
                                echo '</div>';
                            echo '</div>';
                        }

                    echo '</div>';
                }

               if ( $args['show_button'] ) {
                    echo '<div class="course__meta-right">';
                        echo '<div class="view-more-btn">';
                            if (!empty($args['button_text'])) {
                                echo '<a href="' . esc_url( get_permalink() ) . '">'. $args['button_text'] .'</a>';
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