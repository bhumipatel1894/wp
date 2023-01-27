<?php
/**
 * Templates Functions
 *
 * Handles to manage templates of plugin
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Handles the team member social profiles
 * 
 * @package WP Team Showcase and Slider Pro
 * @since 1.0.0
 */
function wp_tsasp_member_social_meta( $post_id = '', $limit = 6 ) {

	// Taking some variables
	$social_html 		= '';
	$social_inr_html	= '';
	$count 				= 1;

	if( empty($post_id) || empty($limit) ) {
		return $social_html;
	}

	$prefix = WP_TSASP_META_PREFIX; // Metabox prefix

	$social_services 	= wp_tsasp_social_scrvices(); // Getting social service
	$social 			= get_post_meta( $post_id, $prefix.'social', true );
	$social 			= !empty($social) ? $social : array();

	$system_social_services = array_keys($social_services);
	$stored_social_services = array_keys($social);
	$final_social_services 	= array_unique( $stored_social_services + $system_social_services );

	// If social meta are not empty
	if( !empty($final_social_services) ) {
		foreach ($final_social_services as $s_key => $s_val) {

			$social_link = isset($social[$s_val]) ? $social[$s_val] : '';
			
			// Older backward competibility
			if( empty($social) ) {
				
				switch ($s_val) {
					case 'fb_link':
						$social_link = get_post_meta( $post_id, '_facebook_link', true );
						break;

					case 'gp_link':
						$social_link = get_post_meta( $post_id, '_google_link', true );
						break;

					case 'li_link':
						$social_link = get_post_meta( $post_id, '_likdin_link', true );
						break;

					case 'tw_link':
						$social_link = get_post_meta( $post_id, '_twitter_link', true );
						break;
				}
			}
			
			if( empty($social_link) ) continue;
			
			$social_data 	= isset($social_services[$s_val]) ? $social_services[$s_val] : '';
			$fa_icon 		= isset($social_data['icon']) ? $social_data['icon'] : 'fa fa-link';
			$social_link 	= ( $s_val == 'mail' ) ? 'mailto:'.$social_link : esc_url($social_link);

			$social_inr_html .= '
							<li>
								<a href="'.esc_url($social_link).'" target="_blank">
									<i class="'.$fa_icon.'"></i>
								</a>
							</li>';
			
			// Limit no of social links
			if( $limit != 'all' && $limit == $count ) {
				break;
			}

			$count++;

		} // End of for each

		// Wrapping the HTML
		if( !empty($social_inr_html) ) {
			$social_html .= '<div class="wp-tsasp-member-social">
								<ul>'.$social_inr_html.'</ul>
							</div><!-- end .wp-tsasp-member-social -->';
		}

	} // End of if

	return $social_html;
}