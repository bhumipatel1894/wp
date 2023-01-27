<?php
/**
 * Settings Page
 *
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Taking some globals
global $wp_version;
?>

<div class="wrap wpspw-settings">

<h2><?php _e( 'Blog Designer - Post and Widget Pro Settings', 'blog-designer-for-post-and-widget' ); ?></h2><br />

<?php
// Success message 
if(isset($_POST['wpspw_reset_setts']) && !empty($_POST['wpspw_reset_setts'])) {
		
		wpspw_pro_default_settings(); // set default settings
		
		// Resett message
		echo '<div id="message" class="updated fade"><p><strong>' . __( 'All settings reset successfully.', 'blog-designer-for-post-and-widget') . '</strong></p></div>';
		
} else if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
	echo '<div id="message" class="updated notice notice-success is-dismissible">
			<p><strong>'.__("Your changes saved successfully.", "blog-designer-for-post-and-widget").'</strong></p>
		  </div>';
}
?>

<form action="" method="post">
	<div class="textright">
		<input type="submit" name="wpspw_reset_setts" value="<?php _e('Reset All Settings', 'blog-designer-for-post-and-widget'); ?>" class="button button-primary wpspw-reset-sett" />
	</div>
</form><!-- Reset settings form -->

<form action="options.php" method="POST" id="wpspw-settings-form" class="wpspw-settings-form">
	
	<?php
	    settings_fields( 'wpspw_pro_plugin_options' );
	    global $wpspw_pro_options;
	?>
	
	<!-- General Settings Starts -->
	<div id="wpspw-general-sett" class="post-box-container wpspw-general-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="general" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'General Settings', 'blog-designer-for-post-and-widget' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wpspw-general-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wpspw-pro-default-img"><?php _e('Default Featured Image', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<input type="text" name="wpspw_pro_options[default_img]" value="<?php echo wpspw_pro_esc_attr( wpspw_pro_get_option('default_img') ); ?>" id="wpspw-pro-default-img" class="regular-text wpspw-pro-default-img wpspw-pro-img-upload-input" />
										<input type="button" name="wpspw_pro_default_img" class="button-secondary wpspw-pro-image-upload" value="<?php _e( 'Upload Image', 'blog-designer-for-post-and-widget'); ?>" data-uploader-title="<?php _e('Choose Logo', 'blog-designer-for-post-and-widget'); ?>" data-uploader-button-text="<?php _e('Insert Logo', 'blog-designer-for-post-and-widget'); ?>" /> <input type="button" name="wpspw_pro_default_img_clear" id="wpspw-pro-default-img-clear" class="button button-secondary wpspw-pro-image-clear" value="<?php _e( 'Clear', 'blog-designer-for-post-and-widget'); ?>" /> <br />
										<span class="description"><?php _e( 'Upload default featured image or provide an external URL of image. If your post does not have featured image then this will be displayed instead of grey blank box.', 'blog-designer-for-post-and-widget' ); ?></span>
										<?php
											$default_img = '';
											if( wpspw_pro_get_option('default_img') ) { 
												$default_img = '<img src="'.wpspw_pro_get_option('default_img').'" alt="" />';
											}
										?>
										<div class="wpspw-pro-img-view"><?php echo $default_img; ?></div>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpspw-settings-submit" name="wpspw-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','blog-designer-for-post-and-widget'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>

					</div><!-- .inside -->
				</div><!-- #general -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpspw-general-sett -->
	<!-- General Settings Ends -->

	<!-- Layout Settings Starts -->
	<div id="wpspw-layout-sett" class="post-box-container wpspw-layout-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Layout Settings', 'blog-designer-for-post-and-widget' ); ?></span>
						</h3>
						
						<div class="inside">
						<table class="form-table wpspw-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th colspan="2"><div class="wpspw-sett-title"><?php _e('Post Title Settings', 'blog-designer-for-post-and-widget'); ?></div></th>
								</tr>
								<tr>
									<th scope="row">
										<label for="wpspw-post-title-clr"><?php _e('Post Title Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[post_title_color]" value="<?php echo wpspw_pro_get_option('post_title_color'); ?>" id="wpspw-post-title-clr" class="wpspw-color-box wpspw-post-title-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[post_title_color]" value="<?php echo wpspw_pro_get_option('post_title_color'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select post title color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Title Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-post-title-font-size"><?php _e('Post Title Font Size', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<input type="number" name="wpspw_pro_options[post_title_font_size]" value="<?php echo wpspw_pro_get_option('post_title_font_size'); ?>" id="wpspw-post-title-font-size" class="small-text wpspw-post-title-font-size" min="1" /> <?php _e('Px', 'blog-designer-for-post-and-widget'); ?><br/>
										<span class="description"><?php _e('Enter post title font size. Leave empty for default font size.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Title Font Size -->

								<tr>
									<th colspan="2"><div class="wpspw-sett-title"><?php _e('Post Category Settings', 'blog-designer-for-post-and-widget'); ?></div></th>
								</tr>
								<tr>
									<th scope="row">
										<label for="wpspw-post-cat-bg-clr"><?php _e('Post Category Background Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[post_cat_bg_clr]" value="<?php echo wpspw_pro_get_option('post_cat_bg_clr'); ?>" id="wpspw-post-cat-bg-clr" class="wpspw-color-box wpspw-post-cat-bg-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[post_cat_bg_clr]" value="<?php echo wpspw_pro_get_option('post_cat_bg_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select post category background color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Category Background Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-post-cat-hbg-clr"><?php _e('Post Category Hover Background Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[post_cat_hbg_clr]" value="<?php echo wpspw_pro_get_option('post_cat_hbg_clr'); ?>" id="wpspw-post-cat-bg-clr" class="wpspw-color-box wpspw-post-cat-hbg-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[post_cat_hbg_clr]" value="<?php echo wpspw_pro_get_option('post_cat_hbg_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select post category hover background color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Category Hover Background Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-post-cat-font-clr"><?php _e('Post Category Font Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[post_cat_font_clr]" value="<?php echo wpspw_pro_get_option('post_cat_font_clr'); ?>" id="wpspw-post-cat-bg-clr" class="wpspw-color-box wpspw-post-cat-font-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[post_cat_font_clr]" value="<?php echo wpspw_pro_get_option('post_cat_font_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select post category font color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Category Font Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-post-cat-hfont-clr"><?php _e('Post Category Hover Font Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[post_cat_hfont_clr]" value="<?php echo wpspw_pro_get_option('post_cat_hfont_clr'); ?>" id="wpspw-post-cat-bg-clr" class="wpspw-color-box wpspw-post-cat-hfont-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[post_cat_hfont_clr]" value="<?php echo wpspw_pro_get_option('post_cat_hfont_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select post category hover font color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Category Hover Font Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-post-cat-font-size"><?php _e('Post Category Font Size', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<input type="number" name="wpspw_pro_options[post_cat_font_size]" value="<?php echo wpspw_pro_get_option('post_cat_font_size'); ?>" id="wpspw-post-cat-font-size" class="small-text wpspw-post-cat-font-size" min="1" /> <?php _e('Px', 'blog-designer-for-post-and-widget'); ?><br/>
										<span class="description"><?php _e('Enter post category font size. Leave empty for default font size.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Category Font Size -->

								<tr>
									<th colspan="2"><div class="wpspw-sett-title"><?php _e('Read More Button Settings', 'blog-designer-for-post-and-widget'); ?></div></th>
								</tr>
								<tr>
									<th scope="row">
										<label for="wpspw-read-more-bg-clr"><?php _e('Read More Button Background Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[read_more_bg_clr]" value="<?php echo wpspw_pro_get_option('read_more_bg_clr'); ?>" id="wpspw-read-more-bg-clr" class="wpspw-color-box wpspw-read-more-bg-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[read_more_bg_clr]" value="<?php echo wpspw_pro_get_option('read_more_bg_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select Read More button background color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Read More Button Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-read-more-hbg-clr"><?php _e('Read More Button Hover Background Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[read_more_hbg_clr]" value="<?php echo wpspw_pro_get_option('read_more_hbg_clr'); ?>" id="wpspw-read-more-hbg-clr" class="wpspw-color-box wpspw-read-more-hbg-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[read_more_hbg_clr]" value="<?php echo wpspw_pro_get_option('read_more_hbg_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select Read More button hover background color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Read More Button Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-read-more-font-clr"><?php _e('Read More Button Text Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[read_more_font_clr]" value="<?php echo wpspw_pro_get_option('read_more_font_clr'); ?>" id="wpspw-read-more-font-clr" class="wpspw-color-box wpspw-read-more-font-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[read_more_font_clr]" value="<?php echo wpspw_pro_get_option('read_more_font_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select Read More button text color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Read More Button Text Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-read-more-hfont-clr"><?php _e('Read More Button Hover Text Color', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<?php if( $wp_version >= 3.5 ) { ?>
											<input type="text" name="wpspw_pro_options[read_more_hfont_clr]" value="<?php echo wpspw_pro_get_option('read_more_hfont_clr'); ?>" id="wpspw-read-more-hfont-clr" class="wpspw-color-box wpspw-read-more-hfont-clr" /><br/>
										<?php } else { ?>
											<div style='position:relative;'>
												<input type='text' name="wpspw_pro_options[read_more_hfont_clr]" value="<?php echo wpspw_pro_get_option('read_more_hfont_clr'); ?>" class="wpspw-color-box-farbtastic-inp" data-default-color="" />
												<input type="button" class="wpspw-color-box-farbtastic button button-secondary" value="<?php _e('Select Color', 'blog-designer-for-post-and-widget'); ?>" />
												<div class="colorpicker" style="background-color: #666; z-index:100; position:absolute; display:none;"></div>
											</div>
										<?php } ?>
											<span class="description"><?php _e('Select Read More button hover text color. Leave empty for default color.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Read More Button Text Color -->

								<tr>
									<th scope="row">
										<label for="wpspw-read-more-font-size"><?php _e('Read More Button Font Size', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<input type="number" name="wpspw_pro_options[read_more_font_size]" value="<?php echo wpspw_pro_get_option('read_more_font_size'); ?>" id="wpspw-read-more-font-size" class="small-text wpspw-read-more-font-size" min="1" /> <?php _e('Px', 'blog-designer-for-post-and-widget'); ?><br/>
										<span class="description"><?php _e('Enter Read More button font size. Leave empty for default font size.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr><!-- Post Category Font Size -->

								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpspw-layout-sett-submit" name="wpspw-settings-submit" class="button button-primary right wpspw-layout-sett-submit" value="<?php _e('Save Changes','blog-designer-for-post-and-widget'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>
					</div><!-- .inside -->
				</div><!-- .postbox -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpspw-layout-sett -->
	<!-- Layout Settings Ends -->

	<!-- Custom CSS Settings Starts -->
	<div id="wpspw-custom-css-sett" class="post-box-container wpspw-custom-css-sett">
		<div class="metabox-holder">
			<div class="meta-box-sortables ui-sortable">
				<div id="custom-css" class="postbox">

					<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

						<!-- Settings box title -->
						<h3 class="hndle">
							<span><?php _e( 'Custom CSS Settings', 'blog-designer-for-post-and-widget' ); ?></span>
						</h3>
						
						<div class="inside">
						
						<table class="form-table wpspw-custom-css-sett-tbl">
							<tbody>
								<tr>
									<th scope="row">
										<label for="wpspw-custom-css"><?php _e('Custom CSS', 'blog-designer-for-post-and-widget'); ?>:</label>
									</th>
									<td>
										<textarea name="wpspw_pro_options[custom_css]" class="large-text wpspw-custom-css" id="wpspw-custom-css" rows="15"><?php echo wpspw_pro_esc_attr(wpspw_pro_get_option('custom_css')); ?></textarea><br/>
										<span class="description"><?php _e('Enter custom CSS to override plugin CSS. Sometime !important will work.', 'blog-designer-for-post-and-widget'); ?></span>
									</td>
								</tr>
								<tr>
									<td colspan="2" valign="top" scope="row">
										<input type="submit" id="wpspw-settings-submit" name="wpspw-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','blog-designer-for-post-and-widget'); ?>" />
									</td>
								</tr>
							</tbody>
						 </table>
					</div><!-- .inside -->
				</div><!-- #custom-css -->
			</div><!-- .meta-box-sortables ui-sortable -->
		</div><!-- .metabox-holder -->
	</div><!-- #wpspw-custom-css-sett -->
	<!-- Custom CSS Settings Ends -->

</form><!-- end .wpspw-settings-form -->

</div><!-- end .wpspw-settings -->