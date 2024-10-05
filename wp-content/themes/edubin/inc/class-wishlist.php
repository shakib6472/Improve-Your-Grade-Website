<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Edubin_Wishlist {
    protected static $instance = null;

    /**
     * Constructor to hook AJAX actions.
     */
    public function __construct() {
        add_action( 'wp_ajax_edubin_wishlist_item', [ $this, 'wishlist_ajax_connect' ] );
        add_action( 'wp_ajax_nopriv_edubin_wishlist_item', [ $this, 'wishlist_ajax_connect' ] );
        add_action( 'wp_ajax_edubin_wishlist_item_remove', [ $this, 'wishlist_ajax_remove' ] );
        add_action( 'wp_ajax_nopriv_edubin_wishlist_item_remove', [ $this, 'wishlist_ajax_remove' ] );
    }

    /**
     * Get the singleton instance of the class.
     *
     * @return Edubin_Wishlist The instance of the Edubin_Wishlist class.
     */
    public static function instance() {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Handle adding an item to the wishlist via AJAX.
     */
    public function wishlist_ajax_connect() {
        check_ajax_referer( 'edubin-wishlist-ajax-connect', 'security' );
        $status = array();

        if ( isset( $_POST['post_id'] ) && $_POST['post_id'] ) {
            self::cache_in_wishlist( $_POST['post_id'] );
            $status['progress'] = 'done';
            $status['text'] = __( 'Item Added to Wishlist', 'edubin' );
        } else {
            $status['progress'] = 'undone';
        }

        echo json_encode( $status );
        die();
    }

    /**
     * Handle removing an item from the wishlist via AJAX.
     */
    public function wishlist_ajax_remove() {
        check_ajax_referer( 'edubin-wishlist-ajax-connect', 'security' );
        $status = array();

        if ( isset( $_POST['post_id'] ) && $_POST['post_id'] ) {
            $id = $_POST['post_id'];
            $newly_added = array();
            if ( isset( $_COOKIE['tpc_course_wishlist'] ) ) {
                $items = explode( ',', $_COOKIE['tpc_course_wishlist'] );
                foreach ( $items as $key => $item ) {
                    if ( $id != $item ) {
                        unset( $items[$key] );
                        $newly_added[] = $item;
                    }
                }
            }

            setcookie( 'tpc_course_wishlist', implode( ',', $newly_added ), time() + 60 * 60 * 24 * 15, '/' );
            $_COOKIE['tpc_course_wishlist'] = implode( ',', $newly_added );
            $status['progress'] = 'done';
            $status['text'] = __( 'Add Item to wishlist', 'edubin' );
        } else {
            $status['progress'] = 'error';
        }

        echo json_encode( $status );
        die();
    }

    /**
     * Cache an item in the wishlist.
     *
     * @param int $id The ID of the item to cache in the wishlist.
     */
    public static function cache_in_wishlist( $id ) {
        $items = array();

        if ( isset( $_COOKIE['tpc_course_wishlist'] ) ) {
            $items = explode( ',', $_COOKIE['tpc_course_wishlist'] );
            if ( ! self::verify_wishlisted_items( $id, $items ) ) {
                $items[] = $id;
            }
        } else {
            $items = array( $id );
        }

        setcookie( 'tpc_course_wishlist', implode( ',', $items ), time() + 60 * 60 * 24 * 15, '/' );
        $_COOKIE['tpc_course_wishlist'] = implode( ',', $items );
    }

    /**
     * Verify if an item is in the wishlist.
     *
     * @param int $id The ID of the item to verify.
     * @return bool True if the item is in the wishlist, false otherwise.
     */
    public static function verify_wishlisted_items( $id ) {
        if ( empty( $id ) ) {
            return false;
        }

        if ( isset( $_COOKIE['tpc_course_wishlist'] ) && ! empty( $_COOKIE['tpc_course_wishlist'] ) ) {
            $added_items = explode( ',', $_COOKIE['tpc_course_wishlist'] );
            if ( in_array( $id, $added_items ) ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Display the wishlist button.
     *
     * @param WP_Post $post The post object.
     * @param string $type The type of button display ('icon' or 'text').
     */
    public static function content( $post, $type = 'icon' ) {
        $id = $post->ID;
        $class = '';
        $icon_class = 'flaticon-heart';
        $text = __( 'Add Item to wishlist', 'edubin' );

        $added = self::verify_wishlisted_items( $id );
        if ( $added ) {
            $text = __( 'Item Added to Wishlist', 'edubin' );
            $icon_class = 'flaticon-heart';
            $class = 'tpc-wishlisted';
        } else {
            $class = 'tpc-wishlist-non-added';
        }

        if ( 'text' === $type ) {
            echo '<a href="#tpc-wishlist-item-link" class="tpc-wishlist-button with-icon-text ' . esc_attr( $class ) . '" data-id="' . esc_attr( $id ) . '">';
                echo '<i class="' . esc_attr( $icon_class ) . '"></i>';
                echo '<span class="wishlist-text">' . esc_html( $text ) . '</span>';
            echo '</a>';
        } else {
            echo '<a href="#tpc-wishlist-item-link" class="tpc-wishlist-button with-icon ' . esc_attr( $class ) . '" data-id="' . esc_attr( $id ) . '">';
                echo '<i class="edubin-wishlist-wrapper ' . esc_attr( $icon_class ) . '"></i>';
            echo '</a>';
        }
    }

    /**
     * Fetch all items in the wishlist.
     *
     * @return array The list of wishlist item IDs.
     */
    public static function fetch_wishlist() {
        if ( isset( $_COOKIE['tpc_course_wishlist'] ) && ! empty( $_COOKIE['tpc_course_wishlist'] ) ) {
            return explode( ',', $_COOKIE['tpc_course_wishlist'] );
        }
        return array();
    }
}

Edubin_Wishlist::instance();
