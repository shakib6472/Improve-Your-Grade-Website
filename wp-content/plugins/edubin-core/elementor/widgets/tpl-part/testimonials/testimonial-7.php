<?php
use \Elementor\Group_Control_Image_Size;

$quote_svg = '<svg 
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink"
width="41px" height="36px">
<path fill-rule="evenodd"  fill="rgb(255, 193, 7)"
d="M41.000,26.080 C41.000,31.558 36.630,35.999 31.240,35.999 C25.850,35.999 21.480,31.558 21.480,26.080 C21.480,26.075 21.481,26.071 21.481,26.066 C21.469,25.777 20.895,9.974 30.993,2.439 C40.098,-4.356 30.275,3.901 28.079,16.703 C29.072,16.357 30.132,16.161 31.240,16.161 C36.630,16.161 41.000,20.602 41.000,26.080 ZM9.769,35.999 C4.378,35.999 0.009,31.558 0.009,26.080 C0.009,26.075 0.009,26.071 0.009,26.066 C-0.002,25.777 -0.576,9.974 9.521,2.439 C18.627,-4.356 8.804,3.901 6.608,16.703 C7.600,16.357 8.661,16.161 9.769,16.161 C15.159,16.161 19.528,20.602 19.528,26.080 C19.528,31.558 15.159,35.999 9.769,35.999 Z"/></svg>';
$quote_icon = '<div class="quote-bg"><i class="flaticon-quote"></i></div>';

$print_quote = ($settings['quote_style'] == '1') ? ($quote_svg) : ($quote_icon);

        echo '<div class="edubin-testi-single layout-7">';

            echo '<div class="testimonial-wrapper">';
                echo '<div class="testimonial-thum">';
                    if( !empty($testimonial['client_image']['url']) ){
                        echo '<div class="testimonal-image">'.Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' ).'</div>';
                    } 
                echo '</div>';

                echo '<div class="testimonial-cont">';
                    if ( $settings['quote_show_hide']){
                        echo $print_quote;
                    }
                    if( !empty($testimonial['client_say_heading']) ){
                        echo '<h4 class="testi-heading">'.esc_html__( $testimonial['client_say_heading'], 'edubin-core' ).'</h4>';
                    }
                    if( !empty($testimonial['client_say']) ){
                        echo '<p class="client-say" >'.esc_html__( $testimonial['client_say'], 'edubin-core' ).'</p>';
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

            
            
        echo '</div>';