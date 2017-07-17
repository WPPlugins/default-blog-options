 	<!--  Default Blog options admin page -->
 	<div id="tab8" class="tabcontent">
 	<div class="wrap">
      <h2><?php _e('Blog settings','default-blog-options'); ?></h2>
      <?php _e('Select the settings, you like to be copied from this blog to a new blog. The settings will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
	<?php
	
    if(get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_settings') != ""){
    	$global_blog_settings = get_blog_option(SITE_ID_CURRENT_SITE,'default_blog_settings');
  	}
  	if($_POST['settings']!=""){$global_blog_settings=$_POST['settings'];}
  	
  	// print_r($global_blog_settings);
  	   	
   	// Welcome page
   	switch_to_blog($defblog_id);
	$page_title=get_the_title(get_blog_option($defblog_id,'page_on_front'));
	restore_current_blog();
   	
    echo "<tr><th scope='row'><label for='theme'>".__('Welcome page','default-blog-options')."</label></th>";
    echo "<td><input class='regular-text $class' type='text' value='".$page_title."' disabled='disabled' /></td>";
    
   	if($global_blog_settings["welcome_page"]==true){
   		echo '<td><INPUT NAME="settings[welcome_page]" TYPE="CHECKBOX" VALUE="true" checked></td>';
   	} else {
		echo '<td><INPUT NAME="settings[welcome_page]" TYPE="CHECKBOX" VALUE="false"></td>';
   	}
   	echo "</tr>";
   	
    ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>	
    </div>
    </div>
    <!--  Default Blog options admin page -->