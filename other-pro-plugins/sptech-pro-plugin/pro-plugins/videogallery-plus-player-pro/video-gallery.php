<?php
/**
 * Plugin Name: Video Gallery and Player Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Text Domain: html5-videogallery-plus-player
 * Domain Path: /languages/
 * Description: Easy to add and display your HTML5, YouTube, Vimeo vedio gallery with Magnific Popup to your website. 
 * Author: WP Online Support
 * Version: 1.2.2
 * Author URI: https://www.wponlinesupport.com
 *
 * @package WordPress
 * @author WP Online Support
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Basic plugin definitions
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
if( !defined( 'WP_VGP_VERSION' ) ) {
	define( 'WP_VGP_VERSION', '1.2.2' ); // Version of plugin
}
if( !defined( 'WP_VGP_DIR' ) ) {
    define( 'WP_VGP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_VGP_URL' ) ) {
    define( 'WP_VGP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_VGP_PLUGIN_BASENAME' ) ) {
    define( 'WP_VGP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WP_VGP_POST_TYPE' ) ) {
	define( 'WP_VGP_POST_TYPE', 'sp_html5video' ); // Plugin post type name
}
if( !defined( 'WP_VGP_CAT' ) ) {
	define( 'WP_VGP_CAT', 'video-category' ); // Plugin taxonomy name
}
if( !defined( 'WP_VGP_META_PREFIX' ) ) {
	define( 'WP_VGP_META_PREFIX', '_wpvideo_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wp_vgp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wp_vgp_lang_dir = apply_filters( 'wp_vgp_languages_directory', $wp_vgp_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'html5-videogallery-plus-player' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'html5-videogallery-plus-player', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_VGP_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'html5-videogallery-plus-player', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'html5-videogallery-plus-player', false, $wp_vgp_lang_dir );
    }
}

// Action to load plugin text domain
add_action('plugins_loaded', 'wp_vgp_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_vgp_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_vgp_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_install() {

	// Get settings for the plugin
    $wp_vgp_options = get_option( 'wp_vgp_options' );
    
    if( empty( $wp_vgp_options ) ) { // Check plugin version option
        
        // Set default settings
        wp_vgp_default_settings();
        
        // Update plugin version to option
        update_option( 'wp_vgp_plugin_version', '1.1.1' );
    }

	// Register post type function
	wp_vgp_register_post_types();
	wp_vgp_register_taxonomies();

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();

	// Deactivate free version
    if( is_plugin_active('html5-videogallery-plus-player/html5video.php') ){
        add_action('update_option_active_plugins', 'wp_vgp_deactivate_free_version');
    }
}

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_uninstall() {
	
	// IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_deactivate_free_version() {
    deactivate_plugins('html5-videogallery-plus-player/html5video.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/html5-videogallery-plus-player/html5video.php';
    
    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'videogallery-plus-player-pro/video-gallery.php' ) && file_exists($dir)) {

        global $pagenow;

        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible">
                    <p>
                        <strong>'.sprintf( __('Thank you for activating %s', 'html5-videogallery-plus-player'), 'Video Gallery and Player Pro').'</strong>.<br/>
                        '.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'html5-videogallery-plus-player'), '<strong>(<em>Video Gallery and Player</em>)</strong>' ).'
                    </p>
                </div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wp_vgp_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_WPVGP_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_WPVGP_ITEM_NAME', 'Video gallery and Player Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_plugin_updater() {
	
	$license_key = trim( get_option( 'wp_vgp_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_WPVGP_STORE_URL, __FILE__, array(
                'version' 	=> WP_VGP_VERSION,         	// current version number
                'license' 	=> $license_key, 		    // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_WPVGP_ITEM_NAME,   	// name of this plugin
                'author' 	=> 'WP Online Support'      // author of this plugin
            )
    );
}
add_action( 'admin_init', 'wp_vgp_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wp-vgp-plugin-updater.php' );
/***** Updater Code Ends *****/

// Global variables
global $wp_vgp_options;

// Functions file
require_once( WP_VGP_DIR . '/includes/wp-vgp-functions.php' );
$wp_vgp_options = wp_vgp_get_settings();

// Post type file
require_once( WP_VGP_DIR . '/includes/wp-vgp-post-types.php' );

// Script Class
require_once( WP_VGP_DIR . '/includes/class-wp-vgp-script.php' );

// Admin Class
require_once( WP_VGP_DIR . '/includes/admin/class-wp-vgp-admin.php' );

// Shortcode
require_once( WP_VGP_DIR . '/includes/shortcode/wp-vgp-grid.php' );
require_once( WP_VGP_DIR . '/includes/shortcode/wp-vgp-slider.php' );

// VC Shortcode File
require_once( WP_VGP_DIR . '/includes/admin/class-wp-vgp-vc.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WP_VGP_DIR . '/includes/admin/wp-vgp-how-it-work.php' );
}