<?php

 if ( ! defined( 'ABSPATH' ) ) exit;
 
require_once get_template_directory() . '/learndash/tpl-part/review/class-review.php';

require_once get_template_directory() . '/inc/class-ld.php';

add_filter( 'edubin_currency_symbols', 'edubin_ld_course_currency_symbols' );

add_action( 'pre_get_posts', 'edubin_ld_custom_query_for_author' );
if ( ! function_exists( 'edubin_ld_custom_query_for_author' ) ) :
    function edubin_ld_custom_query_for_author( $query ) {
        $author_redirect_to_courses = apply_filters( 'edubin_ld_author_redirect_to_course', false );
        if ( is_admin() || ! $query->is_main_query() ) :
            return;
        endif;

        if ( isset( $_GET['ldauthor'] ) ) :
            $ldauthor = $_GET['ldauthor'];
        else :
            $ldauthor = false;
        endif;

        if ( is_author() && ( 'true' == $ldauthor ) && ( true == $author_redirect_to_courses ) ) :
            $query->set( 'post_type', array( 'sfwd-courses' ) );
        endif;
    }
endif;

/**
 * LearnDash specific scripts & stylesheets.
 *
 * @return void
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_ld_scripts' ) ) :
    function edubin_ld_scripts() {
        wp_enqueue_style( 'edubin-ld-style', get_template_directory_uri() . '/assets/css/learndash.css', array(), EDUBIN_THEME_VERSION );
        if ( is_singular( 'sfwd-courses' ) ) :
            wp_enqueue_style( 'jquery-fancybox' );
            wp_enqueue_script( 'jquery-fancybox' );
        endif;
    }
endif;
add_action( 'wp_enqueue_scripts', 'edubin_ld_scripts' );

/**
 * post_class extends for learndash courses
 * 
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_ld_course_class' ) ) :
    function edubin_ld_course_class( $default = array() ) {
        $terms      = get_the_terms( get_the_ID(), 'ld_course_category' );
        $terms_html = array();
        if ( is_array( $terms ) ) :
            foreach ( $terms as $term ) :
                $terms_html[] = $term->slug;
            endforeach;
        endif;
        $all_classes = array_merge( $terms_html, $default );
        $classes = apply_filters( 'edubin_ld_course_class', $all_classes );
        post_class( $classes );
    }
endif;

/**
 * Content area class
 */
add_filter( 'edubin_content_area_class', 'edubin_ld_content_area_class' );

if ( ! function_exists( 'edubin_ld_content_area_class' ) ) :
    function edubin_ld_content_area_class ( $class ) {

        if ( is_post_type_archive( 'sfwd-courses' ) || is_tax( 'ld_course_category' ) || is_tax( 'ld_course_tag' ) ) :

            $course_layout = 'full_width';

            if ( 'right' === $course_layout ) :
                $class = 'edubin-col-lg-9';
            elseif ( 'left' === $course_layout ) :
                $class = 'edubin-col-lg-9 edubin-order-1';
            elseif ( 'full_width' === $course_layout ) :
                $class = 'edubin-col-lg-12';
            endif;
        endif;

        if ( is_singular( 'sfwd-courses' ) ) :
            
            $single_course_layout = 'full_width';

            if ( 'right' ===  $single_course_layout ) :
                $class = 'edubin-col-lg-9';
            elseif ( 'left' === $single_course_layout ) :
                $class = 'edubin-col-lg-9 edubin-order-1';
            elseif ( 'full_width' === $single_course_layout ) :
                $class = 'edubin-col-lg-12';
            endif;
        endif;

        return $class;
    }
endif;

/**
 * Content area class for Author( As Instructor ) Archive
 */
add_filter( 'edubin_content_area_class', 'edubin_ld_author_archive_content_area_class' );

if ( ! function_exists( 'edubin_ld_author_archive_content_area_class' ) ) :
    function edubin_ld_author_archive_content_area_class ( $class ) {
        $author_redirect_to_courses = apply_filters( 'edubin_ld_author_redirect_to_course', false );
        if ( isset( $_GET['ldauthor'] ) ) :
            $ldauthor = $_GET['ldauthor'];
        else :
            $ldauthor = false;
        endif;
        if ( true == $author_redirect_to_courses && 'true' == $ldauthor ) :
            $class = 'edubin-col-lg-12';
        endif;

        return $class;
    }
endif;

/**
 * Archive & Single Sidebar Type
 */
add_filter( 'edubin_archive_sidebar_layout', 'edubin_archive_ld_sidebar_layout' );
add_filter( 'edubin_single_sidebar_layout', 'edubin_archive_ld_sidebar_layout' );

if ( ! function_exists( 'edubin_archive_ld_sidebar_layout' ) ) :
    function edubin_archive_ld_sidebar_layout ( $class ) {
        if ( is_post_type_archive( 'sfwd-courses' ) || is_tax( 'ld_course_category' ) || is_tax( 'ld_course_tag' ) || is_singular( 'sfwd-courses' ) ) :
            $class = 'no-sidebar';
        endif;
        return $class;
    }
endif;

/**
 * Single Course Thumbnail
 */
if ( ! function_exists( 'edubin_ld_single_course_thumbnail' ) ) :
    function edubin_ld_single_course_thumbnail(){
        $thumb_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
        if ( isset( $thumb_src ) && ! empty( $thumb_src ) ) :
            $thumb_url = $thumb_src[0];
        else :
            $thumb_url = get_template_directory_uri() . '/assets/images/no-image-found.png';
        endif;
        echo '<div class="edubin-single-course-thumbnail" style="background-image: url(' . esc_url( $thumb_url ) . ')"></div>';
    }
endif;


/**
 * Course Search Post Type
 */
add_filter( 'edubin_course_search_post_type', 'edubin_ld_course_search_post_type' );
if ( ! function_exists( 'edubin_ld_course_search_post_type' ) ) :
    function edubin_ld_course_search_post_type() {
        return 'sfwd-courses';
    }
endif;

/**
 * Header Course Category Slug
 */
add_filter( 'edubin_header_course_lms_cat_slug', 'edubin_header_course_ld_cat_slug' );
if ( ! function_exists( 'edubin_header_course_ld_cat_slug' ) ) :
    function edubin_header_course_ld_cat_slug() {
        return 'ld_course_category';
    }
endif;

/**
 * Count Course Data
 */
if ( ! function_exists( 'edubin_ld_count_published_posts' ) ) :
    function edubin_ld_count_published_posts( $post_type ) {

        $count_posts = wp_count_posts( $post_type );

        if ( $count_posts->publish ) :
            return $count_posts->publish;
        else :
            return 0;
        endif;
    }
endif;

/**
 * Course Archive Search Filter
 */
add_filter( 'edubin_ld_course_archive_args', 'edubin_ld_course_search_filter_archive' );
if( ! function_exists( 'edubin_ld_course_search_filter_archive' ) ) :
    function edubin_ld_course_search_filter_archive( $args ) {
        if ( is_post_type_archive( 'sfwd-courses' ) ) :
            if ( isset( $_REQUEST['tpc_ld_course_filter'] ) && 'ld_course_search' === $_REQUEST['tpc_ld_course_filter'] ) :
                $args['s'] = sanitize_text_field( $_REQUEST['search_query'] );
            endif;
        endif;
        return $args;
    }
endif;

/**
 * indexing result of courses
 */
if( ! function_exists( 'edubin_ld_course_index_result' ) ) :
    function edubin_ld_course_index_result( $total ) {
        if ( 0 === $total ) :
            $result = __( 'There are no available courses!', 'edubin' );    
        elseif ( 1 === $total ) :
            $result = __( 'Showing only one result.', 'edubin' );
        else :
            $courses_per_page = Edubin::setting( 'ld_course_per_page' ) ? Edubin::setting( 'ld_course_per_page' ) : 9;
            $paged = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;

            $from = 1 + ( $paged - 1 ) * $courses_per_page;
            $to   = ( $paged * $courses_per_page > $total ) ? $total : $paged * $courses_per_page;

            if ( $from == $to ) :
                $result = sprintf( __( 'Showing Last Course Of %s Results', 'edubin' ), $total );
            else :
                $result = sprintf( __( 'Showing %s-%s Of %s Results', 'edubin' ), '<span>' . $from, $to . '</span>', '<span>' . $total . '</span>' );
            endif;
        endif;
        echo wp_kses_post( $result );
    }
endif;

/**
 * Course archive top bar
 */
if( ! function_exists( 'edubin_ld_course_header_top_bar' ) ) :
    function edubin_ld_course_header_top_bar( $query ) {
        global $wp_query;
        $top_bar      = true;
        $index      = true;
        $search_bar = true;

        if ( true == $index && true == $search_bar ) :
            $column = 'edubin-col-md-6';
        else :
            $column = 'edubin-col-md-12';
        endif;

        if ( ( true == $top_bar ) && ( true == $index || true == $search_bar ) ) :
            echo '<div class="edubin-course-archive-top-bar-wrapper">';
                echo '<div class="edubin-course-archive-top-bar edubin-row">';
                    if ( true == $index ) :
                        echo '<div class="' . esc_attr( $column ) . '">';
                            echo '<span class="edubin-course-archive-index-count">';
                                edubin_ld_course_index_result( $query->found_posts );
                            echo '</span>';
                        echo '</div>';
                    endif;
                    if ( true == $search_bar ) :
                        echo '<div class="' . esc_attr( $column ) . '">';
                            echo '<div class="edubin-course-archive-search">';
                                edubin_ld_course_archive_search_bar();
                            echo '</div>';
                        echo '</div>';
                    endif;
                echo '</div>';
            echo '</div>';
        endif;
    }
endif;

/**
 * Course archive search bar
 */
if( ! function_exists( 'edubin_ld_course_archive_search_bar' ) ) :
    function edubin_ld_course_archive_search_bar() {
        /*
         * remove param action="' . esc_url( get_post_type_archive_link( 'sfwd-courses ) ) . '"
         * if you don't want to redirect to course category archive
         */
        echo '<div class="edu-search-box">';
            echo '<form class="edubin-archive-course-search-form" method="get" action="' . esc_url( get_post_type_archive_link( 'sfwd-courses' ) ) . '">';
                echo '<input type="text" value="" name="search_query" placeholder="'. __( 'Search Courses...', 'edubin' ) . '" class="input-search" autocomplete="off" />';
                echo '<input type="hidden" value="ld_course_search" name="tpc_ld_course_filter" />';
                echo '<button class="search-button"><i class="flaticon-search"></i></button>';
            echo '</form>';
        echo '</div>';
    }
endif;


/**
 * LearnDash Course Rating Active
 *
 */
if( ! function_exists( 'is_edubin_ld_rating_enable' ) ) :
    function is_edubin_ld_rating_enable() {
        $status = true;
        return $status;
    }
endif;

/**
 * Get Woocommerce course price
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_get_wc_course_price' ) ) :
    function edubin_get_wc_course_price( $product_id = null ) {
        if ( empty( $product_id ) ) :
            return '';
        endif;
     
        $product = wc_get_product( $product_id );
     
        if ( ! $product ) :
            return '';
        endif;
     
        return $product->get_price_html();
    }
endif;


/**
 * Currency symbols
 * 
 * @param  string $currency  currency code such as USD, EUR
 * @param  int    $course_id course ID
 * @return string currency symbol
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'edubin_ld_course_currency_symbols' ) ) :
    function edubin_ld_course_currency_symbols( $currency, $course_id = null ) {
        $currency_symbols = apply_filters( 'edubin_ld_course_currency_symbols', array(
            'AED' => '&#x62f;.&#x625;',
            'AFN' => '&#x60b;',
            'ALL' => 'L',
            'AMD' => 'AMD',
            'ANG' => '&fnof;',
            'AOA' => 'Kz',
            'ARS' => '&#36;',
            'AUD' => '&#36;',
            'AWG' => 'Afl.',
            'AZN' => 'AZN',
            'BAM' => 'KM',
            'BBD' => '&#36;',
            'BDT' => '&#2547;',
            'BGN' => '&#1083;&#1074;.',
            'BHD' => '.&#x62f;.&#x628;',
            'BIF' => 'Fr',
            'BMD' => '&#36;',
            'BND' => '&#36;',
            'BOB' => 'Bs.',
            'BRL' => '&#82;&#36;',
            'BSD' => '&#36;',
            'BTC' => '&#3647;',
            'BTN' => 'Nu.',
            'BWP' => 'P',
            'BYR' => 'Br',
            'BYN' => 'Br',
            'BZD' => '&#36;',
            'CAD' => '&#36;',
            'CDF' => 'Fr',
            'CHF' => '&#67;&#72;&#70;',
            'CLP' => '&#36;',
            'CNY' => '&yen;',
            'COP' => '&#36;',
            'CRC' => '&#x20a1;',
            'CUC' => '&#36;',
            'CUP' => '&#36;',
            'CVE' => '&#36;',
            'CZK' => '&#75;&#269;',
            'DJF' => 'Fr',
            'DKK' => 'DKK',
            'DOP' => 'RD&#36;',
            'DZD' => '&#x62f;.&#x62c;',
            'EGP' => 'EGP',
            'ERN' => 'Nfk',
            'ETB' => 'Br',
            'EUR' => '&euro;',
            'FJD' => '&#36;',
            'FKP' => '&pound;',
            'GBP' => '&pound;',
            'GEL' => '&#x20be;',
            'GGP' => '&pound;',
            'GHS' => '&#x20b5;',
            'GIP' => '&pound;',
            'GMD' => 'D',
            'GNF' => 'Fr',
            'GTQ' => 'Q',
            'GYD' => '&#36;',
            'HKD' => '&#36;',
            'HNL' => 'L',
            'HRK' => 'kn',
            'HTG' => 'G',
            'HUF' => '&#70;&#116;',
            'IDR' => 'Rp',
            'ILS' => '&#8362;',
            'IMP' => '&pound;',
            'INR' => '&#8377;',
            'IQD' => '&#x639;.&#x62f;',
            'IRR' => '&#xfdfc;',
            'IRT' => '&#x062A;&#x0648;&#x0645;&#x0627;&#x0646;',
            'ISK' => 'kr.',
            'JEP' => '&pound;',
            'JMD' => '&#36;',
            'JOD' => '&#x62f;.&#x627;',
            'JPY' => '&yen;',
            'KES' => 'KSh',
            'KGS' => '&#x441;&#x43e;&#x43c;',
            'KHR' => '&#x17db;',
            'KMF' => 'Fr',
            'KPW' => '&#x20a9;',
            'KRW' => '&#8361;',
            'KWD' => '&#x62f;.&#x643;',
            'KYD' => '&#36;',
            'KZT' => '&#8376;',
            'LAK' => '&#8365;',
            'LBP' => '&#x644;.&#x644;',
            'LKR' => '&#xdbb;&#xdd4;',
            'LRD' => '&#36;',
            'LSL' => 'L',
            'LYD' => '&#x644;.&#x62f;',
            'MAD' => '&#x62f;.&#x645;.',
            'MDL' => 'MDL',
            'MGA' => 'Ar',
            'MKD' => '&#x434;&#x435;&#x43d;',
            'MMK' => 'Ks',
            'MNT' => '&#x20ae;',
            'MOP' => 'P',
            'MRU' => 'UM',
            'MUR' => '&#x20a8;',
            'MVR' => '.&#x783;',
            'MWK' => 'MK',
            'MXN' => '&#36;',
            'MYR' => '&#82;&#77;',
            'MZN' => 'MT',
            'NAD' => 'N&#36;',
            'NGN' => '&#8358;',
            'NIO' => 'C&#36;',
            'NOK' => '&#107;&#114;',
            'NPR' => '&#8360;',
            'NZD' => '&#36;',
            'OMR' => '&#x631;.&#x639;.',
            'PAB' => 'B/.',
            'PEN' => 'S/',
            'PGK' => 'K',
            'PHP' => '&#8369;',
            'PKR' => '&#8360;',
            'PLN' => '&#122;&#322;',
            'PRB' => '&#x440;.',
            'PYG' => '&#8370;',
            'QAR' => '&#x631;.&#x642;',
            'RMB' => '&yen;',
            'RON' => 'lei',
            'RSD' => '&#1088;&#1089;&#1076;',
            'RUB' => '&#8381;',
            'RWF' => 'Fr',
            'SAR' => '&#x631;.&#x633;',
            'SBD' => '&#36;',
            'SCR' => '&#x20a8;',
            'SDG' => '&#x62c;.&#x633;.',
            'SEK' => '&#107;&#114;',
            'SGD' => '&#36;',
            'SHP' => '&pound;',
            'SLL' => 'Le',
            'SOS' => 'Sh',
            'SRD' => '&#36;',
            'SSP' => '&pound;',
            'STN' => 'Db',
            'SYP' => '&#x644;.&#x633;',
            'SZL' => 'L',
            'THB' => '&#3647;',
            'TJS' => '&#x405;&#x41c;',
            'TMT' => 'm',
            'TND' => '&#x62f;.&#x62a;',
            'TOP' => 'T&#36;',
            'TRY' => '&#8378;',
            'TTD' => '&#36;',
            'TWD' => '&#78;&#84;&#36;',
            'TZS' => 'Sh',
            'UAH' => '&#8372;',
            'UGX' => 'UGX',
            'USD' => '&#36;',
            'UYU' => '&#36;',
            'UZS' => 'UZS',
            'VEF' => 'Bs F',
            'VES' => 'Bs.S',
            'VND' => '&#8363;',
            'VUV' => 'Vt',
            'WST' => 'T',
            'XAF' => 'CFA',
            'XCD' => '&#36;',
            'XOF' => 'CFA',
            'XPF' => 'Fr',
            'YER' => '&#xfdfc;',
            'ZAR' => '&#82;',
            'ZMW' => 'ZK'
        ) );
        return isset( $currency_symbols[ $currency ] ) ? $currency_symbols[ $currency ] : $currency;
    }
endif;


function edubin_learndash_get_courses( $args = array() ) {

    $args = wp_parse_args( $args, array(
        'author' => '',
        'fields' => ''
    ) );

    extract($args);
    
    $query_args = array(
        'post_type' => 'sfwd-courses',
        'post_status' => 'publish'
    );

    if ( ! empty( $author ) ) :
        $query_args['author'] = $author;
    endif;

    if ( ! empty( $fields ) ) :
        $query_args['fields'] = $fields;
    endif;

    $loop = new WP_Query($query_args);
    $posts = array();
    
    if ( ! empty( $loop->posts ) ) :
        $posts = $loop->posts;
    endif;
    return $posts;
}
/**
 * LearnDash compatibility
 *
 * @package Edubin
 */

// add_body_classes_for_ld_lms
// edubin_ld_course_info
// edubin_ld_course_category
// edubin_ld_related_course_content
// edubin_ld_related_course_sidebar
// edubin_ld_course_page_title_section_03
// edubin_ld_course_page_title_section_04
// edubin_ld_course_page_title_section_05
// edubin_ld_course_page_title_section_06


  //** ==== LearnDash add body class ** ====
  function add_body_classes_for_ld_lms( $classes ) {

    $prefix = '_edubin_';
    $post_id = edubin_get_id();
    
    $ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );

    if ( $ld_single_page_layout == '5' ) :
        $final_ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
    elseif ( $ld_single_page_layout == '4' ) :
        $final_ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
    elseif ( $ld_single_page_layout == '3' ) :
        $final_ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
    elseif ( $ld_single_page_layout == '2' ) :
        $final_ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
    elseif ( $ld_single_page_layout == '1' ) :
        $final_ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
    endif; //End single page layout


      // Get body class for learndash lms profile page
      if ( class_exists('SFWD_LMS') && $final_ld_single_page_layout && is_singular( 'sfwd-courses' )) {
          $classes[] = 'single-course-layout-0'.$final_ld_single_page_layout.'';
      } // End - Get body class for learndash lms profile page
      
      // Finally $classes return 
    return $classes;

  }
  add_filter( 'body_class', 'add_body_classes_for_ld_lms' );

    // ==== Display Course info / edubin_ld_course_info =====
    
    if ( ! function_exists( 'edubin_ld_course_info' ) ) {

        function edubin_ld_course_info() {  

            $ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );
            $ld_intro_video_position = Edubin::setting( 'ld_intro_video_position' );
            $ld_instructor_single = Edubin::setting( 'ld_instructor_single' );
            $ld_single_duration = Edubin::setting( 'ld_single_duration' );
            $ld_lesson_single = Edubin::setting( 'ld_lesson_single' ); 
            $ld_enrolled_single = Edubin::setting( 'ld_enrolled_single' ); 
            $ld_single_topic = Edubin::setting( 'ld_single_topic' ); 
            $ld_single_cat = Edubin::setting( 'ld_single_cat' ); 
            $ld_single_language = Edubin::setting( 'ld_single_language' );  
            $ld_single_info_heading = Edubin::setting( 'ld_single_info_heading'); 
            $ld_custom_features_position = Edubin::setting( 'ld_custom_features_position' );
            $ld_single_certificate = Edubin::setting( 'ld_single_certificate' );
    
            if ( !in_array( $ld_single_page_layout, array('5')) ) {
                get_template_part( 'learndash/tpl-part/single/single', 'media' );
            }  

        echo '<div class="edubin-course-info">';

            if ($ld_single_info_heading) {
                echo '<h4 class="ld-segment-title tpc_mt_30">' . esc_html($ld_single_info_heading) . '</h4>';
            } 

            echo '<ul class="course-info-list">';

                if ($ld_custom_features_position == 'top') {
                    get_template_part( 'learndash/tpl-part/single/meta', 'custom' );
                }
                
                if ($ld_instructor_single) { 
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-student"></i>';
                    echo '<span class="label">' . esc_html__('Created by :', 'edubin') . '</span>';
                    echo '<span class="value">' . get_the_author() . '</span>';
                    echo '</li>';
                }

                $duration      = get_post_meta( get_the_ID(), '_learndash_course_grid_duration', true );
                $duration_h = is_numeric( $duration ) ? floor( $duration / HOUR_IN_SECONDS ) : null;
                $duration_m = is_numeric( $duration ) ? floor( ( $duration % HOUR_IN_SECONDS ) / MINUTE_IN_SECONDS ) : null;

                if (!empty($ld_single_duration) && !empty($duration_h) && !empty($duration_m)) {
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-start"></i>';
                    echo '<span class="label">' . esc_html__('Duration :', 'edubin') . '</span>';
                    echo '<span class="value">';

                    $tf_duration_h_text   = esc_html__('h', 'edubin');
                    $tf_duration_m_text   = esc_html__('m', 'edubin');

                    if ($duration_h) {
                        echo esc_attr($duration_h) . esc_html($tf_duration_h_text);
                    }
                    if ($duration_m) {
                        echo esc_attr($duration_m) . esc_html($tf_duration_m_text);
                    }
                    echo '</span>';
                    echo '</li>';
                }

                $course_id            = get_the_ID();
                $course_options       = get_post_meta( $course_id, '_sfwd-courses', true );
                $price_type           = isset( $course_options['sfwd-courses_course_price_type'] ) ? strtoupper( $course_options['sfwd-courses_course_price_type'] ) : 'free';

                $enrolled_base = edubin_get_ld_course_meta( 'enrolled' );
                $enrolled      = edubin_get_ld_course_student_count( $course_id, $enrolled_base ); 

                if ( $ld_enrolled_single) {
                    if ( 'OPEN' !== $price_type || $enrolled_base > 0 ) {
                        echo '<li>';
                        echo '<i class="meta-icon flaticon-users"></i>';
                        echo '<span class="label">' . esc_html__('Enrolled :', 'edubin') . '</span>';
                        echo '<span class="value">';
                            printf( _n( '%s Student', '%s Students', $enrolled, 'edubin' ), $enrolled );
                        echo '</span>';
                        echo '</li>';
                    }
                }
                
                if ($ld_lesson_single) {
                    $lesson      = learndash_get_course_steps(get_the_ID(), array('sfwd-lessons'));
                    $lesson      = $lesson ? count($lesson) : 0;
                    $lesson_text = ($lesson == '1') ? esc_html__('Lesson', 'edubin') : esc_html__('Lessons', 'edubin');
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-book"></i>';
                    echo '<span class="label">' . esc_html__('Lessons :', 'edubin') . '</span>';
                    echo '<span class="value">' . esc_attr($lesson) . ' ' . esc_html($lesson_text) . '</span>';
                    echo '</li>';
                }
                
                if ($ld_single_topic) {
                    $topic      = learndash_get_course_steps(get_the_ID(), array('sfwd-topic'));
                    $topic      = $topic ? count($topic) : 0;
                    $topic_text = ($topic == '1') ? esc_html__('Topic', 'edubin') : esc_html__('Topics', 'edubin');
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-study"></i>';
                    echo '<span class="label">' . esc_html__('Topic :', 'edubin') . '</span>';
                    echo '<span class="value">' . esc_attr($topic) . ' ' . esc_html($topic_text) . '</span>';
                    echo '</li>';
                }
                
                if ($ld_single_cat) {
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-tags"></i>';
                    echo '<span class="label">' . esc_html__('Category :', 'edubin') . '</span>';
                    echo '<span class="ld_course_cat value">';
                    if (!get_the_terms(get_the_ID(), 'ld_course_category')) {
                        esc_html_e('Uncategorized', 'edubin');
                    } else {
                        echo get_the_term_list(get_the_ID(), 'ld_course_category', '');
                    }
                    echo '</span>';
                    echo '</li>';
                }

                if ($ld_single_language && !empty(get_the_terms(get_the_ID(), 'ld_course_language'))) {  
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-worldwide"></i>';
                    echo '<span class="label">' . esc_html__('Language :', 'edubin') . '</span>';
                    echo '<span class="language-tag value">';
                        echo get_the_term_list(get_the_ID(), 'ld_course_language', '');
                    echo '</span>';
                    echo '</li>';
                }

                $ld_certificate_show = get_post_meta( get_the_ID(), '_edubin_ld_certificate_show', true );

                $get_certificate = 'yes' === $ld_certificate_show ? __( 'Yes', 'edubin' ) : __( 'No', 'edubin' ); 

               if ( $ld_single_certificate == 'yes' ) {  
                    echo '<li>';
                    echo '<i class="meta-icon flaticon-award"></i>';
                    echo '<span class="label">' . esc_html__('Certificate :', 'edubin') . '</span>';
                    echo '<span class="ld_certificate value">';
                        echo esc_html($get_certificate);
                    echo '</span>';
                    echo '</li>';
                }
                
                if ($ld_custom_features_position == 'bottom') {
                    get_template_part( 'learndash/tpl-part/single/meta', 'custom' );
                }

            echo '</ul>';
        echo '</div>';

        }
    }

    // ===== Display Course Category / edubin_ld_course_category ===== 

    if ( ! function_exists( 'edubin_ld_course_category' ) ) {

        function edubin_ld_course_category() {  

        global $post;
        $post_id    = $post->ID;

        echo '<div class="ld__widget">';
        echo '<section class="widget edubin-course-widget edubin-ld-widget">';
        echo '<h2 class="widget-title">' . esc_html__('Course Categories', 'edubin') . '</h2>';
        $args = array(
            'taxonomy' => 'ld_course_category',
            'orderby' => 'name',
            'order'   => 'ASC'
        );
        $terms = get_categories($args);
        if ($terms && !is_wp_error($terms)) {
            echo '<ul>';
            foreach ($terms as $term) {
                echo '<li><a href="' . esc_url(get_term_link($term->slug, 'ld_course_category')) . '" rel="tag" class="' . esc_attr($term->slug) . '">' . esc_html($term->name) . '</a></li>';
            }
            echo '</ul>';
        }
        echo '</section>';
        echo '</div>';
        }
    }

    /**
     * Display related courses Content
     */
    
    if ( ! function_exists( 'edubin_ld_related_course_content' ) ) {

        function edubin_ld_related_course_content( $postType = 'sfwd-courses', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $ld_related_course_title = Edubin::setting( 'ld_related_course_title' );
        $ld_related_course_items = Edubin::setting( 'ld_related_course_items' );
        $ld_related_course_by = Edubin::setting( 'ld_related_course_by' );
        $ld_related_course_columns = Edubin::setting( 'ld_related_course_columns' );

        $args = array(
            'style' => $style = Edubin::setting( 'ld_course_archive_style' )
        );

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $ld_related_course_items;
        if (null === $relatedBy) $relatedBy = $ld_related_course_by;
        if (null === $postType) $postType = 'sfwd-courses';

        // Build our basic custom query arguments

        if ($relatedBy === 'category') {
            $categories = get_the_category( $post->ID );
            $catidlist = '';
            foreach( $categories as $category) {
                $catidlist .= $category->cat_ID . ",";
            }
            // Build our category based custom query arguments
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
                'cat' => $catidlist, // Select posts in the same categories as the current post
            );
        }

        if ($relatedBy === 'tags') {

            // Get the tags for the current post
            $tags = wp_get_post_tags($postID);
            // If the post has tags, run the related post tag query
            if ($tags) {
                $tag_ids = array();
                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                // Build our tag related custom query arguments
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'tag__in' => $tag_ids, // Select posts with related tags
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            } else {
                // If the post does not have tags, run the standard related posts query
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            }

        }

        // Initiate the custom query
        $custom_query = new WP_Query( $related_posts_custom_query_args );


        // Run the loop and output data for the results
        if ( $custom_query->have_posts() ) : 

            echo '<div class="related-post-title-wrap">';
                echo '<h3 class="related-title text-center">' . esc_html( $ld_related_course_title ) . '</h3>';
            echo '</div>';

            echo '<div class="edubin-row">';
            while ( $custom_query->have_posts() ) : $custom_query->the_post();
                echo '<div class="edubin-col-lg-'. esc_attr( $ld_related_course_columns ). ' edubin-col-sm-6">';

                    get_template_part( 'learndash/tpl-part/course/th-layouts', '', $args );

                echo '</div>';
            endwhile;
            echo '</div>';
        endif;

        // Reset postdata
        wp_reset_postdata();
        }
    }

   
    /**
     * Display related courses sidebar
     */

    if ( ! function_exists( 'edubin_ld_related_course_sidebar' ) ) {

        function edubin_ld_related_course_sidebar( $postType = 'sfwd-courses', $postID = null, $totalPosts = null, $relatedBy = null) { 

        $ld_related_course_title = Edubin::setting( 'ld_related_course_title' );
        $ld_related_course_items = Edubin::setting( 'ld_related_course_items' );
        $ld_related_course_by = Edubin::setting( 'ld_related_course_by' );
        $ld_related_course_style = Edubin::setting( 'ld_related_course_style' );
        $final_ld_related_course_style = ($ld_related_course_style == 'square') ? 'square' : 'round';

        global $post, $related_posts_custom_query_args;
        if (null === $postID) $postID = $post->ID;
        if (null === $totalPosts) $totalPosts = $ld_related_course_items;
        if (null === $relatedBy) $relatedBy = $ld_related_course_by;
        if (null === $postType) $postType = 'sfwd-courses';

        // Build our basic custom query arguments

        if ($relatedBy === 'category') {
            $categories = get_the_category( $post->ID );
            $catidlist = '';
            foreach( $categories as $category) {
                $catidlist .= $category->cat_ID . ",";
            }
            // Build our category based custom query arguments
            $related_posts_custom_query_args = array(
                'post_type' => $postType,
                'posts_per_page' => $totalPosts, // Number of related posts to display
                'post__not_in' => array($postID), // Ensure that the current post is not displayed
                'orderby' => 'rand', // Randomize the results
                'cat' => $catidlist, // Select posts in the same categories as the current post
            );
        }

        if ($relatedBy === 'tags') {

            // Get the tags for the current post
            $tags = wp_get_post_tags($postID);
            // If the post has tags, run the related post tag query
            if ($tags) {
                $tag_ids = array();
                foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
                // Build our tag related custom query arguments
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'tag__in' => $tag_ids, // Select posts with related tags
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            } else {
                // If the post does not have tags, run the standard related posts query
                $related_posts_custom_query_args = array(
                    'post_type' => $postType,
                    'posts_per_page' => $totalPosts, // Number of related posts to display
                    'post__not_in' => array($postID), // Ensure that the current post is not displayed
                    'orderby' => 'rand', // Randomize the results
                );
            }

        }

        // Initiate the custom query
        $custom_query = new WP_Query( $related_posts_custom_query_args );


        // Run the loop and output data for the results
        if ( $custom_query->have_posts() ) : 
     
        echo '<section id="pxcv-learndash-course-2" class="widget edubin-course-widget widget_pxcv_posts style__' . esc_attr($final_ld_related_course_style) . '">';
            echo '<h2 class="widget-title">' . esc_html__('Related Courses', 'edubin') . '</h2>';
        echo '<ul class="pxcv-rr-item-widget">';

        while ( $custom_query->have_posts() ) : $custom_query->the_post();
            echo '<li class="clearfix has_image">';

            if ( has_post_thumbnail() ) :
                echo '<a class="post__link"  href="' . get_the_permalink() . '">';
                    echo '<div class="pxcv-rr-item-image_wrapper">';
                        the_post_thumbnail( 'thumbnail' );
                    echo '</div>';
                echo '</a>';
            endif;

            echo '<div class="pxcv-rr-item-content_wrapper">';
                echo '<a class="post__link" href="' . get_the_permalink() . '">';
                    echo '<h6 class="post__title">' . get_the_title() . '</h6>';
                echo '</a>';
            echo '<span class="course-price">';

            // Show price
            // if ( $price) :
            echo '<span class="price">';
            // echo esc_html($price);
            echo '</span>';
            // endif;

            echo '</span>';
            echo '</div>';
            echo '</li>';
        endwhile;

        echo '</ul>';
        echo '</section>';


        endif;
        // Reset postdata
        wp_reset_postdata();

        }
    }

    /**
     * Filter search redirect to sfwd-courses-search.php
     */

    function edubin_ld_archive_search_template($template)   {    
         global $wp_query;   
         $post_type = get_query_var('post_type');   
         if( isset($_GET['s']) && $post_type == 'sfwd-courses' )   
         {
          return locate_template('sfwd-courses-search.php');  //  redirect to sfwd-courses-search.php
         }   
         return $template;   
    }
    add_filter('template_include', 'edubin_ld_archive_search_template');

     /**
     * LearnDash course archive page post_per_page
     */
       
    function edubin_ld_archive_course_post_per_page( $query ) {

        $ld_course_per_page = Edubin::setting( 'ld_course_per_page' );

        if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'sfwd-courses' ) ) {
            $query->set( 'posts_per_page', $ld_course_per_page );

        }
        return;
    }
    add_action( 'pre_get_posts', 'edubin_ld_archive_course_post_per_page', 15 );


// ===== edubin_ld_course_page_title_section_03

if ( ! function_exists( 'edubin_ld_course_page_title_section_03' ) ) :
    function edubin_ld_course_page_title_section_03( $title = null, $has_bg_image = null, $extra_style = null ) {

    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $prefix = '_edubin_';

    $ld_cg_short_description   = get_post_meta( $post_id, '_learndash_course_grid_short_description', true );
    $mb_short_description   = get_post_meta( $post_id, '_edubin_ld_excerpt', true );

    $short_description = ($ld_cg_short_description) ? $ld_cg_short_description : $mb_short_description;

    $ld_single_excerpt = Edubin::setting( 'ld_single_excerpt' );
    $ld_single_breadcrumb = Edubin::setting( 'ld_single_breadcrumb' );
    $ld_single_page_layout  = Edubin::setting( 'ld_single_page_layout' );
    $ld_header_color = ( $ld_single_page_layout == '4' ) ? 'light' : 'dark' ;

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '. esc_attr( $ld_header_color ).'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';
            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info ld">';

                    if ( $ld_single_breadcrumb ) {

                        echo '<div class="edubin-breadcrumb-wrapper">';
                            do_action( 'edubin_breadcrumb' );
                        echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</div>';

                    if ( $ld_single_excerpt) : 
                        echo '<div class="course-short-text">';
                            echo '<p>';
                                   echo esc_html($short_description);
                            echo '</p>';   
                        echo '</div>';   
                    endif; 

               // get_template_part( 'learndash/tpl-part/single/meta', 'review-update' );
                get_template_part( 'learndash/tpl-part/single/meta', 'top' );


        echo '</div>'; 
        echo '<div class="edubin-col-lg-4"></div>'; 
      
        echo '</div>'; 
    echo '</div>'; 
echo '</div>'; 

    }
endif;


/**
 * Course page title section edubin_ld_course_page_title_section_05
 */
if ( ! function_exists( 'edubin_ld_course_page_title_section_05' ) ) :
    function edubin_ld_course_page_title_section_05( $title = null, $has_bg_image = null, $extra_style = null ) {

    $ld_single_excerpt = Edubin::setting( 'ld_single_excerpt' );
    $ld_single_review = Edubin::setting( 'ld_single_review' );
    $ld_single_last_update = Edubin::setting( 'ld_single_last_update' );
    
    $ld_single_page_layout  = Edubin::setting( 'ld_single_page_layout' );

    $ld_header_color = ( $ld_single_page_layout == '4' ) ? 'light' : 'dark' ;
    $header_title_tag = Edubin::setting( 'header_title_tag' );
    $header_page_title_align = Edubin::setting( 'header_page_title_align' );
    $ld_course_header_style = Edubin::setting( 'ld_course_header_style' );
    $ld_single_breadcrumb = Edubin::setting( 'ld_single_breadcrumb' );

        echo '<div class="edubin-page-title-area edubin-default-breadcrumb '. esc_attr( $has_bg_image ) . 'course-header-style--' . $ld_course_header_style .'"' . $extra_style .'>';
            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

             echo '<div class="edubin-course-top-info">';

                echo '<div class="edubin-page-title">';
                    echo '<'.$header_title_tag.' class="page-title has-text-align-'.$header_page_title_align.'">';
                      the_title();
                    echo '</'.$header_title_tag.' class="page-title">';
                echo '</div>';

                if ( $ld_single_breadcrumb ) {

                echo '<div class="edubin-breadcrumb-wrapper has-text-align-'.$header_page_title_align.'">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                }

               edubin_breadcrumb_shapes();

              get_template_part( 'learndash/tpl-part/single/meta', 'top' );

            echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;

// ===== edubin_ld_course_page_title_section_04 ====

if ( ! function_exists( 'edubin_ld_course_page_title_section_04' ) ) :
    function edubin_ld_course_page_title_section_04( $title = null, $has_bg_image = null, $extra_style = null ) {

    global $post; $post_id = $post->ID;
    $course_id = $post_id;
    $user_id   = get_current_user_id();
    $current_id = $post->ID;
    $prefix = '_edubin_';

    //$ld_course_header_image = get_post_meta( get_the_ID(), '_edubin_ld_course_header_image', 1 ); 
    
    $ld_cg_short_description   = get_post_meta( $post_id, '_learndash_course_grid_short_description', true );
    $mb_short_description   = get_post_meta( $post_id, '_edubin_ld_excerpt', true );

    $short_description = ($ld_cg_short_description) ? $ld_cg_short_description : $mb_short_description;


    $ld_single_excerpt = Edubin::setting( 'ld_single_excerpt' );
    $ld_single_review = Edubin::setting( 'ld_single_review' );
    $ld_single_last_update = Edubin::setting( 'ld_single_last_update' );
    $ld_single_page_layout  = Edubin::setting( 'ld_single_page_layout' );

    $ld_header_color = ( $ld_single_page_layout == '4' ) ? 'light' : 'dark' ;

    $page_header_img = get_post_meta($post_id, $prefix . 'header_img', true);

    $ld_intro_video_position = Edubin::setting( 'ld_intro_video_position' ); 
    $ld_single_social_shear = Edubin::setting( 'ld_single_social_shear ' ); 

    $breadcrumb_show = Edubin::setting( 'breadcrumb_show' );
    $shortcode_breadcrumb = Edubin::setting( 'shortcode_breadcrumb' );
    $ld_single_breadcrumb = Edubin::setting( 'ld_single_breadcrumb' );

echo '<div class="edubin-course-top-info edubin-page-title-area edubin-breadcrumb-style-1 '.$ld_header_color.'">';
    echo '<div class="edubin-container">';
        echo '<div class="edubin-row">';

            echo '<div class="edubin-col-lg-8">';
                echo '<div class="edubin-single-course-lead-info ld">';

                    if ( $ld_single_breadcrumb ) {

                    echo '<div class="edubin-breadcrumb-wrapper">';
                        do_action( 'edubin_breadcrumb' );
                    echo '</div>';

                    }

                    echo '<h1 class="course-title">';
                            the_title();
                    echo '</h1>';

                    if ( $ld_single_excerpt) : 
                        echo '<div class="course-short-text">';
                            echo '<p>';
                                   echo esc_html($short_description);
                            echo '</p>';   
                        echo '</div>';  
                    endif; 

                    get_template_part( 'learndash/tpl-part/single/meta', 'top' );

                echo '</div>'; // End edubin-single-course-lead-info

            echo '</div>'; // End edubin-col-lg-8

            echo '<div class="edubin-col-lg-4">';  
                if ( $ld_single_page_layout == '5' ) {
                      get_template_part( 'learndash/tpl-part/single/media', 'header' );
                }
            echo '</div>'; // End edubin-col-lg-4

        echo '</div>';  // End edubin-row
    echo '</div>';  // End edubin-container
echo '</div>'; // End edubin-course-top-info

    }
endif;

// ===== edubin_ld_course_page_title_section_06

if ( ! function_exists( 'edubin_ld_course_page_title_section_06' ) ) :
    function edubin_ld_course_page_title_section_06( $title = null, $has_bg_image = null, $extra_style = null ) {

            $custom_page_header_img = get_post_meta( get_the_ID(), '_edubin_header_img', 1 ); 
            $ld_single_excerpt = Edubin::setting( 'ld_single_excerpt' );
            $ld_single_review = Edubin::setting( 'ld_single_review' );
            $ld_single_last_update = Edubin::setting( 'ld_single_last_update' );
            $ld_single_page_layout  = Edubin::setting( 'ld_single_page_layout' );
            $ld_course_header_style  = Edubin::setting( 'ld_course_header_style' );
            $ld_single_breadcrumb = Edubin::setting( 'ld_single_breadcrumb' );

        echo '<div style="background-image: url('.$custom_page_header_img.')" class="edubin-page-title-area edubin-breadcrumb-style-1 edubin-breadcrumb-has-bg '. esc_attr( $has_bg_image ) . 'course-header-style--' . $ld_course_header_style .'"' . $extra_style .'>';

            echo '<div class="' . esc_attr( apply_filters( 'edubin_breadcrumb_container_class', 'edubin-container' ) ) . '">';

            echo '<div class="edubin-course-top-info">';
                echo '<div class="edubin-page-title">';
                    echo '<h1 class="entry-title">';
                       echo the_title(); 
                    echo '</h1>';
                echo '</div>';

                echo '<div class="edubin-breadcrumb-wrapper">';
                    do_action( 'edubin_breadcrumb' );
                echo '</div>';

                get_template_part( 'learndash/tpl-part/single/meta', 'top' );

             echo '</div>'; 

            echo '</div>';
        
        echo '</div>';
    }
endif;





if ( ! function_exists( 'edubin_get_ld_course_meta' ) ) {
    /**
     * Get course meta
     *
     * @param  array $key meta key
     * @return string
     */
    function edubin_get_ld_course_meta( $key = '', $course_id = null ) {
        if ( empty( $course_id ) ) {
            $course_id = get_the_ID();
        }

        if ( empty( $key ) ) {
            return get_post_meta( $course_id, '_ld_custom_meta', true );
        }

        $meta_data = get_post_meta( $course_id, '_ld_custom_meta', true );

        return isset( $meta_data[$key] ) ? $meta_data[$key] : '';
    }
}

if ( ! function_exists( 'edubin_get_ld_loop_course_meta' ) ) {
    /**
     * Get course meta html
     *
     * @param  array $meta            meta to show
     * @param  array  $data           meta data
     * @return string
     */
    function edubin_get_ld_loop_course_meta( $meta, $data = array() ) {
        if ( empty( $meta ) ) {
            return '';
        }

        $out = '';

        if ( empty( $data ) ) {
            $data = get_post_meta( get_the_ID(), '_ld_custom_meta', true );
        }

        $meta = apply_filters( 'edubin_loop_course_meta', $meta );
        $data = apply_filters( 'edubin_loop_course_meta_data', $data );

        if ( in_array( 'duration', $meta ) && ! empty( $data['duration'] ) ) {
            $out .= '<li><i class="far fa-clock"></i>' . esc_html( $data['duration'] ) . '</li>';
        }

        if ( in_array( 'level', $meta ) && ! empty( $data['level'] ) ) {
            if ( function_exists( 'ldcm_get_course_level_label' ) ) {
                $level = ldcm_get_course_level_label( $data['level'] );
            } else {
                $level = $data['level'];
            }
            $out .= '<li><i class="fas fa-signal"></i>' . esc_html( $level ) . '</li>';
        }

        if ( in_array( 'language', $meta ) && ! empty( $data['language'] ) ) {
            $out .= '<li><i class="fas fa-globe"></i>' . esc_html( $data['language'] ) . '</li>';
        }

        if ( in_array( 'enrolled', $meta ) ) {
            $enrolled = ! empty( $data['enrolled'] ) ? $data['enrolled'] : 0;
            switch ( get_post_type( get_the_ID() ) ) {
            case 'sfwd-courses':
                $count = edubin_get_ld_course_student_count( get_the_ID(), $enrolled );
                break;
            case 'groups':
                $count = edubin_get_ld_group_student_count( get_the_ID(), $enrolled );
                break;
            }
            $out .= '<li><i class="fas fa-users"></i>' . $count . '</li>';
        }

        /** Add custom meta items here */
        $html = apply_filters( 'edubin_loop_course_meta_items', $out );

        if ( ! empty( $html ) ) {
            $html = '<ul class="post-meta">' . $html . '</ul>';
        }

        return $html;
    }
}

if ( ! function_exists( 'edubin_get_ld_course_student_count' ) ) {
    /**
     * Get LearnDash course student count
     * @param  integer $course_id     course id
     * @param  integer $base_count    base count
     * @return integer                student count
     */
    function edubin_get_ld_course_student_count( $course_id, $base_count = 0 ) {
        $course_access_users = learndash_get_course_users_access_from_meta( $course_id );
        if ( ! empty( $course_access_users ) ) {
            $course_access_users = learndash_convert_course_access_list( $course_access_users, true );
            $count               = count( $course_access_users );
        } else {
            $course_access_list = learndash_get_course_meta_setting( $course_id, 'course_access_list' );
            if ( ! empty( $course_access_list ) && is_array( $course_access_list ) ) {
                $course_access_users = explode( ',', $course_access_list );
                $count               = count( $course_access_users );
            } else {
                $count = 0;
            }
        }
        return $count + absint( $base_count );
    }
}

if ( ! function_exists( 'edubin_get_ld_group_student_count' ) ) {
    /**
     * Get LearnDash group student count
     * @param  integer $post_id       post id
     * @param  integer $base_count    base count
     * @return integer                student count
     */
    function edubin_get_ld_group_student_count( $post_id, $base_count = 0 ) {
        $group_users = learndash_get_groups_user_ids( $post_id );
        if (  ( empty( $group_users ) ) || ( ! is_array( $group_users ) ) ) {
            $group_users = array();
        }
        $count = count( $group_users );
        return $count + absint( $base_count );
    }
}

