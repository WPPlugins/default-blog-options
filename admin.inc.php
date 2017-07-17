<?php
// Page in admin area
function default_blog_options_page($options,$links){
	global $wpdb, $blog_id;
	global $defblog_id;
	
	// echo $defblog_id;
	form_head(); 
  	if ($defblog_id != ""){
  		$defblog_id="1";
  	}
  	include("admin-default-blog-defblog.php");
  	include("admin-default-blog-posts.inc.php");
  	include("admin-default-blog-pages.inc.php");
  	include("admin-default-blog-links.inc.php");
  	include("admin-default-blog-cats.inc.php");
  	include("admin-default-blog-tags.inc.php");
  	include("admin-default-blog-design.inc.php");
  	include("admin-default-blog-plugins.inc.php");
  	include("admin-default-blog-settings.inc.php");
  	include("admin-default-blog-options.inc.php");
  	
  	tab_js();
	form_footer();
}
?>