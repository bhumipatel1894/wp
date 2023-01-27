<?php
/**
 * Shortcode File
 *
 * Handles the 'wp-team' shortcode of plugin
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * 'wp-team' shortcode
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_team_showcase( $atts, $content = null ) {
	
	// Shortcode Parameter
	extract(shortcode_atts(array(
		'limit' 			=> '15',
		'category' 			=> '',
		'include_cat_child'	=> true,
		'design' 			=> 'design-1',
		'grid' 				=> '2',
		'popup' 			=> 'true',
		'popup_design'		=> 'design-1',
		'popup_theme'		=> 'dark',
		'popup_gallery'		=> 'true',
		'words_limit' 		=> 40,
		'content_tail' 		=> '...',
		'social_limit'		=> '6',
		'offset'			=> '',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
		'posts'				=> array(),
		'exclude_post'		=> array(),
		'exclude_cat'		=> array(),
		'show_content'		=> 'true',
		'show_full_content'	=> 'false',
		'pagination' 		=> 'false',
		'pagination_type'	=> 'numeric',
		'image_fit'			=> 'true',
	), $atts));
	
	$shortcode_designs 	= wp_tsasp_designs();
	$content_tail 		= html_entity_decode($content_tail);
	$limit 				= !empty($limit) 		? $limit 		: 15;
	$category 			= (!empty($category))	? explode(',',$category) : '';
	$design 			= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) 	: 'design-1';
	$gridcol 			= !empty($grid) 					? $grid 			: 1;
	$popup 				= ( $popup == 'false' ) 			? 'false' 			: 'true';
	$popup_design 		= !empty($popup_design) 			? $popup_design 	: 'design-1';
	$popup_theme		= ($popup_theme == 'light')			? 'wptsas-light'	: 'wptsas-dark';
	$popup_gallery		= ($popup_gallery == 'true')		? 'true'			: 'false';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 			: 'DESC';
	$orderby 			= (!empty($orderby))				? $orderby			: 'date';
	$posts 				= !empty($posts)					? explode(',', $posts) 			: array();
	$exclude_post 		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$exclude_cat		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$show_content 		= ( $show_content == 'false' ) 		? 'false' 						: 'true';
	$show_full_content 	= ( $show_full_content == 'true' ) 	? 'true' 						: 'false';
	$words_limit 		= !empty($words_limit) 				? $words_limit 					: 40;
	$offset 			=  trim($offset) != '' 				? $offset 						: '';
	$offset_cls			= ($offset == '')					? 'wp-tsasp-no-offset' 			: '';
	$style_offset		= $offset != ''  					? "style='padding:{$offset}px;'" : '';
	$pagination 		= ($pagination == 'true')			? 1		: 0;
	$pagination_type 	= ($pagination_type == 'prev-next')	? 'prev-next' 	: 'numeric';
	$image_fit			= ($image_fit == 'false')			? 0 : 1;

	// Shortcode file
	$design_file_path 	= WP_TSASP_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';

	// Enqueus required script
	if( $popup == 'true' ) {
		wp_enqueue_script('wpos-magnific-script');
		wp_enqueue_script( 'wp-tsasp-public-js' );

		// Popup Configuration
		$popup_conf = compact( 'popup_gallery' );
	}
	
	// Taking some globals
	global $post, $paged;
	
	// Taking variables
	$grid_count 		= 1;
	$popup_html 		= '';
	$unique				= wp_tsasp_get_unique();
	$old_browser		= wp_tsasp_old_browser();
	$per_row 			= wp_tsasp_grid_column( $gridcol );
	$shortcode_designs 	= wp_tsasp_designs();
	
	// Class variables
	$class 				= 'wp-tsasp-team-grid wptsas-medium-'.$per_row.' wptsas-columns';

	$wrpper_cls			= '';
	$wrpper_cls 		.= ($popup == 'true') 	? ' wp-tsasp-popup' 		: '';
	$wrpper_cls			.= ($old_browser) 		? ' wp-tsasp-old-browser' 	: '';
	$wrpper_cls			.= ($image_fit) 		? ' wp-tsasp-image-fit' 	: '';

	$popup_cls			= $popup_theme;
	$popup_cls			.= ($image_fit) 			? ' wp-tsasp-image-fit' 	: '';
	$popup_cls			.= ($old_browser) 			? ' wp-tsasp-old-browser' 	: '';

	// Query Parameter
	$args = array (
		'post_type'      	=> WP_TSASP_POST_TYPE,
		'orderby'        	=> $orderby,
		'order'         	=> $order,
		'posts_per_page'	=> $limit,
		'post_status'		=> array( 'publish' ),
		'post__not_in'		=> $exclude_post,
		'post__in'			=> $posts,
		'paged'          	=> ($pagination) ? $paged : 1,
	);

	// Category Parameter
	if( !empty($category) ) {

		$args['tax_query'] = array(
								array( 
									'taxonomy' 			=> WP_TSASP_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $category,
									'include_children'	=> $include_cat_child,
							));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
									array(
										'taxonomy' 			=> WP_TSASP_CAT,
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
	if ( $query->have_posts() ) { ?>
		
		<div class="wp-tsasp-team-wrp wp-tsasp-team-grid-wrp wptsasp-clearfix">
			<div class="wp-teamshowcase-grid wp-tsasp-teamshowcase wp-tsasp-<?php echo $design .' '. $offset_cls.' '.$wrpper_cls; ?> wptsasp-clearfix" id="wp-tsasp-teamshowcase-<?php echo $unique; ?>">
			
		<?php  while ( $query->have_posts() ) : $query->the_post();
				
				$popup_id = wp_tsasp_get_unique();

				// Taking some member details
				$teamfeat_image 	= wp_get_attachment_url( get_post_thumbnail_id() );
				$member_designation = get_post_meta($post->ID, '_member_designation', true);
				$member_department 	= get_post_meta($post->ID, '_member_department', true); 
				$skills 			= get_post_meta($post->ID, '_skills', true);
				$member_experience 	= get_post_meta($post->ID, '_member_experience', true); 

				// CSS class
				$css_class 		= ($grid_count == 1) ? 'first' : '';
				$css_class		.= empty($teamfeat_image) ? ' no-team-img' : '';

				// Including file
				if( $design_file ) {
					include( $design_file );
				}

		        // Creating Popup HTML
				if( $popup == 'true' ) {
					ob_start();
					include( WP_TSASP_DIR . '/templates/popup/'.$popup_design.'.php' );
					$popup_html .= ob_get_clean();
				}

				if( $gridcol == $grid_count ) {
					$grid_count = 0;
				}
				$grid_count++;

	          	endwhile;
	    		
			    if($popup == 'true') { ?>
		        	<div class="wp-tsasp-popup-conf" data-conf="<?php echo htmlspecialchars(json_encode($popup_conf)); ?>"></div>
		        <?php } ?>
			</div>

			<?php if($pagination && ($query->max_num_pages > 1) ) { ?>
			<div class="wptsasp-paging wptsasp-clearfix wp-tsasp-<?php echo $design;?>">

				<?php if($pagination_type == "numeric") {

					echo wp_tsasp_pagination(array('paged' => $paged, 'total' => $query->max_num_pages));

				} else { ?>
					<div class="wptsasp-pagi-btn wptsasp-prev-btn"><?php previous_posts_link( '&laquo; '.__('Previous', 'wp-team-showcase-and-slider') ); ?></div>
					<div class="wptsasp-pagi-btn wptsasp-next-btn"><?php next_posts_link( __('Next', 'wp-team-showcase-and-slider').' &raquo;', $query->max_num_pages ); ?></div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>

	<?php
		echo $popup_html; // Printing popup html

	} // End of have posts
	
	wp_reset_query(); // Reset wp query

	$content .= ob_get_clean();
	return $content;
}

// 'wp-team' shortcode
add_shortcode('wp-team', 'wp_tsasp_team_showcase');