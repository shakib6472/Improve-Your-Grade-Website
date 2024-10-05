<?php
use \Elementor\Group_Control_Image_Size;

// echo '<div '.$this->get_render_attribute_string( 'testimonial_area_attr' ).'>';
//     foreach ($settings['edubin_testimonial_list'] as $testimonial){
        echo '<div class="edubin-testi-single">';
            echo '<div class="testimonial-cont">';
                if( !empty($testimonial['client_say_heading']) ){
                    echo '<h3 class="testi-heading">'.esc_html__( $testimonial['client_say_heading'], 'edubin-core' ).'</h3>';
                }
                if( !empty($testimonial['client_say']) ){
                    echo '<p class="client-say">'.esc_html__( $testimonial['client_say'], 'edubin-core' ).'</p>';
                }
            echo '</div>';

            echo '<div class="testimonial-thum">';
                if( !empty($testimonial['client_image']['url']) ){
                    echo '<div class="testimonal-image">'.Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' ).'</div>';
                } 
                echo '<div class="testi-name-degree">';
                    if( !empty($testimonial['client_name']) ){
                        echo '<h6 class="name">'.esc_html__( $testimonial['client_name'], 'edubin-core' ).'</h6>';
                    }
                    if( !empty($testimonial['client_designation']) ){
                            echo '<p class="degree">'.esc_html__( $testimonial['client_designation'], 'edubin-core' ).'</p>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
//     };
// echo '</div>';