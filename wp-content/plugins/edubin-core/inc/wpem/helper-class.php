<?php
namespace Edubin\WPEMS;
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/**
 * Taxonomy Support for WP Events Manager
 *
 * @since 1.0.0
 */
class Taxonomy {

    protected static $instance = null;
    const SPEAKER = 'tp_event_speaker';

    public function __construct() {
		add_action( 'init', array( __CLASS__, 'taxonomy' ) );
        add_action( 'pre_get_posts', array( $this, 'event_archive_items' ) );
        add_filter( 'tp_event_admin_event_tab_info', [ $this, 'add_event_speaker_tab' ] );
        add_filter( 'manage_edit-' . self::SPEAKER . '_columns', [ $this, 'thumbnail_column' ], 50 );
        add_filter( 'manage_' . self::SPEAKER . '_custom_column', [ $this, 'thumbnail_column_content' ], 10, 3 );
        add_filter( 'tp_event_price_format', [ $this, 'modify_price_decimal_separator' ], 10, 3 );
	}
    
    public static function instance() {
        if ( null === self::$instance ) :
            self::$instance = new self();
        endif;
        return self::$instance;
    }

    public static function taxonomy() {

        $labels = array(
            'name'              => __( 'Event Speakers', 'edubin' ),
            'singular_name'     => __( 'Event Speaker', 'edubin' ),
            'search_items'      => __( 'Search Event Speaker', 'edubin' ),
            'edit_item'         => __( 'Edit Speaker', 'edubin' ),
            'update_item'       => __( 'Update Speaker', 'edubin' ),
            'add_new_item'      => __( 'Add New Speaker', 'edubin' ),
            'new_item_name'     => __( 'New Event Speaker', 'edubin' ),
            'menu_name'         => __( 'Event Speakers', 'edubin' )
        );

        register_taxonomy( self::SPEAKER, apply_filters( 'edubin_post_type_event' , 'tp_event' ), array(
            'labels'            => apply_filters( 'edubin_tp_event_taxomony_speaker_labels', $labels ),
            'query_var'         => true,
            'rewrite'           => array( 'slug' => apply_filters( 'edubin_tp_event_speaker_slug', 'event-speaker' ) ),
            'public'            => true,
            'show_admin_column' => true,
            'show_ui'           => true
        ) );
    }

    public function add_event_speaker_tab( $tabs ) {
        $tabs[35] = [
            'link' => 'edit-tags.php?taxonomy=' . self::SPEAKER . '&post_type=tp_event',
            'name' => __( 'Speakers', 'edubin' ),
            'id'   => 'edit-' . self::SPEAKER
        ];

        return $tabs;
    }

    public function thumbnail_column( $defaults ) {
        $defaults['edubin_speaker_img']    = __( 'Thumbnail', 'edubin' );
        return $defaults;
    }

    public function thumbnail_column_content( $columns, $column_name, $term_id ) {
        if ( 'edubin_speaker_img' === $column_name ) :
            $image_url  = get_term_meta( $term_id, 'edubin_tp_event_speaker_image', true );
            if ( $image_url ) :
                return '<img src="' . esc_url( $image_url ) . '" alt="' . __( 'Event Speaker', 'edubin' ). '" style="width: 60px; height: 60px; object-fit: cover;" />';
            else :
                return;
            endif;
        endif;
    }

    public function event_archive_items( $query ) {
        $items = 6;
        if ( $query->is_main_query() && ! is_admin() && ( is_post_type_archive( 'tp_event' ) || is_tax( 'tp_event_category' ) ) ) :
            $query->set( 'posts_per_page', $items );
        endif;
    }

    public function modify_price_decimal_separator( $price_format, $price, $with_currency ) {
        $price = wpems_get_option( 'currency_separator', ',' );

        if ( ! empty( $price ) ) :
            $price_format = str_replace( $price, '<span class="decimal-separator">' . $price, $price_format );
            $price_format .= '</span>';
        endif;

        return $price_format;
    }
}

Taxonomy::instance();