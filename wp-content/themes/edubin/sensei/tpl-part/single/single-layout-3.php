<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $sensei_intro_video_position = Edubin::setting( 'sensei_intro_video_position' ); 
    $sensei_related_course_position = Edubin::setting( 'sensei_related_course_position' );
    $sensei_single_enroll_btn = Edubin::setting( 'sensei_single_enroll_btn' );
    $sensei_single_social_shear = Edubin::setting( 'sensei_single_social_shear' );
    $sensei_course_header_style = Edubin::setting( 'sensei_course_header_style' );

    // ==== Course Header =====

     while ( have_posts() ) : the_post(); 

    if ( '1' == $sensei_course_header_style ) { 
        edubin_sensei_course_page_title_section_05(); 
    }
     else { 
        edubin_sensei_course_page_title_section_06();
    }

    endwhile; wp_reset_postdata();  

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';

                while ( have_posts() ) : the_post();

                    get_template_part( 'sensei/tpl-part/single/single', 'content' );

                endwhile; 
                      
                if ($sensei_related_course_position == 'content') { 

                echo '<div class="related-post-wrap related_course">';
                    edubin_sensei_related_course_content(); 
                echo '</div>';

                } 
            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();