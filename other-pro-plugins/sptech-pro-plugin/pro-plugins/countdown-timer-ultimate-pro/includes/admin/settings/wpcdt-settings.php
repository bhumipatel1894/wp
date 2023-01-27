<?php
/**
 * Settings Page
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wpcdt-settings">

	<h2><?php _e( 'Countdown Timer Ultimate	 Pro Settings', 'countdown-timer-ultimate' ); ?></h2><br />

	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p>'.__("Your changes saved successfully.", "countdown-timer-ultimate").'</p>
			  </div>';
	}
	?>

	<form action="options.php" method="POST" id="wpcdt-settings-form" class="wpcdt-settings-form">
		
		<?php
		    settings_fields( 'wpcdt_pro_plugin_options' );
		?>

		<!-- Custom CSS Settings Starts -->
		<div id="wpcdt-custom-css-sett" class="post-box-container wpcdt-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="custom-css" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'countdown-timer-ultimate' ); ?></span>
						</h3>
						
						<div class="inside">
						
							<table class="form-table wpcdt-custom-css-sett-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wpcdt-custom-css"><?php _e('Custom CSS', 'countdown-timer-ultimate'); ?></label>
										</th>
										<td>
											<textarea name="wpcdt_pro_options[custom_css]" class="large-text wpcdt-custom-css" id="wpcdt-custom-css" rows="15"><?php echo wpcdt_pro_escape_attr(wpcdt_pro_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'countdown-timer-ultimate'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wpcdt-settings-submit" name="wpcdt-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','countdown-timer-ultimate'); ?>" />
										</td>
									</tr>
								</tbody>
							</table>
						</div><!-- .inside -->
					</div><!-- #custom-css -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wpcdt-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
	</form><!-- end .wpcdt-settings-form -->
</div><!-- end .wpcdt-settings -->