<?php
/**
 * Settings Page
 *
 * @package WP Slick Slider and Image Carousel Pro
 * @since 1.2.5
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wpsisac-settings">
	
	<h2><?php _e( 'WP Slick Slider and Image Carousel Pro Settings', 'wp-slick-slider-and-image-carousel' ); ?></h2><br/>
	
	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "wp-slick-slider-and-image-carousel").'</strong></p>
			  </div>';
	}
	?>
	
	<form action="options.php" method="POST" id="wpsisac-settings-form" class="wpsisac-settings-form">
		
		<?php
		    settings_fields( 'wpsisac_pro_plugin_options' );
		    global $wpsisac_pro_options;
		?>
		
		<!-- General Settings Starts -->
		<div id="wpsisac-general-sett" class="post-box-container wpsisac-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'General Settings', 'wp-slick-slider-and-image-carousel' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wpsisac-general-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wpsisac-default-img"><?php _e('Default Featured Image', 'wp-slick-slider-and-image-carousel'); ?>:</label>
										</th>
										<td>
											<input type="text" name="wpsisac_pro_options[default_img]" value="<?php echo wpsisac_pro_esc_attr( wpsisac_pro_get_option('default_img') ); ?>" id="wpsisac-default-img" class="regular-text wpsisac-default-img wpsisac-img-upload-input" />
											<input type="button" name="wpsisac_pro_default_img" class="button-secondary wpsisac-image-upload" value="<?php _e( 'Upload Image', 'wp-slick-slider-and-image-carousel'); ?>" data-uploader-title="<?php _e('Choose Image', 'wp-slick-slider-and-image-carousel'); ?>" data-uploader-button-text="<?php _e('Insert Image', 'wp-slick-slider-and-image-carousel'); ?>" /> <input type="button" name="wpsisac_pro_default_img_clear" id="wpsisac-default-img-clear" class="button button-secondary wpsisac-image-clear" value="<?php _e( 'Clear', 'wp-slick-slider-and-image-carousel'); ?>" /> <br />
											<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of blank grey box.', 'wp-slick-slider-and-image-carousel' ); ?></span>
											<?php
												$default_img = '';
												if( wpsisac_pro_get_option('default_img') ) { 
													$default_img = '<img src="'.wpsisac_pro_get_option('default_img').'" alt="" />';
												}
											?>
											<div class="wpsisac-img-view"><?php echo $default_img; ?></div>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wpsisac-settings-submit" name="wpsisac-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-slick-slider-and-image-carousel'); ?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wpsisac-general-sett -->
		<!-- General Settings Ends -->

		
		<!-- Custom CSS Settings Starts -->
		<div id="wpsisac-custom-css-sett" class="post-box-container wpsisac-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'Custom CSS Settings', 'wp-slick-slider-and-image-carousel' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wpsisac-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wpsisac-custom-css"><?php _e('Custom CSS', 'wp-slick-slider-and-image-carousel'); ?>:</label>
										</th>
										<td>
											<textarea name="wpsisac_pro_options[custom_css]" class="large-text wpsisac-custom-css" id="wpsisac-custom-css" rows="15"><?php echo wpsisac_pro_esc_attr(wpsisac_pro_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'wp-slick-slider-and-image-carousel'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wpsisac-settings-submit" name="wpsisac-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-slick-slider-and-image-carousel');?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #wpsisac-custom-css -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wpsisac-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
		
	</form><!-- end .wpsisac-settings-form -->
	
</div><!-- end .wpsisac-settings -->