<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wp_igsp_pro_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.1
 */
function wp_igsp_pro_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WP_IGSP_PRO_POST_TYPE, __('How it works - Meta slider and carousel with lightbox Pro', 'meta-slider-and-carousel-with-lightbox'), __('How It Works', 'meta-slider-and-carousel-with-lightbox'), 'manage_options', 'igsp-designs', 'wp_igsp_pro_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.1
 */
function wp_igsp_pro_designs_page() {

	$wpos_feed_tabs = wp_igsp_pro_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap igsp-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => WP_IGSP_PRO_POST_TYPE, 'page' => 'igsp-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="igsp-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wp_igsp_pro_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wp_igsp_pro_get_plugin_design( 'plugins-feed' );
			} else {
				echo wp_igsp_pro_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .igsp-tab-cnt-wrp -->

	</div><!-- end .igsp-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.1
 */
function wp_igsp_pro_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wp_igsp_pro_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'igsp_' . $active_tab;
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
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'meta-slider-and-carousel-with-lightbox' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.1
 */
function wp_igsp_pro_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'meta-slider-and-carousel-with-lightbox'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'meta-slider-and-carousel-with-lightbox'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'meta-slider-and-carousel-with-lightbox'),
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
 * @package Meta slider and carousel with lightbox Pro
 * @since 1.1
 */
function wp_igsp_pro_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.igsp-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.igsp-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
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
									<span><?php _e( 'How It Works - Display and shortcode', 'meta-slider-and-carousel-with-lightbox' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started with Meta Slider', 'meta-slider-and-carousel-with-lightbox'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin create a Gallery mata box under your POST, PAGE as well as a Meta Gallery tab in WordPress menu section', 'meta-slider-and-carousel-with-lightbox'); ?></li>
														<li><?php _e('Step-2: You can you to any POST and PAGE and check a "Meta slider and carousel with lightbox Pro - Settings" meta box in the end.', 'meta-slider-and-carousel-with-lightbox'); ?></li>
														<li><?php _e('Step-3: Under "Choose Gallery Images" click on "Gallery Images" button and select multiple images from WordPress media and click on "Add to Gallery" button. Once images added you can add the shortcode in the the same POST OR PAGE', 'meta-slider-and-carousel-with-lightbox'); ?></li>
														<li><?php _e('Step-4: If you want a sapreate section, then you can see "Meta Galley Pro" tab in the Wordpress menu.', 'meta-slider-and-carousel-with-lightbox'); ?></li>
														<li><?php _e('Step-5: Use this tab to manage you image galleries and use the shortcode from the list.', 'meta-slider-and-carousel-with-lightbox'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'meta-slider-and-carousel-with-lightbox'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: If you are adding Gallery in POST or PAGE, kinldy use the bellow shortcode in the same page. Just add the shortcode in WordPress editor.', 'meta-slider-and-carousel-with-lightbox'); ?></li>
														<li><?php _e('Step-2: If you are using "Meta Gallery Pro", then click on "Meta Gallery Pro--> Meta Gallery Pro" and find out the shortcode.', 'meta-slider-and-carousel-with-lightbox'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'meta-slider-and-carousel-with-lightbox'); ?>:</label>
												</th>
												<td>
													<span class="igsp-shortcode-preview">[meta_gallery_carousel]</span> ??? <?php _e('Gallery Carousel Slider', 'meta-slider-and-carousel-with-lightbox'); ?> <br />
													<span class="igsp-shortcode-preview">[meta_gallery_slider]</span> ??? <?php _e('Gallery Slider', 'meta-slider-and-carousel-with-lightbox'); ?> <br />
													<span class="igsp-shortcode-preview">[meta_gallery_variable]</span> ??? <?php _e('Variable Width Slider', 'meta-slider-and-carousel-with-lightbox'); ?>
													
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
									<span><?php _e( 'Need Support?', 'meta-slider-and-carousel-with-lightbox' ); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'meta-slider-and-carousel-with-lightbox'); ?></p>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/pro-plugin-document/document-meta-slider-gallery-lightbox-pro/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'meta-slider-and-carousel-with-lightbox'); ?></a>	
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/meta-slider-and-carousel-with-lightbox/?utm_source=hp&event=pro_demo" target="_blank"><?php _e('View PRO Designs', 'meta-slider-and-carousel-with-lightbox'); ?></a>			</p>								
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'meta-slider-and-carousel-with-lightbox' ); ?></span>
									</h3>
									<div class="inside">
										<p><?php _e('Enjoyed this plugin? You can help by rate this plugin', 'meta-slider-and-carousel-with-lightbox'); ?> <a href="https://www.wponlinesupport.com/your-feedback/?utm_source=hp" target="_blank">5 stars!</a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }