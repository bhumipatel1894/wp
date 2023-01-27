<div class="<?php echo $class.' '.$css_class;?>" <?php echo $style_offset;?>>

	<div class="wp-tsasp-team-member">
		<div class="wp-tsasp-team-img wp-tsasp-team-avatar-bg">
			<?php if ( $teamfeat_image ) { ?>
			<img class="wp-tsasp-team-avatar" src="<?php echo $teamfeat_image; ?>" alt="<?php _e('Image', 'wp-team-showcase-and-slider'); ?>" />
			<?php } ?>

			<?php if($popup == 'true') { ?>
			<a class="wp-tsasp-team-info-icon wp-tsasp-popup-link" href="javascript:void(0);" data-mfp-src="#popup-<?php echo $popup_id; ?>"></a>
			<?php } ?>
		</div>

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
			<?php }
			echo wp_tsasp_member_social_meta($post->ID, $social_limit);
			?>
		</div>

	</div>

</div>