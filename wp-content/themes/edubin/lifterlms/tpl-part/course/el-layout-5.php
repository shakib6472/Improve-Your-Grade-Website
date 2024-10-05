<?php

 if ( ! defined( 'ABSPATH' ) ) exit;

echo '<div class="edubin-course layout__5 review__show col__3">';
    echo '<div class="course__container">';
        echo '<div class="course__media">';

                $edubin_lif_video = get_post_meta(get_the_ID(), 'edubin_lif_video', 1); 

                if ( !empty( $edubin_lif_video ) && $args['show_intor_video'] ) : 

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

            if ( $args['show_cat']&& !empty( get_the_term_list(get_the_ID(), 'lif_course_category') )) {
                echo '<div class="course__categories">';
                    echo get_the_term_list(get_the_ID(), 'lif_course_category');
                echo '</div>';
            }

            if ($args['show_price']) {
                echo '<div class="price__2">';
                get_template_part( 'lifterlms/tpl-part/price');
                echo '</div>';
            }
 
            echo '<div class="course__content--meta layout__5">';

                if ( $args['show_author_img'] || $args['show_author_name']): 

                    echo '<div class="author__name ' . esc_attr( $args['style'] == '1' ? ' tpc_mt_15' : '') . '">';
                    if ( $args['show_author_img'] ) {
                        echo get_avatar( get_the_author_meta( 'ID' ), 32 ); 
                    } 
                    if ( $args['show_author_name'] ) {
                        the_author();
                    }  
                    echo '</div>';

                endif; 

                if ( function_exists( 'lifcr_course_rating_stars' ) && $args['show_review']) :
                    echo '<div class="edubin-course-rate">';
                        lifcr_course_rating_stars();
                    echo '</div>';
                endif;

              echo '</div>';
            echo '</div>';

            echo '<div class="course__content">';
              echo '<div class="course__content--info">';

                if ( $args['show_title'] ) {
                    echo '<div class="course__title--info">';
                        echo edubin_get_title();
                    echo '</div>';
                }
                if ( $args['show_excerpt'] ) :
                    echo '<div class="course-excerpt">';
                        echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $args['excerpt_length'] ), esc_html( $args['excerpt_end'] ) ) );
                    echo '</div>';
                endif;

            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';

