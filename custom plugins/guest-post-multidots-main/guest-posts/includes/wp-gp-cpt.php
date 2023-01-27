<?php
/**
 * Register plugin post type functionality
 *
 * @package Guest Post
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Guest Post
 * @since 1.0
 */
function wp_gp_register_post_type() {
	
	$wp_pap_post_lbls = apply_filters( 'wp_gp_post_labels', array(
								'name'                 	=> __('Guest Post', 'guest-posts'),
								'singular_name'        	=> __('Guest Post', 'guest-posts'),
								'add_new'              	=> __('Add Guest Post', 'guest-posts'),
								'add_new_item'         	=> __('Add New Guest Post', 'guest-posts'),
								'edit_item'            	=> __('Edit Guest Post', 'guest-posts'),
								'new_item'             	=> __('New Guest Post', 'guest-posts'),
								'view_item'            	=> __('View Guest Post', 'guest-posts'),
								'search_items'         	=> __('Search Guest Post', 'guest-posts'),
								'not_found'            	=> __('No Guest Post found', 'guest-posts'),
								'not_found_in_trash'   	=> __('No Guest Post found in Trash', 'guest-posts'),
								'menu_name'           	=> __('Guest Post', 'guest-posts'),
                                'featured_image'        => __('Guest Post Cover Image', 'guest-posts'),
                                'set_featured_image'    => __('Set Guest Post Cover Image', 'guest-posts'),
                                'remove_featured_image' => __('Remove Guest Post Cover Image', 'guest-posts'),
                                'use_featured_image'    => __('Use as Guest Post Cover Image', 'guest-posts'),
							));

	$wp_pap_slider_args = array(
        'labels'            => $wp_pap_post_lbls,
        'public'            => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array( 
                                        'slug'       => apply_filters('wp_gp_post_slug', 'guest-post'),
                                        'with_front' => false
                                    ),
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_icon'			=> 'dashicons-portfolio',
        'supports'          => apply_filters('wp_gp_post_supports', array('title', 'editor', 'thumbnail', 'page-attributes', 'publicize'))
	);

	// Register portfolio post type
	register_post_type( WP_GP_POST_TYPE, apply_filters( 'wp_gp_registered_post_type_args', $wp_pap_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'wp_gp_register_post_type');

/**
 * Function to update post message for portfolio
 * 
 * @package Guest Post
 * @since 1.0
 */
function wp_gp_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WP_GP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Guest Post updated.', 'guest-posts' ) ),
		2 => __( 'Custom field updated.', 'guest-posts' ),
		3 => __( 'Custom field deleted.', 'guest-posts' ),
		4 => __( 'Guest Post updated.', 'guest-posts' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Image Gallery restored to revision from %s', 'guest-posts' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Guest Post published.', 'guest-posts' ) ),
		7 => __( 'Guest Post saved.', 'guest-posts' ),
		8 => sprintf( __( 'Guest Post submitted.', 'guest-posts' ) ),
		9 => sprintf( __( 'Guest Post scheduled for: <strong>%1$s</strong>.', 'guest-posts' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Guest Post draft updated.', 'guest-posts' ) ),
	);
	
	return $messages;
}

// Filter to update post message
add_filter( 'post_updated_messages', 'wp_gp_post_updated_messages' );