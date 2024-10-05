<?php 

    $lif_single_page_layout = Edubin::setting( 'lif_single_page_layout' );
    $lif_intro_video_position = Edubin::setting( 'lif_intro_video_position' );
    $lif_related_course_position = Edubin::setting( 'lif_related_course_position' );
    $lif_single_social_shear = Edubin::setting( 'lif_single_social_shear' );
    $lif_single_course_info = Edubin::setting( 'lif_single_course_info' );
    $lif_single_course_cat = Edubin::setting( 'lif_single_course_cat' );
    
    $lif_single_sidebar_sticky = Edubin::setting( 'lif_single_sidebar_sticky' ); 
    $sidebar_sticky_on_off = ( $lif_single_sidebar_sticky ? 'do_sticky' : '');


echo '<aside id="secondary" class="widget-area '; echo esc_attr( $sidebar_sticky_on_off ); echo '">';

    echo '<div class="course-sidebar-preview lif">';

    // ==== Sidebar course info ====
    if ($lif_single_course_info) {

        if (function_exists('edubin_lif_course_info')) {
            echo '<div class="lif__widget">';

                 if ( !in_array( $lif_single_page_layout, array('5')) ) {
                  
                    if ( $lif_intro_video_position == 'intro_video_sidebar' ) {
                        get_template_part( 'lifterlms/tpl-part/single/media', 'sidebar' );
                    } 
                }

                edubin_lif_course_info();

            echo '</div>';
        }
    }

    // ===== Sidebar share this course =====
    if ($lif_single_social_shear) {
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
    if ($lif_single_course_cat && !empty(get_the_terms(get_the_ID(), 'course_cat'))) {
        if (function_exists('edubin_lif_course_category')) {
            echo '<div class="lif__widget">';

            edubin_lif_course_category();

            echo '</div>';
        }
    }

     // ===== Sidebar widgets =====
    if ($lif_related_course_position == 'sidebar') {
        if (function_exists('edubin_lif_related_course_sidebar')) {
            echo '<div class="lif__widget">';

                edubin_lif_related_course_sidebar();

            echo '</div>';
        }
    }

    if (is_active_sidebar('lif-course-sidebar-1')) :
        echo '<div class="lif__widget">';

            dynamic_sidebar('lif-course-sidebar-1');

        echo '</div>';
    endif;

echo '</aside>';