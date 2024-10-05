<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

$edubin_post_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large' );
if ( isset( $edubin_post_thumb_src ) && ! empty( $edubin_post_thumb_src ) ) :
    $edubin_post_thumb_url = $edubin_post_thumb_src[0];
else :
    $edubin_post_thumb_url = '';
endif;

$blog_comments_text = Edubin::setting( 'blog_comments_text' );
$blog_author_show = Edubin::setting( 'blog_author_show' );
$blog_date_show = Edubin::setting( 'blog_date_show' );
$blog_comment_show = Edubin::setting( 'blog_comment_show' );
$blog_read_more_btn_show = Edubin::setting( 'blog_read_more_btn_show' );
$blog_button_text = Edubin::setting( 'blog_button_text' );

$excerpt_length = Edubin::setting( 'edubin_blog_excerpt_length' );
if ( isset( $_GET['excerpt_length'] ) ) :
	$excerpt_length = (int)$_GET['excerpt_length'] ? $_GET['excerpt_length'] : $excerpt_length;
endif;

?>
<div id="post-<?php the_ID(); ?>" <?php post_class( apply_filters( 'edubin_post_standard_classes', 'edubin-post-one-single-grid edubin-col-lg-12 edubin-blog-post-standard' ) ); ?> data-sal>
    <?php
    echo '<div class="edu-blog edubin-radius-small">';
        echo '<div class="inner">';
            if ( has_post_thumbnail() && get_the_post_thumbnail_url() ) :
                echo '<div class="thumbnail">';
                    echo '<a href="' . esc_url( get_the_permalink() ) . '">';
                        echo '<img src="' . esc_url( $edubin_post_thumb_url ). '" alt="' . esc_attr( edubin_thumbanil_alt_text( get_post_thumbnail_id( get_the_id() ) ) ). '" >';
                    echo '</a>';
                echo '</div>';
            endif;

            echo '<div class="content">';

                echo '<ul class="blog-meta">';

                    if ( 'post' === get_post_type() && $blog_author_show ): edubin_posted_author(); endif;

                    if ( $blog_date_show ) {
                        echo '<li>';
                            echo '<i class="flaticon-calendar"></i>';
                            echo esc_html( get_the_date() );
                        echo '</li>';
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

                echo edubin_get_title( 'h3' );

                echo '<div class="card-bottom">';
                    echo wpautop( wp_trim_words( wp_kses_post( get_the_excerpt() ), esc_html( $excerpt_length ), '...' ) );
                echo '</div>';

                if ( $blog_read_more_btn_show ) {
                    echo '<div class="read-more-button">';
                        echo '<a class="edubin-btn" href="' . esc_url( get_the_permalink() ) . '">';
                            echo esc_html( $blog_button_text );
                        echo '</a>';
                    echo '</div>';
                }

            echo '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';