<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpsisac_Pro_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpsisac_pro_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpsisac_pro_front_script') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpsisac_pro_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wpsisac_pro_admin_script') );
		
		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpsisac_pro_add_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.0.0
	 */
	function wpsisac_pro_front_style() {
		
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WPSISAC_PRO_URL.'assets/css/slick.css', array(), WPSISAC_PRO_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}
		
		// Registring and enqueing public css
		wp_register_style( 'wpsisac-pro-public-style', WPSISAC_PRO_URL.'assets/css/wpsisac-pro-public.css', array(), WPSISAC_PRO_VERSION );
		wp_enqueue_style( 'wpsisac-pro-public-style' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.0.0
	 */
	function wpsisac_pro_front_script() {
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPSISAC_PRO_URL.'assets/js/slick.min.js', array('jquery'), WPSISAC_PRO_VERSION, true );
		}
		
		// Registring and enqueing public script
		wp_register_script( 'wpsisac-pro-public-script', WPSISAC_PRO_URL.'assets/js/wpsisac-pro-public.js', array('jquery'), WPSISAC_PRO_VERSION, true );
		wp_localize_script( 'wpsisac-pro-public-script', 'Wpsisac_Pro', array(
																	'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																	'is_rtl' 	=> (is_rtl()) 		? 1 : 0
																	));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.2.5
	 */
	function wpsisac_pro_admin_style( $hook ) {

		global $typenow;

		// Pages array
		$pages_array = array( WPSISAC_PRO_POST_TYPE );
		
		// If page is plugin setting page then enqueue script
		if( in_array($typenow, $pages_array) ) {
			
			// Registring admin script
			wp_register_style( 'wpsisac-pro-admin-style', WPSISAC_PRO_URL.'assets/css/wpsisac-pro-admin.css', null, WPSISAC_PRO_VERSION );
			wp_enqueue_style( 'wpsisac-pro-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.2.5
	 */
	function wpsisac_pro_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;
		
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
		
		// Pages array
		$pages_array = array( 'slick_slider_page_wpsisac-pro-settings' );
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {
			
			// Registring admin script
			wp_register_script( 'wpsisac-pro-admin-script', WPSISAC_PRO_URL.'assets/js/wpsisac-pro-admin.js', array('jquery'), WPSISAC_PRO_VERSION, true );
			wp_localize_script( 'wpsisac-pro-admin-script', 'WpsisacProAdmin', array(
																	'new_ui' =>	$new_ui
																));
			wp_enqueue_script( 'wpsisac-pro-admin-script' );
			wp_enqueue_media(); // For media uploader
		}

		// Slider sorting - only when sorting by menu order on the blog listing page
		if ( $post_type == WPSISAC_PRO_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
			wp_register_script( 'wpsisac-pro-ordering', WPSISAC_PRO_URL . 'assets/js/wpsisac-pro-ordering.js', array( 'jquery-ui-sortable' ), WPSISAC_PRO_VERSION, true );
			wp_enqueue_script( 'wpsisac-pro-ordering' );
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Slick Slider and Image Carousel Pro
	 * @since 1.2.5
	 */
	function wpsisac_pro_add_custom_css() {

		$custom_css = wpsisac_pro_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpsisac_pro_script = new Wpsisac_Pro_Script();