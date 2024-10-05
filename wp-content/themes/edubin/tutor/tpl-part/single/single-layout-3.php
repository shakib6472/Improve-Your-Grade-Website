<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $tutor_intro_video_position = Edubin::setting( 'tutor_intro_video_position' ); 
    $tutor_related_course_position = Edubin::setting( 'tutor_related_course_position' );
    $tutor_single_enroll_btn = Edubin::setting( 'tutor_single_enroll_btn' );
    $tutor_single_social_shear = Edubin::setting( 'tutor_single_social_shear' );
    $tutor_course_header_style = Edubin::setting( 'tutor_course_header_style' );

    // ==== Course Header =====

     while ( have_posts() ) : the_post(); 

    if ( '1' == $tutor_course_header_style ) { 
        edubin_tutor_course_page_title_section_05(); 
    }
     else { 
        edubin_tutor_course_page_title_section_06();
    }

    endwhile; wp_reset_postdata();  

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';

                while ( have_posts() ) : the_post();

                    echo '<div class="edubin-row edubin-tutor-course-layout--3">';
                        echo '<div class="edubin-col-sm-4">';
                        echo '</div>';
                        echo '<div class="edubin-col-sm-4">';
                            tutor_load_template( 'single.course.course-entry-box' );
                        echo '</div>';
                        echo '<div class="edubin-col-sm-4">';
                        echo '</div>';
                    echo '</div>';

                    get_template_part( 'tutor/tpl-part/single/single', 'content' );

                endwhile; 
                      
                if ($tutor_related_course_position == 'content') { 

                echo '<div class="related-post-wrap related_course">';
                    edubin_tutor_related_course_content(); 
                echo '</div>';

                } 
            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();