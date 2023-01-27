<?php
/**
 * Plugin generic functions file
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_default_settings() {
	
	global $wpls_pro_options;
	
	$wpls_pro_options = array(
		'tooltip_theme'		=> 'punk',
		'tooltip_animation'	=> 'grow',
		'tooltip_behavior'	=> 'hover',
		'tooltip_arrow'		=> 'true',
		'tooltip_delay'		=> '300',
		'tooltip_distance'	=> '6',
		'tooltip_maxwidth'	=> '',
		'tooltip_minwidth'	=> '',
		'custom_css' 		=> '',
	);

	$default_options = apply_filters('wpls_pro_options_default_values', $wpls_pro_options );
	
	// Update default options
	update_option( 'wpls_pro_options', $default_options );

	// Overwrite global variable when option is update
	$wpls_pro_options = wpls_pro_get_settings();
}

/**
 * get featured image of logo post
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_get_logo_image( $post_id = '', $size = 'full' ) {
	
	$prefix = WPLS_META_PREFIX; // Metabox prefix
	
	// Taking external image
	$image = get_post_meta( $post_id, $prefix.'logo_url', true );
	
	// If external image is blank then take featured image
	if( empty($image) ) {
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
		
		if( !empty($image) ) {
			$image = isset($image[0]) ? $image[0] : '';
		}
	}
	
	return $image;
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_get_settings() {
	
	$options = get_option('wpls_pro_options');
	
	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Function to add array after specific key
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_add_array(&$array, $value, $index, $from_last = false) {
    
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
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_get_option( $key = '', $default = false ) {
	global $wpls_pro_options;

	$value = ! empty( $wpls_pro_options[ $key ] ) ? $wpls_pro_options[ $key ] : $default;
	$value = apply_filters( 'wpls_pro_get_option', $value, $key, $default );
	return apply_filters( 'wpls_pro_get_option_' . $key, $value, $key, $default );
}

/**
 * Strip Slashes From Array
 *
 * @package  WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_slashes_deep($data = array(), $flag = false) {
	if($flag != true) {
		$data = wpls_pro_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('wpls_pro_nohtml_kses', $data);
		
	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}
	
	return $data;
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Function to get plugin image sizes array
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_img_sizes() {
	
	$img_sizes = array(
					'original' 	=> __('Original', 'logoshowcase'),
					'large'		=> __('Large', 'logoshowcase'),
					'medium' 	=> __('Medium', 'logoshowcase'),
					'thumbnail' => __('Thumbnail', 'logoshowcase')
				);

	return $img_sizes;
}

/**
 * Function to get post excerpt
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

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
 * Function to get plugin image sizes array
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to get plugin design file
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_get_design( $design = '', $type = '', $default_design = '' ) {
	
	$result = false;

	if( !empty($design) ) {
		switch ($type) {
			default:
				$shortcode_designs = wpls_pro_logo_designs();
				$result = ( array_key_exists(trim($design), $shortcode_designs) && !empty($shortcode_designs[$design]['file']) ) ? trim($shortcode_designs[$design]['file']) : $default_design;
				break;
		}
	}
	return $result;
}

/**
 * Function to get `logoshowcase` shortcode designs
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_logo_designs() {
    $design_arr = array(
						'design-1' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 1', 'logoshowcase'),
				        					),
						'design-2' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 2', 'logoshowcase'),
				        					),
						'design-3' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 3', 'logoshowcase'),
				        					),
						'design-4' 	=> array(
				        						'file' 	=> 'design-4',
				        						'name'	=> __('Design 4', 'logoshowcase'),
				        					),
						'design-5' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 5', 'logoshowcase'),
				        					),
						'design-6' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 6', 'logoshowcase'),
				        					),
						'design-7' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 7', 'logoshowcase'),
				        					),
						'design-8' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 8', 'logoshowcase'),
				        					),
						'design-9' 	=> array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 9', 'logoshowcase'),
				        					),
						'design-10' => array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 10', 'logoshowcase'),
				        					),
						'design-11' => array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 11', 'logoshowcase'),
				        					),
						'design-12' => array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 12', 'logoshowcase'),
				        					),
						'design-13' => array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 13', 'logoshowcase'),
				        					),
						'design-14' => array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 14', 'logoshowcase'),
				        					),
						'design-15' => array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 15', 'logoshowcase'),
				        					),
						'design-16' => array(
				        						'file' 	=> 'design-1',
				        						'name'	=> __('Design 16', 'logoshowcase'),
				        					),
	);
	return apply_filters('wpls_pro_logo_designs', $design_arr );
}

/**
 * Function to get supported animations
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_animations() {
	$animations = array(
			'flash' 		=> 'Flash',
			'pulse'			=> 'Pulse',
			'rubberBand' 	=> 'Rubber Band',
			'headShake'		=> 'Head Shake',
			'swing'			=> 'Swing',
			'tada'			=> 'Tada',
			'wobble'		=> 'Wobble',
			'jello'			=> 'jello',
			'bounceIn'		=> 'Bounce In',
			'fadeIn'		=> 'Fade In',
			'fadeOut'		=> 'Fade Out',
			'lightSpeedOut'	=> 'Light Speed Out',
			'rotateIn'		=> 'Rotate In',
		);
	return apply_filters('wpls_pro_animations', $animations );
}