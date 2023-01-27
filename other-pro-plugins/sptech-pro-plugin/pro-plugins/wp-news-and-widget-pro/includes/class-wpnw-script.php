<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP News and Five Widgets Pro
 * @since 1.1.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpnw_Pro_Script {
	
	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpnw_pro_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wpnw_pro_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpnw_pro_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wpnw_pro_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpnw_pro_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package WP News and Five Widgets Pro
 	 * @since 1.1.5
	 */
	function wpnw_pro_front_style() {
		
		// Registring and enqueing slick css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WPNW_PRO_URL.'assets/css/slick.css', null, WPNW_PRO_VERSION );
			wp_enqueue_style('wpos-slick-style');
		}
		
		// Registring public style
		wp_register_style( 'wpnw-public-style', WPNW_PRO_URL.'assets/css/wpnw-pro-public.css', null, WPNW_PRO_VERSION );
		wp_enqueue_style('wpnw-public-style');
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package WP News and Five Widgets Pro
 	 * @since 1.1.5
	 */
	function wpnw_pro_front_script() {
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPNW_PRO_URL . 'assets/js/slick.min.js', array('jquery'), WPNW_PRO_VERSION, true );
		}
		
		// Registring vertical slider script
		if( !wp_script_is( 'wpos-vticker-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-vticker-jquery', WPNW_PRO_URL . 'assets/js/jquery.newstape.js', array('jquery'), WPNW_PRO_VERSION, true );
		}
		
		// Registring news ticker script
		if( !wp_script_is( 'wpos-ticker-script', 'registered' ) ) {
			wp_register_script( 'wpos-ticker-script', WPNW_PRO_URL . 'assets/js/wpnw-ticker.js', array('jquery'), WPNW_PRO_VERSION, true );
		}
		
		// Registring and enqueing public script
		wp_register_script( 'wpnw-pro-public-script', WPNW_PRO_URL.'assets/js/wpnw-pro-public.js', array('jquery'), WPNW_PRO_VERSION, true );
		wp_localize_script( 'wpnw-pro-public-script', 'WpnwPro', array(
																		'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																		'is_rtl' 	=> (is_rtl()) 		? 1 : 0
																	));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_admin_style( $hook ) {
		
		global $typenow;
		
		// If page is plugin setting page then enqueue script
		if( $typenow == WPNW_PRO_POST_TYPE ) {
			
			// Registring admin script
			wp_register_style( 'wpnw-pro-admin-css', WPNW_PRO_URL.'assets/css/wpnw-pro-admin.css', null, WPNW_PRO_VERSION );
			wp_enqueue_style( 'wpnw-pro-admin-css' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;
		
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
		
		// Pages array
		$pages_array = array( 'news_page_wpnw-pro-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Registring admin script
			wp_register_script( 'wpnw-pro-admin-js', WPNW_PRO_URL.'assets/js/wpnw-pro-admin.js', array('jquery'), WPNW_PRO_VERSION, true );
			wp_localize_script( 'wpnw-pro-admin-js', 'WpnwProAdmin', array(
																	'new_ui' =>	$new_ui
																));
			wp_enqueue_script( 'wpnw-pro-admin-js' );
			wp_enqueue_media(); // For media uploader
		}

		// Sorting - only when sorting by menu order on the news listing page
	    if ( $post_type == WPNW_PRO_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
	        wp_register_script( 'wpnw-pro-ordering', WPNW_PRO_URL . 'assets/js/wpnw-pro-ordering.js', array( 'jquery-ui-sortable' ), WPNW_PRO_VERSION, true );
	        wp_enqueue_script( 'wpnw-pro-ordering' );
	    }
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP News and Five Widgets Pro
	 * @since 1.1.6
	 */
	function wpnw_pro_custom_css() {

		$custom_css = wpnw_pro_get_option('custom_css');

		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpnw_pro_script = new Wpnw_Pro_Script();