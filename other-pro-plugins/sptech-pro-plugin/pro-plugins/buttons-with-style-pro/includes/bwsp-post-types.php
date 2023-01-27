<?php
/**
 * Register Post type functionality
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to register post type
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_register_post_type() {

	$bwsp_post_lbls = apply_filters( 'bwsp_post_labels', array(
		'name'                 	=> __('Button Style', 'buttons-with-style'),
		'singular_name'        	=> __('Button Style 55', 'buttons-with-style'),
		'add_new'              	=> __('Add Button 55', 'buttons-with-style'),
		'add_new_item'         	=> __('Add New Button', 'buttons-with-style'),
		'edit_item'            	=> __('Edit Button', 'buttons-with-style'),
		'new_item'             	=> __('New Button', 'buttons-with-style'),
		'view_item'            	=> __('View Button', 'buttons-with-style'),
		'search_items'         	=> __('Search Button', 'buttons-with-style'),
		'not_found'            	=> __('No Button found', 'buttons-with-style'),
		'not_found_in_trash'   	=> __('No Button found in trash', 'buttons-with-style'),
		'parent_item_colon'    	=> '',
		'menu_name'            	=> __('Button Style Pro', 'buttons-with-style')
							));

	$bwsp_pro_args = array(
		'labels'				=> $bwsp_post_lbls,
		'public'              	=> false,
		'show_ui'             	=> true,
		'query_var'           	=> false,
		'rewrite'             	=> false,
		'capability_type'     	=> 'post',
		'hierarchical'        	=> false,
		'menu_icon'				=> 'dashicons-editor-bold',
		'supports'            	=> apply_filters('bwsp_post_supports', array('title','excerpt','custom-fields','thumbnail','comments')),
	);

	// Register slick slider post type
	register_post_type( BWSPOS_PRO_POST_TYPE, apply_filters( 'bwsp_registered_post_type_args', $bwsp_pro_args ) );
}

// Action to register plugin post type
add_action('init', 'bwsp_register_post_type');

/**
 * Function to update post message for button
 * 
 * @package Buttons With Style Pro
 * @since 1.0.0
 */
function bwsp_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[BWSPOS_PRO_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Button updated.', 'buttons-with-style' ) ),
		2 => __( 'Custom field updated.', 'buttons-with-style' ),
		3 => __( 'Custom field deleted.', 'buttons-with-style' ),
		4 => __( 'Button updated.', 'buttons-with-style' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Button restored to revision from %s', 'buttons-with-style' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Button published.', 'buttons-with-style' ) ),
		7 => __( 'Button saved.', 'buttons-with-style' ),
		8 => sprintf( __( 'Button submitted.', 'buttons-with-style' ) ),
		9 => sprintf( __( 'Button scheduled for: <strong>%1$s</strong>.', 'buttons-with-style' ),
		  date_i18n( 'M j, Y @ G:i', strtotime( $post->post_date ) ) ),
		10 => sprintf( __( 'Button draft updated.', 'buttons-with-style' ) ),
	);
	
	return $messages;
}

// Filter to update slider post message
add_filter( 'post_updated_messages', 'bwsp_post_updated_messages' );