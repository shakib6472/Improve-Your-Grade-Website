<?php 

    $post_id = edubin_get_id();

    $lp_single_page_layout = Edubin::setting( 'lp_single_page_layout' );

    if ( $lp_single_page_layout == '3' ) {
        return;
    }


?>

    <div class="edubin-col-lg-4 order-1 order-lg-2 lp-sidebar-col">
        <?php   get_template_part( 'learnpress/tpl-part/single/single', 'sidebar');  ?>
    </div>