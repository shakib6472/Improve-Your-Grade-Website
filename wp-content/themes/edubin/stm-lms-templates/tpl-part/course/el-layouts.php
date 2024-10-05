<?php

defined('ABSPATH') || exit();

use \Edubin\Filter;

// Ensure $get_options is an array if not already set
$get_options = isset($get_options) ? $get_options : array();

// Get the default options from the Edubin_MS_LMS_Controls method
$default_options = Filter::Edubin_MS_LMS_Controls();

// Merge the provided options with the default options
$get_options = wp_parse_args($get_options, $default_options);

// Show the LMS template with the specified style from the options
STM_LMS_Templates::show_lms_template('tpl-part/course/el-layout-' . $get_options['style'], compact('get_options'));
