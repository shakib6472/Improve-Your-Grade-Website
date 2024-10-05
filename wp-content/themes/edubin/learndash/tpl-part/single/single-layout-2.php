<?php
/**
 * The template for displaying course single page
 */

get_header(); 

    $ld_course_header_style = Edubin::setting( 'ld_course_header_style' );
    $ld_related_course_position = Edubin::setting( 'ld_related_course_position' );

    // ==== Course Header =====

    while ( have_posts() ) : the_post(); 

        edubin_ld_course_page_title_section_03();

    endwhile; wp_reset_postdata(); 

     // ==== Content Area  =====   
    echo '<div id="primary" class="content-area">';
        echo '<main id="main" class="site-main" role="main">';
        
            echo '<div class="edubin-container">';
                echo '<div class="edubin-row">';
                echo '<div class="edubin-col-lg-8 order-2 order-lg-1 mt-4 mt-lg-0">'; 

                while ( have_posts() ) : the_post();

                    get_template_part( 'learndash/tpl-part/single/single', 'content' );

                endwhile; 

                // ==== Bug fix for review plugin has active ====
                if (class_exists('LearnDash_Course_Reviews')) {
                    echo '<div class="edubin-col-lg-4 order-1 order-lg-2">';

                        get_template_part( 'learndash/tpl-part/single/single', 'sidebar'); 

                    echo '</div>'; // End col-4
                }
                echo '</div>'; // End col-8
                
                // ==== Bug fix for review plugin not active ====
                if (!class_exists('LearnDash_Course_Reviews')) {
                    echo '<div class="edubin-col-lg-4 order-1 order-lg-2">';

                        get_template_part( 'learndash/tpl-part/single/single', 'sidebar'); 

                    echo '</div>'; // End col-4
                }
                echo '</div>'; // End edubin-row

            echo '</div>'; // End edubin-container

            echo '<div class="edubin-container">';
                if ( $ld_related_course_position == 'content' ) { 

                    echo '<div class="related-post-wrap related_course">';
                        edubin_ld_related_course_content(); 
                    echo '</div>';

                } 
            echo '</div>'; // End edubin-container

        echo '</main>';
    echo '</div>';

get_footer();