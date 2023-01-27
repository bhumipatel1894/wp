<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpls_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpls_pro_logoshowcase_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpls_pro_logoshowcase_script') );

		// Action to add style at front side
		add_action( 'admin_enqueue_scripts', array($this, 'wpls_pro_logoshowcase_admin_style') );

		// Action to add style at front side
		add_action( 'admin_enqueue_scripts', array($this, 'wpls_pro_logoshowcase_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpls_pro_add_custom_css'), 20 );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_logoshowcase_style(){
		
		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WPLS_PRO_URL.'assets/css/slick.css', array(), WPLS_PRO_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}
		
		// Registring and enqueing animate css
		if( !wp_style_is( 'wpos-animate-style', 'registered' ) ) {
			wp_register_style( 'wpos-animate-style', WPLS_PRO_URL.'assets/css/animate.min.css', array(), WPLS_PRO_VERSION );
			wp_enqueue_style( 'wpos-animate-style');
		}
		
		// Registring and enqueing public css
		wp_register_style( 'wpls-pro-public-style', WPLS_PRO_URL.'assets/css/wpls-pro-public.css', array(), WPLS_PRO_VERSION );
		wp_enqueue_style( 'wpls-pro-public-style');
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_logoshowcase_script() {

		// Registring slick slider js
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPLS_PRO_URL.'assets/js/slick.min.js', array('jquery'), WPLS_PRO_VERSION, true );
		}

		// Registring tooltip js
		if( !wp_script_is( 'wpos-tooltip-js', 'registered' ) ) {
			wp_register_script( 'wpos-tooltip-js', WPLS_PRO_URL.'assets/js/tooltipster.min.js', array('jquery'), WPLS_PRO_VERSION, true );
		}
		
		// Registring tooltip js
		if( !wp_script_is( 'wpos-filterizr-js', 'registered' ) ) {
			wp_register_script( 'wpos-filterizr-js', WPLS_PRO_URL.'assets/js/filterizr.js', array('jquery'), WPLS_PRO_VERSION, true );
		}
		
		// Registring public js
		wp_register_script( 'wpls-pro-public-js', WPLS_PRO_URL.'assets/js/wpls-pro-public.js', array('jquery'), WPLS_PRO_VERSION, true );
		wp_localize_script( 'wpls-pro-public-js', 'WplsPro', array(
															'is_mobile' 		=>	(wp_is_mobile()) ? 1 : 0,
															'is_rtl' 			=>	(is_rtl()) ? 1 : 0,
															'tooltip_theme'		=>	wpls_pro_get_option('tooltip_theme','punk'),
															'tooltip_animation'	=>	wpls_pro_get_option('tooltip_animation','grow'),
															'tooltip_behavior'	=>	wpls_pro_get_option('tooltip_behavior','hover'),
															'tooltip_arrow'		=>	wpls_pro_get_option('tooltip_arrow','true'),
															'tooltip_delay'		=>	wpls_pro_get_option('tooltip_delay'),
															'tooltip_distance'	=>	wpls_pro_get_option('tooltip_distance','6'),
															'tooltip_maxwidth'	=>	wpls_pro_get_option('tooltip_maxwidth'),
															'tooltip_minwidth'	=>	wpls_pro_get_option('tooltip_minwidth'),
														));
	}
	
	/**
	 * Function to add style at admin side
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_logoshowcase_admin_style( $hook ) {

		global $typenow;

		if( $typenow == WPLS_PRO_POST_TYPE ) {
			// Registring and enqueing admin css
			wp_register_style( 'wpls-pro-admin-style', WPLS_PRO_URL.'assets/css/wpls-pro-admin.css', array(), WPLS_PRO_VERSION );
			wp_enqueue_style( 'wpls-pro-admin-style');
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_logoshowcase_admin_script( $hook ) {
		
		global $wp_query, $post_type;

		// Logo sorting - only when sorting by menu order on the blog listing page
		if ( $post_type == WPLS_PRO_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
			wp_register_script( 'wpls-pro-ordering', WPLS_PRO_URL . 'assets/js/wpls-pro-ordering.js', array( 'jquery-ui-sortable' ), WPLS_PRO_VERSION, true );
			wp_enqueue_script( 'wpls-pro-ordering' );
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Logo Showcase Responsive Slider Pro
	 * @since 1.0.0
	 */
	function wpls_pro_add_custom_css() {
		
		$custom_css = wpls_pro_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wpls_script = new Wpls_Script();