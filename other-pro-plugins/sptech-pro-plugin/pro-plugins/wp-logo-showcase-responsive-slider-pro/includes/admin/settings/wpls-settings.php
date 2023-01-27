<?php
/**
 * Settings Page
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Taking Values
$tooltip_theme 		= wpls_pro_get_option('tooltip_theme');
$tooltip_animation	= wpls_pro_get_option('tooltip_animation');
$tooltip_behavior	= wpls_pro_get_option('tooltip_behavior');
?>

<div class="wrap wpls-settings">

<h2><?php _e( 'WP Logo Showcase And Slider Pro Settings', 'logoshowcase' ); ?></h2><br />

<?php
// Success message
if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "logoshowcase").'</strong></p>
		  </div>';
}
?>

<form action="options.php" method="POST" id="wpls-settings-form" class="wpls-settings-form">
	
	<?php
	    settings_fields( 'wpls_pro_plugin_options' );
	    global $wpls_pro_options;
	?>

	<!-- Tooltip Settings Starts -->
	<div id="wpls-tooltip-sett" class="post-box-container wpls-tooltip-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Tooltip Settings', 'logoshowcase' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wpls-tooltip-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-theme"><?php _e('Tooltip Theme', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<select name="wpls_pro_options[tooltip_theme]" id="wpls-pro-tooltip-theme" class="wpls-pro-tooltip-theme wpls-select">
											<option value="punk" <?php selected( $tooltip_theme, 'punk' ); ?>><?php _e('Punk', 'logoshowcase'); ?></option>
											<option value="light" <?php selected( $tooltip_theme, 'light' ); ?>><?php _e('Light', 'logoshowcase'); ?></option>
											<option value="borderless" <?php selected( $tooltip_theme, 'borderless' ); ?>><?php _e('Borderless', 'logoshowcase'); ?></option>
											<option value="noir" <?php selected( $tooltip_theme, 'noir' ); ?>><?php _e('Noir', 'logoshowcase'); ?></option>
											<option value="shadow" <?php selected( $tooltip_theme, 'shadow' ); ?>><?php _e('Shadow', 'logoshowcase'); ?></option>
										</select><br/>
										<span class="description"><?php _e('Select the Tooltip Style.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-animation"><?php _e('Tooltip Animation', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<select name="wpls_pro_options[tooltip_animation]" id="wpls-pro-tooltip-animation" class="wpls-pro-tooltip-animation wpls-select">
											<option value="fade" <?php selected( $tooltip_animation, 'fade' ); ?>><?php _e('Fade', 'logoshowcase'); ?></option>
											<option value="grow" <?php selected( $tooltip_animation, 'grow' ); ?>><?php _e('Grow', 'logoshowcase'); ?></option>
											<option value="swing" <?php selected( $tooltip_animation, 'swing' ); ?>><?php _e('Swing', 'logoshowcase'); ?></option>
											<option value="slide" <?php selected( $tooltip_animation, 'slide' ); ?>><?php _e('Slide', 'logoshowcase'); ?></option>
											<option value="fall" <?php selected( $tooltip_animation, 'fall' ); ?>><?php _e('Fall', 'logoshowcase'); ?></option>
										</select><br/>
										<span class="description"><?php _e('Select the Tooltip Animation.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-behavior"><?php _e('Tooltip Behavior', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<select name="wpls_pro_options[tooltip_behavior]" id="wpls-pro-tooltip-behavior" class="wpls-pro-tooltip-behavior wpls-select">
											<option value="hover" <?php selected( $tooltip_behavior, 'hover' ); ?>><?php _e('Hover', 'logoshowcase'); ?></option>
											<option value="click" <?php selected( $tooltip_behavior, 'click' ); ?>><?php _e('Click', 'logoshowcase'); ?></option>
										</select><br/>
										<span class="description"><?php _e('Select when you want to show tooltip.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-arrow"><?php _e('Tooltip Arrow', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<input type="checkbox" name="wpls_pro_options[tooltip_arrow]" value="1" class="wpls-pro-tooltip-arrow" id="wpls-pro-tooltip-arrow" <?php checked( wpls_pro_get_option('tooltip_arrow'), 1 ); ?> /><br/>
										<span class="description"><?php _e('Check this box if you want to show tooltip with arrow.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-delay"><?php _e('Tooltip Delay', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<input type="number" name="wpls_pro_options[tooltip_delay]" value="<?php echo wpls_pro_esc_attr( wpls_pro_get_option('tooltip_delay') ); ?>" id="wpls-pro-tooltip-delay" class="wpls-pro-tooltip-delay" min="0" /><br/>
										<span class="description"><?php _e('Enter delay time to show tooltip.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-distance"><?php _e('Tooltip Distance', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<input type="number" name="wpls_pro_options[tooltip_distance]" value="<?php echo wpls_pro_esc_attr( wpls_pro_get_option('tooltip_distance') ); ?>" id="wpls-pro-tooltip-distance" class="wpls-pro-tooltip-distance" min="0" /><br/>
										<span class="description"><?php _e('Enter distance to show your tooltip from your actual object.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-maxwidth"><?php _e('Tooltip MaxWidth', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<input type="number" name="wpls_pro_options[tooltip_maxwidth]" value="<?php echo wpls_pro_esc_attr( wpls_pro_get_option('tooltip_maxwidth') ); ?>" id="wpls-pro-tooltip-maxwidth" class="wpls-pro-tooltip-maxwidth" min="1" /><br/>
										<span class="description"><?php _e('Enter maximum width of your tooltip.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<th scope="row">
										<label for="wpls-pro-tooltip-minwidth"><?php _e('Tooltip MinWidth', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<input type="number" name="wpls_pro_options[tooltip_minwidth]" value="<?php echo wpls_pro_esc_attr( wpls_pro_get_option('tooltip_minwidth') ); ?>" id="wpls-pro-tooltip-minwidth" class="wpls-pro-tooltip-minwidth" min="1" /><br/>
										<span class="description"><?php _e('Enter minimum width of your tooltip.', 'logoshowcase'); ?></span>
									</td>
								</tr>

								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpls-settings-submit" name="wpls-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','logoshowcase'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>
					</div><!-- .inside -->
				</div><!-- .postbox -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpls-tooltip-sett -->
	<!-- Tooltip Settings Ends -->

	<!-- Custom CSS Settings Starts -->
	<div id="wpls-custom-css-sett" class="post-box-container wpls-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'logoshowcase' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wpls-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wpls-custom-css"><?php _e('Custom Css', 'logoshowcase'); ?>:</label>
									</th>
									<td>
										<textarea name="wpls_pro_options[custom_css]" class="large-text wpls-custom-css" id="wpls-custom-css" rows="15"><?php echo wpls_pro_esc_attr(wpls_pro_get_option('custom_css')); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'logoshowcase'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpls-settings-submit" name="wpls-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','logoshowcase'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpls-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .wpls-settings-form -->

</div><!-- end .wpls-settings -->