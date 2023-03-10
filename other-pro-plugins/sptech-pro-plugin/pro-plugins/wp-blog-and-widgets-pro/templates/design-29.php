<?php if($newscount == "0") { ?>

	<div class="wp-medium-6 wpcolumns responsive-padding">
		<?php $height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';?>
		<div class="blog-image-bg" style="<?php echo $height_css; ?>">
			<?php if( !empty($feat_image) ) { ?>
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
				<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
			</a>
			<?php } ?>
		</div>

		<?php if($showCategory == "true" && $cate_name !='') { ?>
			<div class="blog-categories">	
				<?php echo $cate_name; ?>
			</div>
		<?php } ?>

		<h2 class="blog-title">
			<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
		</h2>

		<?php if($showDate == "true" || $showAuthor == 'true') { ?>	
		<div class="blog-date">		
			<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
			<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
			<?php if($showDate == "true") { echo get_the_date(); } ?>
		</div>
		<?php } ?>

		<?php if($showContent == "true") { ?>	
		<div class="blog-content">

			<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

			<?php if($showreadmore == 'true') { ?>
			<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e($read_more_text); ?></a>
			<?php } ?>
		</div>
		<?php } ?>

	</div>

<?php } else { 
	
	$medium_image = wpbaw_pro_get_post_featured_image( $post->ID, 'medium' );
	$medium_image = ($medium_image) ? $medium_image : $default_img;
?>
			
	<div class="wp-medium-6 wpcolumns flotRight">
		<div class="blog-right-block wp-medium-12 wpcolumns">

			<div class="wp-medium-3 wpcolumns">
				<div class="blog-image-bg">
					<?php if( !empty($medium_image) ) { ?>
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
						<img src="<?php echo $medium_image; ?>" alt="<?php the_title(); ?>" />
					</a>
					<?php } ?>
				</div>
			</div>

			<div class="wp-medium-9 wpcolumns">

				<?php if($showCategory == "true" && $cate_name !='') { ?>
				<div class="blog-categories">	
					<?php echo $cate_name; ?>
				</div>
				<?php } ?>

				<h3 class="blog-title">
					<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a>
				</h3>

				<?php if($showDate == "true" || $showAuthor == 'true') { ?>
				<div class="blog-date">		
					<?php if($showAuthor == 'true') { ?> <span><?php  esc_html_e( 'By', 'wp-blog-and-widgets' ); ?> <?php the_author(); ?></span><?php } ?>
					<?php echo ($showAuthor == 'true' && $showDate == 'true') ? '&nbsp;/&nbsp;' : '' ?>
					<?php if($showDate == "true") { echo get_the_date(); } ?>
				</div>
				<?php } ?>

				<?php if($showContent == "true") { ?>
				<div class="blog-content">
				
					<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

					<?php if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e($read_more_text); ?></a>
					<?php }  ?>
				</div>
				<?php } ?>
				
			</div>
			
		</div>
	</div>

<?php } ?>