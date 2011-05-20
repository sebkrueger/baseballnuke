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

	  jQuery("#bbnuke_retrieve_gamechanger_results_btn_id").bind('click', function() {
		var gameID = jQuery("#bbnuke_plugin_gamechanger_import").val();
		var pitchLink = 'http://www.gamechanger.io/game-'+gameID+'/boxscore/batting/standard';
		var home_or_away = jQuery("#tbl_home_or_away").val();
		var tableToGet = "tbl_"+ home_or_away + "_batting";
		var classSection = "offense";
		
		if (jQuery("#Pitching").attr("style") == "")  {
			pitchLink = 'http://www.gamechanger.io/game-'+gameID+'/boxscore/pitching/standard';
			tableToGet = "tbl_"+ home_or_away +"_pitching";
			classSection = "pitching";
		}
		else if (jQuery("#Fielding").attr("style") == "" ) {
			pitchLink = 'http://www.gamechanger.io/game-'+gameID+'/boxscore/fielding/';
			tableToGet = "tbl_"+ home_or_away + "_fielding";
			classSection = "fielding";
		}
		else {
		}

		var yql = 'http://query.yahooapis.com/v1/public/yql?q=' + encodeURIComponent('select tbody FROM html where url ="'+ pitchLink +'" and xpath="//table[@id=' + "'" + tableToGet + "'" + ']"') + '&format=xml&callback=?';
		jQuery.getJSON( yql, cbFunc );
		function cbFunc(data) {
			if ( data.results[0] ) {
				data = data.results[0].replace(/<script[^>]*>[\s\S]*?<\/script>/gi, '');
				jQuery("#gamesitedump").html(data);
				//get data and fill form
				
				_parseYQLandFillForm(data, classSection);
			
			}
			else {
			 	jQuery("#gamesitedump").html("Error");
				throw new Error('Nothing returned from getJSON.'); 
			}
	
		}
	  });
	} //end function
);

function showTab( toShow ) {
	jQuery(".tabContent").hide();
	jQuery(toShow).show();
	
}

function _parseYQLandFillForm(data, classSection) {
	var playerArray = data.split("<tr");
	for (var a in playerArray) {
		var gamerIDname = jQuery(playerArray[a]).find('a').text();

		if (gamerIDname == 'undefined' || gamerIDname == '') { 
			continue;
		}
	
		gamerIDname = gamerIDname.toLowerCase();
		var gamerIDname_mod = gamerIDname.split(" ");
		var giFirst = gamerIDname_mod[0];
		var giLast = gamerIDname_mod[1];
	
		jQuery('.playername_'+classSection).each(function() {
			var bbName= jQuery(this).html();
			bbName = bbName.toLowerCase();
			var bbName_mod = bbName.split(",");
			var bbLast = bbName_mod[0];
			bbLast = bbLast.replace(/,/,'');
			var bbFirst = bbName_mod[1];
		
			if (bbLast == giLast) { 
				var playerID = jQuery('#playerID_for_'+bbLast+bbFirst).val();
				var statList = _getFillData(playerArray[a], playerID, classSection);
			}                                        
		});
	}
	return;
}

function _getFillData(playerTR, playerID, classSection) {
	playerTR = playerTR.replace(/<p>/ig, "=");
	playerTR = playerTR.replace(/<\/p>/ig, ";");
	playerTR = playerTR.replace(/<td class/ig, "");
	playerTR = playerTR.replace(/<.*?>/ig, "");

	txtarray = playerTR.split(";");
	txtarray[0] = txtarray[0].replace(/.*num ?(.*)\">=/i, "num $1=");

	for (var i in txtarray) {
		txtarray[i]=txtarray[i].replace(/>/,"");
		txtarray[i]=txtarray[i].replace(/="(.*)"/, "$1");
	}

	_populateFields(txtarray, classSection, playerID);
}

function _populateFields(statList, classSection, playerID) {
	var pitchingList = new Array('num IP='+playerID+'_piIP','num H:pitching='+playerID+'_piHits','num R:pitching='+playerID+'_piRA','num ER='+playerID+'_piRuns','num BB:pitching='+playerID+'_piWalks','num SO:pitching='+playerID+'_piSO','num W='+playerID+'_piWin','num L='+playerID+'_piLose','num SV='+playerID+'_piSave','num BS='+playerID+'_piBS','num HBP:pitching='+playerID+'_piHBP','num GP:pitching='+playerID+'_piGP','num SVO='+playerID+'_piSVO');

	var offenseList = new Array('num AB='+playerID+'_baAB', 'num R='+playerID+'_baRuns', 'num RBI='+playerID+'_baRBI', 'num BB='+playerID+'_baBB', 'num SO='+playerID+'_baK', 'num 2B='+playerID+'_ba2b', 'num 3B='+playerID+'_ba3b', 'num HR='+playerID+'_baHR', 'num ROE='+playerID+'_baRE', 'num FC='+playerID+'_baFC', 'num HBP='+playerID+'_baHP', 'num 1B='+playerID+'_ba1b');

	var fieldingList = new Array('num PO:fielding='+playerID+'_fiPO','num E:fielding='+playerID+'_fiE','num A='+playerID+'_fiA');

	var list = offenseList;
	if (classSection == 'pitching') {
		list = pitchingList;
	}
	else if (classSection == 'fielding') {
		list = fieldingList;
	}

	for (var x in statList) {
		var gdata = statList[x].split("=");
		for (var i in list) {
			var fields = list[i].split("=");
			if (gdata[0] == fields[0]) {
				jQuery('input[name="'+fields[1]+'"]').val(gdata[1]);
			}
		}
	}
}
