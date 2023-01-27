<?php
/**
 * 'video_gallery' Shortcode
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `video_gallery` shortcode
 * 
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */
function wp_vgp_video_grid_shortcode( $atts, $content = null ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit'    				=> '20',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'grid'     				=> '3',
		'design'        		=> 'design-1',
		'popup_fix'				=> 'true',
		'gallery_enable' 		=> 'true',
		'show_title'    		=> 'true',
		'show_content'  		=> 'false',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'post'     				=> array(),
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'pagination'			=> 'false',
		'pagination_type'		=> 'numeric',
	), $atts));

	$unique 			= wp_vgp_get_unique();
	$shortcode_designs	= wp_vgp_designs();
	$popup_fix 			= ($popup_fix == 'false') 			? 'false' 	: 'true';
	$gallery_enable 	= ($gallery_enable == 'false')		? 'false'	: 'true';
	$show_title 		= ( $show_title == 'false' )		? 'false'	: 'true';
	$show_content 		= ( $show_content == 'true' )		? 'true'	: 'false';
	$limit				= !empty($limit) 					? $limit 						: '20';
	$cat				= (!empty($category))				? explode(',', $category) 		: '';
	$include_cat_child	= ( $include_cat_child == 'false' ) ? false 						: true;
	$grid 				= !empty($grid) 					? $grid 						: 3;
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby			= !empty($orderby) 					? $orderby 						: 'date';
	$posts 				= !empty($post)						? explode(',', $post) 			: array();
	$exclude_cat 		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$exclude_post		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$pagination			= ($pagination == 'true')			? 1									: 0;
	$pagination_type 	= ($pagination_type == 'prev-next')	? 'prev-next' 	: 'numeric';
	$design 			= array_key_exists( trim($design), $shortcode_designs ) ? $design 	: 'design-1';
	$video_grid 		= wp_vgp_grid_column( $grid );
	$jwp_enable 		= wp_vgp_get_option('jwp_enable');
	$jwp_licence_key 	= wp_vgp_get_option('jwp_licence_key');

	// Popup Configuration
	$popup_conf = compact('gallery_enable', 'popup_fix');

	// Enqueue required script
	if($jwp_enable) {
		wp_enqueue_script( 'wpos-jwplayer-script' );
	} else {
		wp_enqueue_script( 'wpos-videojs-script' );
	}
	wp_enqueue_script( 'wpos-magnific-script' );
	wp_enqueue_script( 'wp-vgp-public-js' );

	// Taking some globals
	global $post;

	// Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}

	// Taking some variables
	$prefix 	= WP_VGP_META_PREFIX;
	$count 		= 1;
	$loop_count = 1;

	// WP Query Parameters
	$query_args = array(
				'post_type'     	 	=> WP_VGP_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'posts_per_page' 		=> $limit,
				'order'         		=> $order,
				'orderby'       		=> $orderby,
				'post__in'       		=> $posts,
				'post__not_in'			=> $exclude_post,
				'paged'          		=> ($pagination) ? $paged : 1,
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

	ob_start();

	// If post is there
	if( $video_query->have_posts() ) {
?>

	<div class="wp-vgp-video-grid-wrp wp-vgp-video-row wp-vgp-clearfix wp-vgp-<?php echo $design; ?> wp-vgp-cols-<?php echo $video_grid; ?>" id="video-grid-<?php echo $unique; ?>">
	<?php while ($video_query->have_posts()) : $video_query->the_post();

			$jw_video_file_link = '';
			$video_link 		= '';
			$unique_id 			= wp_vgp_get_unique();
			$wrap_cls 			= ($loop_count == 1) ? 'wp-vgp-first' : '';
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

				// If HTML 5 video then take any of the link else default
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

		<div class="wp-vgp-video-wrap wp-vgp-medium-<?php echo $video_grid; ?> wp-vgp-columns <?php echo $wrap_cls; ?>">

			<?php if($design == 'design-16' || $design == 'design-17' || $design == 'design-18' ) { ?>

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
						<div class="wp-vgp-video-title"><?php the_title(); ?></div>						
						<?php if($show_content == 'true' && $video_content) { ?>
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
			$loop_count++;
			if( $loop_count == $grid ) {
				$loop_count = 0;
			}
		endwhile;
	?>
		<?php if($pagination) { ?>
		<div class="wp-vgp-paging wp-vgp-clearfix wp-vgp-<?php echo $design; ?>">
			<?php if($pagination_type == "numeric") {
				echo wp_vgp_pagination(array('paged' => $paged, 'total' => $video_query->max_num_pages));
			} else { ?>
				<div class="wp-vgp-pagi-btn wp-vgp-prev-btn"><?php previous_posts_link( '&laquo; '.__('Previous', 'html5-videogallery-plus-player') ); ?></div>
				<div class="wp-vgp-pagi-btn wp-vgp-next-btn"><?php next_posts_link( __('Next', 'html5-videogallery-plus-player').' &raquo;', $video_query->max_num_pages ); ?></div>
			<?php } ?>
		</div>
		<?php } ?>
		<div class="wp-vgp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
	</div>

<?php
		} // end have_post()

		wp_reset_query(); // reset wp query

		$content .= ob_get_clean();
		return $content;
}

// `video_gallery` grid shortcode
add_shortcode('video_gallery', 'wp_vgp_video_grid_shortcode');