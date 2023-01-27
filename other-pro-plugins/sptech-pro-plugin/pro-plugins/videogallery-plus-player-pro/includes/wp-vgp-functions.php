<?php
/**
 * Plugin generic functions file
 *
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_default_settings() {
	
	global $wp_vgp_options;
	
	$wp_vgp_options = array(
		'default_img'		=> '',
		'custom_css' 		=> '',
		'yt_autoplay'		=> 0,
		'yt_hide_controls'	=> 0,
		'yt_hide_fullscreen'=> 0,
		'yt_hide_related'	=> 0,
		'yt_hide_showinfo'	=> 0,
		'yt_subtitles'		=> 0,
		'yt_pb_color'		=> '',
		'vm_autoplay'		=> 0,
		'vm_loop'			=> 0,
		'vm_hide_title'		=> 0,
		'vm_hide_author'	=> 0,
		'vm_color'			=> '',
		'dly_autoplay'		=> 0,
		'dly_hide_controls'	=> 0,
		'dly_hide_showinfo'	=> 0,
		'dly_theme'			=> '',
		'dly_hide_logo'		=> 0,
		'dly_color'			=> '',
		'dly_hide_sharing'	=> 0,
		'dly_hide_related'	=> 0,
		'jwp_enable'		=> 0,
		'jwp_licence_key'	=> '',
	);

	$default_options = apply_filters('wp_vgp_options_default_values', $wp_vgp_options );
	
	// Update default options
	update_option( 'wp_vgp_options', $default_options );

	// Overwrite global variable when option is update
	$wp_vgp_options = wp_vgp_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_get_settings() {
	
	$options = get_option('wp_vgp_options');
	
	$settings = is_array($options) 	? $options : array();
	
	return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_get_option( $key = '', $default = false ) {
	global $wp_vgp_options;

	$value = ! empty( $wp_vgp_options[ $key ] ) ? $wp_vgp_options[ $key ] : $default;
	$value = apply_filters( 'wp_vgp_get_option', $value, $key, $default );
	return apply_filters( 'wp_vgp_get_option_' . $key, $value, $key, $default );
}

/**
 * Function to get unique number
 * 
 * @package Video gallery and Player Pro
 * @since 1.0
 */ 
 function wp_vgp_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_add_array(&$array, $value, $index, $from_last = false) {
    
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
 * Strip Slashes From Array
 *
 * @package  Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_slashes_deep($data = array(), $flag = false) {
	if($flag != true) {
		$data = wp_vgp_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('wp_vgp_nohtml_kses', $data);
		
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
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Function to get grid column based on grid
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_grid_column( $grid = '' ) {
	
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
 * Function to get post featured image
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_get_post_image( $post_id = '', $size = 'full', $default_img = false ) {

    $prefix = WP_VGP_META_PREFIX; // Taking metabox prefix
    $size   = !empty($size) ? $size : 'full';

    // Getting poster image
    $image = get_post_meta( $post_id, $prefix.'poster_img', true);

    if( empty($image) ) {
    	$image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );
        $image 	= isset($image[0]) ? $image[0] : '';
    }

    // Getting default image
    if( $default_img && empty($image) ) {
        $image = wp_vgp_get_option( 'default_img' );
    }

    return $image;
}

/**
 * Function to get pagination
 * 
 * @package Video gallery and Player Pro
 * @since 1.2.1
 */
function wp_vgp_pagination( $args = array() ) {

	$big = 999999999; // need an unlikely integer

	$paging = apply_filters('wp_vgp_paging_args', array(
				            'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				            'format'    => '?paged=%#%',
				            'current'   => max( 1, $args['paged'] ),
				            'total'     => $args['total'],
				            'prev_next' => true,
				            'prev_text' => '&laquo; '.__('Previous', 'html5-videogallery-plus-player'),
				            'next_text' => __('Next', 'html5-videogallery-plus-player').' &raquo;',
				        ));
	return paginate_links($paging);
}

/**
 * Get embed URL from the link
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_get_embed_url( $url, $only_embed = false ) {

	// Taking some defaults
	$result_url = false;
	$video_type = '';

	if(empty($url)) return $result_url;

	// Youtube
	if( strpos( $url, 'youtube' ) !== false ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data['query']) ) {
			$video_type 		= 'youtube';
			$decode_url_data 	= parse_str( $url_data['query'], $output );
			$result_url 		= !empty($output['v']) ? 'https://www.youtube.com/embed/'.$output['v'] : '';
		}
	}

	// Youtube Short URL
	if( strpos( $url, 'youtu.be' ) !== false ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data) ) {
			$video_type 		= 'youtube';
			$decode_url_data 	= explode('/', end($url_data));
			$result_url 		= !empty($decode_url_data) ? 'https://www.youtube.com/embed/'.end($decode_url_data) : '';
		}
	}

	// Vimeo
	if( strpos( $url, 'vimeo' ) !== false ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data['path']) ) {
			$video_type 		= 'vimeo';
			$decode_url_data 	= explode('/', $url_data['path']);
			$result_url 		= !empty($decode_url_data) ? 'https://player.vimeo.com/video/'.end($decode_url_data) : '';
		}
	}

	// Daily Motion
	if( strpos( $url, 'dailymotion' ) !== false ) {
		
		$url_data = explode('/', $url);

		if( !empty($url_data) ) {
			$video_type			= 'dailymotion';
			$decode_url_data 	= explode('_', end($url_data));
			$result_url 		= !empty($decode_url_data) ? 'https://www.dailymotion.com/embed/video/'.current($decode_url_data) : '';
		}
	}

	// Daily Motion Short URL
	if( strpos( $url, 'dai.ly' ) !== false ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data) ) {
			$video_type			= 'dailymotion';
			$decode_url_data 	= explode('/', end($url_data));
			$result_url 		= !empty($decode_url_data) ? 'https://www.dailymotion.com/embed/video/'.end($decode_url_data) : '';
		}
	}

	// Vzaar Short URL
	if( strpos( $url, '//vzaar' ) !== false ) {
		
		$url_data = parse_url($url);

		if( !empty($url_data) ) {
			$decode_url_data 	= explode('/', end($url_data));
			$result_url 		= !empty($decode_url_data) ? 'https://view.vzaar.com/'.end($decode_url_data).'/player' : '';
		}
	}
	
	// Set video parameter with url
	if( !$only_embed ) {
		$result_url = wp_vgp_set_video_params( $result_url, $video_type );
	}

	$result_url = !empty($result_url) ? $result_url : $url;

	return $result_url;
}

/**
 * Function to get video shortcode designs
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_designs() {
	$design_arr = array(
						'design-1'	=> __('Design 1', 'html5-videogallery-plus-player'),
						'design-2'	=> __('Design 2', 'html5-videogallery-plus-player'),
						'design-3'	=> __('Design 3', 'html5-videogallery-plus-player'),
						'design-4'	=> __('Design 4', 'html5-videogallery-plus-player'),
						'design-5'	=> __('Design 5', 'html5-videogallery-plus-player'),
						'design-6'	=> __('Design 6', 'html5-videogallery-plus-player'),
						'design-7'	=> __('Design 7', 'html5-videogallery-plus-player'),
						'design-8'	=> __('Design 8', 'html5-videogallery-plus-player'),
						'design-9'	=> __('Design 9', 'html5-videogallery-plus-player'),
						'design-10'	=> __('Design 10', 'html5-videogallery-plus-player'),
						'design-11'	=> __('Design 11', 'html5-videogallery-plus-player'),
						'design-12'	=> __('Design 12', 'html5-videogallery-plus-player'),
						'design-13'	=> __('Design 13', 'html5-videogallery-plus-player'),
						'design-14'	=> __('Design 14', 'html5-videogallery-plus-player'),
						'design-15'	=> __('Design 15', 'html5-videogallery-plus-player'),
						'design-16'	=> __('Design 16', 'html5-videogallery-plus-player'),
						'design-17'	=> __('Design 17', 'html5-videogallery-plus-player'),
						'design-18'	=> __('Design 18', 'html5-videogallery-plus-player'),
						'design-19'	=> __('Design 19', 'html5-videogallery-plus-player'),
					);
	return apply_filters('wp_vgp_designs', $design_arr );
}

/**
 * Function to get video link
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_get_video_data( $post_id = '' ) {

	$prefix 	= WP_VGP_META_PREFIX;
	$video_link = '';

	if( empty($post_id) ) return $video_link;

	// Youtube video
	$video_link = get_post_meta($post_id, $prefix.'video_yt', true);
	$video_type = 'youtube';

	// Vimeo link
	if( empty($video_link) ){
		$video_link = get_post_meta($post_id, $prefix.'video_vm', true);
		$video_type = 'vimeo';
	}

	// Dailymotion link
	if( empty($video_link) ){
		$video_link = get_post_meta($post_id, $prefix.'video_dly', true);
		$video_type = 'dailymotion';
	}

	// Other link
	if( empty($video_link) ){
		$video_link = get_post_meta($post_id, $prefix.'video_oth', true);
		$video_type = 'other';
	}

	// HTML5 video
	if( empty($video_link) ) {
		$video_link['mp4'] 	= get_post_meta($post_id, $prefix.'video_mp4', true);
		$video_link['webm'] = get_post_meta($post_id, $prefix.'video_wbbm', true);
		$video_link['ogg'] 	= get_post_meta($post_id, $prefix.'video_ogg', true);
		$video_type 		= 'html5';
	}

	$video_data = array(
						'link' 			=> $video_link,
						'embed_link'	=> !is_array($video_link) ? wp_vgp_get_embed_url($video_link) : false,
						'video_type'	=> $video_type,
					);

	return $video_data;
}

/**
 * Set video parameters in video embed URL
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_set_video_params( $url, $type = '' ) {
	
	if( empty($url) || empty($type) ) {
		return $url;
	}

	if( $type == 'youtube' ) {

		$yt_autoplay 		= (wp_vgp_get_option('yt_autoplay') == 1 ) 			? true 	: false;
		$yt_hide_controls 	= (wp_vgp_get_option('yt_hide_controls') == 1)		? 0		: false;
		$yt_hide_fullscreen = (wp_vgp_get_option('yt_hide_fullscreen') == 1)	? 0		: false;
		$yt_hide_related 	= (wp_vgp_get_option('yt_hide_related') == 1)		? 0		: false;
		$yt_hide_showinfo 	= (wp_vgp_get_option('yt_hide_showinfo') == 1)		? 0		: false;

		$yt_args = array(
							'autoplay'			=> $yt_autoplay,
							'controls'			=> $yt_hide_controls,
							'fs'				=> $yt_hide_fullscreen,
							'rel'				=> $yt_hide_related,
							'showinfo'			=> $yt_hide_showinfo,
							'cc_load_policy'	=> wp_vgp_get_option('yt_subtitles'),
							'color'				=> wp_vgp_get_option('yt_pb_color'),
						);
		$url = add_query_arg( $yt_args, $url );
	
	} elseif ($type == 'vimeo') {

		$vm_autoplay 		= (wp_vgp_get_option('vm_autoplay') == 1 ) 			? true 	: false;
		$vm_hide_title 		= (wp_vgp_get_option('vm_hide_title') == 1 ) 		? 0 	: false;
		$vm_hide_author 	= (wp_vgp_get_option('vm_hide_author') == 1 ) 		? 0 	: false;
		$vm_player_clr 		= wp_vgp_get_option('vm_color');

		$vm_args = array(
							'autoplay'			=> $vm_autoplay,
							'title'				=> $vm_hide_title,
							'byline'			=> $vm_hide_author,
							'loop'				=> wp_vgp_get_option('vm_loop'),
							'color'				=> !empty($vm_player_clr) ? str_replace('#', '', $vm_player_clr) : false
						);
		$url = add_query_arg( $vm_args, $url );
	
	} elseif ( $type == 'dailymotion' ) {

		$dly_autoplay 		= (wp_vgp_get_option('dly_autoplay') == 1 ) 			? true 	: false;
		$dly_hide_controls 	= (wp_vgp_get_option('dly_hide_controls') == 1)			? 0		: false;
		$dly_hide_showinfo 	= (wp_vgp_get_option('dly_hide_showinfo') == 1)			? 0		: false;
		$dly_hide_logo 		= (wp_vgp_get_option('dly_hide_logo') == 1)				? 0		: false;
		$dly_hide_sharing 	= (wp_vgp_get_option('dly_hide_sharing') == 1)			? 0		: false;
		$dly_hide_related 	= (wp_vgp_get_option('dly_hide_related') == 1)			? 0		: false;
		$dly_player_clr 	= wp_vgp_get_option('dly_color');

		$dly_args = array(
							'autoplay'				=> $dly_autoplay,
							'controls'				=> $dly_hide_controls,
							'ui-start-screen-info'	=> $dly_hide_showinfo,
							'ui-logo'				=> $dly_hide_logo,
							'sharing-enable'		=> $dly_hide_sharing,
							'endscreen-enable'		=> $dly_hide_related,
							'ui-theme'				=> wp_vgp_get_option('dly_theme'),
							'ui-highlight'			=> !empty($dly_player_clr) ? str_replace('#', '', $dly_player_clr) : false
						);
		$url = add_query_arg( $dly_args, $url );
	}

	return $url;
}