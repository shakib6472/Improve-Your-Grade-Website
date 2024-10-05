<?php

defined('ABSPATH') || exit;

/**
* Edubin Theme Support
*
*
* @class        Edubin_Theme_Support
* @version      1.0
* @category     Class
* @author       Pixelcurve
*/

if (! class_exists('Edubin_Theme_Support')) {
    class Edubin_Theme_Support
    {

        private static $instance = null;

        public static function get_instance()
        {
            if (null == self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }

        public function __construct()
        {
            // if (function_exists('add_theme_support')) {
            //     add_theme_support('post-thumbnails');
            //     add_theme_support('automatic-feed-links');
            //     add_theme_support('revisions');
            //     add_theme_support('post-formats', ['gallery', 'video', 'quote', 'audio', 'link']);
            // }

            // Register Nav Menu
           // add_action('init', [$this, 'register_my_menus'] );
            // Add translation file
         //   add_action('init', [$this, 'enqueue_translation_files'] );
            // Add widget support
            add_action('widgets_init', [$this, 'sidebar_register'] );
        }

        // public function register_my_menus()
        // {
        //     register_nav_menus( [
        //         'main_menu' => esc_html__('Main menu', 'edubin')
        //     ] );
        // }

        // public function enqueue_translation_files()
        // {
        //     load_theme_textdomain('edubin', get_template_directory() . '/languages/');
        // }

        public function sidebar_register()
        {

            // Default wrapper for widget and title
            $wrapper_before = '<section id="%1$s" class="widget %2$s">';
            $wrapper_after = '</section>';
            $title_before = '<h2 class="widget-title">';
            $title_after = '</h2>';

            // Get List of registered sidebar
            $custom_sidebars = Edubin::setting( 'sidebars' );

            // Register custom sidebars
            if (!empty($custom_sidebars)) {
                foreach ($custom_sidebars as $single) {

                    register_sidebar([
                        'name' => esc_attr($single['edubin_sidebar_name']),
                        'id' => "sidebar_".esc_attr(strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', str_replace(' ', '-', $single['edubin_sidebar_name'])))),
                        'description' => esc_html__('Add widget here to appear it in custom sidebar.', 'edubin'),
                        'before_widget' => $wrapper_before,
                        'after_widget' => $wrapper_after,
                        'before_title' => $title_before,
                        'after_title' => $title_after,
                    ]);
                }
            }

            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Blog Sidebar', 'edubin'),
                'id'            => 'sidebar-1',
                'description'   => esc_html__('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));

            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Header Top', 'edubin'),
                'id'            => 'header-top',
                'description'   => esc_html__('Add widgets here to appear in your header top area.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));

            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Footer Column 01', 'edubin'),
                'id'            => 'footer-1',
                'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));

            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Footer Column 02', 'edubin'),
                'id'            => 'footer-2',
                'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));
            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Footer Column 03', 'edubin'),
                'id'            => 'footer-3',
                'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));

            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Footer Column 04', 'edubin'),
                'id'            => 'footer-4',
                'description'   => esc_html__('Add widgets here to appear in your footer.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));

            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Copyright 01', 'edubin'),
                'id'            => 'copyright',
                'description'   => esc_html__('Add widgets here to appear in your footer copyright.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));

            register_sidebar(array(
                'name'          => esc_html__('(Edubin) Copyright 02', 'edubin'),
                'id'            => 'copyright_2',
                'description'   => esc_html__('Add widgets here to appear in your footer copyright right side.', 'edubin'),
                'before_widget' => $wrapper_before,
                'after_widget' => $wrapper_after,
                'before_title' => $title_before,
                'after_title' => $title_after,
            ));

            if (class_exists('WooCommerce')) {
                $shop_sidebars = [
                    [
                        'name' => esc_html__('Shop Products', 'edubin'),
                        'id' => 'woocommerce_shop_page_sidebar',
                        'description'   => esc_html__('Add widgets here to appear in your sidebar on shop page pages.', 'edubin'),
                    ], [
                        'name' => esc_html__('Shop Products Top Area', 'edubin'),
                        'id' => 'woocommerce_shop_page_top_sidebar',
                        'description'   => esc_html__('Add widgets here to appear in your sidebar on shop page top pages.', 'edubin'),
                    ], [
                        'name' => esc_html__('Shop Single Top Area', 'edubin'),
                        'id' => 'woocommerce_product_page_top_sidebar',
                        'description'   => esc_html__('Add widgets here to appear in your sidebar on woocommerce shop product details page top pages.', 'edubin'),
                    ]
                ];
                foreach ($shop_sidebars as $shop_sidebar) {
                    register_sidebar( [
                        'name' => $shop_sidebar['name'],
                        'id' => $shop_sidebar['id'],
                        'description' => $shop_sidebar['description'],
                        'before_widget' => $wrapper_before,
                        'after_widget' => $wrapper_after,
                        'before_title' => $title_before,
                        'after_title' => $title_after,
                    ] );
                }
            }

            if ( class_exists('LearnPress') ) {
				$learnpress_sidebars = [
					[
						'name' => esc_html__( '(Edubin) LearnPress Single', 'edubin' ),
                        'description'   => esc_html__('Add widgets here to appear in your sidebar on LearnPress course details pages.', 'edubin'),
						'id' => 'learnpress_single',
					], [
						'name' => esc_html__( '(Edubin) LearnPress Archive', 'edubin' ),
                        'description'   => esc_html__('Add widgets here to appear in your sidebar on LearnPress course archive pages.', 'edubin'),
						'id' => 'lp-course-sidebar-1'
					],
				];
				foreach ($learnpress_sidebars as $key => $sidebar) {
					register_sidebar( [
						'name'          => $sidebar['name'],
						'id'            => $sidebar['id'],
						'description'   => $sidebar['description'],
						'before_widget' => $wrapper_before,
						'after_widget'  => $wrapper_after,
						'before_title'  => $title_before,
						'after_title'   => $title_after,
					]);
				}
			}
            
            if ( function_exists('tutor') ) {
                   register_sidebar(array(
                    'name'          => esc_html__('(Edubin) Tutor Single', 'edubin'),
                    'id'            => 'tutor-course-sidebar-2',
                    'description'   => esc_html__('Add widgets here to appear in your sidebar on Tutor course details pages.', 'edubin'),
                    'before_widget' => $wrapper_before,
                    'after_widget' => $wrapper_after,
                    'before_title' => $title_before,
                    'after_title' => $title_after,
                ));
            }

            if ( class_exists('SFWD_LMS') ) {
                register_sidebar(array(
                    'name'          => esc_html__('(Edubin) LearnDash Single', 'edubin'),
                    'id'            => 'ld-course-sidebar-1',
                    'description'   => esc_html__('Add widgets here to appear in your sidebar on LearnDash course details pages.', 'edubin'),
                    'before_widget' => $wrapper_before,
                    'after_widget' => $wrapper_after,
                    'before_title' => $title_before,
                    'after_title' => $title_after,
                ));
            }

            if ( class_exists('Sensei_Main') ) {
                register_sidebar(array(
                    'name'          => esc_html__('(Edubin) Sensei Single', 'edubin'),
                    'id'            => 'sensei-course-sidebar-1',
                    'description'   => esc_html__('Add widgets here to appear in your sidebar on Sensei course details pages.', 'edubin'),
                    'before_widget' => $wrapper_before,
                    'after_widget' => $wrapper_after,
                    'before_title' => $title_before,
                    'after_title' => $title_after,
                ));
            }

            if ( class_exists('Tribe__Events__Main') ) {
                register_sidebar(array(
                    'name'          => esc_html__('(Edubin) The Events Calendar Single', 'edubin'),
                    'id'            => 'tribe_event_sidebar',
                    'description'   => esc_html__('Add widgets here to appear in your sidebar on The Events Calendar details pages.', 'edubin'),
                    'before_widget' => $wrapper_before,
                    'after_widget' => $wrapper_after,
                    'before_title' => $title_before,
                    'after_title' => $title_after,
                ));
            }


        // === End sidebar 

        }
    }

    new Edubin_Theme_Support();
}
