<?php
/**
 * Handles Timeline Post Setting Metabox HTML
 *
 * @package WP History and Timeline Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WPHTSP_META_PREFIX; // Metabox prefix

// Getting saved values
$timeline_custom_icon 	= get_post_meta( $post->ID, $prefix.'custom_icon', true );
$featured_icon 			= get_post_meta( $post->ID, $prefix.'timeline_icon', true );
$read_more_link 		= get_post_meta( $post->ID, $prefix.'timeline_link', true );
?>

<table class="form-table wphtsp-post-sett-table">
	<tbody>

		<tr valign="top">
			<th>
				<label for="wphtsp-custom-icon"><?php _e('Timeline Custom Icon', 'timeline-and-history-slider'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $prefix; ?>custom_icon" value="<?php echo wphtsp_esc_attr($timeline_custom_icon ); ?>" id="wphtsp-custom-icon" class="regular-text wphtsp-custom-icon wphtsp-pro-img-upload-input" />
				<input type="button" name="wphtsp_custom_icon" class="button-secondary wphtsp-pro-image-upload" value="<?php _e( 'Upload Image', 'timeline-and-history-slider'); ?>" data-uploader-title="<?php _e('Choose Icon', 'timeline-and-history-slider'); ?>" data-uploader-button-text="<?php _e('Insert Icon', 'timeline-and-history-slider'); ?>" /> <input type="button" name="wphtsp_custom_icon_clear" class="button button-secondary wphtsp-pro-image-clear" value="<?php _e( 'Clear', 'timeline-and-history-slider'); ?>" /> <br />
				<span class="description"><?php _e( 'Upload custom icon that you want to show for your timeline instead of fa icon.', 'timeline-and-history-slider' ); ?></span>
				<?php
					$custom_icon ='';
					if( $timeline_custom_icon ) {
						$custom_icon = '<img src="'.$timeline_custom_icon .'" alt="" />';
					}
				?>
				<div class="wphtsp-pro-img-view"><?php echo $custom_icon; ?></div>
			</td>
		</tr>

		<tr valign="top">
			<th>
				<label for="wphtsp-icon"><?php _e('Timeline Fa Icon', 'timeline-and-history-slider'); ?></label>
			</th>
			<td>
				<input type="text" value="<?php echo wphtsp_esc_attr($featured_icon); ?>" class="large-text wphtsp-icon" id="wphtsp-icon" name="<?php echo $prefix; ?>timeline_icon" /><br/>
				<span class="description"><?php _e('For example :', 'timeline-and-history-slider'); ?> fa fa-bluetooth-b</span><br/>
				<span class="description"><?php _e('Get icon class details : <a href="https://fortawesome.github.io/Font-Awesome/icons/" target="_blank"> Font Awesome</a>', 'timeline-and-history-slider'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th>
				<label for="wphtsp-more-link"><?php _e('Read More Link', 'timeline-and-history-slider'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo wphtsp_esc_attr($read_more_link); ?>" class="large-text wphtsp-more-link" id="wphtsp-more-link" name="<?php echo $prefix; ?>timeline_link" /><br/>
				<span class="description"><?php _e('Enter read more link. You can add external link also. Leave empty to use default post link. ie http://wponlinesupport.com/', 'timeline-and-history-slider'); ?></span>
			</td>
		</tr>

	</tbody>
</table><!-- end .wtwp-tstmnl-table -->