<?php
/**
 * Settings Page
 *
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wp-fcasp-settings">

<h2><?php _e( 'WP Featured Content and Slider Pro Settings', 'wp-featured-content-and-slider' ); ?></h2><br />

<?php

// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "wp-featured-content-and-slider").'</strong></p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="wp-fcasp-settings-form" class="wp-fcasp-settings-form">
	
	<?php
	    settings_fields( 'wp_fcasp_plugin_options' );
	    global $wp_fcasp_options;
	?>

	<!-- General Settings Starts -->
	<div id="wp-fcasp-general-sett" class="post-box-container wp-fcasp-general-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'General Settings', 'wp-featured-content-and-slider' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wp-fcasp-general-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wp-fcasp-default-img"><?php _e('Default Featured Image', 'wp-featured-content-and-slider'); ?>:</label>
									</th>
									<td>
										<input type="text" name="wp_fcasp_options[default_img]" value="<?php echo wp_fcasp_esc_attr( wp_fcasp_get_option('default_img') ); ?>" id="wp-fcasp-default-img" class="regular-text wp-fcasp-default-img wp-fcasp-img-upload-input" />
										<input type="button" name="wp_fcasp_default_img" class="button-secondary wp-fcasp-image-upload" value="<?php _e( 'Upload Image', 'wp-featured-content-and-slider'); ?>" data-uploader-title="<?php _e('Choose Logo', 'wp-featured-content-and-slider'); ?>" data-uploader-button-text="<?php _e('Insert Logo', 'wp-featured-content-and-slider'); ?>" /> <input type="button" name="wp_fcasp_default_img_clear" id="wp-fcasp-default-img-clear" class="button button-secondary wp-fcasp-image-clear" value="<?php _e( 'Clear', 'wp-featured-content-and-slider'); ?>" /> <br />
										<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of grey blank box.', 'wp-featured-content-and-slider' ); ?></span>
										<?php
											$default_img = '';
											if( wp_fcasp_get_option('default_img') ) { 
												$default_img = '<img src="'.wp_fcasp_get_option('default_img').'" alt="" />';
											}
										?>
										<div class="wp-fcasp-img-view"><?php echo $default_img; ?></div>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wp-fcasp-settings-submit" name="wp-fcasp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-featured-content-and-slider'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wp-fcasp-general-sett -->
	<!-- General Settings Ends -->

	<!-- Custom CSS Settings Starts -->
	<div id="wp-fcasp-custom-css-sett" class="post-box-container wp-fcasp-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'wp-featured-content-and-slider' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wp-fcasp-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wp-fcasp-custom-css"><?php _e('Custom CSS', 'wp-featured-content-and-slider'); ?>:</label>
									</th>
									<td>
										<textarea name="wp_fcasp_options[custom_css]" class="large-text wp-fcasp-custom-css" id="wp-fcasp-custom-css" rows="15"><?php echo wp_fcasp_esc_attr(wp_fcasp_get_option('custom_css')); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'wp-featured-content-and-slider'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wp-fcasp-settings-submit" name="wp-fcasp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-featured-content-and-slider'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wp-fcasp-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .wp-fcasp-settings-form -->

</div><!-- end .wp-fcasp-settings -->