<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class Edubin_Sensei_LMS_Helper {

    /**
     * Display the instructor's avatar and name.
     *
     * @param string $tag HTML tag to use for the instructor's name.
     * @param int $image_size Size of the avatar image.
     */
    public static function instructor( $tag = 'h6', $image_size = 40 ) {
        echo get_avatar( get_the_author_meta( 'ID' ), $image_size );

        echo '<' . esc_attr( $tag ) . ' class="instructor-name">';
            the_author();
        echo '</' . esc_attr( $tag ) . '>';
    }
    
    /**
     * Get the course price.
     *
     * @return string Course price with regular and sale prices if applicable, or "Free" if no price is set.
     */
    public static function course_price() {
        $wooproductID = get_post_meta( get_the_ID(), '_course_woocommerce_product', true );
        if ( $wooproductID != '-' && ! empty( $wooproductID ) ) :
            $currency_symbol = get_woocommerce_currency_symbol();
            $regular_price = $currency_symbol . get_post_meta( $wooproductID, '_regular_price', true );
            $sale_price = $currency_symbol . get_post_meta( $wooproductID, '_sale_price', true );
            if ( ! empty( $sale_price ) ) :
                return wp_kses_post( $sale_price . '<span class="regular-price">' . $regular_price . '</span>' );
            else :
                return wp_kses_post( $regular_price );
            endif;
        else :
            return esc_html__( 'Free', 'edubin' );
        endif;
    }
}
