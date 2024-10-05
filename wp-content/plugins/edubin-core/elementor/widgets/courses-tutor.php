<?php

namespace EdubinCore\TL\Widgets;

use \EdubinCore\Helper;

if ( ! defined( 'ABSPATH' ) ) exit;
class Courses extends \EdubinCore\Widgets\Courses_Tutor_Options {

    public function get_name() {
        return 'edubin-tutor-course-addons';
    }

    public function get_title() {
        return __( 'Courses ( Tutor LMS )', 'edubin-core' );
    }

    public function get_keywords() {
        return [ 'edubin', 'courses', 'lms', 'tutor', 'tutor lms', 'archive', 'filter' ];
    }

    protected $post_type         = 'courses';
    protected $category_taxonomy = 'course-category';

    protected function render_query( $query, $settings, $single_wrapper ) {

         $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

// $args = array(
//     'post_type' => tutor()->course_post_type,
//     'paged'          => $paged,
//     'posts_per_page' => 3,
// );
//        $query = new \WP_Query($args);

        while ( $query->have_posts() ) : $query->the_post();
            global $post;
            $thumb_url = '';
            if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                $thumb_url = $this->render_image( get_post_thumbnail_id( $post->ID ), $settings );
            else :
                $thumb_url = tutor()->url . 'assets/images/placeholder-course.jpg';
            endif;
            $get_options = array(
                'thumb_url' => $thumb_url,
                'style'     => $settings['style']
            );

            if ( 'yes' === $settings['enable_excerpt'] ) :
                $get_options['enable_excerpt'] = true;
                $get_options['excerpt_length'] = $settings['excerpt_length'];
            else :
                $get_options['enable_excerpt'] = false;
            endif;

            $animation_attribute = '';
            if ( 'slider' !== $settings['display_type'] ) :
                if ( 'yes' === $settings['default_scroll_animation'] ) :
                    $animation_attribute = ' data-sal';
                endif;
            endif;

// ===
            // if ( $settings['show_excerpt'] ) :
            //      $get_options['show_excerpt'] = $settings['show_excerpt'];
            // endif;

            // if ( $settings['grid_excerpt_length'] ) :
            //      $get_options['grid_excerpt_length'] = $settings['grid_excerpt_length'];
            // endif;

            // if ( $settings['excerpt_end'] ) :
            //     $get_options['excerpt_end'] = $settings['excerpt_end'];
            // endif;

            // if ( $settings['button_text'] ) :
            //     $get_options['button_text'] = $settings['button_text'];
            // endif;

            // if ( $settings['show_button'] ) :
            //     $get_options['show_button'] = $settings['show_button'];
            // endif;

            // if ( $settings['show_title'] ) :
            //     $get_options['show_title'] = $settings['show_title'];

            // endif;

            // if ( $settings['show_media'] ) :
            //     $get_options['show_media'] = $settings['show_media'];
            // endif;

            // if ( $settings['show_intor_video'] ) :
            //     $get_options['show_intor_video'] = $settings['show_intor_video'];
            // endif;

            // if ( $settings['show_price'] ) :
            //     $get_options['show_price'] = $settings['show_price'];
            // endif;

            // if ( $settings['show_lessons'] ) :
            //     $get_options['show_lessons'] = $settings['show_lessons'];
            // endif;

            // if ( $settings['show_lessons_text'] ) :
            //     $get_options['show_lessons_text'] = $settings['show_lessons_text'];
            // endif;

            // if ( $settings['show_quiz'] ) :
            //     $get_options['show_quiz'] = $settings['show_quiz'];
            // endif;

            // if ( $settings['show_quiz_text'] ) :
            //     $get_options['show_quiz_text'] = $settings['show_quiz_text'];
            // endif;

            // if ( $settings['show_cat'] ) :
            //     $get_options['show_cat'] = $settings['show_cat'];
            // endif;

            // if ( $settings['show_wishlist'] ) :
            //     $get_options['show_wishlist'] = $settings['show_wishlist'];
            // endif;

            // if ( $settings['show_level'] ) :
            //     $get_options['show_level'] = $settings['show_level'];
            // endif;

            // if ( $settings['show_review'] ) :
            //     $get_options['show_review'] = $settings['show_review'];
            // endif;

            // if ( $settings['show_review_text'] ) :
            //     $get_options['show_review_text'] = $settings['show_review_text'];
            // endif;

            // if ( $settings['show_author_img'] ) :
            //     $get_options['show_author_img'] = $settings['show_author_img'];
            // endif;

            // if ( $settings['show_author_name'] ) :
            //     $get_options['show_author_name'] = $settings['show_author_name'];
            // endif;
            ?>
            <div id="post-<?php the_ID(); ?>" <?php edubin_tutor_course_class( $single_wrapper ); ?> <?php post_class( $single_wrapper ); ?> <?php echo esc_attr( $animation_attribute ); ?>>
            <?php
                tutor_load_template( 'tpl-part.course.th-layouts', $get_options );
            echo '</div>';  
        endwhile;
        wp_reset_postdata();
        wp_reset_query();
?>
 
     
<?php
    }
    
    // =========== Render ===========
    protected function render() {
        $settings         = $this->get_settings_for_display();
        $single_wrapper[] = 'edubin-course-style-' . esc_attr( $settings['style'] );
        $single_wrapper[] = 'edubin-course-' . esc_attr( $settings['style'] ) . '-' . esc_attr( $settings['display_type'] ) . '-item';

        $this->add_render_attribute( 'widget_wrapper', 'class', 'edubin-course-widget-wrapper' );

        if ( 'grid' === $settings['display_type'] ) :
            if ( 'yes' === $settings['enable_filter'] ) :
                $this->add_render_attribute( 'widget_wrapper', 'class', 'edubin-filter-type-cat-filter' );
                $this->add_render_attribute( 'widget_wrapper', 'id', 'edubin-filterable-course-id-' . $this->get_id() );

                $this->add_render_attribute(
                    'container',
                    [
                        'class' => 'edubin-course-filter-type-cat-filter',
                        'id'    =>  'filters-' . esc_attr( $this->get_id() )
                    ]
                );
            endif;

            if ( 'yes' === $settings['enable_masonry'] ) :
                $this->add_render_attribute( 'container', 'class', 'tpc-masonry-grid-wrapper' );
                $single_wrapper[] = 'tpc-masonry-item';
            endif;
        endif;

        $this->add_render_attribute( 'container', 'class', 'tpc-tutor-archive-courses' );
        $this->add_render_attribute( 'container', 'class', 'edubin-course-archive' );
        $this->add_render_attribute( 'container', 'class', 'edubin-lms-courses-' . esc_attr( $settings['display_type'] ) );

        if ( 'grid' === $settings['display_type'] ) :
            $single_wrapper[] = $this->grid( $settings );
            $this->add_render_attribute( 'container', 'class', 'edubin-row' );
        else :
            $this->add_render_attribute( 'widget_wrapper', 'class', 'tpc-slider-wrapper' );
            $this->add_render_attribute( 'container', 'class', 'swiper swiper-container' );

            if ( 'yes' === $settings['slarrows'] ) :
                $this->add_render_attribute( 'widget_wrapper', 'class', 'tpc-slider-wrapper-arrows-enable' );
            endif;

            if ( 'yes' === $settings['sldots'] ) :
                $this->add_render_attribute( 'widget_wrapper', 'class', 'tpc-slider-wrapper-dots-enable' );
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
                            $cat_args = array(
                                'include'    => $settings['include_categories']
                            );

                            $course_cats = get_terms( $this->category_taxonomy, $cat_args );
                            if ( ! empty( $course_cats ) && ! is_wp_error( $course_cats ) ) :
                                echo '<span data-filter="*" class="filter-item current">' . __( 'All', 'edubin-core' ) . '</span>';
                                foreach ( $course_cats as $course_cat ) :
                                    echo '<span class="filter-item" data-filter=".' . esc_attr( $course_cat->slug ) . '">' . esc_html( $course_cat->name ) . '</span>';
                                endforeach;
                            endif;
                        echo '</div>';
                    echo '</div>';
                endif;
            endif;
            echo '<div ' . $this->get_render_attribute_string( 'container' ) . '>';
                if ( 'slider' === $settings['display_type'] ) : 
                    $this->slider( $settings );
                    echo '<div ' . $this->get_render_attribute_string( 'swiper' ) . '>';
                endif;


            //      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

            // $args = array(
            //     'post_type' => tutor()->course_post_type,
            //     'paged'          => $paged,
            //     'posts_per_page' => 3,
            // );

            $wp_query = new \WP_Query( Helper::query_args(  $settings, $this->post_type, $this->category_taxonomy ) );
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

        if ( ! is_user_logged_in() && ( 1 == $settings['style'] || 14 == $settings['style'] ) ) :
            tutor_load_template_from_custom_path( tutor()->path . '/views/modal/login.php' );
        endif;

        // if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) :
        //     $this->render_editor_script();
        // endif;
    }
}
