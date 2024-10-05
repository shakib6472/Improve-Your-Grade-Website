<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Edubin
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function edubin_body_classes( $classes ) {
	//$preloader     = Edubin::setting( 'preloader_show' );
	$sticky_header = Edubin::setting( 'sticky_header_enable' );
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) :
		$classes[] = 'group-blog';
	endif;

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) :
		$classes[] = 'hfeed';
	endif;

	// if ( $preloader ) :
	// 	$classes[] = 'edubin-site-preloader-loading';
	// endif;

	// if ( $preloader ) :
	// 	$classes[] = 'edubin-site-preloader-loading';
	// endif;

	if ( $sticky_header ) :
		$classes[] = 'edubin-sticky-header-enable';
	endif;

	return $classes;
}
add_filter( 'body_class', 'edubin_body_classes' );


/**
* Edubin get tvf relented Function 
*/
add_filter('admin_body_class', 'edubin_admin_body_class');

function edubin_admin_body_class($classes)
{

    if (edubin_check_tvc()) {
        return "$classes no_edubin_unlock";
    } else {
        return "$classes edubin_unlock";
    }
}

function edubin_tvf_register_settings()
{
    add_option('edubin_tv_option', '');
    register_setting('edubin_tv_options_group', 'edubin_tv_option', 'edubin_tv_callback');
}
add_action('admin_init', 'edubin_tvf_register_settings');

function edubin_tvf_register_options_page()
{
    add_options_page('Theme Verify', 'Theme Verify', 'manage_options', 'edubin_tvf', 'edubin_tv_options_page');
}
add_action('admin_menu', 'edubin_tvf_register_options_page');

function edubin_tv_options_page()
{
    ?>
<div class="edubin-activation-theme_form">
    <div class="container-form">
<form method="post" action="options.php">
      <?php settings_fields('edubin_tv_options_group');?>

        <h1 class="edubin-title"><?php esc_html_e('Activate Your License', 'edubin');?></h1>
        <div class="edubin-content">
            <p class="edubin-content_subtitle">
                <?php echo sprintf(esc_html__('Welcome and thank you for Choosing %s Theme!', 'edubin'), esc_html(wp_get_theme()->get('Name'))); ?>
                <br/>
                <?php echo sprintf(esc_html__('The %s theme needs to be activated to enable demo import installation and customer support service.', 'edubin'), esc_html(wp_get_theme()->get('Name'))); ?>
            </p>
        </div>

        <?php if (edubin_check_tvc() == false): ?>
        <div class="help-description">
            <a href="https://www.youtube.com/watch?v=yTScONNFnZ8&feature=emb_title&ab_channel=Envato" target="_blank"><?php esc_html_e('How to find purchase code?', 'edubin');?></a>
        </div>

        <input type="text" placeholder="Enter Your Purchase Code"  id="edubin_tv_option" name="edubin_tv_option" value="<?php echo get_option('edubin_tv_option'); ?>" />

           <div class="licnese-active-button">
                <?php submit_button(__('Activate', 'edubin'), 'primary');?>
           </div>
        <?php endif;?>

        <div class="form-group hidden_group">
            <input type="hidden" name="deactivate_theme" value=" " class="form-control">
        </div>

        <?php
            $theme_fv_code = get_option('edubin_tv_option');
            if (!empty($theme_fv_code)) {
                ?>
                        <input type="hidden" name="edubin_tv_option" value=" " class="form-control">
                    <?php
            }
        ?>

        <?php wp_nonce_field('purchase-activation', 'security');?>

        <?php if (edubin_check_tvc()): ?>
            <button type="submit" class="button button-primary deactivate_theme-license" value="submit">
                <span class="text-btn"><?php esc_html_e('Deactivate', 'edubin');?></span>
                <span class="loading-icon"></span>
            </button>
        <?php endif;?>

      </form>


        <?php
            if (edubin_check_tvc()) {
        ?>

        <div class="edubin-activation-theme_congratulations">
            <h1 class="edubin-title">
                <?php esc_html_e('Thank you!', 'edubin');?>
            </h1>
            <span><?php esc_html_e('Your theme\'s license is activated successfully.', 'edubin');?></span>

        </div>
            <a href="<?php echo admin_url('themes.php?page=pt-one-click-demo-import'); ?>" class="button button-primary button-large button-next import-demo-next"><?php esc_html_e('Import Demo', 'edubin');?></a>
        <?php

    } else {

        $theme_fv_code = get_option('edubin_tv_option');?>

        <?php if (!empty($theme_fv_code)): ?>
             <div class="edubin-activation-theme_congratulations invalid">
                <h1 class="edubin-title">
                   <?php esc_html_e('Invalid Purchase Code', 'edubin');?>
                </h1>
            </div>
        <?php endif?>

        <?php }?>

    </div>
</div>
 <?php
}
