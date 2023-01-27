<?php
/**
 * 'recent_blog_post' Shortcode
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpbaw_pro_recent_blog_post( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'category_name' 		=> '',
		'grid' 					=> '1',
		'design' 				=> '',
		'show_author' 			=> 'true',
		'show_full_content' 	=> 'false',
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> '20',
		'show_read_more' 		=> 'true',
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
		), $atts));

	$shortcode_designs 	= wpbaw_pro_recent_blog_designs();
	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 	? $limit 	: '20';
	$cat 				= (!empty($category))				? explode(',',$category) 	: '';
	$gridcol 			= !empty($grid) 	? $grid 	: 0;
	$blogcategory_name	= !empty($category_name) ? $category_name : '';
	$blogdesign 		= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-16';
	$showFullContent 	= ( $show_full_content == 'true' ) 		? 'true' 	: 'false';
	$showDate 			= ( $show_date == 'false' ) 			? 'false' 	: 'true';
	$showCategory 		= ( $show_category_name == 'false' ) 	? 'false' 	: 'true';
	$showContent 		= ( $show_content == 'false' ) 			? 'false' 	: 'true';
	$words_limit 		= !empty($content_words_limit) ? $content_words_limit : 20;
	$showAuthor 		= ( $show_author == 'true' ) 		? 'true' : 'false';
	$showreadmore 		= ( $show_read_more == 'false' ) 	? 'false' : 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 	: 'DESC';
	$orderby 			= !empty($orderby) 			? $orderby : 'date';
	$link_target 		= ($link_target == 'blank') ? '_blank' : '_self';
	$image_height		= (empty($image_height) && ($blogdesign == 'design-40' || $blogdesign == 'design-41' || $blogdesign == 'design-49' || $blogdesign == 'design-50')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height)) ? $image_height : '';
	$read_more_text 	= !empty($read_more_text) 	? $read_more_text 	: __('Read More', 'wp-blog-and-widgets');
	$exclude_cat 		= !empty($exclude_cat)		? explode(',', $exclude_cat) 	: array();
	$exclude_post 		= !empty($exclude_post)		? explode(',', $exclude_post) 	: array();
	$posts 				= !empty($posts)			? explode(',', $posts) 			: array();
	$query_offset		= !empty($query_offset)		? $query_offset 				: null;

	// Shortcode file
	$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/' . $blogdesign . '.php';
	$design_file 			= (file_exists($blogdesign_file_path)) ? $blogdesign_file_path : '';

	global $post;

	// Taking some variables
	$count 			= 0;
	$newscount 		= 0;
	$grid_count		= 1;
	$default_img	= wpbaw_pro_get_option('default_img');

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

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();

	// If post is there
	if ( $query->have_posts() ) { ?>

		<div class="sp_blog_static <?php echo $blogdesign; ?> wpbaw-grid-<?php echo $gridcol; ?> wpbaw-clearfix">

			<?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31") { ?>
				<div class="blog-block">		   
			<?php }
					if ($blogdesign == "design-23") { ?>
						<div class="blog-grid wp-medium-3 wpcolumns">
							<div class="blog-grid-content">
								<div class="latest-blog">
									<div class="latest-blog-inner">
										<h1 class="blog-title">
											<?php echo $blogcategory_name; ?>
										</h1>
									</div>
								</div>
							</div>
						</div>
						<?php } else if ($blogdesign != "design-23" && $blogcategory_name != '') { ?>
							<h1 class="category-title-main">
								<?php echo $blogcategory_name; ?>
							</h1>
						<?php }

						while ( $query->have_posts() ) : $query->the_post();

							$count++;
							$terms 		= get_the_terms( $post->ID, WPBAW_PRO_CAT );
							$feat_image = wpbaw_pro_get_post_featured_image( $post->ID );
							$feat_image = ($feat_image) ? $feat_image : $default_img;
							$post_link 	= wpbaw_pro_get_post_link( $post->ID );
							$news_links = array();

							if($terms) {
								foreach ( $terms as $term ) {
									$term_link = get_term_link( $term );
									$news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
								}
							}
							$cate_name = join( " ", $news_links );

							$css_class = "blogfirstlast";
							if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
							if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }

                			// Include shortcode html file
                			if( $design_file ) {
								include( $blogdesign_file_path );
							}

							$newscount++;
							$grid_count++;

						endwhile; ?>

				<?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31") { ?>
				</div>
				<?php } ?>

		</div>

	<?php } // End of if have posts
		
		wp_reset_query(); // Reset WP Query
		
		$content .= ob_get_clean();
		return $content;
}

// Recent blog post shortcode
add_shortcode('recent_blog_post', 'wpbaw_pro_recent_blog_post');