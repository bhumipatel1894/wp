<?php
/**
 * Plugin generic functions file
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_default_settings() {
  
    global $wpsisac_pro_options;

    $wpsisac_pro_options = array(
        'default_img' => '',
        'custom_css'  => '',
    );
    
    $default_options = apply_filters('wpsisac_pro_options_default_values', $wpsisac_pro_options );
    
    // Update default options
    update_option( 'wpsisac_pro_options', $default_options );
    
    // Overwrite global variable when option is update
    $wpsisac_pro_options = wpsisac_pro_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_get_settings() {
  
    $options    = get_option('wpsisac_pro_options');
    $settings   = is_array($options)  ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_get_option( $key = '', $default = false ) {
    global $wpsisac_pro_options;

    $value = ! empty( $wpsisac_pro_options[ $key ] ) ? $wpsisac_pro_options[ $key ] : $default;
    $value = apply_filters( 'wpsisac_pro_get_option', $value, $key, $default );
    
    return apply_filters( 'wpsisac_pro_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_esc_attr($data) {
    return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = wpsisac_pro_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */

function wpsisac_pro_nohtml_kses($data = array()) {
  
  if ( is_array($data) ) {
    
    $data = array_map('wpsisac_pro_nohtml_kses', $data);
    
  } elseif ( is_string( $data ) ) {
    $data = trim( $data );
    $data = wp_filter_nohtml_kses($data);
  }
  
  return $data;
}

/**
 * Function to unique number value
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2
 */
function wpsisac_pro_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_add_array(&$array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    
    return $array;
}

/**
 * Function to get post featured image
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    // Getting default image
    if( $default_img && empty($image) ) {
        $image = wpsisac_pro_get_option( 'default_img' );
    }

    return $image;
}

/**
 * Function to get `slick-slider` shortcode designs
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_slider_designs() {
    $design_arr = array(
        'prodesign-1'  	=> __('Design 1', 'wp-responsive-recent-post-slider'),
        'prodesign-2'  	=> __('Design 2', 'wp-responsive-recent-post-slider'),
        'prodesign-3'  	=> __('Design 3', 'wp-responsive-recent-post-slider'),
        'prodesign-4' 	=> __('Design 4', 'wp-responsive-recent-post-slider'),
        'prodesign-5' 	=> __('Design 5', 'wp-responsive-recent-post-slider'),
        'prodesign-6' 	=> __('Design 6', 'wp-responsive-recent-post-slider'),
        'prodesign-7' 	=> __('Design 7', 'wp-responsive-recent-post-slider'),
        'prodesign-8' 	=> __('Design 8', 'wp-responsive-recent-post-slider'),
        'prodesign-9' 	=> __('Design 9', 'wp-responsive-recent-post-slider'),
        'prodesign-10' 	=> __('Design 10', 'wp-responsive-recent-post-slider'),
        'prodesign-17'  => __('Design 17', 'wp-responsive-recent-post-slider'),
        'prodesign-18'  => __('Design 18', 'wp-responsive-recent-post-slider'),
        'prodesign-19'  => __('Design 19', 'wp-responsive-recent-post-slider'),
        'prodesign-20'  => __('Design 20', 'wp-responsive-recent-post-slider'),
        'prodesign-21'  => __('Design 21', 'wp-responsive-recent-post-slider'),
        'prodesign-22'  => __('Design 22', 'wp-responsive-recent-post-slider'),
        'prodesign-23'  => __('Design 23', 'wp-responsive-recent-post-slider'),
        'prodesign-24'  => __('Design 24', 'wp-responsive-recent-post-slider'),
        'prodesign-25'  => __('Design 25', 'wp-responsive-recent-post-slider'),
        'prodesign-26'  => __('Design 26', 'wp-responsive-recent-post-slider'),
        'prodesign-27'  => __('Design 27', 'wp-responsive-recent-post-slider'),
        'prodesign-28'  => __('Design 28', 'wp-responsive-recent-post-slider'),
        'prodesign-29'  => __('Design 29', 'wp-responsive-recent-post-slider'),
        'prodesign-30'  => __('Design 30', 'wp-responsive-recent-post-slider'),
	);
	return apply_filters('wpsisac_pro_slider_designs', $design_arr );
}

/**
 * Function to get `slick-carousel-slider` shortcode designs
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_carousel_designs() {
    $design_arr = array(
        'prodesign-11'  => __('Design 11', 'wp-responsive-recent-post-slider'),
        'prodesign-12'  => __('Design 12', 'wp-responsive-recent-post-slider'),
        'prodesign-13'  => __('Design 13', 'wp-responsive-recent-post-slider'),
        'prodesign-14' 	=> __('Design 14', 'wp-responsive-recent-post-slider'),
        'prodesign-15' 	=> __('Design 15', 'wp-responsive-recent-post-slider'),
        'prodesign-16'  => __('Design 16', 'wp-responsive-recent-post-slider'),
        'prodesign-17'  => __('Design 17', 'wp-responsive-recent-post-slider'),
        'prodesign-18'  => __('Design 18', 'wp-responsive-recent-post-slider'),
        'prodesign-19'  => __('Design 19', 'wp-responsive-recent-post-slider'),
        'prodesign-20'  => __('Design 20', 'wp-responsive-recent-post-slider'),
        'prodesign-21'  => __('Design 21', 'wp-responsive-recent-post-slider'),
        'prodesign-22'  => __('Design 22', 'wp-responsive-recent-post-slider'),
        'prodesign-23'  => __('Design 23', 'wp-responsive-recent-post-slider'),
        'prodesign-24'  => __('Design 24', 'wp-responsive-recent-post-slider'),
        'prodesign-25'  => __('Design 25', 'wp-responsive-recent-post-slider'),
        'prodesign-26'  => __('Design 26', 'wp-responsive-recent-post-slider'),
        'prodesign-27'  => __('Design 27', 'wp-responsive-recent-post-slider'),
        'prodesign-28'  => __('Design 28', 'wp-responsive-recent-post-slider'),
        'prodesign-29'  => __('Design 29', 'wp-responsive-recent-post-slider'),
        'prodesign-30'  => __('Design 30', 'wp-responsive-recent-post-slider'),
	);
	return apply_filters('wpsisac_pro_carousel_designs', $design_arr );
}

/**
 * Function to get `slick-variable-slider` shortcode designs
 * 
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */
function wpsisac_pro_variable_designs() {
    $design_arr = array(
        'prodesign-11'  => __('Design 11', 'wp-responsive-recent-post-slider'),
        'prodesign-12'  => __('Design 12', 'wp-responsive-recent-post-slider'),
        'prodesign-13'  => __('Design 13', 'wp-responsive-recent-post-slider'),
        'prodesign-14'  => __('Design 14', 'wp-responsive-recent-post-slider'),
        'prodesign-15'  => __('Design 15', 'wp-responsive-recent-post-slider'),
        'prodesign-16' 	=> __('Design 16', 'wp-responsive-recent-post-slider'),
        'prodesign-17'  => __('Design 17', 'wp-responsive-recent-post-slider'),
        'prodesign-18'  => __('Design 18', 'wp-responsive-recent-post-slider'),
        'prodesign-19'  => __('Design 19', 'wp-responsive-recent-post-slider'),
        'prodesign-20'  => __('Design 20', 'wp-responsive-recent-post-slider'),
        'prodesign-21'  => __('Design 21', 'wp-responsive-recent-post-slider'),
        'prodesign-22'  => __('Design 22', 'wp-responsive-recent-post-slider'),
        'prodesign-23'  => __('Design 23', 'wp-responsive-recent-post-slider'),
        'prodesign-24'  => __('Design 24', 'wp-responsive-recent-post-slider'),
        'prodesign-25'  => __('Design 25', 'wp-responsive-recent-post-slider'),
        'prodesign-26'  => __('Design 26', 'wp-responsive-recent-post-slider'),
        'prodesign-27'  => __('Design 27', 'wp-responsive-recent-post-slider'),
        'prodesign-28'  => __('Design 28', 'wp-responsive-recent-post-slider'),
        'prodesign-29'  => __('Design 29', 'wp-responsive-recent-post-slider'),
        'prodesign-30'  => __('Design 30', 'wp-responsive-recent-post-slider'),
        'prodesign-31'  => __('Design 31', 'wp-responsive-recent-post-slider'),
        'prodesign-32'  => __('Design 32', 'wp-responsive-recent-post-slider'),
        'prodesign-33'  => __('Design 33', 'wp-responsive-recent-post-slider'),
	);
	return apply_filters('wpsisac_pro_variable_designs', $design_arr );
}