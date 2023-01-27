<div class="wprpsp-post-slides wprpsp-clr-<?php echo $grid_count; ?>">
	<div class="wprpsp-post-grid-content">
		<div class="wprpsp-post-overlay">
			<div class="wprpsp-post-image-wrap wprpsp-post-image-bg" <?php echo $slider_height_css; ?>>
				<?php if( !empty($feat_image) ) { ?>
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" class="wprpsp-post-img" />
				</a>
				<?php } ?>
			</div>			
			<div class="wprpsp-title-content">
				<h2 class="wprpsp-post-title">
						<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h2>				
			</div>
		</div>
		<?php if($showCategory == "true" && $cat_list) { ?>
				<div class="wprpsp-post-cats-wrap"><?php echo $cat_list; ?></div>
			<?php }  
		  if($showDate == "true" || $showAuthor == 'true') { ?>
			<div class="wprpsp-post-date">
	  			<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-responsive-recent-post-slider' ); ?> <?php the_author(); ?></span><?php } ?>
	  			<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
	  			<?php if($showDate == "true") { echo get_the_date(); } ?>
	  		</div>
		<?php }
		if($showContent == "true") { ?>
			<div class="wprpsp-post-content">
				<div><?php echo wprpsp_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>
				<?php if($showreadmore == 'true') { ?>
				<a class="wprpsp-read-more-btn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e( $read_more_text ); ?></a>
				<?php } ?>
			</div>
		<?php } ?>		
	</div>
</div>
<?php
	if( $grid_count == 9 || ( $post_count == $count ) ) {
		$grid_count = 0;
	}
?>