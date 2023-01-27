<?php
/*
 * Plugin Name: Buttons with Style Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Text Domain: buttons-with-style
 * Description: Wordpress buttons generator, Different Styles on which you can add to your website using easy short code. 
 * Domain Path: /languages/
 * Version: 1.0
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com
 * Contributors: WP Online Support
*/

if( !defined( 'BWSWPOS_PRO_VERSION' ) ) {
	define( 'BWSWPOS_PRO_VERSION', '1.0' ); // Version of plugin
}
if( !defined( 'BWSWPOS_PRO_DIR' ) ) {
    define( 'BWSWPOS_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'BWSWPOS_PRO_URL' ) ) {
    define( 'BWSWPOS_PRO_URL', plugin_dir_url( __FILE__ )); // Plugin url
}

if( !defined( 'BWSWPOS_PRO_PLUGIN_BASENAME' ) ) {
	define( 'BWSWPOS_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name = buttons-with-style-pro/buttons-with-style-pro.php 

}
if(!defined( 'BWSPOS_PRO_POST_TYPE' ) ) {
	define('BWSPOS_PRO_POST_TYPE', 'bwsp_btn'); // Plugin post type
}
if(!defined( 'BWSPOS_PRO_META_PREFIX' ) ) {
	define('BWSPOS_PRO_META_PREFIX','_bwsp_'); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_load_textdomain() {
    global $wp_version;

    // Set filter for plugin's languages directory
    $bwsp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $bwsp_lang_dir = apply_filters( 'bwsp_languages_directory', $bwsp_lang_dir );

    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'buttons-with-style' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'buttons-with-style', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( BWSWPOS_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'buttons-with-style', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'buttons-with-style', false, $bwsp_lang_dir );
    }
}
add_action('plugins_loaded', 'bwsp_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'bwswpos_pro_install' );
/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'bwswpos_pro_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwswpos_pro_install() {

	// Get settings for the plugin
    $bwsp_options = get_option( 'bwsp_options' );
       
    if( empty( $bwsp_options ) ) { // Check plugin version option
        
        // Set default settings
        bwsp_default_settings();
        
        // Update plugin version to option
        update_option( 'bwsp_plugin_version', '1.0' );
    }

    // Register post type function
    bwsp_register_post_type(); // for 1st page to appear

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

	// Deactivate free version
	if( is_plugin_active('buttons-with-style/buttons-with-style.php') ){
		add_action('update_option_active_plugins', 'bwswpos_pro_deactivate_free_version');
	}
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwswpos_pro_uninstall() {
	// Deactivation code here..
}

/**
 * Deactivate free plugin
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwswpos_pro_deactivate_free_version() {
	deactivate_plugins('buttons-with-style/buttons-with-style.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwswpos_pro_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/buttons-with-style/buttons-with-style.php';
    
    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'buttons-with-style/buttons-with-style.php' ) && file_exists($dir) ) {
        
        global $pagenow;

        if( $pagenow == 'plugins.php' && current_user_can('install_plugins') ) {
			echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating  Buttons With Style Pro</strong>.<br /> It looks like you had FREE version <strong>(<em> Buttons With Style</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}
add_action( 'admin_notices', 'bwswpos_pro_admin_notice');

/***** Updater Code Starts *****/
define( 'BWSP_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'BWSP_ITEM_NAME', 'Buttons with Style Pro' ); 

// Plugin Updator Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_plugin_updater() {
    
    $license_key = trim( get_option( 'edd_bwspro_license_key' ) );

     $edd_updater = new EDD_SL_Plugin_Updater( BWSP_STORE_URL, __FILE__, array(
            'version'   => BWSWPOS_PRO_VERSION,     // current version number
            'license'   => $license_key,            // license key (used get_option above to retrieve from DB)
            'item_name' => BWSP_ITEM_NAME,          // name of this plugin
            'author'    => 'WP Online Support'      // author of this plugin
        ));
}
add_action( 'admin_init', 'bwsp_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/bwsp-plugin-updater.php' );
/***** Updater Code Ends *****/

// Taking some globals
global $bwsp_options;

// Funcions File
require_once( BWSWPOS_PRO_DIR .'/includes/bwsp-functions.php' );
$bwsp_options = bwsp_get_settings();

// Post Type File
require_once( BWSWPOS_PRO_DIR . '/includes/bwsp-post-types.php' );

// Script Class File
require_once( BWSWPOS_PRO_DIR . '/includes/class-bwsp-script.php' );

// Admin Class File
require_once( BWSWPOS_PRO_DIR . '/includes/admin/class-bwsp-admin.php' );

// Shortcode file
require_once( BWSWPOS_PRO_DIR . '/includes/shortcode/bwsp-simple-button.php' );
require_once( BWSWPOS_PRO_DIR . '/includes/shortcode/bwsp-group-button.php' );

// How it work file
require_once( BWSWPOS_PRO_DIR . '/includes/admin/bwsp-how-it-work.php' );