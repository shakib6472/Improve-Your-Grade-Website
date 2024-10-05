<?php 

if ( ! defined( 'ABSPATH' ) ) { exit; }

    $ms_single_page_layout = Edubin::setting( 'ms_single_page_layout' );

    if ( $ms_single_page_layout == '5' ) :

    get_template_part( 'stm-lms-templates/tpl-part/single/single-layout', '5');  

    elseif ( $ms_single_page_layout == '4' ) :

    get_template_part( 'stm-lms-templates/tpl-part/single/single-layout', '4');  

    elseif ( $ms_single_page_layout == '3' ) :

    get_template_part( 'stm-lms-templates/tpl-part/single/single-layout', '3');  

    elseif ( $ms_single_page_layout == '2' ) :

    get_template_part( 'stm-lms-templates/tpl-part/single/single-layout', '2');  

    elseif ( $ms_single_page_layout == '1' ) :

    get_template_part( 'stm-lms-templates/tpl-part/single/single-layout', '1');  

    endif; //End single page layout