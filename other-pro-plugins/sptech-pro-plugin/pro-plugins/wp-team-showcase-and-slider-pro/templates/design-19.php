<div class="<?php echo $class.' '.$css_class;?>" <?php echo $style_offset;?>>

	<div class="wp-tsasp-team-item wp-tsasp-box-effect wp-tsasp-top-bottom">

		<a class="wp-tsasp-popup-link" href="javascript:void(0);" data-mfp-src="#popup-<?php echo $popup_id; ?>"></a>

		<div class="wp-tsasp-teambox-img wp-tsasp-team-avatar-bg">
			<?php if( $teamfeat_image ) { ?>
			<img class="wp-tsasp-team-avatar" src="<?php echo $teamfeat_image; ?>" alt="<?php _e('Image', 'wp-team-showcase-and-slider'); ?>" />
			<?php } ?>
		</div>

		<div class="wp-tsasp-info-warp">
			<div class="wp-tsasp-team-info-back">

				<h3><?php the_title(); ?></h3>
				<p>
					<?php
					echo ($member_designation != '' ? $member_designation : '');
					echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
					echo ($member_department != '' ? $member_department : '');
					?>
				</p>
			</div>
		</div>
		<?php echo wp_tsasp_member_social_meta($post->ID, $social_limit); ?>
	</div>
</div>