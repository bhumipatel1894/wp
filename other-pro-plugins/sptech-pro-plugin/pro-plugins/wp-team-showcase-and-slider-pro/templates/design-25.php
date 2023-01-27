<div class="<?php echo $class.' '.$css_class;?>" <?php echo $style_offset;?>>
	<div class="wp-tsasp-team-block">

		<div class="wp-tsasp-team-member">
			<div class="wp-tsasp-team-img  wp-tsasp-team-avatar-bg">
				<?php if ( $teamfeat_image ) { ?>
				<img class="wp-tsasp-team-avatar" src="<?php echo $teamfeat_image; ?>" alt="<?php _e('Image', 'wp-team-showcase-and-slider'); ?>" />
				<?php } ?>

				<div class="wp-tsasp-member-fix-bottom">
					<div class="wp-tsasp-team-img-name"><?php the_title(); ?></div>
					<div class="wp-tsasp-member-designation"><?php echo ($member_designation != '' ? $member_designation : ''); ?></div>
				</div>
			</div>

			<div class="wp-tsasp-link-outer">
				<?php if($popup == 'true') { ?>
					<a class="wp-tsasp-team-info-icon wp-tsasp-popup-link" href="javascript:void(0);" data-mfp-src="#popup-<?php echo $popup_id; ?>"></a>
				<?php } ?>
				<div class="wp-tsasp-team-detail">
					<div class="wp-tsasp-team-detail-inr">
						<div class="wp-tsasp-team-name"><?php the_title(); ?></div>
						<?php if($member_designation != '' || $member_department!= '') { ?>
						<div class="wp-tsasp-team-data">
							<?php
							echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
							echo ($member_department != '' ? $member_department : '');
							?>
						</div>
						<?php } ?>

						<?php if( $show_content == 'true' ) { ?>
						<div class="wp-tsasp-member-details">
							<?php if($show_full_content == "false" ) { ?>
							<div class="wp-tsasp-member-brief-desc"><?php echo wp_tsasp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
							<?php } else { 
								the_content();
							} ?>
						</div>
						<?php } ?>

						<?php if($skills != '' || $member_experience != '') { ?>
						<div class="wp-tsasp-member-info">
							<?php
							echo ($skills != '' ? $skills : '');
							echo ($skills != '' && $member_experience != '' ? ' - ' : '');
							echo ($member_experience != '' ? $member_experience : '');
							?>
						</div>
						<?php }
						echo wp_tsasp_member_social_meta($post->ID, $social_limit);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>