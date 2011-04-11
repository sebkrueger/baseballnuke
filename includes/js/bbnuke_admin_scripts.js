jQuery(document).ready(
        function()
        {
          jQuery('#bbnuke_plugin_option_header_bg_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_header_txt_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_bg_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_hover_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_txt_color').jPicker({window:{expandable: true}});

	}
);

function showTab( toShow ) {
	jQuery(".tabContent").hide();
	jQuery(toShow).show();
	
}
