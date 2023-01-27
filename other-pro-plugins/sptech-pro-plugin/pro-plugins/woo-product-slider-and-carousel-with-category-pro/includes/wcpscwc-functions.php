<?php
/**
 * Plugin generic functions file
 *
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to add array after specific key
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_pro_add_array(&$array, $value, $index, $from_last = false) {
    
    if( is_array($array) && is_array($value) ) {

        if( $from_last ) {
            $total_count    = count($array);
            $index          = (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
        }
        
        $split_arr  = array_splice($array, max(0, $index));
        $array      = array_merge( $array, $value, $split_arr);
    }
    
    return $array;
}

/**
 * Function to unique number value
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.2.5
 */
function wcpscwc_pro_get_unique() {
    static $unique = 0;
    $unique++;

    return $unique;
}

/**
 * Function to get featured content column
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_pro_column( $row = '' ) {
	if($row == 2) {
		$per_row = 6;
	} else if($row == 3) {
		$per_row = 4;	
	} else if($row == 4) {
		$per_row = 3;
	} else if($row == 1) {
		$per_row = 12;
	} else{
        $per_row = 12;
    }

    return $per_row;
}

/**
 * Function to get post featured image
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_pro_get_post_image( $post_id = '', $size = 'full', $default_img = false ) {
    $size   = !empty($size) ? $size : 'full';
    $image  = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), $size );

    if( !empty($image) ) {
        $image = isset($image[0]) ? $image[0] : '';
    }

    // Getting default image
    if( $default_img && empty($image) ) {
		$image = wc_placeholder_img_src();
    }

    return $image;
}

/**
 * Function to get post excerpt
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {
    
    $has_excerpt    = false;
    $word_length    = !empty($word_length) ? $word_length : '55';
    
    // If post id is passed
    if( !empty($post_id) ) {
        if (has_excerpt($post_id)) {

            $has_excerpt    = true;
            $content        = get_the_excerpt();

        } else {
            $content = !empty($content) ? $content : get_the_content();
        }
    }

    if( !empty($content) && (!$has_excerpt) ) {
        $content = strip_shortcodes( $content ); // Strip shortcodes
        $content = wp_trim_words( $content, $word_length, $more );
    }

    return $content;
}

/**
 * Function to get shortcode designs
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.0.0
 */
function wcpscwc_products_designs() {
	$design_arr = array(
                        'default'   => __('Default Design 1', 'woo-product-slider-and-carousel-with-category'),
						'design-1'	=> __('Design 1', 'woo-product-slider-and-carousel-with-category'),
						'design-2'	=> __('Design 2', 'woo-product-slider-and-carousel-with-category'),
						'design-3'	=> __('Design 3', 'woo-product-slider-and-carousel-with-category'),
						'design-4'	=> __('Design 4', 'woo-product-slider-and-carousel-with-category'),
						'design-5'	=> __('Design 5', 'woo-product-slider-and-carousel-with-category'),
						'design-6'	=> __('Design 6', 'woo-product-slider-and-carousel-with-category'),
						'design-7'	=> __('Design 7', 'woo-product-slider-and-carousel-with-category'),
						'design-8'	=> __('Design 8', 'woo-product-slider-and-carousel-with-category'),
						'design-9'	=> __('Design 9', 'woo-product-slider-and-carousel-with-category'),
						'design-10'	=> __('Design 10', 'woo-product-slider-and-carousel-with-category'),
						'design-11'	=> __('Design 11', 'woo-product-slider-and-carousel-with-category'),
						'design-12'	=> __('Design 12', 'woo-product-slider-and-carousel-with-category'),
						'design-13'	=> __('Design 13', 'woo-product-slider-and-carousel-with-category'),
						'design-14'	=> __('Design 14', 'woo-product-slider-and-carousel-with-category'),
						'design-15'	=> __('Design 15', 'woo-product-slider-and-carousel-with-category'),
					);
	return apply_filters('wcpscwc_products_designs', $design_arr );
}

/**
 * Function to check woocommerce version
 * 
 * @package Woo Product Slider and Carousel with category
 * @since 1.2.2
 */
function wcpscwc_wc_version( $version = '3.0', $operator = '>=' ) {
    global $woocommerce;

    $operator = !empty($operator) ? $operator : '=';

    if( version_compare( $woocommerce->version, $version, $operator ) ) {
      return true;
    }
    return false;
}