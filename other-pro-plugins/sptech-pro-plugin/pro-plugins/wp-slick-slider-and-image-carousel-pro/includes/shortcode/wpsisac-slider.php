<?php
/**
 * 'slick-slider' Shortcode
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpsisac_pro_slick_slider( $atts, $content = null ) {          
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit'    			=> '15',
		'category' 			=> '',
		'include_cat_child'	=> 'true',
		'design' 			=> 'prodesign-1',
		'show_content' 		=> 'true',
		'loop'   			=> 'true',
		'dots'     			=> 'true',
		'arrows'     		=> 'true',
		'autoplay'     		=> 'true',
		'autoplay_interval'	=> '3000',
		'speed'             => '300',
		'fade'		        => 'false',
		'rtl'				=> '',
		'sliderheight'     	=> '',
		'show_read_more'	=> 'true',
		'read_more_text'	=> __('Read More', 'wp-slick-slider-and-image-carousel'),
		'slider_nav_column'	=> 3,
		'link_target'		=> 'self',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
		'exclude_cat'		=> array(),
		'exclude_post'      => array(),
		'posts'				=> array(),
		'arrow_design' 		=> 'design-1',
		'dots_design' 		=> 'design-1',
		), $atts));
	
	$shortcode_designs 	= wpsisac_pro_slider_designs();
	$limit 				= !empty($limit) 					? $limit 						: '15';
	$show_read_more 	= ( $show_read_more == 'true' ) 	? true 							: false;
	$cat 				= (!empty($category)) 				? explode(',', $category) 		: '';
	$include_cat_child	= ( $include_cat_child == 'false' ) ? false 						: true;
	$loop 				= ( $loop == 'false' ) 				? 'false' 						: 'true';
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'prodesign-1';
	$showContent 		= ( $show_content == 'false' ) 		? 'false' 						: 'true';
	$dots 				= ( $dots == 'false' ) 				? 'false' 						: 'true';
	$arrows 			= ( $arrows == 'false' ) 			? 'false' 						: 'true';
	$autoplay 			= ( $autoplay == 'false' ) 			? 'false' 						: 'true';
	$autoplay_interval 	= (!empty($autoplay_interval)) 		? $autoplay_interval 			: 3000;
	$speed 				= (!empty($speed)) 					? $speed 						: 300;
	$fade 				= ( $fade == 'true' ) 				? 'true' 						: 'false';
	$link_target 		= ($link_target == 'blank') 		? '_blank' 						: '_self';
	$order				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby			= !empty($orderby) 					? $orderby 						: 'date';
	$exclude_cat		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$exclude_post		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$posts				= !empty($posts)					? explode(',', $posts) 			: array();
	$read_more_text 	= !empty($read_more_text) 			? $read_more_text 				: __('Read More', 'wp-slick-slider-and-image-carousel');
	$sliderheight 		= (!empty($sliderheight)) 			? $sliderheight 				: '';
	$slider_height_css 	= (!empty($sliderheight))			? "style='height:{$sliderheight}px;'" : '';
	$arrow_design		= (!empty($arrow_design) )			? $arrow_design 				: 'design-1';
	$dots_design		= (!empty($dots_design) )			? $dots_design 					: 'design-1';

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Shortcode file
	$design_file_path 	= WPSISAC_PRO_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';
	
	// Enqueus required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpsisac-pro-public-script' );
	
	// Taking some global
	global $post;

	// Taking some variables
	$unique				= wpsisac_pro_get_unique();
	$slider_as_nav_for 	= '';
	$slider_nav_designs	= array( 'prodesign-4', 'prodesign-5', 'prodesign-6' );

	// For Navigation design
	if( in_array( $design, $slider_nav_designs) ) {
		$slider_as_nav_for 	= "data-slider-nav-for='wpsisac-slider-nav-{$unique}'";
	}

	// WP Query Parameters
	$args = array (
		'posts_per_page' 		=> $limit,
		'post_type'     	 	=> WPSISAC_PRO_POST_TYPE,
		'post_status' 			=> array( 'publish' ),
		'orderby'        		=> $orderby,
		'order'          		=> $order,
		'post__not_in'	 		=> $exclude_post,
		'post__in'		 		=> $posts,
		'ignore_sticky_posts'	=> true,
	);

	// Category Parameter
	if( $cat != "" ) {

		$args['tax_query'] = array(
			array(
					'taxonomy' 			=> WPSISAC_PRO_CAT,
					'field' 			=> 'term_id',
					'terms' 			=> $cat,
					'include_children'	=> $include_cat_child,
				));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
			array(
					'taxonomy' 			=> WPSISAC_PRO_CAT,
					'field' 			=> 'term_id',
					'terms' 			=> $exclude_cat,
					'operator'			=> 'NOT IN',
					'include_children'	=> $include_cat_child,
				));
	}

	// WP Query Parameters
	$query 				= new WP_Query($args);
	$post_count 		= $query->post_count;
	$slider_nav_column 	= ( !empty($slider_nav_column) && ($slider_nav_column <= $post_count) ) ? $slider_nav_column : 2;

  	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'fade', 'design', 'rtl', 'loop', 'slider_nav_column');

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>
		
		<div class="wpsisac-slider-wrp">
			<div id="wpsisac-pro-slick-slider-<?php echo $unique; ?>" class="wpsisac-slick wpsisac-slick-slider <?php echo 'wpsisac-'.$design; ?> <?php echo 'wpsisac-arrow-'.$arrow_design; ?> <?php echo 'wpsisac-dots-'.$dots_design; ?>" <?php echo $slider_as_nav_for; ?>><?php
				while ( $query->have_posts() ) : $query->the_post();

				$slider_img 	= wpsisac_pro_get_post_featured_image( $post->ID, 'full', true );
				$read_more_url 	= get_post_meta( $post->ID, 'wpsisac_slide_link', true );

					// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}

				endwhile;
				?>
			</div>

			<div class="wpsisac-slider-conf wpsisac-hide"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
		</div>
		
		<?php
		// For Navigation design
		if( in_array( $design, $slider_nav_designs ) ) { ?>
			<div class="wpsisac-slider-nav-<?php echo $unique; ?> wpsisac-slider-nav <?php echo $design; ?>"><?php
				while ( $query->have_posts() ) : $query->the_post();
				$slider_nav_img = wpsisac_pro_get_post_featured_image( $post->ID, 'large', true );
				?>

				<div class="slick-image-nav"><?php
					if( $slider_nav_img ) { ?>
						<img class="wpsisac-slider-nav-img" src="<?php echo $slider_nav_img; ?>" alt="<?php _e('Slider Nav Image', 'wp-slick-slider-and-image-carousel'); ?>" /><?php
					} ?>
				</div><?php

				endwhile; ?>
			</div>
<?php	}

	} // End have_posts()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'slick-slider' shortcode
add_shortcode('slick-slider', 'wpsisac_pro_slick_slider');