<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package WP Responsive Recent Post Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WPRPSP_META_PREFIX; // Metabox prefix

// Getting saved values
$read_more_link = get_post_meta( $post->ID, $prefix.'more_link', true );
?>

<table class="form-table wprpsp-post-sett-table">
	<tbody>

		<tr valign="top">
			<th scope="row">
				<label for="wprpsp-more-link"><?php _e('Read More Link', 'wp-responsive-recent-post-slider'); ?></label>
			</th>
			<td>
				<input type="url" value="<?php echo esc_url($read_more_link); ?>" class="large-text wprpsp-more-link" id="wprpsp-more-link" name="<?php echo $prefix; ?>more_link" /><br/>
				<span class="description"><?php _e('If you have different URL then enter read more link for post or Leave empty for current post URL.', 'wp-responsive-recent-post-slider'); ?></span>
			</td>
		</tr>

	</tbody>
</table><!-- end .wtwp-tstmnl-table -->