<?php
/**
 * 'pap_portfolio' Shortcode
 * 
 * @package  Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wp_pap_pro_portfolio_shortcode( $atts, $content = '') {

	// Shortcode Parameter
	extract(shortcode_atts(array(
		'design' 				=> 'design-1',
		'grid' 					=> 3,
		'limit' 				=> '20',
		'category' 				=> '',
		'order'					=> 'DESC',
		'orderby'				=> 'date',
		'popup_style' 			=> 'inline',
		'include_cat_child'		=> 'true',
		'pagination' 			=> 'true',
		'pagination_type'		=> 'numeric',
		'posts'					=> array(),
		'exclude_cat'			=> array(),
		'exclude_post'			=> array(),
		'link'					=> 'true',
		'link_target'			=> 'self',
		'image_size'			=> 'full',
		'design_offset' 		=> '',
		'portfolio_height'		=> '',
		'image_fit'				=> 'true',
		'rtl'					=> '',
	), $atts, 'pap_portfolio'));

	$shortcode_designs 		= wp_pap_pro_slider_designs();
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$posts_per_page 		= !empty($limit) 						? $limit 						: '20';
	$main_grid 				= (!empty($grid) && $grid <= 4) 		? $grid 						: 3;
	$cat 					= (!empty($category))					? explode(',',$category) 		: '';
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= !empty($orderby) 						? $orderby 						: 'date';	
	$include_cat_child		= ($include_cat_child == 'false' ) 		? false 						: true;
	$pagination 			= ($pagination == 'false')				? 0								: 1;
	$pagination_type 		= ($pagination_type == 'prev-next')		? 'prev-next' 					: 'numeric';
	$exclude_cat 			= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$exclude_post 			= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$posts 					= !empty($posts)						? explode(',', $posts) 			: array();
	$link 					= ($link == 'true')						? 1								: 0;
	$link_target 			= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$image_size				= (!empty($image_size)) 				? $image_size 					: 'full';
	$popup_style_design		= wp_pap_pro_popup_style();
	$popup_style 			= ($popup_style && (array_key_exists(trim($popup_style), $popup_style_design))) ? trim($popup_style) : '';
	$grid 					= wp_pap_grid_column($grid);
	$portfolio_height_css	= '';
	$image_fit				= ($image_fit == 'false') ? 0 : 1;

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
	$main_wrp_cls 	= "wppap-thumbs wppap-{$design}";
	$main_wrp_cls 	.= $popup_style ? " wppap-portfolio-{$popup_style}" : '';
	$main_wrp_cls	.= ($old_browser) 		? ' wp-pap-old-browser' 	: '';
	$main_wrp_cls	.= ($image_fit) 		? ' wp-pap-image-fit' 		: '';

	$wrapper_css 	= ($design_offset > 0) ? "padding:{$design_offset}px;" : '';
	$wrapper_css	.= $portfolio_height_css;

	// Pagination parameter
	if(is_home() || is_front_page()) {
		$paged = get_query_var('page');
	} else {
		$paged = get_query_var('paged');
	}

	// Taking some globals
	global $post;

	// Query Parameter
	$args = array ( 
				'post_type'      		=> WP_PAP_PRO_POST_TYPE,
				'post_status' 			=> array( 'publish' ),
				'orderby'        		=> $orderby, 
				'order'          		=> $order,
				'posts_per_page' 		=> $posts_per_page,
				'paged'          		=> ($pagination) ? $paged : 1,
				'post__in'				=> $posts,
				'post__not_in'			=> $exclude_post,
				'ignore_sticky_posts'	=> true,
			);

	// Category Parameter
	if( !empty($cat) ) {

		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WP_PAP_PRO_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $cat,
									'include_children'	=> $include_cat_child,
								));

	} else if( !empty($exclude_cat) ) {
		
		$args['tax_query'] = array(
								array(
									'taxonomy' 			=> WP_PAP_PRO_CAT,
									'field' 			=> 'term_id',
									'terms' 			=> $exclude_cat,
									'operator'			=> 'NOT IN',
									'include_children'	=> $include_cat_child,
								));
	}

	// WP Query
	$query 			= new WP_Query($args);
	$post_count 	= $query->post_count;

	ob_start();
?>

	<div class="wppap-main-wrapper wppap-clearfix">		
		<ul id="wppap-thumbs-<?php echo $unique_main; ?>" class="<?php echo $main_wrp_cls; ?> wppap-clearfix">

			<?php while ($query->have_posts()) : $query->the_post();

				$unique 				= wp_pap_pro_get_unique();
				$portfolio_img 			= wp_pap_pro_get_image_src( get_post_thumbnail_id($post->ID), $image_size );
				$portfolio_url 			= wp_pap_pro_get_post_link($post->ID);
				$portfolio_link 		= ( $portfolio_url && empty($popup_style) && $link ) ? $portfolio_url : 'javascript:void(0);';
				$portfolio_link_target	= ( $portfolio_url && $link_target == '_blank' && empty($popup_style) && $link ) ? '_blank' : '_self';
				$terms 					= get_the_terms( $post->ID, WP_PAP_PRO_CAT );
				$wrapper_cls 			= "wppap-portfolio-wrp thum-list wppap-columns wppap-medium-{$grid}";
				$wrapper_cls 			.= (!$portfolio_img) ? ' wppap-no-image' : '';
				$cat_data 				= array();

				if( $count == 1 ) {
					$wrapper_cls .= ' wppap-first';
				} elseif ( $count == $main_grid ) {
					$count = 0;
					$wrapper_cls .= ' wppap-last';
				}

				if( $terms ) {
					foreach ( $terms as $term ) {
						$cat_data[] = '<span>'.$term->name.'</span>';
					}
				}
				$portfolio_cat = join(", ", $cat_data);

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
		}

		// Pagination
		if( $pagination && ($query->max_num_pages > 1) ) { ?>
		<div class="wppap-paging wppap-clearfix">
			<?php if($pagination_type == 'numeric') {

				echo wp_pap_pro_pagination( array( 'paged' => $paged , 'total' => $query->max_num_pages ) );

			} else { ?>
				<div class="wppap-pagi-btn wppap-next-btn"><?php next_posts_link( __('Next', 'portfolio-and-projects').' &raquo;', $query->max_num_pages ); ?></div>
				<div class="wppap-pagi-btn wppap-prev-btn"><?php previous_posts_link( '&laquo; '.__('Previous', 'portfolio-and-projects') ); ?></div>
		<?php } ?>
		</div>
		<?php } ?>
	</div>

<?php
	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'pap_portfolio' shortcode
add_shortcode('pap_portfolio', 'wp_pap_pro_portfolio_shortcode');