<?php

// Ensure this file is being accessed within the WordPress environment
defined('ABSPATH') || exit();

use \Edubin\Filter;

// Ensure $layout_data is an array if not already set
$layout_data = isset($layout_data) ? $layout_data : array();

// Get the default options from the Edubin_LP_LMS_Controls method
$default_data = Filter::Edubin_LP_LMS_Controls();
$features = $default_data['features'];

// Merge the provided options with the default options
$layout_data = wp_parse_args($layout_data, $default_data);

// Load the template with the specified style from the options
learn_press_get_template('tpl-part/course/el-layout-' . $layout_data['style'] . '.php', compact('layout_data', 'features'));
