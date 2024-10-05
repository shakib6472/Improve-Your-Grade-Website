<?php

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.
global $post;

$related_products_by = Edubin::setting( 'related_products_by' );
$edubin_related_products_to_show  = apply_filters( 'edubin_woo_related_product_count', 4 );
$edubin_related_products_terms    = get_the_terms( $post->ID, $related_products_by );
$edubin_related_products_term_ids = array();

if ( $edubin_related_products_terms ) :
    foreach( $edubin_related_products_terms as $term ) :
        $edubin_related_products_term_ids[] = $term->term_id;
    endforeach;
endif;

$edubin_related_products_args = array(
    'post_type'      => 'product',
    'posts_per_page' => $edubin_related_products_to_show,
    'post__not_in'   => array( $post->ID ),
    // 'orderby' => 'rand', // Randomize the results
    'tax_query'      => array(
        'relation'   => 'AND',
        array(
            'taxonomy' => $related_products_by,
            'field'    => 'id',
            'terms'    => $edubin_related_products_term_ids,
            'operator' => 'IN'
        )
    )
);

$edubin_related_products = new WP_Query( $edubin_related_products_args );
if ( $edubin_related_products->have_posts() ) :

    $title = Edubin::setting( 'shop_related_title' );

    if ( $title ) :
        echo '<div class="section-title text-center edubin-mb--50">';
            if ( $title ) :
                echo '<h3 class="title">' . esc_html( $title ) . '</h3>';
            endif;
        echo '</div>';
    endif;

    echo '<div class="edubin-related-product-items">';
        echo '<div class="edubin-row">';
            while ( $edubin_related_products->have_posts() ) : $edubin_related_products->the_post();
                echo '<div class="edubin-col-lg-3 edubin-col-sm-6">';
                    echo '<div class="edubin-single-product-item">';
                        wc_get_template( 'tpl-part/layout.php' );
                    echo '</div>';
                echo '</div>';
            endwhile;
            wp_reset_postdata();
        echo '</div>';
    echo '</div>';
endif;