<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpcdt_Pro_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpcdt_pro_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpcdt_pro_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpcdt_pro_admin_style') );

		// Action to add script in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpcdt_pro_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpcdt_pro_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_front_style() {

		// Registring and enqueing public css
		wp_register_style( 'wpcdt-public-css', WPCDT_PRO_URL.'assets/css/wpcdt-public-style.css', null, WPCDT_PRO_VERSION );
		wp_enqueue_style( 'wpcdt-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_front_script() {

		// Register timer script
		wp_register_script( 'wpcdt-timecircle-js', WPCDT_PRO_URL.'assets/js/wpcdt-timecircles.js', array('jquery'), WPCDT_PRO_VERSION, true );
		wp_register_script( 'wpcdt-countereverest-js', WPCDT_PRO_URL.'assets/js/jquery.counteverest.min.js', array('jquery'), WPCDT_PRO_VERSION, true );
		
		// Register public script
		wp_register_script( 'wpcdt-public-js', WPCDT_PRO_URL.'assets/js/wpcdt-public-script.js', array('jquery'), WPCDT_PRO_VERSION, true );
		wp_localize_script( 'wpcdt-public-js', 'WpCdtPro', array(
															'timezone' => get_option('gmt_offset')
														));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_admin_style( $hook ) {
		
		global $post_type;

		// If page is Post page then enqueue script
		if( $post_type == WPCDT_PRO_POST_TYPE ) {

			// Enqueu built in style for color picker
			wp_enqueue_style( 'wp-color-picker' );

			wp_register_style( 'wpcdt-jquery-ui-css', WPCDT_PRO_URL.'assets/css/wpcdt-time-picker.css', null, WPCDT_PRO_VERSION );
			wp_enqueue_style( 'wpcdt-jquery-ui-css' );

			wp_register_style( 'wpcdt-admin-css', WPCDT_PRO_URL.'assets/css/wpcdt-admin-style.css', null, WPCDT_PRO_VERSION );
			wp_enqueue_style( 'wpcdt-admin-css' );
		}
	}

	/**
	 * Enqueue admin script
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_admin_script( $hook ) {

		global $wp_version, $post_type;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		// If page is plugin setting page then enqueue script
		if( $post_type == WPCDT_PRO_POST_TYPE ) {

			// Enqueu built-in script for color picker
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'jquery-ui-datepicker' );
			wp_enqueue_script( 'jquery-ui-slider' );

			// Registring admin script
			wp_register_script( 'wpcdt-ui-timepicker-addon-js', WPCDT_PRO_URL.'assets/js/wpcdt-ui-timepicker-addon.js', array('jquery'), WPCDT_PRO_VERSION, true );
			wp_enqueue_script( 'wpcdt-ui-timepicker-addon-js' );

			wp_register_script( 'wpcdt-admin-js', WPCDT_PRO_URL.'assets/js/wpcdt-admin-script.js', array('jquery'), WPCDT_PRO_VERSION, true );			
			wp_enqueue_script( 'wpcdt-admin-js' );
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_custom_css() {

		$custom_css = wpcdt_pro_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpcdt_pro_script = new Wpcdt_Pro_Script();