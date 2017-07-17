<div class="wrap">
    <h2><?php _e('Default Blog settings','default-blog-options'); ?></h2>
    <form method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    	<ul id="dbtable" class="shadetabs">
			<li><a href="#" rel="tab1" class="selected">Blog</a></li>
			<li><a href="#" rel="tab2"><?php _e('Posts', 'default-blog-options') ?></a></li>
			<li><a href="#" rel="tab5"><?php _e('Categories', 'default-blog-options') ?></a></li>
  			<li><a href="#" rel="tab6"><?php _e('Tags', 'default-blog-options') ?></a></li>
			<li><a href="#" rel="tab4"><?php _e('Links', 'default-blog-options') ?></a></li>		
  			<li><a href="#" rel="tab3"><?php _e('Pages', 'default-blog-options') ?></a></li>
  			<li><a href="#" rel="tab9"><?php _e('Design', 'default-blog-options') ?></a></li>
  			<li><a href="#" rel="tab10"><?php _e('Plugins', 'default-blog-options') ?></a></li>
  			<li><a href="#" rel="tab8"><?php _e('Settings', 'default-blog-options') ?></a></li>
  			<li><a href="#" rel="tab7"><?php _e('Options table (Expert modus)', 'default-blog-options') ?></a></li>
  		</ul>
  		<div>