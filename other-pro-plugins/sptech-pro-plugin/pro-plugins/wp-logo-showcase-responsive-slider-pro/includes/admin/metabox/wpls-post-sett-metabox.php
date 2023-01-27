<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WPLS_META_PREFIX; // Metabox prefix

// Getting saved values
$logo_url 	= get_post_meta( $post->ID, $prefix.'logo_url', true );
$logo_link 	= get_post_meta( $post->ID, 'wplss_slide_link', true );
?>

<table class="form-table wpls-metabox-table">
	<tbody>

		<tr valign="top">
			<th scope="row">
				<label for="wpls-logo-url"><?php _e('Logo Image URL', 'logoshowcase'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo esc_url($logo_url); ?>" class="large-text wpls-logo-url" id="wpls-logo-url" name="<?php echo $prefix; ?>logo_url" /><br/>
				<span class="description"><?php _e('Enter external URL of logo. If you don not want to use an image from your media gallery, you can set an URL for logo image here.', 'logoshowcase'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wpls-logo-link"><?php _e('Logo Link', 'logoshowcase'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo esc_url($logo_link); ?>" class="large-text wpls-logo-link" id="wpls-logo-link" name="<?php echo $prefix; ?>logo_link" /><br/>
				<span class="description"><?php _e('Enter link url for logo. i.e https://www.wponlinesupport.com', 'logoshowcase'); ?></span>
			</td>
		</tr>

	</tbody>

</table><!-- end .wpls-metabox-table -->