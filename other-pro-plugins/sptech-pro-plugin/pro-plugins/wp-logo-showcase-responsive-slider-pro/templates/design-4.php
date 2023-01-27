<?php
/**
 * `logoshowcase` Design 4 Shortcodes HTML
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>

<div class="wpls-logo-cnt <?php echo $cnt_wrp_cls; ?>" title="<?php the_title(); ?>">
	<div class="single-logo">
		<div class="logo-container">

			<div class="wpls-fix-box">
				<?php if ($logourl != '') { ?>

					<a href="<?php echo $logourl; ?>" target="<?php echo $link_target; ?>">
						<img class="wp-post-image" src="<?php echo $feat_image; ?>" alt="<?php _e('Logo Image', 'logoshowcase'); ?>" />
					</a>

				<?php } else { ?>
					
					<img class="wp-post-image" src="<?php echo $feat_image; ?>" alt="<?php _e('Logo Image', 'logoshowcase'); ?>" />

				<?php } ?>
			</div><!-- end .wpls-fix-box -->

			<?php if($show_title == "true") { ?> 	
			<div class="logo-title"><?php the_title(); ?></div>
			<?php } ?>
			
			<div class="logo-description">
			<?php echo wpls_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?>
			</div>
			
		</div><!-- end .logo-container -->
	</div><!-- end .single-logo -->
</div><!-- end .wpls-logo-cnt -->