=== Default Blog ===
Contributors: svenl77, mahype 
Tags: options,wpmu,wordpress mu,buddypress,blogs,create blogs,blog defaults,wp_options,automation,community,template,admin,tools
Requires at least: wpmu 2.7
Tested up to: wpmu 2.9.2
Stable tag:  0.22 - beta

This plugin adds an option page "Default Blog Options" under your admin menue.
== Description ==
<strong>Experimental mode! Do not use on live sites!</strong>

Want to dublicate blogs with same settings? If you use Wordpress MU, the plugin gives you the possibility to create a default blog as a template for all new blogs. This plugin is for site admins of WPMU sites.

Just create a blog and select it as default blog. After that you can select particular elements (articles, pages, design, plugin settings, and so on) you want to copy to all new blogs you will to create.

Very nice for mass blog creation as in communities.

Bug report, please go here:<br><br>
http://sven-lehnert.de/en/2010/02/26/default-blog-options-2/

== Installation ==
1. Upload `Default Blog Options` to the `/wp-content/plugins/` directory<br>
2. Login as Superadmin
4. Activate the plugin <strong>Site Wide</strong> through the 'Plugins' menu in WordPress<br>


How it works:
Just create a blog which you want to use as default blog and set up the whole blog. 

After setting up the default blog, go to the "Default Blog" plugin in the "Site Admin" panel and set up the "Default Blog". 

When done, you will be able to select the settings you'd like to have in every new blog. Just click on "Update Options" to save.

Every time a blog is created and yout <strong>visit the dashboard of the new blog</strong>, the settings will be copied from the default blog to the new blog.

Thats it! Have fun.<br>

== Screenshots ==
1. Setting up pages

== License ==


**********************************************************************
This program is distributed in the hope that it will be useful, but
WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
**********************************************************************

==  Version history  ==
0.01-beta First testing beta version.

0.02-beta Reorder and clean up the code and fix some bugs were values got lost.

0.03-beta Renamed Plugin to "Default Blog" in consider of developements in future. Cleaned up the code. Plugin will be shown in the Siteadmin menue independent of backend.

0.03.1 Set up correct version of plugin (Attention: Do not use!)

0.04 Added links to copy from default blog (Attention: Do not use!)

0.05 Added translations to plugin and german language (Attention: Do not use!)

0.1	Added Posts and Pages to copy from default blog (Attention: Do not use!)

0.11 - beta	| Heavy Bugfix: Content of existing blogs have been deleted, if dashboard was visited and plugin was active. Now plugin won't run anymore for blogs which have been created before plugin was enabled. | Bugfix: Warning won't be shown anymore, if blog dashboard was visited the first time | New function: Added tabs to the admin area.

0.12 - beta | Default blog couldn't be set after setting main blog to defaul blog. | Tabs where shown now. CSS and JS wasn't linked correct.

0.13 - beta | Added categories to copy from default blog 

0.14 - beta | Post and page meta where now copied too. Parent pages where set correctly. 

0.15 - beta | Categories of posts where now copied too.

0.16 - beta | Tags can be copied too. Default blog can be selected in a dropdown list.

0.2 - beta | Inserted design, plugins and settings tabs with settings for it.

0.21 - beta | Deleted error message and running dead if no page or post was selected. | Added some german words to language file

0.22 - beta | Plugin settings haven't been shown. Problems solved. | Problems on deleting existing pages, posts and categories  in the moment when settings where copied. Script hanged up. Problem is solved.