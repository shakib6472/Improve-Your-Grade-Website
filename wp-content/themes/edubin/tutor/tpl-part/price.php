<span class="price">
<?php 
    //tutor_course_price();

        $is_purchasable = tutor_utils()->is_course_purchasable();
        $price          = apply_filters( 'get_tutor_course_price', null, get_the_ID() );
        if ( $is_purchasable && $price ) :
            $price = $price;
        else :
            $price = __( 'Free', 'edubin' );
        endif;

        echo wp_kses_post($price);

?></span>
