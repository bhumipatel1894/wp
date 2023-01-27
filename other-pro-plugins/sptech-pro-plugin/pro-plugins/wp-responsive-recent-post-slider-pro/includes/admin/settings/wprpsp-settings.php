<?php
/**
 * Settings Page
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$reg_post_types 	= wprpsp_get_post_types();
$support_post_types = wprpsp_get_option('post_types',array());
?>

<div class="wrap wprpsp-settings">
	
	<h2><?php _e( 'WP Responsive Recent Post Slider Pro Settings', 'wp-responsive-recent-post-slider' ); ?></h2><br/>
	
	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "wp-responsive-recent-post-slider").'</strong></p>
			  </div>';
	}
	?>

	<form action="options.php" method="POST" id="wprpsp-settings-form" class="wprpsp-settings-form">
		
		<?php
		    settings_fields( 'wprpsp_plugin_options' );
		    global $wprpsp_options;
		?>

		<!-- General Settings Starts -->
		<div id="wprpsp-general-sett" class="post-box-container wprpsp-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'General Settings', 'wp-responsive-recent-post-slider' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wprpsp-general-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wprpsp-default-img"><?php _e('Default Featured Image', 'wp-responsive-recent-post-slider'); ?></label>
										</th>
										<td>
											<input type="text" name="wprpsp_options[default_img]" value="<?php echo wprpsp_esc_attr( wprpsp_get_option('default_img') ); ?>" id="wprpsp-default-img" class="regular-text wprpsp-default-img wprpsp-img-upload-input" />
											<input type="button" name="wprpsp_default_img" class="button-secondary wprpsp-image-upload" value="<?php _e( 'Upload Image', 'wp-responsive-recent-post-slider'); ?>" data-uploader-title="<?php _e('Choose Logo', 'wp-responsive-recent-post-slider'); ?>" data-uploader-button-text="<?php _e('Insert Logo', 'wp-responsive-recent-post-slider'); ?>" /> <input type="button" name="wprpsp_default_img_clear" id="wprpsp-default-img-clear" class="button button-secondary wprpsp-image-clear" value="<?php _e( 'Clear', 'wp-responsive-recent-post-slider'); ?>" /> <br />
											<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of blank grey box.', 'wp-responsive-recent-post-slider' ); ?></span>
											<?php
												$default_img = '';
												if( wprpsp_get_option('default_img') ) { 
													$default_img = '<img src="'.wprpsp_get_option('default_img').'" alt="" />';
												}
											?>
											<div class="wprpsp-img-view"><?php echo $default_img; ?></div>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wprpsp-settings-submit" name="wprpsp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-responsive-recent-post-slider'); ?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wprpsp-general-sett -->
		<!-- General Settings Ends -->

		<!-- Post Type Support Starts -->
		<div id="wprpsp-post-type-sett" class="post-box-container wprpsp-post-type-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<h3 class="hndle">
								<span><?php _e( 'Post Type Support', 'wp-responsive-recent-post-slider' ); ?></span>
							</h3>
							
							<div class="inside">
							<table class="form-table wprpsp-post-type-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="select-post-type"><?php _e('Select Post Type', 'wp-responsive-recent-post-slider'); ?></label>
										</th>
										<td>
											<?php if( !empty($reg_post_types) ) {
												foreach ($reg_post_types as $post_key => $post_label) {

													$taxonomy_objects = wprpsp_get_taxonomy_list( $post_key );
											?>
												<div class="wprpsp-post-type-wrap">
													<input type="checkbox" id="wprpsp-post-<?php echo $post_key; ?>" value="<?php echo $post_key; ?>" name="wprpsp_options[post_types][]" <?php checked( in_array($post_key, $support_post_types), true ); ?> <?php disabled($post_key, 'post'); ?> />
													<label for="wprpsp-post-<?php echo $post_key; ?>"><?php echo $post_label; ?></label>
													<label>
														( <?php echo __('Post Type','wp-responsive-recent-post-slider').' : '.$post_key; ?>
														<?php if(!empty($taxonomy_objects)) {
															echo '| '.__('Taxonomy','wp-responsive-recent-post-slider').' : '.$taxonomy_objects;
														} ?>
														)
													</label>
												</div>
											<?php }
											} ?>
											<span class="description"><?php _e('Select post type box to enable. You can enter post type name and category name within shortcode parameter.', 'wp-responsive-recent-post-slider'); ?></span> <br/>
											<span class="description"><?php _e('Note: Default `post` will be remain enabled.', 'wp-responsive-recent-post-slider'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wprpsp-settings-submit" name="wprpsp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-responsive-recent-post-slider'); ?>" />
										</td>
									</tr>
								</tbody>
							 </table>
						</div>
					</div>
				</div>
			</div>
		</div><!-- end .wprpsp-post-type-sett -->
		<!-- Post Type Support Ends -->
		
		<!-- Custom CSS Settings Starts -->
		<div id="wprpsp-custom-css-sett" class="post-box-container wprpsp-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'Custom CSS Settings', 'wp-responsive-recent-post-slider' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wprpsp-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wprpsp-custom-css"><?php _e('Custom CSS', 'wp-responsive-recent-post-slider'); ?></label>
										</th>
										<td>
											<textarea name="wprpsp_options[custom_css]" class="large-text wprpsp-custom-css" id="wprpsp-custom-css" rows="15"><?php echo wprpsp_esc_attr(wprpsp_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'wp-responsive-recent-post-slider'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wprpsp-settings-submit" name="wprpsp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-responsive-recent-post-slider');?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #wprpsp-custom-css -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wprpsp-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
		
	</form><!-- end .wprpsp-settings-form -->
	
</div><!-- end .wprpsp-settings -->