<?php

function ocdi_before_content_import($selected_import)
{
    // Customizer reset
    delete_option('theme_mods_' . get_option('stylesheet'));
    // Old style.
    $theme_name = get_option('current_theme');
    if (false === $theme_name) {
        $theme_name = wp_get_theme()->get('edubin');
    }
    delete_option('mods_' . $theme_name);

    // Activate/Deactivate plugins
    // Check LearnPress LMS
        $learnpress_imports = [
            'Online Academy (LearnPress)', 'Digital Marketing (LearnPress)', 'Learning Platform (LearnPress)', 
            'Coaching Center (LearnPress)', 'Cooking Courses (LearnPress)', 'Language School (LearnPress)', 
            'Online Course (LearnPress)', 'Learning Hub (LearnPress)', 'Online Learning (LearnPress)', 'Skill Development (LearnPress)', 
            'Course Hub (LearnPress)', 'Gym Coaching (LearnPress)', 'Learning Center (LearnPress)', 
            'Kindergarten (LearnPress)', 'Business Coach (LearnPress)', 'Education Center (LearnPress)', 
            'University (LearnPress)', 'University Classic (LearnPress)', 'Knowledge Hub (LearnPress)', 'Classic LMS (LearnPress)', 
            'Course Portal (LearnPress)', 'Motivation (LearnPress)', 'Remote Learning (LearnPress)'
        ];

        $learndash_imports = [
            'Online Academy (LearnDash)', 'Digital Marketing (LearnDash)', 'Learning Platform (LearnDash)', 
            'Coaching Center (LearnDash)', 'Cooking Courses (LearnDash)', 'Language School (LearnDash)', 
            'Online Course (LearnDash)', 'Learning Hub (LearnDash)', 'Online Learning (LearnDash)', 'Skill Development (LearnDash)', 
            'Course Hub (LearnDash)', 'Gym Coaching (LearnDash)', 'Learning Center (LearnDash)', 
            'Kindergarten (LearnDash)', 'Business Coach (LearnDash)', 'Education Center (LearnDash)', 
            'University (LearnDash)', 'University Classic (LearnDash)', 'Knowledge Hub (LearnDash)', 'Classic LMS (LearnDash)', 
            'Course Portal (LearnDash)', 'Motivation (LearnDash)', 'Remote Learning (LearnDash)'
        ];

        $tutor_imports = [
            'Online Academy (Tutor)', 'Digital Marketing (Tutor)', 'Learning Platform (Tutor)', 
            'Coaching Center (Tutor)', 'Cooking Courses (Tutor)', 'Language School (Tutor)', 
            'Online Course (Tutor)', 'Learning Hub (Tutor)', 'Online Learning (Tutor)', 'Skill Development (Tutor)', 
            'Course Hub (Tutor)', 'Gym Coaching (Tutor)', 'Learning Center (Tutor)', 
            'Kindergarten (Tutor)', 'Business Coach (Tutor)', 'Education Center (Tutor)', 
            'University (Tutor)', 'University Classic (Tutor)', 'Knowledge Hub (Tutor)', 'Classic LMS (Tutor)', 
            'Course Portal (Tutor)', 'Motivation (Tutor)', 'Remote Learning (Tutor)'
        ];

        $sensei_imports = [
            'Online Academy (Sensei)', 'Digital Marketing (Sensei)', 'Learning Platform (Sensei)', 
            'Coaching Center (Sensei)', 'Cooking Courses (Sensei)', 'Language School (Sensei)', 
            'Online Course (Sensei)', 'Learning Hub (Sensei)', 'Online Learning (Sensei)', 'Skill Development (Sensei)', 
            'Course Hub (Sensei)', 'Gym Coaching (Sensei)', 'Learning Center (Sensei)', 
            'Kindergarten (Sensei)', 'Business Coach (Sensei)', 'Education Center (Sensei)', 
            'University (Sensei)', 'University Classic (Sensei)', 'Knowledge Hub (Sensei)',  'Classic LMS (Sensei)', 
            'Course Portal (Sensei)', 'Motivation (Sensei)', 'Remote Learning (Sensei)'
        ];   
        $masterstudy_imports = [
            'Online Academy (Masterstudy)', 'Digital Marketing (Masterstudy)', 'Learning Platform (Masterstudy)', 
            'Coaching Center (Masterstudy)', 'Cooking Courses (Masterstudy)', 'Language School (Masterstudy)', 
            'Online Course (Masterstudy)', 'Learning Hub (Masterstudy)', 'Online Learning (Masterstudy)', 'Skill Development (Masterstudy)', 
            'Course Hub (Masterstudy)', 'Gym Coaching (Masterstudy)', 'Learning Center (Masterstudy)', 
            'Kindergarten (Masterstudy)', 'Business Coach (Masterstudy)', 'Education Center (Masterstudy)', 
            'University (Masterstudy)', 'University Classic (Masterstudy)', 'Knowledge Hub (Masterstudy)',  'Classic LMS (Masterstudy)', 
            'Course Portal (Masterstudy)', 'Motivation (Masterstudy)', 'Remote Learning (Masterstudy)'
        ];

        if (in_array($selected_import['import_file_name'], $learnpress_imports)) {


        if (function_exists('tutor')) {
            deactivate_plugins('/tutor/tutor.php');
        }
        if (function_exists('tutor_pro')) {
            deactivate_plugins('/tutor-pro/tutor-pro.php');
        }
        if (class_exists('SFWD_LMS')) {
            deactivate_plugins('/sfwd-lms/sfwd_lms.php');
        }
        if (class_exists('Sensei_Main' )) {
            deactivate_plugins('/sensei-lms/sensei-lms.php');
        }
        if (class_exists('MasterStudy\Lms\Plugin')) {
            deactivate_plugins('/masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php');
        }
        // $plugin_file = WP_PLUGIN_DIR . '/learnpress/learnpress.php';
        // if (file_exists($plugin_file) && !is_plugin_active('learnpress/learnpress.php')) {
        //     activate_plugin('/learnpress/learnpress.php');
        // }
        // $plugin_file = WP_PLUGIN_DIR . '/learnpress-course-review/learnpress-course-review.php';
        // if (file_exists($plugin_file) && !is_plugin_active('learnpress-course-review/learnpress-course-review.php')) {
        //     activate_plugin('/learnpress-course-review/learnpress-course-review.php');
        // }
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');

    } 

    // Check Tutor LMS
    elseif (in_array($selected_import['import_file_name'], $tutor_imports)) {

        if (class_exists('LearnPress')) {
            deactivate_plugins('/learnpress/learnpress.php');
        }
        if (class_exists('SFWD_LMS')) {
            deactivate_plugins('/sfwd-lms/sfwd_lms.php');
        }
        if (class_exists('Sensei_Main' )) {
            deactivate_plugins('/sensei-lms/sensei-lms.php');
        }
        if (class_exists('MasterStudy\Lms\Plugin')) {
            deactivate_plugins('/masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php');
        }
        $plugin_file = WP_PLUGIN_DIR . '/tutor/tutor.php';
        if (file_exists($plugin_file) && !is_plugin_active('tutor/tutor.php')) {
            activate_plugin('/tutor/tutor.php');
        }
        $plugin_file = WP_PLUGIN_DIR . '/tutor-pro/tutor-pro.php';
        if (file_exists($plugin_file) && !is_plugin_active('tutor-pro/tutor-pro.php')) {
            activate_plugin('/tutor-pro/tutor-pro.php');
        }
        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 

    // Check LearnDash LMS
    elseif (in_array($selected_import['import_file_name'], $learndash_imports)) {
        if (function_exists('tutor')) {
            deactivate_plugins('/tutor/tutor.php');
        }
        if (function_exists('tutor_pro')) {
            deactivate_plugins('/tutor-pro/tutor-pro.php');
        }
        if (class_exists('Sensei_Main' )) {
            deactivate_plugins('/sensei-lms/sensei-lms.php');
        }
        if (class_exists('LearnPress')) {
            deactivate_plugins('/learnpress/learnpress.php');
        }
        if (class_exists('MasterStudy\Lms\Plugin')) {
            deactivate_plugins('/masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php');
        }
        $plugin_file = WP_PLUGIN_DIR . '/sfwd-lms/sfwd_lms.php';
        if (file_exists($plugin_file) && !is_plugin_active('sfwd-lms/sfwd_lms.php')) {
            activate_plugin('/sfwd-lms/sfwd_lms.php');
        }

        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    
    // Check Masterstudy LMS
    elseif (in_array($selected_import['import_file_name'], $masterstudy_imports)) {
        if (function_exists('tutor')) {
            deactivate_plugins('/tutor/tutor.php');
        }
        if (function_exists('tutor_pro')) {
            deactivate_plugins('/tutor-pro/tutor-pro.php');
        }
        if (class_exists('Sensei_Main' )) {
            deactivate_plugins('/sensei-lms/sensei-lms.php');
        }
        if (class_exists('LearnPress')) {
            deactivate_plugins('/learnpress/learnpress.php');
        }
        $plugin_file = WP_PLUGIN_DIR . '/masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php';
        if (file_exists($plugin_file) && !is_plugin_active('masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php')) {
            activate_plugin('/masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php');
        }

        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    
    // Check Sensei LMS
    elseif (in_array($selected_import['import_file_name'], $sensei_imports)) {
        
        if (function_exists('tutor')) {
            deactivate_plugins('/tutor/tutor.php');
        }
        if (function_exists('tutor_pro')) {
            deactivate_plugins('/tutor-pro/tutor-pro.php');
        }
        if (class_exists('LearnPress')) {
            deactivate_plugins('/learnpress/learnpress.php');
        }
        if (class_exists('SFWD_LMS')) {
            deactivate_plugins('/sfwd-lms/sfwd_lms.php');
        }
        if (class_exists('MasterStudy\Lms\Plugin')) {
            deactivate_plugins('/masterstudy-lms-learning-management-system/masterstudy-lms-learning-management-system.php');
        }
        $plugin_file = WP_PLUGIN_DIR . '/sensei-lms/sensei-lms.php';
        if (file_exists($plugin_file) && !is_plugin_active('sensei-lms/sensei-lms.php')) {
            activate_plugin('/sensei-lms/sensei-lms.php');
        }

        global $wp_rewrite;
        $wp_rewrite->set_permalink_structure('/%postname%/');
    } 
    
    // Check Kids/School
    // elseif ('Kids/School' === $selected_import['import_file_name']) {
    //     if (function_exists('tutor')) {
    //         deactivate_plugins('/tutor/tutor.php');
    //     }
    //     if (function_exists('tutor_pro')) {
    //         deactivate_plugins('/tutor-pro/tutor-pro.php');
    //     }
    //     if (class_exists('SFWD_LMS')) {
    //         deactivate_plugins('/sfwd-lms/sfwd_lms.php');
    //     }
    //     if (class_exists('Sensei_Main' )) {
    //         deactivate_plugins('/sensei-lms/sensei-lms.php');
    //     }
    //     if (class_exists('LearnPress')) {
    //         deactivate_plugins('/learnpress/learnpress.php');
    //     }
    //     if (class_exists('LP_Addon_Course_Review_Preload')) {
    //         deactivate_plugins('/learnpress-course-review/learnpress-course-review.php');
    //     }

    //     global $wp_rewrite;
    //     $wp_rewrite->set_permalink_structure('/%postname%/');
    // }
}
add_action('pt-ocdi/before_content_import', 'ocdi_before_content_import');

