<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wpls_pro_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WPLS_PRO_POST_TYPE, __('How it works, our plugins and offers', 'logoshowcase'), __('How It Works', 'logoshowcase'), 'manage_options', 'wpls-designs', 'wpls_pro_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_designs_page() {

	$wpos_feed_tabs = wpls_pro_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap wpls-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => WPLS_PRO_POST_TYPE, 'page' => 'wpls-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="wpls-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wpls_pro_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wpls_pro_get_plugin_design( 'plugins-feed' );
			} else {
				echo wpls_pro_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .wpls-tab-cnt-wrp -->

	</div><!-- end .wpls-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wpls_pro_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'wpls_' . $active_tab;
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
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'logoshowcase' ) . '</div>';
		}
	}
	return $cache;
}

/**
 * Function to get plugin feed tabs
 *
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'logoshowcase'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'logoshowcase'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'logoshowcase'),
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
 * @package WP Logo Showcase Responsive Slider Pro
 * @since 1.0.0
 */
function wpls_pro_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.wpls-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.wpls-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
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
									<span><?php _e( 'How It Works - Display and shortcode', 'logoshowcase' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started with Logo Showcase Pro', 'logoshowcase'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Go to "Logo Showcase --> Add New".', 'logoshowcase'); ?></li>
														<li><?php _e('Step-2. Add Logo title, logo link to redirect(if need) and logo image under featured image section.', 'logoshowcase'); ?></li>
														<li><?php _e('Step-3. Display multiple logo showcase, create categories under "Logo Showcase --> category" and create categories.', 'logoshowcase'); ?></li>
														<li><?php _e('Step-4. Assign logo showcase post to respective categories and use the category shortcode under "Logo Showcase --> Logo Category"', 'logoshowcase'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'logoshowcase'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Create a page like Logoshowcase OR add the shortcode in any page.', 'logoshowcase'); ?></li>
														<li><?php _e('Step-2. Put below shortcode as per your need.', 'logoshowcase'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'logoshowcase'); ?>:</label>
												</th>
												<td>
													<span class="wpls-shortcode-preview">[logoshowcase]</span> ??? <?php _e('Logo Showcase Slider Shortcode', 'logoshowcase'); ?> <br />
													<span class="wpls-shortcode-preview">[logo_grid]</span> ??? <?php _e('Logo Showcase Grid Shortcode', 'logoshowcase'); ?> <br />
													<span class="wpls-shortcode-preview">[logo_filter]</span> ??? <?php _e('Logo Showcase Filter Shortcode', 'logoshowcase'); ?> <br />
													<span class="wpls-shortcode-preview">[logoshowcase center_mode="true" slides_column="3"]</span> ??? <?php _e('Logo Showcase Slider with center mode Shortcode', 'logoshowcase'); ?>
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
									<span><?php _e('Need Support?', 'logoshowcase'); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'logoshowcase'); ?></p>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/pro-plugin-document/document-wp-logo-showcase-responsive-slider-pro/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'logoshowcase'); ?></a>
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/pro-logo-showcase-responsive-slider/?utm_source=hp&event=pro_demo" target="_blank"><?php _e('View PRO Designs', 'logoshowcase'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'logoshowcase' ); ?></span>
									</h3>
									<div class="inside">
										<p><?php _e('Enjoyed this plugin? You can help by rate this plugin', 'logoshowcase'); ?> <a href="https://www.wponlinesupport.com/your-feedback/?utm_source=hp" target="_blank">5 stars!</a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->
				
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }