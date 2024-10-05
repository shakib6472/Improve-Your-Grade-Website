<?php

defined('ABSPATH') || exit;

//Sets up theme defaults and registers support for various WordPress features.
if ( ! function_exists( 'edubin_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function edubin_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on edubin_, use a find and replace
         * to change 'edubin' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'edubin', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // Add support for Block Styles.
        add_theme_support( 'wp-block-styles' );

        // Add support for full and wide align images.
        add_theme_support( 'align-wide' );

        // Add support for editor styles.
        add_theme_support( 'editor-styles' );

        // Add support for responsive embedded content.
        add_theme_support( 'responsive-embeds' );

        /*
         * Adding Images size.
         *
         * @link https://developer.wordpress.org/reference/functions/add_image_size/
         */
        add_image_size( 'edubin-post-thumb', 590, 430, true );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'edubin' ),
            'footer_menu' => esc_html__('Footer Menu', 'edubin'),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'edubin_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 200,
            'flex-width'  => true,
            'flex-height' => true,
        ) );  

        /**
         * Registers an editor stylesheet for the theme.
         * @link https://developer.wordpress.org/reference/functions/add_editor_style
         * followed twentyseventeen theme and the link above
         */
        add_editor_style( array( 'assets/css/style-editor.css', edubin_main_fonts_url() ) );

        remove_theme_support( 'widgets-block-editor' );


   // Add theme support for Custom Background.
    $args = array(
        'default-color' => '#ffffff',
        'default-image' => '',
    );

    add_theme_support('custom-background', $args);

    $args = array(
        'width'              => 1450,
        'flex-height'        => true,
        'flex-width'         => true,
        'height'             => 480,
        'default-text-color' => '',
        'default-image'      => EDUBIN_URI . '/assets/images/header.jpg',
        'wp-head-callback'   => 'edubin_header_style',
    );
    register_default_headers(array(
        'default-image' => array(
            'url'           => '%s/assets/images/header.jpg',
            'thumbnail_url' => '%s/assets/images/header.jpg',
            'description'   => esc_html__('Default Header Image', 'edubin'),
        ),
    ));
    add_theme_support('custom-header', $args);

    
    }
endif;
add_action( 'after_setup_theme', 'edubin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function edubin_content_width() {
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters( 'edubin_content_width', 640 );
}
add_action( 'after_setup_theme', 'edubin_content_width', 0 );


/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function edubin_pingback_header() {
    if ( is_singular() && pings_open() ) :
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    endif;
}
add_action( 'wp_head', 'edubin_pingback_header' );

/**
 * Edubin get id
 */

if (!function_exists('edubin_array_get')) {
    function edubin_array_get($array, $key, $default = null)
    {
        if (!is_array($array)) {
            return $default;
        }

        return array_key_exists($key, $array) ? $array[$key] : $default;
    }
}

if (!function_exists('edubin_get_id')) {
    function edubin_get_id()
    {
        global $wp_query;
        return $wp_query->get_queried_object_id();
    }
}


/**
 * Course page title section edubin_course_page_title_section_01
 */
if ( ! function_exists( 'edubin_course_page_title_section_01' ) ) :
    function edubin_course_page_title_section_01( $title = null, $has_bg_image = null, $extra_style = null ) {

        $header_title_tag = Edubin::setting( 'header_title_tag' );
        $header_page_title_align = Edubin::setting( 'header_page_title_align' );
        $lp_single_breadcrumb = Edubin::setting( 'lp_single_breadcrumb' );
        $ld_single_breadcrumb = Edubin::setting( 'ld_single_breadcrumb' );
        $ms_single_breadcrumb = Edubin::setting( 'ms_single_breadcrumb' );
        $tutor_single_breadcrumb = Edubin::setting( 'tutor_single_breadcrumb' );
        $sensei_single_breadcrumb = Edubin::setting( 'sensei_single_breadcrumb' );

        echo '<div class="edubin-page-title-area edubin-default-breadcrumb '. esc_attr( $has_bg_image ) .'"' . $extra_style .'>';
            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';
                echo '<div class="edubin-page-title">';
                    echo '<'.$header_title_tag.' class="page-title has-text-align-'.$header_page_title_align.'">';
                        the_title();
                    echo '</'.$header_title_tag.' class="page-title">';
                echo '</div>';

                if ( $lp_single_breadcrumb || $ld_single_breadcrumb || $ms_single_breadcrumb || $tutor_single_breadcrumb || $sensei_single_breadcrumb ) {

                echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                }

            echo '</div>';
            edubin_breadcrumb_shapes();
        echo '</div>';
    }
endif;

// ===== edubin_course_page_title_section_02

if ( ! function_exists( 'edubin_course_page_title_section_02' ) ) :
    function edubin_course_page_title_section_02( $title = null, $has_bg_image = null, $extra_style = null ) {


        $header_title_tag = Edubin::setting( 'header_title_tag' );
        $header_page_title_align = Edubin::setting( 'header_page_title_align' );
        $lp_single_breadcrumb = Edubin::setting( 'lp_single_breadcrumb' );
        $ld_single_breadcrumb = Edubin::setting( 'ld_single_breadcrumb' );
        $ms_single_breadcrumb = Edubin::setting( 'ms_single_breadcrumb' );
        $tutor_single_breadcrumb = Edubin::setting( 'tutor_single_breadcrumb' );
        $sensei_single_breadcrumb = Edubin::setting( 'sensei_single_breadcrumb' );

        $custom_page_header_img = get_post_meta( get_the_ID(), '_edubin_header_img', 1 ); 
        $page_title_image_sourse = ( !empty( $custom_page_header_img )) ? $custom_page_header_img  : get_header_image() ;

        echo '<div style="background-image: url('.$page_title_image_sourse.')" class="edubin-page-title-area edubin-breadcrumb-style-1 edubin-breadcrumb-has-bg '. esc_attr( $has_bg_image ) .'"' . $extra_style .'>';
            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';
                echo '<div class="edubin-page-title">';
                    echo '<h1 class="entry-title">';
                        echo the_title(); 
                    echo '</h1>';
                echo '</div>';

                if ( $lp_single_breadcrumb || $ld_single_breadcrumb || $ms_single_breadcrumb || $tutor_single_breadcrumb || $sensei_single_breadcrumb ) {

                echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';
                
                }
            echo '</div>';
        echo '</div>';
    }
endif;



/*
 * All elementor header
 * return array
 */
function tpc_edubin_get_elementor_header($post_type = 'eb_header')
{
    $options       = array();
    $options       = ['0' => esc_html__('None', 'edubin')];
    $wh_post       = array('posts_per_page' => -1, 'post_type' => $post_type);
    $wh_post_terms = get_posts($wh_post);
    if (!empty($wh_post_terms) && !is_wp_error($wh_post_terms)) {
        foreach ($wh_post_terms as $term) {
            $options[$term->ID] = $term->post_title;
        }
        return $options;
    }
}
/*
 * All elementor footer
 * return array
 */
function tpc_edubin_get_elementor_footer($post_type = 'eb_footer')
{
    $options       = array();
    $options       = ['0' => esc_html__('None', 'edubin')];
    $wh_post       = array('posts_per_page' => -1, 'post_type' => $post_type);
    $wh_post_terms = get_posts($wh_post);
    if (!empty($wh_post_terms) && !is_wp_error($wh_post_terms)) {
        foreach ($wh_post_terms as $term) {
            $options[$term->ID] = $term->post_title;
        }
        return $options;
    }
}

add_action( 'wp_enqueue_scripts', 'enqueue_scripts_for_elementor_header' );
function enqueue_scripts_for_elementor_header() {

    $header_slug = get_post_meta( get_the_ID(), '_edubin_tpc_mb_elementor_header', true );

    if ( $post = get_page_by_path( $header_slug, OBJECT, 'eb_header' ) ) :
        $header_id = $post->ID;
    else:
        $header_id = 0;
    endif;

    $footer_slug = get_post_meta( get_the_ID(), '_edubin_mb_elementor_footer', true );

    if ( $post = get_page_by_path( $footer_slug, OBJECT, 'eb_footer' ) ) :
        $footer_id = $post->ID;
    else:
        $footer_id = 0;
    endif;

        if ( $header_id || $footer_id ) {

            if ( class_exists( '\Elementor\Core\Files\CSS\Post' ) ) {
                $css_file = new \Elementor\Core\Files\CSS\Post( $header_id );
            } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                $css_file = new \Elementor\Post_CSS_File( $header_id );
            } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                $css_file = new \Elementor\Post_CSS_File( $footer_id );
            } elseif ( class_exists( '\Elementor\Post_CSS_File' ) ) {
                $css_file = new \Elementor\Post_CSS_File( $footer_id );
            }
            
            $css_file->enqueue();
        }

}


