<?php
/*
 * Plugin Name: Timeline and History Slider Pro
 * Plugin URI: https://www.wponlinesupport.com/
 * Description: Easy to add and display history OR timeline for your website. Display history on your website with PRO designs.
 * Version: 1.0.7
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com/
 * Contributors: WP Online Support
 * Text Domain: timeline-and-history-slider
 * Domain Path: /languages/
*/

if( !defined( 'WPHTSP_PRO_VERSION' ) ) {
    define( 'WPHTSP_PRO_VERSION', '1.0.7' ); // Version of plugin
}
if( !defined( 'WPHTSP_PRO_DIR' ) ) {
    define( 'WPHTSP_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPHTSP_PRO_URL' ) ) {
    define( 'WPHTSP_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPHTSP_PRO_PLUGIN_BASENAME' ) ) {
    define( 'WPHTSP_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WPHTSP_PRO_POST_TYPE' ) ) {
    define( 'WPHTSP_PRO_POST_TYPE', 'timeline_slider_post' ); // Plugin post type
}
if( !defined( 'WPHTSP_PRO_CAT' ) ) {
    define( 'WPHTSP_PRO_CAT', 'wpostahs-slider-category' ); // Plugin category name
}
if( !defined( 'WPHTSP_META_PREFIX' ) ) {
    define( 'WPHTSP_META_PREFIX', '_wphtsp_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wphtsp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wphtsp_lang_dir = apply_filters( 'wphtsp_languages_directory', $wphtsp_lang_dir );

    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'timeline-and-history-slider' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'timeline-and-history-slider', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPHTSP_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'timeline-and-history-slider', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'timeline-and-history-slider', false, $wphtsp_lang_dir );
    }
}
add_action('plugins_loaded', 'wphtsp_load_textdomain');

/***** Updater Code Starts *****/
define( 'EDD_TIMELINE_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_TIMELINE_ITEM_NAME', 'Timeline and History Slider Pro' );

// Plugin Updator Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {    
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function edd_sl_timeline_plugin_updater() {
    
    $license_key = trim( get_option( 'edd_timeline_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_TIMELINE_STORE_URL, __FILE__, array(
            'version'   => WPHTSP_PRO_VERSION,      // current version number
            'license'   => $license_key,            // license key (used get_option above to retrieve from DB)
            'item_name' => EDD_TIMELINE_ITEM_NAME,  // name of this plugin
            'author'    => 'WP Online Support'      // author of this plugin
        ));
}
add_action( 'admin_init', 'edd_sl_timeline_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wphtsp-plugin-updater.php' );
/***** Updater Code Ends *****/

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wphtsp_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wphtsp_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_install() {
    
    wphtsp_register_post_type();
    wphtsp_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Get settings for the plugin
    $wphtsp_pro_options = get_option( 'wphtsp_pro_options' );
    
    if( empty( $wphtsp_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wphtsp_default_settings();
        
        // Update plugin version to option
        update_option( 'wphtsp_plugin_version', '1.0' );
    }

    if( is_plugin_active('timeline-and-history-slider/timeline-and-history-slider.php') ) {
        add_action('update_option_active_plugins', 'deactivate_history_premium_version');
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_uninstall() {
    // Uninstall functionality
}

/**
 * Deactivate free plugin
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function deactivate_history_premium_version() {
    deactivate_plugins('timeline-and-history-slider/timeline-and-history-slider.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function timelinepro_admin_notice() {

    $dir = WP_PLUGIN_DIR . '/timeline-and-history-slider/timeline-and-history-slider.php';
    
    // If free plugin exist
    if( file_exists($dir) ) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible">
                    <p>
                        <strong>'.sprintf( __('Thank you for activating %s', 'timeline-and-history-slider'), 'Timeline and History Slider Pro').'</strong>.<br/>
                        '.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'timeline-and-history-slider'), '<strong>(<em>Timeline and History Slider</em>)</strong>' ).'
                    </p>
                </div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'timelinepro_admin_notice');

// Global variables
global $wphts_pro_options;

// Functions file
require_once( WPHTSP_PRO_DIR . '/includes/class-wphtsp-functions.php' );
$wphts_pro_options = wphtsp_get_settings();

// Plugin Post type file
require_once( WPHTSP_PRO_DIR . '/includes/wphtsp-post-types.php' );

// Script Class
require_once( WPHTSP_PRO_DIR . '/includes/class-wphtsp-script.php' );

// Admin class file
require_once( WPHTSP_PRO_DIR . '/includes/admin/class-wphtsp-admin.php' );

// Shortcode files
require_once( WPHTSP_PRO_DIR . '/includes/shortcode/wphtsp-slider-shortcode.php' );
require_once( WPHTSP_PRO_DIR . '/includes/shortcode/wphtsp-history-shortcode.php' );

// VC Shortcode File
require_once( WPHTSP_PRO_DIR . '/includes/admin/class-wphtsp-vc.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WPHTSP_PRO_DIR . '/includes/admin/wphtsp-how-it-work.php' );
}