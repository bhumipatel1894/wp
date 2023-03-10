<div class="blog-list">
	<div class="blog-list-content">

		<?php if ( has_post_thumbnail() ) { ?>
		<div class="wp-medium-4 wpcolumns">
			<?php $height_css = ($image_height) ? 'height:'.$image_height.'px;' : '';?>
			<div class="blog-image-bg" style="<?php echo $height_css; ?>">
				<a href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>">
					<img src="<?php echo $feat_image; ?>" alt="<?php the_title(); ?>" />
				</a>
			</div>
			<div class="slideline"><hr></div>
		</div>
		<?php } ?>

		<div class="<?php if ( !has_post_thumbnail() ) { echo 'wp-medium-12 wpcolumns'; } else { echo 'wp-medium-8 wpcolumns'; } ?>">
			
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
			<?php  if($showFullContent == "false" ) { ?>
				 	
				<div><?php echo wpbaw_pro_get_post_excerpt( $post->ID, get_the_content(), $words_limit, $content_tail ); ?></div>

				<?php if($showreadmore == 'true') { ?>
					<a class="readmorebtn" href="<?php echo $post_link; ?>" target="<?php echo $link_target; ?>"><?php esc_html_e($read_more_text); ?></a>
				<?php } 
			} else { 
					the_content();
			} ?>
			</div>
			<?php } ?>
				
		</div>

	</div>
</div>