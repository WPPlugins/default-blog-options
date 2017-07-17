	<!--  Default Blog links admin page -->
	<div id="tab4" class="tabcontent">
	<div class="wrap">
      <h2><?php _e('Blog links','default-blog-options'); ?></h2>
      <?php _e('Select the links, you like to be copied from this blog into a new blog. The links will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
      <?php 
      	if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_links') != ""){
    		$global_blog_links = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_links');
  		}
  		if($_POST['links'] != ""){$global_blog_links = $_POST['links'];}
  		
  		if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_link_delete') != ""){
    		$delete_existing_links = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_link_delete');
  		}
  		$sql="SELECT * FROM wp_".$defblog_id."_links ORDER BY link_name";

      	$links = $wpdb->get_results($sql);
      	
		$class = 'all-options disabled';
		
		echo "<tr style='background-color:#CCC;'>";
        echo "<td scope='row'><label for='delete_existing_links'>".__('Delete existing links','default-blog-options')."</label></td>";
        echo "<td>&nbsp;</td>";	
        if($delete_existing_links==true){
        	echo "<td><INPUT NAME='delete_existing_links' TYPE=\"CHECKBOX\" value=\"true\" checked></td>";
        }else{
        	echo "<td><INPUT NAME='delete_existing_links' TYPE=\"CHECKBOX\" value=\"true\"></td>";
        }
        echo "</tr>";
		      	     	
        foreach((array) $links as $link){
        	echo "<tr>";
        	echo "<td scope='row'><label for='$link->link_name'>$link->link_name</label></td>";    	 	
        	echo "<td><input class='regular-text $class' type='text' name='$link->link_url' id='$link->link_url' value='" .$link->link_url. "' disabled='disabled' /></td>";
        	echo "<td>";
        	if(isset($global_blog_links)){
		      	if(in_array($link->link_id,$global_blog_links)){
		      		echo '<INPUT NAME="links[]" TYPE="CHECKBOX" VALUE="'.$link->link_id.'" checked>';
		      	}else{
		      		echo '<INPUT NAME="links[]" TYPE="CHECKBOX" VALUE="'.$link->link_id.'">';
		    	}
        	}else{
        		echo '<INPUT NAME="links[]" TYPE="CHECKBOX" VALUE="'.$link->link_id.'">';
        	}
        	echo "</td>";
        	echo "</tr>";
        }
      
      ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>
      </div>
      </div>