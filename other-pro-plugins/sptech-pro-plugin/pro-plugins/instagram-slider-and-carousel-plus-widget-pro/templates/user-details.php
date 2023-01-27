<?php if(!empty($instagram_data['iscwp_user_data'])){
	$user_info_user_name	= (isset($instagram_data['iscwp_user_data']['username']) && $instagram_data['iscwp_user_data']['username']) ? $instagram_data['iscwp_user_data']['username'] : '' ;
	$user_info_name 		= (isset($instagram_data['iscwp_user_data']['full_name']) && $instagram_data['iscwp_user_data']['full_name']) ? $instagram_data['iscwp_user_data']['full_name'] : '' ;
	$user_info_img 			= (isset($instagram_data['iscwp_user_data']['profile_pic_url']) && $instagram_data['iscwp_user_data']['profile_pic_url']) ? $instagram_data['iscwp_user_data']['profile_pic_url'] : '' ;
	$following_count 		= (isset($instagram_data['iscwp_user_data']['follows_count']) && $instagram_data['iscwp_user_data']['follows_count']) ? $instagram_data['iscwp_user_data']['follows_count'] : '' ;
	$media_count 			= (isset($instagram_data['iscwp_user_data']['media_count']) && $instagram_data['iscwp_user_data']['media_count']) ? $instagram_data['iscwp_user_data']['media_count'] : '' ;
	$followers_count 		= (isset($instagram_data['iscwp_user_data']['followed_by']) && $instagram_data['iscwp_user_data']['followed_by']) ? $instagram_data['iscwp_user_data']['followed_by'] : '' ;
	$user_bniography 		= (isset($instagram_data['iscwp_user_data']['biography']) && $instagram_data['iscwp_user_data']['biography']) ? $instagram_data['iscwp_user_data']['biography'] : '' ;
	?>

	<div class="iscwp-user-info-main-wrap">

		<div class="iscwp-user-info-img">

			<div class="iscwp-user-img-wrp">

				<img src="<?php echo $user_info_img; ?>">
			</div>
		</div>

		<div class="iscwp-user-info-content-wrp">

			<div class="iscwp-user-info-username">
				<div class="iscwp-uname"><?php echo $user_info_user_name; ?></div>
				<div class="iscwp-follow-btn-wrap"><a href="<?php echo $instagram_link_main.$user_info_user_name; ?>" class="iscwp-follow-btn" target="<?php $link_target ?>"><?php _e('Follow','instagram-slider-and-carousel-plus-widget')?></a></div>
			</div>
			<div class="iscwp-user-details">
				<div class="iscwp-user-media">
					<span class="iscwp-umedia-number"><?php echo iscwp_pro_nice_number($media_count); ?></span> <span class="iscwp-ustatic-word"> <?php _e('posts','instagram-slider-and-carousel-plus-widget')?></span>
				</div>

				<div class="iscwp-user-followers">
					<span class="iscwp-umedia-number"><?php echo iscwp_pro_nice_number($followers_count); ?></span> <span class="iscwp-ustatic-word"><?php _e('followers','instagram-slider-and-carousel-plus-widget')?></span>
				</div>

				<div class="iscwp-user-followedby">
					<span class="iscwp-umedia-number"><?php echo iscwp_pro_nice_number($following_count); ?></span> <span class="iscwp-ustatic-word"><?php _e('following','instagram-slider-and-carousel-plus-widget')?></span>
				</div>
			</div>

			<div class="iscwp-user-info-fullname">
				<span class="iscwp-ufullname"><?php echo $user_info_name; ?></span>
			</div>

			<div class="iscwp-user-biography">
				<?php echo $user_bniography; ?>
			</div>
		</div>
	</div><?php
}