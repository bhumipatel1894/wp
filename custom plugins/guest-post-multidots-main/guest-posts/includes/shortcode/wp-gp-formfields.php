<?php
/**
 * 'gp_insert_form' Shortcode
 * 
 * @package  Guest Posts
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wp_gp_if_shortcode( $atts, $content = '') {

	// Taking some globals
	global $post;

	$user = wp_get_current_user();
	
	/* check if current user is Author*/
	if ( in_array( 'author', (array) $user->roles ) || $user->user_login == 'admin' ) {
	    
	    ob_start(); ?>

	<form id="gp_insert" class="gp_insert" method="post" enctype="multipart/form-data" autocomplete="off">

		<h4 class="gp-form-title">Create Guest Post By Author only...</h4>
		<!-- Post title field -->

		<div class="gp-form-container">
			<div class="gp-field">
			<label for="wp-gp-posttitle"><?php _e('Post Title', 'guest-posts'); ?></label>
			<input type="text" required name="gp_post_title" id="gp_post_title" class="gp_post_title"  placeholder="<?php _e('Post Title', 'guest-posts'); ?>">
			</div>
			<!-- CPT field -->
			<div class="gp-field">

				<label for="wp-gp-posttype"><?php _e('Select Custom POst type', 'guest-posts'); ?></label>
				<select name="gp_post_type" id="gp_post_type" class="gp_post_type" >

					<option data-name="Post" value="post">Post</option>
					<option data-name="Page" value="page">Page</option>
					<?php 
					$args = array(
					   'public'   => true,
					   '_builtin' => false
					);
					$ptypes = get_post_types($args, 'objects');
					    foreach ( $ptypes as $type ) {
					        $name = $type->name;
					        $title = $type->labels->singular_name;

					        echo '<option data-name="'.$name.'" value="'.$name.'">'.$title.'</option>';
					    }
					?>
				</select>
			</div>

			<div class="gp-field">
				<label for="wp-gp-postdescri"><?php _e('Post Description', 'guest-posts'); ?></label>
				<textarea name="gp_post_descri" required id="gp_post_descri" class="gp_post_descri"  placeholder="Enter Post Description here.."></textarea>
			</div>

			<div class="gp-field">
				<label for="wp-gp-excerpt"><?php _e('Post excerpt', 'guest-posts'); ?></label>
				<textarea name="gp_post_excerpt" required id="gp_post_excerpt" class="gp_post_excerpt"  placeholder="Enter Post Excerpt here.."></textarea>
			</div>

			<div class="gp-field">
				<label for="wp-gp-fi"><?php _e('Featured image', 'guest-posts'); ?></label>
				<input type="file" name="fi_file" id="fi_file" class="fi_file" />
				<input name="security" id="security" value="<?php echo wp_create_nonce("uploadingFile"); ?>" type="hidden">
				
			</div>

			<div class="gp-field">
				<input name="submit" value="upload" type="submit"/>
			</div>
		</div>		
		<div id="success_message"></div>
	</form>
	
	<?php
	} else{
		echo '<div class="no-permission">Sorry! You have not permission to access this content...</div>';
	}
	
	wp_reset_query(); // Reset WP Query

	$content .= ob_get_clean();
	return $content;
}

// 'gp_insert_form' shortcode
add_shortcode('gp_insert_form', 'wp_gp_if_shortcode');