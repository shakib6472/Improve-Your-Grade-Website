<?php

$tutor_single_page_layout = Edubin::setting( 'tutor_single_page_layout' );
$tutor_instructor_single = Edubin::setting( 'tutor_instructor_single' );
$tutor_single_last_update = Edubin::setting( 'tutor_single_last_update' );
$tutor_lesson_single = Edubin::setting( 'tutor_lesson_single' ); 
$tutor_single_enroll_btn = Edubin::setting( 'tutor_single_enroll_btn' ); 
$tutor_duration_single = Edubin::setting( 'tutor_duration_single' ); 


if ( !in_array( $tutor_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-01">';

            if ($tutor_instructor_single) { 
                echo '<div class="course-instructor post-author">';

                    echo '<span class="meta-icon meta-image">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 42 );
                    echo '</span>';

                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 

             $course_rating  = tutor_utils()->get_course_rating( get_the_ID() );

             echo '<div class="edubin-rating-wrap">';

                 echo '<span class="edubin-ratings-stars">';
                      echo tutor_utils()->star_rating_generator_v2( $course_rating->rating_avg, null, false, '', 'lg' );
                echo '</span>';

                 echo '<span class="edubin-ratings-total">';
                     $total_text = ('1' == $course_rating) ? esc_html__(' Review', 'edubin') : esc_html__(' Reviews', 'edubin');
                     echo esc_attr(' (');
                    echo esc_html( apply_filters( 'tutor_course_rating_average', $course_rating->rating_avg ) );
                     echo esc_attr(' /');
                     echo esc_html( $course_rating->rating_count > 0 ? $course_rating->rating_count : 0 );
                     echo esc_html($total_text);
                     echo esc_attr(')');
                echo '</span>';

             echo '</div>'; // End .edubin-rating-wrap
                     


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

if ( in_array( $tutor_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-02">';
 
            if ($tutor_lesson_single) {

                $lesson = tutor_utils()->get_lesson_count_by_course(get_the_ID());
                $lesson_text = ('1' == $lesson) ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin');

                echo '<div class="top__meta course-lesson">';
                echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="meta-value">';
                        echo esc_attr($lesson) . ' ' . esc_html($lesson_text);
                    echo '</span>';
                echo '</div>';
            }

            $students = (int) tutor_utils()->count_enrolled_users_by_course(); 

           if ( $students && $tutor_single_enroll_btn ): 

                echo '<div class="top__meta course-students">';
                    echo '<i class="meta-icon flaticon-users"></i>';
                        echo '<span class="meta-value">';
                            echo esc_html($students); 
                            echo esc_html__(' Enrolled', 'edubin'); 
                    echo '</span>'; 
                echo '</div>';    
             endif; 

            $course_duration = get_tutor_course_duration_context();

             if ( $tutor_duration_single ): 
                echo '<div class="top__meta course-duration">';
                    echo '<i class="meta-icon flaticon-start"></i>';
                        echo '<span class="meta-value">';
                           echo wp_kses_post($course_duration);
                    echo '</span>'; 
                echo '</div>';   
            endif;

    echo '</div>'; 
}