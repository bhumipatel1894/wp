<div class="wcpscwc-product-slide <?php echo $css_class; ?>">
	<div class="<?php if( $active_slider ) { echo 'wcpscwc-medium-12  wcpscwc-columns';}else{ echo $grid_cls; } ?>">
		<div class="wcpscwc-main-wrapper">
			<div class="wcpscwc-product-image-wrapper">
				<?php if ( !empty($post_image) ) { ?>
				<a href="<?php the_permalink(); ?>" target="<?php echo $link_target; ?>"><img src="<?php echo $post_image; ?>" alt="<?php the_title(); ?>" class="wcpscwc-product-image" /></a>
				<?php } ?>

				<?php if ( $show_sale && $product->is_on_sale() ) : ?>
				<span class="wcpscwc-product-onsale"><?php _e( 'Sale!', 'woo-product-slider-and-carousel-with-category' ); ?></span>
				<?php endif; ?>
			</div>

			<div class="wcpscwc-product-title"><a href="<?php the_permalink(); ?>" target="<?php echo $link_target; ?>"><?php the_title(); ?></a></div>

			<?php if ( $show_category && !empty($product_cats) ) { ?>
			<div class="wcpscwc-product-category"><?php echo $product_cats; ?></div>
			<?php } ?>

			<div class="wcpscwc-product-price"><?php echo $product->get_price_html(); ?></div>

			<?php if($show_rating && $product_rating) { ?>			
			<div class="wcpscwc-product-rating"><?php echo $product_rating; ?></div>
			<?php } ?>

			<?php if($show_desc) { ?>
			<div class="wcpscwc-product-shortdes"><?php the_excerpt(); ?></div>
			<?php } ?>

			<div class="wcpscwc-product-addtocart">
				<?php
					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
					sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s">%s</a>',
					esc_url( $product->add_to_cart_url() ),
					esc_attr( isset( $quantity ) ? $quantity : 1 ),
					esc_attr( $product_id ),
					esc_attr( $product->get_sku() ),
					esc_attr( isset( $class ) ? $class : 'button' ),
					esc_html( $product->add_to_cart_text() )
					), $product );
				?>
			</div>
		</div>
	</div>
</div>