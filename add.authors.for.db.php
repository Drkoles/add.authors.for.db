<?php
/*
Plugin Name: AddAuthorsBase
Plugin URI: http://github.com
Description: Add Base of Authors
Version: 1.0.0
Author: Kolesov Alexey
Author URI: http://
*/
add_action('admin_menu', 'CreateMyPluginMenu');
	function CreateMyPluginMenu()
	{
		if (function_exists('add_options_page'))
		{
			add_options_page('Настройки Authors.', 'AuthorsSetting', 'manage_options', 'Myplugin', 'MyPluginPageOptions');
		}
	}
	function MyPluginPageOptions()
	{
		echo "<h2>Настройки Authors.</h2>";
?>
	<form id = "ajaxform" method = "POST">
	ЧТо то там:
		<input type = "text" value = "" name = "ssilka">
		<input id = "getForecast" type = "submit" name = "Enter">
	</form>
<?php 
}
?>
<script type="text/javascript" >
(function($) {
	$(document).on('click', '#getForecast', function(e){
	e.preventDefault();
		var data = {
		'action': 'my_action',
		'whatever': 'Соси' 
		};
$.post(ajaxurl, data, function(response) {
	alert(response);
	});
});
})(jQuery);
</script>
<?php
add_action( 'wp_ajax_my_action', 'my_action_callback' );
function my_action_callback() {
	global $wpdb; 
	$whatever = $_POST['whatever'];
        echo $whatever;
	wp_die(); // this is required to terminate immediately and return a proper response
}
?>