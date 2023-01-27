<?php
/**
 * 'iscwp-grid-block' Shortcode
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function iscwp_pro_grid_block( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'username'							=> '',
		'design' 							=> 'design-1',
		'popup_user_avatar'					=> 'true',
		'popup_insta_link' 					=> 'true',
		'instagram_link_text' 				=> '',
		'limit'								=> '',
		'link_target'						=> 'self',
		'popup'								=> 'true',
		'popup_design'						=> 'design-1',
		'popup_gallery'						=> 'true',
		'show_caption'						=> 'true',
		'show_likes_count'					=> 'true',
		'show_comments_count'				=> 'true',
		'show_comments'						=> 'true',
		'show_user_info'					=> 'false',
		'gallery_height'					=> '',
		'image_fit' 						=> 'true',
	), $atts));

	$shortcode_designs 				= iscwp_pro_block_designs();
	$username						= !empty($username)					? $username 						: '';
	$design 						= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$popup_user_avatar				= ($popup_user_avatar == 'true')	? 1									: 0;
	$popup_insta_link				= ($popup_insta_link == 'true')		? 1									: 0;
	$instagram_link_text 			= !empty($instagram_link_text)		? $instagram_link_text 				: __('View On Instagram', 'instagram-slider-and-carousel-plus-widget');
	$limit 							= (is_numeric($limit) && $limit >= 0)	? $limit 						: 20;
	$link_target 					= ($link_target == 'blank') 		? '_blank' 							: '_self';
	$popup_design 					= !empty($popup_design) 			? $popup_design 					: 'design-1';
	$popup_gallery					= ($popup_gallery == 'true')		? 'true'							: 'false';
	$show_caption					= ($show_caption == 'false')		? 'false'							: 'true';
	$popup							= ($popup == 'false')				? 0									: 1;
	$show_likes_count				= ($show_likes_count == 'false')	? 'false'							: 'true';
	$show_comments_count			= ($show_comments_count == 'false')	? 'false'							: 'true';
	$show_comments					= ($show_comments == 'false')		? 'false'							: 'true';
	$gallery_height					= ($gallery_height > 0)				? $gallery_height 					: '';
	$show_user_info					= ($show_user_info == 'true')		? 1									: 0;
	$image_fit 						= ($image_fit == 'true') 			? 1 								: 0;

	// If no username is passed then return
	if( empty($username) ) {
		return $content;
	}

	// Design file
	$design_file_path 	= ISCWP_PRO_DIR . '/templates/block-view/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';

	// Taking some variables
	$instagram_link 		= '';
	$instagram_data 		= iscwp_pro_get_user_media($username,$limit);
	$instagram_link_main 	= 'https://www.instagram.com/';

	$unique			= iscwp_pro_get_unique();
	$old_browser	= iscwp_pro_old_browser();
	$popup_html 	= '';
	$count 			= 1;
	$grid_count 	= 1;

	$wrpper_cls			 = "iscwp-gallery-grid-block iscwp-block{$design}";
	$wrpper_cls 		.= ($popup) 				? " iscwp-popup-gallery" 	: "";
	$wrpper_cls			.= ($old_browser) 			? " iscwp-old-browser" 		: "";
	$wrpper_cls 		.= ($image_fit) 			? " iscwp-image-fit" 		: "";

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
			<div id="iscwp-gallery-<?php echo $unique; ?>" class="<?php echo $wrpper_cls;?>">

				<?php if($show_user_info) {
					include(ISCWP_PRO_DIR . '/templates/user-details.php');
				} ?>

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

						if( $design_file ) {
							include( $design_file );
						}

						// Creating Popup HTML
						if( $popup ) {
							ob_start();
							include( ISCWP_PRO_DIR . '/templates/popup/design-1.php' );
							$popup_html .= ob_get_clean();
						}

						if(($limit) == $count) {
							break;
						}

						$count++;
						$grid_count++;
					} ?>
				</div>
			</div>

			<?php if( $popup ) { ?>
			<div class="wp-iscwp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
			<?php } ?>
		</div>
	<?php }

	echo $popup_html; // Printing popup html

	$content .= ob_get_clean();
	return $content;
}

// 'iscwp-gallery' shortcode
add_shortcode('iscwp-grid-block', 'iscwp_pro_grid_block');