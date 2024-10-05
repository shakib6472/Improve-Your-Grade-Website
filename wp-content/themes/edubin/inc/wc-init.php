<?php

/**
 * Show cart contents / total Ajax
 */
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

function woocommerce_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;

    ob_start();

    ?>
    <a class="edubin-ajax-cart" href="<?php echo esc_url(wc_get_cart_url()); ?>"><i class="flaticon-shopping-cart-1"></i><span><?php echo WC()->cart->get_cart_contents_count(); ?></span></a>
    <?php
    $fragments['a.edubin-ajax-cart'] = ob_get_clean();
    return $fragments;

}

/** ===== Declare WooCommerce support === */

function edubin_woocommerce_support() {
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-slider' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
}
add_action( 'after_setup_theme', 'edubin_woocommerce_support' );

/** ===== Gallery Image thumbnail Size === */

add_filter( 'woocommerce_gallery_thumbnail_size', function( $size ) {
	return 'thumbnail';
} );

/** =====  WooCommerce scripts. === */

add_action( 'wp_enqueue_scripts', 'edubin_woocommerce_scripts' );
function edubin_woocommerce_scripts() {
	
	wp_enqueue_style( 'edubin-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css', array( 'woocommerce-general' ), EDUBIN_THEME_VERSION );

	$image_lightbox_only = apply_filters( 'edubin_woo_single_product_zoom_enable', true );

	if ( is_product() && ! $image_lightbox_only ) :
		wp_enqueue_style( 'jquery-fancybox' );
		wp_enqueue_script( 'jquery-fancybox' );
	endif;

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
	$inline_font = '@font-face {
			font-family: "star";
			src: url("' . $font_path . 'star.eot");
			src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
				url("' . $font_path . 'star.woff") format("woff"),
				url("' . $font_path . 'star.ttf") format("truetype"),
				url("' . $font_path . 'star.svg#star") format("svg");
			font-weight: normal;
			font-style: normal;
		}';

	wp_add_inline_style( 'edubin-woocommerce-style', $inline_font );
}

/** =====  Add woocommerce woocommerce-active class on body === */

add_filter( 'body_class', 'edubin_woocommerce_body_class' );
function edubin_woocommerce_body_class( $classes ) {
	$classes[] = 'woocommerce woocommerce-active';

	return $classes;
}

/** =====  Shop page product per page === */

add_filter( 'loop_shop_per_page', 'edubin_woocommerce_shop_products' );
function edubin_woocommerce_shop_products() {
	$cols = Edubin::setting( 'woo_shop_per_page' );
  	return $cols;
}

/** =====  Add markup before main content === */

add_action( 'woocommerce_before_main_content', 'edubin_woocommerce_markup_before' );
if ( ! function_exists( 'edubin_woocommerce_markup_before' ) ) :

	function edubin_woocommerce_markup_before() {
			echo '<div id="primary" class="' . esc_attr( apply_filters( 'edubin_woo_content_area_class', 'content-area' ) ) . '">';
				echo '<main id="main" class="site-main" role="main">';
	}
endif;

/** =====  Add markup after main content === */

add_action( 'woocommerce_after_main_content', 'edubin_woocommerce_markup_after' );
if ( ! function_exists( 'edubin_woocommerce_markup_after' ) ) :

	function edubin_woocommerce_markup_after() {
			echo '</main>';
		echo '</div>';
	}
endif;

/** =====  Add single product page class === */

add_filter( 'edubin_woo_content_area_class', 'edubin_woo_single_content_class' );
if ( ! function_exists( 'edubin_woo_single_content_class' ) ) :
	function edubin_woo_single_content_class( $args ) {
		if ( is_singular( 'product' ) ) :
			return 'content-area edubin-main-content-inner edubin-container';
		else :
			return $args;
		endif;
	}
endif;

/** =====  Shop page header top are === */

add_action( 'woocommerce_before_shop_loop', 'woocommerce_before_shop_loop_top_area', 20 );

if ( ! function_exists( 'woocommerce_before_shop_loop_top_area' ) ) :
	function woocommerce_before_shop_loop_top_area() {
	    wc_get_template( 'tpl-part/loop-top-area.php' );
	}
endif;

/** =====  Related products === */

if ( ! function_exists( 'edubin_woocommerce_output_related_products' ) ) :
	function edubin_woocommerce_output_related_products() {
		$show = Edubin::setting( 'shop_related_show' );
		if ( $show ) :
			echo '<div class="edubin-related-product-content-wrapper">';
				wc_get_template( 'tpl-part/related-products.php' );
			echo '</div>';
		endif;
	}
endif;

/** =====  WooCommerce cart link fragment === */

add_filter( 'woocommerce_add_to_cart_fragments', 'edubin_woocommerce_add_to_cart_fragments' );
if ( ! function_exists( 'edubin_woocommerce_add_to_cart_fragments' ) ) :

	function edubin_woocommerce_add_to_cart_fragments( $fragments ) {
		ob_start();
		edubin_woocommerce_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
endif;

/** =====  WooCommerce mini cart fragments === */

add_filter( 'woocommerce_add_to_cart_fragments', 'edubin_woocommerce_add_to_cart_fragments' );
if ( ! function_exists( 'edubin_woocommerce_add_to_cart_fragments' ) ) :
	function edubin_woocommerce_add_to_cart_fragments( $fragments ) {
		$fragments['span.edubin-woo-mini-cart-total-item'] = '<span class="edubin-woo-mini-cart-total-item">' . WC()->cart->get_cart_contents_count() . '</span>';
		$fragments['span.edubin-woo-mini-cart-total-price'] = '<span class="edubin-woo-mini-cart-total-price">' . WC()->cart->get_cart_subtotal() . '</span>';
		return $fragments;
	}
endif;

/** =====  WooCommerce cart link === */

if ( ! function_exists( 'edubin_woocommerce_cart_link' ) ) :

	function edubin_woocommerce_cart_link() {
		?>
		<a class="cart-contents" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr__( 'View your shopping cart', 'techwix' ); ?>">
			<?php
			$item_count_text = sprintf(
				/* translators: number of items in the mini cart. */
				_n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'edubin' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="amount"><?php echo wp_kses_data( WC()->cart->get_cart_subtotal() ); ?></span> <span class="count"><?php echo esc_html( $item_count_text ); ?></span>
		</a>
		<?php
	}
endif;

/** =====  WooCommerce header cart=== */

if ( ! function_exists( 'edubin_woocommerce_cart_for_header' ) ) :

	function edubin_woocommerce_cart_for_header() {
		if ( is_cart() ) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
		?>
		<ul id="site-header-cart" class="site-header-cart">
			<li class="<?php echo esc_attr( $class ); ?>">
				<?php edubin_woocommerce_cart_link(); ?>
			</li>
			<li>
				<?php
				$instance = array(
					'title' => '',
				);

				the_widget( 'WC_Widget_Cart', $instance );
				?>
			</li>
		</ul>
		<?php
	}
endif;

/** =====  Single priduct page add to cart text === */

add_filter( 'woocommerce_product_single_add_to_cart_text', 'edubin_woocommerce_product_single_add_to_cart_text' );

if ( ! function_exists( 'edubin_woocommerce_product_single_add_to_cart_text' ) ) :
	function edubin_woocommerce_product_single_add_to_cart_text() {
	    return __( 'Add to cart', 'edubin' ); 
	}
endif;

/** =====  Price separator === */

add_filter( 'formatted_woocommerce_price', 'edubin_woo_price_decimal_separator', 10, 5 );

if ( ! function_exists( 'edubin_woo_price_decimal_separator' ) ) :
	function edubin_woo_price_decimal_separator( $formatted_price, $price, $decimal_number, $decimal_separator, $thousand_separator ) {
		if ( $decimal_number > 0 && ! empty( $decimal_separator ) ) :
			$origin_price = str_replace( $decimal_separator, '<span class="decimal-separator">' . $decimal_separator, $formatted_price );
			$origin_price .= '</span>';

			return $origin_price;
		endif;

		return $formatted_price;
	}
endif;

/** =====  Price separator === */

if ( ! function_exists( 'edubin_woocommerce_product_price_offer' ) ) :
	function edubin_woocommerce_product_price_offer() {
		global $product;
		if( $product->is_on_sale() && $product->is_in_stock() && ! $product->is_type( 'variable' ) ) :
			$regular_price = $product->get_regular_price();
			$sale_price = $product->get_price();
			$percentage = round( 100 - ( $sale_price / $regular_price * 100 ) ) . '%';
			$percentage = apply_filters( 'edubin_woo_product_price_percent', $percentage );
			$prefix = apply_filters( 'edubin_woo_product_percent_prefix', '-' );
			return '<span class="tpc-product-offer-percent">' . esc_html( $prefix ) . esc_html( $percentage ) . '</span>';
		endif;
		return;
	}
endif;

/** =====  Price separator === */

if ( ! function_exists( 'edubin_woocommerce_featured_product_tag' ) ) :
	function edubin_woocommerce_featured_product_tag() {
		global $product;
		if ( $product->is_featured() && $product->is_in_stock() ) :
			$tag = apply_filters( 'edubin_featured_product_tag_text', __( 'Hot', 'edubin' ) );
			return '<span class="tpc-featured-product-tag">' . esc_html( $tag ) . '</span>';
		endif;
		return;
	}
endif;

/** =====  Price separator === */

if ( ! function_exists( 'edubin_woo_single_product_top_content' ) ) :
	function edubin_woo_single_product_top_content() {
		if ( edubin_woocommerce_featured_product_tag() || edubin_woocommerce_product_price_offer() ) :
			echo '<div class="tpc-product-image-top-content">';
				echo edubin_woocommerce_featured_product_tag();
				echo edubin_woocommerce_product_price_offer();
			echo '</div>';
		endif;
	}
endif;

/** =====  Price separator === */

if ( ! function_exists( 'edubin_woo_single_product_rating' ) ) :
	function edubin_woo_single_product_rating( $rating_only = false ) {
		global $product;
		$rating_count = $product->get_rating_count();
		$count_total_rating = $product->get_review_count();
		$average      = $product->get_average_rating();
		if ( $count_total_rating && wc_review_ratings_enabled() ) :
			echo '<div class="edubin-product-rating-wrapper">';
				echo wc_get_rating_html( $average, $rating_count );;
				if ( $rating_only ) :
					echo '<div class="edubin-yith-wcqv-rating-number">';
						$reviews_title = sprintf( esc_html( _n( '(%1$s Review)', '(%1$s Reviews)', $count_total_rating, 'edubin' ) ), esc_html( $count_total_rating ) );
						echo wp_kses_post( $reviews_title );
					echo '</div>';
				else :
					echo '(' . esc_html($average ) . ')';
				endif;
			echo '</div>';
		endif;
	}
endif;


remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );

remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

add_filter( 'woocommerce_product_description_heading', '__return_null' );

add_filter( 'woocommerce_product_additional_information_heading', '__return_null' );

remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

add_action( 'woocommerce_after_single_product_summary', 'edubin_woocommerce_output_related_products', 20 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 6 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 35 );

/**
 * Single product wrapper start
 * 
 * @since 1.0.0
 */

if ( ! function_exists( 'edubin_woocommerce_single_product_summary_start' ) ) :
	function edubin_woocommerce_single_product_summary_start() {
		echo '<div class="edubin-single-product-main-content-wrapper">';
	}
endif;

/**
 * Single product wrapper end
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_woocommerce_single_product_summary_end' ) ) :
	function edubin_woocommerce_single_product_summary_end() {
		echo '</div>';
	}
endif;

/**
 * Before Course Content Area
 * 
 * @since 1.0.0
 */


/**
 * product review submit button content change
 * 
 * @since 1.0.0
 */ 
if ( ! function_exists( 'edubin_woocommerce_product_review_submit_button' ) ) :
	function edubin_woocommerce_product_review_submit_button( $comment_form ){
		$comment_form['submit_button'] = '<button name="%1$s" type="submit" id="%2$s" class="%3$s" value="%4$s">%4$s</button>';
		return $comment_form;
	}
endif;
add_filter( 'woocommerce_product_review_comment_form_args', 'edubin_woocommerce_product_review_submit_button' );

/**
 * product review user thumb size
 * 
 * @since 1.0.0
 */ 
if ( ! function_exists( 'edubin_woocommerce_review_list_avatar_size' ) ) :
	function edubin_woocommerce_review_list_avatar_size(){
		return 80;
	}
endif;

/**
 * remove zoom hover effect on WooCommerce Product Details Page
 * 
 * @since 1.0.0
 */ 
if ( ! function_exists( 'edubin_remove_image_zoom_support' ) ) :
	function edubin_remove_image_zoom_support() {
		remove_theme_support( 'wc-product-gallery-zoom' );
		remove_theme_support( 'wc-product-gallery-lightbox' );
	}
endif;


