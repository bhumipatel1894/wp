<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package  Portfolio and Projects Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wp_pap_pro_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WP_PAP_PRO_POST_TYPE, __('How it works - Portfolio and Projects Pro', 'portfolio-and-projects'), __('How It Works', 'portfolio-and-projects'), 'manage_options', 'pap-designs', 'wp_pap_pro_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package  Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_designs_page() {

	$wpos_feed_tabs = wp_pap_pro_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap pap-wrap">

		<h2 class="nav-tab-wrapper">
			<?php foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => WP_PAP_PRO_POST_TYPE, 'page' => 'pap-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="pap-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wp_pap_pro_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wp_pap_pro_get_plugin_design( 'plugins-feed' );
			} else {
				echo wp_pap_pro_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .pap-tab-cnt-wrp -->

	</div><!-- end .pap-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wp_pap_pro_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'pap_' . $active_tab;
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
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'portfolio-and-projects' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'portfolio-and-projects'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'portfolio-and-projects'),
													'url'				=> 'https://www.wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'portfolio-and-projects'),
													'url'				=> 'https://www.wponlinesupport.com/plugin-data-api/wpos-offers.php',
													'transient_key'		=> 'wpos_offers_feed',
													'transient_time'	=> 86400,
												)
					);
	return $wpos_feed_tabs;
}

/**
 * Function to get 'How It Works' HTML
 *
 * @package Portfolio and Projects Pro
 * @since 1.0
 */
function wp_pap_pro_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.pap-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.pap-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
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
									<span><?php _e( 'How It Works - Display and Shortcode', 'portfolio-and-projects' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started with Portfolio Pro', 'portfolio-and-projects'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin creates Portfolio Pro tab in WordPress menu section', 'portfolio-and-projects'); ?></li>
														<li><?php _e('Step-2: Go to Projects Pro add new portfoilo add portfoliio images, project link, portfolio banner and choose your slider setting', 'portfolio-and-projects'); ?></li>
														<li><?php _e('Step-3: Now, paste below shortcode in any post or page and your profolio listing is ready !!!', 'portfolio-and-projects'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'portfolio-and-projects'); ?>:</label>
												</th>
												<td>
													<span class="pap-shortcode-preview">[pap_portfolio portfolio_style="inline"]</span> – <?php _e('Portfolio Slider inline', 'portfolio-and-projects'); ?> <br />
													<span class="pap-shortcode-preview">[pap_portfolio  portfolio_style="popup"]</span> – <?php _e('Portfolio Slider popup', 'portfolio-and-projects'); ?> <br />
													<span class="pap-shortcode-preview">[pap_portfolio  portfolio_style="none"]</span> – <?php _e('Portfolio Grid View', 'portfolio-and-projects'); ?>
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
									<span><?php _e( 'Need Support?', 'portfolio-and-projects' ); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'portfolio-and-projects'); ?></p>
									<p><a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/pro-plugin-document/document-portfolios-projects-pro/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'portfolio-and-projects'); ?></a></p>
									<a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/portfolio-and-projects-pro/?utm_source=hp&event=demo" target="_blank"><?php _e('Demo for Designs', 'portfolio-and-projects'); ?></a>
									</ul>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					 <div class="metabox-holder wpos-pro-box">
                        <div class="meta-box-sortables ui-sortable">
                            <div class="postbox">
                                <h3 class="hndle">
                                    <span><?php _e('Need PRO Support?', 'portfolio-and-projects'); ?></span>
                                </h3>
                                <div class="inside">
                                    <p><?php _e('Hire our experts for WordPress website support.', 'portfolio-and-projects'); ?></p>
                                    <p><a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/projobs-support/?utm_source=hp&event=projobs" target="_blank"><?php _e('PRO Support', 'portfolio-and-projects'); ?></a></p>
                                </div><!-- .inside -->
                            </div><!-- #general -->
                        </div><!-- .meta-box-sortables ui-sortable -->
                    </div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'portfolio-and-projects' ); ?></span>
									</h3>
									<div class="inside">
										<p><?php _e( 'Enjoyed this plugin? You can help by rate this plugin', 'portfolio-and-projects' ); ?> <a href="https://www.wponlinesupport.com/your-review/?utm_source=hp&event=review" target="_blank"><?php _e('5 stars!', 'portfolio-and-projects'); ?></a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }