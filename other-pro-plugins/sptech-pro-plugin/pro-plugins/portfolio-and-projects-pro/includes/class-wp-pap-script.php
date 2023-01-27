<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class WP_Pap_Pro_Script{
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_pap_pro_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_pap_pro_front_script') );
		
		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wp_pap_pro_admin_style') );
		
		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_pap_pro_admin_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_front_style() {


		// Registring and enqueing slick css		
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WP_PAP_PRO_URL.'assets/css/slick.css', array(), WP_PAP_PRO_VERSION );
			wp_enqueue_style( 'wpos-slick-style');	
		}

		// Registring and enqueing magnific css
		if( !wp_style_is( 'wpos-magnific-style', 'registered' ) ) {
			wp_register_style( 'wpos-magnific-style', WP_PAP_PRO_URL.'assets/css/magnific-popup.css', array(), WP_PAP_PRO_VERSION );
			wp_enqueue_style( 'wpos-magnific-style');
		}

		// Registring and enqueing public css
		wp_register_style( 'wp-pap-public-css', WP_PAP_PRO_URL.'assets/css/wp-pap-public.css', null, WP_PAP_PRO_VERSION );
		wp_enqueue_style( 'wp-pap-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_front_script() {

		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WP_PAP_PRO_URL. 'assets/js/slick.min.js', array('jquery'), WP_PAP_PRO_VERSION, true);
		}

		// Registring magnific popup script
		if( !wp_script_is( 'wpos-magnific-script', 'registered' ) ) {
			wp_register_script( 'wpos-magnific-script', WP_PAP_PRO_URL.'assets/js/jquery.magnific-popup.min.js', array('jquery'), WP_PAP_PRO_VERSION, true );
		}
		
		// Registring portfolio script
		wp_register_script( 'wp-pap-portfolio-js', WP_PAP_PRO_URL.'assets/js/wp-pap-portfolio.js', array('jquery'), WP_PAP_PRO_VERSION, true );

		// Registring public script
		wp_register_script( 'wp-pap-public-js', WP_PAP_PRO_URL.'assets/js/wp-pap-public.js', array('jquery'), WP_PAP_PRO_VERSION, true );
		wp_localize_script( 'wp-pap-public-js', 'WpPap', array(
															'is_mobile' 		=>	(wp_is_mobile()) 			? 1 : 0,
															'is_old_browser'	=> 	wp_pap_pro_old_browser() 	? 1 : 0,
														));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_admin_style( $hook ) {

		global $post_type;
		
		$registered_posts = array(WP_PAP_PRO_POST_TYPE); // Getting registered post types

		// If page is plugin setting page then enqueue script
		if( in_array($post_type, $registered_posts) ) {
			
			// Registring admin script
			wp_register_style( 'wp-pap-admin-style', WP_PAP_PRO_URL.'assets/css/wp-pap-admin.css', null, WP_PAP_PRO_VERSION );
			wp_enqueue_style( 'wp-pap-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Portfolio and Projects Pro
	 * @since 1.0
	 */
	function wp_pap_pro_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;
		
		$registered_posts 	= array(WP_PAP_PRO_POST_TYPE); // Getting registered post types
		$new_ui 			= $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
		
		if( in_array($post_type, $registered_posts) ) {

			// Enqueue required inbuilt sctipt
			wp_enqueue_script( 'jquery-ui-sortable' );

			// Registring admin script
			wp_register_script( 'wp-pap-admin-script', WP_PAP_PRO_URL.'assets/js/wp-pap-admin.js', array('jquery'), WP_PAP_PRO_VERSION, true );
			wp_localize_script( 'wp-pap-admin-script', 'WppapAdmin', array(
																	'new_ui' 				=>	$new_ui,
																	'img_edit_popup_text'	=> __('Edit Image in Popup', 'portfolio-and-projects'),
																	'attachment_edit_text'	=> __('Edit Image', 'portfolio-and-projects'),
																	'img_delete_text'		=> __('Remove Image', 'portfolio-and-projects'),
																	'all_img_delete_text'	=> __('Are you sure to remove all images from this gallery!', 'portfolio-and-projects'),
																));
			wp_enqueue_script( 'wp-pap-admin-script' );
			wp_enqueue_media(); // For media uploader

			// Slider sorting - only when sorting by menu order on the blog listing page
			if ( $post_type == WP_PAP_PRO_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
				wp_register_script( 'wp-pap-pro-ordering', WP_PAP_PRO_URL . 'assets/js/wp-pap-pro-ordering.js', array( 'jquery-ui-sortable' ), WP_PAP_PRO_VERSION, true );
				wp_enqueue_script( 'wp-pap-pro-ordering' );
			}
		}
	}
}

$wp_pap_pro_script = new WP_Pap_Pro_Script();