<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Bwsp_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'bwsp_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'bwsp_save_metabox_value') );

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'bwsp_register_menu') );

		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'bwsp_register_settings') );

		// Action to add custom column to Slider listing
		add_filter( 'manage_'.BWSPOS_PRO_POST_TYPE.'_posts_columns', array($this, 'bwsp_manage_posts_columns') );

		// Action to add custom column data to Slider listing
		add_action('manage_'.BWSPOS_PRO_POST_TYPE.'_posts_custom_column', array($this, 'bwsp_post_columns_data'), 10, 2); // priority, argument 

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'bwsp_add_post_row_action'), 10, 2 );

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'bwsp_plugin_row_meta' ), 10, 2 );
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_post_sett_metabox() {
		add_meta_box( 'bwsp-post-sett', __( 'Buttons With Style Pro - Settings', 'buttons-with-style' ), array($this, 'bwsp_post_sett_mb_content'), BWSPOS_PRO_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_post_sett_mb_content() {
		include_once( BWSWPOS_PRO_DIR .'/includes/admin/metabox/bwsp-post-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  BWSPOS_PRO_POST_TYPE ) )              				// Check if current post type is supported.
		{
		  return $post_id;
		}

		$prefix = BWSPOS_PRO_META_PREFIX; // Taking metabox prefix

		// Taking variables
		$choice_button_type = isset($_POST[$prefix.'choice_button_type']) 	? $_POST[$prefix.'choice_button_type'] 	: '';
		$button_type 		= isset($_POST[$prefix.'button_type']) 			? $_POST[$prefix.'button_type'] 		: '';
		$button_class 		= isset($_POST[$prefix.'button_class']) 		? $_POST[$prefix.'button_class'] 		: '';
		$button_style 		= isset($_POST[$prefix.'button_style']) 		? $_POST[$prefix.'button_style'] 		: '';
		$button_size 		= isset($_POST[$prefix.'button_size']) 			? $_POST[$prefix.'button_size'] 		: '';
		$button_icon_size 	= isset($_POST[$prefix.'button_icon_size']) 	? $_POST[$prefix.'button_icon_size'] 	: '';
		$button_link_target = isset($_POST[$prefix.'button_link_target']) 	? $_POST[$prefix.'button_link_target'] 	: '';

		// Simple button settings
		$button_name 			= isset($_POST[$prefix.'button_name']) 			? bwsp_slashes_deep($_POST[$prefix.'button_name']) 	: '';
		$button_link 			= isset($_POST[$prefix.'button_link']) 			? bwsp_slashes_deep($_POST[$prefix.'button_link']) 	: '';
		$button_icon_class 		= isset($_POST[$prefix.'button_icon_class']) 	? $_POST[$prefix.'button_icon_class'] 						: '';
		
		// group button settings
		$grp_btn_data 			= isset($_POST[$prefix.'grp_btn_data']) ? bwsp_slashes_deep($_POST[$prefix.'grp_btn_data']) : array();

		update_post_meta($post_id, $prefix.'choice_button_type', $choice_button_type);
		update_post_meta($post_id, $prefix.'button_name', $button_name);
		update_post_meta($post_id, $prefix.'button_link', $button_link);
		update_post_meta($post_id, $prefix.'button_type', $button_type);
		update_post_meta($post_id, $prefix.'grp_btn_data', $grp_btn_data);
		update_post_meta($post_id, $prefix.'button_class', $button_class);
		update_post_meta($post_id, $prefix.'button_style', $button_style);
		update_post_meta($post_id, $prefix.'button_size', $button_size);
		update_post_meta($post_id, $prefix.'button_icon_size', $button_icon_size);
		update_post_meta($post_id, $prefix.'button_icon_class', $button_icon_class);
		update_post_meta($post_id, $prefix.'button_link_target', $button_link_target);
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_register_menu() {
		add_submenu_page( 'edit.php?post_type='.BWSPOS_PRO_POST_TYPE, __('Settings', 'buttons-with-style'), __('Settings', 'buttons-with-style'), 'manage_options', 'bwspos-pro-settings', array($this, 'bwsp_settings_page') );
	}

	/**
	 * Function register setings
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_register_settings() {
		register_setting( 'bwsp_plugin_options', 'bwsp_options', array($this, 'bwsp_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_validate_options( $input ) {
		
		$input['custom_css'] = isset($input['custom_css']) 	? bwsp_slashes_deep($input['custom_css'], true) 	: '';
		
		return $input;
	}
	
	/**
	 * Function to handle the setting page html
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_settings_page() {
		include_once( BWSWPOS_PRO_DIR . '/includes/admin/settings/bwsp-settings.php' );
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_manage_posts_columns( $columns ) {

		$new_columns['bwsp_btn_type'] 	= __( 'Button Type', 'buttons-with-style' );
		$new_columns['bwsp_shortcode'] 	= __( 'Shortcode', 'buttons-with-style' );	   
$columns = bwsp_add_array( $columns, $new_columns, 1, true);
	    

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_post_columns_data( $column, $post_id ) {

		$prefix = BWSPOS_PRO_META_PREFIX; // Taking metabox prefix

	    switch ($column) {
			case 'bwsp_shortcode':			
				$shortcode_string = '';
				$shortcode_string .= '[bws_button id="'.$post_id.'"] <BR>';
				$shortcode_string .= '[bws_group_button id="'.$post_id.'"]';
				echo $shortcode_string;
				break;

			case 'bwsp_btn_type':
					$btn_type 			= bwsp_button_type();
					$choice_button_type = get_post_meta( $post_id, $prefix.'choice_button_type', true );
					$choice_button_type = isset($btn_type[$choice_button_type]) ? $btn_type[$choice_button_type] : __('Simple Button', 'buttons-with-style');
					echo $choice_button_type;
					break;
		}
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_add_post_row_action($actions, $post ) {
		if( $post->post_type == BWSPOS_PRO_POST_TYPE ) {
			return array_merge( array( 'bwsp_id' => 'ID: ' . $post->ID ), $actions );
		}
		return $actions;
	}
	
	/**
	 * Function to unique number value
	 * 
	 * @package Buttons With Style Pro
	 * @since 1.0.0
	 */
	function bwsp_plugin_row_meta( $links, $file ) {
		
		if ( $file == BWSWPOS_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-buttons-with-style-pro') . '" title="' . esc_attr( __( 'View Documentation', 'buttons-with-style' ) ) . '" target="_blank">' . __( 'Docs', 'buttons-with-style' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'buttons-with-style' ) ) . '" target="_blank">' . __( 'Support', 'buttons-with-style' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$bwsp_admin = new Bwsp_Admin();