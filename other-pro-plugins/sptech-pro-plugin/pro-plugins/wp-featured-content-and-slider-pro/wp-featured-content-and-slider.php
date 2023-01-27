<?php
/**
 * Plugin Name: WP Featured Content and Slider Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Text Domain: wp-featured-content-and-slider
 * Domain Path: /languages/
 * Description: Easy to add and display what features your company, product or service offers, using our shortcode OR template code.
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com
 * Version: 1.2.1
 * 
 * @package WordPress
 * @author WP Online Support
 */
 
if ( ! defined( 'ABSPATH' ) ) exit;

if( !defined( 'WP_FCASP_VERSION' ) ) {
	define( 'WP_FCASP_VERSION', '1.2.1' ); // Version of plugin
}
if( !defined( 'WP_FCASP_DIR' ) ) {
    define( 'WP_FCASP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_FCASP_URL' ) ) {
    define( 'WP_FCASP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_FCASP_PLUGIN_BASENAME' ) ) {
    define( 'WP_FCASP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WP_FCASP_POST_TYPE' ) ) {
    define( 'WP_FCASP_POST_TYPE', 'featured_post' ); // Plugin post type
}
if( !defined( 'WP_FCASP_CAT' ) ) {
    define( 'WP_FCASP_CAT', 'wpfcas-category' ); // Plugin category name
}
if( !defined( 'WP_FCASP_META_PREFIX' ) ) {
    define( 'WP_FCASP_META_PREFIX', '_wp_fcasp_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
add_action('plugins_loaded', 'wp_fcasp_load_textdomain');
function wp_fcasp_load_textdomain() {
	load_plugin_textdomain( 'wp-featured-content-and-slider', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_fcasp_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_fcasp_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_install() {
	
	wp_fcasp_register_post_type();
    wp_fcasp_register_taxonomies();
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Get settings for the plugin
    $wp_fcasp_options = get_option( 'wp_fcasp_options' );
    
    if( empty( $wp_fcasp_options ) ) { // Check plugin version option
        
        // Set default settings
        wp_fcasp_default_settings();
        
        // Update plugin version to option
        update_option( 'wp_fcasp_plugin_version', '1.0' );
    }

    if( is_plugin_active('wp-featured-content-and-slider/wp-featured-content-and-slider.php') ) {
        add_action('update_option_active_plugins', 'wp_fcasp_deactivate_free_version');
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_uninstall() {
    // Uninstall functionality
}

/**
 * Deactivate free plugin
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_deactivate_free_version() {
    deactivate_plugins('wp-featured-content-and-slider/wp-featured-content-and-slider.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */
function wp_fcasp_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/wp-featured-content-and-slider/wp-featured-content-and-slider.php';

    // If PRO plugin is active and free plugin exist
    if( is_plugin_active('wp-featured-content-and-slider-pro/wp-featured-content-and-slider.php') && file_exists($dir) ) {
    	
        global $pagenow;
        
        if( $pagenow == 'plugins.php' ) {
            if ( current_user_can( 'install_plugins' ) ) {
                echo '<div id="message" class="updated notice is-dismissible">
                        <p><strong>'.__('Thank you for activating  WP Featured Content and Slider Pro', 'wp-featured-content-and-slider').'</strong><br />
                        '.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-featured-content-and-slider'), '<strong>(WP Featured Content and Slider)</strong>' ).'
                        </p>
                     </div>';
            }
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wp_fcasp_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_WP_FCASP_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_WP_FCASP_ITEM_NAME', 'WP Featured Content and Slider Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {    
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_plugin_updater() {
    
    $license_key = trim( get_option( 'wp_fcasp_plugin_license_key' ) );
    
    $edd_updater = new EDD_SL_Plugin_Updater( EDD_WP_FCASP_STORE_URL, __FILE__, array(
                'version'   => WP_FCASP_VERSION,         // current version number
                'license'   => $license_key,             // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_WP_FCASP_ITEM_NAME,   // name of this plugin
                'author'    => 'WP Online Support'       // author of this plugin
            )
    );
}
add_action( 'admin_init', 'wp_fcasp_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wp-fcasp-plugin-updater.php' );
/***** Updater Code Ends *****/

// Taking some globals
global $wp_fcasp_options;

// Plugin functions file
require_once( WP_FCASP_DIR . '/includes/wp-fcasp-functions.php' );
$wp_fcasp_options = wp_fcasp_get_settings();

// Post type file
require_once( WP_FCASP_DIR . '/includes/wp-fcasp-post-types.php' );

// Script Class
require_once( WP_FCASP_DIR . '/includes/class-wp-fcasp-scripts.php' );

// Admin Class
require_once( WP_FCASP_DIR . '/includes/admin/class-wp-fcasp-admin.php' );

// Shortcode File
require_once( WP_FCASP_DIR . '/includes/shortcode/wp-fcasp-fc-icon.php' );
require_once( WP_FCASP_DIR . '/includes/shortcode/wp-fcasp-fc-image.php' );
require_once( WP_FCASP_DIR . '/includes/shortcode/wp-fcasp-fc-icon-image.php' );

// VC Shortcode File
require_once( WP_FCASP_DIR . '/includes/admin/class-wp-fcasp-vc.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    
    // Plugin design page
    include_once( WP_FCASP_DIR . '/includes/admin/wp-fcasp-how-it-work.php' );
}