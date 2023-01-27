<?php
/**
 * Handles team member details metabox HTML
 *
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WP_TSASP_META_PREFIX; // Metabox prefix

$social_services = wp_tsasp_social_scrvices(); // Getting social service

// Getting saved values
$selected_tab 		= get_post_meta($post->ID, $prefix.'tab', true);
$member_department 	= get_post_meta( $post->ID, '_member_department', true );
$member_designation = get_post_meta( $post->ID, '_member_designation', true );
$member_skills 		= get_post_meta( $post->ID, '_skills', true );
$member_experience 	= get_post_meta( $post->ID, '_member_experience', true );
$social 			= get_post_meta( $post->ID, $prefix.'social', true );
$social 			= !empty($social) ? $social : array();

$system_social_services = array_keys($social_services);
$stored_social_services = array_keys($social);
$final_social_services 	= array_unique( $stored_social_services + $system_social_services );
?>

<div class="wp-tsasp-mb-tabs-wrp">
	<ul id="wp-tsasp-mb-tabs" class="wp-tsasp-mb-tabs">
		<li class="wp-tsasp-mb-nav wp-tsasp-active">
			<a href="#wp-tsasp-mdetails">Member Details</a>
		</li>
		<li class="wp-tsasp-mb-nav">
			<a href="#wp-tsasp-sdetails">Social Details</a>
		</li>
	</ul>

	<div id="wp-tsasp-mdetails" class="wp-tsasp-mdetails wp-tsasp-tab-cnt" style="display:block;">
		<table class="form-table wp-tsasp-team-detail-tbl">
			<tbody>

				<tr valign="top">
					<th scope="row">
						<label for="wp-tsasp-mdepartment"><?php _e('Member Department', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo wp_tsasp_esc_attr($member_department); ?>" class="large-text wp-tsasp-mdepartment" id="wp-tsasp-mdepartment" name="_member_department" /><br/>
						<span class="description"><?php _e('Enter team member department.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="wp-tsasp-mdesignation"><?php _e('Member Designation', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo wp_tsasp_esc_attr($member_designation); ?>" class="large-text wp-tsasp-mdesignation" id="wp-tsasp-mdesignation" name="_member_designation" /><br/>
						<span class="description"><?php _e('Enter team member designation.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="wp-tsasp-mskills"><?php _e('Skills', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo wp_tsasp_esc_attr($member_skills); ?>" class="large-text wp-tsasp-mskills" id="wp-tsasp-mskills" name="_skills" /><br/>
						<span class="description"><?php _e('Enter team member skills.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="wp-tsasp-mexperience"><?php _e('Member Experience', 'wp-team-showcase-and-slider'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo wp_tsasp_esc_attr($member_experience); ?>" class="large-text wp-tsasp-mexperience" id="wp-tsasp-mexperience" name="_member_experience" /><br/>
						<span class="description"><?php _e('Enter team member experience.', 'wp-team-showcase-and-slider'); ?></span>
					</td>
				</tr>

			</tbody>
		</table><!-- end .wp-tsasp-team-detail-tbl -->
	</div><!-- end .wp-tsasp-mdetails -->

	<!-- Social Details Metabox -->
	<div id="wp-tsasp-sdetails" class="wp-tsasp-sdetails wp-tsasp-tab-cnt">
		<table class="form-table wp-tsasp-sdetails-tbl">
			<tbody>

				<?php
				if( !empty($final_social_services) ) {
					foreach ($final_social_services as $social_key => $social_name) {
						
						$social_data = isset($social_services[$social_name]) ? $social_services[$social_name] : '';
						
						if( empty($social_data) ) continue;
						
						$service_name 	= isset($social_data['name']) 	? $social_data['name'] 	: '';
						$service_desc 	= isset($social_data['desc'])	? $social_data['desc'] 	: '';
						$social_val 	= isset($social[$social_name]) 	? $social[$social_name] : '';

						// Older backward competibility
						if( empty($social) ) {

							switch ($social_name) {
								case 'fb_link':
									$social_val = get_post_meta( $post->ID, '_facebook_link', true );
									break;

								case 'gp_link':
									$social_val = get_post_meta( $post->ID, '_google_link', true );
									break;

								case 'li_link':
									$social_val = get_post_meta( $post->ID, '_likdin_link', true );
									break;

								case 'tw_link':
									$social_val = get_post_meta( $post->ID, '_twitter_link', true );
									break;
							}
						}
				?>
						
						<tr valign="top" class="wp-tsasp-social-row">
							<th class="wp-tsasp-sdrag" title="<?php _e('Drag', 'wp-team-showcase-and-slider') ?>">
								<i class="dashicons dashicons-move"></i>
							</th>
							<th scope="row">
								<label for="wp-tsasp-<?php echo $service_name; ?>"><?php echo $service_name; ?></label>
							</th>
							<td>
								<input type="text" name="<?php echo $prefix.'social['.$social_name.']'; ?>" value="<?php echo $social_val; ?>" class="large-text wp-tsasp-<?php echo $service_name; ?>" id="wp-tsasp-<?php echo $service_name; ?>" /><br/>
								<span class="description"><?php echo $service_desc; ?></span>
							</td>
						</tr>

			<?php	}
				}
				?>
			</tbody>
		</table>
	</div><!-- end .wp-tsasp-sdetails -->
	<input type="hidden" value="<?php echo $selected_tab; ?>" class="wp-tsasp-selected-tab" name="<?php echo $prefix; ?>tab" />
</div><!-- end .wp-tsasp-mb-tabs-wrp -->