<?php
/**
 * Plugin generic functions file
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Update default settings
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_default_settings() {
    
    global $iscwp_pro_options;
    
    $iscwp_pro_options = array(
        'cache_time'   				=> '21600',
        'custom_css'    			=> '',
        'wp_iscwp_cache_transient' 	=> array(),
    );

    $default_options = apply_filters('iscwp_options_default_values', $iscwp_pro_options );

    // Update default options
    update_option( 'iscwp_pro_options', $default_options );

    // Overwrite global variable when option is update
    $iscwp_pro_options = iscwp_pro_get_settings();
}

/**
 * Get Settings From Option Page
 * 
 * Handles to return all settings value
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_get_settings() {
  
    $options    = get_option('iscwp_pro_options');
    $settings   = is_array($options)  ? $options : array();

    return $settings;
}

/**
 * Get an option
 * Looks to see if the specified setting exists, returns default if not
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_get_option( $key = '', $default = false ) {
    global $iscwp_pro_options;

    $value = ! empty( $iscwp_pro_options[ $key ] ) ? $iscwp_pro_options[ $key ] : $default;
    $value = apply_filters( 'iscwp_get_option', $value, $key, $default );

    return apply_filters( 'iscwp_get_option_' . $key, $value, $key, $default );
}

/**
 * Function to get unique number
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */ 
 function iscwp_pro_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Strip Slashes From Array
 *
 * @package  Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_slashes_deep($data = array(), $flag = false) {
	if($flag != true) {
		$data = iscwp_pro_nohtml_kses($data);
	}
	$data = stripslashes_deep($data);
	return $data;
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_nohtml_kses($data = array()) {
	
	if ( is_array($data) ) {
		
		$data = array_map('iscwp_pro_nohtml_kses', $data);
		
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
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Function to get grid column based on grid
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_grid_column( $grid = '' ) {

	if($grid == '2') {
		$grid_clmn = '6';
	} else if($grid == '3') {
		$grid_clmn = '4';
	}  else if($grid == '4') {
		$grid_clmn = '3';
	} else if ($grid == '1') {
		$grid_clmn = '12';
	} else {
		$grid_clmn = '4';
	}
	return $grid_clmn;
}

/**
 * Function to get user media based on instagram @username
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_get_instagram_media( $username = '', $max_id = '' ) {

	// Taking some defaults
	$result		= array();
	$username 	= !empty($username) ? trim($username) 	: '';
	$max_id 	= !empty($max_id) 	? trim($max_id) 	: false;

	if( $username ) {

		$api_url 	= "https://www.instagram.com/{$username}/media/";
		$api_url	= add_query_arg( array( 'max_id' => $max_id ), $api_url );

		$api_args	= array( 'timeout' => 15, 'sslverify' => false );

		$response = wp_remote_get( $api_url, $api_args );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code($response) !== 200 ) {
			return $result;
		}

		$response_data 		= wp_remote_retrieve_body($response);
		$response_data_arr 	= json_decode($response_data, true); // Convert object to array

		if( !empty( $response_data_arr['items'] ) ) {
			$result = $response_data_arr;
		}
	}
	return $result;
}

/**
 * Function to get user details
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_get_user_details($username = '') {

	// Taking some defaults
	$result		= array();
	$username 	= !empty($username) ? trim($username) 	: '';

	if( $username ) {

		$api_url 	= "https://www.instagram.com/{$username}/?__a=1";
		$api_args	= array( 'timeout' => 15, 'sslverify' => false );

		$response = wp_remote_get( $api_url, $api_args );

		// make sure the response came back okay
		if ( is_wp_error( $response ) || wp_remote_retrieve_response_code($response) !== 200 ) {
			return $result;
		}

		$response_data 		= wp_remote_retrieve_body($response);
		$response_data_arr 	= json_decode($response_data, true); // Convert object to array

		// Taking only needed data
		if( !empty($response_data_arr) ) {
			$result['username']			= $response_data_arr['user']['username'];
			$result['full_name'] 		= $response_data_arr['user']['full_name'];
			$result['profile_pic_url'] 	= $response_data_arr['user']['profile_pic_url'];
			$result['follows_count'] 	= $response_data_arr['user']['follows']['count'];
			$result['media_count'] 		= $response_data_arr['user']['media']['count'];
			$result['followed_by'] 		= $response_data_arr['user']['followed_by']['count'];
			$result['biography'] 		= $response_data_arr['user']['biography'];
		}
	}
	return $result;
}

/**
 * Function to get user media based on instagram @username
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_get_user_media( $username = '', $limit = '', $max_id = '', $cache = true, &$result = array() ) {

	// Taking some defaults
	$result_data	= array();
	$username 		= !empty($username) ? trim($username) 	: '';
	$transient_key 	= "wp_iscwp_media_{$username}";
	$cache_time 	= iscwp_pro_get_option('cache_time');

	// If username is there
	if( $username ) {

		$stored_transient 	= get_transient( $transient_key );
		$stored_transient	= !empty($stored_transient) ? json_decode($stored_transient, true) : false;
		$stored_limit		= !empty($stored_transient['items']) ? count($stored_transient['items']) : '';

		if( $stored_transient === false || ($stored_transient && $stored_limit < $limit && $cache) || (!$cache) ) {

			$limit 				= !empty($limit) 	? trim($limit) 		: 15;
			$limit				= ($limit >= 60)	? 60				: $limit;
			$user_data 			= iscwp_pro_get_instagram_media( $username, $max_id );

			if( !empty( $user_data ) ) {

				$total_photo 		= count( $user_data['items'] );
				$last_photo_data	= end( $user_data['items'] );
				$last_photo_id		= isset( $last_photo_data['id'] ) ? $last_photo_data['id'] : '';

				if( $total_photo < $limit && (!empty($user_data['more_available'])) ) {

					$limit = ( $limit - $total_photo );

					if( $limit > 0 ) {
						$user_data 			= iscwp_pro_merge_user_medias( $user_data, $result );
						$result_data 		= iscwp_pro_get_user_media( $username, $limit, $last_photo_id, false, $user_data );
					}
				} else {
					$result_data = iscwp_pro_merge_user_medias( $user_data, $result );
				}
			}

			// Cache the data if final result is there
			if( $cache && $result_data ) {
				
				// Only store keys to remove stored cache in case
				$cache_transient 	= get_option( 'wp_iscwp_cache_transient', array() );
				$cache_transient[] 	= $transient_key;
				$cache_transient 	= array_unique($cache_transient);
				update_option( 'wp_iscwp_cache_transient', $cache_transient );

				$result_data['iscwp_user_data'] = iscwp_pro_get_user_details($username); // Getting user details
				set_transient( $transient_key, json_encode($result_data), $cache_time );
			}
		} else {
			$result_data = $stored_transient;
		}
	} // End of main if
	return $result_data;
}

/**
 * Function to merge instagram user medias on multiple call
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_merge_user_medias( $media_1, $media_2 ) {
	$final_media = array();

	if( isset($media_1['items']) && isset($media_2['items']) ) {

		$final_media 		= array_merge( $media_2['items'], $media_1['items'] );
		$media_1['items'] 	= $final_media;
		$final_media 		= $media_1;

	} elseif( isset($media_1['items']) && empty($media_2) ) {

		$final_media = $media_1;

	} elseif( isset($media_2['items']) && empty($media_1) ) {
		$final_media = $media_2;
	}

	return $final_media;
}

/**
 * Function to return numeric value in words
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_nice_number($n) {
    
    // first strip any formatting;
    $n = (0+str_replace(",", "", $n));

    // is this a number?
    if (!is_numeric($n)) return false;

    // now filter it;
    elseif ($n > 1000000) return round(($n/1000000), 2).'m';

    return number_format($n);
}

/**
 * Function to get old browser
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_old_browser() {
	global $is_IE, $is_safari, $is_edge;

	// Only for safari
	$safari_browser = iscwp_pro_check_browser_safari();

	if( $is_IE || $is_edge || ($is_safari && (isset($safari_browser['version']) && $safari_browser['version'] <= 7.1)) ) {
		return true;
	}
	return false;
}

/**
 * Determine if the browser is Safari or not (last updated 1.7)
 * @return boolean True if the browser is Safari otherwise false
 */
function iscwp_pro_check_browser_safari() {
	
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
 * Function to get `igsp-gallery` shortcode designs
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function  iscwp_pro_designs() {
    $design_arr = array(
                    'design-1'  => __('Design 1', 'instagram-slider-and-carousel-plus-widget'),
                    'design-2'  => __('Design 2', 'instagram-slider-and-carousel-plus-widget'),
                    'design-3'  => __('Design 3', 'instagram-slider-and-carousel-plus-widget'),
                    'design-4'  => __('Design 4', 'instagram-slider-and-carousel-plus-widget'),
                    'design-5'  => __('Design 5', 'instagram-slider-and-carousel-plus-widget'),
                    'design-6'  => __('Design 6', 'instagram-slider-and-carousel-plus-widget'),
                    'design-7'  => __('Design 7', 'instagram-slider-and-carousel-plus-widget'),
                    'design-8'  => __('Design 8', 'instagram-slider-and-carousel-plus-widget'),
                    'design-9'  => __('Design 9', 'instagram-slider-and-carousel-plus-widget'),
                    'design-10'  => __('Design 10', 'instagram-slider-and-carousel-plus-widget'),
                );
    return apply_filters('iscwp_pro_designs', $design_arr );
}

/**
 * Function to get iscpw grid block designs
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function  iscwp_pro_block_designs() {
    $design_arr = array(
                    'design-1'  => __('Design 1', 'instagram-slider-and-carousel-plus-widget'),
                    'design-2'  => __('Design 2', 'instagram-slider-and-carousel-plus-widget'),
                    'design-3'  => __('Design 3', 'instagram-slider-and-carousel-plus-widget'),
                );
    return apply_filters('iscwp_pro_block_designs', $design_arr );
}

/**
 * Function to get iscpw grid block designs
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function  iscwp_pro_flush_interval() {
    $flush_interval = array(
                    '10800'  => __('3 Hours', 'instagram-slider-and-carousel-plus-widget'),
					'21600'  => __('6 Hours', 'instagram-slider-and-carousel-plus-widget'),
					'32400'  => __('9 Hours', 'instagram-slider-and-carousel-plus-widget'),
					'43200'  => __('12 Hours', 'instagram-slider-and-carousel-plus-widget'),
					'86400'  => __('1 Day', 'instagram-slider-and-carousel-plus-widget'),
					'172800' => __('2 Days', 'instagram-slider-and-carousel-plus-widget'),
				);
    return apply_filters('iscwp_pro_flush_interval', $flush_interval );
}

/**
 * Function to get `igsp-gallery` shortcode designs
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_format_number($number) {  
    if($number >= 1000) {
       return floor($number/1000) . "k";   // NB: you will want to round this  
    }  
    else {  
        return $number;  
    }  
}

/**
 * Function to gather instagram information
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_image_data( $iscwp_data = array() ) {

	// Taking some defaults
	$iscwp_img_data['image_link'] 		= '';
	$iscwp_img_data['gallery_img_src'] 	= '';
	$iscwp_img_data['iscwp_likes'] 		= 0;
	$iscwp_img_data['iscwp_comments'] 	= 0;
	$iscwp_img_data['location_name'] 	= '';
	$iscwp_img_data['img_caption']		= '';
	$iscwp_img_data['comment_data'] 	= array();
	$comment_data 						= array();
	$result 							= array();

	if(!empty($iscwp_data)) {

		if(!empty($iscwp_data['location'])){
			$iscwp_img_data['location_name'] = $iscwp_data['location']['name'];
		}

		if(!empty($iscwp_data['images'])){
			$gallery_img_src = $iscwp_data['images']['standard_resolution']['url'];
		}

		$iscwp_img_data['image_link'] 			= $gallery_img_src;
		$iscwp_img_data['img_src'] 				= $gallery_img_src;
		$iscwp_img_data['instagram_link_code'] 	= $iscwp_data['code'];
		$iscwp_img_data['instagram_link'] 		= $iscwp_data['link'];
		$iscwp_img_data['data_type'] 			= $iscwp_data['type'];

		if($iscwp_data['type'] == 'video') {
			$iscwp_img_data['video_url'] = $iscwp_data['videos']['standard_resolution']['url'];
		}

		// get numbers of comment
		if(!empty($iscwp_data['comments'])){
			$iscwp_img_data['iscwp_comments'] = iscwp_pro_format_number($iscwp_data['comments']['count']);
		}

		// get number  of likes 
		if(!empty($iscwp_data['likes'])){
			$iscwp_img_data['iscwp_likes'] = iscwp_pro_format_number($iscwp_data['likes']['count']);
		}

		// caption
		if(!empty($iscwp_data['caption'])){
			$iscwp_img_data['img_caption'] = $iscwp_data['caption']['text'];
		}

		if(!empty($iscwp_data['comments']['data'])){
		
			foreach ($iscwp_data['comments']['data'] as $cment_key => $comment_value) {
				
				$comment_data[] = array(
			
					'comment_text'		=> $comment_value['text'],
					'created_time'		=> $comment_value['created_time'],
					'username' 			=> $comment_value['from']['username'],
					'full_name' 		=> $comment_value['from']['full_name'],
					'profile_picture' 	=> $comment_value['from']['profile_picture']
				);
			}
			$iscwp_img_data['comment_data'] = $comment_data;
		}
		$result = $iscwp_img_data;
	}
	return $result;
}