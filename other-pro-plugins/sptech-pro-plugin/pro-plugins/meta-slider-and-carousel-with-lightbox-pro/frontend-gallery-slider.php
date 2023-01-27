<?php
/**
 * Plugin Name: Meta Slider and Carousel with Lightbox Pro
 * Plugin URI: https://www.wponlinesupport.com/
 * Description: Plugin add a gallery meta box in your post, page and create a Image gallery menu tab. Display with a lightbox. 
 * Author: WP Online Support 
 * Author URI: https://www.wponlinesupport.com/
 * Text Domain: meta-slider-and-carousel-with-lightbox
 * Domain Path: /languages/
 * Version: 1.2.1
 *
 * @package WordPress
 * @author SP Technolab
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !defined( 'WP_IGSP_PRO_VERSION' ) ) {
	define( 'WP_IGSP_PRO_VERSION', '1.2.1' ); // Version of plugin
}
if( !defined( 'WP_IGSP_PRO_DIR' ) ) {
    define( 'WP_IGSP_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_IGSP_PRO_URL' ) ) {
    define( 'WP_IGSP_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_IGSP_PRO_PLUGIN_BASENAME' ) ) {
    define( 'WP_IGSP_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}
if( !defined( 'WP_IGSP_PRO_POST_TYPE' ) ) {
    define( 'WP_IGSP_PRO_POST_TYPE', 'wp_igsp_gallery' ); // Plugin post type
}
if( !defined( 'WP_IGSP_PRO_META_PREFIX' ) ) {
    define( 'WP_IGSP_PRO_META_PREFIX', '_wp_igsp_' ); // Plugin metabox prefix
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wp_igsp_pro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wp_igsp_pro_lang_dir = apply_filters( 'wp_igsp_pro_languages_directory', $wp_igsp_pro_lang_dir );

    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'meta-slider-and-carousel-with-lightbox' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'meta-slider-and-carousel-with-lightbox', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_IGSP_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'meta-slider-and-carousel-with-lightbox', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'meta-slider-and-carousel-with-lightbox', false, $wp_igsp_pro_lang_dir );
    }
}
add_action('plugins_loaded', 'wp_igsp_pro_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_igsp_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_igsp_pro_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_install() {
    
    // Get settings for the plugin
    $wp_igsp_pro_options = get_option( 'wp_igsp_pro_options' );
    
    if( empty( $wp_igsp_pro_options ) ) { // Check plugin version option
        
        // Set default settings
        wp_igsp_pro_default_settings();
        
        // Update plugin version to option
        update_option( 'wp_igsp_pro_plugin_version', '1.0' );
    }

    // Register post type function
    wp_igsp_pro_register_post_type();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    if( is_plugin_active('meta-slider-and-carousel-with-lightbox/frontend-gallery-slider.php') ) {
        add_action('update_option_active_plugins', 'deactivate_meta_slider_free_version');
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/**
 * Deactivate free plugin
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function deactivate_meta_slider_free_version() {
    deactivate_plugins('meta-slider-and-carousel-with-lightbox/frontend-gallery-slider.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function meta_slider_admin_notice() {

    $dir = WP_PLUGIN_DIR . '/meta-slider-and-carousel-with-lightbox/frontend-gallery-slider.php';
    
    // If free plugin exist
    if( file_exists($dir) ) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating Meta slider and carousel with lightbox Pro</strong>.<br /> It looks like you had FREE version <strong>(<em>Meta slider and carousel with lightbox</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'meta_slider_admin_notice');

/***** Updater Code Starts *****/
define( 'EDD_IGSP_PRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_IGSP_PRO_ITEM_NAME', 'Meta Slider and Carousel with Lightbox Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {    
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_plugin_updater() {
    
    $license_key = trim( get_option( 'wp_igsp_pro_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_IGSP_PRO_STORE_URL, __FILE__, array(
                'version'   => WP_IGSP_PRO_VERSION,         // current version number
                'license'   => $license_key,                // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_IGSP_PRO_ITEM_NAME,      // name of this plugin
                'author'    => 'WP Online Support'          // author of this plugin
            ));
}
add_action( 'admin_init', 'wp_igsp_pro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/igsp-plugin-updater.php' );
/***** Updater Code Ends *****/

// Taking some globals
global $wp_igsp_pro_options;

// Functions File
require_once( WP_IGSP_PRO_DIR . '/includes/wp-igsp-pro-functions.php' );
$wp_igsp_pro_options = wp_igsp_pro_get_settings();

// Plugin Post Type File
require_once( WP_IGSP_PRO_DIR . '/includes/wp-igsp-pro-post-types.php' );

// Script File
require_once( WP_IGSP_PRO_DIR . '/includes/class-wp-igsp-pro-script.php' );

// Admin Class File
require_once( WP_IGSP_PRO_DIR . '/includes/admin/class-wp-igsp-pro-admin.php' );

// Shortcode File
require_once( WP_IGSP_PRO_DIR . '/includes/shortcode/wp-igsp-pro-meta-gallery-slider.php' );
require_once( WP_IGSP_PRO_DIR . '/includes/shortcode/wp-igsp-pro-meta-gallery-carousel.php' );
require_once( WP_IGSP_PRO_DIR . '/includes/shortcode/wp-igsp-pro-meta-gallery-variable.php' );

// Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WP_IGSP_PRO_DIR . '/includes/admin/wp-igsp-how-it-work.php' );
}