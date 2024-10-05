<?php
defined( 'ABSPATH' ) || exit;

/**
 * This is a wrapper class for Kirki.
 * If the Kirki plugin is installed, then all CSS & Google fonts
 * will be handled by the plugin.
 * In case the plugin is not installed, this acts as a fallback
 * ensuring that all CSS & fonts still work.
 * It does not handle the customizer options, simply the frontend CSS.
 */
class Edubin_Kirki {

	/**
	 * The config ID.
	 *
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $config = array();

	/**
	 * An array of all our fields.
	 *
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $fields = array();

	/**
	 * An array of all our typography fields.
	 *
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $typography_fields = array();

	/**
	 * An array of all our translatable fields.
	 *
	 * @static
	 * @access protected
	 * @var array
	 */
	protected static $translation_fields = array();

	protected static $instance = null;

	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * The class constructor
	 */
	public function initialize() {
		// If Kirki exists then there's no reason to proceed.
		if ( class_exists( 'Kirki' ) ) {
			return;
		}
	}

	/**
	 * @return array List field id that can translate in admin text.
	 */
	public function get_translation_fields_id() {
		return self::$translation_fields;
	}

	/**
	 * @return string Get list key tags that add in <admin-texts></admin-texts> of WPML config file.
	 */
	public function get_key_string_wpml_config() {
		$fields          = $this->get_translation_fields_id();
		$wpml_key_string = '';
		foreach ( $fields as $id ) {
			$wpml_key_string .= '<key name="' . $id . '"/>';
		}

		return $wpml_key_string;
	}

	/**
	 * Get the value of an option from the db.
	 *
	 * @param string $config_id The ID of the configuration corresponding to this field.
	 * @param string $field_id  The field_id (defined as 'settings' in the field arguments).
	 *
	 * @return mixed            The saved value of the field.
	 */
	public static function get_option( $config_id = '', $field_id = '' ) {

		// if Kirki exists, use it.
		if ( class_exists( 'Kirki' ) ) {
			return Kirki::get_option( $config_id, $field_id );
		}

		// Kirki does not exist, continue with our custom implementation.
		// Get the default value of the field.
		$default = '';
		if ( isset( self::$fields[ $field_id ] ) && isset( self::$fields[ $field_id ]['default'] ) ) {
			$default = self::$fields[ $field_id ]['default'];
		}

		// Make sure the config is defined.
		if ( isset( self::$config[ $config_id ] ) ) {
			if ( 'option' == self::$config[ $config_id ]['option_type'] ) {

				// check if we're using serialized options.
				if ( isset( self::$config[ $config_id ]['option_name'] ) && ! empty( self::$config[ $config_id ]['option_name'] ) ) {

					// Get all our options.
					$all_options = get_option( self::$config[ $config_id ]['option_name'], array() );

					// If our option is not saved, return the default value.
					// If option was set, return its value unserialized.
					return ( ! isset( $all_options[ $field_id ] ) ) ? $default : maybe_unserialize( $all_options[ $field_id ] );
				}

				// If we're not using serialized options, get the value and return it.
				// We'll be using a dummy default here to check if the option has been set or not.
				// We'll be using md5 to make sure it's randomish and impossible to be actually set by a user.
				$dummy = md5( $config_id . '_UNDEFINED_VALUE' );
				$value = get_option( $field_id, $dummy );

				// setting has not been set, return default.
				return ( $dummy === $value ) ? $default : $value;
			}

			// We're not using options so fallback to theme_mod.
			return get_theme_mod( $field_id, $default );
		}
	}

	/**
	 * Create a new panel.
	 *
	 * @param string $id   The ID for this panel.
	 * @param array  $args The panel arguments.
	 */
	public static function add_panel( $id = '', $args = array() ) {
		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_panel( $id, $args );
		}
		/* If Kirki does not exist then there's no reason to add any panels. */
	}

	/**
	 * Create a new section.
	 *
	 * @param string $id   The ID for this section.
	 * @param array  $args The section arguments.
	 */
	public static function add_section( $id, $args ) {
		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_section( $id, $args );
		}
		/* If Kirki does not exist then there's no reason to add any sections. */
	}

	/**
	 * Sets the configuration options.
	 *
	 * @param string $config_id The configuration ID.
	 * @param array  $args      The configuration arguments.
	 */
	public static function add_config( $config_id, $args = array() ) {

		// if Kirki exists, use it.
		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_config( $config_id, $args );

			return;
		}

		// Kirki does not exist, set the config arguments.
		self::$config[ $config_id ] = $args;

		// Make sure an option_type is defined.
		if ( ! isset( self::$config[ $config_id ]['option_type'] ) ) {
			self::$config[ $config_id ]['option_type'] = 'theme_mod';
		}
	}

	/**
	 * Create a new field
	 *
	 * @param string $config_id The configuration ID.
	 * @param array  $args      The field's arguments.
	 *
	 * @return null
	 */
	public static function add_field( $config_id, $args ) {

		// if Kirki exists, use it.
		if ( class_exists( 'Kirki' ) ) {
			Kirki::add_field( $config_id, $args );

			return;
		}
	}


}

Edubin_Kirki::instance()->initialize();
