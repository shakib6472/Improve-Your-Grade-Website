<?php
/**
 * Template for displaying archive courses breadcrumb.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/global/breadcrumb.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

defined( 'ABSPATH' ) || exit();

$lp_single_page_layout = Edubin::setting( 'lp_single_page_layout' );

if ($lp_single_page_layout == '2') : // The section visible only for layout 2


if ( empty( $breadcrumb ) ) {
	return;
}
echo esc_attr($wrap_before);

foreach ( $breadcrumb as $key => $crumb ) {

	echo esc_attr($before);

	echo '<li>';

	if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
		echo '<a href="' . esc_url( $crumb[1] ) . '"><span>' . esc_html( $crumb[0] ) . '</span></a>';
	} else {
		echo '<span>' . esc_html( $crumb[0] ) . '</span>';
	}

	echo '</li>';

	echo esc_attr($after);

	if ( sizeof( $breadcrumb ) !== $key + 1 ) {
		echo esc_attr($delimiter);
	}
}

echo esc_attr($wrap_after);

endif; // End section only visible for layout 2 
