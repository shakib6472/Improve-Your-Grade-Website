<?php

defined( 'ABSPATH' ) || exit();
use \Edubin\Filter;

global $post;

if ( ! isset( $args ) ) :
    $args = array();
endif;

$thumb_size = 'edubin-post-thumb';
if ( isset( $_GET['thumb_size'] ) ) :
    $thumb_size = $_GET['thumb_size'];
endif;

$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), $thumb_size );
if ( isset( $thumb_src ) && ! empty( $thumb_src ) ) :
    $thumb_url = $thumb_src[0];
else :
    $thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
endif;

if ( ! isset( $style ) ) :
    $style = Edubin::setting( 'sensei_course_archive_style' );
endif;

if ( isset( $_GET['course_preset'] ) ) :
    $style = Filter::grid_layout_keys();
endif;

if ( get_query_var( 'author_name' ) ) :
    $author = get_user_by( 'slug', get_query_var( 'author_name' ) );
    $author_id = $author->ID;
else :
    $author    = '';
    $author_id = get_the_author_meta( 'ID' );
endif;

$author_email  = get_the_author_meta( 'email', $author_id );

$excerpt_length = 12;
if ( isset( $_GET['excerpt_length'] ) ) :
    $excerpt_length = (int)$_GET['excerpt_length'];
endif;

$button_text =  __( 'Enroll Now', 'edubin' );
if ( isset( $_GET['button_text'] ) ) :
    $button_text = $_GET['button_text'];
endif;

$default_data = [
    'thumb_url'      => $thumb_url,
    'style'          => $style,
    'author'         => $author,
    'cat_item'       => edubin_category_by_id( get_the_ID(), 'course-category' ),
    'enrolled'       => get_post_meta( get_the_ID(), 'edubin_ss_course_students', true ),
    'level'          => get_post_meta( get_the_ID(), 'edubin_ss_course_level', true ),
    'duration'       => get_post_meta( get_the_ID(), 'edubin_ss_course_duration', true ),
    'class_type'     => get_post_meta( get_the_ID(), 'edubin_ss_course_class_type', true ),
    'course_options' => get_post_meta( get_the_ID(), '_sfwd-courses', true ),
    'author_email'   => get_the_author_meta( 'email', $author_id ),
    'features'       => get_post_meta( get_the_ID(), 'edubin_course_top_features', true ),
    'button_text'    => $button_text,
    'lessons'        => Sensei()->course->course_lesson_count( get_the_ID() ),
    'enable_excerpt' => true,
    'excerpt_length' => $excerpt_length,
    'uniqid'         => uniqid(),
    'rating'         => Edubin_SS_Course_Review::get_average_ratings( $post->ID ),
    'total_rating'   => Edubin_SS_Course_Review::get_all_reviews( get_the_ID() ),
    'excerpt_end'    => '...'
];

$args = wp_parse_args( $args, $default_data );
get_template_part( 'sensei/tpl-part/course/course-layout-' . $args['style'], '', $args );

