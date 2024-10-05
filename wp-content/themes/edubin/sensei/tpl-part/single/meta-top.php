<?php

$sensei_single_page_layout = Edubin::setting( 'sensei_single_page_layout' );
$sensei_instructor_single = Edubin::setting( 'sensei_instructor_single' );
$sensei_single_last_update = Edubin::setting( 'sensei_single_last_update' );
$sensei_single_lesson = Edubin::setting( 'sensei_single_lesson' ); 
$sensei_single_language = Edubin::setting( 'sensei_single_language' ); 


if ( !in_array( $sensei_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-01">';

            if ($sensei_instructor_single) { 
                echo '<div class="course-instructor post-author">';

                    echo '<span class="meta-icon meta-image">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 42 );
                    echo '</span>';

                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 

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

if ( in_array( $sensei_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-02">';

             if ($sensei_instructor_single) { 
                echo '<div class="top__meta course-instructor post-author">';
                echo '<i class="meta-icon flaticon-user"></i>';
                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 

            if ($sensei_single_lesson) {

                $course              = get_post( get_the_ID() );
                $lesson_count        = Sensei()->course->course_lesson_count( get_the_ID() );
                $lesson_text = ('1' == $lesson_count) ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin');

                echo '<div class="top__meta course-lesson">';
                echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="meta-value">';
                       echo esc_attr($lesson_count) . ' ' . esc_html($lesson_text);
                    echo '</span>';
                echo '</div>';
            }

            if ( $sensei_single_language &&  get_the_terms(get_the_ID(), 'sensei_course_language') ) {

                echo '<div class="top__meta course-language">';
                echo '<i class="meta-icon flaticon-worldwide"></i>';
                    echo '<span class="meta-value">';
                        if ( get_the_terms(get_the_ID(), 'sensei_course_language')) {
                            echo get_the_term_list(get_the_ID(), 'sensei_course_language', '');
                        }
                    echo '</span>';
                echo '</div>';
           }


    echo '</div>'; 
}