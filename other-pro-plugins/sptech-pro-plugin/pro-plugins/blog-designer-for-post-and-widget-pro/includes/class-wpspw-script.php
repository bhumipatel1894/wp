<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wpspw_Pro_Script {
	
	function __construct() {
		
		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpspw_pro_front_style') );
		
		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wpspw_pro_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wpspw_pro_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wpspw_pro_admin_script') );

		// Action to add custom css in head
		add_action( 'wp_head', array($this, 'wpspw_pro_custom_css'), 20 );
	}


	/**
	 * Function to add style at front side
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.4
	 */
	function wpspw_pro_front_style() {

		// Registring and enqueing slick slider css
		if( !wp_style_is( 'wpos-slick-style', 'registered' ) ) {
			wp_register_style( 'wpos-slick-style', WPSPW_PRO_URL.'assets/css/slick.css', array(), WPSPW_PRO_VERSION );
			wp_enqueue_style( 'wpos-slick-style' );
		}

		// Registring and enqueing public css
		wp_register_style( 'wpspw-pro-public-style', WPSPW_PRO_URL.'assets/css/wpspw-pro-public.css', array(), WPSPW_PRO_VERSION );
		wp_enqueue_style( 'wpspw-pro-public-style' );
	}

	/**
	 * Function to add script at front side
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_front_script() {

		// Registring slick slider script
		if( !wp_script_is( 'wpos-slick-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-slick-jquery', WPSPW_PRO_URL. 'assets/js/slick.min.js', array('jquery'), WPSPW_PRO_VERSION, true);
		}
		
		// Registring post vertical ticker script
		if( !wp_script_is( 'wpos-vticker-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-vticker-jquery', WPSPW_PRO_URL. 'assets/js/post-ticker.js', array('jquery'), WPSPW_PRO_VERSION, true);
		}

		// Registring ticker script
		if( !wp_script_is( 'wpos-ticker-script', 'registered' ) ) {
			wp_register_script( 'wpos-ticker-script', WPSPW_PRO_URL . 'assets/js/wpspw-ticker.js', array('jquery'), WPSPW_PRO_VERSION, true );
		}
		
		// Registring and enqueing public script
		wp_register_script( 'wpspw-pro-public-script', WPSPW_PRO_URL. 'assets/js/wpspw-pro-public.js', array('jquery'), WPSPW_PRO_VERSION, true );
		wp_localize_script( 'wpspw-pro-public-script', 'WpspwPro', array(
																		'is_mobile' => (wp_is_mobile()) ? 1 : 0,
																		'is_rtl' 	=> (is_rtl()) ? 1 : 0
																	));
	}

	/**
	 * Enqueue admin styles
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_admin_style( $hook ) {

		// Pages array
		$pages_array = array( 'posts_page_wpspw-pro-settings' );

		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {

			// Enqueu built in style for color picker
			if( wp_style_is( 'wp-color-picker', 'registered' ) ) { // Since WordPress 3.5
				wp_enqueue_style( 'wp-color-picker' );
			} else {
				wp_enqueue_style( 'farbtastic' );
			}

			// Registring admin script
			wp_register_style( 'wpspw-pro-admin-css', WPSPW_PRO_URL.'assets/css/wpspw-pro-admin.css', null, WPSPW_PRO_VERSION );
			wp_enqueue_style( 'wpspw-pro-admin-css' );
		}
	}
	

	/**
	 * Function to add script at admin side
	 * 
	 * @package Blog Designer - Post and Widget Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_admin_script( $hook ) {
		
		global $wp_version, $wp_query, $post_type;
		
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts
		
		// Pages array
		$pages_array = array( 'posts_page_wpspw-pro-settings' );
		
		// If page is plugin setting page then enqueue script
		if( in_array($hook, $pages_array) ) {
			
			// Enqueu built-in script for color picker
			if( wp_script_is( 'wp-color-picker', 'registered' ) ) { // Since WordPress 3.5
				wp_enqueue_script( 'wp-color-picker' );
			} else {
				wp_enqueue_script( 'farbtastic' );
			}
			
			// Registring admin script
			wp_register_script( 'wpspw-pro-admin-js', WPSPW_PRO_URL.'assets/js/wpspw-pro-admin.js', array('jquery'), WPSPW_PRO_VERSION, true );
			wp_localize_script( 'wpspw-pro-admin-js', 'WpspwProAdmin', array(
																	'new_ui' 	=> $new_ui,
																	'reset_msg'	=> __('Click OK to reset all options. All settings will be lost!', 'blog-designer-for-post-and-widget'),
																));
			wp_enqueue_script( 'wpspw-pro-admin-js' );
			wp_enqueue_media(); // For media uploader
		}

		// Post sorting - only when sorting by menu order on the Post listing page
	    if ( $post_type == WPSPW_POST_TYPE && isset( $wp_query->query['orderby'] ) && $wp_query->query['orderby'] == 'menu_order title' ) {
	        wp_register_script( 'wpspw-pro-ordering', WPSPW_PRO_URL . 'assets/js/wpspw-pro-ordering.js', array( 'jquery-ui-sortable' ), WPSPW_PRO_VERSION, true );
	        wp_enqueue_script( 'wpspw-pro-ordering' );
	    }
	}

	/**
	 * Add custom css to head
	 * 
	 * @package WP Stylist Post and Widgets Pro
	 * @since 1.0.0
	 */
	function wpspw_pro_custom_css() {
		
		// Plugin settings CSS
		$post_title_color 		= wpspw_pro_get_option('post_title_color');
		$title_font_size 		= wpspw_pro_get_option('post_title_font_size');
		$post_cat_bg_clr 		= wpspw_pro_get_option('post_cat_bg_clr');
		$post_cat_hbg_clr 		= wpspw_pro_get_option('post_cat_hbg_clr');
		$post_cat_font_clr 		= wpspw_pro_get_option('post_cat_font_clr');
		$post_cat_hfont_clr 	= wpspw_pro_get_option('post_cat_hfont_clr');
		$read_more_bg_clr 		= wpspw_pro_get_option('read_more_bg_clr');
		$read_more_hbg_clr 		= wpspw_pro_get_option('read_more_hbg_clr');
		$read_more_font_clr 	= wpspw_pro_get_option('read_more_font_clr');
		$read_more_hfont_clr 	= wpspw_pro_get_option('read_more_hfont_clr');
		$post_cat_font_size 	= wpspw_pro_get_option('post_cat_font_size');
		$read_more_font_size 	= wpspw_pro_get_option('read_more_font_size');
		
		$sett_css  = '<style type="text/css">' . "\n";
		
		// Post title css
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-grid .wpspw-post-title a,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list .wpspw-post-title a,';
		$sett_css .= '.sp_wpspwpost_static .wpspwpost-block .wpspw-post-title a,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list-content .wpspw-post-title a,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-slides .wpspw-post-title a,';
		$sett_css .= '.sp_wpspwpost_slider .wpspw-post-slides h2.wpspw-post-title a,';
		$sett_css .= '.sp_wpspwpost_slider .wpspw-post-list h2.wpspw-post-title a{';
		$sett_css .= (!empty($post_title_color)) ? "color:{$post_title_color};" : '';
		$sett_css .= (!empty($title_font_size)) ? "font-size:{$title_font_size}px !important;" : '';
		$sett_css .= '}';

		// Post category css
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-grid .wpspw-post-categories a, .sp_wpspwpost_static .wpspw-post-list .wpspw-post-categories a,';
		$sett_css .= '.sp_wpspwpost_static .wpspwpost-block .wpspw-post-categories a,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list-content .wpspw-post-categories a,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-slides .wpspw-post-categories a,';
		$sett_css .= '.wpspw-post-slider .wpspw-post-slides .wpspw-post-categories a, .wpspw-post-slider .wpspw-post-list .wpspw-post-categories a{';
		$sett_css .= (!empty($post_cat_bg_clr)) ? "background:{$post_cat_bg_clr} !important;" : '';
		$sett_css .= (!empty($post_cat_font_clr)) ? "color:{$post_cat_font_clr} !important;" : '';
		$sett_css .= (!empty($post_cat_font_size)) ? "font-size:{$post_cat_font_size}px;" : '';
		$sett_css .= '}';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-grid .wpspw-post-categories a:hover, .sp_wpspwpost_static .wpspw-post-grid .wpspw-post-categories a:focus,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list .wpspw-post-categories a:hover, .sp_wpspwpost_static .wpspw-post-list .wpspw-post-categories a:focus,';
		$sett_css .= '.sp_wpspwpost_static .wpspwpost-block .wpspw-post-categories a:hover, .sp_wpspwpost_static .wpspwpost-block .wpspw-post-categories a:focus,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list-content .wpspw-post-categories a:hover, .sp_wpspwpost_static .wpspw-post-list-content .wpspw-post-categories a:focus,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-slides .wpspw-post-categories a:hover, .sp_wpspwpost_static .wpspw-post-list-content .wpspw-post-categories a:focus,';
		$sett_css .= '.wpspw-post-slider .wpspw-post-slides .wpspw-post-categories a:hover, .wpspw-post-slider .wpspw-post-slides .wpspw-post-categories a:focus,';
		$sett_css .= '.wpspw-post-slider .wpspw-post-list .wpspw-post-categories a:hover, .wpspw-post-slider .wpspw-post-list .wpspw-post-categories a:focus,';
		$sett_css .= '.wpspw_pro_post_simple_widget .wpspw-post-categories a:hover, .wpspw_pro_post_simple_widget .wpspw-post-categories a:focus, .wpspw_pro_post_scrolling_widget .wpspw-post-categories a:hover, .wpspw_pro_post_scrolling_widget .wpspw-post-categories a:focus{';
		$sett_css .= (!empty($post_cat_hbg_clr)) ? "background: {$post_cat_hbg_clr} !important; border-color: {$post_cat_hbg_clr} !important;" : '';
		$sett_css .= (!empty($post_cat_hfont_clr)) ? "color:{$post_cat_hfont_clr} !important;" : '';
		$sett_css .= '}';
		
		// Read more button css
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-grid .wpspw-readmorebtn,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list .wpspw-readmorebtn,';
		$sett_css .= '.sp_wpspwpost_static .wpspwpost-block .wpspw-readmorebtn,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list-content .wpspw-readmorebtn,';
		$sett_css .= '.sp_wpspwpost_slider .wpspw-post-slides .wpspw-readmorebtn{';
		$sett_css .= (!empty($read_more_bg_clr)) ? "background:{$read_more_bg_clr}; border:1px solid {$read_more_bg_clr};" : '';
		$sett_css .= (!empty($read_more_font_clr)) ? "color:{$read_more_font_clr} !important;" : '';
		$sett_css .= (!empty($read_more_font_size)) ? "font-size:{$read_more_font_size}px;" : '';
		$sett_css .= '}';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-grid .wpspw-readmorebtn:hover,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list .wpspw-readmorebtn:hover,';
		$sett_css .= '.sp_wpspwpost_static .wpspwpost-block .wpspw-readmorebtn:hover,';
		$sett_css .= '.sp_wpspwpost_static .wpspw-post-list-content .wpspw-readmorebtn:hover,';
		$sett_css .= '.sp_wpspwpost_slider .wpspw-post-slides .wpspw-readmorebtn:hover{';
		$sett_css .= (!empty($read_more_hbg_clr)) ? "background:{$read_more_hbg_clr} !important; border:1px solid {$read_more_hbg_clr};" : '';
		$sett_css .= (!empty($read_more_hfont_clr)) ? "color:{$read_more_hfont_clr} !important;" : '';
		$sett_css .= '}';
		
		$sett_css .= "\n" . '</style>' . "\n";
		echo $sett_css;
		
		// Custom CSS
		$custom_css = wpspw_pro_get_option('custom_css');
		
		if( !empty($custom_css) ) {
			$css  = '<style type="text/css">' . "\n";
			$css .= $custom_css;
			$css .= "\n" . '</style>' . "\n";
			
			echo $css;
		}
	}
}

$wpspw_pro_script = new Wpspw_Pro_Script();