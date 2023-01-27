<?php
/**
 * 'recent_post_slider' Shortcode
 * 
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wprpsp_recent_post_slider( $atts, $content = null ) {
	
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
		'show_content' 			=> 'true',
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
		'show_read_more'   		=> 'true',
		'read_more_text'		=> '',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'exclude_cat'			=> array(),
		'hide_post'        		=> array(),
		'posts'					=> array(),
		'slider_height'			=> '',
		'sticky_posts' 			=> 'false',
		'image_size' 			=> 'full',
		'image_fit'				=> 'true',		
		), $atts, 'recent_post_slider'));

	$supported_post_types 	= wprpsp_get_option('post_types',array());
	$shortcode_designs 		= wprpsp_recent_post_slider_designs();

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
	$arrows 				= ( $arrows == 'false' ) 				? 'false' 						: 'true';
	$autoplay 				= ( $autoplay == 'false' ) 				? 'false' 						: 'true';
	$autoplay_interval 		= !empty($autoplay_interval) 			? $autoplay_interval 			: '3000';
	$speed 					= !empty($speed) 						? $speed 						: '600';
	$infinite 				= ( $loop == 'true' ) 					? 'true' 						: 'false';
	$link_target 			= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$showreadmore 			= ( $show_read_more == 'false' )		? 'false' 						: 'true';
	$order					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby				= !empty($orderby) 						? $orderby 						: 'date';
	$exclude_cat			= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$exclude_post			= !empty($hide_post)					? explode(',', $hide_post) 		: array();
	$posts					= !empty($posts)						? explode(',', $posts) 			: array();
	$read_more_text 		= !empty($read_more_text) 				? $read_more_text 				: __('Read More', 'wp-responsive-recent-post-slider');
	$slider_height 			= (!empty($slider_height)) 				? $slider_height 				: '';
	$slider_height_css 		= (!empty($slider_height))				? "style='height:{$slider_height}px;'" : '';
	$sticky_posts 			= ( $sticky_posts == 'true' ) 			? false 						: true;
	$image_size 			= !empty($image_size) 					? $image_size 			 		: 'full';
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
	$design_file_path 	= WPRPSP_DIR . '/templates/slider/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';

	// Enqueus required script
	wp_enqueue_script( 'wpos-slick-jquery' );
	wp_enqueue_script( 'wprpsp-public-script' );
	
	// Taking some global
	global $post;

	// Taking some variables
	$count 				= 0;
	$grid_count			= 1;
	$slider_as_nav_for 	= '';
	$unique				= wprpsp_get_unique();
	$old_browser		= wprpsp_old_browser();
	$nav_designs 		= array( 'design-17', 'design-18', 'design-19', 'design-20' );

	$slider_cls 		= "wprpsp-recent-post-slider wprpsp-post-slider wprpsp-{$design}";
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

	// For Navigation design
	if( in_array( $design, $nav_designs) ) {
		$slider_as_nav_for 	= "data-slider-nav-for='wprpsp-recent-post-nav-{$unique}'";
		$slider_cls 		.= ' wprpsp-post-nav-slider wprpsp-medium-8 wprpsp-columns block-no-padding';
	}

	ob_start();

	// If post is there
	if ( $query->have_posts() ) : ?>

		<div class="wprpsp-pro-slider-wrp wprpsp-clearfix">
			<div id="wprpsp-pro-slider-<?php echo $unique; ?>" class="<?php echo $slider_cls; ?>" <?php echo $slider_as_nav_for; ?>>
				<?php while ( $query->have_posts() ) : $query->the_post();

					$count++;
					$post_id 		= isset($post->ID) ? $post->ID : '';
					$post_link 		= esc_url( wprpsp_get_post_link($post->ID) );
					$cat_list		= wprpsp_get_category_list($post->ID, $taxonomy);
					$feat_image 	= wprpsp_get_post_featured_image( $post->ID, $image_size, true );

	            	// Include shortcode html file
					if( $design_file ) {
						include( $design_file );
					}

					$grid_count++;
					endwhile;
				?>
			</div>

			<?php
			// For Slider As Nav For Navigation HTML
			if( in_array( $design, $nav_designs) ) { ?>

				<div class="wprpsp-recent-post-nav-<?php echo $unique; ?> wprpsp-recent-post-nav wprpsp-<?php echo $design; ?> wprpsp-medium-4 wprpsp-columns">

				<?php
					while ( $query->have_posts() ) : $query->the_post(); 

						$nav_thumb_img = wprpsp_get_post_featured_image( $post->ID, array(80, 80) );
				?>
					<div class="wprpsp-post-nav-loop">
						<?php if( !empty($nav_thumb_img) ) { ?>
							<img src="<?php echo $nav_thumb_img; ?>" alt="<?php _e('Post Nav Image', 'wp-responsive-recent-post-slider'); ?>" height="80" width="80" />
						<?php } else { ?>
							<div class="wprpsp-post-noimg"></div>
						<?php } ?>

						<span class="wprpsp-block-right-content">
							<span class="wprpsp-block-right-title"><?php echo wprpsp_limit_words( get_the_title(), 6 ); ?></span>
							<?php if($showDate == "true") { ?>
								<span class="wprpsp-post-date"><?php echo get_the_date(); ?></span>
							<?php } ?>
						</span>
					</div>
					<?php endwhile; ?>
				</div>
			<?php
			} // End of design array check
		?>
			<div class="wprpsp-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
		</div>

	<?php
	endif; // End of have_post()

	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'recent_post_slider' shortcode
add_shortcode( 'recent_post_slider', 'wprpsp_recent_post_slider' );