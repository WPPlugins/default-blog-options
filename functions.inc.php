<?php

// Setting default blog id
function update_default_blog($defblog_id){
	update_blog_option (SITE_ID_CURRENT_SITE,'defblog_id', $defblog_id, true);
}
// Updating posts
function update_posts($posts,$delet_existing=false){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts', $posts, true);
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts_delete', $delet_existing, true);
}
// Updating pages
function update_pages($pages,$delet_existing=false){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages', $pages, true);
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages_delete', $delet_existing, true);
}
// Updating links
function update_links($links,$delet_existing=false){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_links', $links, true);
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_link_delete', $delet_existing, true);
}
// Updating categories
function update_cats($cats,$delet_existing=false){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats', $cats, true);
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats_delete', $delet_existing, true);
}
// Updating tags
function update_tags($tags,$delet_existing=false){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags', $tags, true);
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags_delete', $delet_existing, true);
}
// Updating design
function update_design($design){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_design',$design, true);
}
// Updating plugins
function update_plugins($plugins){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_plugins',$plugins, true);
}
// Updating settings
function update_settings($settings){
	update_blog_option(SITE_ID_CURRENT_SITE,'default_blog_settings', $settings, true);
}
// Updating Options
function update_options($options){
	update_blog_option(SITE_ID_CURRENT_SITE,'global_blog_options', $options, true);
}
// Updating links of new blog
function copy_links(){
	global $wpdb;
	global $blog_id;
	global $defblog_id;
	
	$link_fields=array('link_url','link_name','link_image','link_target','link_description','link_visible','link_updated','link_rel','link_notes','link_rss');
	
	// Getting default blog settings
	$links=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_links');
	$default_blog_link_delete=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_link_delete');
	
	if($default_blog_link_delete==true){
		
		$sql="TRUNCATE TABLE wp_".$blog_id."_links";
		$wpdb->query($sql);
		
	}
	if($links!=""){
		// Adding links
		if(is_array($links)){
			foreach($links AS $link){
					$sql="SELECT * FROM wp_".$defblog_id."_links WHERE link_id='".$link."'";
					$default_link = $wpdb->get_row($sql, ARRAY_A);
					$sql_old=$sql;
					
					$sql="INSERT INTO wp_".$blog_id."_links ";
					$i=0;
		
					foreach($link_fields AS $link_field){
						if($i==0){
							$sql_fields=$link_field;
							$sql_values="'".$default_link[$link_field]."'";
						}else{
							$sql_fields.=",".$link_field;
							$sql_values.=",'".$default_link[$link_field]."'";
						}
						$i++;
					}
					$sql.="(".$sql_fields.") VALUES (".$sql_values.")";
					$wpdb->query($sql);
			}
		}
	}
}

// Updating posts of new blog
function copy_posts(){
	global $blog_id;
	global $defblog_id;
	global $cat_changes;
	global $old_tag_ids;

	$post_fields=array('post_author','post_date','post_date_gmt','post_content','post_title','post_excerpt','post_status','comment_status','ping_status','post_password','post_name','to_ping','pinged','post_modified','post_modified_gmt','post_content_filtered','post_parent','guid','menu_order','post_type','post_mime_type','comment_count');
	// Getting default blog settings
	$posts=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts');
	$default_blog_posts_delete=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts_delete');
		
	// Deleting old posts
	if($default_blog_posts_delete==true){
		$del_posts=get_posts("numberposts=-1&post_status=''&post_type='post'");
				
		// print_r($del_posts);
					
		foreach($del_posts AS $del_post){
			wp_delete_post($del_post->ID,true);
		}
		// echo "ready deleting links<br>";
		
	}
	
	if($posts!=""){
		
		switch_to_blog($defblog_id);
		$new_posts=get_posts("numberposts=-1&include=".implode(",",$posts)."&post_status=''&post_type=any");
		restore_current_blog();
		
		// Adding posts
		if(is_array($new_posts)){
			$post_changes="";

			$i=0;
			
			// Adding pages
			foreach($new_posts AS $new_post){		
				$old_post_id=$new_post->ID;
				
				// Getting additional data for post
				switch_to_blog($defblog_id);
				$custom_keys=get_post_custom_keys($old_post_id);
				$post_cats=wp_get_post_categories($old_post_id);
				restore_current_blog();	
							
				// Changing cats
				$new_cats=array();
				foreach($post_cats AS $post_cat){
					array_push($new_cats,$cat_changes[$post_cat]);
				}
				
				// Inserting new post
				$new_post->ID="";
				$new_post->post_category=$new_cats;						
				$new_post_id=wp_insert_post($new_post);
				
				$post_changes[$old_post_id]=$new_post_id;	
				
				// Adding post_metas
				foreach($custom_keys AS $custom_key){
					
					switch_to_blog($defblog_id);
			  		$post_metas=get_post_meta($old_post_id, $custom_key);
			  		restore_current_blog();
			  		
			  		foreach($post_metas AS $post_meta){
			  			update_post_meta($new_post_id, $custom_key, $post_meta);
			  		} 		  		
			  	}
			  	
			  	$args = array(
			    'orderby'                  => 'name',
			    'order'                    => 'ASC',
			    'hide_empty'               => false,
			    'pad_counts'               => false );
			  	
			  	// Adding post tags
			  	switch_to_blog($defblog_id);		  		
				$post_tags=wp_get_post_tags($old_post_id);
				restore_current_blog();
				
				$post_tag_names=array();
	
				foreach($post_tags AS $post_tag){
					if(in_array($post_tag->term_id,$old_tag_ids)){
						array_push($post_tag_names,$post_tag->name);
					}
			  	}
			  	wp_set_post_tags($new_post_id,$post_tag_names);
			}
		}
	}
}
// Updating pages of new blog
function copy_pages(){
	global $blog_id;
	global $defblog_id;
	global $page_changes;
	
	// Getting default blog settings
	$pages=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages');
	$default_blog_pages_delete=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages_delete');
	
	// Deleting old pages
	if($default_blog_pages_delete==true){
		$args = array(
		    'child_of' => 0,
		    'hierarchical' => 0,
		    'parent' => -1,
		    'offset' => 0, 
		    'post_type'=>'page'
		);
		$del_pages=get_pages($args);
					
		foreach($del_pages AS $del_page){
			wp_delete_post($del_page->ID,true);
		}
	}
	
	// Getting new pages from default blog
	switch_to_blog($defblog_id);
	$new_pages=get_pages("include=".implode(",",$pages));
	restore_current_blog();
	
	if($pages!=""){
		// Adding pages
		if(is_array($new_pages)){
			
			// Adding pages
			foreach($new_pages AS $new_page){
				
				$old_page_id=$new_page->ID;
				$new_page->ID="";				
				$new_page_id=wp_insert_post($new_page);
				
				$page_changes[$old_page_id]=$new_page_id;		
				
				// Adding post_metas
				switch_to_blog($defblog_id);
				$custom_keys=get_post_custom_keys($old_page_id);
				restore_current_blog();
				
				foreach($custom_keys AS $custom_key){
					
					switch_to_blog($defblog_id);
			  		$post_metas=get_post_meta($old_page_id, $custom_key);
			  		restore_current_blog();
			  		
			  		// print_r($post_metas);
			  		
			  		foreach($post_metas AS $post_meta){
			  			update_post_meta($new_page_id, $custom_key, $post_meta);
			  		} 		  		
			  	}
			}
			
			// Seting up parent pages
			$args = array(
			    'child_of' => 0,
			    'hierarchical' => 0,
			    'parent' => -1,
			    'offset' => 0 
			);
			$update_pages=get_pages($args);
			
			foreach($update_pages AS $update_page){
				if($update_page->post_parent!=0){
					$update_page->post_parent=$page_changes[$update_page->post_parent];
					wp_update_post($update_page);
				}
			}
	
		}
	}
}
// Updating categories of new blog
function copy_cats(){
	global $blog_id;
	global $defblog_id;
	global $cat_changes;
	
	// Getting default blog settings
	$cats=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats');
	$default_blog_cats_delete=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats_delete');
	
	if($default_blog_cats_delete==true){
		$args = array(
	    'type'                     => 'post',
	    'child_of'                 => 0,
	    'orderby'                  => 'name',
	    'order'                    => 'ASC',
	    'hide_empty'               => false,
	    'pad_counts'               => false );
		
  		$del_cats=get_categories($args);
  		
  		foreach($del_cats as $del_cat){
  			wp_delete_category($del_cat->cat_ID);
  		}
	}
	
	if($cats!="" && is_array($cats)){	
		$args = array(
		    'type'                     => 'post',
			'include'				   => implode(",",$cats),
		    'child_of'                 => 0,
		    'orderby'                  => 'name',
		    'order'                    => 'ASC',
		    'hide_empty'               => false,
		    'pad_counts'               => false );
		
		switch_to_blog($defblog_id);
		$cats_new=get_categories($args);
	  	restore_current_blog();
		
		// Adding pages
		if(is_array($cats_new)){
			foreach($cats_new AS $cat_new){
				$cat_args = array(
				  'cat_name' => $cat_new->cat_name,
				  'category_description' => $cat_new->category_description,
				  'category_nicename' => $cat_new->category_nicename,
				  'category_parent' => $cat_new->category_parent,
				  'slug' => $cat_new->slug
				);
				$old_cat_id=$cat_new->cat_ID;
				$new_cat_id=wp_insert_category($cat_args);
				$cat_changes[$old_cat_id]=$new_cat_id;
			}
		}
	}
}
// Updating tags of new blog
function copy_tags(){
	global $blog_id;
	global $defblog_id;
	global $page_changes;
	global $tag_changes;
	global $old_tag_ids;
	
	$old_tag_ids=array();
	
	// Getting default blog settings
	$tags=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags');
	$default_blog_tags_delete=get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags_delete');
	
	// Deleting old tags
	if($default_blog_tags_delete==true){
		
		$args = array(
	    'type'                     => 'post',
	    'child_of'                 => 0,
	    'orderby'                  => 'name',
	    'order'                    => 'ASC',
	    'hide_empty'               => false,
	    'pad_counts'               => false );
		
		$tags_delete=get_tags($args);

		foreach($tags_delete AS $tag_delete){
			wp_delete_term($tag_delete->term_id,'post_tag');
		}
	}
	
	if($tags!="" && is_array($tags)){
		$args = array(
	    'type'                     => 'post',
		'include'				   => implode(",",$tags),
	    'child_of'                 => 0,
	    'orderby'                  => 'name',
	    'order'                    => 'ASC',
	    'hide_empty'               => false,
	    'pad_counts'               => false );
		
		switch_to_blog($defblog_id);
	  	$tags=get_tags($args);
	  	restore_current_blog();
	  	
		foreach($tags AS $tag){
			$old_term_id=$tag->term_id;
			$args=array(
				'description' => $tag->description,
				'slug'		  => $tag->slug
			);
			
			$new_term_id=wp_insert_term($tag->name,'post_tag',$args);
			$tag_changes[$old_term_id]=$new_term_id;
			
			array_push($old_tag_ids,$old_term_id);
		}
	}	
}
// Updating design of blog
function copy_design(){
	global $defblog_id;
	$global_blog_design = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_design');
	
	// Copy theme
	if($global_blog_design["theme"]==true){
		
		switch_to_blog($defblog_id);
		$current_template=get_option('current_theme');
		$template=get_option('template');
		$current_stylesheet=get_option('stylesheet');
  		restore_current_blog();
  		
  		update_option('current_theme', $current_template);
  		update_option('template', $template);
		update_option('stylesheet', $current_stylesheet);
	}
}
// Updating plugin settings of blog
function copy_plugins(){
	global $defblog_id;
	$global_blog_plugins = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_plugins');
	
	// Copy active plugins
	if($global_blog_plugins["active"]==true){
		switch_to_blog($defblog_id);
		$active_plugins=get_option('active_plugins');
	  	restore_current_blog();
	  	
	  	update_option('active_plugins', $active_plugins);
	}
}
// Updating settings of blog
function copy_settings(){
	global $defblog_id;
	global $page_changes;
	
	$global_blog_settings = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_settings');
	
	if($global_blog_settings["welcome_page"]==true){
		$page_on_front=get_blog_option($defblog_id,'page_on_front');
		$show_on_front=get_blog_option($defblog_id,'show_on_front');
	  	
		update_option('page_on_front',$page_changes[$page_on_front]);
		update_option('show_on_front',$show_on_front);
	}
	
}

// Updating options of new blog
function copy_options(){
	global $defblog_id;
	
	$options=get_blog_option(SITE_ID_CURRENT_SITE,'global_blog_options');
	if(is_array($options)){
		foreach($options AS $option){
			update_option($option,get_blog_option($defblog_id,$option));
		}
	}
}
?>