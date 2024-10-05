<?php
 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $get_options['style'] ) . '">';
    echo '<div class="course__container">';

        if ( $get_options['show_media'] ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                  if ( $get_options['show_wishlist'] ) {
                        echo '<div class="edubin-wishlist-wrapper-ms">';
                            STM_LMS_Templates::show_lms_template( 'global/wish-list', array( 'course_id' => get_the_ID() ) );
                        echo '</div>';
                   }
                echo '</div>';

                if ( $get_options['show_title'] ) {
                    echo '<div class="top--title">';
                        echo edubin_get_title();
                    echo '</div>';
                }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

                if ( function_exists( 'edubin_ms_course_rating' ) && $get_options['show_review'] ) :
                   echo '<div class="edubin-course-rate">';
                            edubin_ms_course_rating( 'text' );
                    echo '</div>';
                endif;

                if ( $get_options['show_excerpt'] ) :
                    echo '<div class="course-excerpt course-excerpt-grid">';
                        echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length'] ), esc_html( $get_options['excerpt_end'] ) ) );
                    echo '</div>';
                endif;
            
                 if ( $get_options['show_author_img'] || $get_options['show_author_name'] ): 
                    
                   echo '<div class="author__name tpc_mt_15">';
                   if ( $get_options['show_author_img'] ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                   } 
                   if ( $get_options['show_author_name'] ) {
                        the_author();
                   }  
                 echo '</div>';

                endif;

            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( $get_options['show_price'] ) {
                    echo '<div class="course__meta-left">';

                        if ($get_options['show_price']) {
                            echo '<div class="course__meta-right">';
                                echo '<div class="price__1">';
                                     Edubin_MS_LMS_Price::course_price();
                                echo '</div>';
                            echo '</div>';
                        }

                    echo '</div>';
                }
                
                 $ms_see_more_btn_text = $get_options['button_text'];

                if ( $get_options['show_button'] ) {
                    echo '<div class="course__meta-right">';
                        echo '<div class="view-more-btn">';
                            if (!empty($get_options['button_text'])) {
                                echo '<a href="' . esc_url( get_permalink() ) . '">'. $ms_see_more_btn_text .'</a>';
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