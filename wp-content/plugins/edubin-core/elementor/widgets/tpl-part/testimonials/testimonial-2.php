<?php
use \Elementor\Group_Control_Image_Size;

echo '<div class="edubin-testi-2-area">';
    echo '<div class="testi-heading">';
        echo '<h3 class="heading">'.esc_html__( $settings['heading'], 'edubin-core' ).'</h3>';
    echo '</div>';
    echo '<div '.$this->get_render_attribute_string( 'testimonial_area_attr' ).'>';
        foreach($settings['edubin_testimonial_list'] as $testimonial){
            echo '<div class="testi-single">';
                if( !empty($testimonial['client_image']['url']) ){
                    echo Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' );
                }
                if( !empty($testimonial['client_say']) ){
                    echo '<p class="content">'.esc_html__( $testimonial['client_say'], 'edubin-core' ).'</p>';
                }
                if( !empty($testimonial['client_name']) ){
                    echo '<h6 class="name">'.esc_html__( $testimonial['client_name'], 'edubin-core' ).'</h6>';
                }
                if( !empty($testimonial['client_designation']) ){
                    echo '<p class="degree">'.esc_html__( $testimonial['client_designation'], 'edubin-core' ).'</p>';
                }
            echo '</div>';
        };
    echo '</div>';
    if( !empty($settings['bg_image']['url']) ){
        echo '<div class="edubin-testi-bg-image">'.Group_Control_Image_Size::get_attachment_image_html( $settings, 'bg_imagesize', 'bg_image' ).'</div>';
    }
echo '</div>';


