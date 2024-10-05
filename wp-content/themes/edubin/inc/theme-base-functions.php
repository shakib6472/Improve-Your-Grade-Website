<?php

// Two coluumn menu option for widget
function edubin_add_menu_on_off_menu_two_clm_option( $widget, $return, $instance ) {
 
    // Are we dealing with a nav menu widget?
    if ( 'nav_menu' == $widget->id_base ) {
 
        // Display the on_off_menu_two_clm option.
        $on_off_menu_two_clm = isset( $instance['on_off_menu_two_clm'] ) ? $instance['on_off_menu_two_clm'] : '';
        ?>
            <p>
                <input class="checkbox" type="checkbox" id="<?php echo esc_attr($widget->get_field_id('on_off_menu_two_clm')); ?>" name="<?php echo esc_attr($widget->get_field_name('on_off_menu_two_clm')); ?>" <?php checked( true , $on_off_menu_two_clm ); ?> />
                <label for="<?php echo esc_attr($widget->get_field_id('on_off_menu_two_clm')); ?>">
                    <?php esc_html_e( 'Two Column Menu', 'edubin' ); ?>
                </label>
            </p>
        <?php
    }
}
add_filter('in_widget_form', 'edubin_add_menu_on_off_menu_two_clm_option', 10, 3 );

function edubin_save_menu_on_off_menu_two_clm_option( $instance, $new_instance ) {
 
    // Is the instance a nav menu and are on_off_menu_two_clms enabled?
    if ( isset( $new_instance['nav_menu'] ) && !empty( $new_instance['on_off_menu_two_clm'] ) ) {
        $new_instance['on_off_menu_two_clm'] = 1;
    }
 
    return $new_instance;
}
add_filter( 'widget_update_callback', 'edubin_save_menu_on_off_menu_two_clm_option', 10, 2 );


// Two column menu input save
function edubin_in_widget_form_update($instance, $new_instance, $old_instance){

    $instance['on_off_menu_two_clm'] = isset($new_instance['on_off_menu_two_clm']);

    return $instance;
}

// Two column menu class output
function edubin_dynamic_sidebar_params($params){
    global $wp_registered_widgets;
    $widget_id = $params[0]['widget_id'];
    $widget_obj = $wp_registered_widgets[$widget_id];
    $widget_opt = get_option($widget_obj['callback'][0]->option_name);
    $widget_num = $widget_obj['params'][0]['number'];

    if (isset($widget_opt[$widget_num]['on_off_menu_two_clm'])){
  
        $params[0]['before_widget'] = preg_replace('/class="/', 'class="two-column-menu ',  $params[0]['before_widget'], 1);
    }
    return $params;
}

//Callback function for options update (priorität 5, 3 parameters)
add_filter('widget_update_callback', 'edubin_in_widget_form_update',5,3);
//add class names (default priority, one parameter)
add_filter('dynamic_sidebar_params', 'edubin_dynamic_sidebar_params');


/**
 * return all the header items from eb_header post type 
 * and theme default headers
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_fetch_header_layouts' ) ) :
	function edubin_fetch_header_layouts() {
		$headers = apply_filters( 'edubin_theme_header_types', array(
			'theme-default-header' => 'Theme Default Header',
			'theme-header-1' => 'Theme Header 01',
			'theme-header-2' => 'Theme Header 02',
			'theme-header-3' => 'Theme Header 03',
			'theme-header-4' => 'Theme Header 04',
			'theme-header-5' => 'Theme Header 05',
		) );

		$args    = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'eb_header',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) :
			$headers[$post->post_name] = $post->post_title;
		endforeach;
		return $headers;
	}
endif;

/**
 * return elementor header
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_get_header_config' ) ) :
	function edubin_get_header_config() {
		
		global $post;
		if ( is_page() && is_object( $post ) && isset( $post->ID ) ) :
			$header = get_post_meta( $post->ID, '_edubin_tpc_mb_elementor_header', true );
			if ( empty( $header ) || $header == 'global' ) :
				return Edubin::setting( 'edubin_get_elementor_header' );
			endif;
			return $header;
		endif;
		return Edubin::setting( 'edubin_get_elementor_header' );
	}
	add_filter( 'edubin_get_header_layout', 'edubin_get_header_config' );
endif;

/**
 * print Elementor Header
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_show_header_builder' ) ) :
		function edubin_show_header_builder( $header_slug ) {
			$args = array(
				'name'        => $header_slug,
				'post_type'   => 'eb_header',
				'post_status' => 'publish',
				'numberposts' => 1
			);
			$posts         = get_posts( $args );
			$sticky_header = Edubin::setting( 'sticky_header_enable' );
			foreach ( $posts as $post ) :
				$classes        = array( 'edubin-elementor-header-wrapper header-get-sticky' );
				$classes[]      = $post->post_name . '-' . $post->ID;
				$bg_color       = '';

				echo '<header class="' . esc_attr( implode( ' ', $classes ) ) . '">';
					echo '<div class="edubin-header-container"' . trim( $bg_color ) . '>';
						if ( $sticky_header ) :
							echo '<div class="edubin-sticky-header-wrapper">';
						else :
							echo '<div class="edubin-non-sticky-header-wrapper">';
						endif;
							echo apply_filters( 'edubin_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID );
						echo '</div>';
					echo '</div>';
				echo '</header>';

			endforeach;
		}
endif;

/**
 * return all the footer items from eb_footer post type 
 * and theme default footers
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_get_footer_layouts' ) ) :
	function edubin_get_footer_layouts() {
		$footers = apply_filters( 'edubin_theme_footer_types', array(
			'theme-default-footer' => 'Theme Default Footer'
		) );

		$args = array(
			'posts_per_page'   => -1,
			'offset'           => 0,
			'orderby'          => 'date',
			'order'            => 'DESC',
			'post_type'        => 'eb_footer',
			'post_status'      => 'publish',
			'suppress_filters' => true 
		);
		$posts = get_posts( $args );
		foreach ( $posts as $post ) :
			$footers[$post->post_name] = $post->post_title;
		endforeach;
		return $footers;
	}
endif;

/**
 * return elementor footer
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_get_footer_config' ) ) :
	function edubin_get_footer_config() {
		if ( is_page() ) {
			global $post;
			$footer = '';
			if ( is_object( $post ) && isset( $post->ID ) ) :
				$footer = get_post_meta( $post->ID, '_edubin_mb_elementor_footer', true );
				if ( empty( $footer ) || $footer == 'global' ) :
					return Edubin::setting( 'edubin_get_elementor_footer' );
				endif;
			endif;
			return $footer;
		}
		return  Edubin::setting( 'edubin_get_elementor_footer' );
	}
	add_filter( 'edubin_get_footer_layout', 'edubin_get_footer_config' );
endif;

/**
 * print Elementor Footer
 * 
 * @since 1.0.0
 */
function edubin_show_footer_builder( $footer_slug ) {
	$args = array(
		'name'        => $footer_slug,
		'post_type'   => 'eb_footer',
		'post_status' => 'publish',
		'numberposts' => 1
	);

	$posts = get_posts($args);
	foreach ( $posts as $post ) :
		$classes = array( 'edubin-footer footer-builder-wrapper' );
		$classes[] = $post->post_name;

		echo '<footer id="edubin-footer" class="' . esc_attr( implode( ' ', $classes ) ) . '">';
			echo '<div class="edubin-footer-inner">';
				echo apply_filters( 'edubin_generate_post_builder', do_shortcode( $post->post_content ), $post, $post->ID);
			echo '</div>';
		echo '</footer>';
	endforeach;
}


/**
 * return category/single category with link
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_category_by_id' ) ) :
	function edubin_category_by_id( $post_id = null, $taxonomy = 'category', $single = true ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		$cat = '';
		$cat_with_link = '';

		if ( is_array( $terms ) ) :
			foreach ( $terms as $tkey => $term ) :
				$cat .= $term->slug . ' ';
				$cat_with_link .= sprintf('<a href="%s">%s<span class="tags-sep">,</span></a>', esc_url(get_category_link($term->term_id)), esc_html($term->name));
				if ( $single ) :
					break;
				endif;
			endforeach;
		endif;
		return $cat_with_link;
	}
endif;

/**
 * get instructor lists from specific role type
 */
if ( ! function_exists( 'edubin_get_all_instructors' ) ) :
    function edubin_get_all_instructors( $user_role = 'lp_teacher' ) {
		$instructors = array();
		$user_role   = $user_role;
		$users       = get_users( 
            array( 
                'role__in' => array( 
                    $user_role
                ) 
            ) 
        );
        
        if ( is_array( $users ) && ! empty( $users ) && ! is_wp_error( $users ) ) :
            $instructors = ['' => ''];
            foreach ( $users as $user ) :
                if ( isset( $user ) ) :
                    $instructors[ $user->ID ] = $user->display_name.' [ID: '.$user->ID.']';
                endif;
            endforeach;
        else :
            $instructors[0] = __( 'No Instructor found',  'edubin' );
        endif;

        return $instructors;
    }
endif;

/**
 * Get Social icons for instructors
 */
if ( ! function_exists( 'edubin_user_social_icons' ) ) :
	function edubin_user_social_icons( $user_id, $link_tab = '_blank' ) {
		$facebook = $twitter = $linkedin = $youtube = '';

		if ( ! $user_id ) :
			$user_id = get_current_user_id();
		endif;

		$facebook  = get_the_author_meta( 'edubin_facebook', $user_id );
		$twitter   = get_the_author_meta( 'edubin_twitter', $user_id );
		$linkedin  = get_the_author_meta( 'edubin_linkedin', $user_id );
		$youtube   = get_the_author_meta( 'edubin_youtube', $user_id );

		$facebook ? printf( '<a href="%s" target="' . esc_attr( $link_tab ) . '"><i class="icon-facebook"></i></a>', esc_url( $facebook ) ) : '';
		$twitter ? printf( '<a href="%s" target="' . esc_attr( $link_tab ) . '"><i class="icon-twitter"></i></a>', esc_url( $twitter ) ) : ''; 
		$linkedin ? printf( '<a href="%s" target="' . esc_attr( $link_tab ) . '"><i class="icon-linkedin2"></i></a>', esc_url( $linkedin ) ) : '';
		$youtube ? printf( '<a href="%s" target="' . esc_attr( $link_tab ) . '"><i class="icon-youtube"></i></a>', esc_url( $youtube ) ) : '';
	}
endif;

/**
 * Get title
 */
if ( ! function_exists( 'edubin_get_title' ) ) :
	function edubin_get_title( $tag = 'h4', $extra_class = null ) {
		$title = get_the_title();
		$class = 'course__title';

		if ( 0 === mb_strlen( $title ) ) :
			$title = '&nbsp;';
			$class = 'course__title-link';
		endif;

		if ( $extra_class ) :
			$class .= ' ' . $extra_class;
		endif;

		if ( ! empty( $title ) ) :
			return '<' . esc_attr( $tag ) . ' class="' . esc_attr( $class ). '"><a class="course__title-link" href="' . esc_url( get_permalink() ) . '">' . wp_kses_post( $title ) . '</a></' . esc_attr( $tag ) . '>';
		endif;

		return '';
	}
endif;

/**
 * Logo Setup
 */
if ( ! function_exists( 'edubin_logo_setup' ) ) :
    function edubin_logo_setup(){
		global $post;
		echo '<div class="logo-wrapper" itemscope itemtype="http://schema.org/Brand">';

			if ( is_page() && is_object( $post ) && function_exists( 'edubin_child_theme_is_activated' ) && edubin_child_theme_is_activated() ) :
				$page_custom_logo = get_post_meta( get_the_ID(), 'edubin_page_header_logo', true );
				if ( isset( $page_custom_logo ) && ! empty( $page_custom_logo ) ) :
					echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="navbar-brand site-main-logo page-custom-logo">';
						echo '<img class="site-logo" src="' . esc_url( $page_custom_logo ) . '">';
					echo '</a>';

					edubin_white_logo();
					echo '</div>';
					return;
				endif;
			endif;

			if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) :
				the_custom_logo();
			else :
				echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="navbar-brand site-main-logo">';
					echo '<img class="site-logo" src="' . esc_url( get_template_directory_uri().'/assets/images/logo.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				echo '</a>';
			endif;

			edubin_white_logo();

		echo '</div>';
    }
endif;

/**
 * White Logo
 */
if ( ! function_exists( 'edubin_white_logo' ) ) :
    function edubin_white_logo() {
		global $post;
		$white_logo = Edubin::setting( 'header_white_logo' );

		if ( isset( $white_logo ) && ! empty( $white_logo ) ) :
			$white_logo = $white_logo;
		else :
			$white_logo = '';
		endif;

		if ( is_page() && is_object( $post ) && function_exists( 'edubin_child_theme_is_activated' ) ) :
			$page_white_logo = get_post_meta( get_the_ID(), 'edubin_page_header_white_logo', true );
			if ( isset( $page_white_logo ) && ! empty( $page_white_logo ) ) :
				$white_logo = $page_white_logo;
			endif;
		endif;

		if ( isset( $white_logo ) && ! empty( $white_logo ) ) :
			echo '<a href="' . esc_url( home_url( '/' ) ) . '" class="navbar-brand site-white-logo">';
				echo '<img src="' . esc_url( $white_logo ) . '" class="header-white-logo" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />';
			echo '</a>';
		endif;
    }
endif;

/**
 * Menu Setup
 */
if ( ! function_exists( 'edubin_menu_setup' ) ) :
    function edubin_menu_setup(){
        if ( has_nav_menu( 'primary' ) ) :
			echo '<nav id="site-navigation" class="main-navigation edubin-theme-nav edubin-navbar-collapse">';
				echo '<div class="edubin-navbar-primary-menu">';
					do_action( 'edubin_before_main_menu' );
					wp_nav_menu( array(
						'theme_location' => 'primary',
						'depth'          => 8,
						'container'      => 'div',
						'container_class'=> 'primary-menu-container-class',
						'container_id'   => 'primary-menu-container-id',
						'menu_class'     => 'edubin-default-header-navbar edubin-navbar-nav edubin-navbar-right',
						'menu_id'        => 'primary-menu-custom-id',
						'fallback_cb'    => 'Edubin_NavWalker::fallback',
						'walker'         => new Edubin\Navwalker\Edubin_NavWalker()							
					) );
					do_action( 'edubin_after_main_menu' );
				echo '</div>';
			echo '</nav>';//#site-navigation
		endif;
    }
endif;

/**
 * Responsive Menu Setup
 */
if ( ! function_exists( 'edubin_responsive_menu_setup' ) ) :
    function edubin_responsive_menu_setup(){
        if ( has_nav_menu( 'primary' ) ) :
			echo '<div class="edubin-mobile-menu">';
				echo '<div class="edubin-mobile-menu-overlay"></div>';

				echo '<div class="edubin-mobile-menu-nav-wrapper">';
					echo '<div class="responsive-header-top">';
						echo '<div class="responsive-header-logo">';
							edubin_logo_setup();
						echo '</div>';
						
						echo '<div class="edubin-mobile-menu-close">';
							echo '<a href="javascript:void(0);">';
								echo '<i class="flaticon-cancel"></i>';
							echo '</a>';
						echo '</div>';
					echo '</div>';

					wp_nav_menu( array(
						'theme_location' => 'primary',
						'depth'          => 8,
						'container'      => 'ul',
						'menu_id'        => 'edubin-mobile-menu-item',
						'menu_class'     => 'edubin-mobile-menu-item',
						'fallback_cb'    => 'Edubin_NavWalker::fallback',
						'walker'         => new Edubin\Navwalker\Edubin_NavWalker()						
					) );	
				echo '</div>';
			echo '</div>';
		endif;
    }
endif;

/**
 * change default logo class
 */
add_filter( 'get_custom_logo', 'edubin_logo_class' );
if ( ! function_exists( 'edubin_logo_class' ) ) :
	function edubin_logo_class( $html ) {
	    $html = str_replace( 'custom-logo-link', 'navbar-brand site-main-logo', $html );
	    $html = str_replace( 'custom-logo', 'site-logo', $html );
	    return $html;
	}
endif;

/**
 * Header Search Field
 */
if ( ! function_exists( 'edubin_header_search_field' ) ) :
	function edubin_header_search_field( $extra_class = null ) {
		if ( $extra_class ) :
			$extra_class = ' ' . $extra_class;
		endif;
		echo '<div class="edu-header-search-field' . esc_attr( $extra_class ) . '">';
            echo '<div class="inner">';
				echo '<form action="' . esc_url( home_url( '/' ) ) .'" class="search-form" method="get">';
					echo '<input type="text" class="edubin-search-popup-field" name="s" value="' . esc_attr( get_search_query() ) . '" placeholder="' . esc_attr__( 'Search', 'edubin') . '">';
                    echo '<button class="submit-button"><i class="flaticon-search"></i></button>';
				echo '</form>';
            echo '</div>';
        echo '</div>';
	}
endif;

/**
 * Header Search Modal PopUp for enter site
 */
if ( ! function_exists( 'edubin_whole_search_modal_popup' ) ) :
    function edubin_whole_search_modal_popup() {

        $search_type = Edubin::setting( 'edubin_search_style' );

        echo '<div class="edubin-search-box">';
            echo '<div class="edubin-search-form">';

            echo '<div class="edubin-closebtn">';
                echo '<span></span>';
                echo '<span></span>';
            echo '</div>';

            echo '<form action="';
                // Default to WordPress site-wide search
                echo esc_url(home_url('/'));
                echo '" method="get">';
                
                echo '<input type="text" value="" name="s" placeholder="'. esc_attr__( 'Search Here..', 'edubin' ) . '" class="input-search" autocomplete="off" />';
                
                // Hidden input for specific search types
                if ($search_type == 'tpc_wp_search') {
                    echo '<input type="hidden" value="" name="post_type" />';
                }

                echo '<button><i class="flaticon-search"></i></button>';
            echo '</form>';

            echo '</div>';
        echo '</div>';

    }
endif;

/**
 * Header Search Modal PopUp for LMS courses
 */

if ( ! function_exists( 'edubin_lms_course_search_modal_popup' ) ) :
	function edubin_lms_course_search_modal_popup() {

        $search_type = Edubin::setting( 'edubin_search_style' );

		echo '<div class="edubin-search-box">';
			echo '<div class="edubin-search-form">';

			echo '<div class="edubin-closebtn">';

			echo '<span></span>';
			echo '<span></span>';

			echo '</div>';
				echo '<form action="';
				if ($search_type == 'tpc_tutor_search') {
				    echo esc_url(get_post_type_archive_link('courses'));
				} elseif ($search_type == 'tpc_lp_search') {
				    echo esc_url(get_post_type_archive_link('lp_course'));
				} elseif ($search_type == 'tpc_ld_search') {
				    echo esc_url(get_post_type_archive_link('sfwd-courses'));
				}
				echo '" method="get">';
				echo '<input type="text" value="" name="search_query" placeholder="'. __( 'Search Here..', 'edubin' ) . '" class="input-search" autocomplete="off" />';
				echo '<input type="hidden" value="lp_course_search" name="tpc_lp_course_filter" />';
				echo '<button><i class="flaticon-search"></i></button>';
				echo '</form>';
			echo '</div>';
		echo '</div>';

	}
endif;

/**
 * Header User Login / Register
 */
if ( ! function_exists( 'edubin_header_user_login_option' ) ) :
	function edubin_header_user_login_option( $icon_with_text = false ) {
		echo '<div class="quote-icon quote-user">';
			if ( $icon_with_text ) :
				echo '<a class="header-login-register button-text-with-icon" href="' . esc_url( wp_login_url( get_permalink() ) ) . '" target="_blank"><i class="ri-user-line"></i><span class="button-text">' . __( 'Login / Register', 'edubin' ). '</span></a>';
			else :
				echo '<a class="header-login-register" href="' . esc_url( wp_login_url( get_permalink() ) ) . '" target="_blank"><i class="ri-user-line"></i></a>';
			endif;
		echo '</div>';
	}
endif;

/**
 * Header User Login / Register( alter )
 */
if ( ! function_exists( 'edubin_header_user_login_option_alter' ) ) :
	function edubin_header_user_login_option_alter( $icon_with_text = false ) {
		echo '<div class="quote-icon quote-user">';
			if ( is_user_logged_in() ) :
				$user_id = get_current_user_id();
				$user    = get_userdata( $user_id );
				if ( function_exists( 'learn_press_get_page_link' ) ) :
					$profile_url = learn_press_get_page_link( 'profile' );
					echo '<a href="' . esc_url( $profile_url ) . '">';
						echo get_avatar( $user_id, 100 );
					echo '</a>';
				else :
					echo get_avatar( $user_id, 100 );
				endif;
			else :
				if ( $icon_with_text ) :
					echo '<a class="header-login-register button-text-with-icon" href="' . esc_url( wp_login_url( get_permalink() ) ) . '" target="_blank"><i class="ri-user-line"></i><span class="button-text">' . __( 'Login / Register', 'edubin' ) . '</span></a>';
				else :
					echo '<a class="header-login-register" href="' . esc_url( wp_login_url( get_permalink() ) ) . '" target="_blank"><i class="ri-user-line"></i></a>';
				endif;
			endif;
		echo '</div>';
	}
endif;

/**
 * Header Category
 */
if ( ! function_exists( 'edubin_header_category' ) ) :
	function edubin_header_category( $extra_class = null ) {
		$cat_status = Edubin::setting( 'header_category_show' );
		if ( ! $cat_status ) :
			return;
		endif;

		$class = "header-category";
		if ( $extra_class ) :
			$class .= ' ' . $extra_class;
		endif;
		$title = Edubin::setting( 'heading_category_title' ) ? Edubin::setting( 'heading_category_title' ) : __( 'Category', 'edubin' );
		echo '<div class="' . esc_attr( $class ) . '">';
			echo '<nav class="main-navigation">';
				echo '<ul class="category-menu edubin-navbar-nav">';
					echo '<li class="cat-menu-item dropdown">';
						echo '<a class="cat-menu-anchor-item">';
							echo '<i class="flaticon-menu-1"></i>';
							echo esc_html( $title );
						echo '</a>';
						echo '<ul class="edubin-dropdown-menu">';
							edubin_header_category_items();
						echo '</ul>';
					echo '</a>';
				echo '</ul>';
			echo '</nav>';
		echo '</div>';
	}
endif;

/**
 * Header Category Items
 */
if ( ! function_exists( 'edubin_header_category_items' ) ) :
	function edubin_header_category_items() {
		$total_cat_to_show = Edubin::setting( 'heading_category_items' );
		$total_cat_to_show = intval( $total_cat_to_show );
		$cat_slug = apply_filters( 'edubin_header_course_lms_cat_slug', 'course_category' );
		$args = [
			'taxonomy'   => $cat_slug,
			'orderby'    => 'name',
			'show_count' => 0,
			'title_li'   => '',
			'hide_empty' => 1,
			'number'     => $total_cat_to_show
		];

		$args = apply_filters( 'edubin_header_course_category_args', $args );
		$categories = get_categories( $args );

		if ( is_array( $categories ) && ! empty( $categories ) ) :
			foreach ( $categories as $category ) :
				echo '<li class="cat-item">';
					echo '<a href="' . esc_url( get_term_link( $category ) ) . '">';
						echo esc_html( $category->name );
					echo '</a>';
				echo '</li>';
			endforeach;
		else :
			echo '<li class="cat-item"><a class="no-cat-found">' . esc_html( 'No Category Found', 'edubin' ) . '</a></li>';
		endif;
	}
endif;

/**
 * Header Category Only Parent Items
 * by activating the following filter
 * only parent category will be visible
 */
// add_filter( 'edubin_header_course_category_args', 'edubin_header_category_only_parent' );
if ( ! function_exists( 'edubin_header_category_only_parent' ) ) :
	function edubin_header_category_only_parent( $args ) {
		$extra_args = wp_parse_args( [
			'parent' => 0
		], $args );
		return $extra_args;
	}
endif;

/**
 * Header Button
 */
if ( ! function_exists( 'edubin_header_button' ) ) :
	function edubin_header_button( $extra_class = null ) {
		$header_button_show = Edubin::setting( 'header_button_show' );
		$button_text = Edubin::setting( 'header_button_text' );
		$button_url = Edubin::setting( 'header_button_url' );
		$same_tab = Edubin::setting( 'header_button_open_same_tab' );
		if ( $same_tab ) :
			$tab = '_self';
		else :
			$tab = '_blank';
		endif;
		
		if ( $extra_class ) :
			$extra_class = ' ' . $extra_class;
		endif;

		if ( $header_button_show && $button_text ) :
			echo '<a href="' . esc_url( $button_url ). '" target="' . esc_attr( $tab ) . '" class="main-header-btn edubin-btn btn-small' . esc_attr( $extra_class ) . '">' . wp_kses_post( $button_text ) . '</a>';
		elseif ($header_button_show && $button_text ) :
			echo '<a href="' . esc_url( $button_url ). '" target="' . esc_attr( $tab ) . '" class="main-header-btn edubin-btn btn-small' . esc_attr( $extra_class ) . '">' . __( 'Try for free', 'edubin' ) . '<i class="flaticon-cursor"></i></a>';
		endif;
	}
endif;

/**
 * Header Responsive Menu Toggle
 */
if ( ! function_exists( 'edubin_header_responsive_toggle' ) ) :
	function edubin_header_responsive_toggle() {
		echo '<div class="quote-icon edubin-theme-nav-responsive hamburger-icon">';
			echo '<div class="edubin-mobile-hamburger-menu">';
				echo '<a href="javascript:void(0);">';
					echo '<i class="flaticon-menu"></i>';
				echo '</a>';
			echo '</div>';
		echo '</div>';
	}
endif;

/**
 * Header Cart Icon
 */
if ( ! function_exists( 'edubin_header_cart_icon' ) ) :
	function edubin_header_cart_icon() {
		if ( class_exists( 'WooCommerce' ) ) :
			echo '<div class="edubin-woo-mini-cart-wrapper woocommerce">';
				echo '<div class="edubin-woo-mini-cart-inner">';
					echo '<div class="edubin-woo-mini-cart-icon-wrapper edubin-woo-mini-cart-active-on-hover">';
						echo '<a class="edubin-woo-mini-cart-link edubin-woo-mini-cart-visible-on-hover" href="' . esc_url( wc_get_cart_url() ) .'" target="_self">';
							echo '<i aria-hidden="true" class="flaticon-shopping-cart-1"></i>';
						echo '</a>';

						echo '<span class="edubin-woo-mini-cart-total-item">';
							echo WC()->cart->get_cart_contents_count();
						echo '</span>';
						
						echo '<div class="edubin-woo-mini-cart-content">';
							echo '<div class="widget_shopping_cart_content">';
								woocommerce_mini_cart();
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
			echo '</div>';
		else :
			return;
		endif;
	}
endif;

/**
 * Header Search Icon
 */
if ( ! function_exists( 'edubin_header_search_toggle' ) ) :
	function edubin_header_search_toggle() {

		echo '<div class="header-quote">';
			echo '<div class="quote-icon quote-search">';
				echo '<a href="#" id="search"><i class="flaticon-search"></i></a>';
			echo '</div>';
		echo '</div>';

	}
endif;

/**
 * Theme main header
 */
add_action( 'edubin_main_header', 'edubin_header_setup' );
if ( ! function_exists( 'edubin_header_setup' ) ) :
	function edubin_header_setup() {
		$default_headers = array( 
			'theme-default-header',
			'theme-header-1',
			'theme-header-2',
			'theme-header-3',
			'theme-header-4',	
			'theme-header-5',
		);
		$header = apply_filters( 'edubin_get_header_layout', Edubin::setting( 'edubin_get_elementor_header' ) );
		$sticky_header = Edubin::setting( 'sticky_header_enable' );
		$dark_header_enable = Edubin::setting( 'dark_header_enable' );
		$classes[] = 'site-header';
		$classes[] = $header;

		if ( $dark_header_enable ) :
			$classes[] = 'edubin-dark-header';
		endif;

		if ( $sticky_header ) :
			$classes[] = 'header-get-sticky';
		endif;

		$classes = apply_filters( 'edubin_header_class_array', $classes );

		if ( 'none' !== $header ) :
			if ( in_array( $header, $default_headers ) || empty( $header ) ) :
				echo '<header id="masthead" class="' . esc_attr( implode( ' ', $classes ) ) . '">';
					edubin_header_top_bar();
					edubin_header();
				echo '</header>'; //#masthead
				
				// responsive menu
				edubin_responsive_menu_setup();
			else :
				edubin_show_header_builder( $header );
			endif;
		endif;

	}
endif;

/**
 * Theme header
 */
if ( ! function_exists( 'edubin_header' ) ) :
	function edubin_header(){
		$header = apply_filters( 'edubin_get_header_layout', Edubin::setting( 'edubin_get_elementor_header' ) );

		$container_class = 'edubin-container-fluid';
		if ( 'theme-default-header' === $header || 'theme-header-4' === $header  || 'theme-header-5' === $header  ) :
			$container_class = 'edubin-container';
		endif;

		$search_field = $header_btn = '';

		echo '<div class="edubin-header-area edubin-navbar edubin-navbar-expand-lg">';
			echo '<div class="' . esc_attr( apply_filters( 'edubin_header_container_class', $container_class ) ) . '">';
				echo '<div class="tpc-header-navbar edubin-align-items-center">';

					echo '<div class="site-branding site-logo-info">';
						edubin_logo_setup();
					echo '</div>';

					if ( 'theme-header-1' === $header || 'theme-header-2' === $header || 'theme-header-3' === $header ) :
						edubin_header_category();	
					endif;

					if ( 'theme-header-3' === $header ) :
						edubin_header_search_field( $search_field );
					endif;

					echo '<div class="edubin-theme-header-nav edubin-d-none edubin-d-xl-block">';
						edubin_menu_setup();
					echo '</div>';

					edubin_header_right_side_content();

				echo '</div>';
			echo '</div>';
		echo '</div>';
	}
endif;

/**
 * Theme header Right Side Content
 */
if ( ! function_exists( 'edubin_header_right_side_content' ) ) :
	function edubin_header_right_side_content(){
		$header = apply_filters( 'edubin_get_header_layout', Edubin::setting( 'edubin_get_elementor_header' ) );
		
		$search_field = $header_btn = '';

		echo '<div class="edubin-header-right-side">';

			do_action( 'edubin_header_right_before_content' );

			//edubin_login_register_by_icon();

			if( 'theme-header-5' === $header) :
				edubin_header_button( $header_btn );
			endif;

			if ( 'theme-header-1' === $header || 'theme-header-2' === $header && 'theme-header-3' !== $header ) :
				edubin_header_search_field( $search_field );
			endif;

			if ( 'theme-header-4' === $header ) :
				edubin_header_top_social_share();
			endif;
			
			if ( Edubin::setting( 'top_search_enable' ) ) :
				if ( 'theme-header-3' !== $header ) :
					edubin_header_search_toggle();
				endif;
			endif;

			if ( Edubin::setting( 'top_cart_enable' ) ) :
				if ( 'theme-header-2' !== $header ) :
					edubin_header_cart_icon();
				endif;
			endif;

			if( 'theme-header-5' !== $header) :
				edubin_header_button( $header_btn );
			endif;

			do_action( 'edubin_header_right_after_content' );

			edubin_header_responsive_toggle();

		echo '</div>';
	}
endif;

/**
 * Theme header top bar
 */
if ( ! function_exists( 'edubin_header_top_bar' ) ) :
	function edubin_header_top_bar() {
		global $post;
		$top_bar = Edubin::setting( 'header_top_show' );
		$top_bar_type = Edubin::setting( 'header_top_bar_style' );

		if ( is_page() && is_object( $post ) ) :
			$page_top_bar = get_post_meta( get_the_ID(), '_edubin_page_header_top_show', true );
			$page_top_bar_type = get_post_meta( get_the_ID(), '_edubin_page_header_top_bar_style', true );
			if ( 'enable' === $page_top_bar ) :
				$top_bar = true;
			elseif ( 'disable' === $page_top_bar ) :
				$top_bar = false;
			endif;

			if ( '1' === $page_top_bar_type || '2' === $page_top_bar_type ) :
				$top_bar_type = $page_top_bar_type;
			endif;
		endif;

		$container_class = 'edubin-container-fluid';

		if ( '2' === $top_bar_type ||  '3' === $top_bar_type ) :
			$container_class = 'edubin-container';
		endif;

		if ( $top_bar ) :
			echo '<div class="tpc-header-top-bar tpc-top-bar-style-' . esc_attr( $top_bar_type ) . '">';
				echo '<div class="' . esc_attr( apply_filters( 'edubin_header_top_bar_container_class', $container_class ) ) . '">';
					echo '<div class="edubin-header-top-content">';
						if ( '1' === $top_bar_type ) :
							edubin_header_top_01();
						elseif ( '2' === $top_bar_type ) :
							edubin_header_top_02();
						elseif ( '3' === $top_bar_type ) :
							edubin_header_top_03();
						else :
							edubin_header_top_01();
						endif;
					echo '</div>';
				echo '</div>';
			echo '</div>';
		endif;
	}
endif;

/**
 * Theme header top social share
 */
if ( ! function_exists( 'edubin_header_top_social_share' ) ) :
	function edubin_header_top_social_share() {

	$enable_social_handle = Edubin::setting( 'enable_social_handle' );
    $edubin_social_links = Edubin::setting( 'edubin_social_links' );
    $social_newtab   = Edubin::setting( 'social_newtab' );
	$follow_us_show   = Edubin::setting( 'follow_us_show' );
	$follow_us_text   = Edubin::setting( 'follow_us_text' );

echo '<div class="header-top-social-share">';

  echo '<span class="follow-us">';
    if($follow_us_text) {
        echo esc_html($follow_us_text);
    } else {
        echo esc_html__( 'Follow Us :', 'edubin' );
    }
    echo '</span>';

		foreach($edubin_social_links as $edubin_social_handle) : 
			if (!empty($edubin_social_handle)) {

				echo '<span class="header-top-social-item">';
				echo '<a href="' . esc_url($edubin_social_handle['header_icon_link']) . '"';
				if (!empty($edubin_social_handle['header_icon_title'])) {
				    echo ' title="' . esc_attr($edubin_social_handle['header_icon_title']) . '"';
				}
				echo '><i';
				if (!empty($edubin_social_handle['header_icons_color'])) {
				    echo ' style="color:' . esc_attr($edubin_social_handle['header_icons_color']) . '"';
				}
				echo ' class="' . esc_attr($edubin_social_handle['header_icon_icons']) . '"></i></a>';
				echo '</span>';
			}
		endforeach; 	
	echo '</div>';

	}
endif;

/**
 * Theme header top bar 1
 */
if ( ! function_exists( 'edubin_header_top_01' ) ) :
	function edubin_header_top_01() {
		$top_massage = Edubin::setting( 'top_massage' );
		$top_massage_animation_show = Edubin::setting( 'top_massage_animation_show' );
		$top_massage_area_width = Edubin::setting( 'top_massage_area_width' );
		$phone   = Edubin::setting( 'top_phone' );
		$email   = Edubin::setting( 'top_email' );
		$social_icons = Edubin::setting( 'enable_social_handle' );

	    $custom_profile_page_link   = Edubin::setting( 'custom_profile_page_link' );
	    $custom_logout_link    = Edubin::setting( 'custom_logout_link' );
	    $custom_login_link    = Edubin::setting( 'custom_login_link' );
	    $custom_register_link    = Edubin::setting( 'custom_register_link' );
		$top_login_button_text   = Edubin::setting( 'top_login_button_text' );
	    $top_register_button_text   = Edubin::setting( 'top_register_button_text' );
	    $top_logout_button_text   = Edubin::setting( 'top_logout_button_text' );


		if ( $top_massage ) :
			echo '<div class="header-top-left">';
				if ( $top_massage ) :
					echo '<div class="header-top-message">';

					if ( $top_massage_animation_show ) {
						echo '<marquee width='. esc_attr($top_massage_area_width) .'px scrollamount="3">';
					}
						echo wp_kses_post( $top_massage );

					if ( $top_massage_animation_show ) {
						echo '</marquee>';
					}

					echo '</div>';
				endif;
			echo '</div>';
		endif;

		echo '<div class="header-top-right">';

			if ( is_active_sidebar( 'header-top' ) ) {
			    echo '<div class="header-top-widget-wrap">';
			        dynamic_sidebar( 'header-top' );
			    echo '</div>';
			}

			if ( Edubin::setting( 'login_popup_active' ) ) :

				$get_the_top_login_button_text = $top_login_button_text ? $top_login_button_text : __( 'Login', 'edubin' );
				$get_the_top_register_button_text = $top_register_button_text ? $top_register_button_text : __( 'Register', 'edubin' );

				echo '<div class="header-top-login-register">';
					if( ! is_user_logged_in() ) :
						echo '<a href="javascript:void(0)" class="tpc-login-register-popup-trigger">' . $get_the_top_login_button_text . esc_attr(' / ') . esc_html( $get_the_top_register_button_text ) . '</a>';
					else :
						echo '<a href="' . esc_url( wp_logout_url() ).'" class="tpc-logout-trigger">' . esc_html( $get_the_top_logout_button_text ) . '</a>';
					endif;
				echo '</div>';

			else :
	
				$get_the_top_login_button_text = $top_login_button_text ? $top_login_button_text : __( 'Login', 'edubin' );
				$get_the_top_register_button_text = $top_register_button_text ? $top_register_button_text : __( 'Register', 'edubin' );
				$get_the_top_logout_button_text = $top_logout_button_text ? $top_logout_button_text : __( 'Logout', 'edubin' );


				$get_the_custom_login_link = ( !empty( $custom_login_link ) ) ? $custom_login_link : wp_login_url( home_url('/') );

				echo '<div class="header-top-login-register">';
					if( ! is_user_logged_in() ) :
						echo '<a href="'. esc_url( $get_the_custom_login_link ) .'" class="tpc-login-register-popup-trigger-js-none">' . $get_the_top_login_button_text . esc_attr(' / ') . esc_html( $get_the_top_register_button_text ) . '</a>';
					else :
						if ( !empty($custom_logout_link) ) {
							echo '<a href="' . esc_url( wp_logout_url( $custom_logout_link ) ) .'" class="tpc-logout-trigger-js-none">' . esc_html( $get_the_top_logout_button_text ) . '</a>';
						} else {
							echo '<a href="' . esc_url(wp_logout_url( home_url() ) ).'" class="tpc-logout-trigger-js-none">' . esc_html( $get_the_top_logout_button_text ) . '</a>';
						}
					endif;
				echo '</div>';

			endif;

			if ( $email ) :
				echo '<div class="header-top-email">';
					echo '<a href="mailto:' . esc_attr( $email ) . '"><i class="flaticon-message"></i>'. __( 'Email', 'edubin' ) . ': ' . esc_html( $email ) . '</a>';
				echo '</div>';
			endif;

			if ( $phone ) :
				echo '<div class="header-top-phone">';
					echo '<a href="tel:' . esc_attr( $phone ) . '"><i class="flaticon-phone-call"></i>'. __( 'Call', 'edubin' ) . ': ' . esc_html( $phone ) . '</a>';
				echo '</div>';
			endif;

			if ( $social_icons ) :
				edubin_header_top_social_share();
			endif;
		echo '</div>';
	}
endif;

/**
 * Theme header top bar 2
 */
if ( ! function_exists( 'edubin_header_top_02' ) ) :
	function edubin_header_top_02() {

		$header = apply_filters( 'edubin_get_header_layout', Edubin::setting( 'edubin_get_elementor_header' ) );

		$top_massage = Edubin::setting( 'top_massage' );
		$top_massage_area_width = Edubin::setting( 'top_massage_area_width' );
		$top_massage_animation_show = Edubin::setting( 'top_massage_animation_show' );
		$phone   = Edubin::setting( 'top_phone' );
		$email   = Edubin::setting( 'top_email' );

		$header_top_button_show = Edubin::setting( 'header_top_button_show' );
		$button_text = Edubin::setting( 'header_top_button_text' );
		$button_url = Edubin::setting( 'header_top_button_url' );
		$same_tab = Edubin::setting( 'header_top_button_open_same_tab' );

		$social_icons = Edubin::setting( 'enable_social_handle' );

	    $custom_profile_page_link   = Edubin::setting( 'custom_profile_page_link' );
	    $custom_logout_link    = Edubin::setting( 'custom_logout_link' );
	    $custom_login_link    = Edubin::setting( 'custom_login_link' );
	    $custom_register_link    = Edubin::setting( 'custom_register_link' );
		$top_login_button_text   = Edubin::setting( 'top_login_button_text' );
	    $top_register_button_text   = Edubin::setting( 'top_register_button_text' );
	    $top_logout_button_text   = Edubin::setting( 'top_logout_button_text' );
	
		if ( $same_tab ) :
			$tab = '_self';
		else :
			$tab = '_blank';
		endif;

		if ( $email || $phone) :
			echo '<div class="header-top-left">';

				if ( $email ) :
					echo '<div class="header-top-email">';
						echo '<a href="mailto:' . esc_attr( $email ) . '"><i class="flaticon-message"></i>'. __( 'Email', 'edubin' ) . ': ' . esc_html( $email ) . '</a>';
					echo '</div>';
				endif;

				if ( $phone ) :
					echo '<div class="header-top-phone">';
						echo '<a href="tel:' . esc_attr( $phone ) . '"><i class="flaticon-phone-call"></i>'. __( 'Call', 'edubin' ) . ': ' . esc_html( $phone ) . '</a>';
					echo '</div>';
				endif;

			echo '</div>';
		endif;

		echo '<div class="header-top-center">';
			if ( $top_massage ) :
				echo '<div class="header-top-message">';

				if ( $top_massage_animation_show ) {
					echo '<marquee width='. esc_attr($top_massage_area_width) .'px scrollamount="3">';
				}
					echo wp_kses_post( $top_massage );

				if ( $top_massage_animation_show ) {
					echo '</marquee>';
				}

				echo '</div>';
			endif;
		echo '</div>';

		echo '<div class="header-top-right">';


			if ( $social_icons && 'theme-header-4' !== $header) :
				edubin_header_top_social_share();
			endif;

			$top_register_button_text = Edubin::setting( 'top_register_button_text' );
			$top_logout_button_text = Edubin::setting( 'top_logout_button_text' );
			$top_register_button_text = Edubin::setting( 'top_register_button_text' );
			$profile_show = Edubin::setting( 'profile_show' );
			$custom_profile_page_link = Edubin::setting( 'custom_profile_page_link' );
			$top_profile_button_text = Edubin::setting( 'top_profile_button_text' );
			$login_reg_show = Edubin::setting( 'login_reg_show' );

			$get_the_top_login_button_text = $top_login_button_text ? $top_login_button_text : __( 'Login', 'edubin' );
			$get_the_top_register_button_text = $top_register_button_text ? $top_register_button_text : __( 'Register', 'edubin' );
			$get_the_top_logout_button_text = $top_logout_button_text ? $top_logout_button_text : __( 'Logout', 'edubin' );
			$get_the_custom_login_link = ( !empty( $custom_login_link ) ) ? $custom_login_link : wp_login_url( home_url('/') );


			if ( is_active_sidebar( 'header-top' ) ) {
			    echo '<div class="header-top-widget-wrap">';
			        dynamic_sidebar( 'header-top' );
			    echo '</div>';
			}

			if ( Edubin::setting( 'login_popup_active' ) ) :

				if ($profile_show ) :
				    if (is_user_logged_in()) :
				        echo '<div class="header-top-profile">';
				        if (!empty($custom_profile_page_link)) :
				            echo '<span class="profile">';
				            echo '<a href="' . esc_url($custom_profile_page_link) . '">';
				            if ($top_profile_button_text) {
				                echo esc_html($top_profile_button_text);
				            } else {
				                echo esc_html__('Profile', 'edubin');
				            }
				            echo '</a>';
				        else :
				            echo '<a href="' . esc_url(get_edit_user_link()) . '">';
				            if ($top_profile_button_text) {
				                echo esc_html($top_profile_button_text);
				            } else {
				                echo esc_html__('Profile', 'edubin');
				            }
				            echo '</a>';
				            echo '</span>';
				        endif;
				 
				        echo '</div>';
				    endif;
				endif;
				
				echo '<div class="header-top-login-register">';
					if( ! is_user_logged_in() ) :
						echo '<a href="javascript:void(0)" class="tpc-login-register-popup-trigger">' . $get_the_top_login_button_text . esc_attr(' / ') . esc_html( $get_the_top_register_button_text ) . '</a>';
					else :
						echo '<a href="' . esc_url( wp_logout_url() ).'" class="tpc-logout-trigger">' . esc_html( $get_the_top_logout_button_text ) . '</a>';
					endif;
				echo '</div>';

			else :


				if ($profile_show ) :
				    if (is_user_logged_in()) :
				        echo '<div class="header-top-profile">';
				        if (!empty($custom_profile_page_link)) :
				            echo '<span class="profile">';
				            echo '<a href="' . esc_url($custom_profile_page_link) . '">';
				            if ($top_profile_button_text) {
				                echo esc_html($top_profile_button_text);
				            } else {
				                echo esc_html__('Profile', 'edubin');
				            }
				            echo '</a>';
				        else :
				            echo '<a href="' . esc_url(get_edit_user_link()) . '">';
				            if ($top_profile_button_text) {
				                echo esc_html($top_profile_button_text);
				            } else {
				                echo esc_html__('Profile', 'edubin');
				            }
				            echo '</a>';
				            echo '</span>';
				        endif;
				 
				        echo '</div>';
				    endif;
				endif;

				if ($login_reg_show) {

				echo '<div class="header-top-login-register">';
					if( ! is_user_logged_in() ) :

							echo '<a href="'. esc_url( $get_the_custom_login_link ) .'" class="tpc-login-register-popup-trigger-js-none">' . $get_the_top_login_button_text . esc_attr(' / ') . esc_html( $get_the_top_register_button_text ) . '</a>';
						
					else :
						if ( !empty($custom_logout_link) ) {
							echo '<a href="' . esc_url( wp_logout_url( $custom_logout_link ) ) .'" class="tpc-logout-trigger-js-none">' . esc_html( $get_the_top_logout_button_text ) . '</a>';
						} else {
							echo '<a href="' . esc_url(wp_logout_url( home_url() ) ).'" class="tpc-logout-trigger-js-none">' . esc_html( $get_the_top_logout_button_text ) . '</a>';
						}
					endif;
				echo '</div>';

				}

			endif;

			if ( $header_top_button_show ) :
				if ( $button_text ) :

				echo '<div class="header-top-click-button">';
					echo '<a href="' . esc_url( $button_url ). '" target="' . esc_attr( $tab ) . '" class="main-header-btn">' . wp_kses_post( $button_text ) . '</a>';
				echo '</div>';

				else :

				echo '<div class="header-top-click-button">';
					echo '<a href="' . esc_url( $button_url ). '" target="' . esc_attr( $tab ) . '" class="main-header-btn">Apply Now</a>';
				echo '</div>';

				endif;
			endif;

		echo '</div>';
	}
endif;

/**
 * edubin_login_register_by_icon()
 */
// if ( ! function_exists( 'edubin_login_register_by_icon' ) ) :
// 	function edubin_login_register_by_icon() {

// 		$header = apply_filters( 'edubin_get_header_layout', Edubin::setting( 'edubin_get_elementor_header' ) );

// 		echo '<div class="header-top-right">';

// 			if ( Edubin::setting( 'login_popup_active' ) ) :
// 				$top_register_button_text = Edubin::setting( 'top_register_button_text' );
// 				$top_logout_button_text = Edubin::setting( 'top_logout_button_text' );
// 				echo '<div class="header-top-login-register">';
// 					if( ! is_user_logged_in() ) :
// 						echo '<a href="javascript:void(0)" class="tpc-login-register-popup-trigger"><i class="flaticon-user"></i></a>';
// 					else :
// 						echo '<a href="' . esc_url( wp_logout_url() ).'" class="tpc-logout-trigger">' . esc_html( $top_logout_button_text ) . '</a>';
// 					endif;
// 				echo '</div>';
// 			endif;


// 		echo '</div>';
// 	}
// endif;

/**
 * Theme header top bar 3
 */
if ( ! function_exists( 'edubin_header_top_03' ) ) :
	function edubin_header_top_03() {

		$header = apply_filters( 'edubin_get_header_layout', Edubin::setting( 'edubin_get_elementor_header' ) );

		$top_massage = Edubin::setting( 'top_massage' );
		$top_massage_area_width = Edubin::setting( 'top_massage_area_width' );
		$top_massage_animation_show = Edubin::setting( 'top_massage_animation_show' );
		$phone   = Edubin::setting( 'top_phone' );
		$email   = Edubin::setting( 'top_email' );
		$button_text = Edubin::setting( 'header_button_text' );
		$button_url = Edubin::setting( 'header_button_url' );
		$same_tab =  Edubin::setting( 'header_button_open_same_tab' );
		$social_icons = Edubin::setting( 'enable_social_handle' );
		if ( $same_tab ) :
			$tab = '_self';
		else :
			$tab = '_blank';
		endif;


		echo '<div class="header-top-center">';
			if ( $top_massage ) :
				echo '<div class="header-top-message">';

				if ( $top_massage_animation_show ) {
					echo '<marquee width="100%" direction="left" scrollamount="10">';
				}
					echo wp_kses_post($top_massage);

				if ( $top_massage_animation_show ) {
					echo '</marquee>';
				}

				echo '</div>';
			else :
				if ( $top_massage_animation_show ) {
					echo '<marquee width="100%" direction="left" scrollamount="10">';
				}
					echo "Add your notice in top message option! & Enabled the animation options";

				if ( $top_massage_animation_show ) {
					echo '</marquee>';
				}
			endif;
		echo '</div>';

	}
endif;

/**
 * theme after header
 * page title & breadcrumb
 */

add_action( 'edubin_after_header', 'edubin_breadcrumb_display' );
if ( ! function_exists( 'edubin_breadcrumb_display' ) ) :
	function edubin_breadcrumb_display() {
		global $post;
		$breadcrumb = '';
		$has_bg_image = '';
		$show = true;
		$style = array();
		$global_breadcrumb_visibility = Edubin::setting( 'page_header_show' );

		if ( edubin_is_lms_course_details() ) :
			return;
		endif;

		if ( $global_breadcrumb_visibility ) :
			$global_breadcrumb_type = Edubin::setting( 'page_title_bg_type' );

			if ( 'image' === $global_breadcrumb_type ) :
				$global_breadcrumb_img = get_header_image();
				if ( isset( $global_breadcrumb_img ) && ! empty( $global_breadcrumb_img ) ) :
					$style[] = 'background-image:url(\'' . esc_url( $global_breadcrumb_img ) . '\' )';
					$has_bg_image = 'edubin-breadcrumb-has-bg';
				endif;
			elseif ( 'color' === $global_breadcrumb_type ) :
				$breadcrumb_color = Edubin::setting( 'header_banner_overlay_color' );
				if ( $breadcrumb_color ) :
					$style[] = 'background-color:' . esc_attr( $breadcrumb_color );
				endif;
			endif;
		else :
			return;
		endif;

		if ( is_page() && is_object( $post ) ) :
			$breadcrumb_visibility      = get_post_meta( get_the_ID(), '_edubin_page_header_enable', true );
			$breadcrumb_show_framework = Edubin::setting( 'page_header_show' );
			if ( 'disable' !== $breadcrumb_visibility ) :
				if ( ( 'enable' === $breadcrumb_visibility ) || ( isset( $breadcrumb_show_framework ) && ! empty( $breadcrumb_show_framework ) ) ) :
					$default_breadcrumb_at_page = true;
					$bg_meta_image      = get_post_meta( get_the_ID(), '_edubin_header_img', true );
					$bg_meta_color      = get_post_meta( get_the_ID(), '_edubin_page_title_bg_color', true );
					$bg_framework_image = get_header_image();
					$bg_framework_color = Edubin::setting( 'header_banner_overlay_color' );

					if ( $bg_meta_color ) :
						$style[] = 'background-color:' . $bg_meta_color;
					elseif ( $bg_framework_color ) :
						$style[] = 'background-color:' . $bg_framework_color;
					endif;

					if ( $bg_meta_image ) : 
						$style[] = 'background-image:url(\''.esc_url( $bg_meta_image ).'\' )';
						$has_bg_image = 'edubin-breadcrumb-has-bg'; 
					elseif ( ! $default_breadcrumb_at_page ) : 
						$breadcrumb_img   = get_header_image();
						if ( isset( $breadcrumb_img['url'] ) && ! empty( $breadcrumb_img['url'] ) ) :
							$style[] = 'background-image:url(\'' . esc_url( $breadcrumb_img['url'] ) . '\' )';
							$has_bg_image = 'edubin-breadcrumb-has-bg';
						endif;
					endif;

				else :
					return '';
				endif;
			else :
				return '';
			endif;
		
		// elseif ( is_singular( 'tp_event' ) || is_post_type_archive( 'tp_event' ) || is_tax( 'tp_event_category' ) || is_tax( 'tp_event_tags' ) ) :

		// 	$show = Edubin::setting( 'page_header_show' );
		// 	if ( ! $show ) :
		// 		return ''; 
		// 	endif;

		// 	$default_breadcrumb_at_event = edubin_set_value( 'tp_event_show_default_breadcrumb', true );

		// 	if ( $default_breadcrumb_at_event ) :
		// 		$breadcrumb_img   = edubin_set_value( 'tp_event_breadcrumb_image' );
		// 		$breadcrumb_color = edubin_set_value( 'tp_event_breadcrumb_color' );

		// 		if ( isset( $breadcrumb_img['url'] ) && ! empty( $breadcrumb_img['url'] ) ) :
		// 			$style[] = 'background-image:url(\'' . esc_url( $breadcrumb_img['url'] ) . '\' )';
		// 			$has_bg_image = 'edubin-breadcrumb-has-bg';
		// 		endif;
				
		// 		if ( $breadcrumb_color ) :
		// 			$style[] = 'background-color:' . esc_attr( $breadcrumb_color );
		// 		endif;

		// 	endif;

		// elseif ( edubin_is_lms_courses() ) :

		// 	$show = edubin_set_value( 'show_course_breadcrumb', true );
		// 	if ( ! $show ) :
		// 		return ''; 
		// 	endif;

		// 	$default_breadcrumb_at_course = edubin_set_value( 'show_default_breadcrumb_at_course', true );
		// 	if ( ! $default_breadcrumb_at_course ) :
		// 		$breadcrumb_img   = edubin_set_value( 'course_breadcrumb_image' );
		// 		$breadcrumb_color = edubin_set_value( 'course_breadcrumb_color' );

		// 		if ( isset( $breadcrumb_img['url'] ) && ! empty( $breadcrumb_img['url'] ) ) :
		// 			$style[] = 'background-image:url(\'' . esc_url( $breadcrumb_img['url'] ) . '\' )';
		// 			$has_bg_image = 'edubin-breadcrumb-has-bg';
		// 		endif;
				
		// 		if ( $breadcrumb_color ) :
		// 			$style[] = 'background-color:' . esc_attr( $breadcrumb_color );
		// 		endif;
		// 	endif;

	    // elseif ( class_exists( 'WooCommerce' ) && is_woocommerce() ) :
		// 	$show = Edubin::setting( 'show_shop_breadcrumb' );
		// 	if ( ! $show ) :
		// 		return ''; 
		// 	endif;

		// 	$default_breadcrumb_at_shop = Edubin::setting( 'default_breadcrumb_at_shop' );

		// 	if ( ! $default_breadcrumb_at_shop ) :
		// 		$breadcrumb_img   = Edubin::setting( 'shop_breadcrumb_image' );
		// 		$breadcrumb_color = Edubin::setting( 'shop_breadcrumb_color' );

		// 		if ( isset( $breadcrumb_img['url'] ) && ! empty( $breadcrumb_img['url'] ) ) :
		// 			$style[] = 'background-image:url(\'' . esc_url( $breadcrumb_img['url'] ) . '\' )';
		// 			$has_bg_image = 'edubin-breadcrumb-has-bg';
		// 		endif;

		// 		if ( $breadcrumb_color ) :
		// 			$style[] = 'background-color:' . esc_attr( $breadcrumb_color );
		// 		endif;
		// 	endif;
		
		// elseif ( is_singular( 'post' ) || is_search() || edubin_is_blog() ) :
		// 	$show = edubin_set_value( 'show_blog_breadcrumb', true );
		// 	if ( ! $show ) :
		// 		return ''; 
		// 	endif;

		// 	$default_breadcrumb_at_blog = edubin_set_value( 'default_breadcrumb_at_blog', true );

		// 	if ( ! $default_breadcrumb_at_blog ) :
				
		// 		$breadcrumb_img   = edubin_set_value( 'blog_breadcrumb_image' );
		// 		$breadcrumb_color = edubin_set_value( 'blog_breadcrumb_color' );

		// 		if ( isset( $breadcrumb_img['url'] ) && ! empty( $breadcrumb_img['url'] ) ) :
		// 			$style[] = 'background-image:url(\'' . esc_url( $breadcrumb_img['url'] ) . '\' )';
		// 			$has_bg_image = 'edubin-breadcrumb-has-bg';
		// 		endif;

		// 		if ( $breadcrumb_color ) :
		// 			$style[] = 'background-color:' . esc_attr( $breadcrumb_color );
		// 		endif;
		// 	endif;

		endif;

		$title = edubin_get_page_title();
		$extra_style = ! empty( $style ) ? ' style="' . implode( "; ", $style ) . '"' : "";

		$page_title_style = Edubin::setting( 'page_title_style' );
		if ( is_page() && is_object( $post ) ) :
			$page_breadcrumb_style = get_post_meta( get_the_ID(), '_edubin_page_title_style', true );
			if ( $page_breadcrumb_style === 'global' || empty( $page_breadcrumb_style ) || ! isset( $page_breadcrumb_style ) ) :
				$page_title_style = $page_title_style;
			else :
				$page_title_style = $page_breadcrumb_style;
			endif;
		endif;

		if ( isset( $_GET['breadcrumb_preset'] ) ) :
			$page_title_style = in_array( $_GET['breadcrumb_preset'], array( 'default', '1', '2' ) ) ? $_GET['breadcrumb_preset'] : 'default';
		endif;

		$page_title_style = apply_filters( 'edubin_breadcrumb_style', $page_title_style );
		
		if ( '1' === $page_title_style ) :
			edubin_breadcrumb_style_1( $title, $has_bg_image, $extra_style );
		elseif ( '2' === $page_title_style ) :
			edubin_breadcrumb_style_2( $title, $has_bg_image, $extra_style );
		else:
			edubin_breadcrumb_default_style( $title );
		endif;
	}
endif;

/**
 * Breadcrumb Shapes
 *
 */
if( ! function_exists( 'edubin_breadcrumb_shapes' ) ) :
	function edubin_breadcrumb_shapes() {
		$status = apply_filters( 'edubin_breadcrumb_shape', true );

		if ( $status ) :
			echo '<div class="shape-dot-wrapper shape-wrapper edubin-d-xl-block edubin-d-none">';
				echo '<div class="shape-image shape-1">';
					echo '<span></span>';
				echo '</div>';

				echo '<div class="shape-image shape-2">';
					echo '<span></span>';
				echo '</div>';

				echo '<div class="shape-image tpc-mouse-animation shape-3">';
					echo '<span data-depth="2">';
						echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/shapes/HE001.png' ) . '" alt="Breadcrumb Abstract Shape">';
					echo '</span>';
				echo '</div>';

				echo '<div class="shape-image tpc-mouse-animation shape-4">';
					echo '<span data-depth="-2">';
						echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/shapes/HE004.png' ) . '" alt="Breadcrumb Abstract Shape">';
					echo '</span>';
				echo '</div>';

				echo '<div class="shape-image tpc-mouse-animation shape-5">';
					echo '<span data-depth="2">';
						echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/shapes/HE005.png' ) . '" alt="Breadcrumb Abstract Shape">';
					echo '</span>';
				echo '</div>';
			echo '</div>';
		endif;
	}
endif;

/**
 * Breadcrumb Default Style
 */
if ( ! function_exists( 'edubin_breadcrumb_default_style' ) ) :
	function edubin_breadcrumb_default_style( $title = null, $has_bg_image = null, $extra_style = null ) {

		$header_title_tag = Edubin::setting( 'header_title_tag' );
		$header_page_title_align = Edubin::setting( 'header_page_title_align' );
		$breadcrumb_show = Edubin::setting( 'breadcrumb_show' );

		echo '<div class="edubin-page-title-area edubin-default-breadcrumb '. esc_attr( $has_bg_image ) .'"' . $extra_style .'>';
			echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';
				echo '<div class="edubin-page-title">';
					echo '<'.$header_title_tag.' class="page-title has-text-align-'.$header_page_title_align.'">';
						echo wp_kses_post( $title ); 
					echo '</'.$header_title_tag.' class="page-title">';
				echo '</div>';

				if ( $breadcrumb_show ) {
					echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
						do_action( 'edubin_breadcrumb' );
					echo '</div>';
				}
		
			echo '</div>';

			edubin_breadcrumb_shapes();
		echo '</div>';
	}
endif;

/**
 * Breadcrumb Style 1
 */
if ( ! function_exists( 'edubin_breadcrumb_style_1' ) ) :
	function edubin_breadcrumb_style_1( $title = null, $has_bg_image = null, $extra_style = null ) {

		$breadcrumb_show = Edubin::setting( 'breadcrumb_show' );

		echo '<div class="edubin-page-title-area edubin-breadcrumb-style-1 '. esc_attr( $has_bg_image ) .'"' . $extra_style .'>';
			echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

				echo '<div class="edubin-page-title">';
					echo '<h1 class="entry-title">';
						echo wp_kses_post( $title ); 
					echo '</h1>';
				echo '</div>';

				if ($breadcrumb_show) {
					echo '<div class="edubin-breadcrumb-wrapper">';
						do_action( 'edubin_breadcrumb' );
					echo '</div>';
				}

			echo '</div>';
		echo '</div>';
	}
endif;

/**
 * Breadcrumb Style 2
 */
if ( ! function_exists( 'edubin_breadcrumb_style_2' ) ) :
	function edubin_breadcrumb_style_2( $title = null, $has_bg_image = null, $extra_style = null ) {

		$breadcrumb_show = Edubin::setting( 'breadcrumb_show' );

		echo '<div class="edubin-breadcrumb-style-2">';
			echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

			if ( $breadcrumb_show ) {
				echo '<div class="edubin-breadcrumb-wrapper">';
					do_action( 'edubin_breadcrumb' );
				echo '</div>';
			}

			echo '</div>';
		echo '</div>';
	}
endif;


/**
 * Setup breadcrumb
 */
add_action( 'edubin_breadcrumb', 'edubin_breadcrumb_setup', 10 );

if ( ! function_exists( 'edubin_breadcrumb_setup' ) ) :
	function edubin_breadcrumb_setup() {
		edubin_breadcrumb_default();
	}
endif;

/**
 * page title
 */
if ( ! function_exists( 'edubin_get_page_title' ) ) :
	function edubin_get_page_title() {
		global $post;
		$title = get_the_title();

		if ( is_home() ) :
			$title = apply_filters( 'edubin_blog_page_title', __( 'Blog', 'edubin' ) );
		elseif ( is_singular( 'post' ) ) :
			$title = get_the_title();

		elseif (is_post_type_archive( 'product' )  ) :
			$wp_archive_page_title = Edubin::setting( 'wp_archive_page_title' );
			$title = $wp_archive_page_title ? $wp_archive_page_title : $title;
		elseif ( is_archive() ) :
			$title = get_the_archive_title();
			if ( is_post_type_archive( 'lp_course' ) ) :
				$lp_course_archive_page_title = Edubin::setting( 'lp_archive_page_title' );
				$title = $lp_course_archive_page_title ? $lp_course_archive_page_title : $title;
			endif;
			if ( is_post_type_archive( 'sfwd-courses' ) ) :
				$ld_course_archive_page_title = Edubin::setting( 'ld_archive_page_title' );
				$title = $ld_course_archive_page_title ? $ld_course_archive_page_title : $title;
			endif;
			if ( is_post_type_archive( 'courses' ) ) :
				$tutor_course_archive_page_title = Edubin::setting( 'tutor_archive_page_title' );
				$title = $tutor_course_archive_page_title ? $tutor_course_archive_page_title : $title;
			endif;
			if ( is_post_type_archive( 'course' ) ) :
				$sensei_course_archive_page_title = Edubin::setting( 'sensei_archive_page_title' );
				$title = $sensei_course_archive_page_title ? $sensei_course_archive_page_title : $title;
			endif;
			if ( is_post_type_archive( 'zoom-meetings' ) ) :
				$zoom_archive_page_title = Edubin::setting( 'zoom_archive_page_title' );
				$title = $zoom_archive_page_title ? $zoom_archive_page_title : $title;
			endif;
			if ( is_post_type_archive( 'tp_event' ) ) :
				$tp_event_archive_page_title = Edubin::setting( 'tp_event_archive_page_title' );
				$title = $tp_event_archive_page_title ? $tp_event_archive_page_title : $title;
			endif;
			if ( is_post_type_archive( 'tp_event' ) ) :
				$tp_event_archive_page_title = Edubin::setting( 'tp_event_archive_page_title' );
				$title = $tp_event_archive_page_title ? $tp_event_archive_page_title : $title;
			endif;
			if ( is_post_type_archive( 'tribe_events' ) ) :
				$tribe_event_archive_page_title = Edubin::setting( 'tribe_events_archive_page_title' );
				$title = $tribe_event_archive_page_title ? $tribe_event_archive_page_title : $title;
			endif;
		elseif ( is_day() ) :
			$title = get_the_time( get_option( 'date_format' ) );
		elseif ( is_month() ) :
			$title = get_the_time( 'F Y' );
		elseif ( is_year() ) :
			$title = get_the_time( 'Y' );
		elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() && ! is_author() && ! is_search() ) :
			$post_type = get_post_type_object( get_post_type() );
			if ( is_object( $post_type ) ) :
				$title = $post_type->labels->singular_name;
			endif;
		elseif ( is_attachment() ) :
			$title = get_the_title();
		elseif ( is_page() && ! $post->post_parent ) :
			$title = get_the_title();
			$page_custom_title = get_post_meta( $post->ID, '_edubin_custom_page_title', true );
			$title = $page_custom_title ? $page_custom_title : $title;
		elseif ( is_page() && $post->post_parent ) :
			$title = get_the_title();
			$page_custom_title = get_post_meta( $post->ID, '_edubin_custom_page_title', true );
			$title = $page_custom_title ? $page_custom_title : $title;
		elseif ( is_search() ) :
			if ( edubin_is_search_has_results() ) :
				$title = __( 'Search results for', 'edubin' );
			else :
				$title = __( 'Nothing Found', 'edubin' );
			endif;
		elseif ( is_tag() ) :
			$title = __( 'Posts tagged "', 'edubin' ). single_tag_title( '', false ) . '"';
		elseif ( is_author() ) :
			global $author;
			$userdata = get_userdata( $author );
			$title = $userdata->display_name;
		elseif ( is_404() ) :
			$title = __( '404: Error Not Found', 'edubin' );
		elseif ( is_singular( 'lp_course' ) ) :
			$title = get_the_title();
		elseif ( ( function_exists( 'edubin_is_lp_courses' ) && edubin_is_lp_courses() ) ) :
			$title = esc_html( get_the_title( learn_press_get_page_id( 'courses' ) ) );
		endif;
		
		return $title;
	}
endif;

/**
 * Setup breadcrumb
 */
if ( ! function_exists( 'edubin_breadcrumb_default' ) ) :
	function edubin_breadcrumb_default( $spacer = ' ', $word = '' ) {
		$main_home = __( 'Home', 'edubin' );
		$before = '<li><span class="active">';
		$after = '</span></li>';
		
		if ( ! is_front_page() || is_paged() ) :
			global $post;
			$homeURL = esc_url( home_url() );

			echo '<nav class="edubin-breadcrumb">';
				echo '<ul class="breadcrumb">';
					echo '<li><a href="' . esc_url( $homeURL ) . '">' . wp_kses_post( $main_home ) . '</a> ' . wp_kses_post( $spacer ) . '</li> ';

					if ( is_category() ) :
						global $wp_query;
						$cat_obj = $wp_query->get_queried_object();
						$thisCat = $cat_obj->term_id;
						$thisCat = get_category( $thisCat );
						$parentCat = get_category( $thisCat->parent );
						echo '<li>';
						if ( $thisCat->parent != 0 )
							echo get_category_parents( $parentCat, TRUE, '</li><li>' );
						echo '<span class="active">' . single_cat_title( '', false ) . wp_kses_post( $after );

					elseif ( is_day() ) :
						echo '<li><a href="' . esc_url( get_year_link(get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a></li> ' . wp_kses_post( $spacer ) . ' ';
						echo '<li><a href="' . esc_url( get_month_link(get_the_time( 'Y' ),get_the_time( 'm' )) ) . '">' . get_the_time( ' F' ) . '</a></li> ' . wp_kses_post( $spacer ) . ' ';
						echo trim( $before ) . get_the_time( 'd' ) . wp_kses_post( $after );

					elseif ( is_month() ) :
						echo '<a href="' . esc_url( get_year_link(get_the_time( 'Y' ) ) ) . '">' . get_the_time( 'Y' ) . '</a></li> ' . wp_kses_post( $spacer ) . ' ';
						echo trim( $before ) . get_the_time( 'F' ) . wp_kses_post( $after );
						
					elseif ( is_year() ) :
						echo trim( $before ) . get_the_time( 'Y' ) . wp_kses_post( $after );

					elseif ( is_single() && ! is_attachment() ) :
						if ( get_post_type() != 'post' ) :
							$post_type = get_post_type_object( get_post_type() );
							$slug = $post_type->rewrite;
							$slug_url = '';
							
							if ( isset( $slug['slug'] ) && ! empty( $slug['slug'] ) ) :
								$slug_url = $slug['slug'] . '/';
							endif;
							if ( is_singular( 'product' ) ) {
								echo '<li><a href="' . esc_url( $homeURL ) . $slug_url . '">' . $post_type->labels->singular_name . '</a></li> ' . $spacer . ' ';
							} else {
								echo '<li><a href="' . esc_url( $homeURL ) . '/' . $slug_url . '">' . $post_type->labels->singular_name . '</a></li> ' . $spacer . ' ';
							}

							//echo '<li><a href="' . esc_url( $homeURL ) . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a></li> ' . $spacer . ' ';
							echo trim( $before ) . get_the_title() . wp_kses_post( $after );

						elseif ( get_post_type() == 'post' ) :
							global $post;
							$cat = get_the_category(); $cat = $cat[0];
							echo '<li>'.get_category_parents($cat, TRUE, '</li><li class="hidden">');
							echo '<span class="active">'. $post->post_title . wp_kses_post( $after );

						else :
							$cat = get_the_category(); $cat = $cat[0];
							echo '<li>'.get_category_parents($cat, TRUE, '</li>');
						endif;
					elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() && ! is_author() && ! is_search() ) :
						$post_type = get_post_type_object( get_post_type() );
						if ( is_object( $post_type ) ) :
							echo trim( $before ) . $post_type->labels->singular_name . wp_kses_post( $after );
						endif;

					elseif ( is_404() ) :
						echo trim( $before) . __( 'Error 404', 'edubin' ) . wp_kses_post( $after );

					elseif ( is_attachment() ) :
						$parent = get_post($post->post_parent);
						$cat = get_the_category($parent->ID);
						echo '<li>';

						if ( ! empty( $cat ) ) :
							$cat = $cat[0];
							echo get_category_parents($cat, TRUE, '</li><li>');
						endif;

						if ( ! empty( $parent ) ) :
							echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . $parent->post_title . '</a></li><li>';
						endif;
						echo '<span class="active">'.get_the_title() . wp_kses_post( $after );

					elseif ( is_page() ) :
						$page_custom_title = get_post_meta( get_the_ID(), '_edubin_custom_page_title', true );
						$page_custom_sub_title = get_post_meta( get_the_ID(), '_edubin_custom_page_breadcrumb', true );
						$page_custom_title = $page_custom_sub_title ? $page_custom_sub_title : $page_custom_title;
						if ( ! $post->post_parent ) :
							if ( $page_custom_title ) :
								echo trim( $before ) . esc_html( $page_custom_title ) . wp_kses_post( $after );
							else :
								echo trim( $before ) . get_the_title() . wp_kses_post( $after );
							endif;
						elseif ( $post->post_parent ) :
							$parent_id  = $post->post_parent;
							$breadcrumbs = array();
							while ( $parent_id ) :
								$page = get_page( $parent_id );
								$breadcrumbs[] = '<li><a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a></li>';
								$parent_id  = $page->post_parent;
							endwhile;

							$breadcrumbs = array_reverse($breadcrumbs);
							foreach ( $breadcrumbs as $breadcrumb ) :
								echo trim( $breadcrumb ) . ' ' . $spacer . ' ';
							endforeach;
							if ( $page_custom_title ) :
								echo trim( $before ) . esc_html( $page_custom_title ) . wp_kses_post( $after );
							else :
								echo trim( $before ) . get_the_title() . wp_kses_post( $after );
							endif;
						endif;

					elseif ( is_search() ) :
						echo trim( $before ) . sprintf( __( 'Search results for "%s"', 'edubin' ), get_search_query() ) . wp_kses_post( $after );

					elseif ( is_tag() ) :
						echo trim( $before ) . sprintf( __( 'Posts tagged "%s"', 'edubin' ), single_tag_title( '', false ) ) . wp_kses_post( $after );

					elseif ( is_author() ) :
						global $author;
						$userdata = get_userdata($author);
						echo trim( $before ) . __( 'Articles posted by ', 'edubin' ) . $userdata->display_name . wp_kses_post( $after );

					elseif ( is_404() ) :
						echo trim( $before ) . __( 'Error 404', 'edubin' ) . wp_kses_post( $after );

					elseif ( is_home() ) :
						$posts_page_id = get_option( 'page_for_posts');
						if ( $posts_page_id ) :
							$label = get_the_title( $posts_page_id );
						else :
							$label = __( 'Blog', 'edubin' );
						endif;
						echo trim( $before ) . $label . wp_kses_post( $after );
					endif;
				echo '</ul>';
			echo '</nav>';
		endif;
	}
endif;

/**
 * Setup breadcrumb Alter
 */
if ( ! function_exists( 'edubin_breadcrumb_default_alt' ) ) :
	function edubin_breadcrumb_default_alt( $word = '' ) {
	 	echo '<nav class="edubin-breadcrumb">';
			echo '<ul class="breadcrumb">';
				if ( ! is_home() ) :
					echo '<li><a href="' . esc_url( get_home_url( '/' ) ) . '">' . __( 'Home', 'edubin' ) . '</a></li>';

					if ( is_category() || is_single() ) :
						echo '<li>';
							$category	 = get_the_category();
							$post		 = get_queried_object();
							$postType	 = get_post_type_object( get_post_type( $post ) );
						
							if ( ! empty( $category ) ) :
								echo esc_html( $category[ 0 ]->cat_name ) . '</li>';
							elseif ( defined( 'LP_COURSE_CPT' ) && is_category() ) :
								single_cat_title() . '</li>';
							elseif ( $postType ) :
								echo esc_html( $postType->labels->singular_name ) . '</li>';
							endif;

						if ( is_single() ) :
							echo  '<li>';
								echo esc_html( $word ) != '' ? wp_trim_words( get_the_title(), $word ) : get_the_title();
							echo '</li>';
						endif;
						
					elseif ( is_page() ) :
						echo '<li>';
							$page_custom_title = get_post_meta( get_the_ID(), '_edubin_custom_page_title', true );
							$page_custom_sub_title = get_post_meta( get_the_ID(), '_edubin_custom_page_breadcrumb', true );
							if ( $page_custom_title || $page_custom_sub_title ) :
								if ( $page_custom_sub_title ) :
									echo esc_html( $page_custom_sub_title  );
								else :
									echo esc_html( $page_custom_title );
								endif;
							else :
								echo esc_html( $word ) != '' ? wp_trim_words( get_the_title(), $word ) : get_the_title();
							endif;
						echo '</li>';
					endif;
				endif;

				if ( function_exists( 'tutor' ) ) :
					$course_post_type = tutor()->course_post_type;
					
					if ( $course_post_type === 'courses' && is_post_type_archive( 'courses' ) ) :
						echo '<li>' . __( ' Courses', 'edubin' ) . '</li>';	
					endif;
				endif;

				if ( is_post_type_archive( 'simple_team' ) ) :
				  	echo '<li>' . __( ' Team', 'edubin' ) . '</li>';	
				endif;

				if ( is_post_type_archive( 'product' ) ) :
				  	echo '<li>' . __( ' Products', 'edubin' ) . '</li>';	
				endif;

				if ( is_tag() ) :
					echo '<li>'; 
						echo sprintf( __( 'Posts tagged "%s"', 'edubin' ), single_tag_title( '', false ) );
					echo '</li>';
				elseif ( is_day() ) :
					echo '<li>' . __( 'Blogs for', 'edubin' ) . ' ';
						the_time( 'F jS, Y' );
					echo '</li>';
				elseif ( is_month() ) :
					echo'<li>' . __( 'Blogs for', 'edubin' ) . ' ';
						the_time( 'F, Y' );
					echo'</li>';
				elseif ( is_year() ) :
					echo'<li>' . __( 'Blogs for', 'edubin' ) . ' ';
						the_time( 'Y' );
					echo'</li>';
				elseif ( is_author() ) :
					global $author;
					$userdata = get_userdata( $author );
					echo'<li>';
						echo __( 'Articles posted by ', 'edubin' ) . $userdata->display_name;
					echo'</li>';
				elseif ( isset( $_GET[ 'paged' ] ) && !empty( $_GET[ 'paged' ] ) ) :
					echo '<li>' . __( 'Blogs', 'edubin' ) . '</li>';
				elseif ( is_search() ) :
					echo '<li>' . sprintf( __( 'Search results for "%s"', 'edubin' ), get_search_query() ) . '</li>';
				elseif ( is_404() ) :
					echo '<li>' . __( '404: Error Not Found', 'edubin' ) . '</li>';
				elseif ( is_home() ) :
					echo '<li>' . __( 'Blog Page', 'edubin') . '</li>';
				elseif ( ! is_single() && ! is_page() && get_post_type() != 'post' && ! is_404() && ! is_author() && ! is_search() ) :
					$post_type = get_post_type_object( get_post_type() );
					if ( is_object( $post_type ) ) :
						echo '<li>' . $post_type->labels->singular_name . '</li>';
					endif;
				endif;
			echo '</ul>';
		echo '</nav>';
	}
endif;

if( ! function_exists( 'edubin_login_register_form_popup' ) ) :
	function edubin_login_register_form_popup() { 
		if( is_user_logged_in() || ( ! Edubin::setting( 'login_popup_active' ) ) ) return;

		echo '<div id="edubin-custom-login-wrapper" class="edubin-login-form-popup">';
            echo '<div class="edubin-login-form-inner">';
				echo '<div class="edubin-login-popup-close"><button class="close-trigger"><i class="flaticon-cancel"></i></button></div>';
				echo '<div class="edubin-login-form-content">';
					echo '<div id="edubin-login-form-wrapper" class="edubin-login-form-wrapper">';
						echo '<div class="edubin-login-form-tab-wrapper">';
							echo '<div class="edubin-login-form-tab">';
								echo '<span class="login-tab-title login-item active" data-tab-id="tab1">' . __( 'Sign in', 'edubin' ) . '</span>';
								echo '<span class="login-tab-title register-item" data-tab-id="tab2">' . __( 'Sign up', 'edubin' ) . '</span>';
							echo '</div>';
						echo '</div>';

						echo '<div class="edubin-login-form-items">';
							echo '<div class="edubin-login-form-item login-form" id="tab1">';
								echo '<div class="edubin-login-box-text">';
									echo '<h3 class="sign-in-heading">' . __( 'Sign in', 'edubin' ) . '</h3>';

									echo '<div class="edubin-register-text">';
										echo '<span class="note-for-non-account-user">';
											echo __( 'Don’t have an account?', 'edubin' );
										echo '</span>';
										echo '<span id="edubin-register-form-trigger">';
											echo ' ' . __( 'Sign up', 'edubin' );
										echo '</span>';
									echo '</div>';
								echo '</div>';

								echo '<form action="' . esc_url( wp_login_url() ) . '" class="edubin-login-form-container" method="post">';
									echo '<div class="edubin-login-item">';
										echo '<input type="text" name="log" id="username" placeholder="' . __( 'Email or username', 'edubin' ) . '" required>';
									echo '</div>';

									echo '<div class="edubin-login-item">';
										echo '<input type="password" name="pwd" id="password" placeholder="' . __( 'Password', 'edubin' ) . '" required>';
									echo '</div>';

									echo '<div class="remember-me-with-register">';
										echo '<label class="forgetmenot">';
											echo '<input name="rememberme" class="remember-user" type="checkbox" id="rememberme" value="forever">';
											echo '<span class="remember-me-text">' . __( 'Remember me', 'edubin' ) . '</span>';
										echo '</label>';

										echo '<a href=' . esc_url( wp_lostpassword_url() ) . '" class="lost_password">' . __( 'Lost your password?', 'edubin' ) . '</a>';
									echo '</div>';

									echo '<div class="edubin-login-register-button button-login">';
										echo '<div class="edubin-login-register-wrapper">';
											echo '<input type="submit" value="' . __( 'Sign in', 'edubin' ) . '" class="edubin-submit-button login">';
										echo '</div>';
									echo '</div>';
								echo '</form>';
							echo '</div>';

							echo '<div class="edubin-login-form-item register-form" id="tab2">';
								echo '<div class="edubin-register-box-text">';
									echo '<h3 class="sign-up-heading">' . __( 'Sign up', 'edubin' ) . '</h3>';

									echo '<div class="edubin-login-text">';
										echo '<span class="note-for-account-user">';
											echo __( 'Already have an account?', 'edubin' );
										echo '</span>';
										echo '<span id="edubin-login-form-trigger">';
											echo ' ' . __( 'Sign in', 'edubin' );
										echo '</span>';
									echo '</div>';
								echo '</div>';

								echo '<form action="' . esc_url( wp_registration_url() ) . '" class="edubin-register-form-container" method="post">';
									echo '<div class="edubin-login-item">';
										echo '<input type="text" name="user_login" id="reg_username" placeholder="' . __( 'Username', 'edubin' ) . '" required>';
									echo '</div>';

									echo '<div class="edubin-login-item">';
										echo '<input type="email" name="user_email" id="reg_email" placeholder="' . __( 'Email', 'edubin' ) . '" required>';
									echo '</div>';
									
									echo '<div class="edubin-login-item">';
										echo '<input type="password" name="user_pass" id="reg_password" placeholder="' . __( 'Password', 'edubin' ) . '" required>';
									echo '</div>';

									do_action( 'register_form' );

									echo '<div class="edubin-login-register-button button-register">';
										echo '<div class="edubin-login-register-wrapper">';
											echo '<input type="submit" value="' . __( 'Sign up', 'edubin' ) . '" class="edubin-submit-button register">';
										echo '</div>';
									echo '</div>';
								echo '</form>';
							echo '</div>';
						echo '</div>';
					echo '</div>';
				echo '</div>';
            echo '</div>';
        echo '</div>';

		echo '<div class="edubin-login-popup-overlay">';
	}
endif;

/**
 * Edubin Footer Content
 */
if ( ! function_exists( 'edubin_footer_content_init' ) ) :
	function edubin_footer_content_init() {
		// search modal popup
 		$search_type = Edubin::setting( 'edubin_search_style' );
 		
		if ($search_type == 'tpc_tutor_search') {
		    edubin_lms_course_search_modal_popup();
		} elseif ($search_type == 'tpc_lp_search') {
		    edubin_lms_course_search_modal_popup();
		} elseif ($search_type == 'tpc_ld_search') {
		    edubin_lms_course_search_modal_popup();
		} else {
		    edubin_whole_search_modal_popup();
		}
		
		// scroll to top
		$back_to_top_show = Edubin::setting( 'back_to_top_show' );
		
		if ( $back_to_top_show ) :
			echo '<div class="pixelcurve-progress-parent">';
				echo '<svg class="pixelcurve-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">';
					echo '<path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />';
				echo '</svg>';
			echo '</div>';
		endif;

		// login register form popup
		if ( Edubin::setting( 'login_popup_active' ) ) :
			edubin_login_register_form_popup();
		endif;
	}
endif;
add_action( 'wp_footer', 'edubin_footer_content_init' );

/**
 * is Search has result
 */
if ( ! function_exists( 'edubin_is_search_has_results' ) ) :
	function edubin_is_search_has_results() {
	    return 0 != $GLOBALS['wp_query']->found_posts;
	}
endif;

/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
if ( ! function_exists( 'edubin_main_fonts_url' ) ) :
	function edubin_main_fonts_url() {
		$body_typo_array = Edubin::setting( 'edubin_body_text_font' );
		$heading_typo_array = Edubin::setting( 'edubin_heading_font' );
		$body_font_family = 'Open Sans';
		$heading_font_family = 'Heebo';

		if ( isset( $body_typo_array['font-family'] ) && ! empty( $body_typo_array['font-family'] ) ) :
			$body_font_family = $body_typo_array['font-family'];
		endif;

		if ( isset( $heading_typo_array['font-family'] ) && ! empty( $heading_typo_array['font-family'] ) ) :
			$heading_font_family = $heading_typo_array['font-family'];
		endif;

	    $fonts_url = '';
	    $fonts     = array();
	    $subsets   = 'latin,latin-ext';
	    if ( 'off' !== esc_html_x( 'on', $body_font_family . ' font: on or off', 'edubin' ) ) :
	        $fonts[] = $body_font_family . ':300,400,500,600,700,800';
	    endif;
		
	    if ( 'off' !== esc_html_x( 'on', $heading_font_family . ' font: on or off', 'edubin' ) ) :
	        $fonts[] = $heading_font_family . ':300,400,500,600,700,800';
	    endif;

	    if ( $fonts ) :
	        $fonts_url = add_query_arg( array(
	            'family' => urlencode( implode( '|', $fonts ) ),
	            'subset' => urlencode( $subsets ),
	        ), 'https://fonts.googleapis.com/css' );
	    endif;
	    return esc_url_raw( $fonts_url );
	}
endif;

// Enqueue Google Fonts styles
add_action( 'wp_enqueue_scripts', 'edubin_google_fonts_adding' );
if ( ! function_exists( 'edubin_google_fonts_adding' ) ) :
	function edubin_google_fonts_adding() {
	    wp_enqueue_style( 'edubin-main-fonts', edubin_main_fonts_url(), array(), EDUBIN_THEME_VERSION );
	}
endif;

/**
 * Excerpt more
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_excerpt_more' ) ) :
	function edubin_excerpt_more( $more ) {
	    return '&#8230;';
	}
endif;
add_filter( 'excerpt_more', 'edubin_excerpt_more' );

/**
 * Edubin Post Archive Support For Theme Option
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_has_archive_theme_option_support' ) ) :
	function edubin_has_archive_theme_option_support () {
		$supported = [
			'lp_course',
			'product'
		];
		return $supported;
	}
endif;

/**
 * is Blog
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_is_blog' ) ) :
	function edubin_is_blog () {
		global $post;
		$posttype = get_post_type( $post );
		return ( ( ( is_archive() ) || ( is_author() ) || ( is_category() ) || ( is_home() ) || ( is_single() ) || ( is_tag() ) || ( is_search() ) ) && ( ! in_array( $posttype, edubin_has_archive_theme_option_support() ) ) ) ? true : false ;
	}
endif;

/**
 * Page Layout setup
 *
 * @since 1.0.0
 */
add_filter( 'edubin_container_class', 'edubin_page_layout_setup' );
if ( ! function_exists( 'edubin_page_layout_setup' ) ) :
	function edubin_page_layout_setup( $class ) {
		if ( is_page() ) :
			$page_layout = get_post_meta( get_the_ID(), '_edubin_page_container', true );
			if ( 'full-width' === $page_layout ) :
            	$class = ' edubin-fullwidth-page-container';
            else :
            	$class = ' edubin-page-container edubin-container';
            endif;
		endif;

		if ( is_singular( 'elementor_library' ) ) :
			$class = ' edubin-elementor-fullwidth-page-container';
		endif;

		return $class;
	}
endif;

/**
 * Before Content
 *
 * @since 1.0.0
 */
add_action( 'edubin_before_content', 'edubin_before_main_content' );
if ( ! function_exists( 'edubin_before_main_content' ) ) :
	function edubin_before_main_content(){
		$layout_type = '';

		if ( true === edubin_is_blog() ) :
			$layout_type = ' edubin-row';
		endif;

		if ( is_post_type_archive( 'zoom-meetings' ) ) :
			$layout_type = ' edubin-blog-post-archive-style-1 edubin-row';
		endif;

		if ( is_page() ) :
			$page_layout = get_post_meta( get_the_ID(), '_edubin_page_container', true );
			if ( 'full-width' === $page_layout ) :
            	$layout_type = ' edubin-fullwidth-page-row';
            else :
            	$layout_type = ' edubin-row';
            endif;
		endif;

		if ( is_404() ) :
			$layout_type = ' edubin-row edubin-justify-content-center';
		endif;

		if ( is_search() ) :
			$layout_type = ' edubin-row';
		endif;
		
		if ( is_singular( 'elementor_library' ) ) :
			$layout_type = '';
		endif;

		if ( is_post_type_archive( 'product' ) || is_post_type_archive( 'tp_event' ) || is_tax( 'tp_event_category' ) || is_tax( 'tp_event_tag' ) ) :
			$layout_type = '';
		endif;

		if ( function_exists( 'tml_get_action' ) ) :
			if ( tml_get_action() ) :
				$layout_type = ' edubin-row edubin-justify-content-center';
			endif;
		endif;

		echo '<div class="edubin-main-content-inner' . esc_attr( apply_filters( 'edubin_main_content_inner', $layout_type ) ) . '">';
	}
endif;

/**
 * After Content
 *
 * @since 1.0.0
 */
add_action( 'edubin_after_content', 'edubin_after_main_content' );
if ( ! function_exists( 'edubin_after_main_content' ) ) :
	function edubin_after_main_content(){
		echo '</div>';
	}
endif;

/**
 * Content area class
 *
 * @since 1.0.0
 */
add_filter( 'edubin_content_area_class', 'edubin_content_wrapper_class' );
if ( ! function_exists( 'edubin_content_wrapper_class' ) ) :
	function edubin_content_wrapper_class ( $class ) {

		if ( edubin_is_blog() ) :

			$blog_layout = Edubin::setting( 'blog_sidebar' );
			$blog_sidebar = Edubin::setting( 'blog_archive_sidebar_name' );
			$blog_sidebar_width = Edubin::setting( 'blog_sidebar_width' );

			$blog_clm = ($blog_sidebar_width == '4') ? '8' : '9' ;

			if ( isset( $_GET['sidebar_disable'] ) ) :
				$blog_sidebar = 'no-sidebar';
			endif;

			if ( ! is_active_sidebar( $blog_sidebar ) ) :
				$class = 'edubin-col-lg-12';
			elseif ( 'right-sidebar' === $blog_layout ) :
				$class = 'edubin-col-lg-' .$blog_clm. '';
			elseif ( 'left-sidebar' === $blog_layout ) :
				$class = 'edubin-col-lg-' .$blog_clm. ' edubin-order-2';
			elseif ( 'no-sidebar' === $blog_layout ) :
				$class = 'edubin-col-lg-12';
			endif;
		endif;

		if ( is_single() ) :

			$single_layout = Edubin::setting( 'blog_single_sidebar' );
			$single_sidebar = Edubin::setting( 'blog_single_sidebar_name' );

			$blog_single_sidebar_width = Edubin::setting( 'blog_single_sidebar_width' );

			$blog_single_clm = ($blog_single_sidebar_width == '4') ? '8' : '9' ;

			if ( ! is_active_sidebar( $single_sidebar ) ) :
				$class = 'edubin-col-lg-12';
			elseif ( 'right-sidebar' === $single_layout ) :
				$class = 'edubin-col-lg-'. $blog_single_clm .'';
			elseif ( 'left-sidebar' === $single_layout ) :
				$class = 'edubin-col-lg-'. $blog_single_clm .' edubin-order-2';
			elseif ( 'no-sidebar' === $single_layout ) :
				$class = 'edubin-col-lg-12';
			endif;
		endif;

		if ( is_single() && 'simple_team' === get_post_type() ) :
			$class = 'edubin-col-lg-12';
		endif;

		if ( is_page() ) :

			$content_type = get_post_meta( get_the_ID(), '_edubin_page_content_layout', true );
			$page_layout  = get_post_meta( get_the_ID(), '_edubin_page_container', true );
			$page_sidebar  = get_post_meta( get_the_ID(), '_edubin_page_sidebar_id', true );

			$edubin_page_sidebar_width = get_post_meta( get_the_ID(), '_edubin_page_sidebar_width', true );
			$page_clm = ( $edubin_page_sidebar_width == '4') ? '8' : '9' ;


			if ( isset( $page_layout ) && ! empty( $page_layout ) ) :
				if ( 'full-width' === $page_layout ) :
					$class = 'edubin-col-lg-12';
				else :
					if ( ! is_active_sidebar( $page_sidebar ) ) :
						$class = 'edubin-col-lg-12';
					elseif ( 'right-sidebar' === $content_type ) :
						$class = 'edubin-col-lg-'. $page_clm .'';
					elseif ( 'left-sidebar' === $content_type ) :
						$class = 'edubin-col-lg-'. $page_clm .' edubin-order-2';
					elseif ( 'no-sidebar' === $content_type ) :
						$class = 'edubin-col-lg-12';
					endif;
				endif;
			else : 
				$class = 'edubin-col-lg-12';
			endif;
		endif;

		return $class;
	}
endif;

/**
 * Widget area class
 */
add_filter( 'edubin_get_widget_class', 'edubin_widget_wrapper_class' );
if ( ! function_exists( 'edubin_widget_wrapper_class' ) ) :
	function edubin_widget_wrapper_class ( $class ) {

		if ( edubin_is_blog() ) :

			$blog_layout = Edubin::setting( 'blog_sidebar' );

			$blog_sidebar_width = Edubin::setting( 'blog_sidebar_width' );
			$blog_clm = ($blog_sidebar_width == '4') ? '4' : '3' ;

			if ( 'right-sidebar' === $blog_layout ) :
				$class = 'edubin-col-lg-' .$blog_clm .'';
			elseif ( 'left-sidebar' === $blog_layout ) :
				$class = 'edubin-col-lg-' .$blog_clm .' edubin-order-1';
			elseif ( 'no-sidebar' === $blog_layout ) :
				$class = '';
			endif;
		endif;

		if ( is_single() ) :

			$single_layout = Edubin::setting( 'blog_single_sidebar' );

			$blog_single_sidebar_width = Edubin::setting( 'blog_single_sidebar_width' );

			$blog_single_clm = ($blog_single_sidebar_width == '4') ? '4' : '3' ;

			if ( 'right-sidebar' === $single_layout ) :
				$class = 'edubin-col-lg-'. $blog_single_clm .'';
			elseif ( 'left-sidebar' === $single_layout ) :
				$class = 'edubin-col-lg-'. $blog_single_clm .' edubin-order-1';
			elseif ( 'no-sidebar' === $single_layout ) :
				$class = '';
			endif;
		endif;

		if ( is_page() ) :

			$content_type = get_post_meta( get_the_ID(), '_edubin_page_content_layout', true );
			$edubin_page_sidebar_width = get_post_meta( get_the_ID(), '_edubin_page_sidebar_width', true );

			$page_sidebar_width = ( $edubin_page_sidebar_width == '4') ? '4' : '3' ;

			if ( 'right-sidebar' === $content_type ) :
				$class = 'edubin-col-lg-'. $page_sidebar_width .'';
			elseif ( 'left-sidebar' === $content_type ) :
				$class = 'edubin-col-lg-'. $page_sidebar_width .' edubin-order-1';
			elseif ( 'no-sidebar' === $content_type ) :
				$class = '';
			endif;
		endif;
		
		return $class;
	}
endif;

/**
 * Widget sticky class
 */
add_filter( 'edubin_get_widget_sticky_class', 'edubin_widget_sticky_class' );
if ( ! function_exists( 'edubin_widget_sticky_class' ) ) :
	function edubin_widget_sticky_class ( $class ) {

		if ( edubin_is_blog() ) :

			$blog_layout = Edubin::setting( 'blog_sidebar' );

			$blog_sidebar_sticky = Edubin::setting( 'blog_sidebar_sticky' );
			$do_blog_sticky = ($blog_sidebar_sticky ) ? 'do_sticky' : '' ;

			if ( 'right-sidebar' === $blog_layout ) :
				$class = $do_blog_sticky;
			elseif ( 'left-sidebar' === $blog_layout ) :
				$class = $do_blog_sticky;
			elseif ( 'no-sidebar' === '' ) :
				$class = '';
			endif;
		endif;

		if ( is_single() ) :

			$single_layout = Edubin::setting( 'blog_single_sidebar' );

			$blog_single_sidebar_sticky = Edubin::setting( 'blog_single_sidebar_sticky' );
			$do_blog_single_sticky = ($blog_single_sidebar_sticky ) ? 'do_sticky' : '' ;

			if ( 'right-sidebar' === $single_layout ) :
				$class = $do_blog_single_sticky;
			elseif ( 'left-sidebar' === $single_layout ) :
				$class = $do_blog_single_sticky;
			elseif ( 'no-sidebar' === $single_layout ) :
				$class = '';
			endif;
		endif;

		if ( is_page() ) :

			$content_type = get_post_meta( get_the_ID(), '_edubin_page_content_layout', true );
			$edubin_page_sidebar_sticky = get_post_meta( get_the_ID(), '_edubin_page_sidebar_sticky', true );

			$do_page_sticky = ( $edubin_page_sidebar_sticky == 'enable') ? 'do_sticky' : '' ;

			if ( 'right-sidebar' === $content_type ) :
				$class = $do_page_sticky;
			elseif ( 'left-sidebar' === $content_type ) :
				$class = $do_page_sticky;
			elseif ( 'no-sidebar' === $content_type ) :
				$class = '';
			endif;
		endif;
		
		return $class;
	}
endif;

/**
 * Sidebar Name
 */
add_filter( 'edubin_get_sidebar', 'edubin_sidebar_name' );
if ( ! function_exists( 'edubin_sidebar_name' ) ) :
	function edubin_sidebar_name ( $sidebar_layout ) {
		if ( edubin_is_blog() ) :
			$sidebar_layout = Edubin::setting( 'blog_archive_sidebar_name' );
		endif;
		if ( is_single() ) :
			$sidebar_layout = Edubin::setting( 'blog_single_sidebar_name' );
		endif;
		if ( is_page() ) :
			$sidebar_layout  = get_post_meta( get_the_ID(), '_edubin_page_sidebar_id', true );
		endif;
		return $sidebar_layout;
	}
endif;

/**
 *  page footer wrapper class
 *  action located at content-page.php
 *
 * @since 1.0.0
 */
add_action( 'edubin_page_footer_wrapper_class', 'edubin_page_footer_wrapper_class_setup' );
if ( ! function_exists( 'edubin_page_footer_wrapper_class_setup' ) ) :
	function edubin_page_footer_wrapper_class_setup(){
		$class = '';		
		if ( is_page() ) :
			$content_type = 'boxed';

			if ( $content_type && $content_type == 'boxed' ) :
				$class = '';
			else :
				$class = ' edubin-container';
			endif;
		endif;

		echo esc_attr( $class );
	}
endif;

/**
 *  Author bio
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_author_bio' ) ) :
	function edubin_author_bio() {
		$description 	= get_the_author_meta( 'description' );
		$user_url	 	= get_the_author_meta( 'user_url' );

		if ( ! empty( $description ) ) :
			echo '<div class="edubin-author-bio">';
				echo '<div class="edubin-author-thumb">';
				    echo '<a href="' . esc_url( $user_url ) . '">' . get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'edubin_author_thumb_size', 200 ) ) . '</a>';
				echo '</div>';

				echo '<div class="edubin-author-details">';
				    echo '<h5>' . esc_html( get_the_author() ) . '</h5>';

					echo '<div class="edubin-author-info">';
				    	echo wpautop( wp_kses_post( $description ) );
					echo '</div>';

					echo '<div class="edubin-editor-social-info">';
						edubin_user_social_icons( get_the_author_meta( 'ID' ) );
					echo '</div>';
				echo '</div>';
			echo '</div>';	    
		endif;
	}
endif;

/**
 * Link Pages Bootstrap
 * @author toscha
 * @link http://wordpress.stackexchange.com/questions/14406/how-to-style-current-page-number-wp-link-pages
 * @param  array $args
 * @return void
 * Modification of wp_link_pages() with an extra element to highlight the current page.
 */

if ( ! function_exists( 'edubin_link_pages' ) ):
	function edubin_link_pages( $args = array () ) {
	    $defaults = array(
			'before'         => '<nav class="edubin-paignation"><ul class="edubin-custom-pagination">',
			'after'          => '</ul></nav>',
			'before_link'    => '<li>',
			'after_link'     => '</li>',
			'current_before' => '<li class="active">',
			'current_after'  => '</li>',
			'link_before'    => '',
			'link_after'     => '',
			'pagelink'       => '%',
			'echo'           => 1
	    );
	    $r = wp_parse_args( $args, $defaults );
	    $r = apply_filters( 'wp_link_pages_args', $r );
	    extract( $r, EXTR_SKIP );

	    global $page, $numpages, $multipage, $more, $pagenow;
	    if ( ! $multipage ) :
	        return;
	    endif;

	    $output = $before;
	    for ( $i = 1; $i < ( $numpages + 1 ); $i++ ) :
	        $j       = str_replace( '%', $i, $pagelink );
	        $output .= ' ';
	        if ( $i != $page || ( ! $more && 1 == $page ) ) :
	            $output .= "{$before_link}" . _wp_link_page( $i ) . "{$link_before}{$j}{$link_after}</a>{$after_link}";
	        else :
	            $output .= "{$current_before}{$link_before}<span>{$j}</span>{$link_after}{$current_after}";
	        endif;
	    endfor;
	    print wp_kses_post( $output ) . wp_kses_post( $after );
	}
endif;


/**
 * WordPress Bootstrap pagination
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_numeric_pagination' ) ) :
    function edubin_numeric_pagination( $args = array() ) {
        
        $defaults = array(
            'range'           => 4,
            'custom_query'    => FALSE,
            'previous_string' => '<i class="edubin-pagination-icon flaticon-back-1"></i>',
            'next_string'     => '<i class="edubin-pagination-icon flaticon-next"></i>',
            'before_output'   => '<nav class="edubin-pagination-wrapper"><ul class="page-number">',
            'after_output'    => '</ul></nav>'
        );
        
        $args = wp_parse_args( 
            $args, 
            apply_filters( 'wp_bootstrap_pagination_defaults', $defaults )
        );
        
        $args['range'] = (int) $args['range'] - 1;
        if ( !$args['custom_query'] )
            $args['custom_query'] = $GLOBALS['wp_query'];
        $count = (int) $args['custom_query']->max_num_pages;
        $page  = intval( get_query_var( 'paged' ) );
        $ceil  = ceil( $args['range'] / 2 );
        
        if ( $count <= 1 )
            return FALSE;
        
        if ( !$page )
            $page = 1;
        
        if ( $count > $args['range'] ) :
            if ( $page <= $args['range'] ) :
                $min = 1;
                $max = $args['range'] + 1;
            elseif ( $page >= ($count - $ceil) ) :
                $min = $count - $args['range'];
                $max = $count;
            elseif ( $page >= $args['range'] && $page < ($count - $ceil) ) :
                $min = $page - $ceil;
                $max = $page + $ceil;
            endif;
        else :
            $min = 1;
            $max = $count;
        endif;
        
        $echo = '';
        $previous = intval($page) - 1;
        $previous = esc_attr( get_pagenum_link($previous) );
        
        if ( $previous && (1 != $page) )
        	$echo .= sprintf ( '<li><a class="page-numbers" href="%s" title="%s">%s</a></li>', esc_url( $previous ), __( 'previous', 'edubin' ), $args['previous_string'] );
        
        if ( ! empty( $min ) && ! empty( $max ) ) :
            for( $i = $min; $i <= $max; $i++ ) :
                if ( $page == $i ) :
                    $echo .= sprintf ( '<li class="active"><span class="page-numbers current">%s</span></li>', esc_html( (int)$i ) );
                else :
                    $echo .= sprintf( '<li><a class="page-numbers" href="%s">%2d</a></li>', esc_attr( get_pagenum_link($i) ), $i );
                endif;
            endfor;
        endif;
        
        $next = intval($page) + 1;
        $next = esc_attr( get_pagenum_link( $next ) );
        if ($next && ($count != $page) )
        	$echo .= sprintf ( '<li><a class="page-numbers" href="%s" title="%s">%s</a></li>', esc_url( $next ), __( 'next', 'edubin' ), $args['next_string'] );
        
        if ( isset($echo) )
            echo wp_kses_post( $args['before_output'] ) . $echo . wp_kses_post( $args['after_output'] );
    }
endif;

/**
 * Pagination RTL support
 *
 * @since 1.0.0
 */

add_filter( 'wp_bootstrap_pagination_defaults', 'edubin_pagination_rtl_support' );

if ( ! function_exists( 'edubin_pagination_rtl_support' ) ) :
	function edubin_pagination_rtl_support($args) {
	  	if ( is_rtl() ) :
		   $args['next_string']   = '<i class="edubin-pagination-icon flaticon-back-1"></i>';
		   $args['previous_string']  = '<i class="edubin-pagination-icon flaticon-next"></i>';
		endif;
		return $args;
	}
endif;


/**
 * Comment list walker
 * A custom WordPress comment walker class to implement the Bootstrap 3 Media object in wordpress comment list.
 * @package     WP Bootstrap Comment Walker
 * @version     1.0.0
 * @author      Edi Amin <to.ediamin@gmail.com>
 * @license     http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link        https://github.com/ediamin/wp-bootstrap-comment-walker
 */

if ( ! class_exists( 'Edubin_Comment_Walker' ) ) :
	class Edubin_Comment_Walker extends Walker_Comment {
		/**
		 * Output a comment in the HTML5 format.
		 *
		 * @access protected
		 * @since 1.0.0
		 *
		 * @see wp_list_comments()
		 *
		 * @param object $comment Comment to display.
		 * @param int    $depth   Depth of comment.
		 * @param array  $args    An array of arguments.
		 */
		protected function html5_comment( $comment, $depth, $args ) {
			$tag       = ( 'div' === $args['style'] ) ? 'div' : 'li';
			$commenter = wp_get_current_commenter();
		    if ( $commenter['comment_author_email'] ) :
		        $moderation_note = __( 'Your comment is awaiting moderation.', 'edubin' );
		    else :
		        $moderation_note = __( 'Your comment is awaiting moderation. This is a preview, your comment will be visible after it has been approved.', 'edubin' );
		    endif;
			?>		
			<<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent edubin-media edubin-comment-item' : 'edubin-media edubin-comment-item' ); ?>>

			<article id="comment-<?php comment_ID(); ?>" class="edubin-single-comment <?php echo esc_attr( get_avatar($comment) ? 'edubin-comment-has-avatar' : 'edubin-comment-no-avatar' ); ?>">
				<div class="edubin-comment-each-item">
					<?php if ( get_avatar( $comment ) && 0 != $args['avatar_size'] ): ?>
						<div class="edubin-comment-avatar">
							<a href="<?php echo esc_url( esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ); ?>" class="edubin-media-object">
								<?php echo get_avatar( $comment, $args['avatar_size'] ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="edubin-media-body">
						<div class="edubin-comment-header">
							<h4 class="edubin-media-heading">
								<?php echo get_comment_author_link(); ?>
							</h4>
							<span class="comment-metadata">
								<a class="edubin-comment-time" href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
									<time datetime="<?php esc_attr( comment_time( 'c' ) ); ?>">
										<?php 
											printf(
												__( '%1$s at %2$s', 'edubin' ), get_comment_date(), get_comment_time()
											);

											edit_comment_link( __( '(Edit)', 'edubin' ), '  ', '' );
										?>
									</time>
								</a>
							</span>
						</div>						

						<?php if ( '0' == $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation label label-info"><?php echo esc_html( $moderation_note ); ?></p>
						<?php endif; ?>

						<div class="comment-content">
							<?php comment_text(); ?>
						</div>
						
						<div class="edubin-comment-bottom-part">
							<?php 
								echo get_comment_reply_link(
									array(
										'depth'      => $depth,
										'max_depth'  => $args['max_depth'],
										'reply_text' => sprintf( '<i class="flaticon-back"></i> %s', __( 'Reply', 'edubin' ) )
									),
									$comment->comment_ID,
									$comment->comment_post_ID
								);
							?>
						</div>	
					</div>	
				</div>
			</article>	
			<?php
		}	
	}
endif;

/**
 * Custom list of comments for the theme.
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_comments_template' ) ) :
	function edubin_comments_template() {
		$req      = get_option( 'require_name_email' );
		$aria_req = ( $req ? " aria-required='true'" : '' );
		$args     = array(
			'class_form'         => 'edubin-comment-form form media-body',
			'class_submit'       => 'edubin-comment-btn',
			'title_reply_before' => '<h3 class="edubin-title">',
			'title_reply'		 => __( 'Leave a Reply', 'edubin' ),
			'label_submit'		 => __( 'Post A Comment', 'edubin' ),
			'title_reply_after'  => '</h3>',
			'must_log_in'        => '<p class="must-log-in">' .
									sprintf(
										wp_kses(
											/* translators: %s is Link to login */
											__( 'You must be <a href="%s">logged in</a> to post a comment.', 'edubin' ), array(
												'a' => array(
													'href' => array()
												)
											)
										), esc_url( wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) )
									) . '</p>',
			'fields'             => 
			apply_filters(
				'comment_form_default_fields', array(

					'author' => '<div class="edubin-row"><div class="edubin-col-md-6 "><div class="form-group edubin-comment-field label-floating is-empty"><input id="author" name="author" class="form-control" type="text"' . $aria_req . ' placeholder="' . __( 'Name', 'edubin' ) . ( $req ? '*' : '' ) . '" /></div></div>',

					'email'  => '<div class="edubin-col-md-6"><div class="form-group edubin-comment-field label-floating is-empty"><input id="email" name="email" class="form-control" type="email"' . $aria_req . ' placeholder="' . __( 'Email', 'edubin' ) . ( $req ? '*' : '' ) . '" /></div></div>',

					'url'    => '<div class="edubin-col-lg-12"><div class="form-group edubin-comment-field label-floating is-empty"><input id="url" name="url" class="form-control" type="url"' . $aria_req . ' placeholder="' . __( 'Website', 'edubin' ) .'" /></div></div> </div>',
				)
			),
			'comment_field'      => '<div class="form-group edubin-comment-field label-floating is-empty"><textarea rows="8" id="comment" name="comment" class="form-control" cols="20" aria-required="true"  placeholder="' . __( 'Comment', 'edubin' ) .'"></textarea></div>'
		);

		return $args;
	}
endif;

/**
 * Custom form
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_hidden_comment_form' ) ) :
	function edubin_hidden_comment_form( $arg ) {
		global $post;
		if ( 'open' == $post->comment_status ) :
			ob_start();
	      	comment_form( $arg );
	      	$form = ob_get_clean();

			echo '<div class="comment-comment-form-hidden">';
				echo str_replace( 'id="commentform"', 'id="commentform" enctype="multipart/form-data"', $form );
			echo '</div>';
		endif;
	}
endif;

/**
 * Move Comment Field & Cookie Consent to Bottom
 *
 * @since 1.0.0
 */
function edubin_move_comment_field_to_bottom( $fields ) {
    $comment_field = $fields['comment'];
	if ( isset( $fields['cookies'] ) ) :
    	$cookies_field = $fields['cookies'];
	endif;

    unset( $fields['comment'] );
	if ( isset( $fields['cookies'] ) ) :
    	unset( $fields['cookies'] );
	endif;
	
	$fields['comment'] = $comment_field;

	if ( isset( $fields['cookies'] ) ) :
    	$fields['cookies'] = $cookies_field;
	endif;
    return $fields;
}
add_filter( 'comment_form_fields', 'edubin_move_comment_field_to_bottom' );

/**
 *  Body Classes
 *
 * @since 1.0.0
 */
add_filter( 'body_class', 'edubin_get_body_classes' );

if ( ! function_exists( 'edubin_get_body_classes' ) ) :
	function edubin_get_body_classes( $classes ) {
		global $post;
		if ( is_page() && is_object( $post ) ) :
			$classes[]                 = 'edubin-page-content';
			$page_layout               = get_post_meta( get_the_ID(), '_edubin_page_container', true );
			$content_type              = get_post_meta( get_the_ID(), '_edubin_page_content_layout', true );
			$breadcrumb_visibility     = get_post_meta( get_the_ID(), '_edubin_page_header_enable', true );
			$breadcrumb_show_framework = Edubin::setting( 'page_header_show' );

			if( get_post_meta( $post->ID, '_edubin_page_header_transparent', true ) && get_post_meta( $post->ID, '_edubin_page_header_transparent', true ) == 'enable' ) :
				$classes[] = 'edubin-header-transparent-enable';
			endif;

			if ( ! is_front_page() ) :
				if ( 'disable' !== $breadcrumb_visibility ) :
					if ( ( 'enable' === $breadcrumb_visibility ) || ( isset( $breadcrumb_show_framework ) && ! empty( $breadcrumb_show_framework ) ) ) :
						$classes[] = 'edubin-page-breadcrumb-enable';
					else :
						$classes[] = 'edubin-page-breadcrumb-disable';
					endif;
				else :
					$classes[] = 'edubin-page-breadcrumb-disable';
				endif;
			else :
				$classes[] = 'edubin-page-breadcrumb-disable';
			endif;

			if ( 'full-width' === $page_layout ) :
				$classes[] = 'edubin-page-fullwidth';
			else :
				$classes[] = 'edubin-page-boxed';
			endif;

			if ( isset( $content_type ) && ! empty( $content_type ) ) :
				if ( 'no-sidebar' === $content_type ) :
					$classes[] = 'edubin-page-sidebar-disable';
				else :
					$classes[] = 'edubin-page-sidebar-enable';
				endif;
			else :
				$classes[] = 'edubin-page-sidebar-disable';
			endif;

			$extra_class = get_post_meta( $post->ID, 'edubin_page_extra_class', true );

			if ( ! empty( $extra_class ) ) :
				$classes[] = trim( $extra_class );
			endif;

		elseif ( is_singular() || is_category() || is_tax() || is_home() || is_search() || edubin_is_blog() ) :
			$show = true;
			if ( ! $show ) :
				$classes[] = 'edubin-page-breadcrumb-disable';
			endif;

		elseif ( is_singular( 'tp_event' ) || is_post_type_archive( 'tp_event' ) || is_tax( 'tp_event_category' )  || is_tax( 'tp_event_tags' ) ) :
			$show = true;
			if ( ! $show ) :
				$classes[] = 'edubin-page-breadcrumb-disable';
			endif;
	
			
		elseif ( class_exists( 'WooCommerce' ) && is_woocommerce() ) :
			$show = Edubin::setting( 'show_shop_breadcrumb' );
			if ( ! $show ) :
				$classes[] = 'edubin-page-breadcrumb-disable';
			endif;
    	endif;

	    return $classes;
	}
endif;

/**
 * Header Extra Class
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_header_classes' ) ) :
	function edubin_header_classes( $classes ) {
		global $post;
		if ( is_page() && is_object( $post ) ) :
			$header_color_white = get_post_meta( get_the_ID(), '_edubin_page_transparent_header_color', true );
			$header_transparent = get_post_meta( get_the_ID(), '_edubin_page_header_transparent', true );
			$header_white_logo_status = get_post_meta( get_the_ID(), '_edubin_page_transparent_logo', true );
			$header_sticky = get_post_meta( get_the_ID(), '_edubin_page_header_sticky', true );
			$page_dark_header = get_post_meta( get_the_ID(), '_edubin_page_dark_header', true );
			// $extra_class = get_post_meta( $post->ID, 'edubin_page_extra_class', true );
			$white_logo = Edubin::setting( 'header_white_logo' );

			if ( 'enable' === $header_color_white ) :
				$classes[] = 'header-color-white';
			endif;

			if ( 'enable' === $header_transparent && 'enable' === $header_white_logo_status && isset( $white_logo ) && ! empty( $white_logo ) ) :
				$classes[] = 'white-logo-enable';
			endif;

			if ( 'enable' === $header_sticky && ! in_array( 'header-get-sticky', $classes ) ) :
				$classes[] = 'header-get-sticky';
			endif;

			if ( 'enable' === $page_dark_header  ) :
				$classes[] = 'edubin-dark-header';
			endif;

			// if ( ! empty( $extra_class ) ) :
			// 	$classes[] = trim( $extra_class );
			// endif;
		endif;
		return $classes;
	}
endif;
add_filter( 'edubin_header_class_array', 'edubin_header_classes' );

/**
 * Theme Name at Body Classes
 *
 * @since 1.0.0
 */
add_filter( 'body_class', 'edubin_get_theme_name_in_body_classes' );
if ( ! function_exists( 'edubin_get_theme_name_in_body_classes' ) ) :
	function edubin_get_theme_name_in_body_classes( $classes ) {
		$classes[] = 'theme-name-' . esc_attr( wp_get_theme()->get( 'TextDomain' ) );
		return $classes;
	}
endif;

/**
 * Edubin Supported LMS Builders
 *
 * @return boolean
 */
function edubin_is_lms_courses() {
	if ( ( function_exists( 'edubin_is_lp_courses' ) && edubin_is_lp_courses() ) || is_singular( 'lp_course' ) || is_post_type_archive( 'lp_course' ) || is_tax( 'course_category' ) || is_tax( 'course_tag' ) ) : 
		return true;
	elseif ( is_singular( 'courses' ) || is_post_type_archive( 'courses' ) || is_tax( 'course-category' ) || is_tax( 'course-tag' ) ) :
		return true;
	elseif ( is_singular( 'sfwd-courses' ) || is_post_type_archive( 'sfwd-courses' ) || is_tax( 'ld_course_category' ) || is_tax( 'ld_course_tag' ) ) :
		return true;
    endif;
    return false;

}

/**
 * Edubin Supported LMS Builders Course Details Page
 *
 * @return boolean
 */
function edubin_is_lms_course_details() {
	if ( is_singular( 'lp_course' ) ) : 
		// LearnPress
		return true;
	elseif ( is_singular( 'courses' ) ) :
		// Tutor LMS
		return true;
	elseif ( is_singular( 'course' ) ) :
		// Lifter Lms & Sensei LMS
		return true;
	elseif ( is_singular( 'stm-courses' ) ) :
		// Masterstudy
		return true;
	elseif ( is_singular( 'sfwd-courses' ) ) :
		// LearnDash
		return true;
    endif;
    return false;
}

/**
 * Breadcrumb For LearnPress Course Details
 *
 * @return boolean
 */
add_action( 'edubin_lms_course_details_breadcrumb', 'edubin_lp_lms_course_details' );
function edubin_lp_lms_course_details() {
	// echo 'testing';

}

/**
 * Course Ajax Search
 */
add_action( 'wp_ajax_nopriv_edubin_ajax_course_search', 'edubin_ajax_course_search' );
add_action( 'wp_ajax_edubin_ajax_course_search', 'edubin_ajax_course_search' );

if ( ! function_exists( 'edubin_ajax_course_search' ) ) :
	function edubin_ajax_course_search() {
		$args = array (
			'post_type' 	 => apply_filters( 'edubin_course_search_post_type', LP_COURSE_CPT ),
			'post_status' 	 => 'publish',
			'order' 		 => 'DESC',
			'orderby' 		 => 'date',
			's' 			 => $_POST['term'],
			'posts_per_page' => apply_filters( 'edubin_course_search_number_of_post', 10 )
		);
		 
		$query = new WP_Query( $args );
		 
		if ( $query->have_posts() ) :
			echo '<ul>';
				while ( $query->have_posts() ) :
					$query->the_post();
					printf( '<li><a href="%s">%s</a></li>', esc_url( get_the_permalink() ), esc_html( get_the_title() ) );
				endwhile;
			echo '</ul>';
		else :
			printf( '<ul><li>%s</li></ul>', __( 'Sorry, No Course Found.', 'edubin' ) );
		endif;

		wp_reset_postdata();
		exit;
	}
endif;

// Define home url for ajax course search
if ( ! function_exists( 'edubin_ajax_course_search_base' ) ) :
	function edubin_ajax_course_search_base(){
		?>
			<script type="text/javascript">var edubin_home_url = "<?php echo esc_url( home_url() ); ?>";</script>
		<?php
	}
endif;
add_action( 'wp_footer', 'edubin_ajax_course_search_base' );

/**
 *  Add Preloader Class at Body Classes
 *
 * @since 1.0.0
 */
// add_filter( 'body_class', 'edubin_add_preloader_class_at_body' );

// if ( ! function_exists( 'edubin_add_preloader_class_at_body' ) ) :
// 	function edubin_add_preloader_class_at_body( $classes ) {
// 		$preloader = Edubin::setting( 'preloader_show' );
// 		if ( $preloader ) :
// 			$preloader_type = Edubin::setting( 'preloader_type' );
// 			$classes[] = 'edubin-preloader-type-' . $preloader_type;
// 		endif;
// 		return $classes;
// 	}
// endif;

/**
 *  Single Post Support With Header & Footer Blank
 *	return array of post_types
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_header_footer_blank_single_post_array' ) ) :
	function edubin_header_footer_blank_single_post_array() {
		$supported_array = apply_filters( 'edubin_header_footer_blank_post_array', [
			'eb_header', 
			'eb_footer', 
			'edubin_megamenu', 
			'elementor_library' 
		] );
		return $supported_array;
	}
endif;

/**
 * Estimated Reading Time
 *
 * @return void
 */
if( ! function_exists( 'edubin_post_estimated_reading_time' ) ) :
	function edubin_post_estimated_reading_time( $with_second = false ) {
		global $post;
		$words_per_min = apply_filters( 'edubin_words_read_per_min', 200 );
		// get the content
		$the_content = $post->post_content;
		// count the number of words
		$words = str_word_count( strip_tags( $the_content ) );
		// rounding off and deviding per 200( $words_per_min ) words per minute
		$minute = floor( $words / $words_per_min );
		// rounding off to get the seconds
		$second = floor( $words % $words_per_min / ( $words_per_min / 60 ) );
		// calculate the amount of time needed to read

		$estimate = $minute . ' ' . __( 'Min', 'edubin' ) . ( $minute == 1 ? '' : __( 's', 'edubin' ) );

		if ( $minute < 1 ) :
			$estimate = $second . ' ' . __( 'Sec', 'edubin' ) . ( $second == 1 ? '' : __( 's', 'edubin' ) );
		endif;

		if ( $with_second ) :
			$estimate = $minute . ' ' . __( 'Min', 'edubin' ) . ( $minute == 1 ? '' : __( 's', 'edubin' ) ) . ', ' . $second . ' ' . __( 'Sec', 'edubin' ) . ( $second == 1 ? '' : __( 's', 'edubin' ) );
		endif;
		
		return $estimate;
	}
endif;

/**
 * return all the thumb sizes
 *
 * @return void
 */
function edubin_get_thumbnail_sizes() {
	$image_sizes = get_intermediate_image_sizes();
	$additional_sizes = array(
		__( 'Full size', 'edubin' ) => 'full'
	);

	$newsizes = array_merge( $image_sizes, $additional_sizes );
	return apply_filters( 'edubin_thumb_size_filter', array_combine( $newsizes, $newsizes ) );
}

/**
 * add title after image at zoom details page
 */
// Left Section Single Content( with heading )
add_action( 'vczoom_single_content_left', 'edubin_video_conference_zoom_heading', 15 );
if( ! function_exists( 'edubin_video_conference_zoom_heading' ) ) :
	function edubin_video_conference_zoom_heading() {
		echo '<div class="tpc-zoom-details-page-heading">';
			echo '<h3 class="title">' . wp_kses_post( get_the_title() ) . '</h3>';
		echo '</div>';
	}
endif;

// Left Section Single Content( with heading )
if( ! function_exists( 'edubin_vczapi_html_after_meeting_details' ) ) :
	function edubin_vczapi_html_after_meeting_details() {
		$extra_meta = get_post_meta( get_the_ID(), 'edubin_zoom_extra_meta_fields', true ); 
		// var_dump($extra_meta);
		if ( isset( $extra_meta ) && is_array( $extra_meta ) ) :
			foreach ( $extra_meta as $key => $meta ) :
				if ( $meta['label'] ) :
					$wrapper_class = '';
					if ( isset( $meta['wrapper_class'] ) && ! empty( $meta['wrapper_class'] ) ) :
						$wrapper_class = ' ' . $meta['wrapper_class'];
					endif;

					echo '<div class="dpn-zvc-sidebar-content-list' . esc_attr( $wrapper_class ) . '">';
						echo '<span class="label">';
							echo esc_html($meta['label']) ? '<strong>' . esc_html( $meta['label'] ) . '</strong>' : '';
						echo '</span>';

						echo esc_html($meta['label']) ? ' <span class="vczapi-single-meeting-value">' . esc_html( $meta['value'] ) . '</span>' : '';
					echo '</div>';
				endif;
			endforeach;
		endif;
	}
endif;

add_action( 'vczapi_html_after_meeting_details', 'edubin_vczapi_html_after_meeting_details' );
