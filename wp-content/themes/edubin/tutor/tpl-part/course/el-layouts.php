<?php

defined( 'ABSPATH' ) || exit();

use \Edubin\Filter;

global $post, $authordata;

if ( ! isset( $get_options ) ) :
    $get_options = array();
endif;

$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'medium_large' );
if ( isset( $thumb_src ) && ! empty( $thumb_src ) ) :
    $thumb_url = $thumb_src[0];
else :
    $thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
endif;

if ( ! isset( $style ) ) :
    $style = Edubin::setting( 'tutor_course_archive_style' );
endif;

$button_text = '';

if ( isset( $_GET['button_text'] ) ) :
    $button_text = wp_unslash( $_GET['button_text'] );
endif;

if ( isset( $_GET['course_preset'] ) ) :
    $style = Filter::grid_layout_keys();
endif;


$show_review = '';
if ( isset( $_GET['show_review'] ) ) :
    $show_review = wp_unslash( $_GET['show_review'] );
endif;

// $show_media = '';
if ( isset( $_GET['show_media'] ) ) :
    $show_media = wp_unslash( $_GET['show_media'] );
endif;

// $show_intor_video = '';
if ( isset( $_GET['show_intor_video'] ) ) :
    $show_intor_video = wp_unslash( $_GET['show_intor_video'] );
endif;
if ( isset( $_GET['show_intor_video'] ) ) {
    $show_intor_video = wp_unslash( $_GET['show_intor_video'] );
}
// $show_excerpt = '';
if ( isset( $_GET['show_excerpt'] ) ) :
    $show_excerpt = wp_unslash( $_GET['show_excerpt'] );
endif;

// $excerpt_length = '';
if ( isset( $_GET['excerpt_length'] ) ) :
    $excerpt_length = wp_unslash( $_GET['excerpt_length'] );
endif;

// $show_author_img = '';
if ( isset( $_GET['show_author_img'] ) ) :
    $show_author_img = wp_unslash( $_GET['show_author_img'] );
endif;

// $show_author_name = '';
if ( isset( $_GET['show_author_name'] ) ) :
    $show_author_name = wp_unslash( $_GET['show_author_name'] );
endif;

// $show_enrolled = '';
if ( isset( $_GET['show_enrolled'] ) ) :
    $show_enrolled = wp_unslash( $_GET['show_enrolled'] );
endif;

// $show_enrolled_text = '';
if ( isset( $_GET['show_enrolled_text'] ) ) :
    $show_enrolled_text = wp_unslash( $_GET['show_enrolled_text'] );
endif;

// $show_lessons = '';
if ( isset( $_GET['show_lessons'] ) ) :
    $show_lessons = wp_unslash( $_GET['show_lessons'] );
endif;

// $show_lessons_text = '';
if ( isset( $_GET['show_lessons_text'] ) ) :
    $show_lessons_text = wp_unslash( $_GET['show_lessons_text'] );
endif;

// $show_quiz = '';
if ( isset( $_GET['show_quiz'] ) ) :
    $show_quiz = wp_unslash( $_GET['show_quiz'] );
endif;

// $show_quiz_text = '';
if ( isset( $_GET['show_quiz_text'] ) ) :
    $show_quiz_text = wp_unslash( $_GET['show_quiz_text'] );
endif;

// $show_price = '';
if ( isset( $_GET['show_price'] ) ) :
    $show_price = wp_unslash( $_GET['show_price'] );
endif;
// $show_cat = '';
if ( isset( $_GET['show_cat'] ) ) :
    $show_cat = wp_unslash( $_GET['show_cat'] );
endif;

// $show_wishlist = '';
if ( isset( $_GET['show_wishlist'] ) ) :
    $show_wishlist = wp_unslash( $_GET['show_wishlist'] );
endif;

// $show_cat_list = '';
if ( isset( $_GET['show_cat_list'] ) ) :
    $show_cat_list = wp_unslash( $_GET['show_cat_list'] );
endif;
// $show_excerpt_list = '';
if ( isset( $_GET['show_excerpt_list'] ) ) :
    $show_excerpt_list = wp_unslash( $_GET['show_excerpt_list'] );
endif;

// $excerpt_length_list = '';
if ( isset( $_GET['excerpt_length_list'] ) ) :
    $excerpt_length_list = wp_unslash( $_GET['excerpt_length_list'] );
endif;
// $show_review_list = '';
if ( isset( $_GET['show_review_list'] ) ) :
    $show_review_list = wp_unslash( $_GET['show_review_list'] );
endif;

// $show_review_list_text = '';
if ( isset( $_GET['show_review_list_text'] ) ) :
    $show_review_list_text = wp_unslash( $_GET['show_review_list_text'] );
endif;

// $show_enrolled_list = '';
if ( isset( $_GET['show_enrolled_list'] ) ) :
    $show_enrolled_list = wp_unslash( $_GET['show_enrolled_list'] );
endif;

// $show_enrolled_text_list = '';
if ( isset( $_GET['show_enrolled_text_list'] ) ) :
    $show_enrolled_text_list = wp_unslash( $_GET['show_enrolled_text_list'] );
endif;
// $show_lessons_list = '';
if ( isset( $_GET['show_lessons_list'] ) ) :
    $show_lessons_list = wp_unslash( $_GET['show_lessons_list'] );
endif;

// $show_lessons_list_text = '';
if ( isset( $_GET['show_lessons_list_text'] ) ) :
    $show_lessons_list_text = wp_unslash( $_GET['show_lessons_list_text'] );
endif;

// $show_quiz_list = '';
if ( isset( $_GET['show_quiz_list'] ) ) :
    $show_quiz_list = wp_unslash( $_GET['show_quiz_list'] );
endif;

// $show_quiz_list_text = '';
if ( isset( $_GET['show_quiz_list_text'] ) ) :
    $show_quiz_list_text = wp_unslash( $_GET['show_quiz_list_text'] );
endif;

$course_rating   = tutor_utils()->get_course_rating();
$ratings_average = $course_rating->rating_avg;
$total_ratings   = $course_rating->rating_count;
$percent         = ( ! $ratings_average ) ? 0 : min( 100, ( round( $ratings_average * 2 ) / 2 ) * 20 );
$features        = get_post_meta( get_the_ID(), 'edubin_course_top_features', true );
$class_type     = get_post_meta( get_the_ID(), 'edubin_tl_course_class_type', true );

$default_data = [
    'show_media'        => $show_media,
    'show_intor_video'        => $show_intor_video,
    'show_review'        => $show_review,
    'show_excerpt'        => $show_excerpt,
    'show_author_img'        => $show_author_img,
    'show_author_name'        => $show_author_name,
    'show_enrolled'        => $show_enrolled,
    'show_enrolled_text'        => $show_enrolled_text,
    'show_lessons'        => $show_lessons,
    'show_lessons_text'        => $show_lessons_text,
    'show_quiz'        => $show_quiz,
    'show_quiz_text'        => $show_quiz_text,
    'show_cat'        => $show_cat,
    'show_wishlist'        => $show_wishlist,
    'show_price'        => $show_price,
    'show_title'        => $show_title,
    'thumb_url'        => $thumb_url,
    'style'            => $style,
    'instructors'      => tutor_utils()->get_instructors_by_course(),
    // 'lessons'          => tutor_utils()->get_lesson_count_by_course( get_the_ID() ),
    'duration'         => get_tutor_course_duration_context(),
    // 'disable_enrolled' => get_tutor_option( 'disable_course_total_enrolled' ),
    // 'enrolled'         => tutor_utils()->count_enrolled_users_by_course(),
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
    'excerpt_length'   => $excerpt_length,
    'excerpt_end'      => '...',
    'show_cat_list'      => $show_cat_list,
    'show_excerpt_list'      => $show_excerpt_list,
    'excerpt_length_list'      => $excerpt_length_list,
    'show_review_list'      => $show_review_list,
    'show_review_list_text'      => $show_review_list_text,
    'show_enrolled_list'      => $show_enrolled_list,
    'show_enrolled_text_list'      => $show_enrolled_text_list,
    'show_lessons_list'      => $show_lessons_list,
    'show_lessons_list_text'      => $show_lessons_list_text,
    'show_quiz_list'      => $show_quiz_list,
    'show_quiz_list_text'      => $show_quiz_list_text,
];

$get_options = wp_parse_args( $get_options, $default_data );

tutor_load_template( 'tpl-part.course.el-layout-' . $get_options['style'], compact( 'get_options', 'features' ) );


