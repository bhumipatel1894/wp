<?php 
if($gridcol == '2') {
	$newsprogrid = "6";
} else if($gridcol == '3') {
	$newsprogrid = "4";
}  else if($gridcol == '4') {
	$newsprogrid = "3";
} else if ($gridcol == '1') {
	$newsprogrid = "12";
} else {
	$newsprogrid = "12";
}
?>
<div class="news-grid wpnews-medium-<?php echo $newsprogrid; ?> wpnews-columns <?php echo $css_class; ?>">
<a class="link-overlay" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"></a>
	<div class="news_overlay">
  		
  		<div class="news-image-bg" style="<?php echo $height_css; ?>">
			<?php if( !empty($post_featured_image) ) { ?>
			<img src="<?php echo $post_featured_image; ?>" alt="<?php the_title(); ?>" />
			<?php } ?>
		</div>

		<div class="news-grid-content">

			<div class="news-content">
				<?php if($showDate == "true") { ?>
				<div class="news-date">
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>

				<?php if($showCategory == "true") { ?>
				<div class="news-categories">	
				<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<h2 class="news-title">
					<a class="link-border" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>
			</div>

		</div>

	</div>
</div>