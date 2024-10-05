<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

$edubin_post_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'edubin-post-thumb' );
if ( isset( $edubin_post_thumb_src ) && ! empty( $edubin_post_thumb_src ) ) :
    $edubin_post_thumb_url = $edubin_post_thumb_src[0];
else :
    $edubin_post_thumb_url = '';
endif;

$blog_post_desktop_cols = 12/Edubin::setting( 'blog_post_columns' );

if ( isset( $_GET['column'] ) && $_GET['column'] == 3 ) :
	$blog_post_desktop_cols = 4;
endif;

$excerpt_length = Edubin::setting( 'edubin_blog_excerpt_length' );
if ( isset( $_GET['excerpt_length'] ) ) :
	$excerpt_length = (int)$_GET['excerpt_length'] ? $_GET['excerpt_length'] : $excerpt_length;
endif;

$masonry_status = Edubin::setting( 'blog_masonry_show' );
if ( $masonry_status || isset( $_GET['masonry'] ) ) :
	$blog_post_desktop_cols = $blog_post_desktop_cols . ' ' . 'tpc-masonry-item';
endif;

$blog_comments_text = Edubin::setting( 'blog_comments_text' );
$blog_author_show = Edubin::setting( 'blog_author_show' );
$blog_date_show = Edubin::setting( 'blog_date_show' );
$blog_comment_show = Edubin::setting( 'blog_comment_show' );
$blog_read_more_btn_show = Edubin::setting( 'blog_read_more_btn_show' );
$blog_button_text = Edubin::setting( 'blog_button_text' );

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'edubin-post-one-single-grid edubin-col-lg-' . esc_attr( $blog_post_desktop_cols ) . ' edubin-col-md-6 edubin-col-sm-12' ); ?> data-sal>
    <?php

    $blog_comment_short_text  = Edubin::setting( 'blog_comment_short_text' );

    echo '<div class="edu-blog blog-style-1">';
        echo '<div class="inner">';
        
            if ( $edubin_post_thumb_url ) :
                echo '<div class="thumbnail">';
                    echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                        echo '<img src="' . esc_url( $edubin_post_thumb_url ). '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '" >';
                    echo '</a>';
                echo '</div>';
            endif;

            echo '<div class="content">';

                echo edubin_get_title( 'h4' );

                echo '<ul class="blog-meta">';

                    if ( $blog_date_show ) {
                        echo '<li><i class="flaticon-calendar"></i>' . esc_html( get_the_date() ) . '</li>';
                    }

                    if ( $blog_comment_show ) {
                        echo '<li><i class="flaticon-chat"></i>';
                            printf( // WPCS: XSS OK.
                                /* translators: 1: comment count number, 2: title. */
                                esc_html( _nx( '%2$s %1$s', '%2$s %1$s', get_comments_number(), 'comments title', 'edubin' ) ),
                                number_format_i18n( get_comments_number() ),
                                $blog_comments_text,
                                '<span>' . get_the_title() . '</span>'
                            );
                        echo '</li>';
                    }

                echo '</ul>';

                echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $excerpt_length ), '...' ) );

            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';