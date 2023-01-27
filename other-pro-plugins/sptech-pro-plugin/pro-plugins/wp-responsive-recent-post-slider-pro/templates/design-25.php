<div class="wprpsp-post-slides">

	<a class="wprpsp-link-overlay" href="<?php echo $post_link ?>" target="<?php echo $link_target; ?>"></a>

	<div class="wprpsp-post-grid-cnt">
		<div class="wprpsp-post-overlay">

			<div class="wprpsp-post-image-wrap wprpsp-post-img-bg">
				<?php if( !empty($feat_image) ) { ?>
				<img src="<?php echo $feat_image; ?>" alt="<?php _e('Post Image', 'wp-responsive-recent-post-slider'); ?>" class="wprpsp-post-img" />
				<?php } ?>
			</div>

			<div class="wprpsp-post-short-cnt">
				<div class="wprpsp-bottom-content">

					<?php if($showCategory == "true" && $cat_list) { ?>
					<div class="wprpsp-post-cats-wrap"><?php echo $cat_list; ?></div>
					<?php } ?>

					<h2 class="wprpsp-post-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

					<?php if($showDate == "true" || $showAuthor == 'true') { ?>
					<div class="wprpsp-post-date">		
						<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-responsive-recent-post-slider' ); ?> <?php the_author(); ?></span><?php } ?>
						<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
						<?php if($showDate == "true") { echo get_the_date(); } ?>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
</div>