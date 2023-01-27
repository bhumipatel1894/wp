=== WP Featured Content and Slider Pro ===
Contributors: wponlinesupport
Tags: content slider, slider, featured, post slider, custom post slider, custom post type display, featured content, featured services , featured content rotator, featured content slider, Product slider, content gallery, content slideshow, featured content slideshow, featured posts, featured content slider
Requires at least: 3.5
Tested up to: 4.6.1
Stable tag: trunk

A quick, easy way to add and display what features your company, product or service offers, using our shortcode OR template code.

== Description ==
Many CMS site needs to display Featured Content/Featured services on website. "WP Featured Content and Slider Pro" is a clean and easy-to-use features showcase
management system for WordPress. Display Featured Content/Featured services, features your product, company or services offers, and display them via a shortcode OR template code.

View [DEMO](http://demo.wponlinesupport.com/prodemo/pro-wp-featured-content-and-slider/) for more details. 

**We have given 20 designs with 3 shortcode.**
<code>[featured-cnt-icon-img] [featured-cnt-icon] and [featured-cnt-img]</code>

Where you can display Featured Content in list view, in grid view and Featured Content Slider with carousel.
You can also select design theme from "Featured Content -> Featured Content Designs".


= Shortcode Examples =

<code>
1. Featured content with icon design
[featured-cnt-icon type="grid"] [featured-cnt-icon type="slider"]

2. Featured content with image design
[featured-cnt-img type="grid"] [featured-cnt-img type="slider"]

3. Featured content with icon and image design
[featured-cnt-icon-img type="grid"] [featured-cnt-icon-img type="slider"]
</code>


= You can use Following parameters with shortcode =

<code>[featured-cnt-icon]</code>

* **Type:** [featured-cnt-icon type="grid"] (Display featured content in a grid or in a slider. Values are 'grid' and 'slider'.)
* **Limit:** [featured-cnt-icon limit="5"] (Display latest number of featured content on your website.)
* **Grid:** [featured-cnt-icon grid="2"]  (Display featured content in grid view. Values are 1,2,3 and 4.)
* **Design:** [featured-cnt-icon design="design-1"] (Choose design for featured content. Designs are design-1, design-2, design-3, design-4, design-5, design-6, design-7.)
* **Post Type:** [featured-cnt-icon post_type="featured_post"] (If your site have already featured content and if you want to use our plugin design then you can simply switch the plugin post type without writing the content again.)
* **Taxonomy:** [featured-cnt-icon taxonomy="wpfcas-category"] (You can switch plugin category.)
* **Category:** [featured-cnt-icon cat_id="category_id"] (Display featured content categories wise.)
* **Fa Icon Color:** [featured-cnt-icon fa_icon_color="#000000"] (Change the color of Font Awesome Icon.)
* **Image Style:** [featured-cnt-icon image_style="square"]  (Image style "square" OR "circle". Note parameter works with design-1, design-2, design-3, design-8, design-9 and design-20.)
* **Display Read More Button : ** [featured-cnt-icon display_read_more="true"]  (Display Read More Button OR Not. Values are "true" and "false".)
* **Content Words Limit:** [featured-cnt-icon content_words_limit="50"]  (Display the words limit in the content section.)
* **Show Content:** [featured-cnt-icon show_content="true"]  (Show short content or not. By default value is "true". Values are "true" and "false".)
* **Link Target :** [featured-cnt-icon link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order:** [featured-cnt-icon order="DESC"] (Controls featured content post order. Values are "ASC" OR "DESC".)
* **Orderby :** [featured-cnt-icon orderby="post_date"] (Display featured content post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Content Tail :** [featured-cnt-icon content_tail="..."] (Display dots after the post content.)
* **Read More Text :** [featured-cnt-icon read_more_text="More"] (Control featured content post read more button text.)
* **Posts :** [featured-cnt-icon posts="1,5,6"] (Display only specific featured content posts.)
* **Exclude Post :** [featured-cnt-icon exclude_post="1,5,6"] (Exclude some featured content post which you do not want to display.)
* **Exclude Category :** [featured-cnt-icon exclude_cat="1,5,6"] (Exclude some featured content category which you do not want to display.)

The slider parameters with shortcode.
Note : Slider parameters works with type="slider"

* **Slides Column :** [featured-cnt-icon slides_column="3"] ( Display number of Featured Content Post at a time.)
* **Slides Scroll :** [featured-cnt-icon slides_scroll="1"] ( Scroll number of Featured Content Post at a time.)
* **Pagination and arrows:** [featured-cnt-icon dots="false" arrows="false"] (Display slider navigation dots and prev-next arrows.)
* **Autoplay:** [featured-cnt-icon autoplay="true"] (Enable slider auto play.)
* **Autoplay Interval:** [featured-cnt-icon autoplay_interval="3000"] (Set slider slide interval time.)
* **Slide Speed:** [featured-cnt-icon speed="300"] (Set slider speed.)
* **Infinite:** [featured-cnt-icon infinite="true"] (Enable contineous sliding. Values are “true” OR “false”)
* **Centermode:** [featured-cnt-icon centermode="true"] (Enable slider center mode feature. Values are “true” OR “false”. Note use with odd number of 'Slides Column' and 'Slides Scroll'.)

= You can use Following parameters with shortcode =
<code>[featured-cnt-img]</code>

* **Type:** [featured-cnt-img type="grid"] (Display featured content in a grid or in a slider. Values are 'grid' and 'slider'.)
* **Limit:** [featured-cnt-img limit="5"] (Display latest number of featured content on your website.)
* **Grid:** [featured-cnt-img grid="2"]  (Display featured content in grid view. Values are 1,2,3 and 4.)
* **Design:** [featured-cnt-img design="design-1"] (Choose design for featured content. Designs are design-10, design-11, design-12, design-13, design-14, design-15, design-16, design-17, design-18, design-19. Note design-13 and design-15 will not work with slider.)
* **Post Type:** [featured-cnt-img post_type="featured_post"] (If your site have already featured content and if you want to use our plugin design then you can simply switch the plugin post type without writing the content again.)
* **Taxonomy:** [featured-cnt-img taxonomy="wpfcas-category"] (You can switch plugin category.)
* **Category:** [featured-cnt-img cat_id="category_id"] (Display featured content categories wise.)
* **Fa Icon Color:** [featured-cnt-img fa_icon_color="#000000"] (Change the color of Font Awesome Icon.)
* **Image Style:** [featured-cnt-img image_style="square"]  (Image style "square" OR "circle". Note parameter works with design-1, design-2, design-3, design-8, design-9 and design-20.)
* **Display Read More Button : ** [featured-cnt-img display_read_more="true"]  (Display Read More Button OR Not. Values are "true" and "false".)
* **Content Words Limit:** [featured-cnt-img content_words_limit="50"]  (Display the words limit in the content section.)
* **Show Content:** [featured-cnt-img show_content="true"]  (Show short content or not. By default value is "true". Values are "true" and "false".)
* **Link Target :** [featured-cnt-img link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order:** [featured-cnt-img order="DESC"] (Controls featured content post order. Values are "ASC" OR "DESC".)
* **Orderby :** [featured-cnt-img orderby="post_date"] (Display featured content post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Content Tail :** [featured-cnt-img content_tail="..."] (Display dots after the post content.)
* **Read More Text :** [featured-cnt-img read_more_text="More"] (Control featured content post read more button text.)
* **Posts :** [featured-cnt-img posts="1,5,6"] (Display only specific featured content posts.)
* **Exclude Post :** [featured-cnt-img exclude_post="1,5,6"] (Exclude some featured content post which you do not want to display.)
* **Exclude Category :** [featured-cnt-img exclude_cat="1,5,6"] (Exclude some featured content category which you do not want to display.)

The slider parameters with shortcode.
Note : Slider parameters works with type="slider"

* **Slides Column :** [featured-cnt-img slides_column="3"] ( Display number of Featured Content Post at a time.)
* **Slides Scroll :** [featured-cnt-img slides_scroll="1"] ( Scroll number of Featured Content Post at a time.)
* **Pagination and arrows:** [featured-cnt-img dots="false" arrows="false"] (Display slider navigation dots and prev-next arrows.)
* **Autoplay:** [featured-cnt-img autoplay="true"] (Enable slider auto play.)
* **Autoplay Interval:** [featured-cnt-img autoplay_interval="3000"] (Set slider slide interval time.)
* **Slide Speed:** [featured-cnt-img speed="300"] (Set slider speed.)
* **Infinite:** [featured-cnt-img infinite="true"] (Enable contineous sliding. Values are “true” OR “false”)
* **Centermode:** [featured-cnt-img centermode="true"] (Enable slider center mode feature. Values are “true” OR “false”. Note use with odd number of 'Slides Column' and 'Slides Scroll'.)

= You can use Following parameters with shortcode =
<code>[featured-cnt-icon-img]</code>

* **Type:** [featured-cnt-icon-img type="grid"] (Display featured content in a grid or in a slider. Values are 'grid' and 'slider'.)
* **Limit:** [featured-cnt-icon-img limit="5"] (Display latest number of featured content on your website.)
* **Grid:** [featured-cnt-icon-img grid="2"]  (Display featured content in grid view. Values are 1,2,3 and 4.)
* **Design:** [featured-cnt-icon-img design="design-1"] (Choose design for featured content. Designs are design-8, design-9, design-20.)
* **Post Type:** [featured-cnt-icon-img post_type="featured_post"] (If your site have already featured content and if you want to use our plugin design then you can simply switch the plugin post type without writing the content again.)
* **Taxonomy:** [featured-cnt-icon-img taxonomy="wpfcas-category"] (You can switch plugin category.)
* **Category:** [featured-cnt-icon-img cat_id="category_id"] (Display featured content categories wise.)
* **Fa Icon Color:** [featured-cnt-icon-img fa_icon_color="#000000"] (Change the color of Font Awesome Icon.)
* **Image Style:** [featured-cnt-icon-img image_style="square"]  (Image style "square" OR "circle". Note parameter works with design-1, design-2, design-3, design-8, design-9 and design-20.)
* **Display Read More Button : ** [featured-cnt-icon-img display_read_more="true"]  (Display Read More Button OR Not. Values are "true" and "false".)
* **Content Words Limit:** [featured-cnt-icon-img content_words_limit="50"]  (Display the words limit in the content section.)
* **Show Content:** [featured-cnt-icon-img show_content="true"]  (Show short content or not. By default value is "true". Values are "true" and "false".)
* **Link Target :** [featured-cnt-icon-img link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order:** [featured-cnt-icon-img order="DESC"] (Controls featured content post order. Values are "ASC" OR "DESC".)
* **Orderby :** [featured-cnt-icon-img orderby="post_date"] (Display featured content post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Content Tail :** [featured-cnt-icon-img content_tail="..."] (Display dots after the post content.)
* **Read More Text :** [featured-cnt-icon-img read_more_text="More"] (Control featured content post read more button text.)
* **Posts :** [featured-cnt-icon-img posts="1,5,6"] (Display only specific featured content posts.)
* **Exclude Post :** [featured-cnt-icon-img exclude_post="1,5,6"] (Exclude some featured content post which you do not want to display.)
* **Exclude Category :** [featured-cnt-icon-img exclude_cat="1,5,6"] (Exclude some featured content category which you do not want to display.)

The slider parameters with shortcode.
Note : Slider parameters works with type="slider"

* **Slides Column :** [featured-cnt-icon-img slides_column="3"] ( Display number of Featured Content Post at a time.)
* **Slides Scroll :** [featured-cnt-icon-img slides_scroll="1"] ( Scroll number of Featured Content Post at a time.)
* **Pagination and arrows:** [featured-cnt-icon-img dots="false" arrows="false"] (Display slider navigation dots and prev-next arrows.)
* **Autoplay:** [featured-cnt-icon-img autoplay="true"] (Enable slider auto play.)
* **Autoplay Interval:** [featured-cnt-icon-img autoplay_interval="3000"] (Set slider slide interval time.)
* **Slide Speed:** [featured-cnt-icon-img speed="300"] (Set slider speed.)
* **Infinite:** [featured-cnt-icon-img infinite="true"] (Enable contineous sliding. Values are “true” OR “false”)
* **Centermode:** [featured-cnt-icon-img centermode="true"] (Enable slider center mode feature. Values are “true” OR “false”. Note use with odd number of 'Slides Column' and 'Slides Scroll'.)


= Here is Template code =
<code><?php echo do_shortcode('[featured-cnt-icon]'); ?> </code>
<code><?php echo do_shortcode('[featured-cnt-img]'); ?> </code>
<code><?php echo do_shortcode('[featured-cnt-icon-img]'); ?> </code>


= Available fields : =
* Title
* Contents
* Read More Link
* Add either Featured Image OR Font Awesome Icons (Note: for some design you can us both)

== Installation ==

1. Upload the 'WP Featured Content and Slider Pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "WP Featured Content and Slider Pro" list plugin through the 'Plugins' menu in WordPress.
3. Add a new page and add the respective shortcode.

== Changelog ==

= 1.2.1 (11, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated Font Awesome CSS to latest version 4.7.0
* [*] Updated Post type and Category parameters.
* [*] Optimized some CSS.

= 1.2 (26, Sep 2016) =
* [*] Resolved some css issues.
* [+] Added 15 new designs.

= 1.1 (13, Sep 2016) =
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.0 (09, June 2016) =
* Initial release.


== Upgrade Notice ==

= 1.2.1 (11, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated Font Awesome CSS to latest version 4.7.0
* [*] Updated Post type and Category parameters.
* [*] Optimized some CSS.

= 1.2 (26, Sep 2016) =
* [*] Resolved some css issues.
* [+] Added 15 new designs.

= 1.1 (13, Sep 2016) =
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.0 (09, June 2016) =
* Initial release.