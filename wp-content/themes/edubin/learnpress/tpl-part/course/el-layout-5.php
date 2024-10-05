<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__5 review__show col__3">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

            $edubin_lp_video = get_post_meta(get_the_ID(), 'edubin_lp_video', 1); 

            if ( !empty( $edubin_lp_video ) && $layout_data['show_intor_video'] ) : 

                echo '<div class="intro-video-sidebar">';
                    echo '<div class="intro-video" style="background-image:url('. esc_url( $layout_data['thumb_url'] ) .')">';
                        echo '<a href="' . esc_url( $edubin_lp_video ) . '" class="edubin-popup-videos bla-2"><i class="flaticon-play-button"></i></a>';
                    echo '</div>';
                echo '</div>';
           
            else :

                echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                    echo '<img class="w-100" src="' . esc_url( $layout_data['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
                echo '</a>';

            endif;

            if ( $layout_data['show_cat']  && !empty( get_the_term_list(get_the_ID(), 'course_category') )) {
                echo '<div class="course__categories">';
                    echo get_the_term_list(get_the_ID(), 'course_category');
                echo '</div>';
            }

            if ( $layout_data['show_price'] ) {
                echo '<div class="price__2">';
                get_template_part( 'learnpress/tpl-part/price');
                echo '</div>';
            }
 
            echo '<div class="course__content--meta layout__5">';

                if ( $layout_data['show_author_img']  || $layout_data['show_author_name'] ): 

                    echo '<div class="author__name ' . esc_attr( $layout_data['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                    if ( $layout_data['show_author_img'] ) {
                        echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $layout_data['show_author_name']) {
                        the_author();
                    }  
                    echo '</div>';

                endif; 

                if ( class_exists( 'LP_Addon_Course_Review_Preload' ) && $layout_data['show_review'] ) :
                    echo '<div class="edubin-course-rate">';
                        edubin_lp_course_ratings();
                    echo '</div>';
                endif;

              echo '</div>';
            echo '</div>';

            echo '<div class="course__content">';
              echo '<div class="course__content--info">';
                if ( $layout_data['show_title'] ) {
                    echo '<div class="course__title--info">';
                        echo edubin_get_title();
                    echo '</div>';
                }
                
                if ( $layout_data['show_excerpt'] ) :
                    echo '<div class="course-excerpt course-excerpt-grid">';
                        echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
                    echo '</div>';
                endif;

            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
