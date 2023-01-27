<?php
/**
 * Plugin generic functions file
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.2.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wprpsp_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wprpsp_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wprpsp_front_script') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wprpsp_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wprpsp_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wprpsp_add_custom_css'), 20 );
	}
	
	/**
	 * Function to add style at front side
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_front_style() {
		
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WPRPSP_URL.'assets/css/slick.css', array(), WPRPSP_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}
		
		// Registring and enqueing public css
		wp_register_style( 'wprpsp-public-style', WPRPSP_URL.'assets/css/wprpsp-public.css', array(), WPRPSP_VERSION );
		wp_enqueue_style( 'wprpsp-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_front_script() {
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPRPSP_URL.'assets/js/slick.min.js', array('jquery'), WPRPSP_VERSION, true );
		}
		
		// Registring and enqueing public script
		wp_register_script( 'wprpsp-public-script', WPRPSP_URL.'assets/js/wprpsp-public.js', array('jquery'), WPRPSP_VERSION, true );
		wp_localize_script( 'wprpsp-public-script', 'Wprpsp', array(
																	'is_mobile' 		=> (wp_is_mobile()) 	? 1 : 0,
																	'is_rtl' 			=> (is_rtl()) 			? 1 : 0,
																	'is_old_browser'	=> wprpsp_old_browser() ? 1 : 0,
																));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_admin_style( $hook ) {

		// Pages array
		$pages_array = array( 'posts_page_wprpsp-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_style( 'wprpsp-admin-style', WPRPSP_URL.'assets/css/wprpsp-admin.css', null, WPRPSP_VERSION );
			wp_enqueue_style( 'wprpsp-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.2.7
	 */
	function wprpsp_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;

		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		// Pages array
		$pages_array = array( 'posts_page_wprpsp-settings', 'widgets.php' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_script( 'wprpsp-admin-script', WPRPSP_URL.'assets/js/wprpsp-admin.js', array('jquery'), WPRPSP_VERSION, true );
			wp_localize_script( 'wprpsp-admin-script', 'WprpspAdmin', array(
																	'new_ui' =>	$new_ui
																));
			wp_enqueue_script( 'wprpsp-admin-script' );
			wp_enqueue_media(); // For media uploader
		}

		// Product sorting - only when sorting by menu order on the blog listing page
		if ( $post_type == WPRPSP_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
			wp_register_script( 'wprpsp-ordering', WPRPSP_URL . 'assets/js/wprpsp-ordering.js', array( 'jquery-ui-sortable' ), WPRPSP_VERSION, true );
			wp_enqueue_script( 'wprpsp-ordering' );
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Responsive Recent Post Slider Pro
	 * @since 1.1.5
	 */
	function wprpsp_add_custom_css() {

		$custom_css = wprpsp_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wprpsp_script = new Wprpsp_Script();