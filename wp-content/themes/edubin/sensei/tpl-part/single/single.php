
<?php
/**
 * The template for displaying sensei single page
 *
 */

get_header();

    $post_id = edubin_get_id();

    $sensei_single_page_layout = Edubin::setting( 'sensei_single_page_layout'); 

    if ( $sensei_single_page_layout == '5' ) :

        get_template_part( 'sensei/tpl-part/single/single-layout', '5');  

    elseif ( $sensei_single_page_layout == '4' ) :

        get_template_part( 'sensei/tpl-part/single/single-layout', '4');  

    elseif ( $sensei_single_page_layout == '3' ) :

        get_template_part( 'sensei/tpl-part/single/single-layout', '3');  

    elseif ( $sensei_single_page_layout == '2' ) :

        get_template_part( 'sensei/tpl-part/single/single-layout', '2');  

    elseif ( $sensei_single_page_layout == '1' ) :

        get_template_part( 'sensei/tpl-part/single/single-layout', '1');  

    endif; //End single page layout


get_footer();
