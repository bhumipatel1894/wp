<?php
/**
 * 'wpspw_recent_post_slider' Shortcode
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `wpspw_recent_post_slider` shortcode
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */
function wpspw_pro_post_slider( $atts, $content = null ) {
	
    // Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'show_read_more' 		=> 'true',
		'design' 				=> 'design-1',
		'show_author' 			=> 'true',
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> '20',
		'slides_column' 		=> '3',
		'slides_scroll' 		=> '1',
		'dots' 					=> 'true',
		'arrows'				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval' 	=> '2000',
		'speed' 				=> '300',
		'loop' 					=> 'true',
		'content_tail'			=> '...',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'link_target'			=> 'self',
		'image_height'			=> '',
		'read_more_text'		=> __('Read More', 'blog-designer-for-post-and-widget'),
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'rtl'					=> 'false',
		'category_name' 		=> '',
		'show_tags'				=> 'false',
		'show_comments'			=> 'false',
		), $atts));
	
	$shortcode_designs 		= wpspw_pro_recent_post_slider_designs();
	$content_tail 			= html_entity_decode($content_tail);
	$posts_per_page 		= !empty($limit) 						? $limit 						: '20';
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$showreadmore 			= ( $show_read_more == 'false' )		? 'false' 						: 'true';
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$showDate 				= ( $show_date == 'false' ) 			? 'false'						: 'true';
	$showCategory 			= ( $show_category_name == 'false' )	? 'false' 						: 'true';
	$showContent 			= ( $show_content == 'false' ) 			? 'false' 						: 'true';
	$words_limit 			= !empty( $content_words_limit ) 		? $content_words_limit	 		: 20;
	$slides_column 			= !empty( $slides_column ) 				? $slides_column 				: 3;
	$slides_scroll 			= !empty( $slides_scroll ) 				? $slides_scroll 				: 1;
	$dots 					= ( $dots == 'false' )					? 'false' 						: 'true';
	$arrows 				= ( $arrows == 'false' )				? 'false' 						: 'true';
	$autoplay 				= ( $autoplay == 'false' )				? 'false' 						: 'true';
	$autoplay_interval 		= !empty( $autoplay_interval ) 			? $autoplay_interval 			: 2000;
	$speed 					= !empty( $speed ) 						? $speed 						: 300;
	$loop 					= ( $loop == 'false' )					? 'false' 						: 'true';
	$showAuthor 			= ($show_author == 'false')				? 'false'						: 'true';
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 						? $orderby 						: 'date';
	$link_target 			= ($link_target == 'blank')				 ? '_blank' 					: '_self';
	$image_height			= (empty($image_height) && ($design == 'design-40' || $design == 'design-41')) ? '500' : $image_height;
	$image_height 			= (!empty($image_height)) 				? $image_height 				: '';
	$read_more_text 		= !empty($read_more_text) 				? $read_more_text 				: __('Read More', 'blog-designer-for-post-and-widget');
	$exclude_post 			= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$exclude_cat 			= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$posts 					= !empty($posts)						? explode(',', $posts) 			: array();
	$show_tags 				= ( $show_tags == 'false' ) 			? 'false'						: 'true';
	$show_comments 			= ( $show_comments == 'false' ) 		? 'false'						: 'true';
	
	// Shortcode file
	$post_design_file_path 	= WPSPW_PRO_DIR . '/templates/' . $design . '.php';
	$design_file 			= (file_exists($post_design_file_path)) ? $post_design_file_path : '';
	
	// Slider configuration
	$slider_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'rtl', 'loop', 'design');
	
	// Enqueue required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpspw-pro-public-script' );

	// Taking some globals
	global $post;

	// Taking some variables
	$unique			= wpspw_pro_get_unique();
	$count 			= 0;
	$newscount 		= 0;	
	$grid_count 	= 1;
	$default_img	= wpspw_pro_get_option('default_img');

	// WP Query Parameters
	$args = array ( 
				'post_type'     	 	=> WPSPW_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'orderby'        		=> $orderby, 
				'order'          		=> $order,
				'posts_per_page' 		=> $posts_per_page,
				'post__not_in'			=> $exclude_post,
				'post__in'				=> $posts,
				'ignore_sticky_posts'	=> true,
			);
	
	// Category Parameter
	if($cat != "") {

		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> WPSPW_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $cat
								));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
								array(
									'taxonomy' 	=> WPSPW_CAT,
									'field' 	=> 'term_id',
									'terms' 	=> $exclude_cat,
									'operator'	=> 'NOT IN'
								));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

	<div class="wpspw-pro-slider-wrp">
		<div class="wpspw-post-slider sp_wpspwpost_slider <?php echo 'wpspw-'.$design; ?>" id="wpspw-pro-slider-<?php echo $unique; ?>">

			<?php while ( $query->have_posts() ) : $query->the_post();
				
				$count++;
				$terms 		= get_the_terms( $post->ID, WPSPW_CAT );
				$cat_links = array();
				
				if($terms) {
					foreach ( $terms as $term ) {
						$term_link = get_term_link( $term );
						$cat_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
					}
				}
				$cate_name 		= join( " ", $cat_links );
				
				$feat_image 	= wpspw_pro_get_post_featured_image( $post->ID, null, true );
				$post_link 		= wpspw_pro_get_post_link( $post->ID );
				$terms 			= get_the_terms( $post->ID, WPSPW_CAT );
				$tags 			= get_the_tag_list(' ',', ');
				$comments 		= get_comments_number( $post->ID );
				$reply			= ($comments <= 1)  ? __('Reply', 'blog-designer-for-post-and-widget') : __('Replies', 'blog-designer-for-post-and-widget');
				
				// Include shortcode html file
				if( $design_file ) {
					include( $design_file );
				}

				$newscount++;
				$grid_count++;
			endwhile;
		?>
		</div>
		<div class="wpspw-pro-slider-conf"><?php echo htmlspecialchars(json_encode( $slider_conf )); ?></div>
	</div>

	<?php
	} // End of have_post()
	
	wp_reset_query(); // Reset WP Query
	
	$content .= ob_get_clean();
	return $content;
}

// 'wpspw_recent_post_slider' Shortcode
add_shortcode('wpspw_recent_post_slider', 'wpspw_pro_post_slider');