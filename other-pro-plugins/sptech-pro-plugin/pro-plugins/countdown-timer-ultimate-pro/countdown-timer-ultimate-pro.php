<?php
/**
 * Plugin Name: Countdown Timer Ultimate Pro
 * Plugin URI: https://www.wponlinesupport.com/
 * Description: Easy to add and display timer.
 * Author: WP Online Support
 * Text Domain: countdown-timer-ultimate
 * Domain Path: /languages/
 * Version: 1.0.1
 * Author URI: https://www.wponlinesupport.com/
 *
 * @package WordPress
 * @author WP Online Support
 */

/**
 * Basic plugin definitions
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0
 */
if( !defined( 'WPCDT_PRO_VERSION' ) ) {
	define( 'WPCDT_PRO_VERSION', '1.0.1' ); // Version of plugin
}
if( !defined( 'WPCDT_PRO_DIR' ) ) {
    define( 'WPCDT_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPCDT_PRO_URL' ) ) {
    define( 'WPCDT_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPCDT_PRO_PLUGIN_BASENAME' ) ) {
	define( 'WPCDT_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}
if( !defined( 'WPCDT_PRO_POST_TYPE' ) ) {
    define( 'WPCDT_PRO_POST_TYPE', 'wpcdt_countdown' ); // Plugin post type
}
if( !defined( 'WPCDT_PRO_META_PREFIX' ) ) {
    define( 'WPCDT_PRO_META_PREFIX', '_wpcdt_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wpcdt_pro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wpcdt_pro_lang_dir = apply_filters( 'wpcdt_pro_languages_directory', $wpcdt_pro_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'countdown-timer-ultimate' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'countdown-timer-ultimate', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPCDT_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'countdown-timer-ultimate', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'countdown-timer-ultimate', false, $wpcdt_pro_lang_dir );
    }	
}
add_action('plugins_loaded', 'wpcdt_pro_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpcdt_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpcdt_pro_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_install() {  
    
    wpcdt_pro_register_post_type();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Get settings for the plugin
    $wpcdt_pro_options = get_option( 'wpcdt_pro_options' );

    if( empty( $wpcdt_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wpcdt_default_settings();
        
        // Update plugin version to option
        update_option( 'wpcdt_plugin_version', '1.0' );
    }

    if( is_plugin_active('countdown-timer-ultimate/countdown-timer.php') ) {
        add_action('update_option_active_plugins', 'deactivate_countdown_free_version');
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_uninstall() {
    // Uninstall functionality
}

/**
 * Deactivate free plugin
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function deactivate_countdown_free_version() {
    deactivate_plugins('countdown-timer-ultimate/countdown-timer.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function countdown_pro_admin_notice() {

    $dir = WP_PLUGIN_DIR . '/countdown-timer-ultimate/countdown-timer.php';
    
    // If free plugin exist
    if( file_exists($dir) ) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating Countdown Timer Ultimate Pro</strong>.<br /> It looks like you had FREE version <strong>(<em>Countdown Timer Ultimate</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'countdown_pro_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_WPCDT_PRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_WPCDT_PRO_ITEM_NAME', 'Countdown Timer Ultimate Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {    
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_plugin_updater() {

    $license_key = trim( get_option( 'wpcdt_pro_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_WPCDT_PRO_STORE_URL, __FILE__, array(
                'version'   => WPCDT_PRO_VERSION,           // current version number
                'license'   => $license_key,                // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_WPCDT_PRO_ITEM_NAME,     // name of this plugin
                'author'    => 'WP Online Support'          // author of this plugin
            )
    );
}
add_action( 'admin_init', 'wpcdt_pro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wpcdt-plugin-updater.php' );
/***** Updater Code Ends *****/

// Global variables
global $wpcdt_pro_options;

// Functions file
require_once( WPCDT_PRO_DIR . '/includes/wpcdt-functions.php' );
$wpcdt_pro_options = wpcdt_pro_get_settings();

// Plugin Post Type File
require_once( WPCDT_PRO_DIR . '/includes/wpcdt-post-types.php' );

// Admin Class File
require_once( WPCDT_PRO_DIR . '/includes/admin/class-wpcdt-admin.php' );

// Script Class File
require_once( WPCDT_PRO_DIR . '/includes/class-wpcdt-script.php' );

// Shortcode File
require_once( WPCDT_PRO_DIR . '/includes/shortcode/wpcdt-shortcode.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WPCDT_PRO_DIR . '/includes/admin/wpcdt-how-it-work.php' );
}