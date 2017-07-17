	<div id="tab1" class="tabcontent">
  		<h2><?php _e('Default Blog','default-blog-options'); ?></h2>
  		<label for="prefix"><?php _e('Select a default blog','default-blog-options'); ?></label><br>
  		<?php
  		
  		global $wpdb;
  		
  		$blogs = $wpdb->get_results("SELECT blog_id FROM " . $wpdb->blogs. " WHERE spam = '0' AND deleted ='0'", ARRAY_A );
  		
  		?>
  		<select id="act_defblog_id" name="act_defblog_id">
  		<?php 
  		
  		foreach($blogs AS $blog){
  			if($defblog_id==$blog['blog_id']){
  				echo "<option value=\"".$blog['blog_id']."\" selected>".get_blog_option($blog['blog_id'],'blogname')."</option>\n";
  			}else{
  				echo "<option value=\"".$blog['blog_id']."\">".get_blog_option($blog['blog_id'],'blogname')."</option>\n";
  			}
  		}

  		?>
   		</select>
   		<!--  <input name="act_defblog_id" type="text" size="20" id="act_defblog_id" value="<?php echo $defblog_id; ?>"/><br />  -->
   		
      	<p><div class="defblog_submit"><input type="submit" class="button-primary" name="defblog_submit" value="<?php _e('Save default blog ID', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>
    </div>