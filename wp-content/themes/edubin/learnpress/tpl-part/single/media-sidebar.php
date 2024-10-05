<?php

$tutor_intro_video_position = Edubin::setting( 'tutor_intro_video_position' );

if ( $tutor_intro_video_position == 'intro_video_sidebar' ) : 
    echo '<div class="intro-video-sidebar intro-video-content is__sidebar">';  
		tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); 
    echo '</div>';   
endif;



