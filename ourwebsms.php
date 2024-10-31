<?php
/*
Plugin Name: ourwebsms
Plugin URI: http://www.ourwebsms.com/wordpress.html
Description: A plugin that uses ourwebsms gateway. Please log in to www.ourwebsms.com to set up an account.
Version: 1.0.1
Author: Bill Banks <office@ourweb.net>
Author URI: http://www.ourweb.net
*/
?>
<?php

if ( is_admin() ){
     add_action('admin_init', 'ourwebsms_bb_init' );
	 add_action('admin_menu', 'ourwebsms_bb_addpage');
}
// Add setting page
function ourwebsms_bb_addpage() {
     add_options_page('Ourwebsms','Ourwebsms','manage_options','ourwebsms_bb','ourwebsms_bb_options_page');
}

// Options Page
function ourwebsms_bb_options_page() {
?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>ourwebsms  options</h2>
<form action="options.php" method="post">
<?Php
      settings_fields('ourwebsms_bb_options');
	  do_settings_sections('ourwebsms_bb');
?>
<input name="Submit" type="submit" value="Save">
</form></div>
<?php	
}
function ourwebsms_bb_validate() {
          return true;	
}

function ourwebsms_bb_section_text() {
	echo "<P>Enter  setting. </p>";
}

function ourwebsms_bb_setting_input() {
     $options = get_option('ourwebsms_bb_options');
	 	 $email_string = $options['email_string'];
	 $phone_string = $options['phone_string'];    
	 	 $cell_string = $options['cell_string']; 
		 
		 echo "<input id='email_string' name='ourwebsms_bb_email_string' type='text' value='{$options['email_string']}'"; 
		 
		 echo "<input id='cell_string' name='ourwebsms_bb_cell_string' type='text' value='{$options['cell_string']}'"; 
		 
		 echo "<input id='phone_string' name='ourwebsms_bb_phone_string' type='text' value='{$options['phone_string']}'";   	
}

function ourwebsms_bb_init() {

register_setting('ourwebsms_bb_options', 'ourwebsms_bb_options', 'ourwebsms_bb_validate_options');
add_settings_section('ourwebsms_bb_main', 'Ourwebsms Settings', 'ourwebsms_bb_section_text', 'ourwebsms_bb');
add_settings_field('ourwebsms_bb_email_string', 'Enter your Email', 'ourwebsms_bb_setting_input', 'ourwebsms_bb', 'ourwebsms_bb_main');
add_settings_field('ourwebsms_bb_cell_string', 'Enter your Cell', 'ourwebsms_bb_setting_input', 'ourwebsms_bb', 'ourwebsms_bb_main');
add_settings_field('ourwebsms_bb_phone_string', 'Enter your Phone', 'ourwebsms_bb_setting_input', 'ourwebsms_bb', 'ourwebsms_bb_main');	
	
}
add_shortcode('ourwebsms','ourwebsms_bb_ourwebsms');

function ourwebsms_bb_ourwebs() {  

   $options = get_option('ourwebsms_bb_options');
	 	 $memail = $options['email_string'];
	 $mphone = $options['phone_string'];    
	 	 $mmobile = $options['cell_string']; 
$sc = '<div class="smsform">
<center>
<h6>Signup for my SMS list
<form action="http://ourwebsms.com/signup.php" method="post">
<input type="hidden" name="uid" value="<? echo $memail ?>">
<input type="hidden" name="open" value="<? echo $mopen ?>">
<input type="hidden" name="phone" value="<? echo $mphone ?>">
<input type="hidden" name="ucell" value="<? echo $mmobile ?>">
<input type="hidden" name="ushare" value="<? echo $msharingNotifications ?>">
<input type="hidden" name="wshare" value="<? echo $mwhereshouldwesendsharenotifcations ?>">
<input type="hidden" name="uoptin" value="<? echo $moptInNotifications ?>">
<input type="hidden" name="woptin" value="<? echo $mWhereshouldwesendOptInNotifcations ?>">
<input type="checkbox" name="sharex">Only click here if youre sharing.<br>



Cell: <input type="tel" name="cell"><br>
Name: <input type="text"  name="name"><br>


 <input type="submit" value="Signup" class="formbutton"></h6>
</center>
</form>
</div>';

return sc;

	
}

add_action ( 'widgets_init', 'ourwebsms_bb_register_widgets' );

function ourwebsms_bb_register_widgets() {
	register_widget ('ourwebsms_widget');
}

class ourwebsms_widget extends WP_Widget {
	
    function ourwebsms_widget() {
		$widget_ops = array(
		'classname' => 'ourwebsms_widget',
		'description' => 'Display Ourwebsms form'
		);
		$this->WP_Widget( 'ourwebsms_widget','Ourwebsms Form',
		$widget_ops );
	
	}
	
	function form($instance) {
		
	}
	
	function update ($new_instance, $old_instance) {
		//process widget options to save
	}
	
	function widget ($args, $instance) {
		//displays the widget
		
   $options = get_option('ourwebsms_bb_options');
	 	 $memail = $options['email_string'];
	 $mphone = $options['phone_string'];    
	 	 $mmobile = $options['cell_string']; 
?>
<div class="smsform">
<center>
<h6>Signup for my SMS list
<form action="http://ourwebsms.com/signup.php" method="post">
<input type="hidden" name="uid" value="<? echo $memail ?>">
<input type="hidden" name="open" value="<? echo $mopen ?>">
<input type="hidden" name="phone" value="<? echo $mphone ?>">
<input type="hidden" name="ucell" value="<? echo $mmobile ?>">
<input type="hidden" name="ushare" value="<? echo $msharingNotifications ?>">
<input type="hidden" name="wshare" value="<? echo $mwhereshouldwesendsharenotifcations ?>">
<input type="hidden" name="uoptin" value="<? echo $moptInNotifications ?>">
<input type="hidden" name="woptin" value="<? echo $mWhereshouldwesendOptInNotifcations ?>">
<input type="checkbox" name="sharex">Only click here if youre sharing.<br>



Cell: <input type="tel" name="cell"><br>
Name: <input type="text"  name="name"><br>


 <input type="submit" value="Signup" class="formbutton"></h6>
</center>
</form>
</div>
<?
	}
}

?>