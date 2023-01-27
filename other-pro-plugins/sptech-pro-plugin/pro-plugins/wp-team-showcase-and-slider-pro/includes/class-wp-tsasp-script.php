<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_Tsasp_Script {
	
	function __construct() {

		// Action to add style at front side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_tsasp_admin_style') );

		// Action to add style at front side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_tsasp_admin_script') );

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_tsasp_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_tsasp_front_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wp_tsasp_custom_css'), 20 );
	}

	/**
	 * Function to add style at admin side
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_admin_style( $hook ) {

		global $current_screen, $post_type;

		if( $post_type == WP_TSASP_POST_TYPE ) {

			// Registring and enqueing admin css
			wp_register_style( 'wp-tsasp-admin-css', WP_TSASP_URL.'assets/css/wp-tsasp-admin.css', null, WP_TSASP_VERSION );
			wp_enqueue_style( 'wp-tsasp-admin-css' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;

		if( $post_type == WP_TSASP_POST_TYPE ) {
			
			// Built in jquery
			wp_enqueue_script( 'jquery-ui-sortable' );

			// Registring and enqueing public script
			wp_register_script( 'wp-tsasp-admin-js', WP_TSASP_URL.'assets/js/wp-tsasp-admin.js', array('jquery'), WP_TSASP_VERSION, true );
			wp_enqueue_script( 'wp-tsasp-admin-js' );
		}

		// Product sorting - only when sorting by menu order on the Team Showcase listing page
	    if ( $post_type == WP_TSASP_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
	        wp_register_script( 'wp-tsasp-ordering', WP_TSASP_URL . 'assets/js/wp-tsasp-ordering.js', array( 'jquery-ui-sortable' ), WP_TSASP_VERSION, true );
	        wp_enqueue_script( 'wp-tsasp-ordering' );
	    }
	}
	
	/**
	 * Function to add style at front side
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_front_style() {

		// Registring and enqueing font awesome css
		if( !wp_style_is( 'wpos-font-awesome', 'registered' ) ) {
			wp_register_style( 'wpos-font-awesome', WP_TSASP_URL.'assets/css/font-awesome.min.css', null, WP_TSASP_VERSION );
			wp_enqueue_style( 'wpos-font-awesome' );
		}
		
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WP_TSASP_URL.'assets/css/slick.css', null, WP_TSASP_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}

		// Registring and enqueing magnific css
		if( !wp_style_is( 'wpos-magnific-style', 'registered' ) ) {
			wp_register_style( 'wpos-magnific-style', WP_TSASP_URL.'assets/css/magnific-popup.css', array(), WP_TSASP_VERSION );
			wp_enqueue_style( 'wpos-magnific-style');
		}

		// Registring and enqueing public css
		wp_register_style( 'wp-tsasp-public-css', WP_TSASP_URL.'assets/css/wp-tsasp-public.css', null, WP_TSASP_VERSION );
		wp_enqueue_style( 'wp-tsasp-public-css' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_front_script() {

		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WP_TSASP_URL.'assets/js/slick.min.js', array('jquery'), WP_TSASP_VERSION, true );
		}

		// Registring magnific popup script
		if( !wp_script_is( 'wpos-magnific-script', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-script', WP_TSASP_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), WP_TSASP_VERSION, true );
		}

		// Registring and enqueing public script
		wp_register_script( 'wp-tsasp-public-js', WP_TSASP_URL.'assets/js/wp-tsasp-public.js', array('jquery'), WP_TSASP_VERSION, true );
		wp_localize_script( 'wp-tsasp-public-js', 'WpTsasp', array(
																	'is_mobile' 		=> (wp_is_mobile()) 		? 1 : 0,
																	'is_old_browser'	=> wp_tsasp_old_browser() 	? 1 : 0,
																));
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Team Showcase and Slider Pro
	 * @since 1.0.0
	 */
	function wp_tsasp_custom_css() {
		
		$custom_css = wp_tsasp_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wp_tsasp_script = new Wp_Tsasp_Script();