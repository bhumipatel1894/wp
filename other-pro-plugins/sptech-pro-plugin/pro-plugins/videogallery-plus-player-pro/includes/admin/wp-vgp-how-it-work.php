<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Video gallery and Player Pro
 * @since 1.1.6
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wp_vgp_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package Video gallery and Player Pro
 * @since 1.1.6
 */
function wp_vgp_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WP_VGP_POST_TYPE, __('How it works, our plugins and offers', 'html5-videogallery-plus-player'), __('How It Works', 'html5-videogallery-plus-player'), 'manage_options', 'vgap-designs', 'wp_vgp_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package Video gallery and Player Pro
 * @since 1.1.6
 */
function wp_vgp_designs_page() {

	$wpos_feed_tabs = wp_vgp_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap vgap-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => WP_VGP_POST_TYPE, 'page' => 'vgap-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="vgap-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wp_vgp_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wp_vgp_get_plugin_design( 'plugins-feed' );
			} else {
				echo wp_vgp_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .vgap-tab-cnt-wrp -->

	</div><!-- end .vgap-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Video gallery and Player Pro
 * @since 1.1.6
 */
function wp_vgp_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wp_vgp_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'vgap_' . $active_tab;
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
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'html5-videogallery-plus-player' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Video gallery and Player Pro
 * @since 1.1.6
 */
function wp_vgp_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'html5-videogallery-plus-player'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'html5-videogallery-plus-player'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'html5-videogallery-plus-player'),
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
 * @package Video gallery and Player Pro
 * @since 1.1.6
 */
function wp_vgp_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.vgap-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.vgap-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
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
									<span><?php _e( 'How It Works - Display and Shortcode', 'html5-videogallery-plus-player' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started with Video Gallery', 'html5-videogallery-plus-player'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin create a "Video Gallery Pro" in WordPress menu section', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-2: Click on "Video Gallery Pro > Add new" ', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-3: Add Video title, link, and video poster image.', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-4: You can also create the categories under "Video Gallery Pro > Video category". Asign the video under respective category and use category shortcode to display multiple video galleries. ', 'html5-videogallery-plus-player'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'html5-videogallery-plus-player'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: Craete a page say Video gallery OR Videos', 'html5-videogallery-plus-player'); ?></li>
														<li><?php _e('Step-2: Add the bellow shortcode OR shortcode from "Video Gallery Pro > Video category" ', 'html5-videogallery-plus-player'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'html5-videogallery-plus-player'); ?>:</label>
												</th>
												<td>
													<span class="vgap-shortcode-preview">[video_gallery]</span> – <?php _e('Display Video galley in a page with Grid view', 'html5-videogallery-plus-player'); ?> <br />
													<span class="vgap-shortcode-preview">[video_gallery_slider]</span> – <?php _e('Display Video galley in a page with Slider/Carousel', 'html5-videogallery-plus-player'); ?> <br />
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
									<span><?php _e('Need Support?', 'html5-videogallery-plus-player'); ?></span>
								</h3>
								<div class="inside">										
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'html5-videogallery-plus-player'); ?></p>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/pro-plugin-document/document-video-gallery-player-pro/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'html5-videogallery-plus-player'); ?></a>	
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/video-gallery-and-player-pro-demo/?utm_source=hp&event=pro_demo" target="_blank"><?php _e('View PRO Designs', 'html5-videogallery-plus-player'); ?></a>			</p>								
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<div class="metabox-holder wpos-pro-box">
                        <div class="meta-box-sortables ui-sortable">
                            <div class="postbox">
                                <h3 class="hndle">
                                    <span><?php _e('Need PRO Support?', 'html5-videogallery-plus-player'); ?></span>
                                </h3>
                                <div class="inside">
                                    <p><?php _e('Hire our experts for WordPress website support.', 'html5-videogallery-plus-player'); ?></p>
                                    <p><a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/projobs-support/?utm_source=hp&event=projobs" target="_blank"><?php _e('PRO Support', 'html5-videogallery-plus-player'); ?></a></p>
                                </div><!-- .inside -->
                            </div><!-- #general -->
                        </div><!-- .meta-box-sortables ui-sortable -->
                    </div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'html5-videogallery-plus-player' ); ?></span>
									</h3>									
									<div class="inside">										
										<p><?php _e('Enjoyed this plugin? You can help by rate this plugin', 'html5-videogallery-plus-player'); ?> <a href="https://www.wponlinesupport.com/your-review/?utm_source=hp&event=review" target="_blank"><?php _e('5 stars!', 'html5-videogallery-plus-player'); ?></a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }