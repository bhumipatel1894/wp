<?php
/*
 * Plugin Name: WP News and Scrolling Widgets Pro
 * Plugin URI: https://www.wponlinesupport.com/
 * Description: A simple PRO News and Five widgets plugin. Display News posts with various designs.
 * Text Domain: sp-news-and-widget
 * Domain Path: /languages/
 * Version: 2.0.6
 * Author: WP Online Support
 * Author URI: https://www.wponlinesupport.com/
 * Contributors: WP Online Support
*/

if( !defined( 'WPNW_PRO_VERSION' ) ) {
    define( 'WPNW_PRO_VERSION', '2.0.6' ); // Version of plugin
}
if( !defined( 'WPNW_PRO_DIR' ) ) {
    define( 'WPNW_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WPNW_PRO_URL' ) ) {
    define( 'WPNW_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WPNW_PRO_PLUGIN_BASENAME' ) ) {
    define( 'WPNW_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WPNW_PRO_POST_TYPE' ) ) {
    define( 'WPNW_PRO_POST_TYPE', 'news' ); // Plugin post type
}
if( !defined( 'WPNW_PRO_CAT' ) ) {
    define( 'WPNW_PRO_CAT', 'news-category' ); // Plugin category name
}
if( !defined( 'WPNW_META_PREFIX' ) ) {
    define( 'WPNW_META_PREFIX', '_wpnw_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnw_pro_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wpnw_pro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wpnw_pro_lang_dir = apply_filters( 'wpnw_pro_languages_directory', $wpnw_pro_lang_dir );

    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'sp-news-and-widget' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'sp-news-and-widget', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WPNW_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'sp-news-and-widget', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'sp-news-and-widget', false, $wpnw_pro_lang_dir );
    }
}
add_action('plugins_loaded', 'wpnw_pro_load_textdomain');

/***** Updater Code Starts *****/
define( 'EDD_NEWS_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_NEWS_ITEM_NAME', 'WP News and Scrolling Widgets Pro' );

// Plugin Updator Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {	
	include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function edd_sl_news_plugin_updater() {
	
	$license_key = trim( get_option( 'edd_news_license_key' ) );

	$edd_updater = new EDD_SL_Plugin_Updater( EDD_NEWS_STORE_URL, __FILE__, array(
            'version' 	=> WPNW_PRO_VERSION,      // current version number
            'license' 	=> $license_key,          // license key (used get_option above to retrieve from DB)
            'item_name' => EDD_NEWS_ITEM_NAME,    // name of this plugin
            'author' 	=> 'WP Online Support'    // author of this plugin
		)
	);

}
add_action( 'admin_init', 'edd_sl_news_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/edd-news-plugin.php' );
/***** Updater Code Ends *****/

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wpnw_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wpnw_pro_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnw_pro_install() {

    // Get settings for the plugin
    $wpnw_pro_options = get_option( 'wpnw_pro_options' );
    
    if( empty( $wpnw_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wpnw_pro_default_settings();
        
        // Update plugin version to option
        update_option( 'wpnw_pro_plugin_version', '1.0' );
    }
    
    // Custom post type and taxonomy function
    wpnw_pro_register_post_type();
    wpnw_pro_register_taxonomies();

    // IMP to call to generate new rules
    flush_rewrite_rules();

    if( is_plugin_active('sp-news-and-widget/sp-news-and-widget.php') ){
        add_action('update_option_active_plugins', 'wpnw_pro_deactivate_free_version');
    }
}

/**
 * Plugin Functinality (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnw_pro_uninstall() {
    
    // IMP to call to generate new rules
    flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnw_pro_deactivate_free_version() {
    deactivate_plugins('sp-news-and-widget/sp-news-and-widget.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */
function wpnw_pro_news_admin_notice() {

    $dir = ABSPATH . 'wp-content/plugins/sp-news-and-widget/sp-news-and-widget.php';

    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'wp-news-and-widget-pro/sp-news-and-widget.php' ) && file_exists($dir) ) {

        global $pagenow;

        if( $pagenow == 'plugins.php' ) {

            if ( current_user_can( 'install_plugins' ) ) {
                echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating WP News and Five Widgets Pro</strong>.<br /> It looks like you had FREE version <strong>(<em>WP News and three widgets</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
            }
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wpnw_pro_news_admin_notice');

// Taking some globals
global $wpnw_pro_options;

// Functions file
require_once( WPNW_PRO_DIR . '/includes/wpnw-functions.php' );
$wpnw_pro_options = wpnw_pro_get_settings();

// Plugin Post type file
require_once( WPNW_PRO_DIR . '/includes/wpnw-post-types.php' );

// Script class
require_once( WPNW_PRO_DIR . '/includes/class-wpnw-script.php' );

// Admin class
require_once( WPNW_PRO_DIR . '/includes/admin/class-wpnw-admin.php' );

// Public Class
require_once( WPNW_PRO_DIR . '/includes/class-wpnw-public.php' );

// Shortcode
require_once( WPNW_PRO_DIR . '/includes/shortcode/wpnw-news-shortcode.php');
require_once( WPNW_PRO_DIR . '/includes/shortcode/wpnw-news-slider-shortcode.php');
require_once( WPNW_PRO_DIR . '/includes/shortcode/wpnw-news-ticker.php');

// Widget Class
require_once( WPNW_PRO_DIR . '/includes/widgets/class-wpnw-latest-news-list-slider.php' );
require_once( WPNW_PRO_DIR . '/includes/widgets/class-wpnw-latest-news-list-slider2.php' );
require_once( WPNW_PRO_DIR . '/includes/widgets/class-wpnw-latest-news.php' );
require_once( WPNW_PRO_DIR . '/includes/widgets/class-wpnw-latest-news-slider.php' );
require_once( WPNW_PRO_DIR . '/includes/widgets/class-wpnw-latest-news-scrolling.php' );
require_once( WPNW_PRO_DIR . '/includes/widgets/class-wpnw-cat-widget.php' );
require_once( WPNW_PRO_DIR . '/includes/widgets/class-wpnw-archive.php' );

// VC Shortcode File
require_once( WPNW_PRO_DIR . '/includes/admin/class-wpnw-vc.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    
    // Plugin Design Page
    require_once( WPNW_PRO_DIR . '/includes/admin/wpnw-how-it-work.php' );
}