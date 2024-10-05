<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $ms_course_header_style = Edubin::setting( 'ms_course_header_style' );
    $ms_related_course_position = Edubin::setting( 'ms_related_course_position' );

    // ==== Course Header =====

    while ( have_posts() ) : the_post(); 

        edubin_ms_course_page_title_section_03();

    endwhile; wp_reset_postdata(); 

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
            echo '<div class="edubin-container">';
                echo '<div class="edubin-row">';
                    echo '<div class="edubin-col-lg-8 order-2 order-lg-1 edubin-course-single-top-space">'; 

                    while ( have_posts() ) : the_post();

                       get_template_part( 'stm-lms-templates/tpl-part/single/single', 'content' );

                    endwhile; 

                    echo '</div>'; // End col-8
                
                    echo '<div class="edubin-col-lg-4 order-1 order-lg-2">';

                       get_template_part( 'stm-lms-templates/tpl-part/single/single', 'sidebar'); 

                    echo '</div>'; // End col-4

                echo '</div>'; // End edubin-row

                if ( $ms_related_course_position == 'content' ) { 

                    echo '<div class="related-post-wrap related_course">';
                        edubin_ms_related_course_content(); 
                    echo '</div>';

                } 

            echo '</div>';
        echo '</main>';
    echo '</div>';

get_footer();