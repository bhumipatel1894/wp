<?php
/**
 * 'recent_blog_post_slider' Shortcode
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpbaw_pro_blog_slider( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 				=> '20',	
		'category' 				=> '',
		'show_read_more'		=> 'true',
		'design' 				=> 'design-8',
		'show_author' 			=> 'true',
		'show_date' 			=> 'true',
		'show_category_name'	=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> '20',
		'slides_column' 		=> '3',
		'slides_scroll' 		=> '1',
		'dots' 					=> 'true',
		'arrows' 				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval' 	=> '2000',
		'speed' 				=> '300',		
		'loop' 					=> 'true',
		'content_tail'			=> '...',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'link_target'			=> 'self',
		'image_height'			=> '',
		'read_more_text'		=> '',
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'query_offset'			=> '',
		'rtl'					=> '',
		), $atts));

	$shortcode_designs 	= wpbaw_pro_recent_blog_slider_designs();
	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 					? $limit 		: '20';
	$cat 				= (!empty($category))				? explode(',',$category) 	: '';
	$showreadmore 		= ( $show_read_more == 'true' ) 	? 'true' 		: 'false';
	$blogdesign 		= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-8';
	$showDate 			= ( $show_date == 'true' ) 			? 'true' 		: 'false';
	$showCategory 		= ( $show_category_name == 'true' ) ? 'true' 		: 'false';
	$showContent 		= ( $show_content == 'true' ) 		? 'true' 		: 'false';
	$words_limit 		= !empty($content_words_limit) 		? $content_words_limit : 20;
	$slides_column 		= !empty($slides_column) 			? $slides_column : '3';
	$slides_scroll 		= !empty($slides_scroll) 			? $slides_scroll : '1';
	$dots 				= ( $dots == 'true' ) 		? 'true' : 'false';
	$arrows 			= ( $arrows == 'true' ) 	? 'true' : 'false';
	$autoplay 			= ( $autoplay == 'true' ) 	? 'true' : 'false';
	$autoplay_interval 	= !empty($autoplay_interval) ? $autoplay_interval : '2000';
	$speed 				= !empty($speed) ? $speed : '300';
	$infinite 			= ( $loop == 'true' ) 	? 'true' : 'false';
	$showAuthor 		= ( $show_author == 'true' ) 		? 'true' : 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 	: 'DESC';
	$orderby 			= !empty($orderby) 			? $orderby : 'date';
	$link_target 		= ($link_target == 'blank') ? '_blank' : '_self';
	$image_height		= (empty($image_height) && ($blogdesign == 'design-40' || $blogdesign == 'design-41')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height)) ? $image_height : '';
	$read_more_text 	= !empty($read_more_text) 	? $read_more_text 	: __('Read More', 'wp-blog-and-widgets');
	$exclude_post 		= !empty($exclude_post)		? explode(',', $exclude_post) 	: array();
	$exclude_cat 		= !empty($exclude_cat)		? explode(',', $exclude_cat) 	: array();
	$posts 				= !empty($posts)			? explode(',', $posts) 			: array();
	$query_offset		= !empty($query_offset)		? $query_offset 				: null;

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Shortcode file
	$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/' . $blogdesign . '.php';
	$design_file 			= (file_exists($blogdesign_file_path)) ? $blogdesign_file_path : '';

	// Taking some variables
	$count 			= 0;
	$newscount 		= 0;
	$grid_count 	= 1;
	$unique 		= wpbaw_pro_get_unique();
	$default_img	= wpbaw_pro_get_option('default_img');

	// Slider configuration
	$slider_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'rtl', 'infinite', 'centermode', 'blogdesign');

	// Query Parameter
	$args = array (
		'post_type'      	=> WPBAW_PRO_POST_TYPE,
		'orderby'        	=> $orderby,
		'order'          	=> $order,
		'posts_per_page' 	=> $posts_per_page,
		'post__not_in'		=> $exclude_post,
		'post__in'			=> $posts,
		'offset'			=> $query_offset,
	);

	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
			array(
					'taxonomy' 	=> WPBAW_PRO_CAT,
					'field' 	=> 'term_id',
					'terms' 	=> $cat
				));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
			array(
					'taxonomy' 	=> WPBAW_PRO_CAT,
					'field' 	=> 'term_id',
					'terms' 	=> $exclude_cat,
					'operator'	=> 'NOT IN'
				));
	}
	
	global $post;
	
	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	// Enqueue required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpbaw-pro-public-script' );

	ob_start();

	if ( $query->have_posts() ) { ?>

		<div class="wpbaw-pro-blog-slider-wrp">
			<div id="wpbaw-pro-blog-slider-<?php echo $unique; ?>" class="wpbaw-pro-blog-slider sp_blog_slider <?php echo $blogdesign; ?> wpbaw-grid-<?php echo $slides_column; ?>">

				<?php while ( $query->have_posts() ) : $query->the_post();

				$count++;
				$feat_image 	= wpbaw_pro_get_post_featured_image( $post->ID );
				$feat_image 	= ( $feat_image ) ? $feat_image : $default_img;
				$post_link 		= wpbaw_pro_get_post_link( $post->ID );
				$terms 			= get_the_terms( $post->ID, WPBAW_PRO_CAT );
				$blog_links 	= array();

				if($terms) {
					foreach ( $terms as $term ) {
						$term_link 		= get_term_link( $term );
						$blog_links[] 	= '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name = join( " ", $blog_links );

				// Include shortcode html file
				if( $design_file ) {
					include( $blogdesign_file_path );
				}
				
				$newscount++;
				$grid_count++;

				endwhile; 
				?>
			</div>
			<div class="wpbaw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
		</div>

	<?php } // End of if have post
	
		wp_reset_query(); // Reset WP Query

		$content .= ob_get_clean();
		return $content;
	}

// Recent blog post slider shortcode
add_shortcode('recent_blog_post_slider', 'wpbaw_pro_blog_slider');