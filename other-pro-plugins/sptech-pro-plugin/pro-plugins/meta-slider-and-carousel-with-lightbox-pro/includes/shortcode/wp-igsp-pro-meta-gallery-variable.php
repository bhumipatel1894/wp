<?php
/**
 * 'meta_gallery_variable' Shortcode
 * 
 * @package Meta slider and carousel with lightbox
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function msacwl_pro_gallery_variable( $atts, $content ) {

	extract(shortcode_atts(array(
		'id'				=> '',
		'show_title' 		=> 'true',
		'show_caption' 		=> 'true',
		'show_description' 	=> 'true',
		'slider_height'		=> '',
		'design'			=> 'design-1',
		'autoplay' 			=> 'true',
		'autoplay_speed' 	=> '3000',
		'speed' 			=> '300',
		'loop'				=> 'true',
		'arrows' 			=> 'true',
		'dots' 				=> 'true',
		'navigation'		=> 'flase',
		'nav_slide_column'	=> 5,
		'nav_image_size'	=> 'medium',
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
	$autoplay 				= ($autoplay == 'false') 			? 'false' 			: 'true';
	$autoplay_speed 		= !empty($autoplay_speed) 			? $autoplay_speed 	: 3000;
	$speed 					= !empty($speed) 					? $speed 			: 300;
	$loop 					= ($loop == 'false') 				? 'false' 			: 'true';
	$arrows 				= ($arrows == 'false') 				? 'false' 			: 'true';
	$dots 					= ($dots == 'false') 				? 'false' 			: 'true';
	$navigation 			= ($navigation == 'true') 			? 'true' 			: 'false';
	$nav_slide_column 		= !empty($nav_slide_column) 		? $nav_slide_column : 5;
	$nav_image_size 		= !empty($nav_image_size) 			? $nav_image_size 	: 'medium';
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

	// carousel configuration
	$slider_conf = compact('autoplay', 'autoplay_speed', 'speed', 'arrows', 'dots', 'loop', 'nav_slide_column');

	// Taking some variables
	$count 				= 1;
	$unique 			= wp_igsp_pro_get_unique();
	$wrapper_cls		= "msacwl-{$design}";
	$wrapper_cls 		.= ($popup) ? ' msacwl-slider-popup' : '';
	$slider_as_nav_for  = ($navigation == 'true') ? "data-slider-nav-for='msacwl-slider-nav-{$unique}'" : '';

	// Getting gallery images
	$images = get_post_meta($gallery_id, '_vdw_gallery_id', true);

	ob_start();

	if( $images ): ?>
		
		<div class="msacwl-variable-wrap msacwl-row-clearfix">
			<div id="msacwl-variable-<?php echo $unique; ?>" class="msacwl-variable <?php echo $wrapper_cls; ?>" <?php echo $slider_as_nav_for; ?>>
				<div class="msacwl-gallery-variable msacwl-common-slider">

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
				<div class="msacwl-variable-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
			</div>
			
			<?php
			// For Navigation design
			if( $navigation == 'true' ) { ?>
		
				<div class="msacwl-slider-nav-<?php echo $unique; ?> msacwl-slider-nav <?php echo $design; ?>"><?php
					
					foreach( $images as $image ): 
					$slider_nav_img = wp_igsp_pro_get_image_src( $image, $nav_image_size, false );
					?>

					<div class="slick-image-nav"><?php
						if( $slider_nav_img ) { ?>
							<img class="msacwl-slider-nav-img" src="<?php echo $slider_nav_img; ?>" alt="<?php _e('Slider Nav Image', 'meta-slider-and-carousel-with-lightbox'); ?>" /><?php
						} ?>
					</div><?php

					endforeach; ?>
				</div>
			<?php } ?>
		</div>
	<?php endif;
	
	$content .= ob_get_clean();
	return $content;
}

// 'meta_gallery_variable' Shortcode
add_shortcode( 'meta_gallery_variable', 'msacwl_pro_gallery_variable' );