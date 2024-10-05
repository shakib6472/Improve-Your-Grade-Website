<?php

// add_body_classes_for_tutor_lms
// edubin_tutor_course_category
// edubin_tutor_course_info
// edubin_tutor_related_course_content
// edubin_tutor_related_course_sidebar
// edubin_tutor_course_page_title_section_03
// edubin_tutor_course_page_title_section_04
// edubin_tutor_course_page_title_section_05
// edubin_tutor_course_page_title_section_06

    /**
     * Tutor LMS Compatibility
     *
     * @package Edubin
     */

    function add_body_classes_for_tutor_lms( $classes ) {


        global $wp;
        $prefix = '_edubin_';
        $post_id = edubin_get_id();
        
        $tutor_single_page_layout = Edubin::setting( 'tutor_single_page_layout' );
        $tutor_hide_profile_page_header = Edubin::setting( 'tutor_hide_profile_page_header' );

        // Get body class for tutor lms profile page
        if (strpos( home_url($wp->request), '/profile/') !== false && function_exists('tutor') && $tutor_hide_profile_page_header == true ) {
            $classes[] = 'edubin_tutor_profile_page';
        } // End - Get body class for tutor lms profile page
        
        // Get body class for tutor lms profile page
        if ( function_exists('tutor') && $tutor_single_page_layout && is_singular( 'courses' )) {
            $classes[] = 'single-course-layout-0'.$tutor_single_page_layout.'';
        } // End - Get body class for tutor lms profile page
        
        // Finally $classes return 
    	return $classes;


    }
    add_filter( 'body_class', 'add_body_classes_for_tutor_lms' );


    /**
     * Display Course Category
     */
    
    if ( ! function_exists( 'edubin_tutor_course_category' ) ) {

        function edubin_tutor_course_category() {  

        global $post;
        $post_id    = $post->ID;

        ?>
       <!--  tutor Course Category -->
        <div class="tutor__widget">    
            <section class="widget edubin-course-widget">
                <h2 class="widget-title"><?php esc_html_e('Course Categories', 'edubin');?></h2> 
                <?php
                
                $args = array(
                   'taxonomy' => 'course-category',
                   'orderby' => 'name',
                   'order'   => 'ASC'
                );
               $terms = get_categories($args);

                if ($terms && ! is_wp_error($terms)): ?>
                    <ul>
                    <?php foreach($terms as $term): ?>
                        <li><a href="<?php echo get_term_link( $term->slug, 'course-category'); ?>" rel="tag" class="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
             </section>
        </div>

    <?php
        }
    }
    // ==== Display Course info / edubin_tutor_course_info =====
    
    if ( ! function_exists( 'edubin_tutor_course_info' ) ) {

        function edubin_tutor_course_info() {  

            $tutor_single_page_layout = Edubin::setting( 'tutor_single_page_layout' );
            $tutor_intro_video_position = Edubin::setting( 'tutor_intro_video_position' );
            $tutor_instructor_single = Edubin::setting( 'tutor_instructor_single' );
            $tutor_duration_single = Edubin::setting( 'tutor_duration_single' );
            $tutor_lesson_single = Edubin::setting( 'tutor_lesson_single' ); 
            $tutor_single_cat = Edubin::setting( 'tutor_single_cat' ); 
            $tutor_single_language = Edubin::setting( 'tutor_single_language' );  
            $tutor_single_info_heading = Edubin::setting( 'tutor_single_info_heading'); 
            $tutor_custom_features_position = Edubin::setting( 'tutor_custom_features_position' );
            $tutor_single_price = Edubin::setting( 'tutor_single_price' );
            $tutor_single_enroll = Edubin::setting( 'tutor_single_enroll' );
            $tutor_single_enroll_btn = Edubin::setting( 'tutor_single_enroll_btn' );
            $tutor_single_skill_level = Edubin::setting( 'tutor_single_skill_level' );
            $tutor_single_quiz = Edubin::setting( 'tutor_single_quiz' );

            if ( !in_array( $tutor_single_page_layout, array('5')) ) {
                //get_template_part( 'tutor/tpl-part/single/single', 'media' );
            }  

        echo '<div class="edubin-course-info">';

            if ($tutor_single_info_heading) {
                echo '<h4 class="ld-segment-title tpc_mt_30">' . esc_html($tutor_single_info_heading) . '</h4>';
            } 

            echo '<ul class="course-info-list">';

                if ($tutor_single_enroll_btn) {
                    tutor_load_template( 'single.course.course-entry-box' );
                }

                $course_id     = get_the_ID();
                $default_price = apply_filters('tutor-loop-default-price', esc_html__('Free', 'edubin'));
                $price_html    = '<span class="price"> ' . $default_price . '</span>';

                if ($tutor_single_price) { 
                    echo '<li>';
                        echo '<i class="flaticon-price-tag"></i>';
                        echo '<span class="label">' . esc_html__('Price :', 'edubin') . '</span>';
                            echo '<span class="value edubin-price-value">';
                                if (tutor_utils()->is_course_purchasable()) {
                                    $product_id = tutor_utils()->get_course_product_id($course_id);
                                    $product    = wc_get_product($product_id);
                                    if ($product) {
                                        $price_html = '<span class="price"> ' . $product->get_price_html() . ' </span>';
                                    }
                                }
                                 echo wp_kses( $price_html, 'edubin-default' );
                            echo '</span>';
                    echo '</li>';
                }

                if ($tutor_custom_features_position == 'top') {
                    get_template_part( 'tutor/tpl-part/single/meta', 'custom' );
                }

                // if ($tutor_instructor_single) { 
                //     echo '<li>';
                //     echo '<i class="meta-icon flaticon-student"></i>';
                //     echo '<span class="label">' . esc_html__('Created by :', 'edubin') . '</span>';
                //     echo '<span class="value">' . get_the_author() . '</span>';
                //     echo '</li>';
                // }

                $total_students = (int) tutor_utils()->count_enrolled_users_by_course(); 
                $students_text = ('1' == $total_students) ? esc_html__(' Student', 'edubin') : esc_html__(' Students', 'edubin');
                 if ($tutor_single_enroll) { 
                        echo '<li>';
                        echo '<i class="meta-icon flaticon-users"></i>';
                                echo '<span class="label">' . esc_html__(' Enrolled :', 'edubin') . '</span>';
                                echo '<span class="value">';
                                    echo wp_kses_post($total_students);
                                    echo wp_kses_post($students_text);
                                echo '</span>';
                        echo '</li>';
                 }
           
                $course_duration = get_tutor_course_duration_context();
                 if ($tutor_duration_single) { 
                        echo '<li>';
                        echo '<i class="meta-icon flaticon-start"></i>';
                                echo '<span class="label">' . esc_html__(' Duration :', 'edubin') . '</span>';
                                echo '<span class="value">';
                                    echo wp_kses_post($course_duration);
                                echo '</span>';
                        echo '</li>';
                 }

                $total_lesson = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                $lesson_text = ('1' == $total_lesson) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');

                 if ($tutor_lesson_single) { 
                        echo '<li>';
                        echo '<i class="meta-icon flaticon-book"></i>';
                                echo '<span class="label">' . esc_html__('Lessons :', 'edubin') . '</span>';
                                echo '<span class="value">';
                                    echo wp_kses_post( $total_lesson );
                                    echo wp_kses_post( $lesson_text );
                                echo '</span>';
                        echo '</li>';
                 }

           
                $total_questions = tutor_utils()->get_quiz_count_by_course( get_the_ID() );
                $total_questions_text = ('1' == $total_questions) ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quizzes', 'edubin');

                if ($tutor_single_quiz) { 
                        echo '<li>';
                        echo '<i class="meta-icon flaticon-pin"></i>';
                                echo '<span class="label">' . esc_html__(' Quiz :', 'edubin') . '</span>';
                                echo '<span class="value">';
                                    echo wp_kses_post( $total_questions );
                                    echo wp_kses_post( $total_questions_text );
                                echo '</span>';
                        echo '</li>';
                }

               if ($tutor_single_skill_level) { 
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-network"></i>';
                    echo '<span class="label">' . esc_html__('Skill Level :', 'edubin') . '</span>';
                    echo '<span class="value">' . get_tutor_course_level() . '</span>';
                    echo '</li>';
              }
                
                if ($tutor_single_cat) {
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-tags"></i>';
                    echo '<span class="label">' . esc_html__('Category :', 'edubin') . '</span>';
                    echo '<span class="tutor_course_cat value">';
                    if (!get_the_terms(get_the_ID(), 'course-category')) {
                        esc_html_e('Uncategorized', 'edubin');
                    } else {
                        echo get_the_term_list(get_the_ID(), 'course-category', '');
                    }
                    echo '</span>';
                    echo '</li>';
                }

                if ( $tutor_single_language && !empty(get_the_terms(get_the_ID(), 'tutor_course_language'))) {  
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-worldwide"></i>';
                    echo '<span class="label">' . esc_html__('Language :', 'edubin') . '</span>';
                    echo '<span class="language-tag value">';
                        echo get_the_term_list(get_the_ID(), 'tutor_course_language', '');
                    echo '</span>';
                    echo '</li>';
                }
                
                if ($tutor_custom_features_position == 'bottom') {
                    get_template_part( 'tutor/tpl-part/single/meta', 'custom' );
                }

            echo '</ul>';
        echo '</div>';

        }
    }
    /**
     * Display related courses Content
     */
    
    if ( ! function_exists( 'edubin_tutor_related_course_content' ) ) {

        function edubin_tutor_related_course_content( $postType = 'courses', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $tutor_related_course_title = Edubin::setting( 'tutor_related_course_title' );
        $tutor_related_course_items = Edubin::setting( 'tutor_related_course_items' );
        $tutor_related_course_by = Edubin::setting( 'tutor_related_course_by' );
        $tutor_related_course_columns = Edubin::setting( "tutor_related_course_columns" );

        $args = array(
            'style' => $style = Edubin::setting( 'tutor_course_archive_style' )
        );

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $tutor_related_course_items;
        if (null === $relatedBy) $relatedBy = $tutor_related_course_by;
        if (null === $postType) $postType = 'courses';

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
                echo '<h3 class="related-title text-center">' . esc_html( $tutor_related_course_title ) . '</h3>';
            echo '</div>';

            echo '<div class="edubin-row">';
            while ( $custom_query->have_posts() ) : $custom_query->the_post();
                echo '<div class="edubin-col-lg-'. esc_attr( $tutor_related_course_columns ). ' edubin-col-sm-6">';

                    get_template_part( 'tutor/tpl-part/course/th-layouts', '', $args );

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

    if ( ! function_exists( 'edubin_tutor_related_course_sidebar' ) ) {

        function edubin_tutor_related_course_sidebar( $postType = 'courses', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $tutor_related_course_title = Edubin::setting( 'tutor_related_course_title' );
        $tutor_related_course_items = Edubin::setting( 'tutor_related_course_items' );
        $tutor_related_course_by = Edubin::setting( 'tutor_related_course_by' );
        $tutor_related_course_style = Edubin::setting( 'tutor_related_course_style' );
        $final_tutor_related_course_style = ($tutor_related_course_style == 'square') ? 'square' : 'round';

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $tutor_related_course_items;
        if (null === $relatedBy) $relatedBy = $tutor_related_course_by;
        if (null === $postType) $postType = 'courses';

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
        if ( $custom_query->have_posts() ) : ?>
     
              <section id="pxcv-tutor-course-2" class="widget edubin-course-widget widget_pxcv_posts style__<?php echo esc_attr($final_tutor_related_course_style); ?>">
                <h2 class="widget-title"><?php echo esc_html__('Related Courses', 'edubin'); ?></h2>
                <ul class="pxcv-rr-item-widget">

                  <?php while ( $custom_query->have_posts() ) : $custom_query->the_post(); ?>
                    <li class="clearfix has_image">

                     <?php if ( has_post_thumbnail() ) : ?>
                          
                          <a class="post__link"  href="<?php the_permalink(); ?>">
                            <div class="pxcv-rr-item-image_wrapper">
                            <?php the_post_thumbnail( 'thumbnail' ); ?>
                            </div>
                          </a>
                          
                      <?php endif; ?>

                      <div class="pxcv-rr-item-content_wrapper">
                        <a class="post__link" href="<?php the_permalink(); ?>">
                          <h6 class="post__title"><?php the_title(); ?></h6>
                        </a>
                        <span class="course-price">

                          <span class="price">
                              <?php get_template_part( 'tutor/tpl-part/price'); ?>
                           </span>

                        </span>
                      </div>
                    </li>
                  <?php endwhile; ?>

                </ul>
              </section>

        <?php endif;
        // Reset postdata
        wp_reset_postdata();

        }
    }



// ===== edubin_tutor_course_page_title_section_03

if ( ! function_exists( 'edubin_tutor_course_page_title_section_03' ) ) :
    function edubin_tutor_course_page_title_section_03( $title = null, $has_bg_image = null, $extra_style = null ) {

    $tutor_single_excerpt = Edubin::setting( 'tutor_single_excerpt' );
    $tutor_single_breadcrumb = Edubin::setting( 'tutor_single_breadcrumb' );
    $tutor_single_page_layout  = Edubin::setting( 'tutor_single_page_layout' );
    $tutor_header_color = ( $tutor_single_page_layout == '4' ) ? 'light' : 'dark' ;

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '. esc_attr( $tutor_header_color ).'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';
            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info ld">';

                    if ( $tutor_single_breadcrumb ) {

                        echo '<div class="edubin-breadcrumb-wrapper">';
                            do_action( 'edubin_breadcrumb' );
                        echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</div>';

                    if ( $tutor_single_excerpt) : 
                        echo '<div class="course-short-text">';
                                the_excerpt();
                        echo '</div>'; 
                    endif; 

               // get_template_part( 'tutor/tpl-part/single/meta', 'review-update' );
                get_template_part( 'tutor/tpl-part/single/meta', 'top' );


        echo '</div>'; 
        echo '<div class="edubin-col-lg-4"></div>'; 
      
        echo '</div>'; 
    echo '</div>'; 
echo '</div>'; 

    }
endif;


/**
 * Course page title section edubin_tutor_course_page_title_section_05
 */
if ( ! function_exists( 'edubin_tutor_course_page_title_section_05' ) ) :
    function edubin_tutor_course_page_title_section_05( $title = null, $has_bg_image = null, $extra_style = null ) {

    $tutor_single_excerpt = Edubin::setting( 'tutor_single_excerpt' );
    $tutor_single_review = Edubin::setting( 'tutor_single_review' );
    $tutor_single_last_update = Edubin::setting( 'tutor_single_last_update' );
    
    $tutor_single_page_layout  = Edubin::setting( 'tutor_single_page_layout' );

    $tutor_header_color = ( $tutor_single_page_layout == '4' ) ? 'light' : 'dark' ;
    $header_title_tag = Edubin::setting( 'header_title_tag' );
    $header_page_title_align = Edubin::setting( 'header_page_title_align' );
    $tutor_course_header_style = Edubin::setting( 'tutor_course_header_style' );
    $tutor_single_breadcrumb = Edubin::setting( 'tutor_single_breadcrumb' );

        echo '<div class="edubin-page-title-area edubin-default-breadcrumb '. esc_attr( $has_bg_image ) . 'course-header-style--' . $tutor_course_header_style .'"' . $extra_style .'>';
            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

             echo '<div class="edubin-course-top-info">';

                echo '<div class="edubin-page-title">';
                    echo '<'.$header_title_tag.' class="page-title has-text-align-'.$header_page_title_align.'">';
                      the_title();
                    echo '</'.$header_title_tag.' class="page-title">';
                echo '</div>';

                if ( $tutor_single_breadcrumb ) {

                echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                }

               edubin_breadcrumb_shapes();

              get_template_part( 'tutor/tpl-part/single/meta', 'top' );

            echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

// ===== edubin_tutor_course_page_title_section_04 ====

if ( ! function_exists( 'edubin_tutor_course_page_title_section_04' ) ) :
    function edubin_tutor_course_page_title_section_04( $title = null, $has_bg_image = null, $extra_style = null ) {

    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $prefix = '_edubin_';

    $tutor_single_excerpt = Edubin::setting( 'tutor_single_excerpt' );
    $tutor_single_review = Edubin::setting( 'tutor_single_review' );
    $tutor_single_last_update = Edubin::setting( 'tutor_single_last_update' );
    $tutor_single_page_layout  = Edubin::setting( 'tutor_single_page_layout' );

    $tutor_header_color = ( $tutor_single_page_layout == '4' ) ? 'light' : 'dark' ;

    $page_header_img = get_post_meta($post_id, $prefix . 'header_img', true);

    $tutor_intro_video_position = Edubin::setting( 'tutor_intro_video_position' ); 
    $tutor_single_social_shear = Edubin::setting( 'tutor_single_social_shear ' ); 

    $breadcrumb_show = Edubin::setting( 'breadcrumb_show' );
    $shortcode_breadcrumb = Edubin::setting( 'shortcode_breadcrumb' );
    $tutor_single_breadcrumb = Edubin::setting( 'tutor_single_breadcrumb' );

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '.$tutor_header_color.'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';

            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info tutor">';

                    if ( $tutor_single_breadcrumb ) {

                    echo '<div class="edubin-breadcrumb-wrapper">';
                        do_action( 'edubin_breadcrumb' );
                    echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</h1>';

                    if ( $tutor_single_excerpt) : 
                        echo '<div class="course-short-text">';
                            the_excerpt();
                        echo '</div>'; 
                    endif; 

                    get_template_part( 'tutor/tpl-part/single/meta', 'top' );

                echo '</div>'; // End edubin-single-course-lead-info

            echo '</div>'; // End edubin-col-lg-8

            echo '<div class="edubin-col-lg-4">';  
                if ( $tutor_single_page_layout == '5' ) {
                  get_template_part( 'tutor/tpl-part/single/media', 'header' );
                }
            echo '</div>'; // End edubin-col-lg-4

        echo '</div>';  // End edubin-row
    echo '</div>';  // End edubin-container
echo '</div>'; // End edubin-course-top-info

    }
endif;

// ===== edubin_tutor_course_page_title_section_06

if ( ! function_exists( 'edubin_tutor_course_page_title_section_06' ) ) :
    function edubin_tutor_course_page_title_section_06( $title = null, $has_bg_image = null, $extra_style = null ) {

            $custom_page_header_img = get_post_meta( get_the_ID(), '_edubin_header_img', 1 ); 
            $tutor_course_header_style  = Edubin::setting( 'tutor_course_header_style' );
            $tutor_single_breadcrumb = Edubin::setting( 'tutor_single_breadcrumb' );

        echo '<div style="background-image: url('.$custom_page_header_img.')" class="edubin-page-title-area edubin-breadcrumb-style-1 edubin-breadcrumb-has-bg '. esc_attr( $has_bg_image ) . 'course-header-style--' . $tutor_course_header_style .'"' . $extra_style .'>';

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

                get_template_part( 'tutor/tpl-part/single/meta', 'top' );

             echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

// ====== == = == = = = == = = = == = == = == = == = = == = old existing functions 


/**
 * Course Search Post Type
 */
add_filter( 'edubin_course_search_post_type', 'edubin_tl_course_search_post_type' );
if ( ! function_exists( 'edubin_tl_course_search_post_type' ) ) :
    function edubin_tl_course_search_post_type() {
        return 'courses';
    }
endif;



/**
 * Generate wishlist icon
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_tutor_wishlist_icon' ) ) :
    function edubin_tutor_wishlist_icon( $course_id ) {
// $is_wishlisted = tutor_utils()->is_wishlisted( $course_id );
// $has_wish_list = '';
// if ( $is_wishlisted ) :
//  $has_wish_list = 'has-wish-listed';
// endif;

// $action_class = '';
// if ( is_user_logged_in() ) :
//  $action_class = apply_filters( 'tutor_wishlist_btn_class', 'tutor-course-wishlist-btn' );
// else :
//  $action_class = apply_filters( 'tutor_popup_login_class', 'cart-required-login' );
// endif;

// echo '<a href="javascript:;" class="icon-22 tutor-course-wishlist-btn' . $action_class . ' ' . $has_wish_list . '" data-course-id="' . $course_id . '"></a>';

        // $course_id      = get_the_ID();
        // $is_wish_listed = tutor_utils()->is_wishlisted( $course_id );
        // $login_url_attr = '';
        // $action_class   = '';

        // if ( is_user_logged_in() ) :
        //  $action_class = apply_filters( 'tutor_wishlist_btn_class', 'tutor-course-wishlist-btn' );
        // else :
        //  $action_class = apply_filters( 'tutor_popup_login_class', 'tutor-open-login-modal' );

        //  if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) :
        //      $login_url_attr = 'data-login_url="' . esc_url( wp_login_url() ) . '"';
        //  endif;
        // endif;
        //  //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- $login_url_attr contain safe data
        //  echo '<a href="javascript:;" ' . $login_url_attr . ' class="edubin-wishlist-wrapper ' . esc_attr( $action_class ) . ' save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary ' . ( $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line' ) . '" data-course-id="' . esc_attr( $course_id ) . '">';
        //         // echo '<span class="' . ( $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line' ) . '"></span>';
        //         // echo '<i class="' . ( $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line' ) . '"></i>';
        //         echo '<i class="' . ( $is_wish_listed ? 'icon-22 on' : 'icon-22 off' ) . '"></i>';
        //     echo '</a>';



            $course_id      = get_the_ID();
            $is_wish_listed = tutor_utils()->is_wishlisted( $course_id );

            $login_url_attr = '';
            $action_class   = '';

            if ( is_user_logged_in() ) :
                $action_class = apply_filters( 'tutor_wishlist_btn_class', 'tutor-course-wishlist-btn' );
            else :
                $action_class = apply_filters( 'tutor_popup_login_class', 'tutor-open-login-modal' );

                if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) :
                    $login_url_attr = 'data-login_url="' . esc_url( wp_login_url() ) . '"';
                endif;
            endif;
                //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- $login_url_attr contain safe data
                echo '<a href="javascript:;" ' . $login_url_attr . ' class="' . esc_attr( $action_class ) . ' save-bookmark-btn" data-course-id="' . esc_attr( $course_id ) . '">
                    <i class="edubin-wishlist-wrapper ' . ( $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line' ) . '"></i>
                </a>';


// echo '<div class="tutor-course-bookmark">';
//  $course_id      = get_the_ID();
//  $is_wish_listed = tutor_utils()->is_wishlisted( $course_id );

//  $login_url_attr = '';
//  $action_class   = '';

//  if ( is_user_logged_in() ) {
//      $action_class = apply_filters( 'tutor_wishlist_btn_class', 'tutor-course-wishlist-btn' );
//  } else {
//      $action_class = apply_filters( 'tutor_popup_login_class', 'tutor-open-login-modal' );

//      if ( ! tutor_utils()->get_option( 'enable_tutor_native_login', null, true, true ) ) {
//          $login_url_attr = 'data-login_url="' . esc_url( wp_login_url() ) . '"';
//      }
//  }
//      //phpcs:disable WordPress.Security.EscapeOutput.OutputNotEscaped -- $login_url_attr contain safe data
//      echo '<a href="javascript:;" ' . $login_url_attr . ' class="' . esc_attr( $action_class ) . ' save-bookmark-btn tutor-iconic-btn tutor-iconic-btn-secondary" data-course-id="' . esc_attr( $course_id ) . '">
//             <i class="' . ( $is_wish_listed ? 'tutor-icon-bookmark-bold' : 'tutor-icon-bookmark-line' ) . '"></i>
//         </a>';
// echo '</div>';

        

    }
endif;

/**
 * Sale tag for promotional courses
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_tutor_course_sale_tag' ) ) :
    function edubin_tutor_course_sale_tag() {
        $course_price  = tutor_utils()->get_raw_course_price( get_the_ID() );
        $regular_price = $course_price->regular_price;
        $sale_price    = $course_price->sale_price;
        if ( empty( $sale_price ) ) :
            return;
        endif;
        if ( $regular_price != $sale_price ) :
            printf( '<span class="label">%s</span>', apply_filters( 'edubin_course_sale_tag_text', __( 'Sale', 'edubin' ) ) );
        endif;
    }
endif;

/**
 * post_class extends for tutor courses
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_tutor_course_class' ) ) :
    function edubin_tutor_course_class( $default = array() ) {
        $terms      = get_the_terms( get_the_ID(), 'course-category' );
        $terms_html = array();
        if ( $terms ) :
            foreach ( $terms as $term ) :
                $terms_html[] = $term->slug;
            endforeach;
        endif;
        $all_classes = array_merge( $terms_html, $default );
        $classes     = apply_filters( 'edubin_tutor_course_class', $all_classes );
        post_class( $classes );
    }
endif;

