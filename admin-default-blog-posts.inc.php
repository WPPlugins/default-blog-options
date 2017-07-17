	<!--  Default Blog links admin page -->
	<div id="tab2" class="tabcontent">
	<div class="wrap">
      <h2><?php _e('Blog posts','default-blog-options'); ?></h2>
      <?php _e('Select the posts, you like to be copied from this blog into a new blog. The links will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
      <?php
      	if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts') != ""){
    		$global_blog_posts = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts');
  		}
  		if($_POST['posts']!=""){$global_blog_posts = $_POST['posts'];}
  		
  		if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts_delete') != ""){
    		$delete_existing_posts = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_posts_delete');
  		}

  		$sql="SELECT * FROM wp_".$defblog_id."_posts WHERE post_type='post' ORDER BY post_title";
  		
      	$posts = $wpdb->get_results($sql);
      	
		$class = 'all-options disabled';
		
		echo "<tr style='background-color:#CCC;'>";
        echo "<td scope='row'><label for='delete_existing_posts'>".__('Delete existing posts','default-blog-options')."</label></td>";
        echo "<td>&nbsp;</td>";	
        if($delete_existing_posts==true){
        	echo "<td><INPUT NAME='delete_existing_posts' TYPE=\"CHECKBOX\" value=\"true\" checked></td>";
        }else{
        	echo "<td><INPUT NAME='delete_existing_posts' TYPE=\"CHECKBOX\" value=\"true\"></td>";
        }
        echo "</tr>";
		      	     	
        foreach((array) $posts as $post){
        	echo "<tr>";
        	echo "<td scope='row'><label for='".$post->post_title."'>".$post->post_title."</label></td>";    	 	
        	echo "<td><input class='regular-text $class' type='text' name='$post->post_name' id='$link->post_name' value='" .$post->post_name. "' disabled='disabled' /></td>";
        	echo "<td>";
        	if(isset($global_blog_posts)){
		      	if(in_array($post->ID,$global_blog_posts)){
		      		echo '<INPUT NAME="posts[]" TYPE="CHECKBOX" VALUE="'.$post->ID.'" checked>';
		      	}else{
		      		echo '<INPUT NAME="posts[]" TYPE="CHECKBOX" VALUE="'.$post->ID.'">';
		    	}
        	}else{
        		echo '<INPUT NAME="posts[]" TYPE="CHECKBOX" VALUE="'.$post->ID.'">';
        	}
        	echo "</td>";
        	echo "</tr>";
        }
      
      ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>
      </div>
      </div>    