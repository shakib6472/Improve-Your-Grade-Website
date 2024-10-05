<?php

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
global $post;
$edubin_related_posts_to_show  = '4';
$edubin_related_posts_terms    = get_the_terms( $post->ID, 'category' );
$edubin_related_posts_term_ids = array();

if ( $edubin_related_posts_terms ) :
    foreach( $edubin_related_posts_terms as $term ) :
        $edubin_related_posts_term_ids[] = $term->term_id;
    endforeach;
endif;

$edubin_related_posts_args = array(
    'post_type'      => 'post',
    'posts_per_page' => $edubin_related_posts_to_show,
    'post__not_in'   => array( $post->ID ),
    'tax_query'      => array(
        'relation'   => 'AND',
        array(
            'taxonomy' => 'category',
            'field'    => 'id',
            'terms'    => $edubin_related_posts_term_ids,
            'operator' => 'IN'
        )
    )
);

$edubin_related_posts = new WP_Query( $edubin_related_posts_args );


if ( $edubin_related_posts->have_posts() ) :
    echo '<div class="edubin-related-posts-wrapper edubin-blog-post-archive-style-1">';
        $related_products_heading = 'Related Posts';
        if ( $related_products_heading ) :
            echo '<h3 class="edubin-related-product-title">' . esc_html( $related_products_heading ) . '</h2>';
        endif;

        echo '<div class="edubin-related-product-items tpc-swiper-carousel-activator swiper swiper-container" data-lg-items="3" data-md-items="3" data-sm-items="2" data-xs-items="2">';
            echo '<div class="swiper-wrapper">';
                while ( $edubin_related_posts->have_posts() ) : $edubin_related_posts->the_post();
                    $edubin_post_thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'edubin-post-thumb' );
                    if ( isset( $edubin_post_thumb_src ) && ! empty( $edubin_post_thumb_src ) ) :
                        $edubin_post_thumb_url = $edubin_post_thumb_src[0];
                    else :
                        $edubin_post_thumb_url = '';
                    endif;

                    echo '<div class="swiper-slide">';
                        echo '<div class="edubin-single-blog" style="background-image: url(' . esc_url( $edubin_post_thumb_url ) . ')">';
                            echo '<div class="blog-content">';
                                echo '<ul class="blog-meta date">';
                                    echo '<li><i class="flaticon-hour"></i>' . esc_html( get_the_date( get_option( 'date_format' ) ) ) . '</li>';
                                echo '</ul>';
                                the_title( '<h4 class="title"><a href="' . esc_url( get_the_permalink() ) . '" class="post-link">', '</a></h4>' );
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                endwhile;
                wp_reset_postdata();
            echo '</div>';
        echo '</div>';
    echo '</div>';
endif;