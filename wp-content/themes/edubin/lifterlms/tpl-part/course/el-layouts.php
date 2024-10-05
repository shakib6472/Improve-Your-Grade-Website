<?php

defined('ABSPATH') || exit();

use \Edubin\Filter;

// Ensure $args is an array if not already set
$args = isset($args) ? $args : array();

// Get the default options from the Edubin_Lif_LMS_Controls method
$default_data = Filter::Edubin_Lif_LMS_Controls();

// Merge the provided options with the default options
$args = wp_parse_args($args, $default_data);

// Get the template part with the specified style from the options
get_template_part('lifterlms/tpl-part/course/el-layout-' . $args['style'], '', $args);
