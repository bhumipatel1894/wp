<?php
$cnt_cls = (!empty($feat_image)) ? 'wprpsp-medium-7' : 'wprpsp-medium-12';
?>
<div class="wprpsp-post-slides">
	<div class="wprpsp-post-list-wrap" <?php echo $slider_height_css; ?>>
		<div class="wprpsp-post-list-cnt">
			<?php if( !empty($feat_image) ) { ?>
			<div class="wprpsp-medium-5 wprpsp-columns">
				<div class="wprpsp-post-image-wrap wprpsp-post-image-bg">
					<img src="<?php echo $feat_image; ?>" alt="<?php _e('Post Image', 'wp-responsive-recent-post-slider'); ?>" class="wprpsp-post-img" />
				</div>
				<a class="wprpsp-post-link" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
			</div>
			<?php } ?>

			<div class="<?php echo $cnt_cls; ?> wprpsp-columns">
				<?php if($showCategory == "true" && $cat_list) { ?>
				<div class="wprpsp-post-cats-wrap"><?php echo $cat_list; ?></div>
				<?php } ?>

			  	<h2 class="wprpsp-post-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>

				<?php if($showDate == "true" || $showAuthor == 'true') { ?>
				<div class="wprpsp-post-date">
					<?php if($showAuthor == 'true') { ?>
					<span>
						<?php esc_html_e( 'By', 'wp-responsive-recent-post-slider' ); ?>
						<?php the_author(); ?>
					</span>
					<?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>

				<?php if($showContent == "true") { ?>
					<div class="wprpsp-post-content">
						<div><?php echo wprpsp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

						<?php if($showreadmore == 'true') { ?>
						<a class="wprpsp-read-more-btn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</div>