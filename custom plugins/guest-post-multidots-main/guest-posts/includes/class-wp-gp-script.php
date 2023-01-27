<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Guest Posts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class WP_gp_Script{
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_gp_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_gp_front_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package Guest Posts
	 * @since 1.0
	 */
	function wp_gp_front_style() {

		// Registring and enqueing public css
		wp_register_style( 'wp-gp-public-css', WP_GP_URL.'assets/css/wp-gp-public.css', null, WP_GP_VERSION );
		wp_enqueue_style( 'wp-gp-public-css' );
	}
	
	/**
	 * Function to add script at front side
	 * 
	 * @package Guest Posts
	 * @since 1.0
	 */
	function wp_gp_front_script() {
		
		// Registring public script
		wp_register_script( 'wp-gp-public-js', WP_GP_URL.'assets/js/wp-gp-public.js', array('jquery'), WP_GP_VERSION, true );
		wp_localize_script( 'wp-gp-public-js', 'Wpgp', array('ajax_url' => admin_url('admin-ajax.php')) );
		wp_enqueue_script('wp-gp-public-js');
	}

}

$wp_gp_script = new WP_gp_Script();