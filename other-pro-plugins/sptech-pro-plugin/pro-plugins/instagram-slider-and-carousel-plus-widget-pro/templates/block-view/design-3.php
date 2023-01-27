<?php
$gallery_height 	= ($gallery_height) 	? $gallery_height : 400;
$dynamic_height 	= ($grid_count == 1) ? $gallery_height : ($gallery_height/2);
$height_css 		= ($dynamic_height) 	? "height:{$dynamic_height}px;" : '';
$main_cls 			= "iscwp-cnt-wrp iscwp-bglay-{$grid_count} iscwp-block-columns iscwp-block-4";
?>
<div class="<?php echo $main_cls; ?>" data-item-index="<?php echo $grid_count; ?>">
	<div class="iscwp-inr-wrp" style="<?php echo $height_css ?>">
		<div class="iscwp-img-wrp">

			<img class="iscwp-img" src="<?php echo $gallery_img_src ?>" alt="" />

			<div class="iscwp-meta">
				<?php if($show_likes_count =='true' || $show_comments_count == 'true') { ?>
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
				<?php } ?>
			</div>
			<a class="iscwp-img-link" href="<?php echo $iscwp_link_value; ?>" target="<?php echo $link_target;?>" data-mfp-src="<?php echo "#wp-iscwp-popup-{$unique}-{$count}"; ?>"></a>
		</div>
	</div>
</div>
<?php if( $grid_count == 5 ) {
	$grid_count = 0;
} ?>