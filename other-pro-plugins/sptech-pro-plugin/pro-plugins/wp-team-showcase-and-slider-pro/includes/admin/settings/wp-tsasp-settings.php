<?php
/**
 * Settings Page
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wp-tsasp-settings">

<h2><?php _e( 'WP Team Showcase and Slider Pro Settings', 'wp-team-showcase-and-slider' ); ?></h2><br />

<?php
// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "wp-team-showcase-and-slider").'</strong></p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="wp-tsasp-settings-form" class="wp-tsasp-settings-form">
	
	<?php
	    settings_fields( 'wp_tsasp_plugin_options' );
	    global $wp_tsasp_options;
	?>

	<!-- Custom CSS Settings Starts -->
	<div id="wp-tsasp-custom-css-sett" class="post-box-container wp-tsasp-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'wp-team-showcase-and-slider' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wp-tsasp-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wp-tsasp-custom-css"><?php _e('Custom CSS', 'wp-team-showcase-and-slider'); ?>:</label>
									</th>
									<td>
										<textarea name="wp_tsasp_options[custom_css]" class="large-text wp-tsasp-custom-css" id="wp-tsasp-custom-css" rows="15"><?php echo wp_tsasp_esc_attr(wp_tsasp_get_option('custom_css')); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'wp-team-showcase-and-slider'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wp-tsasp-settings-submit" name="wp-tsasp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','wp-team-showcase-and-slider'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wp-tsasp-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .wp-tsasp-settings-form -->

</div><!-- end .wp-tsasp-settings -->