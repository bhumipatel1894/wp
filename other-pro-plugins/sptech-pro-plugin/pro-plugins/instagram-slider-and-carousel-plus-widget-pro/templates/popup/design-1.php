<div id="wp-iscwp-popup-<?php echo $unique.'-'.$count; ?>" class="wp-iscwp-popup-box wp-iscwp-<?php echo $design; ?>-popup iscwp-popup-design-1 wp-iscwp-popup-content mfp-hide">

	<a href="javascript:void(0);" class="wp-iscwp-popup-close wp-iscwp-close-btn mfp-close" title="<?php _e('Close (Esc)', 'instagram-slider-and-carousel-plus-widget'); ?>"></a>

	<div class="iscwp-left-panel">
		<?php if( $data_type == 'video' && !empty($iscwp_data['video_url']) ) { ?>
			<video id="iscwp-player-<?php echo $count;?>" class="iscwp-video" controls preload="false" poster="<?php echo $gallery_img_src; ?>">
				<source src="<?php echo $iscwp_data['video_url']; ?>" type="video/mp4"></source>
			</video>
		<?php } else { ?>
			<img class="iscwp-popup-img" src="<?php echo $gallery_img_src; ?>" alt="" />
		<?php } ?>
	</div>

	<div class="iscwp-right-panel">
		<div class="iscwp-right-wrap">

			<div class="iscwp-user-head-box">
				<?php if( $popup_user_avatar || $popup_insta_link ) { ?>
				<div class="iscwp-user-head-box-inner">
					<?php if($popup_user_avatar) { ?>
					<a class="iscwp-user-img" href="<?php echo $instagram_link_main.$username;?>" target="<?php echo $link_target;?>">
						<img src="<?php echo $userdata['profile_picture'];?>" class="iscwp-img-user" alt="<?php _e('Profile Picture', 'instagram-slider-and-carousel-plus-widget'); ?>" />
					</a>

					<a href="<?php echo $instagram_link_main.$username; ?>" class="iscwp-username <?php if(!$popup_user_avatar) { echo 'iscwp-no-avatar'; } ?>" target="<?php echo $link_target;?>"><?php echo $userdata['username'];?></a>
					<?php } ?>

					<?php if($popup_insta_link) { ?>
					<div class="iscwp-insta-link-wrap">
						<a href="<?php echo $instagram_link;?>" class="iscwp-view-on-insta-link" target="<?php echo $link_target;?>"><?php esc_html_e($instagram_link_text); ?></a>
					</div>
					<?php } ?>
				</div>
				<?php } ?>

				<div class="iscwp-popup-meta">
					<?php if($show_likes_count == 'true') { ?>
						<div class="iscwp-popup-meta-row iscwp-popup-heart">
							<span class="likes"> <i class="fa fa-heart"></i> <?php echo $iscwp_likes; ?></span>
						</div>
					<?php }

					if($show_comments_count == 'true') { ?>
						<div class="iscwp-popup-meta-row  iscwp-popup-heart-comment">
							<span class="comments"> <i class="fa fa-comment"></i> <?php echo $iscwp_comments; ?></span>
						</div>
					<?php } ?>

					<?php if(!empty($location)) { ?>
						<div class="iscwp-popup-meta-row">
							<span class="location">
								<i class="fa fa-map-marker"></i> <?php echo $location; ?>
							</span>
						</div>
					<?php } ?>
				</div>

				<?php if( isset($img_caption) && $show_caption == 'true') { ?>
				<div class="iscwp-caption-text"><?php echo $img_caption; ?></div>
				<?php } ?>
			</div>

			<div class="iscwp-comments-box">
				<?php if($show_comments== 'true' && !empty($comment_data)) { ?>
					<div class="iscwp-popup-comments">
						<ul class="iscwp-popup-comments-listing iscwp-clearfix">
							<?php foreach ($comment_data as $cmt_key => $cmt_value) { ?>

								<li class="iscwp-row iscwp-clearfix">
									<div class="iscwp-comment-detail" id="iscwp-comment-detail-<?php echo $cmt_key;?>">
										<a class="iscwp-user-img" href="<?php echo $instagram_link_main.$cmt_value['username'];?>" target="<?php echo $link_target;?>">
											<img src="<?php echo $cmt_value['profile_picture'];?>" alt="<?php _e('Profile Picture', 'instagram-slider-and-carousel-plus-widget'); ?>">
										</a>

										<div class="iscwp-comment-right">
											<div class="iscwp-username-wrp">
												<a href="<?php echo $instagram_link_main.$cmt_value['username'];?>" target="<?php echo $link_target;?>">
													<span class="iscwp-username"><?php echo $cmt_value['username'];?></span>
												</a>
											</div>

											<div class="iscwp-comment-description">
												<?php echo $cmt_value['comment_text'];?>
											</div>
										</div>
									</div>
								</li>

							<?php } ?>
						</ul>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>