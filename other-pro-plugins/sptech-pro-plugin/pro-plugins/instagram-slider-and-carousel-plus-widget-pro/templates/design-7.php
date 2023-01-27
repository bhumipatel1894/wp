<div class="<?php echo $wrpper_cls; ?>" style="<?php echo $offset_css; ?>" data-item-index="<?php echo $count; ?>">
	<div class="iscwp-inr-wrp">
		<div class="iscwp-img-wrp" style="<?php echo $height_css; ?>">

			<img class="iscwp-img" src="<?php echo $gallery_img_src ?>" alt="" />

			<?php if($show_likes_count =='true' || $show_comments_count == 'true') { ?>
			<div class="iscwp-meta">
				<div class="iscmp-meta-mid-wrap">
					<div class="iscwp-meta-inner-wrap">
						<?php if($show_likes_count == 'true' && $iscwp_likes > 0) { ?>
						<div class="iscwp-likes-num <?php if($iscwp_comments <= 0) { echo 'iscwp-only-likes'; } ?>">
							<i class="fa fa-heart faa-pulse animated"></i> <span class="iscwp-like-count"><?php echo $iscwp_likes;?></span>
						</div>
						<?php } ?>

						<?php if($show_comments_count == 'true' && $iscwp_comments > 0) { ?>
						<div class="iscwp-meta-comment">
							<i class="fa fa-comment"></i> <span class="iscwp-cmnt-count"><?php echo $iscwp_comments; ?></span>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>
			<?php } ?>
			<a class="iscwp-img-link" href="<?php echo $iscwp_link_value; ?>" target="<?php echo $link_target;?>" data-mfp-src="<?php echo "#wp-iscwp-popup-{$unique}-{$count}"; ?>"></a>
			<div class="iscwp-extra-brdr"></div>
		</div>
	</div>
</div>