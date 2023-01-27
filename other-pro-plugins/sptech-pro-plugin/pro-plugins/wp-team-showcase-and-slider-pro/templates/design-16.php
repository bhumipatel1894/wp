<div class="<?php echo $class.' '.$css_class;?>" <?php echo $style_offset;?>>

	<div class="wp-tsasp-team-item wp-tsasp-team-box wp-tsasp-box-effect wp-tsasp-right-left">

		<div class="wp-tsasp-teambox-img wp-tsasp-team-avatar-bg">
				<?php if( $teamfeat_image ) { ?>
					<img class="wp-tsasp-team-avatar" src="<?php echo $teamfeat_image; ?>" alt="<?php _e('Image', 'wp-team-showcase-and-slider'); ?>" />
				<?php } ?>
				<div class="wp-tsasp-info-warp">

					<?php if($popup == 'true') { ?>
						<a class="wp-tsasp-popup-link" href="javascript:void(0);" data-mfp-src="#popup-<?php echo $popup_id; ?>"></a>
					<?php } ?>

					<div class="wp-tsasp-team-info-back">
						<h3><?php the_title(); ?></h3>
						<p>
							<?php
							echo ($member_designation != '' ? $member_designation : '');
							echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
							echo ($member_department != '' ? $member_department : '');
							?>
						</p>

						<?php if( $show_content == 'true' ) { ?>
							<div class="wp-tsasp-member-details">
								<?php if($show_full_content == "false" ) { ?>
									<?php echo wp_tsasp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?>
									<?php } else {
										the_content();
								} ?>
							</div>
						<?php } ?>
						<?php echo wp_tsasp_member_social_meta($post->ID, $social_limit); ?>
					</div>
					
				</div>
		</div>
	</div>
</div>