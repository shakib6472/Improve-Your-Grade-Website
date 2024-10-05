<?php

defined("ABSPATH") || exit();

if (!class_exists("Edubin_Theme_Dependencies")) {
    /**
     * Require all the theme necessary files.
     */
    class Edubin_Theme_Dependencies
    {
        public function __construct()
        {
            self::include_theme_essential_files();
        }

        public static function include_theme_essential_files()
        {
            
            // Deprecated function
            require_once EDUBIN_DIR . '/inc/deprecated-function.php';

            /** Theme Global Functions */
            require_once get_theme_file_path(
                "/inc/theme-global-functions.php"
            );

            /**
             * edubin base Functions
             */
            require_once get_template_directory() . '/inc/theme-base-functions.php';

            /** Theme helper functions */
            require_once EDUBIN_DIR . "/inc/theme-helper.php";

            /** Multiple LMS error warning  */
            require_once EDUBIN_DIR . "/inc/multiple-lms-error.php";

            /** Custom template tags for this theme. */
            require_once get_parent_theme_file_path(
                "/inc/template-tags.php"
            );

            /** Additional features to allow styling of the templates */
            require_once EDUBIN_DIR .
                "/inc/template-functions.php";

            /** Widgets */
            require_once get_parent_theme_file_path(
                "/inc/theme-support.php"
            );

            /** Kirki & Customizer */
            require_once get_template_directory() . '/inc/customizer/class-static.php';
            require_once get_template_directory() . '/inc/customizer/class-customize.php';
            require_once get_template_directory() . '/inc/customizer/class-kirki.php';
            require_once get_template_directory() . '/inc/customizer.php';

            /** Dynamic styles */
            require_once get_theme_file_path("/inc/dynamic-styles.php");

            require_once get_template_directory() . '/inc/theme-base-css.php';

            /**
             * Load CMB2 metabox file.
             */
            require_once get_template_directory() . '/inc/cmb2/cmb2.php';

            /**
             * Load Once Click Demo Import File.
             */

            // Admin init
            require_once EDUBIN_DIR . '/admin/admin-pages/admin.php';

           // Envato setup
            if ( !is_customize_preview() && is_admin() ) {
                require EDUBIN_DIR . '/admin/envato_setup/envato_setup.php';
            }
            /** One click demo import */
            require_once get_theme_file_path("admin/edubin-demo-import.php");

            if ( ! class_exists( 'TGM_Plugin_Activation' ) ) :
                require_once get_template_directory() . '/admin/tgm/class-tgm-plugin-activation.php';
                require_once EDUBIN_DIR . '/admin/tgm/tgm-init.php';
            endif;

            /**
             * Implement the Custom Header feature.
             */
            require_once get_template_directory() . '/inc/custom-header.php';

            /**
             * Custom template tags for this theme.
             */
            require_once get_template_directory() . '/inc/template-tags.php';

            /**
             * Bootstrap Nav Walker Class
             */
            require_once get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

            /**
             * LearnPress compatibility file.
             */
            if ( class_exists( 'LearnPress' ) ) :
                require_once get_template_directory() . '/inc/lp-init.php';
            endif;

            /**
             * LearnDash compatibility file.
             */
            if ( class_exists( 'SFWD_LMS' ) ) :
                require_once get_template_directory() . '/inc/ld-init.php';
                require_once get_template_directory() . '/inc/class-ld.php';
            endif;

            /**
             * Totor LMS compatibility file.
             */
            if ( function_exists( 'tutor' ) ) :
                require_once get_template_directory() . '/inc/tutor-init.php';
                require_once get_template_directory() . '/inc/class-tutor.php';

            endif;

            /**
             * Lifter LMS compatibility file.
             */
            if ( class_exists( 'LifterLMS' ) ) :
                require_once get_template_directory() . '/inc/lifter-init.php';
                require_once get_template_directory() . '/inc/class-lifter.php';
            endif;

            /**
             * Sensei LMS compatibility file.
             */
            if ( class_exists( 'Sensei_Main' ) ) :
                require_once get_template_directory() . '/inc/sensei-init.php';
                require_once get_template_directory() . '/inc/class-sensei.php';

            endif;

            /**
             * MasterStudy LMS compatibility file.
             */
            if ( class_exists('MasterStudy\Lms\Plugin') ) :
                require_once get_template_directory() . '/inc/ms-init.php';
                require_once get_template_directory() . '/inc/class-ms.php';

            endif;

            /**
             * LMS Filter
             */
            require_once get_template_directory() . '/inc/course-filter-base.php';

            /**
             * Wishlist Ajax Support
             */
            require_once get_template_directory() . '/inc/class-wishlist.php';

            /**
             * Load Jetpack compatibility file.
             */
            if ( defined( 'JETPACK__VERSION' ) ) :
                require_once get_template_directory() . '/inc/jetpack.php';
            endif;

            /**
             * WooCommerce compatibility file..
             */
            if ( class_exists( 'WooCommerce' ) ) :
                require_once get_template_directory() . '/inc/wc-init.php';
            endif;

            /**
             * Elementor compatibility file.
             */
            require_once get_template_directory() . '/inc/elementor-functions.php';

            /**
             * Admin Script
             */
            require_once get_template_directory() . '/inc/admin-scripts.php';

        }

    }

    new Edubin_Theme_Dependencies();
}
