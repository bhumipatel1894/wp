<?php
switch ($grid_count) {
	case '2':
		$dynamic_cls = 'wprpsp-medium-6';
		break;
	case '4':
	case '5':
	case '6':
		$dynamic_cls = 'wprpsp-medium-4';
		break;
	default:
		$dynamic_cls = 'wprpsp-medium-3';
		break;
}
$image_height 		= (!empty($image_height)) ? $image_height : '';
if( $grid_count == 1 ) { ?>
	<div class="wprpsp-grid-slider-wrp">
<?php } ?>

	<div class="wprpsp-post-slides wprpsp-clr-<?php echo $grid_count; ?> <?php echo $dynamic_cls; ?> wprpsp-columns">

		<a class="wprpsp-link-overlay wprpsp-post-link" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>

		<div class="wprpsp-post-grid-cnt">
			<div class="wprpsp-post-overlay">

				<div class="wprpsp-post-image-wrap wprpsp-post-image-bg" <?php echo $image_height; ?>>
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
	if( $grid_count == 6 || ( $post_count == $count ) ) {
		$grid_count = 0;
?>
</div>
<?php } ?>