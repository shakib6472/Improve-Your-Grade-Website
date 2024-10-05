 <?php
 
        $course_data = apply_filters( 'masterstudy_course_page_header', 'default' );

        STM_LMS_Templates::show_lms_template(
            'components/course/tabs',
            array(
                'course'     => $course_data['course'],
                'user_id'    => $course_data['current_user_id'],
                'style'      => 'underline',
                'with_image' => true,
            )
        );
        // if ( $course_data['settings']['enable_related_courses'] ) {
        //     STM_LMS_Templates::show_lms_template( 'components/course/related-courses', array( 'course' => $course_data['course'] ) );
        // }
?>
 