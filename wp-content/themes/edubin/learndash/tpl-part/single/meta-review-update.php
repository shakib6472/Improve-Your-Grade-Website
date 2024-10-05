<?php

$ld_single_review = Edubin::setting( 'ld_single_review' );
$ld_single_last_update = Edubin::setting( 'ld_single_last_update' );

echo '<div class="edubin-single-course-lead-meta-01">';

	if ($ld_single_review && function_exists('ldcr_course_rating_stars')) {
	    echo '<div class="lead-meta-item meta-last-review">';
	    	ldcr_course_rating_stars();
	    echo '</div>';
	}

	 if ($ld_single_last_update) { 

	    echo '<div class="lead-meta-item meta-last-update">';
	        echo '<span class="lead-meta-value">';
	            echo esc_html__('Last Updated : ', 'edubin');
	                echo get_the_modified_date();
	            echo '</span>'; 
	        echo '</div>';      
	} 

echo '</div>'; // <div class="edubin-single-course-lead-meta">