<?php

defined( 'ABSPATH' ) || exit();
use \Edubin\Filter;

global $post, $authordata;

if ( ! isset( $get_options ) ) :
    $get_options = array();
endif;

$tutor_archive_image_size   = \Edubin::setting( 'tutor_archive_image_size' );

$thumb_size = $tutor_archive_image_size ? $tutor_archive_image_size : 'edubin-post-thumb';
if ( isset( $_GET['thumb_size'] ) ) :
    $thumb_size = wp_unslash( $_GET['thumb_size'] );
endif;


$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
if ( isset( $thumb_src ) && ! empty( $thumb_src ) ) :
    $thumb_url = $thumb_src[0];
else :
    $thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
endif;

if ( ! isset( $style ) ) :
    $style = Edubin::setting( 'tutor_course_archive_style' );
endif;

$button_text =  __( 'Enroll Now', 'edubin' );

if ( isset( $_GET['button_text'] ) ) :
    $button_text = wp_unslash( $_GET['button_text'] );
endif;

if ( isset( $_GET['course_preset'] ) ) :
    $style = Filter::grid_layout_keys();
endif;

$course_rating   = tutor_utils()->get_course_rating();
$ratings_average = $course_rating->rating_avg;
$total_ratings   = $course_rating->rating_count;
$percent         = ( ! $ratings_average ) ? 0 : min( 100, ( round( $ratings_average * 2 ) / 2 ) * 20 );
$features        = get_post_meta( get_the_ID(), 'edubin_course_top_features', true );
$class_type     = get_post_meta( get_the_ID(), 'edubin_tl_course_class_type', true );

$default_data = [
    'thumb_url'        => $thumb_url,
    'style'            => $style,
    'instructors'      => tutor_utils()->get_instructors_by_course(),
    'lessons'          => tutor_utils()->get_lesson_count_by_course( get_the_ID() ),
    'quiz'             => tutor_utils()->get_quiz_count_by_course( get_the_ID() ),
    'duration'         => get_tutor_course_duration_context(),
    'disable_enrolled' => get_tutor_option( 'disable_course_total_enrolled' ),
    'enrolled'         => tutor_utils()->count_enrolled_users_by_course(),
    'cat_item'         => edubin_category_by_id( get_the_ID(), 'course-category' ),
    'review_status'    => get_tutor_option( 'enable_course_review' ),
    'ratings_average'  => $ratings_average,
    'total_ratings'    => $total_ratings,
    'percent'          => $percent,
    'level'            => get_tutor_course_level(),
    'author'           => $post->post_author,
    'author_name'      => $authordata->display_name,
    'author_url'       => tutor_utils()->profile_url( $authordata->ID ),
    'features'         => $features,
    'button_text'      => $button_text,
    'uniqid'           => uniqid(),
    'class_type'       => $class_type,
    'enable_excerpt'   => true,
    'excerpt_length'   => 14,
    'excerpt_end'      => '...'
];

$get_options = wp_parse_args( $get_options, $default_data );

tutor_load_template( 'tpl-part.course.th-layout-' . $get_options['style'], compact( 'get_options', 'features' ) );

