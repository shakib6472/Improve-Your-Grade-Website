<?php

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

if ( ! isset( $get_options ) ) :
	$get_options = array();
endif;

global $post, $product;
$thumb_url = '';
$thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium_large' );

if ( isset( $thumb_src ) && ! empty( $thumb_src ) ) :
    $thumb_url = $thumb_src[0];
endif;

$default_data = array(
    'thumb_url' => $thumb_url
);

$get_options = wp_parse_args( $get_options, $default_data );

echo '<div class="edubin-single-product-inner">';
    echo '<div class="edubin-single-product-thumb-wrapper">';
    	woocommerce_template_loop_product_link_open();
            echo '<div class="edubin-single-product-thumb" style="background-image: url(' . esc_url( $get_options['thumb_url'] ) . ')"></div>';
        woocommerce_template_loop_product_link_close();
        edubin_woo_single_product_top_content();
        echo '<div class="product-over-info">';
            echo '<ul>';
                if ( class_exists( 'YITH_WCQV' ) ) :
                    echo '<li>';
                        echo '<a href="#" class="button yith-wcqv-button" data-product_id="' . esc_attr( $product->get_id() ) . '">';
                            echo '<span class="edubin-product-popup-icon"><i class="flaticon-search"></i></span>';
                            echo '<span class="edubin-product-popup-text">Quick View</span>';
                        echo '</a>';
                    echo '</li>';
                endif;

                echo '<li class="add-to-cart">';
                    echo '<span>';
                        woocommerce_template_loop_add_to_cart();
                    echo '</span>';
                echo '</li>';
            echo '</ul>';
        echo '</div>';
    echo '</div>';

    echo '<div class="content">';
    	woocommerce_template_loop_product_link_open();
		do_action( 'woocommerce_shop_loop_item_title' );
        woocommerce_template_loop_product_link_close();
        edubin_woo_single_product_rating();
    	woocommerce_template_loop_price();
    echo '</div>';
echo '</div>';