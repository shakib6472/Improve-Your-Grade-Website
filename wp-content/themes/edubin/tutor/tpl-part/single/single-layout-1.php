<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $tutor_course_header_style = Edubin::setting( 'tutor_course_header_style' );
    $tutor_related_course_position = Edubin::setting( 'tutor_related_course_position' );
    $tutor_intro_video_position = Edubin::setting( 'tutor_intro_video_position' );


    // ==== Course Header =====

    while ( have_posts() ) : the_post(); 

       if ( '1' == $tutor_course_header_style ) { edubin_course_page_title_section_02(); } else { edubin_course_page_title_section_01();}

    endwhile; wp_reset_postdata(); 

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';
                echo '<div class="edubin-row">';
                echo '<div class="edubin-col-lg-8 order-2 order-lg-1 mt-4 mt-lg-0">'; 

                while ( have_posts() ) : the_post();

                   get_template_part( 'tutor/tpl-part/single/single', 'content' );

                endwhile; 

                echo '</div>'; // End col-8
                
                echo '<div class="edubin-col-lg-4 order-1 order-lg-2">';

                   get_template_part( 'tutor/tpl-part/single/single', 'sidebar'); 

                echo '</div>'; // End col-4

                echo '</div>'; // End edubin-row

                if ( $tutor_related_course_position == 'content' ) { 

                    echo '<div class="related-post-wrap related_course">';
                      edubin_tutor_related_course_content(); 
                    echo '</div>';

                } 

            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();