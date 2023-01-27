<?php
/**
 * 'gridbox_post_slider' Shortcode
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wprpsp_gridbox_post_slider( $atts, $content = null ) {
	
    // Shortcode Parameter
	extract(shortcode_atts(array(
		'post_type'				=> 'post',
		'taxonomy'				=> 'category',
		'limit' 				=> '20',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'design' 				=> 'design-1',
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_content' 			=> 'false',
		'show_author' 			=> 'true',
		'content_words_limit' 	=> '20',
		'fade'                  => 'false',
		'content_tail'			=> '...',
		'dots'     				=> 'true',
		'arrows'     			=> 'true',				
		'autoplay'     			=> 'true',		
		'autoplay_interval' 	=> '3000',				
		'speed'             	=> '600',
		'loop'					=> 'true',
		'rtl'					=> '',
		'link_target'			=> 'self',		
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'exclude_cat'			=> array(),
		'hide_post'        		=> array(),
		'posts'					=> array(),
		'image_height'			=> '',
		'sticky_posts' 			=> 'false',		
		'image_fit'				=> 'true',		
		), $atts, 'gridbox_post_slider'));

	$supported_post_types 	= wprpsp_get_option('post_types',array());
	$shortcode_designs 		= wprpsp_gridbox_slider_designs();

	$post_type 				= (!empty($post_type) && in_array($post_type, $supported_post_types))	? $post_type : 'post';
	$taxonomy 				= (!empty($taxonomy))					? $taxonomy						: 'category';
	$posts_per_page 		= !empty($limit) 						? $limit 						: '20';
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$include_cat_child		= ( $include_cat_child == 'false' ) 	? false 						: true;
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$showDate 				= ( $show_date == 'false' ) 			? 'false'						: 'true';
	$showCategory 			= ( $show_category_name == 'false' )	? 'false' 						: 'true';
	$showContent 			= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$showAuthor 			= ( $show_author == 'false')			? 'false'						: 'true';
	$words_limit 			= !empty( $content_words_limit ) 		? $content_words_limit 			: 20;
	$fade 					= ( $fade == 'false' ) 					? 'false' 						: 'true';
	$dots 					= ( $dots == 'false' ) 					? 'false' 						: 'true';
	$arrows 				= ( $arrows == 'true' ) 				? 'true' 						: 'false';
	$autoplay 				= ( $autoplay == 'false' ) 				? 'false' 						: 'true';
	$autoplay_interval 		= !empty($autoplay_interval) 			? $autoplay_interval 			: '3000';
	$speed 					= !empty($speed) 						? $speed 						: '600';
	$infinite 				= ( $loop == 'true' ) 					? 'true' 						: 'false';
	$link_target 			= ($link_target == 'blank') 			? '_blank' 						: '_self';	
	$order					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby				= !empty($orderby) 						? $orderby 						: 'date';
	$exclude_cat			= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$exclude_post			= !empty($hide_post)					? explode(',', $hide_post) 		: array();
	$posts					= !empty($posts)						? explode(',', $posts) 			: array();	
	$sticky_posts 			= ( $sticky_posts == 'true' ) 			? false 						: true;
	$image_fit				= ($image_fit == 'false')				? 0 : 1;
	$content_tail 			= html_entity_decode($content_tail);	

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Shortcode file
	$design_file_path 	= WPRPSP_DIR . '/templates/gridbox/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';

	// Enqueus required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wprpsp-public-script' );
	
	// Taking some global
	global $post;

	// Taking some variables
	$count 				= 0;
	$grid_count			= 1;	
	$unique				= wprpsp_get_unique();
	$old_browser		= wprpsp_old_browser();	

	$slider_cls 		= "wprpsp-gridbox-slider wprpsp-{$design}";
	$slider_cls			.= ($image_fit) 	? ' wprpsp-image-fit' 	: '';
	$slider_cls			.= ($old_browser) 	? ' wprpsp-old-browser' : '';

	// Slider configuration
	$slider_conf = compact('dots', 'arrows', 'fade', 'autoplay', 'autoplay_interval', 'speed', 'design', 'rtl', 'infinite');

	// WP Query Parameters
	$args = array (
		'post_type'      		=> $post_type,
		'post_status' 			=> array( 'publish' ),
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

	// If post is there
	if ( $query->have_posts() ) : ?>

		<div class="wprpsp-gridbox-slider-wrp wprpsp-clearfix">
			<div id="wprpsp-gridbox-slider-<?php echo $unique; ?>" class="<?php echo $slider_cls; ?>">
				<?php while ( $query->have_posts() ) : $query->the_post();

					$count++;
					$post_id 		= isset($post->ID) ? $post->ID : '';
					$post_link 		= esc_url( wprpsp_get_post_link($post->ID) );
					$cat_list		= wprpsp_get_category_list($post->ID, $taxonomy);
					$feat_image 	= wprpsp_get_post_featured_image( $post->ID, 'large', true );

	            	// Include shortcode html file
					if( $design_file ) {
						include( $design_file );
					}
					$grid_count++;
					endwhile;
				?>
			</div>			
			<div class="wprpsp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>

	<?php
	endif; // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'recent_post_slider' shortcode
add_shortcode( 'gridbox_post_slider', 'wprpsp_gridbox_post_slider' );