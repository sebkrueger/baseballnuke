<?php


function bbnuke_include_js()
{
global $module, $name, $admin, $advanced_editor, $lang;

if (file_exists("themes/$ThemeSel/style/editor.css")) {
    $edtcss = "editor_css : \"themes/$ThemeSel/style/editor.css\",";
} else {
    $edtcss = "editor_css : \"includes/tiny_mce/themes/default/editor_ui.css\",";
}

if (is_admin($admin) AND defined('ADMIN_FILE') AND $advanced_editor == 1) {
	echo "<!-- tinyMCE -->
		<script language=\"javascript\" type=\"text/javascript\" src=\"includes/tiny_mce/tiny_mce.js\"></script>
		<script language=\"javascript\" type=\"text/javascript\">
	   	tinyMCE.init({
		mode : \"textareas\",
		theme : \"advanced\",
		language : \"$lang\",
		force_p_newlines: \"false\",
		force_br_newlines: \"true\",
		plugins : \"table,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,zoom,flash,searchreplace,print\",
		theme_advanced_buttons1_add : \"fontselect,fontsizeselect\",
		theme_advanced_buttons2_add : \"separator,insertdate,inserttime,preview,zoom,separator,forecolor,backcolor\",
		theme_advanced_buttons2_add_before: \"cut,copy,paste,separator,search,replace,separator\",
		theme_advanced_buttons3_add_before : \"tablecontrols,separator\",
		theme_advanced_buttons3_add : \"emotions,iespell,flash,advhr,separator,print\",
		theme_advanced_toolbar_location : \"top\",
		theme_advanced_toolbar_align : \"left\",
		theme_advanced_path_location : \"bottom\",
		$edtcss
	    	plugin_insertdate_dateFormat : \"%Y-%m-%d\",
	    	plugin_insertdate_timeFormat : \"%H:%M:%S\",
		extended_valid_elements : \"a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]\",
		external_link_list_url : \"example_link_list.js\",
		external_image_list_url : \"example_image_list.js\",
		flash_external_list_url : \"example_flash_list.js\",
		file_browser_callback : \"fileBrowserCallBack\"
	});
	function fileBrowserCallBack(field_name, url, type) {
		// This is where you insert your custom filebrowser logic
		alert(\"Filebrowser callback: \" + field_name + \",\" + url + \",\" + type);
	}		</script>
		<!-- /tinyMCE -->";
} elseif (is_admin($admin) AND $advanced_editor != 1 AND $name != "Private_Messages") {
	echo "<!-- tinyMCE -->
		<script language=\"javascript\" type=\"text/javascript\" src=\"includes/tiny_mce/tiny_mce.js\"></script>
		<script language=\"javascript\" type=\"text/javascript\">
	   	tinyMCE.init({
      		mode : \"textareas\",
			theme : \"basic\",
			language : \"$lang\",
			$edtcss
			force_p_newlines: \"false\",
			force_br_newlines: \"true\"
	   	});
		</script>
		<!-- /tinyMCE -->";
} elseif ($name != "Private_Messages" AND $name != "Forums") {
	echo "<!-- tinyMCE -->
		<script language=\"javascript\" type=\"text/javascript\" src=\"includes/tiny_mce/tiny_mce.js\"></script>
		<script language=\"javascript\" type=\"text/javascript\">
	   	tinyMCE.init({
      		mode : \"textareas\",
			theme : \"default\",
			language : \"$lang\",
			$edtcss
			force_p_newlines: \"false\",
			force_br_newlines: \"true\"
	   	});
		</script>
		<!-- /tinyMCE -->";
}

if ($userpage == 1) {
    echo "<SCRIPT type=\"text/javascript\">\n";
    echo "<!--\n";
    echo "function showimage() {\n";
    echo "if (!document.images)\n";
    echo "return\n";
    echo "document.images.avatar.src=\n";
    echo "'$nukeurl/modules/Forums/images/avatars/gallery/' + document.Register.user_avatar.options[document.Register.user_avatar.selectedIndex].value\n";
    echo "}\n";
    echo "//-->\n";
    echo "</SCRIPT>\n\n";
}

if ($module == 1 AND file_exists("modules/$name/copyright.php")) {
    echo "<script type=\"text/javascript\">\n";
    echo "<!--\n";
    echo "function openwindow(){\n";
    echo "	window.open (\"modules/$name/copyright.php\",\"Copyright\",\"toolbar=no,location=no,directories=no,status=no,scrollbars=yes,resizable=no,copyhistory=no,width=400,height=200\");\n";
    echo "}\n";
    echo "//-->\n";
    echo "</SCRIPT>\n\n";
}

}













?>