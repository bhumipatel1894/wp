<?php 
/**
 * `sp_news_slider` Shortcode
 * 
 * @package WP News and Five Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpnw_pro_get_news_slider( $atts, $content = null ) {

	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '-1',
		'category' 				=> '',
		'include_cat_child'		=> 'true',
		'category_name' 		=> '',
		'show_read_more' 		=> 'true',
		'read_more_text'		=> '',
		'design' 				=> '',
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> '20',
		'slides_column' 		=> '4',
		'slides_scroll' 		=> '1',
		'dots' 					=> 'true',
		'arrows' 				=> 'true',
		'autoplay' 				=> 'true',
		'autoplay_interval' 	=> '2000',
		'speed' 				=> '300',
		'loop' 					=> 'true',
		'rtl'					=> '',
		'content_tail'			=> '...',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'query_offset'			=> '',
		'link_target'			=> 'self',
		'posts'					=> array(),
		'exclude_post'			=> array(),
		'exclude_cat'			=> array(),
		'image_height'			=> '',
	), $atts));

	// Shortcode Parameters
	$shortcode_designs 		= wpnw_sp_news_slider_designs();
	$content_tail 			= html_entity_decode($content_tail);
	$posts_per_page			= (!empty($limit)) 					? $limit 					: '-1';
	$cat 					= (!empty($category))				? explode(',', $category) 	: '';
	$showreadmore 			= ( $show_read_more == 'true' ) 	? 'true' 				: 'false';
	$read_more_text 		= !empty($read_more_text) 			? $read_more_text 	: __('Read More', 'sp-news-and-widget');
	$newscategory_name 		= ($category_name) 					? $category_name 		: '';
	$showDate 				= ( $show_date == 'true' ) 			? 'true' 				: 'false';
	$showCategory 			= ( $show_category_name == 'true' ) ? 'true' 				: 'false';
	$showContent 			= ( $show_content == 'true' ) 		? 'true' 				: 'false';
	$words_limit 			= !empty($content_words_limit) 		? $content_words_limit 	: '20';
	$slides_column 			= !empty($slides_column) 			? $slides_column 		: '4';
	$slides_scroll 			= !empty($slides_scroll) 			? $slides_scroll		: '1';
	$dots 					= ( $dots == 'true' ) 				? 'true' 				: 'false';
	$arrows 				= ( $arrows == 'true' ) 			? 'true' 				: 'false';
	$autoplay 				= ( $autoplay == 'true' ) 			? 'true' 				: 'false';
	$autoplay_interval 		= !empty($autoplay_interval) 		? $autoplay_interval 	: 2000;
	$speed 					= !empty($speed) 					? $speed 				: '300';
	$loop 					= ( $loop == 'true' ) 				? 'true' 				: 'false';
	$order 					= ( strtolower($order) == 'asc' ) 	? 'ASC' 				: 'DESC';
	$orderby 				= (!empty($orderby))				? $orderby				: 'date';
	$link_target 			= ($link_target == 'blank') 		? '_blank' 				: '_self';
	$newdesign 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-8';
	$posts 					= !empty($posts)					? explode(',', $posts) 			: array();
	$exclude_post 			= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$exclude_cat			= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$query_offset			= !empty($query_offset)				? $query_offset 				: null;
	$image_height			= (empty($image_height) && ($newdesign == 'design-40' || $newdesign == 'design-41')) ? '500' : $image_height;
	$image_height 			= (!empty($image_height)) ? $image_height : '';
	$height_css 			= ($image_height) ? 'height:'.$image_height.'px;' : '';

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 'true';
	} elseif ( $rtl == 'true' ) {
		$rtl = 'true';
	} else {
		$rtl = 'false';
	}

	// Shortcode File
	$design_file_path 		= WPNW_PRO_DIR . '/templates/' . $newdesign . '.php';
	$design_file 			= (file_exists($design_file_path)) ? $design_file_path : '';

	// Enqueue required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wpnw-pro-public-script' );

	// Taking some globals
	global $post;

	// Taking some default
	$count 			= 0;
	$newscount 		= 0;
	$grid_count 	= 1;
	$unique			= wpnw_pro_get_unique();

	// Slider configuration
	$slider_conf = compact('slides_column', 'slides_scroll', 'dots', 'arrows', 'autoplay', 'autoplay_interval', 'speed', 'rtl', 'loop', 'newdesign');

	// Query Parameter
    $args = array ( 
            'post_type'      		=> WPNW_PRO_POST_TYPE,
            'posts_per_page' 		=> $posts_per_page,
            'post_status'			=> array( 'publish' ),
            'order'          		=> $order,
            'orderby'        		=> $orderby,
            'post__in'				=> $posts,
            'post__not_in'			=> $exclude_post,
            'ignore_sticky_posts'	=> true,
            'offset'				=> $query_offset,
	);

    // Category Parameter
	if( !empty($cat) ) {
		
		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WPNW_PRO_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
							));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
									array(
										'taxonomy' 			=> WPNW_PRO_CAT,
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
	if ( $query->have_posts() ) {

		if ($newscategory_name != '') { ?>
			<h1 class="category-title-main">		   
				<?php echo $newscategory_name; ?>
			</h1>
		<?php } ?>
		
		<div class="wpnw-pro-news-slider-wrp">
			<div class="wpnaw-news-slider sp_news_slider <?php echo $newdesign; ?>" id="wpnw-pro-news-slider-<?php echo $unique; ?>">
				
	            <?php while ( $query->have_posts() ) : $query->the_post();
	            	$count++;
	            	$post_link 				= wpnw_pro_get_post_link( $post->ID );
					$post_featured_image 	= wpnw_get_post_featured_image( $post->ID, '', true );
	               	$terms 					= get_the_terms( $post->ID, WPNW_PRO_CAT );
					$news_links 			= array();
					
					if($terms) {
	                    foreach ( $terms as $term ) {
	                        $term_link = get_term_link( $term );
	                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
	                    }
	                }
					$cate_name = join( " ", $news_links );
					
					if( $design_file ) {
	              		include( $design_file );
	              	}
					
					$newscount++;
					$grid_count++;
	            	endwhile;
				?>
			</div>
			<div class="wpnw-pro-slider-conf"><?php echo htmlspecialchars(json_encode($slider_conf)); ?></div>
		</div>
		
	<?php
	} // End of have_post()
	
	wp_reset_query(); // Reset WP Query
	
	$content .= ob_get_clean();
	return $content;
}

// 'sp_news_slider' shortcode
add_shortcode('sp_news_slider', 'wpnw_pro_get_news_slider');