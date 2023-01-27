<?php
/**
 * Plugin Name: Blog Designer - Post and Widget Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Description: Display Post on your website with PRO designs.
 * Text Domain: blog-designer-for-post-and-widget
 * Domain Path: /languages/
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com
 * Contributors: WP Online Support
 * Version: 1.1
*/

// Exit if accessed directly
// abs pth is start ffrom folder path upto proj folder
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
if( !defined( 'WPSPW_PRO_VERSION' ) ) {
    define( 'WPSPW_PRO_VERSION', '1.1' ); // Version of plugin
}
if( !defined( 'WPSPW_PRO_DIR' ) ) {
    define( 'WPSPW_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPSPW_PRO_URL' ) ) {
    define( 'WPSPW_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPSPW_PRO_PLUGIN_BASENAME' ) ) {
    define( 'WPSPW_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined('WPSPW_POST_TYPE') ) {
    define('WPSPW_POST_TYPE', 'post'); // Post type name
}
if( !defined('WPSPW_CAT') ) {
    define('WPSPW_CAT', 'category'); // Plugin category name
}
if( !defined( 'WPSPW_META_PREFIX' ) ) {
    define( 'WPSPW_META_PREFIX', '_wpspw_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function wpspw_load_textdomain() {
    load_plugin_textdomain( 'blog-designer-for-post-and-widget', false, dirname( plugin_basename(__FILE__) ) . '/languages/' );
}

// Action to load plugin text domain
add_action('plugins_loaded', 'wpspw_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpspw_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpspw_pro_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function wpspw_pro_install() {
    
    // Get settings for the plugin
    $wpspw_pro_options = get_option( 'wpspw_pro_options' );
    
    if( empty( $wpspw_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wpspw_pro_default_settings();
        
        // Update plugin version to option
        update_option( 'wpspw_pro_plugin_version', '1.0' );
    }

    // If free plugin is active
    if( is_plugin_active('blog-designer-for-post-and-widget/blog-designer-post-and-widget.php') ) {
        add_action('update_option_active_plugins', 'deactivate_wpspw_free_version');
    }
}

/**
 * Function to deactivate free version of plugin
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function deactivate_wpspw_free_version() {
    deactivate_plugins('blog-designer-for-post-and-widget/blog-designer-post-and-widget.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function wpspw_pro_admin_notice() {

    $dir = WP_PLUGIN_DIR . '/blog-designer-for-post-and-widget/blog-designer-post-and-widget.php';
    
    // If free plugin exist
    if( file_exists($dir) ) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating Blog Designer - Post and Widget Pro</strong>.<br /> It looks like you had FREE version <strong>(<em>Blog Designer - Post and Widget</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wpspw_pro_admin_notice');

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function wpspw_pro_uninstall() {
    // Uninstall functionality
}

/***** Updater Code Starts *****/
define( 'EDD_SPOST_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_SPOST_ITEM_NAME', 'Blog Designer for Post and Widget Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function wpspw_pro_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_wpspwpost_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_SPOST_STORE_URL, __FILE__, array(
			'version' 	=> WPSPW_PRO_VERSION, 	// current version number
			'license' 	=> $license_key, 		// license key (used get_option above to retrieve from DB)
			'item_name' => EDD_SPOST_ITEM_NAME, // name of this plugin
			'author' 	=> 'WP Online Support'  // author of this plugin
		)
	);
}
add_action( 'admin_init', 'wpspw_pro_plugin_updater', 0 );

include( dirname( __FILE__ ) . '/edd-wpspw-post-plugin.php' );
/***** Updater Code Ends *****/

// Global variables
global $wpspw_pro_options;

// Functions file
require_once( WPSPW_PRO_DIR . '/includes/wpspw-functions.php' );
$wpspw_pro_options = wpspw_pro_get_settings();

// Admin Class
require_once( WPSPW_PRO_DIR . '/includes/admin/class-wpspw-admin.php' );

// Script Class
require_once( WPSPW_PRO_DIR . '/includes/class-wpspw-script.php' );

// Shortcode files
require_once( WPSPW_PRO_DIR . '/includes/shortcodes/wpspw-post.php' );
require_once( WPSPW_PRO_DIR . '/includes/shortcodes/wpspw-recent-post.php' );
require_once( WPSPW_PRO_DIR . '/includes/shortcodes/wpspw-recent-post-slider.php' );
require_once( WPSPW_PRO_DIR . '/includes/shortcodes/wpspw-post-ticker.php' );

// Widgets Files
require_once( WPSPW_PRO_DIR . '/includes/widgets/class-wpspw-latest-post.php' );
require_once( WPSPW_PRO_DIR . '/includes/widgets/class-wpspw-latest-post-list-slider.php' );
require_once( WPSPW_PRO_DIR . '/includes/widgets/class-wpspw-latest-post-list-slider-1.php' );
require_once( WPSPW_PRO_DIR . '/includes/widgets/class-wpspw-latest-post-list-slider-2.php' );
require_once( WPSPW_PRO_DIR . '/includes/widgets/class-wpspw-latest-post-scrolling-widget.php' );

// VC Shortcode File
require_once( WPSPW_PRO_DIR . '/includes/admin/class-wpspw-vc.php' );

// Load admin side files
if( is_admin() ) {

    // Designs file
    require_once( WPSPW_PRO_DIR . '/includes/admin/wpspw-how-it-work.php' );
}