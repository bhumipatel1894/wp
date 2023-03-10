<?php
/**
 * 'blog' Shortcode
 * 
 * @package WP Blog and Widgets Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wpbaw_pro_get_blog( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 				=> '20',
		'category' 				=> '',
		'grid' 					=> '1',
		'design' 				=> 'design-16',
		'show_author' 			=> 'true',
		'pagination' 			=> 'true',
		'pagination_type'		=> 'numeric',
		'show_date' 			=> 'true',
		'show_category_name' 	=> 'true',
		'show_full_content' 	=> 'false',
		'show_content' 			=> 'true',
		'content_words_limit' 	=> '20',
		'show_read_more' 		=> 'true',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'content_tail'			=> '...',
		'link_target'			=> 'self',
		'image_height'			=> '',
		'read_more_text'		=> '',
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'query_offset'			=> '',
		), $atts));

	$shortcode_designs 	= wpbaw_pro_blog_designs();
	$content_tail 		= html_entity_decode($content_tail);
	$posts_per_page 	= !empty($limit) 					? $limit 					: '20';
	$cat 				= (!empty($category))				? explode(',',$category) 	: '';
	$blogdesign 		= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-16';
	$showAuthor 		= ($show_author == 'false')			? 'false'					: 'true';
	$blogpagination 	= ($pagination == 'false')			? 'false'					: 'true';
	$pagination_type 	= ($pagination_type == 'prev-next')	? 'prev-next' 				: 'numeric';
	$showDate 			= ( $show_date == 'false' ) 		? 'false'					: 'true';
	$gridcol 			= !empty($grid) ? $grid : '1';
	$showCategory 		= ( $show_category_name == 'false' )? 'false' 					: 'true';
	$showContent 		= ( $show_content == 'false' ) 		? 'false' 					: 'true';
	$words_limit 		= !empty( $content_words_limit ) 	? $content_words_limit 		: 20;
	$showFullContent 	= ( $show_full_content == 'true' )	? 'true' 					: 'false';
	$showreadmore 		= ( $show_read_more == 'false' )	? 'false' 					: 'true';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 					: 'DESC';
	$orderby 			= !empty($orderby) 					? $orderby 					: 'date';
	$link_target 		= ($link_target == 'blank') ? '_blank' : '_self';
	$image_height		= (empty($image_height) && ($blogdesign == 'design-40' || $blogdesign == 'design-41')) ? '500' : $image_height;
	$image_height 		= (!empty($image_height)) 	? $image_height 	: '';
	$read_more_text 	= !empty($read_more_text) 	? $read_more_text 	: __('Read More', 'wp-blog-and-widgets');
	$exclude_cat 		= !empty($exclude_cat)		? explode(',', $exclude_cat) 	: array();
	$exclude_post 		= !empty($exclude_post)		? explode(',', $exclude_post) 	: array();
	$posts 				= !empty($posts)			? explode(',', $posts) 			: array();
	$query_offset		= !empty($query_offset)		? $query_offset 				: null;

	// Shortcode file
	$blogdesign_file_path 	= WPBAW_PRO_DIR . '/templates/' . $blogdesign . '.php';
	$design_file 			= (file_exists($blogdesign_file_path)) ? $blogdesign_file_path : '';

	global $post, $paged;

	// Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}
	
	// Query Parameters
	$args = array ( 
		'post_type'      	=> WPBAW_PRO_POST_TYPE,
		'orderby'        	=> $orderby,
		'order'          	=> $order,
		'posts_per_page' 	=> $posts_per_page,
		'paged'         	=> $paged,
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

	// Taking some variables
	$count 			= 0; 
	$newscount 		= 0;
	$grid_count		= 1;
	$default_img	= wpbaw_pro_get_option('default_img');

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

					while ( $query->have_posts() ) : $query->the_post();

					$count++;
					$feat_image = wpbaw_pro_get_post_featured_image( $post->ID );
					$feat_image = ($feat_image) ? $feat_image : $default_img;
					$post_link 	= wpbaw_pro_get_post_link( $post->ID );
					$terms 		= get_the_terms( $post->ID, WPBAW_PRO_CAT );

					$news_links = array();
					if($terms) {
						foreach ( $terms as $term ) {
							$term_link 		= get_term_link( $term );
							$news_links[] 	= '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
						}
					}
					$cate_name = join( " ", $news_links );
					$css_class = "blogfirstlast";

					if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == ($count - 1) % $grid ) ) || 1 == $count ) { $css_class .= ' first'; }
					if ( ( is_numeric( $grid ) && ( $grid > 0 ) && ( 0 == $count % $grid ) ) || $post_count == $count ) { $css_class .= ' last'; }

            		// Include shortcode html file
            		if( $design_file ) {
						include( $design_file );
					}
					
					$newscount++;
					$grid_count++;
					
					endwhile; ?>
					
					<?php if ($blogdesign == "design-28" || $blogdesign == "design-29" || $blogdesign == "design-31") { ?>
					</div>
					<?php } ?>

				</div>

				<?php if( $blogpagination == "true" && ($query->max_num_pages > 1) ) { ?>
					<div class="blog_pagination wpbaw-clearfix">

						<?php if($pagination_type == "numeric") {

							echo wpbaw_pro_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages ) );

						} else { ?>
							<div class="button-blog-p"><?php next_posts_link( ' Next >>', $query->max_num_pages ); ?></div>
							<div class="button-blog-n"><?php previous_posts_link( '<< Previous' ); ?> </div>
							<?php } ?>
						</div>

						<?php }

	} // End of have post if

    wp_reset_query(); // Reset WP Query

    $content .= ob_get_clean();
    return $content;
}

// `Blog` shortcode
add_shortcode('blog', 'wpbaw_pro_get_blog');