<?php
/**
 * Settings Page
 *
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wp-vgp-settings">

<h2><?php _e( 'Video gallery and Player Pro Settings', 'html5-videogallery-plus-player' ); ?></h2><br />

<?php
// Success message
if(isset($_POST['wp_vgp_reset_setts']) && !empty($_POST['wp_vgp_reset_setts'])) {
		
		wp_vgp_default_settings(); // set default settings
		
		// Resett message
		echo '<div id="message" class="updated fade"><p><strong>' . __( 'All settings reset successfully.', 'html5-videogallery-plus-player') . '</strong></p></div>';
		
} else if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "html5-videogallery-plus-player").'</strong></p>
		  </div>';
}
?>

<form action="" method="post">
	<div class="textright">
		<input type="submit" name="wp_vgp_reset_setts" value="<?php _e('Reset All Settings', 'html5-videogallery-plus-player'); ?>" class="button button-primary wp-vgp-reset-sett" />
	</div>
</form><!-- Reset settings form -->

<form action="options.php" method="POST" id="wp-vgp-settings-form" class="wp-vgp-settings-form">
	
	<?php
	    settings_fields( 'wp_vgp_plugin_options' );
	    global $wp_vgp_options;
	?>

	<!-- General Settings Starts -->
	<div id="wp-vgp-general-sett" class="post-box-container wp-vgp-general-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'General Settings', 'html5-videogallery-plus-player' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wp-vgp-general-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wp-vgp-default-img"><?php _e('Default Image', 'html5-videogallery-plus-player'); ?>:</label>
									</th>
									<td>
										<input type="text" name="wp_vgp_options[default_img]" value="<?php echo wp_vgp_esc_attr( wp_vgp_get_option('default_img') ); ?>" id="wp-vgp-default-img" class="regular-text wp-vgp-default-img wp-vgp-img-upload-input" />
										<input type="button" name="wprpsp_default_img" class="button-secondary wp-vgp-image-upload" value="<?php _e( 'Upload Image', 'html5-videogallery-plus-player'); ?>" data-uploader-title="<?php _e('Choose Image', 'html5-videogallery-plus-player'); ?>" data-uploader-button-text="<?php _e('Insert Image', 'html5-videogallery-plus-player'); ?>" /> <input type="button" name="wprpsp_default_img_clear" id="wp-vgp-default-img-clear" class="button button-secondary wp-vgp-image-clear" value="<?php _e( 'Clear', 'html5-videogallery-plus-player'); ?>" /> <br />
										<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of blank grey box.', 'html5-videogallery-plus-player' ); ?></span>
										<?php
											$default_img = '';
											if( wp_vgp_get_option('default_img') ) { 
												$default_img = '<img src="'.wp_vgp_get_option('default_img').'" alt="" />';
											}
										?>
										<div class="wp-vgp-img-view"><?php echo $default_img; ?></div>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" name="wp-vgp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','html5-videogallery-plus-player'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wp-vgp-general-sett -->
	<!-- General Settings Ends -->

	<!-- Video Settings Starts -->
	<div id="wp-vgp-video-sett" class="post-box-container wp-vgp-video-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

					<!-- Settings box title -->
					<h3 class="hndle">
						<span><?php _e( 'Video Settings', 'html5-videogallery-plus-player' ); ?></span>
					</h3>
						
					<div class="inside">
						
						<div class="wp-vgp-video-notice"><?php _e('Note: Some parameters will not work if video author has selected preference for video.', 'html5-videogallery-plus-player'); ?></div>

						<div class="wp-vgp-mb-tabs-wrp">
							<ul id="wp-vgp-mb-tabs" class="wp-vgp-mb-tabs">
								<li class="wp-vgp-mb-nav wp-vgp-active">
									<a href="#wp-vgp-yt-sett"><?php _e('YouTube', 'html5-videogallery-plus-player'); ?></a>
								</li>
								<li class="wp-vgp-mb-nav">
									<a href="#wp-vgp-vm-sett"><?php _e('Vimeo', 'html5-videogallery-plus-player'); ?></a>
								</li>
								<li class="wp-vgp-mb-nav">
									<a href="#wp-vgp-dly-sett"><?php _e('Dailymotion', 'html5-videogallery-plus-player'); ?></a>
								</li>
							</ul>

							<div id="wp-vgp-yt-sett" class="wp-vgp-yt-sett wp-vgp-tab-cnt" style="display:block;">
								<table class="form-table">
									<tbody>
										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-yt-autoplay"><?php _e('Autoplay', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-yt-autoplay" id="wp-vgp-yt-autoplay" name="wp_vgp_options[yt_autoplay]" <?php checked(wp_vgp_get_option('yt_autoplay'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to play video automatically when open.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-yt-controls"><?php _e('Hide Video Controls', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-yt-controls" id="wp-vgp-yt-controls" name="wp_vgp_options[yt_hide_controls]" <?php checked(wp_vgp_get_option('yt_hide_controls'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to hide video controls.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-yt-fullscreen"><?php _e('Hide Fullscreen Option', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-yt-fullscreen" id="wp-vgp-yt-fullscreen" name="wp_vgp_options[yt_hide_fullscreen]" <?php checked(wp_vgp_get_option('yt_hide_fullscreen'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to remove a button to view a fullscreen player.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-yt-related"><?php _e('Hide Related Videos', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-yt-related" id="wp-vgp-yt-related" name="wp_vgp_options[yt_hide_related]" <?php checked(wp_vgp_get_option('yt_hide_related'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to do not show related video after video ends.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-yt-showinfo"><?php _e('Hide Video Information', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-yt-showinfo" id="wp-vgp-yt-showinfo" name="wp_vgp_options[yt_hide_showinfo]" <?php checked(wp_vgp_get_option('yt_hide_showinfo'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to do not display information like the video title, author or rating before the video starts playing.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-yt-subtitles"><?php _e('Video Subtitles', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-yt-subtitles" id="wp-vgp-yt-subtitles" name="wp_vgp_options[yt_subtitles]" <?php checked(wp_vgp_get_option('yt_subtitles'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to display `CC` button in video controlbar for subtitles.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-yt-pb-color"><?php _e('Progressbar Color', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<select class="wp-vgp-checkbox wp-vgp-yt-pb-color" id="wp-vgp-yt-pb-color" name="wp_vgp_options[yt_pb_color]">
													<option value=""><?php _e('Red', 'html5-videogallery-plus-player'); ?></option>
													<option value="white" <?php selected( wp_vgp_get_option('yt_pb_color'), 'white' ); ?> ><?php _e('White', 'html5-videogallery-plus-player'); ?></option>
												</select><br/>
												<span class="description"><?php _e('Select video progressbar color.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr>
											<td colspan="2" valign="top" scope="row">
												<input type="submit" name="wp-vgp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','html5-videogallery-plus-player'); ?>" />
											</td>
										</tr>
									</tbody>
								</table>
							</div><!-- end #wp-vgp-yt-sett -->

							<!-- Vimeo Settings -->
							<div id="wp-vgp-vm-sett" class="wp-vgp-vm-sett wp-vgp-tab-cnt">
								<table class="form-table">
									<tbody>
										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-vm-autoplay"><?php _e('Autoplay', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-vm-autoplay" id="wp-vgp-vm-autoplay" name="wp_vgp_options[vm_autoplay]" <?php checked(wp_vgp_get_option('vm_autoplay'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to play video automatically when open.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-vm-loop"><?php _e('Loop', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-vm-loop" id="wp-vgp-vm-loop" name="wp_vgp_options[vm_loop]" <?php checked(wp_vgp_get_option('vm_loop'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to play video again when it reaches to end.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-vm-title"><?php _e('Hide Video Title', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-vm-title" id="wp-vgp-vm-title" name="wp_vgp_options[vm_hide_title]" <?php checked(wp_vgp_get_option('vm_hide_title'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to do not display video title.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-vm-author"><?php _e('Hide Video Author Name', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-vm-author" id="wp-vgp-vm-author" name="wp_vgp_options[vm_hide_author]" <?php checked(wp_vgp_get_option('vm_hide_author'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to do not display video author.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr>
											<th scope="row">
												<label for="wp-vgp-vm-color"><?php _e('Player Color', 'html5-videogallery-plus-player'); ?>:</label>
											</th>
											<td>
												<input type="text" name="wp_vgp_options[vm_color]" value="<?php echo wp_vgp_get_option('vm_color') ?>" id="wp-vgp-vm-color" class="wp-vgp-vm-color wp-vgp-color-box" /><br/>
												<span class="description"><?php _e('Select player color.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr>
											<td colspan="2" valign="top" scope="row">
												<input type="submit" name="wp-vgp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','html5-videogallery-plus-player'); ?>" />
											</td>
										</tr>
									</tbody>
								</table>
							</div><!-- end #wp-vgp-vm-sett -->

							<!-- Dailymotion Settings -->
							<div id="wp-vgp-dly-sett" class="wp-vgp-dly-sett wp-vgp-tab-cnt">
								<table class="form-table">
									<tbody>
										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-dly-autoplay"><?php _e('Autoplay', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-dly-autoplay" id="wp-vgp-dly-autoplay" name="wp_vgp_options[dly_autoplay]" <?php checked(wp_vgp_get_option('dly_autoplay'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to play video automatically when open.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-dly-controls"><?php _e('Hide Video Controls', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-dly-controls" id="wp-vgp-dly-controls" name="wp_vgp_options[dly_hide_controls]" <?php checked(wp_vgp_get_option('dly_hide_controls'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to hide video controls.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-dly-showinfo"><?php _e('Hide Video Information', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-dly-showinfo" id="wp-vgp-dly-showinfo" name="wp_vgp_options[dly_hide_showinfo]" <?php checked(wp_vgp_get_option('dly_hide_showinfo'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to do not display information like the video title, author or rating before the video starts playing.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-dly-related"><?php _e('Hide Related Videos', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-dly-related" id="wp-vgp-dly-related" name="wp_vgp_options[dly_hide_related]" <?php checked(wp_vgp_get_option('dly_hide_related'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to do not show related video after video ends.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-dly-logo"><?php _e('Hide Dailymotion Logo', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-dly-logo" id="wp-vgp-dly-logo" name="wp_vgp_options[dly_hide_logo]" <?php checked(wp_vgp_get_option('dly_hide_logo'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to remove dailymotion logo from player.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-dly-sharing"><?php _e('Hide Sharing Button', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<input type="checkbox" value="1" class="wp-vgp-checkbox wp-vgp-dly-sharing" id="wp-vgp-dly-sharing" name="wp_vgp_options[dly_hide_sharing]" <?php checked(wp_vgp_get_option('dly_hide_sharing'), 1); ?> /><br/>
												<span class="description"><?php _e('Check this box to remove sharing button from player.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr>
											<th scope="row">
												<label for="wp-vgp-dly-color"><?php _e('Player Color', 'html5-videogallery-plus-player'); ?>:</label>
											</th>
											<td>
												<input type="text" name="wp_vgp_options[dly_color]" value="<?php echo wp_vgp_get_option('dly_color') ?>" id="wp-vgp-dly-color" class="wp-vgp-dly-color wp-vgp-color-box" /><br/>
												<span class="description"><?php _e('Select player color.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr valign="top">
											<th scope="row">
												<label for="wp-vgp-dly-theme"><?php _e('Player Theme', 'html5-videogallery-plus-player'); ?></label>
											</th>
											<td>
												<select class="wp-vgp-checkbox wp-vgp-dly-theme" id="wp-vgp-dly-theme" name="wp_vgp_options[dly_theme]">
													<option value=""><?php _e('Dark', 'html5-videogallery-plus-player'); ?></option>
													<option value="light" <?php selected( wp_vgp_get_option('dly_theme'), 'light' ); ?> ><?php _e('Light', 'html5-videogallery-plus-player'); ?></option>
												</select><br/>
												<span class="description"><?php _e('Select video player theme. Note: Player theme will automatically change according to `Player Color`.', 'html5-videogallery-plus-player'); ?></span>
											</td>
										</tr>

										<tr>
											<td colspan="2" valign="top" scope="row">
												<input type="submit" name="wp-vgp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','html5-videogallery-plus-player'); ?>" />
											</td>
										</tr>
									</tbody>
								</table>
							</div><!-- end #wp-vgp-dly-sett -->
							<input type="hidden" value="<?php echo wp_vgp_get_option('tab') ?>" class="wp-vgp-selected-tab" name="wp_vgp_options[tab]" />
						</div><!-- end .wp-vgp-mb-tabs-wrp -->

					</div><!-- .inside -->
				</div><!-- #postbox -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wp-vgp-video-sett -->
	<!-- Video Settings Ends -->

	<!-- Jwplayer Settings Starts -->
	<div id="wp-vgp-jwplayer-sett" class="post-box-container wp-vgp-jwplayer-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

					<!-- Settings box title -->
					<h3 class="hndle">
						<span><?php _e( 'JW Player Settings', 'html5-videogallery-plus-player' ); ?></span>
					</h3>
						
					<div class="inside">
						<div class="wp-vgp-video-notice"><?php _e('Note: Due to limitation of JW Player, It only works with HTML5 (Self Hosted) or YouTube video only.', 'html5-videogallery-plus-player'); ?></div>
						<table class="form-table wp-vgp-jwplayer-sett-tbl">
							<tbody>
								<tr valign="top">
									<th scope="row">
										<label for="wp-jwp-enable"><?php _e('Enable', 'html5-videogallery-plus-player'); ?></label>
									</th>
									<td>
										<input type="checkbox" value="1" class="wp-vgp-checkbox wp-jwp-enable" id="wp-jwp-enable" name="wp_vgp_options[jwp_enable]" <?php checked(wp_vgp_get_option('jwp_enable'), 1); ?> /><br/>
										<span class="description"><?php _e('Check this box to enable JW Player.', 'html5-videogallery-plus-player'); ?></span>
									</td>
								</tr>
								<tr valign="top">
									<th scope="row">
										<label for="wp-jwp-licence-key"><?php _e('JW Player License Key', 'html5-videogallery-plus-player'); ?></label>
									</th>
									<td>
										<input type="text" name="wp_vgp_options[jwp_licence_key]" value="<?php echo wp_vgp_esc_attr(wp_vgp_get_option('jwp_licence_key')); ?>" id="wp-jwp-licence-key" class="wp-jwp-licence-key regular-text" /><br/>
										<span class="description"><?php _e('Enter JW Player license key.', 'html5-videogallery-plus-player'); ?></span>
									</td>
								</tr>							
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" name="wp-vgp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes', 'html5-videogallery-plus-player'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>
					</div><!-- .inside -->
				</div><!-- #jwplayer-sett -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wp-vgp-jwplayer-sett -->
	<!-- Jwplayer Settings Ends -->

	<!-- Custom CSS Settings Starts -->
	<div id="wp-vgp-custom-css-sett" class="post-box-container wp-vgp-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'html5-videogallery-plus-player' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wp-vgp-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wp-vgp-custom-css"><?php _e('Custom CSS', 'html5-videogallery-plus-player'); ?>:</label>
									</th>
									<td>
										<textarea name="wp_vgp_options[custom_css]" class="large-text wp-vgp-custom-css" id="wp-vgp-custom-css" rows="15"><?php echo wp_vgp_esc_attr(wp_vgp_get_option('custom_css')); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'html5-videogallery-plus-player'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" name="wp-vgp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','html5-videogallery-plus-player'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wp-vgp-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .wp-vgp-settings-form -->

</div><!-- end .wp-vgp-settings -->