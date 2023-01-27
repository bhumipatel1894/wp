<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Meta slider and carousel with lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class WP_Igsp_pro_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_igsp_pro_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_igsp_pro_front_script') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wp_igsp_pro_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_igsp_pro_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wp_igsp_pro_add_custom_css'), 20 );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Meta slider and carousel with lightbox
	 * @since 1.0.0
	 */
	function wp_igsp_pro_front_style() {

		// Registring and enqueing magnific css
		if( !wp_style_is( 'wpos-magnific-style', 'registered' ) ) {
			wp_register_style( 'wpos-magnific-style', WP_IGSP_PRO_URL.'assets/css/magnific-popup.css', array(), WP_IGSP_PRO_VERSION );
			wp_enqueue_style( 'wpos-magnific-style');
		}

		// Registring and enqueing slick css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WP_IGSP_PRO_URL.'assets/css/slick.css', array(), WP_IGSP_PRO_VERSION );
			wp_enqueue_style( 'wpos-slick-style');
		}
		
		// Registring and enqueing public css
		wp_register_style( 'wp-igsp-public-css', WP_IGSP_PRO_URL.'assets/css/wp-igsp-pro-public.css', null, WP_IGSP_PRO_VERSION );
		wp_enqueue_style( 'wp-igsp-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Meta slider and carousel with lightbox
	 * @since 1.0.0
	 */
	function wp_igsp_pro_front_script() {

		// Registring magnific popup script
		if( !wp_script_is( 'wpos-magnific-script', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-script', WP_IGSP_PRO_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), WP_IGSP_PRO_VERSION, true );
		}
		
		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WP_IGSP_PRO_URL.'assets/js/slick.min.js', array('jquery'), WP_IGSP_PRO_VERSION, true );
		}

		// Registring public script
		wp_register_script( 'wp-igsp-public-js', WP_IGSP_PRO_URL.'assets/js/wp-igsp-pro-public.js', array('jquery'), WP_IGSP_PRO_VERSION, true );
		wp_localize_script( 'wp-igsp-public-js', 'WpIsgp', array(
															'is_mobile' 		=>	(wp_is_mobile()) 	? 1 : 0,
															'is_rtl' 			=>	(is_rtl()) 			? 1 : 0,
														));
	}
	
	/**
	 * Enqueue admin styles
	 * 
	 * @package Meta slider and carousel with lightbox
	 * @since 1.0.0
	 */
	function wp_igsp_pro_admin_style( $hook ) {

		global $post_type, $typenow;
		
		$registered_posts = wp_igsp_pro_get_post_types(); // Getting registered post types

		// If page is plugin setting page then enqueue script
		if( in_array($post_type, $registered_posts) ) {
			
			// Registring admin script
			wp_register_style( 'wp-igsp-admin-style', WP_IGSP_PRO_URL.'assets/css/wp-igsp-pro-admin.css', null, WP_IGSP_PRO_VERSION );
			wp_enqueue_style( 'wp-igsp-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Meta slider and carousel with lightbox
	 * @since 1.0.0
	 */
	function wp_igsp_pro_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $typenow, $post_type;
		
		$registered_posts = wp_igsp_pro_get_post_types(); // Getting registered post types
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
		
		if( in_array($post_type, $registered_posts) ) {

			// Enqueue required inbuilt sctipt
			wp_enqueue_script( 'jquery-ui-sortable' );

			// Registring admin script
			wp_register_script( 'wp-igsp-admin-script', WP_IGSP_PRO_URL.'assets/js/wp-igsp-pro-admin.js', array('jquery'), WP_IGSP_PRO_VERSION, true );
			wp_localize_script( 'wp-igsp-admin-script', 'WpIgspProAdmin', array(
																	'new_ui' 				=>	$new_ui,
																	'img_edit_popup_text'	=> __('Edit Image in Popup', 'meta-slider-and-carousel-with-lightbox'),
																	'attachment_edit_text'	=> __('Edit Image', 'meta-slider-and-carousel-with-lightbox'),
																	'img_delete_text'		=> __('Remove Image', 'meta-slider-and-carousel-with-lightbox'),
																	'all_img_delete_text'	=> __('Are you sure to remove all images from this gallery!', 'meta-slider-and-carousel-with-lightbox'),
																));
			wp_enqueue_script( 'wp-igsp-admin-script' );
			wp_enqueue_media(); // For media uploader
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package Meta slider and carousel with lightbox
	 * @since 1.0.0
	 */
	function wp_igsp_pro_add_custom_css() {

		$custom_css = wp_igsp_pro_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$wp_igsp_pro_script = new WP_Igsp_pro_Script();