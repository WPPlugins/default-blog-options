<?php
/*
Plugin Name: Default Blog
Plugin URI: http://wordpress.org/extend/plugins/default-blog-options/
Description: Set up a default blog and let automatically copy default blog settings to all new blogs in Wordpress MU
Author: Sven Lehnert, Sven Wagener
Author URI: http://www.rheinschmiede.de
Version: 0.22 - beta
License: (Events: GNU General Public License 2.0 (GPL) http://www.gnu.org/licenses/gpl.html)
*/
include("functions.inc.php");
include("functions_layout.inc.php");
include("admin.inc.php");

global $blog_id;
global $defblog_id;
global $cat_changes;

// Adding menue if WP main blog is active
add_action('admin_menu', 'add_blog_menue_page');
add_action('wp_dashboard_setup', 'initialize_plugin');
add_action('wp_dashboard_setup', 'initialise_blog');
add_action('admin_head', 'tab_css');

$defblog_id=get_blog_option(SITE_ID_CURRENT_SITE,'defblog_id');

$plugin_dir = basename(dirname(__FILE__))."/lang/";
load_plugin_textdomain( 'default-blog-options', 'wp-content/plugins/' . $plugin_dir, $plugin_dir );

// Add a new top-level menu 
function add_blog_menue_page() {
	add_submenu_page('wpmu-admin.php', 'Default Blog', 'Default Blog', 10, 'defaultblog', 'default_blog');
}

// Saving settings from admin form
function default_blog(){
	// Save Default Blog ID
	if (isset($_POST['defblog_submit'])) {
		update_default_blog($_POST['act_defblog_id']);
		alert(__('Default Blog ID Saved!','default-blog-options')); 
	}
	// Save Default Blog Options
	if (isset($_POST['submit'])){
		update_posts($_POST['posts'],$_POST['delete_existing_posts']);
		update_pages($_POST['pages'],$_POST['delete_existing_pages']);
		update_links($_POST['links'],$_POST['delete_existing_links']);
		update_cats($_POST['cats'],$_POST['delete_existing_cats']);
		update_tags($_POST['tags'],$_POST['delete_existing_tags']);
		update_design($_POST['design']);
		update_plugins($_POST['plugins']);
		update_settings($_POST['settings']);
		update_options($_POST['options']);
	    alert(__('Settings updatet!','default-blog-options'));
	}
	// Load the options page
	default_blog_options_page($options,$links);
}

// Initializing new blog 
function initialise_blog(){	
	// If update have to be done
	global $initialized_blog_plugin;
	
	if(get_option('dummy_blog_update')=="" && $initialized_blog_plugin==true){
		copy_tags();
		copy_cats();
		copy_posts();
		copy_pages();
		copy_links();
		copy_design();
		copy_plugins();
		copy_settings();
		copy_options();
		update_option('dummy_blog_update',true);
	}
}
// This script will run the first time, the plugin was started
function initialize_plugin(){
	global $initialized_blog_plugin;
	
	switch_to_blog(SITE_ID_CURRENT_SITE);
	$initialized_blog_plugin=get_option('default_blog_plugin_initialized');
	restore_current_blog();
		
	if($initialized_blog_plugin==""){
		global $wpdb;
	    $blog_ids = $wpdb->get_results("SELECT blog_id FROM " . $wpdb->blogs, ARRAY_A );
		
	    foreach($blog_ids as $blog_id){
			switch_to_blog($blog_id['blog_id']);
			update_option('dummy_blog_update',true);
			restore_current_blog();
	    }
	    switch_to_blog(SITE_ID_CURRENT_SITE);
	    update_option('default_blog_plugin_initialized',true);
		restore_current_blog();
	}
}

?>