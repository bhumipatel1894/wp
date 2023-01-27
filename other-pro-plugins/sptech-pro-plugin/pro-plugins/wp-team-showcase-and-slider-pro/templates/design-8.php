<div class="<?php echo $class.' '.$css_class;?>" <?php echo $style_offset;?>>
	<div class="wp-tsasp-team-member">

		<div class="wp-tsasp-team-cnt-wrp">

			<div class="wptsas-medium-6 wptsas-columns wp-tsasp-team-img-col">
				<div class="wp-tsasp-team-img wp-tsasp-team-avatar-bg">
					<?php if ( $teamfeat_image ) { ?>
					<img class="wp-tsasp-team-avatar" src="<?php echo $teamfeat_image; ?>" alt="<?php _e('Image', 'wp-team-showcase-and-slider'); ?>" />
					<?php } ?>

					<?php if($popup == 'true') { ?>
					<div class="wp-tsasp-link-outer">
						<a class="wp-tsasp-popup-link" href="javascript:void(0);" data-mfp-src="#popup-<?php echo $popup_id; ?>"><i class="fa fa-plus-circle"></i></a>
					</div>
					<?php } ?>
				</div>
			</div>

			<div class="wptsas-medium-6 wptsas-columns wp-tsasp-text-center wp-tsasp-team-content-col">
				<div class="wp-tsasp-content-outer">
					<div class="wp-tsasp-team-detail">

						<div class="wp-tsasp-team-name"><?php the_title(); ?></div>

						<?php if($member_designation != '' || $member_department!= '') { ?>
						<div class="wp-tsasp-team-data">
							<?php
							echo ($member_designation != '' ? $member_designation : ''); 
							echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
							echo ($member_department != '' ? $member_department : '');
							?>
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
						<?php } ?>

						<?php echo wp_tsasp_member_social_meta($post->ID, $social_limit); ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>