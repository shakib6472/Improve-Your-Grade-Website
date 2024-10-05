<?php
/**
 * The template for displaying course single page
 */

get_header(); 

   $post_id = edubin_get_id();
    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();

//    if(function_exists('edubinGetPostViewsCustom')){ edubinSetPostViewsCustom(get_the_ID()); }

    $lp_related_course_position = Edubin::setting( 'lp_related_course_position' );
    $lp_course_header_style = Edubin::setting( 'lp_course_header_style' );

    // ==== Course Header =====
    
    while ( have_posts() ) : the_post(); 

        edubin_lp_course_page_title_section_03(); 

    endwhile; wp_reset_postdata(); 

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';

                while ( have_posts() ) : the_post();

                    global $post; $post_id = $post->ID;
                    $course_id = $post_id;

                    learn_press_get_template( 'content-single-course' ); 

                endwhile; 
                
                if ($lp_related_course_position == 'content') { 

                echo '<div class="related-post-wrap related_course">';
                    edubin_lp_related_course_content(); 
                echo '</div>';

                } 
            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();