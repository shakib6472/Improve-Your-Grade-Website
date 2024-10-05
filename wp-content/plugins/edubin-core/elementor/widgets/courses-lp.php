<?php

namespace EdubinCore\LP\Widgets;

use \EdubinCore\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Edubin Core
 *
 * Elementor widget for LearnPress Courses.
 *
 * @since 1.0.0
 */
class Courses extends \EdubinCore\Widgets\Courses {

    public function get_name() {
        return 'edubin-lpcourse-addons';
    }

    public function get_keywords() {
        return [ 'edubin', 'courses', 'lms', 'lp', 'learnpress', 'archive', 'filter' ];
    }

    /**
     * render the course query
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render_query( $query, $settings, $single_wrapper, $uniqueid = '', $exclude_unique_ids = array() ) {
        while ( $query->have_posts() ) : $query->the_post();
            global $post;
            $course    = \LP_Global::course();
            $thumb_url = '';
            if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                $thumb_url = $this->render_image( get_post_thumbnail_id( $post->ID ), $settings );
            else :
                $thumb_url = \LP()->image( 'no-image.png' );
            endif;
            $layout_data = array(
                'thumb_url' => $thumb_url,
                'style'     => $settings['style']
            );

            // if ( 'yes' === $settings['show_excerpt'] ) :
            //     $layout_data['show_excerpt'] = true;

            //     if ( $settings['excerpt_length'] ) :
            //         $layout_data['excerpt_length'] = $settings['excerpt_length'];
            //     endif;
                
            //     if ( $settings['excerpt_end'] ) :
            //         $layout_data['excerpt_end'] = $settings['excerpt_end'];
            //     endif;
            // else :
            //     $layout_data['show_excerpt'] = false;
            // endif;


                            if ( $settings['show_excerpt'] ) :
                                 $layout_data['show_excerpt'] = $settings['show_excerpt'];
                            endif;
        
                            if ( $settings['grid_excerpt_length'] ) :
                                 $layout_data['grid_excerpt_length'] = $settings['grid_excerpt_length'];
                            endif;
        
                            if ( $settings['excerpt_end'] ) :
                                $layout_data['excerpt_end'] = $settings['excerpt_end'];
                            endif;
        
                            if ( $settings['button_text'] ) :
                                $layout_data['button_text'] = $settings['button_text'];
                            endif;

                            if ( $settings['show_button'] ) :
                                $layout_data['show_button'] = $settings['show_button'];
                            endif;

                            if ( $settings['show_title'] ) :
                                $layout_data['show_title'] = $settings['show_title'];
                            endif;
      
                            if ( $settings['show_media'] ) :
                                $layout_data['show_media'] = $settings['show_media'];
                            endif;

                            if ( $settings['show_intor_video'] ) :
                                $layout_data['show_intor_video'] = $settings['show_intor_video'];
                            endif;

                            if ( $settings['show_price'] ) :
                                $layout_data['show_price'] = $settings['show_price'];
                            endif;
 
                            if ( $settings['show_lessons'] ) :
                                $layout_data['show_lessons'] = $settings['show_lessons'];
                            endif;

                            if ( $settings['show_lessons_text'] ) :
                                $layout_data['show_lessons_text'] = $settings['show_lessons_text'];
                            endif;

                            if ( $settings['show_enrolled'] ) :
                                $layout_data['show_enrolled'] = $settings['show_enrolled'];
                            endif;

                            if ( $settings['show_enrolled_text'] ) :
                                $layout_data['show_enrolled_text'] = $settings['show_enrolled_text'];
                            endif;

                            if ( $settings['show_quiz'] ) :
                                $layout_data['show_quiz'] = $settings['show_quiz'];
                            endif;

                            if ( $settings['show_quiz_text'] ) :
                                $layout_data['show_quiz_text'] = $settings['show_quiz_text'];
                            endif;

                            if ( $settings['show_cat'] ) :
                                $layout_data['show_cat'] = $settings['show_cat'];
                            endif;

                            if ( $settings['show_lessons'] ) :
                                $layout_data['show_lessons'] = $settings['show_lessons'];
                            endif;

                            if ( $settings['show_lessons_text'] ) :
                                $layout_data['show_lessons_text'] = $settings['show_lessons_text'];
                            endif;

                            if ( $settings['show_enrolled'] ) :
                                $layout_data['show_enrolled'] = $settings['show_enrolled'];
                            endif;

                            if ( $settings['show_enrolled_text'] ) :
                                $layout_data['show_enrolled_text'] = $settings['show_enrolled_text'];
                            endif;

                            if ( $settings['show_quiz'] ) :
                                $layout_data['show_quiz'] = $settings['show_quiz'];
                            endif;

                            if ( $settings['show_quiz_text'] ) :
                                $layout_data['show_quiz_text'] = $settings['show_quiz_text'];
                            endif;

                           if ( $settings['show_wishlist'] ) :
                                $layout_data['show_wishlist'] = $settings['show_wishlist'];
                            endif;
                        
                           if ( $settings['show_level'] ) :
                                $layout_data['show_level'] = $settings['show_level'];
                            endif;
                        
                           if ( $settings['show_review'] ) :
                                $layout_data['show_review'] = $settings['show_review'];
                            endif;
                        
                           if ( $settings['show_review_text'] ) :
                                $layout_data['show_review_text'] = $settings['show_review_text'];
                            endif;
                        
                           if ( $settings['show_author_img'] ) :
                                $layout_data['show_author_img'] = $settings['show_author_img'];
                            endif;
                        
                           if ( $settings['show_author_name'] ) :
                                $layout_data['show_author_name'] = $settings['show_author_name'];
                            endif;

            if ( ! empty( $uniqueid ) ) :
                $single_wrapper[] = $uniqueid;
            endif;
            if ( is_array( $exclude_unique_ids ) && ! empty( $exclude_unique_ids ) ) :
                $single_wrapper = array_diff( $single_wrapper, $exclude_unique_ids );
            endif;

            $animation_attribute = '';
            if ( 'slider' !== $settings['display_type'] ) :
                if ( 'yes' === $settings['default_scroll_animation'] ) :
                    $animation_attribute = ' data-sal';
                endif;
            endif;
            ?>
            <div id="post-<?php the_ID(); ?>" <?php post_class( $single_wrapper ); ?>  <?php echo esc_attr( $animation_attribute ); ?>>
            <?php
                learn_press_get_template( 'tpl-part/course/el-layouts.php', compact( 'layout_data' ) );
            echo '</div>';  
        endwhile;
        wp_reset_postdata();
    }

    /**
     * Render the widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     *
     * @access protected
     */
    protected function render() {
        $settings         = $this->get_settings_for_display();
        $category_slug    = $this->category_taxonomy;
        $filter_type      = '';
        $uniqueid         = time().rand( 1, 99 );
        $single_wrapper   = [];
        $single_wrapper[] = 'edubin-course-style-' . esc_attr( $settings['style'] );
        $single_wrapper[] = 'edubin-course-' . esc_attr( $settings['style'] ) . '-' . esc_attr( $settings['display_type'] ) . '-item';

        $this->add_render_attribute( 'widget_wrapper', 'class', 'edubin-course-widget-wrapper' );

        if ( 'grid' === $settings['display_type'] ) :
            if ( 'yes' === $settings['enable_filter'] ) :
                $filter_type = $settings['filter_type'];
                $this->add_render_attribute( 'widget_wrapper', 'class', 'edubin-filter-type-' . esc_attr( $filter_type ) );
                $this->add_render_attribute( 'widget_wrapper', 'id', 'edubin-filterable-course-id-' . $this->get_id() );

                $this->add_render_attribute(
                    'container',
                    [
                        'class' => 'edubin-course-filter-type-' . esc_attr( $filter_type ),
                        'id'    =>  'filters-' . esc_attr( $this->get_id() )
                    ]
                );
            endif;
        endif;

        $this->add_render_attribute( 'container', 'class', 'edubin-archive-lp-courses' );
        $this->add_render_attribute( 'container', 'class', 'edubin-course-archive' );
        $this->add_render_attribute( 'container', 'class', 'edubin-lms-courses-' . esc_attr( $settings['display_type'] ) );

        if ( 'grid' === $settings['display_type'] ) :
            $single_wrapper[] = $this->grid( $settings );
            $this->add_render_attribute( 'container', 'class', 'edubin-row' );
            
            if ( 'yes' === $settings['enable_masonry'] ) :
                $this->add_render_attribute( 'container', 'class', 'tpc-masonry-grid-wrapper' );
                $single_wrapper[] = 'tpc-masonry-item';
            endif;
        else :
            $this->add_render_attribute( 'widget_wrapper', 'class', 'tpc-slider-wrapper' );
            $this->add_render_attribute( 'container', 'class', 'swiper swiper-container' );

            if ( 'yes' === $settings['slarrows'] ) :
                $this->add_render_attribute( 'widget_wrapper', 'class', 'tpc-slider-wrapper-arrows-enable' );
            endif;

            if ( 'yes' === $settings['sldots'] ) :
                $this->add_render_attribute( 'container', 'class', 'tpc-slider-dots-enable' );
            endif;
            
            $single_wrapper[] = 'edubin-slider-item';
            $single_wrapper[] = 'swiper-slide';
        endif;

        echo '<div ' . $this->get_render_attribute_string( 'widget_wrapper' ) . '>';
            if ( 'grid' === $settings['display_type'] ) :
                if ( 'yes' === $settings['enable_filter'] ) :
                    echo '<div class="edubin-course-filter-wrapper">';
                        echo '<div class="edubin-filter-course edubin-category-controls-' . esc_attr( $settings['enable_filter'] ) . '">';

                            $all_filter_text = __( 'All', 'edubin-core' );
                            if ( ! empty( $settings['filter_all_text'] ) ) :
                                $all_filter_text = $settings['filter_all_text'];
                            endif;
                            if ( 'cat-filter' === $filter_type ) :
                                $cat_args = array(
                                    'include'    => $settings['include_categories']
                                );

                                $course_cats = get_terms( $category_slug, $cat_args );
                                if ( ! empty( $course_cats ) && ! is_wp_error( $course_cats ) ) :
                                    echo '<span data-filter="*" class="filter-item current">' . esc_html( $all_filter_text ) . '</span>';
                                    foreach ( $course_cats as $course_cat ) :
                                        echo '<span class="filter-item" data-filter=".' . $category_slug . '-' . esc_attr( $course_cat->slug ) . '">' . esc_html( $course_cat->name ) . '</span>';
                                    endforeach;
                                endif;
                            else :
                                $nav_items = array(
                                    'recent'   => __( 'New Courses', 'edubin-core' ),
                                    'featured' => __( 'Featured Courses', 'edubin-core' ),
                                    'popular'  => __( 'Popular Courses', 'edubin-core' )
                                );
                                foreach ( $nav_items as $key => $value ) :
                                    echo '<span class="filter-item">' . esc_html( $value ) . '</span>';
                                endforeach;
                            endif;
                        echo '</div>';
                    echo '</div>';
                endif;
            endif;
            
            if ( 'tab-filter' !== $filter_type ) :
                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    if ( 'slider' === $settings['display_type'] ) : 
                        $this->slider( $settings );
                        echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                    endif;

                    $wp_query = new \WP_Query( Helper::query_args( $settings, $this->post_type, $this->category_taxonomy, $this->get_name() ) );
                    $this->render_query( $wp_query, $settings, $single_wrapper );

                    if ( 'slider' === $settings['display_type'] ) : 
                        echo '</div>';
                    endif;

                    if ( 'slider' === $settings['display_type'] ) : 
                        if ( 'yes' === $settings['sldots'] ) :
                            echo '<div class="slider-course-pegination swiper-pagination"></div>';
                        endif;
                    endif;
                echo '</div>';
            elseif ( 'tab-filter' === $filter_type && 'grid' === $settings['display_type'] && 'yes' === $settings['enable_filter'] ) :
                $this->add_render_attribute( 'container', 'class', 'edubin-course-tab-content edubin-fade' );

                $recent_args = array(
                    'post_type'      => $this->post_type,
                    'post_status'    => 'publish',
                    'posts_per_page' => $settings['per_page']['size']
                );
                $query_recent = new \WP_Query( $recent_args );

                $featured_args = array(
                    'post_type'      => $this->post_type,
                    'posts_per_page' => $settings['per_page']['size'],
                    'meta_key'       => '_lp_featured',
                    'meta_value'     => 'yes',
                    'post_status'    => 'publish',
                    'orderby'        => 'title',
                    'order'          => 'ASC'
                );
                $query_featured = new \WP_Query( $featured_args );

                $popular_args = array(
                    'post_type'      => $this->post_type,
                    'posts_per_page' => $settings['per_page']['size'],
                    'meta_key'       => '_lp_students',
                    'post_status'    => 'publish',
                    'orderby'        => 'meta_value_num',
                    'order'          => 'DESC'
                );
                $query_popular = new \WP_Query( $popular_args );

                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    $this->render_query( $query_recent, $settings, $single_wrapper, $uniqueid . 'recent' );
                echo '</div>';

                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    $this->render_query( $query_featured, $settings, $single_wrapper, $uniqueid . 'featured', array( $uniqueid . 'recent' ) );
                    echo '</div>';

                echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                    $this->render_query( $query_popular, $settings, $single_wrapper, $uniqueid . 'popular', array( $uniqueid . 'recent', $uniqueid . 'featured' ) );
                echo '</div>';
            endif;

 
            if ( 'yes' === $settings['slarrows'] && $settings['display_type']==='slider' ) :
                echo '<div class="edubin-arrow-style-'.$settings['nav_arrow_style'].' prev-icon slide-prev">';
                    echo '<i class="flaticon-back-1"></i>';
                echo '</div>';
                echo '<div class="edubin-arrow-style-'.$settings['nav_arrow_style'].' next-icon slide-next">';
                    echo '<i class="flaticon-next"></i>';
                echo '</div>';
            endif;
        echo '</div>';

        if ( $settings['pagi_on_off'] ) {
            echo '<nav class="edubin-pagination-wrapper tpc-custom-pagination">';
                echo '<div class="page-number">';
                    echo paginate_links( array(
                        'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
                        'total'        => $wp_query->max_num_pages,
                        'current'      => max( 1, get_query_var( 'paged' ) ),
                        'format'       => '?paged=%#%',
                        'show_all'     => $settings['pagi_show_all'],
                        'end_size'     => $settings['pagi_end_size'],
                        'mid_size'     => $settings['pagi_mid_size'],
                        'prev_text' => '<i class="edubin-pagination-icon flaticon-back-1" aria-hidden="true"></i>',
                        'next_text' => '<i class="edubin-pagination-icon flaticon-next" aria-hidden="true"></i>'
                    ) );
                echo '</div>';
            echo '</nav>';
        }

    }
}