<?php
/**
 * Settings Page
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0.4
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

$flush_interval = iscwp_pro_flush_interval();
?>

<div class="wrap iscwp-settings-form-settings">

	<h2><?php _e( 'Instagram Slider and Carousel Plus Widget Pro - Settings', 'instagram-slider-and-carousel-plus-widget' ); ?></h2><br />

	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
		<p>'.__("Your changes saved successfully.", "instagram-slider-and-carousel-plus-widget").'</p>
			  </div>';
	}
	?>

	<form action="options.php" method="POST" id="iscwp-settings-form-settings-form" class="iscwp-settings-form-settings-form">

		<?php
		    settings_fields( 'iscwp_pro_plugin_options' );
		    global $iscwp_pro_options;
		?>

		<!-- General Settings Starts -->
		<div id="iscwp-settings-form-general-sett" class="post-box-container iscwp-settings-form-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'General Settings', 'instagram-slider-and-carousel-plus-widget' ); ?></span>
						</h3>
						
						<div class="inside">
							
							<table class="form-table iscwp-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="iscwp-cache-time"><?php _e('Cache Time', 'instagram-slider-and-carousel-plus-widget'); ?></label>
										</th>
										<td>
											<select name="iscwp_pro_options[cache_time]" id="iscwp-cache-time" class="iscwp-cache-time">
												<?php
												if( !empty($flush_interval) ) {
													foreach ($flush_interval as $interval_time => $interval_data) {
												?>
												<option value="<?php echo $interval_time; ?>" <?php selected( iscwp_pro_get_option('cache_time'), $interval_time ); ?> ><?php echo $interval_data; ?></option>
												<?php
													}
												}
												?>
											</select><br/>
											<span class="description"><?php _e('Select time period for instagram data cache. Cache will be automatically flushed after selected time period.', 'instagram-slider-and-carousel-plus-widget'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="iscwp-settings-submit" name="iscwp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','instagram-slider-and-carousel-plus-widget');?>" />
										</td>
									</tr>
								</tbody>
						 	</table>
						</div><!-- .inside -->
					</div>
				</div>
			</div>
		</div>
		<!-- General Settings end -->

		<!-- Flush Settings Starts -->
		<div id="iscwp-settings-cache-user" class="post-box-container iscwp-settings-form-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Flush Caches', 'instagram-slider-and-carousel-plus-widget' ); ?></span>
						</h3>

						<div class="inside iscwp-cache-user" id="iscwp-cache-user">

							<table class="form-table iscwp-settings-form-general-sett-tbl">
								<tbody>
								<tr>
									<td colspan="2">
										<input type="button" value="<?php _e('Flush All Caches', 'instagram-slider-and-carousel-plus-widget'); ?>" class="button button-secondary right iscwp-crl-all-cache" />
									</td>
								</tr>

								<?php $stored_transient = get_option('wp_iscwp_cache_transient');
								if( $stored_transient ) {
									foreach ($stored_transient as $user) {
										$user 		= explode('_', $user);
										$user_key	= end($user);
								?>
										<tr class="iscwp-user">
											<th scope="row">
												<b><?php echo $user_key; ?></b>
											</th>
											<td>
												<div class="iscwp-ajax-btn-wrap">
													<input type="button" value="<?php _e('Clear Cache', 'instagram-slider-and-carousel-plus-widget'); ?>" class="button button-secondary iscwp-crl-cache" data-user="<?php echo $user_key; ?>" />
													<span class="spinner"></span>
												</div>
											</td>
										</tr>
								<?php } 
								} ?>
									<tr class="iscwp-cache-empty <?php if($stored_transient) { echo 'iscwp-user-hide'; } ?>">
										<td>
											<?php _e('No cache data found.', 'instagram-slider-and-carousel-plus-widget'); ?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Flush Settings end -->

		<!-- Custom CSS Settings Starts -->
		<div id="iscwp-settings-form-general-sett" class="post-box-container iscwp-settings-form-general-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="general" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS', 'instagram-slider-and-carousel-plus-widget' ); ?></span>
						</h3>

						<div class="inside">
							
							<table class="form-table iscwp-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="iscwp-custom-css"><?php _e('Custom CSS', 'instagram-slider-and-carousel-plus-widget'); ?></label>
										</th>
										<td>
											<textarea name="iscwp_pro_options[custom_css]" class="large-text iscwp-custom-css" id="iscwp-custom-css" rows="15"><?php echo iscwp_pro_get_option('custom_css'); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'instagram-slider-and-carousel-plus-widget'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="iscwp-settings-submit" name="iscwp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','instagram-slider-and-carousel-plus-widget');?>" />
										</td>
									</tr>
								</tbody>
							 </table>
						</div><!-- .inside -->
				</div>
			</div>
		</div>
		<!-- Custom CSS Settings end -->
	</form><!-- end .iscwp-settings-form-settings-form -->
</div><!-- end .iscwp-settings-form-settings -->