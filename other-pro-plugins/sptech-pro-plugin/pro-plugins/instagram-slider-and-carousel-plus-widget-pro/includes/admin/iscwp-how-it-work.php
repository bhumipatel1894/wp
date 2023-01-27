<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package  Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'iscwp_pro_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_register_design_page() {
	add_submenu_page( 'iscwp-pro-settings', __('How it works', 'instagram-slider-and-carousel-plus-widget').' - Instagram Slider and Carousel Plus Widget Pro', __('How It Works', 'instagram-slider-and-carousel-plus-widget'), 'edit_posts', 'iscwp-designs', 'iscwp_pro_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package  Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_designs_page() {

	$wpos_feed_tabs = iscwp_pro_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap iscwp-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'page' => 'iscwp-designs', 'tab' => $tab_key), admin_url('admin.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="iscwp-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				iscwp_pro_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo iscwp_pro_get_plugin_design( 'plugins-feed' );
			} else {
				echo iscwp_pro_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .iscwp-tab-cnt-wrp -->

	</div><!-- end .iscwp-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = iscwp_pro_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'iscwp_' . $active_tab;
	$url 			= isset($wpos_feed_tabs[$active_tab]['url']) 			? $wpos_feed_tabs[$active_tab]['url'] 				: '';
	$transient_time = isset($wpos_feed_tabs[$active_tab]['transient_time']) ? $wpos_feed_tabs[$active_tab]['transient_time'] 	: 172800;
	$cache 			= get_transient( $transient_key );
	
	if ( false === $cache ) {
		
		$feed 			= wp_remote_get( esc_url_raw( $url ), array( 'timeout' => 120, 'sslverify' => false ) );
		$response_code 	= wp_remote_retrieve_response_code( $feed );
		
		if ( ! is_wp_error( $feed ) && $response_code == 200 ) {
			if ( isset( $feed['body'] ) && strlen( $feed['body'] ) > 0 ) {
				$cache = wp_remote_retrieve_body( $feed );
				set_transient( $transient_key, $cache, $transient_time );
			}
		} else {
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'instagram-slider-and-carousel-plus-widget' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'instagram-slider-and-carousel-plus-widget'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'instagram-slider-and-carousel-plus-widget'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'instagram-slider-and-carousel-plus-widget'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/wpos-offers.php',
													'transient_key'		=> 'wpos_offers_feed',
													'transient_time'	=> 86400,
												)
					);
	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package Instagram Slider and Carousel Plus Widget Pro
 * @since 1.0
 */
function iscwp_pro_howitwork_page() { ?>

	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.iscwp-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.iscwp-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
			
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								
								<h3 class="hndle">
									<span><?php _e( 'How It Works - Display and Shortcode', 'instagram-slider-and-carousel-plus-widget' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started', 'instagram-slider-and-carousel-plus-widget'); ?></label>
												</th>
												<td>
													<ul>
														<li><?php _e('This plugin is as easy as 123!!!', 'instagram-slider-and-carousel-plus-widget'); ?></li>
														<li><?php _e('Just paste below shortcode in any post or page and add your instagram username to shortcode.', 'instagram-slider-and-carousel-plus-widget'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'instagram-slider-and-carousel-plus-widget'); ?></label>
												</th>
												<td>
													<span class="iscwp-shortcode-preview">[iscwp-slider username="instagram"]</span> – <?php _e('Instagram Slider', 'instagram-slider-and-carousel-plus-widget'); ?> <br />
													<span class="iscwp-shortcode-preview">[iscwp-grid username="instagram"]</span> – <?php _e('Instagram Grid', 'instagram-slider-and-carousel-plus-widget'); ?> <br />
													<span class="iscwp-shortcode-preview">[iscwp-grid-block username="instagram"]</span> – <?php _e('Instagram Grid Block', 'instagram-slider-and-carousel-plus-widget'); ?> <br />
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
				
				<!--Upgrad to Pro HTML -->
				<div id="postbox-container-1" class="postbox-container">
					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox" style="">
									
								<h3 class="hndle">
									<span><?php _e( 'Need Support?', 'instagram-slider-and-carousel-plus-widget' ); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'instagram-slider-and-carousel-plus-widget'); ?></p> <br/>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/pro-plugin-document/document-instagram-slider-and-carousel-plus-widget-pro/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'instagram-slider-and-carousel-plus-widget'); ?></a>
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/instagram-slider-and-carousel-plus-widget-pro/?utm_source=hp&event=demo" target="_blank"><?php _e('Demo for Designs', 'instagram-slider-and-carousel-plus-widget'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<div class="metabox-holder wpos-pro-box">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php _e('Need PRO Support?', 'instagram-slider-and-carousel-plus-widget'); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Hire our experts for WordPress website support.', 'instagram-slider-and-carousel-plus-widget'); ?></p>
									<p><a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/projobs-support/?utm_source=hp&event=projobs" target="_blank"><?php _e('PRO Support', 'instagram-slider-and-carousel-plus-widget'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'instagram-slider-and-carousel-plus-widget' ); ?></span>
									</h3>
									<div class="inside">
										<p><?php _e( 'Enjoyed this plugin? You can help by rate this plugin', 'instagram-slider-and-carousel-plus-widget' ); ?> <a href="https://www.wponlinesupport.com/your-review/?utm_source=hp&event=review" target="_blank"><?php _e('5 stars!', 'instagram-slider-and-carousel-plus-widget'); ?></a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }