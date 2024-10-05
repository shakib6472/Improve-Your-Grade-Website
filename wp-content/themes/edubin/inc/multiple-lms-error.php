<?php

/**
 * Check for other LMS plugins
 *
 */
function edubin_check_other_lms_plugins() {
    global $edubin_other_plugins_active_text;

    $edubin_other_plugins_active_text = '';

    $lms_plugins = array(
        // 'lifterlms/lifterlms.php'         => array(
        //     'label'    => 'Lifter',
        //     'plugin'   => 'lifterlms/lifterlms.php',
        //     'function' => 'llms',
        // ),
        'sensei-lms/sensei-lms.php'       => array(
            'label'  => 'Sensei',
            'plugin' => 'sensei-lms/sensei-lms.php',
        ),
        'learnpress/learnpress.php'       => array(
            'label'  => 'LearnPress',
            'plugin' => 'learnpress/learnpress.php',
        ),
        'sfwd-lms/sfwd_lms.php'       => array(
            'label'  => 'LearnDash',
            'plugin' => 'sfwd-lms/sfwd_lms.php',
        ),
        'tutor/tutor.php'                 => array(
            'label'  => 'Tutor',
            'plugin' => 'tutor/tutor.php',
        ),
        'wp-courses/wp-courses.php'       => array(
            'label'  => 'WP Courses',
            'plugin' => 'wp-courses/wp-courses.php',
        ),
        'wp-courseware/wp-courseware.php' => array(
            'label'    => 'WP Courseware',
            'function' => 'WPCW_plugin_init',
        ),
        'WPLMS'                           => array(
            'label'  => 'WPLMS Theme',
            'define' => 'WPLMS_VERSION',
        ),
    );

    foreach ( $lms_plugins as $plugin_set ) {

        $plugin_active = false;

        if ( ( isset( $plugin_set['plugin'] ) ) && ( ! empty( $plugin_set['plugin'] ) ) ) { // @phpstan-ignore-line
            if ( ( is_plugin_active( $plugin_set['plugin'] ) ) || ( ( is_multisite() ) && ( is_plugin_active_for_network( $plugin_set['plugin'] ) ) ) ) {
                $plugin_active = true;
            }
        } elseif ( ( isset( $plugin_set['class'] ) ) && ( ! empty( $plugin_set['class'] ) ) ) { // @phpstan-ignore-line
            if ( class_exists( $plugin_set['class'] ) ) {
                $plugin_active = true;
            }
        } elseif ( ( isset( $plugin_set['function'] ) ) && ( ! empty( $plugin_set['function'] ) ) ) { // @phpstan-ignore-line
            if ( function_exists( $plugin_set['function'] ) ) { // @phpstan-ignore-line
                $plugin_active = true;
            }
        } elseif ( ( isset( $plugin_set['define'] ) ) && ( ! empty( $plugin_set['define'] ) ) ) { // @phpstan-ignore-line
            if ( defined( $plugin_set['define'] ) ) {
                $plugin_active = true;
            }
        }

        if ( ( $plugin_active ) && ( isset( $plugin_set['label'] ) ) && ( ! empty( $plugin_set['label'] ) ) ) { // @phpstan-ignore-line
            if ( ! empty( $edubin_other_plugins_active_text ) ) {
                $edubin_other_plugins_active_text .= ', ';
            }
            $edubin_other_plugins_active_text .= $plugin_set['label'];
        }
    }
}

add_action( 'admin_init', 'edubin_check_other_lms_plugins' );

/**
 * Admin notice other LMS plugins
 *
 */
function edubin_admin_notice_other_lms_plugins() {
    global $edubin_other_plugins_active_text;

    $current_screen = get_current_screen();

    if ( ! empty( $edubin_other_plugins_active_text ) ) {
        $notice_time = get_user_meta( get_current_user_id(), 'edubin_other_plugins_notice_dismissed_nonce', true );
        $notice_time = absint( $notice_time );
        if ( ! empty( $notice_time ) ) {
            return;
        }

    $multiple_lms_error_massage = Edubin::setting( 'multiple_lms_error_massage' );

    if( $multiple_lms_error_massage ) : // If enable 
        if( class_exists('Sensei_Main' ) && !function_exists('tutor') && !class_exists('LearnPress') && !class_exists('SFWD_LMS')) : 
        elseif( !class_exists('Sensei_Main' ) && function_exists('tutor') && !class_exists('LearnPress') && !class_exists('SFWD_LMS')): 
        elseif( !class_exists('Sensei_Main' ) && !function_exists('tutor') && class_exists('LearnPress') && !class_exists('SFWD_LMS')): 
        elseif( !class_exists('Sensei_Main' ) && !function_exists('tutor') && !class_exists('LearnPress') && class_exists('SFWD_LMS')): 
        else: 
    ?>

        <div class="notice notice-error notice-alt is-dismissible edubin-multiple-plugins-notice" data-notice-dismiss-nonce="<?php echo esc_attr( wp_create_nonce( 'notice-dismiss-nonce-' . get_current_user_id() ) ); ?>">
        <?php
            echo wp_kses_post(
                wpautop(
                    sprintf(
                        // translators: placeholder: list of active LMS plugins.
                        _x( '<span>Warning!! </span><br><strong>%s</strong> multiple LMS plugins are active in your site. Please activate only one LMS plugin. Otherwise multiple LMS plugins may cause conflicts.', 'placeholder: list of active LMS plugins', 'edubin' ),
                        $edubin_other_plugins_active_text
                    )
                )
            );
        ?>
        </div>
            <?php endif; ?>
        <?php endif; ?>

        <?php
    }
}
add_action( 'admin_notices', 'edubin_admin_notice_other_lms_plugins' );


/**
 * AJAX function to handle other plugins notice dismiss action from browser.
 *
 * @since 3.2.3
 */
function edubin_admin_other_plugins_notice_dismissed_ajax() {
    $user_id = get_current_user_id();
    if ( ! empty( $user_id ) ) {
        if ( ( isset( $_POST['action'] ) ) && ( 'edubin_other_plugins_notice_dismissed' === $_POST['action'] ) ) {
            if ( ( isset( $_POST['edubin_other_plugins_notice_dismissed_nonce'] ) ) && ( ! empty( $_POST['edubin_other_plugins_notice_dismissed_nonce'] ) ) && ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['edubin_other_plugins_notice_dismissed_nonce'] ) ), 'notice-dismiss-nonce-' . $user_id ) ) ) {
                update_user_meta( $user_id, 'edubin_other_plugins_notice_dismissed_nonce', time() );
            }
        }
    }

    die();
}
add_action( 'wp_ajax_edubin_other_plugins_notice_dismissed', 'edubin_admin_other_plugins_notice_dismissed_ajax' );



// ===== Update notice for old version Edubin Core plugin =====

function check_edubin_core_plugin_version() {
    // Check if the Edubin Core plugin class exists
    if (class_exists('Edubin_Core')) {
        // Define the path to the Edubin Core plugin main file
        $edubin_core_plugin_dir = WP_PLUGIN_DIR . '/edubin-core/edubin-core.php';

        // Ensure the function is available by including the file if necessary
        if (!function_exists('get_plugin_data')) {
            require_once(ABSPATH . 'wp-admin/includes/plugin.php');
        }

        // Check if the plugin file exists
        if (file_exists($edubin_core_plugin_dir)) {
            // Get the plugin data
            $plugin_data = get_plugin_data($edubin_core_plugin_dir);
            $plugin_version = $plugin_data['Version'];

            // Compare plugin version with the minimum required version
            if (version_compare($plugin_version, '9.2.8', '<')) {
                // Display update notice with animated or blinking text
                function edubin_admin_notice_old_core_plugin() {
                    ?>
                    <div class="notice notice-error is-dismissible" style="background-color: #ffe5e5; border-color: #d63638;">
                        <p>
                            <?php _e('Your Edubin Core plugin is outdated, ', 'edubin'); ?>
                            <a href="<?php echo admin_url('admin.php?page=edubin-required-plugins&plugin_status=update'); ?>" style="color: #d63638; font-weight: bold; animation: blinker 1.5s linear infinite;">
                                <?php _e('click here to update', 'edubin'); ?>
                            </a>
                        </p>
                    </div>
                    <style>
                        @keyframes blinker {
                            50% {
                                opacity: 0;
                            }
                        }
                    </style>
                    <?php
                }
                add_action('admin_notices', 'edubin_admin_notice_old_core_plugin');
            }
        } else {
            // Log an error if the plugin file is not found
           // error_log('Edubin Core plugin file not found at ' . $edubin_core_plugin_dir);
        }
    }
}

// Call the function to check the Edubin Core plugin version
check_edubin_core_plugin_version();
