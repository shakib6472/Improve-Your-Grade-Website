<?php
namespace Edubin\Tutor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.

/*
 * Edubin Tutor Helper Class
 */ 
class Helper {

    protected static $instance = null;

    public static function instance() {
        if ( null === self::$instance ) :
            self::$instance = new self();
        endif;
        return self::$instance;
    }

    public static function rating( $type = 1 ) {
        $decimal_number    = apply_filters( 'edubin_tl_course_rating_decimal', 1 );
        $course_rating     = tutor_utils()->get_course_rating();
        $ratings_average   = $course_rating->rating_avg;
        $ratings_average_2 = number_format( $course_rating->rating_avg, $decimal_number );
        $total_ratings     = $course_rating->rating_count;
        $percent           = ( ! $ratings_average ) ? 0 : min( 100, ( round( $ratings_average * 2 ) / 2 ) * 20 );
        $status            = get_tutor_option( 'enable_course_review' );
        $rating_text       = $total_ratings > 1 ? __( 'Ratings', 'edubin' ) : __( 'Rating', 'edubin' );
        if ( $status ) :
            echo '<div class="tpc-tl-course-rating">';
                if ( 1 == $type ) :
                    tutor_utils()->star_rating_generator( $ratings_average );
                    echo '<span class="tpc-tl-rating-text">(';
                        echo esc_html( $ratings_average_2 ) . '/ ' . esc_html( $total_ratings ) . ' ' . esc_html( $rating_text ) . ')';
                    echo '</span>';
                endif;
            echo '</div>';
        endif;
    }
}

// Helper::instance();