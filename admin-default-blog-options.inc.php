 	<!--  Default Blog options admin page -->
 	<div id="tab7" class="tabcontent">
 	<div class="wrap">
      <h2><?php _e('Blog options','default-blog-options'); ?></h2>
      <?php _e('Select the options, you like to be copied from this blog options table into a create blog option table. The options will be updated the first time the user visit the Dashboard.','default-blog-options'); ?>	
      <table class="widefat post fixed">
	<?php
    if(get_blog_option(SITE_ID_CURRENT_SITE,'global_blog_options') != ""){
    	$global_blog_options = get_blog_option(SITE_ID_CURRENT_SITE,'global_blog_options');
  	}
  	if($_POST['options']!=""){$global_blog_options=$_POST['options'];}
  	
    $options = $wpdb->get_results("SELECT * FROM wp_".$defblog_id."_options ORDER BY option_name");
    foreach((array) $options as $option) :
    	$disabled = '';
    	$option->option_name = esc_attr($option->option_name);
    	if($option->option_name=='')
    		continue;
    	if(is_serialized($option->option_value)){
    		if(is_serialized_string($option->option_value)){
    			// this is a serialized string, so we should display it
    			$value = maybe_unserialize($option->option_value);
    			$class = 'all-options disabled';
    			} else {
    			$value = 'SERIALIZED DATA';
    			$disabled = ' disabled="disabled"';
    			$class = 'all-options disabled';
    		}
    	}else{
    		$value = $option->option_value;
    		$class = 'all-options disabled';
    	}
    	echo "
    <tr>
    	<th scope='row'><label for='$option->option_name'>$option->option_name</label></th>
    <td>";
    	if (strpos($value, "\n") !== false) echo "<textarea class='$class' name='$option->option_name' id='$option->option_name' cols='30' rows='5'>" . esc_html($value) . "</textarea>";
    	else echo "<input class='regular-text $class' type='text' name='$option->option_name' id='$option->option_name' value='" . esc_attr($value) . "'$disabled />";
    	echo "</td><td>";
    	if(isset($global_blog_options)){
      	if(in_array($option->option_name,$global_blog_options)){
      		echo '<INPUT NAME="options[]" TYPE="CHECKBOX" VALUE="'.$option->option_name.'" checked>';
      	} else {
      		echo '<INPUT NAME="options[]" TYPE="CHECKBOX" VALUE="'.$option->option_name.'">';
      	}
    	} else {
      		echo '<INPUT NAME="options[]" TYPE="CHECKBOX" VALUE="'.$option->option_name.'">';
      }
    	echo "</td>
    	</tr>";
    endforeach;
    ?>
      </table>
      <p><div class="submit"><input type="submit" name="submit" class="button-primary" value="<?php _e('Update', 'default-blog-options') ?>"  style="font-weight:bold;" /></div></p>	
    </div>
    </div>
    <!--  Default Blog options admin page -->