
<?php
/**
 * The template for displaying learndash single page
 *
 */

//get_header();

    $post_id = edubin_get_id();

  //  if (function_exists('edubinGetPostViewsCustom')) {edubinSetPostViewsCustom(get_the_ID());}

    $ld_single_page_layout = Edubin::setting( 'ld_single_page_layout' );


    if ( $ld_single_page_layout == '5' ) :

        get_template_part( 'learndash/tpl-part/single/single-layout', '5');  

    elseif ( $ld_single_page_layout == '4' ) :

        get_template_part( 'learndash/tpl-part/single/single-layout', '4');  

    elseif ( $ld_single_page_layout == '3' ) :

        get_template_part( 'learndash/tpl-part/single/single-layout', '3');  

    elseif ( $ld_single_page_layout == '2' ) :

        get_template_part( 'learndash/tpl-part/single/single-layout', '2');  

    elseif ( $ld_single_page_layout == '1' ) :

        get_template_part( 'learndash/tpl-part/single/single-layout', '1');  

    endif; //End single page layout


//get_footer();
