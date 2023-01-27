=== WP Logo Showcase Responsive Slider ===
Contributors: wponlinesupport, anoopranawat 
Tags: logo slider, widget, client logo carousel, client logo slider, client, customer,  image carousel, carousel, logo showcase, Responsive logo slider, Responsive logo carousel, WordPress logo slider, WordPress logo carousel, slick carousel, Best logo showcase, easy logo slider, logo carousel wordpress, logo slider wordpress, sponsors, sponsors slider, sponsors carousel
Requires at least: 3.1
Tested up to: 4.6.1

A quick, easy way to add and display Multiple reponsive logo slideshow carousel to your site quickly and easily.

== Description ==
Many CMS site needs to display logo slideshow responsive slider/carousel on their website. WP Logo Showcase Responsive Slider help to display partners, 
clients or sponsor's Logo in your WordPress site quickly and easily. Using WP Logo Showcase Responsive slider/carousel plugin creating a carousel 
slider of logos like client logo slider, partners logo slider, sponsor logo slider is super easy. 

View [DEMO](http://demo.wponlinesupport.com/prodemo/pro-logo-showcase-responsive-slider/) for additional information.

There are three shortcodes

= Here is the shortcode example =
<code>[logoshowcase]</code> - Slider Shortcode
<code>[logo_grid]</code> - Logo Grid Shortcode
<code>[logo_filter]</code> - Logo Filter Shortcode

= Complete shortcode with all parameters =
Slider Shortcode
<code>[logoshowcase limit="5" cat_id="8,10" cat_name="My Logo" design="design-1" slides_column="3" slides_scroll="1" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="600" center_mode="false" loop="true" ticker="false" order="desc" orderby="date" link_target="blank" show_title="true" image_size="full" posts="10,15" exclude_cat="1,2" exclude_post="5,10" animation="tada" tooltip="true" content_words_limit="20" content_tail="..."]</code>

Logo Grid Shortcode
[logo_grid limit="5" grid="4" cat_id="8,10" cat_name="My Logo" design="design-1" order="desc" orderby="date" link_target="blank" show_title="true" image_size="full" posts="10,15" exclude_cat="1,2" exclude_post="5,10" animation="tada" tooltip="true" content_words_limit="20" content_tail="..."]

Logo Filter Shortcode
[logo_filter limit="5" design="design-1" cat_id="8,10" grid="4" order="desc" orderby="post_date" link_target="blank" show_title="true" image_size="full" cat_limit="10" cat_order="asc" cat_orderby="name" exclude_cat="5,10" tooltip="true" include_cat_child="true" all_filter_text="All" content_words_limit="20" content_tail="..."]

= Use Following parameters with shortcode =
<code>[logoshowcase]</code>
* **Limit:** [logoshowcase limit="5"] (Display number of logos. To display all logos pass limit="-1".)
* **Design** : [logoshowcase design="design-1"] (You can select 16 design for logo slider. Designs are design-1 to design-16.)
* **Category** : [logoshowcase  cat_id="category_ID"] (Display Logos by their category ID.)
* **Include Cat Child**: [logoshowcase include_cat_child="true"] (Display child category slides. Values are "true" OR "false".)
* **Display Heading:** [logoshowcase cat_name="category name"] (Display heading above logo slider.)
* **Slides Column :** [logoshowcase slides_column="3"] (Display number of logos at a time in slider.)
* **Slides to Scroll :** [logoshowcase slides_scroll="1"] (Scroll number of logos at a time.)
* **Slider Pagination and arrows** : [logoshowcase dots="false" arrows="false"]
* **Autoplay : ** [logoshowcase autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval : ** [logoshowcase autoplay_interval="3000"] (Delay between two slides.)
* **Slider Speed**: [logoshowcase speed="3000"] (Control speed of slider.)
* **Centermode** : [logoshowcase centermode="true"] (Enables centered view with partial prev/next slides. Use with odd numbered slides_scroll counts and slides_column="1". By default value is "false".)
* **Slider Loop** : [logoshowcase loop="true"] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false".)
* **Slider Ticker** : [logoshowcase ticker="true"] (Runs the slider contineously like ticker. Options are "ture OR false".)
* **Order :** [logoshowcase order="DESC"] (Controls slides order. Values are "ASC" OR "DESC".)
* **Orderby :** [logoshowcase orderby="post_date"] (Display logos in your order. Values are "post_date", "modified", "title", "ID", "rand" (Random), "menu_order" (Sort Order).)
* **Link Target :** [logoshowcase link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Show Logo Title:** [logoshowcase show_title="false"] (Show logo title or not. Values are "true" and "false") 
* **Logo Image Size:** [logoshowcase image_size="full"] (Set image size of logo. By default value is "full". Values are "full, large, medium, thumbnail".)
* **Exclude Category :** [logoshowcase exclude_cat="1,5,6"] (Exclude some logo category which you do not want to display.)
* **Exclude Post :** [logoshowcase exclude_post="1,5,6"] (Exclude some logo which you do not want to display.)
* **Display Specific Posts :** [logoshowcase posts="1,5,6"] (Display only specific slides.)
* **Animation :** [logoshowcase animation="tada"] (Enable animation effect on logo. There are 15 animation effect.)
* **Tooltip :** [logoshowcase tooltip="true"] (Enable tooltip on logo. Values are "true" OR "false".)
* **Words Limit :** [logoshowcase content_words_limit="20"] (Controls content word limit. Note: Works with only design 4.)
* **Content Tail :** [logoshowcase content_tail="..."] (Display three dots after the content. Note: Works with only design 4.)


<code>[logo_grid]</code>
* **Limit:** [logo_grid limit="5"] (Display number of logos. To display all logos pass limit="-1".)
* **Design** : [logo_grid design="design-1"] (You can select 16 design for logo slider. Designs are design-1 to design-16.)
* **Category** : [logo_grid  cat_id="category_ID"] (Display Logos by their category ID.)
* **Include Cat Child**: [logo_grid include_cat_child="true"] (Display child category slides. Values are "true" OR "false".)
* **Display Heading:** [logo_grid cat_name="category name"] (Display heading above logo slider.)
* **Grid :** [logo_grid grid="3"] (Controls the logo columns.)
* **Order :** [logo_grid order="DESC"] (Controls slides order. Values are "ASC" OR "DESC".)
* **Orderby :** [logo_grid orderby="post_date"] (Display logos in your order. Values are "post_date", "modified", "title", "ID", "rand" (Random), "menu_order" (Sort Order).)
* **Link Target :** [logo_grid link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Show Logo Title:** [logo_grid show_title="false"] (Show logo title or not. Values are "true" and "false") 
* **Logo Image Size:** [logo_grid image_size="full"] (Set image size of logo. By default value is "full". Values are "full, large, medium, thumbnail".)
* **Exclude Category :** [logo_grid exclude_cat="1,5,6"] (Exclude some logo category which you do not want to display.)
* **Exclude Post :** [logo_grid exclude_post="1,5,6"] (Exclude some logo which you do not want to display.)
* **Display Specific Posts :** [logo_grid posts="1,5,6"] (Display only specific slides.)
* **Animation :** [logo_grid animation="tada"] (Enable animation effect on logo. There are 15 animation effect.)
* **Tooltip :** [logo_grid tooltip="true"] (Enable tooltip on logo. Values are "true" OR "false".)
* **Words Limit :** [logo_grid content_words_limit="20"] (Controls content word limit. Note: Works with only design 4.)
* **Content Tail :** [logo_grid content_tail="..."] (Display three dots after the content. Note: Works with only design 4.) 


<code>[logo_filter]</code>
* **Design** : [logo_filter design="design-1"] (You can select 16 design for logo slider. Designs are design-1 to design-16.)
* **Limit:** [logo_filter limit="5"] (Display number of logos. To display all logos pass limit="-1".)
* **Category** : [logo_filter  cat_id="category_ID"] (Display Logos by their category ID.)
* **Include Cat Child**: [logo_filter include_cat_child="true"] (Display child category slides. Values are "true" OR "false".)
* **Display Heading:** [logo_filter cat_name="category name"] (Display heading above logo slider.)
* **Grid :** [logo_filter grid="3"] (Controls the logo columns.)
* **Order :** [logo_filter order="DESC"] (Controls slides order. Values are "ASC" OR "DESC".)
* **Orderby :** [logo_filter orderby="post_date"] (Display logos in your order. Values are "post_date", "modified", "title", "ID", "rand" (Random), "menu_order" (Sort Order).)
* **Category Limit :** [logo_filter cat_limit="10"] (Number of categories to be displayed for category filter. To display all category pass cat_limit="0".)
* **Category Order :** [logo_filter cat_order="asc"] (Controls category order. Values are "ASC" OR "DESC".)
* **Category Orderby :** [logo_filter cat_orderby="name"] (Display category in your order. Values are "name", "term_id" and "count".)
* **Link Target :** [logo_filter link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Show Logo Title:** [logo_filter show_title="false"] (Show logo title or not. Values are "true" and "false") 
* **Logo Image Size:** [logo_filter image_size="full"] (Set image size of logo. By default value is "full". Values are "full, large, medium, thumbnail".)
* **Exclude Category :** [logo_filter exclude_cat="1,5,6"] (Exclude some logo category which you do not want to display.)
* **Tooltip :** [logo_filter tooltip="true"] (Enable tooltip on logo. Values are "true" OR "false".)
* **Words Limit :** [logo_filter content_words_limit="20"] (Controls content word limit. Note: Works with only design 4.)
* **Content Tail :** [logo_filter content_tail="..."] (Display three dots after the content. Note: Works with only design 4.) 


= Features include: =
* 15+ predefined template for logo showcase.
* Display logo showcase in a grid view.
* Display logo with filtration.
* Display logo showcase in slider view.
* Created with versatile Slick Slider with various parameters.
* Slider RTL support.
* Display logo showcase categories wise.
* Display external logo.
* Add Link for logo and control link behaviour.
* Set image size for logo among WordPress image size.
* Display Logo with title and description.
* Visual Composer support.
* Drag & Drop features to display logo in your desired order.
* Logo Showcase with tooltip with 5 tooltip theme and various parameters.
* Add your custom css via plugin setting page.
* Various shortcode parametrs.
* Fully Responsive.
* 100% Multilanguage.

= Template code is =
<code><?php echo do_shortcode('[logoshowcase]'); ?></code>
<code><?php echo do_shortcode('[logo_grid]'); ?></code>
<code><?php echo do_shortcode('[logo_filter]'); ?></code>

== Installation ==

1. Upload the 'WP Logo Showcase Responsive Slider Pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "WP Logo Showcase Responsive Slider" list plugin through the 'Plugins' menu in WordPress.
3. Add a new page and add logo showcase shortcode.


== Changelog ==

= 1.3.1 (11, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Optimized some CSS.

= 1.3 (13, Sep 2016) =
* [*] Removed plugin license page from plugin section and added in 'Logo Showcase' menu.
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.2 (Aug, 05 2016) =
* [*] Resolved slider responsive column issue in mobile device.

= 1.1 (July, 23 2016) =
* [*] Resolved - Custom CSS not printing on head.
* [+] Resolved some CSS issue.

= 1.0 =
* Initial release.


== Upgrade Notice ==

= 1.3.1 (11, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Optimized some CSS.

= 1.3 (13, Sep 2016) =
* [*] Removed plugin license page from plugin section and added in 'Logo Showcase' menu.
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.2 (Aug, 05 2016) =
* [*] Resolved slider responsive column issue in mobile device.

= 1.1 (July, 23 2016) =
* [*] Resolved - Custom CSS not printing on head.
* [+] Resolved some CSS issue.

= 1.0 =
* Initial release.