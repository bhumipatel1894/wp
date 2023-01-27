<?php
/**
 * Plugin Name: WP Logo Showcase Responsive Slider Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Description: Easy to add and display Logo Showcase Responsive Slider on your website. 
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com
 * Text Domain: logoshowcase
 * Domain Path: /languages/
 * Version: 1.3.1
 *
 * @package WordPress
 * @author WP Online Support
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
if( !defined( 'WPLS_PRO_VERSION' ) ) {
	define( 'WPLS_PRO_VERSION', '1.3.1' ); // Version of plugin
}
if( !defined( 'WPLS_PRO_DIR' ) ) {
	define( 'WPLS_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPLS_PRO_URL' ) ) {
	define( 'WPLS_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPLS_PRO_PLUGIN_BASENAME' ) ) {
    define( 'WPLS_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WPLS_PRO_POST_TYPE' ) ) {
	define( 'WPLS_PRO_POST_TYPE', 'logoshowcase' ); // Plugin post type name
}
if( !defined( 'WPLS_PRO_CAT' ) ) {
	define( 'WPLS_PRO_CAT', 'wplss_logo_showcase_cat' ); // Plugin taxonomy name
}
if( !defined( 'WPLS_META_PREFIX' ) ) {
	define( 'WPLS_META_PREFIX', '_wpls_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_load_textdomain() {
	load_plugin_textdomain( 'logoshowcase', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

// Action to load plugin text domain
add_action('plugins_loaded', 'wpls_pro_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpls_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpls_pro_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_install() {

	// Get settings for the plugin
    $wpls_pro_options = get_option( 'wpls_pro_options' );
    
    if( empty( $wpls_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wpls_pro_default_settings();
        
        // Update plugin version to option
        update_option( 'wpls_pro_plugin_version', '1.0' );
    }

	// Register post type function
	wpls_pro_register_post_types();
	wpls_pro_register_taxonomies();

	// IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Deactivate free version
    if( is_plugin_active('wp-logo-showcase-responsive-slider-slider/logo-showcase.php') ){
        add_action('update_option_active_plugins', 'wpls_pro_deactivate_free_version');
    }
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_uninstall() {
	
	// IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_deactivate_free_version() {
    deactivate_plugins('wp-logo-showcase-responsive-slider-slider/logo-showcase.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/wp-logo-showcase-responsive-slider-slider/logo-showcase.php';
    
    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'wp-logo-showcase-responsive-slider-pro/logo-showcase.php' ) && file_exists($dir)) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating WP Logo Showcase Responsive Slider Pro</strong>.<br /> It looks like you had FREE version <strong>(<em>WP Logo Showcase Responsive Slider</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wpls_pro_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_WPLSPRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_WPLSPRO_ITEM_NAME', 'WP Logo Showcase Responsive Slider Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_plugin_updater() {
	
	$license_key = trim( get_option( 'wpls_pro_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_WPLSPRO_STORE_URL, __FILE__, array(
                'version' 	=> WPLS_PRO_VERSION,         // current version number
                'license' 	=> $license_key, 		     // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_WPLSPRO_ITEM_NAME,    // name of this plugin
                'author' 	=> 'WP Online Support'       // author of this plugin
            )
    );
}
add_action( 'admin_init', 'wpls_pro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wpls-plugin-updater.php' );
/***** Updater Code Ends *****/

// Global variables
global $wpls_pro_options;

// Functions file
require_once( WPLS_PRO_DIR . '/includes/wpls-functions.php' );
$wpls_pro_options = wpls_pro_get_settings();

// Post type file
require_once( WPLS_PRO_DIR . '/includes/wpls-post-types.php' );

// Script Class
require_once( WPLS_PRO_DIR . '/includes/class-wpls-script.php' );

// Admin Class
require_once( WPLS_PRO_DIR . '/includes/admin/class-wpls-admin.php' );

// Shortcode File
require_once( WPLS_PRO_DIR . '/includes/shortcode/wpls-logo-slider.php' );
require_once( WPLS_PRO_DIR . '/includes/shortcode/wpls-logo-grid.php' );
require_once( WPLS_PRO_DIR . '/includes/shortcode/wpls-logo-filter.php' );

// Widget Class
require_once( WPLS_PRO_DIR . '/includes/widgets/class-wpls-logo-grid-widget.php' );
require_once( WPLS_PRO_DIR . '/includes/widgets/class-wpls-logo-slider-widget.php' );

// VC Shortcode File
require_once( WPLS_PRO_DIR . '/includes/admin/class-wpls-vc.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WPLS_PRO_DIR . '/includes/admin/wpls-how-it-work.php' );
}