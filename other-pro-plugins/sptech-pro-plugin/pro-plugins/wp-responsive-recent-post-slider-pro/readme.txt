=== WP Responsive Recent Post Slider Pro  ===
Contributors: wponlinesupport
Tags: post slider, posts slider, recent post slider, recent posts slider, slider, responsive post slider, responsive posts slider, responsive recent post slider, responsive recent posts slider, wordpress posts slider, post slideshow, posts slideshow, recent posts slideshow, shortcodes
Requires at least: 3.1
Tested up to: 4.7.3


A quick, easy way to add and display Responsive WordPresss Recent Post Slider and Carousel on your website with 16 designs using a shortcode.


== Description ==
Responsive Recent WordPresss Post Slider is a WordPress posts content slider plugin with touch for mobile devices and responsive.
WordPresss Recent Post Slider displays your recent posts using 4 designs with beautiful slider.

Added 3 Widget in the WP Responsive Recent Post Slider Pro Plugin.

A multipurpose responsive WordPresss posts slider plugin powered with four built-in design template, lots of easy customizable options.
Display unlimited number of WordPresss posts slider in a single page or post with different sets of options like category, limit, navigation type. 

= Here is the Recent Post Slider and Recent Post Carousel shortcode example =

Main shortcode:
<code>[recent_post_slider] and [recent_post_carousel]</code>

To display only latest 4 post:
<code>[recent_post_slider limit="4"]</code>
Where limit define the number of posts to display.

If you want to display Recent Post Slider by category then use this short code: 
<code>[recent_post_slider  category="category_ID"]</code>

We have given 4 designs. For designs use the following shortcode: 
<code>[recent_post_slider design="design-1"]</code> 
Where designs are : design-1, design-2, design-3, design-4  to design-16

You can see and select all the designs from Post -> Pro Post Slider Designs. Here you can use the shortcode
for design that you like and want to use for your website.

= Complete shortcode is =

<code>[recent_post_slider limit="4" category="8,10" design="design-1" show_date="true" show_category_name="true" show_content="true" content_words_limit="20" show_author="true" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="1000" loop="true" link_target="blank" show_read_more="false" read_more_text="More" order="DESC" orderby="post_date" include_cat_child="yes" exclude_cat="1,5,6" posts="1,5,6" hide_post="1,2,3" slider_height="500" sticky_posts="fasle" image_size="full"]</code>
 
<code>[recent_post_carousel limit="4" category="8,10" design="design-1" show_date="true" show_category_name="true" show_content="true" content_words_limit="20" show_author="true" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="1000" loop="true" slides_to_show="3" slides_to_scroll="1" link_target="blank" show_read_more="false" read_more_text="More" order="DESC" orderby="post_date" include_cat_child="yes" exclude_cat="1,5,6" posts="1,5,6" hide_post="1,2,3" slider_height="500"  sticky_posts="fasle" image_size="full"]</code> 


= Here is Template code =
<code><?php echo do_shortcode('[recent_post_slider]'); ?> and <?php echo do_shortcode('[recent_post_carousel]'); ?></code>

= Features include: =
* Added Language support for German(de_DE), French(France fr_FR) (Beta)
* Easy to add.
* Given 30 designs.
* Added 3 Widget (Post slider, Post List/Slider-1, Post List/Slider-2)
* Responsive.
* Responsive touch slider.
* Mouse Draggable.
* You can create multiple post slider with different options at single page or post.
* Custom post type support.
* Exclude Post with their ID's that you do not want to display.

= Use Following Recent Post Slider parameters with shortcode =
<code>[recent_post_slider]</code>

* **Limit** : [recent_post_slider limit="10"] (Display number of post. Display all post with limit="-1")
* **Category** : [recent_post_slider category="category_id"] (Display post category wise. Enter multiple category id wih comma seperated.)
* **Design** : [recent_post_slider design="design-1"] (Display child category post. Values are "true" OR "false".)
* **Show Date** : [recent_post_slider show_date="true"] (Display post date. Values are "true" OR "false".)
* **Show Category Name** : [recent_post_slider show_category_name="true"] (Display post categories. Values are "true" OR "false".)
* **Show Content** : [recent_post_slider show_content="true"] (Display post content. Values are "true" OR "false". Note: Some of the designs does not have post content.)
* **Content Tail** : [recent_post_slider content_tail="..."] (Display three dots after post content as a continue reading.)
* **Content Words Limit** : [recent_post_slider content_words_limit="20"] (Limit number of post content words.)
* **Show Author** : [recent_post_slider show_author="true"] (Display post author. Values are "true" OR "false".)
* **Slider Pagination and Arrows** : [recent_post_slider dots="true" arrows="true"] (Values are "true" OR "false".)
* **Autoplay : ** [recent_post_slider autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval : ** [recent_post_slider autoplay_interval="3000"] (Delay between two slides.)
* **Speed : ** [recent_post_slider speed="300"] (Control speed of slider.)
* **Loop : ** [recent_post_slider loop="true"] (Run slider contineously or not. Values are "true" OR "false".)
* **Link Target :** [recent_post_slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Show Read More :** [recent_post_slider show_read_more="false"] (Show/Hide read more links. Values are "true" and "false".)
* **Read More Text :** [recent_post_slider read_more_text="More"] (Control post read more button text.)
* **Order :** [recent_post_slider order="DESC"] (Controls post order. Values are "ASC" OR "DESC".)
* **Orderby :** [recent_post_slider orderby="post_date"] (Display post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Include Category Child** : [recent_post_slider include_cat_child="yes"] (Display child category post. Values are "true" OR "false".)
* **Exclude Category :** [recent_post_slider exclude_cat="1,5,6"] (Exclude some post category which you do not want to display.)
* **Display Specific Posts :** [recent_post_slider posts="1,5,6"] (Display only specific posts.)
* **Exclude Post :** [recent_post_slider hide_post="1,5,6"] (Exclude some post which you do not want to display.)
* **Slider Height :** [recent_post_slider slider_height="500"] (Control slider height.)
* **Sticky Post :** [recent_post_slider sticky_posts="false"] (Show sticky posts. Values are "true" Or "false")
* **Image Size :** [recent_post_slider image_size="full"] (Choose image size. Values are "thumbnail", "medium", "large", "full")
* **Image Fit :** [recent_post_slider image_fit="true"] (Image will fit in a whole container without white or gray space. Values are "true" OR "false")

<code>[recent_post_carousel]</code>

* **Limit** : [recent_post_carousel limit="10"] (Display number of post. Display all post with limit="-1")
* **Category** : [recent_post_carousel category="category_id"] (Display post category wise. Enter multiple category id wih comma seperated.)
* **Design** : [recent_post_carousel design="design-1"] (Display child category post. Values are "true" OR "false".)
* **Show Date** : [recent_post_carousel show_date="true"] (Display post date. Values are "true" OR "false".)
* **Show Category Name** : [recent_post_carousel show_category_name="true"] (Display post categories. Values are "true" OR "false".)
* **Show Content** : [recent_post_carousel show_content="true"] (Display post content. Values are "true" OR "false". Note: Some of the designs does not have post content.)
* **Content Words Limit** : [recent_post_carousel content_words_limit="20"] (Limit number of post content words.)
* **Content Tail** : [recent_post_carousel content_tail="..."] (Display three dots after post content as a continue reading.)
* **Show Author** : [recent_post_carousel show_author="true"] (Display post author. Values are "true" OR "false".)
* **Slider Pagination and Arrows** : [recent_post_carousel dots="true"]
* **Autoplay : ** [recent_post_carousel autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval : ** [recent_post_carousel autoplay_interval="3000"] (Delay between two slides.)
* **Speed : ** [recent_post_carousel speed="300"] (Control speed of slider.)
* **Loop : ** [recent_post_carousel loop="true"] (Run slider contineously. Values are "true" OR "false".)
* **Slides Column :** [recent_post_carousel slides_to_show="3"] (Display number of Post at a time in slider.)
* **Slides to Scroll :** [recent_post_carousel slides_to_scroll="1"] ( Scroll number of Posts at a time.)
* **Link Target :** [recent_post_carousel link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Show Read More :** [recent_post_carousel show_read_more="false"] (Show/Hide read more links. Values are "true" and "false".)
* **Read More Text :** [recent_post_carousel read_more_text="More"] (Control post read more button text.)
* **Order :** [recent_post_carousel order="DESC"] (Controls post order. Values are "ASC" OR "DESC".)
* **Orderby :** [recent_post_carousel orderby="post_date"] (Display post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Include Category Child** : [recent_post_carousel include_cat_child="yes"] (Display child category post. Values are "true" OR "false".)
* **Exclude Category :** [recent_post_carousel exclude_cat="1,5,6"] (Exclude some post category which you do not want to display.)
* **Exclude Post :** [recent_post_carousel hide_post="1,5,6"] (Exclude some post which you do not want to display.)
* **Display Specific Posts :** [recent_post_carousel posts="1,5,6"] (Display only specific posts.)
* **Slider Height :** [recent_post_carousel slider_height="500"] (Control slider height.)
* **Sticky Post :** [recent_post_carousel sticky_posts="false"] (Show sticky posts. Values are "true" Or "false")
* **Image Size :** [recent_post_carousel image_size="full"] (Choose image size. Values are "thumbnail", "medium", "large", "full")
* **Image Fit :** [recent_post_carousel image_fit="true"] (Image will fit in a whole container without white or gray space. Values are "true" OR "false")

== Installation ==

1. Upload the 'wp-recent-post-slider-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "wp-recent-post-slider-pro" list plugin through the 'Plugins' menu in WordPress.
3. Add this short code where you want to display recent post slider
<code>[recent_post_slider] and [recent_post_carousel]</code>


== Changelog ==

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