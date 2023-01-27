<li class="<?php echo $wrapper_cls; ?>" style="<?php echo $wrapper_css; ?>">
	<div class="wppap-li-inner-wrap">
		<div class="wppap-portfolio-bg">
			<?php if( $portfolio_img ) { ?>
				<img class="wppap-portfolio-img" src="<?php echo $portfolio_img; ?>" alt="<?php echo wp_pap_pro_esc_attr(the_title()); ?>" />
			<?php } ?>
		</div>

		<div class="wppap-title-overlay">
			<div class="wppap-title-overlay-wrp">
				<span class="wppap-description"><?php the_title(); ?></span>
				
				<?php if(!empty($portfolio_cat)) {?>
				<div class="wppap-cats"><?php echo $portfolio_cat; ?></div>
				<?php } ?>

				<div class="wppap-external-link-popup">
					<?php if( $portfolio_url && $link ) { ?>
					<a href="<?php echo $portfolio_url; ?>" class="wppap-external-link" target="<?php echo $link_target; ?>"></a>
					<?php } ?>

					<?php if( $popup_style ) { ?>
					<a href="javascript:void(0);" class="wppap-popup-link wppap-popup-ref-link"></a>
					<?php } ?>
				</div>
			</div>
			<a href="<?php echo $portfolio_link; ?>" class="wppap-thumbnail wppap-popup-info-link" data-mfp-src="#wppap-popup-<?php echo $unique; ?>" target="<?php echo $portfolio_link_target; ?>"></a>
		</div>
	</div>
</li>