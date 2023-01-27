<?php
/**
 * Plugin generic functions file
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_default_settings() {
    
    global $wpcdt_pro_options;
    
    $wpcdt_pro_options = array(
        'custom_css' => '',
    );

    $default_options = apply_filters('wpcdt_options_default_values', $wpcdt_pro_options );
    
    // Update default options
    update_option( 'wpcdt_pro_options', $default_options );

    // Overwrite global variable when option is update
    $wpcdt_pro_options = wpcdt_pro_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_get_settings() {
    
    $options = get_option('wpcdt_pro_options');
    
    $settings = is_array($options)  ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_get_option( $key = '', $default = false ) {
    global $wpcdt_pro_options;

    $value = ! empty( $wpcdt_pro_options[ $key ] ) ? $wpcdt_pro_options[ $key ] : $default;
    $value = apply_filters( 'wpcdt_pro_get_option', $value, $key, $default );
    return apply_filters( 'wpcdt_pro_get_option_' . $key, $value, $key, $default );
}

/**
 * Function to unique number value
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}
/**
 * Escape Tags & Slashes. Handles escapping the slashes and tags
 *
 * @package  Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_escape_attr($data){
	return esc_attr(stripslashes($data));
}

/**
 * Strip Slashes From Array
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = wpcdt_pro_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

function wpcdt_pro_nohtml_kses($data = array()) {
  
  if ( is_array($data) ) {
    
    $data = array_map('wpcdt_pro_nohtml_kses', $data);
    
  } elseif ( is_string( $data ) ) {
    $data = trim( $data );
    $data = wp_filter_nohtml_kses($data);
  }
  
  return $data;
}

/**
 * Function to add array after specific key
 * 
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_add_array(&$array, $value, $index, $from_last = false) {
    
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
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */
function wpcdt_pro_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {
    
    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
    
    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    return $image;
}

/**
* Function to add array after specific key
* 
* @package Countdown Timer Ultimate Pro
* @since 1.0.0
*/
function wpcdt_pro_designs() {
    $design_arr = array(
            'circle'    => __('Circle Clock', 'countdown-timer-ultimate'),
            'design-3'  => __('Circle Style 2', 'countdown-timer-ultimate'),
            'design-1'  => __('Rounded Clock', 'countdown-timer-ultimate'),
            'design-8'  => __('Horizontal Flip', 'countdown-timer-ultimate'),
            'design-2'  => __('Vertical Flip', 'countdown-timer-ultimate'),
            'design-6'  => __('Simple Clock', 'countdown-timer-ultimate'),
            'design-7'  => __('Simple Clock 2', 'countdown-timer-ultimate'),
            'design-10' => __('Simple Clock 3', 'countdown-timer-ultimate'),
            'design-12' => __('Simple Clock 4', 'countdown-timer-ultimate'),
            'design-9'  => __('Modern Clock', 'countdown-timer-ultimate'),
            'design-11' => __('Shadow Clock', 'countdown-timer-ultimate'),
            'design-4'  => __('Bars Clock', 'countdown-timer-ultimate'),
            'design-5'  => __('Night Clock', 'countdown-timer-ultimate'),
        );
    return apply_filters('wpcdt_pro_designs', $design_arr );
}