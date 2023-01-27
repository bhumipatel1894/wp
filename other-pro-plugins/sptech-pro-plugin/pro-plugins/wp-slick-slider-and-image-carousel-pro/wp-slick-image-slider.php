<?php
/**
 * Plugin Name: WP Slick Slider and Image Carousel Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Description: Easy to add and display wp slick image slider and carousel.
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com
 * Text Domain: wp-slick-slider-and-image-carousel
 * Domain Path: languages
 * Version: 1.3.1
 * 
 * @package WordPress
 * @author WP Online Support
 */

/**
 * Basic plugin definitions
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
if( !defined( 'WPSISAC_PRO_VERSION' ) ) {
	define( 'WPSISAC_PRO_VERSION', '1.3.1' ); // Version of plugin
}
if( !defined( 'WPSISAC_PRO_DIR' ) ) {
    define( 'WPSISAC_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPSISAC_PRO_URL' ) ) {
    define( 'WPSISAC_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPSISAC_PRO_PLUGIN_BASENAME' ) ) {
	define( 'WPSISAC_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}
if( !defined( 'WPSISAC_PRO_POST_TYPE' ) ) {
    define( 'WPSISAC_PRO_POST_TYPE', 'slick_slider' ); // Plugin post type
}
if( !defined( 'WPSISAC_PRO_CAT' ) ) {
    define( 'WPSISAC_PRO_CAT', 'wpsisac_slider-category' ); // Plugin category name
}
if( !defined( 'WPSISAC_PRO_META_PREFIX' ) ) {
    define( 'WPSISAC_PRO_META_PREFIX', '_wpsisac_pro_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wpsisac_pro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wpsisac_pro_lang_dir = apply_filters( 'wpsisac_pro_languages_directory', $wpsisac_pro_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'wp-slick-slider-and-image-carousel' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'wp-slick-slider-and-image-carousel', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPSISAC_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'wp-slick-slider-and-image-carousel', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'wp-slick-slider-and-image-carousel', false, $wpsisac_pro_lang_dir );
    }
}
add_action('plugins_loaded', 'wpsisac_pro_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpsisac_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpsisac_pro_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_install() {

	// Get settings for the plugin
    $wpsisac_pro_options = get_option( 'wpsisac_pro_options' );
    
    if( empty( $wpsisac_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wpsisac_pro_default_settings();
        
        // Update plugin version to option
        update_option( 'wpsisac_pro_plugin_version', '1.0' );
    }

    // Register post type function
	wpsisac_pro_register_post_type();
    wpsisac_pro_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

	// Deactivate free version
	if( is_plugin_active('wp-slick-slider-and-image-carousel/wp-slick-image-slider.php') ){
		add_action('update_option_active_plugins', 'wpsisac_pro_deactivate_free_version');
	}
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_deactivate_free_version() {
	deactivate_plugins('wp-slick-slider-and-image-carousel/wp-slick-image-slider.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function wpsisac_pro_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/wp-slick-slider-and-image-carousel/wp-slick-image-slider.php';
    
    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'wp-slick-slider-and-image-carousel-pro/wp-slick-image-slider.php' ) && file_exists($dir) ) {
        
        global $pagenow;

        if( $pagenow == 'plugins.php' && current_user_can('install_plugins') ) {
			echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating  WP Slick Slider and Image Carousel Pro</strong>.<br /> It looks like you had FREE version <strong>(<em> WP Slick Slider and Image Carousel</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}
add_action( 'admin_notices', 'wpsisac_pro_admin_notice');

/***** Updater Code Starts *****/
define( 'WPSISAC_PRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'WPSISAC_PRO_ITEM_NAME', 'WP Slick Slider and Image Carousel Pro' ); 

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */
function edd_sl_slickspro_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_slickspro_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( WPSISAC_PRO_STORE_URL, __FILE__, array(
        'version' 	=> WPSISAC_PRO_VERSION,      // current version number
        'license' 	=> $license_key,             // license key
        'item_name' => WPSISAC_PRO_ITEM_NAME,    // name of this plugin
        'author' 	=> 'WP Online Support'       // author of this plugin
	));
}
add_action( 'admin_init', 'edd_sl_slickspro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/edd-slickslider-plugin.php' );
/***** Updater Code Ends *****/

// Taking some globals
global $wpsisac_pro_options;

// Functions File
require_once( WPSISAC_PRO_DIR . '/includes/wpsisac-functions.php' );
$wpsisac_pro_options = wpsisac_pro_get_settings();

// Plugin Post Type File
require_once( WPSISAC_PRO_DIR . '/includes/wpsisac-post-types.php' );

// Script Class File
require_once( WPSISAC_PRO_DIR . '/includes/class-wpsisac-script.php' );

// Admin Class File
require_once( WPSISAC_PRO_DIR . '/includes/admin/class-wpsisac-admin.php' );

// Shortcode File
require_once( WPSISAC_PRO_DIR . '/includes/shortcode/wpsisac-slider.php' );
require_once( WPSISAC_PRO_DIR . '/includes/shortcode/wpsisac-carousel.php' );
require_once( WPSISAC_PRO_DIR . '/includes/shortcode/wpsisac-variable-slider.php' );

// VC Shortcode File
require_once( WPSISAC_PRO_DIR . '/includes/admin/class-wpsisac-vc.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	require_once( WPSISAC_PRO_DIR . '/includes/admin/wpsisac-how-it-work.php' );
}