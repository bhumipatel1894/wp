<?php
/**
 * Plugin Name: Portfolio and Projects Pro
 * Plugin URI: https://www.wponlinesupport.com/
 * Description: Display Portfolio OR Projects in a grid view. 
 * Author: WP Online Support 
 * Text Domain: portfolio-and-projects
 * Domain Path: /languages/
 * Version: 1.1
 * Author URI: https://www.wponlinesupport.com/
 *
 * @package Portfolio and Projects Pro
 * @author WP Online Support 
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !defined( 'WP_PAP_PRO_VERSION' ) ) {
	define( 'WP_PAP_PRO_VERSION', '1.1' ); // Version of plugin
}
if( !defined( 'WP_PAP_PRO_DIR' ) ) {
    define( 'WP_PAP_PRO_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_PAP_PRO_URL' ) ) {
    define( 'WP_PAP_PRO_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_PAP_PRO_POST_TYPE' ) ) {
    define( 'WP_PAP_PRO_POST_TYPE', 'wpos_portfolio' ); // Plugin post type
}
if( !defined( 'WP_PAP_PRO_CAT' ) ) {
    define( 'WP_PAP_PRO_CAT', 'wppap_portfolio_cat' ); // Plugin post type
}
if( !defined( 'WP_PAP_PRO_TAG' ) ) {
    define( 'WP_PAP_PRO_TAG', 'wppap_portfolio_tag' ); // Plugin post type
}
if( !defined( 'WP_PAP_PRO_META_PREFIX' ) ) {
    define( 'WP_PAP_PRO_META_PREFIX', '_wp_pap_' ); // Plugin metabox prefix
}
if( !defined( 'WP_PAP_PRO_PLUGIN_BASENAME' ) ) {
    define( 'WP_PAP_PRO_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_load_textdomain() {
	
    global $wp_version;

    // Set filter for plugin's languages directory
    $wp_pap_pro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wp_pap_pro_lang_dir = apply_filters( 'wp_pap_pro_languages_directory', $wp_pap_pro_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'portfolio-and-projects' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'portfolio-and-projects', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_PAP_PRO_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'portfolio-and-projects', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'portfolio-and-projects', false, $wp_pap_pro_lang_dir );
    }
}
add_action('plugins_loaded', 'wp_pap_pro_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
register_activation_hook( __FILE__, 'wp_pap_pro_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
register_deactivation_hook( __FILE__, 'wp_pap_pro_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_install() {
    
    // Register post type function
    wp_pap_pro_register_post_type();
    wp_pap_pro_register_taxonomies();

    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();

    // Deactivate free version
    if( is_plugin_active('portfolio-and-projects/portfolio-and-projects.php') ){
        add_action('update_option_active_plugins', 'wp_pap_pro_deactivate_free_version');
    }
}

/**
 * Deactivate free plugin
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_deactivate_free_version() {
    deactivate_plugins('portfolio-and-projects/portfolio-and-projects.php', true);
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/portfolio-and-projects/portfolio-and-projects.php';
    
    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'portfolio-and-projects-pro/portfolio-and-projects.php' ) && file_exists($dir)) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating Portfolio and Projects Pro</strong>.<br /> It looks like you had FREE version <strong>(<em>Portfolio and Projects</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wp_pap_pro_admin_notice');

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

/***** Updater Code Starts *****/
define( 'WPPAP_PRO_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'WPPAP_PRO_ITEM_NAME', 'Portfolio and Projects Pro' );

// Plugin Updator Class
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_plugin_updater() {

    $license_key = trim( get_option( 'wp_pap_pro_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( WPPAP_PRO_STORE_URL, __FILE__, array(
                'version'   => WP_PAP_PRO_VERSION,           // current version number
                'license'   => $license_key,                // license key (used get_option above to retrieve from DB)
                'item_name' => WPPAP_PRO_ITEM_NAME,     // name of this plugin
                'author'    => 'WP Online Support'          // author of this plugin
            ));
}
add_action( 'admin_init', 'wp_pap_pro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wppap-plugin-updater.php' );
/***** Updater Code Ends *****/

// Functions File
require_once( WP_PAP_PRO_DIR . '/includes/wp-pap-functions.php' );

// Plugin Post Type File
require_once( WP_PAP_PRO_DIR . '/includes/wp-pap-post-types.php' );

// Script File
require_once( WP_PAP_PRO_DIR . '/includes/class-wp-pap-script.php' );

// Admin Class File
require_once( WP_PAP_PRO_DIR . '/includes/admin/class-wp-pap-admin.php' );

// Shortcode File
require_once( WP_PAP_PRO_DIR . '/includes/shortcode/wp-pap-portfolio.php' );
require_once( WP_PAP_PRO_DIR . '/includes/shortcode/wp-pap-portfolio-filter.php' );

// How it work file, Load admin files
if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
    require_once( WP_PAP_PRO_DIR . '/includes/admin/pap-how-it-work.php' );
}