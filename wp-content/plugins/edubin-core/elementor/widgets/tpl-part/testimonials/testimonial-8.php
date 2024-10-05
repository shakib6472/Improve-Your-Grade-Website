<?php
use \Elementor\Group_Control_Image_Size;

    echo '<div class="edubin-testi-single layout-8">';

        echo '<div class="testimonial-wrapper">';
            echo '<div class="testimonial-thum">';
                if( !empty($testimonial['client_image']['url']) ){
                    echo '<div class="testimonal-image">'.Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' ).'</div>';
                } 
            echo '</div>';

            echo '<div class="testimonial-cont">';
                if ( $settings['quote_show_hide']){
                    echo '<div class="quote-icon"><i class="flaticon-quote"></i></div>';
                }
                if( !empty($testimonial['client_say_heading']) ){
                    echo '<h4 class="testi-heading">'.esc_html__( $testimonial['client_say_heading'], 'edubin-core' ).'</h4>';
                }
                if( !empty($testimonial['client_say']) ){
                    echo '<p class="client-say">'.esc_html__( $testimonial['client_say'], 'edubin-core' ).'</p>';
                } 

                echo '<div class="testi-name-degree">';
                    if( !empty($testimonial['client_name']) ){
                        echo '<h6 class="name">'.esc_html__( $testimonial['client_name'], 'edubin-core' ).'</h6>';
                    }
                echo '</div>';
                
            echo '</div>';

        echo '</div>';

        
        
    echo '</div>';
