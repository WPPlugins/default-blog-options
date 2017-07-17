	<!--  Default Blog links admin page -->
	<div id="tab5" class="tabcontent">
	<div class="wrap">
      <h2><?php _e('Blog categories','default-blog-options'); ?></h2>
      <?php _e('Select the categories, you like to be copied from this blog into a new blog. The categories will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
      <?php
      	if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats') != ""){
    		$global_blog_cats = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats');
  		}
  		if($_POST['cats']!=""){$global_blog_cats = $_POST['cats'];}
  		
  		if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats_delete') != ""){
    		$delete_existing_cats = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_cats_delete');
  		}

  		// $sql="SELECT * FROM wp_".$defblog_id."_posts WHERE post_type='post' ORDER BY post_title";
      	// $posts = $wpdb->get_results($sql);
      	
  		$args = array(
	    'type'                     => 'post',
	    'child_of'                 => 0,
	    'orderby'                  => 'name',
	    'order'                    => 'ASC',
	    'hide_empty'               => false,
	    'pad_counts'               => false );
      	
  		switch_to_blog($defblog_id);
  		$cats=get_categories($args);
  		restore_current_blog();
  		
  		// print_r($cats);
      	
		$class = 'all-options disabled';
		
		echo "<tr style='background-color:#CCC;'>";
        echo "<td scope='row'><label for='delete_existing_posts'>".__('Delete existing categories','default-blog-options')."</label></td>";
        echo "<td>&nbsp;</td>";	
        if($delete_existing_cats==true){
        	echo "<td><INPUT NAME='delete_existing_cats' TYPE=\"CHECKBOX\" value=\"true\" checked></td>";
        }else{
        	echo "<td><INPUT NAME='delete_existing_cats' TYPE=\"CHECKBOX\" value=\"true\"></td>";
        }
        echo "</tr>";
		      	     	
        foreach($cats as $cat){
        	echo "<tr>";
        	echo "<td scope='row'><label for='".$cat->cat_name."'>".$cat->cat_name."</label></td>";    	 	
        	echo "<td><input class='regular-text $class' type='text' name='$cat->cat_name' id='$link->cat_name' value='" .$cat->slug. "' disabled='disabled' /></td>";
        	echo "<td>";
        	if(isset($global_blog_cats)){
		      	if(in_array($cat->cat_ID,$global_blog_cats)){
		      		echo '<INPUT NAME="cats[]" TYPE="CHECKBOX" VALUE="'.$cat->cat_ID.'" checked>';
		      	}else{
		      		echo '<INPUT NAME="cats[]" TYPE="CHECKBOX" VALUE="'.$cat->cat_ID.'">';
		    	}
        	}else{
        		echo '<INPUT NAME="cats[]" TYPE="CHECKBOX" VALUE="'.$cat->cat_ID.'">';
        	}
        	echo "</td>";
        	echo "</tr>";
        }
      
      ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>
      </div>
      </div>    