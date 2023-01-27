=== Video gallery and Player Pro ===
Contributors: wponlinesupport
Tags: HTML5, video.js,  HTML5 video, youtube video gallery, vimeo video gallery, youtube video gallery with popup,  Youtube-video, youtube embed, youtube gallery, youtube player, magnific Popup, vimeo video gallery gallery, HTML5 video player, HTML5 video gallery, wordpress HTML5 video, wordpress HTML5 video player, wordpress HTML5 video gallery, responsive, wordpress responsive video gallery  
Requires at least: 3.1
Tested up to: 4.7.3

Easy to add and display your HTML5, YouTube, Vimeo video gallery with Magnific Popup to your website . 

== Description ==

This plugin add a responsive HTML5, YouTube, Vimeo vedio gallery with Magnific Popup to your  WordPress website. Display video gallery in grid view(1,2,3,4) etc
You can also use category id to create multiple vedio galleries.

View [DEMO](http://wponlinesupport.com/pro-plugin-document/document-video-gallery-player-pro/)  for more details.

The plugin adds a Video gallery tab to your admin menu, which allows you to enter Video Title and Video source items just as you would regular posts.

= Gallery Options: = 
* Create a YouTube gallery page.
* Create a Vimeo gallery page.
* Create a HTML5 Video gallery page.

= Display video in a Popup =
* Added Magnific Popup
 
With this video gallery plugin, you can create galleries from your youtube, vimeo and HTML5 videos. The process of creating a video gallery only takes a few minutes and created gallery can be displayed on any page or post by means of WordPress shortcode.

There are three shortcodes

= Here is the shortcode example =
<code>[video_gallery]</code> - Grid Shortcode
<code>[video_gallery_sallery]</code> - Slider Shortcode

= Template code is =
<code><?php echo do_shortcode('[video_gallery]'); ?></code>
<code><?php echo do_shortcode('[video_gallery_sallery]'); ?></code>

= Complete shortcode with all parameters =
Grid Shortcode
<code>[video_gallery limit="20" category="5,10" include_cat_child="true" grid="3" design="design-1" popup_fix="true" gallery_enable="true" show_title="true" show_content="true" order="desc" orderby="date" post="5,10" exclude_cat="5,10" exclude_post="5,10"]</code>

Slider Shortcode
<code>[video_gallery_slider limit="20" category="5,10" include_cat_child="true" design="design-1" popup_fix="true" gallery_enable="true" slide_to_show="3" slide_to_scroll="1" autoplay="true" autoplay_speed="3000" speed="300" arrows="true" loop="true" center_mode="true" show_title="true" show_content="false" order="desc" orderby="date" post="5,10" exclude_cat="5,10" exclude_post="5,10"]</code>


= Use Following parameters with shortcode =
<code>[video_gallery]</code>
* **Limit:** [video_gallery limit="5"] (Display number of videos. To display all videos pass limit="-1".)
* **Design :** [video_gallery design="design-1"] (Select designs for video grid. Designs are design-1 to design-19.)
* **Fix Popup:** [video_gallery popup_fix="true"] ( Popup setting ie fix or scroll with page. Default value is "false". Values are "true OR false".)
* **Popup Gallery:** [video_gallery gallery_enable="true"] (Enable gallery view video. Values are "true OR false".)
* **Category :** [video_gallery  category="category_ID"] (Display video by their category ID.)
* **Include Cat Child**: [video_gallery include_cat_child="true"] (Display child category video. Values are "true" OR "false".)
* **Grid :** [video_gallery grid="3"] (Controls the video columns.)
* **Show Title:** [video_gallery show_title="false"] (Show video title or not. Values are "true" and "false") 
* **Show Content:** [video_gallery show_content="true"] (Show video description or not. Values are "true" and "false") 
* **Order :** [video_gallery order="DESC"] (Controls video order. Values are "ASC" OR "DESC".)
* **Orderby :** [video_gallery orderby="post_date"] (Display video in your order. Values are "post_date", "modified", "title", "ID", "rand" (Random), "menu_order" (Sort Order).)
* **Display Specific Posts :** [video_gallery post="1,5,6"] (Display only specific video.)
* **Exclude Category :** [video_gallery exclude_cat="1,5,6"] (Exclude some video category which you do not want to display.)
* **Exclude Post :** [video_gallery exclude_post="1,5,6"] (Exclude some video which you do not want to display.)
* **Pagination :** [video_gallery pagination="true"] (Enable pagination. Values are "true" OR "false")
* **Pagination Type :** [video_gallery pagination_type="numeric"] (Choose pagination type. Values are "numeric" OR "prev-next")

<code>[video_gallery_slider]</code>
* **Limit:** [video_gallery_slider limit="5"] (Display number of videos. To display all videos pass limit="-1".)
* **Design :** [video_gallery_slider design="design-1"] (Select design for video slider. Designs are design-1 to design-19.)
* **Fix Popup:** [video_gallery_slider popup_fix="true"] ( Popup setting ie fix or scroll with page. Default value is "false". Values are "true OR false".)
* **Popup Gallery:** [video_gallery_slider gallery_enable="true"] (Enable gallery view video. Values are "true OR false".)
* **Category :** [video_gallery_slider  category="category_ID"] (Display video by their category ID.)
* **Include Cat Child**: [video_gallery_slider include_cat_child="true"] (Display child category video. Values are "true" OR "false".)
* **Show Title:** [video_gallery_slider show_title="false"] (Show video title or not. Values are "true" and "false") 
* **Show Content:** [video_gallery_slider show_content="true"] (Show video description or not. Values are "true" and "false") 
* **Order :** [video_gallery_slider order="DESC"] (Controls video order. Values are "ASC" OR "DESC".)
* **Orderby :** [video_gallery_slider orderby="post_date"] (Display video in your order. Values are "post_date", "modified", "title", "ID", "rand" (Random), "menu_order" (Sort Order).)
* **Display Specific Posts :** [video_gallery_slider post="1,5,6"] (Display only specific video.)
* **Exclude Category :** [video_gallery_slider exclude_cat="1,5,6"] (Exclude some video category which you do not want to display.)
* **Exclude Post :** [video_gallery_slider exclude_post="1,5,6"] (Exclude some video which you do not want to display.)
* **Slides Column :** [video_gallery_slider slide_to_show="3"] (Display number of video at a time in slider.)
* **Slides to Scroll :** [video_gallery_slider slide_to_scroll="1"] (Scroll number of video at a time.)
* **Slider Pagination and arrows** : [video_gallery_slider arrows="false"]
* **Autoplay :** [video_gallery_slider autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval : ** [video_gallery_slider autoplay_speed="3000"] (Delay between two slides.)
* **Slider Speed**: [video_gallery_slider speed="3000"] (Control speed of slider.)
* **Centermode** : [video_gallery_slider center_mode="true"] (Enables centered view with partial prev/next slides. Use with odd numbered slides_scroll counts and slides_column="1". By default value is "false".)
* **Slider Loop** : [video_gallery_slider loop="true"] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false".)

= Features include: =
* 19 Designs
* Grid View
* Slider/Carousel View
* Slider/Carousel with center mode
* Multiple display with category
* Editor support
* Drag and drop custom ordering
* Responsive
* Popup gallery slider
* Fully Responsive
* Easy to configure

== Installation ==

1. Upload the 'videogallery-plus-player-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the 'Video gallery and Player Pro'  plugin through the 'Plugins' menu in WordPress.
3. Add videos under Video gallery tab.

### How to add video gallery in a page
Create a page with any name and enter 
<code>[video_gallery]</code> shortcode in to your page 
OR  
<code> <?php echo do_shortcode('[video_gallery_slider]'); ?> </code> to your template file.


== Changelog ==

= 1.2.2 (19, Apr 2017) =
* [+] Added JW Player suuport for HTML 5 and YouTube video.
* [*] Resolved HTML 5 (Self Hosted) video autoplay issue is popup is closed.
* [*] Added CSS prefix to classes and removed generic classes to avoid CSS conflict.
* [*] Resolved design 19 issue with show_content="true".

= 1.2.1 (15, Feb 2017) =
* [+] Added two types of 'Pagination' numeric and prev-next to [video_gallery] shortcode.
* [+] Added Video title, current video number and total video count in popup for better user interface.
* [*] Taken care of slider 'CenterMode' effect when 'slide_to_show' is equal to 'limit'.
* [*] Taken care of slider pause when popup is open so user will remain at current position of slider.

= 1.2 (03, Feb 2017) =
* [*] Resolved 'term_id' issue in WP Query.
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.

= 1.1.9 (03, Jan 2017) =
* [+] Added 'Other' tab for other third party video like vzaar (https://vzaar.com) and etc.
* [+] Added 'External Video Poster Image' functionality. Now user can add external video poster image.
* [+] Added 'Video Settings' for 'Youtube', 'Vimeo' and 'Dailymotion' for video title, autoplay and etc.
* [*] Taken better care of slider 'CenterMode' effect. Now design will not be disturbed with even number of slide.
* [*] Optimized some code.

= 1.1.8 (26, Dec 2016) =
* [+] Added 'Visual Composer' page builder support.

= 1.1.7 (14, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated slick slider JS to latest version to 1.6.0
* [*] Optimize JS.
* [*] Optimize CSS for better mobile experience.
* [*] Resolved wrong video popup issue when used mulitiple time on same page.

= 1.1.6 (19, Oct 2016) =
* [+] Added 1 new designs (design-19)

= 1.1.5 (18, Oct 2016) =
* [+] Added 3 new designs (design-16, design-17, design-18)

= 1.1.4 (13, Sep 2016) =
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.1.3.1(10, Sep 2016) =
* Fixed some css issue.

= 1.1.3(06, Sep 2016) =
* Fixed image hover bug from design 10 to design 14
* Fixed some css issue.
* Video Gallery License page removed from Plugins and added under Video Gallery Pro tab

= 1.1.2(19, Aug 2016) =
* Added New design 6 designs(design-10 to design-15)

= 1.1.1 =
* Added New design(Design-9)

= 1.1 =
* Added New design(Design-8) for grid.

= 1.0 =
* Initial release.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.2.2 (19, Apr 2017) =
* [+] Added JW Player suuport for HTML 5 and YouTube video.
* [*] Resolved HTML 5 (Self Hosted) video autoplay issue is popup is closed.
* [*] Added CSS prefix to classes and removed generic classes to avoid CSS conflict.
* [*] Resolved design 19 issue with show_content="true".

= 1.2.1 (15, Feb 2017) =
* [+] Added two types of 'Pagination' numeric and prev-next to [video_gallery] shortcode.
* [+] Added Video title, current video number and total video count in popup for better user interface.
* [*] Taken care of slider 'CenterMode' effect when 'slide_to_show' is equal to 'limit'.
* [*] Taken care of slider pause when popup is open so user will remain at current position of slider.

= 1.2 (03, Feb 2017) =
* [*] Resolved 'term_id' issue in WP Query.
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.

= 1.1.9 (03, Jan 2017) =
* [+] Added 'Other' tab for other third party video like vzaar (https://vzaar.com) and etc.
* [+] Added 'External Video Poster Image' functionality. Now user can add external video poster image.
* [+] Added 'Video Settings' for 'Youtube', 'Vimeo' and 'Dailymotion' for video title, autoplay and etc.
* [*] Taken better care of slider 'CenterMode' effect. Now design will not be disturbed with even number of slide.
* [*] Optimized some code.

= 1.1.8 (26, Dec 2016) =
* [+] Added 'Visual Composer' page builder support.

= 1.1.7 (14, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Updated slick slider JS to latest version to 1.6.0
* [*] Optimize JS.
* [*] Optimize CSS for better mobile experience.
* [*] Resolved wrong video popup issue when used mulitiple time on same page.

= 1.1.6 (19, Oct 2016) =
* [+] Added 1 new designs (design-19)

= 1.1.5 (18, Oct 2016) =
* [+] Added 3 new designs (design-16, design-17, design-18)

= 1.1.4 (13, Sep 2016) =
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.1.3.1(10, Sep 2016) =
* Fixed some css issue.

= 1.1.3(06, Sep 2016) =
* Fixed image hover bug from design 10 to design 14
* Fixed some css issue.
* Video Gallery License page removed from Plugins and added under Video Gallery Pro tab

= 1.1.2(19, Aug 2016) =
* Added New design 6 designs(design-10 to design-15)

= 1.1.1 =
* Added New design(Design-9)

= 1.1 =
* Added New design(Design-8) for grid.

= 1.0 =
* Initial release.