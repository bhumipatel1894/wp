=== WP Responsive Recent Post Slider Pro  ===
Contributors: wponlinesupport
Tags: post slider, posts slider, recent post slider, recent posts slider, slider, responsive post slider, responsive posts slider, responsive recent post slider, responsive recent posts slider, wordpress posts slider, post slideshow, posts slideshow, recent posts slideshow, shortcodes
Requires at least: 3.1
Tested up to: 4.8
Author URI: http://wponlinesupport.com
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A quick, easy way to add and display Responsive WordPresss Recent Post Slider and Carousel on your website with 16 designs using a shortcode.


== Description ==
Responsive Recent WordPresss Post Slider is a WordPress posts content slider plugin with touch for mobile devices and responsive.
WordPresss Recent Post Slider displays your recent posts using 4 designs with beautiful slider.

Added 3 Widget in the WP Responsive Recent Post Slider Pro Plugin.

A multipurpose responsive WordPresss posts slider plugin powered with four built-in design template, lots of easy customizable options.
Display unlimited number of WordPresss posts slider in a single page or post with different sets of options like category, limit, navigation type. 

You can see and select all the designs from Post -> Pro Post Slider Designs. Here you can use the shortcode
for design that you like and want to use for your website.

= 3 Shortcode are =
* <code>[recent_post_slider]</code> : Display Post in slider layout with 25 Designs.
* <code>[recent_post_carousel]</code> : Display Post in carousel layout with 30 Designs.
* <code>[gridbox_post_slider]</code> : Display Post in gridbox layout with 8 Designs


= Here is Template code =
<code><?php echo do_shortcode('[recent_post_slider]'); ?>, <?php echo do_shortcode('[recent_post_carousel]'); ?> and <?php echo do_shortcode('[gridbox_post_slider]'); ?></code>


== Installation ==

1. Upload the 'wp-recent-post-slider-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "wp-recent-post-slider-pro" list plugin through the 'Plugins' menu in WordPress.
3. Add this short code where you want to display recent post slider
<code>[recent_post_slider] and [recent_post_carousel]</code>


== Changelog ==

= 1.3.5 (3 July 2017) =
* [+] Fixed image display issue in IE

= 1.3.4 (28, June 2017) =
* [+] Added new 15+ designs in <code>[recent_post_carousel]</code>
* [+] Added new 10+ designs in <code>[recent_post_slider]</code>
* [+] Added new shortcode <code>[gridbox_post_slider]</code> with 8 designs.
* [+] Added VC support for <code>[gridbox_post_slider]</code>
* [+] Added new shortcode parameter fade="false" OR fade="true" for slider and gridbox slider.
* [+] Added new shortcode parameter image_fit="false" OR image_fit="true".
* [-] Design #30 added as a design #25 in shortcode <code>[recent_post_slider]</code>
* [-] Design #27, #28 and #29 removed from  shortcode <code>[recent_post_slider]</code> and added in shortcode <code>[gridbox_post_slider]</code> as Design #1, #2 and #3.

= 1.3.3 (26, May 2017) =
* [*] Added custom post type and custom taxonomy support which is publicly viewable. Now you can use with any custom post type.

= 1.3.2 (18, Apr 2017) =
* [*] Make desing compatible with old browser like IE and MicroSoft Edge.
* [*] Added prefix to CSS classes to avoid CSS conflict.
* [*] Resolved some notices when widget is added via WordPress Customizer.
* [*] Updated widget performance. Now user can choose multiple categories from widget to show post.
* [*] Optimized plugin CSS.

= 1.3.1 (22, March 2017) =
* [+] Added 'image_size' shortcode parameter to choose image size from WordPress registered image size.
* [+] Added 'sticky_posts' shortcode parameter to display Stick Posts.
* [*] Updated plugin widget with 'sticky_posts' parameter.
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.

= 1.3 (10, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated slider responsive for mobile device.
* [*] Optimized some CSS.

= 1.2.9 (Sep, 12 2016) =
* [*] Removed plugin license page from plugin section and added in 'Post' menu.
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.2.8 (July, 23 2016) =
* [+] Added 'Show Description' and some other parameter in Latest Post List/Slider 1 and Latest Post List/Slider 2 widget.
* [*] Resolved WPML multi language post fetch issue.
* [*] Resolved Custom CSS display issue.
* [*] Resolved WP Query notice when category is passed.

= 1.2.7 (June, 27 2016) =
* [+] Added new designs.
* [+] Updated slider js to new version.
* [+] Added Visual Composer page builder support.
* [+] Added Drag & Drop feature to display post in your desired order.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for post ordering.
* [+] Added 'orderby' short code parameter for post order by.
* [+] Added 'posts' short code parameter to display only some specific post.
* [+] Added 'exclude_cat' short code parameter to exclude some category.
* [+] Improved widget with more features.
* [+] Added 'slider_height' short code parameter for 'recent_post_slider' to control slider height.
* [+] Added default post featured image settings.
* [+] Added custom CSS setting for plugin.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added 'read_more_text' short code parameter to change read more button text.
* [+] Added 'content_tail' short code parameter.
* [+] Added 'include_cat_child' short code parameter to show child category post or not.
* [+] Added 'loop' short code parameter to run slider contineously.
* [+] Added RTL support for slider.
* [*] Improved PRO plugin design page.
* [*] Improved plugin license page with instruction.
* [*] Optimized js for better performance.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Optimzed code.

= 1.2.6 =
* Fixed some css issues.

= 1.2.5 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.2.4 =
* Fixed some bugs
* Added 2 New shortcode parameters ie **post_type="post", hide_post="1,2,3"**

= 1.2.3 =
* Added Language support for German(de_DE), French(France fr_FR) (Beta)
* Fixed some bugs

= 1.2.2 =
* Fixed some php and designing  bug.

= 1.2.1 =
* Fixed some bug.

= 1.2 =
* Fixed some bug and added 3 more designs.

= 1.1.1 =
* Fixed some bug and added 3 more designs.

= 1.1 =
* Fixed slider height bug.

= 1.0 =
* Initial release.


== Upgrade Notice ==

= 1.3.5 (3 July 2017) =
* [+] Fixed image display issue in IE

= 1.3.4 (28, June 2017) =
* [+] Added new 15+ designs in <code>[recent_post_carousel]</code>
* [+] Added new 10+ designs in <code>[recent_post_slider]</code>
* [+] Added new shortcode <code>[gridbox_post_slider]</code> with 8 designs.
* [+] Added VC support for <code>[gridbox_post_slider]</code>
* [+] Added new shortcode parameter fade="false" OR fade="true" for slider and gridbox slider.
* [+] Added new shortcode parameter image_fit="false" OR image_fit="true".
* [-] Design #30 added as a design #25 in shortcode <code>[recent_post_slider]</code>
* [-] Design #27, #28 and #29 removed from  shortcode <code>[recent_post_slider]</code> and added in shortcode <code>[gridbox_post_slider]</code> as Design #1, #2 and #3.


= 1.3.3 (26, May 2017) =
* [*] Added custom post type and custom taxonomy support which is publicly viewable. Now you can use with any custom post type.

= 1.3.2 (18, Apr 2017) =
* [*] Make desing compatible with old browser like IE and MicroSoft Edge.
* [*] Added prefix to CSS classes to avoid CSS conflict.
* [*] Resolved some notices when widget is added via WordPress Customizer.
* [*] Updated widget performance. Now user can choose multiple categories from widget to show post.
* [*] Optimized plugin CSS.

= 1.3.1 (22, March 2017) =
* [+] Added 'image_size' shortcode parameter to choose image size from WordPress registered image size.
* [+] Added 'sticky_posts' shortcode parameter to display Stick Posts.
* [*] Updated plugin widget with 'sticky_posts' parameter.
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.

= 1.3 (10, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated slider responsive for mobile device.
* [*] Optimized some CSS.

= 1.2.9 (Sep, 12 2016) =
* [*] Removed plugin license page from plugin section and added in 'Post' menu.
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.2.8 (July, 23 2016) =
* [+] Added 'Show Description' and some other parameter in Latest Post List/Slider 1 and Latest Post List/Slider 2 widget.
* [*] Resolved WPML multi language post fetch issue.
* [*] Resolved Custom CSS display issue.
* [*] Resolved WP Query notice when category is passed.

= 1.2.7 (June, 27 2016) =
* [+] Added new designs.
* [+] Updated slider js to new version.
* [+] Added Visual Composer page builder support.
* [+] Added Drag & Drop feature to display post in your desired order.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for post ordering.
* [+] Added 'orderby' short code parameter for post order by.
* [+] Added 'posts' short code parameter to display only some specific post.
* [+] Added 'exclude_cat' short code parameter to exclude some category.
* [+] Improved widget with more features.
* [+] Added 'slider_height' short code parameter for 'recent_post_slider' to control slider height.
* [+] Added default post featured image settings.
* [+] Added custom CSS setting for plugin.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added 'read_more_text' short code parameter to change read more button text.
* [+] Added 'content_tail' short code parameter.
* [+] Added 'include_cat_child' short code parameter to show child category post or not.
* [+] Added 'loop' short code parameter to run slider contineously.
* [+] Added RTL support for slider.
* [*] Improved PRO plugin design page.
* [*] Improved plugin license page with instruction.
* [*] Optimized js for better performance.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Optimzed code.

= 1.2.6 =
* Fixed some css issues.

= 1.2.5 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.2.4 =
* Fixed some bugs
* Added 2 New shortcode parameters ie **post_type="post", hide_post="1,2,3"**

= 1.2.3 =
* Added Language support for German(de_DE), French(France fr_FR) (Beta)
* Fixed some bugs

= 1.2.2 =
* Fixed some php and designing  bug.

= 1.2.1 =
* Fixed some bug.

= 1.2 =
* Fixed some bug and added 3 more designs.

= 1.1.1 =
* Fixed some bug and added 3 more designs.

= 1.1 =
* Fixed slider height bug.

= 1.0 =
* Initial release.