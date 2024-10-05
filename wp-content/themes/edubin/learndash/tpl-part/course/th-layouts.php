<?php

defined('ABSPATH') || exit();

use \Edubin\Filter;

// Ensure $args is an array if not already set
$args = isset($args) ? $args : array();

// Get the default options from the Edubin_LD_LMS_Controls method
$default_data = Filter::Edubin_LD_LMS_Controls();

// Merge the provided options with the default options
$args = wp_parse_args($args, $default_data);

// Get the template part with the specified style from the options
get_template_part('learndash/tpl-part/course/th-layout-' . $args['style'], '', $args);
