<?php 

    $ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
    $ld_intro_video_position = Edubin::setting( 'ld_intro_video_position' );
    $ld_related_course_position = Edubin::setting( 'ld_related_course_position' );
    $ld_single_social_shear = Edubin::setting( 'ld_single_social_shear' );
    $ld_single_course_info = Edubin::setting( 'ld_single_course_info' );
    $ld_single_course_cat = Edubin::setting( 'ld_single_course_cat' );
    
    $ld_single_sidebar_sticky = Edubin::setting( 'ld_single_sidebar_sticky' ); 
    $sidebar_sticky_on_off = ( $ld_single_sidebar_sticky ? 'do_sticky' : '');


echo '<aside id="secondary" class="widget-area '; echo esc_attr( $sidebar_sticky_on_off ); echo '">';

    echo '<div class="course-sidebar-preview ld">';

    // ==== Sidebar course info ====
    if ($ld_single_course_info) {

        if (function_exists('edubin_ld_course_info')) {
            echo '<div class="ld__widget">';

                 if ( !in_array( $ld_single_page_layout, array('5')) ) {
                  
                    if ( $ld_intro_video_position == 'intro_video_sidebar' ) {
                        get_template_part( 'learndash/tpl-part/single/media', 'sidebar' );
                    } 
                }

                edubin_ld_course_info();

            echo '</div>';
        }
    }

    // ===== Sidebar share this course =====
    if ($ld_single_social_shear) {
        echo '<div class="entry-post-share text-center tpc_pb_30">';
            echo '<div class="post-share style-03">';
                echo '<div class="share-label">';

                    esc_html_e('Share this course', 'edubin');

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

     // ===== Sidebar course category =====
    if ($ld_single_course_cat && !empty(get_the_terms(get_the_ID(), 'ld_course_category'))) {
        if (function_exists('edubin_ld_course_category')) {
            echo '<div class="ld__widget">';

            edubin_ld_course_category();

            echo '</div>';
        }
    }

     // ===== Sidebar widgets =====
    if ($ld_related_course_position == 'sidebar') {
        if (function_exists('edubin_ld_related_course_sidebar')) {
            echo '<div class="ld__widget">';

                edubin_ld_related_course_sidebar();

            echo '</div>';
        }
    }

    if (is_active_sidebar('ld-course-sidebar-1')) :
        echo '<div class="ld__widget">';

            dynamic_sidebar('ld-course-sidebar-1');

        echo '</div>';
    endif;

echo '</aside>';