<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $ld_intro_video_position = Edubin::setting( 'ld_intro_video_position' ); 
    $ld_related_course_position = Edubin::setting( 'ld_related_course_position' );
    $ld_single_enroll_btn = Edubin::setting( 'ld_single_enroll_btn' );
    $ld_single_social_shear = Edubin::setting( 'ld_single_social_shear' );
    $ld_course_header_style = Edubin::setting( 'ld_course_header_style' );

    // ==== Course Header =====

     while ( have_posts() ) : the_post(); 

    if ( '1' == $ld_course_header_style ) { 
        edubin_ld_course_page_title_section_05(); 
    }
     else { 
        edubin_ld_course_page_title_section_06();
    }

    endwhile; wp_reset_postdata();  

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';

                while ( have_posts() ) : the_post();

                    get_template_part( 'learndash/tpl-part/single/single', 'content' );

                endwhile; 
                      
                if ($ld_related_course_position == 'content') { 

                echo '<div class="related-post-wrap related_course">';
                    edubin_ld_related_course_content(); 
                echo '</div>';

                } 
            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();