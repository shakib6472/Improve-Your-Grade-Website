<?php

require_once get_template_directory() . '/sensei/tpl-part/review/class-review.php';

/**
 * Course Search Post Type
 */
add_filter( 'edubin_course_search_post_type', 'edubin_ss_course_search_post_type' );
if ( ! function_exists( 'edubin_ss_course_search_post_type' ) ) :
    function edubin_ss_course_search_post_type() {
        return 'course';
    }
endif;


/**
 * post_class extends for sensei courses
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_sensei_course_class' ) ) :
    function edubin_sensei_course_class( $default = array() ) {
        $terms      = get_the_terms( get_the_ID(), 'course-category' );
        $terms_html = array();
        if ( is_array( $terms ) ) :
            foreach ( $terms as $term ) :
                $terms_html[] = $term->slug;
            endforeach;
        endif;
        $all_classes = array_merge( $terms_html, $default );
        $classes = apply_filters( 'edubin_sensei_course_class', $all_classes );
        post_class( $classes );
    }
endif;

/**
 * Sensei specific scripts & stylesheets.
 *
 * @return void
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_sensei_scripts' ) ) :
    function edubin_sensei_scripts() {
        wp_enqueue_style( 'edubin-sensei-style', get_template_directory_uri() . '/assets/css/sensei.css', array(), EDUBIN_THEME_VERSION );
        if ( is_singular( 'course' ) ) :
            wp_enqueue_style( 'jquery-fancybox' );
            wp_enqueue_script( 'jquery-fancybox' );
        endif;
    }
endif;
add_action( 'wp_enqueue_scripts', 'edubin_sensei_scripts' );


function edubin_sensei_get_courses( $args = array() ) {

    $args = wp_parse_args( $args, array(
        'author' => '',
        'fields' => ''
    ) );

    extract($args);
    
    $query_args = array(
        'post_type' => 'course',
        'post_status' => 'publish'
    );

    if ( ! empty( $author ) ) :
        $query_args['author'] = $author;
    endif;

    if ( ! empty( $fields ) ) :
        $query_args['fields'] = $fields;
    endif;

    $loop = new WP_Query($query_args);
    $posts = array();
    
    if ( ! empty( $loop->posts ) ) :
        $posts = $loop->posts;
    endif;
    return $posts;
}

add_filter( 'sensei_register_post_type_course', 'edubin_sensei_post_type_comment_support' );
if ( ! function_exists( 'edubin_sensei_post_type_comment_support' ) ) :
    function edubin_sensei_post_type_comment_support( $args ) {
        $args['supports'][] = 'comments';
        return $args;
    }  
endif;

/**
 * Sensei compatibility
 *
 * @package Edubin
 */

	// edubin_declare_sensei_support
    // add_body_classes_for_sensei_lms
	// edubin_sensei_course_info
	// edubin_sensei_course_category
	// edubin_sensei_related_course_content
	// edubin_sensei_related_course_sidebar
    // edubin_sensei_course_page_title_section_03
    // edubin_sensei_course_page_title_section_04
    // edubin_sensei_course_page_title_section_05
    // edubin_sensei_course_page_title_section_06

    add_action( 'after_setup_theme', 'edubin_declare_sensei_support' );

    function edubin_declare_sensei_support() {
        add_theme_support( 'sensei' );
    }

	//** ==== Sensei add body class ** ====
	function add_body_classes_for_sensei_lms( $classes ) {

	    $prefix = '_edubin_';
	    $post_id = edubin_get_id();
		    
	    $sensei_single_page_layout = Edubin::setting( 'sensei_single_page_layout' );

	    // Get body class for Sensei lms profile page
	    if ( class_exists('Sensei_Main') && $sensei_single_page_layout && is_singular( 'course' )) {
	        $classes[] = 'single-course-layout-0'.$sensei_single_page_layout.'';
	    } // End - Get body class for Sensei lms profile page
	    
	    // Finally $classes return 
		return $classes;

	}
	add_filter( 'body_class', 'add_body_classes_for_sensei_lms' );

   // ==== Display Course info / edubin_sensei_course_info =====
    
    if ( ! function_exists( 'edubin_sensei_course_info' ) ) {

        function edubin_sensei_course_info() {  

            $sensei_single_page_layout = Edubin::setting( 'sensei_single_page_layout' );
            $sensei_intro_video_position = Edubin::setting( 'sensei_intro_video_position' );
            $sensei_instructor_single = Edubin::setting( 'sensei_instructor_single' );
            $sensei_single_duration = Edubin::setting( 'sensei_single_duration' );
            $sensei_single_lesson = Edubin::setting( 'sensei_single_lesson' ); 
            $sensei_single_topic = Edubin::setting( 'sensei_single_topic' ); 
            $sensei_single_cat = Edubin::setting( 'sensei_single_cat' ); 
            $sensei_single_language = Edubin::setting( 'sensei_single_language' );  
            $sensei_single_info_heading = Edubin::setting( 'sensei_single_info_heading'); 
            $sensei_custom_features_position = Edubin::setting( 'sensei_custom_features_position' );

        echo '<div class="edubin-course-info">';

            if ($sensei_single_info_heading) {
                echo '<h4 class="ld-segment-title tpc_mt_30">' . esc_html($sensei_single_info_heading) . '</h4>';
            } 

            echo '<ul class="course-info-list">';

                if ($sensei_custom_features_position == 'top') {
                   get_template_part( 'sensei/tpl-part/single/meta', 'custom' );
                }
                
                if ($sensei_instructor_single) { 
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-student"></i>';
                    echo '<span class="label">' . esc_html__('Created by :', 'edubin') . '</span>';
                    echo '<span class="value">' . get_the_author() . '</span>';
                    echo '</li>';
                }
                
                if ($sensei_single_lesson ) {

                    $course              = get_post( get_the_ID() );
                    $lesson_count        = Sensei()->course->course_lesson_count( get_the_ID() );
                    $lesson_text = ('1' == $lesson_count) ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin');

                    echo '<li>';
                    echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="label">' . esc_html__('Lessons :', 'edubin') . '</span>';
                    echo '<span class="value">' . esc_attr($lesson_count) . ' ' . esc_html($lesson_text) . '</span>';
                    echo '</li>';
                }
 
                if ( $sensei_single_cat && get_the_terms(get_the_ID(), 'course-category') ) {
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-tags"></i>';
                    echo '<span class="label">' . esc_html__('Category :', 'edubin') . '</span>';
                    echo '<span class="sensei_course_cat value">';
                    if (!get_the_terms(get_the_ID(), 'course-category')) {
                        esc_html_e('Uncategorized', 'edubin');
                    } else {
                        echo get_the_term_list(get_the_ID(), 'course-category', '');
                    }
                    echo '</span>';
                    echo '</li>';
                }
                
                if ( $sensei_single_language && !empty(get_the_terms(get_the_ID(), 'sensei_course_language')) ) {  
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-worldwide"></i>';
                    echo '<span class="label">' . esc_html__('Language :', 'edubin') . '</span>';
                    echo '<span class="language-tag value">';
                    if (!get_the_terms(get_the_ID(), 'sensei_course_language')) {
                        echo get_the_term_list(get_the_ID(), 'sensei_course_language', '');
                    }
                    echo '</span>';
                    echo '</li>';
                }
                
                if ($sensei_custom_features_position == 'bottom') {
                    get_template_part( 'sensei/tpl-part/single/meta', 'custom' );
                }

            echo '</ul>';
        echo '</div>';

        }
    }

    /**
     * Display Course Category
     */
    
    if ( ! function_exists( 'edubin_sensei_course_category' ) ) {

        function edubin_sensei_course_category() {  

        ?>
       <!--  Sensei Course Category -->
        <div class="sensei__widget">    
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


    /**
     * Display related courses Content
     */
    
    if ( ! function_exists( 'edubin_sensei_related_course_content' ) ) {

        function edubin_sensei_related_course_content( $postType = 'course', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $sensei_related_course_title = Edubin::setting( 'sensei_related_course_title' );
        $sensei_related_course_items = Edubin::setting( 'sensei_related_course_items' );
        $sensei_related_course_by = Edubin::setting( 'sensei_related_course_by' );

        $sensei_related_course_columns = Edubin::setting( "sensei_related_course_columns" );

        $args = array(
            'style' => $style = Edubin::setting( 'sensei_course_archive_style' )
        );

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $sensei_related_course_items;
        if (null === $relatedBy) $relatedBy = $sensei_related_course_by;
        if (null === $postType) $postType = 'course';

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
                echo '<h3 class="related-title text-center">' . esc_html( $sensei_related_course_title ) . '</h3>';
            echo '</div>';

            echo '<div class="edubin-row">';
            while ( $custom_query->have_posts() ) : $custom_query->the_post();
                echo '<div class="edubin-col-lg-'. esc_attr( $sensei_related_course_columns ). ' edubin-col-sm-6">';

                    get_template_part( 'sensei/tpl-part/course/course-layouts', '', $args );

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

    if ( ! function_exists( 'edubin_sensei_related_course_sidebar' ) ) {

        function edubin_sensei_related_course_sidebar( $postType = 'course', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $sensei_related_course_title = Edubin::setting( 'sensei_related_course_title' );
        $sensei_related_course_items = Edubin::setting( 'sensei_related_course_items' );
        $sensei_related_course_by = Edubin::setting( 'sensei_related_course_by' );
        $sensei_related_course_style = Edubin::setting( 'sensei_related_course_style' );
        $final_sensei_related_course_style = ($sensei_related_course_style == 'square') ? 'square' : 'round';

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $sensei_related_course_items;
        if (null === $relatedBy) $relatedBy = $sensei_related_course_by;
        if (null === $postType) $postType = 'course';

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
     
              <section id="pxcv-sensei-course-2" class="widget edubin-course-widget widget_pxcv_posts style__<?php echo esc_attr($final_sensei_related_course_style); ?>">
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
                        <?php get_template_part( 'sensei/tpl-part/price'); ?>
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

    /**
     * Sensei course archive page post_per_page
     */
       
    function edubin_sensei_archive_course_post_per_page( $query ) {

        $sensei_course_per_pag = Edubin::setting( 'sensei_course_per_page' );

        if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'course' ) ) {
            $query->set( 'posts_per_page', $sensei_course_per_pag );

        }

        return;
    }
    add_action( 'pre_get_posts', 'edubin_sensei_archive_course_post_per_page', 15 );


// ===== edubin_sensei_course_page_title_section_03

if ( ! function_exists( 'edubin_sensei_course_page_title_section_03' ) ) :
    function edubin_sensei_course_page_title_section_03( $title = null, $has_bg_image = null, $extra_style = null ) {

    $sensei_single_short_text = Edubin::setting( 'sensei_single_short_text' );
    $sensei_single_breadcrumb = Edubin::setting( 'sensei_single_breadcrumb' );
    $sensei_single_page_layout  = Edubin::setting( 'sensei_single_page_layout' );
    $sensei_header_color = ( $sensei_single_page_layout == '4' ) ? 'light' : 'dark' ;

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '. esc_attr( $sensei_header_color ).'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';
            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info ld">';

                    if ( $sensei_single_breadcrumb ) {

                        echo '<div class="edubin-breadcrumb-wrapper">';
                            do_action( 'edubin_breadcrumb' );
                        echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</div>';

                    if ( $sensei_single_short_text) : 
                        echo '<div class="course-short-text">';
                                the_excerpt();
                        echo '</div>'; 
                    endif; 

               // get_template_part( 'sensei/tpl-part/single/meta', 'review-update' );
                get_template_part( 'sensei/tpl-part/single/meta', 'top' );


        echo '</div>'; 
        echo '<div class="edubin-col-lg-4"></div>'; 
      
        echo '</div>'; 
    echo '</div>'; 
echo '</div>'; 

    }
endif;


/**
 * Course page title section edubin_sensei_course_page_title_section_05
 */
if ( ! function_exists( 'edubin_sensei_course_page_title_section_05' ) ) :
    function edubin_sensei_course_page_title_section_05( $title = null, $has_bg_image = null, $extra_style = null ) {

    $sensei_single_short_text = Edubin::setting( 'sensei_single_short_text' );
    $sensei_single_review = Edubin::setting( 'sensei_single_review' );
    $sensei_single_last_update = Edubin::setting( 'sensei_single_last_update' );
    
    $sensei_single_page_layout  = Edubin::setting( 'sensei_single_page_layout' );

    $sensei_header_color = ( $sensei_single_page_layout == '4' ) ? 'light' : 'dark' ;
    $header_title_tag = Edubin::setting( 'header_title_tag' );
    $header_page_title_align = Edubin::setting( 'header_page_title_align' );
    $sensei_course_header_style = Edubin::setting( 'sensei_course_header_style' );
    $sensei_single_breadcrumb = Edubin::setting( 'sensei_single_breadcrumb' );

        echo '<div class="edubin-page-title-area edubin-default-breadcrumb '. esc_attr( $has_bg_image ) . 'course-header-style--' . $sensei_course_header_style .'"' . $extra_style .'>';
            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

             echo '<div class="edubin-course-top-info">';

                echo '<div class="edubin-page-title">';
                    echo '<'.$header_title_tag.' class="page-title has-text-align-'.$header_page_title_align.'">';
                      the_title();
                    echo '</'.$header_title_tag.' class="page-title">';
                echo '</div>';

                if ( $sensei_single_breadcrumb ) {

                echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                }

               edubin_breadcrumb_shapes();

              get_template_part( 'sensei/tpl-part/single/meta', 'top' );

            echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

// ===== edubin_sensei_course_page_title_section_04 ====

if ( ! function_exists( 'edubin_sensei_course_page_title_section_04' ) ) :
    function edubin_sensei_course_page_title_section_04( $title = null, $has_bg_image = null, $extra_style = null ) {

    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $prefix = '_edubin_';

    $sensei_single_short_text = Edubin::setting( 'sensei_single_short_text' );
    $sensei_single_review = Edubin::setting( 'sensei_single_review' );
    $sensei_single_last_update = Edubin::setting( 'sensei_single_last_update' );
    $sensei_single_page_layout  = Edubin::setting( 'sensei_single_page_layout' );

    $sensei_header_color = ( $sensei_single_page_layout == '4' ) ? 'light' : 'dark' ;

    $page_header_img = get_post_meta($post_id, $prefix . 'header_img', true);

    $sensei_intro_video_position = Edubin::setting( 'sensei_intro_video_position' ); 
    $sensei_single_social_shear = Edubin::setting( 'sensei_single_social_shear ' ); 

    $breadcrumb_show = Edubin::setting( 'breadcrumb_show' );
    $shortcode_breadcrumb = Edubin::setting( 'shortcode_breadcrumb' );
    $sensei_single_breadcrumb = Edubin::setting( 'sensei_single_breadcrumb' );

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '.$sensei_header_color.'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';

            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info lp">';

                    if ( $sensei_single_breadcrumb ) {

                    echo '<div class="edubin-breadcrumb-wrapper">';
                        do_action( 'edubin_breadcrumb' );
                    echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</h1>';

                    if ( $sensei_single_short_text) : 
                        echo '<div class="course-short-text">';
                            the_excerpt();
                        echo '</div>'; 
                    endif; 

                    get_template_part( 'sensei/tpl-part/single/meta', 'top' );

                echo '</div>'; // End edubin-single-course-lead-info

            echo '</div>'; // End edubin-col-lg-8

            echo '<div class="edubin-col-lg-4">';  
                if ( $sensei_single_page_layout == '5' ) {
                  get_template_part( 'sensei/tpl-part/single/media', 'header' );
                }
            echo '</div>'; // End edubin-col-lg-4

        echo '</div>';  // End edubin-row
    echo '</div>';  // End edubin-container
echo '</div>'; // End edubin-course-top-info

    }
endif;

// ===== edubin_sensei_course_page_title_section_06

if ( ! function_exists( 'edubin_sensei_course_page_title_section_06' ) ) :
    function edubin_sensei_course_page_title_section_06( $title = null, $has_bg_image = null, $extra_style = null ) {

            $custom_page_header_img = get_post_meta( get_the_ID(), '_edubin_header_img', 1 ); 
            $sensei_single_short_text = Edubin::setting( 'sensei_single_short_text' );
            $sensei_single_review = Edubin::setting( 'sensei_single_review' );
            $sensei_single_last_update = Edubin::setting( 'sensei_single_last_update' );
            $sensei_single_page_layout  = Edubin::setting( 'sensei_single_page_layout' );
            $sensei_course_header_style  = Edubin::setting( 'sensei_course_header_style' );
            $sensei_single_breadcrumb = Edubin::setting( 'sensei_single_breadcrumb' );

        echo '<div style="background-image: url('.$custom_page_header_img.')" class="edubin-page-title-area edubin-breadcrumb-style-1 edubin-breadcrumb-has-bg '. esc_attr( $has_bg_image ) . 'course-header-style--' . $sensei_course_header_style .'"' . $extra_style .'>';

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

                get_template_part( 'sensei/tpl-part/single/meta', 'top' );

             echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

