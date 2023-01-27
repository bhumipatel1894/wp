<?php
/**
 * 'logo_grid' Shortcode
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `logo_grid` shortcode
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_logo_grid( $atts, $content ) {
	
	// Shortcode Parameters
	extract(shortcode_atts(array(
		'limit' 				=> '15',
		'cat_id' 				=> '',
		'include_cat_child'		=> 'true',
		'cat_name' 				=> '',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'grid' 					=> '4',
		'link_target' 			=> '',
		'show_title' 			=> 'true',
		'image_size' 			=> 'full',
		'design'				=> 'design-1',
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'posts'					=> array(),
		'animation'				=> '',
		'tooltip'				=> 'false',
		'content_words_limit' 	=> '20',
		'content_tail'			=> '...',
		), $atts));
	
	$shortcode_designs	= wpls_pro_logo_designs();
	$unique 			= wpls_pro_get_unique();
	$limit				= !empty($limit) 					? $limit 						: '15';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby			= !empty($orderby) 					? $orderby 						: 'date';
	$grid				= (!empty($grid) && $grid <= 12) 	? $grid 						: '4';
	$design 			= array_key_exists( trim($design), $shortcode_designs ) ? $design 	: 'design-1';
	$grid_class			= ($grid <= 12 ) 					? ('wpls-col-'.($grid)) 		: 'wpls-col-4';
	$show_title 		= ($show_title == 'false') 			? 'false'						: 'true';
	$cat_id				= (!empty($cat_id))					? explode(',',$cat_id) 			: '';
	$include_cat_child	= ( $include_cat_child == 'false' ) ? false 						: true;
	$exclude_cat 		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$exclude_post		= !empty($exclude_post)				? explode(',', $exclude_post) 	: array();
	$posts 				= !empty($posts)					? explode(',', $posts) 			: array();
	$animation 			= !empty($animation) 				? $animation 					: '';
	$animation_cls 		= ($animation == "") 				? 'has-no-animation'			: '';
	$tooltip 			= ($tooltip == 'true') 				? 'true' 						: 'false';
	$tooltip_cls 		= ($tooltip == "true") 				? 'wpls-tooltip'				: '';
	$words_limit 		= !empty( $content_words_limit ) 	? $content_words_limit : 20;
	$content_tail 		= html_entity_decode($content_tail);
	
	// Shortcode file
	$design_file 		= wpls_pro_get_design( $design, 'grid', 'design-1' );
	$design_file_path 	= WPLS_PRO_DIR . '/templates/' . $design_file . '.php';
	$design_file_path 	= (file_exists($design_file_path)) ? $design_file_path : '';
	
	// Enqueus required script
	if($tooltip == 'true') {
		wp_enqueue_script( 'wpos-tooltip-js' );
	}
	wp_enqueue_script( 'wpls-pro-public-js' );
	
	// Taking some globals
	global $post;
	
	// Taking some variables
	$count = 1;
	
	// WP Query Parameters
	$query_args = array(
			'post_type' 			=> WPLS_PRO_POST_TYPE,
			'post_status' 			=> array( 'publish' ),
			'posts_per_page'		=> $limit,
			'order'          		=> $order,
			'orderby'        		=> $orderby,
			'post__not_in'			=> $exclude_post,
			'post__in'				=> $posts,
			'ignore_sticky_posts'	=> true,
		);

	// Category Parameter
	if( !empty($cat_id) ) {

		$query_args['tax_query'] = array( 
										array(
											'taxonomy' 			=> WPLS_PRO_CAT, 
											'field' 			=> 'term_id',
											'terms' 			=> $cat_id,
											'include_children'	=> $include_cat_child,
										));

	} else if( !empty($exclude_cat) ) {

		$query_args['tax_query'] = array(
										array(
											'taxonomy' 			=> WPLS_PRO_CAT,
											'field' 			=> 'term_id',
											'terms' 			=> $exclude_cat,
											'operator'			=> 'NOT IN',
											'include_children'	=> $include_cat_child,
											));
	}

	// WP Query
	$logo_query = new WP_Query($query_args);
	$post_count = $logo_query->post_count;
	
	ob_start();
	
	// If post is there
	if( $logo_query->have_posts() ) {

		if( !empty($cat_name) ) { ?>
			<h3><?php echo $cat_name; ?></h3>
		<?php } ?>

		<div class="wpls-logo-showcase wpls-logo-grid wpls-logo-grid-<?php echo $unique .' wpls-'.$design.' '.$animation_cls; ?> wpls-clearfix" data-animation="<?php echo $animation; ?>">

	<?php
			while ($logo_query->have_posts()) : $logo_query->the_post();
				
				$first_last_cls = '';
				$feat_image 	= wpls_pro_get_logo_image($post->ID,$image_size);
				$logourl 		= get_post_meta( get_the_ID(), 'wplss_slide_link', true );

				if( $count == 1 ){
					$first_last_cls = 'wpls-first';
				} elseif ( $count == $grid ) {
					$count = 0;
					$first_last_cls = 'wpls-last';
				}
				$cnt_wrp_cls = "{$grid_class} wpls-columns {$first_last_cls} {$tooltip_cls}";

				// Include shortcode html file
				if( $design_file_path ) {
					include( $design_file_path );
				}

				$count++;
			endwhile;

			wp_reset_query(); // reset wp query
	?>		
		</div><!-- end .wpls-logo-grid -->

	<?php
		$content .= ob_get_clean();
		return $content;
	}
}

// `logo_grid` slider shortcode
add_shortcode('logo_grid', 'wpls_pro_logo_grid');