<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $lif_intro_video_position = Edubin::setting( 'lif_intro_video_position' ); 
    $lif_related_course_position = Edubin::setting( 'lif_related_course_position' );
    $lif_single_enroll_btn = Edubin::setting( 'lif_single_enroll_btn' );
    $lif_single_social_shear = Edubin::setting( 'lif_single_social_shear' );
    $lif_course_header_style = Edubin::setting( 'lif_course_header_style' );

    // ==== Course Header =====

     while ( have_posts() ) : the_post(); 

    if ( '1' == $lif_course_header_style ) { 
        edubin_lif_course_page_title_section_05(); 
    }
     else { 
        edubin_lif_course_page_title_section_06();
    }

    endwhile; wp_reset_postdata();  

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';

                while ( have_posts() ) : the_post();

                    get_template_part( 'lifterlms/tpl-part/single/single', 'content' );

                endwhile; 
                      
                if ($lif_related_course_position == 'content') { 

                echo '<div class="related-post-wrap related_course">';
                    edubin_lif_related_course_content(); 
                echo '</div>';

                } 
            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();