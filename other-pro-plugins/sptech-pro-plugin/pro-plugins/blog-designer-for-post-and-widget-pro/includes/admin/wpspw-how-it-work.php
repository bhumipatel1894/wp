<?php
/**
 * Pro Designs and Plugins Feed
 *
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// Action to add menu
add_action('admin_menu', 'wpspw_register_design_page');

/**
 * Register plugin design page in admin menu
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0
 */
function wpspw_register_design_page() {
	add_submenu_page( 'edit.php', __('How it works, our plugins and offers', 'blog-designer-for-post-and-widget'), __('Blog Designer - How It Works', 'blog-designer-for-post-and-widget'), 'manage_options', 'wpspw-designs', 'wpspw_designs_page' );
}

/**
 * Function to display plugin design HTML
 * 
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0
 */
function wpspw_designs_page() {

	$wpos_feed_tabs = wpspw_help_tabs();
	$active_tab 	= isset($_GET['tab']) ? $_GET['tab'] : 'how-it-work';
?>
		
	<div class="wrap wpspw-wrap">

		<h2 class="nav-tab-wrapper">
			<?php
			foreach ($wpos_feed_tabs as $tab_key => $tab_val) {
				$tab_name	= $tab_val['name'];
				$active_cls = ($tab_key == $active_tab) ? 'nav-tab-active' : '';
				$tab_link 	= add_query_arg( array( 'page' => 'wpspw-designs', 'tab' => $tab_key), admin_url('edit.php') );
			?>

			<a class="nav-tab <?php echo $active_cls; ?>" href="<?php echo $tab_link; ?>"><?php echo $tab_name; ?></a>

			<?php } ?>
		</h2>
		
		<div class="wpspw-tab-cnt-wrp">
		<?php
			if( isset($active_tab) && $active_tab == 'how-it-work' ) {
				wpspw_howitwork_page();
			}
			else if( isset($active_tab) && $active_tab == 'plugins-feed' ) {
				echo wpspw_get_plugin_design( 'plugins-feed' );
			} else {
				echo wpspw_get_plugin_design( 'offers-feed' );
			}
		?>
		</div><!-- end .wpspw-tab-cnt-wrp -->

	</div><!-- end .wpspw-wrap -->

<?php
}

/**
 * Gets the plugin design part feed
 *
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0
 */
function wpspw_get_plugin_design( $feed_type = '' ) {
	
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : '';
	
	// If tab is not set then return
	if( empty($active_tab) ) {
		return false;
	}

	// Taking some variables
	$wpos_feed_tabs = wpspw_help_tabs();
	$transient_key 	= isset($wpos_feed_tabs[$active_tab]['transient_key']) 	? $wpos_feed_tabs[$active_tab]['transient_key'] 	: 'wpspw_' . $active_tab;
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
			$cache = '<div class="error"><p>' . __( 'There was an error retrieving the data from the server. Please try again later.', 'blog-designer-for-post-and-widget' ) . '</div>';
		}
	}
	return $cache;	
}

/**
 * Function to get plugin feed tabs
 *
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0
 */
function wpspw_help_tabs() {
	$wpos_feed_tabs = array(
						'how-it-work' 	=> array(
													'name' => __('How It Works', 'blog-designer-for-post-and-widget'),
												),
						'plugins-feed' 	=> array(
													'name' 				=> __('Our Plugins', 'blog-designer-for-post-and-widget'),
													'url'				=> 'http://wponlinesupport.com/plugin-data-api/plugins-data.php',
													'transient_key'		=> 'wpos_plugins_feed',
													'transient_time'	=> 172800
												),
						'offers-feed' 	=> array(
													'name'				=> __('WPOS Offers', 'blog-designer-for-post-and-widget'),
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
 * @package Blog Designer - Post and Widget Pro
 * @since 1.0
 */
function wpspw_howitwork_page() { ?>
	
	<style type="text/css">
		.wpos-pro-box .hndle{background-color:#0073AA; color:#fff;}
		.wpos-pro-box .postbox{background:#dbf0fa none repeat scroll 0 0; border:1px solid #0073aa; color:#191e23;}
		.postbox-container .wpos-list li:before{font-family: dashicons; content: "\f139"; font-size:20px; color: #0073aa; vertical-align: middle;}
		.wpspw-wrap .wpos-button-full{display:block; text-align:center; box-shadow:none; border-radius:0;}
		.wpspw-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
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
									<span><?php _e( 'How It Works - Display and shortcode', 'blog-designer-for-post-and-widget' ); ?></span>
								</h3>
								
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php _e('Getting Started with Blog Designer Pro', 'blog-designer-for-post-and-widget'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1: This plugin works with wordpress post.', 'blog-designer-for-post-and-widget'); ?></li>
														<li><?php _e('Step-2: Go to "Posts --> Add new".', 'blog-designer-for-post-and-widget'); ?></li>
														<li><?php _e('Step-3: Add post title, description, category, and images as featured image.', 'blog-designer-for-post-and-widget'); ?></li>
														<li><?php _e('Step-4: Repeat this process and add multiple post item', 'blog-designer-for-post-and-widget'); ?></li>	
														<li><?php _e('Step-4: To display post category wise you can use category shortcode under "Posts --> categories"', 'blog-designer-for-post-and-widget'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('How Shortcode Works', 'blog-designer-for-post-and-widget'); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php _e('Step-1. Create a page like Our Blog OR Latest Blog.', 'blog-designer-for-post-and-widget'); ?></li>
														<li><?php _e('Step-2. Put below shortcode as per your need.', 'blog-designer-for-post-and-widget'); ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php _e('All Shortcodes', 'blog-designer-for-post-and-widget'); ?>:</label>
												</th>
												<td>
													<span class="wpspw-shortcode-preview">[wpspw_post limit="10"]</span> – <?php _e('Display latest 10 post and then pagination', 'blog-designer-for-post-and-widget'); ?> <br />
													<span class="wpspw-shortcode-preview">[wpspw_recent_post]</span> – <?php _e('Recent Blog with Grid View', 'blog-designer-for-post-and-widget'); ?> <br />
													<span class="wpspw-shortcode-preview">[wpspw_recent_post_slider]</span> – <?php _e('Display Post in Slider View', 'blog-designer-for-post-and-widget'); ?> <br />
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
									<span><?php _e('Need Support?', 'blog-designer-for-post-and-widget'); ?></span>
								</h3>
								<div class="inside">
									<p><?php _e('Check plugin document for shortcode parameters and demo for designs.', 'blog-designer-for-post-and-widget'); ?></p>
									<a class="button button-primary wpos-button-full" href="https://www.wponlinesupport.com/pro-plugin-document/document-blog-designer-post-and-widget-pro/?utm_source=hp&event=doc" target="_blank"><?php _e('Documentation', 'blog-designer-for-post-and-widget'); ?></a>
									<p><a class="button button-primary wpos-button-full" href="http://demo.wponlinesupport.com/prodemo/blog-designer-post-and-widget/?utm_source=hp&event=pro_demo" target="_blank"><?php _e('View PRO Designs ', 'blog-designer-for-post-and-widget'); ?></a></p>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->

					<!-- Help to improve this plugin! -->
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
									<h3 class="hndle">
										<span><?php _e( 'Help to improve this plugin!', 'blog-designer-for-post-and-widget' ); ?></span>
									</h3>
									<div class="inside">
										<p>Enjoyed this plugin? You can help by rate this plugin <a href="https://www.wponlinesupport.com/your-feedback/?utm_source=hp" target="_blank">5 stars!</a></p>
									</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-container-1 -->

			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
<?php }