<?php
/**
 * Plugin generic functions file
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_default_settings() {
	
	global $wp_fcasp_options;
	
	$wp_fcasp_options = array(
							'default_img'	=> '',
							'custom_css' 	=> '',
						);

	$default_options = apply_filters('wp_fcasp_options_default_values', $wp_fcasp_options );
	
	// Update default options
	update_option( 'wp_fcasp_options', $default_options );

	// Overwrite global variable when option is update
	$wp_fcasp_options = wp_fcasp_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_get_settings() {
	
	$options = get_option('wp_fcasp_options');
	
	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_get_option( $key = '', $default = false ) {
	global $wp_fcasp_options;

	$value = ! empty( $wp_fcasp_options[ $key ] ) ? $wp_fcasp_options[ $key ] : $default;
	$value = apply_filters( 'wp_fcasp_get_option', $value, $key, $default );
	return apply_filters( 'wp_fcasp_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_slashes_deep($data = array(), $flag = false) {
	
	if($flag != true) {
		$data = wp_fcasp_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('wp_fcasp_nohtml_kses', $data);
		
	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}
	
	return $data;
}

/**
 * Function to get unique value number
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0
 */
function wp_fcasp_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_add_array(&$array, $value, $index) {
	
	if( is_array($array) && is_array($value) ){
		$split_arr 	= array_splice($array, max(0, $index));
    	$array 		= array_merge( $array, $value, $split_arr);
	}
	return $array;
}

/**
 * Function to get post excerpt
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

	$has_excerpt 	= false;
	$word_length 	= !empty($word_length) ? $word_length : '55';

	// If post id is passed
	if( !empty($post_id) ) {
		if (has_excerpt($post_id)) {

			$has_excerpt 	= true;
			$content 		= get_the_excerpt();

		} else {
			$content = !empty($content) ? $content : get_the_content();
		}
	}

	if( !empty($content) && (!$has_excerpt) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}

	return $content;
}

/**
 * Function to get post featured image
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {
	
	$size 	= !empty($size) ? $size : 'full';
	$image 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	
	if( !empty($image) ) {
		$image = isset($image[0]) ? $image[0] : '';
	}

	// Getting default image
	if( $default_img && empty($image) ) {
		$image = wp_fcasp_get_option( 'default_img' );
	}
	
	return $image;
}

/**
 * Function to get featured content column
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_column( $row = '' ) {
	if($row == 2) {
		$per_row = 6;
	} else if($row == 3) {
		$per_row = 4;	
	} else if($row == 4) {
		$per_row = 3;
	} else if($row == 1) {
		$per_row = 12;
	} else{
        $per_row = 12;
    }

    return $per_row;
}

/**
 * Function to get `featured-cnt-icon` shortcode designs
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_fc_cnt_icon_designs() {
	$design_arr = array(
						'design-1'	=> __('Design 1', 'wp-featured-content-and-slider'),
						'design-2'	=> __('Design 2', 'wp-featured-content-and-slider'),
						'design-3'	=> __('Design 3', 'wp-featured-content-and-slider'),
						'design-4'	=> __('Design 4', 'wp-featured-content-and-slider'),
						'design-5'	=> __('Design 5', 'wp-featured-content-and-slider'),
						'design-6'	=> __('Design 6', 'wp-featured-content-and-slider'),
						'design-7'	=> __('Design 7', 'wp-featured-content-and-slider'),
						'design-22'	=> __('Design 22', 'wp-featured-content-and-slider'),
						'design-23'	=> __('Design 23', 'wp-featured-content-and-slider'),
						'design-26'	=> __('Design 26', 'wp-featured-content-and-slider'),
						'design-27'	=> __('Design 27', 'wp-featured-content-and-slider'),
						'design-28'	=> __('Design 28', 'wp-featured-content-and-slider'),
						'design-29'	=> __('Design 29', 'wp-featured-content-and-slider'),
						'design-30'	=> __('Design 30', 'wp-featured-content-and-slider'),
						'design-32'	=> __('Design 32', 'wp-featured-content-and-slider'),
						'design-33'	=> __('Design 33', 'wp-featured-content-and-slider'),
						'design-35'	=> __('Design 35', 'wp-featured-content-and-slider'),
					);
	return apply_filters('wp_fcasp_fc_cnt_icon_designs', $design_arr );
}

/**
 * Function to get `featured-cnt-icon-img` shortcode designs
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_fc_cnt_icon_img_designs() {
	$design_arr = array(
						'design-8'	=> __('Design 8', 'wp-featured-content-and-slider'),
						'design-9'	=> __('Design 9', 'wp-featured-content-and-slider'),
						'design-20'	=> __('Design 20', 'wp-featured-content-and-slider'),
						'design-21'	=> __('Design 21', 'wp-featured-content-and-slider'),
						'design-24'	=> __('Design 24', 'wp-featured-content-and-slider'),
						'design-25'	=> __('Design 25', 'wp-featured-content-and-slider'),
						'design-31'	=> __('Design 31', 'wp-featured-content-and-slider'),
						'design-34'	=> __('Design 34', 'wp-featured-content-and-slider'),
					);
	return apply_filters('wp_fcasp_fc_cnt_icon_img_designs', $design_arr );
}

/**
 * Function to get `featured-cnt-img` shortcode designs
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */
function wp_fcasp_fc_cnt_img_designs( $type = 'grid' ) {

	$type = ($type == 'slider') ? 'slider' : 'grid';

	if( $type == 'grid' ) {
		$design_arr = array(
							'design-10'	=> __('Design 10', 'wp-featured-content-and-slider'),
							'design-11'	=> __('Design 11', 'wp-featured-content-and-slider'),
							'design-12'	=> __('Design 12', 'wp-featured-content-and-slider'),
							'design-13'	=> __('Design 13', 'wp-featured-content-and-slider'),
							'design-14'	=> __('Design 14', 'wp-featured-content-and-slider'),
							'design-15'	=> __('Design 15', 'wp-featured-content-and-slider'),
							'design-16'	=> __('Design 16', 'wp-featured-content-and-slider'),
							'design-17'	=> __('Design 17', 'wp-featured-content-and-slider'),
							'design-18'	=> __('Design 18', 'wp-featured-content-and-slider'),
							'design-19'	=> __('Design 19', 'wp-featured-content-and-slider'),
						);
	} else {
		$design_arr = array(
							'design-10'	=> __('Design 10', 'wp-featured-content-and-slider'),
							'design-11'	=> __('Design 11', 'wp-featured-content-and-slider'),
							'design-12'	=> __('Design 12', 'wp-featured-content-and-slider'),
							'design-14'	=> __('Design 14', 'wp-featured-content-and-slider'),
							'design-16'	=> __('Design 16', 'wp-featured-content-and-slider'),
							'design-17'	=> __('Design 17', 'wp-featured-content-and-slider'),
							'design-18'	=> __('Design 18', 'wp-featured-content-and-slider'),
							'design-19'	=> __('Design 19', 'wp-featured-content-and-slider'),
						);
	}
	return apply_filters('wp_fcasp_fc_cnt_img_designs', $design_arr, $type );
}