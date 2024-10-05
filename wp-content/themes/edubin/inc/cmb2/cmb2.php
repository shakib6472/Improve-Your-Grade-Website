<?php
defined('ABSPATH') || exit;

require_once get_template_directory() . '/inc/cmb2/page.php';

// Include LearnPress settings
if (class_exists('LearnPress')) {
    require_once get_template_directory() . '/inc/cmb2/lp.php';
}

// Include MasterStudy settings
if (class_exists('MasterStudy\Lms\Plugin')) {
    require_once get_template_directory() . '/inc/cmb2/ms.php';
}

// Include LearnDash settings
if (class_exists('SFWD_LMS')) {
    require_once get_template_directory() . '/inc/cmb2/ld.php';
}

// Include Tutor LMS settings
if (function_exists('tutor')) {
    require_once get_template_directory() . '/inc/cmb2/tutor.php';
}

// Include Sensei LMS settings
if (class_exists('Sensei_Main')) {
    require_once get_template_directory() . '/inc/cmb2/sensei.php';
}

// Include Lifter LMS settings
if (class_exists('LifterLMS')) {
    require_once get_template_directory() . '/inc/cmb2/lifter.php';
}

// Include Tribe Events settings
if (class_exists('Tribe__Events__Main')) {
    require_once get_template_directory() . '/inc/cmb2/tribe-events.php';
}

// Include WPEMS settings
if (class_exists('WPEMS')) {
    require_once get_template_directory() . '/inc/cmb2/tp-event.php';
}

// Include Zoom Video Conferencing settings
if (class_exists('Zoom_Video_Conferencing_Api')) {
    require_once get_template_directory() . '/inc/cmb2/zoom.php';
}
