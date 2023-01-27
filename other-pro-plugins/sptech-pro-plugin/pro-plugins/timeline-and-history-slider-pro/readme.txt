=== Timeline and History slider Pro  ===
Contributors: wponlinesupport
Tags: slick, image slider, slick slider, timeline slider, history slider
Requires at least: 3.1
Tested up to: 4.7.4

Easy to add and display history OR timeline for your WordPress website.


== Description ==

Easy to add and display history OR timeline for your WordPress website. This plugin create a "Timeline Slider" menu tab with a custom post type to your wordpress admin side. You can add Title, content and featured image as same like
WordPress post.

View [DEMO](http://wponlinesupport.com/wp-plugin/timeline-history-slider/)  for more details.

**This timeline plugin contain two shortcode**
<code>[th-slider] [th-history]</code>
Where you can display Timeline posts Horizontal and Vertical

= Shortcode Examples =

= Here is the shortcode example =

<code>[th-slider]</code> - Timeline Horizontal Slider
<code>[th-history]</code> - Timeline Vertical

= Complete shortcode with all parameters =

Timeline History Slider
<code>[th-slider limit="-1" category="5,10" include_cat_child="true" slidestoshow="3" dots="true" arrows="true" autoplay="false" adaptiveheight="true" autoplay_interval="3000" speed="300" fade="false" design="design-1" orderby="date" order="DESC" show_full_content="false" show_content="true" content_words_limit="70" show_read_more="true" content_tail="..." link_target="self" read_more_text="more" show_date="true" posts="501,506" exclude_post="502,504" exclude_cat="4,10" post_type="post" image_position="left" background_color="#ddd" font_color="#fff"]</code>

Timeline History Vertical
<code>[th-history limit="-1" category="5,10" include_cat_child="true" design="design-1" orderby="date" order="DESC" show_full_content="false" show_content="true" show_date="true" content_words_limit="70" show_read_more="true" content_tail="..." link_target="self" read_more_text="more" posts="501,506" exclude_post="502,504" exclude_cat="4,10" post_type="post" animation="bounceInUp" fa_icon_color="#fff" background_color="#ddd" font_color="#fff"]</code>

= Use Following Timeline Slider parameters with shortcode =
<code>[th-slider]</code>

* **Limit:** [th-slider limit="5"] (Number of Timeline Slides which you want to display images.)
* **Display By Category:** [th-slider category="5,10"]  (Display timeline slider by their category ID.)
* **Weather Include Child Post or not:** [th-slider include_cat_child="true"] (Weather to show child category post or not.)
* **slidestoshow:** [th-slider slidestoshow="3"] (Display number of images at a time in slider.)
* **Slider Pagination and Arrows:** [th-slider arrows="true" dots="true"]
* **Autoplay:** [th-slider autoplay="false"] (Start slider automatically. Values are "true" OR "false".)
* **adaptiveheight:** [th-slider adaptiveheight="true"]
* **Autoplay Interval:** [th-slider autoplay_interval="3000"] (Delay between two slides.)
* **Slider Speed:** [th-slider speed="300"] (Control speed of slider.)
* **Slider Effect:** [th-slider fade="false"] (Slider Effects. values are "true" OR "false")
* **Design:** [th-slider design="design-1"] (Select design for timeline slider. Designs are design-1 to design-6)
* **Orderby:** [th-slider orderby="date"] (Set orderby for album. You can set "date" (Album Date), "modified" (Album updated date), "title" (Album Title), "rand" (Random), "menu_order" (Sort Order))
* **Order:** [th-slider order="DESC"] (Set album order. Values are "ASC" OR "DESC")
* **Show Full COntent:** [th-slider show_full_content="true"] (values are "true" OR "false")
* **Show Content:** [th-slider show_content="true"] (Show Content or not. values are "true" OR "false")
* **Conetnt Word Limit:** [th-slider content_words_limit="70"] (Limit the Content. any integer number)
* **Show Read More:** [th-slider show_read_more="true"] (Show read more button or not. values are "true" OR "false")
* **Content Tail (Continue Reading):** [th-slider content_tail="..."] (Display three dots as a contineous reading.)
* **Link Behaviour:** [th-slider link_target="self"] (Choose link behaviour. Values are "self" OR "blank")
* **Read More Text:** [th-slider read_more_text="Read More"] ( Text to show insted of Read More.)
* **Show Date:** [th-slider show_date="true"] (Weather show date or not. values are "true" or "false")
* **Show Only Specific Posts:** [th-slider posts="501,506"] (Show only specific posts. values are comma separated Post id)
* **Don't Show Specific Posts:** [th-slider exclude_post="502,504"] (Don't show specific posts. values are comma separated post id)
* **Show Post of only Specific Category:** [th-slider exclude_cat="2,9"] (Don't show specific category posts. values are comma separated category id.)
* **Post type:** [th-slider post_type="post"] (post type support if you want to show your timeline of your wordpress posts values is "post".)
* **Image Position:** [th-slider image_position="left"] (Where to show your image. values are left, right, top, bottom.)
* **Image Size:** [th-slider image_size="medium"] (Choose image size from WordPress registered image size. Default image sizes are "thumbnail", "medium", "large" OR "full")
* **Background Color:** [th-slider background_color="#ddd"] (Set background color of post value must be colorcode )
* **Font Color:** [th-slider font_color="#fff"] (Set fonts color of post according to your needs value must be colorcode)
* **Show Title:** [th-slider show_title="true"] (Display post title. Values are "true" or "False")
* **Link:** [th-slider link="true"] (Display post link. Values are "true" or "False")

= Use Following Timeline Vertical parameters with shortcode =
<code>[th-history]</code>

* **Limit:** [th-history limit="5"] (Number of Timeline Slides which you want to display images.)
* **Display By Category:** [th-history category="5,10"] (Display timeline slider by their category ID.)
* **Weather Include Child Post or not:** [th-history include_cat_child="true"] (Weather to show child category post or not.)
* **Design:** [th-history design="design-1"] (Select design for timeline slider. Designs are design-1 to design-6)
* **Orderby:** [th-history orderby="date"] (Set orderby for album. You can set "date" (Album Date), "modified" (Album updated date), "title" (Album Title), "rand" (Random), "menu_order" (Sort Order))
* **Order:** [th-history order="DESC"] (Set album order. Values are "ASC" OR "DESC")
* **Show Full Content:** [th-history show_full_content="true"] (values are "true" OR "false")
* **Show Content:** [th-history show_content="true"] (Show Content or not. values are "true" OR "false")
* **Conetnt Word Limit:** [th-history content_words_limit="70"] (Limit the Content. any integer number)
* **Show Read More:** [th-history show_read_more="true"] (Show read more button or not. values are "true" OR "false")
* **Content Tail (Continue Reading):** [th-history content_tail="..."] (Display three dots as a contineous reading.)
* **Link Behaviour:** [th-history link_target="self"] (Choose link behaviour. Values are "self" OR "blank")
* **Read More Text:** [th-history read_more_text="Read More"] ( Text to show insted of Read More.)
* **Show Date:** [th-history show_date="true"] (Weather show date or not. values are "true" or "false")
* **Show Only Specific Posts:** [th-history posts="501,506"] (Show only specific posts. values are comma separated Post id)
* **Don't Show Specific Posts:** [th-history exclude_post="502,504"] (Don't show specific posts. values are comma separated post id)
* **Show Post of only Specific Category:** [th-history exclude_cat="2,9"] (Don't show specific category posts. values are comma separated category id.)
* **Post type:** [th-history post_type="post"] (post type support if you want to show your timeline of your wordpress posts values is "post".)
* **Background Color:** [th-history background_color="#ddd"] (Set background color of post value must be colorcode )
* **Font Color:** [th-history font_color="#fff"] (Set fonts color of post according to your needs value must be colorcode )
* **Animation:**  [th-history animation="bounceInUp"] (Add animation effect to your vertical timeline. values are bounce-in, bounceInUp, bounceInDown, fadeInDown, fadeInUp, flipInX, flipInY, zoomIn)
* **Show Title:** [th-history show_title="true"] (Display post title. Values are "true" or "False")
* **Link:** [th-history link="true"] (Display post link. Values are "true" or "False")
* **FA Icon Color:** [th-history fa_icon_color="#000"] (Set font awesome icon color.)
* **Image Size:** [th-history image_size="medium"] (Choose image size from WordPress registered image size. Default image sizes are "thumbnail", "medium", "large" OR "full")


= Template code is =
<code><?php echo do_shortcode('[th-slider]'); ?></code>
<code><?php echo do_shortcode('[th-history]'); ?></code>


== Installation ==

1. Upload the 'timeline-and-history-slider' folder to the '/wp-content/plugins/' directory.
2. Activate the "timeline-and-history-slider" list plugin through the 'Plugins' menu in WordPress.
3. Add this short code where you want to display slider
<code>[th-slider]</code>

== Screenshots ==
1. Timeline and History Slider
2. Timeline and History Backend Listing Page
3. Timeline and History Edit Page

== Changelog ==

= 1.0.7 (22, Apr 2017) =
* [+] Added 'image_size' parameter to shortcode to choose your desired WordPress registered image size.
* [+] Added 'Font Awesome' (FA) support to [th-slider] design 3.
* [*] Taken better care of slider 'CenterMode' effect. Now design will not be disturbed with even number of slide or slides equal to total limit.
* [*] Resolved Background Color issue in slider design 1.
* [*] Resolved 'fa_icon_color' not working when post format icon is coming.
* [*] Resolved line break issue when 'Show Full Content' is set to true.
* [*] Resolved post title and date is not showing when show_content is set to false in timeline slider design.
* [*] Resolved some design issues.

= 1.0.6 (12, Jan 2017) =
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.
* [*] Resolved some design issues in IE and Safari.
* [*] Resolved some CSS issues.

= 1.0.5 (24, Dec 2016) =
* [+] Added 'Visual Composer' page builder support.

= 1.0.4 (19, Dec 2016) =
* [+] Added 'show_title' shortcode parameter to show/hide post title.
* [+] Added 'link' shortcode parameter to show/hide post link from all.
* [+] Added Custom icon functionality to upload your custom icon instead of FA icon.
* [+] Added 'Post Format' support to timeline and history slider post.
* [+] Added 'Menu Order' support to WordPress default post for custom order.
* [*] Resolved 'Timeline Slider' navigation issue with even number of slide.

= 1.0.3 (11, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated Font Awesome CSS to latest version 4.7.0

= 1.0.2 =
* Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.0.1 =
* Fixed some css bug

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.0.7 (22, Apr 2017) =
* [+] Added 'image_size' parameter to shortcode to choose your desired WordPress registered image size.
* [+] Added 'Font Awesome' (FA) support to [th-slider] design 3.
* [*] Taken better care of slider 'CenterMode' effect. Now design will not be disturbed with even number of slide or slides equal to total limit.
* [*] Resolved Background Color issue in slider design 1.
* [*] Resolved 'fa_icon_color' not working when post format icon is coming.
* [*] Resolved line break issue when 'Show Full Content' is set to true.
* [*] Resolved post title and date is not showing when show_content is set to false in timeline slider design.
* [*] Resolved some design issues.

= 1.0.6 (12, Jan 2017) =
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.
* [*] Resolved some design issues in IE and Safari.
* [*] Resolved some CSS issues.

= 1.0.5 (24, Dec 2016) =
* [+] Added 'Visual Composer' page builder support.

= 1.0.4 (19, Dec 2016) =
* [+] Added 'show_title' shortcode parameter to show/hide post title.
* [+] Added 'link' shortcode parameter to show/hide post link from all.
* [+] Added Custom icon functionality to upload your custom icon instead of FA icon.
* [+] Added 'Post Format' support to timeline and history slider post.
* [+] Added 'Menu Order' support to WordPress default post for custom order.
* [*] Resolved 'Timeline Slider' navigation issue with even number of slide.

= 1.0.3 (11, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated Font Awesome CSS to latest version 4.7.0

= 1.0.2 =
* Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.0.1 =
* Fixed some css bug.

= 1.0 =
* Initial release.