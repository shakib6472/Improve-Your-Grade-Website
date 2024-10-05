
<?php
/**
 * The template for displaying tutor single page
 *
 */

get_header();

    $post_id = edubin_get_id();

    $tutor_single_page_layout = Edubin::setting( 'tutor_single_page_layout'); 

    if ( $tutor_single_page_layout == '5' ) :

        get_template_part( 'tutor/tpl-part/single/single-layout', '5');  

    elseif ( $tutor_single_page_layout == '4' ) :

        get_template_part( 'tutor/tpl-part/single/single-layout', '4');  

    elseif ( $tutor_single_page_layout == '3' ) :

        get_template_part( 'tutor/tpl-part/single/single-layout', '3');  

    elseif ( $tutor_single_page_layout == '2' ) :

        get_template_part( 'tutor/tpl-part/single/single-layout', '2');  

    elseif ( $tutor_single_page_layout == '1' ) :

        get_template_part( 'tutor/tpl-part/single/single-layout', '1');  

    endif; //End single page layout


get_footer();
