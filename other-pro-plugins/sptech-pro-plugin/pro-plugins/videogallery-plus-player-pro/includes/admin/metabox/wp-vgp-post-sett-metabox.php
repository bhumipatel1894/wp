<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package Video gallery and Player Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WP_VGP_META_PREFIX; // Metabox prefix

// Getting saved values
$selected_tab 	= get_post_meta($post->ID, $prefix.'tab', true);
$poster_img 	= get_post_meta($post->ID, $prefix.'poster_img', true);
$video_mp4 		= get_post_meta($post->ID, $prefix.'video_mp4', true);
$video_wbbm 	= get_post_meta($post->ID, $prefix.'video_wbbm', true);
$video_ogg 		= get_post_meta($post->ID, $prefix.'video_ogg', true);
$video_yt 		= get_post_meta($post->ID, $prefix.'video_yt', true);
$video_vm 		= get_post_meta($post->ID, $prefix.'video_vm', true);
$video_dly 		= get_post_meta($post->ID, $prefix.'video_dly', true);
$video_oth 		= get_post_meta($post->ID, $prefix.'video_oth', true);
?>

<table class="form-table wp-vgp-meta-sett-tbl">
	<tbody>
		<tr valign="top">
			<th scope="row">
				<label for="wp-vgp-poster-img"><?php _e('External Video Poster Image', 'html5-videogallery-plus-player'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $prefix; ?>poster_img" value="<?php echo wp_vgp_esc_attr($poster_img); ?>" id="wp-vgp-poster-img" class="large-text wp-vgp-poster-img" /><br/>
				<span class="description"><?php _e( 'Enter external URL of video poster image if you do not want to use `Video Poster Image` (Right hand side).', 'html5-videogallery-plus-player' ); ?></span>
				<?php
					$default_img = '';
					if( !empty($poster_img) ) { 
						$default_img = '<img src="'.$poster_img.'" alt="" />';
					}
				?>
				<div class="wp-vgp-img-view"><?php echo $default_img; ?></div>
			</td>
		</tr>
	</tbody>
</table>

<div class="wp-vgp-mb-tabs-wrp">
	<ul id="wp-vgp-mb-tabs" class="wp-vgp-mb-tabs">
		<li class="wp-vgp-mb-nav wp-vgp-active">
			<a href="#wp-vgp-html5"><?php _e('HTML5', 'html5-videogallery-plus-player'); ?></a>
		</li>
		<li class="wp-vgp-mb-nav">
			<a href="#wp-vgp-yt"><?php _e('YouTube', 'html5-videogallery-plus-player'); ?></a>
		</li>
		<li class="wp-vgp-mb-nav">
			<a href="#wp-vgp-vm"><?php _e('Vimeo', 'html5-videogallery-plus-player'); ?></a>
		</li>
		<li class="wp-vgp-mb-nav">
			<a href="#wp-vgp-dly"><?php _e('Dailymotion', 'html5-videogallery-plus-player'); ?></a>
		</li>
		<li class="wp-vgp-mb-nav">
			<a href="#wp-vgp-oth"><?php _e('Other', 'html5-videogallery-plus-player'); ?></a>
		</li>
	</ul>

	<div id="wp-vgp-html5" class="wp-vgp-html5 wp-vgp-tab-cnt" style="display:block;">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="link-for-mp4"><?php _e('video/mp4', 'html5-videogallery-plus-player'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo esc_attr($video_mp4); ?>" class="large-text" id="link-for-mp4" name="<?php echo $prefix; ?>video_mp4" /><br/>
						<span class="description"><?php _e('ie http://videolink.mp4', 'html5-videogallery-plus-player'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="link-for-webm"><?php _e('video/webm', 'html5-videogallery-plus-player'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo esc_attr($video_wbbm); ?>" class="large-text" id="link-for-webm" name="<?php echo $prefix; ?>video_wbbm" /><br/>
						<span class="description"><?php _e('ie http://videolink.webm', 'html5-videogallery-plus-player'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="link-for-ogg"><?php _e('video/ogg', 'html5-videogallery-plus-player'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo esc_attr($video_ogg); ?>" class="large-text" id="link-for-ogg" name="<?php echo $prefix; ?>video_ogg" /><br/>
						<span class="description"><?php _e('ie http://videolink.ogg', 'html5-videogallery-plus-player'); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div><!-- end .wp-vgp-html5 -->

	<div id="wp-vgp-yt" class="wp-vgp-yt wp-vgp-tab-cnt">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="link-for-youtube"><?php _e('YouTube Link', 'html5-videogallery-plus-player'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo esc_attr($video_yt); ?>" class="large-text" id="link-for-youtube" name="<?php echo $prefix; ?>video_yt" /><br/>
						<span class="description"><?php _e('ie https://www.youtube.com/watch?v=07IRBn1oXrU', 'html5-videogallery-plus-player'); ?></span>
					</td>
				</tr>
			</tbody>
		</table>
	</div><!-- end .wp-vgp-yt -->

	<div id="wp-vgp-vm" class="wp-vgp-vm wp-vgp-tab-cnt">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="link-for-vimeo"><?php _e('Vimeo Link', 'html5-videogallery-plus-player'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo esc_attr($video_vm); ?>" class="large-text" id="link-for-vimeo" name="<?php echo $prefix; ?>video_vm" /><br/>
						<span class="description"><?php _e('ie https://vimeo.com/171807697', 'html5-videogallery-plus-player'); ?></span>
					</td>
				</tr>
			</tbody>
		</table><!-- end .wtwp-tstmnl-table -->
	</div><!-- end .wp-vgp-vm -->
	
	<div id="wp-vgp-dly" class="wp-vgp-dly wp-vgp-tab-cnt">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="wp-vgp-dly-link"><?php _e('Dailymotion Link', 'html5-videogallery-plus-player'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo esc_attr($video_dly); ?>" class="large-text" id="wp-vgp-dly-link" name="<?php echo $prefix; ?>video_dly" /><br/>
						<span class="description"><?php _e('ie http://www.dailymotion.com/video/x2u6iu9_xxxxxxx', 'html5-videogallery-plus-player'); ?></span>
					</td>
				</tr>
			</tbody>
		</table><!-- end .wtwp-tstmnl-table -->
	</div><!-- end .wp-vgp-dly -->

	<div id="wp-vgp-oth" class="wp-vgp-oth wp-vgp-tab-cnt">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="wp-vgp-oth-link"><?php _e('Other Link', 'html5-videogallery-plus-player'); ?></label>
					</th>
					<td>
						<input type="url" value="<?php echo esc_attr($video_oth); ?>" class="large-text" id="wp-vgp-oth-link" name="<?php echo $prefix; ?>video_oth" /><br/>
						<span class="description"><?php _e('Enter embed link of video.', 'html5-videogallery-plus-player'); ?> ie http://view.vzaar.com/XXXXXXX/player</span>
					</td>
				</tr>
			</tbody>
		</table><!-- end .wtwp-tstmnl-table -->
	</div><!-- end .wp-vgp-oth -->

	<input type="hidden" value="<?php echo $selected_tab; ?>" class="wp-vgp-selected-tab" name="<?php echo $prefix; ?>tab" />
</div><!-- end .wp-vgp-mb-tabs-wrp -->