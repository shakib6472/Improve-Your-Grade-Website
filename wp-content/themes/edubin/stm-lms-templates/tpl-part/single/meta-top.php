<?php

$ms_single_page_layout = Edubin::setting( 'ms_single_page_layout' );
$ms_instructor_single = Edubin::setting( 'ms_instructor_single' );
$ms_single_last_update = Edubin::setting( 'ms_single_last_update' );
$ms_lesson_single = Edubin::setting( 'ms_lesson_single' ); 
$ms_single_enrolled = Edubin::setting( 'ms_single_enrolled' ); 
$ms_duration_single = Edubin::setting( 'ms_duration_single' ); 
$ms_single_review = Edubin::setting( 'ms_single_review' ); 


if ( !in_array( $ms_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-01">';

            if ( $ms_instructor_single ) { 
                echo '<div class="course-instructor post-author">';

                    echo '<span class="meta-icon meta-image">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 42 );
                    echo '</span>';

                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 

            if ($ms_single_review) {
             echo '<div class="edubin-rating-wrap">';

                 echo '<span class="edubin-ratings-stars">';
                        edubin_ms_course_rating_02( 'text' );
                echo '</span>';

             echo '</div>'; // End .edubin-rating-wrap
            } 

            if ($ms_single_last_update) {
                echo '<div class="edubin-last-update-wrap">';
                echo '<span class="edubin-last-update">';
                    echo esc_html__('Last Updated : ', 'edubin');
                    echo get_the_modified_date();
                echo '</span>';
                echo '</div>';

            }

    echo '</div>';
}

if ( in_array( $ms_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-02">';
 
            $curriculum_info = \STM_LMS_Course::curriculum_info( get_the_ID() );
            $meta_info = \STM_LMS_Helpers::parse_meta_field( get_the_ID() );

            if ($ms_lesson_single) {

                $lesson = $curriculum_info['lessons'];
                $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin');

                echo '<div class="top__meta course-lesson">';
                echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="meta-value">';
                        echo esc_attr($lesson) . ' ' . esc_html($lesson_text);
                    echo '</span>';
                echo '</div>';
            }

            $students = $meta_info['current_students'];
            $student_text = ('1' == $meta_info['current_students']) ? esc_html__('Student', 'edubin') : esc_html__('Students', 'edubin');

            if ( $students && $ms_single_enrolled ): 
                echo '<div class="top__meta course-students">';
                    echo '<i class="meta-icon flaticon-users"></i>';
                        echo '<span class="meta-value">';
                            echo esc_html($students) . ' ' . $student_text; 
                    echo '</span>'; 
                echo '</div>';    
            endif; 

            $total_quiz = $curriculum_info['quizzes'];
            $total_quiz_text = ($total_quiz == 1) ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quizzes', 'edubin');

            if ( $total_quiz ): 
                echo '<div class="top__meta course-duration">';
                    echo '<i class="meta-icon flaticon-start"></i>';
                        echo '<span class="meta-value">';
                           echo wp_kses_post($total_quiz); 
                           echo esc_html($total_quiz_text); 
                    echo '</span>'; 
                echo '</div>';   
            endif;

    echo '</div>'; 
}