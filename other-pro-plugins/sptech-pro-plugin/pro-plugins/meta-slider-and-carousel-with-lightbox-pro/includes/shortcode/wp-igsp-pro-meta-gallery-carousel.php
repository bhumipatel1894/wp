<?php
/**
 * 'meta_gallery_carousel' Shortcode
 * 
 * @package Meta slider and carousel with lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function msacwl_pro_gallery_carousel( $atts, $content ) {
	
	extract(shortcode_atts(array(
		'id'				=> '',
		'show_title' 		=> 'true',
		'show_caption' 		=> 'true',
		'show_description' 	=> 'true',
		'slider_height'		=> '',
		'design'			=> 'design-1',
		'slide_to_show' 	=> '2',
		'slide_to_scroll' 	=> '1',
		'autoplay' 			=> 'true',
		'autoplay_speed' 	=> '3000',
		'speed' 			=> '300',
		'loop'				=> 'true',
		'arrows' 			=> 'true',
		'dots' 				=> 'true',
		'centermode'		=> 'false',
		'popup'				=> 'true',
	), $atts));
	
	// Taking some globals
	global $post;

	$shortcode_designs 		= wp_igsp_pro_slider_designs();
	
	$gallery_id 			= !empty($id) 						? $id 				: $post->ID;
	$show_title 			= ($show_title == 'false') 			? 'false' 			: 'true';
	$show_caption 			= ($show_caption == 'false') 		? 'false' 			: 'true';
	$show_description		= ($show_description == 'false') 	? 'false' 			: 'true';
	$slider_height_css 		= (!empty($slider_height))			? "style='height:{$slider_height}px;'" : '';
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$slide_to_show			= !empty($slide_to_show) 			? $slide_to_show 	: 2;
	$slide_to_scroll		= !empty($slide_to_scroll) 			? $slide_to_scroll 	: 1;
	$autoplay 				= ($autoplay == 'false') 			? 'false' 			: 'true';
	$autoplay_speed 		= !empty($autoplay_speed) 			? $autoplay_speed 	: 3000;
	$speed 					= !empty($speed) 					? $speed 			: 300;
	$loop 					= ($loop == 'false') 				? 'false' 			: 'true';
	$arrows 				= ($arrows == 'false') 				? 'false' 			: 'true';
	$dots 					= ($dots == 'false') 				? 'false' 			: 'true';
	$popup 					= ($popup == 'false')				? 0 				: 1;

	// Getting gallery post status
	$gallery_status = get_post_status( $id );
	
	// If gallery post status is not publish then return
	if( $gallery_status != 'publish' ) {
		return $content;
	}
	
	// Shortcode file
	$gallery_path 	= WP_IGSP_PRO_DIR . '/templates/' . $design . '.php';
	$design_file 	= (file_exists($gallery_path)) ? $gallery_path : '';

	// Enqueue required script
	if( $popup ) {
		wp_enqueue_script( 'wpos-magnific-script' );
	}
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wp-igsp-public-js' );

	// Taking some variables
	$count 			= 1;
	$unique 		= wp_igsp_pro_get_unique();
	$wrapper_cls	= "msacwl-{$design}";
	$wrapper_cls 	.= ($popup) ? ' msacwl-slider-popup' : '';

	// Getting gallery images
	$images 		= get_post_meta($gallery_id, '_vdw_gallery_id', true);
	$images_count	= (!empty($images)) ? count($images) : '';

	// Slider configuration and taken care of centermode
	$slide_to_show 		= (!empty($slide_to_show) && $slide_to_show <= $images_count) ? $slide_to_show : $images_count;
	$centermode			= ($centermode == 'true' && $slide_to_show % 2 != 0) ? 'true' : 'false';
	$wrapper_cls		.= ($centermode == 'true') ? ' msacwl-center-mode' 	: '';

	// Carousel configuration
	$slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows', 'dots', 'loop', 'centermode');

	ob_start();

	if( $images ): ?>
		<div class="msacwl-carousel-wrap msacwl-row-clearfix">
			<div id="msacwl-carousel-<?php echo $unique; ?>" class="msacwl-carousel <?php echo $wrapper_cls; ?>">
				<div class="msacwl-gallery-carousel msacwl-common-slider">

					<?php foreach( $images as $image ):
						
						$post_meta_data 	= get_post($image);
						$gallery_img_src 	= wp_igsp_pro_get_image_src( $image, 'full',false );
						$image_alt_text 	= get_post_meta($image,'_wp_attachment_image_alt',true);
						$image_caption 		= $post_meta_data->post_excerpt;
						$image_content 		= $post_meta_data->post_content;
						
						if($design_file) {
		                   	include($design_file);

		                   	$count++; // Increment loop count
		                }

					endforeach; ?>
				</div>
				<div class="msacwl-carousel-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
			</div>
		</div>
	<?php endif;
	
	$content .= ob_get_clean();
	return $content;
}

// 'meta_gallery_carousel' Shortcode
add_shortcode( 'meta_gallery_carousel', 'msacwl_pro_gallery_carousel' );