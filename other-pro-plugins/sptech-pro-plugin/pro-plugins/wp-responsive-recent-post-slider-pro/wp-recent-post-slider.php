<?php
/**
 * Plugin Name: WP Responsive Recent Post Slider Pro
 * Plugin URI: https://www.wponlinesupport.com/
 * Description: Easy to add and display Recent Post Slider with multiple pro designs.
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com/
 * Text Domain: wp-responsive-recent-post-slider
 * Domain Path: /languages/
 * Version: 1.3.3
 * 
 * @package WordPress
 * @author WP Online Support
 */

/**
 * Basic plugin definitions
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
if( !defined( 'WPRPSP_VERSION' ) ) {
	define( 'WPRPSP_VERSION', '1.3.3' ); // Version of plugin
}
if( !defined( 'WPRPSP_DIR' ) ) {
    define( 'WPRPSP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPRPSP_URL' ) ) {
    define( 'WPRPSP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPRPSP_PLUGIN_BASENAME' ) ) {
    define( 'WPRPSP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WPRPSP_POST_TYPE' ) ) {
    define( 'WPRPSP_POST_TYPE', 'post' ); // Plugin post type
}
if( !defined( 'WPRPSP_CAT' ) ) {
    define( 'WPRPSP_CAT', 'category' ); // Plugin category name
}
if( !defined( 'WPRPSP_META_PREFIX' ) ) {
    define( 'WPRPSP_META_PREFIX', '_wprpsp_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
function wprpsp_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wprpsp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wprpsp_lang_dir = apply_filters( 'wprpsp_languages_directory', $wprpsp_lang_dir );

    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'wp-responsive-recent-post-slider' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'wp-responsive-recent-post-slider', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPRPSP_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'wp-responsive-recent-post-slider', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'wp-responsive-recent-post-slider', false, $wprpsp_lang_dir );
    }
}
add_action('plugins_loaded', 'wprpsp_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wprpsp_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wprpsp_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
function wprpsp_install() {
    
    // Get settings for the plugin
    $wprpsp_options = get_option( 'wprpsp_options' );
    
    if( empty( $wprpsp_options ) ) { // Check plugin version option
        
        // Set default settings
        wprpsp_default_settings();
        
        // Update plugin version to option
        update_option( 'wprpsp_plugin_version', '1.1' );
    }

    // Version 1.1
    $plugin_version = get_option('wprpsp_plugin_version');

    if( version_compare( $plugin_version, '1.0', '=' ) && !isset($wprpsp_options['post_types']) ) {
        $updated_options = $wprpsp_options['post_types'][0] = 'post';
        update_option('wprpsp_options', $updated_options);
        update_option( 'wprpsp_plugin_version', '1.1' );
    }

    // Deactivate free version
    if( is_plugin_active('wp-responsive-recent-post-slider/wp-recent-post-slider.php') ){
        add_action('update_option_active_plugins', 'wprpsp_deactivate_free_version');
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
function wprpsp_uninstall() {
    // Uninstall functionality
}

/**
 * Deactivate free plugin
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
function wprpsp_deactivate_free_version() {
    deactivate_plugins('wp-responsive-recent-post-slider/wp-recent-post-slider.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
function wprpsp_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/wp-responsive-recent-post-slider/wp-recent-post-slider.php';
    
    // If PRO plugin is active and free plugin exist
    if( file_exists($dir) ) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible">
                    <p>
                        <strong>'.sprintf( __('Thank you for activating %s', 'wp-responsive-recent-post-slider'), 'WP Responsive Recent Post Slider Pro').'</strong>.<br/>
                        '.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-responsive-recent-post-slider'), '<strong>(<em>WP Responsive Recent Post Slider</em>)</strong>' ).'
                    </p>
                </div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wprpsp_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_POSTPRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_POSTPRO_ITEM_NAME', 'WP Responsive Recent Post Slider Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */
function edd_sl_postpro_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_postpro_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_POSTPRO_STORE_URL, __FILE__, array(
                'version' 	=> WPRPSP_VERSION,           // current version number
                'license' 	=> $license_key, 		     // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_POSTPRO_ITEM_NAME,    // name of this plugin
                'author' 	=> 'WP Online Support'       // author of this plugin
            )
    );

}
add_action( 'admin_init', 'edd_sl_postpro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/edd-post-plugin.php' );
/***** Updater Code Ends *****/

// Taking some globals
global $wprpsp_options;

// Functions file
require_once( WPRPSP_DIR .'/includes/wprpsp-functions.php' );
$wprpsp_options = wprpsp_get_settings();

// Script Class
require_once( WPRPSP_DIR . '/includes/class-wprpsp-script.php' );

// Admin class
require_once( WPRPSP_DIR . '/includes/admin/class-wprpsp-admin.php' );

// Public Class
require_once( WPRPSP_DIR . '/includes/class-wprpsp-public.php' );

// Shortcode Files
require_once( WPRPSP_DIR . '/includes/shortcode/wprpsp-recent-post-slider.php' );
require_once( WPRPSP_DIR . '/includes/shortcode/wprpsp-post-carousel.php' );

// Widget Class
require_once( WPRPSP_DIR . '/includes/widgets/class-wprpsp-post-list-slider.php' );
require_once( WPRPSP_DIR . '/includes/widgets/class-wprpsp-post-list-slider2.php' );
require_once( WPRPSP_DIR .'/includes/widgets/class-wprpsp-post-slider.php' );

// VC Shortcode File
require_once( WPRPSP_DIR . '/includes/admin/class-wprpsp-vc.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    
    // Plugin design file
    require_once( WPRPSP_DIR . '/includes/admin/wprpsp-how-it-work.php' );
}