<?php
/**
 * 'featured_products_slider' Shortcode
 * 
 * @package Woo Product Slider and Carousel with category Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wcpscwc_pro_featured_products_slider($atts, $content) {
 	
	global $woocommerce_loop;
 	
 	// Shortcode Parameter
	extract(shortcode_atts(array(
		'design' 			=> 'design-1',
		'default_slider_cls'=> 'products',
		'cats' 				=> '',
		'exclude_cat'		=> array(),
		'include_cat_child'	=> true,
		'tax' 				=> WCPSCWC_PRODUCT_CAT,
		'limit'			 	=> '-1',
		'order'				=> 'DESC',
		'orderby'			=> 'date',
		'posts'				=> array(),
		'exclude_post'		=> array(),
		'slide_to_show' 	=> '3',
		'slide_to_scroll'	=> '1',
		'autoplay' 			=> 'false',
		'autoplay_speed'	=> '3000',
		'speed' 			=> '300',
		'arrows' 			=> 'true',
		'dots' 				=> 'true',
		'show_category'		=> 'true',
		'show_rating'		=> 'true',
		'show_sale'			=> 'true',
		'link_target'		=> 'self',
		'show_desc'			=> 'false',
		'type'				=> 'slider',
		'grid'              => 2,
		'loop'				=> 'true',
		'centermode'		=> 'false',
		'adaptiveheight'	=> 'false',
	), $atts));
 	
	$shortcode_designs 		= wcpscwc_products_designs();
	$limit 					= !empty($limit) 						? $limit 						: '-1';
	$cat 					= (!empty($cats))						? explode(',',$cats)			: '';
	$grid 					= !empty($grid) 						? $grid 						: '2';
	$exclude_cat			= !empty($exclude_cat)					? explode(',', $exclude_cat) 	: array();
	$post_ids				= !empty($posts)						? explode(',', $posts) 			: array();
	$exclude_post 			= !empty($exclude_post)					? explode(',', $exclude_post) 	: array();
	$order 					= ( strtolower($order) == 'asc' ) 		? 'ASC' 						: 'DESC';
	$orderby 				= (!empty($orderby))					? $orderby						: 'date';
	$slide_to_show 			= !empty($slide_to_show) 				? $slide_to_show 				: '3';
	$slide_to_scroll 		= !empty($slide_to_scroll) 				? $slide_to_scroll 				: '1';
	$autoplay 				= ( $autoplay == 'false' )				? 'false' 						: 'true';
	$centermode 			= ( $centermode == 'true' )				? 'true' 						: 'false';
	$adaptiveheight 		= ( $adaptiveheight == 'true' ) 		? 'true' 						: 'false';
	$autoplay_speed			= !empty( $autoplay_speed ) 			? $autoplay_speed 				: '3000';
	$speed 					= !empty( $speed ) 						? $speed 						: '300';
	$dots 					= ( $dots == 'false' )					? 'false' 						: 'true';
	$loop 					= ( $loop == 'false' )					? 'false' 						: 'true';
	$arrows 				= ( $arrows == 'false' )				? 'false' 						: 'true';
 	$show_category			= ($show_category == 'false')			? 0 							: 1;
	$show_rating			= ($show_rating == 'false')				? 0 							: 1;
	$show_sale				= ($show_sale == 'false')				? 0 							: 1;
	$show_desc				= ($show_desc == 'false')				? 0 							: 1;
	$link_target 			= ($link_target == 'blank') 			? '_blank' 						: '_self';
	$active_slider   		= ( $type == 'grid' ) 					? 0 							: 1;
	$slider_cls     		= ($active_slider) 						? 'wcpscwc-product-slider' 		: 'wcpscwc-product-grid';
	$grid_clmn      		= wcpscwc_pro_column($grid);
	$design 				= ($design && (array_key_exists(trim($design), $shortcode_designs))) ? trim($design) : 'design-1';
	$default_slider_cls 	= !empty($default_slider_cls) ? $default_slider_cls : 'products';

	if($design == 'default') {
		$slider_cls = ($active_slider) ? 'wcpscwc-product-slider-default' : 'wcpscwc-product-default-grid';
	}

 	// Enqueue required script
 	if($active_slider) {
		wp_enqueue_script( 'wpos-slick-jquery' );
	    wp_enqueue_script( 'wcpscwc-public-jquery' );
	}

	// Shortcode file
	$product_design_file_path 	= WCPSCWC_DIR . '/templates/' . $design . '.php';
	$design_file 				= (file_exists($product_design_file_path)) ? $product_design_file_path : '';

	// Slider configuration
	$slider_conf = compact('slide_to_show', 'slide_to_scroll', 'autoplay', 'autoplay_speed', 'speed', 'arrows', 'dots', 'loop', 'centermode', 'adaptiveheight', 'default_slider_cls');

	// Taking some variables
	$grid_count  		= 1;
    $css_class   		= '';
    $grid_cls       	= 'wcpscwc-medium-'.$grid_clmn.' wcpscwc-column';
    $centermode_cls 	= ( $centermode == 'true' && $active_slider )	? 'wcpscwc-center-mode' : '';
	$slide_to_show_cls 	= ( $active_slider ) ? 'wcpscwc-slide-show-'.$slide_to_show : '';
	$unique 	 		= wcpscwc_pro_get_unique();
 	
	// WP Query Parameters
	$args = array(
		'post_type'				=> WCPSCWC_PRODUCT_POST_TYPE,
		'post_status' 			=> array( 'publish' ),
		'posts_per_page' 		=> $limit,
		'order'					=> $order,
		'orderby'				=> $orderby,
		'ignore_sticky_posts'	=> true,
		'post__in'		 		=> $post_ids,
		'post__not_in'			=> $exclude_post,
		'tax_query'				=> array(),
	);

	// Backward compatibility
	if( wcpscwc_wc_version('3.0', '<') ) {
		$args['meta_query'] = array(
									// get only products marked as featured
									array(
										'key' 		=> '_featured',
										'value' 	=> 'yes',
										'compare' 	=> '=',
									));
	} else {
		$args['tax_query'][] =
								array(
									'taxonomy' => 'product_visibility',
									'field'    => 'name',
									'terms'    => 'featured',
									'operator' => 'IN',
								);
	}

	// Category Parameter
	if($cat != "") {

		$args['tax_query'][] = array(
								'taxonomy' 			=> $tax,
								'field' 			=> 'term_id',
								'terms' 			=> $cat,
								'include_children'	=> $include_cat_child,
							);

	} else if( !empty($exclude_cat) ) {

		$args['tax_query'][] = array(
								'taxonomy' 			=> $tax,
								'field' 			=> 'term_id',
								'terms' 			=> $exclude_cat,
								'operator'			=> 'NOT IN',
								'include_children'	=> $include_cat_child,
							);
	}

	// query database
	$products = new WP_Query( $args );

	ob_start();

	// If product is there
	if ( $products->have_posts() ) : 

		if($design == 'default') { ?>
			<div class="wcpscwc-product-slider-default-wrap wcps-<?php echo $design; ?> ">
				<div class="woocommerce <?php echo $slider_cls;?>" id="wcpscwc-product-slider-<?php echo $unique; ?>">
				<?php
 					woocommerce_product_loop_start();
	 
					while ( $products->have_posts() ) : $products->the_post(); 
						if( wcpscwc_wc_version('3.0') ) {
							wc_get_template_part( 'content', 'product' );
						} else {
							woocommerce_get_template_part( 'content', 'product' );
						}
					endwhile; // end of the loop.
	 
				 	woocommerce_product_loop_end(); 
				?>
			<?php 
			if( $active_slider ) { ?>
				<div class="wcpscwc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
			<?php }?>
				</div>
			</div>
			<?php
 		} else { ?>
	 		<div class="wcpscwc-product-slider-wrap wcpscwc-<?php echo $design.' '.$centermode_cls.' '.$slide_to_show_cls; ?> wcpscwc-clearfix">
				<div class="woocommerce <?php echo $slider_cls; ?>" id="wcpscwc-product-slider-<?php echo $unique; ?>">
	 
	                <?php while ( $products->have_posts() ) : $products->the_post();
	                	
	                    global $post, $product;

	                    // Check older version compatibility
	 					if( wcpscwc_wc_version('3.0') ) {
	 						$product_id 	= $product->get_id();
	 						$average_rating = $product->get_average_rating();
	 						$product_rating = wc_get_rating_html( $average_rating);
	 						$product_type 	= $product->get_type();
	 					} else {
	 						$product_id 	= $product->id;
	 						$product_rating	= $product->get_rating_html();
	 						$product_type 	= $product->product_type;
	 					}

	                    if( !$active_slider ) {
	                       $css_class = ($grid_count == 1) ? 'wcpscwc-first' : '';
	                    }

	                    // Taking some variables
	                    $post_image = wcpscwc_pro_get_post_image( $product_id, 'full', true );

	                    // Getting product category list
	                    $product_cats = get_the_term_list( $product_id, 'product_cat', '<span>', ', ', '</span>' );
	                    
	                    // Woo Commerce button class
	                    $class = implode( ' ', 
	                        array_filter( 
	                            array(
	                                'button',
	                                'product_type_' .$product_type,
	                                $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
	                                $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : ''
	                            )) 
	                    );

	                    if($design_file) {
	                		include($product_design_file_path);
	            		}

	            		// Resetting grid count
	                    if( $grid_count == $grid ) {
	                        $grid_count = 0;
	                    }

	                    $grid_count++;

	                endwhile; // end of the loop. ?>
				</div>
				
				<?php if( $active_slider ) { ?>	
				<div class="wcpscwc-slider-conf" data-conf="<?php echo htmlspecialchars(json_encode($slider_conf)); ?>"></div>
				<?php } ?>
			</div>
		<?php } ?>
	<?php endif;

	wp_reset_query(); // Reset WP Query
	
	$content .= ob_get_clean();
	
	return $content;
}

// 'featured_products_slider' shortcode
add_shortcode( 'featured_products_slider', 'wcpscwc_pro_featured_products_slider' );
add_shortcode( 'wcpscwc_feat_pdt_slider', 'wcpscwc_pro_featured_products_slider' );