<?php
$dynamic_height = ($grid_count == 1) 	? $slider_height : ($slider_height/2);
$height_css 	= ($dynamic_height) 	? 'height:'.$dynamic_height.'px;' : '';
$dynamic_class 	= ($grid_count == 1) 	? 'wprpsp-medium-8' : 'wprpsp-medium-4';

if( $grid_count == 1 ) { ?>
	<div class="wprpsp-grid-slider-wrp">
<?php } ?>

	<div class="wprpsp-post-slides wprpsp-clr-<?php echo $grid_count; ?> <?php echo $dynamic_class; ?> wprpsp-columns">

		<a class="wprpsp-link-overlay wprpsp-post-link" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>

		<div class="wprpsp-post-grid-cnt">
			<div class="wprpsp-post-overlay">

				<div class="wprpsp-post-image-wrap wprpsp-post-img-bg" style="<?php echo $height_css; ?>">
					<?php if( !empty($feat_image) ) { ?>
					<img src="<?php echo $feat_image; ?>" alt="<?php _e('Post Image', 'wp-responsive-recent-post-slider'); ?>" class="wprpsp-post-img" />
					<?php } ?>
				</div>

				<div class="wprpsp-post-short-cnt">
					<?php if($showCategory == "true" && $cat_list) { ?>
					<div class="wprpsp-post-cats-wrap"><?php echo $cat_list; ?></div>
					<?php } ?>

					<div class="wprpsp-bottom-content">
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

<?php
	if( $grid_count == 3 || ( $post_count == $count ) ) {
		$grid_count = 0;
?>
</div>
<?php } ?>