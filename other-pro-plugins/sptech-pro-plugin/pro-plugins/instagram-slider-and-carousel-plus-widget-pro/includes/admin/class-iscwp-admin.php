<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Iscwp_Admin {

	function __construct() {

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'iscwp_pro_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'iscwp_pro_register_settings') );

		// Ajax call to update attachment data
		add_action( 'wp_ajax_iscwp_pro_clear_cache', array($this, 'iscwp_pro_clear_cache'));
		add_action( 'wp_ajax_nopriv_iscwp_pro_clear_cache',array( $this, 'iscwp_pro_clear_cache'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_iscwp_pro_clear_all_cache', array($this, 'iscwp_pro_clear_all_cache'));
		add_action( 'wp_ajax_nopriv_iscwp_pro_clear_all_cache',array( $this, 'iscwp_pro_clear_all_cache'));

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'iscwp_pro_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_register_menu() {
		add_menu_page( __('Insta Feed', 'instagram-slider-and-carousel-plus-widget').' - WPOS', __('Insta Feed', 'instagram-slider-and-carousel-plus-widget').' - WPOS', 'manage_options', 'iscwp-pro-settings', array($this, 'iscwp_pro_setting_page'), 'dashicons-camera' );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_setting_page() {
		include_once( ISCWP_PRO_DIR . '/includes/admin/settings/iscwp-pro-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_register_settings() {
		register_setting( 'iscwp_pro_plugin_options', 'iscwp_pro_options', array($this, 'iscwp_pro_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_validate_options( $input ) {

		$input['custom_css'] = isset($input['custom_css']) ? iscwp_pro_slashes_deep($input['custom_css'], true) : '';
				
		return $input;
	}

	/**
	 * delete user cache
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_clear_cache(){

		extract($_POST);

		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'instagram-slider-and-carousel-plus-widget');

		if(isset($user_name) && $user_name != '') {

			$transient 		= "wp_iscwp_media_{$user_name}";
			$dlt_transient 	= delete_transient( $transient );

			if( $dlt_transient ) {

				$users 				= get_option('wp_iscwp_cache_transient');
				$srch_user 			= array_search($transient, $users);

				unset($users[$srch_user]);

				update_option( 'wp_iscwp_cache_transient', $users );

				$result['success'] 	= 1;
				$result['msg'] 		= __('Cache Cleared', 'instagram-slider-and-carousel-plus-widget');
			}
		};

		echo json_encode($result);
		exit;
	}

	/**
	 * Fulsh all user cache
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_clear_all_cache(){

		extract($_POST);

		$result 			= array();
		$users 				= get_option('wp_iscwp_cache_transient');
		$result['success'] 	= 0;

		if( $users ) {

			foreach ($users as $transient) {

				delete_transient( $transient );

				$srch_user = array_search($transient, $users);
				unset($users[$srch_user]);

				update_option( 'wp_iscwp_cache_transient', $users);
			}

			$result['success'] 	= 1;
			$result['msg'] 		= __('Cache Cleared', 'instagram-slider-and-carousel-plus-widget');
		} else {
			$result['msg'] 		= __('Sorry, no data found', 'instagram-slider-and-carousel-plus-widget');
		}

		echo json_encode($result);
		exit;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package Instagram Slider and Carousel Plus Widget Pro
	 * @since 1.0
	 */
	function iscwp_pro_plugin_row_meta( $links, $file ) {

		if ( $file == ISCWP_PRO_PLUGIN_BASENAME ) {

			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-instagram-slider-and-carousel-plus-widget-pro') . '" title="' . esc_attr( __( 'View Documentation', 'instagram-slider-and-carousel-plus-widget' ) ) . '" target="_blank">' . __( 'Docs', 'instagram-slider-and-carousel-plus-widget' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'instagram-slider-and-carousel-plus-widget' ) ) . '" target="_blank">' . __( 'Support', 'instagram-slider-and-carousel-plus-widget' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$iscwp_admin = new Iscwp_Admin();