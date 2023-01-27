<?php
/**
 * Plugin generic functions file
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

 // Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get button type
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */


function bwsp_button_type() {
	$button_type= array(
						'button'		=> __('Simple Button', 'buttons-with-style'),
						'button_group'	=> __('Button Group', 'buttons-with-style')
					);

	return apply_filters('bwsp_button_type', $button_type );
}

/**
 * Function to get button style type
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_btn_style_type() {
	$button_type= array(
						'square'	=> __('Square','buttons-with-style'),
						'radius'	=> __('Radius','buttons-with-style'),
						'round'		=> __('Round','buttons-with-style')
					);
	return apply_filters('bwsp_btn_style_type', $button_type );
}

/**
 * Function to get button class
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_clr_class() {
	$button_class = array(
						'black' 				=> __('Black', 'buttons-with-style'),
						'white'					=> __('White', 'buttons-with-style'),
						'light-grey'			=> __('Light Grey', 'buttons-with-style'),
						'grey'					=> __('Grey', 'buttons-with-style'),
						'azure'					=> __('Azure', 'buttons-with-style'),
						'moderate-green'		=> __('Moderate Green', 'buttons-with-style'),
						'soft-red'				=> __('Soft Red', 'buttons-with-style'),
						'green'					=> __('Green', 'buttons-with-style'),
						'bright-yellow' 		=> __('Bright Yellow', 'buttons-with-style'),
						'cyan'					=> __('Cyan', 'buttons-with-style'),
						'orange'				=> __('Orange', 'buttons-with-style'),
						'moderate-violet'		=> __('Moderate Violet', 'buttons-with-style'),
						'dark-magenta'			=> __('Dark Magenta', 'buttons-with-style'),
						'dark-grayish-orange'	=> __('Dark Grayish Orange', 'buttons-with-style'),
						'moderate-blue'			=> __('Moderate Blue', 'buttons-with-style'),
						'blue'					=> __('Blue', 'buttons-with-style'),
						'red'					=> __('Red', 'buttons-with-style'),
						'cyan'					=> __('Cyan', 'buttons-with-style'),
						'magenta' 				=> __('Magenta', 'buttons-with-style'),
						'lime'					=> __('Lime', 'buttons-with-style'),
						'pink'					=> __('Pink', 'buttons-with-style'),
						'vivid-yellow'			=> __('Vivid Yellow', 'buttons-with-style'),
						'lime-green' 			=> __('Lime Green', 'buttons-with-style'),
						'yellow'				=> __('Yellow', 'buttons-with-style')
					);
	return apply_filters('bwsp_clr_class', $button_class );
}

/**
 * Function to get button style
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_btn_style_cls() {
	$button_style = array(
						'plane'		=> __('Plane','buttons-with-style'),
						'hollow'	=> __('Border','buttons-with-style'),
						'shadow'	=> __('Shadow','buttons-with-style'),
					);
	return apply_filters('bwsp_btn_style_cls', $button_style );
}

/**
 * Function to get button size
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_btn_sizes() {
	$button_sizes = array(
						'tiny'		=> __('Small', 'buttons-with-style'),
						'small'		=> __('Medium', 'buttons-with-style'),
						'large'		=> __('Large', 'buttons-with-style'),
						'expand'	=> __('Expand', 'buttons-with-style')
					);
	
	return apply_filters('bwsp_btn_sizes', $button_sizes );
}

/**
 * Function to get button icon class
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_btn_icon_class() {
	$button_icon_class = array(
						'star'		=> __('Star', 'buttons-with-style'),
						'small'		=> __('Small', 'buttons-with-style'),
						'large'		=> __('Large', 'buttons-with-style'),
						'expand'	=> __('Expand', 'buttons-with-style'));
	
	return apply_filters('bwsp_btn_icon_class', $button_icon_class );
}

/**
 * Function to get button icon size
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_btn_icon_size() {
	$button_icon_size = array(
						'small'		=> __('Tiny', 'buttons-with-style'),
						'midium'	=> __('Small', 'buttons-with-style'),
						'large'		=> __('Large', 'buttons-with-style')
					);
	return apply_filters('bwsp_btn_icon_size', $button_icon_size );
}

/**
 * Update default settings
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_default_settings() {

    global $bwsp_options;

    $bwsp_options = array(
               				'custom_css'  => ''
    					);
    
    $default_options = apply_filters('bwsp_options_default_values', $bwsp_options );

    // Update default options
    update_option( 'bwsp_options', $default_options );

    // Overwrite global variable when option is update
    $bwsp_options = bwsp_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_get_settings() {
  
    $options    = get_option('bwsp_options');
    $settings   = is_array($options)  ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_get_option( $key = '', $default = false ) {
    global $bwsp_options;
   	$bwsp_options = bwsp_get_settings();

    $value = ! empty( $bwsp_options[ $key ] ) ? $bwsp_options[ $key ] : $default;
    $value = apply_filters( 'bwsp_get_option', $value, $key, $default );
    
    return apply_filters( 'bwsp_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_esc_attr($data) {
    return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_slashes_deep($data = array(), $flag = false) {
  
    if($flag != true) {
        $data = bwsp_nohtml_kses($data);
    }
    $data = stripslashes_deep($data);
    return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

function bwsp_nohtml_kses($data = array()) {
  
  if ( is_array($data) ) {
    
    $data = array_map('bwsp_nohtml_kses', $data);
    
  } elseif ( is_string( $data ) ) {
    $data = trim( $data );
    $data = wp_filter_nohtml_kses($data);
  }
  
  return $data;
}

/**
 * Function to add array after specific key
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_add_array(&$array, $value, $index, $from_last = false) {

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
 * Function to get buton post meta
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_get_button_post_meta( $post_id = '' ) {

	$prefix = BWSPOS_PRO_META_PREFIX; // Metabox prefix

	$grp_btn_data						= array();
	$post_meta['simple_button_text'] 	= get_post_meta( $post_id, $prefix.'button_name', true );
	$post_meta['simple_button_link'] 	= get_post_meta( $post_id, $prefix.'button_link', true );
	$post_meta['button_style_type'] 	= get_post_meta( $post_id, $prefix.'button_type', true );
	$post_meta['button_class'] 			= get_post_meta( $post_id, $prefix.'button_class', true );
	$post_meta['button_style'] 			= get_post_meta( $post_id, $prefix.'button_style', true );
	$post_meta['button_size'] 			= get_post_meta( $post_id, $prefix.'button_size', true );
	$post_meta['button_icon_class'] 	= get_post_meta( $post_id, $prefix.'button_icon_class', true );
	$post_meta['button_icon_size'] 		= get_post_meta( $post_id, $prefix.'button_icon_size', true );
	$post_meta['button_link_target'] 	= get_post_meta( $post_id, $prefix.'button_link_target', true );
	$post_meta['grp_btn_data'] 			= get_post_meta( $post_id, $prefix.'grp_btn_data', true );
	
	// Remove is data is not set
	if( !empty($post_meta['grp_btn_data']) ) {
		foreach ($post_meta['grp_btn_data'] as $grp_key => $grp_val) {
			if( (isset($grp_val['name']) && trim($grp_val['name']) != '') || (!empty($grp_val['icon_cls']))  ) {
				$grp_btn_data[$grp_key] = $grp_val;
			}
		}
	}

	$post_meta['grp_btn_data'] = $grp_btn_data;

	return $post_meta;
}