<?php

$ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
$ld_instructor_single = Edubin::setting( 'ld_instructor_single' );
$ld_single_duration = Edubin::setting( 'ld_single_duration' );
$ld_lesson_single = Edubin::setting( 'ld_lesson_single' ); 
$ld_single_topic = Edubin::setting( 'ld_single_topic' ); 


if ( !in_array( $ld_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-01">';

            if ($ld_instructor_single) { 
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

if ( in_array( $ld_single_page_layout, array('5')) ) {
    echo '<div class="edubin-course-single-header-meta-02">';

             if ($ld_instructor_single) { 
                echo '<div class=" course-instructor post-author">';

                    echo '<span class="meta-icon meta-image">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 42 );
                    echo '</span>';

                    echo '<span class="meta-value">';
                        the_author();
                    echo '</span>'; 

                echo '</div>'; 

            } 

            if ($ld_lesson_single) {

            $lesson      = learndash_get_course_steps(get_the_ID(), array('sfwd-lessons'));
            $lesson      = $lesson ? count($lesson) : 0;
            $lesson_text = ($lesson == '1') ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin');

                echo '<div class="top__meta course-lesson">';
                echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="meta-value">';
                       echo esc_attr($lesson) . ' ' . esc_html($lesson_text);
                    echo '</span>';
                echo '</div>';
            }

            $topic      = learndash_get_course_steps(get_the_ID(), array('sfwd-topic'));
            $topic      = $topic ? count($topic) : 0;
            $topic_text = ($topic == '1') ? esc_html__('Topic', 'edubin') : esc_html__('Topics', 'edubin');

            if ($ld_single_topic) {


                echo '<div class="top__meta course-lesson">';
                echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="meta-value">';
                       echo esc_attr($topic) . ' ' . esc_html($topic_text);
                    echo '</span>';
                echo '</div>';
            }



    echo '</div>'; 
}