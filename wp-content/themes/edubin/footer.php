<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Edubin
 */

		echo '</div>';

		$edubin_get_page_footer = get_post_meta( get_the_ID(), '_edubin_mb_elementor_footer', true );

		$footer = apply_filters( 'edubin_get_footer_layout',  Edubin::setting( 'edubin_get_elementor_footer' ) );
		$default_footers = array( 'theme-default-footer' );
		
    	$footer_widget_area_column = Edubin::setting( 'footer_widget_area_column' );
		$copyright_text = Edubin::setting( 'copyright_text' );
		$footer_variations = Edubin::setting( 'footer_variations' );
		$copyright_show = Edubin::setting( 'copyright_show' );

		echo '<footer id="colophon" class="site-footer footer-v' . esc_attr($footer_variations) . '">';

		if ( $footer != 'theme-default-footer') :

			edubin_show_footer_builder( $footer );

		elseif ( $footer == 'theme-default-footer' ) :

          if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) :
                 if ( $footer_widget_area_column == '12' ) :
                    get_template_part( 'template-parts/footer/widgets-1' );
                elseif( $footer_widget_area_column == '6_6' ) :
                    get_template_part( 'template-parts/footer/widgets-2' );
                elseif( $footer_widget_area_column == '4_4_4' ) :
                    get_template_part( 'template-parts/footer/widgets-3' );
                elseif( $footer_widget_area_column == '3_3_3_3' ) :
                    get_template_part( 'template-parts/footer/widgets-4' );
                elseif( $footer_widget_area_column == '3_6_3' ) :
                    get_template_part( 'template-parts/footer/widgets-5' );
                elseif( $footer_widget_area_column == '4_3_2_3' ) :
                    get_template_part( 'template-parts/footer/widgets-6' );
                elseif( $footer_widget_area_column == '4_2_2_4' ) :
                    get_template_part( 'template-parts/footer/widgets-7' );
                 endif; 
            endif; 

			if ( $copyright_show) : 
			    echo '<div class="edubin-footer-default-wrapper site-footer footer-bottom">';
			       echo '<div class="site-info ' . esc_attr( apply_filters( 'edubin_footer_site_info_container_class', 'edubin-container' ) ) . '">';
			            echo '<div class="edubin-row">';
			                if ( is_active_sidebar( 'copyright' ) ) : 
			                    echo '<div class="' . (has_nav_menu( 'footer_menu' ) ? 'edubin-col-md-6' : 'edubin-col-md-12 text-center') . '">';
			                        dynamic_sidebar( 'copyright' );
			                    echo '</div>';
			                else : 
			                    echo '<div class="' . (has_nav_menu( 'footer_menu' ) ? 'edubin-col-md-6' : 'edubin-col-md-12 text-center') . '">';
									if ( $copyright_text ) :
										echo wp_kses_post( $copyright_text );
									else :
										$allowed_html_array = array( 'a' => array( 'href' => array() ) );
										echo wp_kses( sprintf( __( '&copy; %s - Edubin. All Rights Reserved. Proudly powered by <a href="https://thepixelcurve.com">Pixelcurve</a>', 'edubin' ), date( "Y" ) ), $allowed_html_array );
									endif;
			                    echo '</div>';
			                endif; 

			                if ( is_active_sidebar( 'copyright_2' ) ) : 
			                    echo '<div class="edubin-col-md-6 text-ml-left">';
			                        dynamic_sidebar( 'copyright_2' );
			                    echo '</div>';
			                else : 
			                    if ( has_nav_menu( 'footer_menu' ) ) : 
			                        echo '<div class="edubin-col-md-6 text-right text-ml-left">';
			                            echo '<nav class="social-navigation" role="navigation" aria-label="' . esc_attr__( 'Footer Menu', 'edubin' ) . '">';
			                                wp_nav_menu( array(
			                                    'theme_location' => 'footer_menu',
			                                    'container_class' => '',
			                                    'depth'          => 1,
			                                ) );
			                            echo '</nav>';
			                        echo '</div>';
			                    endif; 
			                endif; 
			            echo '</div>';
			        echo '</div>';
			    echo '</div>';
			endif; 

		else:

          if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) :
                 if ( $footer_widget_area_column == '12' ) :
                    get_template_part( 'template-parts/footer/widgets-1' );
                elseif( $footer_widget_area_column == '6_6' ) :
                    get_template_part( 'template-parts/footer/widgets-2' );
                elseif( $footer_widget_area_column == '4_4_4' ) :
                    get_template_part( 'template-parts/footer/widgets-3' );
                elseif( $footer_widget_area_column == '3_3_3_3' ) :
                    get_template_part( 'template-parts/footer/widgets-4' );
                elseif( $footer_widget_area_column == '3_6_3' ) :
                    get_template_part( 'template-parts/footer/widgets-5' );
                elseif( $footer_widget_area_column == '4_3_2_3' ) :
                    get_template_part( 'template-parts/footer/widgets-6' );
                elseif( $footer_widget_area_column == '4_2_2_4' ) :
                    get_template_part( 'template-parts/footer/widgets-7' );
                 endif; 
            endif; 

			if ( $copyright_show) : 
			    echo '<div class="edubin-footer-default-wrapper site-footer footer-bottom">';
			       echo '<div class="site-info ' . esc_attr( apply_filters( 'edubin_footer_site_info_container_class', 'edubin-container' ) ) . '">';
			            echo '<div class="edubin-row">';
			                if ( is_active_sidebar( 'copyright' ) ) : 
			                    echo '<div class="' . (has_nav_menu( 'footer_menu' ) ? 'edubin-col-md-6' : 'edubin-col-md-12 text-center') . '">';
			                        dynamic_sidebar( 'copyright' );
			                    echo '</div>';
			                else : 
			                    echo '<div class="' . (has_nav_menu( 'footer_menu' ) ? 'edubin-col-md-6' : 'edubin-col-md-12 text-center') . '">';
									if ( $copyright_text ) :
										echo wp_kses_post( $copyright_text );
									else :
										$allowed_html_array = array( 'a' => array( 'href' => array() ) );
										echo wp_kses( sprintf( __( '&copy; %s - Edubin. All Rights Reserved. Proudly powered by <a href="https://thepixelcurve.com">Pixelcurve</a>', 'edubin' ), date( "Y" ) ), $allowed_html_array );
									endif;
			                    echo '</div>';
			                endif; 

			                if ( is_active_sidebar( 'copyright_2' ) ) : 
			                    echo '<div class="edubin-col-md-6 text-ml-left">';
			                        dynamic_sidebar( 'copyright_2' );
			                    echo '</div>';
			                else : 
			                    if ( has_nav_menu( 'footer_menu' ) ) : 
			                        echo '<div class="edubin-col-md-6 text-right text-ml-left">';
			                            echo '<nav class="social-navigation" role="navigation" aria-label="' . esc_attr__( 'Footer Menu', 'edubin' ) . '">';
			                                wp_nav_menu( array(
			                                    'theme_location' => 'footer_menu',
			                                    'container_class' => '',
			                                    'depth'          => 1,
			                                ) );
			                            echo '</nav>';
			                        echo '</div>';
			                    endif; 
			                endif; 
			            echo '</div>';
			        echo '</div>';
			    echo '</div>';
			endif; 
				
			endif;

	echo '</footer>';

	echo '</div>';

	wp_footer();

?>



<?php
echo '</body>';
echo '</html>';
