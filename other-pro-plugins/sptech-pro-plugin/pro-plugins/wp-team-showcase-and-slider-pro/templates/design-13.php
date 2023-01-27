<?php
if(!empty($teamfeat_image))
{
	$team_back_image= "background:url('".$teamfeat_image."') no-repeat scroll center center";
}else{
	$team_back_image='';
}

?>
<div class="<?php echo $class.' '.$css_class;?>" <?php echo $style_offset;?>>				
	<div class="wp-tsasp-team-member">

		<div class="wp-tsasp-inr-wrp">

			<div class="wp-tsasp-team-img" style="<?php echo $team_back_image; ?>">
				<?php if($popup == 'true') { ?>
				<a class="wp-tsasp-team-info-icon wp-tsasp-popup-link" href="javascript:void(0);" data-mfp-src="#popup-<?php echo $popup_id; ?>"></a>
				<?php } ?>
			</div>

			<?php echo wp_tsasp_member_social_meta($post->ID, $social_limit); ?>

		</div>

		<div class="wp-tsasp-team-detail wp-tsasp-text-center">
			<div class="wp-tsasp-team-name"><?php the_title(); ?></div>

			<?php if($member_designation != '' || $member_department!= ''){ ?>
			<div class="wp-tsasp-team-data">
				<?php
				echo ($member_designation != '' ? $member_designation : '');
				echo ($member_designation != '' && $member_department != '' ? ' - ' : '');
				echo ($member_department != '' ? $member_department : '');
				?>
			</div>
			<?php } ?>
		</div>
	</div>
</div>