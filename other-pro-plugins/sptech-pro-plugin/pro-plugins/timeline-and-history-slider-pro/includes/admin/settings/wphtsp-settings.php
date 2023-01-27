<?php
/**
 * Settings Page
 *
 * @package WP Stylish Post And Widgets
 * @since 1.0.4
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wphtsp-settings">

	<h2><?php _e( 'WP History and Timeline Slider Pro Settings', 'timeline-and-history-slider' ); ?></h2><br />

	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
		<p>'.__("Your changes saved successfully.", "timeline-and-history-slider").'</p>
			  </div>';
	}
	?>

	<form action="options.php" method="POST" id="wphtsp-settings-form" class="wphtsp-settings-form">
		
		<?php
		    settings_fields( 'wphtsp_pro_plugin_options' );
		    global $wphts_pro_options;
		?>

		<!-- General Settings Starts -->
		<div id="wphtsp-general-sett" class="post-box-container wphtsp-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'General Settings', 'timeline-and-history-slider' ); ?></span>
						</h3>
						
						<div class="inside">
						
							<table class="form-table wphtsp-general-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wphtsp-pro-default-img"><?php _e('Default Featured Image', 'timeline-and-history-slider'); ?>:</label>
										</th>
										<td>
											<input type="text" name="wphts_pro_options[default_img]" value="<?php echo wphtsp_esc_attr( wphts_pro_get_option('default_img') ); ?>" id="wphtsp-pro-default-img" class="regular-text wphtsp-pro-default-img wphtsp-pro-img-upload-input" />
											<input type="button" name="wphtsp_pro_default_img" class="button-secondary wphtsp-pro-image-upload" value="<?php _e( 'Upload Image', 'timeline-and-history-slider'); ?>" data-uploader-title="<?php _e('Choose Logo', 'timeline-and-history-slider'); ?>" data-uploader-button-text="<?php _e('Insert Logo', 'timeline-and-history-slider'); ?>" /> <input type="button" name="wphtsp_pro_default_img_clear" id="wphtsp-pro-default-img-clear" class="button button-secondary wphtsp-pro-image-clear" value="<?php _e( 'Clear', 'timeline-and-history-slider'); ?>" /> <br />
											<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of grey blank box.', 'timeline-and-history-slider' ); ?></span>
											<?php
												$default_img = '';
												if( wphts_pro_get_option('default_img') ) { 
													$default_img = '<img src="'.wphts_pro_get_option('default_img').'" alt="" />';
												}
											?>
											<div class="wphtsp-pro-img-view"><?php echo $default_img; ?></div>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wphtsp-settings-submit" name="wphtsp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','timeline-and-history-slider'); ?>" />
										</td>
									</tr>
								</tbody>
						 	</table>
						</div><!-- .inside -->
					</div><!-- #general -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wphtsp-general-sett -->
		<!-- General Settings Ends -->

		<!-- Date Format Settings Starts -->
		<div id="wphtsp-date-format-sett" class="post-box-container wphtsp-date-format-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="date-format" class="postbox">
						
						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Date Format Settings', 'timeline-and-history-slider' ); ?></span>
						</h3>

						<div class="inside">
						
							<table class="form-table wphtsp-date-format-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wphtsp-date-format"><?php _e('Date Format Settings', 'timeline-and-history-slider'); ?>:</label>
										</th>
										<td>
											<label class="date-format"><input type="radio" name="wphts_pro_options[date_format]" value="m/d/Y" <?php checked( $wphts_pro_options['date_format'], 'm/d/Y' ); ?>><span class="date-time-text format-i18n"><?php echo date("m/d/Y"); ?></span><code>m/d/Y</code></label><br>
											<label class="date-format"><input type="radio" name="wphts_pro_options[date_format]" value="Y-m-d" <?php checked( $wphts_pro_options['date_format'], 'Y-m-d' ); ?>><span class="date-time-text format-i18n"><?php echo date("Y-m-d"); ?></span><code>Y-m-d</code></label><br>
											<label class="date-format"><input type="radio" name="wphts_pro_options[date_format]" value="d/m/Y" <?php checked( $wphts_pro_options['date_format'], 'd/m/Y' ); ?>><span class="date-time-text format-i18n"><?php echo date("d/m/Y"); ?></span><code>d/m/Y</code></label><br>
											<label class="date-format"><input type="radio" name="wphts_pro_options[date_format]" value="F j, Y" <?php checked( $wphts_pro_options['date_format'], 'F j, Y' ); ?>><span class="date-time-text format-i18n"><?php echo date("F j, Y"); ?></span><code>F j, Y</code></label><br>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wphtsp-settings-submit" name="wphtsp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','timeline-and-history-slider'); ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div>
				</div>
			</div>
		</div>
		<!-- end Date Format Settings -->

		<!-- Custom CSS Settings Starts -->
		<div id="wphtsp-custom-css-sett" class="post-box-container wphtsp-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="custom-css" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'timeline-and-history-slider' ); ?></span>
						</h3>
						
						<div class="inside">
						
							<table class="form-table wphtsp-custom-css-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wphtsp-custom-css"><?php _e('Custom CSS', 'timeline-and-history-slider'); ?>:</label>
										</th>
										<td>
											<textarea name="wphts_pro_options[custom_css]" class="large-text wphtsp-custom-css" id="wphtsp-custom-css" rows="15"><?php echo wphtsp_esc_attr(wphts_pro_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'timeline-and-history-slider'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wphtsp-settings-submit" name="wphtsp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','timeline-and-history-slider'); ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- #custom-css -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wphtsp-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
	</form><!-- end .wphtsp-settings-form -->
</div><!-- end .wphtsp-settings -->