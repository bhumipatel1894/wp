<?php
/**
 * 'th-slider' Shortcode
 * 
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wphtsp_pro_timeline_slider( $atts, $content = null ) {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit'    				=> '-1',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'slidestoshow'			=> '3',
		'first_slide'			=> '0',
		'dots'     				=> 'true',
		'arrows'     			=> 'true',
		'autoplay'     			=> 'false',
		'adaptiveheight'		=> 'true',
		'autoplay_interval' 	=> '3000',
		'speed'             	=> '300',
		'fade'		        	=> 'false',
		'design' 				=> 'design-1',
		'orderby' 				=> 'date',
		'order' 				=> 'DESC',
		'show_title'			=> 'true',
		'show_full_content' 	=> 'false',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> '70',
		'show_read_more' 		=> 'true',
		'content_tail'			=> '...',
		'link'					=> 'true',
		'link_target'			=> 'self',
		'read_more_text'		=> '',
		'show_date'				=> 'true',
		'posts'					=> array(),
		'exclude_post'			=> array(),
		'exclude_cat'			=> array(),
		'post_type'				=> WPHTSP_PRO_POST_TYPE,
		'image_position'		=> 'left',
		'image_size'			=> '',
		'background_color'		=> '',
		'font_color'			=> '',
		'rtl'					=> '',
	), $atts));

	$shortcode_designs 	= wphtsp_slider_designs();
	$supportedposts		= wphtsp_supported_post_types();
	$supportedpostcat 	= wphtsp_supported_post_types_category();
	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 						? $limit 						: '-1';
	$slidestoshow 		= !empty($slidestoshow) 				? $slidestoshow 				: '3';
	$first_slide 		= (!empty($first_slide) && $first_slide > 0) ? $first_slide -1			: '0';
	$cat 				= (!empty($category))					? explode(',',$category)		: '';
	$orderby 			= !empty($orderby) 						? $orderby 						: 'date';
	$order 				= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$include_cat_child 	= ( $include_cat_child == 'false' ) 	? 'false' 						: 'true';
	$dots 				= ( $dots == 'false' )					? 'false' 						: 'true';
	$arrows 			= ( $arrows == 'false' )				? 'false' 						: 'true';
	$autoplay 			= ( $autoplay == 'false' )				? 'false' 						: 'true';
	$adaptiveheight 	= ( $adaptiveheight == 'false' ) 		? 'false' 						: 'true';
	$show_date 			= ( $show_date == 'false' ) 			? 'false' 						: 'true';
	$autoplayInterval	= !empty( $autoplay_interval ) 			? $autoplay_interval 			: '3000';
	$image_position		= !empty( $image_position )				? $image_position 				: 'left';
	$speed 				= !empty( $speed ) 						? $speed 						: '300';
	$fade				= ( $fade == 'true' )					? 'true' 						: 'false';
	$show_title			= ( $show_title == 'false' ) 			? 0 							: 1;
	$showFullContent 	= ( $show_full_content == 'true' ) 		? 'true' 						: 'false';
	$showContent 		= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$words_limit 		= !empty($content_words_limit) 			? $content_words_limit 			: 20;
	$showreadmore 		= ( $show_read_more == 'false' ) 		? 'false' 						: 'true';
	$link_target 		= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$link 				= ( $link == 'false' )					? 0 							: 1;
	$read_more_text 	= !empty($read_more_text) 				? $read_more_text 				: __('Read More', 'timeline-and-history-slider');
	$historydesign 		= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$posts 				= !empty($posts)						? explode(',', $posts) 			: array();
	$exclude_post 		= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$exclude_cat 		= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$post_type 			= ($post_type && (array_key_exists(trim($post_type), $supportedposts))) ? trim($post_type) 	: WPHTSP_PRO_POST_TYPE;
	$faIconcolor 		= (!empty($fa_icon_color))				? $fa_icon_color				: '#000';
	$post_type_cat 		= ($post_type && (array_key_exists(trim($post_type), $supportedpostcat))) ? $supportedpostcat[$post_type] : WPHTSP_PRO_CAT;

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Enqueue required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wphts-pro-public-script' );

	// Shortcode file
	$historydesign_file_path 	= WPHTSP_PRO_DIR . '/templates/slider/' . $historydesign . '.php';
	$design_file 				= (file_exists($historydesign_file_path)) ? $historydesign_file_path : '';

	// Taking some variables
	$unique 			= wphtsp_get_unique();
	$slider_as_nav_for 	= "data-slider-nav-for='wphtsp-slider-for-{$unique}'";
	$background_style	= !empty($background_color) ? 'style="background:'.$background_color.'"' 	: '';
	$font_style			= !empty($font_color) 		? 'style="color:'.$font_color.'"' 				: '';

	// Taking some globals
	global $post;

	// WP Query Parameters
	$args = array ( 
		'post_type'      	=> $post_type, 
		'order'          	=> $order,
		'orderby'        	=> $orderby,
		'posts_per_page' 	=> $posts_per_page,
		'post__not_in'		=> $exclude_post,
		'post__in'			=> $posts,
	);

	// Category Parameter
	if($cat != '') {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> $post_type_cat,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
							));

	} elseif( !empty($exclude_cat) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> $post_type_cat,
									'field' 			=> 'term_id',
									'terms' 			=> $exclude_cat,
									'operator'			=> 'NOT IN',
									'include_children'	=> $include_cat_child,
							));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;
	$date_format	= wphts_pro_get_option('date_format');

	// Slider configuration
	$slidestoshow 	= (!empty($slidestoshow) && $slidestoshow <= $post_count) 	? $slidestoshow : $post_count;
	$nav_centermode	= ($slidestoshow % 2 == 0 || $slidestoshow == $post_count) 	? 'false' : 'true';
	$slider_conf 	= compact('dots', 'arrows', 'autoplay', 'autoplayInterval', 'speed', 'fade','adaptiveheight','fade','slidestoshow','first_slide', 'nav_centermode', 'rtl');

	ob_start();

	if ( $query->have_posts() ) : ?>

		<div class="wphtsp-slider-wrp wphtsp-clearfix">
			<div class="wphtsp-slider-inner-wrp <?php echo 'wphtsp-slider-'.$historydesign; ?> wphtsp-clearfix">
				<?php
					// Include shortcode html file
					if( $design_file ) {
						include( $design_file );
					}
				?>
			</div>
			<div class="wphtsp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>
	<?php endif; // end if

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'th-slider' shortcode
add_shortcode('th-slider', 'wphtsp_pro_timeline_slider');