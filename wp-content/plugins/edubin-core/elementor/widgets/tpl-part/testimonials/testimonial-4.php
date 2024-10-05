<?php
use \Elementor\Group_Control_Image_Size;
// $qoute_bg_color = ($settings['quote_bg_color']) ? ($settings['quote_bg_color']) : ('#ffc600');
// $qoute_icon_color = ($settings['quote_icon_color']) ? ($settings['quote_icon_color']) : ('#fff');

$quote_bg_color = ($settings['quote_bg_color'] != '') ? ( $settings['quote_bg_color'] ) : ('var(--edubin-primary-color)');
$quote_icon_color = ($settings['quote_icon_color'] != '')  ? ( $settings['quote_icon_color'] ) : ('#fff');

$quote_svg = '<svg 
xmlns="http://www.w3.org/2000/svg"
xmlns:xlink="http://www.w3.org/1999/xlink"
width="61px" height="40px">
<path fill-rule="evenodd"  fill="'.$quote_bg_color.'"
d="M41.139,39.999 L19.860,39.999 C8.892,39.999 -0.000,31.045 -0.000,19.998 C-0.000,8.952 8.892,-0.001 19.860,-0.001 L41.139,-0.001 C52.108,-0.001 61.000,8.952 61.000,19.998 C61.000,25.702 61.000,39.999 61.000,39.999 C61.000,39.999 46.445,39.999 41.139,39.999 Z"/>
<path fill-rule="evenodd"  fill="'.$quote_icon_color.'"
d="M46.000,24.777 C46.000,28.760 42.819,32.000 38.908,32.000 C35.096,32.000 32.114,28.978 31.816,24.813 C31.308,17.720 34.819,11.932 37.980,9.129 C38.075,9.046 38.191,9.005 38.308,9.005 C38.429,9.005 38.549,9.049 38.644,9.136 C38.925,9.396 39.117,9.595 39.537,10.031 C39.858,10.364 40.317,10.840 41.059,11.596 C41.229,11.770 41.254,12.042 41.117,12.245 C39.303,14.927 39.255,16.856 39.319,17.563 C43.039,17.782 46.000,20.933 46.000,24.777 ZM40.062,12.020 C39.484,11.429 39.102,11.033 38.824,10.744 C38.595,10.507 38.440,10.346 38.304,10.210 C36.897,11.581 32.242,16.761 32.813,24.740 C33.072,28.357 35.635,30.982 38.908,30.982 C42.267,30.982 45.001,28.199 45.001,24.777 C45.001,21.354 42.267,18.570 38.908,18.570 C38.722,18.570 38.545,18.456 38.459,18.290 C38.277,17.937 37.861,15.476 40.062,12.020 ZM21.159,32.000 C17.349,32.000 14.366,28.978 14.067,24.814 L14.067,24.813 C13.560,17.721 17.071,11.932 20.232,9.130 C20.326,9.046 20.443,9.005 20.560,9.005 C20.680,9.005 20.801,9.049 20.896,9.136 C21.178,9.396 21.371,9.596 21.793,10.035 C22.114,10.367 22.572,10.843 23.311,11.596 C23.481,11.770 23.506,12.042 23.369,12.245 C21.555,14.928 21.506,16.856 21.570,17.563 C25.291,17.782 28.252,20.933 28.252,24.777 C28.252,28.760 25.070,32.000 21.159,32.000 ZM21.159,18.570 C20.974,18.570 20.796,18.456 20.710,18.290 C20.528,17.937 20.113,15.476 22.314,12.020 C21.738,11.432 21.358,11.037 21.080,10.749 C20.849,10.510 20.692,10.347 20.555,10.210 C19.149,11.581 14.493,16.762 15.064,24.740 C15.323,28.357 17.887,30.982 21.159,30.982 C24.519,30.982 27.253,28.199 27.253,24.777 C27.253,21.354 24.519,18.570 21.159,18.570 Z"/>
</svg>';

// echo '<div '.$this->get_render_attribute_string( 'testimonial_area_attr' ).'>';
//     foreach ($settings['edubin_testimonial_list'] as $testimonial){
        echo '<div class="edubin-testi-single">';
            if ( $settings['quote_show_hide']){
                
                echo '<div class="testi-icon-wrap">';
                    echo $quote_svg;
                    // echo '<span>';
                    //     echo '<i class="flaticon-quote"></i>';
                    // echo '</span>';
                echo '</div>';
            }
            echo '<div class="testi-content">';
                if( !empty($testimonial['client_say']) ){
                    echo '<p class="client-say">'.esc_html__( $testimonial['client_say'], 'edubin-core' ).'</p>';
                }
            echo '</div>';

            echo '<div class="testi-thum-degree-wrap">';
                if( !empty($testimonial['client_image']['url']) ){
                    echo '<div class="testi-img">'.Group_Control_Image_Size::get_attachment_image_html( $testimonial, 'client_imagesize', 'client_image' ).'</div>';
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