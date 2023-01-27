<?php
/**
 * Register plugin post type functionality
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_register_post_type() {
	
	$wp_pap_post_lbls = apply_filters( 'wp_pap_pro_post_labels', array(
								'name'                 	=> __('Portfolios & Projects', 'portfolio-and-projects'),
								'singular_name'        	=> __('Portfolio', 'portfolio-and-projects'),
								'add_new'              	=> __('Add Portfolio', 'portfolio-and-projects'),
								'add_new_item'         	=> __('Add New Portfolio', 'portfolio-and-projects'),
								'edit_item'            	=> __('Edit Portfolio', 'portfolio-and-projects'),
								'new_item'             	=> __('New Portfolio', 'portfolio-and-projects'),
								'view_item'            	=> __('View Portfolio', 'portfolio-and-projects'),
								'search_items'         	=> __('Search Portfolio', 'portfolio-and-projects'),
								'not_found'            	=> __('No Portfolio found', 'portfolio-and-projects'),
								'not_found_in_trash'   	=> __('No Portfolio found in Trash', 'portfolio-and-projects'),
								'menu_name'           	=> __('Portfolio Pro', 'portfolio-and-projects'),
                                'featured_image'        => __('Portfolio Cover Image', 'portfolio-and-projects'),
                                'set_featured_image'    => __('Set Portfolio Cover Image', 'portfolio-and-projects'),
                                'remove_featured_image' => __('Remove Portfolio Cover Image', 'portfolio-and-projects'),
                                'use_featured_image'    => __('Use as Portfolio Cover Image', 'portfolio-and-projects'),
							));

	$wp_pap_slider_args = array(
        'labels'            => $wp_pap_post_lbls,
        'public'            => true,
        'show_ui'           => true,
        'query_var'         => true,
        'rewrite'           => array( 
                                        'slug'       => apply_filters('wp_pap_pro_portfolio_post_slug', 'wp-portfolio'),
                                        'with_front' => false
                                    ),
        'capability_type'   => 'post',
        'hierarchical'      => false,
        'menu_icon'			=> 'dashicons-portfolio',
        'supports'          => apply_filters('wp_pap_pro_post_supports', array('title', 'editor', 'thumbnail', 'page-attributes', 'publicize'))
	);

	// Register portfolio post type
	register_post_type( WP_PAP_PRO_POST_TYPE, apply_filters( 'wp_pap_pro_registered_post_type_args', $wp_pap_slider_args ) );
}

// Action to register plugin post type
add_action('init', 'wp_pap_pro_register_post_type');

/**
 * Function to regoster category for portfolio
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_register_taxonomies() {
    
    // Register Portfolio Category
    $cat_labels = apply_filters('wp_pap_pro_cat_labels', array(
                    'name'              => __( 'Portfolio Categories', 'portfolio-and-projects' ),
                    'singular_name'     => __( 'Category', 'portfolio-and-projects' ),
                    'search_items'      => __( 'Search Portfolio Category', 'portfolio-and-projects' ),
                    'all_items'         => __( 'All Category', 'portfolio-and-projects' ),
                    'parent_item'       => __( 'Parent Category', 'portfolio-and-projects' ),
                    'parent_item_colon' => __( 'Parent Category:', 'portfolio-and-projects' ),
                    'edit_item'         => __( 'Edit Portfolio Category', 'portfolio-and-projects' ),
                    'update_item'       => __( 'Update Portfolio Category', 'portfolio-and-projects' ),
                    'add_new_item'      => __( 'Add New Portfolio Category', 'portfolio-and-projects' ),
                    'new_item_name'     => __( 'New Category Name', 'portfolio-and-projects' ),
                    'menu_name'         => __( 'Categories', 'portfolio-and-projects' ),
    ));

    $cat_args = array(
        'labels'            => $cat_labels,
    	'public'			=> true,
        'hierarchical'      => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => apply_filters('wp_pap_pro_portfolio_cat_slug', 'portfolio-category')),
    );

    register_taxonomy( WP_PAP_PRO_CAT, array(WP_PAP_PRO_POST_TYPE), apply_filters('wp_pap_pro_register_portfolio_cat', $cat_args) );


    // Register Portfolio tag (Skill)
    $tag_labels = apply_filters('wp_pap_pro_tag_labels', array(
        'name'                          => __( 'Portfolio Skills', 'portfolio-and-projects' ),
        'singular_name'                 => __( 'Skill', 'portfolio-and-projects' ),
        'search_items'                  =>  __( 'Search Portfolio Skills', 'portfolio-and-projects' ),
        'popular_items'                 => __( 'Popular Skills', 'portfolio-and-projects' ),
        'all_items'                     => __( 'All Skills', 'portfolio-and-projects' ),
        'parent_item'                   => null,
        'parent_item_colon'             => null,
        'edit_item'                     => __( 'Edit Portfolio Skill', 'portfolio-and-projects' ), 
        'update_item'                   => __( 'Update Portfolio Skill', 'portfolio-and-projects' ),
        'add_new_item'                  => __( 'Add New Portfolio Skill', 'portfolio-and-projects' ),
        'new_item_name'                 => __( 'New Skill Name', 'portfolio-and-projects' ),
        'separate_items_with_commas'    => __( 'Separate skills with commas', 'portfolio-and-projects' ),
        'add_or_remove_items'           => __( 'Add or remove portfolios', 'portfolio-and-projects' ),
        'choose_from_most_used'         => __( 'Choose from the most used portfolios', 'portfolio-and-projects' ),
        'menu_name'                     => __( 'Skills', 'portfolio-and-projects' ),
    ));

    $tag_args = array(
        'labels'                => $tag_labels,
        'hierarchical'          => false,
        'show_ui'               => true,
        'query_var'             => true,
        'show_admin_column'     => true,
        'rewrite'               => array('slug' => apply_filters('wp_pap_pro_portfolio_tag_slug', 'portfolio-skill')),
    );

    register_taxonomy( WP_PAP_PRO_TAG, array( WP_PAP_PRO_POST_TYPE ), apply_filters('wp_pap_pro_register_portfolio_tag', $tag_args) );
}

// Action to register plugin taxonomy
add_action( 'init', 'wp_pap_pro_register_taxonomies');

/**
 * Function to update post message for portfolio
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_post_updated_messages( $messages ) {
	
	global $post, $post_ID;
	
	$messages[WP_PAP_PRO_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Portfolio updated.', 'portfolio-and-projects' ) ),
		2 => __( 'Custom field updated.', 'portfolio-and-projects' ),
		3 => __( 'Custom field deleted.', 'portfolio-and-projects' ),
		4 => __( 'Portfolio updated.', 'portfolio-and-projects' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Image Gallery restored to revision from %s', 'portfolio-and-projects' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Portfolio published.', 'portfolio-and-projects' ) ),
		7 => __( 'Portfolio saved.', 'portfolio-and-projects' ),
		8 => sprintf( __( 'Portfolio submitted.', 'portfolio-and-projects' ) ),
		9 => sprintf( __( 'Portfolio scheduled for: <strong>%1$s</strong>.', 'portfolio-and-projects' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Portfolio draft updated.', 'portfolio-and-projects' ) ),
	);
	
	return $messages;
}

// Filter to update post message
add_filter( 'post_updated_messages', 'wp_pap_pro_post_updated_messages' );