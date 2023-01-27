<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpcdt_Pro_Admin {
	
	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wpcdt_pro_post_sett_metabox') );
		
		// Action to save metabox
		add_action( 'save_post', array($this, 'wpcdt_pro_save_metabox_value') );
		
		// Action to add custom column to Timer listing
		add_filter( 'manage_'.WPCDT_PRO_POST_TYPE.'_posts_columns', array($this, 'wpcdt_pro_posts_columns') );
		
		// Action to add custom column data to Timer listing
		add_action('manage_'.WPCDT_PRO_POST_TYPE.'_posts_custom_column', array($this, 'wpcdt_pro_post_columns_data'), 10, 2);

		// Action to register admin menu
		add_action( 'admin_menu', array($this, 'wpcdt_pro_register_menu'), 9 );
		
		// Action to register plugin settings
		add_action ( 'admin_init', array($this, 'wpcdt_pro_register_settings') );

		// Filter to add plugin links
		add_filter( 'plugin_row_meta', array( $this, 'wpcdt_pro_plugin_row_meta' ), 10, 2 );		
	}
	
	/**
	 * Post Settings Metabox
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_post_sett_metabox() {
		
		// Settings Metabox
		add_meta_box( 'wpcdt-post-sett', __( 'Countdown Timer Ultimate Pro - Settings', 'countdown-timer-ultimate' ), array($this, 'wpcdt_pro_post_sett_mb_content'), WPCDT_PRO_POST_TYPE, 'normal', 'high' );

		// Ecommerce settings metabox
		if ( class_exists( 'WooCommerce' ) || class_exists( 'Easy_Digital_Downloads' ) ) {
			add_meta_box( 'wpcdt-post-ecommerce-sett', __( 'Countdown Timer Ultimate Pro - E-commerce Settings', 'countdown-timer-ultimate' ), array($this, 'wpcdt_pro_post_ecommerce_sett_mb_content'), WPCDT_PRO_POST_TYPE, 'normal', 'high' );
		}
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_post_sett_mb_content() {
		include_once( WPCDT_PRO_DIR .'/includes/admin/metabox/wpcdt-sett-metabox.php');
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_post_ecommerce_sett_mb_content() {
		include_once( WPCDT_PRO_DIR .'/includes/admin/metabox/wpcdt-ecommerce-sett-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_save_metabox_value( $post_id ) {

		global $post_type;
		
		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( $post_type !=  WPCDT_PRO_POST_TYPE ) )              					// Check if current post type is supported.
		{
		  return $post_id;
		}
		
		$prefix = WPCDT_PRO_META_PREFIX; // Taking metabox prefix
		
		// Choosing Style
		$style 					= isset($_POST[$prefix.'design_style']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'design_style']) 				 : '';
		$completion_text		= isset($_POST[$prefix.'completion_text']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'completion_text']) 			 : '';
		$background_pref 		= isset($_POST[$prefix.'background_pref']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'background_pref']) 			 : '';
		$show_title 			= isset($_POST[$prefix.'show_title']) 					? wpcdt_pro_slashes_deep($_POST[$prefix.'show_title']) 			 		 : '';
		
		//E-Commerce Meta Value
		$is_ecommerce			= !empty($_POST[$prefix.'is_ecommerce']) 				? 1 																	 : 0;
		
		//Woo Meta Value
		$woo_coupons_dropdown 	= isset($_POST[$prefix.'woo_coupons_dropdown']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'woo_coupons_dropdown']) 		 : '';

		//EDD Meta Value
		$edd_coupons_dropdown 	= isset($_POST[$prefix.'edd_coupons_dropdown']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'edd_coupons_dropdown']) 		 : '';

		// Circle Meta Value
		$date 					= isset($_POST[$prefix.'timer_date']) 					? wpcdt_pro_slashes_deep($_POST[$prefix.'timer_date']) 					 : '';
		$animation 				= isset($_POST[$prefix.'timercircle_animation']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'timercircle_animation']) 		 : '';
		$circlewidth			= isset($_POST[$prefix.'timercircle_width']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'timercircle_width']) 			 : '';
		$backgroundwidth		= isset($_POST[$prefix.'timerbackground_width']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'timerbackground_width']) 		 : '';
		$textcolor				= isset($_POST[$prefix.'timertext_color']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'timertext_color']) 		 	 : '';
		$digitcolor				= isset($_POST[$prefix.'timerdigit_color']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'timerdigit_color']) 		 	 : '';
		$backgroundcolor		= isset($_POST[$prefix.'timerbackground_color']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'timerbackground_color']) 		 : '';
		$timer_width 			= isset($_POST[$prefix.'timer_width']) 					? wpcdt_pro_slashes_deep($_POST[$prefix.'timer_width']) 				 : '';
		$is_days				= !empty($_POST[$prefix.'is_timerdays']) 				? 1 																	 : 0;
		$days_text 				= isset($_POST[$prefix.'timer_day_text']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'timer_day_text']) : 'Days';
		$daysbackgroundcolor	= isset($_POST[$prefix.'timerdaysbackground_color']) 	? wpcdt_pro_slashes_deep($_POST[$prefix.'timerdaysbackground_color']) 	 : '';
		$is_hours				= !empty($_POST[$prefix.'is_timerhours']) 				? 1 																	 : 0;
		$hours_text 			= isset($_POST[$prefix.'timer_hour_text']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'timer_hour_text']) : 'Hours';
		$hoursbackgroundcolor	= isset($_POST[$prefix.'timerhoursbackground_color']) 	? wpcdt_pro_slashes_deep($_POST[$prefix.'timerhoursbackground_color']) 	 : '';
		$is_minutes				= !empty($_POST[$prefix.'is_timerminutes']) 			? 1 																	 : 0;
		$minutes_text 			= isset($_POST[$prefix.'timer_minute_text']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'timer_minute_text']) : 'Minutes';
		$minutesbackgroundcolor	= isset($_POST[$prefix.'timerminutesbackground_color']) ? wpcdt_pro_slashes_deep($_POST[$prefix.'timerminutesbackground_color']) : '';
		$is_seconds				= !empty($_POST[$prefix.'is_timerseconds']) 			? 1 																	 : 0;
		$seconds_text 			= isset($_POST[$prefix.'timer_second_text']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'timer_second_text']) : 'Seconds';
		$secondsbackgroundcolor	= isset($_POST[$prefix.'timersecondsbackground_color']) ? wpcdt_pro_slashes_deep($_POST[$prefix.'timersecondsbackground_color']) : '';

		// Circle 2 Meta Value
		$circle2width					= isset($_POST[$prefix.'timercircle2_width']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'timercircle2_width']) 		 : '';
		$circle2backgroundcolor 		= isset($_POST[$prefix.'timer2background_color']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'timer2background_color']) 		 : '';
		$circle2daysbackgroundcolor 	= isset($_POST[$prefix.'timer2daysbackground_color']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'timer2daysbackground_color']) 		 : ''; 
		$cieclr2hoursbackgroundcolor 	= isset($_POST[$prefix.'timer2hoursbackground_color']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'timer2hoursbackground_color']) 		 : '';
		$circle2minutesbackgroundcolor 	= isset($_POST[$prefix.'timer2minutesbackground_color']) 	? wpcdt_pro_slashes_deep($_POST[$prefix.'timer2minutesbackground_color']) 		 : '';
		$circle2secondsbackgroundcolor 	= isset($_POST[$prefix.'timer2secondsbackground_color']) 	? wpcdt_pro_slashes_deep($_POST[$prefix.'timer2secondsbackground_color']) 		 : '';

		// Vertical Meta Value
		$verticalbackgroundcolor 		= isset($_POST[$prefix.'verticalbackground_color']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'verticalbackground_color']) 		 : '';

		// Horizontal Meta Value
		$horizontalbackgroundcolor 		= isset($_POST[$prefix.'horizontalbackground_color']) 		? wpcdt_pro_slashes_deep($_POST[$prefix.'horizontalbackground_color']) 		 : '';
		
		// Rounded Clock options
		$roundedcirclecolor 			= isset($_POST[$prefix.'round_circle_color']) 				? wpcdt_pro_slashes_deep($_POST[$prefix.'round_circle_color']) 		 : '';

		// Rounded Clock options
		$barbackgroundcolor 			= isset($_POST[$prefix.'bar_background_color']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'bar_background_color']) 		 : '';
		$barfillcolor 					= isset($_POST[$prefix.'bar_fill_color']) 					? wpcdt_pro_slashes_deep($_POST[$prefix.'bar_fill_color']) 		 : '';

		// Night Clock options
		$nightseparatorcolor 			= isset($_POST[$prefix.'night_separator_color']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'night_separator_color']) 		 : '';

		// Modern Clock options
		$modernseparatorcolor 			= isset($_POST[$prefix.'modern_separator_color']) 			? wpcdt_pro_slashes_deep($_POST[$prefix.'modern_separator_color']) 		 : '';

		// Shadow options
		$shadow1color 					= isset($_POST[$prefix.'shadow1_color']) 					? wpcdt_pro_slashes_deep($_POST[$prefix.'shadow1_color']) 		 : '';
		$shadow2color 					= isset($_POST[$prefix.'shadow2_color']) 					? wpcdt_pro_slashes_deep($_POST[$prefix.'shadow2_color']) 		 : '';

		// Style option update
		update_post_meta($post_id, $prefix.'design_style', $style);
		update_post_meta($post_id, $prefix.'completion_text', $completion_text);
		update_post_meta($post_id, $prefix.'background_pref', $background_pref);
		update_post_meta($post_id, $prefix.'show_title', $show_title);

		//E-Commerce option update
		update_post_meta($post_id, $prefix.'is_ecommerce', $is_ecommerce);

		//Woo option update
		update_post_meta($post_id, $prefix.'woo_coupons_dropdown', $woo_coupons_dropdown);

		//EDD option update
		update_post_meta($post_id, $prefix.'edd_coupons_dropdown', $edd_coupons_dropdown);

		// Circle option update
		update_post_meta($post_id, $prefix.'timer_date', $date);
		update_post_meta($post_id, $prefix.'timercircle_animation', $animation);
		update_post_meta($post_id, $prefix.'timercircle_width', $circlewidth);
		update_post_meta($post_id, $prefix.'timerbackground_width', $backgroundwidth);
		update_post_meta($post_id, $prefix.'timertext_color', $textcolor);
		update_post_meta($post_id, $prefix.'timerdigit_color', $digitcolor);
		update_post_meta($post_id, $prefix.'timerbackground_color', $backgroundcolor);
		update_post_meta($post_id, $prefix.'timer_width', $timer_width);
		update_post_meta($post_id, $prefix.'is_timerhours', $is_hours);
		update_post_meta($post_id, $prefix.'timer_hour_text', $hours_text);
		update_post_meta($post_id, $prefix.'timerdaysbackground_color', $daysbackgroundcolor);
		update_post_meta($post_id, $prefix.'is_timerdays', $is_days);
		update_post_meta($post_id, $prefix.'timer_day_text', $days_text);
		update_post_meta($post_id, $prefix.'timerhoursbackground_color', $hoursbackgroundcolor);
		update_post_meta($post_id, $prefix.'is_timerminutes', $is_minutes);
		update_post_meta($post_id, $prefix.'timer_minute_text', $minutes_text);
		update_post_meta($post_id, $prefix.'timerminutesbackground_color', $minutesbackgroundcolor);
		update_post_meta($post_id, $prefix.'is_timerseconds', $is_seconds);
		update_post_meta($post_id, $prefix.'timer_second_text', $seconds_text);
		update_post_meta($post_id, $prefix.'timersecondsbackground_color', $secondsbackgroundcolor);

		// Circle 2 option update
		update_post_meta($post_id, $prefix.'timercircle2_width', $circle2width);
		update_post_meta($post_id, $prefix.'timer2background_color', $circle2backgroundcolor);
		update_post_meta($post_id, $prefix.'timer2daysbackground_color', $circle2daysbackgroundcolor);
		update_post_meta($post_id, $prefix.'timer2hoursbackground_color', $cieclr2hoursbackgroundcolor);
		update_post_meta($post_id, $prefix.'timer2minutesbackground_color', $circle2minutesbackgroundcolor);
		update_post_meta($post_id, $prefix.'timer2secondsbackground_color', $circle2secondsbackgroundcolor);

		// Vertical option update
		update_post_meta($post_id, $prefix.'verticalbackground_color', $verticalbackgroundcolor);

		// Horizontal option update
		update_post_meta($post_id, $prefix.'horizontalbackground_color', $horizontalbackgroundcolor);

		// Rounded option update
		update_post_meta($post_id, $prefix.'round_circle_color', $roundedcirclecolor);

		// Bar options update
		update_post_meta($post_id, $prefix.'bar_background_color', $barbackgroundcolor);
		update_post_meta($post_id, $prefix.'bar_fill_color', $barfillcolor);

		// Night options update
		update_post_meta($post_id, $prefix.'night_separator_color', $nightseparatorcolor);

		// Modern options update
		update_post_meta($post_id, $prefix.'modern_separator_color', $modernseparatorcolor);

		// Shadow options update
		update_post_meta($post_id, $prefix.'shadow1_color', $shadow1color);
		update_post_meta($post_id, $prefix.'shadow2_color', $shadow2color);
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_posts_columns( $columns ) {

	    $new_columns['wpcdt_shortcode'] = __('Shortcode', 'countdown-timer-ultimate');
	    
	    $columns = wpcdt_pro_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_post_columns_data( $column, $post_id ) {

		// Taking some variables
		$prefix = WPCDT_PRO_META_PREFIX;

	    switch ($column) {
	    	case 'wpcdt_shortcode':
	    		
	    		echo '<div class="wpcdt-shortcode-preview">[wpcdt-countdown id="'.$post_id.'"]</div> <br/>';
	    		break;
		}
	}

	/**
	 * Function to register admin menus
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_register_menu() {
		add_submenu_page( 'edit.php?post_type='.WPCDT_PRO_POST_TYPE, __('Settings', 'countdown-timer-ultimate'), __('Settings', 'countdown-timer-ultimate'), 'manage_options', 'wpcdt-pro-settings', array($this, 'wpcdt_pro_settings_page') );
	}

	/**
	 * Function to handle the setting page html
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_settings_page() {
		include_once( WPCDT_PRO_DIR . '/includes/admin/settings/wpcdt-settings.php' );
	}

	/**
	 * Function register setings
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_register_settings() {
		register_setting( 'wpcdt_pro_plugin_options', 'wpcdt_pro_options', array($this, 'wpcdt_pro_validate_options') );
	}

	/**
	 * Validate Settings Options
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_validate_options( $input ) {

		$input['custom_css'] 	= isset($input['custom_css']) ? wpcdt_pro_slashes_deep($input['custom_css'], true) 	: '';
		return $input;
	}

	/**
	 * Function to unique number value
	 * 
	 * @package Countdown Timer Ultimate Pro
	 * @since 1.0.0
	 */
	function wpcdt_pro_plugin_row_meta( $links, $file ) {
		
		if ( $file == WPCDT_PRO_PLUGIN_BASENAME ) {
			
			$row_meta = array(
				'docs'    => '<a href="' . esc_url('https://www.wponlinesupport.com/pro-plugin-document/document-countdown-timer-ultimate-pro/') . '" title="' . esc_attr( __( 'View Documentation', 'countdown-timer-ultimate' ) ) . '" target="_blank">' . __( 'Docs', 'countdown-timer-ultimate' ) . '</a>',
				'support' => '<a href="' . esc_url('https://www.wponlinesupport.com/welcome-wp-online-support-forum/') . '" title="' . esc_attr( __( 'Visit Customer Support Forum', 'countdown-timer-ultimate' ) ) . '" target="_blank">' . __( 'Support', 'countdown-timer-ultimate' ) . '</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}

$wpcdt_pro_admin = new Wpcdt_Pro_Admin();