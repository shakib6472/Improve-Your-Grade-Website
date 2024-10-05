<?php 

    $sensei_single_page_layout = Edubin::setting( 'sensei_single_page_layout' );
    $sensei_intro_video_position = Edubin::setting( 'sensei_intro_video_position' );
    $sensei_related_course_position = Edubin::setting( 'sensei_related_course_position' );
    $sensei_single_social_shear = Edubin::setting( 'sensei_single_social_shear' );
    $sensei_single_course_info = Edubin::setting( 'sensei_single_course_info' );
    $sensei_single_course_cat = Edubin::setting( 'sensei_single_course_cat' );
    
    $sensei_single_sidebar_sticky = Edubin::setting( 'sensei_single_sidebar_sticky' ); 
    $sidebar_sticky_on_off = ( $sensei_single_sidebar_sticky ? 'do_sticky' : '');


echo '<aside id="secondary" class="widget-area '; echo esc_attr( $sidebar_sticky_on_off ); echo '">';

    echo '<div class="course-sidebar-preview sensei">';

    // ==== Sidebar course info ====
    if ($sensei_single_course_info) {

        if (function_exists('edubin_sensei_course_info')) {
            echo '<div class="sensei__widget">';

                 if ( !in_array( $sensei_single_page_layout, array('5')) ) {
                  
                    if ( $sensei_intro_video_position == 'intro_video_sidebar' ) {
                        get_template_part( 'sensei/tpl-part/single/media', 'sidebar' );
                    } 
                }

                edubin_sensei_course_info();

            echo '</div>';
        }
    }

    // ===== Sidebar share this course =====
    if ($sensei_single_social_shear) {
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
    if ($sensei_single_course_cat && !empty(get_the_terms(get_the_ID(), 'sensei_course_category'))) {
        if (function_exists('edubin_sensei_course_category')) {
            echo '<div class="sensei__widget">';

            edubin_sensei_course_category();

            echo '</div>';
        }
    }

     // ===== Sidebar widgets =====
    if ($sensei_related_course_position == 'sidebar') {
        if (function_exists('edubin_sensei_related_course_sidebar')) {
            echo '<div class="sensei__widget">';

                edubin_sensei_related_course_sidebar();

            echo '</div>';
        }
    }

    if (is_active_sidebar('sensei-course-sidebar-1')) :
        echo '<div class="sensei__widget">';

            dynamic_sidebar('sensei-course-sidebar-1');

        echo '</div>';
    endif;

echo '</aside>';