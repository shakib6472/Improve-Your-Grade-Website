<?php
defined( 'ABSPATH' ) || exit;

/**
 * Setup for customizer of this theme
 */
if ( ! class_exists( 'Edubin_Customize' ) ) {
	class Edubin_Customize {

		protected static $instance = null;

		protected static $override_settings = array();

		public static function instance() {
			if ( null === self::$instance ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function initialize() {
			// Build URL for customizer.
			add_filter( 'kirki_values_get_value', array( $this, 'kirki_db_get_theme_mod_value' ), 10, 2 );

			// Load customizer sections when all widgets init.
			add_action( 'init', array( $this, 'load_customizer' ), 99 );


			/**
			 * Override kirki settings with url preset or post meta preset.
			 * Used priority 11 to wait global variables loaded.
			 *
			 * @see Edubin_Global->init_global_variable()
			 */
			add_action( 'wp', array( $this, 'setup_override_settings' ), 11 );
		}

		function setup_override_settings() {

			// Make preset in meta box.
			
			// if ( ! is_customize_preview() ) {
			// 	$presets = apply_filters( 'edubin_page_meta_box_presets', array() );

			// 	if ( ! empty( $presets ) ) {
			// 		foreach ( $presets as $preset ) {
			// 			$page_preset_value = Edubin_Helper::get_post_meta( $preset );
			// 			if ( $page_preset_value !== false ) {
			// 				$_GET[ $preset ] = $page_preset_value;
			// 			}
			// 		}
			// 	}
			// }

			// Setup url.
			if ( empty( self::$override_settings ) ) {

				/**
				 * Use child theme selected preset for any demos.
				 */
				$selected_presets = apply_filters( 'edubin_settings_preset', array() );
				if ( ! empty( $selected_presets ) ) {
					foreach ( $selected_presets as $key => $selected_preset ) {
						$_GET[ $key ] = $selected_preset;
					}
				}

				if ( ! empty( $_GET ) ) {

					foreach ( $_GET as $key => $query_value ) {
						if ( class_exists( 'Kirki' ) && ! empty( Kirki::$fields[ $key ] ) ) {

							if ( is_array( Kirki::$fields[ $key ] ) &&
							     ( in_array( Kirki::$fields[ $key ]['type'], [
								     'kirki-preset',
								     'kirki-select',
							     ] ) ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ] ) &&
							     ! empty( Kirki::$fields[ $key ]['args']['choices'][ $query_value ]['settings'] )
							) {
								$field_choice = Kirki::$fields[ $key ]['args']['choices'];
								foreach ( $field_choice[ $query_value ]['settings'] as $kirki_setting => $kirki_value ) {
									self::$override_settings[ $kirki_setting ] = $kirki_value;
								}
							} else {
								self::$override_settings[ $key ] = $query_value;
							}
						}
					}
				}
			}
		}

		/**
		 * Build URL for customizer
		 *
		 * @param $value
		 * @param $setting
		 *
		 * @return mixed
		 */
		public function kirki_db_get_theme_mod_value( $value, $setting ) {
			if ( ! is_customize_preview() && ! empty( self::$override_settings ) && isset( self::$override_settings["{$setting}"] ) ) {
				return self::$override_settings["{$setting}"];
			}

			return $value;
		}

		/**
		 * Load Customizer.
		 */
		public function load_customizer() {
			if ( class_exists( 'Kirki' ) ) {
	            /** Customizer additions. */
	            require_once EDUBIN_DIR . '/inc/customizer/customizer.php';
	        }
		}

	}

	Edubin_Customize::instance()->initialize();
}
