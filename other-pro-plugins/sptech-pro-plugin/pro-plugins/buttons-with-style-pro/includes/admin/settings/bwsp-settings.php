<?php
/**
 * Settings Page
 *
 * @package Buttons With Style Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wrap bwswpos-settings">
	
	<h2><?php _e( 'Buttons With Style Pro Settings', 'buttons-with-style' ); ?></h2><br/>
	
	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "button-width-style").'</strong></p>
			  </div>';
	}
	?>
	
	<form action="options.php" method="POST" id="bwswpos-settings-form" class="bwswpos-settings-form">
		
		<?php
		    settings_fields( 'bwsp_plugin_options' );
		?>
		<!-- Custom CSS Settings Starts -->
		<div id="bwsp-custom-css-sett" class="post-box-container bwsp-custom-css-sett">
			<div class="metabox-holder">
				<div class="meta-box-sortables ui-sortable">
					<div class="postbox">

						<button class="handlediv button-link" type="button"><span class="toggle-indicator"></span></button>

							<!-- Settings box title -->
							<h3 class="hndle">
								<span><?php _e( 'Custom CSS Settings', 'buttons-with-style' ); ?></span>
							</h3>
							
							<div class="inside">
							
							<table class="form-table bwsp-custom-css-tbl">
								<tbody>
									<tr>
										<th scope="row">
											<label for="bwsp-custom-css"><?php _e('Custom CSS', 'buttons-with-style'); ?>:</label>
										</th>
										<td>
											<textarea name="bwsp_options[custom_css]" class="large-text bwsp-custom-css" id="bwsp-custom-css" rows="15"><?php echo bwsp_esc_attr(bwsp_get_option('custom_css')); ?></textarea><br/>
											<span class="description"><?php _e('Enter custom CSS to override plugin CSS.', 'buttons-with-style'); ?></span>
										</td>
									</tr>
									<tr>
										<td colspan="2" valign="top" scope="row">
											<input type="submit" id="bwswpos-settings-submit" name="bwswpos-settings-submit" class="button button-primary right" value="<?php _e('Save Changes','buttons-with-style');?>" />
										</td>
									</tr>
								</tbody>
							 </table>

						</div><!-- .inside -->
					</div><!-- #bwswpos-custom-css -->
				</div><!-- .meta-box-sortables ui-sortable -->
			</div><!-- .metabox-holder -->
		</div><!-- #bwsp-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
		
	</form><!-- end .bwswpos-settings-form -->
	
</div><!-- end .bwswpos-settings -->