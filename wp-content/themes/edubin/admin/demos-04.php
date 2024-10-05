<?php

function edubin_after_import_setup($selected_import)
{
    // Assign menus to their locations.
    $main_menu   = get_term_by('name', 'Primary', 'nav_menu');
    $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'primary'     => $main_menu->term_id,
        'footer_menu' => $footer_menu->term_id,
    )
    );
    // LearnPress LMS
    if ('Online Academy (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-academy-learnpress');
    } elseif ('Digital Marketing (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-digital-marketing-learnpress');
    } elseif ('Learning Platform (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-platform-learnpress');
    } elseif ('Coaching Center (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-coaching-center-learnpress');
    } elseif ('Cooking Courses (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-cooking-courses-learnpress');
    } elseif ('Language School (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-language-school-learnpress');
    } elseif ('Online Course (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-course-learnpress');
    } elseif ('Learning Hub (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-hub-learnpress');
    } elseif ('Online Learning (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-learning-learnpress');
    } elseif ('Skill Development (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-skill-development-learnpress');
    } elseif ('Course Hub (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-hub-learnpress');
    } elseif ('Gym Coaching (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-gym-coaching-learnpress');
    } elseif ('Learning Center (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-center-learnpress');
    } elseif ('Kindergarten (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-kindergarten-learnpress');
    } elseif ('Business Coach (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-business-coach-learnpress');
    } elseif ('Education Center (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-education-center-learnpress');
    } elseif ('University (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-learnpress');
    } elseif ('University Classic (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-classic-learnpress');
    } elseif ('Knowledge Hub (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-knowledge-hub-learnpress');
    } elseif ('Classic LMS (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-classic-lms-learnpress');
    } elseif ('Course Portal (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-portal-learnpress');
    } elseif ('Motivation (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-motivation-learnpress');
    } elseif ('Remote Learning (LearnPress)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-remote-learning-learnpress');
    }
    // Tutor LMS
    elseif ('Online Academy (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-academy-tutor');
    } elseif ('Digital Marketing (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-digital-marketing-tutor');
    } elseif ('Learning Platform (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-platform-tutor');
    } elseif ('Coaching Center (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-coaching-center-tutor');
    } elseif ('Cooking Courses (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-cooking-courses-tutor');
    } elseif ('Language School (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-language-school-tutor');
    } elseif ('Online Course (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-course-tutor');
    } elseif ('Skill Development (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-skill-development-tutor');
    } elseif ('Learning Hub (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-hub-tutor');
    } elseif ('Online Learning (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-learning-tutor');
    } elseif ('Course Hub (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-hub-tutor');
    } elseif ('Gym Coaching (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-gym-coaching-tutor');
    } elseif ('Learning Center (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-center-tutor');
    } elseif ('Kindergarten (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-kindergarten-tutor');
    } elseif ('Business Coach (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-business-coach-tutor');
    } elseif ('Education Center (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-education-center-tutor');
    } elseif ('University (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-tutor');
    } elseif ('University Classic (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-classic-tutor');
    } elseif ('Knowledge Hub (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-knowledge-hub-tutor');
    } elseif ('Classic LMS (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-classic-lms-tutor');
    } elseif ('Course Portal (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-portal-tutor');
    } elseif ('Motivation (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-motivation-tutor');
    } elseif ('Remote Learning (Tutor)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-remote-learning-tutor');
    }
    // LearnDash LMS
    elseif ('Online Academy (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-academy-learndash');
    } elseif ('Digital Marketing (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-digital-marketing-learndash');
    } elseif ('Learning Platform (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-platform-learndash');
    } elseif ('Coaching Center (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-coaching-center-learndash');
    } elseif ('Cooking Courses (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-cooking-courses-learndash');
    } elseif ('Language School (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-language-school-learndash');
    } elseif ('Online Course (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-course-learndash');
    } elseif ('Learning Hub (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-hub-learndash');
    } elseif ('Online Learning (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-learning-learndash');
    } elseif ('Skill Development (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-skill-development-learndash');
    } elseif ('Course Hub (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-hub-learndash');
    } elseif ('Gym Coaching (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-gym-coaching-learndash');
    } elseif ('Learning Center (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-center-learndash');
    } elseif ('Kindergarten (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-kindergarten-learndash');
    } elseif ('Business Coach (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-business-coach-learndash');
    } elseif ('Education Center (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-education-center-learndash');
    } elseif ('University (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-learndash');
    } elseif ('University Classic (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-classic-learndash');
    } elseif ('Knowledge Hub (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-knowledge-hub-learndash');
    } elseif ('Classic LMS (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-classic-lms-learndash');
    } elseif ('Course Portal (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-portal-learndash');
    } elseif ('Motivation (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-motivation-learndash');
    } elseif ('Remote Learning (LearnDash)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-remote-learning-learndash');
    }
    // Masterstudy LMS
    elseif ('Online Academy (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-academy-masterstudy');
    } elseif ('Digital Marketing (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-digital-marketing-masterstudy');
    } elseif ('Learning Platform (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-platform-masterstudy');
    } elseif ('Coaching Center (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-coaching-center-masterstudy');
    } elseif ('Cooking Courses (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-cooking-courses-masterstudy');
    } elseif ('Language School (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-language-school-masterstudy');
    } elseif ('Online Course (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-course-masterstudy');
    } elseif ('Learning Hub (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-hub-masterstudy');
    } elseif ('Online Learning (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-learning-masterstudy');
    } elseif ('Skill Development (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-skill-development-masterstudy');
    } elseif ('Course Hub (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-hub-masterstudy');
    } elseif ('Gym Coaching (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-gym-coaching-masterstudy');
    } elseif ('Learning Center (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-center-masterstudy');
    } elseif ('Kindergarten (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-kindergarten-masterstudy');
    } elseif ('Business Coach (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-business-coach-masterstudy');
    } elseif ('Education Center (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-education-center-masterstudy');
    } elseif ('University (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-masterstudy');
    } elseif ('University Classic (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-classic-masterstudy');
    } elseif ('Knowledge Hub (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-knowledge-hub-masterstudy');
    } elseif ('Classic LMS (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-classic-lms-masterstudy');
    } elseif ('Course Portal (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-portal-masterstudy');
    } elseif ('Motivation (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-motivation-masterstudy');
    } elseif ('Remote Learning (Masterstudy)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-remote-learning-masterstudy');
    }
    // Sensei LMS
    elseif ('Online Academy (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-academy-sensei');
    } elseif ('Digital Marketing (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-digital-marketing-sensei');
    } elseif ('Learning Platform (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-platform-sensei');
    } elseif ('Coaching Center (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-coaching-center-sensei');
    } elseif ('Cooking Courses (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-cooking-courses-sensei');
    } elseif ('Language School (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-language-school-sensei');
    } elseif ('Online Course (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-course-sensei');
    } elseif ('Learning Hub (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-hub-sensei');
    } elseif ('Online Learning (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-online-learning-sensei');
    } elseif ('Skill Development (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-skill-development-sensei');
    } elseif ('Course Hub (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-hub-sensei');
    } elseif ('Gym Coaching (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-gym-coaching-sensei');
    } elseif ('Learning Center (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-learning-center-sensei');
    } elseif ('Kindergarten (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-kindergarten-sensei');
    } elseif ('Business Coach (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-business-coach-sensei');
    } elseif ('Education Center (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-education-center-sensei');
    } elseif ('University (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-sensei');
    } elseif ('University Classic (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-university-classic-sensei');
    } elseif ('Knowledge Hub (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-knowledge-hub-sensei');
    } elseif ('Course Portal (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-course-portal-sensei');
    } elseif ('Classic LMS (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-classic-lms-sensei');
    } elseif ('Motivation (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-motivation-sensei');
    } elseif ('Remote Learning (Sensei)' === $selected_import['import_file_name']) {
        $front_page_id = get_page_by_path('home-remote-learning-sensei');
    }
    
    $blog_page_id = get_page_by_title('Blog');
    update_option('show_on_front', 'page');
    $shop_page_id     = get_page_by_title( 'Shop' );
    $cart_page_id     = get_page_by_title( 'Cart' );
    $checkout_page_id = get_page_by_title( 'Checkout' );

    update_option('page_on_front', $front_page_id->ID);
    update_option('page_for_posts', $blog_page_id->ID);

    update_option( 'woocommerce_shop_page_id', $shop_page_id->ID );
    update_option( 'woocommerce_cart_page_id', $cart_page_id->ID );
    update_option( 'woocommerce_checkout_page_id', $checkout_page_id->ID );
    update_option( 'woocommerce_enable_myaccount_registration', 'yes' );

    update_option( 'elementor_container_width', 1200 );
    update_option( 'elementor_disable_color_schemes', 'yes' );
    update_option( 'elementor_disable_typography_schemes', 'yes' );
    update_option( 'elementor_global_image_lightbox', 0 );

    // Reset site permalink
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');

}
add_action('pt-ocdi/after_import', 'edubin_after_import_setup');
