
<?php
/**
 * The template for displaying learnpress single page
 *
 */

get_header();

    $post_id = edubin_get_id();

    $lp_single_page_layout = Edubin::setting( 'lp_single_page_layout' );


    if ( $lp_single_page_layout == '6' ) :

        get_template_part( 'learnpress/tpl-part/single/single-layout', '6');  

    elseif ( $lp_single_page_layout == '5' ) :

        get_template_part( 'learnpress/tpl-part/single/single-layout', '5');  

    elseif ( $lp_single_page_layout == '4' ) :

        get_template_part( 'learnpress/tpl-part/single/single-layout', '4');  

    elseif ( $lp_single_page_layout == '3' ) :

        get_template_part( 'learnpress/tpl-part/single/single-layout', '3');  

    elseif ( $lp_single_page_layout == '2' ) :

        get_template_part( 'learnpress/tpl-part/single/single-layout', '2');  

    elseif ( $lp_single_page_layout == '1' ) :

        get_template_part( 'learnpress/tpl-part/single/single-layout', '1');  

    endif; //End single page layout


get_footer();
