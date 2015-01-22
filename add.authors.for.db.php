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
add_action( 'admin_init', 'register_mysettings');
	function register_mysettings() 
		{
			register_setting( 'my-plugin-settings-group', 'option_mass' );
		}
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
		<input id = "ssilka" type = "text">
		<input id = "getForecast" type = "submit" name = "Enter">
	</form>
<script type="text/javascript" >
(function($) {
	$(document).on('click', '#getForecast', function(e){
	e.preventDefault();
		var data = {
		'action': 'my_action',
		'whatever':  $('#ssilka').val()  
		};
$.post(ajaxurl, data, function(response) {
	alert(response);
	});
});
})(jQuery);
</script>
<?php
}
add_action( 'wp_ajax_my_action', 'my_action_callback' );
function my_action_callback() {
	global $wpdb; 
	$file_name = $_POST['whatever'];
	$upload_dir = wp_upload_dir();
	$base_dir = $upload_dir['path']; // /home/k/kamaev/wp-kama.ru/public_html/wp-content/uploads/2015/01
	$file_dir = $base_dir."/".$file_name;
			if(($handle_o = fopen($file_dir , "r")) !== FALSE)
			{
				$insertValuesMass = array();
					while (($data_o = fgetcsv($handle_o, 500, ";")) !== FALSE) 
					{
						$insertValues = array();
						  foreach( $data_o as $v ) 
						  {
							$insertValues[] = addslashes(trim($v));
						  }
						$year = substr("'".$insertValues[0]."'", 1, 2);		
						$month = substr("'".$insertValues[0]."'", 3, 2);
						$page = substr("'".$insertValues[0]."'", 5,-1);
						$insertValuesMass[] = array($year,$month,$page,$insertValues[1],$insertValues[2],$insertValues[3],$insertValues[4],$insertValues[5]);
					}
			}		
	update_option( 'option_mass', $insertValuesMass ); //для проверки
	$whatever = var_dump($insertValuesMass);
	echo $whatever;
	wp_die();
}
?>