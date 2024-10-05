<?php

$lp_single_page_layout = Edubin::setting( 'lp_single_page_layout' );
$lp_instructor_single = Edubin::setting( 'lp_instructor_single' );
$lp_single_last_update = Edubin::setting( 'lp_single_last_update' );
$lp_lesson_single = Edubin::setting( 'lp_lesson_single' ); 
$lp_single_enroll_btn = Edubin::setting( 'lp_single_enroll_btn' ); 
$lp_duration_single = Edubin::setting( 'lp_duration_single' ); 
$lp_single_review = Edubin::setting( 'lp_single_review' ); 


if ( in_array( $lp_single_page_layout, array('2', '4')) ) {
    echo '<div class="edubin-course-single-header-meta-01">';

            if ($lp_instructor_single) { 
                echo '<div class="course-instructor post-author">';

                    echo '<span class="meta-icon meta-image">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 42 );
                    echo '</span>';

                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 

            if ( class_exists('LP_Addon_Course_Review_Preload') && $lp_single_review ):

                 echo '<div class="edubin-rating-wrap">';
                        edubin_lp_course_ratings();
                 echo '</div>'; // End .edubin-rating-wrap
            endif;       

            if (1==1) {
                echo '<div class="edubin-last-update-wrap">';
                echo '<span class="edubin-last-update">';
                    echo esc_html__('Last Updated : ', 'edubin');
                    echo get_the_modified_date();
                echo '</span>';
                echo '</div>';

            }

    echo '</div>';
}

if ( in_array( $lp_single_page_layout, array('3')) ) {
    echo '<div class="edubin-course-single-header-meta-01">';

            global $post; $post_id = $post->ID;
            $course_id = $post_id;
            $user_id   = get_current_user_id();
            $current_id = $post->ID;
            $course    = learn_press_get_course();

            if ($lp_instructor_single) { 
                echo '<div class="course-instructor post-author">';

                    echo '<span class="meta-icon meta-image">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 42 );
                    echo '</span>';

                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 
         if ( class_exists('LP_Addon_Course_Review_Preload') && $lp_single_review ):

                 echo '<div class="edubin-rating-wrap">';
                        edubin_lp_course_ratings();
                 echo '</div>'; // End .edubin-rating-wrap
            endif;   

            $students = (int)learn_press_get_course()->count_students(); 
            $lp_student_text = ('1' == $students) ? esc_html__(' Student', 'edubin') : esc_html__(' Students', 'edubin');

             // if ( $lp_students && $lp_course_feature_enroll_show ): 
              
                echo '<div class="course-students">';
                    echo '<i class="meta-icon flaticon-users"></i>';
                        echo '<span class="meta-value">';
                             echo esc_html($students); 
                             echo esc_html($lp_student_text); 
                    echo '</span>'; 
                echo '</div>';    
             // endif; 


            $lessons = $course->get_items('lp_lesson', false) ? count($course->get_items('lp_lesson', false)) : 0;
            $lessons_text = ('1' == $lessons) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');

             // if ( $lessons  && $lp_course_feature_lessons_show ): 
                echo '<div class="course-lesson">';
                    echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="meta-value">';
                        echo esc_attr( $lessons ) . $lessons_text; 
                    echo '</span>'; 
                echo '</div>';    
            //  endif; 

            $lp_quizzes      = $course->get_curriculum_items('lp_quiz');

            $quiz = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
            $quiz_text = ('1' == $quiz) ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quizzes', 'edubin'); 

             //if ( $quiz && $lp_course_feature_quizzes_show ): 
                echo '<div class="course-duration">';
                    echo '<i class="meta-icon flaticon-pin"></i>';
                        echo '<span class="meta-value">';
                            echo esc_attr( $quiz ) . $quiz_text;
                    echo '</span>'; 
                echo '</div>';   
           // endif;


            if (1==1) {
                echo '<div class="edubin-last-update-wrap">';
                echo '<span class="edubin-last-update">';
                    echo esc_html__('Last Updated : ', 'edubin');
                    echo get_the_modified_date();
                echo '</span>';
                echo '</div>';

            }

    echo '</div>';
}

if ( in_array( $lp_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-02">';
   global $post; $post_id = $post->ID;
            $course_id = $post_id;
            $user_id   = get_current_user_id();
            $current_id = $post->ID;
            $course    = learn_press_get_course();

            if ($lp_instructor_single) { 
                echo '<div class="course-instructor post-author">';

                    echo '<span class="meta-icon meta-image">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 42 );
                    echo '</span>';

                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 

            $students = (int)learn_press_get_course()->count_students(); 
            $lp_student_text = ('1' == $students) ? esc_html__(' Student', 'edubin') : esc_html__(' Students', 'edubin');

             // if ( $lp_students && $lp_course_feature_enroll_show ): 
              
                echo '<div class="top__meta course-students">';
                    echo '<i class="meta-icon flaticon-users"></i>';
                        echo '<span class="meta-value">';
                             echo esc_html($students); 
                             echo esc_html($lp_student_text); 
                    echo '</span>'; 
                echo '</div>';    
             // endif; 

 
           // if ($lp_lesson_single) {

            $lessons = $course->get_items('lp_lesson', false) ? count($course->get_items('lp_lesson', false)) : 0;
            $lessons_text = ('1' == $lessons) ? esc_html__(' Lesson', 'edubin') : esc_html__(' Lessons', 'edubin');

             // if ( $lessons  && $lp_course_feature_lessons_show ): 
                echo '<div class="top__meta course-lesson">';
                    echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="meta-value">';
                        echo esc_attr( $lessons ) . $lessons_text; 
                    echo '</span>'; 
                echo '</div>';    
            //  endif; 

         //   }


            $lp_quizzes      = $course->get_curriculum_items('lp_quiz');

            $quiz = $course->get_items('lp_quiz', false) ? count($course->get_items('lp_quiz', false)) : 0;
            $quiz_text = ('1' == $quiz) ? esc_html__(' Quiz', 'edubin') : esc_html__(' Quizzes', 'edubin'); 

             //if ( $quiz && $lp_course_feature_quizzes_show ): 
                echo '<div class="top__meta course-duration">';
                    echo '<i class="meta-icon flaticon-pin"></i>';
                        echo '<span class="meta-value">';
                            echo esc_attr( $quiz ) . $quiz_text;
                    echo '</span>'; 
                echo '</div>';   
           // endif;

    echo '</div>'; 
}