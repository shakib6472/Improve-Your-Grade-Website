<?php
 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__' . esc_attr( $get_options['style'] ) . '">';
    echo '<div class="course__container">';

        if ( Edubin::setting( 'ms_archive_media_show' ) ) {
            echo '<div class="course__media">';

                    echo '<a class="no-course-thumb" href="' . esc_url( get_the_permalink() ) . '">';

                        echo '<div class="edubin-triangle-up"></div>';
                        echo '<div class="edubin-circle"></div>';
                        echo '<div class="edubin-rectangle"></div>';
                        echo '<div class="edubin-circle-border"></div>';

                    echo '</a>';

                echo '<div class="course__meta-top">';

                  if ( Edubin::setting( 'ms_wishlist_show' ) ) {
                        echo '<div class="edubin-wishlist-wrapper-ms">';
                            STM_LMS_Templates::show_lms_template( 'global/wish-list', array( 'course_id' => get_the_ID() ) );
                        echo '</div>';
                   }
                echo '</div>';

                if ( Edubin::setting( 'ms_archive_title_show' ) ) {
                    echo '<div class="top--title">';
                        echo edubin_get_title();
                    echo '</div>';
                }

            echo '</div>';

        } // == End media

        echo '<div class="course__content">';
            echo '<div class="course__content--info">';

                if ( function_exists( 'edubin_ms_course_rating' ) && Edubin::setting( 'ms_review_show' ) ) :
                   echo '<div class="edubin-course-rate">';
                            edubin_ms_course_rating( 'text' );
                    echo '</div>';
                endif;

                if ( Edubin::setting( 'ms_excerpt_show' ) ) :
                    echo '<div class="course-excerpt course-excerpt-grid">';
                        echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $get_options['excerpt_length'] ), esc_html( $get_options['excerpt_end'] ) ) );
                    echo '</div>';
                endif;
            
                 if ( Edubin::setting( 'ms_instructor_img_on_off' ) || Edubin::setting( 'ms_instructor_name_on_off' ) ): 
                    
                   echo '<div class="author__name tpc_mt_15">';
                   if ( Edubin::setting( 'ms_instructor_img_on_off' ) ) {
                           echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                   } 
                   if ( Edubin::setting( 'ms_instructor_name_on_off' ) ) {
                        the_author();
                   }  
                 echo '</div>';

                endif;

            echo '</div>';

            echo '<div class="course__border"></div>';
                echo '<div class="course__content--meta">';

                if ( Edubin::setting( 'ms_price_show' ) ) {
                    echo '<div class="course__meta-left">';

                        if (Edubin::setting( 'ms_price_show' )) {
                            echo '<div class="course__meta-right">';
                                echo '<div class="price__1">';
                                     Edubin_MS_LMS_Price::course_price();
                                echo '</div>';
                            echo '</div>';
                        }

                    echo '</div>';
                }
                
                 $ms_see_more_btn_text = Edubin::setting( 'ms_see_more_btn_text' );

                if ( Edubin::setting( 'ms_see_more_btn' ) ) {
                    echo '<div class="course__meta-right">';
                        echo '<div class="view-more-btn">';
                            if (!empty(Edubin::setting( 'ms_see_more_btn_text' ))) {
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