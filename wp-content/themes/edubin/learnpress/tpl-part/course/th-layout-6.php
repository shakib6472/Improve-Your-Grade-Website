<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $layout_data['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $layout_data['lp_archive_media_show'] ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                    if ( $layout_data['lp_wishlist_show'] ) {
                         edubin_lp_wishlist_icon( get_the_ID() );
                    }
                echo '</div>';

            if ( $layout_data['lp_archive_title_show'] ) {
                echo '<div class="top--title">';
                     echo edubin_get_title();
                echo '</div>';
            }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

            if ( class_exists( 'LP_Addon_Course_Review_Preload' ) && $layout_data['lp_review_show'] ) :
                echo '<div class="edubin-course-rate">';
                    edubin_lp_course_ratings();
                echo '</div>';
            endif;

            if ( $layout_data['lp_excerpt_show'] ) :
                echo '<div class="course-excerpt course-excerpt-grid">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
                echo '</div>';
            endif;
            
            if ( $layout_data['lp_instructor_img_on_off'] || $layout_data['lp_instructor_name_on_off'] ): 
                 echo '<div class="author__name tpc_mt_15">';
                    if ( $layout_data['lp_instructor_img_on_off'] ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $layout_data['lp_instructor_name_on_off'] ) {
                        the_author();
                    }   
                 echo '</div>';
            endif;

            echo '</div>';

            if ( $layout_data['lp_price_show'] || $layout_data['lp_see_more_btn'] ) {

                echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $layout_data['lp_price_show'] ) {
                    echo '<div class="course__meta-left">';

                    if ($layout_data['lp_price_show']) {
                        echo '<div class="price__1">';
                        get_template_part( 'learnpress/tpl-part/price');
                        echo '</div>';
                    }

                    echo '</div>';
                }

               if ( $layout_data['lp_see_more_btn'] ) {
                    echo '<div class="course__meta-right">';
                        echo '<div class="view-more-btn">';
                            if ( $layout_data['lp_see_more_btn_text'] ) {
                                echo '<a href="' . esc_url( get_permalink() ) . '">'. $layout_data['lp_see_more_btn_text'] .'</a>';
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