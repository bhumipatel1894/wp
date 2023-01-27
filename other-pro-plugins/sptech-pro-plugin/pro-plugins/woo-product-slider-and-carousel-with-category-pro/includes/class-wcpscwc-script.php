<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wcpscwc_Pro_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wcpscwc_pro_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wcpscwc_pro_front_script') );
	}
	
	/**
	 * Function to add style at front side
	 * 
	 * @package Woo Product Slider and Carousel with category
	 * @since 1.0.0
	 */
	function wcpscwc_pro_front_style() {
		
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WCPSCWC_URL.'assets/css/slick.css', array(), WCPSCWC_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}
		
		// Registring and enqueing font awesome css
		if( !wp_style_is( 'wpos-font-awesome', 'registered' ) ) {
			wp_register_style( 'wpos-font-awesome', WCPSCWC_URL.'assets/css/font-awesome.min.css', array(), WCPSCWC_VERSION );
			wp_enqueue_style( 'wpos-font-awesome' );
		}

		// Registring and enqueing public css
		wp_register_style( 'wcpscwc_style', WCPSCWC_URL.'assets/css/wcpscwc-pro-public.css', array(), WCPSCWC_VERSION );
		wp_enqueue_style( 'wcpscwc_style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package Woo Product Slider and Carousel with category
	 * @since 1.0.0
	 */
	function wcpscwc_pro_front_script() {
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WCPSCWC_URL.'assets/js/slick.min.js', array('jquery'), WCPSCWC_VERSION, true );
		}
		
		// Registring and enqueing public script
		wp_register_script( 'wcpscwc-public-jquery', WCPSCWC_URL.'assets/js/wcpscwc-pro-public.js', array('jquery'), WCPSCWC_VERSION, true );
		wp_localize_script( 'wcpscwc-public-jquery', 'WcpscwcPro', array(
																		'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																		'is_rtl' 	=> (is_rtl()) ? 1 : 0
																	));
	}
}

$Wcpscwc_pro_script = new Wcpscwc_Pro_Script();