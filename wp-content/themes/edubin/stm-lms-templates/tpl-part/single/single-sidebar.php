<?php 

    $ms_single_page_layout = Edubin::setting( 'ms_single_page_layout' );
    $ms_intro_video_position = Edubin::setting( 'ms_intro_video_position' );
    $ms_related_course_position = Edubin::setting( 'ms_related_course_position' );
    $ms_single_social_shear = Edubin::setting( 'ms_single_social_shear' );
    $ms_single_course_info = Edubin::setting( 'ms_single_course_info' );
    $ms_single_course_cat = Edubin::setting( 'ms_single_course_cat' );
    
    $ms_single_sidebar_sticky = Edubin::setting( 'ms_single_sidebar_sticky' ); 
    $sidebar_sticky_on_off = ( $ms_single_sidebar_sticky ? 'do_sticky' : '');


echo '<aside id="secondary" class="widget-area '; echo esc_attr( $sidebar_sticky_on_off ); echo '">';

    echo '<div class="course-sidebar-preview ms">';

    // ==== Sidebar course info ====
    if ($ms_single_course_info) {

        if (function_exists('edubin_ms_course_info')) {
            echo '<div class="ms__widget">';

                 if ( !in_array( $ms_single_page_layout, array('5')) ) {
                  
                    if ( $ms_intro_video_position == 'intro_video_sidebar' ) {
                        get_template_part( 'stm-lms-templates/tpl-part/single/media', 'sidebar' );
                    } 
                }

                edubin_ms_course_info();

            echo '</div>';
        }
    }

    // ===== Sidebar share this course =====
    if ($ms_single_social_shear) {
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
    if ($ms_single_course_cat && !empty(get_the_terms(get_the_ID(), 'ms_course_category'))) {
        if (function_exists('edubin_ms_course_category')) {
            echo '<div class="ms__widget">';

            edubin_ms_course_category();

            echo '</div>';
        }
    }

     // ===== Sidebar widgets =====
    if ($ms_related_course_position == 'sidebar') {
        if (function_exists('edubin_ms_related_course_sidebar')) {
            echo '<div class="ms__widget">';

                edubin_ms_related_course_sidebar();

            echo '</div>';
        }
    }

    if (is_active_sidebar('stm_lms_sidebar')) :
        echo '<div class="ms__widget">';

           dynamic_sidebar('stm_lms_sidebar');

        echo '</div>';
    endif;

echo '</aside>';