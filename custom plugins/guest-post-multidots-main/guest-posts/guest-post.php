<?php

/**
 * Plugin Name: Guest Posts
 * Plugin URI: 
 * Description: This Plugin is specially build for Multidots team for Custom Post/Page auto submission through form.
 * Author: Bhumi Patel
 * Text Domain: guest-posts
 * Domain Path: /languages/
 * Version: 1.0
 * Author URI: 
 *
 * @package Guest Posts
 * @author Bhumi Patel
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !defined( 'WP_GP_VERSION' ) ) {
	define( 'WP_GP_VERSION', '1.0' ); // Version of plugin
}
if( !defined( 'WP_GP_DIR' ) ) {
    define( 'WP_GP_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WP_GP_URL' ) ) {
    define( 'WP_GP_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WP_GP_POST_TYPE' ) ) {
    define( 'WP_GP_POST_TYPE', 'guest-post' ); // Plugin post type
}
if( !defined( 'WP_GP_PLUGIN_BASENAME' ) ) {
    define( 'WP_GP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // Plugin base name
}

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Guest Posts
 * @since 1.0
 */
function wp_gp_load_textdomain() {
	
    // Set filter for plugin's languages directory
    $wp_gp_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wp_gp_lang_dir = apply_filters( 'wp_gp_languages_directory', $wp_gp_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_user_locale();

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'guest-posts' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'guest-posts', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WP_GP_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'guest-posts', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'guest-posts', false, $wp_gp_lang_dir );
    }
}
add_action('plugins_loaded', 'wp_gp_load_textdomain');

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Guest Posts
 * @since 1.0
 */
register_activation_hook( __FILE__, 'wp_gp_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Guest Posts
 * @since 1.0
 */
register_deactivation_hook( __FILE__, 'wp_gp_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * set default values for the plugin options.
 * 
 * @package Guest Posts
 * @since 1.0
 */
function wp_gp_install() {
    
    // Register post type function
    wp_gp_register_post_type();
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

// Action to display notice
add_action( 'admin_notices', 'wp_gp_admin_notice');
/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Guest Posts
 * @since 1.0
 */
function wp_gp_admin_notice() {
    
    $dir = WP_PLUGIN_DIR . '/guest-posts/guest-post.php';
    
    // If PRO plugin is active and free plugin exist
    if( is_plugin_active( 'guest-posts/guest-post.php' ) && file_exists($dir)) {
        
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you Multidots Team for activating Guest Posts Plugin</strong>.<br /> you can create post/CPT/Page through form submission by author role.</p></div>';
        }
    }
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Guest Posts
 * @since 1.0
 */
function wp_gp_uninstall() {
    
    // IMP need to flush rules for custom registered post type
    flush_rewrite_rules();
}

//function file
require_once( WP_GP_DIR . '/includes/wp-gp-function.php' );
// Plugin Post Type File
require_once( WP_GP_DIR . '/includes/wp-gp-cpt.php' );
// Script File
require_once( WP_GP_DIR . '/includes/class-wp-gp-script.php' );
// Shortcode File
require_once( WP_GP_DIR . '/includes/shortcode/wp-gp-formfields.php' );
require_once( WP_GP_DIR . '/includes/shortcode/wp_gp_review.php' );