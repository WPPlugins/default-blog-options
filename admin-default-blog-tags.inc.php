	<!--  Default Blog links admin page -->
	<div id="tab6" class="tabcontent">
	<div class="wrap">
      <h2><?php _e('Blog tags','default-blog-options'); ?></h2>
      <?php _e('Select the tags, you like to be copied from this blog into a new blog. The categories will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
      <?php
      	if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags') != ""){
    		$global_blog_tags = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags');
  		}
  		if($_POST['tags']!=""){$global_blog_tags = $_POST['tags'];}
  		
  		if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags_delete') != ""){
    		$delete_existing_tags = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_tags_delete');
  		}
  		
  		$args = array(
	    'type'                     => 'post',
	    'child_of'                 => 0,
	    'orderby'                  => 'name',
	    'order'                    => 'ASC',
	    'hide_empty'               => false,
	    'pad_counts'               => false );
  		
  		switch_to_blog($defblog_id);
  		$tags=get_tags($args);
  		restore_current_blog();

		$class = 'all-options disabled';
		
		echo "<tr style='background-color:#CCC;'>";
        echo "<td scope='row'><label for='delete_existing_tags'>".__('Delete existing tags','default-blog-options')."</label></td>";
        echo "<td>&nbsp;</td>";	
        if($delete_existing_tags==true){
        	echo "<td><INPUT NAME='delete_existing_tags' TYPE=\"CHECKBOX\" value=\"true\" checked></td>";
        }else{
        	echo "<td><INPUT NAME='delete_existing_tags' TYPE=\"CHECKBOX\" value=\"true\"></td>";
        }
        echo "</tr>";
		      	     	
        foreach($tags as $tag){
        	echo "<tr>";
        	echo "<td scope='row'><label for='".$tag->name."'>".$tag->name."</label></td>";    	 	
        	echo "<td><input class='regular-text $class' type='text' name='$tag->name' id='$link->name' value='" .$tag->slug. "' disabled='disabled' /></td>";
        	echo "<td>";
        	if(isset($global_blog_tags)){
		      	if(in_array($tag->term_id,$global_blog_tags)){
		      		echo '<INPUT NAME="tags[]" TYPE="CHECKBOX" VALUE="'.$tag->term_id.'" checked>';
		      	}else{
		      		echo '<INPUT NAME="tags[]" TYPE="CHECKBOX" VALUE="'.$tag->term_id.'">';
		    	}
        	}else{
        		echo '<INPUT NAME="tags[]" TYPE="CHECKBOX" VALUE="'.$tag->term_id.'">';
        	}
        	echo "</td>";
        	echo "</tr>";
        }
      
      ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>
      </div>
      </div>    