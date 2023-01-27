<?php
/**
 * 'logo_filter' Shortcode
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to handle the `logo_filter` shortcode
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_logo_filter( $atts, $content ) {

	// Shortcode Parameters
	extract(shortcode_atts(array(
		'design'				=> 'design-1',
		'limit' 				=> '20',
		'cat_id' 				=> '',
		'cat_name' 				=> '',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'grid' 					=> '4',
		'link_target'			=> 'self',
		'show_title' 			=> 'true',
		'image_size' 			=> 'full',
		'cat_limit'				=> 0,
		'cat_order'				=> 'asc',
		'cat_orderby'			=> 'name',
		'exclude_cat'			=> array(),
		'tooltip'				=> '',
		'include_cat_child'		=> 'true',
		'all_filter_text'		=> '',
		'content_words_limit' 	=> '20',
		'content_tail'			=> '...',
		), $atts));
	
	$shortcode_designs	= wpls_pro_logo_designs();
	$unique 			= wpls_pro_get_unique();
	$design 			= array_key_exists( trim($design), $shortcode_designs ) ? $design 	: 'design-1';
	$link_target 		= ($link_target == 'blank') 		? '_blank' 						: '_self';
	$limit				= !empty($limit) 					? $limit 						: '20';
	$order 				= ( strtolower($order) == 'asc' ) 	? 'ASC' 						: 'DESC';
	$orderby			= !empty($orderby) 					? $orderby 						: 'date';
	$grid				= (!empty($grid) && $grid <= 12) 	? $grid 						: '4';
	$grid_class			= ($grid <= 12 ) 					? ('wpls-col-'.($grid)) 		: 'wpls-col-4';
	$cat_id				= (!empty($cat_id))					? explode(',',$cat_id) 			: '';
	$cat_limit			= !empty($cat_limit) 					? $cat_limit 				: 0;
	$cat_order 			= ( strtolower($cat_order) == 'asc' ) 	? 'ASC' 					: 'DESC';
	$cat_orderby		= !empty($cat_orderby) 					? $cat_orderby 				: 'name';
	$exclude_cat 		= !empty($exclude_cat)				? explode(',', $exclude_cat) 	: array();
	$tooltip 			= ($tooltip == "true") 				? 'true' 						: 'false';
	$tooltip_cls 		= ($tooltip == "true") 				? 'wpls-tooltip'				: '';
	$include_cat_child	= ( $include_cat_child == 'false' ) ? false 						: true;
	$all_filter_text 	= !empty($all_filter_text) ? $all_filter_text : __('All', 'logoshowcase');
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
	wp_enqueue_script( 'wpos-filterizr-js' );
	wp_enqueue_script( 'wpls-pro-public-js' );

	// Taking some globals
	global $post;

	// Taking some variables
	$cnt_wrp_cls 	= "{$tooltip_cls}";

	// Getting Terms
	$wplsterms = get_terms( array(
							'taxonomy' 		=> WPLS_PRO_CAT,
							'hide_empty' 	=> true,
							'fields'		=> 'id=>name',
							'number'		=> $cat_limit,
							'order'			=> $cat_order,
							'orderby'		=> $cat_orderby,
							'include'       => $cat_id,
							'exclude'       => $exclude_cat,
				));

	ob_start();

	// If category is there
	if( !is_wp_error($wplsterms) && !empty($wplsterms) ) {

		// Getting ids 
		$logo_cats = array_keys( $wplsterms );

		// WP Query Parameters
		$query_args = array(
				'post_type' 			=> WPLS_PRO_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'posts_per_page'		=> -1,
				'order'          		=> $order,
				'orderby'        		=> $orderby,
				'ignore_sticky_posts'	=> true,
			);

		// Category Parameter
		if( !empty($logo_cats) ) {

			$query_args['tax_query'] = array( 
											array(
												'taxonomy' 			=> WPLS_PRO_CAT, 
												'field' 			=> 'term_id',
												'terms' 			=> $logo_cats,
												'include_children'	=> $include_cat_child,
											));
		}

		// WP Query
		$logo_query = new WP_Query($query_args);
		$post_count = $logo_query->post_count;

		// If logo post is there
		if( $logo_query->have_posts() ) {

			if( !empty($cat_name) ) { ?>
				<h3><?php echo $cat_name; ?></h3><?php
			}
	?>

		<div class="wpls-filter-wrp">
			<ul class="wpls-filter">
				<li class="wpls-filtr-cat wpls-active-filtr" data-filter="all"><a href="javascript:void(0);"><?php echo $all_filter_text; ?></a></li>
				<?php foreach ($wplsterms as $term_id => $term_name) { ?>
					<li class="wpls-filtr-cat" data-filter="<?php echo $term_id; ?>"><a href="javascript:void(0);"><?php echo $term_name; ?></a></li>
				<?php } ?>
			</ul>

			<div class="wpls-filtr-container" id="wpls-logo-filtr-<?php echo $unique; ?>">
				<div class="wpls-logo-showcase wpls-logo-filter <?php echo 'wpls-'.$design; ?> has-no-animation wpls-clearfix">

				<?php while ($logo_query->have_posts()) : $logo_query->the_post();

					$feat_image = wpls_pro_get_logo_image($post->ID, $image_size);
					$logourl 	= get_post_meta( get_the_ID(), 'wplss_slide_link', true );
					$postcats 	= get_the_terms($post->ID, WPLS_PRO_CAT);
					$usedcat	= array();

					if( !is_wp_error($postcats) && !empty($postcats) ) {
						foreach ($postcats as $postcat) {
							$usedcat[] = $postcat->term_id;
						}
					}
					$data_category = !empty($usedcat) ? implode(', ',$usedcat) : '1';
					?>

					<div class="<?php echo $grid_class; ?> filtr-item" data-category="<?php echo $data_category; ?>">
					<?php
						// Include shortcode html file
						if( $design_file_path ) {
							include( $design_file_path );
						}
					?>
					</div><!-- end .wpls-logo-cnt -->

					<?php endwhile; ?>

				</div><!-- end .wpls-logo-showcase -->
			</div><!-- end .wpls-filtr-container -->
		</div><!-- end .wpls-filter-wrp -->

		<?php
		} // End of have post

		wp_reset_query(); // reset wp query

		$content .= ob_get_clean();
		return $content;

	} // End of category check
}

// 'logo_filter' Shortcode
add_shortcode('logo_filter', 'wpls_pro_logo_filter');