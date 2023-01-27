<?php
/**
 * Plugin generic functions file
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_default_settings() {
	
	global $wp_tsasp_options;
	
	$wp_tsasp_options = array(
								'custom_css' => '',
							);

	$default_options = apply_filters('wp_tsasp_options_default_values', $wp_tsasp_options );
	
	// Update default options
	update_option( 'wp_tsasp_options', $default_options );

	// Overwrite global variable when option is update
	$wp_tsasp_options = wp_tsasp_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_get_settings() {
	
	$options = get_option('wp_tsasp_options');
	
	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_get_option( $key = '', $default = false ) {
	global $wp_tsasp_options;

	$value = ! empty( $wp_tsasp_options[ $key ] ) ? $wp_tsasp_options[ $key ] : $default;
	$value = apply_filters( 'wp_tsasp_get_option', $value, $key, $default );
	return apply_filters( 'wp_tsasp_get_option_' . $key, $value, $key, $default );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Strip Slashes From Array
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_slashes_deep($data = array(), $flag = false) {
	
	if($flag != true) {
		$data = wp_tsasp_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('wp_tsasp_nohtml_kses', $data);
		
	} elseif ( is_string( $data ) ) {
		$data = trim( $data );
		$data = wp_filter_nohtml_kses($data);
	}
	
	return $data;
}

/**
 * Function to get post excerpt
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

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
 * Function to get unique number value
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_add_array(&$array, $value, $index) {
	
	if( is_array($array) && is_array($value) ){
		$split_arr 	= array_splice($array, max(0, $index));
    	$array 		= array_merge( $array, $value, $split_arr);
	}
	return $array;
}

/**
 * Function to get grid column based on grid
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_grid_column( $grid = '' ) {

	if($grid == '2') {
		$grid_clmn = '6';
	} else if($grid == '3') {
		$grid_clmn = '4';
	}  else if($grid == '4') {
		$grid_clmn = '3';
	} else if ($grid == '1') {
		$grid_clmn = '12';
	} else {
		$grid_clmn = '12';
	}
	
	return $grid_clmn;
}

/**
 * Function to get social links
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_social_scrvices() {

	$services_arr = array(
							'fb_link' 		=> array(
														'name'	=> __('Facebook', 'wp-team-showcase-and-slider'),
														'desc'	=> __('Enter facebook link.', 'wp-team-showcase-and-slider'),
														'icon'	=> 'fa fa-facebook'
													),
							'gp_link' 		=> array(
														'name'	=> __('Google+', 'wp-team-showcase-and-slider'),
														'desc'	=> __('Enter google plus link.', 'wp-team-showcase-and-slider'),
														'icon'	=> 'fa fa-google-plus'
													),
							'li_link' 		=> array(
														'name' 	=> __('Linkedin', 'wp-team-showcase-and-slider'),
														'desc'	=> __('Enter Linkedin link.', 'wp-team-showcase-and-slider'),
														'icon'	=> 'fa fa-linkedin'
													),
							'tw_link' 		=> array(
														'name' => __('Twitter', 'wp-team-showcase-and-slider'),
														'desc'	=> __('Enter Twitter link.', 'wp-team-showcase-and-slider'),
														'icon'	=> 'fa fa-twitter'
													),
							'inst_link' 	=> array(
														'name' => __('Instagram', 'wp-team-showcase-and-slider'),
														'desc'	=> __('Enter Instagram link.', 'wp-team-showcase-and-slider'),
														'icon'	=> 'fa fa-instagram'
													),
							'yt_link' 		=> array(
														'name' 	=> __('YouTube', 'wp-team-showcase-and-slider'),
														'desc'	=> __('Enter YouTube link.', 'wp-team-showcase-and-slider'),
														'icon'	=> 'fa fa-youtube'
													),
							'pt_link' 		=> array(
													'name' 	=> __('Pinterest', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter Pinterest link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-pinterest-p'
												),
							'tb_link' 		=> array(
													'name' 	=> __('Tumblr', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter Tumblr link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-tumblr'
												),
							'fl_link' 		=> array(
													'name' 	=> __('Flickr', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter Flickr link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-flickr'
												),
							'reddit_link'	=> array(
													'name' 	=> __('Reddit', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter Reddit link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-reddit-alien'
												),
							'dl_link'	=> array(
													'name' 	=> __('Delicious', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter Delicious link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-delicious'
												),
							'fs_link'	=> array(
													'name' 	=> __('Foursquare', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter Foursquare link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-foursquare'
												),
							'vine_link'	=> array(
													'name' 	=> __('Vine', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter Vine link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-vine'
												),
							'wp_link'	=> array(
													'name' 	=> __('WordPress', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter WordPress profile link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-wordpress'
												),
							'mail'		=> array(
													'name' 	=> __('Email', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter email address.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-envelope'
												),
							'web_link'	=> array(
													'name' 	=> __('Website', 'wp-team-showcase-and-slider'),
													'desc'	=> __('Enter website link.', 'wp-team-showcase-and-slider'),
													'icon'	=> 'fa fa-desktop'
												),
						);

	return apply_filters('wp_tsasp_social_scrvices', $services_arr );
}

/**
 * Function to get pagination
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.2.1
 */
function wp_tsasp_pagination( $args = array() ) {
	
	$big = 999999999; // need an unlikely integer
	$paging = apply_filters('wp_tsasp_paging_args', array(
		'base' 		=> str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' 	=> '?paged=%#%',
		'current' 	=> max( 1, $args['paged'] ),
		'total' 	=> $args['total'],
		'prev_next'	=> true,
		'prev_text'	=> '&laquo; '.__('Previous', 'wp-team-showcase-and-slider'),
		'next_text'	=> __('Next', 'wp-team-showcase-and-slider').' &raquo;',
	));
	return paginate_links($paging);
}

/**
 * Function to get old browser
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.2.1
 */
function wp_tsasp_old_browser() {
	global $is_IE, $is_safari, $is_edge;

	// Only for safari
	$safari_browser = wp_tsasp_check_browser_safari();

	if( $is_IE || $is_edge || ($is_safari && (isset($safari_browser['version']) && $safari_browser['version'] <= 7.1)) ) {
		return true;
	}
	return false;
}

/**
 * Determine if the browser is Safari or not (last updated 1.7)
 * @return boolean True if the browser is Safari otherwise false
 */
function wp_tsasp_check_browser_safari() {
	
	// Takinf some variables
	$browser 	= array();
	$user_agent = isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";

    if (stripos($user_agent, 'Safari') !== false && stripos($user_agent, 'iPhone') === false && stripos($user_agent, 'iPod') === false) {
        $aresult = explode('/', stristr($user_agent, 'Version'));
        if (isset($aresult[1])) {
            $aversion = explode(' ', $aresult[1]);
            $browser['version'] = ($aversion[0]);
        } else {
        	$browser['version'] = '';
        }
        $browser['browser'] = 'safari';
    }
    return $browser;
}

/**
 * Function to get `wp-team` shortcode designs
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_designs() {
	$design_arr = array(
						'design-1'	=> __('Design 1', 'wp-team-showcase-and-slider'),
						'design-2'	=> __('Design 2', 'wp-team-showcase-and-slider'),
						'design-3'	=> __('Design 3', 'wp-team-showcase-and-slider'),
						'design-4'	=> __('Design 4', 'wp-team-showcase-and-slider'),
						'design-5'	=> __('Design 5', 'wp-team-showcase-and-slider'),
						'design-6'	=> __('Design 6', 'wp-team-showcase-and-slider'),
						'design-7'	=> __('Design 7', 'wp-team-showcase-and-slider'),
						'design-8'	=> __('Design 8', 'wp-team-showcase-and-slider'),
						'design-9'	=> __('Design 9', 'wp-team-showcase-and-slider'),
						'design-10'	=> __('Design 10', 'wp-team-showcase-and-slider'),
						'design-11'	=> __('Design 11', 'wp-team-showcase-and-slider'),
						'design-12'	=> __('Design 12', 'wp-team-showcase-and-slider'),
						'design-13'	=> __('Design 13', 'wp-team-showcase-and-slider'),
						'design-14'	=> __('Design 14', 'wp-team-showcase-and-slider'),
						'design-15'	=> __('Design 15', 'wp-team-showcase-and-slider'),
						'design-16'	=> __('Design 16', 'wp-team-showcase-and-slider'),
						'design-17'	=> __('Design 17', 'wp-team-showcase-and-slider'),
						'design-18'	=> __('Design 18', 'wp-team-showcase-and-slider'),
						'design-19'	=> __('Design 19', 'wp-team-showcase-and-slider'),
						'design-20'	=> __('Design 20', 'wp-team-showcase-and-slider'),
						'design-21'	=> __('Design 21', 'wp-team-showcase-and-slider'),
						'design-22'	=> __('Design 22', 'wp-team-showcase-and-slider'),
						'design-23'	=> __('Design 23', 'wp-team-showcase-and-slider'),
						'design-24'	=> __('Design 24', 'wp-team-showcase-and-slider'),
						'design-25'	=> __('Design 25', 'wp-team-showcase-and-slider'),
					);
	return apply_filters('wp_tsasp_designs', $design_arr );
}

/**
 * Function to get `wp-team-slider` shortcode designs
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_slider_designs() {
	$design_arr = array(
						'design-1'	=> __('Design 1', 'wp-team-showcase-and-slider'),
						'design-2'	=> __('Design 2', 'wp-team-showcase-and-slider'),
						'design-3'	=> __('Design 3', 'wp-team-showcase-and-slider'),
						'design-4'	=> __('Design 4', 'wp-team-showcase-and-slider'),
						'design-5'	=> __('Design 5', 'wp-team-showcase-and-slider'),
						'design-6'	=> __('Design 6', 'wp-team-showcase-and-slider'),
						'design-7'	=> __('Design 7', 'wp-team-showcase-and-slider'),
						'design-8'	=> __('Design 8', 'wp-team-showcase-and-slider'),
						'design-9'	=> __('Design 9', 'wp-team-showcase-and-slider'),
						'design-10'	=> __('Design 10', 'wp-team-showcase-and-slider'),
						'design-11'	=> __('Design 11', 'wp-team-showcase-and-slider'),
						'design-12'	=> __('Design 12', 'wp-team-showcase-and-slider'),
						'design-13'	=> __('Design 13', 'wp-team-showcase-and-slider'),
						'design-14'	=> __('Design 14', 'wp-team-showcase-and-slider'),
						'design-15'	=> __('Design 15', 'wp-team-showcase-and-slider'),
						'design-16'	=> __('Design 16', 'wp-team-showcase-and-slider'),
						'design-17'	=> __('Design 17', 'wp-team-showcase-and-slider'),
						'design-18'	=> __('Design 18', 'wp-team-showcase-and-slider'),
						'design-19'	=> __('Design 19', 'wp-team-showcase-and-slider'),
						'design-20'	=> __('Design 20', 'wp-team-showcase-and-slider'),
						'design-21'	=> __('Design 21', 'wp-team-showcase-and-slider'),
						'design-22'	=> __('Design 22', 'wp-team-showcase-and-slider'),
						'design-23'	=> __('Design 23', 'wp-team-showcase-and-slider'),
						'design-24'	=> __('Design 24', 'wp-team-showcase-and-slider'),
						'design-25'	=> __('Design 25', 'wp-team-showcase-and-slider'),
					);
	return apply_filters('wp_tsasp_slider_designs', $design_arr );
}