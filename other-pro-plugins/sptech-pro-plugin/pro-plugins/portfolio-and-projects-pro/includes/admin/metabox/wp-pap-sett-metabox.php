<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WP_PAP_PRO_META_PREFIX; // Metabox prefix

// Getting meta values
$gallery_imgs 	= get_post_meta( $post->ID, $prefix.'gallery_id', true );
$project_url 	= get_post_meta( $post->ID, $prefix.'project_url', true );

// Slider meta
$arrow_slider 				= get_post_meta( $post->ID, $prefix.'arrow_slider', true );
$pagination_slider 			= get_post_meta( $post->ID, $prefix.'pagination_slider', true );
$animation_slider 			= get_post_meta( $post->ID, $prefix.'animation_slider', true );
$slide_to_show_slider 		= get_post_meta( $post->ID, $prefix.'slide_to_show_slider', true );
$loop_slider 				= get_post_meta( $post->ID, $prefix.'loop_slider', true );
$autoplay_slider 			= get_post_meta( $post->ID, $prefix.'autoplay_slider', true );
$autoplayspeed_slider 		= get_post_meta( $post->ID, $prefix.'autoplayspeed_slider', true );
$speed_slider 				= get_post_meta( $post->ID, $prefix.'speed_slider', true );

$no_img_cls					= !empty($gallery_imgs) 			? 'wp-pap-hide' 		: '';
$arrow_slider 				= ($arrow_slider != '') 			? $arrow_slider 		: 1;
$pagination_slider 			= ($pagination_slider != '') 		? $pagination_slider 	: 1;
$loop_slider 				= ($loop_slider != '') 				? $loop_slider 			: 1;
$autoplay_slider 			= ($autoplay_slider != '') 			? $autoplay_slider 		: 1;
$slide_to_show_slider 		= (!empty($slide_to_show_slider)) 	? $slide_to_show_slider : 1;
$autoplayspeed_slider 		= (!empty($autoplayspeed_slider)) 	? $autoplayspeed_slider : 3000 ;
$speed_slider 				= (!empty($speed_slider)) 			? $speed_slider 		: 300 ;
?>

<table class="form-table wp-pap-post-sett-table">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-project-link"><?php _e('Portfolio Link', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="url" id="wp-pap-project-link" class="large-text wp-pap-project-link" name="<?php echo $prefix ?>project_url" value="<?php echo wp_pap_pro_esc_attr($project_url); ?>"><br/>
				<span class="description"><?php _e('Enter portfolio link.', 'portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-gallery-imgs"><?php _e('Choose Portfolio Gallery Images', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<button type="button" class="button button-secondary wp-pap-img-uploader" id="wp-pap-gallery-imgs" data-multiple="true" data-button-text="<?php _e('Add to Gallery', 'portfolio-and-projects'); ?>" data-title="<?php _e('Add Images to Gallery', 'portfolio-and-projects'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php _e('Gallery Images', 'portfolio-and-projects'); ?></button>
				<button type="button" class="button button-secondary wp-pap-del-gallery-imgs"><i class="dashicons dashicons-trash"></i> <?php _e('Remove Gallery Images', 'portfolio-and-projects'); ?></button><br/>
				
				<div class="wp-pap-gallery-imgs-prev wp-pap-imgs-preview wp-pap-gallery-imgs-wrp">
					<?php if( !empty($gallery_imgs) ) {
						foreach ($gallery_imgs as $img_key => $img_data) {

							$attachment_url 		= wp_get_attachment_thumb_url( $img_data );
							$attachment_edit_link	= get_edit_post_link( $img_data );
					?>
							<div class="wp-pap-img-wrp">
								<div class="wp-pap-img-tools wp-pap-hide">
									<span class="wp-pap-tool-icon wp-pap-edit-img dashicons dashicons-edit" title="<?php _e('Edit Image in Popup', 'portfolio-and-projects'); ?>"></span>
									<a href="<?php echo $attachment_edit_link; ?>" target="_blank" title="<?php _e('Edit Image', 'portfolio-and-projects'); ?>"><span class="wp-pap-tool-icon wp-pap-edit-attachment dashicons dashicons-visibility"></span></a>
									<span class="wp-pap-tool-icon wp-pap-del-tool wp-pap-del-img dashicons dashicons-no" title="<?php _e('Remove Image', 'portfolio-and-projects'); ?>"></span>
								</div>
								<img class="wp-pap-img" src="<?php echo $attachment_url; ?>" alt="" />
								<input type="hidden" class="wp-pap-attachment-no" name="wp_pap_img[]" value="<?php echo $img_data; ?>" />
							</div><!-- end .wp-pap-img-wrp -->
					<?php }
					} ?>
					<p class="wp-pap-img-placeholder <?php echo $no_img_cls; ?>"><?php _e('No Gallery Images', 'portfolio-and-projects'); ?></p>
				</div><!-- end .wp-pap-imgs-preview -->
				<span class="description"><?php _e('Choose your desired images for gallery. Hold Ctrl key to select multiple images at a time.', 'portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr>
			<th colspan="2">
				<div class="wp-pap-sett-title"><?php _e('Portfolio Gallery Slider Settings', 'portfolio-and-projects'); ?></div>
			</th>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-arrow"><?php _e('Slider Arrow', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="checkbox" value="1" name="<?php echo $prefix; ?>arrow_slider" id="wp-pap-slider-arrow" class="wp-pap-slider-arrow" <?php checked( 1, $arrow_slider ); ?> /><br/>
				<span class="description"><?php _e('Check this box to enable gallery slider arrow.','portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-pagination"><?php _e('Slider Pagination Dots', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="checkbox" name="<?php echo $prefix; ?>pagination_slider" value="1" id="wp-pap-slider-pagination" class="wp-pap-slider-pagination" <?php checked( 1, $pagination_slider ); ?> /><br/>
				<span class="description"><?php _e('Check this box to enable gallery slider pagination dots.','portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-autoplay"><?php _e('Slider Autoplay', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="checkbox" name="<?php echo $prefix; ?>autoplay_slider" value="1" id="wp-pap-slider-autoplay" class="wp-pap-slider-autoplay" <?php checked( 1, $autoplay_slider ); ?> /><br/>
				<span class="description"><?php _e('Check this box to enable slider autoplay.','portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-loop"><?php _e('Slider Loop', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="checkbox" name="<?php echo $prefix; ?>loop_slider" value="1" id="wp-pap-slider-loop" class="wp-pap-slider-loop" <?php checked( 1, $loop_slider ); ?> /><br/>
				<span><?php _e('Check this box to run slider continuously.','portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-slides"><?php _e('Slide to Show', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="number" name="<?php echo $prefix; ?>slide_to_show_slider" value="<?php echo $slide_to_show_slider; ?>" id="wp-pap-slider-slides" class="wp-pap-slider-slides small-text" step="1" min="1" /><br/>
				<span class="description"><?php _e('Enter number of slides to show at a time.','portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-autoplay-interval"><?php _e('Autoplay Interval', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="number" name="<?php echo $prefix; ?>autoplayspeed_slider" value="<?php echo $autoplayspeed_slider; ?>" id="wp-pap-autoplay-interval" class="small-text wp-pap-autoplay-interval" step="100" min="0" /> <?php _e('Milisecond', 'portfolio-and-projects'); ?><br/>
				<span class="description"><?php _e('Enter slider autoplay interval.','portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-speed"><?php _e('Speed', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<input type="number" name="<?php echo $prefix; ?>speed_slider" value="<?php echo $speed_slider; ?>" id="wp-pap-slider-speed" class="wp-pap-slider-speed small-text" step="50" min="0" /><br/>
				<span class="description"><?php _e('Enter slider speed.', 'portfolio-and-projects'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<th scope="row">
				<label for="wp-pap-slider-effect"><?php _e('Effect', 'portfolio-and-projects'); ?></label>
			</th>
			<td>
				<select name="<?php echo $prefix; ?>animation_slider" id="wp-pap-slider-effect" class="wp-pap-slider-effect">
					<option value="slide" <?php if($animation_slider == 'slide'){echo 'selected'; } ?>><?php _e('Slide','portfolio-and-projects'); ?></option>
					<option value="fade" <?php if($animation_slider == 'fade'){echo 'selected'; } ?>><?php _e('Fade','portfolio-and-projects'); ?></option>
				</select><br/>
				<span class="description"><?php _e('Select slider effect. Note: Slider `fade` effect only works when `Slide to Show` is set to 1.', 'portfolio-and-projects'); ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .wtwp-tstmnl-table -->