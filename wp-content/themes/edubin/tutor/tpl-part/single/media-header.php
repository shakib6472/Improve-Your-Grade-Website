<?php

echo '<div class="intro-video-sidebar intro-video-sidebar is__sidebar">';  
    echo '<div class="intro-video-content">';  
            tutor_utils()->has_video_in_single() ? tutor_course_video() : get_tutor_course_thumbnail(); 
    echo '</div>';   
echo '</div>'; // End intro-video-sidebar

