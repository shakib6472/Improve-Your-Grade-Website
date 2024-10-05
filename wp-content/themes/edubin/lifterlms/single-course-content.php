<?php

defined( 'ABSPATH' ) || exit();

get_header();

$course_details_style = edubin_set_value( 'll_course_details_style', 1 );
$course_details_sidebar = edubin_set_value( 'll_course_details_sidebar_status', true );
$course_sidebar_sticky = edubin_set_value( 'll_course_details_sidebar_sticky', true );
$course_details_column = 'edubin-col-lg-12';
$siebar_main_content = 'course-summary';
$course_sidebar_class = 'ed-course-sidebar';

if ( isset( $_GET['course_details'] ) ) :
	$course_details_style = in_array( $_GET['course_details'], array( 1, 2, 3, 4, 5, 6 ) ) ? $_GET['course_details'] : 1;
endif;

if ( $course_details_sidebar ) :
	$course_details_column = 'edubin-col-lg-8';
endif;

if ( isset( $_GET['disable_sidebar'] ) ) :
	$course_details_column = 'edubin-col-lg-12';
	$course_details_sidebar = false;
endif;

if ( isset( $_GET['sidebar_sticky'] ) ) :
	$course_sidebar_sticky = true;
endif;

if ( in_array( $course_details_style, array( 3, 4 ) ) ) :
	if ( $course_sidebar_sticky ) :
		wp_enqueue_script( 'theia-sticky-sidebar' );
		$siebar_main_content .= $siebar_main_content . ' ' . 'eb-sticky-sidebar-parallal-content';
		$course_sidebar_class = $course_sidebar_class . ' ' . 'eb-sidebar-sticky';
	endif;
endif;

edubin_ll_course_details_header( $course_details_style );

echo '<div class="edubin-course-details-page ll-course-single-page eb-course-single-style-' . esc_attr( $course_details_style ) . '">';
	echo '<div class="edubin-container">';
		echo '<div class="edubin-row">';
			echo '<div class="' . esc_attr( $siebar_main_content ) . ' ' . apply_filters( 'courese_details_columnn', $course_details_column ) . '">';
				echo '<div class="eb-course-details-page-content">';
                    the_content();
					
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				echo '</div>';
			echo '</div>';

			if ( $course_details_sidebar ) :
				echo '<div class="' . esc_attr( $course_sidebar_class ) . ' ' . apply_filters( 'courese_details_sidebar_columnn', 'edubin-col-lg-4' ) . '">';
					edubin_ll_course_content_sidebar();
				echo '</div>';
			endif;
		echo '</div>';
	echo '</div>';
echo '</div>';

edubin_ll_related_courses();

get_footer();