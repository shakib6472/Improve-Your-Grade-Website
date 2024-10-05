<?php 

    $course_id     = get_the_ID();
    $course_rating = tutor_utils()->get_course_rating( $course_id );
    $is_enrolled   = tutor_utils()->is_enrolled( $course_id, get_current_user_id() );

    // Prepare the nav items.
    $course_nav_item = apply_filters( 'tutor_course/single/nav_items', tutor_utils()->course_nav_items(), $course_id );
    $is_public       = \TUTOR\Course_List::is_public( $course_id );
    $is_mobile       = wp_is_mobile();

    $enrollment_box_position = tutor_utils()->get_option( 'enrollment_box_position_in_mobile', 'bottom' );
    if ( '-1' === $enrollment_box_position ) {
        $enrollment_box_position = 'bottom';
    }
    $student_must_login_to_view_course = tutor_utils()->get_option( 'student_must_login_to_view_course' );

    tutor_utils()->tutor_custom_header();

    if ( ! is_user_logged_in() && ! $is_public && $student_must_login_to_view_course ) {
        tutor_load_template( 'login' );
        tutor_utils()->tutor_custom_footer();
        return;
    }

    $tutor_single_page_layout = Edubin::setting( 'tutor_single_page_layout' );
    $tutor_intro_video_position = Edubin::setting( 'tutor_intro_video_position' );
    $tutor_related_course_position = Edubin::setting( 'tutor_related_course_position' );
    $tutor_single_social_shear = Edubin::setting( 'tutor_single_social_shear' );
    $tutor_single_course_info = Edubin::setting( 'tutor_single_course_info' );
    $tutor_single_cat_list = Edubin::setting( 'tutor_single_cat_list' );
    $tutor_single_tags = Edubin::setting( 'tutor_single_tags' );
    
    $tutor_single_sidebar_sticky = Edubin::setting( 'tutor_single_sidebar_sticky' ); 
    $sidebar_sticky_on_off = ( $tutor_single_sidebar_sticky ? 'do_sticky' : '');


echo '<aside id="secondary" class="widget-area '; echo esc_attr( $sidebar_sticky_on_off ); echo '">';

    echo '<div class="course-sidebar-preview tutor">';

    // ==== Sidebar course info ====
    //if ($tutor_single_course_info) {

      //  if (function_exists('edubin_tutor_course_info')) {
            echo '<div class="tutor__widget">';
                echo '<div class="tutor-sidebar-top-wrap">';

                 if ( !in_array( $tutor_single_page_layout, array('5')) ) {
                  
                    if ( $tutor_intro_video_position == 'intro_video_sidebar' ) {
                        get_template_part( 'tutor/tpl-part/single/media', 'sidebar' );
                    } 
                }
                    do_action( 'tutor_course/single/before/sidebar' ); 

                    edubin_tutor_course_info();

                        // ===== Sidebar share this course =====
                        if ($tutor_single_social_shear) {
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

                echo '<div class="tutor-single-course-sidebar-more tutor-mt-24">';
                        tutor_course_instructors_html();
                        tutor_course_requirements_html();

                        if ( $tutor_single_tags ) {
                            tutor_course_tags_html();
                        }
                        
                        tutor_course_target_audience_html();
                    echo '</div>';

                 do_action( 'tutor_course/single/after/sidebar' );
            echo '</div>';
      //  }
    //}

    echo '</div>';

     // ===== Sidebar course category =====
    if ($tutor_single_cat_list && !empty(get_the_terms(get_the_ID(), 'tutor_course_category'))) {
        if (function_exists('edubin_tutor_course_category')) {
            echo '<div class="tutor__widget">';

            edubin_tutor_course_category();

            echo '</div>';
        }
    }

     // ===== Sidebar widgets =====
    if ($tutor_related_course_position == 'sidebar') {
        if (function_exists('edubin_tutor_related_course_sidebar')) {
            echo '<div class="tutor__widget">';

                edubin_tutor_related_course_sidebar();

            echo '</div>';
        }
    }

    if (is_active_sidebar('tutor-course-sidebar-1')) :
        echo '<div class="tutor__widget">';

            dynamic_sidebar('tutor-course-sidebar-1');

        echo '</div>';
    endif;

echo '</aside>';