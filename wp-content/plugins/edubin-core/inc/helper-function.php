<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/*
 * Elementor category
 */

function edubin_elementor_init( $elements_manager ) {

    $categories = [];
    $categories['edubin-core'] =
        [
            'title' => 'Edubin Addons',
            'icon'  => 'eicon-navigator'
        ];

    $old_categories = $elements_manager->get_categories();
    $categories = array_merge($categories, $old_categories);

    $set_categories = function ( $categories ) {
        $this->categories = $categories;
    };

    $set_categories->call( $elements_manager, $categories );

}

add_action( 'elementor/elements/categories_registered', 'edubin_elementor_init', 20) ;

/*
 * Elementor category
 */
// function edubin_elementor_init()
// {
//     \Elementor\Plugin::instance()->elements_manager->add_category(
//         'edubin-core',
//         [
//             'title' => 'Edubin Addons',
//             'icon'  => 'font',
//         ],
//         1
//     );
// }
// add_action('elementor/init', 'edubin_elementor_init');

/*
 * Plugisn Options value
 * return on/off
 */
// function edubin_core_get_option($option, $section, $default = '')
// {

//     $options = get_option($section);
//     if (isset($options[$option])) {
//         return $options[$option];
//     }
//     return $default;
// }

/*
 * Elementor Templates List
 * return array
 */
function edubin_elementor_template()
{
    $templates = \Elementor\Plugin::instance()->templates_manager->get_source('local')->get_items();
    $types     = array();
    if (empty($templates)) {
        $template_lists = ['0' => __('Do not Saved Templates.', 'edubin-core')];
    } else {
        $template_lists = ['0' => __('Select Template', 'edubin-core')];
        foreach ($templates as $template) {
            $template_lists[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
        }
    }
    return $template_lists;
}

/*
 * Sidebar Widgets List
 * return array
 */
// function edubin_sidebar_options()
// {
//     global $wp_registered_sidebars;
//     $sidebar_options = array();

//     if (!$wp_registered_sidebars) {
//         $sidebar_options['0'] = __('No sidebars were found', 'edubin-core');
//     } else {
//         $sidebar_options['0'] = __('Select Sidebar', 'edubin-core');
//         foreach ($wp_registered_sidebars as $sidebar_id => $sidebar) {
//             $sidebar_options[$sidebar_id] = $sidebar['name'];
//         }
//     }
//     return $sidebar_options;
// }

/*
 * Get Taxonomy
 * return array
 */
function edubin_get_taxonomies($edubin_texonomy = 'category')
{
    $terms = get_terms(array(
        'taxonomy'   => $edubin_texonomy,
        'hide_empty' => true,
    ));
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
        return $options;
    }
}

/*
 * Get Post Type
 * return array
 */
function edubin_get_post_types($args = [])
{

    $post_type_args = [
        'show_in_nav_menus' => true,
    ];
    if (!empty($args['post_type'])) {
        $post_type_args['name'] = $args['post_type'];
    }
    $_post_types = get_post_types($post_type_args, 'objects');

    $post_types = [];
    foreach ($_post_types as $post_type => $object) {
        $post_types[$post_type] = $object->label;
    }
    return $post_types;
}

/*
 * HTML Tag list
 * return array
 */
function edubin_html_tag_lists()
{
    $html_tag_list = [
        'h1'   => __('H1', 'edubin-core'),
        'h2'   => __('H2', 'edubin-core'),
        'h3'   => __('H3', 'edubin-core'),
        'h4'   => __('H4', 'edubin-core'),
        'h5'   => __('H5', 'edubin-core'),
        'h6'   => __('H6', 'edubin-core'),
        'p'    => __('p', 'edubin-core'),
        'div'  => __('div', 'edubin-core'),
        'span' => __('span', 'edubin-core'),
    ];
    return $html_tag_list;
}

/*
 * Contact form list
 * return array
 */
function edubin_contact_form_seven()
{
    $countactform      = array();
    $edubin_forms_args = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
    $edubin_forms      = get_posts($edubin_forms_args);

    if ($edubin_forms) {
        foreach ($edubin_forms as $edubin_form) {
            $countactform[$edubin_form->ID] = $edubin_form->post_title;
        }
    } else {
        $countactform[esc_html__('No contact form found', 'edubin-core')] = 0;
    }
    return $countactform;
}

/*
 * All Post Name
 * return array
 */
// function edubin_post_name($post_type = 'post')
// {
//     $options       = array();
//     $options       = ['0' => esc_html__('None', 'edubin-core')];
//     $wh_post       = array('posts_per_page' => -1, 'post_type' => $post_type);
//     $wh_post_terms = get_posts($wh_post);
//     if (!empty($wh_post_terms) && !is_wp_error($wh_post_terms)) {
//         foreach ($wh_post_terms as $term) {
//             $options[$term->ID] = $term->post_title;
//         }
//         return $options;
//     }
// }
/*
 * All elementor header
 * return array
 */
// function edubin_get_elementor_header($post_type = 'eb_header')
// {
//     $options       = array();
//     $options       = ['0' => esc_html__('None', 'edubin-core')];
//     $wh_post       = array('posts_per_page' => -1, 'post_type' => $post_type);
//     $wh_post_terms = get_posts($wh_post);
//     if (!empty($wh_post_terms) && !is_wp_error($wh_post_terms)) {
//         foreach ($wh_post_terms as $term) {
//             $options[$term->ID] = $term->post_title;
//         }
//         return $options;
//     }
// }
/*
 * All elementor footer
 * return array
 */
// function edubin_get_elementor_footer($post_type = 'eb_footer')
// {
//     $options       = array();
//     $options       = ['0' => esc_html__('None', 'edubin-core')];
//     $wh_post       = array('posts_per_page' => -1, 'post_type' => $post_type);
//     $wh_post_terms = get_posts($wh_post);
//     if (!empty($wh_post_terms) && !is_wp_error($wh_post_terms)) {
//         foreach ($wh_post_terms as $term) {
//             $options[$term->ID] = $term->post_title;
//         }
//         return $options;
//     }
// }

/*
 * Caldera Form
 * @return array
 */
// function edubin_caldera_forms_options()
// {
//     if (class_exists('Caldera_Forms')) {
//         $caldera_forms = Caldera_Forms_Forms::get_forms(true, true);
//         $form_options  = ['0' => esc_html__('Select Form', 'edubin-core')];
//         $form          = array();
//         if (!empty($caldera_forms) && !is_wp_error($caldera_forms)) {
//             foreach ($caldera_forms as $form) {
//                 if (isset($form['ID']) and isset($form['name'])) {
//                     $form_options[$form['ID']] = $form['name'];
//                 }
//             }
//         }
//     } else {
//         $form_options = ['0' => esc_html__('Form Not Found!', 'edubin-core')];
//     }
//     return $form_options;
// }

/*
 * Check user Login and call this function
 */
// global $user;
// if (empty($user->ID)) {
//     add_action('elementor/init', 'edubin_ajax_login_init');
// }

// /*
//  * wp_ajax_nopriv Function
//  */
// function edubin_ajax_login_init()
// {
//     add_action('wp_ajax_nopriv_edubin_ajax_login', 'edubin_ajax_login');
// }

/*
 * ajax login
 */
// function edubin_ajax_login()
// {
//     check_ajax_referer('ajax-login-nonce', 'security');
//     $user_data                  = array();
//     $user_data['user_login']    = !empty($_POST['username']) ? $_POST['username'] : "";
//     $user_data['user_password'] = !empty($_POST['password']) ? $_POST['password'] : "";
//     $user_data['remember']      = true;
//     $user_signon                = wp_signon($user_data, false);

//     if (is_wp_error($user_signon)) {
//         echo json_encode(['loggeauth' => false, 'message' => esc_html__('Invalid username or password!', 'edubin-core')]);
//     } else {
//         echo json_encode(['loggeauth' => true, 'message' => esc_html__('Login successfully, Redirecting...', 'edubin-core')]);
//     }
//     die();
// }

/*
 * Redirect 404 page select from plugins options
 */
// function edubin_redirect_404()
// {
//     $errorpage_id = edubin_core_get_option('errorpage', 'edubin_general_tabs');
//     if (is_404() && !empty($errorpage_id)) {
//         wp_redirect(esc_url(get_page_link($errorpage_id)));die();
//     }
// }
// add_action('template_redirect', 'edubin_redirect_404');

/*=============================================
Post views
=============================================*/
// function to display number of posts.
// function edubinGetPostViews($postID)
// {
//     $count_key = 'post_views_count';
//     $count     = get_post_meta($postID, $count_key, true);
//     if ($count == '') {
//         delete_post_meta($postID, $count_key);
//         add_post_meta($postID, $count_key, '0');
//         esc_html_e('0', 'edubin');
//     }
//     echo esc_html($count . '');
// }

// function to count views.
// function edubinSetPostViews($postID)
// {
//     $count_key = 'post_views_count';
//     $count     = get_post_meta($postID, $count_key, true);
//     if ($count == '') {
//         $count = 0;
//         delete_post_meta($postID, $count_key);
//         add_post_meta($postID, $count_key, '0');
//     } else {
//         $count++;
//         update_post_meta($postID, $count_key, $count);
//     }
// }

/*=============================================
Post views custom
=============================================*/
// function to display number of posts.
// function edubinGetPostViewsCustom($postID)
// {
//     $count_key = 'custom_views_number';
//     $count     = get_post_meta($postID, $count_key, true);
//     if ($count == '') {
//         delete_post_meta($postID, $count_key);
//         add_post_meta($postID, $count_key, '0');
//         esc_html_e('0', 'edubin');
//     }
//     echo esc_html($count . '');
// }

// function to count views.
// function edubinSetPostViewsCustom($postID)
// {
//     $count_key = 'custom_views_number';
//     $count     = get_post_meta($postID, $count_key, true);
//     if ($count == '') {
//         $count = 0;
//         delete_post_meta($postID, $count_key);
//         add_post_meta($postID, $count_key, '0');
//     } else {
//         $count++;
//         update_post_meta($postID, $count_key, $count);
//     }
// }

/*=============================================
=  Disable Tribe Select2 on non-tribe admin pages   =
=============================================*/
if (is_admin()) {
    if (!function_exists('edubin_theme_disable_tribe_select2')) {
        function edubin_theme_disable_tribe_select2()
        {
            $screen = get_current_screen();
            if ('tribe_events' === $screen->id) {
                return;
            }
            $tribe_post_types = array(
                'tribe_events',
                'tribe_venue',
            );
            if (in_array($screen->post_type, $tribe_post_types)) {
                return;
            }
            wp_deregister_script('tribe-select2');
        }
        add_action('admin_enqueue_scripts', 'edubin_theme_disable_tribe_select2', 99);
    }
}

/*=============================================
=  * Get Taxonomy for posts * return array   =
=============================================*/
if (!function_exists('edubin_posts_get_taxonomies')) {
    function edubin_posts_get_taxonomies($posts_category = 'category')
    {
        $terms = get_terms(array(
            'taxonomy'   => $posts_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Taxonomy for woocommerce shop * return array   =
=============================================*/
if (!function_exists('edubin_wooocommerce_shop_get_taxonomies')) {
    function edubin_wooocommerce_shop_get_taxonomies($woo_shop_category = 'product_cat')
    {
        $terms = get_terms(array(
            'taxonomy'   => $woo_shop_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Taxonomy for the events calender * return array   =
=============================================*/
if (!function_exists('edubin_tribe_events_get_taxonomies')) {
    function edubin_tribe_events_get_taxonomies($tribe_events_category = 'tribe_events_cat')
    {
        $terms = get_terms(array(
            'taxonomy'   => $tribe_events_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Taxonomy for learnpress lms * return array   =
=============================================*/
if (!function_exists('edubin_learpress_get_taxonomies')) {
    function edubin_learpress_get_taxonomies($lp_course_category = 'course_category')
    {
        $terms = get_terms(array(
            'taxonomy'   => $lp_course_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Taxonomy for learndash lms * return array   =
=============================================*/
if (!function_exists('edubin_learndash_get_taxonomies')) {

    function edubin_learndash_get_taxonomies($ld_course_category = 'ld_course_category')
    {
        $terms = get_terms(array(
            'taxonomy'   => $ld_course_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Taxonomy for learndash croups lms * return array   =
=============================================*/
if (!function_exists('edubin_learndash_group_get_taxonomies')) {

    function edubin_learndash_group_get_taxonomies($ld_group_category = 'ld_group_category')
    {
        $terms = get_terms(array(
            'taxonomy'   => $ld_group_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Tag for Learndash groups lms * return array   =
=============================================*/
if (!function_exists('edubin_learndash_groups_get_tag')) {
    function edubin_learndash_groups_get_tag($learndash_groups_course_tag = 'ld_groups_tag')
    {
        $terms = get_terms(array(
            'taxonomy'   => $learndash_groups_course_tag,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Tag for learndash lms * return array   =
=============================================*/
if (!function_exists('edubin_learndash_get_tag')) {
    function edubin_learndash_get_tag($learndash_course_tag = 'ld_course_tag')
    {
        $terms = get_terms(array(
            'taxonomy'   => $learndash_course_tag,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Taxonomy for tutor lms * return array   =
=============================================*/
if (!function_exists('edubin_tutor_get_taxonomies')) {
    function edubin_tutor_get_taxonomies($tutor_course_category = 'course-category')
    {
        $terms = get_terms(array(
            'taxonomy'   => $tutor_course_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Tag for tutor lms * return array   =
=============================================*/
if (!function_exists('edubin_tutor_get_tag')) {
    function edubin_tutor_get_tag($tutor_course_tag = 'course-tag')
    {
        $terms = get_terms(array(
            'taxonomy'   => $tutor_course_tag,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Taxonomy for sensei lms * return array   =
=============================================*/
if (!function_exists('edubin_sensei_get_taxonomies')) {
    function edubin_sensei_get_taxonomies($sensei_course_category = 'course-category')
    {
        $terms = get_terms(array(
            'taxonomy'   => $sensei_course_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Get Tag for sensei lms * return array   =
=============================================*/
if (!function_exists('edubin_sensei_get_tag')) {
    function edubin_sensei_get_tag($sensei_course_tag = 'course-tag')
    {
        $terms = get_terms(array(
            'taxonomy'   => $sensei_course_tag,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}
/*=============================================
=  * Count user post in filter addon   =
=============================================*/
function edubin_sensei_course_level( $level = null ) {

        $levels = apply_filters(
            'edubin_sensei_course_level_key',
            array(
                'all_levels'   => __( 'All Levels', 'edubin-core' ),
                'beginner'     => __( 'Beginner', 'edubin-core' ),
                'intermediate' => __( 'Intermediate', 'edubin-core' ),
                'expert'       => __( 'Expert', 'edubin-core' ),
            )
        );

        if ( $level ) {
            if ( isset( $levels[ $level ] ) ) {
                return $levels[ $level ];
            } else {
                return '';
            }
        }

        return $levels;
    }



    
/**
 * Author additional fields
 */
if ( ! function_exists( 'edubin_additional_user_fields' ) ) :
    function edubin_additional_user_fields( $contactmethods ) {
        $contactmethods['edubin_job']   = __( 'Instructor Job', 'edubin-core' );
        $contactmethods['edubin_facebook']  = __( 'Facebook', 'edubin-core' );
        $contactmethods['edubin_twitter']   = __( 'Twitter', 'edubin-core' );
        $contactmethods['edubin_youtube']  = __( 'YoutTube', 'edubin-core' );
        $contactmethods['edubin_linkedin']   = __( 'LinkedIn', 'edubin-core' );
    
        return $contactmethods;
    }
endif;
add_filter( 'user_contactmethods', 'edubin_additional_user_fields', 10, 1 );


/*
 * HTML Tag list
 * return array
 */
if( !function_exists('edubin_html_tag_lists') ){
    function edubin_html_tag_lists() {
        $html_tag_list = [
            'h1'   => __( 'H1', 'edubin-core' ),
            'h2'   => __( 'H2', 'edubin-core' ),
            'h3'   => __( 'H3', 'edubin-core' ),
            'h4'   => __( 'H4', 'edubin-core' ),
            'h5'   => __( 'H5', 'edubin-core' ),
            'h6'   => __( 'H6', 'edubin-core' ),
            'p'    => __( 'p', 'edubin-core' ),
            'div'  => __( 'div', 'edubin-core' ),
            'span' => __( 'span', 'edubin-core' ),
        ];
        return $html_tag_list;
    }
}

/*
 * HTML Tag Validation
 * return strig
 */
function edubin_validate_html_tag( $tag ) {
    $allowed_html_tags = [
        'article',
        'aside',
        'footer',
        'header',
        'section',
        'nav',
        'main',
        'div',
        'h1',
        'h2',
        'h3',
        'h4',
        'h5',
        'h6',
        'p',
        'span',
    ];
    return in_array( strtolower( $tag ), $allowed_html_tags ) ? $tag : 'div';
}

/*
 * Contact form list
 * return array
 */
if( !function_exists('edubin_contact_form_seven') ){
    function edubin_contact_form_seven(){
        $countactform = array();
        $edubin_forms_args = array( 'posts_per_page' => -1, 'post_type'=> 'wpcf7_contact_form' );
        $edubin_forms = get_posts( $edubin_forms_args );

        if( $edubin_forms ){
            foreach ( $edubin_forms as $edubin_form ){
                $countactform[$edubin_form->ID] = $edubin_form->post_title;
            }
        }else{
            $countactform[ esc_html__( 'No contact form found', 'edubin-core' ) ] = 0;
        }
        return $countactform;
    }
}

/*
 * All list of allowed html tags.
 *
 * @param string $tag_type Allowed levels are title and desc
 * @return array
 */
function edubin_get_html_allowed_tags($tag_type = 'title') {
    $accept_html_tags = [
        'span'   => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'strong' => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'br'     => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],        
        'b'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'sub'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'sup'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'i'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'u'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        's'      => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'em'     => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'del'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'ins'    => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],

        'code'   => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'mark'   => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'small'  => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'strike' => [
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
        'abbr'   => [
            'title' => [],
            'class' => [],
            'id'    => [],
            'style' => [],
        ],
    ];

    if ('desc' === $tag_type) {
        $desc_tags = [
            'h1' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h2' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h3' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h4' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h5' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'h6' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'p' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'a'       => [
                'href'  => [],
                'title' => [],
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'q'       => [
                'cite'  => [],
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'img'     => [
                'src'    => [],
                'alt'    => [],
                'height' => [],
                'width'  => [],
                'class'  => [],
                'id'     => [],
                'title'  => [],
                'style'  => [],
            ],
            'dfn'     => [
                'title' => [],
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'time'    => [
                'datetime' => [],
                'class'    => [],
                'id'       => [],
                'style'    => [],
            ],
            'cite'    => [
                'title' => [],
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'acronym' => [
                'title' => [],
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'hr'      => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],
            'div' => [
                'class' => [],
                'id'    => [],
                'style' => []
            ],
           
            'button' => [
                'class' => [],
                'id'    => [],
                'style' => [],
            ],

        ];

        $accept_html_tags = array_merge($accept_html_tags, $desc_tags);
    }

    return $accept_html_tags;
}
/*
 * Escaping function for allow html tags
 * Title escaping function
 */

function edubin_kses_title( $string = '' ) {
    return wp_kses($string, edubin_get_html_allowed_tags( 'title' ));
}

/*
 * Escaping function for allow html tags
 * Description escaping function
 */
function edubin_kses_desc( $string = '' ) {
    return wp_kses($string, edubin_get_html_allowed_tags( 'desc' ));
}


/*
 * Get Taxonomy
 * return array
 */
if( !function_exists('edubin_get_taxonomies') ){
    function edubin_get_taxonomies( $edubin_texonomy = 'category' ){
        $terms = get_terms( array(
            'taxonomy' => $edubin_texonomy,
            'hide_empty' => true,
        ));
        $options = array();
        if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
                $options[ $term->slug ] = $term->name;
            }
            return $options;
        }
    }
}


/*
 * All Taxonomie Category Load
 * return Array
*/
if( !function_exists('all_object_taxonomie_show_catagory') ){
    function all_object_taxonomie_show_catagory($taxonomieName){

        $allTaxonomie =  get_object_taxonomies($taxonomieName);
        if(isset($allTaxonomie['0'])){
            if($allTaxonomie['0'] == "product_type"){
                $allTaxonomie['0'] = 'product_cat';
            }
            return edubin_get_taxonomies($allTaxonomie['0']);
        }
    }
}


/*
 * Get Post Type
 * return array
 */
if( !function_exists('edubin_get_post_types') ){
    function edubin_get_post_types( $args = [] ) {
        $post_type_args = [
            'show_in_nav_menus' => true,
        ];
        if ( ! empty( $args['post_type'] ) ) {
            $post_type_args['name'] = $args['post_type'];
        }
        $_post_types = get_post_types( $post_type_args , 'objects' );

        $post_types  = [];
        if( !empty( $args['defaultadd'] ) ){
            $post_types[ strtolower($args['defaultadd']) ] = ucfirst($args['defaultadd']);
        }
        foreach ( $_post_types as $post_type => $object ) {
            $post_types[ $post_type ] = $object->label;
        }
        return $post_types;
    }
}

/**
 * Get all Authors List
 *
 * @return array
 */
if( !function_exists('edubin_get_authors_list') ){
    function edubin_get_authors_list() {
        $args = [
            'capability'          => [ 'edit_posts' ],
            'has_published_posts' => true,
            'fields'              => [
                'ID',
                'display_name',
            ],
        ];

        // Version check 5.9.
        if ( version_compare( $GLOBALS['wp_version'], '5.9-alpha', '<' ) ) {
            $args['who'] = 'authors';
            unset( $args['capability'] );
        }

        $authors = get_users( $args );

        if ( ! empty( $authors ) ) {
            return wp_list_pluck( $authors, 'display_name', 'ID' );
        }

        return [];
    }
}


/**
 * Escaped title html tags
 *
 * @param string $tag input string of title tag
 * @return string $default default tag will be return during no matches
 */
if (!function_exists('edubin_escape_tags')) {
    function edubin_escape_tags($tag, $default = 'span', $extra = [])
    {

        $supports = ['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span', 'p'];

        $supports = array_merge($supports, $extra);

        if (!in_array($tag, $supports, true)) {
            return $default;
        }

        return $tag;
    }
}


/*
 * Elementor Templates List
 * return array
 */
if( !function_exists('edubin_elementor_template') ){
    function edubin_elementor_template( $args = [] ) {
        if( class_exists('\Elementor\Plugin') ){
            $template_instance = \Elementor\Plugin::instance()->templates_manager->get_source( 'local' );
            
            $defaults = [
                'post_type' => 'elementor_library',
                'post_status' => 'publish',
                'posts_per_page' => -1,
                'orderby' => 'title',
                'order' => 'ASC',
                'meta_query' => [
                    [
                        'key' => '_elementor_template_type',
                        'value' => $template_instance::get_template_types()
                    ],
                ],
            ];
            $query_args = wp_parse_args( $args, $defaults );

            $templates_query = new \WP_Query( $query_args );

            $templates = [];
            if ( $templates_query->have_posts() ) {
                $templates = [ '0' => __( 'Select Template', 'edubin-core' ) ];
                foreach ( $templates_query->get_posts() as $post ) {
                    $templates[$post->ID] = $post->post_title . '(' . $template_instance::get_template_type( $post->ID ). ')';
                }
            }else{
                $templates = [ '0' => __( 'Do not Saved Templates.', 'edubin-core' ) ];
            }

            wp_reset_query();

            return $templates;

        }else{
            return array( '0' => __( 'Do not Saved Templates.', 'edubin-core' ) );
        }
    }
}

/*=============================================
=  * Get Taxonomy for posts * return array   =
=============================================*/
if (!function_exists('edubin_posts_get_taxonomies')) {
    function edubin_posts_get_taxonomies($posts_category = 'category')
    {
        $terms = get_terms(array(
            'taxonomy'   => $posts_category,
            'hide_empty' => false,
        ));
        if (!empty($terms) && !is_wp_error($terms)) {
            foreach ($terms as $term) {
                $options[$term->slug] = $term->name;
            }
            return $options;
        }
    }
}

/*=============================================
Retrieves all registered navigation menu.
=============================================*/
if (!function_exists('edubin_get_custom_menu')) {

    function edubin_get_custom_menu()
    {
        $nav_menus = [];
        $terms     = wp_get_nav_menus();
        foreach ($terms as $term) {
            $nav_menus[$term->name] = $term->name;
        }

        return $nav_menus;
    }
}