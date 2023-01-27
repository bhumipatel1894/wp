<?php
/**
 * 'pap_portfolio_filter' Shortcode
 * 
 * @package  Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wp_pap_pro_portfolio_filter_shortcode( $atts, $content = '') {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'design' 				=> 'design-1',
		'grid' 					=> 3,
		'category' 				=> '',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'popup_style' 			=> 'inline',
		'include_cat_child'		=> 'true',
		'exclude_cat'			=> array(),
		'link'					=> 'true',
		'link_target'			=> 'self',
		'image_size'			=> 'full',
		'design_offset' 		=> '',
		'portfolio_height'		=> '',
		'cat_limit'				=> 0,
		'cat_order'				=> 'asc',
		'cat_orderby'			=> 'name',
		'all_filter_text'		=> '',
		'image_fit'				=> 'true',
		'rtl'					=> '',
	), $atts, 'pap_portfolio_filter'));

	$shortcode_designs 		= wp_pap_pro_slider_designs();
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$main_grid 				= (!empty($grid) && $grid <= 4) 		? $grid 						: 3;
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 						? $orderby 						: 'date';	
	$include_cat_child		= ($include_cat_child == 'false' ) 		? false 						: true;
	$exclude_cat 			= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$link 					= ($link == 'true')						? 1								: 0;
	$link_target 			= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$image_size				= !empty($image_size)					? $image_size					: 'full';
	$popup_style_design		= wp_pap_pro_popup_style();
	$popup_style 			= ($popup_style && (array_key_exists(trim($popup_style), $popup_style_design))) ? trim($popup_style) : '';
	$grid 					= wp_pap_grid_column($grid);
	$all_filter_text 		= !empty($all_filter_text) 				? $all_filter_text 			: __('All', 'portfolio-and-projects');
	$cat_limit				= !empty($cat_limit) 					? $cat_limit 				: 0;
	$cat_order 				= ( strtolower($cat_order) == 'asc' ) 	? 'ASC' 					: 'DESC';
	$cat_orderby			= !empty($cat_orderby) 					? $cat_orderby 				: 'name';
	$image_fit				= ($image_fit == 'false')			? 0 : 1;
	$portfolio_height_css	= '';

	// For RTL
	if( empty($rtl) && is_rtl() ) {
		$rtl = 1;
	} elseif ( $rtl == 'true' ) {
		$rtl = 1;
	} else {
		$rtl = 0;
	}
	
	// Height
	if( $portfolio_height == 'auto' ) {
		$portfolio_height_css = "height:auto;";
	} elseif ( $portfolio_height > 0 ) {
		$portfolio_height_css = "height:{$portfolio_height}px;";
	}

	// Shortcode file
	$design_file_path 	= WP_PAP_PRO_DIR . '/templates/' . $design . '.php';
	$design_file 		= (file_exists($design_file_path)) ? $design_file_path : '';
	$popup_file_path	= ($popup_style) ? WP_PAP_PRO_DIR . '/templates/popup/' . $popup_style . '-portfolio.php' : '';

	// Required enqueue_script
	if( $popup_style == 'inline' ) {
		wp_enqueue_script('wp-pap-portfolio-js');
	} elseif ( $popup_style == 'popup' ) {
		wp_enqueue_script('wpos-magnific-script');
	}
	wp_enqueue_script('wpos-slick-jquery');
	wp_enqueue_script('wp-pap-public-js');

	// Thumb conf
	$thumb_conf = compact('main_grid');

	// Taking some variables
	$count 			= 1;
	$prefix 		= WP_PAP_PRO_META_PREFIX;
	$unique_main 	= wp_pap_pro_get_unique_main_thumb();
	$old_browser	= wp_pap_pro_old_browser();

	$main_wrp_cls 	= "wppap-thumbs wppap-portfolio-filter wppap-{$design} wppap-clearfix";
	$main_wrp_cls 	.= $popup_style ? " wppap-portfolio-{$popup_style}" : '';
	$main_wrp_cls	.= ($old_browser) 		? ' wp-pap-old-browser' 	: '';
	$main_wrp_cls	.= ($image_fit) 		? ' wp-pap-image-fit' 		: '';

	$wrapper_css 	= ($design_offset > 0) ? "padding:{$design_offset}px;" : '';
	$wrapper_css	.= $portfolio_height_css;

	// Taking some globals
	global $post;

	$wppapterms = get_terms( array(
			'taxonomy' 		=> WP_PAP_PRO_CAT,
			'hide_empty' 	=> true,
			'fields'		=> 'id=>name',
			'number'		=> $cat_limit,
			'order'			=> $cat_order,
			'orderby'		=> $cat_orderby,
			'include'       => $cat,
			'exclude'       => $exclude_cat,
		)
	);

	// If category is there
	if( !is_wp_error($wppapterms) && !empty($wppapterms) ) {
		
		// Getting ids 
		$wppap_cats = array_keys( $wppapterms );

		// Query Parameter
		$args = array ( 
			'post_type'      		=> WP_PAP_PRO_POST_TYPE,
			'post_status' 			=> array( 'publish' ),
			'orderby'        		=> $orderby, 
			'order'          		=> $order,
			'posts_per_page' 		=> -1,
			'ignore_sticky_posts'	=> true,
		);

		// Category Parameter
		if( !empty($wppap_cats) ) {

			$args['tax_query'] = array(
									array(
										'taxonomy' 			=> WP_PAP_PRO_CAT,
										'field' 			=> 'term_id',
										'terms' 			=> $wppap_cats,
										'include_children'	=> $include_cat_child,
									)
								);
		}

		// WP Query
		$query 			= new WP_Query($args);
		$post_count 	= $query->post_count;

		ob_start(); ?>

		<div class="wppap-main-wrapper wppap-clearfix">		
			
			<ul class="wppap-filter wppap-clearfix" id="wppap-filter-<?php echo $unique_main; ?>">
				<li class="wppap-filtr-cat wppap-active-filtr" data-filter=".wppap-portfolio-wrp"><a href="javascript:void(0);"><?php echo $all_filter_text; ?></a></li>
				<?php foreach ($wppapterms as $term_id => $term_name) { ?>
					<li class="wppap-filtr-cat" data-filter=".wppap-cat-<?php echo $term_id; ?>"><a href="javascript:void(0);"><?php echo $term_name; ?></a></li>
				<?php } ?>
			</ul>

			<ul id="wppap-thumbs-<?php echo $unique_main; ?>" class="<?php echo $main_wrp_cls; ?>">

				<?php while ($query->have_posts()) : $query->the_post();

					$unique 				= wp_pap_pro_get_unique();
					$portfolio_img 			= wp_pap_pro_get_image_src( get_post_thumbnail_id($post->ID), $image_size );
					$portfolio_url 			= wp_pap_pro_get_post_link($post->ID);
					$portfolio_link 		= ( $portfolio_url && empty($popup_style) && $link ) ? $portfolio_url : 'javascript:void(0);';
					$portfolio_link_target	= ( $portfolio_url && $link_target == '_blank' && empty($popup_style) && $link ) ? '_blank' : '_self';
					$terms 					= get_the_terms( $post->ID, WP_PAP_PRO_CAT );
					$cat_data 				= array();
					$usedcat				= array();

					if( $terms ) {
						foreach ( $terms as $term ) {
							$usedcat[] 	= 'wppap-cat-'.$term->term_id;
							$cat_data[] = '<span>'.$term->name.'</span>';
						}
					}
					$portfolio_cat 	= join(", ", $cat_data);
					$data_category 	= !empty($usedcat) ? implode(' ',$usedcat) : '1';
					$wrapper_cls 	= "wppap-portfolio-wrp thum-list wppap-portfolio-active wppap-columns wppap-medium-{$grid} {$data_category}";
					$wrapper_cls 	.= (!$portfolio_img) ? ' wppap-no-image' : '';

					if( $count == 1 ) {
						$wrapper_cls .= ' wppap-first';
					} elseif ( $count == $grid ) {
						$count = 0;
						$wrapper_cls .= ' wppap-last';
					}

					// Include design file
					if( $design_file ) {
						include( $design_file );
					}

					$count++;
				endwhile;
				?>
				<div class="wppap-thumb-conf" data-conf="<?php echo htmlspecialchars(json_encode($thumb_conf)); ?>"></div>
			</ul>

			<?php
			// Portfolio popup design file
			if( $popup_file_path && file_exists($popup_file_path) ) {
				include( $popup_file_path );
			} ?>
		</div><?php
		
		wp_reset_query(); // Reset WP Query

		$content .= ob_get_clean();
		return $content;
	}// End of category check
}

// 'pap_portfolio_filter' shortcode
add_shortcode('pap_portfolio_filter', 'wp_pap_pro_portfolio_filter_shortcode');