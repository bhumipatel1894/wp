<?php
/**
 * Register Post type functionality
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_register_post_type() {
	
	$wp_igsp_post_lbls = apply_filters( 'wp_igsp_post_labels', array(
								'name'                 	=> __('Meta Gallery Pro', 'meta-slider-and-carousel-with-lightbox'),
								'singular_name'        	=> __('Meta Gallery Pro', 'meta-slider-and-carousel-with-lightbox'),
								'add_new'              	=> __('Add Meta Gallery', 'meta-slider-and-carousel-with-lightbox'),
								'add_new_item'         	=> __('Add New Meta Gallery', 'meta-slider-and-carousel-with-lightbox'),
								'edit_item'            	=> __('Edit Meta Gallery', 'meta-slider-and-carousel-with-lightbox'),
								'new_item'             	=> __('New Meta Gallery', 'meta-slider-and-carousel-with-lightbox'),
								'view_item'            	=> __('View Meta Gallery', 'meta-slider-and-carousel-with-lightbox'),
								'search_items'         	=> __('Search Meta Gallery', 'meta-slider-and-carousel-with-lightbox'),
								'not_found'            	=> __('No Meta Gallery found', 'meta-slider-and-carousel-with-lightbox'),
								'not_found_in_trash'   	=> __('No Meta Gallery found in Trash', 'meta-slider-and-carousel-with-lightbox'),
								'parent_item_colon'    	=> '',
								'menu_name'           	=> __('Meta Gallery Pro', 'meta-slider-and-carousel-with-lightbox')
							));

	$wp_igsp_slider_args = array(
		'labels'				=> $wp_igsp_post_lbls,
		'public'              	=> false,
		'show_ui'             	=> true,
		'query_var'           	=> false,
		'rewrite'             	=> false,
		'capability_type'     	=> 'post',
		'hierarchical'        	=> false,
		'menu_icon'				=> 'dashicons-format-gallery',
		'supports'            	=> apply_filters('wp_igsp_post_supports', array('title')),
	);

	// Register slick slider post type
	register_post_type( WP_IGSP_PRO_POST_TYPE, apply_filters( 'wp_igsp_registered_post_type_args', $wp_igsp_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'wp_igsp_pro_register_post_type');

/**
 * Function to update post message for team showcase
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */
function wp_igsp_pro_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WP_IGSP_PRO_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Meta Gallery updated.', 'meta-slider-and-carousel-with-lightbox' ) ),
		2 => __( 'Custom field updated.', 'meta-slider-and-carousel-with-lightbox' ),
		3 => __( 'Custom field deleted.', 'meta-slider-and-carousel-with-lightbox' ),
		4 => __( 'Meta Gallery updated.', 'meta-slider-and-carousel-with-lightbox' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Meta Gallery restored to revision from %s', 'meta-slider-and-carousel-with-lightbox' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Meta Gallery published.', 'meta-slider-and-carousel-with-lightbox' ) ),
		7 => __( 'Meta Gallery saved.', 'meta-slider-and-carousel-with-lightbox' ),
		8 => sprintf( __( 'Meta Gallery submitted.', 'meta-slider-and-carousel-with-lightbox' ) ),
		9 => sprintf( __( 'Meta Gallery scheduled for: <strong>%1$s</strong>.', 'meta-slider-and-carousel-with-lightbox' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Meta Gallery draft updated.', 'meta-slider-and-carousel-with-lightbox' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'wp_igsp_pro_post_updated_messages' );