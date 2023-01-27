<?php
/**
 * Handles e-commerce Setting metabox HTML
 *
 * @package Countdown Timer Ultimate Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix 		= WPCDT_PRO_META_PREFIX; // Metabox prefix
$is_ecommerce 	= get_post_meta( $post->ID, $prefix.'is_ecommerce', true );
?>

<table class="form-table wpcdt-integrate-ecom">
	<tr valign="top">
		<th scope="row">
			<label for="wpcdt-ecom"><?php _e('Integrate with E-commerce', 'countdown-timer-ultimate'); ?></label>
		</th>
		
		<td>
			<label for="wpcdt-countdown-timer"><input type="checkbox" id="wpcdt-ecom" name="<?php echo $prefix; ?>is_ecommerce" value="1" <?php checked($is_ecommerce, 1); ?>/></label><br/>
			<span class="description"><?php _e('Check this box to integrate with E-commerce Coupons.', 'countdown-timer-ultimate'); ?></span>
		</td>
	</tr>
</table>

<div class="wpcdt-mb-tabs-wrp" style="<?php if($is_ecommerce == 0){ echo 'display:none'; } ?>">
	
	<ul id="wpcdt-mb-tabs" class="wpcdt-mb-tabs">
		<?php if ( class_exists( 'WooCommerce' ) ) { ?>
  			<li class="wpcdt-mb-nav  wpcdt-active">
				<a href="#wpcdt-mdetails">WooCommerce</a>
			</li>
		<?php }

		if( class_exists( 'Easy_Digital_Downloads' ) ) { ?>
			<li class="wpcdt-mb-nav">
				<a href="#wpcdt-sdetails">EDD</a>
			</li>
		<?php } ?>
	</ul>

	<?php if ( class_exists( 'WooCommerce' ) ) {
		$woo_coupons 			= get_posts(array('post_type' => 'shop_coupon', 'posts_per_page' => -1));
		$woo_coupons_dropdown 	= get_post_meta( $post->ID, $prefix.'woo_coupons_dropdown', true );
	?>
		<div id="wpcdt-mdetails" class="wpcdt-mdetails wpcdt-tab-cnt" style="display:block;">

			<table class="form-table wpcdt-detail-tbl">
				<tbody>
					<?php if(!empty($woo_coupons)) { ?>
						<tr valign="top">
							<th scope="row">
								<label for="wpcdt-woo-coupons"><?php _e('WooCommerce Coupons', 'countdown-timer-ultimate'); ?></label>
							</th>
							<td>
								<select name="<?php echo $prefix; ?>woo_coupons_dropdown" class="wpcdt-select-box wpcdt-woo-coupons" id="wpcdt-woo-coupons">
									<option value=""><?php _e('Select Coupon', 'countdown-timer-ultimate'); ?></option>
									<?php foreach ($woo_coupons as $woo_coupon) { ?>
										<option value="<?php echo $woo_coupon->ID ?>" <?php selected( $woo_coupons_dropdown, $woo_coupon->ID); ?>><?php echo $woo_coupon->post_title; ?></option>
									<?php } ?>
								</select><br/>
								<span class="description"><?php _e('Select WooCommerce coupon. The expiry date will be taken from coupon.', 'countdown-timer-ultimate'); ?></span>
							</td>
						</tr>

					<?php } else { ?>

						<tr valign="top">							
							<th scope="row">
								<label><?php _e('No WooCommerce Coupons Found', 'countdown-timer-ultimate'); ?></label>
							</th>
						</tr>
					<?php } ?>
				</tbody>
			</table><!-- end .wpcdt-detail-tbl -->
		</div><!-- end .wpcdt-mdetails -->
	<?php } ?>

	<?php if ( class_exists( 'Easy_Digital_Downloads' ) ) {
		$edd_coupons 			= get_posts(array('post_type'=> 'edd_discount', 'posts_per_page'=>-1,'post_status' => 'active',));
		$edd_coupons_dropdown 	= get_post_meta( $post->ID, $prefix.'edd_coupons_dropdown', true );
	?>
		<div id="wpcdt-sdetails" class="wpcdt-sdetails wpcdt-tab-cnt">
			<table class="form-table wpcdt-detail-tbl">		
				<tbody>
					<?php if(!empty($edd_coupons)) { ?>
						<tr valign="top">
							<th scope="row">
								<label for="wpcdt-edd-coupons"><?php _e('EDD Coupons', 'countdown-timer-ultimate'); ?></label>
							</th>
							<td>
								<select name="<?php echo $prefix; ?>edd_coupons_dropdown" class="wpcdt-select-box wpcdt-edd-coupons" id="wpcdt-edd-coupons">
									<option value=""><?php _e('Select Coupon', 'countdown-timer-ultimate'); ?></option>
									<?php foreach ($edd_coupons as $edd_coupon) { ?>
										<option value="<?php echo $edd_coupon->ID ?>" <?php selected( $edd_coupons_dropdown, $edd_coupon->ID); ?>><?php echo $edd_coupon->post_title; ?></option>
									<?php } ?>
								</select><br/>
								<span class="description"><?php _e('Select WooCommerce coupon. The expiry date will be taken from coupon.', 'countdown-timer-ultimate'); ?></span>
							</td>
						</tr>
					<?php } else { ?>

						<tr valign="top">
							<th scope="row">
								<?php _e('No EDD Coupons Found', 'countdown-timer-ultimate'); ?>
							</th>
						</tr>
					<?php } ?>
				</tbody>
			</table><!-- end .wpcdt-detail-tbl -->
		</div><!-- end .wpcdt-sdetails -->
	<?php } ?>

</div><!-- end .wpcdt-mb-tabs-wrp -->