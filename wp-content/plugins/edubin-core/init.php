<?php
namespace EdubinCore;

/**
	 Plugin class
 */
class Plugin {

	/**
	 * Instance
	 *
	 * @static
	 *
	 * @var Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @return Plugin An instance of the class.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) :
			self::$_instance = new self();
		endif;
		return self::$_instance;
	}

	/**
	 *
	 * Load core plugin scripts
	 */
	public function registered_scripts() {

		// Edubin Core plugin CSS
		wp_enqueue_style( 'edubin-core-css', plugins_url( '/assets/css/edubin-core.css', __FILE__ ), '', EDUBIN_CORE_VERSION );

		// ViewPort JS ****
		wp_register_script( 'jquery-viewport', plugins_url( '/assets/js/isInViewport.jquery.min.js', __FILE__ ), array( 'jquery' ), EDUBIN_CORE_VERSION, true );

		// Edubin animation
		wp_register_script( 'edubin-animation', plugins_url( '/assets/js/edubin-animation.min.js', __FILE__ ), array( 'jquery' ), EDUBIN_CORE_VERSION, true );

		// Conterup JS
		wp_register_script( 'jquery-counterup', plugins_url( '/assets/js/jquery.counterup.min.js', __FILE__ ), array( 'jquery' ), EDUBIN_CORE_VERSION, true );

        // Waypoints JS
        wp_register_script( 'jquery-waypoints', plugins_url( '/assets/js/jquery.waypoints.min.js', __FILE__ ), array( 'jquery' ), EDUBIN_CORE_VERSION, true );

        // CountDown JS
        // wp_register_script( 'jquery-countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array( 'jquery' ), EDUBIN_CORE_VERSION, true );

        // Tilt JS
        wp_register_script( 'jquery-tilt', get_template_directory_uri() . '/assets/js/tilt.jquery.min.js', array( 'jquery' ), EDUBIN_CORE_VERSION, true );

        // imagesLoaded JS
        wp_register_script( 'jquery-imagesloaded', plugins_url( '/assets/js/imagesloaded.pkgd.min.js', __FILE__ ), array( 'jquery' ), EDUBIN_CORE_VERSION, true );

		// Youtube Pop Up
        wp_register_script( 'jquery-youtubepopup', get_template_directory_uri() . '/assets/js/youtube-popup.js', array( 'jquery' ), EDUBIN_CORE_VERSION, true );

        // Animated Text JS
      //  wp_register_script( 'typed-js', plugins_url( '/assets/js/typed.min.js', __FILE__ ), array( 'jquery' ), EDUBIN_CORE_VERSION, true );

		// Vivus Animation JS
		//wp_register_script( 'vivus', plugins_url( '/assets/js/vivus.min.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );

	}

	/**
	 *
	 * Load required plugin core files.
	 */
	public function enqueued_scripts() {

		wp_enqueue_script( 'edubin-active', plugins_url( '/assets/js/edubin-active.js', __FILE__ ), array( 'jquery' ), EDUBIN_CORE_VERSION, true );
		
		wp_localize_script( 'edubin-active', 'edubin_frontend_ajax_object',
            array(
                'ajaxurl' => admin_url( 'admin-ajax.php' )
            ) 
        );
	}

	/**
	 * editor_enqueued_scripts
	 *
	 */
	public function editor_enqueued_scripts() {
		wp_enqueue_style( 'edubin-elementor-editor', get_template_directory_uri() . '/assets/css/edubin-elementor-editor.css', '', EDUBIN_CORE_VERSION );
	}

	/**
	 * Enqueued Scripts for wishlist
	 */
	public function edubin_core_enqueued_scripts() {
		
		wp_enqueue_script( 'edubin-core-wishlist', plugins_url( '/assets/js/edubin-wishlist.js', __FILE__ ), array( 'jquery', 'edubin-sal-js', 'edubin-tipped' ), EDUBIN_CORE_VERSION, true );
		
		$phpStringPass = array(
			'login_notice_lp_text' => __( 'You need to Login first.', 'edubin-core' )
		);

		wp_add_inline_script( 'edubin-core-wishlist', 'const php_strings = ' . json_encode( $phpStringPass ), 'before' );

		wp_localize_script( 'edubin-core-wishlist', 'edubin_wishlist_data', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'ajax_nonce' => wp_create_nonce( 'edubin-wishlist-ajax-connect' )
		));
	}

	private function plugin_active( $plugin ) {
		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		if ( is_plugin_active( $plugin ) ) :
			return true;
		endif;

		return false;
	}

	/**
	 * Include Widgets files
	 *
	 */
	private function include_widgets_files() {
		
		include_once( __DIR__ . '/elementor/widgets/info-box.php' );
		include_once( __DIR__ . '/elementor/widgets/section-1.php' );
		include_once( __DIR__ . '/elementor/widgets/section-2.php' );
		include_once( __DIR__ . '/elementor/widgets/section-3.php' );
		include_once( __DIR__ . '/elementor/widgets/section-4.php' );
		include_once( __DIR__ . '/elementor/widgets/section-5.php' );
		include_once( __DIR__ . '/elementor/widgets/section-6.php' );
		include_once( __DIR__ . '/elementor/widgets/teachers.php' );
		include_once( __DIR__ . '/elementor/widgets/programs.php' );
		include_once( __DIR__ . '/elementor/widgets/search.php' );
		include_once( __DIR__ . '/elementor/widgets/countdown.php' );
		include_once( __DIR__ . '/elementor/widgets/cta.php' );
		include_once( __DIR__ . '/elementor/widgets/custom-icon.php' );
		include_once( __DIR__ . '/elementor/widgets/delimiter.php' );
		include_once( __DIR__ . '/elementor/widgets/course-categories.php' );
		include_once( __DIR__ . '/elementor/widgets/course-instructor.php' );
		include_once( __DIR__ . '/elementor/widgets/section-title.php' );
		include_once( __DIR__ . '/elementor/widgets/title.php' );
		include_once( __DIR__ . '/elementor/widgets/join-login-logout.php' );
		include_once( __DIR__ . '/elementor/widgets/logo.php' );
		include_once( __DIR__ . '/elementor/widgets/wpforms.php' );
		include_once( __DIR__ . '/elementor/widgets/contact-form-7.php' );
		include_once( __DIR__ . '/elementor/widgets/event-custom.php' );
		include_once( __DIR__ . '/elementor/widgets/icon-text.php' );
		include_once( __DIR__ . '/elementor/widgets/video-popup.php' );
		include_once( __DIR__ . '/elementor/widgets/testimonial.php' );
		include_once( __DIR__ . '/elementor/widgets/category-carousel.php' );
		include_once( __DIR__ . '/elementor/widgets/slider-advanced.php' );
		include_once( __DIR__ . '/elementor/widgets/slider-basic.php' );
		include_once( __DIR__ . '/elementor/widgets/blog-post.php' );
		include_once( __DIR__ . '/elementor/widgets/shape-animation.php' );
		include_once( __DIR__ . '/elementor/widgets/button.php' );
		include_once( __DIR__ . '/elementor/widgets/copyright.php' );
		include_once( __DIR__ . '/elementor/widgets/footer-menu.php' );
		include_once( __DIR__ . '/elementor/widgets/services.php' );
		include_once( __DIR__ . '/elementor/widgets/woo-product.php' );
		include_once( __DIR__ . '/elementor/widgets/woo-cart.php' );
		include_once( __DIR__ . '/elementor/widgets/accordion.php' );
		include_once( __DIR__ . '/elementor/widgets/counter.php' );
		include_once( __DIR__ . '/elementor/widgets/courses.php' );
		include_once( __DIR__ . '/elementor/widgets/nav-menu.php' );
		include_once( __DIR__ . '/elementor/widgets/menu-list.php' );

		if ( class_exists( 'LearnPress' ) ) :
			include_once( __DIR__ . '/elementor/widgets/courses-lp.php' );
			include_once( __DIR__ . '/elementor/widgets/course-filter-lp.php' );
		endif;

		if ( class_exists( 'SFWD_LMS' ) ) :
			include_once( __DIR__ . '/elementor/widgets/courses-ld-options.php' );
			include_once( __DIR__ . '/elementor/widgets/courses-ld.php' );
			include_once( __DIR__ . '/elementor/widgets/course-filter-ld.php' );
		endif;

		if ( function_exists( 'tutor' ) ) :
			include_once( __DIR__ . '/elementor/widgets/courses-tutor-options.php' );
			include_once( __DIR__ . '/elementor/widgets/courses-tutor.php' );
			include_once( __DIR__ . '/elementor/widgets/course-filter-tutor.php' );
		endif; 

		if ( class_exists( 'Sensei_Main' ) ) :
			include_once( __DIR__ . '/elementor/widgets/courses-sensei.php' );
			include_once( __DIR__ . '/elementor/widgets/course-filter-sensei.php' );
		endif; 

		if ( class_exists( 'MasterStudy\Lms\Plugin' ) ) :
			include_once( __DIR__ . '/elementor/widgets/courses-ms-options.php' );
			include_once( __DIR__ . '/elementor/widgets/courses-ms.php' );
			include_once( __DIR__ . '/elementor/widgets/course-filter-ms.php' );
		endif; 

		if ( class_exists( 'LifterLMS' ) ) :
			include_once( __DIR__ . '/elementor/widgets/courses-lifter-options.php' );
			include_once( __DIR__ . '/elementor/widgets/courses-lifter.php' );
			include_once( __DIR__ . '/elementor/widgets/course-filter-lifter.php' );
		endif; 

		if ( class_exists( 'WPEMS' ) ) :
			include_once( __DIR__ . '/elementor/widgets/event-wpem.php' );
		endif; 

		if ( class_exists( 'Tribe__Events__Main' ) ) :
			include_once( __DIR__ . '/elementor/widgets/event-tribe.php' );
		endif; 
	}

	/**
	 *
	 * Register Elementor widgets.
	 *
	 */
	public function register_widgets() {
		// Its is now safe to include Widgets files
		$this->include_widgets_files();

		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Logo() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Button() );

		if ( class_exists( 'LearnPress' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Courses() );
			\Elementor\Plugin::instance()->widgets_manager->register( new LP\Widgets\Course_Filter() );
		endif;

		if ( class_exists( 'SFWD_LMS' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new LD\Widgets\Courses() );
			\Elementor\Plugin::instance()->widgets_manager->register( new LD\Widgets\Course_Filter() );
		endif;

		if ( function_exists( 'tutor' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new TL\Widgets\Courses() );
			\Elementor\Plugin::instance()->widgets_manager->register( new TL\Widgets\Course_Filter() );
		endif;

		if ( class_exists( 'Sensei_Main' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new SS\Widgets\Courses() );
			\Elementor\Plugin::instance()->widgets_manager->register( new SS\Widgets\Course_Filter() );
		endif;

		if ( class_exists('MasterStudy\Lms\Plugin') ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new MS\Widgets\Courses() );
			\Elementor\Plugin::instance()->widgets_manager->register( new MS\Widgets\Course_Filter() );
		endif;

		if ( class_exists( 'LifterLMS' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new LI\Widgets\Courses() );
			\Elementor\Plugin::instance()->widgets_manager->register( new LI\Widgets\Course_Filter() );
		endif;

		if ( class_exists( 'WPEMS' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new Events\Widgets\WP_Events_Manager() );
		endif;

			
		if ( class_exists( 'Tribe__Events__Main' ) ) :
			\Elementor\Plugin::instance()->widgets_manager->register( new Events\Widgets\Edubin_Elementor_Widget_Event_Calendar() );
		endif;

		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Custom_Icon() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Icon_Text() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Info_box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Search() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Teachers() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Testimonial() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Latest_Post() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Programs() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_WPforms() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Countdown() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Accordion() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_CTA() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Animation() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Delimiter() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Course_Category_Custom() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Course_Instructor() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Join_Login_Logout() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Contact_Form_Seven() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Custom_Event() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Video_PopUp() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Icon_Category() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Edubin_Slider() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Slider_Pro() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Section_Title() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\edubin_Elementor_Widget_Services_Box() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Woo_Product() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_WooCart() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Section_1() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Section_2() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Section_3() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Section_4() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Section_5() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Elementor_Widget_Section_6() );
		\Elementor\Plugin::instance()->widgets_manager->register( new Widgets\Edubin_Counter_Up() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Edubin_Copyright() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Edubin_Footer_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Nav_Menu() );
		\Elementor\Plugin::instance()->widgets_manager->register( new HF\Widgets\Menu_List() );

	}

	/**
     * 
     * Includes all Files
     */
	public function includes() {

		require_once( __DIR__ . '/inc/kirki/kirki.php' );
		require_once( __DIR__ . '/inc/cmb2/init.php' );
		require_once( __DIR__ . '/inc/cmb2-tabs/cmb2-tabs.php' );
		require_once( __DIR__ . '/inc/copyright-shortcode.php' );
		require_once( __DIR__ . '/inc/edubin-helper-class.php' );
		require_once( __DIR__ . '/inc/helper-function.php' );
		require_once( __DIR__ . '/inc/edubin-icons.php' );
		require_once( __DIR__ . '/inc/wpem/helper-class.php' );

	}

	/**
     * 
     * Includes all Traits
     */
	public function traits() {
		require_once( __DIR__ . '/inc/Traits/Button.php' );
		require_once( __DIR__ . '/inc/Traits/Grid.php' );
		require_once( __DIR__ . '/inc/Traits/Posts.php' );
		require_once( __DIR__ . '/inc/Traits/Events.php' );
		require_once( __DIR__ . '/inc/Traits/Slider.php' );
		require_once( __DIR__ . '/inc/Traits/Slider_Arrows.php' );
		require_once( __DIR__ . '/inc/Traits/Slider_Dots.php' );
		require_once( __DIR__ . '/inc/Traits/Taxonomy.php' );
		require_once( __DIR__ . '/inc/Traits/Users.php' );
	}

	/**
     * 
     * Includes all Post Types
     */
	public function post_types() {
		require_once( __DIR__ . '/inc/post-types/megamenu.php' );
		require_once( __DIR__ . '/inc/post-types/header.php' );
		require_once( __DIR__ . '/inc/post-types/footer.php' );
	}

	/**
     * 
     * Includes all Widgets
     */
	public function widgets() {
		require_once( __DIR__ . '/inc/widgets/posts.php' );
	}

	/**
     * 
     * Custom animation
     */
	public function extra_entrance_animations( $animations = array() ) {
		$entrance_animations = array(
			'Edubin Extra Animations' => [
				'edubin--scale'       => __( 'Scale', 'edubin-core' ),
				'edubin--fancy'       => __( 'Fancy', 'edubin-core' ),
				'edubin--slide-up'    => __( 'Slide Up', 'edubin-core' ),
				'edubin--slide-left'  => __( 'Slide Left', 'edubin-core' ),
				'edubin--slide-right' => __( 'Slide Right', 'edubin-core' ),
				'edubin--slide-down'  => __( 'Slide Down', 'edubin-core' )
			]
		);
		return array_merge( $animations, $entrance_animations );
	}

	/**
	 * Register plugin action hooks and filters
	 */
	public function __construct() {
		// Enqueued scripts
		add_action( 'wp_enqueue_scripts', [ $this, 'edubin_core_enqueued_scripts' ] );

		// Register widget scripts
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'registered_scripts' ] );
		
		// Enqueued widget scripts
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueued_scripts' ] );

		// Elementor Editor Styles
        add_action( 'elementor/editor/after_enqueue_scripts', [ $this, 'editor_enqueued_scripts' ] );
		
		// Register widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Additional Entrance Animations
		add_filter( 'elementor/controls/animations/additional_animations', [ $this, 'extra_entrance_animations' ], 10 );

		// Load Files
		$this->includes();

		// Load Traits
		$this->traits();

		// Load Post Types
		$this->post_types();

		// Load Widgets
		$this->widgets();
	}
}

// Instantiate Plugin Class
$theme = wp_get_theme();
if ( 'Edubin' === $theme->name || 'Edubin' === $theme->parent_theme ) :
	Plugin::instance();
endif;

// Shortcode 
require_once( __DIR__ . '/inc/shortcodes/shortcode-social.php' );
require_once( __DIR__ . '/inc/shortcodes/shortcode-quick-info.php' );



