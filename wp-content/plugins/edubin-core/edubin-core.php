<?php
/**
 * Plugin Name: Edubin Core
 * Description: A Required core plugin for Edubin Theme.
 * Plugin URI: 	https://themeforest.net/item/edubin-education-lms-wordpress-theme/24037792
 * Author: 		Pixelcurve
 * Author URI: 	http://thepixelcurve.com/
 * Version: 	9.2.16
 * Text Domain: edubin-core
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'EDUBIN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'EDUBIN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'EDUBIN_CORE_URL', plugins_url( '/', __FILE__ ) );
define( 'EDUBIN_ASSETS_URL', EDUBIN_CORE_URL . 'assets/' );
define( 'EDUBIN_CORE_VERSION', '9.2.16' );

/**
 * Main Edubin Core Class
 */
final class Edubin_Core {

	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '3.1.0';
	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function i18n() {
		load_plugin_textdomain( 'edubin-core', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	public function init() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		add_action( 'elementor/init', array( $this, 'edubin_custom_elementor_category' ) );

		require_once( 'init.php' );
	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'edubin-core' ),
			'<strong>' . esc_html__( 'Edubin Core', 'edubin-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'edubin-core' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'edubin-core' ),
			'<strong>' . esc_html__( 'Edubin Core', 'edubin-core' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'edubin-core' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'edubin-core' ),
			'<strong>' . esc_html__( 'Edubin Core', 'edubin-core' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'edubin-core' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function edubin_custom_elementor_category() {
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'edubin_elementor_widgets',
            array(
                'title' => esc_html__( 'Edubin', 'edubin-core' ),
            ),
            1
        );
        \Elementor\Plugin::instance()->elements_manager->add_category(
            'edubin-core-hf',
            array(
                'title' => esc_html__( 'Edubin Header Footer Addons', 'edubin-core' ),
            ),
            1
        );
    }
}

// Instantiate Edubin_Core.
new Edubin_Core();


/*=============================================
Register language tax for LearnPress LMS
=============================================*/
if (!class_exists('LearnPress')) {
    function edubin_register_lp_tax_language()
    {
        $course_post_type = 'lp_course';

        $labels = array(
            'name'                       => _x('Course Language', 'taxonomy general name', 'edubin-core'),
            'singular_name'              => _x('Language', 'taxonomy singular name', 'edubin-core'),
            'search_items'               => esc_html__('Search Languages', 'edubin-core'),
            'popular_items'              => esc_html__('Popular Languages', 'edubin-core'),
            'all_items'                  => esc_html__('All Languages', 'edubin-core'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__('Edit Language', 'edubin-core'),
            'update_item'                => esc_html__('Update Language', 'edubin-core'),
            'add_new_item'               => esc_html__('Add New Language', 'edubin-core'),
            'new_item_name'              => esc_html__('New Language Name', 'edubin-core'),
            'separate_items_with_commas' => esc_html__('Separate languages with commas', 'edubin-core'),
            'add_or_remove_items'        => esc_html__('Add or remove languages', 'edubin-core'),
            'choose_from_most_used'      => esc_html__('Choose from the most used languages', 'edubin-core'),
            'not_found'                  => esc_html__('No languages found.', 'edubin-core'),
            'menu_name'                  => esc_html__('Course Languages', 'edubin-core'),
            'back_to_items'              => esc_html__('Back to Languages', 'edubin-core'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_in_rest'          => true,
            'rewrite'               => array('slug' => apply_filters('edubin_lp_course_language_slug', 'lp_course_language')),
        );

        register_taxonomy('lp_course_language', $course_post_type, $args);
    }
    add_action('init', 'edubin_register_lp_tax_language', 1);

}


/*=============================================
Register language tax for LearnDash LMS
=============================================*/
if (!class_exists('SFWD_LMS')) {
    function edubin_register_ld_tax_language()
    {
        $course_post_type = 'sfwd-courses';

        $labels = array(
            'name'                       => _x('Course Language', 'taxonomy general name', 'edubin-core'),
            'singular_name'              => _x('Language', 'taxonomy singular name', 'edubin-core'),
            'search_items'               => esc_html__('Search Languages', 'edubin-core'),
            'popular_items'              => esc_html__('Popular Languages', 'edubin-core'),
            'all_items'                  => esc_html__('All Languages', 'edubin-core'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__('Edit Language', 'edubin-core'),
            'update_item'                => esc_html__('Update Language', 'edubin-core'),
            'add_new_item'               => esc_html__('Add New Language', 'edubin-core'),
            'new_item_name'              => esc_html__('New Language Name', 'edubin-core'),
            'separate_items_with_commas' => esc_html__('Separate languages with commas', 'edubin-core'),
            'add_or_remove_items'        => esc_html__('Add or remove languages', 'edubin-core'),
            'choose_from_most_used'      => esc_html__('Choose from the most used languages', 'edubin-core'),
            'not_found'                  => esc_html__('No languages found.', 'edubin-core'),
            'menu_name'                  => esc_html__('Course Languages', 'edubin-core'),
            'back_to_items'              => esc_html__('Back to Languages', 'edubin-core'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_in_rest'          => true,
            'rewrite'               => array('slug' => apply_filters('edubin_ld_course_language_slug', 'ld_course_language')),
        );

        register_taxonomy('ld_course_language', $course_post_type, $args);
    }
    add_action('init', 'edubin_register_ld_tax_language', 1);

}


/*=============================================
Register language tax for MasterStudy LMS
=============================================*/
if (!class_exists('MasterStudy\Lms\Plugin')) {
    function edubin_register_ms_tax_language()
    {
        $course_post_type = 'stm-courses';

        $labels = array(
            'name'                       => _x('Course Language', 'taxonomy general name', 'edubin-core'),
            'singular_name'              => _x('Language', 'taxonomy singular name', 'edubin-core'),
            'search_items'               => esc_html__('Search Languages', 'edubin-core'),
            'popular_items'              => esc_html__('Popular Languages', 'edubin-core'),
            'all_items'                  => esc_html__('All Languages', 'edubin-core'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__('Edit Language', 'edubin-core'),
            'update_item'                => esc_html__('Update Language', 'edubin-core'),
            'add_new_item'               => esc_html__('Add New Language', 'edubin-core'),
            'new_item_name'              => esc_html__('New Language Name', 'edubin-core'),
            'separate_items_with_commas' => esc_html__('Separate languages with commas', 'edubin-core'),
            'add_or_remove_items'        => esc_html__('Add or remove languages', 'edubin-core'),
            'choose_from_most_used'      => esc_html__('Choose from the most used languages', 'edubin-core'),
            'not_found'                  => esc_html__('No languages found.', 'edubin-core'),
            'menu_name'                  => esc_html__('Course Languages', 'edubin-core'),
            'back_to_items'              => esc_html__('Back to Languages', 'edubin-core'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_in_rest'          => true,
            'rewrite'               => array('slug' => apply_filters('edubin_ms_course_language_slug', 'ms_course_language')),
        );

        register_taxonomy('ms_course_language', $course_post_type, $args);
    }
    add_action('init', 'edubin_register_ms_tax_language', 1);

}

/*=============================================
Register language tax for Tutor LMS
=============================================*/
if (!function_exists('tutor')) {
    function edubin_register_tutor_tax_language()
    {
        $course_post_type = 'courses';

        $labels = array(
            'name'                       => _x('Course Language', 'taxonomy general name', 'edubin-core'),
            'singular_name'              => _x('Language', 'taxonomy singular name', 'edubin-core'),
            'search_items'               => esc_html__('Search Languages', 'edubin-core'),
            'popular_items'              => esc_html__('Popular Languages', 'edubin-core'),
            'all_items'                  => esc_html__('All Languages', 'edubin-core'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__('Edit Language', 'edubin-core'),
            'update_item'                => esc_html__('Update Language', 'edubin-core'),
            'add_new_item'               => esc_html__('Add New Language', 'edubin-core'),
            'new_item_name'              => esc_html__('New Language Name', 'edubin-core'),
            'separate_items_with_commas' => esc_html__('Separate languages with commas', 'edubin-core'),
            'add_or_remove_items'        => esc_html__('Add or remove languages', 'edubin-core'),
            'choose_from_most_used'      => esc_html__('Choose from the most used languages', 'edubin-core'),
            'not_found'                  => esc_html__('No languages found.', 'edubin-core'),
            'menu_name'                  => esc_html__('Course Languages', 'edubin-core'),
            'back_to_items'              => esc_html__('Back to Languages', 'edubin-core'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_in_rest'          => true,
            'rewrite'               => array('slug' => apply_filters('edubin_tutor_course_language_slug', 'tutor_course_language')),
        );

        register_taxonomy('tutor_course_language', $course_post_type, $args);
    }
    add_action('init', 'edubin_register_tutor_tax_language', 1);

	/*=============================================
	Add language tax submenu for Tutor LMS
	=============================================*/
	function edubin_register_tutor_language_submenu(){
	    $course_post_type = 'courses';
	    add_submenu_page(
	        'tutor',
	        esc_html__('Languages', 'edubin-core'),
	        esc_html__('Languages', 'edubin-core'),
	        'manage_tutor',
	        'edit-tags.php?taxonomy=tutor_course_language&post_type=' . $course_post_type,
	        null,
	        3
	    );
	}

	add_action('admin_menu', 'edubin_register_tutor_language_submenu', 100);

}


/*=============================================
Register language tax for Sensei LMS
=============================================*/
if (!class_exists('Sensei_Main')) {
    function edubin_register_sensei_tax_language()
    {
        $course_post_type = 'course';

        $labels = array(
            'name'                       => _x('Course Language', 'taxonomy general name', 'edubin-core'),
            'singular_name'              => _x('Language', 'taxonomy singular name', 'edubin-core'),
            'search_items'               => esc_html__('Search Languages', 'edubin-core'),
            'popular_items'              => esc_html__('Popular Languages', 'edubin-core'),
            'all_items'                  => esc_html__('All Languages', 'edubin-core'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__('Edit Language', 'edubin-core'),
            'update_item'                => esc_html__('Update Language', 'edubin-core'),
            'add_new_item'               => esc_html__('Add New Language', 'edubin-core'),
            'new_item_name'              => esc_html__('New Language Name', 'edubin-core'),
            'separate_items_with_commas' => esc_html__('Separate languages with commas', 'edubin-core'),
            'add_or_remove_items'        => esc_html__('Add or remove languages', 'edubin-core'),
            'choose_from_most_used'      => esc_html__('Choose from the most used languages', 'edubin-core'),
            'not_found'                  => esc_html__('No languages found.', 'edubin-core'),
            'menu_name'                  => esc_html__('Course Languages', 'edubin-core'),
            'back_to_items'              => esc_html__('Back to Languages', 'edubin-core'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_in_rest'          => true,
            'rewrite'               => array('slug' => apply_filters('edubin_sensei_course_language_slug', 'sensei_course_language')),
        );

        register_taxonomy('sensei_course_language', $course_post_type, $args);
    }
    add_action('init', 'edubin_register_sensei_tax_language', 1);

}


/*=============================================
Register language tax for LifterLMS
=============================================*/
if (!class_exists('LifterLMS')) {
    function edubin_register_lifter_tax_language()
    {

        $course_post_type = 'course';

        $labels = array(
            'name'                       => _x('Course Language', 'taxonomy general name', 'edubin-core'),
            'singular_name'              => _x('Language', 'taxonomy singular name', 'edubin-core'),
            'search_items'               => esc_html__('Search Languages', 'edubin-core'),
            'popular_items'              => esc_html__('Popular Languages', 'edubin-core'),
            'all_items'                  => esc_html__('All Languages', 'edubin-core'),
            'parent_item'                => null,
            'parent_item_colon'          => null,
            'edit_item'                  => esc_html__('Edit Language', 'edubin-core'),
            'update_item'                => esc_html__('Update Language', 'edubin-core'),
            'add_new_item'               => esc_html__('Add New Language', 'edubin-core'),
            'new_item_name'              => esc_html__('New Language Name', 'edubin-core'),
            'separate_items_with_commas' => esc_html__('Separate languages with commas', 'edubin-core'),
            'add_or_remove_items'        => esc_html__('Add or remove languages', 'edubin-core'),
            'choose_from_most_used'      => esc_html__('Choose from the most used languages', 'edubin-core'),
            'not_found'                  => esc_html__('No languages found.', 'edubin-core'),
            'menu_name'                  => esc_html__('Course Languages', 'edubin-core'),
            'back_to_items'              => esc_html__('Back to Languages', 'edubin-core'),
        );

        $args = array(
            'hierarchical'          => false,
            'labels'                => $labels,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var'             => true,
            'show_in_rest'          => true,
            'rewrite'               => array('slug' => apply_filters('edubin_lifter_course_language_slug', 'lifter_course_language')),
        );

        register_taxonomy('lifter_course_language', $course_post_type, $args);
    }
    add_action('init', 'edubin_register_lifter_tax_language', 1);

}

