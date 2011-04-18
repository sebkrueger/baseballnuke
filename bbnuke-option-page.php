<?php

global $wpdb;


function bbnuke_plugin_print_option_page()
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

  $team_leaders = $options['bbnuke_team_leaders'];
  $bg_color     = $options['bbnuke_widget_bg_color'];
  $hover_color     = $options['bbnuke_widget_hover_color'];
  $txt_color    = $options['bbnuke_widget_txt_color'];
  $header_bg_color    = $options['bbnuke_widget_header_bg_color'];
  $header_txt_color    = $options['bbnuke_widget_header_txt_color'];
  $wdg_playerstats_player_id  = $options['bbnuke_widget_playerstats_player_id'];
  $wdg_game_results_player_id = $options['bbnuke_widget_game_results_player_id'];
  $wdg_game_results_game_id   = $options['bbnuke_widget_game_results_game_id'];
  $game_results_page   = $options['bbnuke_game_results_page'];
  $player_stats_page   = $options['bbnuke_player_stats_page'];
  $locations_page   = $options['bbnuke_locations_page'];

  //   get seasons
  $seasons_list    = bbnuke_get_seasons();
  $team_list       = bbnuke_get_teams();
  $defs            = bbnuke_get_defaults();

  $players         = bbnuke_get_players($defs['defaultSeason']);
  $games           = bbnuke_get_past_games_with_results();

  echo
  '<div class="wrap">' . "\n" .
  '  <a name="Top"></a>' . "\n" .
  '  <div class="bbnuke-icon32"></div>' . "\n" .
  '  <h2>baseballNuke - Plugin Settings</h2>' . "\n" .
  '  <hr />' . "\n" .
  '  <p>' . "\n" .
  '    <b>Welcome to baseballNuke</b><br />' . "\n" .
  '    ' . __('baseballNuke is a wordpress plugin based on the module for the CMS phpnuke <a href="http://phpnuke.org" target="_blank">http://phpnuke.org</a> for the administration of a single baseball team. It is a complete team management tool and information source. baseballNuke provides team and individual information about the players including schedule, field directions, player stats, team stats, player profiles and game results.', 'bbnuke') . '<br />' . "\n" .
  '  </p>' . "\n" .
  '  <hr />' . "\n" .
  '  <div class="clear"></div>' . "\n" .
  '  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-main">' . "\n" .
  '      <div class="has-sidebar-content">' . "\n" .
  '        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-settings">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Settings', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <b>Default settings</b><br />' . "\n" .
  '              <form name="bbnuke_plugin_option_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_plugin_options');

  echo
  '              <table class="form-table">' . "\n" .
  '               <tr><th class="bbnuke_option_left_part"><label for="bbnuke_season_select">Set default season and team</label></th>' . "\n" .
  '                <td>Default season:&nbsp;<select name="bbnuke_def_season_select" class="select-season-single" size="1">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $defs['defaultSeason'] )
      echo '<option value="' . $i . '" selected="yes">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $i . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                 </select><br /><br />' . "\n" .
  '                 Default team:&nbsp;<select name="bbnuke_def_team_select" class="select-team-single" size="1">' . "\n";

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $defs['defaultTeam'] )
      echo '<option value="' . $i . '" selected="yes">' . $team_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $i . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                 </select><br /><br />' . "\n" .
  '                 <div class="div-wait" id="divwaitdts0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                 <input type="submit" class="button-primary" value="Set Defaults" id="bbnuke_set_defs_btn_id" name="bbnuke_set_defs_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                 </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label>Game Results Widget Page</label></th>' . "\n" .
  '                  <td>' .wp_dropdown_pages(array('name'=>'bbnuke_plugin_option_game_results_page','selected'=>"$game_results_page",'echo'=>'0')) . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label>Player Stats Widget Page</label></th>' . "\n" .
  '                  <td>' .wp_dropdown_pages(array('name'=>'bbnuke_plugin_option_player_stats_page','selected'=>"$player_stats_page",'echo'=>'0')) . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label>Locations Widget Page</label></th>' . "\n" .
  '                  <td>' .wp_dropdown_pages(array('name'=>'bbnuke_plugin_option_locations_page','selected'=>"$locations_page",'echo'=>'0')) . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_team_leaders">Team Leaders</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_plugin_option_team_leaders" value="' . $team_leaders . '" />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_header_bg_color">Table Header Background Color</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_plugin_option_header_bg_color" id="bbnuke_plugin_option_header_bg_color" value="' . $header_bg_color . '" />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_header_txt_color">Table Header Text Color</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_plugin_option_header_txt_color" id="bbnuke_plugin_option_header_txt_color" value="' . $header_txt_color . '" />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_bg_color">Table Body Background Color</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_plugin_option_bg_color" id="bbnuke_plugin_option_bg_color" value="' . $bg_color . '" />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_hover_color">Table Body Hover Color</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_plugin_option_hover_color" id="bbnuke_plugin_option_hover_color" value="' . $hover_color . '" />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_txt_color">Table Body Text Color</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_plugin_option_txt_color" id="bbnuke_plugin_option_txt_color" value="' . $txt_color . '" />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_wdg_playerstats_playerid">Widget PlayerStats Player ID</label></th>' . "\n" .
  '                  <td><select name="bbnuke_plugin_option_wdg_playerstats_players_select" class="select-team-single" size="1">' . "\n";

  for ( $i=0; $i < count($players); $i++ )
  {
    if ( $players[$i]['playerID'] == $wdg_playerstats_player_id )
      echo '<option value="' . $players[$i]['playerID'] . '" selected="yes">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>' . "\n";
    else
      echo '<option value="' . $players[$i]['playerID'] . '">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_wdg_playerstats_playerid">Widget Game Results - Player ID</label></th>' . "\n" .
  '                  <td><select name="bbnuke_plugin_option_wdg_game_results_players_select" class="select-team-single" size="1">' . "\n";

  for ( $i=0; $i < count($players); $i++ )
  {
    if ( $players[$i]['playerID'] == $wdg_game_results_player_id )
      echo '<option value="' . $players[$i]['playerID'] . '" selected="selected">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>' . "\n";
    else
      echo '<option value="' . $players[$i]['playerID'] . '">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_wdg_playerstats_playerid">Widget Game Results - Game ID</label></th>' . "\n" .
  '                  <td><select name="bbnuke_plugin_option_wdg_game_results_games_select" class="select-team-single" size="1">' . "\n";

  for ( $i=0; $i < count($games); $i++ )
  {
    if ( $games[$i]['gameID'] == $wdg_game_results_game_id )
      echo '<option value="' . $games[$i]['gameID'] . '" selected="selected">' . $games[$i]['homeTeam'] . ' vs ' . $games[$i]['visitingTeam'] . ' on ' . $games[$i]['Gdate'] . ' at ' . $games[$i]['Gtime'] . '</option>' . "\n";
    else
      echo '<option value="' . $games[$i]['gameID'] . '">' . $games[$i]['homeTeam'] . ' vs ' . $games[$i]['visitingTeam'] . ' on ' . $games[$i]['Gdate'] . ' at ' . $games[$i]['Gtime'] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit">' . "\n" .
  '                <div class="div-wait" id="divwaitms0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_btn_above" name="bbnuke_update_options_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="season-div">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Seasons Management', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select which teams you want add to which season.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_plugin_option_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_plugin_options');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_season_new">New Season:</label></th>' . "\n" .
  '                  <td><input type="text" size="6" id="bbnuke_season_new_id" name="bbnuke_season_new" value="" />  (Year)<br />' . "\n" .
  '                    <div class="div-wait" id="divwaitsn0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Add new season" id="bbnuke_add_season_btn_id" name="bbnuke_add_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" class="select-season-single" id="bbnuke_select_season_id" name="bbnuke_select_season">' . "\n";

  reset($seasons_list);
  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    echo '<option value="' . $i . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>&nbsp;' . "\n" .
  '                    <div class="div-wait" id="divwaitsn1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Delete season" id="bbnuke_del_season_btn_id" name="bbnuke_del_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                    <br /><br />' . "\n" .
  '                    Select teams you want add to that season<br />' . "\n" .
  '                    <select size="6" class="select-teams-multiple" multiple="multiple" id="bbnuke_select_season_teams_id" name="bbnuke_select_season_teams[]">' . "\n";

  for ( $i=0; $i < count($team_list); $i++ )
  {
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit">' . "\n" .
  '                <div class="div-wait" id="divwaitst0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Add teams to season" id="bbnuke_add_season_teams_btn_id" name="bbnuke_add_season_teams_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="teams-div">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Teams', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Add and delete teams.', 'bbnuke') . '<br /><br />' .
  '              </p>' . "\n" .
  '              <form name="bbnuke_plugin_option_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_plugin_options');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_add_new_team">Add new team: </label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_add_new_team" size="25" value="" />' . "\n" .
  '                    <div class="div-wait" id="divwaitt0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="' . __('Add', 'bbnuke') . '" id="bbnuke_add_new_team_btn_id" name="bbnuke_add_new_team_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season">Delete a team:</label></th>' . "\n" .
  '                  <td><select size="1" name="bbnuke_select_team_delete" class="select-team-single">' . "\n";

  reset($team_list);
  for ( $i=0; $i < count($team_list); $i++ )
  {
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                    <div class="div-wait" id="divwaitt1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="' . __('Delete', 'bbnuke') . '" id="bbnuke_select_team_delete_btn_id" name="bbnuke_select_team_delete_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-news">' . "\n" .
  '      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_info">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <!-- Facebook Badge START -->' . "\n" .
  '            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP" ><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>' . "\n" .
  '            <!-- Facebook Badge END -->' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_links">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Donations</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <p>Help support the Flying Dogs by making a donation!</p>' . "\n" .
  '            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal-form">' . "\n" .
  '              <input type="hidden" name="cmd" value="_xclick">' . "\n" .
  '              <input type="hidden" name="business" value="manager@frederickcardinals.com">' . "\n" .
  '              <input type="hidden" name="item_name" value="Flying Dogs Donation">' . "\n" .
  '              <input type="hidden" name="item_number" value="2007donation">' . "\n" .
  '              <input type="hidden" name="no_shipping" value="0">' . "\n" .
  '              <input type="hidden" name="no_note" value="1">' . "\n" .
  '              <input type="hidden" name="currency_code" value="USD">' . "\n" .
  '              <input type="hidden" name="tax" value="0">' . "\n" .
  '              <input type="hidden" name="lc" value="US">' . "\n" .
  '              <input type="hidden" name="bn" value="PP-DonationsBF">' . "\n" .
  '              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">' . "\n" .
  '            </form>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '  </div>' . "\n" .
  '</div>' . "\n";

}



////////////////////////////////////////////////////////////////////////////////
// show locations page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_fields_page( $edit_field = false )
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

  $fields_list = bbnuke_get_locations();

  $fieldname   = NULL;

  if ( $edit_field === true )
  {
    $field_id   = bbnuke_get_option('bbnuke_location_edit_id');
    $fieldname  = $fields_list[$field_id]['fieldname'];
    $directions = bbnuke_get_field_data($fieldname);
  }


  echo
  '<div class="wrap">' . "\n" .
  '  <a name="Top"></a>' . "\n" .
  '  <div class="bbnuke-icon32"></div>' . "\n" .
  '  <h2>baseballNuke Plugin  -  Locations Settings</h2>' . "\n" .
  '  <hr />' . "\n" .
  '  <div class="clear"></div>' . "\n" .
  '  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-main">' . "\n" .
  '      <div class="has-sidebar-content">' . "\n" .
  '        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-fields-edit">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Field Edit', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <b>Add or Edit a Location</b>' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Edit the location or add a new entry.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_fields_edit_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_fields_edit');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_field_edit_fieldname">Field Name</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_field_edit_fieldname" value="' . $fieldname . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_field_edit_directions">Directions</label></th>' . "\n" .
  '                  <td><textarea class="bbnuke_textarea" name="bbnuke_field_edit_directions" cols="50" rows="10">' . $directions . '</textarea></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n";

  echo
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td>' . "\n";

  if ( $edit_field === true )
    echo '                    <input type="hidden" value="' . $field_id . '" name="bbnuke_delete_field_id" />' . "\n";
  else
    echo '                    <input type="hidden" value="none" name="bbnuke_delete_field_id" />' . "\n";

  echo
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="div-wait" id="divwaitedl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_location_btn_id" name="bbnuke_save_location_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;' . "\n";

  if ( $edit_field === true )
  {
    echo
    '                <div class="div-wait" id="divwaitedl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                <input type="submit" class="button-primary" value="Delete Field" id="bbnuke_delete_field_' . $field_id . '_btn_id" name="bbnuke_delete_field_' . $field_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n";
  }

  echo
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-locations-list">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Locations List', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Edit or delete a location.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_fields_list_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_fields_list');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">Total Locations:</label></th>' . "\n" .
  '                  <td>' . count($fields_list) . '&nbsp;&nbsp;' . "\n" .
  '                    <div class="div-wait" id="divwaitlloc0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Delete all locations" id="bbnuke_del_all_fields_btn_id" name="bbnuke_del_all_fields_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_fields">Current Locations:</label></th>' . "\n" .
  '                  <td><ul class="locations-list">' . "\n";

  for ( $i=0; $i < count($fields_list); $i++ )
  {
    $fieldname   = $fields_list[$i]['fieldname'];
    $directions  = $fields_list[$i]['directions'];
    echo
    '                       <li class="locations-list-entry">' . "\n" .
    '                         <label for="bbnuke_field_' . $i . '" class="locations-list-entry-label">' . $fieldname . '</label> -- &nbsp;' . "\n" .
    '                         <div class="div-wait" id="divwaitlloc1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                         <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_field_' . $i . '_btn_id" name="bbnuke_edit_field_' . $i . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;' . "\n" .
    '                         <div class="div-wait" id="divwaitlloc2"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                         <input type="submit" class="button-primary" value="Delete" id="bbnuke_delete_field_' . $i . '_btn_id" name="bbnuke_delete_field_' . $i . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;' . "\n" .
    '                       </li>' . "\n";
  }

  echo
  '                      </ul></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-news">' . "\n" .
  '      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_info">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <!-- Facebook Badge START -->' . "\n" .
  '            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>' . "\n" .
  '            <!-- Facebook Badge END -->' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_links">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Donations</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <p>Help support the Flying Dogs by making a donation!</p>' . "\n" .
  '            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">' . "\n" .
  '              <input type="hidden" name="cmd" value="_xclick">' . "\n" .
  '              <input type="hidden" name="business" value="manager@frederickcardinals.com">' . "\n" .
  '              <input type="hidden" name="item_name" value="Flying Dogs Donation">' . "\n" .
  '              <input type="hidden" name="item_number" value="2007donation">' . "\n" .
  '              <input type="hidden" name="no_shipping" value="0">' . "\n" .
  '              <input type="hidden" name="no_note" value="1">' . "\n" .
  '              <input type="hidden" name="currency_code" value="USD">' . "\n" .
  '              <input type="hidden" name="tax" value="0">' . "\n" .
  '              <input type="hidden" name="lc" value="US">' . "\n" .
  '              <input type="hidden" name="bn" value="PP-DonationsBF">' . "\n" .
  '              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">' . "\n" .
  '            </form>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '  </div>' . "\n" .
  '</div>' . "\n";

  return;
}



////////////////////////////////////////////////////////////////////////////////
// show players page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_players_option_page( $edit_player = false )
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

  //   get seasons
  $seasons_list = bbnuke_get_seasons();
  $team_list    = bbnuke_get_teams();
  $players      = array();
  $player_id    = bbnuke_get_option('bbnuke_players_edit_id');
  $player       = NULL;

  if ( $edit_player === true )
  {
    $season  = bbnuke_get_option('bbnuke_players_season');
    $team    = bbnuke_get_option('bbnuke_players_team');
    $players = bbnuke_get_players_season_team($season, $team);
    $player  = $players[$player_id];
    $player_obj = bbnuke_get_player_info($player_id, $season);

    //   set player variables
    $firstname  = $player_obj->firstname;
    $middlename = $player_obj->middlename;
    $lastname   = $player_obj->lastname;
    $profile    = $player_obj->profile;
    $positions  = $player_obj->positions;
    $bats       = $player_obj->bats;
    $throws     = $player_obj->throws;
    $height     = $player_obj->height;
    $weight     = $player_obj->weight;
    $bdate      = $player_obj->bdate;
    $address    = $player_obj->address;
    $city       = $player_obj->city;
    $state      = $player_obj->state;
    $zip        = $player_obj->zip;
    $homephone  = $player_obj->homePhone;
    $cellphone  = $player_obj->cellphone;
    $workphone  = $player_obj->workPhone;
    $jerseynum   = $player_obj->jerseyNum;
    $email       = $player_obj->email;
    $school      = $player_obj->school;
    $piclocation = $player_obj->picLocation;
  }


  echo
  '<div class="wrap">' . "\n" .
  '  <a name="Top"></a>' . "\n" .
  '  <div class="bbnuke-icon32"></div>' . "\n" .
  '  <h2>baseballNuke Plugin  -  Players Settings</h2>' . "\n" .
  '  <hr />' . "\n" .
  '  <div class="clear"></div>' . "\n" .
  '  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-main">' . "\n" .
  '      <div class="has-sidebar-content">' . "\n" .
  '        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-players-1">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Players', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <b>Add, edit, delete Players</b>' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('<b>Player</b>', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '  <form name="bbnuke_players_edit_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_players_edit_form');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_fname">First Name</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_fname" value="' . $firstname . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_mname">Middle Name</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_mname" value="' . $middlename . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_lname">Last Name</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_lname" value="' . $lastname . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_pprofile">Player Profile</label></th>' . "\n" .
  '                  <td><textarea class="bbnuke_textarea" rows="20" cols="55" name="bbnuke_player_edit_pprofile">' . $profile . '</textarea></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_team">Team</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_player_edit_team_id" name="bbnuke_player_edit_team">' . "\n";

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $team )
      echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_season">Season</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_player_edit_season_id" name="bbnuke_player_edit_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_jerseynum">Jersey Number</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_jerseynum" value="' . $jerseynum . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_position">Position(s)</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_position" value="' . $positions . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_bats">Bats</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_bats" value="' . $bats . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_throws">Throws</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_throws" value="' . $throws . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_height">Height</label><i> (value in inches) </i></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_height" value="' . $height . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_weight">Weight</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_weight" value="' . $weight . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_bdate">Birth Date</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_bdate" value="' . $bdate . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_address">Address</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_address" value="' . $address . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_city">City</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_city" value="' . $city . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_state">State</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_state" value="' . $state . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_zip">Zip</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_zip" value="' . $zip . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_hphone">Home Phone</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_hphone" value="' . $homephone . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_cphone">Cell Phone</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_cphone" value="' . $cellphone . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_wphone">Work Phone</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_wphone" value="' . $workphone . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_email">Email</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_email" value="' . $email . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_school">School</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_player_edit_school" value="' . $school . '"></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_pictureloc">Picture Location</label></th>' . "\n" .
  '		   <td><label for="upload_image">
 		     <input id="upload_image" type="text" size="36" name="bbnuke_player_edit_pictureloc" value="' . $piclocation . '" />
		     <input id="upload_image_button" type="button" value="Upload Image" />
		     <br />Enter an URL or upload an image for player profile.
		   </label></td>' . "\n" .
  '              </tr>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit">' . "\n" ;

  if ( $edit_player === true )
  echo
  '                <div class="div-wait" id="divwaitped1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Update Player" id="bbnuke_update_player_' . $player_id . '_btn_id" name="bbnuke_update_player_' . $player_id . '_btn"      onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" ;

  else
  echo
  '                <div class="div-wait" id="divwaitped1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Save Players Data" id="bbnuke_save_player_btn_id" name="bbnuke_save_player_btn"      onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" ;

  echo
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-upload-players">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Upload Players', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Choose a file to upload in the form: ', 'bbnuke') . "\n" .
  '                ' . __('teamName, firstname, middlename, lastname, positions, bats, throws, height, weight, address, city, state, zip, homePhone, workPhone, cellphone, jerseyNum, picLocation, season, profile, email, school, bdate.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>' . "\n" .
  '                  <td>' . "\n" .
  '                    <form enctype="multipart/form-data" method="POST" action="">' . "\n" .
  '                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />' . "\n" .
  '                      <input name="bbnuke_uploadedfile" type="file" /><br />' . "\n" .
  '                      <input type="submit" name="bbnuke_players_file_upload_btn" value="Upload" />' . "\n" .
  '                    </form>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-players-list">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Current Players', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select which player you want edit - first select team and season.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_players_list_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_players_list_form');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_select_season_id" name="bbnuke_select_season">' . "\n";

  $season  = bbnuke_get_option('bbnuke_players_season');
  $team    = bbnuke_get_option('bbnuke_players_team');
  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season_team">Select team to which you want add players: </label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_select_season_team_id" name="bbnuke_select_season_team">' . "\n";

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $team )
      echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select><br /><br />' . "\n" .
  '                    <div class="div-wait" id="divwaitsts0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Set season and team" id="bbnuke_set_season_team_id" name="bbnuke_set_season_team_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n";

  if ( !empty($season) AND !empty($team) )
    $players = bbnuke_get_players_season_team($season, $team);

  echo
  '              <tr><th class="bbnuke_option_left_part"><label for="">Total Players:</label></th>' . "\n" .
  '                  <td>' . count($players) . '&nbsp;&nbsp;' . "\n" .
  '                    <div class="div-wait" id="divwaitsts1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Delete all players" id="bbnuke_del_players_season_team_id" name="bbnuke_del_players_season_team_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_players">Current Players:</label></th>' . "\n" .
  '                  <td><ul class="players-list">' . "\n";

  for ( $i=0; $i < count($players); $i++ )
  {
    $player_id   = $players[$i]['playerID'];
    $lastname   = $players[$i]['lastname'];
    $firstname  = $players[$i]['firstname'];
    $middlename = $players[$i]['middlename'];
    echo
    '                       <li class="players-list-entry">' . "\n" .
    '                         <label for="bbnuke_player_' . $i . '" class="player-list-entry-label">' . $lastname . ', ' . $firstname . ' ' . $middlename . '</label> ' . "\n" .
    '                         -- ' . $team . '&nbsp;' . "\n" .
    '                         <div class="div-wait" id="divwaitcpl' . $i . '"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                         <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_player_' . $player_id . '_btn_id" name="bbnuke_edit_player_' . $player_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />' . "\n" .
    '			      <div class="div-wait" id="divwaitped0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '			      <input type="submit" class="button-primary" value="Delete" id="bbnuke_delete_player_' . $player_id . '_btn_id" name="bbnuke_delete_player_' . $player_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />' . "\n" .
    '                       </li>' . "\n";
  }

  echo
  '                      </ul></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-players-season-teams">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Players - Team/Season Management', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select the season and assign players to the teams.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke-players-season-team-form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke-players-season-team-form');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_players_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_players_select_season_id" name="bbnuke_players_select_season">' . "\n";

  $season  = bbnuke_get_option('bbnuke_players_season');
  $team    = bbnuke_get_option('bbnuke_players_team');
  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_players_select_season_team">Select team to which you want add players: </label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_players_select_season_team_id" name="bbnuke_players_select_season_team">' . "\n";

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $team )
      echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select><br /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n";

  if ( !empty($season) AND !empty($team) )
    $players = bbnuke_get_all_players();

  echo
  '              <tr><th class="bbnuke_option_left_part"><label for="">Total Players:</label></th>' . "\n" .
  '                  <td>' . count($players) . '</td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_players_list_players">Assign Players:</label></th>' . "\n" .
  '                  <td><select name="bbnuke_players_assign_select[]" id="bbnuke_players_assign_select_id" size="10" multiple="multiple">' . "\n";

  for ( $i=0; $i < count($players); $i++ )
  {
    $player_id   = $players[$i]['playerID'];
    $lastname   = $players[$i]['lastname'];
    $firstname  = $players[$i]['firstname'];
    $middlename = $players[$i]['middlename'];
    echo '<option value="' . $i . '">' . $lastname . ', ' . $firstname . ' ' . $middlename . '</option>' . "\n";
  }

  echo
  '                      </select></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="div-wait" id="divwaitapl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-primary" value="Assign players to team" id="bbnuke_assign_players_team_btn_id" name="bbnuke_assign_players_team_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-news">' . "\n" .
  '      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_info">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <!-- Facebook Badge START -->' . "\n" .
  '            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>' . "\n" .
  '            <!-- Facebook Badge END -->' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_links">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Donations</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <p>Help support the Flying Dogs by making a donation!</p>' . "\n" .
  '            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">' . "\n" .
  '              <input type="hidden" name="cmd" value="_xclick">' . "\n" .
  '              <input type="hidden" name="business" value="manager@frederickcardinals.com">' . "\n" .
  '              <input type="hidden" name="item_name" value="Flying Dogs Donation">' . "\n" .
  '              <input type="hidden" name="item_number" value="2007donation">' . "\n" .
  '              <input type="hidden" name="no_shipping" value="0">' . "\n" .
  '              <input type="hidden" name="no_note" value="1">' . "\n" .
  '              <input type="hidden" name="currency_code" value="USD">' . "\n" .
  '              <input type="hidden" name="tax" value="0">' . "\n" .
  '              <input type="hidden" name="lc" value="US">' . "\n" .
  '              <input type="hidden" name="bn" value="PP-DonationsBF">' . "\n" .
  '              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">' . "\n" .
  '            </form>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '  </div>' . "\n" .
  '</div>' . "\n";

}



////////////////////////////////////////////////////////////////////////////////
// show schedules page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_schedules_page( $edit_game = false )
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

  $fields_list  = bbnuke_get_locations();
  $seasons_list = bbnuke_get_seasons();
  $team_list    = bbnuke_get_teams();

  $season       = bbnuke_get_option('bbnuke_schedules_season');
  $games        = bbnuke_get_schedules($season);

  if ( $edit_game === true )
  {
    $game_id    = bbnuke_get_option('bbnuke_game_edit_id');
    //   get schedule data
    $game = bbnuke_get_game($game_id);
    $vteam       = $game['visitingTeam'];
    $hteam       = $game['homeTeam'];
    $gdate       = $game['gameDate'];
    $gtime       = $game['gameTime'];
    $field       = $game['field'];
    $hscore      = $game['homeScore'];
    $vscore      = $game['visitScore'];
  }


  echo
  '<div class="wrap">' . "\n" .
  '  <a name="Top"></a>' . "\n" .
  '  <div class="bbnuke-icon32"></div>' . "\n" .
  '  <h2>baseballNuke Plugin  -  Schedules Settings</h2>' . "\n" .
  '  <hr />' . "\n" .
  '  <div class="clear"></div>' . "\n" .
  '  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-main">' . "\n" .
  '      <div class="has-sidebar-content">' . "\n" .
  '        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-schedules-edit">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Schedule Edit', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <b>Add, Edit or delete a Schedule</b>' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select a season  - edit the schedules or add a new entry.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_schedules_edit_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_schedules_edit');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_schedules_edit_select_season_id" name="bbnuke_schedules_edit_select_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_gdate">Date</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_schedules_edit_gdate" value="' . $gdate . '" />&nbsp;(In the form: "YYYY-MM-DD")</td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_gtime">Time</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_schedules_edit_gtime" value="' . $gtime . '" />&nbsp;(In the form: "HH:MM:SS")</td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_hteam_select">Home</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_schedules_edit_hteam_select_id" name="bbnuke_schedules_edit_hteam_select">' . "\n";

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $hteam )
      echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_vteam_select">Visitors</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_schedules_edit_vteam_select_id" name="bbnuke_schedules_edit_vteam_select">' . "\n";

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $vteam )
      echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_field_select">Field</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_schedules_edit_field_select_id" name="bbnuke_schedules_edit_field_select">' . "\n";

  reset($fields_list);
  for ( $i=0; $i < count($fields_list); $i++ )
  {
    if ( $fields_list[$i]['fieldname'] == $field )
      echo '<option selected="selected" value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>' . "\n";
    else
      echo '<option value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>' . "\n";
  }

  echo
  '                    </select><br /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td>' . "\n";

  if ( $edit_game === true )
    echo '                    <input type="hidden" value="' . $game_id . '" name="bbnuke_game_delete_id" />' . "\n";
  else
    echo '                    <input type="hidden" value="none" name="bbnuke_game_delete_id" />' . "\n";

  echo
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="div-wait" id="divwaiteds0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_game_btn_id" name="bbnuke_save_game_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;' . "\n";

  if ( $edit_game === true )
  {
    echo
    '                <div class="div-wait" id="divwaiteds1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                <input type="submit" class="button-primary" value="Delete Game" id="bbnuke_delete_game_' . $game_id . '_btn_id" name="bbnuke_delete_game_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n";
  }

  echo
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-upload-schedules">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Upload Schedules for season ' . $season, 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Choose a file to upload in the form: ', 'bbnuke') . "\n" .
  '                ' . __('visitingTeam,homeTeam,gameDate,gameTime,field.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>' . "\n" .
  '                  <td>' . "\n" .
  '                    <form enctype="multipart/form-data" method="POST" action="">' . "\n" .
  '                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />' . "\n" .
  '                      <input name="bbnuke_schedules_uploadedfile" type="file" /><br />' . "\n" .
  '                      <input type="submit" name="bbnuke_schedules_file_upload_btn" value="Upload" />' . "\n" .
  '                    </form>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-schedules-list">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Schedules List', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select a game for edit.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_schedules_list_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_schedules_list');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_list_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_schedules_list_select_season_id" name="bbnuke_schedules_list_select_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select><br /><br />' . "\n" .
  '                    <div class="div-wait" id="divwaitschl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_schedules_set_season_btn_id" name="bbnuke_schedules_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">Total Schedules:</label></th>' . "\n" .
  '                  <td>' . count($games) . '&nbsp;&nbsp;' . "\n" .
  '                    <div class="div-wait" id="divwaitsch0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Delete all schedules" id="bbnuke_del_all_schedules_btn_id" name="bbnuke_del_all_schedules_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_games">Existing Games:</label></th>' . "\n" .
  '                  <td><ul class="games-list">' . "\n";

  for ( $i=0; $i < count($games); $i++ )
  {
    $game_id     = $games[$i]['gameID'];
    $vteam       = $games[$i]['visitingTeam'];
    $hteam       = $games[$i]['homeTeam'];
    $gdate       = $games[$i]['gameDate'];
    $gtime       = $games[$i]['gameTime'];
    $field       = $games[$i]['field'];
    $hscore      = $games[$i]['homeScore'];
    $vscore      = $games[$i]['visitScore'];
    echo
    '                       <li class="games-list-entry">' . "\n" .
    '                         <label for="bbnuke_game_' . $i . '" class="games-list-entry-label"><b>' . $hteam . '</b> VS <b>' . $vteam . '</b> on <b>' . $gdate . '</b> at ' . $gtime . ' @ ' . $field . '&nbsp;&nbsp;</label>' . "\n" .
    '                         <div class="div-wait" id="divwaitsch1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                         <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_game_' . $game_id . '_btn_id" name="bbnuke_edit_game_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;' . "\n" .
    '                       </li>' . "\n";
  }

  echo
  '                      </ul></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-news">' . "\n" .
  '      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_info">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <!-- Facebook Badge START -->' . "\n" .
  '            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>' . "\n" .
  '            <!-- Facebook Badge END -->' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_links">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Donations</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <p>Help support the Flying Dogs by making a donation!</p>' . "\n" .
  '            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">' . "\n" .
  '              <input type="hidden" name="cmd" value="_xclick">' . "\n" .
  '              <input type="hidden" name="business" value="manager@frederickcardinals.com">' . "\n" .
  '              <input type="hidden" name="item_name" value="Flying Dogs Donation">' . "\n" .
  '              <input type="hidden" name="item_number" value="2007donation">' . "\n" .
  '              <input type="hidden" name="no_shipping" value="0">' . "\n" .
  '              <input type="hidden" name="no_note" value="1">' . "\n" .
  '              <input type="hidden" name="currency_code" value="USD">' . "\n" .
  '              <input type="hidden" name="tax" value="0">' . "\n" .
  '              <input type="hidden" name="lc" value="US">' . "\n" .
  '              <input type="hidden" name="bn" value="PP-DonationsBF">' . "\n" .
  '              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">' . "\n" .
  '            </form>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '  </div>' . "\n" .
  '</div>' . "\n";

  return;
}




////////////////////////////////////////////////////////////////////////////////
// show tournament page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_tournaments_page( $edit_tournament = false )
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

  $fields_list      = bbnuke_get_locations();
  $seasons_list     = bbnuke_get_seasons();
  $def              = bbnuke_get_defaults();
  $hometeam         = $def['defaultTeam'];
  $season           = bbnuke_get_option('bbnuke_tournaments_season');
  $tournaments_list = bbnuke_get_tournaments($hometeam, $season);

  if ( $edit_tournament === true )
  {
    $game_id    = bbnuke_get_option('bbnuke_game_edit_id');
    //   get schedule data
    $game = bbnuke_get_game($game_id);
    $vteam       = $game['visitingTeam'];
    $hteam       = $game['homeTeam'];
    $gdate       = $game['gameDate'];
    $gtime       = $game['gameTime'];
    $field       = $game['field'];
    $hscore      = $game['homeScore'];
    $vscore      = $game['visitScore'];
  }


  echo
  '<div class="wrap">' . "\n" .
  '  <a name="Top"></a>' . "\n" .
  '  <div class="bbnuke-icon32"></div>' . "\n" .
  '  <h2>baseballNuke Plugin  -  Tournaments Settings</h2>' . "\n" .
  '  <hr />' . "\n" .
  '  <div class="clear"></div>' . "\n" .
  '  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-main">' . "\n" .
  '      <div class="has-sidebar-content">' . "\n" .
  '        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-tournaments-edit">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Tournament Edit', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <b>Add, Edit or delete a Tournament</b>' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select a season  - edit the tournament or add a new entry.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_tournaments_edit_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_tournaments_edit');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_tournaments_edit_select_season_id" name="bbnuke_tournaments_edit_select_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_gdate">Date</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_tournaments_edit_gdate" value="' . $gdate . '" />&nbsp;(In the form: "YYYY-MM-DD")</td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_gtime">Time</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_tournaments_edit_gtime" value="' . $gtime . '" />&nbsp;(In the form: "HH:MM:SS")</td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_field_select">Field</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_tournaments_edit_field_select_id" name="bbnuke_tournaments_edit_field_select">' . "\n";

  reset($fields_list);
  for ( $i=0; $i < count($fields_list); $i++ )
  {
    if ( $fields_list[$i]['fieldname'] == $field )
      echo '<option selected="selected" value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>' . "\n";
    else
      echo '<option value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_type_select">Type</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_tournaments_edit_type_select_id" name="bbnuke_tournaments_edit_type_select">' . "\n" .
  '                        <option value="NABF">NABF</option>' . "\n" .
  '                        <option value="MSBL">MSBL</option>' . "\n" .
  '                        <option value="NABA">NABA</option>' . "\n" .
  '                        <option value="League">League</option>' . "\n" .
  '                        <option value="USSSA">USSSA</option>' . "\n" .
  '                        <option value="AABO">AABO</option>' . "\n" .
  '                        <option value="SuperSeries">SuperSeries</option>' . "\n" .
  '                        <option value="Independent">Independent</option>' . "\n" .
  '                        <option value="Other">Other</option>' . "\n" .
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_notes">Notes</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_tournaments_edit_notes" value="' . $notes . '" /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td>' . "\n";

  if ( $edit_tournament === true )
    echo '                    <input type="hidden" value="' . $game_id . '" name="bbnuke_game_delete_id" />' . "\n";
  else
    echo '                    <input type="hidden" value="none" name="bbnuke_game_delete_id" />' . "\n";

  echo
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="div-wait" id="divwaitedt0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_tournament_btn_id" name="bbnuke_save_tournament_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;' . "\n";

  if ( $edit_tournament === true )
  {
    echo
    '                <div class="div-wait" id="divwaitedt1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                <input type="submit" class="button-primary" value="Delete Tournament" id="bbnuke_delete_tournament_' . $game_id . '_btn_id" name="bbnuke_delete_tournament_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n";
  }

  echo
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-upload-tournaments">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Upload Tournaments for season ' . $season, 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Choose a file to upload in the form: ', 'bbnuke') . "\n" .
  '                ' . __('gameDate,gameTime,field,note.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>' . "\n" .
  '                  <td>' . "\n" .
  '                    <form enctype="multipart/form-data" method="POST" action="">' . "\n" .
  '                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />' . "\n" .
  '                      <input name="bbnuke_tournaments_uploadedfile" type="file" /><br />' . "\n" .
  '                      <input type="submit" name="bbnuke_tournaments_file_upload_btn" value="Upload" />' . "\n" .
  '                    </form>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-tournaments-list">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Tournaments List', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select a tournament for edit.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_tournaments_list_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_tournaments_list');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_tournaments_edit_select_season_id" name="bbnuke_tournaments_edit_select_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select><br /><br />' . "\n" .
  '                    <div class="div-wait" id="divwaittl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_tournaments_list_set_season_btn_id" name="bbnuke_tournaments_list_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">Total Tournaments:</label></th>' . "\n" .
  '                  <td>' . count($tournaments_list) . '&nbsp;&nbsp;' . "\n" .
  '                    <div class="div-wait" id="divwaittl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Delete all tournaments" id="bbnuke_del_all_tournaments_btn_id" name="bbnuke_del_all_tournaments_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_tournaments">Existing Tournaments:</label></th>' . "\n" .
  '                  <td><ul class="tournaments-list">' . "\n";

  for ( $i=0; $i < count($tournaments_list); $i++ )
  {
    $game_id     = $tournaments_list[$i]['gameID'];
    $vteam       = $tournaments_list[$i]['visitingTeam'];
    $hteam       = $tournaments_list[$i]['homeTeam'];
    $gdate       = $tournaments_list[$i]['gameDate'];
    $gtime       = $tournaments_list[$i]['gameTime'];
    $field       = $tournaments_list[$i]['field'];
    $hscore      = $tournaments_list[$i]['homeScore'];
    $vscore      = $tournaments_list[$i]['visitScore'];
    echo
    '                       <li class="tournaments-list-entry">' . "\n" .
    '                         <label for="bbnuke_tournament_' . $i . '" class="tournaments-list-entry-label">' . $hteam . ' ' . $vteam . ' on ' . $gdate . ' at ' . $gtime . ' @ ' . $field . '&nbsp;$Notes&nbsp;</label>' . "\n" .
    '                         <div class="div-wait" id="divwaittl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                         <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_tournament_' . $game_id . '_btn_id" name="bbnuke_edit_tournament_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;' . "\n" .
    '                       </li>' . "\n";
  }

  echo
  '                      </ul></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-news">' . "\n" .
  '      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_info">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <!-- Facebook Badge START -->' . "\n" .
  '            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>' . "\n" .
  '            <!-- Facebook Badge END -->' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_links">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Donations</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <p>Help support the Flying Dogs by making a donation!</p>' . "\n" .
  '            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">' . "\n" .
  '              <input type="hidden" name="cmd" value="_xclick">' . "\n" .
  '              <input type="hidden" name="business" value="manager@frederickcardinals.com">' . "\n" .
  '              <input type="hidden" name="item_name" value="Flying Dogs Donation">' . "\n" .
  '              <input type="hidden" name="item_number" value="2007donation">' . "\n" .
  '              <input type="hidden" name="no_shipping" value="0">' . "\n" .
  '              <input type="hidden" name="no_note" value="1">' . "\n" .
  '              <input type="hidden" name="currency_code" value="USD">' . "\n" .
  '              <input type="hidden" name="tax" value="0">' . "\n" .
  '              <input type="hidden" name="lc" value="US">' . "\n" .
  '              <input type="hidden" name="bn" value="PP-DonationsBF">' . "\n" .
  '              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">' . "\n" .
  '            </form>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '  </div>' . "\n" .
  '</div>' . "\n";

  return;
}




////////////////////////////////////////////////////////////////////////////////
// show practice page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_practice_page( $edit_practice = false )
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

  $fields_list      = bbnuke_get_locations();
  $seasons_list     = bbnuke_get_seasons();
  $def              = bbnuke_get_defaults();
  $season           = bbnuke_get_option('bbnuke_practice_season');
  $hometeam         = $def['defaultTeam'];
  $practice_list    = bbnuke_get_practices($hometeam, $season);

  if ( $edit_practice === true )
  {
    $game_id    = bbnuke_get_option('bbnuke_game_edit_id');
    //   get schedule data
    $game = bbnuke_get_game($game_id);
    $vteam       = $game['visitingTeam'];
    $hteam       = $game['homeTeam'];
    $gdate       = $game['gameDate'];
    $gtime       = $game['gameTime'];
    $field       = $game['field'];
    $notes       = $game['notes'];
    $hscore      = $game['homeScore'];
    $vscore      = $game['visitScore'];
  }


  echo
  '<div class="wrap">' . "\n" .
  '  <a name="Top"></a>' . "\n" .
  '  <div class="bbnuke-icon32"></div>' . "\n" .
  '  <h2>baseballNuke Plugin  -  Practice Settings</h2>' . "\n" .
  '  <hr />' . "\n" .
  '  <div class="clear"></div>' . "\n" .
  '  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-main">' . "\n" .
  '      <div class="has-sidebar-content">' . "\n" .
  '        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-practice-edit">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Practice Edit', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <b>Add, Edit or delete a Practice</b>' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select a season  - edit the practice or add a new entry.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_practice_edit_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_practice_edit');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_practice_edit_select_season_id" name="bbnuke_practice_edit_select_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_gdate">Date</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_practice_edit_gdate" value="' . $gdate . '" />&nbsp;(In the form: "YYYY-MM-DD")</td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_gtime">Time</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_practice_edit_gtime" value="' . $gtime . '" />&nbsp;(In the form: "HH:MM:SS")</td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_field_select">Field</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_practice_edit_field_select_id" name="bbnuke_practice_edit_field_select">' . "\n";

  reset($fields_list);
  for ( $i=0; $i < count($fields_list); $i++ )
  {
    if ( $fields_list[$i]['fieldname'] == $field )
      echo '<option selected="selected" value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>' . "\n";
    else
      echo '<option value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_notes">Notes</label></th>' . "\n" .
  '                  <td><input type="text" name="bbnuke_practice_edit_notes" value="' . $notes . '" /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td>' . "\n";

  if ( $edit_practise === true )
    echo '                    <input type="hidden" value="' . $game_id . '" name="bbnuke_game_delete_id" />' . "\n";
  else
    echo '                    <input type="hidden" value="none" name="bbnuke_game_delete_id" />' . "\n";

  echo
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="div-wait" id="divwaitedp0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_practice_btn_id" name="bbnuke_save_practice_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;' . "\n";

  if ( $edit_practise === true )
  {
    echo
    '                <div class="div-wait" id="divwaitedp1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                <input type="submit" class="button-primary" value="Delete Practice" id="bbnuke_delete_practice_' . $game_id . '_btn_id" name="bbnuke_delete_practice_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n";
  }

  echo
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-upload-practice">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Upload Practice for season ' . $season, 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Choose a file to upload in the form: ', 'bbnuke') . "\n" .
  '                ' . __('gameDate,gameTime,field,note.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>' . "\n" .
  '                  <td>' . "\n" .
  '                    <form enctype="multipart/form-data" method="POST" action="">' . "\n" .
  '                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />' . "\n" .
  '                      <input name="bbnuke_practice_uploadedfile" type="file" /><br />' . "\n" .
  '                      <input type="submit" name="bbnuke_practice_file_upload_btn" value="Upload" />' . "\n" .
  '                    </form>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-practice-list">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Practice List', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select a practice for edit.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_practice_list_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_practice_list');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_practice_edit_select_season_id" name="bbnuke_practice_edit_select_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select><br /><br />' . "\n" .
  '                    <div class="div-wait" id="divwaitpl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_practices_list_set_season_btn_id" name="bbnuke_practices_list_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">Total Practices:</label></th>' . "\n" .
  '                  <td>' . count($practise_list) . '&nbsp;&nbsp;' . "\n" .
  '                    <div class="div-wait" id="divwaitpl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Delete all practices" id="bbnuke_del_all_practice_btn_id" name="bbnuke_del_all_practice_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_practice">Existing Practices:</label></th>' . "\n" .
  '                  <td><ul class="practice-list">' . "\n";

  for ( $i=0; $i < count($practice_list); $i++ )
  {
    $game_id     = $practice_list[$i]['gameID'];
    $vteam       = $practice_list[$i]['visitingTeam'];
    $hteam       = $practice_list[$i]['homeTeam'];
    $gdate       = $practice_list[$i]['gameDate'];
    $gtime       = $practice_list[$i]['gameTime'];
    $field       = $practice_list[$i]['field'];
    $notes       = $practice_list[$i]['notes'];
    $hscore      = $practice_list[$i]['homeScore'];
    $vscore      = $practice_list[$i]['visitScore'];
    echo
    '                       <li class="practice-list-entry">' . "\n" .
    '                         <label for="bbnuke_practice_' . $i . '" class="practice-list-entry-label">' . $hteam . ' ' . $vteam . ' on ' . $gdate . ' at ' . $gtime . ' @ ' . $field . '&nbsp;' . $notes . '&nbsp;</label>' . "\n" .
    '                         <div class="div-wait" id="divwaitpl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                         <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_practice_' . $game_id . '_btn_id" name="bbnuke_edit_practice_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;' . "\n" .
    '                       </li>' . "\n";
  }

  echo
  '                      </ul></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-news">' . "\n" .
  '      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_info">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <!-- Facebook Badge START -->' . "\n" .
  '            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>' . "\n" .
  '            <!-- Facebook Badge END -->' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_links">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Donations</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <p>Help support the Flying Dogs by making a donation!</p>' . "\n" .
  '            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">' . "\n" .
  '              <input type="hidden" name="cmd" value="_xclick">' . "\n" .
  '              <input type="hidden" name="business" value="manager@frederickcardinals.com">' . "\n" .
  '              <input type="hidden" name="item_name" value="Flying Dogs Donation">' . "\n" .
  '              <input type="hidden" name="item_number" value="2007donation">' . "\n" .
  '              <input type="hidden" name="no_shipping" value="0">' . "\n" .
  '              <input type="hidden" name="no_note" value="1">' . "\n" .
  '              <input type="hidden" name="currency_code" value="USD">' . "\n" .
  '              <input type="hidden" name="tax" value="0">' . "\n" .
  '              <input type="hidden" name="lc" value="US">' . "\n" .
  '              <input type="hidden" name="bn" value="PP-DonationsBF">' . "\n" .
  '              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">' . "\n" .
  '            </form>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '  </div>' . "\n" .
  '</div>' . "\n";

  return;
}



////////////////////////////////////////////////////////////////////////////////
// show game result page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_game_results_page( $edit_results = false )
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

  $ret_flag = NULL;

  $fields_list      = bbnuke_get_locations();
  $seasons_list     = bbnuke_get_seasons();
  $def              = bbnuke_get_defaults();
  $hometeam         = $def['defaultTeam'];
  $season           = bbnuke_get_option('bbnuke_results_season');
  $games_list       = bbnuke_get_past_games($season);

  if ( $edit_results === true )
  {
    $game_id     = bbnuke_get_option('bbnuke_game_edit_id');
    $gresults    = bbnuke_get_game_results($game_id);

    if ( !$gresults )
    {
      $players = bbnuke_get_players_from_team( $hometeam, $season);
      if (!$players)
        $ret_flag = -1;
    }

    $presults    = bbnuke_get_game_player_results($game_id, $season);
    if (!$presults)
    {
      $players = bbnuke_get_players_from_team( $hometeam, $season);
      if (!$players)
        $ret_flag = -1;
    }
    //   get schedule data
    $game        = bbnuke_get_game($game_id);
    $vteam       = $game['visitingTeam'];
    $hteam       = $game['homeTeam'];
    $gdate       = $game['gameDate'];
    $gtime       = $game['gameTime'];
    $field       = $game['field'];
    $notes       = $game['notes'];
    $hscore      = $game['homeScore'];
    $vscore      = $game['visitScore'];
  }


  echo
  '<div class="wrap">' . "\n" .
  '  <a name="Top"></a>' . "\n" .
  '  <div class="bbnuke-icon32"></div>' . "\n" .
  '  <h2>baseballNuke Plugin  -  Game Results Page</h2>' . "\n" .
  '  <hr />' . "\n" .
  '  <div class="clear"></div>' . "\n" .
  '  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-main">' . "\n" .
  '      <div class="has-sidebar-content">' . "\n" .
  '        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-results-edit">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Game Results Edit', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n";

  if ( $edit_results === true )
    echo  '              <b>Edit Results for game:</b>&nbsp;&nbsp; ' . $vteam . ' v. ' . $hteam . '</b>' . "\n";
  else
  {
    echo  '              <b>Edit Results</b>' . "\n" .
    '              <p>' . "\n" .
    '                ' . __('Select a season  - edit the game results and save them.', 'bbnuke') . "\n" .
    '              </p>' . "\n";
  }

  echo
  '              <form name="bbnuke_results_edit_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_results_edit');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">Box Score</label></th>' . "\n" .
  '                  <td>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n";

  if ( $edit_results === true )
  {
    list($gameID,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$vhits,$vruns,$verr,$hhits,$hruns,$herr,$notes) = $gresults[0];
	if ( $vruns == 0){
	  $vruns = ($v1+$v2+$v3+$v4+$v5+$v6+$v7+$v8+$v9);
	  }
	if ( $hruns == 0){
	$hruns = ($h1+$h2+$h3+$h4+$h5+$h6+$h7+$h8+$h9);
	  }
    echo
    '           <table width="75%" border="1" class="gresults-form-table">
            <tr>
            <td width="13%"></td>';
    for ($i=1; $i <= 9; $i++)
      echo
      '		              <td width="5%" align="center">' . $i . '</td>' . "\n";

    echo
    '		              <td width="5%" align="center">R</td>
		              <td width="5%" align="center">H</td>
		              <td width="5%" align="center">E</td>
		          </tr>
		          <tr>
		            <td width="13%">' . $vteam . '</td>' . "\n";

    echo
    "	            <td width=5%>
	                <input type=text name=v1 size=2 value=".$v1.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v2 size=2 value=".$v2.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v3 size=2 value=".$v3.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v4 size=2 value=".$v4.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v5 size=2 value=".$v5.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v6 size=2 value=".$v6.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v7 size=2 value=".$v7.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v8 size=2 value=".$v8.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=v9 size=2 value=".$v9.">
		              </font></td>
                            <td width=5%>
                                <input type=text name=vruns size=2 value=".$vruns.">
                              </font></td>
		            <td width=5%>
		                <input type=text name=vhits size=2 value=".$vhits.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=verr size=2 value=".$verr.">
		              </font></td>
		          </tr>
		          <tr>
		            <td width=13%>$hteam</font></td>
		            <td width=5%>
		                <input type=text name=h1 size=2 value=".$h1.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h2 size=2 value=".$h2.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h3 size=2 value=".$h3.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h4 size=2 value=".$h4.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h5 size=2 value=".$h5.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h6 size=2 value=".$h6.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h7 size=2 value=".$h7.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h8 size=2 value=".$h8.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=h9 size=2 value=".$h9.">
		              </font></td>
                            <td width=5%>
                                <input type=text name=hruns size=2 value=".$hruns.">
                              </font></td>
		            <td width=5%>
		                <input type=text name=hhits size=2 value=".$hhits.">
		              </font></td>
		            <td width=5%>
		                <input type=text name=herr size=2 value=".$herr.">
		              </font></td>
		          </tr>
			<tr>
			<td>&nbsp;</td>
			<td colspan=12>
			<textarea class=bbnuke_textarea name=notes cols=75 rows=10>".$notes."</textarea>
		        </td>
		      </table>
	     <div>&nbsp;</div>
             <div class='game-results-table'>
                 <div class='tabs'>
                   <a class='tab' onclick=\"showTab('#Offense')\">Offense</a>
                   <a class='tab' onclick=\"showTab('#Pitching')\">Pitching</a>
                   <a class='tab' onclick=\"showTab('#Fielding')\">Fielding</a>
		   <hr>
		 </div>
             <div>&nbsp;</div>
		 
             <div id='Offense' class='tabContent' style='display:block'>         
		      <table class=gresults-form-table>
		        <tr>
		            <th width=150px>&nbsp;</th>
		            <th align=center>Inactive</th>
		            <th align=center>Ord</th>
		            <th align=center>AB</th>
		            <th align=center>R</th>
		            <th align=center>1B</th>
		            <th align=center>2B</th>
		            <th align=center>3B</th>
		            <th align=center>HR</th>
		            <th align=center>RE</th>
		            <th align=center>FC</th>
		            <th align=center>HP</th>
		            <th align=center>RBI</th>
		            <th align=center>BB</th>
		            <th align=center>K</th>
		            <th align=center>LOB</th>
		            <th align=center>SB</th>
			</tr>";
    //Lookup players
    if ( $presults )
      $count_p = count($presults);
    else
      $count_p = count($players);

    for ($m=0; $m < $count_p; $m++)
    {
      if ( $presults )
        list($PLAYERID,$firstname,$middlename,$lastname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE) = $presults[$m];
      else
        list($PLAYERID,$firstname,$middlename,$lastname) = $players[$m];

echo '                    <tr>
                            <td>' . $lastname . ', ' . $firstname . ' ' . $middlename . '</td>
                            <td align=center>
                              <input type="checkbox" name="' . $PLAYERID . '_chkbxDNP" value="DNP" >
                            </td>
                            <td align=center>
                              <input type="text" name="' . $PLAYERID . '_battOrd" size="1" value="'.$battOrd.'">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baAB" size="1" value="' . $baAB . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baRuns" size="1" value="' . $baRuns . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_ba1b" size="1" value="' . $ba1b . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_ba2b" size="1" value="' . $ba2b . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_ba3b" size="1" value="' . $ba3b . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baHR" size="1" value="' . $baHR . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baRE" size="1" value="' . $baRE . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baFC" size="1" value="' . $baFC . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baHP" size="1" value="' . $baHP . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baRBI" size="1" value="' . $baRBI . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baBB" size="1" value="' . $baBB . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baK" size="1" value="' . $baK . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baLOB" size="1" value="' . $baLOB . '">
                            </td>
                            <td>
                              <input type="text" name="' . $PLAYERID . '_baSB" size="1" value="' . $baSB . '">
                            </td>
			  </tr>'."\n";
}

   echo "</table> </div>
                  <div id='Pitching' class='tabContent' style='display:none'>
                       <table class=gresults-form-table>
                         <tr>
                             <th width=150px>&nbsp;</th>
                             <th align=center>Ord</th>
                             <th align=center>W</th>
                             <th align=center>L</th>
                             <th align=center>S</th>
                             <th align=center>IP</th>
                             <th align=center>H</th>
                             <th align=center>R</th>
                             <th align=center>ER</th>
                             <th align=center>BB</th>
                             <th align=center>K</th>
                        </tr>";
    //Lookup players
    if ( $presults )
      $count_p = count($presults);
    else
      $count_p = count($players);

    for ($m=0; $m < $count_p; $m++)
    {
      if ( $presults )
        list($PLAYERID,$firstname,$middlename,$lastname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE) = $presults[$m];
      else
        list($PLAYERID,$firstname,$middlename,$lastname) = $players[$m];

echo '                    <tr>
                             <td>' . $lastname . ', ' . $firstname . ' ' . $middlename . '</td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_pitchOrd" size="1" value="' . $pitchOrd . '">
                             </td>
                             <td>  <b>
                               <input type="checkbox" name="' . $PLAYERID . '_piWin" value="1" ';

       if($piWin){
                         echo ' checked="checked" ';
       }

       echo
       ' >
                               </b> </td>
                             <td>
                               <input type="checkbox" name="' . $PLAYERID . '_piLose" value="1" ';

       if($piLose){
                         echo ' checked="checked" ';
       }
       echo ' >
                               </td>
                             <td>
                               <input type="checkbox" name="' . $PLAYERID . '_piSave" value="1" ';
       if($piSave){
                         echo ' checked="checked" ';
       }
       echo ' >
                               </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_piIP" size="2" value="'.$piIP.'" >
                             </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_piHits" size="1" value="'.$piHits.'" >
                             </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_piRuns" size="1" value="' . $piRuns . '" >
                             </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_piER" size="1" value="' . $piER . '" >
                             </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_piWalks" size="1" value="' . $piWalks . '" >
                             </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_piSO" size="1" value="' . $piSO . '" >
                             </td>
                           </tr>
                          </tr>'."\n";
}

   echo "</table> </div>
                  <div id='Fielding' class='tabContent' style='display:none'>
                         <table class=gresults-form-table>
                           <tr>
                             <th width=150px>&nbsp;</th>
                             <th align=center>PO</th>
                             <th align=center>A</th>
                             <th align=center>E</th>
                        </tr>";
    //Lookup players
    if ( $presults )
      $count_p = count($presults);
    else
      $count_p = count($players);

    for ($m=0; $m < $count_p; $m++)
    {
      if ( $presults )
        list($PLAYERID,$firstname,$middlename,$lastname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE) = $presults[$m];
      else
        list($PLAYERID,$firstname,$middlename,$lastname) = $players[$m];

echo '                    <tr>
                             <td>' . $lastname . ', ' . $firstname . ' ' . $middlename . '</td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_fiPO" size="1" value="' . $fiPO . '">
                               </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_fiA" size="1" value="' . $fiA . '">
                               </td>
                             <td>
                               <input type="text" name="' . $PLAYERID . '_fiE" size="1" value="' . $fiE . '">
                               </td>
                          </tr>'."\n";
}
   echo '</table> </div>' . "\n" .
    '              <table class="form-table">' . "\n" .
    '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
    '                  <td>' . "\n" .
    '                <div class="div-wait" id="divwaitedgr0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
    '                <input type="submit" class="button-secondary" value="Update" id="bbnuke_save_results_btn_id" name="bbnuke_save_results_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;' . "\n" .
    '                  </td><br><br>' . "\n" .
    '              </tr>' . "\n" .
/*  '              <tr><th class="bbnuke_option_left_part"><label for="">Game Results CSV ' .$game_id. '</label></th>' . "\n" .
  '                  <td>' . "\n" .
  '                    <form enctype="multipart/form-data" method="POST" action="">' . "\n" .
  '                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />' . "\n" .
  '                      <input name="bbnuke_gameResults_bat_uploadedfile" type="file" /><br />' . "\n" .
  '                      <input type="submit" name="bbnuke_gameResults_bat_upload_btn" value="Upload" />' . "\n" .
  '                    </form>' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
 */ '              </table>
		</div>' . "\n";

  }

  echo
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '          <div class="postbox ui-droppable" id="bbnuke-games-list">' . "\n" .
  '            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '            <h3 class="hndle">' . __('Past Games List', 'bbnuke') . '</h3>' . "\n" .
  '            <div class="inside">' . "\n" .
  '              <p>' . "\n" .
  '                ' . __('Select a game for edit.', 'bbnuke') . "\n" .
  '              </p>' . "\n" .
  '              <form name="bbnuke_results_list_form" method="post" action="">' . "\n";

  wp_nonce_field('bbnuke_results_list');

  echo
  '              <table class="form-table">' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_results_list_select_season">Select season:</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_results_list_select_season_id" name="bbnuke_results_list_select_season">' . "\n";

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
      echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
    else
      echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>' . "\n";
  }

  echo
  '                    </select><br /><br />' . "\n" .
  '                    <div class="div-wait" id="divwaitrl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_results_list_set_season_btn_id" name="bbnuke_results_list_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td><hr /></td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="">Total Games:</label></th>' . "\n" .
  '                  <td>' . count($games_list) . '&nbsp;&nbsp;' . "\n" .
  '                    <div class="div-wait" id="divwaitpl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Delete all games" id="bbnuke_del_all_games_btn_id" name="bbnuke_del_all_games_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_results_edit_game_select">Select a game to update</label></th>' . "\n" .
  '                  <td><select size="1" id="bbnuke_results_edit_game_select_id" name="bbnuke_results_edit_game_select">' . "\n";

  reset($games_list);
  for ( $i=0; $i < count($games_list); $i++ )
  {
    $game_id = $games_list[$i]['gameID'];
    $hteam   = $games_list[$i]['homeTeam'];
    $vteam   = $games_list[$i]['visitingTeam'];
    $gdate   = $games_list[$i]['gameDate'];
    $gtime   = $games_list[$i]['gameTime'];
    echo '<option value="' . $game_id . '">' . $hteam . ' v. ' . $vteam . ' (' . $gdate . ' ' . $gtime . ')</option>' . "\n";
  }

  echo
  '                    </select>' . "\n" .
  '                    <div class="div-wait" id="divwaitgl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>' . "\n" .
  '                    <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_game_btn_id" name="bbnuke_edit_game_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />' . "\n" .
  '                  </td>' . "\n" .
  '              </tr>' . "\n" .
  '              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>' . "\n" .
  '                  <td></td>' . "\n" .
  '              </tr>' . "\n" .
  '              </table>' . "\n" .
  '              <div class="submit-bottom-div">' . "\n" .
  '                <div class="right-bottom"><a href="#Top">Back to Top</a></div>' . "\n" .
  '              </div>' . "\n" .
  '              </form>' . "\n" .
  '            </div>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '    <div class="postbox-container" id="bbnuke-plugin-news">' . "\n" .
  '      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_info">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <!-- Facebook Badge START -->' . "\n" .
  '            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>' . "\n" .
  '            <!-- Facebook Badge END -->' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '        <div class="postbox ui-droppable" id="bbnuke_links">' . "\n" .
  '          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>' . "\n" .
  '          <h3 class="hndle">Donations</h3>' . "\n" .
  '          <div class="inside">' . "\n" .
  '            <p>Help support the Flying Dogs by making a donation!</p>' . "\n" .
  '            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">' . "\n" .
  '              <input type="hidden" name="cmd" value="_xclick">' . "\n" .
  '              <input type="hidden" name="business" value="manager@frederickcardinals.com">' . "\n" .
  '              <input type="hidden" name="item_name" value="Flying Dogs Donation">' . "\n" .
  '              <input type="hidden" name="item_number" value="2007donation">' . "\n" .
  '              <input type="hidden" name="no_shipping" value="0">' . "\n" .
  '              <input type="hidden" name="no_note" value="1">' . "\n" .
  '              <input type="hidden" name="currency_code" value="USD">' . "\n" .
  '              <input type="hidden" name="tax" value="0">' . "\n" .
  '              <input type="hidden" name="lc" value="US">' . "\n" .
  '              <input type="hidden" name="bn" value="PP-DonationsBF">' . "\n" .
  '              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">' . "\n" .
  '            </form>' . "\n" .
  '          </div>' . "\n" .
  '        </div>' . "\n" .
  '      </div>' . "\n" .
  '    </div>' . "\n" .
  '  </div>' . "\n" .
  '</div>' . "\n";

  return $ret_flag;
}

	$latestVersion="1.0.9";


	function getbnukeVersion(){
		global $prefix,$dbi;
		$sqlString="SELECT version FROM ".$prefix."_baseballNuke_settings WHERE ID=1 LIMIT 1";
                $resultVersion=sql_query($sqlString,$dbi);
                list($version)=sql_fetch_row($resultVersion,$dbi);
		return $version;
	}

?>
