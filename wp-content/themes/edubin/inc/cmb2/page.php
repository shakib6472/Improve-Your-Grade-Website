<?php

/**
 * MetaBoxes for Edubin Theme
 */
namespace Edubin;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Metaboxes Class
 */ 
class Metaboxes {

    public static function init() {
        add_filter( 'cmb2_admin_init', array( __CLASS__, 'page_metabox' ) );

    }

    public static function page_metabox() {
        
        global $wp_registered_sidebars;
        $sidebars = array();
        if ( ! empty( $wp_registered_sidebars ) ) :
            foreach ( $wp_registered_sidebars as $sidebar ) :
                $sidebars[$sidebar['id']] = $sidebar['name'];
            endforeach;
        endif;

        $headers = array_merge( array( 'global' => __( 'Global Setting', 'edubin' ) ), edubin_fetch_header_layouts(), array( 'none' => __( 'None', 'edubin' ) ) );
        $footers = array_merge( array( 'global' => __( 'Global Setting', 'edubin' ) ), edubin_get_footer_layouts(), array( 'none' => __( 'None', 'edubin' ) ) );
        $prefix = 'edubin_page_';
        $prefix_edubin = '_edubin_';

        $page_meta = new_cmb2_box( array(
            'id'           => $prefix_edubin . 'page_metabox',
            'title'        => __( 'Page Settings', 'edubin' ),
            'object_types' => array( 'page' ), // Post type
            'context'      => 'normal', //  'normal', 'advanced', or 'side'
            'priority'     => 'high',  //  'high', 'core', 'default' or 'low'
            'show_names'   => true, // Show field names on the left
            'vertical_tabs' => true, // Set vertical tabs, default false
            'tabs' => array(

                array(
                    'id'    => 'tab-page',
                    'icon' => 'dashicons-align-left',
                    'title' => 'Page Layout',
                    'fields' => array(
                        $prefix_edubin . 'page_container',
                        $prefix_edubin . 'page_content_layout',
                        $prefix_edubin . 'page_sidebar_id',
                        $prefix_edubin . 'page_sidebar_width',
                        $prefix_edubin . 'page_sidebar_sticky',
                    ),
                ),
                array(
                    'id'    => 'tab-header',
                    'icon' => 'dashicons-heading',
                    'title' => 'Page Header',
                    'fields' => array(
                        $prefix_edubin . 'tpc_mb_elementor_header',
                        $prefix_edubin . 'page_header_top_show',
                        $prefix_edubin . 'page_header_top_bar_style',
                        $prefix_edubin . 'page_top_bg_color',
                        $prefix_edubin . 'page_header_sticky',
                        $prefix_edubin . 'page_header_transparent',
                        $prefix_edubin . 'page_transparent_logo',
                        $prefix_edubin . 'page_transparent_header_color',
                        $prefix_edubin . 'page_dark_header',
                    ),
                ),
                array(
                    'id'    => 'tab-page',
                    'icon' => 'dashicons-archive',
                    'title' => 'Page Title',
                    'fields' => array(
                        $prefix_edubin . 'page_header_enable',
                        $prefix_edubin . 'header_img',
                        $prefix_edubin . 'custom_page_title',
                        $prefix_edubin . 'custom_page_breadcrumb',
                        $prefix_edubin . 'page_title_style',
                        $prefix_edubin . 'page_title_bg_color',
                    ),
                ),
                array(
                    'id'    => 'tab-colors',
                    'icon' => 'dashicons-art',
                    'title' => 'Page Colors',
                    'fields' => array(
                        $prefix_edubin . 'page_primary_color',
                        $prefix_edubin . 'page_secondary_color',
                        $prefix_edubin . 'page_bg_color',
                    ),
                ),
                array(
                    'id'    => 'tab-footer',
                    'icon' => 'dashicons-align-full-width',
                    'title' => 'Page Footer',
                    'fields' => array(
                        $prefix_edubin . 'mb_elementor_footer',
                    ),
                ),
                // array(
                //     'id'    => 'tab-advanced',
                //     'icon' => 'dashicons-shortcode',
                //     'title' => 'Advanced',
                //     'fields' => array(
                //         $prefix_edubin . 'page_extra_class',
                //     ),
                // ),
            )

        ) );

        // ======== Page Title =======

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'page_header_enable',
            'type'        => 'radio_inline',
            'name'        => __( 'Page Title', 'edubin' ),
            'default'     => 'default',
            'options'     => array(
                'default' => __( 'Default', 'edubin' ),
                'enable'  => __( 'Enable', 'edubin' ),
                'disable' => __( 'Disable', 'edubin' )
            ),
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'page_title_style',
            'type'        => 'select',
            'name'        => __( 'Page Title Style', 'edubin' ),
            'default'     => 'global',
            'options'     => array(
                'global'  => __( 'Global Settings', 'edubin' ),
                'default' => __( 'Default', 'edubin' ),
                '1'       => 'Style 01',
                '2'       => 'Style 02'
            ),
            'description' => __( 'Here the global setting means the theme option setting. ', 'edubin' )
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'custom_page_title',
            'type'        => 'text',
            'name'        => __( 'Custom Page Title', 'edubin' ),
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'custom_page_breadcrumb',
            'type'        => 'text',
            'name'        => __( 'Custom Page Breadcrumb', 'edubin' ),
        ) );

        $page_meta->add_field( array(
            'id'   => $prefix_edubin . 'page_title_bg_color',
            'type' => 'colorpicker',
            'name' => __( 'Page Title Color', 'edubin' )
        ) );
        $page_meta->add_field( array(
            'name'       => __('Page Title Background Image', 'edubin'),
            'id'         => $prefix_edubin . 'header_img',
            'type'       => 'file',
            // 'default'    => ''
        ) );
        // ======== Page Header =======

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'tpc_mb_elementor_header',
            'type'        => 'select',
            'name'        => __( 'Header Layout Type', 'edubin' ),
            'options'     => $headers,
            'default'     => 'global',
        ) );

        // $page_meta->add_field( array(
        //     'name'       => __('Select Header', 'edubin'),
        //     'id'         => $prefix_edubin . 'tpc_mb_elementor_header',
        //     'type'       => 'select',
        //     'default'    => 'enable',
        //     'options'    => edubin_get_elementor_header()
        // ) );              
            // end old    

        $page_meta->add_field( array(
            'id'      => $prefix_edubin . 'page_header_top_show',
            'name'    => 'Header Top Bar',
            'type'    => 'radio_inline',
            'default' => 'default',
            'options' => array(
                'default' => __( 'Global Settings', 'edubin' ),
                'enable'  => __( 'Enable', 'edubin' ),
                'disable' => __( 'Disable', 'edubin' ),
            ),
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'page_header_top_bar_style',
            'type'        => 'select',
            'name'        => __( 'Header Top bar Style', 'edubin' ),
            'default'     => 'global',
            'options'     => array(
                'global'  => __( 'Global Settings', 'edubin' ),
                '1'       => 'Style 01',
                '2'       => 'Style 02',
                '3'       => 'Style 03'
            ),
        ) );

        $page_meta->add_field( array(
            'name'    => __('Header Top bar Background Color', 'edubin'),
            'id'      => $prefix_edubin . 'page_top_bg_color',
            'type'    => 'colorpicker',
            'default' => ''
        ) );

        $page_meta->add_field( array(
            'id'      => $prefix_edubin . 'page_header_sticky',
            'name'    => 'Header Sticky',
            'type'    => 'radio_inline',
            'default' => 'default',
            'options' => array(
                'default' => __( 'Global Settings', 'edubin' ),
                'enable'  => __( 'Enable', 'edubin' )
            ),
        ) );

        $page_meta->add_field( array(
            'id'      => $prefix_edubin . 'page_header_transparent',
            'name'    => 'Header Transparent',
            'type'    => 'radio_inline',
            'default' => 'disable',
            'options' => array(
                'enable'  => __( 'Enable', 'edubin' ),
                'disable' => __( 'Disable', 'edubin' )
            )
        ) );

        $page_meta->add_field( array(
            'id'      => $prefix_edubin . 'page_transparent_logo',
            'name'    => 'Enable Transparent Logo',
            'type'    => 'radio_inline',
            'default' => 'disable',
            'options' => array(
                'enable'  => __( 'Enable', 'edubin' ),
                'disable' => __( 'Disable', 'edubin' )
            ),
        ) );

        $page_meta->add_field( array(
            'id'      => $prefix_edubin . 'page_transparent_header_color',
            'name'    => 'Transparent Header White Color',
            'type'    => 'radio_inline',
            'default' => 'disable',
            'options' => array(
                'enable'  => __( 'Enable', 'edubin' ),
                'disable' => __( 'Disable', 'edubin' )
            ),
        ) );

        $page_meta->add_field( array(
            'id'      => $prefix_edubin . 'page_dark_header',
            'name'    => 'Dark Header',
            'type'    => 'radio_inline',
            'default' => 'disable',
            'options' => array(
                'enable'  => __( 'Enable', 'edubin' ),
                'disable' => __( 'Disable', 'edubin' )
            ),
        ) );

        // ======== Page Colors =======
        $page_meta->add_field( array(
            'name'    => __('Page Primary Color', 'edubin'),
            'id'      => $prefix_edubin . 'page_primary_color',
            'type'    => 'colorpicker',
            'default' => ''
        ) );

        $page_meta->add_field( array(
            'name'    => __('Page Secondary Color', 'edubin'),
            'id'      => $prefix_edubin . 'page_secondary_color',
            'type'    => 'colorpicker',
            'default' => ''
        ) );

         $page_meta->add_field( array(
            'name'    => __('Page Background', 'edubin'),
            'id'      => $prefix_edubin . 'page_bg_color',
            'type'    => 'colorpicker',
            'default' => ''
        ) );

        
        // ======== Page Footer =======

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'mb_elementor_footer',
            'type'        => 'select',
            'name'        => __( 'Footer Layout Type', 'edubin' ),
            'description' => __( 'Choose a footer for your website.', 'edubin' ),
            'options'     => $footers,
            'default'     => 'global',
            'description' => __( 'Global Settings means it will get the value which is selected from Theme Options > Footer Settings > Footer Layout Type.', 'edubin' )
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'page_container',
            'type'        => 'select',
            'name'        => __( 'Container', 'edubin' ),
            'default'     => 'boxed',
            'options'     => array(
                'boxed'      => __( 'Boxed', 'edubin' ),
                'full-width' => __( 'Full Width', 'edubin' )
            )
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'page_content_layout',
            'type'        => 'select',
            'name'        => __( 'Content Layout', 'edubin' ),
            'default'     => 'full-width',
            'options'     => array(
                'no-sidebar'    => __( 'No Sidebar (Only Content)', 'edubin' ),
                'left-sidebar'  => __( 'Left Sidebar', 'edubin' ),
                'right-sidebar' => __( 'Right Sidebar', 'edubin' )
            ),
            'description' => __( 'This option will not function if you select container <b>Full Width</b>.', 'edubin' )
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'page_sidebar_id',
            'type'        => 'select',
            'name'        => __( 'Sidebar', 'edubin' ),
            'options'     => $sidebars,
            'description' => __( 'This option will not function if you select container <b> Full Width</b> or <b>No Sidebar (Only Content )</b> option.', 'edubin' )
        ) );

        $page_meta->add_field( array(
            'id'          => $prefix_edubin . 'page_sidebar_width',
            'type'        => 'select',
            'name'        => __( 'Sidebar Width', 'edubin' ),
            'default'     => '3',
            'options'     => array(
                '3'    => __( '25%', 'edubin' ),
                '4'  => __( '33%', 'edubin' ),
            ),
            'description' => __( 'This option will not function if you select container <b>Full Width</b>.', 'edubin' )
        ) );


        $page_meta->add_field( array(
            'id'      => $prefix_edubin . 'page_sidebar_sticky',
            'name'    => 'Sidebar Sticky',
            'type'    => 'radio_inline',
            'default' => 'disable',
            'options' => array(
                'enable' => __( 'Enable', 'edubin' ),
                'disable'  => __( 'Disable', 'edubin' )
            ),
            'description' => __( 'This option will not function if you select container <b>Full Width</b>.', 'edubin' )
        ) );

        // ======== Extra =======

        // $page_meta->add_field( array(
        //     'id'          => $prefix . 'extra_class',
        //     'type'        => 'text',
        //     'name'        => __( 'Extra Class', 'edubin' ),
        //     'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'edubin' )
        // ) );
    }

 
}

Metaboxes::init();