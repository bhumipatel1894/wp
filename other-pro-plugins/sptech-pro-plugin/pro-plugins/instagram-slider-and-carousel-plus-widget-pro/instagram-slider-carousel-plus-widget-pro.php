<?php
/**
 * Plugin Name: Instagram Slider and Carousel Plus Widget Pro
 * Plugin URI: https://www.wponlinesupport.com
 * Text Domain: instagram-slider-and-carousel-plus-widget
 * Domain Path: /languages/
 * Description: Easy to display your instagram photo in a slider, carousel, variable width slider and widget.
 * Author: WP Online Support
 * Version: 1.0
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
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
if( !defined( 'ISCWP_PRO_VERSION' ) ) {
	define( 'ISCWP_PRO_VERSION', '1.0' ); // Version of plugin
}
if( !defined( 'ISCWP_PRO_DIR' ) ) {
    define( 'ISCWP_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'ISCWP_PRO_URL' ) ) {
    define( 'ISCWP_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'ISCWP_PRO_PLUGIN_BASENAME' ) ) {
    define( 'ISCWP_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $iscwp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $iscwp_lang_dir = apply_filters( 'iscwp_languages_directory', $iscwp_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'instagram-slider-and-carousel-plus-widget' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'instagram-slider-and-carousel-plus-widget', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( ISCWP_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'instagram-slider-and-carousel-plus-widget', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'instagram-slider-and-carousel-plus-widget', false, $iscwp_lang_dir );
    }
}
add_action('plugins_loaded', 'iscwp_pro_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'iscwp_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'iscwp_pro_uninstall');

/**
 * Plugin Activation Function
 * Does the initial setup, sets the default values for the plugin options
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
function iscwp_pro_install() {

    // Get settings for the plugin
    $iscwp_pro_options = get_option( 'iscwp_pro_options' );
    
    if( empty( $iscwp_pro_options ) ) { // Check plugin version option

        // Set default settings
        iscwp_pro_default_settings();

        // Update plugin version to option
        update_option( 'iscwp_pro_plugin_version', '1.0' );
    }

    // Deactivate free version
    if( is_plugin_active('slider-and-carousel-plus-widget-for-instagram/slider-carousel-plus-widget-for-instagram.php') ){
        add_action('update_option_active_plugins', 'iscwp_pro_deactivate_free_version');
    }
}

/**
 * Deactivate free plugin
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
function iscwp_pro_deactivate_free_version() {
    deactivate_plugins('slider-and-carousel-plus-widget-for-instagram/slider-carousel-plus-widget-for-instagram.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
function iscwp_pro_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/slider-and-carousel-plus-widget-for-instagram/slider-carousel-plus-widget-for-instagram.php';

    // If PRO plugin is active and free plugin exist
    if( file_exists($dir) ) {

        global $pagenow;

        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible">
                    <p>
                        <strong>'.sprintf( __('Thank you for activating %s', 'instagram-slider-and-carousel-plus-widget'), 'Instagram Slider and Carousel Plus Widget Pro').'</strong>.<br/>
                        '.sprintf( __('It looks like you had FREE version %s of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it.', 'instagram-slider-and-carousel-plus-widget'), '<strong>(<em>Instagram Slider and Carousel Plus Widget</em>)</strong>' ).'
                    </p>
                </div>';
        }
    }
}
add_action( 'admin_notices', 'iscwp_pro_admin_notice');

/**
 * Plugin Deactivation Function
 * Delete  plugin options
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
function iscwp_pro_uninstall() {
}

/***** Updater Code Starts *****/
define( 'ISCWP_PRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'ISCWP_PRO_ITEM_NAME', 'Instagram Slider and Carousel Plus Widget Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {    
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */
function iscwp_pro_plugin_updater() {

    $license_key = trim( get_option( 'iscwp_pro_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( ISCWP_PRO_STORE_URL, __FILE__, array(
                'version'   => ISCWP_PRO_VERSION,       // current version number
                'license'   => $license_key,            // license key (used get_option above to retrieve from DB)
                'item_name' => ISCWP_PRO_ITEM_NAME, // name of this plugin
                'author'    => 'WP Online Support'      // author of this plugin
            ));
}
add_action( 'admin_init', 'iscwp_pro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/iscwp-plugin-updater.php' );
/***** Updater Code Ends *****/

// Taking some globals
global $iscwp_pro_options;

// Functions file
require_once( ISCWP_PRO_DIR . '/includes/iscwp-functions.php' );
$iscwp_pro_options = iscwp_pro_get_settings();

// Admin Class
require_once( ISCWP_PRO_DIR . '/includes/admin/class-iscwp-admin.php' );

// Script Class File
require_once( ISCWP_PRO_DIR . '/includes/class-iscwp-script.php' );

// Shortcode File
require_once( ISCWP_PRO_DIR . '/includes/shortcode/iscwp-grid.php' );
require_once( ISCWP_PRO_DIR . '/includes/shortcode/iscwp-slider.php' );
require_once( ISCWP_PRO_DIR . '/includes/shortcode/iscwp-block.php' );

// Widget Files
require_once( ISCWP_PRO_DIR . '/includes/widgets/class-instagram-grid-widget.php' );
require_once( ISCWP_PRO_DIR . '/includes/widgets/class-instagram-slider-widget.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( ISCWP_PRO_DIR . '/includes/admin/iscwp-how-it-work.php' );
}