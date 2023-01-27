<?php
/**
 * Register Post type functionality
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_register_post_type() {
	
	$wp_tsasp_labels = apply_filters('wp_tsasp_post_labels', array(
		'name'                 	=> __('Team Showcase', 'wp-team-showcase-and-slider'),
		'singular_name'        	=> __('Team Showcase', 'wp-team-showcase-and-slider'),
		'add_new'              	=> __('Add New Member', 'wp-team-showcase-and-slider'),
		'add_new_item'         	=> __('Add New Member', 'wp-team-showcase-and-slider'),
		'edit_item'            	=> __('Edit Member', 'wp-team-showcase-and-slider'),
		'new_item'             	=> __('New Member', 'wp-team-showcase-and-slider'),
		'view_item'            	=> __('View Member', 'wp-team-showcase-and-slider'),
		'search_items'         	=> __('Search Members','wp-team-showcase-and-slider'),
		'not_found'            	=> __('No Member found', 'wp-team-showcase-and-slider'),
		'not_found_in_trash'   	=> __('No Members found in Trash', 'wp-team-showcase-and-slider'),
		'menu_name' 			=> __('Team Showcase Pro', 'wp-team-showcase-and-slider'),
		'featured_image'		=> __('Team Member Image', 'wp-team-showcase-and-slider'),
		'set_featured_image'	=> __('Set Team Member Image', 'wp-team-showcase-and-slider'),
		'remove_featured_image'	=> __('Remove Team Member Image', 'wp-team-showcase-and-slider'),
		'use_featured_image'	=> __('Use as Team Member Image', 'wp-team-showcase-and-slider'),
	));
	
	$wp_tsasp_args = array(
		'labels'              => $wp_tsasp_labels,
		'public'              => true,
		'publicly_queryable'  => true,
		'exclude_from_search' => false,
		'show_ui'             => true,
		'show_in_menu'        => true, 
		'query_var'           => true,
		'rewrite'             => array( 
										'slug' 			=> apply_filters('wp_tsasp_post_slug', 'team-showcase'),
										'with_front' 	=> false
									),
		'capability_type'     	=> 'post',
		'has_archive'         	=> false,
		'hierarchical'        	=> false,
		'menu_icon'   			=> 'dashicons-groups',
		'supports'            	=> apply_filters('wp_tsasp_post_supports', array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'))
	);

	// Register team showcase post type
	register_post_type( WP_TSASP_POST_TYPE, apply_filters('wp_tsasp_registered_post', $wp_tsasp_args) );
}

// Action to register plugin post type
add_action('init', 'wp_tsasp_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_register_taxonomies() {
	
	$wp_tsasp_cat_lbls = apply_filters('wp_tsasp_cat_labels', array(
								'name'              => __( 'Category', 'wp-team-showcase-and-slider' ),
								'singular_name'     => __( 'Category', 'wp-team-showcase-and-slider' ),
								'search_items'      => __( 'Search Category', 'wp-team-showcase-and-slider' ),
								'all_items'         => __( 'All Categories', 'wp-team-showcase-and-slider' ),
								'parent_item'       => __( 'Parent Category', 'wp-team-showcase-and-slider' ),
								'parent_item_colon' => __( 'Parent Category', 'wp-team-showcase-and-slider' ),
								'edit_item'         => __( 'Edit Category', 'wp-team-showcase-and-slider' ),
								'update_item'       => __( 'Update Category', 'wp-team-showcase-and-slider' ),
								'add_new_item'      => __( 'Add New Category', 'wp-team-showcase-and-slider' ),
								'new_item_name'     => __( 'New Category Name', 'wp-team-showcase-and-slider' ),
								'menu_name'         => __( 'Category', 'wp-team-showcase-and-slider' ),
							));
	
	$wp_tsasp_cat_args = array(
		'hierarchical'      => true,
		'labels'            => $wp_tsasp_cat_lbls,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array(
										'slug' 			=> apply_filters('wp_tsasp_cat_slug', 'tsas-category'),
										'with_front' 	=> false,
										'hierarchical' 	=> true,
									),
	);
	
	// Register team showcase category
	register_taxonomy( WP_TSASP_CAT, array( WP_TSASP_POST_TYPE ), apply_filters('wp_tsasp_registered_cat', $wp_tsasp_cat_args) );
}

// Action to register plugin taxonomies
add_action( 'init', 'wp_tsasp_register_taxonomies');

/**
 * Function to update post message for team showcase
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[WP_TSASP_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Team Member updated. <a href="%s">View Team Member</a>', 'wp-team-showcase-and-slider' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'wp-team-showcase-and-slider' ),
		3 => __( 'Custom field deleted.', 'wp-team-showcase-and-slider' ),
		4 => __( 'Team Member updated.', 'wp-team-showcase-and-slider' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Team Member restored to revision from %s', 'wp-team-showcase-and-slider' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Team Member published. <a href="%s">View Team Member</a>', 'wp-team-showcase-and-slider' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'Team Member saved.', 'wp-team-showcase-and-slider' ),
		8 => sprintf( __( 'Team Member submitted. <a target="_blank" href="%s">Preview Team Member</a>', 'wp-team-showcase-and-slider' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'Team Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Team Member</a>', 'wp-team-showcase-and-slider' ),
		  date_i18n( 'M j, Y @ G:i', strtotime($post->post_date) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Team Member draft updated. <a target="_blank" href="%s">Preview Team Member</a>', 'wp-team-showcase-and-slider' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}

// Filter to update team showcase post message
add_filter( 'post_updated_messages', 'wp_tsasp_post_updated_messages' );