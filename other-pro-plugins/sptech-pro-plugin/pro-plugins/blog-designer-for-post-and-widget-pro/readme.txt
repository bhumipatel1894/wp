=== Blog Designer - Post and Widget Pro  ===
Contributors: wponlinesupport, anoopranawat 
Tags: wordpress blog , wordpress blog widget, Free wordpress blog, blog custom post type, blog tab, blog menu, blog page with custom post type, blog, latest blog, custom post type, cpt, widget
Requires at least: 3.1
Tested up to: 4.6.1
Author URI: http://wponlinesupport.com
Stable tag: trunk

A quick, easy way to add WP Stylist Post designs to your WordPress website.

== Description ==

Blog Designer - Post and Widget Pro display WordPress posts with multiple designs . You can display latest post on your homepage/frontpage as well as in inner pages with around 36 designs.

**This wordpress plugin contains 3 shorcode**

1) Recent Posts Slider/Carousel
<code>[wpspw_recent_post_slider]</code>

Where Designs for this shortcode is : design-1, design-2, design-3, design-4, design-5, design-6, design-7, design-8, design-9, design-10, design-11, design-12, design-13, design-14, design-15, design-32, design-33, design-38

2) Recent Post with Grid View
<code>[wpspw_recent_post]</code>

Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-25, design-26, design-27, design-28, design-29, design-31, design-34, design-35, design-37 

3) Post with Grid View
<code>[wpspw_post limit="10"]</code>

Where designs are : design-16, design-17, design-18, design-19, design-20, design-21, design-22, design-24, design-25, design-26, design-27, design-30, design-34, design-35, design-36, design-37 


* **Complete shortcode example:**
<code>[wpspw_recent_post_slider design="design-1" show_author="true" slides_column="1"
 slides_scroll="1" dots="true" arrows="true" autoplay="true" autoplay_interval="3000"
 speed="300" loop="true" limit="5" category="5" category_name="Sports" show_read_more="false"
 show_date="true" show_category_name="true" show_content="true" content_words_limit="20"]</code>
 
 <code>[wpspw_recent_post design="design-16" limit="5" grid="2" show_author="true"
 category="5" category_name="Sports" show_date="true" show_category_name="true" show_content="true"
 content_words_limit="20" show_read_more="false"]</code>
 
 <code>[wpspw_post design="design-16" limit="5" grid="2" show_author="true" category="5" category_name="Sports"
 pagination="true" show_date="true" show_category_name="true" show_content="true" show_full_content="true"
 content_words_limit="20" show_read_more="false"]</code>



= Following are shortcode Parameters: =

<code>[wpspw_post] </code>

* **Limit :** [wpspw_post limit="10"] (Display latest 10 post and then pagination).
* **Category :** [wpspw_post category="category_id"] (Display post categories wise).
* **Grid :** [wpspw_post grid="2"] (Display post in Grid formats. You can use grid:1,2,3,4).
* **Design :** [wpspw_post design="design-16"] (Select the designs for post. Select the design shortcode from Pro -> Pro Designs)
* **Show Author :** [wpspw_post show_author="true"] (Display author OR not. By default value is “true”. Values are “true” OR “false” )
* **Pagination:** [wpspw_post pagination="false"] (Show/Hide pagination links. By default value is “false”. Values are “true” and “false”)
* **Show Content :** [wpspw_post show_content="true" ] (Display post Short content OR not. By default value is “True”. Options are “true OR false”).
* **Show Full Content :** [wpspw_post show_full_content="true"] (Display Full content on main page if you do not want word limit. By default value is “false”)
* **Show Date :** [wpspw_post show_date="false"] (Display date OR not. By default value is “true”. Options are “true OR false”)
* **Show Category Name :** [wpspw_post show_category_name="true" ] (Display post category name OR not. By default value is “true”. Options are “true OR false”).
* **Content Words Limit :** [wpspw_post content_words_limit="30" ] (Control post short content Words limit. By default limit is 20 words).
* **Show Read More :** [wpspw_post show_read_more="false"](Show/Hide read more links. By default value is “true”. Values are “true” and “false”)
* **Content Tail :** [wpspw_post content_tail="..."] (Display dots after the post content.)
* **Order :** [wpspw_post order="DESC"] (Controls post order. Values are "ASC" OR "DESC".)
* **Orderby :** [wpspw_post orderby="post_date"] (Display post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [wpspw_post link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [wpspw_post image_height="500"] (Control post image height.)
* **Read More Text :** [wpspw_post read_more_text="More"] (Control post read more button text.)
* **Posts :** [wpspw_post posts="1,5,6"] (Display only specific posts.)
* **Exclude Post :** [wpspw_post exclude_post="1,5,6"] (Exclude some post which you do not want to display.)
* **Exclude Category :** [wpspw_post exclude_cat="1,5,6"] (Exclude some category which you do not want to display.)
* **Pagination Type :** [wpspw_post pagination_type="numeric"] (Display pagination style. Values are "numeric" OR "prev-next".)

= Following are Recent Post Parameters: =

<code>[wpspw_recent_post]</code>

* **Limit :** [wpspw_recent_post limit="10"] (Display latest 10 post and then pagination).
* **Category :** [wpspw_recent_post category="category_id"] (Display post categories wise).
* **Grid :** [wpspw_recent_post grid="2"] (Display post in Grid formats. You can use grid:1,2,3,4).
* **Category Name :** [wpspw_recent_post category_name="Sports"](Display categories name).
* **Design :** [wpspw_recent_post design="design-16"] (Select the designs for post. Select the design shortcode from Pro -> Pro Designs)
* **Show Author :** [wpspw_recent_post show_author="true"] (Display author OR not. By default value is “true”. Values are “true” OR “false” )
* **Show Content :** [wpspw_recent_post show_content="true" ] (Display post Short content OR not. By default value is “True”. Options are “true OR false”).
* **Show Date :** [wpspw_recent_post show_date="false"] (Display date OR not. By default value is “true”. Options are “true OR false”)
* **Show Category Name :** [wpspw_recent_post show_category_name="true" ] (Display post category name OR not. By default value is “true”. Options are “true OR false”).
* **Content Words Limit :** [wpspw_recent_post content_words_limit="30" ] (Control post short content Words limit. By default limit is 20 words).
* **Show Read More :** [wpspw_recent_post show_read_more="false"](Show/Hide read more links. By default value is “true”. Values are “true” and “false”)
* **Content Tail :** [wpspw_recent_post content_tail="..."] (Display dots after the post content.)
* **Order :** [wpspw_recent_post order="DESC"] (Controls post order. Values are "ASC" OR "DESC".)
* **Orderby :** [wpspw_recent_post orderby="post_date"] (Display post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [wpspw_recent_post link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [wpspw_recent_post image_height="500"] (Control post image height.)
* **Read More Text :** [wpspw_recent_post read_more_text="More"] (Control post read more button text.)
* **Posts :** [wpspw_recent_post posts="1,5,6"] (Display only specific posts.)
* **Exclude Post :** [wpspw_recent_post exclude_post="1,5,6"] (Exclude some post which you do not want to display.)
* **Exclude Category :** [wpspw_recent_post exclude_cat="1,5,6"] (Exclude some category which you do not want to display.)

= Following are Recent Post Parameters: =

<code>[wpspw_recent_post_slider]</code>

* **Slides Column :** [wpspw_recent_post_slider slides_column="3"] (ie Display number of Post at a time.)
* **Slides Scroll :** [wpspw_recent_post_slider slides_scroll="1"] (ie scroll number of Post at a time.)
* **Pagination and Arrows:** [wpspw_recent_post_slider dots="false" arrows="false"]
* **Autoplay and Autoplay Interval:** [wpspw_recent_post_slider autoplay="true" autoplay_interval="100"]
* **Slide Speed:** [wpspw_recent_post_slider speed="3000"]
* **Loop:** [wpspw_recent_post_slider loop="true"](values are “true” OR “false”)
* **Limit :** [wpspw_recent_post_slider limit="10"] (Display latest 10 post in slider).
* **Category :** [wpspw_recent_post_slider category="category_id"] (Display post categories wise).
* **Design :** [wpspw_recent_post_slider design="design-1"] (Select the designs for post. Select the design shortcode from Pro -> Pro Designs)
* **Show Date :** [wpspw_recent_post_slider show_date="false"] (Display date OR not. By default value is “true”. Options are “true OR false”)
* **Show Content :** [wpspw_recent_post_slider show_content="true" ] (Display post Short content OR not. By default value is “True”. Options are “true OR false”).
* **Show Category Name :** [wpspw_recent_post_slider show_category_name="true"] (Display post category name OR not. By default value is “true”. Options are “true OR false”).
* **Content Words Limit :** [wpspw_recent_post_slider content_words_limit="30"] (Control post short content Words limit. By default limit is 20 words).
* **Show Read More :** [wpspw_recent_post_slider show_read_more="false"](Show/Hide read more links. By default value is “true”. Values are “true” and “false”)
* **Content Tail :** [wpspw_recent_post_slider content_tail="..."] (Display dots after the post content.)
* **Order :** [wpspw_recent_post_slider order="DESC"] (Controls post order. Values are "ASC" OR "DESC".)
* **Orderby :** [wpspw_recent_post_slider orderby="post_date"] (Display post in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [wpspw_recent_post_slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Image Height :** [wpspw_recent_post_slider image_height="500"] (Control post image height.)
* **Read More Text :** [wpspw_recent_post_slider read_more_text="More"] (Control post read more button text.)
* **Posts :** [wpspw_recent_post_slider posts="1,5,6"] (Display only specific posts.)
* **Exclude Post :** [wpspw_recent_post_slider exclude_post="1,5,6"] (Exclude some post which you do not want to display.)
* **Exclude Category :** [wpspw_recent_post_slider exclude_cat="1,5,6"] (Exclude some category which you do not want to display.)

Post Ticker Shortcode
<code>[wpspw_ticker]</code>
* **Limit :** [wpspw_ticker limit="10"] (Display latest 10 News post in ticker.)
* **Category :** [wpspw_ticker category="category_id"] (Display News post categories wise.)
* **Include Child Cat Post :** [wpspw_ticker include_cat_child="true"] (Display News Child Category.)
* **Order :** [wpspw_ticker order="DESC"] (Controls News post order. Values are "ASC" OR "DESC".)
* **Orderby :** [wpspw_ticker orderby="date"] (Display News post in your order. Values are "date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order", "comment_count")
* **Link Target :** [wpspw_ticker link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Posts :** [wpspw_ticker posts="1,5,6"] (Display only specific News posts.)
* **Exclude Post :** [wpspw_ticker exclude_post="1,5,6"] (Exclude some news post which you do not want to display.)
* **Ticker Title :** [wpspw_ticker ticker_title="Latest News"] (Set your ticker title.)
* **Theme Color :** [wpspw_ticker theme_color="#2096cd"] (Set your ticker theme color.)
* **Heading Font Color :** [wpspw_ticker heading_font_color="#fff"] (Set Heading font color.)
* **Font Color :** [wpspw_ticker font_color="#2096cd"] (Set your ticker font color.)
* **Font Style :** [wpspw_ticker font_style="normal"] (Set ticker font style.)
* **Ticker Effect :** [wpspw_ticker ticker_effect="fade"] (Set ticker effect by this parameter.)
* **AutoPlay :** [wpspw_ticker autoplay="true"] (Start ticker automatically.)
* **Speed :** [wpspw_ticker speed="3000"] (Set ticker speed.)
* **Exclude Category :** [wpspw_ticker exclude_cat="1,5"] (Exclude those post that you don't want to display.)
* **Query Offset :** [wpspw_ticker query_offset=""] (Exclude some news post.)

== Changelog ==

= 1.1 (Dec 02, 2016) =
* [+] Added 'News Ticker' for Post.
* [+] Added 'How It Work' page for better user interface.
* [+] Added 'Pagination' for post to 'wpspw_post' shortcode.
* [+] Added plugin settings to customize post title, color and etc.

= 1.0 =
* Initial release.


== Upgrade Notice ==

= 1.1 (Dec 02, 2016) =
* [+] Added 'News Ticker' for Post.
* [+] Added 'How It Work' page for better user interface.
* [+] Added 'Pagination' for post to 'wpspw_post' shortcode.
* [+] Added plugin settings to customize post title, color and etc.

= 1.0 =
* Initial release.