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

    $lp_intro_video_position = Edubin::setting( 'lp_intro_video_position' ); 
    $lp_related_course_position = Edubin::setting( 'lp_related_course_position' );
    $lp_single_enroll_btn = Edubin::setting( 'lp_single_enroll_btn' );
    $lp_single_social_shear = Edubin::setting( 'lp_single_social_shear' );
    $lp_course_header_style = Edubin::setting( 'lp_course_header_style' );

    // ==== Course Header =====

     while ( have_posts() ) : the_post(); 


    if ( '1' == $lp_course_header_style ) { 
        edubin_lp_course_page_title_section_05(); 
    }
     else { 
        edubin_lp_course_page_title_section_06();
    }

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

                  echo '<div class="course-bottom-wrap">';

                        if ($lp_single_enroll_btn) {
                            learn_press_get_template( 'single-course/buttons' ); 
                        }
                        
                        if ($lp_single_social_shear) { 
                            
                            echo '<div class="entry-post-share">';
                                echo '<div class="post-share style-01">';
                                    echo '<div class="share-label">';
                                        esc_html_e( 'Share this course', 'edubin' ); 
                                    echo '</div>';
                                    echo '<div class="share-media">';
                                        echo '<i class="share-icon flaticon-share"></i>';

                                        echo '<div class="share-list">';
                                            edubin_get_sharing_list(); 
                                        echo '</div>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            
                            } 

                  echo '</div>';
                        
                if ($lp_related_course_position == 'content') { 

                echo '<div class="related-post-wrap related_course">';
                    edubin_lp_related_course_content(); 
                echo '</div>';

                } 
            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();