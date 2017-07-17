	<!--  Default Blog links admin page -->
	<div id="tab3" class="tabcontent">
	<div class="wrap">
      <h2><?php _e('Blog pages','default-blog-options'); ?></h2>
      <?php _e('Select the pages, you like to be copied from this blog into a new blog. The links will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
      <?php
      
      	if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages') != ""){
    		$global_blog_pages = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages');
  		}
  		
  		if($_POST['pages']!=""){$global_blog_pages=$_POST['pages'];}
  		
  		if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages_delete') != ""){
    		$delete_existing_pages = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_pages_delete');
  		}
  		$sql="SELECT * FROM wp_".$defblog_id."_posts WHERE post_type='page' ORDER BY post_title";

      	$pages = $wpdb->get_results($sql);
      	
		$class = 'all-options disabled';
		
		echo "<tr style='background-color:#CCC;'>";
        echo "<td scope='row'><label for='delete_existing_pages'>".__('Delete existing pages','default-blog-options')."</label></td>";
        echo "<td>&nbsp;</td>";	
        if($delete_existing_pages==true){
        	echo "<td><INPUT NAME='delete_existing_pages' TYPE=\"CHECKBOX\" value=\"true\" checked></td>";
        }else{
        	echo "<td><INPUT NAME='delete_existing_pages' TYPE=\"CHECKBOX\" value=\"true\"></td>";
        }
        echo "</tr>";
		      	     	
        foreach((array) $pages as $page){
        	echo "<tr>";
        	echo "<td scope='row'><label for='".$page->post_title."'>".$page->post_title."</label></td>";    	 	
        	echo "<td><input class='regular-text $class' type='text' name='$page->post_name' id='$link->post_name' value='" .$page->post_name. "' disabled='disabled' /></td>";
        	echo "<td>";
        	if(isset($global_blog_pages)){
		      	if(in_array($page->ID,$global_blog_pages)){
		      		echo '<INPUT NAME="pages[]" TYPE="CHECKBOX" VALUE="'.$page->ID.'" checked>';
		      	}else{
		      		echo '<INPUT NAME="pages[]" TYPE="CHECKBOX" VALUE="'.$page->ID.'">';
		    	}
        	}else{
        		echo '<INPUT NAME="pages[]" TYPE="CHECKBOX" VALUE="'.$page->ID.'">';
        	}
        	echo "</td>";
        	echo "</tr>";
        }
      
      ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>
      </div>
      </div>