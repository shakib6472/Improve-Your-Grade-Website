<?php
/*
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
echo '<div class="edubin-single-course course-style-' . esc_attr( $layout_data['style'] ) . '">';
    echo '<div class="inner">';
        echo '<div class="thumbnail">';
            echo '<a class="course-thumb" href="' . esc_url( get_the_permalink() ) . '">';
                echo '<img class="w-100" src="' . esc_url( $layout_data['thumb_url'] ) . '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '">';
            echo '</a>';

            echo '<div class="time-top">';
                echo '<span class="duration"><i class="icon-61"></i>' . esc_html( $layout_data['duration'] ) . '</span>';
            echo '</div>';
        echo '</div>';

        echo '<div class="content main-content">';
            LP()->template( 'course' )->courses_loop_item_price();

            echo edubin_get_title();

            if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                echo '<div class="course-rating">';
                    edubin_lp_course_ratings();
                echo '</div>';
            endif;

            if ( true === $layout_data['enable_excerpt'] ) :
                echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $layout_data['excerpt_length'] ), esc_html( $layout_data['excerpt_end'] ) ) );
            endif;

            echo '<ul class="course-meta">';
                echo '<li>';
                    echo '<i class="flaticon-book"></i>';
                    echo esc_html( $layout_data['lessons'] );
                    _e( ' Lessons', 'edubin' );
                echo '</li>';
                
                echo '<li>';
                    echo '<i class="flaticon-study"></i>';
                    echo esc_html( $layout_data['enrolled'] );
                    _e( ' Students', 'edubin' );
                echo '</li>';
            echo '</ul>';
        echo '</div>';
    echo '</div>';

    echo '<div class="edubin-course-14-hover visible-bottom">';
        echo '<div class="inner">';
            echo '<div class="content">';
                if ( $layout_data['cat_item'] ) :
                    echo '<span class="course-level">' . wp_kses_post( $layout_data['cat_item'] ) . '</span>';
                endif;

                echo edubin_get_title();

                if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
                    echo '<div class="course-rating">';
                        edubin_lp_course_ratings_alter( true );
                    echo '</div>';
                endif;

                echo '<ul class="course-meta">';
                    echo '<li>';
                        echo esc_html( $layout_data['lessons'] );
                        _e( ' Lessons', 'edubin' );
                    echo '</li>';

                    echo '<li class="course-meta-info">';
                        echo esc_html( $layout_data['duration'] );
                    echo '</li>';
                    echo $layout_data['level'] ? '<li class="course-meta-info">' . esc_html( $layout_data['level'] ) . '</li>' : '';
                echo '</ul>';

                if ( is_array( $layout_data['features'] ) ) :
                    echo '<div class="course-feature">';
                        echo '<h6 class="feature-title">' . apply_filters( 'edubin_course_14_features_title', __( 'What You’ll Learn?', 'edubin' ) ) . '</h6>';
                        echo '<ul>';
                            $i = 1;
                            foreach( $layout_data['features'] as $key => $feature ) :
                                echo '<li class="course-list-item">' . esc_html( $feature['name'] ) . '</span></li>';
                                if ( $i === 3 ) :
                                    break;
                                endif;
                                $i++;
                            endforeach;
                        echo '</ul>';
                    echo '</div>';
                endif;

                echo '<div class="button-group">';
                    if ( $layout_data['button_text'] ) :
                        echo '<a class="edu-btn btn-medium" href="' . esc_url( get_the_permalink() ) . '">' . esc_html( $layout_data['button_text'] ) . '</a>';
                    endif;
                    edubin_lp_wishlist_icon( get_the_ID() );
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';*/

echo '<h1> List Style 02</h1>';