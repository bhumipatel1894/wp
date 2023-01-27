<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package WP Blog and Widgets Pro
 * @since 2.0.1
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wpbaw_pro_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package WP Blog and Widgets Pro
 * @since 2.0.1
 */
function wpbaw_pro_register_design_page() {
	add_submenu_page( 'edit.php?post_type='.WPBAW_PRO_POST_TYPE, __('How it works, our plugins and offers', 'wp-blog-and-widgets'), __('How It Works', 'wp-blog-and-widgets'), 'manage_options', 'wpbawh-designs', 'wpbaw_pro_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package WP Blog and Widgets Pro
 * @since 2.0.1
 */
function wpbaw_pro_designs_page() {

	$wpos_feed_tabs = wpbaw_pro_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap wpbawh-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'post_type' => WPBAW_PRO_POST_TYPE, 'page' => 'wpbawh-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="wpbawh-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wpbaw_pro_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wpbaw_pro_get_plugin_design( 'plugins-feed' );
			} else {
				echo wpbaw_pro_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .wpbawh-tab-cnt-wrp -->

	</div><!-- end .wpbawh-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package WP Blog and Widgets Pro
 * @since 2.0.1
 */
function wpbaw_pro_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wpbaw_pro_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'wpbawh_' . $active_tab;
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
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'wp-blog-and-widgets' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package WP Blog and Widgets Pro
 * @since 2.0.1
 */
function wpbaw_pro_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'wp-blog-and-widgets'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'wp-blog-and-widgets'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'wp-blog-and-widgets'),
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
 * @package WP Blog and Widgets Pro
 * @since 2.0.1
 */
function wpbaw_pro_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.wpbawh-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.wpbawh-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
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
									<span><?php _e( 'How It Works - Display and shortcode', 'wp-blog-and-widgets' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started with Blog and widget Pro', 'wp-blog-and-widgets'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin create a BLOG Pro menu tab in WordPress menu with custom post type.".', 'wp-blog-and-widgets'); ?></li>														
														<li><?php _e('Step-2: Go to "Blog Pro --> Add blog tab".', 'wp-blog-and-widgets'); ?></li>
														<li><?php _e('Step-3: Add blog title, description, category, and images as featured image.', 'wp-blog-and-widgets'); ?></li>
														<li><?php _e('Step-4: <b>NOTE</b> :- If you want to create a blog page with WordPress existing POST section then try our other plugin --', 'wp-blog-and-widgets'); ?> <a href="https://www.wponlinesupport.com/wp-plugin/blog-designer-post-and-widget/" target="_blank">Blog Designer – Post and Widget</a></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'wp-blog-and-widgets'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Create a page like Blog OR Our Blog.', 'wp-blog-and-widgets'); ?></li>
														<li><?php _e('Step-2. Put below shortcode as per your need.', 'wp-blog-and-widgets'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'wp-blog-and-widgets'); ?>:</label>
												</th>
												<td>
													<span class="wpbawh-shortcode-preview">[blog]</span> – <?php _e('Blog in Grid View', 'wp-blog-and-widgets'); ?> <br />
													<span class="wpbawh-shortcode-preview">[recent_blog_post]</span> – <?php _e('Display Recent blog post in Grid View', 'wp-blog-and-widgets'); ?> <br />
													<span class="wpbawh-shortcode-preview">[recent_blog_post_slider]</span> – <?php _e('Display Recent blog post in Slider/Carousel', 'wp-blog-and-widgets'); ?> <br />
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
									<span><?php _e('Need Support?', 'wp-blog-and-widgets'); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'wp-blog-and-widgets'); ?></p>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/pro-plugin-document/document-wp-blog-and-widgets-pro/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'wp-blog-and-widgets'); ?></a>
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/pro-blog-and-widgets-plugin-demo/?utm_source=hp&event=pro_demo" target="_blank"><?php _e('View PRO Designs', 'wp-blog-and-widgets'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'wp-blog-and-widgets' ); ?></span>
									</h3>
									<div class="inside">
										<p><?php _e('Enjoyed this plugin? You can help by rate this plugin', 'wp-blog-and-widgets'); ?> <a href="https://www.wponlinesupport.com/your-feedback/?utm_source=hp" target="_blank">5 stars!</a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }