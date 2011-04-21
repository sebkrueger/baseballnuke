jQuery(document).ready(
        function()
        {
          jQuery('#bbnuke_plugin_option_header_bg_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_header_txt_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_bg_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_hover_color').jPicker({window:{expandable: true}});
          jQuery('#bbnuke_plugin_option_txt_color').jPicker({window:{expandable: true}});
		
          jQuery(".v_inning").blur(function() {
	  	var Total = 0;
		jQuery(".v_inning").each(function() {
			if (!isNaN(this.value) && this.value.length != 0) {
            			Total += parseFloat(this.value);
        		}		
			jQuery("#vruns_total").val(Total);
		});
	  });
	
          jQuery(".h_inning").blur(function() {
                var Total = 0;
                jQuery(".h_inning").each(function() {
                        if (!isNaN(this.value) && this.value.length != 0) {
                                Total += parseFloat(this.value);
                        }
                        jQuery("#hruns_total").val(Total);
                });
          });

          jQuery(".classBA").blur(function() {
                var Total = 0;
                jQuery(".classBA").each(function() {
                        if (!isNaN(this.value) && this.value.length != 0) {
                                Total += parseFloat(this.value);
                        }
                        jQuery("#vhits_total").val(Total);
                });
          });

          jQuery(".classPI").blur(function() {
                var Total = 0;
                jQuery(".classPI").each(function() {
                        if (!isNaN(this.value) && this.value.length != 0) {
                                Total += parseFloat(this.value);
                        }
                        jQuery("#hhits_total").val(Total);
                });
          });


	} //end function
);

function showTab( toShow ) {
	jQuery(".tabContent").hide();
	jQuery(toShow).show();
	
}


