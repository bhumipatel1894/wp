<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Fcasp_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_fcasp_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_fcasp_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wp_fcasp_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_fcasp_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wp_fcasp_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP Featured Content and Slider Pro
 	 * @since 1.0.0
	 */
	function wp_fcasp_front_style() {

		// Registring font awesome style
		if (!wp_style_is('wpos-font-awesome', 'registered')) {
		 	wp_register_style( 'wpos-font-awesome', WP_FCASP_URL.'assets/css/font-awesome.min.css', null, WP_FCASP_VERSION );
			wp_enqueue_style( 'wpos-font-awesome' );
		}
		
		// Registring slick style
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WP_FCASP_URL.'assets/css/slick.css', null, WP_FCASP_VERSION );
			wp_enqueue_style('wpos-slick-style');
		}

		// Registring public style
		wp_register_style( 'wp-fcasp-public-style', WP_FCASP_URL.'assets/css/wp-fcasp-public-style.css', null, WP_FCASP_VERSION );
		wp_enqueue_style('wp-fcasp-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Featured Content and Slider Pro
 	 * @since 1.0.0
	 */
	function wp_fcasp_front_script() {

		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WP_FCASP_URL . 'assets/js/slick.min.js', array('jquery'), WP_FCASP_VERSION, true );
		}

		// Registring modernizr script
		if( !wp_script_is( 'wpos-modernizr', 'registered' ) ) {
			wp_register_script( 'wpos-modernizr', WP_FCASP_URL . 'assets/js/modernizr.custom.js', array('jquery'), WP_FCASP_VERSION, true );
		}
		
		// Registring Public script
		wp_register_script( 'wp-fcasp-public-js', WP_FCASP_URL . 'assets/js/wp-fcasp-public.js', array('jquery'), WP_FCASP_VERSION, true );
		wp_localize_script( 'wp-fcasp-public-js', 'WpFcasp', array(
																	'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																	'is_rtl' 	=>	(is_rtl()) 		? 1 : 0,
																));
	}
	
	/**
	 * Enqueue admin styles
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_admin_style( $hook ) {
		
		// Pages array
		$pages_array = array( 'featured_post_page_wp-fcasp-settings' );
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {
			
			// Registring admin script
			wp_register_style( 'wp-fcasp-admin-css', WP_FCASP_URL.'assets/css/wp-fcasp-admin.css', null, WP_FCASP_VERSION );
			wp_enqueue_style( 'wp-fcasp-admin-css' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		// Pages array
		$pages_array = array( 'featured_post_page_wp-fcasp-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_script( 'wp-fcasp-admin-js', WP_FCASP_URL.'assets/js/wp-fcasp-admin.js', array('jquery'), WP_FCASP_VERSION, true );
			wp_localize_script( 'wp-fcasp-admin-js', 'WpFcaspAdmin', array(
																	'new_ui' =>	$new_ui
																));
			wp_enqueue_script( 'wp-fcasp-admin-js' );
			wp_enqueue_media(); // For media uploader
		}

		// Product sorting - only when sorting by menu order on the featured content listing page
	    if ( $post_type == WP_FCASP_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
	        wp_register_script( 'wp-fcasp-ordering', WP_FCASP_URL . 'assets/js/wp-fcasp-ordering.js', array( 'jquery-ui-sortable' ), WP_FCASP_VERSION, true );
	        wp_enqueue_script( 'wp-fcasp-ordering' );
	    }
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Featured Content and Slider Pro
	 * @since 1.0.0
	 */
	function wp_fcasp_custom_css() {

		$custom_css = wp_fcasp_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wp_fcasp_script = new Wp_Fcasp_Script();