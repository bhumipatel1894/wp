<?php
/**
 * 'iscwp-grid' Shortcode
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function iscwp_pro_grid( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'username'							=> '',
		'grid'    							=> '3',
		'popup_user_avatar'					=> 'true',
		'popup_insta_link' 					=> 'true',
		'instagram_link_text' 				=> '',
		'design' 							=> 'design-1',
		'limit'								=> '',
		'offset'							=> '',
		'link_target'						=> 'self',
		'gallery_height'					=> '',
		'show_caption'						=> 'true',
		'popup'								=> 'true',
		'popup_gallery'						=> 'true',
		'show_likes_count'					=> 'true',
		'show_comments_count'				=> 'true',
		'show_comments'						=> 'true',
		'show_user_info' 					=> 'false',
		'image_fit' 						=> 'false',
		), $atts));

	$shortcode_designs 				= iscwp_pro_designs();
	$username						= !empty($username)					? trim($username) 					: '';
	$grid 							= (!empty($grid) && $grid <= 12) 	? $grid 							: '3';
	$popup_user_avatar				= ($popup_user_avatar == 'true')	? 1									: 0;
	$popup_insta_link				= ($popup_insta_link == 'true')		? 1									: 0;
	$instagram_link_text 			= !empty($instagram_link_text)		? $instagram_link_text 				: __('View On Instagram', 'instagram-slider-and-carousel-plus-widget');
	$design 						= ($design && (array_key_exists(trim($design), $shortcode_designs))) 	? trim($design) : 'design-1';
	$limit 							= (is_numeric($limit) && $limit >= 0)	? $limit 						: 20;
	$offset 						= (is_numeric($offset) && $offset >= 0)	? $offset 						: '';
	$offset_css						= ($offset != '')					? "padding:{$offset}px;"			: '';
	$link_target 					= ($link_target == 'blank') 		? '_blank' 							: '_self';
	$popup_gallery					= ($popup_gallery == 'true')		? 'true'							: 'false';
	$gallery_height					= ($gallery_height > 0)				? $gallery_height 					: '';
	$show_caption					= ($show_caption == 'false')		? 'false'							: 'true';
	$popup							= ($popup == 'false')				? 0									: 1;
	$show_likes_count				= ($show_likes_count == 'false')	? 'false'							: 'true';
	$show_comments_count			= ($show_comments_count == 'false')	? 'false'							: 'true';
	$show_comments					= ($show_comments == 'false')		? 'false'							: 'true';
	$show_user_info					= ($show_user_info == 'true')		? 1									: 0;
	$height_css 					= !empty($gallery_height) 			? "height:{$gallery_height}px;" 	: '';
	$image_fit 						= ($image_fit == 'true') 			? 1 								: 0;

	// If no username is passed then return
	if( empty($username) ) {
		return $content;
	}

	// Design file
	$design_file_path 	= ISCWP_PRO_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';

	// Taking some variables
	$popup_html 	 	 = '';
	$loop_count		 	 = 1;
	$count 				 = 1;
	$unique			 	 = iscwp_pro_get_unique();
	$old_browser		 = iscwp_pro_old_browser();

	$main_wrpper_cls	= "iscwp-gallery-grid iscwp-grid-{$grid} iscwp-{$design}";
	$main_wrpper_cls 	.= ($popup) 				? ' iscwp-popup-gallery' 	: '';
	$main_wrpper_cls	.= ($old_browser) 			? ' iscwp-old-browser' 		: '';
	$main_wrpper_cls 	.= ($image_fit) 			? ' iscwp-image-fit' 		: '';

	$instagram_data 	 = iscwp_pro_get_user_media($username, $limit);
	$instagram_link_main = 'https://www.instagram.com/';
	$instagram_link 	 = '';

	// User details
	$userdata = array(
			'username' 			=>	(!empty($instagram_data['iscwp_user_data']['username'])) 			? $instagram_data['iscwp_user_data']['username'] 		: '',
			'full_name'			=>	(!empty($instagram_data['iscwp_user_data']['full_name'])) 			? $instagram_data['iscwp_user_data']['full_name'] 		: '',
			'profile_picture'	=>	(!empty($instagram_data['iscwp_user_data']['profile_pic_url']) ) 	? $instagram_data['iscwp_user_data']['profile_pic_url'] : '',
		);

	// Popup Configuration
	$popup_conf = compact( 'popup_gallery' );

	// Enqueue required script
	if( $popup ) {
		wp_enqueue_script('wpos-magnific-script');
	}
	if( $popup || ($image_fit && $old_browser) ) {
		wp_enqueue_script('iscwp-pro-public-js');
	}

	ob_start();

	if(!empty($instagram_data)) { ?>

	<div class="iscwp-main-wrp iscwp-clearfix">

		<?php if($show_user_info) {
			include(ISCWP_PRO_DIR . '/templates/user-details.php');
		} ?>

		<div id="iscwp-gallery-<?php echo $unique; ?>" class="<?php echo $main_wrpper_cls; ?> iscwp-clearfix">
			<div class="iscwp-outer-wrap">

				<?php foreach ($instagram_data['items'] as $iscwp_key => $iscwp_data) {

					$iscwp_data 		= iscwp_pro_image_data($iscwp_data);
					$comment_data 		= $iscwp_data['comment_data'];
					$gallery_img_src 	= $iscwp_data['img_src'];
					$data_type 			= $iscwp_data['data_type'];
					$iscwp_likes 		= $iscwp_data['iscwp_likes'];
					$iscwp_comments 	= $iscwp_data['iscwp_comments'];
					$instagram_link 	= $iscwp_data['instagram_link'];
					$img_caption 		= $iscwp_data['img_caption'];
					$location 			= $iscwp_data['location_name'];
					$iscwp_link_value 	= ($popup) ? 'javascript:void(0);' : $instagram_link;

					$wrpper_cls	   		= "iscwp-cnt-wrp iscwp-col-{$grid} iscwp-columns";
					$wrpper_cls			.= ($loop_count == 1) ? " iscwp-first"	: '';

					if( $design_file ) {
						include( $design_file );
					}

					// Creating Popup HTML
					if( $popup ) {
						ob_start();
						include( ISCWP_PRO_DIR . '/templates/popup/design-1.php' );
						$popup_html .= ob_get_clean();
					}

					// If reach to limit then break
					if($limit == $count) {
						break;
					}

					$count++;
					$loop_count++; // Increment loop count for grid

					// Reset loop count
					if( $loop_count == $grid ) {
						$loop_count = 0;
					}
				} ?>
				</div>
			</div>

			<?php if($popup) { ?>
			<div class="wp-iscwp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
			<?php } ?>
		</div>
		<?php }

	echo $popup_html; // Printing popup html

	$content .= ob_get_clean();
	return $content;
}

// 'iscwp-grid' shortcode
add_shortcode('iscwp-grid', 'iscwp_pro_grid');