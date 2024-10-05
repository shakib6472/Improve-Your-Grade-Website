<?php
if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

class Edubin_MS_LMS_Price {

    /**
     * Display the instructor's avatar and name with optional linking.
     *
     * @param string $tag HTML tag to use for the instructor's name.
     * @param int $image_size Size of the avatar image.
     * @param int|null $instructor_id Optional instructor ID.
     */
    public static function instructor( $tag = 'h6', $image_size = 40, $instructor_id = null ) {
        $redirect = edubin_set_value( 'ms_author_course_archive', true );
        $redirect = false;
        $instructor_id = ( ! empty( $instructor_id ) ) ? $instructor_id : get_the_author_meta( 'ID' );
        $author = STM_LMS_User::get_current_user( $instructor_id );

        if ( $redirect ) {
            echo '<a class="author-name" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) . '?msauthor=true' ) . '">';
        }

        if ( ! $redirect && edubin_set_value( 'ms_instructor_linking', true ) ) {
            echo '<a class="author-name" href="' . esc_url( STM_LMS_User::user_public_page_url( $author['id'] ) ) . '">';
        }

        echo get_avatar( get_the_author_meta( 'ID' ), $image_size );

        echo '<' . esc_attr( $tag ) . ' class="instructor-name">';
            the_author();
        echo '</' . esc_attr( $tag ) . '>';

        if ( $redirect ) {
            echo '</a>';
        }

        if ( ! $redirect && edubin_set_value( 'ms_instructor_linking', true ) ) {
            echo '</a>';
        }
    }
    
    /**
     * Display the course price with sale price if applicable.
     */
    public static function course_price() {
        $price = get_post_meta( get_the_ID(), 'price', true );
        $sale_price = STM_LMS_Course::get_sale_price( get_the_ID() );

        if ( empty( $price ) && ! empty( $sale_price ) ) {
            $price = $sale_price;
            $sale_price = '';
        }

        if ( ! empty( $price ) && ! empty( $sale_price ) ) {
            $tmp_price = $sale_price;
            $sale_price = $price;
            $price = $tmp_price;
        }

        if ( ! empty( $price ) || ! empty( $sale_price ) ) {
            if ( ! empty( $sale_price ) ) {
                echo '<span class="sale_price">' . wp_kses_post( STM_LMS_Helpers::display_price( $sale_price ) ) . '</span>';
            }

            if ( ! empty( $price ) ) {
                echo '<span class="price">' . wp_kses_post( STM_LMS_Helpers::display_price( $price ) ) . '</span>';
            }
        } else {
            echo '<span class="free-price">' . esc_html__( 'Free', 'edubin' ) . '</span>';
        }
    }
}
