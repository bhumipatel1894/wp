<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Iscw_Pro_Script {

	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'iscwp_pro_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'iscwp_pro_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'iscwp_pro_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'iscwp_pro_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'iscwp_pro_add_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_front_style() {

		// Registring and enqueing font awesome css
		if( !wp_style_is( 'wpos-font-awesome', 'registered' ) ) {
			wp_register_style( 'wpos-font-awesome', ISCWP_PRO_URL.'assets/css/font-awesome.min.css', array(), ISCWP_PRO_VERSION );
			wp_enqueue_style( 'wpos-font-awesome' );
		}

		// Registring and enqueing magnific css
		if( !wp_style_is( 'wpos-magnific-style', 'registered' ) ) {
			wp_register_style( 'wpos-magnific-style', ISCWP_PRO_URL.'assets/css/magnific-popup.css', array(), ISCWP_PRO_VERSION );
			wp_enqueue_style( 'wpos-magnific-style');
		}

		// Registring and enqueing slick css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', ISCWP_PRO_URL.'assets/css/slick.css', array(), ISCWP_PRO_VERSION );
			wp_enqueue_style( 'wpos-slick-style');	
		}
		
		// Registring and enqueing public css
		wp_register_style( 'iscwp-pro-public-css', ISCWP_PRO_URL.'assets/css/iscwp-pro-public.css', array(), ISCWP_PRO_VERSION );
		wp_enqueue_style( 'iscwp-pro-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_front_script() {

		// Registring magnific popup script
		if( !wp_script_is( 'wpos-magnific-script', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-script', ISCWP_PRO_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), ISCWP_PRO_VERSION, true );
		}
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', ISCWP_PRO_URL.'assets/js/slick.min.js', array('jquery'), ISCWP_PRO_VERSION, true );
		}

		// Registring public script 
		wp_register_script( 'iscwp-pro-public-js', ISCWP_PRO_URL.'assets/js/iscwp-pro-public.js', array('jquery'), ISCWP_PRO_VERSION, true );
		wp_localize_script( 'iscwp-pro-public-js', 'IscwPro', array(
															'is_mobile' 		=>	(wp_is_mobile()) 			? 1 : 0,
															'is_rtl' 			=>	(is_rtl()) 					? 1 : 0,
															'is_old_browser'	=> 	iscwp_pro_old_browser() 	? 1 : 0,
														));
		
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_admin_style( $hook ) {

		$pages_array = array('toplevel_page_iscwp-pro-settings');

		if(in_array($hook, $pages_array)) {
			
			wp_register_style( 'iscwp-admin-style', ISCWP_PRO_URL.'assets/css/iscwp-pro-admin.css', array(), ISCWP_PRO_VERSION );
			wp_enqueue_style( 'iscwp-admin-style');	
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_admin_script( $hook ) {

		$pages_array = array('toplevel_page_iscwp-pro-settings');

		if(in_array($hook,$pages_array)) {
			wp_register_script( 'iscwp-admin-script', ISCWP_PRO_URL.'assets/js/iscwp-pro-admin.js', array('jquery'), ISCWP_PRO_VERSION, true );
			wp_enqueue_script('iscwp-admin-script');
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_add_custom_css() {

		$custom_css = iscwp_pro_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$iscwp_pro_script = new Iscw_Pro_Script();