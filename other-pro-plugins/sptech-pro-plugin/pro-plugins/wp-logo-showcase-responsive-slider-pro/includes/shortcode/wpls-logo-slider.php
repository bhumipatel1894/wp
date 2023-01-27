<?php
/**
 * 'logoshowcase' Shortcode
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `logoshowcase` shortcode
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_logo_slider( $atts, $content ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 				=> '15',
		'cat_id' 				=> '',
		'include_cat_child'		=> 'true',
		'cat_name' 				=> '',
		'design'				=> 'design-1',
		'slides_column' 		=> '4',
		'slides_scroll' 		=> '1',
		'dots' 					=> 'true',
		'arrows' 				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval' 	=> '3000',
		'speed' 				=> '600',
		'center_mode' 			=> 'false',
		'loop' 					=> 'true',
		'rtl'					=> '',
		'ticker'				=> 'false',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'link_target'			=> 'self',
		'show_title' 			=> 'true',
		'image_size' 			=> 'full',
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'animation'				=> '',
		'tooltip'				=> '',
		'content_words_limit' 	=> '20',
		'content_tail'			=> '...',
		), $atts));
	
	$shortcode_designs		= wpls_pro_logo_designs();
	$limit					= !empty($limit) 					? $limit 						: '15';
	$cat_id					= (!empty($cat_id))					? explode(',',$cat_id) 			: '';
	$include_cat_child		= ( $include_cat_child == 'false' ) ? false 						: true;
	$slides_column 			= !empty($slides_column) 			? $slides_column 				: 4;
	$slides_scroll 			= !empty($slides_scroll) 			? $slides_scroll 				: 1;
	$design 				= array_key_exists( trim($design), $shortcode_designs ) ? $design 	: 'design-1';
	$dots 					= ($dots == 'false') 				? 'false' 						: 'true';
	$arrows 				= ($arrows == 'false') 				? 'false' 						: 'true';
	$autoplay 				= ($autoplay == 'false') 			? 'false' 						: 'true';
	$order 					= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 					? $orderby 						: 'date';
	$autoplay_interval 		= ($autoplay_interval !== '') 		? $autoplay_interval 			: '2000';
	$speed 					= (!empty($speed)) 					? $speed 						: '300';
	$ticker					= ($ticker == 'true') 				? 'true' 						: 'false';
	$center_mode 			= ($center_mode == 'true') 			? 'true' 						: 'false';
	$loop 					= ($loop == 'false') 				? 'false' 						: 'true';
	$link_target 			= ($link_target == 'blank') 		? '_blank' 						: '_self';
	$show_title 			= ($show_title == 'false') 			? 'false'						: 'true';
	$image_size 			= (!empty($image_size)) 			? $image_size					: 'original';
	$border_color 			= (!empty($border_color)) 			? $border_color 				: '#ddd';
	$exclude_cat 			= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$exclude_post 			= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$posts 					= !empty($posts)					? explode(',', $posts) 			: array();
	$animation 				= !empty($animation) 				? $animation 					: '';
	$animation_cls 			= ($animation == '') 				? 'has-no-animation'			: '';
	$tooltip 				= ($tooltip == 'true') 				? 'true' 						: 'false';
	$tooltip_cls 			= ($tooltip == "true") 				? 'wpls-tooltip'				: '';
	$words_limit 			= !empty( $content_words_limit ) 	? $content_words_limit : 20;
	$content_tail 			= html_entity_decode($content_tail);
	
	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}
	
	// Little tweak for ticker mode
	if( $ticker	== 'true' ) {
		$autoplay 			= 'true';
		$slides_scroll 		= 1;
		$autoplay_interval 	= 0;
		$dots 				= 'false';
		$arrows 			= 'false';
		$loop 				= 'true';
	}
	
	// Shortcode file
	$design_file 		= wpls_pro_get_design( $design, 'grid', 'design-1' );
	$design_file_path 	= WPLS_PRO_DIR . '/templates/' . $design_file . '.php';
	$design_file_path 	= (file_exists($design_file_path)) ? $design_file_path : '';
	
	// Enqueus required script
	if($tooltip == 'true') {
		wp_enqueue_script( 'wpos-tooltip-js' );
	}
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpls-pro-public-js' );

	// Taking some globals
	global $post;

	// Taking some variables
	$unique				= wpls_pro_get_unique();
	$center_mode_cls 	= ($center_mode == "true") ? 'wpls-center-mode' : '';
	$cnt_wrp_cls 		= "{$tooltip_cls}";
	
	// Slider variable
	$logo_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval','ticker', 'speed', 'center_mode', 'loop','rtl');
	
	// WP Query Parameters
	$query_args = array(
						'post_type' 			=> WPLS_PRO_POST_TYPE,
						'post_status' 			=> array( 'publish' ),
						'posts_per_page'		=> $limit,
						'order'          		=> $order,
						'orderby'        		=> $orderby,
						'post__in'				=> $posts,
						'post__not_in'			=> $exclude_post,
						'ignore_sticky_posts'	=> true,
					);

	// Category Parameter
	if( !empty($cat_id) ) {

		$query_args['tax_query'] = array( 
										array(
											'taxonomy' 			=> WPLS_PRO_CAT, 
											'field' 			=> 'term_id',
											'terms' 			=> $cat_id,
											'include_children'	=> $include_cat_child,
										));

	} else if( !empty($exclude_cat) ) {

		$query_args['tax_query'] = array(
										array(
											'taxonomy' 			=> WPLS_PRO_CAT,
											'field' 			=> 'term_id',
											'terms' 			=> $exclude_cat,
											'operator'			=> 'NOT IN',
											'include_children'	=> $include_cat_child,
											));
	}

	// WP Query Parameters
	$logo_query = new WP_Query($query_args);
	$post_count = $logo_query->post_count;

	ob_start();

	// If post is there
	if( $logo_query->have_posts() ) {

		if($cat_name != '') { ?>
		<h3><?php echo $cat_name; ?></h3>
		<?php } ?>

		<div class="wpls-logo-showcase-slider-wrp">
			<div class="wpls-logo-showcase logo_showcase wpls-logo-slider wpls-<?php echo $design.' '.$animation_cls .' '.$center_mode_cls; ?>" id="wpls-logo-showcase-slider-<?php echo $unique; ?>" data-animation="<?php echo $animation; ?>">

			<?php while ($logo_query->have_posts()) : $logo_query->the_post();

					$feat_image = wpls_pro_get_logo_image($post->ID, $image_size);
					$logourl 	= get_post_meta( $post->ID, 'wplss_slide_link', true );

					// Include shortcode html file
					if( $design_file_path ) {
						include( $design_file_path );
					}

			 	endwhile;
			 ?>

			</div><!-- end .wpls-logo-slider -->
			
			<div class="wpls-logo-showacse-slider-conf"><?php echo json_encode( $logo_conf ); ?></div>

		</div><!-- end .wpls-logo-showcase-slider-wrp -->

	<?php
		wp_reset_query(); // Reset WP Query

		$content .= ob_get_clean();
		return $content;
	}
}

// `logoshowcase` slider shortcode
add_shortcode( 'logoshowcase', 'wpls_pro_logo_slider' );