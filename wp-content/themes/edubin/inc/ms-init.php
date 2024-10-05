<?php

require_once get_template_directory() . '/inc/class-ms.php';
use \Edubin\Filter;


    //** ==== Msterstudy add body class ** ====
    function add_body_classes_for_ms_lms( $classes ) {

        $prefix = '_edubin_';
        $post_id = edubin_get_id();
            
        $ms_single_page_layout = Edubin::setting( 'ms_single_page_layout' );

        // Get body class for Msterstudy lms profile page
        if ( class_exists('MasterStudy\Lms\Plugin') && $ms_single_page_layout && is_singular( 'stm-courses' )) {
            $classes[] = 'single-course-layout-0'.$ms_single_page_layout.'';
        } // End - Get body class for Msterstudy lms profile page
        
        // Finally $classes return 
        return $classes;

    }
    add_filter( 'body_class', 'add_body_classes_for_ms_lms' );


 // ==== Display Course info / edubin_ms_course_info =====
    
    if ( ! function_exists( 'edubin_ms_course_info' ) ) {

        function edubin_ms_course_info() {  

            $course_data = apply_filters( 'masterstudy_course_page_header', 'default' );

            $ms_single_page_layout = Edubin::setting( 'ms_single_page_layout' );
            $ms_intro_video_position = Edubin::setting( 'ms_intro_video_position' );
            $ms_instructor_single = Edubin::setting( 'ms_instructor_single' );
            $ms_single_duration = Edubin::setting( 'ms_single_duration' );
            $ms_lesson_single = Edubin::setting( 'ms_lesson_single' ); 
            $ms_single_topic = Edubin::setting( 'ms_single_topic' ); 
            $ms_single_cat = Edubin::setting( 'ms_single_cat' ); 
            $ms_single_language = Edubin::setting( 'ms_single_language' );  
            $ms_single_info_heading = Edubin::setting( 'ms_single_info_heading'); 
            $ms_custom_features_position = Edubin::setting( 'ms_custom_features_position' );

            // if ( !in_array( $ms_single_page_layout, array('5')) ) {
            //     get_template_part( 'stm-lms-templates/tpl-part/single/single', 'media' );
            // }  

        echo '<div class="edubin-course-info">';

            STM_LMS_Templates::show_lms_template( 'components/course/wishlist', array( 'course_id' => $course_data['course']->id ) );

            // if ($ms_single_info_heading) {
            //     echo '<h4 class="ms-segment-title tpc_mt_30">' . esc_html($ms_single_info_heading) . '</h4>';
            // } 

            echo '<ul class="course-info-list">';

        STM_LMS_Templates::show_lms_template(
            'components/course/complete',
            array(
                'course_id'     => $course_data['course']->id,
                'user_id'       => $course_data['current_user_id'],
                'settings'      => $course_data['settings'],
                'block_enabled' => true,
            )
        );
        if ( ! $course_data['is_coming_soon'] || $course_data['course']->coming_soon_preorder ) {
            ?>
            <div class="masterstudy-single-course__cta">
                <?php
                STM_LMS_Templates::show_lms_template(
                    'components/buy-button/buy-button',
                    array(
                        'post_id'              => $course_data['course']->id,
                        'item_id'              => '',
                        'user_id'              => $course_data['current_user_id'],
                        'dark_mode'            => false,
                        'prerequisite_preview' => false,
                        'hide_group_course'    => false,
                    )
                );
                ?>
            </div>
            <?php
            STM_LMS_Templates::show_lms_template( 'components/course/money-back', array( 'course' => $course_data['course'] ) );
        }
        if ( $course_data['is_coming_soon'] && $course_data['course']->coming_soon_price && ! $course_data['course']->coming_soon_preorder ) {
            ?>
            <div class="masterstudy-single-course__cta">
                <?php STM_LMS_Templates::show_lms_template( 'components/course/coming-button' ); ?>
            </div>
            <?php
        }
        STM_LMS_Templates::show_lms_template(
            'components/course/expired',
            array(
                'course'         => $course_data['course'],
                'user_id'        => $course_data['current_user_id'],
                'is_coming_soon' => $course_data['is_coming_soon'],
            )
        );
        // if ($ms_custom_features_position == 'top') {
        //     get_template_part( 'stm-lms-templates/tpl-part/single/meta', 'custom' );
        // }

        STM_LMS_Templates::show_lms_template( 'components/course/details', array( 'course' => $course_data['course'] ) );
        if ( $course_data['settings']['course_allow_basic_info'] ) {
            STM_LMS_Templates::show_lms_template(
                'components/course/info',
                array(
                    'course_id' => $course_data['course']->id,
                    'content'   => $course_data['course']->basic_info,
                    'title'     => esc_html__( 'Basic info', 'edubin' ),
                ),
            );
        }

        if ( $course_data['settings']['course_allow_requirements_info'] ) {
            STM_LMS_Templates::show_lms_template(
                'components/course/info',
                array(
                    'course_id' => $course_data['course']->id,
                    'content'   => $course_data['course']->requirements,
                    'title'     => esc_html__( 'Course requirements', 'edubin' ),
                ),
            );
        }

        if ($ms_custom_features_position == 'bottom') {
            get_template_part( 'stm-lms-templates/tpl-part/single/meta', 'custom' );
        }

        if ( $course_data['settings']['course_allow_intended_audience'] ) {
            STM_LMS_Templates::show_lms_template(
                'components/course/info',
                array(
                    'course_id' => $course_data['course']->id,
                    'content'   => $course_data['course']->intended_audience,
                    'title'     => esc_html__( 'Intended audience', 'edubin' ),
                ),
            );
        }

        // if ( $course_data['settings']['enable_sticky'] && $course_data['show_panel'] ) {
        //  STM_LMS_Templates::show_lms_template(
        //      'components/course/stickybar',
        //      array(
        //          'course'     => $course_data['course'],
        //          'instructor' => $course_data['instructor'],
        //          'settings'   => $course_data['settings'],
        //      )
        //  );
        // }
                 

            echo '</ul>';
        echo '</div>';

        }
    }

    // ===== Display Course Category / edubin_ms_course_category ===== 

    if ( ! function_exists( 'edubin_ms_course_category' ) ) {

        function edubin_ms_course_category() {  

        global $post;
        $post_id    = $post->ID;

        echo '<div class="ms__widget">';
        echo '<section class="widget edubin-course-widget edubin-ms-widget">';
        echo '<h2 class="widget-title">' . esc_html__('Course Categories', 'edubin') . '</h2>';
        $args = array(
            'taxonomy' => 'stm_lms_course_taxonomy',
            'orderby' => 'name',
            'order'   => 'ASC'
        );
        $terms = get_categories($args);
        if ($terms && !is_wp_error($terms)) {
            echo '<ul>';
            foreach ($terms as $term) {
                echo '<li><a href="' . esc_url(get_term_link($term->slug, 'stm_lms_course_taxonomy')) . '" rel="tag" class="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</a></li>';
            }
            echo '</ul>';
        }
        echo '</section>';
        echo '</div>';
        }
    }

    /**
     * Display related courses Content
     */
    
    if ( ! function_exists( 'edubin_ms_related_course_content' ) ) {

        function edubin_ms_related_course_content( $postType = 'stm-courses', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $ms_related_course_title = Edubin::setting( 'ms_related_course_title' );
        $ms_related_course_items = Edubin::setting( 'ms_related_course_items' );
        $ms_related_course_by = Edubin::setting( 'ms_related_course_by' );
        $ms_related_course_columns = Edubin::setting( 'ms_related_course_columns' );

        $args = array(
            'style' => $style = Edubin::setting( 'ms_course_archive_style' )
        );

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $ms_related_course_items;
        if (null === $relatedBy) $relatedBy = $ms_related_course_by;
        if (null === $postType) $postType = 'stm-courses';

        // Build our basic custom query arguments

        if ($relatedBy === 'category') {
            $categories = get_the_category( $post->ID );
            $catidlist = '';
            foreach( $categories as $category) {
                $catidlist .= $category->cat_ID . ",";
            }
            // Build our category based custom query arguments
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
                'cat' => $catidlist, // Select posts in the same categories as the current post
            );
        }

        if ($relatedBy === 'tags') {

            // Get the tags for the current post
            $tags = wp_get_post_tags($postID);
            // If the post has tags, run the related post tag query
            if ($tags) {
                $tag_ids = array();
                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                // Build our tag related custom query arguments
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'tag__in' => $tag_ids, // Select posts with related tags
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            } else {
                // If the post does not have tags, run the standard related posts query
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            }

        }

        // Initiate the custom query
        $custom_query = new WP_Query( $related_posts_custom_query_args );


        // Run the loop and output data for the results
        if ( $custom_query->have_posts() ) : 

            echo '<div class="related-post-title-wrap">';
                echo '<h3 class="related-title text-center">' . esc_html( $ms_related_course_title ) . '</h3>';
            echo '</div>';

            echo '<div class="edubin-row">';
            while ( $custom_query->have_posts() ) : $custom_query->the_post();
                echo '<div class="edubin-col-lg-'. esc_attr( $ms_related_course_columns ). ' edubin-col-sm-6">';

                    get_template_part( 'stm-lms-templates/tpl-part/course/th-layouts', '', $args );

                echo '</div>';
            endwhile;
            echo '</div>';
        endif;

        // Reset postdata
        wp_reset_postdata();
        }
    }

    /**
     * Display related courses sidebar
     */

    if ( ! function_exists( 'edubin_ms_related_course_sidebar' ) ) {

        function edubin_ms_related_course_sidebar( $postType = 'stm-courses', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $ms_related_course_title = Edubin::setting( 'ms_related_course_title' );
        $ms_related_course_items = Edubin::setting( 'ms_related_course_items' );
        $ms_related_course_by = Edubin::setting( 'ms_related_course_by' );
        $ms_related_course_style = Edubin::setting( 'ms_related_course_style' );
        $final_ms_related_course_style = ($ms_related_course_style == 'square') ? 'square' : 'round';

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $ms_related_course_items;
        if (null === $relatedBy) $relatedBy = $ms_related_course_by;
        if (null === $postType) $postType = 'stm-courses';

        // Build our basic custom query arguments

        if ($relatedBy === 'category') {
            $categories = get_the_category( $post->ID );
            $catidlist = '';
            foreach( $categories as $category) {
                $catidlist .= $category->cat_ID . ",";
            }
            // Build our category based custom query arguments
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
                'cat' => $catidlist, // Select posts in the same categories as the current post
            );
        }

        if ($relatedBy === 'tags') {

            // Get the tags for the current post
            $tags = wp_get_post_tags($postID);
            // If the post has tags, run the related post tag query
            if ($tags) {
                $tag_ids = array();
                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                // Build our tag related custom query arguments
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'tag__in' => $tag_ids, // Select posts with related tags
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            } else {
                // If the post does not have tags, run the standard related posts query
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            }

        }

        // Initiate the custom query
        $custom_query = new WP_Query( $related_posts_custom_query_args );


        // Run the loop and output data for the results
        if ( $custom_query->have_posts() ) : 
     
        echo '<section id="pxcv-learndash-course-2" class="widget edubin-course-widget widget_pxcv_posts style__' . esc_attr($final_ms_related_course_style) . '">';
            echo '<h2 class="widget-title">' . esc_html__('Related Courses', 'edubin') . '</h2>';
        echo '<ul class="pxcv-rr-item-widget">';

        while ( $custom_query->have_posts() ) : $custom_query->the_post();
            echo '<li class="clearfix has_image">';

            if ( has_post_thumbnail() ) :
                echo '<a class="post__link"  href="' . get_the_permalink() . '">';
                    echo '<div class="pxcv-rr-item-image_wrapper">';
                        the_post_thumbnail( 'thumbnail' );
                    echo '</div>';
                echo '</a>';
            endif;

            echo '<div class="pxcv-rr-item-content_wrapper">';
                echo '<a class="post__link" href="' . get_the_permalink() . '">';
                    echo '<h6 class="post__title">' . get_the_title() . '</h6>';
                echo '</a>';
            echo '<span class="course-price">';

            // Show price
            // if ( $price) :
            echo '<span class="price">';
             Edubin_MS_LMS_Price::course_price();
            echo '</span>';
            // endif;

            echo '</span>';
            echo '</div>';
            echo '</li>';
        endwhile;

        echo '</ul>';
        echo '</section>';


        endif;
        // Reset postdata
        wp_reset_postdata();

        }
    }

// ===== edubin_ms_course_page_title_section_03

if ( ! function_exists( 'edubin_ms_course_page_title_section_03' ) ) :
    function edubin_ms_course_page_title_section_03( $title = null, $has_bg_image = null, $extra_style = null ) {

    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $prefix = '_edubin_';

    $ms_single_excerpt = Edubin::setting( 'ms_single_excerpt' );
    $ms_single_breadcrumb = Edubin::setting( 'ms_single_breadcrumb' );
    $ms_single_page_layout  = Edubin::setting( 'ms_single_page_layout' );
    $ms_header_color = ( $ms_single_page_layout == '4' ) ? 'light' : 'dark' ;

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '. esc_attr( $ms_header_color ).'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';
            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info ms">';

                    if ( $ms_single_breadcrumb ) {

                        echo '<div class="edubin-breadcrumb-wrapper">';
                            do_action( 'edubin_breadcrumb' );
                        echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</div>';

                    if ( $ms_single_excerpt) : 
                        echo '<div class="course-short-text">';
                            $course_data = apply_filters( 'masterstudy_course_page_header', 'default' );

                            if ( ! empty( $course_data['course']->excerpt ) || ! empty( $course_data['course']->udemy_headline ) ) {
                                ?>
                                <div class="masterstudy-single-course__desc">
                                    <?php STM_LMS_Templates::show_lms_template( 'components/course/excerpt', array( 'course' => $course_data['course'] ) ); ?>
                                </div>
                                <?php
                            }
                        echo '</div>';   
                    endif; 

               // get_template_part( 'stm-lms-templates/tpl-part/single/meta', 'review-update' );
                get_template_part( 'stm-lms-templates/tpl-part/single/meta', 'top' );


        echo '</div>'; 
        echo '<div class="edubin-col-lg-4"></div>'; 
      
        echo '</div>'; 
    echo '</div>'; 
echo '</div>'; 

    }
endif;


/**
 * Course page title section edubin_ms_course_page_title_section_05
 */
if ( ! function_exists( 'edubin_ms_course_page_title_section_05' ) ) :
    function edubin_ms_course_page_title_section_05( $title = null, $has_bg_image = null, $extra_style = null ) {

    $ms_single_excerpt = Edubin::setting( 'ms_single_excerpt' );
    $ms_single_review = Edubin::setting( 'ms_single_review' );
    $ms_single_last_update = Edubin::setting( 'ms_single_last_update' );
    
    $ms_single_page_layout  = Edubin::setting( 'ms_single_page_layout' );

    $ms_header_color = ( $ms_single_page_layout == '4' ) ? 'light' : 'dark' ;
    $header_title_tag = Edubin::setting( 'header_title_tag' );
    $header_page_title_align = Edubin::setting( 'header_page_title_align' );
    $ms_course_header_style = Edubin::setting( 'ms_course_header_style' );
    $ms_single_breadcrumb = Edubin::setting( 'ms_single_breadcrumb' );

        echo '<div class="edubin-page-title-area edubin-default-breadcrumb '. esc_attr( $has_bg_image ) . 'course-header-style--' . $ms_course_header_style .'"' . $extra_style .'>';
            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

             echo '<div class="edubin-course-top-info">';

                echo '<div class="edubin-page-title">';
                    echo '<'.$header_title_tag.' class="page-title has-text-align-'.$header_page_title_align.'">';
                      the_title();
                    echo '</'.$header_title_tag.' class="page-title">';
                echo '</div>';

                if ( $ms_single_breadcrumb ) {

                echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                }

               edubin_breadcrumb_shapes();

              get_template_part( 'stm-lms-templates/tpl-part/single/meta', 'top' );

            echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

// ===== edubin_ms_course_page_title_section_04 ====

if ( ! function_exists( 'edubin_ms_course_page_title_section_04' ) ) :
    function edubin_ms_course_page_title_section_04( $title = null, $has_bg_image = null, $extra_style = null ) {

    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $prefix = '_edubin_';

    $ms_single_excerpt = Edubin::setting( 'ms_single_excerpt' );
    $ms_single_review = Edubin::setting( 'ms_single_review' );
    $ms_single_last_update = Edubin::setting( 'ms_single_last_update' );
    $ms_single_page_layout  = Edubin::setting( 'ms_single_page_layout' );

    $ms_header_color = ( $ms_single_page_layout == '4' ) ? 'light' : 'dark' ;

    $page_header_img = get_post_meta($post_id, $prefix . 'header_img', true);

    $ms_intro_video_position = Edubin::setting( 'ms_intro_video_position' ); 
    $ms_single_social_shear = Edubin::setting( 'ms_single_social_shear ' ); 

    $breadcrumb_show = Edubin::setting( 'breadcrumb_show' );
    $shortcode_breadcrumb = Edubin::setting( 'shortcode_breadcrumb' );
    $ms_single_breadcrumb = Edubin::setting( 'ms_single_breadcrumb' );

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '.$ms_header_color.'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';

            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info ms">';

                    if ( $ms_single_breadcrumb ) {

                    echo '<div class="edubin-breadcrumb-wrapper">';
                        do_action( 'edubin_breadcrumb' );
                    echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</h1>';

                    if ( $ms_single_excerpt) : 
                        echo '<div class="course-short-text">';
                            $course_data = apply_filters( 'masterstudy_course_page_header', 'default' );

                            if ( ! empty( $course_data['course']->excerpt ) || ! empty( $course_data['course']->udemy_headline ) ) {
                                ?>
                                <div class="masterstudy-single-course__desc">
                                    <?php STM_LMS_Templates::show_lms_template( 'components/course/excerpt', array( 'course' => $course_data['course'] ) ); ?>
                                </div>
                                <?php
                            } else {
                                the_excerpt();
                            }

                            
                        echo '</div>';  
                    endif; 

                    get_template_part( 'stm-lms-templates/tpl-part/single/meta', 'top' );

                echo '</div>'; // End edubin-single-course-lead-info

            echo '</div>'; // End edubin-col-lg-8

            echo '<div class="edubin-col-lg-4">';  
                if ( $ms_single_page_layout == '5' ) {
                      get_template_part( 'stm-lms-templates/tpl-part/single/media', 'header' );
                }
            echo '</div>'; // End edubin-col-lg-4

        echo '</div>';  // End edubin-row
    echo '</div>';  // End edubin-container
echo '</div>'; // End edubin-course-top-info

    }
endif;

// ===== edubin_ms_course_page_title_section_06

if ( ! function_exists( 'edubin_ms_course_page_title_section_06' ) ) :
    function edubin_ms_course_page_title_section_06( $title = null, $has_bg_image = null, $extra_style = null ) {

            $custom_page_header_img = get_post_meta( get_the_ID(), '_edubin_header_img', 1 ); 
            $ms_single_excerpt = Edubin::setting( 'ms_single_excerpt' );
            $ms_single_review = Edubin::setting( 'ms_single_review' );
            $ms_single_last_update = Edubin::setting( 'ms_single_last_update' );
            $ms_single_page_layout  = Edubin::setting( 'ms_single_page_layout' );
            $ms_course_header_style  = Edubin::setting( 'ms_course_header_style' );
            $ms_single_breadcrumb = Edubin::setting( 'ms_single_breadcrumb' );

        echo '<div style="background-image: url('.$custom_page_header_img.')" class="edubin-page-title-area edubin-breadcrumb-style-1 edubin-breadcrumb-has-bg '. esc_attr( $has_bg_image ) . 'course-header-style--' . $ms_course_header_style .'"' . $extra_style .'>';

            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

            echo '<div class="edubin-course-top-info">';
                echo '<div class="edubin-page-title">';
                    echo '<h1 class="entry-title">';
                       echo the_title(); 
                    echo '</h1>';
                echo '</div>';

                echo '<div class="edubin-breadcrumb-wrapper">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                get_template_part( 'stm-lms-templates/tpl-part/single/meta', 'top' );

             echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;


/**
 * post_class extends for MasterStudy courses
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_masterstudy_course_class' ) ) :
    function edubin_masterstudy_course_class( $default = array() ) {
		$terms      = get_the_terms( get_the_ID(), 'stm_lms_course_taxonomy' );
		$terms_html = array();
		if ( $terms ) :
			foreach ( $terms as $term ) :
				$terms_html[] = $term->slug;
			endforeach;
		endif;
		$ams_classes = array_merge( $terms_html, $default );
		$classes     = apply_filters( 'edubin_masterstudy_course_class', $ams_classes );
        post_class( $classes );
    }
endif;

add_action( 'pre_get_posts', 'edubin_ms_custom_query_for_author' );
if ( ! function_exists( 'edubin_ms_custom_query_for_author' ) ) :
	function edubin_ms_custom_query_for_author( $query ) {
		$author_redirect_to_courses = apply_filters( 'ms_author_course_archive', true );
	    if ( is_admin() || ! $query->is_main_query() ) :
	        return;
		endif;
		if ( isset( $_GET['msauthor'] ) ) :
			$msauthor = $_GET['msauthor'];
		else :
			$msauthor = false;
		endif;
		if ( is_author() && ( 'true' == $msauthor ) && ( true == $author_redirect_to_courses ) ) :
	        $query->set( 'post_type' , array( 'stm-courses' ) );
	    endif;
	}
endif;

/**
 * Content area class for Author( As Instructor ) Archive
 */
add_filter( 'edubin_content_area_class', 'edubin_ms_author_archive_content_area_class' );

if ( ! function_exists( 'edubin_ms_author_archive_content_area_class' ) ) :
	function edubin_ms_author_archive_content_area_class ( $class ) {
		$author_redirect_to_courses = apply_filters( 'ms_author_course_archive', true );
		if ( isset( $_GET['msauthor'] ) ) :
			$msauthor = $_GET['msauthor'];
		else :
			$msauthor = false;
		endif;
		if ( true == $author_redirect_to_courses && 'true' == $msauthor ) :
			$class = 'edubin-col-lg-12';
		endif;

		return $class;
	}
endif;

/**
 * Header Course Category Slug
 */
add_filter( 'edubin_header_course_lms_cat_slug', 'edubin_header_course_ms_cat_slug' );
if ( ! function_exists( 'edubin_header_course_ms_cat_slug' ) ) :
	function edubin_header_course_ms_cat_slug() {
		return 'stm_lms_course_taxonomy';
	}
endif;

/**
 * Course Rating
 */
if ( ! function_exists( 'edubin_ms_course_rating' ) ) :
	function edubin_ms_course_rating( $style = 'default' ) {

		$post_id        = get_the_ID();
		$meta           = STM_LMS_Helpers::parse_meta_field( $post_id );
		$rates__ms          = ! empty( $meta['course_marks'] ) ? STM_LMS_Course::course_average_rate( $meta['course_marks'] ) : array();


		$single_rating_text =  __( 'Rating', 'edubin' );
		$plural_rating_text =  __( 'Ratings', 'edubin' );
		$ratings = get_post_meta(get_the_ID(), 'course_marks', true);
		$percent = 0;
		$average_rating = '0.0';
		$rates = array(
			'5' => 0,
			'4' => 0,
			'3' => 0,
			'2' => 0,
			'1' => 0
		);

		if ( isset( $ratings ) && ! empty( $ratings ) && is_array( $ratings ) ) :
			$average_rating = round( array_sum( $ratings ) / count( $ratings ), 1 );
			$percent = $average_rating * 100 / 5;
			$average_rating = number_format( floatval( $average_rating ), 1 );

			foreach ( $ratings as $rating ) :
				$rates[$rating]++;
			endforeach;
		else :
			$ratings = [];
		endif;

		echo '<div class="edubin-ms-course-rating-wrap">';

				if ( ! empty( $rates__ms ) ) :
				    echo '<div class="star-rating">';
				    	echo '<span style="width:' . ( ! empty( $rates__ms ) ? floatval( $rates__ms['percent'] ) . '%' : '' ) . '">&nbsp;</span>';
				    echo '</div>';
				endif;

			if ( Edubin::setting( 'ms_review_average_show' ) ) {

				if ( 'text' === $style ) :


					echo '<span class="edubin-ms-rating-text">(';

						echo esc_html( $average_rating ) . '/';
						echo esc_html( count( $ratings ) ) . '';

						if ( Edubin::setting( 'ms_review_text_show' ) ) {
							if ( (int)count( $ratings ) > 1 ) :
								echo esc_html( $plural_rating_text );
							else :
								echo esc_html( $single_rating_text );
							endif;
						}

					echo ')</span>';
				elseif ( 'count' === $style ) :
					echo '<span class="eb-rating-text">(' . esc_html( $average_rating ) . ')</span>';
				endif;

			}

		
		echo '</div>';
	}
endif;

/**
 * Course Rating Single
 */
if ( ! function_exists( 'edubin_ms_course_rating_02' ) ) :
    function edubin_ms_course_rating_02( $style = 'default' ) {

        $post_id        = get_the_ID();
        $meta           = STM_LMS_Helpers::parse_meta_field( $post_id );
        $rates__ms          = ! empty( $meta['course_marks'] ) ? STM_LMS_Course::course_average_rate( $meta['course_marks'] ) : array();

        $single_rating_text =  __( 'Rating', 'edubin' );
        $plural_rating_text =  __( 'Ratings', 'edubin' );
        $ratings = get_post_meta(get_the_ID(), 'course_marks', true);
        $percent = 0;
        $average_rating = '0.0';
        $rates = array(
            '5' => 0,
            '4' => 0,
            '3' => 0,
            '2' => 0,
            '1' => 0
        );

        if ( isset( $ratings ) && ! empty( $ratings ) && is_array( $ratings ) ) :
            $average_rating = round( array_sum( $ratings ) / count( $ratings ), 1 );
            $percent = $average_rating * 100 / 5;
            $average_rating = number_format( floatval( $average_rating ), 1 );

            foreach ( $ratings as $rating ) :
                $rates[$rating]++;
            endforeach;
        else :
            $ratings = [];
        endif;


        echo '<div class="edubin-ms-course-rating-wrap">';

                if ( ! empty( $rates__ms ) ) :
                    echo '<div class="star-rating">';
                        echo '<span style="width:' . ( ! empty( $rates__ms ) ? floatval( $rates__ms['percent'] ) . '%' : '' ) . '">&nbsp;</span>';
                    echo '</div>';
                endif;

          if ( Edubin::setting( 'ms_single_review' ) ) {

                if ( 'text' === $style ) :


                    echo '<span class="edubin-ms-rating-text">(';

                        echo esc_html( $average_rating ) . '/';
                        echo esc_html( count( $ratings ) ) . '';

                        if ( Edubin::setting( 'ms_review_text_show' ) ) {
                            if ( (int)count( $ratings ) > 1 ) :
                                echo esc_html( $plural_rating_text );
                            else :
                                echo esc_html( $single_rating_text );
                            endif;
                        }

                    echo ')</span>';
                elseif ( 'count' === $style ) :
                    echo '<span class="eb-rating-text">(' . esc_html( $average_rating ) . ')</span>';
                endif;

         }

        echo '</div>';

    }
endif;
