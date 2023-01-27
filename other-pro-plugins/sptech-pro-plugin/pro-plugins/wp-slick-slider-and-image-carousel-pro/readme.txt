=== WP Slick Slider and Image Carousel Pro  ===
Contributors: wponlinesupport, anoopranawat
Tags: slick, image slider, slick slider, slick image slider, slider, image slider, header image slider, responsive image slider, responsive content slider, carousel, image carousel, carousel slider, content slider, coin slider, touch slider, text slider, responsive slider, responsive slideshow, Responsive Touch Slider, wp slider, wp image slider, wp header image slider, photo slider, responsive photo slider  
Requires at least: 3.1
Tested up to: 4.7.2

A quick, easy way to add and display mulipale WP Slick Slider and carousel using a shortcode.


== Description ==

Display multiple slick image slider and carousel using shortcode with category. Fully responsive, Swipe enabled, Desktop mouse dragging and  Infinite looping.
Fully accessible with arrow key navigation  Autoplay, dots, arrows etc.

It uses A custom post type and taxonomy to create a slider, with almost unlimited options and support for multiple sliders on any page.
You can also display image slider on your website header.

= You can use 3 shortcodes =

<code>[slick-slider]</code> - Slick Slider
<code>[slick-carousel-slider]</code> - Slick Carousel Slider
<code>[slick-variable-slider]</code> - Slick Variable Slider

= Complete shortcode  is =

<code>[slick-slider limit="5" category="5,10" include_cat_child="true" design="prodesign-1" show_content="true" loop="true" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="300" fade="false" sliderheight="400" show_read_more="true" read_more_text="Read More" slider_nav_column="3" link_target="self" order="desc" orderby="date" exclude_cat="5,10" posts="5,10" exclude_post="5,10" ]</code>
 
<code>[slick-carousel-slider limit="5" category="5,10" include_cat_child="true" design="prodesign-11" image_size="full" show_content="true" slidestoshow="2" slidestoscroll="1" loop="true" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="300" sliderheight="400" show_read_more="true" read_more_text="Read More" link_target="self" order="desc" orderby="date" exclude_cat="5,10" posts="5,10" exclude_post="5,10" ]</code>

<code>[slick-variable-slider limit="5" category="5,10" include_cat_child="true" design="prodesign-11" image_size="full" show_content="true" loop="true" dots="true" arrows="true" autoplay="true" autoplay_interval="3000" speed="300" sliderheight="400" show_read_more="true" read_more_text="Read More" link_target="self" order="desc" orderby="date" exclude_cat="5,10" posts="5,10" exclude_post="5,10" ]</code> 

= Here is Template code =

<code><?php echo do_shortcode('[slick-slider]'); ?></code>
<code><?php echo do_shortcode('[slick-carousel-slider]'); ?></code>
<code><?php echo do_shortcode('[slick-variable-slider]'); ?></code>


= Use Following parameters with shortcode =

<code>[slick-slider]</code>

* **Limit :** [slick-slider limit="8"] (Limit number of slides. By default set to "15". if you want to display all slides then set limit to limit="-1".)
* **Design :** [slick-slider design="prodesign-1"] (Choose slick slider design. Refer plugin documentation for more designs.)
* **Category :** [slick-slider category="category_ID"] ( Display slider by their category ID. )
* **Include Cat Child :** [slick-slider include_cat_child="true"] (Display child category slides. Values are "true" OR "false".)
* **Show Content :** [slick-slider show_content="true" ] (Display content OR not. By default value is "true". Options are "ture OR false".)
* **Slider Loop :** [slick-slider loop="true" ] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false").
* **Slider Pagination and arrows :** [slick-slider dots="false" arrows="false"]
* **Autoplay :** [slick-slider autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval :** [slick-slider autoplay_interval="3000"] (Delay between two slides.)
* **Slider Speed :** [slick-slider speed="3000"] (Control speed of slider.)
* **Fade :** [slick-slider fade="true" ] (Slider Fade effect. By default effect is slide. If you set fade="true" then effect change from slide to fade.)
* **Slider Height :** [slick-slider sliderheight="400" ] (Set Slider height. By default given 400px height.)
* **Show Read More :** [slick-slider show_read_more="false"] (Show/Hide read more links. Values are "true" and "false".)
* **Read More Text :** [slick-slider read_more_text="More"] (Control read more button text.)
* **Link Target :** [slick-slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order :** [slick-slider order="DESC"] (Controls slides order. Values are "ASC" OR "DESC".)
* **Orderby :** [slick-slider orderby="post_date"] (Display slides in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Exclude Category :** [slick-slider exclude_cat="1,5,6"] (Exclude some slider category which you do not want to display.)
* **Exclude Post :** [slick-slider hide_post="1,5,6"] (Exclude some slides which you do not want to display.)
* **Display Specific Posts :** [slick-slider posts="1,5,6"] (Display only specific slides.)
* **Arrow Design :** [slick-variable-slider arrow_design="design-2"] (Choose slider arrow design. Designs are design-1 to design-8.)
* **Dots Design :** [slick-variable-slider dots_design="design-2"] (Choose slider dots design. Designs are design-1 to design-12.)

<code>[slick-carousel-slider]</code>

* **Limit :** [slick-carousel-slider limit="8"] (Limit number of slides. By default set to "15". if you want to display all slides then set limit to limit="-1".)
* **Design :** [slick-carousel-slider design="prodesign-11"] (Choose carousel slider design. Refer plugin documentation for more designs.)
* **Category :** [slick-carousel-slider category="category_ID"] ( Display slider by their category ID ).
* **Image Display Size :** [slick-carousel-slider image_size="large"] ( Display appropriate image size from WordPress. Default is "large". Values are thumbnail, medium, large, original.)
* **Slides Column :** [slick-carousel-slider slidestoshow="3"] (Display number of slides at a time in slider.)
* **Slides to Scroll :** [slick-carousel-slider slides_to_scroll="1"] (Scroll number of slides at a time.)
* **Show Content :** [slick-carousel-slider show_content="true" ] (Display content OR not. By default value is "true". Options are "ture OR false").
* **Slider Loop :** [slick-carousel-slider loop="true" ] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false").
* **Slider Pagination and arrows** : [slick-carousel-slider dots="false" arrows="false"]
* **Autoplay :** [slick-carousel-slider autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval :** [slick-carousel-slider autoplay_interval="3000"] (Delay between two slides.)
* **Slide Speed :** [slick-carousel-slider speed="3000"]
* **Centermode :** [slick-carousel-slider centermode="true" ] ( Enables centered view with partial prev/next slides. Use with odd numbered slidesToShow counts and slides_to_scroll="1". By default value is "false")
* **Variable Width :** [slick-carousel-slider variablewidth="true" ] (Variable width of images in slider. By default value us "false".)
* **Show Read More :** [slick-carousel-slider show_read_more="false"] (Show/Hide read more links. Values are "true" and "false".)
* **Read More Text :** [slick-carousel-slider read_more_text="More"] (Control read more button text.)
* **Link Target :** [slick-carousel-slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order :** [slick-carousel-slider order="DESC"] (Controls slides order. Values are "ASC" OR "DESC".)
* **Orderby :** [slick-carousel-slider orderby="post_date"] (Display slides in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Exclude Category :** [slick-carousel-slider exclude_cat="1,5,6"] (Exclude some slider category which you do not want to display.)
* **Exclude Post :** [slick-carousel-slider hide_post="1,5,6"] (Exclude some slides which you do not want to display.)
* **Display Specific Posts :** [slick-carousel-slider posts="1,5,6"] (Display only specific slides.)
* **Slider Height** : [slick-carousel-slider sliderheight="400"] (Set Carousel Slider height.)
* **Arrow Design :** [slick-variable-slider arrow_design="design-2"] (Choose slider arrow design. Designs are design-1 to design-8.)
* **Dots Design :** [slick-variable-slider dots_design="design-2"] (Choose slider dots design. Designs are design-1 to design-12.)

<code>[slick-variable-slider]</code>

* **Limit :** [slick-variable-slider limit="8"] (Limit number of slides. By default set to "15". if you want to display all slides then set limit to limit="-1".)
* **Design :** [slick-variable-slider design="prodesign-13"] (Choose variable slider design. Refer plugin documentation for more designs.)
* **Category :** [slick-variable-slider category="category_ID"] ( Display slider by their category ID. )
* **Include Cat Child :** [slick-variable-slider include_cat_child="true"] (Display child category slides. Values are "true" OR "false".)
* **Image Display Size :** [slick-carousel-slider image_size="large"] ( Display appropriate image size from WordPress. Default is "full". Values are thumbnail, medium, large, full.)
* **Show Content :** [slick-variable-slider show_content="true" ] (Display content OR not. By default value is "true". Options are "ture OR false".)
* **Slider Loop :** [slick-variable-slider loop="true" ] (Create a Infinite loop sliding. By default value is "true". Options are "ture OR false").
* **Slider Pagination and arrows :** [slick-variable-slider dots="false" arrows="false"]
* **Autoplay :** [slick-variable-slider autoplay="true"] (Start slider automatically. Values are "true" OR "false".)
* **Autoplay Interval :** [slick-variable-slider autoplay_interval="3000"] (Delay between two slides.)
* **Slider Speed :** [slick-variable-slider speed="3000"] (Control speed of slider.)
* **Slider Height :** [slick-variable-slider sliderheight="400" ] (Set Slider height. By default given 400px height.)
* **Center Slide Width :** [slick-variable-slider center_width="80%" ] (Set center slide width. Leave empty for default. By default is 80%. e.g 80% OR 500px)
* **Show Read More :** [slick-variable-slider show_read_more="false"] (Show/Hide read more links. Values are "true" and "false".)
* **Read More Text :** [slick-variable-slider read_more_text="More"] (Control read more button text.)
* **Link Target :** [slick-variable-slider link_target="blank"] (Open link in a same window or in a new tab. Values are "self" OR "blank".)
* **Order :** [slick-variable-slider order="DESC"] (Controls slides order. Values are "ASC" OR "DESC".)
* **Orderby :** [slick-variable-slider orderby="post_date"] (Display slides in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Exclude Category :** [slick-variable-slider exclude_cat="1,5,6"] (Exclude some slider category which you do not want to display.)
* **Exclude Post :** [slick-variable-slider hide_post="1,5,6"] (Exclude some slides which you do not want to display.)
* **Display Specific Posts :** [slick-variable-slider posts="1,5,6"] (Display only specific slides.)
* **Arrow Design :** [slick-variable-slider arrow_design="design-2"] (Choose slider arrow design. Designs are design-1 to design-8.)
* **Dots Design :** [slick-variable-slider dots_design="design-2"] (Choose slider dots design. Designs are design-1 to design-12.)


= Features include =

* Display unlimited number of slider and carousel with the help of category.
* Touch-enabled Navigation.
* Fully responsive. Scales with its container.
* Fully accessible with arrow key navigation.
* Responsive
* Given shortcode and template code.
* Use for header image slider.


== Installation ==

1. Upload the 'wp-slick-slider-and-carousel-pro' folder to the '/wp-content/plugins/' directory.
2. Activate the "wp-slick-slider-and-carousel-pro" list plugin through the 'Plugins' menu in WordPress.
3. Add this short code where you want to display slider

<code>[slick-slider] and [slick-carousel-slider]</code>



== Changelog ==

= 1.3.1 (03, Feb 2017) =
* [+] Added 'arrow_design' shortcode parameter to choose different slider arrow style.
* [+] Added 'dots_design' shortcode parameter to choose different slider dots style.
* [+] Added 'center_width' shortcode parameter for [slick-variable-slider] to control center slide width.
* [+] Added 5 more designs for [slick-variable-slider]
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.
* [*] Resolved 'sliderheight' issue. In some desings 'sliderheight' parameter is not working.
* [*] Improved some variable slider designs for better look.
* [*] Optimized some CSS.

= 1.3 (10, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Optimized some CSS.

= 1.2.9 (07, Nov 2016) =
* [*] Resolved some design bug.
* [*] Optimized CSS.

= 1.2.8 (05, Nov 2016) =
* [+] Added 9 new designs for slider, carousel and variable width.
* [*] Optimized CSS.

= 1.2.7 (20, Oct 2016) =
*[+] Added new design (design-21). It is a design from free plugin of slick slider(design-3) and added as per user request.

= 1.2.6 (12, Sep 2016) =
* [*] Removed plugin license page from plugin section and added in 'Slick Slider Pro' menu.
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.2.5 (July, 20 2016) =
* [+] Added new designs.
* [+] Added new shortcode 'slick-variable-slider' for variable slider.
* [+] Added Visual Composer page builder support.
* [+] Added Drag & Drop feature to display slides in your desired order.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for post ordering.
* [+] Added 'orderby' short code parameter for post order by.
* [+] Added 'posts' short code parameter to display only some specific post.
* [+] Added 'exclude_cat' short code parameter to exclude some category.
* [+] Added 'sliderheight' short code parameter for 'slick-carousel-slider' to control slider height.
* [+] Added default post featured image settings.
* [+] Added custom CSS setting for plugin.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added 'read_more_text' short code parameter to change read more button text.
* [+] Added 'include_cat_child' short code parameter to show child category post or not.
* [+] Added 'loop' short code parameter to run slider contineously.
* [+] Added RTL support for slider.
* [*] Updated slider js to new version.
* [*] Improved designs.
* [*] Improved PRO plugin design page.
* [*] Improved plugin license page with instruction.
* [*] Optimized js for better performance.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Optimzed code.

= 1.2.4 (13, May 2016) =
* [*] Added new feature variable width for carousel slider.

= 1.2.3 (13, APR 2016) =
* [*] Fixed some css issues.
* [*] Resolved slick slider initialize issue.

= 1.2.2 =
* Added 'show_read_more' and 'slider_nav_column' shortcode parameter.
* Added anchor link on images, content and title.
* Fixed some css issues.

= 1.2.1 =
* Fixed some css issues.
* Fixed responsive issue.

= 1.2 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1 =
* Fixed some bugs.

= 1.0 =
* Initial release.

== Upgrade Notice ==

= 1.3.1 (03, Feb 2017) =
* [+] Added 'arrow_design' shortcode parameter to choose different slider arrow style.
* [+] Added 'dots_design' shortcode parameter to choose different slider dots style.
* [+] Added 'center_width' shortcode parameter for [slick-variable-slider] to control center slide width.
* [+] Added 5 more designs for [slick-variable-slider]
* [*] Updated plugin translation code. Now user can put plugin languages file in WordPress 'language' folder so plugin language file will not be loss while plugin update.
* [*] Resolved 'sliderheight' issue. In some desings 'sliderheight' parameter is not working.
* [*] Improved some variable slider designs for better look.
* [*] Optimized some CSS.

= 1.3 (10, Nov 2016) =
* [+] Added 'How it Work' page for better user interface.
* [-] Removed 'Plugin Design' page.
* [*] Optimized some CSS.

= 1.2.9 (07, Nov 2016) =
* [*] Resolved some design bug.
* [*] Optimized CSS.

= 1.2.8 (05, Nov 2016) =
* [+] Added 9 new designs for slider, carousel and variable width.
* [*] Optimized CSS.

= 1.2.7 (20, Oct 2016) =
* [+] Added new design (design-21). It is a design from free plugin of slick slider(design-3) and added as per user request.

= 1.2.6 (12, Sep 2016) =
* [*] Removed plugin license page from plugin section and added in 'Slick Slider Pro' menu.
* [*] Updated plugin license page.
* Added SSL to https://www.wponlinesupport.com/ for secure updates.

= 1.2.5 (July, 20 2016) =
* [+] Added new designs.
* [+] Added new shortcode 'slick-variable-slider' for variable slider.
* [+] Added Visual Composer page builder support.
* [+] Added Drag & Drop feature to display slides in your desired order.
* [+] Added 'link_target' short code parameter for link behavior.
* [+] Added 'order' short code parameter for post ordering.
* [+] Added 'orderby' short code parameter for post order by.
* [+] Added 'posts' short code parameter to display only some specific post.
* [+] Added 'exclude_cat' short code parameter to exclude some category.
* [+] Added 'sliderheight' short code parameter for 'slick-carousel-slider' to control slider height.
* [+] Added default post featured image settings.
* [+] Added custom CSS setting for plugin.
* [+] Added some useful plugin links for user at plugins page.
* [+] Added 'read_more_text' short code parameter to change read more button text.
* [+] Added 'include_cat_child' short code parameter to show child category post or not.
* [+] Added 'loop' short code parameter to run slider contineously.
* [+] Added RTL support for slider.
* [*] Updated slider js to new version.
* [*] Improved designs.
* [*] Improved PRO plugin design page.
* [*] Improved plugin license page with instruction.
* [*] Optimized js for better performance.
* [*] Improved CSS to display images properly. Optimized CSS.
* [*] Optimzed code.

= 1.2.4 (13, May 2016) =
* [*] Added new feature variable width for carousel slider.

= 1.2.3 (13, APR 2016) =
* [*] Fixed some css issues.
* [*] Resolved slick slider initialize issue.

= 1.2.2 =
* Added 'show_read_more' and 'slider_nav_column' shortcode parameter.
* Added anchor link on images, content and title.
* Fixed some css issues.

= 1.2.1 =
* Fixed some css issues.
* Fixed responsive issue.

= 1.2 =
* Fixed some css issues.
* Resolved multiple slider jquery conflict issue.

= 1.1 =
* Fixed some bugs.

= 1.0 =
* Initial release.