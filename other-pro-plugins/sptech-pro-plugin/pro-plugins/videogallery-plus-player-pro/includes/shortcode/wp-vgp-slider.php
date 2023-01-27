<?php
/**
 * 'video_gallery_slider' Shortcode
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `video_gallery_slider` shortcode
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_video_gallery_slider( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit'    			=> '20',
		'category' 			=> '',
		'include_cat_child'	=> 'true',
		'post'     			=> '',
		'design'        	=> 'design-1',
		'popup_fix'			=> 'true',
		'gallery_enable' 	=> 'true',
		'slide_to_show' 	=> '3',
		'slide_to_scroll' 	=> '1',
		'autoplay' 			=> 'true',
		'autoplay_speed' 	=> '3000',
		'speed' 			=> '300',
		'arrows' 			=> 'true',
		'loop' 				=> 'true',
		'center_mode' 		=> 'false',
		'rtl'  				=> false,
		'show_title'    	=> 'true',
		'show_content'  	=> 'false',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
		'exclude_cat'		=> array(),
		'exclude_post'		=> array(),
	), $atts));

	$unique 			= wp_vgp_get_unique();
	$shortcode_designs	= wp_vgp_designs();
	$popup_fix 			= ($popup_fix == 'false') 			? 'false' 	: 'true';
	$gallery_enable 	= ($gallery_enable == 'false')		? 'false'	: 'true';
	$limit				= !empty($limit) 					? $limit 						: '20';
	$cat				= (!empty($category))				? explode(',', $category) 		: '';
	$include_cat_child	= ( $include_cat_child == 'false' ) ? false 						: true;
	$grid 				= !empty($grid) 					? $grid 						: 3;
	$show_title 		= ( $show_title == 'false' )		? 'false'	: 'true'; 	
	$show_content 		= ( $show_content == 'true' )		? 'true'	: 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby			= !empty($orderby) 					? $orderby 						: 'date';
	$posts 				= !empty($post)						? explode(',', $post) 			: array();
	$exclude_cat 		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$exclude_post		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$slide_to_show 		= !empty($slide_to_show) 			? $slide_to_show 				: 3;
	$slide_to_scroll 	= !empty($slide_to_scroll) 			? $slide_to_scroll 				: 1;
	$autoplay_speed 	= ($autoplay_speed !== '') 			? $autoplay_speed 				: '3000';
	$speed 				= (!empty($speed)) 					? $speed 						: '300';
	$arrows 			= ($arrows == 'false') 				? 'false' 						: 'true';
	$autoplay 			= ($autoplay == 'false') 			? 'false' 						: 'true';
	$loop 				= ($loop == 'false') 				? 'false' 						: 'true';
	$design 			= array_key_exists( trim($design), $shortcode_designs ) ? $design 	: 'design-1';
	$video_grid 		= wp_vgp_grid_column( $grid );
	$jwp_enable 		= wp_vgp_get_option('jwp_enable');
	$jwp_licence_key 	= wp_vgp_get_option('jwp_licence_key');

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Enqueue required script
	if($jwp_enable) {
		wp_enqueue_script( 'wpos-jwplayer-script' );
	} else {
		wp_enqueue_script( 'wpos-videojs-script' );
	}
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpos-magnific-script' );
	wp_enqueue_script( 'wp-vgp-public-js' );

	// Taking some globals
	global $post;

	// Taking some variables
	$prefix = WP_VGP_META_PREFIX;
	$count 	= 1;

	// WP Query Parameters
	$query_args = array ( 
				'post_type'     	 	=> WP_VGP_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'posts_per_page' 		=> $limit,
				'order'         		=> $order,
				'orderby'       		=> $orderby,
				'post__in'       		=> $posts,
				'post__not_in'			=> $exclude_post,
				'ignore_sticky_posts'	=> true,
			);

	// Category Parameter
	if( $cat != '' ) {
		
		$query_args['tax_query'] = array(
								array(
									'taxonomy' 			=> WP_VGP_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
								));

	} else if( !empty($exclude_cat) ) {

		$query_args['tax_query'] = array(
										array(
											'taxonomy' 			=> WP_VGP_CAT,
											'field' 			=> 'term_id',
											'terms' 			=> $exclude_cat,
											'operator'			=> 'NOT IN',
											'include_children'	=> $include_cat_child,
										));
	}
	
	// WP Query
	$video_query 	= new WP_Query($query_args);
	$post_count 	= $video_query->post_count;

	// Slider configuration and taken care of centermode
	$slide_to_show 		= (!empty($slide_to_show) && $slide_to_show <= $post_count) ? $slide_to_show : $post_count;
	$center_mode		= ($center_mode == 'true' && $slide_to_show % 2 != 0 && $slide_to_show != $post_count) ? 'true' : 'false';
	$center_mode_cls	= ($center_mode == "true") ? 'wp-vgp-center-mode' 	: '';

	// Slider and Popup Configuration
	$slider_conf 	= compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows', 'loop','center_mode','rtl');
	$popup_conf 	= compact('gallery_enable', 'popup_fix');

	ob_start();

	// If post is there
	if( $video_query->have_posts() ) {
?>
	<div class="wp-vgp-video-slider-wrap wp-vgp-clearfix <?php echo $center_mode_cls; ?> wp-vgp-slider-value-<?php echo $slide_to_show; ?> wp-vgp-ds-<?php echo $design; ?>">
		<div class="wp-vgp-video-gallery-slider wp-vgp-<?php echo $design; ?>" id="wp-vgp-video-gallery-slider-<?php echo $unique; ?>">	

		<?php while ($video_query->have_posts()) : $video_query->the_post();

				$jw_video_file_link = '';
				$video_link 		= '';
				$unique_id 			= wp_vgp_get_unique();
				$feat_image 		= wp_vgp_get_post_image( $post->ID, 'full', true );
				$video_data 		= wp_vgp_get_video_data( $post->ID );
				$video_embed_link	= $video_data['embed_link'];
				$video_type			= $video_data['video_type'];
				$video_content		= get_the_content();

				// If video link is array then get self hosted video
				if( is_array($video_data['link']) ) {
					$wpvideo_video_mp4 	= $video_data['link']['mp4'];
					$wpvideo_video_wbbm = $video_data['link']['webm'];
					$wpvideo_video_ogg 	= $video_data['link']['ogg'];
				} else {
					$video_link = $video_data['link'];
				}

				// Assign video file to jw player (Only supports one at a time)
				if($jwp_enable && !empty($jwp_licence_key) && ($video_type == 'html5' || $video_type == 'youtube')) {

					if( $video_type == 'html5' ) {
						if(!empty($wpvideo_video_mp4)) {
							$jw_video_file_link = $wpvideo_video_mp4;
						}
						elseif (!empty($wpvideo_video_wbbm)) {
							$jw_video_file_link = $wpvideo_video_wbbm;
						}
						else {
							$jw_video_file_link = $wpvideo_video_ogg;
						}
					} else {
						$jw_video_file_link = $video_link;
					}
				}
		?>
			<div class="wp-vgp-video-wrap">
			
				<?php if($design == 'design-16' || $design == 'design-17' || $design == 'design-18') { ?>

				<div class="wp-vgp-video-frame-wrap">
					<div class="wp-vgp-video-image-frame wp-vgp-medium-6 wp-vgp-columns">
						<a href="javascript:void(0);" data-mfp-src="#video-modal-<?php echo $unique_id; ?>" class="wp-vgp-popup-modal">
							<?php if( $feat_image ) { ?>
							<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
							<?php } ?>
							<span class="wp-vgp-video-icon"></span>
						</a>
					</div>
					<div class="wp-vgp-medium-6 wp-vgp-columns wp-vgp-video-right-content">						
						<?php if($show_title == 'true') { ?>
						<div class="wp-vgp-video-title"><?php the_title(); ?></div>
						<?php } ?>

						<?php if ( $show_content == 'true' && $video_content) { ?>
						<div class="wp-vgp-video-content"><?php the_content(); ?></div>
						<?php } ?>
					</div>
				</div>

			<?php } else { ?>

				<div class="wp-vgp-video-frame-wrap">
					<div class="wp-vgp-video-image-frame-wrap">
						<div class="wp-vgp-video-image-frame">
							<a href="javascript:void(0);" data-mfp-src="#video-modal-<?php echo $unique_id; ?>" class="wp-vgp-popup-modal">
								<?php if( $feat_image ) { ?>
								<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
								<?php } ?>
								<span class="wp-vgp-video-icon"></span>
							</a>
						</div>

						<?php if($show_title == 'true') { ?>
						<div class="wp-vgp-video-title"><div class="video-title-text"><?php the_title(); ?></div></div>
						<?php } ?>
					</div>

					<?php if($show_content == 'true' && $video_content) { ?>
					<div class="wp-vgp-video-content"><?php the_content(); ?></div>
					<?php } ?>
				</div>
				<?php } ?>

				<div id="video-modal-<?php echo $unique_id; ?>" class="wp-vgp-popup-wrp mfp-hide wp-vgp-zoom-dialog wp-vgp-white-popup-block">
					<?php if( !empty($jw_video_file_link) ) { ?>
						<div id="wp-vgp-jw-player-<?php echo $unique_id; ?>" class="wp-vgp-jwplayer-list" data-file="<?php echo $jw_video_file_link; ?>" data-image="<?php echo $feat_image; ?>">
							<?php _e('JWPlayer not supported','html5-videogallery-plus-player');?>
						</div>
					<?php } elseif( !empty($video_link) ) { ?>
						<iframe src="about:blank" data_src="<?php echo $video_embed_link; ?>" class="wpos-iframe-video" frameborder="0" allowfullscreen></iframe>
					<?php } else { ?>

						<video id="wp-vgp-video-<?php echo $unique_id; ?>" class="wp-vgp-video-frame video-js vjs-default-skin" width="100%" poster="<?php echo $feat_image; ?>" controls preload="none" data-setup="{}">
							<source src="<?php echo $wpvideo_video_mp4; ?>" type='video/mp4' />
							<source src="<?php echo $wpvideo_video_wbbm; ?>" type='video/webm' />
							<source src="<?php echo $wpvideo_video_ogg; ?>" type='video/ogg' />
						</video>

					<?php } ?>
					<div class="mfp-bottom-bar wp-vgp-mfp-bottom-bar">
						<div class="mfp-title"><?php the_title(); ?></div>
						<div class="mfp-counter"><?php echo $count.' '.__('of', 'html5-videogallery-plus-player').' '.$post_count; ?></div>
					</div>
				</div>
			</div>

	<?php
				$count++;
			endwhile;
	?>
		
		</div>
		<div class="wp-vgp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		<div class="wp-vgp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
	</div>

	<?php 
		} // end have_post()

		wp_reset_query(); // reset wp query
		
		$content .= ob_get_clean();
		return $content;
}

// `video_gallery_slider` grid shortcode
add_shortcode('video_gallery_slider', 'wp_vgp_video_gallery_slider');