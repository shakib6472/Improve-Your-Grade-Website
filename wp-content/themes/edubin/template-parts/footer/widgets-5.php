<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Edubin
 * Version: 1.0.0
 */

?>

<div class="footer-top">
    <div class="edubin-container">
        <div class="edubin-row footer-wrap">
            <div class="edubin-col-lg-3 edubin-col-md-4 <?php if ( is_active_sidebar( 'footer-1' ) ) : echo esc_attr( 'sidebar-yes' ); else : echo esc_attr( 'sidebar-no' ); endif; ?>">
                <div class="footer-column">
                    <?php dynamic_sidebar( 'footer-1' ); ?>     
                </div>
             </div>
            <div class="edubin-col-lg-6 edubin-col-md-4 <?php if ( is_active_sidebar( 'footer-2' ) ) : echo esc_attr( 'sidebar-yes' ); else : echo esc_attr( 'sidebar-no' ); endif; ?>">
                <div class="footer-column">
                    <?php dynamic_sidebar( 'footer-2' ); ?>     
                </div>
             </div>
            <div class="edubin-col-lg-3 edubin-col-md-4 <?php if ( is_active_sidebar( 'footer-3' ) ) : echo esc_attr( 'sidebar-yes' ); else : echo esc_attr( 'sidebar-no' ); endif; ?>">
                <div class="footer-column">
                    <?php dynamic_sidebar( 'footer-3' ); ?>     
                </div>
             </div>
        </div>
    </div>
</div>