<?php
/**
 * Plugin Name: Woo Product Slider and Carousel with Category Pro
 * Plugin URI: https://www.wponlinesupport.com/
 * Description: Display Woocommerce Product Slider/Carousel, Woocommerce Best Selling Product Slider/Carousel, Woocommerce Featured Product Slider/Carousel with category.
 * Author: WP Online Support 
 * Text Domain: woo-product-slider-and-carousel-with-category
 * Domain Path: /languages/
 * Author URI: https://www.wponlinesupport.com/
 * Version: 1.2.3
 * 
 * @package WordPress
 * @author SP Technolab
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

if( !defined( 'WCPSCWC_VERSION' ) ) {
	define( 'WCPSCWC_VERSION', '1.2.3' ); // Version of plugin
}
if( !defined( 'WCPSCWC_DIR' ) ) {
    define( 'WCPSCWC_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( !defined( 'WCPSCWC_URL' ) ) {
    define( 'WCPSCWC_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( !defined( 'WCPSCWC_PLUGIN_BASENAME' ) ) {
    define( 'WCPSCWC_PLUGIN_BASENAME', plugin_basename( __FILE__ ) ); // plugin base name
}
if( !defined( 'WCPSCWC_PRODUCT_POST_TYPE' ) ) {
    define( 'WCPSCWC_PRODUCT_POST_TYPE', 'product' ); // Plugin category name
}
if( !defined( 'WCPSCWC_PRODUCT_CAT' ) ) {
    define( 'WCPSCWC_PRODUCT_CAT', 'product_cat' ); // Plugin category name
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Woo Product Slider and Carousel with category Pro
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wcpscwc_pro_install' );

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Woo Product Slider and Carousel with category Pro
 * @since 1.0.0
 */
function wcpscwc_pro_install() {

    // Deactivate free version
    if( is_plugin_active('woo-product-slider-and-carousel-with-category/woo-product-slider-carousel.php') ) {
        add_action('update_option_active_plugins', 'wcpscwc_deactivate_free_version');
    }
}

/**
 * Deactivate free plugin
 * 
 * @package Woo Product Slider and Carousel with category Pro
 * @since 1.0.0
 */
function wcpscwc_deactivate_free_version() {
    deactivate_plugins('woo-product-slider-and-carousel-with-category/woo-product-slider-carousel.php', true);
}

/**
 * Check WP News and Widget plugin is active
 *
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_pro_check_activation() {

	if ( !class_exists('WooCommerce') ) {
		// is this plugin active?
		if ( is_plugin_active( plugin_basename( __FILE__ ) ) ) {
			// deactivate the plugin
	 		deactivate_plugins( plugin_basename( __FILE__ ) );
	 		// unset activation notice
	 		unset( $_GET[ 'activate' ] );
	 		// display notice
	 		add_action( 'admin_notices', 'wcpscwc_pro_admin_notices' );
		}
	}
}

// Check required plugin is activated or not
add_action( 'admin_init', 'wcpscwc_pro_check_activation' );

/**
 * Admin notices
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_pro_admin_notices() {
	
	if ( !class_exists('WooCommerce') ) {
		echo '<div class="error notice is-dismissible">';
		echo '<p><strong>Woo Product Slider and Carousel with Category</strong> '.__('recommends the following plugin to use.', 'woo-product-slider-and-carousel-with-category').'</p>';
		echo '<p><strong><a href="https://wordpress.org/plugins/woocommerce/" target="_blank">WooCommerce</a> </strong></p>';
		echo '</div>';
	}
}

/**
 * Function to display admin notice of activated plugin.
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_pro_plugin_exist_notice() {

	// If free plugin exist
	$dir = WP_PLUGIN_DIR . '/woo-product-slider-and-carousel-with-category/woo-product-slider-carousel.php';

    if( file_exists($dir) && is_plugin_active( 'woo-product-slider-and-carousel-with-category-pro/woo-product-slider-carousel.php' ) ) {
        global $pagenow;
        
        if ( $pagenow == 'plugins.php' && current_user_can( 'install_plugins' ) ) {
            echo '<div id="message" class="updated notice is-dismissible"><p><strong>Thank you for activating Woo Product Slider and Carousel with Category Pro</strong>.<br /> It looks like you had FREE version <strong>(<em>Woo Product Slider and Carousel with Category</em>)</strong> of this plugin activated. To avoid conflicts the extra version has been deactivated and we recommend you delete it. </p></div>';
        }
    }
}

// Action to display notice
add_action( 'admin_notices', 'wcpscwc_pro_plugin_exist_notice');

/***** Updater Code Starts *****/
define( 'EDD_WCPSCWC_STORE_URL', 'https://www.wponlinesupport.com' );
define( 'EDD_WCPSCWC_ITEM_NAME', 'Woo Product Slider and Carousel with category Pro' );

// Plugin Updator Class 
if( !class_exists( 'EDD_SL_Plugin_Updater' ) ) {    
    include( dirname( __FILE__ ) . '/EDD_SL_Plugin_Updater.php' );
}

/**
 * Updater Function
 * 
 * @package Woo Product Slider and Carousel with category Pro
 * @since 1.0.0
 */
function wcpscwc_pro_plugin_updater() {
    
    $license_key = trim( get_option( 'wcpscwc_plugin_license_key' ) );

    $edd_updater = new EDD_SL_Plugin_Updater( EDD_WCPSCWC_STORE_URL, __FILE__, array(
                'version'   => WCPSCWC_VERSION,       // current version number
                'license'   => $license_key,          // license key (used get_option above to retrieve from DB)
                'item_name' => EDD_WCPSCWC_ITEM_NAME, // name of this plugin
                'author'    => 'WP Online Support'    // author of this plugin
            )
    );
}
add_action( 'admin_init', 'wcpscwc_pro_plugin_updater', 0 );
include( dirname( __FILE__ ) . '/wcpscwc-plugin-updater.php' );
/***** Updater Code Ends *****/

/**
 * Load Text Domain
 * This gets the plugin ready for translation
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0
 */
function wcpscwc_pro_load_textdomain() {

    global $wp_version;

    // Set filter for plugin's languages directory
    $wcpscwc_pro_lang_dir = dirname( plugin_basename( __FILE__ ) ) . '/languages/';
    $wcpscwc_pro_lang_dir = apply_filters( 'wcpscwc_pro_languages_directory', $wcpscwc_pro_lang_dir );
    
    // Traditional WordPress plugin locale filter.
    $get_locale = get_locale();

    if ( $wp_version >= 4.7 ) {
        $get_locale = get_user_locale();
    }

    // Traditional WordPress plugin locale filter
    $locale = apply_filters( 'plugin_locale',  $get_locale, 'woo-product-slider-and-carousel-with-category' );
    $mofile = sprintf( '%1$s-%2$s.mo', 'woo-product-slider-and-carousel-with-category', $locale );

    // Setup paths to current locale file
    $mofile_global  = WP_LANG_DIR . '/plugins/' . basename( WCPSCWC_DIR ) . '/' . $mofile;

    if ( file_exists( $mofile_global ) ) { // Look in global /wp-content/languages/plugin-name folder
        load_textdomain( 'woo-product-slider-and-carousel-with-category', $mofile_global );
    } else { // Load the default language files
        load_plugin_textdomain( 'woo-product-slider-and-carousel-with-category', false, $wcpscwc_pro_lang_dir );
    }
}

/**
 * Load the plugin after the main plugin is loaded.
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_pro_load_plugin() {

	// Check main plugin is active or not
	if( class_exists('WooCommerce') ) {

        // Action to load plugin text domain
        wcpscwc_pro_load_textdomain();
        
		// Script file
		require_once( WCPSCWC_DIR.'/includes/class-wcpscwc-script.php' );

		// Function file
		require_once( WCPSCWC_DIR.'/includes/wcpscwc-functions.php' );

		// Admin File
		require_once( WCPSCWC_DIR.'/includes/admin/class-wcpscwc-admin.php' );

		// Including Shortcode files
		require_once( WCPSCWC_DIR.'/includes/shortcodes/woo-products-slider.php' );
		require_once( WCPSCWC_DIR.'/includes/shortcodes/woo-best-selling-products-slider.php' );
		require_once( WCPSCWC_DIR.'/includes/shortcodes/woo-featured-products-slider.php' );

		// Widgets
		require_once( WCPSCWC_DIR.'/includes/widgets/class-woo-product-widget.php' );
        require_once( WCPSCWC_DIR.'/includes/widgets/class-woo-featured-product-widget.php' );
        require_once( WCPSCWC_DIR.'/includes/widgets/class-woo-best-selling-product-widget.php' );

        // How it work file, Load admin files
        if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {
            require_once( WCPSCWC_DIR . '/includes/admin/wcpscwc-how-it-work.php' );
        }
	}
}

// Action to load plugin after the main plugin is loaded
add_action('plugins_loaded', 'wcpscwc_pro_load_plugin', 15);