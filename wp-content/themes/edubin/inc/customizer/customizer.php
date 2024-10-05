<?php
/**
 * Edubin Theme Customizer
 */

// init kirki theme option
 Kirki::add_config('edubin_theme_config', array(
     'capability'   =>  'edit_theme_options',
     'option_type'  =>  'theme_mod',
 ));

 // General option panel
 Kirki::add_panel( 'edubin_general_panel', array(
     'title'    =>  esc_html__( 'General', 'edubin' ),
     'priority' => 9,
 ) );


require_once EDUBIN_DIR . '/inc/customizer/option-panel/color.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/typography.php';
/*----------------------------
WP Default Background Image
----------------------------*/
 Kirki::add_section( 'background_image', array(
    'title'    =>  esc_html__( 'Background Image', 'edubin' ),
    'theme_supports' => 'custom-background',
    'priority'       => 160,
    'panel' =>  'edubin_general_panel'
) );
 
require_once EDUBIN_DIR . '/inc/customizer/option-panel/preloader.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/social-link.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/social-shear.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/button.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/back-to-top.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/pagination.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/page-404.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/rtl.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/utilities.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/load-libraries.php';

 // Header option panel
 Kirki::add_panel( 'header_naviation_panel', array(
     'title'    =>  esc_html__( 'Header', 'edubin' ),
     'priority' => 9,
 ) );
require_once EDUBIN_DIR . '/inc/customizer/option-panel/name-and-logo.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/global-header.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/header-top.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/header-area.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/header-menu.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/page-title.php';

 // Blog option panel
 Kirki::add_panel( 'header_blog_panel', array(
     'title'    =>  esc_html__( 'Blog', 'edubin' ),
     'priority' => 9,
 ) );

require_once EDUBIN_DIR . '/inc/customizer/option-panel/blog.php';

// Sidebar Panel
Kirki::add_panel( 'edubin_sidebar_panel', array(
     'title'    =>  esc_html__( 'Sidebar', 'edubin' ),
     'priority' => 9,
) );

require_once EDUBIN_DIR . '/inc/customizer/option-panel/sidebar.php';

if ( class_exists('LearnPress') ) {

     // LearnPress LMS option panel
     Kirki::add_panel( 'edubin_lp_panel', array(
         'title'    =>  esc_html__( 'LearnPress LMS', 'edubin' ),
         'priority' => 9,
     ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/learnpress.php';
}

if ( class_exists('SFWD_LMS') ) {

     // LearnDash LMS option panel
     Kirki::add_panel( 'edubin_ld_panel', array(
         'title'    =>  esc_html__( 'LearnDash LMS', 'edubin' ),
         'priority' => 9,
     ) );

     require_once EDUBIN_DIR . '/inc/customizer/option-panel/learndash.php';
}

if ( class_exists('MasterStudy\Lms\Plugin') ) {

     // MasterStudy LMS option panel
     Kirki::add_panel( 'edubin_ms_panel', array(
         'title'    =>  esc_html__( 'MasterStudy LMS', 'edubin' ),
         'priority' => 9,
     ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/ms.php';
}

if ( function_exists('tutor') ) {

     // Tutor LMS option panel
     Kirki::add_panel( 'edubin_tutor_panel', array(
         'title'    =>  esc_html__( 'Tutor LMS', 'edubin' ),
         'priority' => 9,
     ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/tutor.php';
}

if ( class_exists('Sensei_Main') ) {

    // Sensei LMS option panel
    Kirki::add_panel( 'edubin_sensei_panel', array(
         'title'    =>  esc_html__( 'Sensei LMS', 'edubin' ),
         'priority' => 9,
    ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/sensei.php';
}

if ( class_exists('LifterLMS') ) {

    // Lifter LMS option panel
    Kirki::add_panel( 'edubin_lif_panel', array(
         'title'    =>  esc_html__( 'Lifter LMS', 'edubin' ),
         'priority' => 9,
    ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/lifter.php';
}

if ( class_exists('WooCommerce') ) {

 // WooCommerce panel
 Kirki::add_panel( 'woocommerce', array(
     'title'    =>  esc_html__( 'WooCommerce', 'edubin' ),
     'priority' => 9,
 ) );

   require_once EDUBIN_DIR . '/inc/customizer/option-panel/wc.php';
}

if ( class_exists('Tribe__Events__Main') ) {

     // The event calendar option panel
     Kirki::add_panel( 'tribe_customizer', array(
         'title'    =>  esc_html__( 'The Event Calendar', 'edubin' ),
         'priority' => 9,
     ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/events.php';
}

if ( class_exists('Zoom_Video_Conferencing_Api') ) {

     // adding Zoom Meeting plugin option panel
     Kirki::add_panel( 'edubin_zoom_meeting_panel', array(
         'title'    =>  esc_html__( 'Zoom Meeting', 'edubin' ),
         'priority' => 9,
     ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/zoom.php';
}

if ( class_exists('WPEMS') ) {

     // adding Zoom Meeting plugin option panel
     Kirki::add_panel( 'edubin_tp_event_panel', array(
         'title'    =>  esc_html__( 'WP Events Manager', 'edubin' ),
         'priority' => 9,
     ) );

    require_once EDUBIN_DIR . '/inc/customizer/option-panel/tp_events.php';
}

 // Fooder option pagnel
 Kirki::add_panel( 'edubin_footer_panel', array(
     'title'    =>  esc_html__( 'Footer', 'edubin' ),
     'priority' => 9,
 ) );

require_once EDUBIN_DIR . '/inc/customizer/option-panel/footer.php';
require_once EDUBIN_DIR . '/inc/customizer/option-panel/copyright.php';




