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

<div class="wrap">
	
	<h2><?php _e( 'Personal Settings', 'buttons-with-style' ); ?></h2><br/>
	
	<?php
	// Success message
	if( isset($_GET['settings-updated']) && $_GET['settings-updated'] == 'true' ) {
		echo '<div id="message" class="updated notice notice-success is-dismissible">
				<p><strong>'.__("Your changes saved successfully.", "button-width-style").'</strong></p>
			  </div>';
	}
	?>
	
	<form action="options.php" method="POST" id="bwswpos-personal-settings-form" class="bwswpos-settings-form">
		
		<?php
		    settings_fields( 'bwsp_personal_setting' );
		?>
		<!-- Custom CSS Settings Starts -->
		<div>
			<p>
				<label for="personal_username"><?php _e('Personal Username','buttons-with-style');?></label>
				<input type="text" name="personal_username" id="personal_username" value="<?php echo bwsp_esc_attr(get_option('personal_username')); ?>" />
			</p>
			<p>
				<label for="personal_detail"><?php _e('Personal Detail','buttons-with-style');?></label>
				<input type="text" name="personal_detail" id="personal_detail" value="<?php echo bwsp_esc_attr(get_option('personal_detail')); ?>" >
			</p>					
			<p>
				<input type="submit" name="submit_personal_setting" id="submit_personal_setting"  value="<?php _e('Save Changes','buttons-with-style');?>" >
			</p>
					
				
			
		</div><!-- #bwsp-custom-css-sett -->
		<!-- Custom CSS Settings Ends -->
		
	</form><!-- end .bwswpos-settings-form -->
	
</div><!-- end .bwswpos-settings -->