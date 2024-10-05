<?php
use \Elementor\Group_Control_Image_Size;

$cat_link_url = $cat_carousel['link']['url'];
$is_external = ($cat_carousel['link']['is_external']) ? ('target="_blank"'): (''); 
$link_tag = ($cat_carousel['link']['url']) ? ('<a href="'.esc_url($cat_link_url).'" '.$is_external.'>'): ('');
$link_end_tag = ($cat_carousel['link']['url']) ? ('</a>'): ('');


$cat_bg_color = ($cat_carousel['bg_colors']) ? ('style="background: '.esc_attr__($cat_carousel['bg_colors'])) : ('');
$cat_title_color = ($cat_carousel['title_colors']) ? ('style="color: '.esc_attr__($cat_carousel['title_colors'])) : ('');
$cat_border_color = ($cat_carousel['border_colors']) ? ('style="color: '.esc_attr__($cat_carousel['border_colors'])) : ('');
    echo $link_tag;
        echo '<div class="edubin-icon-category">';
            echo '<div class="single-category" '.$cat_bg_color.'">';
                echo '<div class="img-wrapper" '.$cat_border_color.'">';
                    echo Group_Control_Image_Size::get_attachment_image_html($cat_carousel, 'carosul_imagesize', 'carosul_image');
                echo '</div>';

                echo '<h3 class="icon-category-title" '.$cat_title_color.'">';
                    echo $cat_carousel['carosul_image_title'];
                echo '</h3>';

            echo '</div>';
        echo '</div>';
    echo $link_end_tag;

?>