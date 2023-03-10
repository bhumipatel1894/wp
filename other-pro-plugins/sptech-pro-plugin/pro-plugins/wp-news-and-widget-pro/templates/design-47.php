<?php
switch ($grid_count) {
	case '2':
		$dynamic_cls = 'wpnews-medium-6';
		break;

	case '4':
	case '5':
	case '6':
		$dynamic_cls = 'wpnews-medium-4';
		break;
	
	default:
		$dynamic_cls = 'wpnews-medium-3';
		break;
}
?>

	<div class="news-grid wpnaw-clr-<?php echo $grid_count; ?> <?php echo $dynamic_cls; ?> wpnews-columns">
	<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
		<div class="news-grid-content">
			<div class="news-overlay">

				<div class="news-image-bg" style="<?php echo $height_css; ?>">
					<?php if( !empty($post_featured_image) ) { ?>
					<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
					<?php } ?>
				</div>

				<div class="news-short-content">
				<?php if($showCategory == "true") { ?>
					<div class="news-categories">	
						<?php echo $cate_name; ?>
					</div>
					<?php } ?>
					<div class="bottom-content">

					 <h2 class="news-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
					</h2>

					<?php if($showDate == "true") { ?>
					<div class="news-date">
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
<?php } ?>