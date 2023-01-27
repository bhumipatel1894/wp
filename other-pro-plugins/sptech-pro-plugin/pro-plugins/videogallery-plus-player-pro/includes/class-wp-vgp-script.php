<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Vgp_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_vgp_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_vgp_front_script') );

		// Action to add style at front side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_vgp_admin_style') );

		// Action to add style at front side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_vgp_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wp_vgp_add_custom_css'), 20 );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_front_style() {
		
		// Registring and enqueing magnific css
		if( !wp_style_is( 'wpos-magnific-style', 'registered' ) ) {
			wp_register_style( 'wpos-magnific-style', WP_VGP_URL.'assets/css/magnific-popup.css', array(), WP_VGP_VERSION );
			wp_enqueue_style( 'wpos-magnific-style');
		}

		// Registring and enqueing video js css
		if( !wp_style_is( 'wpos-videojs-style', 'registered' ) ) {
			wp_register_style( 'wpos-videojs-style', WP_VGP_URL.'assets/css/video-js.css', array(), WP_VGP_VERSION );
			wp_enqueue_style( 'wpos-videojs-style' );
		}

		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WP_VGP_URL.'assets/css/slick.css', array(), WP_VGP_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}

		wp_register_style( 'wp-vgp-public-style', WP_VGP_URL.'assets/css/wp-vgp-public.css', array(), WP_VGP_VERSION );
		wp_enqueue_style( 'wp-vgp-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_front_script() {

		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WP_VGP_URL.'assets/js/slick.min.js', array('jquery'), WP_VGP_VERSION, true );
		}
		
		// Registring video js script
		if( !wp_script_is( 'wpos-videojs-script', 'registered' ) ) {
			wp_register_script( 'wpos-videojs-script', WP_VGP_URL.'assets/js/video.js', array('jquery'), WP_VGP_VERSION, true );
		}

		// Registring JW Player script
		if( !wp_script_is( 'wpos-jwplayer-script', 'registered' ) ) {
			wp_register_script( 'wpos-jwplayer-script', WP_VGP_URL.'assets/js/jwplayer.js', array('jquery'), WP_VGP_VERSION, true );
		}
		
		// Registring magnific popup script
		if( !wp_style_is( 'wpos-magnific-script', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-script', WP_VGP_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), WP_VGP_VERSION, true );
		}

		// Registring public script
		wp_register_script( 'wp-vgp-public-js', WP_VGP_URL.'assets/js/wp-vgp-public.js', array('jquery'), WP_VGP_VERSION, true );
		wp_localize_script( 'wp-vgp-public-js', 'Wpvgp', array(
															'is_mobile' 	=>	(wp_is_mobile()) 	? 1 : 0,
															'is_rtl' 		=>	(is_rtl()) 			? 1 : 0,
															'jwp_enable'	=>	wp_vgp_get_option('jwp_enable'),
															'jwp_lc_key'	=>	wp_vgp_get_option('jwp_licence_key'),
														));
	}

	/**
	 * Function to add style at admin side
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_admin_style( $hook ) {

		global $typenow;

		if( $typenow == WP_VGP_POST_TYPE ) {

			// enqueing built in css
			wp_enqueue_style( 'wp-color-picker' );

			// Registring and enqueing admin css
			wp_register_style( 'wp-vgp-admin-style', WP_VGP_URL.'assets/css/wp-vgp-admin.css', array(), WP_VGP_VERSION );
			wp_enqueue_style( 'wp-vgp-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_admin_script( $hook ) {

		global $typenow, $wp_version, $wp_query;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		if( $typenow == WP_VGP_POST_TYPE ) {
			
			// enqueing built in js
			wp_enqueue_script( 'wp-color-picker' );

			// Registring and enqueing admin script
			wp_register_script( 'wp-vgp-admin-script', WP_VGP_URL.'assets/js/wp-vgp-admin.js', array('jquery'), WP_VGP_VERSION, true );
			wp_localize_script( 'wp-vgp-admin-script', 'WpVgpAdmin', array(
																	'new_ui' 	=>	$new_ui,
																	'reset_msg'	=> __('Click OK to reset all options. All settings will be lost!', 'html5-videogallery-plus-player'),
																));
			wp_enqueue_script( 'wp-vgp-admin-script' );
			wp_enqueue_media(); // For media uploader

			// Video sorting - only when sorting by menu order on the blog listing page
			if ( isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
				wp_register_script( 'wp-vgp-ordering', WP_VGP_URL . 'assets/js/wp-vgp-ordering.js', array( 'jquery-ui-sortable' ), WP_VGP_VERSION, true );
				wp_enqueue_script( 'wp-vgp-ordering' );
			}
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package Video gallery and Player Pro
	 * @since 1.0.0
	 */
	function wp_vgp_add_custom_css() {

		$custom_css = wp_vgp_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wp_vgp_script = new Wp_Vgp_Script();