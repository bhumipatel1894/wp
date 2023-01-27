<?php
/**
 * 'recent_post_carousel' Shortcode
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wprpsp_post_carousel( $atts, $content = null ){

    // setup the query
	extract(shortcode_atts(array(
		'post_type'				=> 'post',
		'taxonomy'				=> 'category',
		'limit' 				=> '20',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'design' 				=> 'design-7',	
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_content'			=> 'true',
		'content_words_limit' 	=> '20',
		'content_tail'			=> '...',
		'show_author' 			=> 'true',
		'dots'     				=> 'true',
		'arrows'     			=> 'true',
		'autoplay'     			=> 'true',
		'autoplay_interval'  	=> '3000',
		'speed'             	=> '300',
		'link_target'			=> 'self',
		'show_read_more'   		=> 'true',
		'slides_to_show'		=> '2',
		'slides_to_scroll' 		=> '1',
		'loop'					=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'exclude_cat'			=> array(),
		'hide_post'				=> array(),
		'posts'					=> array(),
		'rtl'					=> '',
		'read_more_text'		=> '',
		'sticky_posts' 			=> 'false',
		'image_size' 			=> 'full',
		'image_fit'				=> 'true',
		), $atts));

	$supported_post_types 	= wprpsp_get_option('post_types',array());
	$shortcode_designs 		= wprpsp_recent_post_crousel_designs();

	$content_tail	 		= html_entity_decode($content_tail);
	$post_type 				= (!empty($post_type) && in_array($post_type, $supported_post_types))	? $post_type : 'post';
	$taxonomy 				= (!empty($taxonomy))					? $taxonomy						: 'category';
	$posts_per_page 		= !empty($limit) 						? $limit 				 		: '20';
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$include_cat_child		= ( $include_cat_child == 'false' ) 	? false : true;
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-7';
	$showDate 				= ( $show_date == 'false' ) 			? 'false'				 		: 'true';
	$showCategory 			= ( $show_category_name == 'false' )	? 'false' 				 		: 'true';
	$showContent 			= ( $show_content == 'false' ) 			? 'false' 				 		: 'true';
	$words_limit 			= !empty( $content_words_limit ) 		? $content_words_limit 	 		: 20;
	$showAuthor 			= ($show_author == 'false')				? 'false'				 		: 'true';
	$dots 					= ( $dots == 'false' ) 					? 'false' 				 		: 'true';
	$arrows 				= ( $arrows == 'false' ) 				? 'false' 				 		: 'true';
	$autoplay 				= ( $autoplay == 'false' ) 				? 'false' 				 		: 'true';
	$autoplay_interval 		= !empty($autoplay_interval) 			? $autoplay_interval 	 		: '3000';
	$speed 					= !empty($speed) 						? $speed 				 		: '300';
	$link_target 			= ($link_target == 'blank') 			? '_blank' 				 		: '_self';
	$showreadmore 			= ( $show_read_more == 'false' )		? 'false' 				 		: 'true';
	$slides_to_show			= !empty($slides_to_show) 				? $slides_to_show 		 		: '2';
	$slides_to_scroll 		= !empty($slides_to_scroll) 			? $slides_to_scroll 	 		: '1';
	$infinite 				= ( $loop == 'true' ) 					? 'true' 				 		: 'false';
	$order					= ( strtolower($order) == 'asc' ) 		? 'ASC' 				 		: 'DESC';
	$orderby				= !empty($orderby) 						? $orderby 				 		: 'date';
	$exclude_cat			= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$exclude_post			= !empty($hide_post)					? explode(',', $hide_post) 		: array();
	$posts					= !empty($posts)						? explode(',', $posts) 			: array();
	$read_more_text 		= !empty($read_more_text) 				? $read_more_text : __('Read More', 'wp-responsive-recent-post-slider');
	$sticky_posts 			= ( $sticky_posts == 'true' ) 			? false 						: true;
	$image_size 			= !empty($image_size) 					? $image_size 			 		: 'full';
	$image_fit				= ($image_fit == 'false')				? 0 : 1;

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Shortcode file
	$design_file_path 	= WPRPSP_DIR . '/templates/' . $design . '.php';
	$design_file 			= (file_exists($design_file_path)) ? $design_file_path : '';

	// Enqueus required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wprpsp-public-script' );

	// Taking some global
	global $post;

	// Taking some variables	
	$unique	= wprpsp_get_unique();
	$old_browser		= wprpsp_old_browser();

	$slider_cls 		= "wprpsp-{$design}";
	$slider_cls			.= ($image_fit) 	? ' wprpsp-image-fit' 	: '';
	$slider_cls			.= ($old_browser) 	? ' wprpsp-old-browser' : '';

	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'slides_to_show','slides_to_scroll', 'infinite');

	// WP Query Parameters
	$args = array ( 
		'post_type'      		=> $post_type,
		'orderby'        		=> $orderby,
		'order'          		=> $order,
		'posts_per_page' 		=> $posts_per_page,
		'post__not_in'	 		=> $exclude_post,
		'post__in'		 		=> $posts,
		'ignore_sticky_posts'	=> $sticky_posts,
	);

	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
									array( 
											'taxonomy' 			=> $taxonomy,
											'field' 			=> 'term_id',
											'terms' 			=> $cat,
											'include_children'	=> $include_cat_child,
								));

	} else if( !empty($exclude_cat) ) {

		$args['tax_query'] = array(
									array(
										'taxonomy' 			=> $taxonomy,
										'field' 			=> 'term_id',
										'terms' 			=> $exclude_cat,
										'operator'			=> 'NOT IN',
										'include_children'	=> $include_cat_child,
										));
	}

	// WP Query
	$query 		= new WP_Query($args);
	$post_count = $query->post_count;

	ob_start();

	if ( $query->have_posts() ) : ?>

		<div class="wprpsp-carousel-pro-slider-wrp wprpsp-clearfix">
			<div id="wprpsp-recent-post-carousel-<?php echo $unique; ?>" class="wprpsp-recent-post-carousel <?php echo $slider_cls; ?> wprpsp-clearfix">
				<?php while ( $query->have_posts() ) : $query->the_post();

					$post_id 	= isset($post->ID) ? $post->ID : '';
					$post_link 	= wprpsp_get_post_link( $post->ID );
					$cat_list	= wprpsp_get_category_list($post->ID, $taxonomy);
					$feat_image = wprpsp_get_post_featured_image( $post->ID, $image_size, true );

		            // Include shortcode html file
					if( $design_file ) {
						include( $design_file );
					}

				endwhile; ?>
			</div>
			<div class="wprpsp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>

	<?php
	endif; // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;		             
}

// 'recent_post_carousel' Shortcode
add_shortcode( 'recent_post_carousel', 'wprpsp_post_carousel' );