<?php
/**
 * Settings Page
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap wp-igsp-settings">
	
	<h2><?php _e( 'Image Gallery and Slider Pro Settings', 'meta-slider-and-carousel-with-lightbox' ); ?></h2><br/>
	
	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "meta-slider-and-carousel-with-lightbox").'</strong></p>
			  </div>';
	}
	?>
	
	<form action="options.php" method="POST" id="wp-igsp-settings-form" class="wp-igsp-settings-form">
		
		<?php
		    settings_fields( 'wp_igsp_pro_plugin_options' );
		    global $wp_igsp_pro_options;
		?>
		
		<!-- Custom CSS Settings Starts -->
		<div id="wp-igsp-custom-css-sett" class="post-box-container wp-igsp-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div id="wp-igsp-custom-css-postbox" class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'Custom CSS Settings', 'meta-slider-and-carousel-with-lightbox' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table wp-igsp-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="wp-igsp-custom-css"><?php _e('Custom CSS', 'meta-slider-and-carousel-with-lightbox'); ?>:</label>
										</th>
										<td>
											<textarea name="wp_igsp_pro_options[custom_css]" class="large-text wp-igsp-custom-css" id="wp-igsp-custom-css" rows="15"><?php echo wp_igsp_pro_esc_attr(wp_igsp_pro_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'meta-slider-and-carousel-with-lightbox'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="wp-igsp-settings-submit" name="wp-igsp-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','meta-slider-and-carousel-with-lightbox');?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #wp-igsp-custom-css-postbox -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #wp-igsp-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
		
	</form><!-- end .wp-igsp-settings-form -->
	
</div><!-- end .wp-igsp-settings -->