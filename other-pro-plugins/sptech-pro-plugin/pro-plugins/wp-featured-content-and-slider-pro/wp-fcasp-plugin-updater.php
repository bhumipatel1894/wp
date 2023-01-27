<?php
/**
 * Updater Functions
 * 
 * @package WP Featured Content and Slider Pro
 * @since 1.0.0
 */

function wp_fcasp_plugin_license_menu() {
	add_submenu_page( 'edit.php?post_type='.WP_FCASP_POST_TYPE, 'WP Featured Content and Slider License', 'Plugin License', 'manage_options', 'wp-fcasp-license', 'wp_fcasp_plugin_license_page' );
}

add_action('admin_menu', 'wp_fcasp_plugin_license_menu', 30);

function wp_fcasp_plugin_license_page() {
	$license 		= get_option( 'wp_fcasp_plugin_license_key' );
	$status 		= get_option( 'wp_fcasp_plugin_license_status' );
	$license_info 	= get_option( 'wp_fcasp_plugin_license_info' );
?>
	<div class="wrap">
		<h2><?php _e('Featured Content and Slider Plugin License Options'); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields('wp_fcasp_plugin_license_sett'); ?>

			<?php if( $status !== false && $status == 'valid' ) { ?>
			<div class="updated notice notice-success" id="message">
				<p>Plugin license activated successfully</p>
			</div>
			<?php } elseif( $status !== false && $status == 'invalid' ) { ?>
			<div class="error notice notice-error" id="message">
				<p>Plugin license is invalid. Please be sure you have entered right plugin license key.</p>
			</div>
			<?php } else { ?>
			<div class="error notice notice-error" id="message">
				<p>Please activate plugin license to get automatic update of plugin.</p>
			</div>
			<?php } ?>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<label for="wp_fcasp_plugin_license_key"><?php _e('License Key'); ?></label>
						</th>
						<td>
							<input id="wp_fcasp_plugin_license_key" name="wp_fcasp_plugin_license_key" type="text" class="regular-text" value="<?php esc_attr_e( $license ); ?>" /><br/>
							<span class="description"><?php _e('Enter your license key'); ?></span>
						</td>
					</tr>
					<?php if( false !== $license ) { ?>
						<tr valign="top">
							<th scope="row" valign="top">
								<?php _e('Activate License'); ?>
							</th>
							<td>
								<?php if( $status !== false && $status == 'valid' ) { ?>
									<?php wp_nonce_field( 'edd_wp_fcasp_nonce', 'edd_wp_fcasp_nonce' ); ?>
									<input type="submit" class="button-secondary" name="wp_fcasp_license_deactivate" value="<?php _e('Deactivate License'); ?>"/>
									<span style="color: green; display: inline-block; margin: 4px 0px 0px;"><i class="dashicons dashicons-yes"></i><?php _e('Active'); ?></span>
								<?php } else {
									wp_nonce_field( 'edd_wp_fcasp_nonce', 'edd_wp_fcasp_nonce' ); ?>
									<input type="submit" class="button-secondary" name="wp_fcasp_license_activate" value="<?php _e('Activate License'); ?>"/>
								<?php } ?>
							</td>
						</tr>
					<?php } ?>

					<?php if( $status !== false && $status == 'valid' && !empty($license_info) ) { ?>
					<tr>
						<th valign="top">License Information</th>
						<td style="font-weight: 600; line-height: 25px;">
							License Limit : <?php echo (isset($license_info->license_limit) && $license_info->license_limit == 0) ? 'Unlimited' : $license_info->license_limit.' Sites'; ?> <br/>
							Active Site(s) : <?php echo isset($license_info->site_count) ? $license_info->site_count : 'N/A'; ?> <br/>
							Activations Left Site(s) : <?php echo isset($license_info->activations_left) ? ucfirst($license_info->activations_left) : 'N/A'; ?> <br/>
							Valid Upto : <?php echo (isset($license_info->expires) && $license_info->expires == 'lifetime') ? 'Lifetime' : date('d M, Y', strtotime($license_info->expires)); ?> <label style="vertical-align:top;" title="On purchase of any product 1 Year of Updates, 1 Year of Expert Support 24/7. After 1 Year, use without renewal OR renew manually at 50% of the price for further updates and support.">[?]</label>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php submit_button(); ?>
			
			<div class="wpo-activate-step">
				<h2>Steps to Activate the License</h2>
				<h4>Note: If you do not activate the license then you will not get update of this plugin any more.</h4>
				<h4>You will receive license key within your product purchase email. If you do not have license key then you can get it from your <a href="https://www.wponlinesupport.com/my-account/" target="_blank">Account Page</a>.</h4>
				<p><b>Step 1:</b> Enter your license key into 'License Key' field and press 'Save Changes' button.</p>
				<p><b>Step 2:</b> After save changes you can see an another button named 'Activate License'.</p>
				<p><b>Step 3:</b> Press 'Activate License'. If your key is valid then you can see green 'Active' text.</p>
				<p><b>Step 4:</b> That's it. Now you can get auto update of this plugin.</p>
			</div><!-- end .wpo-activate-step -->
			
		</form>
	<?php
}

function wp_fcasp_plugin_register_license_option() {
	// creates our settings in the options table
	register_setting('wp_fcasp_plugin_license_sett', 'wp_fcasp_plugin_license_key', 'wp_fcasp_sanitize_license' );
}
add_action('admin_init', 'wp_fcasp_plugin_register_license_option');

function wp_fcasp_sanitize_license( $new ) {
	$old = get_option( 'wp_fcasp_plugin_license_key' );
	if( $old && $old != $new ) {
		delete_option( 'wp_fcasp_plugin_license_status' ); // new license has been entered, so must reactivate
	}
	return $new;
}

/************************************
* this illustrates how to activate
* a license key
*************************************/

function wp_fcasp_activate_plugin_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['wp_fcasp_license_activate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_wp_fcasp_nonce', 'edd_wp_fcasp_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'wp_fcasp_plugin_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'activate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_WP_FCASP_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( EDD_WP_FCASP_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "valid" or "invalid"
		update_option( 'wp_fcasp_plugin_license_status', $license_data->license );

		if(isset($license_data->license)) {
			update_option( 'wp_fcasp_plugin_license_info', $license_data );
		}
	}
}
add_action('admin_init', 'wp_fcasp_activate_plugin_license');


/***********************************************
* Illustrates how to deactivate a license key.
* This will descrease the site count
***********************************************/

function wp_fcasp_deactivate_plugin_license() {

	// listen for our activate button to be clicked
	if( isset( $_POST['wp_fcasp_license_deactivate'] ) ) {

		// run a quick security check
	 	if( ! check_admin_referer( 'edd_wp_fcasp_nonce', 'edd_wp_fcasp_nonce' ) )
			return; // get out if we didn't click the Activate button

		// retrieve the license from the database
		$license = trim( get_option( 'wp_fcasp_plugin_license_key' ) );

		// data to send in our API request
		$api_params = array(
			'edd_action'=> 'deactivate_license',
			'license' 	=> $license,
			'item_name' => urlencode( EDD_WP_FCASP_ITEM_NAME ), // the name of our product in EDD
			'url'       => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( EDD_WP_FCASP_STORE_URL, array( 'timeout' => 15, 'sslverify' => false, 'body' => $api_params ) );

		// make sure the response came back okay
		if ( is_wp_error( $response ) )
			return false;

		// decode the license data
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// $license_data->license will be either "deactivated" or "failed"
		if( $license_data->license == 'deactivated' ) {
			delete_option( 'wp_fcasp_plugin_license_status' );
		}
	}
}
add_action('admin_init', 'wp_fcasp_deactivate_plugin_license');