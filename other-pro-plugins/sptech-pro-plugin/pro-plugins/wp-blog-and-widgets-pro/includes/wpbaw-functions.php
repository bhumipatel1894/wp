<?php
/**
 * Plugin generic functions file
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_default_settings() {
	
	global $wpbaw_pro_options;
	
	$wpbaw_pro_options = array(
		'default_img'	=> '',
		'custom_css' 	=> '',
		);

	$default_options = apply_filters('wpbaw_pro_options_default_values', $wpbaw_pro_options );
	
	// Update default options
	update_option( 'wpbaw_pro_options', $default_options );

	// Overwrite global variable when option is update
	$wpbaw_pro_options = wpbaw_pro_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_settings() {
	
	$options = get_option('wpbaw_pro_options');
	
	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_option( $key = '', $default = false ) {
	global $wpbaw_pro_options;

	$value = ! empty( $wpbaw_pro_options[ $key ] ) ? $wpbaw_pro_options[ $key ] : $default;
	$value = apply_filters( 'wpbaw_pro_get_option', $value, $key, $default );
	return apply_filters( 'wpbaw_pro_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */

function wpbaw_pro_slashes_deep($data = array(), $flag = false) {

	// date is i/p array , falg is for to avoid spe char like "" in value
	if($flag != true) {
		$data = wpbaw_pro_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('wpbaw_pro_nohtml_kses', $data);
		
	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}
	
	return $data;
}

/**
 * Function to get limited words
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0
 */
function pro_blog_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
		array_pop($words);
	return implode(' ', $words);
}

/**
 * Function to unique number value
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.5
 */
function wpbaw_pro_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.6
 */
function wpbaw_pro_add_array(&$array, $value, $index) {
	
	if( is_array($array) && is_array($value) ){
		$split_arr 	= array_splice($array, max(0, $index));
		$array 		= array_merge( $array, $value, $split_arr);
	}

	return $array;
}

/**
 * Function to get post featured image
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_post_featured_image( $post_id = '', $size = 'full' ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
	
	if( !empty($image) ) {
		$image = isset($image[0]) ? $image[0] : '';
	}

	return $image;
}

/**
 * Function to get 'recent_blog_post_slider' shortcode designs
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_recent_blog_slider_designs() {
	$design_arr = array(
		'design-1'	=> __('Design 1', 'sp-blog-and-widget'),
		'design-2'	=> __('Design 2', 'sp-blog-and-widget'),
		'design-3'	=> __('Design 3', 'sp-blog-and-widget'),
		'design-4'	=> __('Design 4', 'sp-blog-and-widget'),
		'design-5'	=> __('Design 5', 'sp-blog-and-widget'),
		'design-6'	=> __('Design 6', 'sp-blog-and-widget'),
		'design-7'	=> __('Design 7', 'sp-blog-and-widget'),
		'design-8'	=> __('Design 8', 'sp-blog-and-widget'),
		'design-9'	=> __('Design 9', 'sp-blog-and-widget'),
		'design-10'	=> __('Design 10', 'sp-blog-and-widget'),
		'design-11'	=> __('Design 11', 'sp-blog-and-widget'),
		'design-12'	=> __('Design 12', 'sp-blog-and-widget'),
		'design-13'	=> __('Design 13', 'sp-blog-and-widget'),
		'design-14'	=> __('Design 14', 'sp-blog-and-widget'),
		'design-15'	=> __('Design 15', 'sp-blog-and-widget'),
		'design-32'	=> __('Design 32', 'sp-blog-and-widget'),
		'design-33'	=> __('Design 33', 'sp-blog-and-widget'),
		'design-38'	=> __('Design 38', 'sp-blog-and-widget'),
		'design-39'	=> __('Design 39', 'sp-blog-and-widget'),
		'design-40'	=> __('Design 40', 'sp-blog-and-widget'),
		'design-41'	=> __('Design 41', 'sp-blog-and-widget'),
		'design-43'	=> __('Design 43', 'sp-blog-and-widget'),
		'design-46'	=> __('Design 46', 'sp-blog-and-widget'),
		);
	return apply_filters('wpbaw_pro_recent_blog_slider_designs', $design_arr );
}


/**
 * Function to get 'recent_blog_post' shortcode designs
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_recent_blog_designs() {
	$design_arr = array(
		'design-16'	=> __('Design 16', 'sp-blog-and-widget'),
		'design-17'	=> __('Design 17', 'sp-blog-and-widget'),
		'design-18'	=> __('Design 18', 'sp-blog-and-widget'),
		'design-19'	=> __('Design 19', 'sp-blog-and-widget'),
		'design-20'	=> __('Design 20', 'sp-blog-and-widget'),
		'design-21'	=> __('Design 21', 'sp-blog-and-widget'),
		'design-22'	=> __('Design 22', 'sp-blog-and-widget'),
		'design-23'	=> __('Design 23', 'sp-blog-and-widget'),
		'design-25'	=> __('Design 25', 'sp-blog-and-widget'),
		'design-26'	=> __('Design 26', 'sp-blog-and-widget'),
		'design-27'	=> __('Design 27', 'sp-blog-and-widget'),
		'design-28'	=> __('Design 28', 'sp-blog-and-widget'),
		'design-29'	=> __('Design 29', 'sp-blog-and-widget'),
		'design-31'	=> __('Design 31', 'sp-blog-and-widget'),
		'design-34'	=> __('Design 34', 'sp-blog-and-widget'),
		'design-35'	=> __('Design 35', 'sp-blog-and-widget'),
		'design-37'	=> __('Design 37', 'sp-blog-and-widget'),
		'design-42'	=> __('Design 42', 'sp-blog-and-widget'),
		'design-44'	=> __('Design 44', 'sp-blog-and-widget'),
		'design-45'	=> __('Design 45', 'sp-blog-and-widget'),
		'design-47'	=> __('Design 47', 'sp-blog-and-widget'),
		'design-48'	=> __('Design 48', 'sp-blog-and-widget'),
		'design-49'	=> __('Design 49', 'sp-blog-and-widget'),
		'design-50'	=> __('Design 50', 'sp-blog-and-widget'),
		);
	return apply_filters('wpbaw_pro_recent_blog_designs', $design_arr );
}


/**
 * Function to get 'blog' shortcode design
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_blog_designs() {
	$design_arr = array(
		'design-16'	=> __('Design 16', 'sp-blog-and-widget'),
		'design-17'	=> __('Design 17', 'sp-blog-and-widget'),
		'design-18'	=> __('Design 18', 'sp-blog-and-widget'),
		'design-19'	=> __('Design 19', 'sp-blog-and-widget'),
		'design-20'	=> __('Design 20', 'sp-blog-and-widget'),
		'design-21'	=> __('Design 21', 'sp-blog-and-widget'),
		'design-22'	=> __('Design 22', 'sp-blog-and-widget'),
		'design-24'	=> __('Design 24', 'sp-blog-and-widget'),
		'design-25'	=> __('Design 25', 'sp-blog-and-widget'),
		'design-26'	=> __('Design 26', 'sp-blog-and-widget'),
		'design-27'	=> __('Design 27', 'sp-blog-and-widget'),
		'design-30'	=> __('Design 30', 'sp-blog-and-widget'),
		'design-34'	=> __('Design 34', 'sp-blog-and-widget'),
		'design-35'	=> __('Design 35', 'sp-blog-and-widget'),
		'design-36'	=> __('Design 36', 'sp-blog-and-widget'),
		'design-37'	=> __('Design 37', 'sp-blog-and-widget'),
		'design-42'	=> __('Design 42', 'sp-blog-and-widget'),
		'design-44'	=> __('Design 44', 'sp-blog-and-widget'),
		'design-45'	=> __('Design 45', 'sp-blog-and-widget'),
		'design-48'	=> __('Design 48', 'sp-blog-and-widget'),
		);	
	return apply_filters('wpbaw_pro_blog_designs', $design_arr );
}


/**
 * Function to get post excerpt
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

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
 * Function to get post external link or permalink
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.7
 */
function wpbaw_pro_get_post_link( $post_id = '' ) {

	$post_link = '';

	if( !empty($post_id) ) {

		$prefix = WPBAW_META_PREFIX;

		$post_link = get_post_meta( $post_id, $prefix.'more_link', true );

		if( empty($post_link) ) {
			$post_link = get_post_permalink( $post_id );	
		}
	}
	return $post_link;
}

/**
 * Pagination function for grid
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.1.9
 */
function wpbaw_pro_pagination($args = array()){
	
	$big = 999999999; // need an unlikely integer

	$paging = apply_filters('wpbaw_pro_blog_paging_args', array(
					'base' 		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
					'format' 	=> '?paged=%#%',
					'current' 	=> max( 1, $args['paged'] ),
					'total'		=> $args['total'],
					'prev_next'	=> true,
					'prev_text'	=> __('?? Previous', 'wp-blog-and-widgets'),
					'next_text'	=> __('Next ??', 'wp-blog-and-widgets'),
				));
	
	echo paginate_links($paging);
}