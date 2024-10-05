
<?php
/**
 * The template for displaying lifterlms single page
 *
 */

get_header();

    $post_id = edubin_get_id();

    $lif_single_page_layout = Edubin::setting( 'lif_single_page_layout'); 

    if ( $lif_single_page_layout == '5' ) :

        get_template_part( 'lifterlms/tpl-part/single/single-layout', '5');  

    elseif ( $lif_single_page_layout == '4' ) :

        get_template_part( 'lifterlms/tpl-part/single/single-layout', '4');  

    elseif ( $lif_single_page_layout == '3' ) :

        get_template_part( 'lifterlms/tpl-part/single/single-layout', '3');  

    elseif ( $lif_single_page_layout == '2' ) :

        get_template_part( 'lifterlms/tpl-part/single/single-layout', '2');  

    elseif ( $lif_single_page_layout == '1' ) :

        get_template_part( 'lifterlms/tpl-part/single/single-layout', '1');  

    endif; //End single page layout


get_footer();
