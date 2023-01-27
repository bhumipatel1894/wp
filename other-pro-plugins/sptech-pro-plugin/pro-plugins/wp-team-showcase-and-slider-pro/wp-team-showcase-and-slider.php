<?php
/**
 * Plugin Name: WP Team Showcase and Slider Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Text Domain: wp-team-showcase-and-slider
 * Domain Path: /languages/
 * Description: Easy to add and display your employees, team members in Grid view, Slider view and in widget. 
 * Author: WP Online Support
 * Version: 1.2.1
 * Author URI: https://www.wponlinesupport.com
 *
 * @package WP Team Showcase and Slider Pro
 * @author WP Online Support
 */
if ( ! defined( 'ABSPATH' ) ) exit;

if( !defined( 'WP_TSASP_VERSION' ) ) {
	define( 'WP_TSASP_VERSION', '1.2.1' ); // Version of plugin
}
if( !defined( 'WP_TSASP_DIR' ) ) {
    define( 'WP_TSASP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_TSASP_URL' ) ) {
    define( 'WP_TSASP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_TSASP_PLUGIN_BASENAME' ) ) {
    define( 'WP_TSASP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}
if( !defined( 'WP_TSASP_POST_TYPE' ) ) {
    define( 'WP_TSASP_POST_TYPE', 'team_showcase_post' ); // Plugin post type
}
if( !defined( 'WP_TSASP_CAT' ) ) {
    define( 'WP_TSASP_CAT', 'tsas-category' ); // Plugin category name
}
if( !defined( 'WP_TSASP_META_PREFIX' ) ) {
	define( 'WP_TSASP_META_PREFIX', '_wp_tsas_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wp_tsasp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wp_tsasp_lang_dir = apply_filters( 'wp_tsasp_languages_directory', $wp_tsasp_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'wp-team-showcase-and-slider' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'wp-team-showcase-and-slider', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_TSASP_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'wp-team-showcase-and-slider', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'wp-team-showcase-and-slider', false, $wp_tsasp_lang_dir );
    }	
}
add_action('plugins_loaded', 'wp_tsasp_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_tsasp_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_tsasp_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_install() {

    // Get settings for the plugin
    $wp_tsasp_options = get_option( 'wp_tsasp_options' );
    
    if( empty( $wp_tsasp_options ) ) { // Check plugin version option
        
        // Set default settings
        wp_tsasp_default_settings();
        
        // Update plugin version to option
        update_option( 'wp_tsasp_plugin_version', '1.0' );
    }

	wp_tsasp_register_post_type();
    wp_tsasp_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Check if free version of plugin is active or not
    if( is_plugin_active('wp-team-showcase-and-slider/wp-team-showcase-and-slider.php') ) {
		add_action('update_option_active_plugins', 'wp_tsasp_deactivate_free_version');
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_uninstall() {
    // Uninstall functionality
}

/**
 * Deactivate free plugin
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_deactivate_free_version() {
	deactivate_plugins('wp-team-showcase-and-slider/wp-team-showcase-and-slider.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/wp-team-showcase-and-slider/wp-team-showcase-and-slider.php';
    
    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'wp-team-showcase-and-slider-pro/wp-team-showcase-and-slider.php' ) && file_exists($dir) ) {

        global $pagenow;

        if( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible">
                    <p><strong>'.__('Thank you for activating  WP Team Showcase and Slider Pro', 'wp-team-showcase-and-slider').'</strong><br />
                    '.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'wp-team-showcase-and-slider'), '<strong>(WP Team Showcase and Slider)</strong>' ).'
                    </p>
                 </div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wp_tsasp_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_WPTSASP_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_WPTSASP_ITEM_NAME', 'WP Team Showcase and Slider Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {    
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_plugin_updater() {
    
    $license_key = trim( get_option( 'wp_tsasp_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_WPTSASP_STORE_URL, __FILE__, array(
                'version'   => WP_TSASP_VERSION,         // current version number
                'license'   => $license_key,             // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_WPTSASP_ITEM_NAME,    // name of this plugin
                'author'    => 'WP Online Support'       // author of this plugin
            )
    );
}
add_action( 'admin_init', 'wp_tsasp_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/tsasp-plugin-updater.php' );
/***** Updater Code Ends *****/

global $wp_tsasp_options;

// Plugin function file
include_once( WP_TSASP_DIR . '/includes/wp-tsasp-functions.php' );
$wp_tsasp_options = wp_tsasp_get_settings();

// Post Type File
require_once( WP_TSASP_DIR . '/includes/wp-tsasp-post-types.php' );

// Script Class
require_once( WP_TSASP_DIR . '/includes/class-wp-tsasp-script.php' );

// Admin Class
require_once( WP_TSASP_DIR . '/includes/admin/class-wp-tsasp-admin.php' );

// Public Class
require_once( WP_TSASP_DIR . '/includes/class-wp-tsasp-public.php' );

// Shortcode file
require_once( WP_TSASP_DIR . '/includes/shortcode/wp-tsasp-team-grid.php' );
require_once( WP_TSASP_DIR . '/includes/shortcode/wp-tsasp-team-slider.php' );

// Template Functions
require_once( WP_TSASP_DIR . '/includes/wp-tsasp-template-functions.php' );

// VC Shortcode File
require_once( WP_TSASP_DIR . '/includes/admin/class-wp-tsasp-vc.php' );

// Load admin side files
if( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
	
	// Designs file
	include_once( WP_TSASP_DIR . '/includes/admin/wp-tsasp-how-it-work.php' );
}