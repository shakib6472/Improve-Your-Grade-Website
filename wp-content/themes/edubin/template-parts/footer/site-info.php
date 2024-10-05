<?php
/**
 * Displays footer site info
 *
 * @package Edubin
 * Version: 1.0.0
 */
    $copyright_text = Edubin::setting( 'copyright_text' );
?>

<div class="site-info">
    <?php if ( $copyright_text ) : ?>
         <p><?php echo esc_html( Edubin::setting( 'copyright_text' ) ); ?></p> 
    <?php endif; ?>
</div><!-- .site-info -->
