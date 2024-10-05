<?php

if( ! function_exists( 'edubin_theme_base_css' ) ) :
	function edubin_theme_base_css() {

		$page_primary_color  = get_post_meta(get_the_ID(), '_edubin_page_primary_color', true);
		$the_primary_color  = Edubin::setting( 'primary_color' );
		$to_primary_color = ($page_primary_color ) ? $page_primary_color : $the_primary_color;
		
		$default_primary_color = '#ffc600';
		$primary_color = (!empty(Edubin::setting( 'primary_color' ))) ? $to_primary_color : $default_primary_color ;

		$page_secondary_color  = get_post_meta(get_the_ID(), '_edubin_page_secondary_color', true);
		$the_secondary_color  = Edubin::setting( 'secondary_color' );
		$to_secondary_color = ($page_secondary_color ) ? $page_secondary_color : $the_secondary_color;
		
		$default_secondary_color = '#07294d';
		$secondary_color = (!empty(Edubin::setting( 'secondary_color' ))) ? $to_secondary_color : $default_secondary_color ;

		$to_tertiary_color = Edubin::setting( 'tertiary_color' );
		$default_tertiary_color = '#021E40';
		$heading_color = (!empty(Edubin::setting( 'tertiary_color' ))) ? $to_tertiary_color : $default_tertiary_color ;

		// === Buttons ==== 

		$theme_btn_bg_color  = Edubin::setting( 'btn_color' );
		$btn_bg_color = ($theme_btn_bg_color ) ? $theme_btn_bg_color : $primary_color;
		
		$theme_btn_border_color  = Edubin::setting( 'btn_color' );
		$btn_border_color = ($theme_btn_border_color ) ? $theme_btn_border_color : $primary_color;

		$final_btn_color = ( '#ffc600' === $primary_color ) ? $heading_color : '#ffffff' ;
	
		$theme_btn_text_color  = Edubin::setting( 'btn_text_color' );
		$btn_text_color = ($theme_btn_text_color ) ? $theme_btn_text_color : $final_btn_color;
		
		// Button Hover

		$theme_btn_hover_color  = Edubin::setting( 'btn_hover_color' );
		$btn_bg_hover_color = ($theme_btn_hover_color ) ? $theme_btn_hover_color : $secondary_color;

		// === Others ==== 

		$primary_color_alt = Edubin::setting( 'tpc_primary_color_alter' );

		$body_color = Edubin::setting( 'content_color' );

		$page_top_bg_color = get_post_meta(get_the_ID(), '_edubin_page_top_bg_color', true);

		$body_typo_array = Edubin::setting( 'edubin_body_text_font' );
		$heading_typo_array = Edubin::setting( 'edubin_heading_font' );
		$body_font_family = 'Open Sans';
		$heading_font_family = 'Heebo';
		$body_font_size = '16px';

		if ( isset( $body_typo_array['font-family'] ) && ! empty( $body_typo_array['font-family'] ) ) :
			$body_font_family = $body_typo_array['font-family'];
		endif;

		if ( isset( $body_typo_array['font-size'] ) && ! empty( $body_typo_array['font-size'] ) ) :
			$body_font_size = '16px';
		endif;

		if ( isset( $heading_typo_array['font-family'] ) && ! empty( $heading_typo_array['font-family'] ) ) :
			$heading_font_family = $heading_typo_array['font-family'];
		endif;

		$base_css = ":root {
			--edubin-primary-color: {$primary_color};
			--edubin-primary-color-alt: {$primary_color_alt};
			--edubin-color-secondary: {$secondary_color};
			--edubin-color-thirty: #021E40;
			--edubin-color-01: #ff4830;
			--edubin-color-02: #6cbd7f;
			--edubin-color-03: #8e56ff;
			--edubin-color-04: #17b8c1;
			--edubin-color-05: #3BBC9B;
			--edubin-color-06: #0071dc;

			--edubin-color-btn-bg: {$btn_bg_color};
			--edubin-color-btn-border: {$btn_border_color};
			--edubin-color-btn-text: {$btn_text_color};

			--edubin-color-btn-bg-hover: {$secondary_color};
			--edubin-color-btn-border-hover: {$secondary_color};
			--edubin-color-btn-text-hover: #ffffff;

			--edubin-color-placeholder: #CCCCCC;
			--edubin-shadow-01: 0 0 30px rgb(0 0 0 / 5%);
			--edubin-color-tertiary: #f8b81f;
			--edubin-color-dark: #231F40;
			--edubin-color-body: {$body_color};
			--edubin-heading-color: {$heading_color};
			--edubin-color-white: #ffffff;
			--edubin-color-shade: #F5F5F5;
			--edubin-color-border: #ebebeb;
			--edubin-color-black: #000000;
			--edubin-p-regular: 400;
			--edubin-p-medium: 500;
			--edubin-p-semi-bold: 600;
			--edubin-p-bold: 700;
			--edubin-p-extra-bold: 800;
			--edubin-p-black: 900;
			--edubin-shadow-darker: 0px 10px 50px 0px rgba(26,46,85,0.1);
			--edubin-shadow-dark: 0px 10px 30px 0px rgba(20,36,66,0.15);
			--edubin-shadow-darkest: 0px 10px 30px 0px rgba(0,0,0,0.05);
			--edubin-transition: 0.3s;
			--edubin-font-primary: '{$body_font_family}', sans-serif;
			--edubin-font-secondary: '{$heading_font_family}', sans-serif;
			--edubin-font-size-b1: {$body_font_size};
			--edubin-font-size-b2: 13px;
			--edubin-font-size-b3: 14px;
			--edubin-font-size-b4: 12px;
			--edubin-line-height-b1: 1.73;
			--edubin-h1: 50px;
			--edubin-h2: 36px;
			--edubin-h3: 28px;
			--edubin-h4: 20px;
			--edubin-h5: 18px;
			--edubin-h6: 16px;
			--edubin-h1-lineHeight: 1.2;
			--edubin-h2-lineHeight: 1.39;
			--edubin-h3-lineHeight: 1.43;
			--edubin-h4-lineHeight: 1.4;
			--edubin-h5-lineHeight: 1.45;
			--edubin-h6-lineHeight: 1.62;
		}";

		// === Button style ===
		$edubin_button_style   = Edubin::setting( 'edubin_button_style' );
		
		if ( '2' === $edubin_button_style ) :

		$base_css .= "
			body #learn-press-profile-basic-information button[type=submit], body .profile-basic-information button, body form[name=profile-change-password] button, body #popup-content .lp-button, body.learnpress-page .lp-button, body.learnpress-page #lp-button, body #checkout-payment #checkout-order-action button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, body .learndash-wrapper .ld-expand-button, .edu-btn, a.edu-btn {
				border-radius:5px !important;
			}
		";
		endif;		

		// === Page Header Top Background Color ===
		if ( !empty($page_top_bg_color) ) :

		$base_css .= "
			body .tpc-header-top-bar, .tpc-header-top-bar.tpc-top-bar-style-2 {
			    background: {$page_top_bg_color};
			}
		";
		endif;	

		// === Page Header Top Background Color ===
		if ( !Edubin::setting( 'email_small_device' ) || !Edubin::setting( 'phone_small_device' ) || !Edubin::setting( 'message_small_device' ) || !Edubin::setting( 'login_reg_small_device' )  || !Edubin::setting( 'profile_small_device' ) ) :

	     	$base_css .= "
	     @media only screen and (max-width: 991px) {";

	     	if (!Edubin::setting( 'phone_small_device' )) {
				$base_css .= "
				.header-top-phone {
					   display: none;
					}
				";
	     	}
	     	if (!Edubin::setting( 'email_small_device' )) {
				$base_css .= "
					.header-top-email {
					   display: none;
					}
				";
	     	}
	     	if (!Edubin::setting( 'message_small_device' )) {
				$base_css .= "
					.header-top-message {
					   display: none;
					}
				";
	     	}
	     	if (!Edubin::setting( 'login_reg_small_device' )) {
				$base_css .= "
					.header-top-login-register {
					   display: none;
					}
				";
	     	}
     		if (!Edubin::setting( 'profile_small_device' )) {
				$base_css .= "
					.header-top-profile{
					   display: none;
					}
				";
	     	}

			$base_css .= "}";

		endif;

		// === Responsive  ===
		$mobile_logo_size = Edubin::setting( 'mobile_logo_size' );
		$mobile_logo_screen_width = Edubin::setting( 'mobile_logo_screen_width' );

		if ( $mobile_logo_size !== 180 ) :

			$base_css .= "
			@media only screen and (max-width: {$mobile_logo_screen_width}px) {";

			$base_css .= "
				body .site-branding img.site-logo {
				   max-width: {$mobile_logo_size}px;
				}
			";

			$base_css .= "}";

		endif;

		// === Page Top Bottom Space On/Off ===
		if ( '1' === Edubin::setting( 'top_bottom_space_show' ) ) :

		$base_css .= "
			body.elementor-page:not(.edubin-page-breadcrumb-disable) .tpc-site-content {
			    padding: 90px 0;
			}
		";
		endif;		

		// === Pagination style ===
		if ( '2' === Edubin::setting( 'pagination_style' ) ) :

		$base_css .= "
			body .tutor-pagination-wrap span, body .tutor-pagination-wrap a, nav.edubin-theme-page-links ul.pager li span, nav.edubin-theme-page-links ul.pager li a, .edubin-pagination-wrapper.woocommerce-pagination .page-numbers .page-numbers, .edubin-pagination-wrapper .page-number .page-numbers {
				border-radius:50%;
			}
			body .tutor-pagination-wrap span:before, body .tutor-pagination-wrap a:before, nav.edubin-theme-page-links ul.pager li span:before, nav.edubin-theme-page-links ul.pager li a:before, .edubin-pagination-wrapper.woocommerce-pagination .page-numbers .page-numbers:before, .edubin-pagination-wrapper .page-number .page-numbers:before{
				border-radius:50%;
			}
		";
		endif;		

		// === Sensei LMS style ===
		if ( Edubin::setting( 'sensei_layout_override' ) ) :

		$base_css .= "
			.wp-block-sensei-lms-course-outline-lesson:not(.has-text-color), .entry-content .wp-block-sensei-lms-course-outline-lesson:not(.has-text-color), .sensei .entry-content .wp-block-sensei-lms-course-outline-lesson:not(.button):not(.has-text-color) {
				border-radius:5px;
			}
			.wp-block-sensei-lms-course-outline-lesson>span {
	            padding: 15px 16px;
	        }
		";
		endif;

		// === Old style ===
		if ( '#ffc600' === $primary_color ) :
		$base_css .= "
			body .edubin-btn{
				 color: var(--edubin-heading-color);
			}
			body .edubin-latest-news .edubin-blog-date p {
				color: var(--edubin-heading-color);
			}
			body .edubin-latest-news .edubin-blog-date p span {
				color: var(--edubin-heading-color);
			}
			body .edubin-page-title-area.edubin-breadcrumb-has-bg:before {
			    background: rgb(7 41 77 / 87%);
			}
			body .edubin-course .course__categories a {
			    color: var(--edubin-heading-color);
			}
			body .edubin-course .price__2 {
			    color: var(--edubin-heading-color);
			}
			body .tutor-pagination-wrap span.current, body .tutor-pagination-wrap a:hover, nav.edubin-theme-page-links ul.pager li.active span, nav.edubin-theme-page-links ul.pager li:hover a, .edubin-pagination-wrapper.woocommerce-pagination .page-numbers .page-numbers.current, .edubin-pagination-wrapper.woocommerce-pagination .page-numbers .page-numbers:hover, .edubin-pagination-wrapper .page-number .page-numbers.current, .edubin-pagination-wrapper .page-number .page-numbers:hover {
			    color: var(--edubin-heading-color);
			}
			body .pixelcurve-progress-parent::after {
			    color: var(--edubin-heading-color);
			}
			body .edubin-woo-mini-cart-total-item {
			    color: var(--edubin-heading-color);
			}
			body .tpc-course-details-page-content .learndash-wrapper .ld-course-status.ld-course-status-not-enrolled .ld-button, .tpc-course-details-page-content .learndash-wrapper #btn-join, a.edu-btn, p.edubin-cart-shop-page-link a, button.edu-btn {
			    color: var(--edubin-heading-color);
			}
			body .pixelcurve-progress-parent:hover::after {
			    color: var(--edubin-heading-color);
			}
			body .edubin-single-product-inner .edubin-single-product-thumb-wrapper .product-over-info ul li a {
			    color: var(--edubin-heading-color);
			}
			body .edubin-single-product-inner .edubin-single-product-thumb-wrapper .product-over-info ul li a:hover {
			    color: #fff;
			}
			body .related-post-wrap.related_course .price__2 .price {
			    color: var(--edubin-heading-color);
			}
			body .woocommerce-error, body .woocommerce-info, body .woocommerce-message{
				color: var(--edubin-heading-color);
			}
			body .woocommerce-cart .woocommerce button.button.update-cart:disabled{
				color: var(--edubin-heading-color);
			}
			body .woocommerce-error a, body .woocommerce-info a, body .woocommerce-message a{
				color: var(--edubin-heading-color);
			}
			body .woocommerce-info:before, .woocommerce-message::before {
				color: var(--edubin-heading-color);
			}
			body .woocommerce-checkout-review-order button.button.alt{
				 color: var(--edubin-heading-color);
			}
			body .edubin-course.layout__4 .price__4 .price {
			    color: var(--edubin-heading-color);
			}
			body .tpc-event-item .thumbnail .event-time span{
				color: var(--edubin-heading-color);
			}
			body .tpc-event-item .content .event-date{
				color: var(--edubin-heading-color);
			}
			body .learndash-wrapper .ld-expand-button{
				color: var(--edubin-heading-color);
			}
			body.stm_lms_button .masterstudy-buy-button__link.masterstudy-buy-button__link_centered .masterstudy-buy-button__title{
			    color: var(--edubin-heading-color) !important;
			}
		";

		endif;

		$base_css = apply_filters( 'edubin_custom_color_style_css', $base_css );   

		return $base_css;
	}
endif;

if( ! function_exists( 'edubin_custom_color_styles' ) ) :
	function edubin_custom_color_styles() {   
	    wp_add_inline_style( 'edubin-main', html_entity_decode( edubin_theme_base_css(), ENT_QUOTES ) );
	}
endif;
add_action( 'wp_enqueue_scripts', 'edubin_custom_color_styles', 20);