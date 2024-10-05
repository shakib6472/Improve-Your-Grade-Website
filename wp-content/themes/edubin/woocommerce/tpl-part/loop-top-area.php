<?php

if ( ! woocommerce_products_will_display() ) :
	return;
endif;
?>
<div class="edubin-woocommerce-shop-top">
	<div class="edubin-woocommerce-shop-top-count">
		<?php woocommerce_result_count();?>
	</div>
	<div class="edubin-woocommerce-shop-top-order">
		<?php woocommerce_catalog_ordering();?>
	</div>
</div>