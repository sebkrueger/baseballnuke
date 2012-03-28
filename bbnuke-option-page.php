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
  $erainnings = $options['bbnuke_era_innings'];
  $roster_num = $options['bbnuke_roster_num'];
  $roster_name = $options['bbnuke_roster_name'];
  $roster_pos = $options['bbnuke_roster_pos'];
  $roster_bats = $options['bbnuke_roster_bats'];
  $roster_throws = $options['bbnuke_roster_throws'];
  $roster_home = $options['bbnuke_roster_home'];
  $roster_school = $options['bbnuke_roster_school'];
  $batting_num = $options['bbnuke_batting_num'];
  $batting_name = $options['bbnuke_batting_name'];
  $batting_ab = $options['bbnuke_batting_ab'];
  $batting_r = $options['bbnuke_batting_r'];
  $batting_h = $options['bbnuke_batting_h'];
  $batting_2b = $options['bbnuke_batting_2b'];
  $batting_3b = $options['bbnuke_batting_3b'];
  $batting_hr = $options['bbnuke_batting_hr'];
  $batting_re = $options['bbnuke_batting_re'];
  $batting_fc = $options['bbnuke_batting_fc'];
  $batting_sf = $options['bbnuke_batting_sf'];
  $batting_hp = $options['bbnuke_batting_hp'];
  $batting_rbi = $options['bbnuke_batting_rbi'];
  $batting_ba = $options['bbnuke_batting_ba'];
  $batting_obp = $options['bbnuke_batting_obp'];
  $batting_slg = $options['bbnuke_batting_slg'];
  $batting_ops = $options['bbnuke_batting_ops'];
  $batting_bb = $options['bbnuke_batting_bb'];
  $batting_k = $options['bbnuke_batting_k'];
  $batting_lob = $options['bbnuke_batting_lob'];
  $batting_sb = $options['bbnuke_batting_sb'];
  $pitching_num = $options['bbnuke_pitching_num'];
  $pitching_name = $options['bbnuke_pitching_name'];
  $pitching_w = $options['bbnuke_pitching_w'];
  $pitching_l = $options['bbnuke_pitching_l'];
  $pitching_s = $options['bbnuke_pitching_s'];
  $pitching_ip = $options['bbnuke_pitching_ip'];
  $pitching_h = $options['bbnuke_pitching_h'];
  $pitching_r = $options['bbnuke_pitching_r'];
  $pitching_er = $options['bbnuke_pitching_er'];
  $pitching_bb = $options['bbnuke_pitching_bb'];
  $pitching_k = $options['bbnuke_pitching_k'];
  $pitching_era = $options['bbnuke_pitching_era'];
  $pitching_whip = $options['bbnuke_pitching_whip'];


  //   get seasons
  $seasons_list    = bbnuke_get_seasons();
  $team_list       = bbnuke_get_teams($defs['defaultSeason']);
  $defs            = bbnuke_get_defaults();

  $players         = bbnuke_get_players($defs['defaultSeason']);
  $games           = bbnuke_get_past_games_with_results();

echo '
<div class="wrap">
    <a name="Top"></a>
    <div class="bbnuke-icon32"></div>
    <h2>baseballNuke - Plugin Settings</h2>
    <hr />
    <p>
      <b>Welcome to baseballNuke</b><br />
     '. __('baseballNuke is a wordpress plugin based on the module for the CMS phpnuke <a href="http://phpnuke.org" target="_blank">http://phpnuke.org</a> for the administration of a single baseball team. It is a complete team management tool and information source. baseballNuke provides team and individual information about the players including schedule, field directions, player stats, team stats, player profiles and game results.', 'bbnuke') . '<br />
    </p>
    <hr />
    <div class="clear"></div>
    <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
      <div class="postbox-container" id="bbnuke-plugin-main">
        <div class="has-sidebar-content">
          <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
            <div class="postbox ui-droppable" id="bbnuke-settings">
              <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
              <h3 class="hndle">' . __('Settings', 'bbnuke') . '</h3>
              <div class="inside">
                <b>Default settings</b><br />
                <form name="bbnuke_plugin_option_form" method="post" action="">';

  wp_nonce_field('bbnuke_plugin_options');

echo '
              <table class="form-table">
                 <tr><th class="bbnuke_option_left_part"><label for="bbnuke_season_select">Set default season and team</label></th>
                  <td>Default season:&nbsp;<select name="bbnuke_def_season_select" class="select-season-single" size="1">';

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $defs['defaultSeason'] )
    echo '<option value="' . $i . '" selected="yes">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $i . '">' . $seasons_list[$i] . '</option>';
  }

echo '
                 </select><br /><br />
                   Default team:&nbsp;<select name="bbnuke_def_team_select" class="select-team-single" size="1">';

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $defs['defaultTeam'] )
    echo '<option value="' . $i . '" selected="yes">' . $team_list[$i] . '</option>';
    else
    echo '<option value="' . $i . '">' . $team_list[$i] . '</option>';
  }

echo '
                 </select><br /><br />
                   <div class="div-wait" id="divwaitdts0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                   <input type="submit" class="button-primary" value="Set Defaults" id="bbnuke_set_defs_btn_id" name="bbnuke_set_defs_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
                   </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                    <td><hr /></td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label>Game Results Widget Page</label></th>
                    <td>' .wp_dropdown_pages(array('name'=>'bbnuke_plugin_option_game_results_page','selected'=>"$game_results_page",'echo'=>'0')).'
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label>Player Stats Widget Page</label></th>
                    <td>' .wp_dropdown_pages(array('name'=>'bbnuke_plugin_option_player_stats_page','selected'=>"$player_stats_page",'echo'=>'0')).' 
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label>Locations Widget Page</label></th>
                    <td>' .wp_dropdown_pages(array('name'=>'bbnuke_plugin_option_locations_page','selected'=>"$locations_page",'echo'=>'0')).'
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_team_leaders">Team Leaders</label></th>
                    <td><input type="text" name="bbnuke_plugin_option_team_leaders" value="' . $team_leaders . '" />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_era_innings">Game Length for ERA</label></th>
                    <td><input type="text" name="bbnuke_plugin_option_era_innings" value="' . $erainnings . '" />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_header_bg_color">Table Header Background Color</label></th>
                    <td><input type="text" name="bbnuke_plugin_option_header_bg_color" id="bbnuke_plugin_option_header_bg_color" value="' . $header_bg_color . '" />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_header_txt_color">Table Header Text Color</label></th>
                    <td><input type="text" name="bbnuke_plugin_option_header_txt_color" id="bbnuke_plugin_option_header_txt_color" value="' . $header_txt_color . '" />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_bg_color">Table Body Background Color</label></th>
                    <td><input type="text" name="bbnuke_plugin_option_bg_color" id="bbnuke_plugin_option_bg_color" value="' . $bg_color . '" />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_hover_color">Table Body Hover Color</label></th>
                    <td><input type="text" name="bbnuke_plugin_option_hover_color" id="bbnuke_plugin_option_hover_color" value="' . $hover_color . '" />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_txt_color">Table Body Text Color</label></th>
                    <td><input type="text" name="bbnuke_plugin_option_txt_color" id="bbnuke_plugin_option_txt_color" value="' . $txt_color . '" />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_wdg_playerstats_playerid">Widget PlayerStats Player ID</label></th>
                    <td><select name="bbnuke_plugin_option_wdg_playerstats_players_select" class="select-team-single" size="1">'; 

  for ( $i=0; $i < count($players); $i++ )
  {
    if ( $players[$i]['playerID'] == $wdg_playerstats_player_id )
    echo '<option value="' . $players[$i]['playerID'] . '" selected="yes">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>';
    else
    echo '<option value="' . $players[$i]['playerID'] . '">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>';
  }

echo '
                    </select>
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_wdg_playerstats_playerid">Widget Game Results - Player ID</label></th>
                    <td><select name="bbnuke_plugin_option_wdg_game_results_players_select" class="select-team-single" size="1">'; 

  for ( $i=0; $i < count($players); $i++ )
  {
    if ( $players[$i]['playerID'] == $wdg_game_results_player_id )
    echo '<option value="' . $players[$i]['playerID'] . '" selected="selected">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>';
    else
    echo '<option value="' . $players[$i]['playerID'] . '">' . $players[$i]['lastname'] . ', ' . $players[$i]['firstname'] . '</option>';
  }

echo '
                    </select>
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_wdg_playerstats_playerid">Widget Game Results - Game ID</label></th>
                    <td><select name="bbnuke_plugin_option_wdg_game_results_games_select" class="select-team-single" size="1">'; 

  for ( $i=0; $i < count($games); $i++ )
  {
    if ( $games[$i]['gameID'] == $wdg_game_results_game_id )
    echo '<option value="' . $games[$i]['gameID'] . '" selected="selected">' . $games[$i]['homeTeam'] . ' vs ' . $games[$i]['visitingTeam'] . ' on ' . $games[$i]['Gdate'] . ' at ' . $games[$i]['Gtime'] . '</option>';
    else
    echo '<option value="' . $games[$i]['gameID'] . '">' . $games[$i]['homeTeam'] . ' vs ' . $games[$i]['visitingTeam'] . ' on ' . $games[$i]['Gdate'] . ' at ' . $games[$i]['Gtime'] . '</option>';
  }

echo '
                    </select>
                    </td>
                </tr>
		<tr>
		  <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_roster_widget">Options for Roster Widget</label></th>
		  <td>
		<table id="bbnuke_options_table">
		  <tr>
		    <th>#</th>
		    <th>Name</th>
		    <th>Position</th>
		    <th>Bats</th>
		    <th>Throws</th>
		    <th>Home</th>
		    <th>School</th>
		  </tr>
		  <tr>';
		  if ($roster_num == 'true') 
		    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_num" value="num" checked="checked"></td>';
		  else 
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_num" value="num"></td>';
                  if ($roster_name == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_name" value="name" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_name" value="name"></td>';
                  if ($roster_pos == 'true') 
		    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_pos" value="pos" checked="checked"></td>';
		  else
		    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_pos" value="pos"></td>';
		  if ($roster_bats == 'true')
		    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_bats" value="bats" checked="checked"></td>';
		  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_bats" value="bats"></td>';
		  if ($roster_throws == 'true')
		    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_throws" value="throws" checked="checked"></td>';
		  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_throws" value="throws"></td>';
		  if ($roster_home == 'true')
		    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_home" value="home" checked="checked"></td>';
		  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_home" value="home"></td>';
		  if ($roster_school == 'true')
		    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_school" value="school" checked="checked"></td>';
		  else 
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_roster_school" value="school"></td>';
echo '
		  </tr>
		</table>
		  </td>
		</tr>
                <tr>
                  <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_option_batting_widget">Options for Batting Widget</label></th>
                  <td>
                <table id="bbnuke_options_table">
                  <tr>
                    <th id="bbnuke_option_subtable">#</th>
                    <th id="bbnuke_option_subtable">Batter</th>
                    <th id="bbnuke_option_subtable">AB</th>
                    <th id="bbnuke_option_subtable">R</th>
                    <th id="bbnuke_option_subtable">H</th>
                    <th id="bbnuke_option_subtable">2B</th>
                    <th id="bbnuke_option_subtable">3B</th>
                    <th id="bbnuke_option_subtable">HR</th>
                    <th id="bbnuke_option_subtable">RE</th>
                    <th id="bbnuke_option_subtable">FC</th>
                    <th id="bbnuke_option_subtable">SF</th>
                    <th id="bbnuke_option_subtable">HP</th>
                    <th id="bbnuke_option_subtable">RBI</th>
                    <th id="bbnuke_option_subtable">BA</th>
                    <th id="bbnuke_option_subtable">OBP</th>
                    <th id="bbnuke_option_subtable">SLG</th>
                    <th id="bbnuke_option_subtable">OPS</th>
                    <th id="bbnuke_option_subtable">BB</th>
                    <th id="bbnuke_option_subtable">K</th>
                    <th id="bbnuke_option_subtable">LOB</th>
                    <th id="bbnuke_option_subtable">SB</th>
                  </tr>
                  <tr>';
                  if ($batting_num == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_num" value="num" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_num" value="num"></td>';
                  if ($batting_name == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_name" value="name" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_name" value="name"></td>';
                  if ($batting_ab == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_ab" value="ab" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_ab" value="ab"></td>';
                  if ($batting_r == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_r" value="r" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_r" value="r"></td>';
                  if ($batting_h == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_h" value="h" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_h" value="h"></td>';
                  if ($batting_2b == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_2b" value="2b" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_2b" value="2b"></td>';
                  if ($batting_3b == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_3b" value="3b" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_3b" value="3b"></td>';
                  if ($batting_hr == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_hr" value="hr" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_hr" value="hr"></td>';
                  if ($batting_re == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_re" value="re" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_re" value="re"></td>';                    
                  if ($batting_fc == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_fc" value="fc" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_fc" value="fc"></td>';
                  if ($batting_sf == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_sf" value="sf" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_sf" value="sf"></td>';
                  if ($batting_hp == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_hp" value="hp" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_hp" value="hp"></td>';
                  if ($batting_rbi == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_rbi" value="rbi" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_rbi" value="rbi"></td>';
                  if ($batting_ba == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_ba" value="ba" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_ba" value="ba"></td>';
                  if ($batting_obp == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_obp" value="obp" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_obp" value="obp"></td>';
                  if ($batting_slg == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_slg" value="slg" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_slg" value="slg"></td>';
                  if ($batting_ops == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_ops" value="ops" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_ops" value="ops"></td>';
                  if ($batting_bb == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_bb" value="bb" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_bb" value="bb"></td>';
                  if ($batting_k == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_k" value="k" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_k" value="k"></td>';
                  if ($batting_lob == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_lob" value="lob" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_lob" value="lob"></td>';
                  if ($batting_sb == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_sb" value="sb" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_batting_sb" value="sb"></td>';                    
echo '
                  </tr>
                </table>
                  </td>
                </tr>
                <tr>
                  <th class="bbnuke_option_bbft_part"><label for="bbnuke_plugin_option_pitching_widget">Options for Pitching Widget</label></th>
                  <td>
                <table id="bbnuke_options_table">
                  <tr>
                    <th id="bbnuke_option_subtable">#</th>
                    <th id="bbnuke_option_subtable">Pitcher</th>
                    <th id="bbnuke_option_subtable">W</th>
                    <th id="bbnuke_option_subtable">L</th>
                    <th id="bbnuke_option_subtable">S</th>
                    <th id="bbnuke_option_subtable">IP</th>
                    <th id="bbnuke_option_subtable">H</th>
                    <th id="bbnuke_option_subtable">R</th>
                    <th id="bbnuke_option_subtable">ER</th>
                    <th id="bbnuke_option_subtable">BB</th>
                    <th id="bbnuke_option_subtable">K</th>
                    <th id="bbnuke_option_subtable">ERA</th>
                    <th id="bbnuke_option_subtable">WHIP</th>
                  </tr>
                  <tr>';
                  if ($pitching_num == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_num" value="num" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_num" value="num"></td>';
                  if ($pitching_name == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_name" value="name" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_name" value="name"></td>';
                  if ($pitching_w == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_w" value="w" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_w" value="w"></td>';
                  if ($pitching_l == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_l" value="l" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_l" value="l"></td>';
                  if ($pitching_s == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_s" value="s" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_s" value="s"></td>';
                  if ($pitching_ip == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_ip" value="ip" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_ip" value="ip"></td>';
                  if ($pitching_h == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_h" value="h" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_h" value="h"></td>';
                  if ($pitching_er == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_r" value="r" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_r" value="r"></td>';
                  if ($pitching_er == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_er" value="er" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_er" value="er"></td>';
                  if ($pitching_bb == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_bb" value="bb" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_bb" value="bb"></td>';                    
                  if ($pitching_k == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_k" value="k" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_k" value="k"></td>';
                  if ($pitching_era == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_era" value="era" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_era" value="era"></td>';
                  if ($pitching_whip == 'true')
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_whip" value="whip" checked="checked"></td>';
                  else
                    echo '<td id="bbnuke_option_subtable"><input type=checkbox name="bbnuke_plugin_option_pitching_whip" value="whip"></td>';
echo '
                  </tr>
                </table>
                  </td>
                </tr>
	      </table>
                <div class="submit">
                  <div class="div-wait" id="divwaitms0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                  <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_btn_above" name="bbnuke_update_options_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
                </div>
                </form>
              </div>
            </div>
            <div class="postbox ui-droppable" id="season-div">
              <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
              <h3 class="hndle">' . __('Seasons Management', 'bbnuke') . '</h3>
              <div class="inside">
                <p>
                 '. __('Select which teams you want add to which season.', 'bbnuke').'
                </p>
                <form name="bbnuke_plugin_option_form" method="post" action="">';

  wp_nonce_field('bbnuke_plugin_options');

echo '
              <table class="form-table">
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_season_new">New Season:</label></th>
                    <td><input type="text" size="6" id="bbnuke_season_new_id" name="bbnuke_season_new" value="" />  (Year)<br />
                      <div class="div-wait" id="divwaitsn0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                      <input type="submit" class="button-primary" value="Add new season" id="bbnuke_add_season_btn_id" name="bbnuke_add_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season">Select season:</label></th>
                    <td><select size="1" class="select-season-single" id="bbnuke_select_season_id" name="bbnuke_select_season">';

  reset($seasons_list);
  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $defs['defaultSeason'] )
    echo '<option value="' . $i . '" selected="yes">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $i . '">' . $seasons_list[$i] . '</option>';
  }

//  for ( $i=0; $i < count($seasons_list); $i++ )
//  {
//  echo '<option value="' . $i . '">' . $seasons_list[$i] . '</option>';
//  }

echo '
                    </select>&nbsp;
                      <div class="div-wait" id="divwaitsn1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                      <input type="submit" class="button-primary" value="Delete season" id="bbnuke_del_season_btn_id" name="bbnuke_del_season_btn" onclick="return confirm(\'Are you sure you want to delete season and ALL related teams, players and stats?\');" /><br />
                      <br /><br />
                      Select teams you want add to that season<br />
                      <select size="6" class="select-teams-multiple" multiple="multiple" id="bbnuke_select_season_teams_id" name="bbnuke_select_season_teams[]">';

  for ( $i=0; $i < count($team_list); $i++ )
  {
  echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

echo '
                   </select><br />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                    <td></td>
                </tr>
                </table>
                <div class="submit">
                  <div class="div-wait" id="divwaitst0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                  <input type="submit" class="button-secondary" value="Add teams to season" id="bbnuke_add_season_teams_btn_id" name="bbnuke_add_season_teams_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
                  <div class="right-bottom"><a href="#Top">Back to Top</a></div>
                </div>
                </form>
              </div>
            </div>
            <div class="postbox ui-droppable" id="teams-div">
              <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
              <h3 class="hndle">' . __('Teams', 'bbnuke') . '</h3>
              <div class="inside">
                <p>
                 '. __('Add and delete teams.', 'bbnuke') . '<br /><br />
                </p>
                <form name="bbnuke_plugin_option_form" method="post" action="">';

  wp_nonce_field('bbnuke_plugin_options');

echo '
              <table class="form-table">
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_add_new_team">Add new team: </label></th>
                    <td><input type="text" name="bbnuke_add_new_team" size="25" value="" />
                      <div class="div-wait" id="divwaitt0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                      <input type="submit" class="button-primary" value="' . __('Add', 'bbnuke') . '" id="bbnuke_add_new_team_btn_id" name="bbnuke_add_new_team_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
                    </td>
                </tr>
                <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season">Delete a team:</label></th>
                    <td><select size="1" name="bbnuke_select_team_delete" class="select-team-single">';

  reset($team_list);
  for ( $i=0; $i < count($team_list); $i++ )
  {
  echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

echo '
                    </select>
                    <div class="div-wait" id="divwaitt1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                    <input type="submit" class="button-primary" value="' . __('Delete', 'bbnuke') . '" id="bbnuke_select_team_delete_btn_id" name="bbnuke_select_team_delete_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td></td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="postbox-container" id="bbnuke-plugin-news">
      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">
        <div class="postbox ui-droppable" id="bbnuke_info">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>
          <div class="inside">
            <!-- Facebook Badge START -->
            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP" ><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>
            <!-- Facebook Badge END -->
          </div>
        </div>
        <div class="postbox ui-droppable" id="bbnuke_links">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Donations</h3>
          <div class="inside">
            <p>Help support the Flying Dogs by making a donation!</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypal-form">
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="manager@frederickcardinals.com">
              <input type="hidden" name="item_name" value="Flying Dogs Donation">
              <input type="hidden" name="item_number" value="2007donation">
              <input type="hidden" name="no_shipping" value="0">
              <input type="hidden" name="no_note" value="1">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="tax" value="0">
              <input type="hidden" name="lc" value="US">
              <input type="hidden" name="bn" value="PP-DonationsBF">
              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';

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


echo '
<div class="wrap">
  <a name="Top"></a>
  <div class="bbnuke-icon32"></div>
  <h2>baseballNuke Plugin  -  Locations Settings</h2>
  <hr />
  <div class="clear"></div>
  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
    <div class="postbox-container" id="bbnuke-plugin-main">
      <div class="has-sidebar-content">
        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
          <div class="postbox ui-droppable" id="bbnuke-fields-edit">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Field Edit', 'bbnuke') . '</h3>
            <div class="inside">
              <b>Add or Edit a Location</b>
              <p>
               '. __('Edit the location or add a new entry.', 'bbnuke').'
              </p>
              <form name="bbnuke_fields_edit_form" method="post" action="">';

  wp_nonce_field('bbnuke_fields_edit');

echo '
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_field_edit_fieldname">Field Name</label></th>
                  <td><input type="text" name="bbnuke_field_edit_fieldname" value="' . $fieldname . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_field_edit_directions">Directions</label></th>
                  <td><textarea class="bbnuke_textarea" name="bbnuke_field_edit_directions" cols="50" rows="10">' . $directions . '</textarea></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td>
                  </td>
              </tr>';

echo '
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td>';

  if ( $edit_field === true )
  echo '                    <input type="hidden" value="' . $field_id . '" name="bbnuke_delete_field_id" />';
  else
  echo '                    <input type="hidden" value="none" name="bbnuke_delete_field_id" />';

echo '
                  </td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="div-wait" id="divwaitedl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_location_btn_id" name="bbnuke_save_location_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;';

  if ( $edit_field === true )
  {
  echo '
                  <div class="div-wait" id="divwaitedl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                  <input type="submit" class="button-primary" value="Delete Field" id="bbnuke_delete_field_' . $field_id . '_btn_id" name="bbnuke_delete_field_' . $field_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />';
  }

echo '
              </div>
              </form>
            </div>
          </div>
          <div class="postbox ui-droppable" id="bbnuke-locations-list">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Locations List', 'bbnuke') . '</h3>
            <div class="inside">
              <p>
               '. __('Edit or delete a location.', 'bbnuke').'
              </p>
              <form name="bbnuke_fields_list_form" method="post" action="">';

  wp_nonce_field('bbnuke_fields_list');

echo '
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="">Total Locations:</label></th>
                  <td>' . count($fields_list) . '&nbsp;&nbsp;
                    <div class="div-wait" id="divwaitlloc0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                    <input type="submit" class="button-primary" value="Delete all locations" id="bbnuke_del_all_fields_btn_id" name="bbnuke_del_all_fields_btn" onclick="return confirm(\'Are you sure you want to delete ALL locations?\');"  /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_fields">Current Locations:</label></th>
                  <td><ul class="locations-list">';

  for ( $i=0; $i < count($fields_list); $i++ )
  {
    $fieldname   = $fields_list[$i]['fieldname'];
    $directions  = $fields_list[$i]['directions'];
  echo '
                         <li class="locations-list-entry">
                           <label for="bbnuke_field_' . $i . '" class="locations-list-entry-label">' . $fieldname . '</label> -- &nbsp;
                           <div class="div-wait" id="divwaitlloc1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                           <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_field_' . $i . '_btn_id" name="bbnuke_edit_field_' . $i . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;
                           <div class="div-wait" id="divwaitlloc2"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                           <input type="submit" class="button-primary" value="Delete" id="bbnuke_delete_field_' . $i . '_btn_id" name="bbnuke_delete_field_' . $i . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;
                         </li>';
  }

echo '
                      </ul></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td></td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';

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
  $defs         = bbnuke_get_defaults();
  $season	= $defs['defaultSeason'];
  $team		= $defs['defaultTeam'];
  $seasons_list = bbnuke_get_seasons();
  $team_list    = bbnuke_get_teams($season);
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


echo '
<div class="wrap">
  <a name="Top"></a>
  <div class="bbnuke-icon32"></div>
  <h2>baseballNuke Plugin  -  Players Settings</h2>
  <hr />
  <div class="clear"></div>
  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
    <div class="postbox-container" id="bbnuke-plugin-main">
      <div class="has-sidebar-content">
        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
          <div class="postbox ui-droppable" id="bbnuke-players-1">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Players', 'bbnuke') . '</h3>
            <div class="inside">
              <b>Add, edit, delete Players</b>
              <p>
               '. __('<b>Player</b>', 'bbnuke').'
              </p>
  <form name="bbnuke_players_edit_form" method="post" action="">';

  wp_nonce_field('bbnuke_players_edit_form');

echo '
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_fname">First Name</label></th>
                  <td><input type="text" name="bbnuke_player_edit_fname" value="' . $firstname . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_mname">Middle Name</label></th>
                  <td><input type="text" name="bbnuke_player_edit_mname" value="' . $middlename . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_lname">Last Name</label></th>
                  <td><input type="text" name="bbnuke_player_edit_lname" value="' . $lastname . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_pprofile">Player Profile</label></th>
                  <td><textarea class="bbnuke_textarea" rows="20" cols="55" name="bbnuke_player_edit_pprofile">' . $profile . '</textarea></td>
              </tr>';
        $ajpath = BBNPURL.'bbnuke-get-teams.php';
        echo '<input type=hidden id=path value='.$ajpath.'>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_season">Season</label></th>
                  <td><select size="1" id="bbnuke_player_edit_season_id" name="bbnuke_player_edit_season">';

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $defs['defaultSeason'] )
    echo '<option value="' . $seasons_list[$i] . '" selected="yes">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
  }

echo '
                    </select>
	        </td>
	      </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_team">Team</label></th>
                  <td><select size="1" id="bbnuke_player_edit_team_id" name="bbnuke_player_edit_team">';

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $defs['defaultTeam'] )
    echo '<option value="' . $team_list[$i] . '" selected="yes">' . $team_list[$i] . '</option>';
    else
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

echo '
                    </select>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_jerseynum">Jersey Number</label></th>
                  <td><input type="text" name="bbnuke_player_edit_jerseynum" value="' . $jerseynum . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_position">Position(s)</label></th>
                  <td><input type="text" name="bbnuke_player_edit_position" value="' . $positions . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_bats">Bats</label></th>
                  <td><input type="text" name="bbnuke_player_edit_bats" value="' . $bats . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_throws">Throws</label></th>
                  <td><input type="text" name="bbnuke_player_edit_throws" value="' . $throws . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_height">Height</label><i> (value in inches) </i></th>
                  <td><input type="text" name="bbnuke_player_edit_height" value="' . $height . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_weight">Weight</label></th>
                  <td><input type="text" name="bbnuke_player_edit_weight" value="' . $weight . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_bdate">Birth Date</label></th>
                  <td><input type="text" name="bbnuke_player_edit_bdate" value="' . $bdate . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_address">Address</label></th>
                  <td><input type="text" name="bbnuke_player_edit_address" value="' . $address . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_city">City</label></th>
                  <td><input type="text" name="bbnuke_player_edit_city" value="' . $city . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_state">State</label></th>
                  <td><input type="text" name="bbnuke_player_edit_state" value="' . $state . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_zip">Zip</label></th>
                  <td><input type="text" name="bbnuke_player_edit_zip" value="' . $zip . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_hphone">Home Phone</label></th>
                  <td><input type="text" name="bbnuke_player_edit_hphone" value="' . $homephone . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_cphone">Cell Phone</label></th>
                  <td><input type="text" name="bbnuke_player_edit_cphone" value="' . $cellphone . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_wphone">Work Phone</label></th>
                  <td><input type="text" name="bbnuke_player_edit_wphone" value="' . $workphone . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_email">Email</label></th>
                  <td><input type="text" name="bbnuke_player_edit_email" value="' . $email . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_school">School</label></th>
                  <td><input type="text" name="bbnuke_player_edit_school" value="' . $school . '"></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_player_edit_pictureloc">Picture Location</label></th>
		   <td><label for="upload_image">
 		     <input id="upload_image" type="text" size="36" name="bbnuke_player_edit_pictureloc" value="' . $piclocation . '" />
		     <input id="upload_image_button" type="button" value="Upload Image" />
		     <br />Enter an URL or upload an image for player profile.
		   </label></td>
              </tr>
                  </td>
              </tr>
              </table>
              <div class="submit">';

  if ( $edit_player === true )
echo '
                <div class="div-wait" id="divwaitped1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                <input type="submit" class="button-secondary" value="Update Player" id="bbnuke_update_player_' . $player_id . '_btn_id" name="bbnuke_update_player_' . $player_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>';

  else echo '

                <div class="div-wait" id="divwaitped1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                <input type="submit" class="button-secondary" value="Save Players Data" id="bbnuke_save_player_btn_id" name="bbnuke_save_player_btn"      onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>';
echo '

              </div>
              </form>
            </div>
          </div>
          <div class="postbox ui-droppable" id="bbnuke-upload-players">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Upload Players', 'bbnuke') . '</h3>
            <div class="inside">
              <p>
               '. __('Choose a file to upload in the form: ', 'bbnuke').'
               '. __('teamName, firstname, middlename, lastname, positions, bats, throws, height, weight, address, city, state, zip, homePhone, workPhone, cellphone, jerseyNum, picLocation, season, profile, email, school, bdate.', 'bbnuke').'
              </p>
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>
                  <td>
                    <form enctype="multipart/form-data" method="POST" action="">
                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                      <input name="bbnuke_uploadedfile" type="file" /><br />
                      <input type="submit" name="bbnuke_players_file_upload_btn" value="Upload" />
                    </form>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td></td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
              </div>
            </div>
          </div>
          <div class="postbox ui-droppable" id="bbnuke-players-list">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Current Players', 'bbnuke') . '</h3>
            <div class="inside">
              <p>
               '. __('Select which player you want edit - first select team and season.', 'bbnuke').'
              </p>
              <form name="bbnuke_players_list_form" method="post" action="">';

  wp_nonce_field('bbnuke_players_list_form');

echo '
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season">Select season:</label></th>';
              $ajpath = BBNPURL.'bbnuke-get-teams.php';
        echo '<input type=hidden id=path value='.$ajpath.'>
	        <td><select size="1" id="bbnuke_select_season_id" name="bbnuke_select_season">';

  $season  = bbnuke_get_option('bbnuke_players_season');
  $team    = bbnuke_get_option('bbnuke_players_team');
  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
    echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
  }

echo '
                    </select>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_select_season_team">Select team to which you want add players: </label></th>
                  <td><select size="1" id="bbnuke_select_season_team_id" name="bbnuke_select_season_team">';

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $defs['defaultTeam'] )
    echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
    else
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

echo '
                    </select><br /><br />
                    <div class="div-wait" id="divwaitsts0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                    <input type="submit" class="button-primary" value="Set season and team" id="bbnuke_set_season_team_id" name="bbnuke_set_season_team_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td><hr /></td>
              </tr>';

  if ( !empty($season) AND !empty($team) )
    $players = bbnuke_get_players_season_team($season, $team);

echo '
              <tr><th class="bbnuke_option_left_part"><label for="">Total Players:</label></th>
                  <td>' . count($players) . '&nbsp;&nbsp;
                    <div class="div-wait" id="divwaitsts1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                    <input type="submit" class="button-primary" value="Delete all players" id="bbnuke_del_players_season_team_id" name="bbnuke_del_players_season_team_btn" onclick="return confirm(\'Are you sure you want to delete ALL players for '.$season.'?\');"  /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_players">Current Players:</label></th>
                  <td><ul class="players-list">';

  for ( $i=0; $i < count($players); $i++ )
  {
    $player_id   = $players[$i]['playerID'];
    $lastname   = $players[$i]['lastname'];
    $firstname  = $players[$i]['firstname'];
    $middlename = $players[$i]['middlename'];
  echo '
                         <li class="players-list-entry">
                           <label for="bbnuke_player_' . $i . '" class="player-list-entry-label">' . $lastname . ', ' . $firstname . ' ' . $middlename . '</label> 
                           -- ' . $team . '&nbsp;
                           <div class="div-wait" id="divwaitcpl' . $i . '"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                           <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_player_' . $player_id . '_btn_id" name="bbnuke_edit_player_' . $player_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
  			      <div class="div-wait" id="divwaitped0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
  			      <input type="submit" class="button-primary" value="Delete" id="bbnuke_delete_player_' . $player_id . '_btn_id" name="bbnuke_delete_player_' . $player_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
                         </li>';
  }

echo '
                      </ul></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td></td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
              </div>
              </form>
            </div>
          </div>
          <div class="postbox ui-droppable" id="bbnuke-players-season-teams">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Assign Existing Players to Team', 'bbnuke') . '</h3>
            <div class="inside">
              <p>
               '. __('Select the season and assign players to the teams.', 'bbnuke').' 
              </p>
              <form name="bbnuke-players-season-team-form" method="post" action="">';

  wp_nonce_field('bbnuke-players-season-team-form');

echo '
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_players_select_season">Select season:</label></th>';
              $ajpath = BBNPURL.'bbnuke-get-teams.php';
        echo '<input type=hidden id=path value='.$ajpath.'>
                  <td><select size="1" id="bbnuke_players_select_season_id" name="bbnuke_players_select_season">';

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
    echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
  }

echo '
                    </select>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_players_select_season_team">Select team to which you want add players: </label></th>
                  <td><select size="1" id="bbnuke_players_select_season_team_id" name="bbnuke_players_select_season_team">';

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $team )
    echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
    else
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

echo '
                    </select><br /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td><hr /></td>
              </tr>';

  if ( !empty($season) AND !empty($team) )
    $players = bbnuke_get_all_players();
echo '
              <tr><th class="bbnuke_option_left_part"><label for="">Total Players:</label></th>
                  <td>' . count($players) . '</td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_players_list_players">Assign Players:</label></th>
                  <td><select name="bbnuke_players_assign_select[]" id="bbnuke_players_assign_select_id" size="10" multiple="multiple">';

  for ( $i=0; $i < count($players); $i++ )
  {
    $player_id   = $players[$i]['playerID'];
    $lastname   = $players[$i]['lastname'];
    $firstname  = $players[$i]['firstname'];
    $middlename = $players[$i]['middlename'];
  echo '<option value="' . $i . '">' . $lastname . ', ' . $firstname . ' ' . $middlename . '</option>';
  }

echo '
                      </select></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td></td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="div-wait" id="divwaitapl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                <input type="submit" class="button-primary" value="Assign players to team" id="bbnuke_assign_players_team_btn_id" name="bbnuke_assign_players_team_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="postbox-container" id="bbnuke-plugin-news">
      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">
        <div class="postbox ui-droppable" id="bbnuke_info">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>
          <div class="inside">
            <!-- Facebook Badge START -->
            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>
            <!-- Facebook Badge END -->
          </div>
        </div>
        <div class="postbox ui-droppable" id="bbnuke_links">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Donations</h3>
          <div class="inside">
            <p>Help support the Flying Dogs by making a donation!</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="manager@frederickcardinals.com">
              <input type="hidden" name="item_name" value="Flying Dogs Donation">
              <input type="hidden" name="item_number" value="2007donation">
              <input type="hidden" name="no_shipping" value="0">
              <input type="hidden" name="no_note" value="1">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="tax" value="0">
              <input type="hidden" name="lc" value="US">
              <input type="hidden" name="bn" value="PP-DonationsBF">
              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';

}



////////////////////////////////////////////////////////////////////////////////
// show schedules page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_schedules_page( $edit_game = false )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $options = get_option('bbnuke_plugin_options');

  $fields_list  = bbnuke_get_locations();
  $seasons_list = bbnuke_get_seasons();
  $season       = bbnuke_get_option('bbnuke_schedules_season');
  $team_list    = bbnuke_get_teams($season);

  $games        = bbnuke_get_schedules($season);
  $hteam	= NULL;
  $vteam	= NULL;

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
    $season	 = $game['season'];
  }


echo '
<div class="wrap">
  <a name="Top"></a>
  <div class="bbnuke-icon32"></div>
  <h2>baseballNuke Plugin  -  Schedules Settings</h2>
  <hr />
  <div class="clear"></div>
  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
    <div class="postbox-container" id="bbnuke-plugin-main">
      <div class="has-sidebar-content">
        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
          <div class="postbox ui-droppable" id="bbnuke-schedules-edit">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Schedule Edit', 'bbnuke') . '</h3>
            <div class="inside">
              <b>Add, Edit or delete a Schedule</b>
              <p>
               '. __('Select a season  - edit the schedules or add a new entry.', 'bbnuke').' 
              </p>
              <form name="bbnuke_schedules_edit_form" method="post" action="">';

  wp_nonce_field('bbnuke_schedules_edit');

echo '
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_select_season">Select season:</label></th>
                  <td><select size="1" id="bbnuke_schedules_edit_select_season_id" name="bbnuke_schedules_edit_select_season">';

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ($seasons_list[$i] == $season)
    echo '<option value="' . $seasons_list[$i] . '" selected="yes">' . $seasons_list[$i] . '</option>';
    elseif ( ($seasons_list[$i] == $defs['defaultSeason']) && (is_null($season)) )
    echo '<option value="' . $seasons_list[$i] . '" selected="yes">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
  }

echo '
                    </select>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td><hr /></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_type_select">Type</label></th>
                  <td><select size="1" id="bbnuke_schedules_edit_type_select_id" name="bbnuke_schedules_edit_type_select">
		  <option selected="selected" value="game">Game</option>
                  <option value="practice">Practice</option>
                  <option value="tournament">Tournament</option>
		  </select>
		  </td>
	      </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_gdate">Date</label></th>
                  <td><input type="text" name="bbnuke_schedules_edit_gdate" value="' . $gdate . '" />&nbsp;(In the form: "YYYY-MM-DD")</td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_gtime">Time</label></th>
                  <td><input type="text" name="bbnuke_schedules_edit_gtime" value="' . $gtime . '" />&nbsp;(In the form: "HH:MM:SS")</td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_hteam_select">Home</label></th>
                  <td><select size="1" id="bbnuke_schedules_edit_hteam_select_id" name="bbnuke_schedules_edit_hteam_select">';

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $hteam )
    echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
    elseif ( ($team_list[$i] == $defs['defaultTeam']) && (is_null($hteam)) )
    echo '<option value="' . $team_list[$i] . '" selected="yes">' . $team_list[$i] . '</option>';
    else
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

echo '
                  </select>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_vteam_select">Visitors</label></th>
                  <td><select size="1" id="bbnuke_schedules_edit_vteam_select_id" name="bbnuke_schedules_edit_vteam_select">';

  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $vteam )
    echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
    elseif ( ($team_list[$i] == $defs['defaultTeam']) && (is_null($vteam)) )
    echo '<option value="' . $team_list[$i] . '" selected="yes">' . $team_list[$i] . '</option>';
    else
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

//  for ( $i=0; $i < count($team_list); $i++ )
//  {
//    if ( $team_list[$i] == $vteam )
//    echo '<option selected="selected" value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
//    else
//    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
//  }

echo '
                  <option value=""></option>
                  </select>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_edit_field_select">Field</label></th>
                  <td><select size="1" id="bbnuke_schedules_edit_field_select_id" name="bbnuke_schedules_edit_field_select">';

  reset($fields_list);
  for ( $i=0; $i < count($fields_list); $i++ )
  {
    if ( $fields_list[$i]['fieldname'] == $field )
    echo '<option selected="selected" value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>';
    else
    echo '<option value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>';
  }

echo '
                    </select><br /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td>';

  if ( $edit_game === true )
  echo '                    <input type="hidden" value="' . $game_id . '" name="bbnuke_game_delete_id" />';
  else
  echo '                    <input type="hidden" value="none" name="bbnuke_game_delete_id" />';

echo '
                  </td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="div-wait" id="divwaiteds0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_game_btn_id" name="bbnuke_save_game_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;';

  if ( $edit_game === true )
  {
  echo '
                  <div class="div-wait" id="divwaiteds1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                  <input type="submit" class="button-primary" value="Delete Game" id="bbnuke_delete_game_' . $game_id . '_btn_id" name="bbnuke_delete_game_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />';
  }

echo '
              </div>
              </form>
            </div>
          </div>
          <div class="postbox ui-droppable" id="bbnuke-upload-schedules">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Upload Schedules for season ' . $season, 'bbnuke') . '</h3>
            <div class="inside">
              <p>
               '. __('Choose a file to upload in the form: ', 'bbnuke').' 
               '. __('visitingTeam,homeTeam,gameDate,gameTime,field.', 'bbnuke').'
              </p>
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>
                  <td>
                    <form enctype="multipart/form-data" method="POST" action="">
                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                      <input name="bbnuke_schedules_uploadedfile" type="file" /><br />
	                      <input type="submit" name="bbnuke_schedules_file_upload_btn" value="Upload" />
	                    </form>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td></td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
	              </div>
	            </div>
	          </div>
	          <div class="postbox ui-droppable" id="bbnuke-schedules-list">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Schedules List', 'bbnuke') . '</h3>
	            <div class="inside">
	              <p>
	               '. __('Select a game for edit.', 'bbnuke').' 
	              </p>
	              <form name="bbnuke_schedules_list_form" method="post" action="">';

	  wp_nonce_field('bbnuke_schedules_list');

	echo '
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_schedules_list_select_season">Select season:</label></th>
	                  <td><select size="1" id="bbnuke_schedules_list_select_season_id" name="bbnuke_schedules_list_select_season">';

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ($seasons_list[$i] == $season)
    echo '<option value="' . $seasons_list[$i] . '" selected="yes">' . $seasons_list[$i] . '</option>';
    elseif ( ($seasons_list[$i] == $defs['defaultSeason']) && (is_null($season)) )
    echo '<option value="' . $seasons_list[$i] . '" selected="yes">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
  }
	echo '
	                    </select><br /><br />
	                    <div class="div-wait" id="divwaitschl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_schedules_set_season_btn_id" name="bbnuke_schedules_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td><hr /></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="">Total Schedules:</label></th>
	                  <td>' . count($games) . '&nbsp;&nbsp;
	                    <div class="div-wait" id="divwaitsch0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                    <input type="submit" class="button-primary" value="Delete all schedules" id="bbnuke_del_all_schedules_btn_id" name="bbnuke_del_all_schedules_btn" onclick="return confirm(\'Are you sure you want to delete ALL games for '.$season.'?\');" /><br />
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_games">Existing Games:</label></th>
	                  <td><ul class="games-list">';

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
	  echo '
	                         <li class="games-list-entry">
                                   <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_game_' . $game_id . '_btn_id" name="bbnuke_edit_game_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;
                              <input type="submit" class="button-primary" value="Delete" id="bbnuke_delete_game_' . $game_id . '_btn_id" name="bbnuke_delete_game_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />
	                           <label for="bbnuke_game_' . $i . '" class="games-list-entry-label"><b>' . $hteam . '</b> VS <b>' . $vteam . '</b> on <b>' . $gdate . '</b> at ' . $gtime . ' @ ' . $field . '&nbsp;&nbsp;</label>
	                           <div class="div-wait" id="divwaitsch1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                         </li>';
	  }

	echo '
	                      </ul></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td></td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
	              </div>
	              </form>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="postbox-container" id="bbnuke-plugin-news">
	      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">
	        <div class="postbox ui-droppable" id="bbnuke_info">
	          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>
	          <div class="inside">
	            <!-- Facebook Badge START -->
	            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>
	            <!-- Facebook Badge END -->
	          </div>
	        </div>
	        <div class="postbox ui-droppable" id="bbnuke_links">
	          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	          <h3 class="hndle">Donations</h3>
	          <div class="inside">
	            <p>Help support the Flying Dogs by making a donation!</p>
	            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	              <input type="hidden" name="cmd" value="_xclick">
	              <input type="hidden" name="business" value="manager@frederickcardinals.com">
	              <input type="hidden" name="item_name" value="Flying Dogs Donation">
	              <input type="hidden" name="item_number" value="2007donation">
	              <input type="hidden" name="no_shipping" value="0">
	              <input type="hidden" name="no_note" value="1">
	              <input type="hidden" name="currency_code" value="USD">
	              <input type="hidden" name="tax" value="0">
	              <input type="hidden" name="lc" value="US">
	              <input type="hidden" name="bn" value="PP-DonationsBF">
	              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>';

	  return;
	}




	////////////////////////////////////////////////////////////////////////////////
	// show tournament page
	////////////////////////////////////////////////////////////////////////////////
/*	function bbnuke_plugin_print_tournaments_page( $edit_tournament = false )
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


	echo '
	<div class="wrap">
	  <a name="Top"></a>
	  <div class="bbnuke-icon32"></div>
	  <h2>baseballNuke Plugin  -  Tournaments Settings</h2>
	  <hr />
	  <div class="clear"></div>
	  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
	    <div class="postbox-container" id="bbnuke-plugin-main">
	      <div class="has-sidebar-content">
	        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
	          <div class="postbox ui-droppable" id="bbnuke-tournaments-edit">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Tournament Edit', 'bbnuke') . '</h3>
	            <div class="inside">
	              <b>Add, Edit or delete a Tournament</b>
	              <p>
	               '. __('Select a season  - edit the tournament or add a new entry.', 'bbnuke').' 
	              </p>
	              <form name="bbnuke_tournaments_edit_form" method="post" action="">';

	  wp_nonce_field('bbnuke_tournaments_edit');

	echo '
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_select_season">Select season:</label></th>
	                  <td><select size="1" id="bbnuke_tournaments_edit_select_season_id" name="bbnuke_tournaments_edit_select_season">';

	  for ( $i=0; $i < count($seasons_list); $i++ )
	  {
	    if ( $seasons_list[$i] == $season )
	    echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	    else
	    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	  }

	echo '
	                    </select>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td><hr /></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_gdate">Date</label></th>
	                  <td><input type="text" name="bbnuke_tournaments_edit_gdate" value="' . $gdate . '" />&nbsp;(In the form: "YYYY-MM-DD")</td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_gtime">Time</label></th>
	                  <td><input type="text" name="bbnuke_tournaments_edit_gtime" value="' . $gtime . '" />&nbsp;(In the form: "HH:MM:SS")</td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_field_select">Field</label></th>
	                  <td><select size="1" id="bbnuke_tournaments_edit_field_select_id" name="bbnuke_tournaments_edit_field_select">';

	  reset($fields_list);
	  for ( $i=0; $i < count($fields_list); $i++ )
	  {
	    if ( $fields_list[$i]['fieldname'] == $field )
	    echo '<option selected="selected" value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>';
	    else
	    echo '<option value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>';
	  }

	echo '
	                    </select>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_type_select">Type</label></th>
	                  <td><select size="1" id="bbnuke_tournaments_edit_type_select_id" name="bbnuke_tournaments_edit_type_select">
	                        <option value="NABF">NABF</option>
	                        <option value="MSBL">MSBL</option>
	                        <option value="NABA">NABA</option>
	                        <option value="League">League</option>
	                        <option value="USSSA">USSSA</option>
	                        <option value="AABO">AABO</option>
	                        <option value="SuperSeries">SuperSeries</option>
	                        <option value="Independent">Independent</option>
	                        <option value="Other">Other</option>
	                    </select>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_notes">Notes</label></th>
	                  <td><input type="text" name="bbnuke_tournaments_edit_notes" value="' . $notes . '" /></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td>';

	  if ( $edit_tournament === true )
	  echo '                    <input type="hidden" value="' . $game_id . '" name="bbnuke_game_delete_id" />';
	  else
	  echo '                    <input type="hidden" value="none" name="bbnuke_game_delete_id" />';

	echo '
	                  </td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="div-wait" id="divwaitedt0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_tournament_btn_id" name="bbnuke_save_tournament_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;';

	  if ( $edit_tournament === true )
	  {
	  echo '
	                  <div class="div-wait" id="divwaitedt1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                  <input type="submit" class="button-primary" value="Delete Tournament" id="bbnuke_delete_tournament_' . $game_id . '_btn_id" name="bbnuke_delete_tournament_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />';
	  }

	echo '
	              </div>
	              </form>
	            </div>
	          </div>
	          <div class="postbox ui-droppable" id="bbnuke-upload-tournaments">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Upload Tournaments for season ' . $season, 'bbnuke') . '</h3>
	            <div class="inside">
	              <p>
	               '. __('Choose a file to upload in the form: ', 'bbnuke').'
	               '. __('gameDate,gameTime,field,note.', 'bbnuke').'
	              </p>
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>
	                  <td>
	                    <form enctype="multipart/form-data" method="POST" action="">
	                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	                      <input name="bbnuke_tournaments_uploadedfile" type="file" /><br />
	                      <input type="submit" name="bbnuke_tournaments_file_upload_btn" value="Upload" />
	                    </form>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td></td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
	              </div>
	            </div>
	          </div>
	          <div class="postbox ui-droppable" id="bbnuke-tournaments-list">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Tournaments List', 'bbnuke') . '</h3>
	            <div class="inside">
	              <p>
	               '. __('Select a tournament for edit.', 'bbnuke').'
	              </p>
	              <form name="bbnuke_tournaments_list_form" method="post" action="">';

	  wp_nonce_field('bbnuke_tournaments_list');

	echo '
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_tournaments_edit_select_season">Select season:</label></th>
	                  <td><select size="1" id="bbnuke_tournaments_edit_select_season_id" name="bbnuke_tournaments_edit_select_season">';

	  for ( $i=0; $i < count($seasons_list); $i++ )
	  {
	    if ( $seasons_list[$i] == $season )
	    echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	    else
	    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	  }

	echo '
	                    </select><br /><br />
	                    <div class="div-wait" id="divwaittl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_tournaments_list_set_season_btn_id" name="bbnuke_tournaments_list_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td><hr /></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="">Total Tournaments:</label></th>
	                  <td>' . count($tournaments_list) . '&nbsp;&nbsp;
	                    <div class="div-wait" id="divwaittl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                    <input type="submit" class="button-primary" value="Delete all tournaments" id="bbnuke_del_all_tournaments_btn_id" name="bbnuke_del_all_tournaments_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_tournaments">Existing Tournaments:</label></th>
	                  <td><ul class="tournaments-list">';

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
	  echo '
	                         <li class="tournaments-list-entry">
	                           <label for="bbnuke_tournament_' . $i . '" class="tournaments-list-entry-label">' . $hteam . ' ' . $vteam . ' on ' . $gdate . ' at ' . $gtime . ' @ ' . $field . '</label>
	                           <div class="div-wait" id="divwaittl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                           <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_tournament_' . $game_id . '_btn_id" name="bbnuke_edit_tournament_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;
	                         </li>';
	  }

	echo '
	                      </ul></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td></td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
	              </div>
	              </form>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="postbox-container" id="bbnuke-plugin-news">
	      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">
	        <div class="postbox ui-droppable" id="bbnuke_info">
	          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>
	          <div class="inside">
	            <!-- Facebook Badge START -->
	            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>
	            <!-- Facebook Badge END -->
	          </div>
	        </div>
	        <div class="postbox ui-droppable" id="bbnuke_links">
	          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	          <h3 class="hndle">Donations</h3>
	          <div class="inside">
	            <p>Help support the Flying Dogs by making a donation!</p>
	            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	              <input type="hidden" name="cmd" value="_xclick">
	              <input type="hidden" name="business" value="manager@frederickcardinals.com">
	              <input type="hidden" name="item_name" value="Flying Dogs Donation">
	              <input type="hidden" name="item_number" value="2007donation">
	              <input type="hidden" name="no_shipping" value="0">
	              <input type="hidden" name="no_note" value="1">
	              <input type="hidden" name="currency_code" value="USD">
	              <input type="hidden" name="tax" value="0">
	              <input type="hidden" name="lc" value="US">
	              <input type="hidden" name="bn" value="PP-DonationsBF">
	              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>';

	  return;
	}
*/



	////////////////////////////////////////////////////////////////////////////////
	// show practice page
	////////////////////////////////////////////////////////////////////////////////
/*	function bbnuke_plugin_print_practice_page( $edit_practice = false )
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


	echo '
	<div class="wrap">
	  <a name="Top"></a>
	  <div class="bbnuke-icon32"></div>
	  <h2>baseballNuke Plugin  -  Practice Settings</h2>
	  <hr />
	  <div class="clear"></div>
	  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
	    <div class="postbox-container" id="bbnuke-plugin-main">
	      <div class="has-sidebar-content">
	        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
	          <div class="postbox ui-droppable" id="bbnuke-practice-edit">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Practice Edit', 'bbnuke') . '</h3>
	            <div class="inside">
	              <b>Add, Edit or delete a Practice</b>
	              <p>
	               '. __('Select a season  - edit the practice or add a new entry.', 'bbnuke').' 
	              </p>
	              <form name="bbnuke_practice_edit_form" method="post" action="">';

	  wp_nonce_field('bbnuke_practice_edit');

	echo '
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_select_season">Select season:</label></th>
	                  <td><select size="1" id="bbnuke_practice_edit_select_season_id" name="bbnuke_practice_edit_select_season">';

	  for ( $i=0; $i < count($seasons_list); $i++ )
	  {
	    if ( $seasons_list[$i] == $season )
	    echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	    else
	    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	  }

	echo '
	                    </select>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td><hr /></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_gdate">Date</label></th>
	                  <td><input type="text" name="bbnuke_practice_edit_gdate" value="' . $gdate . '" />&nbsp;(In the form: "YYYY-MM-DD")</td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_gtime">Time</label></th>
	                  <td><input type="text" name="bbnuke_practice_edit_gtime" value="' . $gtime . '" />&nbsp;(In the form: "HH:MM:SS")</td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_field_select">Field</label></th>
	                  <td><select size="1" id="bbnuke_practice_edit_field_select_id" name="bbnuke_practice_edit_field_select">';

	  reset($fields_list);
	  for ( $i=0; $i < count($fields_list); $i++ )
	  {
	    if ( $fields_list[$i]['fieldname'] == $field )
	    echo '<option selected="selected" value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>';
	    else
	    echo '<option value="' . $fields_list[$i]['fieldname'] . '">' . $fields_list[$i]['fieldname'] . '</option>';
	  }

	echo '
	                    </select>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_notes">Notes</label></th>
	                  <td><input type="text" name="bbnuke_practice_edit_notes" value="' . $notes . '" /></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td>';

	  if ( $edit_practise === true )
	  echo '                    <input type="hidden" value="' . $game_id . '" name="bbnuke_game_delete_id" />';
	  else
	  echo '                    <input type="hidden" value="none" name="bbnuke_game_delete_id" />';

	echo '
	                  </td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="div-wait" id="divwaitedp0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                <input type="submit" class="button-secondary" value="Save Changes" id="bbnuke_save_practice_btn_id" name="bbnuke_save_practice_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;';

	  if ( $edit_practise === true )
	  {
	  echo '
	                  <div class="div-wait" id="divwaitedp1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                  <input type="submit" class="button-primary" value="Delete Practice" id="bbnuke_delete_practice_' . $game_id . '_btn_id" name="bbnuke_delete_practice_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />';
	  }

	echo '
	              </div>
	              </form>
	            </div>
	          </div>
	          <div class="postbox ui-droppable" id="bbnuke-upload-practice">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Upload Practice for season ' . $season, 'bbnuke') . '</h3>
	            <div class="inside">
	              <p>
	               '. __('Choose a file to upload in the form: ', 'bbnuke').'
	               '. __('gameDate,gameTime,field,note.', 'bbnuke').'
	              </p>
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="">File</label></th>
	                  <td>
	                    <form enctype="multipart/form-data" method="POST" action="">
	                      <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
	                      <input name="bbnuke_practice_uploadedfile" type="file" /><br />
	                      <input type="submit" name="bbnuke_practice_file_upload_btn" value="Upload" />
	                    </form>
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td></td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
	              </div>
	            </div>
	          </div>
	          <div class="postbox ui-droppable" id="bbnuke-practice-list">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Practice List', 'bbnuke') . '</h3>
	            <div class="inside">
	              <p>
	               '. __('Select a practice for edit.', 'bbnuke').' 
	              </p>
	              <form name="bbnuke_practice_list_form" method="post" action="">';

	  wp_nonce_field('bbnuke_practice_list');

	echo '
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_practice_edit_select_season">Select season:</label></th>
	                  <td><select size="1" id="bbnuke_practice_edit_select_season_id" name="bbnuke_practice_edit_select_season">';

	  for ( $i=0; $i < count($seasons_list); $i++ )
	  {
	    if ( $seasons_list[$i] == $season )
	    echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	    else
	    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
	  }

	echo '
	                    </select><br /><br />
	                    <div class="div-wait" id="divwaitpl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_practices_list_set_season_btn_id" name="bbnuke_practices_list_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td><hr /></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="">Total Practices:</label></th>
	                  <td>' . count($practice_list) . '&nbsp;&nbsp;
	                    <div class="div-wait" id="divwaitpl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                    <input type="submit" class="button-primary" value="Delete all practices" id="bbnuke_del_all_practice_btn_id" name="bbnuke_del_all_practice_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
	                  </td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_list_practice">Existing Practices:</label></th>
	                  <td><ul class="practice-list">';

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
	  echo '
	                         <li class="practice-list-entry">
	                           <label for="bbnuke_practice_' . $i . '" class="practice-list-entry-label">' . $hteam . ' ' . $vteam . ' on ' . $gdate . ' at ' . $gtime . ' @ ' . $field . '&nbsp;' . $notes . '&nbsp;</label>
	                           <div class="div-wait" id="divwaitpl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
	                           <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_practice_' . $game_id . '_btn_id" name="bbnuke_edit_practice_' . $game_id . '_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;&nbsp;
	                         </li>';
	  }

	echo '
	                      </ul></td>
	              </tr>
	              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
	                  <td></td>
	              </tr>
	              </table>
	              <div class="submit-bottom-div">
	                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
	              </div>
	              </form>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
	    <div class="postbox-container" id="bbnuke-plugin-news">
	      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">
	        <div class="postbox ui-droppable" id="bbnuke_info">
	          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>
	          <div class="inside">
	            <!-- Facebook Badge START -->
	            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>
	            <!-- Facebook Badge END -->
	          </div>
	        </div>
	        <div class="postbox ui-droppable" id="bbnuke_links">
	          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	          <h3 class="hndle">Donations</h3>
	          <div class="inside">
	            <p>Help support the Flying Dogs by making a donation!</p>
	            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
	              <input type="hidden" name="cmd" value="_xclick">
	              <input type="hidden" name="business" value="manager@frederickcardinals.com">
	              <input type="hidden" name="item_name" value="Flying Dogs Donation">
	              <input type="hidden" name="item_number" value="2007donation">
	              <input type="hidden" name="no_shipping" value="0">
	              <input type="hidden" name="no_note" value="1">
	              <input type="hidden" name="currency_code" value="USD">
	              <input type="hidden" name="tax" value="0">
	              <input type="hidden" name="lc" value="US">
	              <input type="hidden" name="bn" value="PP-DonationsBF">
	              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>';

	  return;
	}
*/


	////////////////////////////////////////////////////////////////////////////////
	// show game result page
	////////////////////////////////////////////////////////////////////////////////
	function bbnuke_plugin_print_game_results_page( $edit_results = false )
	{
	  global $wpdb;

	  $options = get_option('bbnuke_plugin_options');

	  $ret_flag = NULL;

          $season           = bbnuke_get_option('bbnuke_results_season');
	  $fields_list      = bbnuke_get_locations();
	  $seasons_list     = bbnuke_get_seasons();
          $team_list    = bbnuke_get_teams($season);
	  $def              = bbnuke_get_defaults();
	  $hometeam         = $def['defaultTeam'];
	  $games_list       = bbnuke_get_past_games($season);

	  if ( $edit_results === true )
	  {
	    $game_id     = bbnuke_get_option('bbnuke_game_edit_id');
	    $gresults    = bbnuke_get_game_results($game_id);
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

	    if ( !$gresults )
	    {
	      $homeplayers = bbnuke_get_players_from_team( $hteam, $season);
	      if (!$homeplayers)
		$ret_flag = -1;
              $visitplayers = bbnuke_get_players_from_team( $vteam, $season);
              if (!$visitplayers)
                $ret_flag = -1;
	    }

	    $presults    = bbnuke_get_game_results_all($game_id, $season);
	    if (!$presults)
	    {
              $homeplayers = bbnuke_get_players_from_team( $hteam, $season);
              if (!$homeplayers)
                $ret_flag = -1;
              $visitplayers = bbnuke_get_players_from_team( $vteam, $season);
              if (!$visitplayers)
                $ret_flag = -1;
	    }
	    
	    if ($vteam == $hometeam)
		{
		$HomeAway = 'away';
		}
	    else{
		$HomeAway = 'home';
		}
	  }


	echo '
	<div class="wrap">
	  <a name="Top"></a>
	  <div class="bbnuke-icon32"></div>
	  <h2>baseballNuke Plugin  -  Game Results Page</h2>
	  <hr />
	  <div class="clear"></div>
	  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
	    <div class="postbox-container" id="bbnuke-plugin-main">
	      <div class="has-sidebar-content">
	        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
	          <div class="postbox ui-droppable" id="bbnuke-results-edit">
	            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
	            <h3 class="hndle">' . __('Game Results Edit', 'bbnuke') . '</h3>
	            <div class="inside">';

	  if ( $edit_results === true )
	  echo '              <b>Edit Results for game:</b>&nbsp;&nbsp; ' . $vteam . ' v. ' . $hteam . '</b>';
	  else
	  {
	  echo '              <b>Edit Results</b>
	                <p>
	                 '. __('Select a season  - edit the game results and save them.', 'bbnuke').'
	                </p>';
	  }

	echo '
	              <form name="bbnuke_results_edit_form" method="post" action="">';

	  wp_nonce_field('bbnuke_results_edit');

	echo '
	              <table class="form-table">
	              <tr><th class="bbnuke_option_left_part"><label for="">Box Score</label></th>
	                  <td>
	                  </td>
	              </tr>
	              </table>';

	  if ( $edit_results === true )
	  {
	    list($gameID,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$vhits,$vruns,$verr,$hhits,$hruns,$herr,$content,$postID,$gameStatus) = $gresults[0];
	  echo '
	             <table width="75%" border="1" class="gresults-form-table">
		    <tr>
		    <td width="13%"></td>';
	    for ($i=1; $i <= 9; $i++)
	    echo '
	    		              <td width="5%" align="center">' . $i . '</td>';

	  echo '
	  		              <td width="5%" align="center">R</td>
				      <td width="5%" align="center">H</td>
				      <td width="5%" align="center">E</td>
				  </tr>
				  <tr>
				    <td width="13%">' . $vteam . '</td>';

	  echo 
	    "	            <td width=5%>
				<input type=text name=v1 class='v_inning' size=2 value=".$v1.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v2 class='v_inning' size=2 value=".$v2.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v3 class='v_inning' size=2 value=".$v3.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v4 class='v_inning'size=2 value=".$v4.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v5 class='v_inning' size=2 value=".$v5.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v6 class='v_inning' size=2 value=".$v6.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v7 class='v_inning'  size=2 value=".$v7.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v8 class='v_inning' size=2 value=".$v8.">
				      </font></td>
				    <td width=5%>
					<input type=text name=v9 class='v_inning'size=2 value=".$v9.">
				      </font></td>
				    <td width=5%>
					<input type=text name=vruns size=2 id='vruns_total' value=".$vruns.">
				      </font></td>
				    <td width=5%>
					<input type=text name=vhits size=2 id='vhits_total' value=".$vhits.">
				      </font></td>
				    <td width=5%>
					<input type=text name=verr size=2 id='verr_total' value=".$verr.">
				      </font></td>
				  </tr>
				  <tr>
				    <td width=13%>$hteam</font></td>
				    <td width=5%>
					<input type=text name=h1 class='h_inning' size=2 value=".$h1.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h2 class='h_inning' size=2 value=".$h2.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h3 class='h_inning' size=2 value=".$h3.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h4 class='h_inning' size=2 value=".$h4.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h5 class='h_inning' size=2 value=".$h5.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h6 class='h_inning' size=2 value=".$h6.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h7 class='h_inning' size=2 value=".$h7.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h8 class='h_inning' size=2 value=".$h8.">
				      </font></td>
				    <td width=5%>
					<input type=text name=h9 class='h_inning' size=2 value=".$h9.">
				      </font></td>
				    <td width=5%>
					<input type=text name=hruns size=2 id='hruns_total' value=".$hruns.">
				      </font></td>
				    <td width=5%>
					<input type=text name=hhits size=2 id='hhits_total' value=".$hhits.">
				      </font></td>
				    <td width=5%>
					<input type=text name=herr size=2 id='herr_total' value=".$herr.">
				      </font></td>
				  </tr>
				</td>
			      </table>
		     <div class='game-results-table'>
		     Game status  <select name='bbnuke_game_status' id='bbnuke_game_status'>";
$statusOptions = array("Complete", "Suspended", "Postponed", "Cancelled");
  for ( $i=0; $i < count($statusOptions); $i++ )
  {
    if ( $statusOptions[$i] == $gameStatus )
    echo '<option selected="selected" value="' . $statusOptions[$i] . '">' . $statusOptions[$i] . '</option>';
    else
    echo '<option value="' . $statusOptions[$i] . '">' . $statusOptions[$i] . '</option>';
  }	
		echo '
		     </select><br />
		     Attach post to game results? 
		     <input type="checkbox" name="bbnuke_include_post" id="bbnuke_include_post" /> <br />
		     <div id="bbnuke_select_post" style="display:none">
		     Select post title: &nbsp;';
		     bbnuke_display_post_selectbox();
		  echo ' 
		     </div>
		     </div>
		     <div>&nbsp;</div>
		     <div class="game-results-table">
			 <div class="tabs">
			   <a class="tab" onclick=showTab("#Offense")>Offense</a>
			   <a class="tab" onclick=showTab("#Pitching")>Pitching</a>
			   <a class="tab" onclick=showTab("#Fielding")>Fielding</a>
			   <hr>
			 </div>
		     <div>&nbsp;</div>
			 
		     <div id="Offense" class="tabContent" style="display:block">         
		       <div class="game-results-table"><h3>'.$hteam.'</h3></div>
			      <table id=home_team_offense_results class=gresults-form-table>
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
                                    <th align=center>SF</th>
				</tr>';
	    //Lookup players
	    if ( $presults )
	      $count_off_h = count($presults);
	    else
	      $count_off_h = count($homeplayers);

	    for ($m=0; $m < $count_off_h; $m++)
	    {
	      if ( $presults )
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE,$baSF) = $presults[$m];
	      else
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname) = $homeplayers[$m];
	      if ( $teamname == $hteam )
	      {

	echo '                    <tr>
				    <td class="playername_offense">' . $lastname . ', ' . $firstname . ' ' . $middlename . '
                                      <input type=hidden id="playerID_for_'.$lastname.'_'.$firstname.'" value="'.$PLAYERID.'">
				    </td>
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
				      <input type="text" name="' . $PLAYERID . '_ba1b" class="classBA" size="1" value="' . $ba1b . '">
				    </td>
				    <td>
				      <input type="text" name="' . $PLAYERID . '_ba2b" class="classBA" size="1" value="' . $ba2b . '">
				    </td>
				    <td>
				      <input type="text" name="' . $PLAYERID . '_ba3b" class="classBA"" size="1" value="' . $ba3b . '">
				    </td>
				    <td>
				      <input type="text" name="' . $PLAYERID . '_baHR" class="classBA" size="1" value="' . $baHR . '">
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
                                    <td>
                                      <input type="text" name="' . $PLAYERID . '_baSF" size="1" value="' . $baSF . '">
                                    </td>
				  </tr>'."\n";
              }
      }
         echo ' </table>
		       <div><br>&nbsp;<br></div>
                       <div class="game-results-table"><h3>'.$vteam.'</h3></div>
                              <table id=visit_team_offense_results class=gresults-form-table>
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
                                    <th align=center>SF</th>
                                </tr>';

           if ( $presults )
              $count_off_v = count($presults);
            else
              $count_off_v = count($visitplayers);

	    for ($n=0; $n < $count_off_v; $n++)
	    {
	      if ( $presults )
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE,$baSF) = $presults[$n];
	      else
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname) = $visitplayers[$n];
	      if ( $teamname == $vteam )
	      {

	echo '                    <tr>
				    <td class="playername_offense">' . $lastname . ', ' . $firstname . ' ' . $middlename . '
                                      <input type=hidden id="playerID_for_'.$lastname.'_'.$firstname.'" value="'.$PLAYERID.'">
				    </td>
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
				      <input type="text" name="' . $PLAYERID . '_ba1b" class="classBA" size="1" value="' . $ba1b . '">
				    </td>
				    <td>
				      <input type="text" name="' . $PLAYERID . '_ba2b" class="classBA" size="1" value="' . $ba2b . '">
				    </td>
				    <td>
				      <input type="text" name="' . $PLAYERID . '_ba3b" class="classBA"" size="1" value="' . $ba3b . '">
				    </td>
				    <td>
				      <input type="text" name="' . $PLAYERID . '_baHR" class="classBA" size="1" value="' . $baHR . '">
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
                                    <td>
                                      <input type="text" name="' . $PLAYERID . '_baSF" size="1" value="' . $baSF . '">
                                    </td>
				  </tr>'."\n";
              }

	}

	 echo ' </table></div>
			  <div id="Pitching" class="tabContent" style="display:none">
                       <div class="game-results-table"><h3>'.$hteam.'</h3></div>
			       <table id=home_team_pitch_results class=gresults-form-table>
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
				</tr>';
	    //Lookup players
            if ( $presults )
              $count_pit_h = count($presults);
            else
              $count_pit_h = count($homeplayers);

            for ($m=0; $m < $count_pit_h; $m++)
            {
              if ( $presults )
                list($PLAYERID,$firstname,$middlename,$lastname,$teamname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE) = $presults[$m];
              else
                list($PLAYERID,$firstname,$middlename,$lastname,$teamname) = $homeplayers[$m];

              if ( $teamname == $hteam )
              {

	echo '                    <tr>
				     <td class="playername_pitching">' . $lastname . ', ' . $firstname . ' ' . $middlename . '
                                        <input type=hidden id="playerID_for_'.$lastname.'_'.$firstname.'" value="'.$PLAYERID.'">
			     	     </td>
				     <td>
				       <input type="text" name="' . $PLAYERID . '_pitchOrd" size="1" value="' . $pitchOrd . '">
				     </td>
				     <td>  <b>
				       <input type="checkbox" name="' . $PLAYERID . '_piWin" value="1" ';

	       if($piWin){
				 echo ' checked="checked" ';
	       }

	     echo '
	      >
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
				       <input type="text" name="' . $PLAYERID . '_piHits" class="classPI" size="1" value="'.$piHits.'" >
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
				  </tr>';
              }
	}

	 echo ' </table>
                       <div><br>&nbsp;<br></div>
                       <div class="game-results-table"><h3>'.$vteam.'</h3></div>
			       <table id=visit_team_pitch_results class=gresults-form-table>
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
				</tr>';
	    //Lookup players
	    if ( $presults )
	      $count_pit_v = count($presults);
	    else
	      $count_pit_v = count($visitplayers);

	    for ($m=0; $m < $count_pit_v; $m++)
	    {
	      if ( $presults )
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE) = $presults[$m];
	      else
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname) = $visitplayers[$m];

              if ( $teamname == $vteam )
              {

	echo '                    <tr>
				     <td class="playername_pitching">' . $lastname . ', ' . $firstname . ' ' . $middlename . '
                                        <input type=hidden id="playerID_for_'.$lastname.'_'.$firstname.'" value="'.$PLAYERID.'">
			     	     </td>
				     <td>
				       <input type="text" name="' . $PLAYERID . '_pitchOrd" size="1" value="' . $pitchOrd . '">
				     </td>
				     <td>  <b>
				       <input type="checkbox" name="' . $PLAYERID . '_piWin" value="1" ';

	       if($piWin){
				 echo ' checked="checked" ';
	       }

	     echo '
	      >
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
				       <input type="text" name="' . $PLAYERID . '_piHits" class="classPI" size="1" value="'.$piHits.'" >
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
				  </tr>';
              }
	}

        echo ' </table></div> 
			  <div id="Fielding" class="tabContent" style="display:none">
                       <div class="game-results-table"><h3>'.$hteam.'</h3></div>
                                 <table id=visit_team_field_results class=gresults-form-table>
                                   <tr>
                                     <th width=150px>&nbsp;</th>
                                     <th align=center>PO</th>
                                     <th align=center>A</th>
                                     <th align=center>E</th>
                                </tr>';
            //Lookup players
            if ( $presults )
              $count_fld_h = count($presults);
            else
              $count_fld_h = count($homeplayers);

            for ($m=0; $m < $count_fld_h; $m++)
            {
              if ( $presults )
                list($PLAYERID,$firstname,$middlename,$lastname,$teamname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE) = $presults[$m];
              else
                list($PLAYERID,$firstname,$middlename,$lastname,$teamname) = $homeplayers[$m];

              if ( $teamname == $hteam )
              {

        echo '                    <tr>
                                     <td class="playername_fielding">' . $lastname . ', ' . $firstname . ' ' . $middlename . '
                                        <input type=hidden id="playerID_for_'.$lastname.'_'.$firstname.'" value="'.$PLAYERID.'">
                                        </td>
                                     <td>
                                       <input type="text" name="' . $PLAYERID . '_fiPO" size="1" value="' . $fiPO . '">
                                       </td>
                                     <td>
                                       <input type="text" name="' . $PLAYERID . '_fiA" size="1" value="' . $fiA . '">
                                       </td>
                                     <td>
                                       <input type="text" name="' . $PLAYERID . '_fiE" size="1" value="' . $fiE . '">
                                       </td>
                                  </tr>';
	     }
        }
         echo '</table>
                       <div><br>&nbsp;<br></div>
                       <div class="game-results-table"><h3>'.$vteam.'</h3></div>
				 <table id=visit_team_field_results class=gresults-form-table>
				   <tr>
				     <th width=150px>&nbsp;</th>
				     <th align=center>PO</th>
				     <th align=center>A</th>
				     <th align=center>E</th>
				</tr>';
	    //Lookup players
	    if ( $presults )
	      $count_fld_v = count($presults);
	    else
	      $count_fld_v = count($visitplayers);

	    for ($m=0; $m < $count_fld_v; $m++)
	    {
	      if ( $presults )
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE,$baFC,$baHP,$baLOB,$fiPO,$fiA,$fiE) = $presults[$m];
	      else
		list($PLAYERID,$firstname,$middlename,$lastname,$teamname) = $visitplayers[$m];

              if ( $teamname == $vteam )
              {

	echo '                    <tr>
				     <td class="playername_fielding">' . $lastname . ', ' . $firstname . ' ' . $middlename . '
					<input type=hidden id="playerID_for_'.$lastname.'_'.$firstname.'" value="'.$PLAYERID.'">
					</td>
				     <td>
				       <input type="text" name="' . $PLAYERID . '_fiPO" size="1" value="' . $fiPO . '">
				       </td>
				     <td>
				       <input type="text" name="' . $PLAYERID . '_fiA" size="1" value="' . $fiA . '">
				       </td>
				     <td>
				       <input type="text" name="' . $PLAYERID . '_fiE" size="1" value="' . $fiE . '">
				       </td>
				  </tr>';
	       }
	}
	 echo '</table> </div>

			  <table class="form-table">
			  <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
			      <td>
			    <div class="div-wait" id="divwaitedgr0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
			    <input type="submit" class="button-secondary" value="Update" id="bbnuke_save_results_btn_id" name="bbnuke_save_results_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" />&nbsp;
			      </td><br><br>
			  </tr>
			  </table>
			  </form>
<div id=spinnerdisplay>
<div id=game-results-dump></div>
<div id=hiddendump style="display:none"> </div>
</div>';

/////////////////////////////////////////////////
//  Import Stats
/////////////////////////////////////////////////

echo '
			  <hr>
			  <div class="game-results-table"><h3>Import Game Stats From File</h3></div>
			  <table class="form-table">';
////////////////////////////////////////////////
/* Import stats from gamechanger, depricated in release 1.2
			  <tr>
			    <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_gamechanger_import">Retrieve GameChanger Results</label></th>
		    <td><input type=hidden id="tbl_home_or_away" value= ' . $HomeAway . '></td>
                    <td width=150><input type="text" name="bbnuke_plugin_gamechanger_import" id="bbnuke_plugin_gamechanger_import"/><br>
			<i>GameChanger Game ID</i></td>
                    <td align=left valign=top class=gamechanger_import_status> <input type="button" class="button-secondary" value="Retrieve" id="bbnuke_retrieve_gamechanger_results_btn_id" name="bbnuke_retrieve_gamechanger_results_btn" />&nbsp;</td>
                </tr> 
*/
echo '
                  <tr>
                    <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_stats_upload">Upload All Stats</label></th>
		    <form enctype="multipart/form-data" method="POST" action="">
		    <td><input type="hidden" name="MAX_FILE_SIZE" value="100000"/></td>
		    <td><input type="radio" name="bbnuke_home_or_away" value="'.$vteam.'" /><label>'.$vteam.'</label><br>
			<input type="radio" name="bbnuke_home_or_away" value="'.$hteam.'" /><label>'.$hteam.'</label>
		    </td>
                    <td width=150><input type="file" name="bbnuke_plugin_stats_upload_file" id="bbnuke_plugin_stats_upload_file"/><br>
                        <i>CSV file in the following</i>
			<a href="#TB_inline?height=300&width=300&inlineId=bbnuke_stat_format_popup" class="thickbox"> format</a>
		    </td>
                    <td align=left valign=top> <input type="submit" value="Upload" id="bbnuke_stats_upload_btn_id" name="bbnuke_stats_upload_btn" /></td>
		    </form>
                  </tr>
                  <tr>
                    <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_iScore_batting_upload">Upload Batting Stats</label></th>
		    <form enctype="multipart/form-data" method="POST" action="">
                    <td><input type="hidden" name="MAX_FILE_SIZE" value="100000"/></td>
                    <td><input type="radio" name="'.$vteam.'" value="'.$vteam.'"><label>'.$vteam.'</label><br>
                        <input type="radio" name="'.$hteam.'" value="'.$hteam.'"><label>'.$hteam.'</label>
                    </td>
                    <td width=150><input type="file" name="bbnuke_plugin_iScore_batting_upload" id="bbnuke_plugin_iScore_batting_upload"/><br>
                        <i>iScore Batting Stats CSV File</i></td>
                    <td align=left valign=top> <input type="submit" value="Upload" id="bbnuke_iScore_batting_upload_btn_id" name="bbnuke_iScore_batting_upload_btn" /></td>
		    </form>
                  </tr>
                  <tr>
                    <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_iScore_pitching_upload">Upload Pitching Stats</label></th>
                    <form enctype="multipart/form-data" method="POST" action="">
		    <td><input type="hidden" name="MAX_FILE_SIZE" value="100000"/></td>
                    <td><input type="radio" name="'.$vteam.'" value="'.$vteam.'"><label>'.$vteam.'</label><br>
                        <input type="radio" name="'.$hteam.'" value="'.$hteam.'"><label>'.$hteam.'</label>
                    </td>
		    <td width=150><input type="file" name="bbnuke_plugin_iScore_pitching_upload" id="bbnuke_plugin_iScore_pitching_upload"/><br>
                        <i>iScore Pitching Stats CSV File</i></td>
                    <td align=left valign=top> <input type="submit" value="Upload" id="bbnuke_iScore_pitching_upload_btn_id" name="bbnuke_iScore_pitching_upload_btn" /></td>
		    </form>
                </tr>
                </table>
		</div>';

/////////////////////////////////////////////////
//  File format popup thickbox
////////////////////////////////////////////////
echo '
<div id="bbnuke_stat_format_popup" style="display:none">
<h2>Stats Import CSV File Format</h2>
<div>
<b>Use the following as a template for your CSV header</b><hr>
jersey#,battOrd,baAB,ba1b,ba2b,ba3b,baHR,baRBI,baBB,
baK,baSB,baRuns,baRE,baFC,baHP,baLOB,baSF,pitchOrd,
piWin,piLose,piSave,piIP,piHits,piRuns,piER,piWalks,piSO,
fiPO,fiA,fiE
<br>&nbsp;<br>
<b>ba</b> = batting or offensive statistic<br>
<b>pi</b> = pitching statistic<br>
<b>fi</b> = fielding or defensive statistic<br>
</div>
<br>&nbsp;<br>
<strong>Just click outside the pop-up to close it.</strong>
</div>
';
		
  }
echo '
              <div class="submit-bottom-div">
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
              </div>
              </form>
            </div>
          </div>
          <div class="postbox ui-droppable" id="bbnuke-games-list">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Past Games List', 'bbnuke') . '</h3>
            <div class="inside">
              <p>
               '. __('Select a game for edit.', 'bbnuke').'
              </p>
              <form name="bbnuke_results_list_form" method="post" action="">';

  wp_nonce_field('bbnuke_results_list');

echo '
              <table class="form-table">
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_results_list_select_season">Select season:</label></th>
                  <td><select size="1" id="bbnuke_results_list_select_season_id" name="bbnuke_results_list_select_season">';

  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $season )
    echo '<option selected="selected" value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
  }

echo '
                    </select><br><br>
                    <div class="div-wait" id="divwaitrl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                    <input type="submit" class="button-primary" value="Set season" id="bbnuke_results_list_set_season_btn_id" name="bbnuke_results_list_set_season_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td><hr /></td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="">Total Games:</label></th>
                  <td>' . count($games_list) . '&nbsp;&nbsp;
                    <div class="div-wait" id="divwaitpl0"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for="bbnuke_results_edit_game_select">Select a game to update</label></th>
                  <td><select size="1" id="bbnuke_results_edit_game_select_id" name="bbnuke_results_edit_game_select">';

  reset($games_list);
  for ( $i=0; $i < count($games_list); $i++ )
  {
    $game_id = $games_list[$i]['gameID'];
    $hteam   = $games_list[$i]['homeTeam'];
    $vteam   = $games_list[$i]['visitingTeam'];
    $gdate   = $games_list[$i]['gameDate'];
    $gtime   = $games_list[$i]['gameTime'];
  echo '<option value="' . $game_id . '">' . $hteam . ' v. ' . $vteam . ' (' . $gdate . ' ' . $gtime . ')</option>';
  }

echo '
                    </select>
                    <div class="div-wait" id="divwaitgl1"><img src="' . BBNPURL . 'img/loading.gif" /></div>
                    <input type="submit" class="button-primary" value="Edit" id="bbnuke_edit_game_btn_id" name="bbnuke_edit_game_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
                  </td>
              </tr>
              <tr><th class="bbnuke_option_left_part"><label for=""></label></th>
                  <td></td>
              </tr>
              </table>
              <div class="submit-bottom-div">
                <div class="right-bottom"><a href="#Top">Back to Top</a></div>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="postbox-container" id="bbnuke-plugin-news">
      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">
        <div class="postbox ui-droppable" id="bbnuke_info">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>
          <div class="inside">
            <!-- Facebook Badge START -->
            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>
            <!-- Facebook Badge END -->
          </div>
        </div>
        <div class="postbox ui-droppable" id="bbnuke_links">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Donations</h3>
          <div class="inside">
            <p>Help support the Flying Dogs by making a donation!</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="manager@frederickcardinals.com">
              <input type="hidden" name="item_name" value="Flying Dogs Donation">
              <input type="hidden" name="item_number" value="2007donation">
              <input type="hidden" name="no_shipping" value="0">
              <input type="hidden" name="no_note" value="1">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="tax" value="0">
              <input type="hidden" name="lc" value="US">
              <input type="hidden" name="bn" value="PP-DonationsBF">
              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';

  return $ret_flag;
}


////////////////////////////////////////////////////////////////////////////////
// show import page
////////////////////////////////////////////////////////////////////////////////
/*
function bbnuke_plugin_print_import_page()
{
  global $wpdb;
$ret_flag = NULL;
  $options = get_option('bbnuke_plugin_options');


 echo '

  <div class="wrap">
    <a name="Top"></a>
    <div class="bbnuke-icon32"></div>
    <h2>baseballNuke Plugin  -  Import CSV</h2>
    <hr />
    <div class="clear"></div>
    <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
      <div class="postbox-container" id="bbnuke-plugin-main">
        <div class="has-sidebar-content">
          <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
            <div class="postbox ui-droppable" id="bbnuke-fields-edit">
              <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
              <h3 class="hndle">' . __('Import CSV', 'bbnuke') . '</h3>
              <div class="inside">
                <b>Import</b>
                <p>
                 '. __('Import Stuff.', 'bbnuke') . '
                </p>
                <form id="importcsvform" enctype="multipart/form-data" method="POST" action="">
                <table class="form-table">
                  <tr>
		    <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_upload_type">Data Type</label></th>
		    <td><input type="radio" name="bbnuke_plugin_upload_schedule"/><label>Schedule</><br>
		      <input type="radio" name="bbnuke_plugin_upload_players"/><label>Players</><br>
		      <input type="radio" name="bbnuke_plugin_upload_teams"/><label>Teams</><br>
		      <input type="radio" name="bbnuke_plugin_upload_fields"/><label>Fields</></td>
		  </tr>
		  <tr>
                    <th class="bbnuke_option_left_part"><label for="bbnuke_plugin_test_csv_upload">Upload CSV Test</label></th>
                    <td><input type="hidden" name="MAX_FILE_SIZE" value="100000"/></td>
                    <td width=150><input type="file" name="bbnuke_plugin_test_csv_upload" id="bbnuke_plugin_test_csv_upload"/><br>
                        <i>Test CSV File</i></td>
                    <td align=left valign=top> <input type="button" value="Upload" id="bbnuke_test_csv_upload_btn_id" name="bbnuke_test_csv_upload_btn" /></td>
                  </tr>
                </table>
<div id="CSVSource"></div>
<div id="CSVTable"></div>
<input type="submit" class="button-primary" value="Import Data" id="bbnuke_import_data_btn_id" name="bbnuke_import_data_btn" onclick="document.getElementById(nameofDivWait).style.display=\'inline\';this.form.submit();" /><br />
</form>
                <div class="submit-bottom-div">
                  <div class="right-bottom"><a href="#Top">Back to Top</a></div>
                </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>';

  return $ret_flag;
}
*/

////////////////////////////////////////////////////////////////////////////////
// show uninstall page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_print_uninstall_page()
{
  global $wpdb;

  $options = get_option('bbnuke_plugin_options');

echo '
<div class="wrap">
  <a name="Top"></a>
  <div class="bbnuke-icon32"></div>
  <h2>baseballNuke Plugin  -  Uninstall Warning</h2>
  <hr />
  <div class="clear"></div> 
  <div class="metabox-holder has-right-sidebar" id="plugin-panel-widgets">
    <div class="postbox-container" id="bbnuke-plugin-main">
      <div class="has-sidebar-content">
        <div class="meta-box-sortables ui-sortable" id="normal-sortables" unselectable="on">
          <div class="postbox ui-droppable" id="bbnuke-fields-edit">
            <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
            <h3 class="hndle">' . __('Uninstall Warning', 'bbnuke') . '</h3>
            <div class="inside">
              <b>Uninstall Warning, Data Will be Lost</b>
              <p>
               '. __('Uninstalling BaseballNuke will delete all data that has been entered including schedules, players, locations and game results.  If you would like to delete the plugin but not your data, please uninstall BaseballNuke from the plugins page', 'bbnuke') . '
              </p>
	      <form method=post name=bbnuke_uninstall_form>
              <input type="submit" class="button-primary" value="Uninstall BaseballNuke" id="bbnuke_uninstall_plugin_btn" name="bbnuke_uninstall_plugin_btn" onclick="return confirm("You Are About To Uninstall WP-DBManager From WordPress.\nThis Action Is Not Reversible.\n\n Choose [Cancel] To Stop, [OK] To Uninstall.")">&nbsp;&nbsp;
	      </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="postbox-container" id="bbnuke-plugin-news">
      <div class="meta-box-sortables ui-sortable" id="side-sortables" unselectable="on">
        <div class="postbox ui-droppable" id="bbnuke_info">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Flying Dogs - Facebook Fanpage</h3>
          <div class="inside">
            <!-- Facebook Badge START -->
            <a href="http://www.facebook.com/pages/Frederick-Flying-Dogs/169763578596" title="Frederick Flying Dogs" target="_TOP"><img src="http://badge.facebook.com/badge/169763578596.2461.731360298.png" style="border: 0px;" /></a><br/>
            <!-- Facebook Badge END -->
          </div>
        </div>
        <div class="postbox ui-droppable" id="bbnuke_links">
          <div title="' . __('Zum umschalten klicken', 'bbnuke') . '" class="handlediv"><br /></div>
          <h3 class="hndle">Donations</h3>
          <div class="inside">
            <p>Help support the Flying Dogs by making a donation!</p>
            <form action="https://www.paypal.com/cgi-bin/webscr" method="post">
              <input type="hidden" name="cmd" value="_xclick">
              <input type="hidden" name="business" value="manager@frederickcardinals.com">
              <input type="hidden" name="item_name" value="Flying Dogs Donation">
              <input type="hidden" name="item_number" value="2007donation">
              <input type="hidden" name="no_shipping" value="0">
              <input type="hidden" name="no_note" value="1">
              <input type="hidden" name="currency_code" value="USD">
              <input type="hidden" name="tax" value="0">
              <input type="hidden" name="lc" value="US">
              <input type="hidden" name="bn" value="PP-DonationsBF">
              <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but04.gif" border="0" name="submit" alt="Make payments with PayPal - it\'s fast, free and secure!">
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>';

  return;
}


	$latestVersion="1.2.1";


	function getbnukeVersion(){
		global $prefix,$dbi;
		$sqlString="SELECT version FROM ".$prefix."_baseballNuke_settings WHERE ID=1 LIMIT 1";
                $resultVersion=sql_query($sqlString,$dbi);
                list($version)=sql_fetch_row($resultVersion,$dbi);
		return $version;
	}
?>
