<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bwsp_Script {

	function __construct() {

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'bwsp_front_style') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'bwsp_admin_style') );
		
		// Action to add script in backend
		add_action( 'admin_enqueue_scripts', array($this, 'bwsp_admin_script') );
		
		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'bwsp_add_custom_css'), 20 );
	}
	
	/**
	 * Function to add style at front side
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_front_style() {

		// Registring and enqueing public css
		if( !wp_style_is( 'wpos-foundation-style', 'registered' ) ) {
			wp_register_style( 'wpos-foundation-style', BWSWPOS_PRO_URL.'assets/css/foundation-icons.css', array(), BWSWPOS_PRO_VERSION );
			wp_enqueue_style( 'wpos-foundation-style' );
		}

		// Registring and enqueing button with style pro css
		wp_register_style( 'bwsp-public-style', BWSWPOS_PRO_URL.'assets/css/bwsp-public-style.css', array(), BWSWPOS_PRO_VERSION );
		wp_enqueue_style( 'bwsp-public-style' );
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_admin_style( $hook ) {

		global $typenow;
		//echo " rhffffffffffffffffffff     dhg        hf :type now = ".$typenow; // return post type
		//echo "hook Name Is = " .$hook; // return slug name last var 
		
		// Taking pages array
		$pages_arr = array( BWSPOS_PRO_POST_TYPE,'shop_order' ); // array of pages in which css has to display ex. post types with coma seperators
		// hook used to compare page and typenow used to compare post type 
		if( in_array($typenow, $pages_arr) ) { // compare current page post type and post type in array 
			wp_register_style( 'bwso-admin-style', BWSWPOS_PRO_URL.'assets/css/bwsp-admin-style.css', array(), BWSWPOS_PRO_VERSION );
			wp_enqueue_style( 'bwso-admin-style' );
		}

		if( $typenow == 'shop_order')  {
			wp_register_style( 'bwso-admin-style2', BWSWPOS_PRO_URL.'assets/css/bwsp-admin-style2.css', array(), BWSWPOS_PRO_VERSION );
			wp_enqueue_style( 'bwso-admin-style2' );
		}
	}

	/**
	 * Enqueue admin script
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_admin_script( $hook ) {

		global $typenow;

		// Taking pages array
		$pages_arr = array( BWSPOS_PRO_POST_TYPE );

		if( in_array($typenow, $pages_arr) ) {
			
			// Registring admin script
			wp_register_script( 'bwsp-admin-script', BWSWPOS_PRO_URL.'assets/js/bwsp-admin-script.js', array('jquery'), BWSWPOS_PRO_VERSION, true );
			wp_enqueue_script( 'bwsp-admin-script' );
			// localize for declare variabl for javascript
			wp_localize_script( 'bwsp-admin-script', 'BwspAdmin', array(
																		'sry_msg' => __('Sorry, One entry should be there.', 'buttons-with-style'),
																	));
		}
	}

	/**
	 * Add custom css to head
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_add_custom_css() {

		$custom_css = bwsp_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";

			echo $css;
		}
	}
}

$bwsp_script = new Bwsp_Script();