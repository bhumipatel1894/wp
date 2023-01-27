=== Portfolio and Projects Pro ===
Contributors: wponlinesupport
Tags: portfolio, portfolio listing, projects, project grid,project portfolio,  Responsive Portfolio, showcase,  portfolio categories,  add portfolio,  add portfolio plugin,  portfolio gallery,  portfolio plugin,  career portfolio, googole image style,  best portfolio,  portfolio display, portfolio slider, project management, 
Requires at least: 3.5
Tested up to: 4.7.5

Display Portfolio OR Projects in a grid view. 

== Description ==
A very simple plugin to add portfolios and your projects.

Portfolio/ Projects - is the free and most modern mobile touch hardware accelerated transitions and amazing native behavior. It is intended to be used in Destktop and mobile websites.

= This plugin contains 2 shortcode: =

<code>[pap_portfolio]</code>
<code>[pap_portfolio_filter]</code>

= Complete shortcode  is =

<code>[pap_portfolio design="design-1" grid="3" limit="20" category="5,10" order="desc" orderby="date" popup_style="inline" include_cat_child="true" pagination="true" pagination_type="numeric" posts="12,16,15" exclude_cat="19,14,78" exclude_post="13,45,56" link="true" link_target="self" image_size="full" design_offset="5" portfolio_height="300" image_fit="true"]</code>

<code>[pap_portfolio_filter design="design-1" grid="3" limit="20" category="5,10" order="desc" orderby="date" popup_style="inline" include_cat_child="true" exclude_cat="19,14,78" link="true" link_target="self" image_size="full" design_offset="5" portfolio_height="300" image_fit="true" cat_limit="0" cat_order="asc" cat_orderby="name" all_filter_text="all"]</code>


= Here is Template code =

<code><?php echo do_shortcode('[pap_portfolio]'); ?></code>

<code><?php echo do_shortcode('[pap_portfolio_filter]'); ?></code>

= Use Following parameters with shortcode =

<code>[pap_portfolio]</code>

* **Grid** [pap_portfolio grid="4"] (number of portfolios you want to show per row.)
* **Limit :** [pap_portfolio limit="8"] (Limit define the number of portfolios to be display at a time. By default set to "20". if you want to display all images then set limit to limit="-1".)
* **Category :** [pap_portfolio category="12,15,45"] (Comma separated category ids of the portfolios which you wanna show .)
* **Order :** [pap_portfolio order="desc"] (order portfolios asceding or desceding. values are "asc" or "desc" )
* **Orderby :** [pap_portfolio orderby="post_date"] (Display slides in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Portfolio Popup Style ** [pap_portfolio popup_style="inline"] (portfolios style. values are "inline" OR "popup".)
* **Design** [pap_portfolio design="design-1"] (number of design that you want to display. values are "design-1" TO "design-15".)
* **Includes Child Category** [pap_portfolio include_cat_child="true"] (show child category portfolio or not. values are "true" OR "false".)
* **Pagination** [pap_portfolio pagination="true"] (enable pagination. values are "true" OR "flase")
* **Pagination Type** [pap_portfolio pagination_type="numeric"] (pagination type values are "numeri" OR "prev-next".)
* **Exclude Category** [pap_portfolio exclude_cat="6,36,14"] (Comma separated ctaegory ids of the portfolios that you dont want to show.)
* **Exclude Post** [pap_portfolio exclude_post="110,23,152"] (Comma separated post ids that you dont want to show.)
* **Posts** [pap_portfolio posts="126,45,78"] (Comma separated portfolios ids that you only want to show. )
* **Link** [pap_portfolio link="true"] (Enable the external link when popup is false. values are true OR flase)
* **Link Target** [pap_portfolio link_target="blnak"] (open link in new tab or in the same window. values are "self" OR "blank".)
* **Design Offset** [pap_portfolio design_offset="0"] (distance between two portfolios. distance is in pixel. values are line 5, 10, 15.)
* **Image Size** [pap_portfolio image_size="full"] (Image size of portfolio values are "thubmnail", "medium", "full", "large")
* **Portfolio Height** [pap_portfolio portfolio_height="300"] (portfolio height. values is any number.)
* **Image Fit** [pap_portfolio image_fit="true"] (Fit the image in container. Values are true OR false)

= Use Following parameters with shortcode =

<code>[pap_portfolio_filter]</code>

* **Design** [pap_portfolio_filter design="design-1"] (number of design that you want to display. values are "design-1" TO "design-15".)
* **Grid** [pap_portfolio_filter grid="4"] (number of portfolios you want to show per row.)
* **category :** [pap_portfolio_filter category="12,15,45"] (Comma separated category ids of the portfolios which you wanna show .)
* **Order :** [pap_portfolio_filter order="desc"] (order portfolios asceding or desceding. values are "asc" or "desc" )
* **Orderby :** [pap_portfolio_filter orderby="post_date"] (Display slides in your order. Values are "post_date", "modified", "title", "name" (Post Slug), "ID", "rand", "menu_order" (Sort Order), "comment_count".)
* **Portfolio Popup Style ** [pap_portfolio_filter popup_style="inline"] (portfolios style. values are "inline" OR "popup".)
* **Includes Child Category** [pap_portfolio_filter include_cat_child="true"] (show child category portfolio or not. values are "true" OR "false".)
* **Exclude Category** [pap_portfolio_filter exclude_cat="6,36,14"] (Comma separated ctaegory ids of the portfolios that you dont want to show.)
* **Link** [pap_portfolio_filter link="true"] (Enable the external link when popup is false. values are true OR flase)
* **Link Target** [pap_portfolio_filter link_target="blnak"] (open link in new tab or in the same window. values are "self" OR "blank".)
* **Design Offset** [pap_portfolio_filter design_offset="0"] (distance between two portfolios. distance is in pixel. values are line 5, 10, 15.)
* **Image Size** [pap_portfolio_filter image_size="full"] (Image size of portfolio values are "thubmnail", "medium", "full", "large")
* **Portfolio Height** [pap_portfolio_filter portfolio_height="300"] (portfolio height. values is any number.)
* **Category Limit** [pap_portfolio_filter cat_limit="0"] (Category Limit.value is any any number)
* **Category Order** [pap_portfolio_filter cat_order="asc"] (Category Order. values are "desc" OR "asc")
* **Category OrderBy** [pap_portfolio_filter cat_orderby="name"] (Category OrderBy. values are "name", "slug", )
* **All Filter Text** [pap_portfolio_filter all_filter_text="All"] (All filter text name. value is any string.)
* **Image Fit** [pap_portfolio_filter image_fit="true"] (Fit the image in container. Values are true OR false)

== Changelog ==

= 1.1 (29, May 2017) =
* [*] Resolved RTL issue in portfolio gallery slider.

= 1.0 (21, March 2017) =
* Initial release.

== Upgrade Notice ==

= 1.1 (29, May 2017) =
* [*] Resolved RTL issue in portfolio gallery slider.

= 1.0 (21, March 2017) =
* Initial release.