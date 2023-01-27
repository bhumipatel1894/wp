<?php
/**
 * Plugin generic functions file
 *
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_default_settings() {
	
	global $wphts_pro_options;
	
	$wphts_pro_options = array(
		'default_img'	=> '',
		'custom_css' 	=> '',
		'date_format' 	=> 'm/d/Y',
	);

	$default_options = apply_filters('wphtsp_options_default_values', $wphts_pro_options );
	
	// Update default options
	update_option( 'wphts_pro_options', $default_options );

	// Overwrite global variable when option is update
	$wphts_pro_options = wphtsp_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_get_settings() {
	
	$options = get_option('wphts_pro_options');
	
	$settings = is_array($options) 	? $options : array();

	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphts_pro_get_option( $key = '', $default = false ) {
	global $wphts_pro_options;

	$value = ! empty( $wphts_pro_options[ $key ] ) ? $wphts_pro_options[ $key ] : $default;
	$value = apply_filters( 'wphts_pro_get_option', $value, $key, $default );
	return apply_filters( 'wphts_pro_get_option_' . $key, $value, $key, $default );
}

/**
 * Function to get post featured image
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_get_post_featured_image( $post_id = '', $size = 'full', $default_img = false ) {

	$size 	= !empty($size) ? trim($size) : 'full';
	$image 	= wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

	if( !empty($image) ) {
		$image = isset($image[0]) ? $image[0] : '';
	}

	// Getting default image
    if( $default_img && empty($image) ) {
        $image = wphts_pro_get_option( 'default_img' );
    }

	return $image;
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 * If $flag is passed then it will allow HTML
 *
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_slashes_deep($data = array(), $flag = false){
	
	if($flag != true) {
		$data = wphtsp_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input fields. Strip html tags and escape characters)
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_nohtml_kses($data = array()) {

	if ( is_array($data) ) {

		$data = array_map('wphtsp_nohtml_kses', $data);

	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}
	return $data;
}

/**
 * Function to get post external link or permalink
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_get_post_link( $post_id = '' ) {

	$post_link = '';

	if( !empty($post_id) ) {

		$prefix = WPHTSP_META_PREFIX;

		$post_link = get_post_meta( $post_id,$prefix.'timeline_link', true );

		if( empty($post_link) ) {
			$post_link = get_post_permalink( $post_id );	
		}
	}
	return $post_link;
}

/**
 * Function to get post excerpt
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphts_pro_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

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
 * Function to add array after specific key
 * 
 * @package WP Testimonials with rotator widget Pro
 * @since 1.0.0
 */
function wphts_pro_add_array(&$array, $value, $index, $from_last = false) {
    
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
 * Function to get plugin image sizes array
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_get_unique() {
  static $unique = 0;
  $unique++;

  return $unique;
}

/**
 * Function to get supported post types
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_supported_post_types() {
	$post_arr = array(
		'post'					=> __('post'),
		WPHTSP_PRO_POST_TYPE	=> __(WPHTSP_PRO_POST_TYPE),
		);
	return apply_filters('wphtsp_supported_post_types', $post_arr );
}

/**
 * Function to get supported post type category
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_supported_post_types_category() {
	$cat_arr = array(
		'post'					=> __('category'),
		WPHTSP_PRO_POST_TYPE	=> __(WPHTSP_PRO_CAT),
		);
	return apply_filters('wphtsp_supported_post_types_category', $cat_arr );
}

/**
 * Function to get post format when posttype is post
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_post_format() {

	$format_arr = array(
		'0' 		=> 'fa fa-thumb-tack',
		'image'		=> 'fa fa-picture-o',
		'aside'		=> 'fa fa-file-text',
		'link'		=> 'fa fa-link',
		'quote'		=> 'fa fa-quote-left',
		'status'	=> 'fa fa-comments-o',
	);
	return apply_filters('wphtsp_post_format', $format_arr );
}

/**
 * Function to get timeline post fa icon
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_timeline_format_icon( $post_id = '' ) {

	if( empty($post_id) ) {
		return false;
	}

	$tl_fa_icon = get_post_meta( $post_id, WPHTSP_META_PREFIX.'timeline_icon', true );

	if( empty($tl_fa_icon) ) {
		if( current_theme_supports('post-formats') ) {
			$reg_post_formats 	= wphtsp_post_format();
			$post_format 		= get_post_format( $post_id ); // Getting post formats
			$tl_fa_icon 		= $reg_post_formats[$post_format];
		} else {
			$tl_fa_icon = 'fa fa-check-square-o';
		}
	}
	return $tl_fa_icon;
}

/**
 * Function to get 'th-slider' shortcode designs
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_slider_designs() {
	$design_arr = array(
		'design-1'	=> __('Design 1', 'timeline-and-history-slider'),
		'design-2'	=> __('Design 2', 'timeline-and-history-slider'),
		'design-3'	=> __('Design 3', 'timeline-and-history-slider'),
		'design-4'	=> __('Design 4', 'timeline-and-history-slider'),
		'design-5'	=> __('Design 5', 'timeline-and-history-slider'),
		'design-6'	=> __('Design 6', 'timeline-and-history-slider'),
	);
	return apply_filters('wphtsp_slider_designs', $design_arr );
}

/**
 * Function to get 'th-history' shortcode designs
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */
function wphtsp_history_designs() {
	$design_arr = array(
		'design-1'	=> __('Design 1', 'timeline-and-history-slider'),
		'design-2'	=> __('Design 2', 'timeline-and-history-slider'),
		'design-3'	=> __('Design 3', 'timeline-and-history-slider'),
		'design-4'	=> __('Design 4', 'timeline-and-history-slider'),
		'design-5'	=> __('Design 5', 'timeline-and-history-slider'),
		'design-6'	=> __('Design 6', 'timeline-and-history-slider'),
		'design-7'	=> __('Design 7', 'timeline-and-history-slider'),
		);
	return apply_filters('wphtsp_history_designs', $design_arr );
}