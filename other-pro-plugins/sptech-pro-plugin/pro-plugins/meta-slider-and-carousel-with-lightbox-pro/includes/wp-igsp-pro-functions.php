<?php
/**
 * Plugin generic functions file
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_default_settings() {
    
    global $wp_igsp_pro_options;
    
    $wp_igsp_pro_options = array(
        'custom_css'    => '',
    );
    
    $default_options = apply_filters('wp_igsp_pro_options_default_values', $wp_igsp_pro_options );
    
    // Update default options
    update_option( 'wp_igsp_pro_options', $default_options );
    
    // Overwrite global variable when option is update
    $wp_igsp_pro_options = wp_igsp_pro_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_get_settings() {
  
    $options    = get_option('wp_igsp_pro_options');
    $settings   = is_array($options)  ? $options : array();
    
    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_get_option( $key = '', $default = false ) {
    global $wp_igsp_pro_options;

    $value = ! empty( $wp_igsp_pro_options[ $key ] ) ? $wp_igsp_pro_options[ $key ] : $default;
    $value = apply_filters( 'wp_igsp_pro_get_option', $value, $key, $default );
    
    return apply_filters( 'wp_igsp_pro_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_esc_attr($data) {
    return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = wp_igsp_pro_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */

function wp_igsp_pro_nohtml_kses($data = array()) {
  
  if ( is_array($data) ) {
    
    $data = array_map('wp_igsp_pro_nohtml_kses', $data);
    
  } elseif ( is_string( $data ) ) {
    $data = trim( $data );
    $data = wp_filter_nohtml_kses($data);
  }
  
  return $data;
}

/**
 * Function to unique number value
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_add_array(&$array, $value, $index, $from_last = false) {
    
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
 * Function to get registered post types
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_get_post_types() {
	
	// Getting registered post type
	$post_type_args = array(
		'public' => true
	);
	$custom_post_types = get_post_types($post_type_args);
	$custom_post_types = (!empty($custom_post_types) && is_array($custom_post_types)) ? array_keys($custom_post_types) : array();
	
	// Exclude some post type
	$include_post_types = apply_filters('wp_igsp_gallery_support', array(WP_IGSP_PRO_POST_TYPE));
	$custom_post_types = array_merge($custom_post_types, (array)$include_post_types);
	
	// Exclude some post type
	$exclude_post_types = apply_filters('wp_igsp_remove_gallery_support', array('attachment'));
	$custom_post_types = array_diff($custom_post_types, (array)$exclude_post_types);
	
	return $custom_post_types;
}

/**
 * Function to get post image
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_get_image_src( $post_id = '', $size = 'full', $default_img = false ) {
   
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( $post_id, $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    return $image;
}

/**
 * Function to get `meta_gallery_slider` shortcode designs
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_slider_designs() {
    $design_arr = array(
        'design-1'   => __('Design 1', 'meta-slider-and-carousel-with-lightbox'),
        'design-2'   => __('Design 2', 'meta-slider-and-carousel-with-lightbox'),
        'design-3'   => __('Design 3', 'meta-slider-and-carousel-with-lightbox'),
        'design-4'   => __('Design 4', 'meta-slider-and-carousel-with-lightbox'),
        'design-5'   => __('Design 5', 'meta-slider-and-carousel-with-lightbox'),
        'design-6'   => __('Design 6', 'meta-slider-and-carousel-with-lightbox'),
        'design-7'   => __('Design 7', 'meta-slider-and-carousel-with-lightbox'),
        'design-8'   => __('Design 8', 'meta-slider-and-carousel-with-lightbox'),
        'design-9'   => __('Design 9', 'meta-slider-and-carousel-with-lightbox'),
        'design-10'  => __('Design 10', 'meta-slider-and-carousel-with-lightbox'),
        'design-11'  => __('Design 11', 'meta-slider-and-carousel-with-lightbox'),
        'design-12'  => __('Design 12', 'meta-slider-and-carousel-with-lightbox'),
        'design-13'  => __('Design 13', 'meta-slider-and-carousel-with-lightbox'),
        'design-14'  => __('Design 14', 'meta-slider-and-carousel-with-lightbox'),
        'design-15'  => __('Design 15', 'meta-slider-and-carousel-with-lightbox'),
    );
    return apply_filters('wp_igsp_pro_slider_designs', $design_arr );
}