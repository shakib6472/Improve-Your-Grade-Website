<?php
/**
 * The Template for displaying single events page.
 *
 * Override this template by copying it to yourtheme/wp-events-manager/single-event.php
 *
 * @author        ThimPress, leehld
 * @package       WP-Events-Manager/Template
 * @version       2.1.7
 */
defined( 'ABSPATH' ) || exit;

get_header();

echo '<div class="tpc-event-details tpc-site-content-inner' . esc_attr( apply_filters( 'edubin_container_class', ' edubin-container' ) ) . '">';
    echo '<div class="edubin-main-content-inner">';

        wpems_get_template_part( 'content', 'single-event' );

    echo '</div>';
echo '</div>';

get_footer();