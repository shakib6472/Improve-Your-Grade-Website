<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $layout_data['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $layout_data['show_media'] ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                    if ( $layout_data['show_wishlist'] ) {
                         edubin_lp_wishlist_icon( get_the_ID() );
                    }
                echo '</div>';

            if ( $layout_data['show_title'] ) {
                echo '<div class="top--title">';
                     echo edubin_get_title();
                echo '</div>';
            }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( class_exists( 'LP_Addon_Course_Review_Preload' ) && $layout_data['show_review'] ) :
                echo '<div class="edubin-course-rate">';
                    edubin_lp_course_ratings();
                echo '</div>';
            endif;

            if ( $layout_data['show_excerpt'] ) :
                echo '<div class="course-excerpt course-excerpt-grid">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
                echo '</div>';
            endif;
            
            if ( $layout_data['show_author_img'] || $layout_data['show_author_name'] ): 
                 echo '<div class="author__name tpc_mt_15">';
                    if ( $layout_data['show_author_img'] ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $layout_data['show_author_name'] ) {
                        the_author();
                    }   
                 echo '</div>';
            endif;

            echo '</div>';

            if ( $layout_data['show_price'] || $layout_data['show_button'] ) {

                echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $layout_data['show_price'] ) {
                    echo '<div class="course__meta-left">';

                    if ($layout_data['show_price']) {
                        echo '<div class="price__1">';
                        get_template_part( 'learnpress/tpl-part/price');
                        echo '</div>';
                    }

                    echo '</div>';
                }

               if ( $layout_data['show_button'] ) {
                    echo '<div class="course__meta-right">';
                        echo '<div class="view-more-btn">';
                            if ( $layout_data['button_text'] ) {
                                echo '<a href="' . esc_url( get_permalink() ) . '">'. $layout_data['button_text'] .'</a>';
                            } else {
                                echo '<a href="' . esc_url( get_permalink() ) . '">'. esc_html__('View Details', 'edubin').'</a>';
                            }   
                        echo '</div>';
                    echo '</div>';
                }

                echo '</div>';
            }
        echo '</div>';

    echo '</div>';

echo '</div>';