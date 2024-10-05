<?php

/**
 * A single course loop
 *
 * @package Tutor\Templates
 * @subpackage CourseLoopPart
 * @author Themeum
 * @link https://themeum.com
 * @since 1.4.3
 */

defined('ABSPATH') || exit();

use \Edubin\Filter;

// Ensure $get_options is set as an array if not already provided
$get_options = isset($get_options) ? $get_options : array();

// Retrieve the course archive style setting if $style is not already set
$style = isset($style) ? $style : Edubin::setting('tutor_course_archive_style');

// Override $style if 'course_preset' is present in the URL query parameters
if (isset($_GET['course_preset'])) {
    $style = Filter::grid_layout_keys();
}

// Set the default data array with the style
$default_data = array(
    'style' => $style
);

// Merge the provided $get_options with the default data
$get_options = wp_parse_args($get_options, $default_data);

// Ensure $column is set to default values if not already provided
$column = isset($column) ? $column : apply_filters('edubin_course_archive_grid_column', array('edubin-col-lg-4 edubin-col-md-6 edubin-col-sm-12'));

// Load the template with the specified layout style
tutor_load_template('tpl-part.course.th-layouts', compact('get_options'));

?>
