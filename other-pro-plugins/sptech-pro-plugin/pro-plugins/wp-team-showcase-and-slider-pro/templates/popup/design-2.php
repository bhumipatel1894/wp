<div id="popup-<?php echo $popup_id; ?>" class="wp-tsasp-popup-box wptsas-popup-design-2 <?php echo $popup_cls; ?> wp-tsasp-popup-content wptsasp-clearfix mfp-hide">

	<div class="dv-panel-right">
		<a href="javascript:void(0);" class="wp-tsasp-popup-close wp-tsasp-close-btn mfp-close" title="<?php _e('Close (Esc)', 'wp-team-showcase-and-slider') ?>"></a>
		<div class="wptsas-medium-6 wptsas-columns">

			<div class="wp-tsasp-popup-header wp-tsasp-team-avatar-bg">

				<?php if( $teamfeat_image ) { ?>
				<img class="wp-tsasp-team-avatar" src="<?php echo $teamfeat_image ?>" alt="<?php _e('Team Image', 'wp-team-showcase-and-slider'); ?>" />
				<?php } ?>

				<div class="wp-tsasp-popup-member-info">

					<div class="wp-tsasp-popup-member-name"><?php the_title(); ?></div>	

					<?php if($member_designation != '' || $member_department!= '') { ?>
					<div class="wp-tsasp-popup-member-job">

						<?php echo ($member_designation != '' ? $member_designation : '');
						echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
						echo ($member_department != '' ? $member_department : ''); ?>
					</div><?php
				} ?>
				<?php if($skills != '' || $member_experience != '') { ?>
				<div class="wp-tsasp-member-info"><?php

					echo ($skills != '' ? $skills : '');
					echo ($skills != '' && $member_experience != '' ? ' - ' : '');
					echo ($member_experience != '' ? $member_experience : ''); ?>
					</div>
				<?php } ?>
			</div>
		</div>

		<div class="wptsas-img-bottom-info">
			<?php echo wp_tsasp_member_social_meta($post->ID, 'all'); ?>
		</div>

	</div>

	<div class="wptsas-medium-6 wptsas-columns">
		<div class="wp-tsasp-popup-body">
			<?php the_content(); ?>
		</div>
	</div>

</div>
</div>