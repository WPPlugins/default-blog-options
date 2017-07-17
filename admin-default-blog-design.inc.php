 	<!--  Default Blog options admin page -->
 	<div id="tab9" class="tabcontent">
 	<div class="wrap">
      <h2><?php _e('Blog design','default-blog-options'); ?></h2>
      <?php _e('Select the settings, you like to be copied from this blog to a new blog. The settings will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
	<?php
	
    if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_design') != ""){
    	$global_blog_design = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_design');
  	}
  	if($_POST['design']!=""){$global_blog_design=$_POST['design'];}
  	
  	// print_r($global_blog_settings);
  	
  	// Theme
    echo "<tr><th scope='row'><label for='theme'>".__('Theme','default-blog-options')."</label></th>";
    echo "<td><input class='regular-text $class' type='text' value='".get_blog_option($defblog_id,'current_theme')."' disabled='disabled' /></td>";
   	if($global_blog_design["theme"]==true){
   		echo '<td><INPUT NAME="design[theme]" TYPE="CHECKBOX" VALUE="true" checked></td>';
   	} else {
		echo '<td><INPUT NAME="design[theme]" TYPE="CHECKBOX" VALUE="false"></td>';
   	}
   	echo "</tr>";
   	
    ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>	
    </div>
    </div>
    <!--  Default Blog options admin page -->