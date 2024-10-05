<?php

/**
 * LearnPress compatibility
 *
 * @package Edubin
 */

// add_body_classes_for_lp_lms
// edubin_lp_course_info
// edubin_lp_course_category
// edubin_lp_related_course_content
// edubin_lp_related_course_sidebar
// edubin_lp_course_page_title_section_03
// edubin_lp_course_page_title_section_04
// edubin_lp_course_page_title_section_05
// edubin_lp_course_page_title_section_06

	/// Enable LearnPress template override
	add_filter( 'learn-press/override-templates', '__return_true' );

	if (class_exists('LearnPress')):
		remove_action( 'learn-press/before-main-content', LearnPress::instance()->template( 'general' )->func( 'breadcrumb' ) );
	endif;

	//** ==== LearnPress add body class ** ====
	function add_body_classes_for_lp_lms( $classes ) {

	    $prefix = '_edubin_';
	    $post_id = edubin_get_id();
		    
	    $lp_single_page_layout = Edubin::setting( 'lp_single_page_layout' );

	    // Get body class for LearnPress lms profile page
	    if ( class_exists('LearnPress') && $lp_single_page_layout && is_singular( 'lp_course' )) {
	        $classes[] = 'single-course-layout-0'.$lp_single_page_layout.'';
	    } // End - Get body class for LearnPress lms profile page
	    
	    // Finally $classes return 
		return $classes;

	}
	add_filter( 'body_class', 'add_body_classes_for_lp_lms' );

	/// Admin notice for old version plugin
	if (class_exists('LearnPress')):
	        $get_lp_plugin_dir = WP_PLUGIN_DIR . '/learnpress/learnpress.php';
	        $lp_plugin_version_number = get_plugin_data($get_lp_plugin_dir);

	        if ( $lp_plugin_version_number['Version'] < '3.9.9.9'):

	        function edubin_admin_notice_olp_lp() {
	            ?>
	            <div class="notice notice notice-error is-dismissible">
	                <h2 style=" color: #d63638;"><?php _e( "Your site LearnPress LMS plugin is an old version. Please update it to get LearnPress V4+ features.", 'edubin' ); ?> <a href="<?php echo admin_url( 'plugins.php' ); ?>"><?php _e( 'Update Now', 'edubin' ); ?></a></h2>
	               
	            </div>
	            <?php
	        }
	        add_action( 'admin_notices', 'edubin_admin_notice_olp_lp' );

	        endif;

	endif;

	/// TP Class for archive
	if ( ! class_exists( 'TP' ) ) {
		class TP {

			protected static $_instance = null;

			static function instance() {
				if ( ! self::$_instance ) {
					self::$_instance = new self();
				}

				return self::$_instance;
			}
		}
		TP::instance();
	}// End if().


/**
 * Learnpress course info
 */

if (!function_exists('edubin_lp_course_info')) {

    function edubin_lp_course_info()
    {

        global $post;
        $post_id    = $post->ID;
        // Prefix
        $prefix = '_edubin_';

        $course_id = get_the_ID();
        $course    = learn_press_get_course();

        $lp_duration     = get_post_meta(get_the_ID(), '_lp_duration');
        
        $lp_students     = get_post_meta(get_the_ID(), '_lp_students');
        $lp_retake_count = get_post_meta(get_the_ID(), '_lp_retake_count');
        $lp_curriculum   = get_post_meta(get_the_ID(), '_lp_curriculum');
        $lp_quizzes      = $course->get_curriculum_items('lp_quiz');

        $lp_custom_features_position    = Edubin::setting( 'lp_custom_features_position' );
        $lp_course_feature_quizzes      = Edubin::setting( 'lp_course_feature_quizzes' );
        $lp_course_feature_duration     = Edubin::setting( 'lp_course_feature_duration' );
        $lp_course_feature_lessons     = Edubin::setting( 'lp_course_feature_lessons' );
        $lp_course_feature_max_tudents  = Edubin::setting( 'lp_course_feature_max_tudents' );
        $lp_course_feature_enroll       = Edubin::setting( 'lp_course_feature_enroll' );
        $lp_course_feature_retake_count = Edubin::setting( 'lp_course_feature_retake_count' );
        $lp_course_feature_skill_level  = Edubin::setting( 'lp_course_feature_skill_level' );
        $lp_course_feature_language     = Edubin::setting( 'lp_course_feature_language' );
        $lp_course_feature_assessments  = Edubin::setting( 'lp_course_feature_assessments' );
        $lp_course_feature_cat  = Edubin::setting( 'lp_course_feature_cat' );

        $lp_course_feature_quizzes_show      = Edubin::setting( 'lp_course_feature_quizzes_show' );
        $lp_course_feature_duration_show     = Edubin::setting( 'lp_course_feature_duration_show' );
        $lp_course_feature_lessons_show     = Edubin::setting( 'lp_course_feature_lessons_show' );
        $lp_course_feature_max_students_show = Edubin::setting( 'lp_course_feature_max_students_show' );
        $lp_course_feature_enroll_show       = Edubin::setting( 'lp_course_feature_enroll_show' );
        $lp_course_feature_retake_count_show = Edubin::setting( 'lp_course_feature_retake_count_show' );
        $lp_course_feature_skill_level_show  = Edubin::setting( 'lp_course_feature_skill_level_show' );
        $lp_course_feature_language_show     = Edubin::setting( 'lp_course_feature_language_show' );
        $lp_course_feature_assessments_show  = Edubin::setting( 'lp_course_feature_assessments_show' );
        $lp_course_feature_cat_show  = Edubin::setting( 'lp_course_feature_cat_show' );
        $lp_intro_video_position  = Edubin::setting( 'lp_intro_video_position' );
		$lp_single_page_layout = Edubin::setting( 'lp_single_page_layout' );
		$lp_single_info_heading = Edubin::setting( 'lp_single_info_heading' );  
		$lp_instructor_single = Edubin::setting( 'lp_instructor_single' );  
		$lp_single_course_price  = Edubin::setting( 'lp_single_course_price ' );  

		$edubin_lp_video = get_post_meta( get_the_ID(), 'edubin_lp_video', 1 ); 

		?>

	<?php

	//if ( $lp_single_page_layout == '1') : // The section visible only for layout 2 ?>
		<div class="edubin-course-info">
			<?php if ($lp_single_info_heading) { ?>
	 			<h4 class="ld-segment-title tpc_mt_30"><?php echo esc_html( $lp_single_info_heading );?></h4>
	 		<?php } ?>
			<ul class="course-info-list">

			<!-- Custom course features cmb2 reparable meta display for top area-->
			<?php if ( $lp_custom_features_position == 'top' ) : ?>
	            <?php
					$lp_custom_feature_group = get_post_meta(get_the_ID(), 'lp_custom_feature_group', true);
	        		if ( $lp_custom_feature_group): ?>
	                    <?php
						foreach ((array) $lp_custom_feature_group as $key => $entry) {?>

								<li>
	                       			<?php if (isset($entry['lp_custom_feature_group_icon'])): 

									$if_has_dashicons = ( str_contains( $entry['lp_custom_feature_group_icon'] , 'dashicons' ) ? 'dashicons' : ''); // Check if dashicons icon library

									$if_has_fontwsome = ( str_contains( $entry['lp_custom_feature_group_icon'] , 'fa-' ) ? 'fa' : ''); // Check if dashicons icon library

	                       			?>
										<i class="<?php echo esc_html($if_has_fontwsome); ?> <?php echo esc_html($if_has_dashicons); ?> <?php echo esc_html($entry['lp_custom_feature_group_icon']); ?>"></i>
									<?php else: ?>
										<i class="flaticon-play-button"></i>
	                        		<?php endif;?>

	                       			<?php if (isset($entry['lp_custom_feature_group_label'])): ?>
										<span class="label"><?php echo esc_html($entry['lp_custom_feature_group_label']); ?> <?php echo esc_attr( ':' ); ?></span>
	                        		<?php endif;?>
	                        		<?php if (isset($entry['lp_custom_feature_group_value'])): ?>
										<span class="value"><?php echo esc_html($entry['lp_custom_feature_group_value']); ?></span>
									<?php endif;?>
								</li>

	                       	<?php
								}
				        endif;
				        ?>
			<?php endif; ?>

			<!-- Main Course info area -->

				<?php //if ( $lp_single_course_price  ): ?>
					<li>
						<i class="flaticon-price-tag"></i>
					<?php if ( $lp_course_feature_enroll): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_enroll); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Price :', 'edubin');?></span>
					<?php endif;?>

						<span class="value"><?php  LP()->template( 'course' )->courses_loop_item_price(); ?></span>
					</li>
				<?php //endif?>


				<?php if ( !in_array($lp_single_page_layout , array('2', '4', '6')) && $lp_students && $lp_course_feature_enroll_show ): ?>
					<li>
						<i class="flaticon-study"></i>
					<?php if ( $lp_course_feature_enroll): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_enroll); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Enrolled :', 'edubin');?></span>
					<?php endif;?>
						<?php $user_count = $course->get_users_enrolled() ? $course->get_users_enrolled() : 0; ?>
						<span class="value"><?php echo esc_html($user_count); ?></span>
					</li>
				<?php endif?>

				<?php if ( $lp_duration && $lp_course_feature_duration_show ): ?>
					<li>
						<i class="flaticon-start"></i>
					<?php if ( $lp_course_feature_duration): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_duration); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Duration :', 'edubin');?></span>
					<?php endif;?>
						<span class="value"><?php echo esc_html($lp_duration[0]); ?></span>
					</li>
				<?php endif; ?>

	            <?php
	                $lessons = $course->get_items('lp_lesson', false) ? count($course->get_items('lp_lesson', false)) : 0;
	                $lessons_text = ('1' == $lessons) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');
	            ?>  
				<?php if ( !in_array($lp_single_page_layout , array('2', '4', '6')) && $lessons  && $lp_course_feature_lessons_show ): ?>
					<li>
						<i class="flaticon-book"></i>
					<?php if ( $lp_course_feature_lessons): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_lessons); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Lessons :', 'edubin');?></span>
					<?php endif;?>
						<span class="value"><?php echo esc_attr( $lessons ) . $lessons_text; ?></span>
					</li>
				<?php endif; ?>

	            <?php
	                $quiz = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
	                $quiz_text = ('1' == $quiz) ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quizzes', 'edubin');
	            ?>  

				<?php if ( !in_array($lp_single_page_layout , array('2', '4', '6')) &&  $quiz && $lp_course_feature_quizzes_show ): ?>
				<li>
					<i class="flaticon-pin"></i>
					<?php if ( $lp_course_feature_quizzes): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_quizzes); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Quizzes :', 'edubin');?></span>
					<?php endif;?>
					<span class="value"><?php echo esc_attr( $quiz ) . $quiz_text; ?></span>
				</li>
				<?php endif; ?>
	
				<?php //if ( $lp_retake_count[0] && $lp_course_feature_retake_count_show == '1'): ?>
					<li>
						<i class="flaticon-reload"></i>
					<?php if ( $lp_course_feature_retake_count): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_retake_count); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Re-take Course :', 'edubin');?></span>
					<?php endif;?>
						<span class="value"><?php echo esc_html($lp_retake_count[0]); ?></span>
					</li>
				<?php //endif; ?>
		
				<?php //if ( $course_id && $lp_course_feature_assessments_show == '1'): ?>
					<li>
						<i class="flaticon-checklist"></i>
					<?php if ( $lp_course_feature_assessments): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_assessments); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Assessments :', 'edubin');?></span>
					<?php endif;?>
						<span class="value"><?php echo (get_post_meta($course_id, '_lpr_course_final', true) == 'yes') ? esc_html_e('Yes', 'edubin') : esc_html_e('Self', 'edubin'); ?></span>
					</li>
				<?php //endif; ?>
				<?php
				$course_levels =  learn_press_get_post_level( get_the_ID() );
				if ( $course_levels && $lp_course_feature_skill_level_show ): ?>
					<li>
						<i class="flaticon-network"></i>
					<?php if ( $lp_course_feature_skill_level): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_skill_level); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Skill Level :', 'edubin');?></span>
					<?php endif;?>
						<span class="value"><?php echo esc_html( $course_levels ); ?></span>
					</li>
				<?php endif?>
				<?php
				$edubin_course_cat = get_the_terms( get_the_ID(), 'course_language' );;
	        	if ( $edubin_course_cat && $lp_course_feature_cat_show == '1'): ?>
					<li>
						<i class="flaticon-folder"></i>
					<?php if ( $lp_course_feature_cat): ?>
						<span class="label"><?php echo esc_html($lp_course_feature_cat); ?></span>
					<?php else: ?>
						<span class="label"><?php esc_html_e('Category :', 'edubin');?></span>
					<?php endif;?>
						<span class="lp_course_cat value">
							<?php 
								echo get_the_term_list(get_the_ID(), 'course_category', '', ' ', '');
							?>
							</span>
					</li>
				<?php endif?>

				<?php
				if ($lp_course_feature_language_show && !empty(get_the_terms(get_the_ID(), 'lp_course_language'))) {  
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-worldwide"></i>';
                    echo '<span class="label">' . esc_html__('Language :', 'edubin') . '</span>';
                    echo '<span class="language-tag value">';
                        echo get_the_term_list(get_the_ID(), 'lp_course_language', '');
                    echo '</span>';
                    echo '</li>';
                } ?>

			<?php if ( $lp_custom_features_position == 'bottom') : ?>
				<!-- Custom course features cmb2 reparable meta display (bottom area) -->
	            <?php
					$lp_custom_feature_group = get_post_meta(get_the_ID(), 'lp_custom_feature_group', true);
	        		if ( $lp_custom_feature_group): ?>
	                    <?php
						foreach ((array) $lp_custom_feature_group as $key => $entry) {?>

								<li>
	                       			<?php if (isset($entry['lp_custom_feature_group_icon'])): 

	                       				$if_has_dashicons = ( str_contains( $entry['lp_custom_feature_group_icon'] , 'dashicons' ) ? 'dashicons' : ''); // Check if dashicons icon library
	                       				$if_has_fontwsome = ( str_contains( $entry['lp_custom_feature_group_icon'] , 'fa-' ) ? 'fa' : ''); // Check if dashicons icon 
	                       			?>
										<i class="<?php echo esc_html($if_has_fontwsome); ?> <?php echo esc_html($if_has_dashicons); ?> <?php echo esc_html($entry['lp_custom_feature_group_icon']); ?>"></i>
									<?php else: ?>
										<i class="flaticon-play-button"></i>
	                        		<?php endif;?>

	                       			<?php if (isset($entry['lp_custom_feature_group_label'])): ?>
										<span class="label"> <?php echo esc_html($entry['lp_custom_feature_group_label']); ?> <?php echo esc_attr( ':' ); ?></span>
	                        		<?php endif;?>
	                        		<?php if (isset($entry['lp_custom_feature_group_value'])): ?>
										<span class="value"><?php echo esc_html($entry['lp_custom_feature_group_value']); ?></span>
									<?php endif;?>
								</li>

	                       	<?php
						}
				    endif;
				        ?>
			<?php endif; ?>
			
			</ul>
			<?php         
			//if ( $lp_single_enroll_btn ) { 
          // Buttons.
          LP()->template( 'course' )->course_buttons();
      //  } ?>
		</div>
	<?php //endif; ?>
		<?php

	    }
	}

    /**
     * Display Course Category
     */
    
    if ( ! function_exists( 'edubin_lp_course_category' ) ) {

        function edubin_lp_course_category() {  

        global $post;
        $post_id    = $post->ID;

        ?>
       <!--  LearnPress Course Category -->
        <div class="lp__widget">    
            <section class="widget edubin-course-widget">
                <h2 class="widget-title"><?php esc_html_e('Course Categories', 'edubin');?></h2> 
                <?php
                
                $args = array(
                   'taxonomy' => 'course_category',
                   'orderby' => 'name',
                   'order'   => 'ASC'
                );
               $terms = get_categories($args);
               
                if ($terms && ! is_wp_error($terms)): ?>
                    <ul>
                    <?php foreach($terms as $term): ?>
                        <li><a href="<?php echo get_term_link( $term->slug, 'course_category'); ?>" rel="tag" class="<?php echo esc_attr($term->slug); ?>"><?php echo esc_html($term->name); ?></a></li>
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
    
    if ( ! function_exists( 'edubin_lp_related_course_content' ) ) {

        function edubin_lp_related_course_content( $postType = 'lp_course', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $lp_related_course_title = Edubin::setting( 'lp_related_course_title' );
        $lp_related_course_items = Edubin::setting( 'lp_related_course_items' );
        $lp_related_course_by = Edubin::setting( 'lp_related_course_by' );

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $lp_related_course_items;
        if (null === $relatedBy) $relatedBy = $lp_related_course_by;
        if (null === $postType) $postType = 'lp_course';

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

        $lp_related_course_columns = Edubin::setting( 'lp_related_course_columns' );

		$style = Edubin::setting( 'lp_course_archive_style' );

		if ( 'default' === $style ) :
		    $style = Edubin::setting( 'lp_course_archive_style' );
		endif;

		$layout_data = array(
		    'style' => $style
		);

        // Initiate the custom query
        $custom_query = new WP_Query( $related_posts_custom_query_args );

        // Run the loop and output data for the results
        if ( $custom_query->have_posts() ) : 

			echo '<div class="related-post-title-wrap">';
				echo '<h3 class="related-title text-center">' . esc_html( $lp_related_course_title ) . '</h3>';
			echo '</div>';

			echo '<div class="edubin-row">';
			while ( $custom_query->have_posts() ) : $custom_query->the_post();
			    echo '<div class="edubin-col-lg-'. esc_attr( $lp_related_course_columns ). ' edubin-col-sm-6">';
			    	learn_press_get_template( 'tpl-part/course/th-layouts.php', compact( 'layout_data' ) );
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

    if ( ! function_exists( 'edubin_lp_related_course_sidebar' ) ) {

        function edubin_lp_related_course_sidebar( $postType = 'lp_course', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $lp_related_course_title = Edubin::setting( 'lp_related_course_title' );
        $lp_related_course_items = Edubin::setting( 'lp_related_course_items' );
        $lp_related_course_by = Edubin::setting( 'lp_related_course_by' );
        $lp_related_course_style = Edubin::setting( 'lp_related_course_style' );
        $final_lp_related_course_style = ($lp_related_course_style == 'square') ? 'square' : 'round';

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $lp_related_course_items;
        if (null === $relatedBy) $relatedBy = $lp_related_course_by;
        if (null === $postType) $postType = 'lp_course';

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
     
		echo '<section id="pxcv-learndash-course-2" class="widget edubin-course-widget widget_pxcv_posts style__' . esc_attr($final_lp_related_course_style) . '">';
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
		    // echo esc_html($price);
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


// ===== edubin_lp_course_page_title_section_06

if ( ! function_exists( 'edubin_lp_course_page_title_section_06' ) ) :
    function edubin_lp_course_page_title_section_06( $title = null, $has_bg_image = null, $extra_style = null ) {

            $custom_page_header_img = get_post_meta( get_the_ID(), '_edubin_header_img', 1 ); 
            $lp_single_breadcrumb = Edubin::setting( 'lp_single_breadcrumb' );
            $lp_course_header_style = Edubin::setting( 'lp_course_header_style' );

        echo '<div style="background-image: url('.$custom_page_header_img.')" class="edubin-page-title-area edubin-breadcrumb-style-1 edubin-breadcrumb-has-bg '. esc_attr( $has_bg_image ) . 'course-header-style--' . $lp_course_header_style .'"' . $extra_style .'>';

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

                get_template_part( 'learnpress/tpl-part/single/meta', 'top' );

             echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

/**
 * Course page title section edubin_lp_course_page_title_section_05
 */
if ( ! function_exists( 'edubin_lp_course_page_title_section_05' ) ) :
    function edubin_lp_course_page_title_section_05( $title = null, $has_bg_image = null, $extra_style = null ) {

  
 	global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $course    = learn_press_get_course();
    $prefix = '_edubin_';

	//$lp_course_header_image = get_post_meta( get_the_ID(), '_edubin_lp_course_header_image', 1 ); 

	$lp_single_excerpt = Edubin::setting( 'lp_single_excerpt' );
	$lp_single_review = Edubin::setting( 'lp_single_review' );
	$lp_single_last_update = Edubin::setting( 'lp_single_last_update' );
	$lp_instructor_single = Edubin::setting( 'lp_instructor_single' );
	$lp_course_feature_quizzes_show      = Edubin::setting( 'lp_course_feature_quizzes_show' );
	$lp_course_feature_duration_show     = Edubin::setting( 'lp_course_feature_duration_show' );
	$lp_course_feature_lessons_show     = Edubin::setting( 'lp_course_feature_lessons_show' );
	$lp_course_feature_max_students_show = Edubin::setting( 'lp_course_feature_max_students_show' );
	$lp_course_feature_enroll_show       = Edubin::setting( 'lp_course_feature_enroll_show' );
	$lp_course_feature_retake_count_show = Edubin::setting( 'lp_course_feature_retake_count_show' );
	$lp_course_feature_skill_level_show  = Edubin::setting( 'lp_course_feature_skill_level_show' );
	$lp_course_feature_language_show     = Edubin::setting( 'lp_course_feature_language_show' );
	$lp_course_feature_assessments_show  = Edubin::setting( 'lp_course_feature_assessments_show' );
	$lp_course_feature_cat_show  = Edubin::setting( 'lp_course_feature_cat_show' );
	$lp_single_page_layout  = Edubin::setting( 'lp_single_page_layout' );

	$lp_header_color = ( $lp_single_page_layout == '4' ) ? 'light' : 'dark' ;
	$header_title_tag = Edubin::setting( 'header_title_tag' );
	$header_page_title_align = Edubin::setting( 'header_page_title_align' );
	$lp_course_header_style = Edubin::setting( 'lp_course_header_style' );
    $lp_single_breadcrumb = Edubin::setting( 'lp_single_breadcrumb' );

        echo '<div class="edubin-page-title-area edubin-default-breadcrumb '. esc_attr( $has_bg_image ) . 'course-header-style--' . $lp_course_header_style .'"' . $extra_style .'>';
            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

             echo '<div class="edubin-course-top-info">';

                echo '<div class="edubin-page-title">';
                    echo '<'.$header_title_tag.' class="page-title has-text-align-'.$header_page_title_align.'">';
                        the_title();
                    echo '</'.$header_title_tag.' class="page-title">';
                echo '</div>';

                if ( $lp_single_breadcrumb ) {

                echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                }

    			edubin_breadcrumb_shapes();

             	get_template_part( 'learnpress/tpl-part/single/meta', 'top' );

			echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

// ===== edubin_lp_course_page_title_section_03

if ( ! function_exists( 'edubin_lp_course_page_title_section_03' ) ) :
    function edubin_lp_course_page_title_section_03( $title = null, $has_bg_image = null, $extra_style = null ) {

    $lp_single_excerpt = Edubin::setting( 'lp_single_excerpt' );
    $lp_single_breadcrumb = Edubin::setting( 'lp_single_breadcrumb' );
    $lp_single_page_layout  = Edubin::setting( 'lp_single_page_layout' );
    $lp_header_color = ( $lp_single_page_layout == '4' ) ? 'light' : 'dark' ;

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '. esc_attr( $lp_header_color ).'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';
            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info ld">';

                    if ( $lp_single_breadcrumb ) {

                        echo '<div class="edubin-breadcrumb-wrapper">';
                            do_action( 'edubin_breadcrumb' );
                        echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</div>';

                    if ( $lp_single_excerpt) : 
                        echo '<div class="course-short-text">';
                                the_excerpt();
                        echo '</div>'; 
                    endif; 

               // get_template_part( 'lp/tpl-part/single/meta', 'review-update' );
                get_template_part( 'learnpress/tpl-part/single/meta', 'top' );


        echo '</div>'; 
        echo '<div class="edubin-col-lg-4"></div>'; 
      
        echo '</div>'; 
    echo '</div>'; 
echo '</div>'; 

    }
endif;

// ===== edubin_lp_course_page_title_section_04 ====

if ( ! function_exists( 'edubin_lp_course_page_title_section_04' ) ) :
    function edubin_lp_course_page_title_section_04( $title = null, $has_bg_image = null, $extra_style = null ) {

    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $prefix = '_edubin_';

    $lp_single_excerpt = Edubin::setting( 'lp_single_excerpt' );
    $lp_single_review = Edubin::setting( 'lp_single_review' );
    $lp_single_last_update = Edubin::setting( 'lp_single_last_update' );
    $lp_single_page_layout  = Edubin::setting( 'lp_single_page_layout' );

    $lp_header_color = ( $lp_single_page_layout == '4' ) ? 'light' : 'dark' ;

    $page_header_img = get_post_meta($post_id, $prefix . 'header_img', true);

    $lp_intro_video_position = Edubin::setting( 'lp_intro_video_position' ); 
    $lp_single_social_shear = Edubin::setting( 'lp_single_social_shear ' ); 

    $breadcrumb_show = Edubin::setting( 'breadcrumb_show' );
    $shortcode_breadcrumb = Edubin::setting( 'shortcode_breadcrumb' );
    $lp_single_breadcrumb = Edubin::setting( 'lp_single_breadcrumb' );

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '.$lp_header_color.'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';

            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info lp">';

                    if ( $lp_single_breadcrumb ) {

                    echo '<div class="edubin-breadcrumb-wrapper">';
                        do_action( 'edubin_breadcrumb' );
                    echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</h1>';

                    if ( $lp_single_excerpt) : 
                        echo '<div class="course-short-text">';
                            the_excerpt();
                        echo '</div>'; 
                    endif; 

                   get_template_part( 'learnpress/tpl-part/single/meta', 'top' );

                echo '</div>'; // End edubin-single-course-lead-info

            echo '</div>'; // End edubin-col-lg-8

            echo '<div class="edubin-col-lg-4">';  
                if ( $lp_single_page_layout == '5' ) {
                 get_template_part( 'learnpress/tpl-part/single/media', 'header' );
                }
            echo '</div>'; // End edubin-col-lg-4

        echo '</div>';  // End edubin-row
    echo '</div>';  // End edubin-container
echo '</div>'; // End edubin-course-top-info

    }
endif;



// ========================================================================================================================
	/**
	 * Display related courses sidebar
	 */
	if (!function_exists('edubin_related_courses')) {
	    function edubin_related_courses()
	    {
	        $related_courses = edubin_get_related_courses(null, array('posts_per_page' => 3));
	        if ( $related_courses) {
	            $ids = wp_list_pluck($related_courses, 'ID');
	            ?>
				<div class="edubin-col-lg-12 edubin-col-md-6">
					<div class="edubin-related-course">
						<h2 class="widget-title"><?php esc_html_e('You May Like', 'edubin');?></h2>
						<?php foreach ($related_courses as $course_item): ?>
						<?php
						$course      = LP_Course::get_course($course_item->ID);
						$is_required = $course->is_required_enroll();
						$count       = $course->get_users_enrolled();
						?>

							<div class="single-maylike">
								<?php $src = wp_get_attachment_image_src(get_post_thumbnail_id($course_item->ID), 'thumbnail', false, '');?>
								<div class="image">
									<img src="<?php echo esc_url($src[0]); ?>" alt="<?php echo esc_attr($course_item->post_title); ?>">
								</div>
								<div class="cont">
									<a href="<?php echo get_the_permalink($course_item->ID); ?>"><h4><?php echo esc_html($course_item->post_title); ?></h4></a>
									<ul>
										<li class="enroll-student"><i class="flaticon-user-4"></i><?php echo esc_html($count); ?></li>

										<?php if ( $price = $course->get_price_html()) {

						                $origin_price = $course->get_origin_price_html();
						                $sale_price   = $course->get_sale_price();
						                $sale_price   = isset($sale_price) ? $sale_price : '';
						                $class        = '';
						                if ( $course->is_free() || !$is_required) {
						                    $class .= ' free-course';
						                    $price = __('Free', 'edubin');
						                }
	                					?>
											<li><?php
											if ( $sale_price !== '') {
							                    echo '<span class="course-origin-price">' . $origin_price . '</span>';
							                }
							                ?>
											<?php echo esc_html($price);
	            } ?>
									</li>
								</ul>
							</div>
						</div>
					<?php endforeach;?>
				</div>
			</div>

		<?php
	}
	    }
	}

if (!function_exists('edubin_get_related_courses')) {
    function edubin_get_related_courses($limit)
    {
        if (!$limit) {
            $limit = 3;
        }
        $course_id = get_the_ID();

        $tag_ids = array();
        $tags    = get_the_terms($course_id, 'course_tag');

        if ( $tags) {
            foreach ($tags as $individual_tag) {
                $tag_ids[] = $individual_tag->slug;
            }
        }

        $args = array(
            'posts_per_page'      => $limit,
            'paged'               => 1,
            'ignore_sticky_posts' => 1,
            'post__not_in'        => array($course_id),
            'post_type'           => 'lp_course',
        );

        if ( $tag_ids) {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => 'course_tag',
                    'field'    => 'slug',
                    'terms'    => $tag_ids,
                ),
            );
        }

        $related = array();
        if ( $posts = new WP_Query($args)) {
            global $post;
            while ($posts->have_posts()) {
                $posts->the_post();
                $related[] = $post;
            }
        }
        wp_reset_postdata();

        return $related;
    }
}

/**
 * @edubin_extra_user_profile_fields
 */
if (!function_exists('edubin_extra_user_profile_fields')) {
    function edubin_extra_user_profile_fields($user)
    {
        $user_info = get_the_author_meta('lp_info', $user->ID);
        ?>
		<h3><?php esc_html_e('LearnPress Profile', 'edubin');?></h3>

		<table class="form-table">
			<tbody>
				<tr>
					<th>
						<label for="lp_major"><?php esc_html_e('Major', 'edubin');?></label>
					</th>
					<td>
						<input id="lp_major" class="regular-text" type="text"
						value="<?php echo isset($user_info['major']) ? $user_info['major'] : ''; ?>"
						name="lp_info[major]">
					</td>
				</tr>
				<tr>
					<th>
						<label for="lp_facebook"><?php esc_html_e('Facebook Account', 'edubin');?></label>
					</th>
					<td>
						<input id="lp_facebook" class="regular-text" type="text"
						value="<?php echo isset($user_info['facebook']) ? $user_info['facebook'] : ''; ?>"
						name="lp_info[facebook]">
					</td>
				</tr>
				<tr>
					<th>
						<label for="lp_twitter"><?php esc_html_e('Twitter Account', 'edubin');?></label>
					</th>
					<td>
						<input id="lp_twitter" class="regular-text" type="text"
						value="<?php echo isset($user_info['twitter']) ? $user_info['twitter'] : ''; ?>"
						name="lp_info[twitter]">
					</td>
				</tr>
				<tr>
					<th>
						<label for="lp_instagram"><?php esc_html_e('Instagram Account', 'edubin');?></label>
					</th>
					<td>
						<input id="lp_instagram" class="regular-text" type="text"
						value="<?php echo isset($user_info['instagram']) ? $user_info['instagram'] : ''; ?>"
						name="lp_info[instagram]">
					</td>
				</tr>
				<tr>
					<th>
						<label for="lp_linkedin"><?php esc_html_e('LinkedIn Plus Account', 'edubin');?></label>
					</th>
					<td>
						<input id="lp_linkedin" class="regular-text" type="text"
						value="<?php echo isset($user_info['linkedin']) ? $user_info['linkedin'] : ''; ?>"
						name="lp_info[linkedin]">
					</td>
				</tr>
				<tr>
					<th>
						<label for="lp_youtube"><?php esc_html_e('Youtube Account', 'edubin');?></label>
					</th>
					<td>
						<input id="lp_youtube" class="regular-text" type="text"
						value="<?php echo isset($user_info['youtube']) ? $user_info['youtube'] : ''; ?>"
						name="lp_info[youtube]">
					</td>
				</tr>
			</tbody>
		</table>
		<?php
}
}

add_action('show_user_profile', 'edubin_extra_user_profile_fields');
add_action('edit_user_profile', 'edubin_extra_user_profile_fields');

function edubin_save_extra_user_profile_fields($user_id)
{

    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }
    update_user_meta($user_id, 'lp_info', $_POST['lp_info']);
}

add_action('personal_options_update', 'edubin_save_extra_user_profile_fields');
add_action('edit_user_profile_update', 'edubin_save_extra_user_profile_fields');

/**
 * Display co instructors
 *
 * @param $course_id
 */
if (!function_exists('edubin_co_instructors')) {
    function edubin_co_instructors($course_id, $author_id)
    {
        if (!$course_id) {
            return;
        }

        if (class_exists('LP_Co_Instructor_Preload') or class_exists('LP_Multiple_Instructor_Preload')) {
            $instructors = get_post_meta($course_id, '_lp_co_teacher');
            $instructors = array_diff($instructors, array($author_id));
            if ( $instructors) {
                foreach ($instructors as $instructor) {
                    //Check if instructor not exist
                    $user = get_userdata($instructor);
                    if ( $user === false) {
                        break;
                    }
                    $lp_info = get_the_author_meta('lp_info', $instructor);
                    $link    = learn_press_user_profile_link($instructor);
                    ?>
						<div class="edubin-about-author edubin-co-instructor">
						<div class="author-wrapper">
							<div class="author-avatar">
								<?php echo get_avatar($instructor, 110); ?>
							</div>
							<div class="author-bio">
								<div class="author-top">
									<a itemprop="url" class="name" href="<?php echo esc_url($link); ?>">
										<span itemprop="name"><?php echo get_the_author_meta('display_name', $instructor); ?></span>
									</a>
									<?php if (isset($lp_info['major']) && $lp_info['major']): ?>
										<p class="job"
										itemprop="jobTitle"><?php echo esc_html($lp_info['major']); ?></p>
									<?php endif;?>
								</div>
								<ul class="edubin-author-social">
								<?php if (isset($lp_info['facebook']) && $lp_info['facebook']): ?>
								<li>
								<a href="<?php echo esc_url($lp_info['facebook']); ?>" class="facebook"><i
									class="fab fa-facebook-f"></i></a>
								</li>
								<?php endif;?>

								<?php if (isset($lp_info['twitter']) && $lp_info['twitter']): ?>
								<li>
									<a href="<?php echo esc_url($lp_info['twitter']); ?>" class="twitter"><i
										class="fab fa-twitter"></i></a>
									</li>
								<?php endif;?>

								<?php if (isset($lp_info['instagram']) && $lp_info['instagram']): ?>
									<li>
										<a href="<?php echo esc_url($lp_info['instagram']); ?>" class="instagram"><i
											class="fab fa-instagram"></i></a>
										</li>
									<?php endif;?>

									<?php if (isset($lp_info['linkedin']) && $lp_info['linkedin']): ?>
										<li>
											<a href="<?php echo esc_url($lp_info['linkedin']); ?>" class="linkedin"><i
												class="fab fa-linkedin-in"></i></a>
											</li>
										<?php endif;?>

										<?php if (isset($lp_info['youtube']) && $lp_info['youtube']): ?>
											<li>
												<a href="<?php echo esc_url($lp_info['youtube']); ?>" class="youtube"><i
													class="fab fa-youtube"></i></a>
												</li>
											<?php endif;?>
										</ul>

									</div>
									<div class="author-description" itemprop="description">
										<?php echo get_the_author_meta('description', $instructor); ?>
									</div>
								</div>
							</div>
					<?php
}
            }
        }
    }
}
/**
 * About the author/ default instructor only
 */
if (!function_exists('edubin_about_author')) {
    function edubin_about_author()
    {
        $lp_info = get_the_author_meta('lp_info');
        ?>
		<div class="edubin-about-author">

			<div class="author-top">
				<?php if (isset($lp_info['major']) && $lp_info['major']): ?>
					<p class="job"><?php echo esc_html($lp_info['major']); ?></p>
				<?php endif;?>
			</div>

			<ul class="edubin-author-social">
				<?php if (isset($lp_info['facebook']) && $lp_info['facebook']): ?>
					<li>
						<a href="<?php echo esc_url($lp_info['facebook']); ?>" class="facebook"><i class="fab fa-facebook-f"></i></a>
					</li>
				<?php endif;?>

				<?php if (isset($lp_info['twitter']) && $lp_info['twitter']): ?>
					<li>
						<a href="<?php echo esc_url($lp_info['twitter']); ?>" class="twitter"><i class="fab fa-twitter"></i></a>
					</li>
				<?php endif;?>

				<?php if (isset($lp_info['instagram']) && $lp_info['instagram']): ?>
					<li>
						<a href="<?php echo esc_url($lp_info['instagram']); ?>" class="instagram"><i
							class="fab fa-instagram"></i></a>
						</li>
					<?php endif;?>

					<?php if (isset($lp_info['linkedin']) && $lp_info['linkedin']): ?>
						<li>
							<a href="<?php echo esc_url($lp_info['linkedin']); ?>" class="linkedin"><i class="fab fa-linkedin-in"></i></a>
						</li>
					<?php endif;?>

					<?php if (isset($lp_info['youtube']) && $lp_info['youtube']): ?>
						<li>
							<a href="<?php echo esc_url($lp_info['youtube']); ?>" class="youtube"><i class="fab fa-youtube"></i></a>
						</li>
					<?php endif;?>
				</ul>
			</div>
			<?php

    }
}


// remove_action( 'admin_footer', 'learn_press_footer_advertisement', - 10 );

// remove_action( 'learn-press/user-profile', LP()->template( 'profile' )->func( 'login_form' ), 10 );
// remove_action( 'learn-press/user-profile', LP()->template( 'profile' )->func( 'register_form' ), 15 );

// // remove breadcrumbs
// remove_action( 'learn-press/before-main-content', LP()->template( 'general' )->func( 'breadcrumb' ) );
// remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );
// remove_action( 'learn-press/before-main-content', 'learn_press_search_form', 15 );

// remove_all_actions( 'learn-press/course-content-summary', 10 );
// remove_all_actions( 'learn-press/course-content-summary', 15 );
// remove_all_actions( 'learn-press/course-content-summary', 30 );
// remove_all_actions( 'learn-press/course-content-summary', 35 );
// remove_all_actions( 'learn-press/course-content-summary', 40 );
// remove_all_actions( 'learn-press/course-content-summary', 80 );

// // remove course sidebar
// remove_all_actions( 'learn-press/course-content-summary', 85 );
// remove_all_actions( 'learn-press/course-content-summary', 100 );

// remove_action( 'learn-press/after-courses-loop-item', 'learn_press_course_loop_item_buttons', 35 );
// remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_price', 20 );
// remove_action( 'learn-press/after-courses-loop-item', 'learn_press_courses_loop_item_instructor', 25 );
// remove_action( 'learn-press/courses-loop-item-title', 'learn_press_courses_loop_item_thumbnail', 10 );
// remove_action( 'learn-press/courses-loop-item-title', 'learn_press_courses_loop_item_title', 15 );

// /* 
//  * Course Sidebar Button 
//  */
// if ( class_exists( 'LP_Prere_Course_Hooks' ) ) :
// 	$edubin_lp_prerequisite_plugin = LP_Prere_Course_Hooks::get_instance();
// 	remove_action( 'learn-press/course-buttons', [$edubin_lp_prerequisite_plugin, 'check_condition'], 1 );
// endif;

// /* 
//  * Remove Wishlist Button From Sidebar 
//  */
// add_action( 'edubin_course_sidebar_lp_button', LearnPress::instance()->template( 'course' )->func( 'course_enroll_button' ), 5 );
// add_action( 'edubin_course_sidebar_lp_button', LearnPress::instance()->template( 'course' )->func( 'course_purchase_button' ), 10 );
// add_action( 'edubin_course_sidebar_lp_button', LearnPress::instance()->template( 'course' )->func( 'course_external_button' ), 15 );
// add_action( 'edubin_course_sidebar_lp_button', LearnPress::instance()->template( 'course' )->func( 'button_retry' ), 20 );
// add_action( 'edubin_course_sidebar_lp_button', LearnPress::instance()->template( 'course' )->func( 'course_continue_button' ), 25 );
// add_action( 'edubin_course_sidebar_lp_button', LearnPress::instance()->template( 'course' )->func( 'course_finish_button' ), 30 );

/* 
 * Course Price With Deciaml Separator 
 */
// add_filter( 'learn_press_course_origin_price_html', 'edubin_lp_course_price_decimal_separator', 99, 1 );
// add_filter( 'learn_press_course_price_html', 'edubin_lp_course_price_decimal_separator', 99, 1 );

/**
 * LearnPress specific scripts & stylesheets.
 *
 * @return void
 * 
 * @since 1.0.0
 */
// if ( ! function_exists( 'edubin_lp_scripts' ) ) :
// 	function edubin_lp_scripts() {
// 		wp_enqueue_style( 'edubin-lp-style', esc_url( get_template_directory_uri() . '/assets/css/learnpress.css' ), array( 'learnpress' ), EDUBIN_THEME_VERSION );

// 		if ( is_singular( LP_COURSE_CPT ) ) :
// 			wp_enqueue_style( 'jquery-fancybox' );
// 			wp_enqueue_script( 'jquery-fancybox' );
// 		endif;
// 	}
// endif;
// add_action( 'wp_enqueue_scripts', 'edubin_lp_scripts' );

/**
 * Course Page Container Class
 *
 * @since 1.0.0
 */
add_filter( 'edubin_container_class', 'edubin_lp_course_container_class' );
if ( ! function_exists( 'edubin_lp_course_container_class' ) ) :
	function edubin_lp_course_container_class ( $class ) {
		if ( is_singular( LP_COURSE_CPT ) ) :
			return ' edubin-container edubin-lp-course-details-page';
		else :
			return $class;
		endif;
	}
endif;

/**
 * Content area class
 */
add_filter( 'edubin_content_area_class', 'edubin_lp_content_area_class' );
if ( ! function_exists( 'edubin_lp_content_area_class' ) ) :
	function edubin_lp_content_area_class ( $class ) {

		if ( is_post_type_archive( LP_COURSE_CPT ) || is_tax( 'course_category' ) ) :

			$course_layout = 'full_width';

			if ( 'right' === $course_layout ) :
				$class = 'edubin-col-lg-9';
			elseif ( 'left' === $course_layout ) :
				$class = 'edubin-col-lg-9 edubin-order-1';
			elseif ( 'full_width' === $course_layout ) :
				$class = 'edubin-col-lg-12';
			endif;
		endif;

		if ( is_singular( LP_COURSE_CPT ) ) :
			
			$single_course_layout = 'full_width';

			if ( 'right' ===  $single_course_layout ) :
				$class = 'edubin-col-lg-9';
			elseif ( 'left' === $single_course_layout ) :
				$class = 'edubin-col-lg-9 edubin-order-1';
			elseif ( 'full_width' === $single_course_layout ) :
				$class = 'edubin-col-lg-12';
			endif;
		endif;

		return $class;
	}
endif;

/**
 * Widget area class
 */
add_filter( 'edubin_get_widget_class', 'edubin_lp_widget_area_class' );

if ( ! function_exists( 'edubin_lp_widget_area_class' ) ) :
	function edubin_lp_widget_area_class ( $class ) {

		if ( is_post_type_archive( LP_COURSE_CPT ) || is_tax( 'course_category' ) ) :

			$course_layout = 'full_width';

			if ( 'right' === $course_layout ) :
				$class = 'edubin-col-lg-3';
			elseif ( 'left' === $course_layout ) :
				$class = 'edubin-col-lg-3 edubin-order-2';
			elseif ( 'full_width' === $course_layout ) :
				$class = '';
			endif;
		endif;

		if ( is_singular( LP_COURSE_CPT ) ) :
			
			$single_course_layout = 'full_width';

			if ( 'right' === $single_course_layout ) :
				$class = 'edubin-col-lg-3';
			elseif ( 'left' === $single_course_layout ) :
				$class = 'edubin-col-lg-3 edubin-order-2';
			elseif ( 'full_width' === $single_course_layout ) :
				$class = '';
			endif;
		endif;
		
		return $class;

	}
endif;

/**
 * Sale tag for promotional courses
 */
if ( ! function_exists( 'edubin_lp_course_sale_tag' ) ) :
	function edubin_lp_course_sale_tag() {

		$course = LP_Global::course();
		if ( $course->get_origin_price() != $course->get_price() ) :
			printf( '<span class="label">%s</span>', apply_filters( 'edubin_course_sale_tag_text', __( 'Sale', 'edubin' ) ) );
		endif;
	}
endif;

/**
 * Sale percentage tag for promotional courses
 */
if ( ! function_exists( 'edubin_lp_course_sale_offer_in_percentage' ) ) :
	function edubin_lp_course_sale_offer_in_percentage() {

		$course = LP_Global::course();
		$discount = round( 100 * ($course->get_origin_price() - $course->get_price()) / $course->get_origin_price() );
		$offer = apply_filters( 'edubin_course_sale_offer_text', __( 'Off', 'edubin' ) );
		return $discount.'%' . ' ' . $offer;
	}
endif;

/**
 * Add html span tag to wrap decimal separator.
 */
if ( ! function_exists( 'edubin_lp_course_price_decimal_separator' ) ) :
	function edubin_lp_course_price_decimal_separator( $origin_price ) {
		$decimal_number    = intval( LP()->settings->get( 'number_of_decimals' ) );
		$decimal_separator = LP()->settings->get( 'decimals_separator' );

		if ( $decimal_number > 0 && ! empty( $decimal_separator ) ) :
			$decimal_position = strpos( $origin_price, $decimal_separator );
			$decimal_part = substr( $origin_price, $decimal_position, $decimal_number + 1 );
			$decimal_html = '<span class="decimal-separator">' . $decimal_part . '</span>';
			$origin_price = str_replace( $decimal_part, $decimal_html, $origin_price );
		endif;
		return $origin_price;
	}
endif;


/**
 * Course instructor
 */
if ( ! function_exists( 'edubin_lp_course_instructor' ) ) :
	function edubin_lp_course_instructor( $thumb_size = 60 ) {
		echo '<div class="course-author" itemscope="" itemtype="http://schema.org/Person">';
			printf( get_avatar( get_the_author_meta( 'ID' ), $thumb_size ) );	
			echo '<div class="author-contain">';
				echo '<label itemprop="jobTitle">' . __( 'Teacher', 'edubin' ) . '</label>';
				echo '<div class="value" itemprop="name">';
					the_author();
				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
endif;

/**
 * Course category
 */
if ( ! function_exists( 'edubin_lp_course_first_category' ) ) :
	function edubin_lp_course_first_category() {
		$first_cat = edubin_category_by_id( get_the_id(), 'course_category' );
		if ( ! empty( $first_cat) ) :
			echo '<div class="course-categories">';
				echo '<label>' . __( 'Categories', 'edubin' ) . '</label>';
				echo '<div class="value">';
					echo '<span class="cat-links">';
						echo wp_kses_post( $first_cat );
					echo '</span>';
				echo '</div>';
			echo '</div>';
		endif;
	}
endif;

/**
 * Display course ratings
 */
if ( ! function_exists( 'edubin_lp_course_ratings' ) ) :
	function edubin_lp_course_ratings() {
		if ( ! class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
			return;
		endif;

		$course_rate_res = learn_press_get_course_rate( get_the_ID(), false );
		$course_rate     = $course_rate_res['rated'];
		$total           = $course_rate_res['total'];
		$ratings         = learn_press_get_course_rate_total( get_the_ID() );
		$rating_text = __( 'Rating', 'edubin' );
		$ratings_text = __( 'Ratings', 'edubin' );
		echo '<div class="edubin-course-review-wrapper">';
			learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );

			echo '<span>';
				echo esc_html( '(' . number_format( $course_rate, 1 ) ) . '/ ';
				echo esc_html( $ratings ) . ' ';
				// if ( (int)$ratings > 1 ) :
				// 	echo esc_html( $ratings_text );
				// else :
				// 	echo esc_html( $rating_text );
				// endif;
			echo ')</span>';
		echo '</div>';
	}
endif;

/**
 * Display course ratings alter
 */
if ( ! function_exists( 'edubin_lp_course_ratings_alter' ) ) :
	function edubin_lp_course_ratings_alter( $show_rating = false ) {
		if ( ! class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
			return;
		endif;

		$course_rate_res = learn_press_get_course_rate( get_the_ID(), false );
		$course_rate     = $course_rate_res['rated'];
		$total           = $course_rate_res['total'];
		$ratings         = learn_press_get_course_rate_total( get_the_ID() );
		echo '<div class="edubin-course-review-wrapper">';
			learn_press_course_review_template( 'rating-stars.php', array( 'rated' => $course_rate ) );

			if ( $show_rating ) :
				echo '<span>';
					echo esc_html( '(' . number_format( $course_rate, 1 ) . ')' );
				echo '</span>';
			else :
				echo '<span>';
					printf( _nx( '(%s Review)', '(%s Reviews)', $ratings, 'Ratings', 'edubin' ), number_format_i18n( $ratings ) );
				echo '</span>';
			endif;
		echo '</div>';
	}
endif;

/**
 * Display course rating value only
 */
if ( ! function_exists( 'edubin_lp_course_rating_value' ) ) :
	function edubin_lp_course_rating_value() {
		if ( ! class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
			return;
		endif;

		$course_rate_res = learn_press_get_course_rate( get_the_ID(), false );
		$course_rate     = $course_rate_res['rated'];
		$total           = $course_rate_res['total'];
		$ratings         = learn_press_get_course_rate_total( get_the_ID() );
		return number_format( $course_rate, 1 );
	}
endif;

/**
 * Generate wishlist icon
 */
if ( ! function_exists( 'edubin_lp_wishlist_icon' ) ) :
	function edubin_lp_wishlist_icon( $course_id ){
		$user_id = get_current_user_id();

		if ( ! class_exists( 'LP_Addon_Wishlist' ) || ! $course_id ) :
			return;
		endif;

		if ( ! $user_id ) :
			echo '<button class="edubin-wishlist-wrapper edubin-lp-non-logged-user"></button>';
			return;
		endif;

		$classes = array( 'course-wishlist' );
		$state   = learn_press_user_wishlist_has_course( $course_id, $user_id ) ? 'on' : 'off';

		if ( 'on' === $state ) :
			$classes[] = 'on';
		endif;
		$classes = apply_filters( 'learn_press_course_wishlist_button_classes', $classes, $course_id );
		$title   = ( 'on' === $state ) ? __( 'Remove this course from your wishlist', 'edubin' ) : __( 'Add this course to your wishlist', 'edubin' );

		printf(
			'<button class="edubin-wishlist-wrapper learn-press-course-wishlist-button-%2$d %s" data-id="%s" data-nonce="%s" title="%s"></button>',
			join( " ", $classes ),
			$course_id,
			wp_create_nonce( 'course-toggle-wishlist' ),
			$title
		);	

	}
endif;


/**
 * Curriculum section title
 */
if ( ! function_exists( 'edubin_lp_curriculum_section_title' ) ) :
	function edubin_lp_curriculum_section_title( $section ) {
		learn_press_get_template( 'custom/curriculum-title.php', array( 'section' => $section ) );
	}
endif;

/**
 * LearnPress Course
 * @return boolean
 */
function edubin_is_lp_courses() {
    if ( learn_press_is_courses() || learn_press_is_course_tag() || learn_press_is_course_category() || learn_press_is_course_tax() || learn_press_is_search() ) :
        return true;
    endif;
    return false;
}

/**
 * LP breadcrumb delimiter
 */

add_filter( 'learn_press_breadcrumb_defaults', 'edubin_lp_breadcrumb_delimiter' );

if( ! function_exists( 'edubin_lp_breadcrumb_delimiter' ) ) :
	function edubin_lp_breadcrumb_delimiter( $args ) {
		$args['delimiter'] = '';
		return $args;
	}
endif;

/**
 * indexing result of courses
 */
if( ! function_exists( 'edubin_lp_course_index_result' ) ) :
	function edubin_lp_course_index_result( $total ) {
		if ( 0 === $total ) :
			$result = __( 'There are no available courses!', 'edubin' );	
		elseif ( 1 === $total ) :
			$result = __( 'Showing only one result.', 'edubin' );
		else :
			$courses_per_page = absint( LP()->settings->get( 'archive_course_limit' ) );
			$paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

			$from = 1 + ( $paged - 1 ) * $courses_per_page;
			$to   = ( $paged * $courses_per_page > $total ) ? $total : $paged * $courses_per_page;

			if ( $from == $to ) :
				$result = sprintf( __( 'Showing Last Course Of %s Results', 'edubin' ), $total );
			else :
				$result = sprintf( __( 'Showing %s-%s Of %s Results', 'edubin' ), '<span>' . $from, $to . '</span>', '<span>' . $total . '</span>' );
			endif;
		endif;
		echo wp_kses_post( $result );
	}
endif;

/**
 * Course archive top bar
 */
if( ! function_exists( 'edubin_lp_course_header_top_bar' ) ) :
	function edubin_lp_course_header_top_bar( $query ) {
		global $wp_query;
		$top_bar      = true;
		$index      = true;
		$search_bar = true;

		if ( true == $index && true == $search_bar ) :
			$column = 'edubin-col-md-6';
		else :
			$column = 'edubin-col-md-12';
		endif;

		if ( ( true == $top_bar ) && ( true == $index || true == $search_bar ) ) :
			echo '<div class="edubin-course-archive-top-bar-wrapper">';
				echo '<div class="edubin-course-archive-top-bar edubin-row">';
					if ( true == $index ) :
						echo '<div class="' . esc_attr( $column ) . '">';
							echo '<span class="edubin-course-archive-index-count">';
								edubin_lp_course_index_result( $query->found_posts );
							echo '</span>';
						echo '</div>';
					endif;
					if ( true == $search_bar ) :
						echo '<div class="' . esc_attr( $column ) . '">';
							echo '<div class="edubin-course-archive-search">';
								edubin_lp_course_archive_search_bar();
							echo '</div>';
						echo '</div>';
					endif;
				echo '</div>';
			echo '</div>';
		endif;
	}
endif;

/**
 * Course archive search bar
 */
if( ! function_exists( 'edubin_lp_course_archive_search_bar' ) ) :
	function edubin_lp_course_archive_search_bar() {
		/*
		 * remove param action="' . esc_url( get_post_type_archive_link( LP_COURSE_CPT ) ) . '"
		 * if you don't want to redirect to course category archive
		 */
		echo '<div class="edu-search-box">';
			echo '<form class="edubin-archive-course-search-form" method="get" action="' . esc_url( get_post_type_archive_link( LP_COURSE_CPT ) ) . '">';
				echo '<input type="text" value="" name="search_query" placeholder="'. __( 'Search Courses...', 'edubin' ) . '" class="input-search" autocomplete="off" />';
				echo '<input type="hidden" value="lp_course_search" name="tpc_lp_course_filter" />';
				echo '<button class="search-button"><i class="flaticon-search"></i></button>';
			echo '</form>';
		echo '</div>';
	}
endif;

/**
 * Main Content Wrapper Class for LearnPress 
 * Course Archive & Course Details
 */
add_filter( 'edubin_main_content_inner', 'edubin_lp_main_content_wrapper_class' );
if( ! function_exists( 'edubin_lp_main_content_wrapper_class' ) ) :
	function edubin_lp_main_content_wrapper_class( $class ) {
		if ( learn_press_is_courses() || learn_press_is_course_tag() || learn_press_is_course_category() || learn_press_is_course_tax() || learn_press_is_search() ) :
			$class = '';
		elseif ( is_singular( LP_COURSE_CPT ) ) :
			$class = ' edubin-row';
		endif;
		return $class;
	}
endif;

/**
 * Remove and Modify Tab Items From 
 * LearnPress Course Details Page
 */
add_filter( 'learn-press/course-tabs', 'edubin_lp_instructor_tab_modify' );
if( ! function_exists( 'edubin_lp_instructor_tab_modify' ) ) :
	function edubin_lp_instructor_tab_modify( $tabs ) {
		$lp_overview_tab_text = Edubin::setting( 'lp_overview_tab_text' );
		$lp_curriculum_tab_text = Edubin::setting( 'lp_curriculum_tab_text' );
		$lp_instructor_tab_show = Edubin::setting( 'lp_instructor_tab_show' );
		$lp_instructor_tab_text = Edubin::setting( 'lp_instructor_tab_text' );
		$lp_faqs_tab_show = Edubin::setting( 'lp_faqs_tab_show' );
		$lp_faqs_tab_text = Edubin::setting( 'lp_faqs_tab_text' );
		$lp_curriculum_tab_show = Edubin::setting( 'lp_curriculum_tab_show' );
		$lp_review_tab_show = Edubin::setting( 'lp_review_tab_show' );
		$lp_reviews_tab_text = Edubin::setting( 'lp_reviews_tab_text' );

		if ( $lp_overview_tab_text ) :
			$tabs['overview']['title'] = $lp_overview_tab_text;
		endif;

		if ( true == $lp_instructor_tab_show ) :
			if ( $lp_overview_tab_text ) :
				$tabs['instructor']['title'] = $lp_instructor_tab_text; 
			endif;
		else :
			unset( $tabs['instructor'] );
		endif;

		if ( true == $lp_curriculum_tab_show ) :
			if ( $lp_curriculum_tab_text ) :
				$tabs['curriculum']['title'] = $lp_curriculum_tab_text; 
			endif;
		else :
			unset( $tabs['curriculum'] );
		endif;

		if ( isset( $tabs['faqs'] ) && ! empty( $tabs['faqs'] ) ) :
			if ( true == $lp_faqs_tab_show ) :
				if ( $lp_faqs_tab_text ) :
					$tabs['faqs']['title'] = $lp_faqs_tab_text; 
				endif;
			else :
				unset( $tabs['faqs'] );
			endif;
		endif;

		if ( class_exists( 'LP_Addon_Course_Review_Preload' ) ) :
			if ( true == $lp_review_tab_show ) :
				if ( $lp_overview_tab_text ) :
					$tabs['reviews']['title'] = $lp_reviews_tab_text; 
				endif;
			else :
				unset( $tabs['reviews'] );
			endif;
		endif;

		return $tabs;
	}
endif;

/**
 * Course Taxonomy Archive Page Query
 * Only for Category( 'course_category' ) and 
 * Tag( 'course_tag' ) Archive Pages
 */
add_filter( 'edubin_lp_course_archive_args', 'edubin_lp_course_taxonomy_filter_archive' );
if( ! function_exists( 'edubin_lp_course_taxonomy_filter_archive' ) ) :
	function edubin_lp_course_taxonomy_filter_archive( $args ) {
		$category = get_queried_object();
		if ( learn_press_is_course_archive() ) :
			if ( isset( $category->taxonomy ) && 'course_category' === $category->taxonomy ) :
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'course_category',
						'field'    => 'term_id',
						'terms'    => array( $category->term_id )
					)
				);
			elseif ( isset( $category->taxonomy ) && 'course_tag' === $category->taxonomy ) :
				$args['tax_query'] = array(
					array(
						'taxonomy' => 'course_tag',
						'field'    => 'term_id',
						'terms'    => array( $category->term_id )
					)
				);
			endif;
		endif;
		return $args;
	}
endif;

/**
 * Course Archive Search Filter
 */
add_filter( 'edubin_lp_course_archive_args', 'edubin_lp_course_search_filter_archive' );
if( ! function_exists( 'edubin_lp_course_search_filter_archive' ) ) :
	function edubin_lp_course_search_filter_archive( $args ) {
		if ( learn_press_is_course_archive() ) :
			if ( isset( $_REQUEST['tpc_lp_course_filter'] ) && 'lp_course_search' === $_REQUEST['tpc_lp_course_filter'] ) :
				$args['s'] = sanitize_text_field( $_REQUEST['search_query'] );
			endif;
		endif;
		return $args;
	}
endif;

/**
 * Course Archive Main Filter
 */
add_filter( 'edubin_lp_course_archive_args', 'edubin_lp_course_category_filter_archive' );
if( ! function_exists( 'edubin_lp_course_category_filter_archive' ) ) :
	function edubin_lp_course_category_filter_archive( $args ) {
		if ( learn_press_is_course_archive() ) :
			if ( ! empty( $_GET['filter-category'] ) ) :
				if ( is_array( $_GET['filter-category'] ) ) :
					$args['tax_query'] = array(
						array(
						'taxonomy'  => 'course_category',
						'field'     => 'term_id',
						'terms'     => array_map( 'sanitize_text_field', $_GET['filter-category'] ),
						'compare'   => 'IN'
						)
					);
				else :
					$args['tax_query'] = array(
						array(
							'taxonomy'  => 'course_category',
							'field'     => 'term_id',
							'terms'     => sanitize_text_field( $_GET['filter-category'] ),
							'compare'   => '=='
						)
					);
				endif;
			endif;

			if ( ! empty( $_GET['filter-level'] ) ) :
				if ( is_array( $_GET['filter-level'] ) ) :
					$args['meta_query'][] = array(
						'key'     => '_lp_level',
						'value'   => array_map( 'sanitize_text_field', $_GET['filter-level'] ),
						'compare' => 'IN'
					);
				else :
					$args['meta_query'][] = array(
						'key'     => '_lp_level',
						'value'   => sanitize_text_field( $_GET['filter-level'] ),
						'compare' => '='
					);
				endif;
            endif;
        endif;
		return $args;
	}
endif;

/**
 * Course Duration
 *
 */
if( ! function_exists( 'edubin_lp_course_duration_customize' ) ) :
	function edubin_lp_course_duration_customize( $duration ) {
		$duration_number = absint( $duration );
		$duration_text = str_replace( $duration_number, '', $duration );
		$duration_text = trim( $duration_text );

		switch ( $duration_text ) :
			case 'minute':
				$duration_text = $duration_number > 1 ? __( 'minutes', 'edubin' ) : __( 'minute', 'edubin' );
				break;
			case 'hour':
				$duration_text = $duration_number > 1 ? __( 'hours', 'edubin' ) : __( 'hour', 'edubin' );
				break;
			case 'day':
				$duration_text = $duration_number > 1 ? __( 'days', 'edubin' ) : __( 'day', 'edubin' );
				break;
			case 'week':
				$duration_text = $duration_number > 1 ? __( 'weeks', 'edubin' ) : __( 'week', 'edubin' );
				break;
		endswitch;
		return $duration_number . ' ' . $duration_text;
	}
endif;



