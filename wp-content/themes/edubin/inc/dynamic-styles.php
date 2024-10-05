<?php

defined('ABSPATH') || exit;

function edubin_scripts() {

    $sticky_header = Edubin::setting( 'sticky_header_enable' );

    wp_enqueue_style( 'edubin-style', get_stylesheet_uri() );

    // Global courses stylesheet based on plugin or class existence
    if (class_exists('SFWD_LMS') || class_exists('LearnPress') || class_exists('Sensei_Main') || function_exists('tutor') || class_exists('MasterStudy\Lms\Plugin')) {
        wp_enqueue_style('edubin-global-courses', EDUBIN_URI . '/assets/css/global-courses.css', array(), EDUBIN_THEME_VERSION);
    }

    if (class_exists('LearnPress')):
        $get_lp_plugin_dir        = WP_PLUGIN_DIR . '/learnpress/learnpress.php';
        $lp_plugin_version_number = get_plugin_data($get_lp_plugin_dir);

        if ( $lp_plugin_version_number['Version'] < '4.0.0'):
            wp_enqueue_style('edubin-learnpress', EDUBIN_URI . '/assets/css/learnpress.css', array(), EDUBIN_THEME_VERSION);
        endif;

        if ( $lp_plugin_version_number['Version'] > '4.0.0'):
            wp_enqueue_style('edubin-learnpress-v4', EDUBIN_URI . '/assets/css/learnpress-v4.css', array(), EDUBIN_THEME_VERSION);
            // wp_enqueue_style('edubin-learnpress-color', EDUBIN_URI . '/assets/css/learnpress-color.css', array(), EDUBIN_THEME_VERSION);
        endif;

    endif;

    if (function_exists('tutor')):
        wp_enqueue_style('edubin-tutor', EDUBIN_URI . '/assets/css/tutor.css', array(), EDUBIN_THEME_VERSION);
    endif;

    if ( class_exists('MasterStudy\Lms\Plugin')):
        wp_enqueue_style('edubin-masterstudy', EDUBIN_URI . '/assets/css/masterstudy.css', array(), EDUBIN_THEME_VERSION);
    endif;

    if ( class_exists('LifterLMS')):
        wp_enqueue_style('edubin-lifter', EDUBIN_URI . '/assets/css/lifter.css', array(), EDUBIN_THEME_VERSION);
    endif;

   if ( class_exists('Zoom_Video_Conferencing_Api') ) :
        wp_enqueue_style( 'edubin-zoom', get_template_directory_uri() . '/assets/css/zoom.css', array(), EDUBIN_THEME_VERSION );
   endif;

    if ( class_exists( 'WPEMS' ) || class_exists('Tribe__Events__Main') ) :
        wp_enqueue_style( 'edubin-wpem', get_template_directory_uri() . '/assets/css/wpem.css', array(), EDUBIN_THEME_VERSION );
    endif;

    if (class_exists('Tribe__Events__Main')):
        wp_enqueue_style('edubin-events', EDUBIN_URI . '/assets/css/events.css', array(), EDUBIN_THEME_VERSION);
    endif;
    
    if (class_exists('Tribe__Events__Filterbar__PUE')):
        wp_enqueue_style('edubin-events-filterbar', EDUBIN_URI . '/assets/css/filterbar.css', array(), EDUBIN_THEME_VERSION);
    endif;

    wp_enqueue_style( 'edubin-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon_edubin.css', array(), EDUBIN_THEME_VERSION );
    wp_enqueue_style( 'edubin-swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css', array(), EDUBIN_THEME_VERSION );
    wp_enqueue_style( 'metismenu', get_template_directory_uri() . '/assets/css/metisMenu.min.css', array(), EDUBIN_THEME_VERSION );
    wp_enqueue_style( 'edubin-tipped', get_template_directory_uri() . '/assets/css/tipped.min.css', array(), EDUBIN_THEME_VERSION );
    wp_enqueue_style( 'nice-select', get_template_directory_uri() . '/assets/css/nice-select.css', array(), EDUBIN_THEME_VERSION );
    wp_enqueue_style( 'edubin-core', get_template_directory_uri() . '/assets/css/edubin-core.css', array(), EDUBIN_THEME_VERSION );
    wp_enqueue_style( 'edubin-main', get_template_directory_uri() . '/assets/css/main.css', array(), EDUBIN_THEME_VERSION );
    wp_enqueue_style( 'global-courses', get_template_directory_uri() . '/assets/css/global-courses.css', array(), EDUBIN_THEME_VERSION );
    wp_register_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'metismenu', get_template_directory_uri() . '/assets/js/metisMenu.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'edubin-swiper', get_template_directory_uri() . '/assets/js/swiper-bundle.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'edubin-mouse-animation', get_template_directory_uri() . '/assets/js/edubin-mouse-move-animation.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'edubin-sal-js', get_template_directory_uri() . '/assets/js/sal.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'jquery-isotope', get_template_directory_uri() . '/assets/js/isotope.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'edubin-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
    wp_enqueue_script( 'edubin-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) :
        wp_enqueue_script( 'comment-reply' );
    endif;
    wp_register_style( 'jquery-fancybox', get_template_directory_uri() . '/assets/css/jquery.fancybox.min.css', array(), EDUBIN_THEME_VERSION );
    wp_register_script( 'jquery-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'edubin-tipped', get_template_directory_uri() . '/assets/js/tipped.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/nice-select.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    wp_register_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/js/theia-sticky-sidebar.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    $back_to_top_show = Edubin::setting( 'back_to_top_show' );
    if ( $back_to_top_show ) :
        wp_enqueue_script( 'edubin-back-to-top', get_template_directory_uri() . '/assets/js/back-to-top.js', array(), EDUBIN_THEME_VERSION, true );
    endif;
    $smooth_scroll = Edubin::setting( 'smooth_scroll' );
    if ( $smooth_scroll ) :
        wp_enqueue_script( 'edubin-smooth-scroll', get_template_directory_uri() . '/assets/js/smooth-scroll.min.js', array(), EDUBIN_THEME_VERSION, true );
    endif;
    wp_enqueue_script( 'youtube-popup', get_template_directory_uri() . '/assets/js/youtube-popup.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    if ( $sticky_header ) {
        wp_enqueue_script( 'headroom', get_template_directory_uri() . '/assets/js/headroom.min.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
    }
    wp_enqueue_script( 'edubin-init', get_template_directory_uri() . '/assets/js/init.js', array( 'jquery' ), EDUBIN_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'edubin_scripts' );


/**
 * Register/Enqueue JS/CSS In Admin Panel
 */
function edubin_register_admin_styles()
{
    wp_enqueue_script('edubin-unloack', EDUBIN_URI . '/admin/assets/js/edubin-unloack.js', array('jquery'), '1.0.0');

    wp_enqueue_style('edubin-admin-css', EDUBIN_URI . '/admin/assets/css/admin.css', array(), EDUBIN_THEME_VERSION);

}
add_action('admin_enqueue_scripts', 'edubin_register_admin_styles');    
