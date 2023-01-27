<div class="news-slides">
	<div class="news-image-bg" style="<?php echo $height_css; ?>">

		<?php if( !empty($post_featured_image) ) { ?>
		<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
			<img src="<?php echo $post_featured_image; ?>" alt="<?php _e('Post Image', 'sp-news-and-widget'); ?>" />
		</a>
		<?php } ?>
		
		<div class="news-while-overlay">
			<div class="news-while-overlay-inner">

 				<?php if($showCategory == "true") { ?>
				<div class="news-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

			  	<h2 class="news-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>

				<?php if($showDate == "true") {  ?>	
					<div class="news-date">		
						<?php echo get_the_date(); ?>
					</div>
				<?php } ?>

			</div>
		</div>

	</div>
</div>