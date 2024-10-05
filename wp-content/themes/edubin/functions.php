<?php
/**
 * Theme functions and definitions
 *
 * @package Edubin
 */

// Define constants for theme directory and URI
define('EDUBIN_DIR', trailingslashit(get_template_directory()));
define('EDUBIN_URI', trailingslashit(get_template_directory_uri()));

// Define constant for theme version
define('EDUBIN_THEME_VERSION', wp_get_theme()->get('Version'));

// Define constant for LearnPress course custom post type if not already defined
if (!defined('LP_COURSE_CPT')) {
    define('LP_COURSE_CPT', 'lp_course');
}

/**
 * Load Theme Dependencies
 */
require_once get_theme_file_path('/inc/theme-dependencies.php');
