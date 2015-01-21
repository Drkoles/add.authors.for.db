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
	<form method = "POST">
	Добавить в базу:
		<input type = "text" value = "Ссылка на CSV" name = "ssilka">
		<input type = "submit" name = "Enter">
	</form>
<?php
	}
?>