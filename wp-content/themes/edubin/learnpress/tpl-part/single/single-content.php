<?php
/**
 * The template for displaying course single page
 */

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

    $tutor_intro_video_position = Edubin::setting( 'tutor_intro_video_position' ); 
    $tutor_single_page_layout  = Edubin::setting( 'tutor_single_page_layout' );


echo '<article id="post-'; the_ID(); echo '"'; post_class( 'edubin-course-single-wrap' ); echo '>';  

    if ( !in_array( $tutor_single_page_layout, array('5')) ) {
        if ( $tutor_intro_video_position == 'intro_video_content' ) : 
            get_template_part( 'tutor/tpl-part/single/media', 'content' );
        endif;
    }

    echo '<div class="post-wrapper">';

        echo '<div class="tutor-course-details-tab">';
            if (is_array($course_nav_item) && count($course_nav_item) > 1) : 
                echo '<div class="tutor-is-sticky">';
                    tutor_load_template('single.course.enrolled.nav', array('course_nav_item' => $course_nav_item)); 
                echo '</div>';
            endif; 
            echo '<div class="tutor-tab tutor-pt-24">';
                foreach ($course_nav_item as $key => $subpage) : 
                    echo '<div id="tutor-course-details-tab-' . esc_attr($key) . '" class="tutor-tab-item' . ('info' == $key ? ' is-active' : '') . '">';
                        do_action('tutor_course/single/tab/' . $key . '/before');
                        $method = $subpage['method'];
                        if (is_string($method)) {
                            $method();
                        } else {
                            $_object = $method[0];
                            $_method = $method[1];
                            $_object->$_method(get_the_ID());
                        }
                        do_action('tutor_course/single/tab/' . $key . '/after');
                    echo '</div>';
                endforeach; 
            echo '</div>';
        echo '</div>';
        do_action('tutor_course/single/after/inner-wrap');

    echo '</div>'; // End post-wrapper

echo ' </article>'; //  End </article>
           