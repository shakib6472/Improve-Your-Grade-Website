<?php
defined( 'ABSPATH' ) || exit;

class Edubin {

	/**
	 * Get settings for Kirki
	 *
	 * @param string $option_name
	 * @param string $default
	 *
	 * @return mixed
	 */
	public static function setting( $option_name = '', $default = '' ) {
		$value = Edubin_Kirki::get_option( 'edubin_theme_config', $option_name );

		$value = $value === null ? $default : $value;

		return $value;
	}

}
