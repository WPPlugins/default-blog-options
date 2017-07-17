<?php 
// Templates
function form_head(){
	global $defblog_id;
	include("template/header.php");
}
function form_footer(){
	include("template/footer.php");
}
function alert($msg){
	include("template/alert.php");	
}
function tab_css() {
	echo '
	   <link rel="stylesheet" href="' . get_option('siteurl') . '/wp-content/plugins/default-blog-options/css/tabcontent.css" type="text/css" media="screen" />
	   <script type="text/javascript" src="' . get_option('siteurl') . '/wp-content/plugins/default-blog-options/js/tabcontent.js">
      /***********************************************
      * Tab Content script v2.2- © Dynamic Drive DHTML code library (www.dynamicdrive.com)
      * This notice MUST stay intact for legal use
      * Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
      ***********************************************/
      
    </script>

	';
}
function tab_js(){
	    echo '<script type="text/javascript">

var countries=new ddtabcontent("dbtable")
countries.setpersist(true)
countries.setselectedClassTarget("link") //"link" or "linkparent"
countries.init()

</script>';
}
?>