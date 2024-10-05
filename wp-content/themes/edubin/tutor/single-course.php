<?php
/**
 * Template for displaying single course
 *
 * @package Tutor\Templates
 * @author Themeum <support@themeum.com>
 * @link https://themeum.com
 * @since 1.0.0
 */

$tutor_single_page_layout = Edubin::setting('tutor_single_page_layout');

if (in_array($tutor_single_page_layout, ['1', '2', '3', '4', '5'])) {
    get_template_part('tutor/tpl-part/single/single-layout', $tutor_single_page_layout);
}
?>
