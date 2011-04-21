<?php

global  $wpdb,
        $responses;

function  bbnuke_save_plugin_options()
{
  global $wpdb;

  $team_leaders = $_POST['bbnuke_plugin_option_team_leaders'];
  $erainnings = $_POST['bbnuke_plugin_option_era_innings'];
  $bg_color     = $_POST['bbnuke_plugin_option_bg_color'];
  $hover_color     = $_POST['bbnuke_plugin_option_hover_color'];
  $txt_color    = $_POST['bbnuke_plugin_option_txt_color'];
  $header_bg_color    = $_POST['bbnuke_plugin_option_header_bg_color'];
  $header_txt_color    = $_POST['bbnuke_plugin_option_header_txt_color'];
  $wdg_playerstats_playerid  = $_POST['bbnuke_plugin_option_wdg_playerstats_players_select'];
  $wdg_game_results_playerid = $_POST['bbnuke_plugin_option_wdg_game_results_players_select'];
  $wdg_game_results_gameid   = $_POST['bbnuke_plugin_option_wdg_game_results_games_select'];
  $game_results_page   = $_POST['bbnuke_plugin_option_game_results_page'];
  $player_stats_page   = $_POST['bbnuke_plugin_option_player_stats_page'];
  $locations_page   = $_POST['bbnuke_plugin_option_locations_page'];

  bbnuke_update_option('bbnuke_team_leaders', $team_leaders);
  bbnuke_update_option('bbnuke_era_innings', $erainnings);
  bbnuke_update_option('bbnuke_widget_bg_color', $bg_color);
  bbnuke_update_option('bbnuke_widget_hover_color', $hover_color);
  bbnuke_update_option('bbnuke_widget_txt_color', $txt_color);
  bbnuke_update_option('bbnuke_widget_header_txt_color', $header_txt_color);
  bbnuke_update_option('bbnuke_widget_header_bg_color', $header_bg_color);
  bbnuke_update_option('bbnuke_widget_playerstats_player_id', $wdg_playerstats_playerid);
  bbnuke_update_option('bbnuke_widget_game_results_player_id', $wdg_game_results_playerid);
  bbnuke_update_option('bbnuke_widget_game_results_game_id', $wdg_game_results_gameid);
  bbnuke_update_option('bbnuke_game_results_page', $game_results_page);
  bbnuke_update_option('bbnuke_player_stats_page', $player_stats_page);
  bbnuke_update_option('bbnuke_locations_page', $locations_page);

  return;
}

function  bbnuke_build_heading($SORTBY,$SORTORDER,$titLen,$titLink, $func,$echo = true)
{
  $bbnuke_content = NULL;
  $URI=$_SERVER['REQUEST_URI'];
  $URI=preg_replace('/\&sortby.*/','',$URI);
  foreach($titLen as $heading=>$length)
  {
    $bbnuke_content .= '<th >
         <form id="bbnuke_form" action="" method="post">';
    if($titLink[$heading]=="")
    {
      $bbnuke_content .= $heading;
    }
    elseif($SORTBY==$titLink[$heading] && $SORTORDER=="A")
    {
      $bbnuke_content .= '<input type="submit" name="bbnuke_widget_tb_head_btn" id="bbnuke_input_link" value="'. $heading .'" />';
      $bbnuke_content .= '<input type="hidden" name="bbnuke_widget_tb_head_'.$func.'_sortby" value="'. $titLink[$heading] .'" />';
      $bbnuke_content .= '<input type="hidden" name="bbnuke_widget_tb_head_'.$func.'_sortorder" value="D" />';
    }
    elseif($SORTBY==$titLink[$heading] && ($SORTORDER=="D" || SORTORDER==""))
    {
      $bbnuke_content .= '<input type="submit" name="bbnuke_widget_tb_head_btn" id="bbnuke_input_link" value="'. $heading .'" />';
      $bbnuke_content .= '<input type="hidden" name="bbnuke_widget_tb_head_'.$func.'_sortby" value="'. $titLink[$heading] .'" />';
      $bbnuke_content .= '<input type="hidden" name="bbnuke_widget_tb_head_'.$func.'_sortorder" value="A" />';
    }
    else
    {
      $bbnuke_content .= '<input type="submit" name="bbnuke_widget_tb_head_btn" id="bbnuke_input_link" value="'. $heading .'" />';
      $bbnuke_content .= '<input type="hidden" name="bbnuke_widget_tb_head_'.$func.'_sortby" value="'. $titLink[$heading] .'" />';
      $bbnuke_content .= '<input type="hidden" name="bbnuke_widget_tb_head_'.$func.'_sortorder" value="D" />';
    }
    $bbnuke_content .= '</form></th>';	
  }

  if ( $echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;
}

function  bbnuke_delete_game($game_id)
{
  global $wpdb;

  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_schedule WHERE gameID = $game_id ";
  $result = mysql_query($query);
  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_boxscores WHERE gameID = $game_id ";
  $result = mysql_query($query);
  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_stats WHERE gameID = $game_id ";
  $result = mysql_query($query);

  return;
}


function  bbnuke_delete_all_schedules($season)
{
  global $wpdb;

  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_schedule WHERE DATE_FORMAT(gameDate,'%Y') = '" . $season . "' ";
  $result = mysql_query($query);
  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_boxscores WHERE DATE_FORMAT(gameDate,'%Y') = '" . $season . "' ";
  $result = mysql_query($query);
  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_stats WHERE DATE_FORMAT(gameDate,'%Y') = '" . $season . "' ";
  $result = mysql_query($query);

  return;
}


function  bbnuke_get_past_games($season)
{
  global $wpdb;

  $query = 'SELECT gameID, visitingTeam, homeTeam, gameDate, gameTime FROM ' . $wpdb->prefix . 'baseballNuke_schedule WHERE season = "' . $season . '" AND gameDate <= "' . date("Y-m-d") . '" ORDER BY gameDate desc';
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $games[] = $row;
    }

  return $games;
}


function  bbnuke_get_game_results($game_id)
{
  global $wpdb;

  $query = "SELECT * FROM " . $wpdb->prefix . "baseballNuke_boxscores WHERE gameID=$game_id";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_row($result) )
    {
      $gresults[] = $row;
    }
  else
    return false;

  return $gresults;
}


function  bbnuke_get_players_from_team( $team, $season )
{
  global $wpdb;

  $query = 'SELECT pl.playerID, pl.firstname, pl.middlename, pl.lastname
              FROM ' . $wpdb->prefix . 'baseballNuke_players AS pl
             WHERE teamName = "' . $team . '" AND season = "' . $season . '" ';
  $result = mysql_query($query);
  if ($result)
    if (mysql_num_rows($result))
      while ( $row = mysql_fetch_array($result) )
      {
        $players[] = $row;
      }
    else
      return false;
  else
    return false;

  return $players;
}


function  bbnuke_get_game_player_results($game_id, $season)
{
  global $wpdb;

  $query = "SELECT pl.playerID, pl.firstname, pl.middlename, pl.lastname, 
                   st.battOrd,
                   st.pitchOrd,
                   st.baAB,
                   st.ba1b,
                   st.ba2b,
                   st.ba3b,
                   st.baHR,
                   st.baRBI,
                   st.baBB,
                   st.baK,
                   st.baSB,
                   st.piWin,
                   st.piLose,
                   st.piSave,
                   st.piIP,
                   st.piHits,
                   st.piRuns,
                   st.piER,
                   st.piWalks,
                   st.piSO,
                   st.baRuns,
                   st.baRE,
                   st.baFC,
                   st.baHP,
                   st.baLOB,
                   st.fiPO,
                   st.fiA,
                   st.fiE
            FROM 
           " . $wpdb->prefix . "baseballNuke_players AS pl, 
           " . $wpdb->prefix . "baseballNuke_stats AS st
           WHERE st.gameID=$game_id AND pl.playerID = st.playerID AND 
                 pl.season='$season' ORDER BY pl.lastname";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $gresults[] = $row;
    }

  return $gresults;
}



function  bbnuke_update_game_results()
{
  global $wpdb;

  $game_id = bbnuke_get_option('bbnuke_game_edit_id');
  $season  = bbnuke_get_option('bbnuke_results_season');
  $def      = bbnuke_get_defaults();
  $hometeam = $def['defaultTeam'];

  $error_flag = NULL;

  //  check if entry exists
  $query = 'SELECT * FROM ' . $wpdb->prefix . 'baseballNuke_boxscores WHERE gameID = ' . $game_id . ' ';
  $result = mysql_query($query);
  if (mysql_num_rows($result))
    $new_entry = false;
  else
    $new_entry = true;

  if ($new_entry)
  {
    //  insert game results
    $query = 'INSERT INTO ' . $wpdb->prefix . 'baseballNuke_boxscores SET ';

    for ( $i = 1; $i < 10; $i++ )
    {
      $query .= ' v' . $i . ' = ' . (int)$_POST['v' . $i] . ', ';
      $query .= ' h' . $i . ' = ' . (int)$_POST['h' . $i] . ', ';
    }

    $query .= '  vhits = ' . (int)$_POST['vhits'] . ', ' .
           '  vruns = ' . (int)$_POST['vruns'] . ', ' .
           '  verr  = ' . (int)$_POST['verr'] . ', ' .
           '  hhits = ' . (int)$_POST['hhits'] . ', ' .
           '  hruns = ' . (int)$_POST['hruns'] . ', ' .
           '  herr  = ' . (int)$_POST['herr'] . ', ' .
           '  notes  = "' . $_POST['content'] . '", ' .
           '  gameID = ' . $game_id . ' ';
    $result = mysql_query($query);
    if (mysql_error())
      $error_flag = 1;
  }
  else
  {
    //  update game results
    $query = 'UPDATE ' . $wpdb->prefix . 'baseballNuke_boxscores SET ';

    for ( $i = 1; $i < 10; $i++ )
    {
      $query .= ' v' . $i . ' = ' . (int)$_POST['v' . $i] . ', ';
      $query .= ' h' . $i . ' = ' . (int)$_POST['h' . $i] . ', ';
    }

    $query .= '  vhits = ' . (int)$_POST['vhits'] . ', ' .
           '  vruns = ' . (int)$_POST['vruns'] . ', ' .
           '  verr  = ' . (int)$_POST['verr'] . ', ' .
           '  hhits = ' . (int)$_POST['hhits'] . ', ' .
           '  hruns = ' . (int)$_POST['hruns'] . ', ' .
           '  herr  = ' . (int)$_POST['herr'] . ', ' .
           '  notes = "' . $_POST['content'] . '" ' .
           ' WHERE gameID = ' . $game_id . ' ';
    $result = mysql_query($query);
    if (mysql_error())
      $error_flag = 1;
  }

  //  get players with id's
  $players = bbnuke_get_players_from_team( $hometeam, $season );
  //  check if entries exists
  $presults    = bbnuke_get_game_player_results($game_id, $season);
  if (!$presults)
    $new_entry = true;
  else
    $new_entry = false;

  //  update/insert player game results
  foreach ( $players as $player )
  {
    $player_id = $player['playerID'];

    if ( !isset($_POST[$player_id . '_chkbxDNP']) )
    {
      if (isset($_POST[$player_id . '_piWin']))
        $piWin = 1;
      else
        $piWin = 0;
      if (isset($_POST[$player_id . '_piLose']))
        $piLose = 1;
      else
        $piLose = 0;
      if (isset($_POST[$player_id . '_piSave']))
        $piSave = 1;
      else
        $piSave = 0;
      if ($new_entry)
      {
        $query = 'INSERT INTO ' . $wpdb->prefix . 'baseballNuke_stats SET ' .
               '   battOrd  = ' . (int)$_POST[$player_id . '_battOrd'] . ',
                   pitchOrd = ' . (int)$_POST[$player_id . '_pitchOrd'] . ',
                   baAB     = ' . (int)$_POST[$player_id . '_baAB'] . ',
                   ba1b     = ' . (int)$_POST[$player_id . '_ba1b'] . ',
                   ba2b     = ' . (int)$_POST[$player_id . '_ba2b'] . ',
                   ba3b     = ' . (int)$_POST[$player_id . '_ba3b'] . ',
                   baHR     = ' . (int)$_POST[$player_id . '_baHR'] . ',
                   baRBI    = ' . (int)$_POST[$player_id . '_baRBI'] . ',
                   baBB     = ' . (int)$_POST[$player_id . '_baBB'] . ',
                   baK      = ' . (int)$_POST[$player_id . '_baK'] . ',
                   baSB     = ' . (int)$_POST[$player_id . '_baSB'] . ',
                   piWin    = ' . $piWin . ',
                   piLose   = ' . $piLose . ',
                   piSave   = ' . $piSave . ',
                   piIP     = ' . (float)$_POST[$player_id . '_piIP'] . ',
                   piHits   = ' . (int)$_POST[$player_id . '_piHits'] . ',
                   piRuns   = ' . (int)$_POST[$player_id . '_piRuns'] . ',
                   piER     = ' . (int)$_POST[$player_id . '_piER'] . ',
                   piWalks  = ' . (int)$_POST[$player_id . '_piWalks'] . ',
                   piSO     = ' . (int)$_POST[$player_id . '_piSO'] . ',
                   baRuns   = ' . (int)$_POST[$player_id . '_baRuns'] . ',
                   baRE     = ' . (int)$_POST[$player_id . '_baRE'] . ',
                   baFC     = ' . (int)$_POST[$player_id . '_baFC'] . ',
                   baHP     = ' . (int)$_POST[$player_id . '_baHP'] . ',
                   baLOB    = ' . (int)$_POST[$player_id . '_baLOB'] . ',
                   fiPO     = ' . (int)$_POST[$player_id . '_fiPO'] . ',
                   fiA      = ' . (int)$_POST[$player_id . '_fiA'] . ',
                   fiE      = ' . (int)$_POST[$player_id . '_fiE'] . ',
                   gameID   = ' . $game_id . ',
                   playerID = ' . $player_id . ' ';
       }
       else
       {
        $query = 'UPDATE ' . $wpdb->prefix . 'baseballNuke_stats SET ' .
               '   battOrd  = ' . (int)$_POST[$player_id . '_battOrd'] . ',
                   pitchOrd = ' . (int)$_POST[$player_id . '_pitchOrd'] . ',
                   baAB     = ' . (int)$_POST[$player_id . '_baAB'] . ',
                   ba1b     = ' . (int)$_POST[$player_id . '_ba1b'] . ',
                   ba2b     = ' . (int)$_POST[$player_id . '_ba2b'] . ',
                   ba3b     = ' . (int)$_POST[$player_id . '_ba3b'] . ',
                   baHR     = ' . (int)$_POST[$player_id . '_baHR'] . ',
                   baRBI    = ' . (int)$_POST[$player_id . '_baRBI'] . ',
                   baBB     = ' . (int)$_POST[$player_id . '_baBB'] . ',
                   baK      = ' . (int)$_POST[$player_id . '_baK'] . ',
                   baSB     = ' . (int)$_POST[$player_id . '_baSB'] . ',
                   piWin    = ' . $piWin . ',
                   piLose   = ' . $piLose . ',
                   piSave   = ' . $piSave . ',
                   piIP     = ' . (float)$_POST[$player_id . '_piIP'] . ',
                   piHits   = ' . (int)$_POST[$player_id . '_piHits'] . ',
                   piRuns   = ' . (int)$_POST[$player_id . '_piRuns'] . ',
                   piER     = ' . (int)$_POST[$player_id . '_piER'] . ',
                   piWalks  = ' . (int)$_POST[$player_id . '_piWalks'] . ',
                   piSO     = ' . (int)$_POST[$player_id . '_piSO'] . ',
                   baRuns   = ' . (int)$_POST[$player_id . '_baRuns'] . ',
                   baRE     = ' . (int)$_POST[$player_id . '_baRE'] . ',
                   baFC     = ' . (int)$_POST[$player_id . '_baFC'] . ',
                   baHP     = ' . (int)$_POST[$player_id . '_baHP'] . ',
                   baLOB    = ' . (int)$_POST[$player_id . '_baLOB'] . ',
                   fiPO     = ' . (int)$_POST[$player_id . '_fiPO'] . ',
                   fiA      = ' . (int)$_POST[$player_id . '_fiA'] . ',
                   fiE      = ' . (int)$_POST[$player_id . '_fiE'] . '
             WHERE gameID   = ' . $game_id . ' AND playerID = ' . $player_id . ' ';
       }
      $result = mysql_query($query);
      if (mysql_error())
        $error_flag = 1;
    }
  }

  if ($error_flag)
    return false;
  else 
    return true;
}


function  bbnuke_get_game($game_id)
{
  global $wpdb;

  $query  = "SELECT gameID, visitingTeam, homeTeam, gameDate, gameTime, field, homeScore, visitScore, season FROM " . $wpdb->prefix . "baseballNuke_schedule WHERE gameID = " . $game_id . " ";
  $result = mysql_query($query);
  if ($result)
    $game   = mysql_fetch_array($result);

  return $game;
}


function  bbnuke_get_schedules($season)
{
  global $wpdb;

  $query  = "SELECT gameID, visitingTeam, homeTeam, gameDate, gameTime, field, homeScore, visitScore FROM " . $wpdb->prefix . "baseballNuke_schedule WHERE season= '" . $season . "' ORDER BY gameDate desc ";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $games[] = $row;
    }

  return $games;
}


function  bbnuke_add_schedule()
{
  global $wpdb;

  $season = $_POST['bbnuke_schedules_edit_select_season'];
  $vteam = $_POST['bbnuke_schedules_edit_vteam_select'];
  $hteam = $_POST['bbnuke_schedules_edit_hteam_select'];
  $gdate = $_POST['bbnuke_schedules_edit_gdate'];
  $gtime = $_POST['bbnuke_schedules_edit_gtime'];
  $field = $_POST['bbnuke_schedules_edit_field_select'];

  $query  = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='$vteam', homeTeam='$hteam', gameDate='$gdate', gameTime='$gtime', field='$field', homeScore='$hscore', visitScore='$vscore', season='$season' ";
  $result = mysql_query($query);
  if (mysql_error())
    return false;

  return true;
}



function  bbnuke_update_schedule($game_id)
{
  global $wpdb;

  $season = $_POST['bbnuke_schedules_edit_select_season'];
  $vteam = $_POST['bbnuke_schedules_edit_vteam_select'];
  $hteam = $_POST['bbnuke_schedules_edit_hteam_select'];
  $gdate = $_POST['bbnuke_schedules_edit_gdate'];
  $gtime = $_POST['bbnuke_schedules_edit_gtime'];
  $field = $_POST['bbnuke_schedules_edit_field_select'];

  $query  = "UPDATE " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='$vteam', homeTeam='$hteam', gameDate='$gdate', gameTime='$gtime', field='$field' WHERE gameID=$game_id ";
  $result = mysql_query($query);

  if (mysql_error())
    return false;

  return true;
}



function  bbnuke_upload_schedules($season)
{
  global $wpdb;
  $def      = bbnuke_get_defaults();
  $defaultTeam = $def['defaultTeam'];

  $lines = file($_FILES['bbnuke_schedules_uploadedfile']['tmp_name']);

  foreach ($lines as $line_num => $line) 
  {
    list($visitingTeam, $homeTeam, $gameDate, $gameTime, $field)=explode(",",$line);
   
//Trim unnecessary characters from beginning and end of entries
      
      $visitingTeam = trim($visitingTeam," \t\n\r\x0B\'\"");
      $gameDate = trim($gameDate," \t\n\r\x0B\'\"");
      $gameTime = trim($gameTime," \t\n\r\x0B\'\"");
      $homeTeam = trim($homeTeam," \t\n\r\x0B\'\"");
      $field = str_replace('"', '', $field);
      $field = trim($field," \t\n\x0B\'\"\r");
        #$field = trim($field," \t\n\x0B\'\"");
//Prevent SQL Injection
      	$visitingTeam = mysql_real_escape_string($visitingTeam);
	$gameDate =mysql_real_escape_string($gameDate);
	$gameTime =mysql_real_escape_string($gameTime);
	$homeTeam =mysql_real_escape_string($homeTeam);
	$field = mysql_real_escape_string($field);
//Verify one of the teams playing is the default team
    if (($visitingTeam == $defaultTeam) || ($homeTeam == $defaultTeam)){
    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='$visitingTeam', homeTeam='$homeTeam', gameDate='$gameDate', gameTime='$gameTime',field='$field',season='$season'";
    $result = mysql_query($query);
    if(!$result)
    {
      echo "Failed to add: $visitingTeam vs. $homeTeam on $gameDate at $gameTime at $field ($query)";
    }
    }
  }

  return;
}



function  bbnuke_add_tournament()
{
  global $wpdb;

  $defs = bbnuke_get_defaults();
  $hteam = $defs['defaultTeam'];

  $season = $_POST['bbnuke_tournaments_edit_select_season'];
  $gdate = $_POST['bbnuke_tournaments_edit_gdate'];
  $gtime = $_POST['bbnuke_tournaments_edit_gtime'];
  $field = $_POST['bbnuke_tournaments_edit_field_select'];
  $type  = $_POST['bbnuke_tournaments_edit_type_select'];
  $notes = $_POST['bbnuke_tournaments_edit_notes'];

  $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='tournament',homeTeam='$hteam',gameDate='$gdate',gameTime='$gtime',field='$field',notes='$notes',season='$season' ";
  $result = mysql_query($query);

  if ($result)
    return true;
  else
    return false;
}


function  bbnuke_update_tournament($game_id)
{
  global $wpdb;

  $defs = bbnuke_get_defaults();
  $hteam = $defs['defaultTeam'];

  $gdate = $_POST['bbnuke_tournaments_edit_gdate'];
  $gtime = $_POST['bbnuke_tournaments_edit_gtime'];
  $field = $_POST['bbnuke_tournaments_edit_field_select'];
  $type  = $_POST['bbnuke_tournaments_edit_type_select'];
  $notes = $_POST['bbnuke_tournaments_edit_notes'];

  $query = "UPDATE " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='tournament',homeTeam='$hteam',gameDate='$gdate',gameTime='$gtime',field='$field',notes='$notes' WHERE gameID=$game_id ";
  $result = mysql_query($query);

  if ($result)
    return true;
  else
    return false;
}


function  bbnuke_upload_tournaments()
{
  global $wpdb;

  $lines = file($_FILES['bbnuke_tournaments_uploadedfile']['tmp_name']);
  $def              = bbnuke_get_defaults();
  $hometeam         = $def['defaultTeam'];

  foreach ($lines as $line_num => $line) 
  {
    list($gameDate, $gameTime, $field, $notes)=explode(",",$line);
    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='tournament', homeTeam='$homeTeam', gameDate='$gameDate', gameTime='$gameTime', field='$field', notes='$notes' ";
    $result = mysql_query($query);
    if(!$result)
    {
      echo "Failed to add: $visitingTeam vs. $homeTeam on $gameDate at $gameTime at $field ($query)";
    }
  }

  return;
}



function  bbnuke_get_tournaments($hometeam, $season)
{
  global $wpdb;

  $query  = "SELECT gameID, visitingTeam, homeTeam, gameDate, gameTime, field, Notes FROM " . $wpdb->prefix . "baseballNuke_schedule WHERE DATE_FORMAT(gameDate,'%Y')='$season' AND visitingTeam='tournament' AND homeTeam='$hometeam' ORDER BY gameDate desc ";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $tournaments[] = $row;
    }

  return $tournaments;
}



function  bbnuke_upload_practices()
{
  global $wpdb;

  $lines = file($_FILES['bbnuke_practice_uploadedfile']['tmp_name']);

  foreach ($lines as $line_num => $line) 
  {
    list($visitingTeam, $homeTeam, $gameDate, $gameTime, $field)=explode(",",$line);

    $query  = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='$visitingTeam', homeTeam='$homeTeam', gameDate='$gameDate', gameTime='$gameTime',field='$field'" ;
    $result = mysql_query($query);
  }

  return;
}



function  bbnuke_get_practices($hometeam, $season)
{
  global $wpdb;

  $query  = 'SELECT gameID, gameDate, gameTime, field, notes FROM ' . $wpdb->prefix . 'baseballNuke_schedule WHERE DATE_FORMAT(gameDate,"%Y")= "' . $season . '" AND visitingTeam="practice" AND homeTeam = "' . $hometeam . '" ORDER BY gameDate desc ';
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $games[] = $row;
    }

  return $games;
}


function  bbnuke_update_practice( $game_id )
{
  global $wpdb;

  $defs = bbnuke_get_defaults();
  $hteam = $defs['defaultTeam'];

  $gdate = $_POST['bbnuke_practice_edit_gdate'];
  $gtime = $_POST['bbnuke_practice_edit_gtime'];
  $field = $_POST['bbnuke_practice_edit_field_select'];
  $notes = $_POST['bbnuke_practice_edit_notes'];

  $query = "UPDATE " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='practice',homeTeam='$hteam',gameDate='$gdate',gameTime='$gtime',field='$field',notes='$notes' WHERE gameID=$game_id ";
  $result = mysql_query($query);

  if ($result)
    return true;
  else
    return false;
}



function  bbnuke_add_practice()
{
  global $wpdb;

  $defs = bbnuke_get_defaults();
  $hteam = $defs['defaultTeam'];

  $season = $_POST['bbnuke_practice_edit_select_season'];
  $gdate = $_POST['bbnuke_practice_edit_gdate'];
  $gtime = $_POST['bbnuke_practice_edit_gtime'];
  $field = $_POST['bbnuke_practice_edit_field_select'];
  $notes = $_POST['bbnuke_practice_edit_notes'];

  $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='practice',homeTeam='$hteam',gameDate='$gdate',gameTime='$gtime',field='$field',notes='$notes',season='$season' ";
  $result = mysql_query($query);

  if ($result)
    return true;
  else
    return false;
}


function  bbnuke_delete_all_practices()
{
  global $wpdb;

  $defs = bbnuke_get_defaults();
  $hteam = $defs['defaultTeam'];

  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_schedule WHERE visitingTeam='practice' AND homeTeam = '" . $hteam . "' ";
  $result = mysql_query();
  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_boxscores WHERE visitingTeam='practice' AND homeTeam = '" . $hteam . "' ";
  $result = mysql_query();
  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_stats WHERE visitingTeam='practice' AND homeTeam = '" . $hteam . "' ";
  $result = mysql_query();

  return;
}


function  bbnuke_get_height($inches) 
{
  //divide by 12 to get feet
  $feet = $inches/12;
	 
  //round decimal so we can divide by 100 and use as percent
  $feet = round($feet, 2);
	 
  // separate whole from decimal
  $parts = explode(".", $feet);
  $wholeFeet = $parts[0];
	 
  //turn remaining into percent of 12
  $remainingInches = round(($parts[1]/100)*12);
	 
  $height = $wholeFeet."&#39; ".$remainingInches."&quot;";
	 
  return $height;
}



function  bbnuke_upload_file()
{
  global  $wpdb;

  $lines = file($_FILES['bbnuke_uploadedfile']['tmp_name']);

  $error = 0;
  foreach ($lines as $line_num => $line) 
  {
    list($teamName,$firstname,$middlename,$lastname,
	 $positions,$bats,$throws,$height,$weight,$address,
	 $city,$state,$zip,$homePhone,$workPhone,
	 $cellphone,$jerseyNum,$picLocation,$season,$profile,$email,$school,$bdate)=explode(",",$line);

    $sqlString = "INSERT INTO " . $wpdb->prefix . "baseballNuke_players SET playerID='$playerID',teamName='$teamName',
        											firstname='$firstname',middlename='$middlename',
        											lastname='$lastname',positions='$positions',
        											bats='$bats',throws='$throws',height='$height',weight='$weight',
        											address='$address',city='$city',state='$state',zip='$zip',
        											homePhone='$homePhone',workPhone='$workPhone',
        											cellPhone='$cellPhone',jerseyNum='$jerseyNum',
        											picLocation='$picLocation',season='$season',
        											profile='$profile',email='$email',school='$school',bdate='$bdate'" ;

    $resultAction = mysql_query($sqlString);
    if(!$resultAction)
    {
      echo "Failed to add player: $sqlString<BR>";
      $error = 1;
    }
  }

  return $error;
}




function  bbnuke_get_seasons()
{
  global $wpdb;

  $query = "SELECT DISTINCT(season) FROM " . $wpdb->prefix . "baseballNuke_teams ORDER BY season";

  $result = mysql_query($query);
  if ($result)
    while( $row = mysql_fetch_object($result) )
    {
      $season_list[] = $row->season;
    }
  else
    return false;

  return $season_list;
}


function  bbnuke_get_players_seasons()
{
  global $wpdb;

  $query = "SELECT DISTINCT(season) FROM " . $wpdb->prefix . "baseballNuke_players ORDER BY season";

  $result = mysql_query($query);
  if ($result)
    while( $row = mysql_fetch_object($result) )
    {
      $season_list[] = $row->season;
    }
  else
    return false;

  return $season_list;
}



function  bbnuke_get_teams()
{
  global $wpdb;

  $teams = array();
  $query = "SELECT distinct(teamname) FROM " . $wpdb->prefix . "baseballNuke_teams ORDER BY teamname asc";
  $result = mysql_query($query);
  if ($result)
    while ( $obj = mysql_fetch_object($result) )
    {
      $teams[] = $obj->teamname;
    }

  return $teams;
}

function  bbnuke_get_pages()
{
  global $wpdb;

  $pages = array();
  $query = $wpdb->get_results("SELECT ID, post_status, post_title FROM $wpdb->posts WHERE post_type='page' ORDER BY post_status DESC, menu_order ASC, post_title ASC");
  $result = mysql_query($query);
  if ($result)
    while ( $obj = mysql_fetch_object($result) )
    {
      $pages[] = $obj->pagename;
    }

  return $teams;
}

function  bbnuke_assign_players_team($team, $season, $players_selected)
{
  global $wpdb;
  $players = bbnuke_get_all_players();

  foreach( $players_selected as $indx )
  {
    $firstname   = $players[$indx]['firstname'];
    $middlename  = $players[$indx]['middlename'];
    $lastname    = $players[$indx]['lastname'];
    $profile     = $players[$indx]['profile'];
    $positions   = $players[$indx]['positions'];
    $bats        = $players[$indx]['bats'];
    $throws      = $players[$indx]['throws'];
    $height      = $players[$indx]['height'];
    $weight      = $players[$indx]['weight'];
    $bdate       = $players[$indx]['bdate'];
    $address     = $players[$indx]['address'];
    $city        = $players[$indx]['city'];
    $state       = $players[$indx]['state'];
    $zip         = $players[$indx]['zip'];
    $homephone   = $players[$indx]['homePhone'];
    $cellphone   = $players[$indx]['cellphone'];
    $workphone   = $players[$indx]['workPhone'];
    $jerseynum   = $players[$indx]['jerseyNum'];
    $school      = $players[$indx]['school'];
    $email       = $players[$indx]['email'];
    $piclocation = $players[$indx]['picLocation'];
    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_players SET teamName='$team',
        		firstname='$firstname',middlename='$middlename',
        		lastname='$lastname',positions='$positions',
        		bats='$bats',throws='$throws',height='$height',weight='$weight',
        		address='$address',city='$city',state='$state',zip='$zip',
        		homePhone='$homephone',workPhone='$workphone',
        		cellphone='$cellphone',jerseyNum='$jerseynum',
        		picLocation='$piclocation',season='$season',
        		profile='$profile',email='$email',school='$school',bdate='$bdate'";
    $result = mysql_query($query);
  }

  return;
}


function  bbnuke_get_players($season)
{
  global $wpdb;

  $players = array();

  $query = "SELECT playerID, firstname, middlename, lastname, teamName FROM " . $wpdb->prefix . "baseballNuke_players WHERE season = " . $season . " ORDER BY teamName, lastname,firstname,middlename asc";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_selected_players($player_id)
{
  global $wpdb;

  $players = array();

  $query = "SELECT DISTINCT * FROM " . $wpdb->prefix . "baseballNuke_players WHERE playerID='" . $player_id . "'";

  ## you may want to use the below query instead of the above... this will give you the last record for that player for the last season
  #$query = "SELECT playerID, teamName, firstname, middlename, lastname, positions, bats, throws, height, weight, address, city, state, zip, homePhone, workPhone, cellphone, jerseyNum, picLocation, season, profile, bdate, email, school
  #FROM " . $wpdb->prefix . "baseballNuke_players WHERE playerID='" . $player_id . "' ORDER BY season DESC limit 1";
  
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_all_players()
{
  global $wpdb;

  $players = array();

#  $query = "SELECT DISTINCT lastname,firstname,middlename FROM " . $wpdb->prefix . "baseballNuke_players ORDER BY lastname,firstname,middlename asc";
#  $query = "SELECT playerID, teamName, firstname, middlename, lastname, positions, bats, throws, height, weight, address, city, state, zip, homePhone, workPhone, cellphone, jerseyNum, picLocation, season, profile, bdate, email, school 
  $query = "SELECT * 
  FROM " . $wpdb->prefix ."baseballNuke_players 
  GROUP BY CONCAT(lastname, firstname, middlename) 
  ORDER BY playerID DESC, lastname ASC, firstname ASC, middlename ASC";

  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}



function  bbnuke_get_players_season_team($season, $team)
{
  global $wpdb;
  $players = array();
  $query = "SELECT playerID, firstname, middlename, lastname FROM " . $wpdb->prefix . "baseballNuke_players WHERE season = '" . $season . "' AND teamName = '" . $team . "' ORDER BY lastname,firstname,middlename asc";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_player_info($id, $season)
{
  global $wpdb;
#  $query = "SELECT playerID, teamName, firstname, middlename, lastname, positions, bats, throws, height, weight, address, city, state, zip, homePhone, workPhone, cellphone, jerseyNum, picLocation, season, profile, bdate, email, school
#  FROM ". $wpdb->prefix . "baseballNuke_players WHERE playerID = " . $id . " AND season = '" . $season . "'";
  $query  = "SELECT * FROM " . $wpdb->prefix . "baseballNuke_players WHERE playerID = " . $id . " AND season = '" . $season . "' ";
  $result = mysql_query($query);
  if ($result)
    $player_obj = mysql_fetch_object($result);

  return $player_obj;
}



function  bbnuke_delete_player($id, $season)
{
  global $wpdb;

  $query  = "DELETE FROM " . $wpdb->prefix . "baseballNuke_players WHERE playerID = " . $id . " AND season = '" . $season . "' ";
  $result = mysql_query($query);

  return;
}


function  bbnuke_delete_all_players_team($team, $season)
{
  global $wpdb;

  $query  = "DELETE FROM " . $wpdb->prefix . "baseballNuke_players WHERE teamname = '" . $team . "' AND season = '" . $season . "' ";
  $result = mysql_query($query);

  return;
}



function  bbnuke_add_player()
{
  global $wpdb;

  //  get post data
  $firstname   = $_POST['bbnuke_player_edit_fname'];
  $middlename  = $_POST['bbnuke_player_edit_mname'];
  $lastname    = $_POST['bbnuke_player_edit_lname'];
  $profile     = $_POST['bbnuke_player_edit_pprofile'];
  $positions   = $_POST['bbnuke_player_edit_position'];
  $bats        = $_POST['bbnuke_player_edit_bats'];
  $throws      = $_POST['bbnuke_player_edit_throws'];
  $height      = $_POST['bbnuke_player_edit_height'];
  $teamname    = $_POST['bbnuke_player_edit_team'];
  $season      = $_POST['bbnuke_player_edit_season'];
  $weight      = $_POST['bbnuke_player_edit_weight'];
  $bdate       = $_POST['bbnuke_player_edit_bdate'];
  $address     = $_POST['bbnuke_player_edit_address'];
  $city        = $_POST['bbnuke_player_edit_city'];
  $state       = $_POST['bbnuke_player_edit_state'];
  $zip         = $_POST['bbnuke_player_edit_zip'];
  $homephone   = $_POST['bbnuke_player_edit_hphone'];
  $cellphone   = $_POST['bbnuke_player_edit_cphone'];
  $workphone   = $_POST['bbnuke_player_edit_wphone'];
  $jerseynum   = $_POST['bbnuke_player_edit_jerseynum'];
  $email       = $_POST['bbnuke_player_edit_email'];
  $school      = $_POST['bbnuke_player_edit_school'];
  $piclocation = $_POST['bbnuke_player_edit_pictureloc'];

  $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_players SET teamName='$teamname',
        		firstname='$firstname',middlename='$middlename',
        		lastname='$lastname',positions='$positions',
        		bats='$bats',throws='$throws',height='$height',weight='$weight',
        		address='$address',city='$city',state='$state',zip='$zip',
        		homePhone='$homephone',workPhone='$workphone',
        		cellphone='$cellphone',jerseyNum='$jerseynum',
        		picLocation='$piclocation',season='$season',
        		profile='$profile',email='$email',school='$school',bdate='$bdate'";
  $result = mysql_query($query);
  if ($result)
    $ret = true;
  else
    $ret = false;

  return $ret;
}



function  bbnuke_update_player($player_id, $season)
{
  global $wpdb;

  //  get post data
  $firstname   = $_POST['bbnuke_player_edit_fname'];
  $middlename  = $_POST['bbnuke_player_edit_mname'];
  $lastname    = $_POST['bbnuke_player_edit_lname'];
  $profile     = $_POST['bbnuke_player_edit_pprofile'];
  $positions   = $_POST['bbnuke_player_edit_position'];
  $bats        = $_POST['bbnuke_player_edit_bats'];
  $throws      = $_POST['bbnuke_player_edit_throws'];
  $height      = $_POST['bbnuke_player_edit_height'];
  $teamname    = $_POST['bbnuke_player_edit_team'];
  $weight      = $_POST['bbnuke_player_edit_weight'];
  $bdate       = $_POST['bbnuke_player_edit_bdate'];
  $address     = $_POST['bbnuke_player_edit_address'];
  $city        = $_POST['bbnuke_player_edit_city'];
  $state       = $_POST['bbnuke_player_edit_state'];
  $zip         = $_POST['bbnuke_player_edit_zip'];
  $homephone   = $_POST['bbnuke_player_edit_hphone'];
  $cellphone   = $_POST['bbnuke_player_edit_cphone'];
  $workphone   = $_POST['bbnuke_player_edit_wphone'];
  $jerseynum   = $_POST['bbnuke_player_edit_jerseynum'];
  $email       = $_POST['bbnuke_player_edit_email'];
  $school      = $_POST['bbnuke_player_edit_school'];
  $piclocation = $_POST['bbnuke_player_edit_pictureloc'];

  $query = "UPDATE " . $wpdb->prefix . "baseballNuke_players SET 
                teamName='$teamname',
		firstname='$firstname',middlename='$middlename',
		lastname='$lastname',positions='$positions',
		bats='$bats',throws='$throws',height='$height',weight='$weight',
		address='$address',city='$city',state='$state',zip='$zip',
       		homePhone='$homephone',workPhone='$workphone',
       		cellphone='$cellphone',jerseyNum='$jerseynum',
       		picLocation='$piclocation',season='$season',
		profile='$profile',email='$email',school='$school',bdate='$bdate' 
                WHERE playerID='$player_id'
		AND season='$season'";

  $result = mysql_query($query);
  if ($result)
    $ret = true;
  else
    $ret = false;

  return $ret;
}


function  bbnuke_get_field_data($fieldname)
{
  global $wpdb;

  $query = "SELECT directions FROM " . $wpdb->prefix . "baseballNuke_locations WHERE fieldname = '" . $fieldname . "' ";
  $result = mysql_query($query);
  if ($result)
    $row = mysql_fetch_array($result); 
 
  return $row['directions'];
}


function  bbnuke_get_locations()
{
  global $wpdb;

  $query = "SELECT fieldname FROM " . $wpdb->prefix . "baseballNuke_locations ORDER BY fieldname asc ";
  $result = mysql_query($query);
  
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $fields[] = $row;
    }

  return $fields;
}


function  bbnuke_add_location($fieldname, $directions)
{
  global $wpdb;

  $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_locations SET fieldname = '" . $fieldname . "', directions = '" . $directions . "' ";
  $result = mysql_query($query);

  if ( mysql_error() )
    return false;

  return true;
}


function  bbnuke_delete_location( $fieldname )
{
  global $wpdb;

  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_locations WHERE fieldname = '" . $fieldname . "' ";
  $result = mysql_query($query);

  if ( mysql_error() )
    return false;

  return true;
}


function  bbnuke_delete_all_locations()
{
  global $wpdb;

  $query = "TRUNCATE TABLE " . $wpdb->prefix . "baseballNuke_locations ";
  $result = mysql_query($query);
  if ( mysql_error() )
    return false;

  return true;
}


function  bbnuke_update_location($fieldname, $directions)
{
  global $wpdb;

  $query = "UPDATE " . $wpdb->prefix . "baseballNuke_locations SET fieldname = '" . $fieldname . "', directions = '" . $directions ."' WHERE fieldname = '" . $fieldname . "' ";
  $result = mysql_query($query);

  if ( mysql_error() )
    return false;

  return true;
}



function  bbnuke_addSeason($year)
{
  global $wpdb;

  $ret_array = array();
  //  check if season already exists
  $query = "SELECT COUNT(*) FROM " . $wpdb->prefix . "baseballNuke_teams WHERE season = " . $year . " ";
  $result = mysql_query($query);

  if ( $result )
    $obj = mysql_fetch_object($result);

  if ( (!$result) OR ($obj->count == 0) )
  {
    //  season does not exists - create an entry with default team
    $query  = "SELECT defaultTeam FROM " . $wpdb->prefix . "baseballNuke_settings ";
    $result = mysql_query($query);
    $obj    = mysql_fetch_object($result);
    $team   = $obj->defaultTeam;

    $query  = "INSERT INTO `" . $wpdb->prefix . "baseballNuke_teams` (`teamname`, `wins`, `losses`, `winPer`, `season`) VALUES
			('" . $team . "', NULL, NULL, NULL, '" . $year . "');";
    $result = mysql_query($query);
   
    return true;
  }
  else
  {
    //  season exists - return false
    return false;
  }
}


function  bbnuke_add_team_season( $team_list, $season = NULL)
{
  global $wpdb;

  if ( is_array($team_list) )
  {
    if ( !$season )
    {
      //  get default season
      $query  = "SELECT defaultSeason FROM " . $wpdb->prefix . "baseballNuke_settings ";
      $result = mysql_query($query);
      $obj    = mysql_fetch_object($result);
      $season = $obj->defaultSeason;
    }
    foreach( $team_list as $team )
    {
      $query  = "INSERT INTO `" . $wpdb->prefix . "baseballNuke_teams` (`teamname`, `wins`, `losses`, `winPer`, `season`) VALUES
			('" . $team . "', NULL, NULL, NULL, '" . $season . "');";
      $result = mysql_query($query);
    }
  }
  else
  {
    if ( !$season )
    {
      //  get default season
      $query  = "SELECT defaultSeason FROM " . $wpdb->prefix . "baseballNuke_settings ";
      $result = mysql_query($query);
      $obj    = mysql_fetch_object($result);
      $season = $obj->defaultSeason;
    }
    $query  = "INSERT INTO `" . $wpdb->prefix . "baseballNuke_teams` (`teamname`, `wins`, `losses`, `winPer`, `season`) VALUES
			('" . $team_list . "', NULL, NULL, NULL, '" . $season . "');";
    $result = mysql_query($query);
  }
 
  return;
}


function  bbnuke_delete_season($year)
{
  global $wpdb;

  $defs = bbnuke_get_defaults();

  if ( $defs['defaultSeason'] == $year )
    return -10;
  
  $seasons_list = bbnuke_get_seasons();
  if ( count($seasons_list) <= 1 )
    return -20;

  $query = 'DELETE FROM ' . $wpdb->prefix . 'baseballNuke_teams WHERE season = "' . $year . '" ';
  $result = mysql_query($query);
  $wpdb->flush();

  return 10;
}


function  bbnuke_delete_team($team)
{
  global $wpdb;

  $query = "DELETE FROM " . $wpdb->prefix . "baseballNuke_teams WHERE teamname = '" . $team . "' ";
  $result = mysql_query($query);

  return;
}



function  bbnuke_get_defaults()
{
  global $wpdb;

  $query = "SELECT defaultTeam, defaultSeason, displayMenu FROM " . $wpdb->prefix . "baseballNuke_settings  WHERE ID=1";
  $result = mysql_query($query);
  if ($result)
    while ( $obj = mysql_fetch_object($result) )
    {
      $def['defaultTeam']   = $obj->defaultTeam;
      $def['defaultSeason'] = $obj->defaultSeason;
      $def['displayMenu']   = $obj->displayMenu;
    }

  return $def;
}


function  bbnuke_set_defaults($defs)
{
  global $wpdb;

  $query = "UPDATE " . $wpdb->prefix . "baseballNuke_settings 
					SET defaultSeason = '" . $defs['defaultSeason'] . "' " . 
					", defaultTeam = '" . $defs['defaultTeam'] . "' " .
					", displayMenu = '" . $defs['displayMenu'] . "' " .
					" WHERE ID=1";

  $result = mysql_query($query);

  return;
}



function  bbnuke_get_batting_avg()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum, ".
    		" round((baTotH/baTotAB),3) as BA ".
		" FROM ".$wpdb->prefix."baseballNuke_batTotals".
		" WHERE baTotAB>10".
		" GROUP BY playerID".
		" ORDER BY BA desc".
		" LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_hit_leaders()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotH ".
                " FROM ".$wpdb->prefix."baseballNuke_batTotals".
		" WHERE baTotH > 0".
                " GROUP BY playerID".
                " ORDER BY baTotH desc".
                " LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function bbnuke_get_homerun_leaders()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotHR ".
                " FROM ".$wpdb->prefix."baseballNuke_batTotals".
		" WHERE baTotHR > 0".
                " GROUP BY playerID".
                " ORDER BY baTotHR desc".
                " LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_rbi()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotRBI ".
                " FROM ".$wpdb->prefix."baseballNuke_batTotals".
                " GROUP BY playerID".
                " ORDER BY baTotRBI desc".
                " LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_era_leaders()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');
  $erainnings = bbnuke_get_option('bbnuke_era_innings'); 

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum, ".
    		" round(sum((piTotER/piTotIP)*".$erainnings."),2) as ERA ".
		" FROM ".$wpdb->prefix."baseballNuke_pitchTotals".
		" WHERE piTotIP>5".
		" GROUP BY playerID".
		" ORDER BY ERA asc".
		" LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}



function  bbnuke_get_strikeout_leaders()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotSO ".
                " FROM ".$wpdb->prefix."baseballNuke_pitchTotals".
		" WHERE piTotSO > 0".
                " GROUP BY playerID".
                " ORDER BY piTotSO desc".
                " LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}



function  bbnuke_get_innings_pitched_leaders()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotIP ".
                " FROM ".$wpdb->prefix."baseballNuke_pitchTotals".
		" WHERE piTotIP > 0".
                " GROUP BY playerID".
                " ORDER BY piTotIP desc".
                " LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}



function  bbnuke_get_wins_leaders()
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotWin ".
                " FROM ".$wpdb->prefix."baseballNuke_pitchTotals".
		" WHERE piTotWin > 0".
                " GROUP BY playerID".
                " ORDER BY piTotWin desc".
                " LIMIT ".$team_leaders;
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_last_game_results()
{
  global $wpdb;

  $query = "SELECT s.gameID, gameDate as Gdate, gameTime as Gtime, " .
                 " homeTeam, visitingTeam, field, hruns, vruns " .
                 " FROM " . $wpdb->prefix . "baseballNuke_schedule s, " . $wpdb->prefix . "baseballNuke_boxscores b WHERE " . 
                 " s.gameID = b.gameID AND gameDate <= CURDATE() " .
                 " AND (hruns>0 OR vruns>0) ORDER BY gameDate DESC, gameTime DESC LIMIT 1";
  $result = mysql_query($query);
  if ( $result )
    $game = mysql_fetch_array($result);
  else
    $game = NULL;

  return $game;
}


function  bbnuke_get_past_games_with_results()
{
  global $wpdb;

  $query = "SELECT s.gameID, gameDate as Gdate,gameTime as Gtime, " .
                 " homeTeam, visitingTeam, field, hruns, vruns " .
                 " FROM " . $wpdb->prefix . "baseballNuke_schedule s, " . $wpdb->prefix . "baseballNuke_boxscores b WHERE " . 
                 " s.gameID = b.gameID AND gameDate <= CURDATE() " .
                 " AND (hruns>0 OR vruns>0) ORDER BY gameDate DESC, gameTime DESC ";
  $result = mysql_query($query);
  if ( $result )
    while ( $row = mysql_fetch_array($result) )
      $games[] = $row;
  else
    return false;

  return $games;
}

function  bbnuke_get_next_game()
{
  global $wpdb;

  $query = "SELECT gameID,gameDate as Gdate, gameTime as Gtime, homeTeam, visitingTeam, field "
                  ." FROM ".$wpdb->prefix."baseballNuke_schedule WHERE gameDate >= CURDATE() ORDER BY gameDate ASC, gameTime ASC LIMIT 1";
  $result = mysql_query($query);
  if ($result)
    $game = mysql_fetch_array($result);

  return $game;
}

function  bbnuke_upload_gameResults_bat($gameID,$season)
{
  global  $wpdb;
  $o = new PaperPear_CSVParser('bbnuke_gameResults_bat_uploadedfile');
 while ($o->getNext())
    {
$playerID=bbnuke_get_playerID($o->getNum(),$season); 
print "baAB=" . $o->getAB() .",baRuns=" . $o->getR() .",ba1b=" . $o->get1B() .",ba2b=" . $o->get2B() .",ba3b=" . $o->get3B() .",baHR=" . $o->getHR() .",baRBI=" . $o->getRBI() .",baBB=" . $o->getBB() .",baK=" . $o->getSO() .",baHP=" . $o->getHBP() .",baSB=" . $o->getSB() .",baRE=" . $o->getROE() .",baFC=" . $o->getFC() ."" . $playerID . "";
    }
}


function  bbnuke_get_playerID($jersey,$season)
{
  global $wpdb;

  $query = "SELECT playerID FROM ".$wpdb->prefix."baseballNuke_players " .
		"WHERE season=". $season . " AND jerseyNum=" . $jersey . ";" .
  $result = mysql_query($query);
  if ($result)
    $game = mysql_fetch_array($result);

  return $game;
}

////////////////////////////////////////////////////////////////////////////////
// plugin widget functions for output generation
////////////////////////////////////////////////////////////////////////////////
      add_shortcode(bbnuke_topbatters,bbnuke_widget_top_batters);
      add_shortcode(bbnuke_toppitchers,bbnuke_widget_top_pitchers);
      add_shortcode(bbnuke_lastgame,bbnuke_widget_lastgame);
      add_shortcode(bbnuke_nextgame,bbnuke_widget_nextgame);
      add_shortcode(bbnuke_batstats,bbnuke_widget_batstats);
      add_shortcode(bbnuke_roster,bbnuke_widget_roster);
      add_shortcode(bbnuke_pitchstats,bbnuke_widget_pitchstats);
      add_shortcode(bbnuke_fieldstats,bbnuke_widget_fieldstats);
      add_shortcode(bbnuke_playerstats,bbnuke_widget_playerstats);
      add_shortcode(bbnuke_top5stats,bbnuke_widget_top5stats);
      add_shortcode(bbnuke_schedule,bbnuke_widget_team_schedule);
      add_shortcode(bbnuke_practice,bbnuke_widget_team_practices);
      add_shortcode(bbnuke_tournament,bbnuke_widget_team_tournament);
      add_shortcode(bbnuke_fields,bbnuke_widget_locations_info);
      add_shortcode(bbnuke_gameresults,bbnuke_widget_game_results);

function  bbnuke_display_widget( $bbnuke_w_args )
{
  global $wpdb;

  switch  ($bbnuke_w_args['display_type'])
  {
    case 0:
      bbnuke_widget_top_batters( true );
      break;
    case 1:
      bbnuke_widget_top_pitchers( true );
      break;
    case 2:
      bbnuke_widget_lastgame( true );
      break;
    case 3:
      bbnuke_widget_nextgame( true );
      break;
    case 4:
      bbnuke_widget_batstats( true );
      break;
    case 5:
      bbnuke_widget_roster( true );
      break;
    case 6:
      bbnuke_widget_pitchstats( true );
      break;
    case 7:
      bbnuke_widget_fieldstats( true );
      break;
    case 8:
      bbnuke_widget_playerstats( NULL, true);
      break;
    case 9:
      bbnuke_widget_top5stats( true );
      break;
    case 10:
      bbnuke_widget_team_schedule( true );
      break;
    case 11:
      bbnuke_widget_team_practices( true );
      break;
    case 12:
      bbnuke_widget_team_tournament( true );
      break;
    case 13:
      bbnuke_widget_locations_info( true );
      break;
    case 14:
      bbnuke_widget_game_results( NULL, NULL, true);
      break;
  }

  return;
}



function  bbnuke_widget_top_batters( $bbnuke_echo = true )
{
  global $wpdb;
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));

  $heading_arr = array(
             __('Batting Avg', 'bbnuke'),
             __('Hits', 'bbnuke'),
             __('Home', 'bbnuke'),
             __('RBI', 'bbnuke')
          );

  $bbnuke_content = NULL;

  for ( $i=0; $i < 4; $i++ )
  {
    $bbnuke_content .= 
    '   <table width="140px" class="bbnuke-results-table">
        <tr>
          <th style="text-align:left;">' . $heading_arr[$i] . '</th>
          <th>&nbsp;</th></tr>' . "\n";

    switch ($i)        
    {
      case 0:
        #Batting Average Leaders
        $players = bbnuke_get_batting_avg();
        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $BA) = $players[$m];
          $bAvg=$BA;
          $bAvg=strval($bAvg);
          $bAvg=str_pad($bAvg,5,"0");
          if($bAvg=="10000")
          {
            $bAvg=substr($bAvg,0,-1);
          }
          else
          {
            $bAvg=substr($bAvg,1);
            $bAvg=str_replace("0000","0",$bAvg);
          }
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $bAvg . '</td>
                </tr>';
        }	
        break;
      case 1:
        #Hits Leaders    
        $players = bbnuke_get_hit_leaders();
        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotH) = $players[$m];
          $bbnuke_content .= '<tr>
                 <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $baTotH . '</td>
                </tr>';
        }
        break;
      case 2:
        #Homerun Leaders
        $players = bbnuke_get_homerun_leaders();
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotHR) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $baTotHR . '</td>
                </tr>';
        }
        break;
      case 3:
        $players = bbnuke_get_rbi();
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotRBI) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $baTotRBI . '</td>
                </tr>';
        }
        break;
    }

    $bbnuke_content .= '</table>' . "\n";
  }

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_top_pitchers( $bbnuke_echo = true)
{
  global $wpdb;
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
    $heading_arr = array(
            __('ERA', 'bbnuke'),
       	    __('Strikeouts', 'bbnuke'),
            __('Innings', 'bbnuke'),
            __('Wins', 'bbnuke')
          );

  $bbnuke_content = NULL;

  for ( $i=0; $i < 4; $i++ )
  {
    $bbnuke_content .= 
    '   <table width="140px" class="bbnuke-results-table">
        <tr>
          <th style="text-align:left;">' . $heading_arr[$i] . '</th>
          <th>&nbsp;</th</tr>' . "\n";

    switch ($i)        
    {
      case 0:
        #ERA Leaders	
        $players = bbnuke_get_era_leaders();
        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $ERA) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
                  <td>' . $ERA . '</td>
                </tr>';
        }	
        break;
      case 1:
        #Strikeout Leaders    
        $players = bbnuke_get_strikeout_leaders();
        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $piTotSO) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $piTotSO . '</td>
                </tr>';
        }
        break;
      case 2:
        #Innings Pitched Leaders
        $players = bbnuke_get_innings_pitched_leaders();
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $piTotIP) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
	          <td>' . $piTotIP . '</td>
                </tr>';
        }
        break;
      case 3:
        #Wins Leader
        $players = bbnuke_get_wins_leaders();
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $piTotWin) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $piTotWin . '</td>
                </tr>';
        }
        break;
    }

    $bbnuke_content .= '</table>' . "\n";
  }

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_lastgame( $bbnuke_echo = true )
{
  global $wpdb;

  $defs  = bbnuke_get_defaults();
  $dteam = $defs['defaultTeam'];
  $timeformat = get_option('time_format');
  $dateformat = get_option('date_format');
  $game  = bbnuke_get_last_game_results();
  $game_results_page = get_permalink(bbnuke_get_option('bbnuke_game_results_page'));

  $bbnuke_content = NULL;

  if ( $game )
  {
    list($gameID, $Gdate, $Gtime, $homeTeam, $visitingTeam, $field, $hruns, $vruns) = $game;
    $date =date_create("$Gdate $Gtime");
    $bbnuke_content .= '<a class="game_results-page-link" href="'.$game_results_page.'?gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'.date_format($date,"$dateformat $timeformat").'</a><br />';
    if ($dteam == $homeTeam)
    {
      $bbnuke_content .= $visitingTeam . ' (' . $vruns . ')<br />';
      $bbnuke_content .= '<b>' . $homeTeam . ' (' . $hruns . ')</b><br />';
    }
    else
    {
      $bbnuke_content .= '<b>' . $visitingTeam . ' (' . $vruns . ')</b><br />';
      $bbnuke_content .= $homeTeam . ' (' . $hruns . ')<br />';
    }
  }
  else
  {
    $bbnuke_content .= __('There are no results.', 'bbnuke') . "\n";
  }

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_nextgame( $bbnuke_echo = true )
{
  global $wpdb;

  $defs  = bbnuke_get_defaults();
  $dteam = $defs['defaultTeam'];
  $locations_page = get_permalink(bbnuke_get_option('bbnuke_locations_page'));
  $timeformat = get_option('time_format');
  $dateformat = get_option('date_format');
  $game  = bbnuke_get_next_game();

  $bbnuke_content = NULL;

  if ( $game )
  {
    list($gameID, $Gdate, $Gtime, $homeTeam, $visitingTeam, $field) = $game;

    $date =date_create("$Gdate $Gtime");
    $bbnuke_content .= '<a class="game_results-page-link">'.date_format($date,"$dateformat $timeformat").'</a><br />';
    if ($dteam == $homeTeam)
    {
      $bbnuke_content .= 'vs. ' . $visitingTeam;
    }
    else
    {
      $bbnuke_content .= 'vs. ' . $homeTeam;
    }
    $bbnuke_content .= '</b><br /> at <a href="' . $locations_page . '?field='.$field.'" title="">'.$field.'</a>';
  }
  else
  {
    $bbnuke_content .= __('There are no upcoming games.', 'bbnuke') . "\n";
  }

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_batstats( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $SORTBY    = $_POST['bbnuke_widget_tb_head_batstats_sortby'];
  $SORTORDER = $_POST['bbnuke_widget_tb_head_batstats_sortorder'];

  $bbnuke_content = NULL;

  $titLen=array('#'=>'','Batting'=>'','AB'=>'','R'=>'','H'=>'','2B'=>'','3B'=>'',
		'HR'=>'','RE'=>'','FC'=>'','HP'=>'','RBI'=>'','BA'=>'','OBP'=>'','SLG'=>'','OPS'=>'','BB'=>'','K'=>'','LOB'=>'','SB'=>'');
  $titLink=array('#'=>'baJersey','Batting'=>'baName','AB'=>'baAB','R'=>'baR','H'=>'baH','2B'=>'ba2B','3B'=>'ba3B','HR'=>'baHR',
		'RE'=>'baRE','FC'=>'baFC','HP'=>'baHP','RBI'=>'baRBI','BA'=>'',
		'OBP'=>'','SLG'=>'','OPS'=>'','BB'=>'baBB','K'=>'baK','LOB'=>'baLOB','SB'=>'baSB');

  $bbnuke_content .= '<table class="bbnuke-results-table"><tr> ';
  $bbnuke_content .= bbnuke_build_heading($SORTBY,$SORTORDER,$titLen,$titLink,'batstats',false);
  $bbnuke_content .= '</tr>';

  //BATTING STATS
  $query = "SELECT p.playerID,p.lastname,p.firstname,p.middlename,p.jerseyNum,".
      	" sum(baRuns) as baR, sum(baAb) as baAB, sum(ba1b+ba2b+ba3b+baHR) as baH,sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b,".
      	" sum(baHR) as baHR, sum(baRE) as baRE, sum(baFC) as baFC, sum(baHP) as baHP, sum(baRBI) as baRBI,".
      	" sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB, sum(baSB) as baSB".
      	" FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s".
      	" WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' ".
      	" AND p.playerID=st.playerID AND st.gameID=s.gameID  ".
      	" AND p.season=DATE_FORMAT(gameDate,'%Y') GROUP BY p.playerID ORDER BY ";
	if($SORTBY=="" || !(preg_match('/^ba/',$SORTBY))){
		$query.="lastname,firstname ASC";
	}elseif($SORTBY=="baName" && $SORTORDER=="D"){
		$query.="lastname DESC, firstname ASC";
	}elseif($SORTBY=="baName" && $SORTORDER=="A"){
		$query.="lastname ASC, firstname ASC";
	}elseif($SORTBY=="baJersey" && $SORTORDER=="D"){
		$query.="jerseyNum DESC";
	}elseif($SORTBY=="baJersey" && $SORTORDER=="A"){
		$query.="jerseyNum ASC";
	}else{
		$query.=$SORTBY;
		switch($SORTORDER){
			case "A":
				$query.=" ASC";
				break;
			case "D":
				$query.=" DESC";
				break;
			}
	}
  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
    $presults[] = $row;

  for ($m=0; $m < count($presults); $m++) 
  {
    if( count($presults) )
    {
      list($playerID, $lastname, $firstname, $middlename, $jerseyNum,$baR, $baAB, $baH,$ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baHP, $baRBI, $baBB, $baK, $baLOB, $baSB) = $presults[$m];
      $hits=$ba1b+$ba2b+$ba3b+$baHR;
      if ( $baAB > 0 )
        $slg=round((($ba1b+($ba2b*2)+($ba3b*3)+($baHR*4))/$baAB),3);
	$slg=number_format("$slg",3);
	$slg = ltrim($slg,"0"); 
      if($slg==0){
        $slg=".000";
         }
      if ( $baAB == 0 ){
	$slg=".000";
	}
      
      if ( ($baAB+$baBB) > 0 )
        $obp= str_pad(str_replace("0.",".",round(($hits+$baBB+$baRE+$baFC+$baHP)/($baAB+$baBB),3)),4,"0",STR_PAD_RIGHT);
      if (($baAB+baBB+$hits)== 0)
	{$obp = .000;}
      if ($obp == "1000") 
        { $obp = "1.000";}
      if ($obp == "0") 
        { $obp = ".000";}

      if ( $baAB > 0 )
	$ops=($obp+$slg);	   
      	$ops=number_format("$ops",3);
	$ops = ltrim($ops,"0"); 
      if ( $baAB == 0)
      {
	$ops = ".000";
      }
      if ( $baAB > 0)          			
        $ba=round($hits/$baAB,3);
      $ba=strval($ba);
      $ba=str_pad($ba,5,"0"); 
      if($ba=="10000")
      {
	$ba=substr($ba,0,-1);
      }
      if ( $baAB == 0)
	{$ba = 0.000;}
      else
      {
	$ba=substr($ba,1);
	$ba=str_replace("0000","0",$ba); 
     }
    }

    $bbnuke_content .= "<tr><td>$jerseyNum</td>";
    $bbnuke_content .= '<td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>';

    if( count($presults) )
    {
      $bbnuke_content .= '
			<td align="center">'.$baAB.'</td>
			<td align="center">'.$baR.'</td>
			<td align="center">'.$baH.'</td>
			<td align="center">'.$ba2b.'</td>
			<td align="center">'.$ba3b.'</td>
			<td align="center">'.$baHR.'</td>
			<td align="center">'.$baRE.'</td>
			<td align="center">'.$baFC.'</td>
			<td align="center">'.$baHP.'</td>
			<td align="center">'.$baRBI.'</td>
			<td align="center">'.$ba.'</td>
			<td align="center">'.$obp.'</td>
			<td align="center">'.$slg.'</td>
			<td align="center">'.$ops.'</td>
			<td align="center">'.$baBB.'</td>
			<td align="center">'.$baK.'</td>
			<td align="center">'.$baLOB.'</td>
			<td align="center">'.$baSB.'</td>';
    }

    $bbnuke_content .= '</tr>';
  }

  //Get totals   //was between baK and baSB - sum(baLOB) as baLOB,
  $query = "SELECT sum(baRuns) as baR, sum(baAb) as baAB, sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b,  " . 
           "       sum(baHR) as baHR, sum(baRE) as baRE, sum(baFC) as baFC, sum(baHP) as baHP, sum(baRBI) as baRBI, " .
           "       sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB, sum(baSB) as baSB " .
           "  FROM ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
           " WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND st.gameID=s.gameID AND " .
           "       p.playerID=st.playerID AND p.season=DATE_FORMAT(gameDate,'%Y')";
  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
    $gresults[] = $row;

  for ($m=0; $m < count($gresults); $m++) 
  {
    // see above  $baLOB,
    list($baR, $baAB, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baHP, $baRBI, $baBB, $baK, $baLOB, $baSB) = $gresults[$m];
    $hits=$ba1b+$ba2b+$ba3b+$baHR;
    if($baAB>0)
      $ba=round($hits/$baAB,3);
    $ba=strval($ba);
    $ba=str_pad($ba,5,"0");
    $ba=substr($ba,1);
    $ba=str_replace("0000","0",$ba);
    if($baAB>0)
      $obp=round(($hits+$baBB)/($baAB+$baBB),3);
    $obp=strval($obp);
    $obp=str_pad($obp,5,"0");
    $obp=substr($obp,1);
    $obp=str_replace("0000","0",$obp);
    if($baAB>0)
      $slg=round((($ba1b+($ba2b*2)+($ba3b*3)+($baHR*4))/$baAB),3);
    $slg=strval($slg);
    $slg=str_pad($slg,5,"0");
    $slg=substr($slg,1);
    $slg=str_replace("0000","0",$slg);
 			
    $ops=($obp + $slg);
    $ops=str_pad($ops,4,"0");
    $ops=substr($ops,1);
    $ops=str_replace("0000","0",$ops);

    $bbnuke_content .= '<tr><td>&nbsp;</td>
       	      <td style="text-align:left;"><b>TOTAL</b></td>
	      <td><b>'.$baAB.'</b></td>
              <td><b>'.$baR.'</b></td>
              <td><b>'.$hits.'</b></td>
              <td><b>'.$ba2b.'</b></td>
              <td><b>'.$ba3b.'</b></td>
              <td><b>'.$baHR.'</b></td>
              <td><b>'.$baRE.'</b></td>
              <td><b>'.$baFC.'</b></td>
              <td><b>'.$baHP.'</b></td>
              <td><b>'.$baRBI.'</b></td>
              <td><b>'.$ba.'</b></td>
              <td><b>'.$obp.'</b></td>
	      <td><b>'.$slg.'</b></td>
	      <td><b>'.$ops.'</b></td>
	      <td><b>'.$baBB.'</b></td>
              <td><b>'.$baK.'</b></td>
              <td><b>'.$baLOB.'</b></td>
              <td><b>'.$baSB.'</b></td></tr></table>';
  }

  $bbnuke_content .= '<br /><br /><hr /><table class="bbnuke-stat-key">
	<tr><td><u>' . __('Key', 'bbnuke') . '</u></td><td><u>' . __('Meaning', 'bbnuke') . '</u></td></tr>
	<tr><td colspan="2"><hr /></td></tr>
	<tr><td>AB</td><td>' . __('At Bat', 'bbnuke') . '</td></tr>
	<tr><td>R</td><td>' . __('Runs', 'bbnuke') . '</td></tr>
    	<tr><td>H</td><td>' . __('Hits', 'bbnuke') . '</td></tr>
	<tr><td>2B</td><td>' . __('Doubles', 'bbnuke') . '</td></tr>
	<tr><td>3B</td><td>' . __('Triples', 'bbnuke') . '</td></tr>
	<tr><td>HR</td><td>' . __('Home Runs', 'bbnuke') . '</td></tr>
	<tr><td>RE</td><td>' . __('Reach on Error', 'bbnuke') . '</td></tr>
	<tr><td>FC</td><td>' . __('Fielders Choice', 'bbnuke') . '</td></tr>
	<tr><td>HP</td><td>' . __('Hit by Pitch', 'bbnuke') . '</td></tr>
	<tr><td>RBI</td><td>' . __('Runs Batted In', 'bbnuke') . '</td></tr>
	<tr><td>BA</td><td>' . __('Batting Average', 'bbnuke') . '</td></tr>
	<tr><td>OBP</td><td>' . __('On-Base Percentage', 'bbnuke') . '</td></tr>
	<tr><td>SLG</td><td>' . __('Slugging Percentage', 'bbnuke') . '</td></tr>
	<tr><td>OPS</td><td>' . __('On-Base Plus Slugging', 'bbnuke') . '</td></tr>
	<tr><td>BB</td><td>' . __('Bases on Balls (Walks)', 'bbnuke') . '</td></tr>
	<tr><td>K</td><td>' . __('Strikeouts', 'bbnuke') . '</td></tr>
	<tr><td>LOB</td><td>' . __('Left on Base', 'bbnuke') . '</td></tr>
	<tr><td>SB</td><td>' . __('Stolen Bases', 'bbnuke') . '</td></tr>
        </table>';

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_roster( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $bbnuke_content = NULL;

  $bbnuke_content .= '<table class="bbnuke-schedule-table"">
        <tr>
          <th>' . __('#', 'bbnuke') . '</th>
          <th style="text-align:left;">' . __('Player', 'bbnuke') . '</th>
          <th>' . __('Pos', 'bbnuke') . '</th>
          <th>' . __('Bats', 'bbnuke') . '</th>
          <th>' . __('Throws', 'bbnuke') . '</th>
	  <th style="text-align:left;">' . __('Home', 'bbnuke') . '</th>
	  <th style="text-align:left;">' . __('School', 'bbnuke') . '</th>
        </tr>';
  $query = "SELECT playerID,lastname,firstname,middlename,jerseyNum,positions,bats,throws,city,state,school,".
	   "((date_format(now(),'%Y') - date_format(bdate,'%Y')) - (date_format(now(),'00-%m-%d') < date_format(bdate,'00-%m-%d'))) AS age".
           " FROM ".$wpdb->prefix."baseballNuke_players".
	   " WHERE season='".$dseason."'".
           " GROUP BY playerID ORDER BY lastname";

  $result = mysql_query($query);
  if ( $result )
    while ( $row = mysql_fetch_array($result) )
      $tresults[] = $row;

  for ($m=0; $m < count($tresults); $m++)
  {
    list($playerID,$lastname,$firstname,$middlename,$jerseyNum,$positions,$bats,$throws,$city,$state,$school,$age) = $tresults[$m];
    if ($age>100)
      $age="&nbsp;";
    $location=$city.', '.$state;
    if ($state==null)
      $location=$city;
    if ($city==null)
      $location=$state;

    $bbnuke_content .= '<tr>
    			    <td>'.$jerseyNum.'</td>
                            <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
			    <td>'.$positions.'</td>
			    <td style="text-align:center;">'.$bats.'</td>
			    <td style="text-align:center;">'.$throws.'</td>
                            <td style="text-align:left;">'.$location.'</td>
                            <td style="text-align:left;">'.$school.'</td>

                        </tr>';
  }
     $bbnuke_content .= '</table>';
  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;


}


function  bbnuke_widget_pitchstats( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $erainnings = bbnuke_get_option('bbnuke_era_innings');
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $SORTBY    = $_POST['bbnuke_widget_tb_head_pitchstats_sortby'];
  $SORTORDER = $_POST['bbnuke_widget_tb_head_pitchstats_sortorder'];

  $bbnuke_content = NULL;
		
  $bbnuke_content .= '<table class="bbnuke-results-table"><tr> ';	

  $titLen=array('#'=>'','Pitching'=>'','W'=>'','L'=>'','S'=>'','IP'=>'','H'=>'','R'=>'','ER'=>'','BB'=>'','K'=>'','ERA'=>'');
  $titLink=array('#'=>'piJersey','Pitching'=>'piName','W'=>'piWin','L'=>'piLose','S'=>'piSave','IP'=>'piIP','H'=>'piHits','R'=>'piRuns','ER'=>'piER','K'=>'piSO');

  $bbnuke_content .= bbnuke_build_heading($SORTBY,$SORTORDER,$titLen,$titLink,'pitchstats',false);
  $bbnuke_content .= '</tr>';

  //PITCHING STATS
  $query = "SELECT p.playerID, lastname,firstname,middlename,jerseyNum,sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, ".
		 "sum(piIP) as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, ".
		 "sum(piWalks) as piWalks, sum(piSO) as piSO ".
           "  FROM ".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_schedule s ".		
           " WHERE s.gameID=st.gameID AND p.season='".$dseason."' AND DATE_FORMAT(gameDate, '%Y')='".$dseason."' AND piIP>0 ".
		" AND st.playerID=p.playerID GROUP BY p.playerID ORDER BY ";

  if($SORTBY=="" || !(preg_match('/^pi/',$SORTBY))){
			$query.="lastname,firstname ASC";
		}elseif($SORTBY=="piName" && $SORTORDER=="D"){
			$query.="lastname DESC, firstname ASC";
		}elseif($SORTBY=="piName" && $SORTORDER=="A"){
			$query.="lastname ASC, firstname ASC";
		}elseif($SORTBY=="piJersey" && $SORTORDER=="D"){
			$query.="jerseyNum DESC";
		}elseif($SORTBY=="piJersey" && $SORTORDER=="A"){
			$query.="jerseyNum ASC";
		}else{
			$query.=$SORTBY;
			switch($SORTORDER){
				case "A":
					$query.=" ASC";
					break;
				case "D":
					$query.=" DESC";
					break;
				}
		}
  $result = mysql_query($query);
  if ( $result )
    while ( $row = mysql_fetch_array($result) )
      $presults[] = $row;

  for ($m=0; $m < count($presults); $m++) 
  {
    list($playerID,$lastname, $firstname, $middlename, $jerseyNum,$piWin,$piLose, $piSave, $piIP, $piHits, $piRuns, $piER, $piWalks, $piSO) = $presults[$m];
    if ($piIP)
      $ERA=($piER/$piIP)*$erainnings;
    $ERA=round($ERA,2);
    $bbnuke_content .= "<tr>"; 
    $bbnuke_content .= '<td>'.$jerseyNum.'</td>
			    <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  	    <td>'.$piWin.'</td>
		            <td>'.$piLose.'</td>
		            <td>'.$piSave.'</td>
		            <td>'.$piIP.'</td>
		            <td>'.$piHits.'</td>
		            <td>'.$piRuns.'</td>
		            <td>'.$piER.'</td>
		            <td>'.$piWalks.'</td>
		            <td>'.$piSO.'</td>
		            <td>'.$ERA.'</td>
			</tr>';
  }
		
  //SEASON PITCHING TOTAL
  unset($presults);
  $query="SELECT sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, sum(piIP) "
                        ."as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, "
                        ."sum(piWalks) as piWalks, sum(piSO) as piSO " .
         "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
         " WHERE pitchOrd>0 AND teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND p.playerID=st.playerID AND " .
         "       st.gameID=s.gameID AND p.season=DATE_FORMAT(gameDate,'%Y')";
  $result = mysql_query($query);
    while ( $row = mysql_fetch_array($result) )
      $presults[] = $row;
  
  for ($m=0; $m < count($presults); $m++) 
  {
    list($piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO) = $presults[$m];
    if ($piIP)
      $ERA=($piER/$piIP)*$erainnings;
    $ERA=round($ERA,2);
    $bbnuke_content .= '<tr><td>&nbsp;</td>
		     <td style="text-align:left;"><b>TOTAL</b></td>
    		     <td><b>'.$piWin.'</b></td>
                     <td><b>'.$piLose.'</b></td>
                     <td><b>'.$piSave.'</b></td>
                     <td><b>'.$piIP.'</b></td>
                     <td><b>'.$piHits.'</b></td>
                     <td><b>'.$piRuns.'</b></td>
                     <td><b>'.$piER.'</b></td>
                     <td><b>'.$piWalks.'</b></td>
                     <td><b>'.$piSO.'</b></td>
                     <td><b>'.$ERA.'</b></td>
                   </tr>
		 </table>';
  } 

  $bbnuke_content .= '<br /><br /><hr /><table class="bbnuke-stat-key">
	<tr><td><u>' . __('Key', 'bbnuke') . '</u></td><td><u>' . __('Meaning', 'bbnuke') . '</u></td></tr>
	<tr><td colspan="2"><hr /></td></tr>
	<tr><td>W</td><td>' . __('Wins', 'bbnuke') . '</td></tr>
	<tr><td>L</td><td>' . __('Losses', 'bbnuke') . '</td></tr>
        <tr><td>S</td><td>' . __('Save', 'bbnuke') . '</td></tr>
	<tr><td>IP</td><td>' . __('Innings Pitched', 'bbnuke') . '</td></tr>
	<tr><td>PC</td><td>' . __('Pitch Count', 'bbnuke') . '</td></tr>
	<tr><td>H</td><td>' . __('Hits', 'bbnuke') . '</td></tr>
	<tr><td>R</td><td>' . __('Runs', 'bbnuke') . '</td></tr>
	<tr><td>ER</td><td>' . __('Earned Runs', 'bbnuke') . '</td></tr>
	<tr><td>BB</td><td>' . __('Walks (Bases on Balls)', 'bbnuke') . '</td></tr>
	<tr><td>K</td><td>' . __('Strikeouts', 'bbnuke') . '</td></tr>
	<tr><td>ERA</td><td>' . __('Earned Run Average', 'bbnuke') . '</td></tr>
	<tr><td>ASP</td><td>' . __('Average Speed', 'bbnuke') . '</td></tr>
        </table>';

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_fieldstats( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];

  $SORTBY    = $_POST['bbnuke_widget_tb_head_fieldstats_sortby'];
  $SORTORDER = $_POST['bbnuke_widget_tb_head_fieldstats_sortorder'];

  $bbnuke_content = NULL;

  $bbnuke_content .= '<table class="bbnuke-results-table"><tr>';

  $titLen=array('#'=>25,'Fielding'=>245,'PO'=>25,'A'=>25,'E'=>25,'FP'=>35);
  $titLink=array('#'=>'fiJersey','Fielding'=>'fiName','PO'=>'fiPO','A'=>'fiA','E'=>'fiE','FP'=>'');

  $bbnuke_content .= bbnuke_build_heading($SORTBY,$SORTORDER,$titLen,$titLink, 'fieldstats',false);
  $bbnuke_content .= '</tr>';

  //Fielding STATS
  $query = "SELECT p.playerID,p.lastname,p.firstname,p.middlename,p.jerseyNum,".
		" sum(st.fiPO)as fiPO, sum(st.fiA) as fiA, sum(st.fiE) as fiE ".
		" FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s ".
		" WHERE p.playerID=st.playerID AND teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."'".
		" AND st.gameID=s.gameID AND p.season=DATE_FORMAT(gameDate,'%Y') GROUP BY p.playerID ORDER BY ";
	
  if( $SORTBY=="" || !(preg_match('/^fi/',$SORTBY)))
  {
    $query.="lastname,firstname ASC";
  }
  elseif($SORTBY=="fiName" && $SORTORDER=="D")
  {
    $query.="lastname DESC, firstname ASC";
  }
  elseif($SORTBY=="fiName" && $SORTORDER=="A")
  {
    $query.="lastname ASC, firstname ASC";
  }
  elseif($SORTBY=="fiJersey" && $SORTORDER=="D")
  {
    $query.="jerseyNum DESC";
  }
  elseif($SORTBY=="fiJersey" && $SORTORDER=="A")
  {
    $query.="jerseyNum ASC";
  }
  else
  {
    $query.=$SORTBY;
    switch($SORTORDER)
    {
				case "A":
					$query.=" ASC";
					break;
				case "D":
					$query.=" DESC";
					break;
    }
  }
  $result = mysql_query($query);
  if ($result)
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $presults[] = $row;
    }
  }

  for ($m=0; $m < count($presults); $m++) 
  {
    list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $fiPO,$fiA, $fiE) = $presults[$m];
    $SumfiPO += $fiPO;
    $SumfiA += $fiA;
    $SumfiE += $fiE;
		
    if ( (($fiPO+$fiA+$fiE)) > 0 )
      $FP= str_pad(str_replace("0.",".",round(($fiPO+$fiA)/($fiPO+$fiA+$fiE),3)),4,"0",STR_PAD_RIGHT);
    if ($FP == "1000") 
      $FP = "1.000";
    if ($FP == "0") 
      $FP = ".000";

    $bbnuke_content .= '<tr><td>'.$jerseyNum.'</td>
		  	    <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
			    <td>'.$fiPO.'</td>
		            <td>'.$fiA.'</td>
		            <td>'.$fiE.'</td>
		            <td>'.$FP.'</td>
		        </tr>';
  }

  if ( ($SumfiPO+$SumfiA+$SumfiE) > 0 )
    $SumfiFP = str_pad(str_replace("0.",".",round(($SumfiPO+$SumfiA)/($SumfiPO+$SumfiA+$SumfiE),3)),4,"0",STR_PAD_RIGHT);

  $bbnuke_content .= '<tr><td></td><td><strong>TOTALS</strong></td>
	<td><strong>'.$SumfiPO.'</strong></td>
	<td><strong>'.$SumfiA.'</strong></td>
	<td><strong>'.$SumfiE.'</strong></td>
	<td><strong>'.$SumfiFP.'</strong></td>
	</tr>';

  $bbnuke_content .= '</table>';

  $bbnuke_content .= '<br /><table><tr><td><hr /></td></tr><tr><td><table class="bbnuke-results-table">
	<tr><td><u>' . __('Key', 'bbnuke') . '</u></td><td><u>' . __('Meaning', 'bbnuke') . '</u></td></tr>
	<tr><td colspan="2"><hr /></td></tr>
	<tr><td>PO</td><td>' . __('Putouts', 'bbnuke') . '</td></tr>
	<tr><td>A</td><td>' . __('Assists', 'bbnuke') . '</td></tr>
    <tr><td>E</td><td>' . __('Errors', 'bbnuke') . '</td></tr>
	<tr><td>FP</td><td>' . __('Fielding Percentage', 'bbnuke') . '</td></tr>
        </table></td></tr></table>';

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;
 
  return;
}





function  bbnuke_widget_playerstats( $player_id = NULL, $bbnuke_echo = true )
{
  global $wpdb;
  global $wp_query;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $erainnings = bbnuke_get_option('bbnuke_era_innings');

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');
  
  $SORTBY    = $_POST['bbnuke_widget_tb_head_playerstats_sortby'];
  $SORTORDER = $_POST['bbnuke_widget_tb_head_playerstats_sortorder'];
  $player_id = $_COOKIE["playerID"];
  $game_results_page = get_permalink(bbnuke_get_option('bbnuke_game_results_page'));
  $bbnuke_content = NULL;
	
  if(!$player_id)
    $player_id = bbnuke_get_option('bbnuke_widget_playerstats_player_id');

  $query = 'SELECT playerID,teamname,firstname, middlename,lastname,positions,bats,throws,height,weight,jerseyNum,picLocation,profile ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_players WHERE playerID = ' . $player_id . ' AND season=' . $dseason . '';
  $result = mysql_query($query);
  if ($result)
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $presults[] =  $row;
    }
  }

  for ($m=0; $m < count($presults); $m++) 
  {
    list($playerID,$teamname,$firstname, $middlename,$lastname,$positions,$bats,$throws,$height,$weight,$jerseyNum,$picLocation,$profile) = $presults[$m];
    $usheight= bbnuke_get_height($height);
    if($picLocation)
      $bbnuke_content .= '<img src="' . $picLocation . '" align="left" alt="Player Image" class="bbnuke_players_img" /><br />';
    $bbnuke_content .= '<b>#' . $jerseyNum . '</b><br />';
    $bbnuke_content .= '<br /><b>' . $lastname . ', ' . $firstname . '</b><br />';
    $bbnuke_content .= '<br /><b>' . __('Positions:', 'bbnuke') . '</b> ' . $positions . '<br />';
    $bbnuke_content .= '<b>' . __('Bats:', 'bbnuke') . '</b> ' . $bats . '    <b>' . __('Throws:', 'bbnuke') . '</b>' . $throws . '<br />';
    if($height)
      $bbnuke_content .= '<b>' . __('Height:', 'bbnuke') . '</b> ' . $usheight . '';
    if($weight)
      $bbnuke_content .= ' <b>' . __('Weight:', 'bbnuke') . '</b>' . $weight . '';
    $bbnuke_content .= '<br /><div class="clear"></div>';
    if($profile)
      $bbnuke_content .= '<p><b>' . __('Player Profile:', 'bbnuke') . '</b> ' . $profile . '</p>';
  }

  $titLen=array('Game'=>'10','AB'=>'10','R'=>'10','H'=>'10','2B'=>'10','3B'=>'10','HR'=>'10',
                 'RE'=>'10','FC'=>'10','HP'=>'10','RBI'=>'10','BA'=>'10',
                 'OBP'=>'10','SLG'=>'10','OPS'=>'10','BB'=>'10','K'=>'10','LOB'=>'10','SB'=>'10');
  $titLink=array('Game'=>'','AB'=>'','R'=>'','H'=>'','2B'=>'','3B'=>'','HR'=>'',
                 'RE'=>'','FC'=>'','HP'=>'','RBI'=>'','BA'=>'',
                 'OBP'=>'','SLG'=>'','OPS'=>'','BB'=>'','K'=>'','LOB'=>'','SB'=>'');

  $bbnuke_content .= '<br /><b>' . __('Batting Statistics', 'bbnuke') . '</b><br /><table class="bbnuke-results-table"><tr> ';
  $bbnuke_content .= bbnuke_build_heading($SORTBY,$SORTORDER,$titLen,$titLink, 'playerstats', false);
  $bbnuke_content .= '</tr>';


  $query = 'SELECT baAB, baRuns, ba1b, ba2b, ba3b, baHR, baRE,baFC,baHP, baRBI, baBB, baK, baLOB, baSB,homeTeam,visitingTeam, hruns, vruns, gameDate, gameTime, s.gameID ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_boxscores b, ' . $wpdb->prefix . 'baseballNuke_stats st ' .
           ' LEFT JOIN ' . $wpdb->prefix . 'baseballNuke_schedule s ON st.gameID=s.gameID ' .
           ' WHERE playerID=' . $player_id . ' AND b.gameID=s.gameID AND battOrd>0 ' .
           ' AND DATE_FORMAT(gameDate,"%Y") = "' . $dseason . '" ORDER BY ';
  if($SORTBY=="" || !(preg_match('/^ba/',$SORTBY)))
  {
    $query.="gameDate ASC";
  }
  elseif($SORTBY=="bagameDate" && $SORTORDER=="D")
  {
    $query.="gameDate DESC";
  }
  elseif($SORTBY=="bagameDate" && $SORTORDER=="A")
  {
    $query.="gameDate ASC";
  }
  else
  {
    $query.=$SORTBY;
    switch($SORTORDER)
    {
      case "A":
        $query.=" ASC";
        break;
      case "D":
        $query.=" DESC";
        break;
    }
  }

  $result = mysql_query($query);
  if ( $result )
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $bresults[] = $row;
    }
  }

  for ($m=0; $m < count($bresults); $m++) 
  {
    list($baAB, $baRuns, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baHP, $baRBI, $baBB, $baK, $baLOB, $baSB, $homeTeam,
	$visitingTeam, $hruns, $vruns, $gameDate, $gameTime, $gameID) = $bresults[$m];
    $hits=$ba1b+$ba2b+$ba3b+$baHR;
    if ($baAB)
      $ba=round($hits/$baAB,3);
    $ba=strval($ba);
    $ba=str_pad($ba,5,"0");
    if($ba=="10000")
      $ba=substr($ba,0,-1);
    else
    {
      $ba=substr($ba,1);
      $ba=str_replace("0000","0",$ba);
    }
    if ( ($baAB+$baBB) )
      $obp= str_pad(str_replace("0.",".",round(($hits+$baBB+$baRE+$baFC+$baHP)/($baAB+$baBB),3)),4,"0",STR_PAD_RIGHT);
    if ($obp == "1000") 
      $obp = "1.000";
    if ($obp == "0") 
      $obp = ".000";
    if ( $baAB )
      $slg=round((($ba1b+($ba2b*2)+($ba3b*3)+($baHR*4))/$baAB),3);
    $slg=str_pad($slg,5,"0");
    if($slg=="1000")
      $slg=substr($slg,-1);
    else
    {
      $slg=substr($slg,1);
      $slg=str_replace("0000","0",$slg);
    }
    $ops=($obp+$slg);
    if ($baAB)
      $ba=round($hits/$baAB,3);
    $ba=strval($ba);
    $ba=str_pad($ba,5,"0");
    if($ba=="10000")
      $ba=substr($ba,0,-1);
    else
    {
      $ba=substr($ba,1);
      $ba=str_replace("0000","0",$ba);
    }
    list($year, $month, $day) = split("-", $gameDate);
    $modGameDate = date('M d', mktime(0, 0, 0, $month, $day, $year));

    $bbnuke_content .= '<tr><td style="text-align:left;"><a href="'.$game_results_page.'?gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'; 
    if($homeTeam==$dteam)
       $bbnuke_content .= $visitingTeam; 	 
    else
       $bbnuke_content .= ' @ ' . $homeTeam; 	 
         	 
    $bbnuke_content .= ' - ' . $modGameDate . '</a></td>
                        <td>' . $baAB . '</td>
                        <td>' . $baRuns . '</td>
                        <td>' . $hits . '</td>
                        <td>' . $ba2b . '</td>
                        <td>' . $ba3b . '</td>
                        <td>' . $baHR . '</td>
                        <td>' . $baRE . '</td>
                        <td>' . $baFC . '</td>
                        <td>' . $baHP . '</td>
                        <td>' . $baRBI . '</td>
                        <td>' . $ba . '</td>
			<td>' . $obp . '</td>
                        <td>' . $slg . '</td>
			<td>' . $ops . '</td>
			<td align="center">' . $baBB . '</td>
                        <td align="center">' . $baK . '</td>
                        <td align="center">' . $baLOB . '</td>
                        <td align="center">' . $baSB . '</td>';
  }
	

  unset($gresults);
  $query = 'SELECT sum(baAb) as baAB, sum(baRuns) as baR,sum(ba1b) as ba1b, sum(ba2b) as ba2b, ' .
           '       sum(ba3b) as ba3b, sum(baHR) as baHR,sum(baRE) as baRE,sum(baFC) as baFC,sum(baHP) as baHP, sum(baRBI) as baRBI, sum(baBB) as baBB, ' .
           '       sum(baK) as baK,sum(baLOB) as baLOB, sum(baSB) as baSB ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_stats st, ' . $wpdb->prefix . 'baseballNuke_schedule s ' .
           ' WHERE DATE_FORMAT(gameDate,"%Y") = "' . $dseason . '" AND st.gameID=s.gameID AND st.playerID = ' . $player_id . ' ';
  $result = mysql_query($query);
  if ( $result )
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $gresults[] = $row;
    }
  }

  for ($m=0; $m < count($gresults); $m++) 
  {
    list($baAB, $baR, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baHP, $baRBI, $baBB, $baK, $baLOB,$baSB) = $gresults[$m];
    $hits=$ba1b+$ba2b+$ba3b+$baHR;
    if ($baAB)
      $ba=round($hits/$baAB,3);
    $ba=strval($ba);
    $ba=str_pad($ba,5,"0");
    $ba=substr($ba,1);
    $ba=str_replace("0000","0",$ba);
    if ( ($baAB+$baBB) )
      $obp= str_pad(str_replace("0.",".",round(($hits+$baBB+$baRE+$baFC+$baHP)/($baAB+$baBB),3)),4,"0",STR_PAD_RIGHT);
    if ($obp == "1000") 
      $obp = "1.000";
    if ($obp == "0") 
      $obp = ".000";
    if ( $baAB )
      $slg=round((($ba1b+($ba2b*2)+($ba3b*3)+($baHR*4))/$baAB),3);
    $slg=str_pad($slg,5,"0");
    if($slg=="1000")
      $slg=substr($slg,-1);
    else 
    {
      $slg=substr($slg,1);
      $slg=str_replace("0000","0",$slg);
    }
    $ops=($obp+$slg);
    if ($baAB)
      $ba=round($hits/$baAB,3);
    $ba=strval($ba);
    $ba=str_pad($ba,5,"0");
    if($ba=="10000")
      $ba=substr($ba,0,-1);
    else
    {
      $ba=substr($ba,1);
      $ba=str_replace("0000","0",$ba);
    }

    $bbnuke_content .= '<tr><td style="text-align:left;"><b>' . __('TOTAL FOR ', 'bbnuke') . $dseason . __(' Season', 'bbnuke') . '</b></td>
	          <td><b>' . $baAB . '</b></td>
	          <td><b>' . $baR  . '</b></td>
	          <td><b>' . $hits . '</b></td>
	          <td><b>' . $ba2b . '</b></td>
	          <td><b>' . $ba3b . '</b></td>
	          <td><b>' . $baHR . '</b></td>
	          <td><b>' . $baRE . '</b></td>
	          <td><b>' . $baFC . '</b></td>
	          <td><b>' . $baHP . '</b></td>
	          <td><b>' . $baRBI . '</b></td>
	          <td><b>' . $ba .  '</b></td>
	          <td><b>' . $obp . '</b></td>
                  <td><b>' . $slg . '</b></td>
             	  <td><b>' . $ops . '</b></td>
		  <td align="center"><b>' . $baBB . '</b></td>
	          <td align="center"><b>' . $baK . '</b></td>
	          <td align="center"><b>' . $baLOB . '</b></td>
	          <td align="center"><b>' . $baSB . '</b></td>
	        </tr>';
  }
	

  //CAREER TOTAL BA
  $query = 'SELECT sum(baAb) as baAB, sum(baRuns) as baR,sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b, ' .
           '       sum(baHR) as baHR,sum(baRE) as baRE,sum(baFC) as baFC, sum(baHP) as baHP, ' .
           '       sum(baRBI) as baRBI, sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB,sum(baSB) as baSB ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_stats st, ' . $wpdb->prefix . 'baseballNuke_schedule s ' .
           ' WHERE st.gameID=s.gameID AND st.playerID = ' . $player_id . ' ';
  $result = mysql_query($query);
  if ( $result )
  {
    $row = mysql_fetch_array($result);
  }

  list($baAB, $baR, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baHP, $baRBI, $baBB, $baK, $baLOB,$baSB) = $row;
  $hits=$ba1b+$ba2b+$ba3b+$baHR;
  if ($baAB)
    $ba=round($hits/$baAB,3);
  $ba=strval($ba);
  $ba=str_pad($ba,5,"0");
  $ba=substr($ba,1);
  $ba=str_replace("0000","0",$ba);
  if ( ($baAB+$baBB) )
    $obp= str_pad(str_replace("0.",".",round(($hits+$baBB+$baRE+$baFC+$baHP)/($baAB+$baBB),3)),4,"0",STR_PAD_RIGHT);
  if ($obp == "1000") 
    $obp = "1.000";
  if ($obp == "0") 
    $obp = ".000";
  if ($baAB)
    $slg=round((($ba1b+($ba2b*2)+($ba3b*3)+($baHR*4))/$baAB),3);
  $slg=str_pad($slg,5,"0");
  if($slg=="1000")
    $slg=substr($slg,-1);
  else
  {
    $slg=substr($slg,1);
    $slg=str_replace("0000","0",$slg);
  }
  $ops=($obp+$slg);
  if ($baAB)
    $ba=round($hits/$baAB,3);
  $ba=strval($ba);
  $ba=str_pad($ba,5,"0");
  if($ba=="10000")
    $ba=substr($ba,0,-1);
  else
  {
    $ba=substr($ba,1);
    $ba=str_replace("0000","0",$ba);
  }
  $bbnuke_content .= '<tr><td style="text-align:left;"><b>' . __('CAREER AS ', 'bbnuke') . $dteam . ' *</b></td>
		      <td><b>' . $baAB . '</b></td>
		      <td><b>' . $baR . '</b></td>
		      <td><b>' . $hits . '</b></td>
		      <td><b>' . $ba2b . '</b></td>
		      <td><b>' . $ba3b . '</b></td>
		      <td><b>' . $baHR . '</b></td>
		      <td><b>' . $baRE . '</b></td>
		      <td><b>' . $baFC . '</b></td>
		      <td><b>' . $baHP . '</b></td>
		      <td><b>' . $baRBI . '</b></td>
		      <td><b>' . $ba . '</b></td>
		      <td><b>' . $obp . '</b></td>
		      <td><b>' . $slg . '</b></td>
		      <td><b>' . $ops . '</b></td>
		      <td align="center"><b>' . $baBB . '</b></td>
		      <td align="center"><b>' . $baK . '</b></td>
		      <td align="center"><b>' . $baLOB . '</b></td>
		      <td align="center"><b>' . $baSB . '</b></td>
		    </tr>'; 
    
  $bbnuke_content .= '<tr><td>&nbsp;<br />&nbsp;<br /></td></tr>   </table>';


  //	PITCHING STATS
  $query = 'SELECT piWin, piLose, piSave, piIP, piHits, piRuns, piER, piWalks, piSO,homeTeam, visitingTeam, hruns, vruns, gameDate, gameTime ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_boxscores b, ' . $wpdb->prefix . 'baseballNuke_stats st ' .
           ' LEFT JOIN ' . $wpdb->prefix . 'baseballNuke_schedule s ON st.gameID=s.gameID ' .
           ' WHERE playerID = ' . $player_id . ' AND b.gameID=s.gameID AND DATE_FORMAT(gameDate,"%Y") = "' . $dseason . '" AND pitchOrd>0 ORDER BY ';

  if($SORTBY=="" || !(preg_match('/^pi/',$SORTBY)))
  {
    $query.='gameDate ASC';
  }
  elseif($SORTBY=="pigameDate" && $SORTORDER=="D")
  {
    $query.='gameDate DESC';
  }
  elseif($SORTBY=="pigameDate" && $SORTORDER=="A")
  {
    $query.='gameDate ASC';
  }
  else
  {
    $query.=$SORTBY;
    switch($SORTORDER)
    {
      case "A":
        $query.=' ASC';
        break;
      case "D":
        $query.=' DESC';
        break;
    }
  }

  $result = mysql_query($query);
  if ($result)
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $pitchresults[] = $row;
      $showPitchingStats+=$row['piIP'];
    }
  }
if ($showPitchingStats>0)
{
  $titLen=array('Game'=>'','W'=>'','L'=>'','S'=>'','IP'=>'','H'=>'','R'=>'','ER'=>'','BB'=>'','K'=>'','ERA'=>'');
  $titLink=array('Game'=>'pigameDate','W'=>'piWin','L'=>'piLose','S'=>'piSave','IP'=>'piIP','H'=>'piHits','R'=>'piRuns',
                 'ER'=>'piER','BB'=>'piWalks','K'=>'piSO','ERA'=>'');
	
  $bbnuke_content .= '<b>' . __('Pitching Statistics', 'bbnuke') . '</b><br /><table class="bbnuke-results-table"><tr> ';
  $bbnuke_content .= bbnuke_build_heading($SORTBY,$SORTORDER,$titLen,$titLink, 'playerstats',false);
  $bbnuke_content .= '</tr>';

  for ($m=0; $m < count($pitchresults); $m++) 
  {
    list($piWin,$piLose, $piSave, $piIP, $piHits, $piRuns, $piER, $piWalks, $piSO, $homeTeam, $visitingTeam, $hruns, $vruns, 
	  	$gameDate, $gameTime) = $pitchresults[$m];
    $hits=$ba1b+$ba2b+$ba3b+$baHR;
    if ($piIP > 0)
      $ERA=($piER/$piIP)*$erainnings;
    $ERA=round($ERA,2);
    $bbnuke_content .= '<tr><td style="text-align:left;"><a href="'.$game_results_page.'?gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'; 
    if($homeTeam==$dteam) 	 
      $bbnuke_content .= $visitingTeam; 	 
    else 	 
      $bbnuke_content .= $homeTeam; 	 
         	 
    $bbnuke_content .= ' on ' . $gameDate . '</a></td>
			  <td>' . $piWin . '</td>
		          <td>' . $piLose . '</td>
		          <td>' . $piSave . '</td>
		          <td>' . $piIP . '</td>
		          <td>' . $piHits . '</td>
		          <td>' . $piRuns . '</td>
		          <td>' . $piER . '</td>
		          <td>' . $piWalks . '</td>
		          <td>' . $piSO . '</td>
		          <td>' . $ERA . '</td>
		        </tr>';
  }
	

  //PITCHING TOTAL
  unset($pitchresults);
  $query = 'SELECT sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, ' .
           '       sum(piIP) as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, ' . 
           '       sum(piWalks) as piWalks, sum(piSO) as piSO ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_stats st, ' . $wpdb->prefix . 'baseballNuke_schedule s ' .
           ' WHERE pitchOrd>0 AND DATE_FORMAT(gameDate,"%Y") = "' . $dseason . '" AND st.gameID=s.gameID AND ' .
           '       st.playerID = ' . $player_id . ' ';
  $result = mysql_query($query);
  if ($result)
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $pitchresults[] = $row;
    }
  }

  for ($m=0; $m < count($pitchresults); $m++) 
  {
    list($piWin,$piLose, $piSave, $piIP, $piHits, $piRuns, $piER, $piWalks, $piSO) = $pitchresults[$m];
    if ($piIP > 0)
      $ERA=($piER/$piIP)*$erainnings;
    $ERA=round($ERA,2);
    $bbnuke_content .= '<tr><td style="text-align:left;"><b>' . __('TOTAL FOR ', 'bbnuke') . $dseason . __(' Season', 'bbnuke') . '</b></td>
	 	<td><b>' . $piWin . '</b></td>
         	<td><b>' . $piLose . '</b></td>
             	<td><b>' . $piSave . '</b></td>
             	<td><b>' . $piIP . '</b></td>
             	<td><b>' . $piHits . '</b></td>
             	<td><b>' . $piRuns . '</b></td>
             	<td><b>' . $piER . '</b></td>
      	     	<td><b>' . $piWalks . '</b></td>
             	<td><b>' . $piSO . '</b></td>
             	<td><b>' . $ERA . '</b></td>
		</tr>';
  }

  unset($pitchresults);
  //CAREER PITCHING TOTAL
  $query = 'SELECT sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, sum(piIP) as piIP, ' . 
           '       sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, ' .
           '       sum(piWalks) as piWalks, sum(piSO) as piSO ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_stats st, ' . $wpdb->prefix . 'baseballNuke_schedule s ' . 
           ' WHERE pitchOrd>0 AND st.gameID=s.gameID AND st.playerID = '. $player_id . ' ';
  $result = mysql_query($query);
  if ($result)
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $pitchresults[] = $row;
    }
  }

  for ($m=0; $m < count($pitchresults); $m++) 
  {
    list($piWin,$piLose, $piSave, $piIP, $piHits, $piRuns, $piER, $piWalks, $piSO) = $pitchresults[$m];
    if ($piIP > 0)
      $ERA=($piER/$piIP)*$erainnings;
    $ERA=round($ERA,2);
    $bbnuke_content .= '<tr><td style="text-align:left;"><b>' . __('CAREER AS ', 'bbnuke') . $dteam . ' *</b></td>
		     <td><b>' . $piWin . '</b></td>
	             <td><b>' . $piLose . '</b></td>
	             <td><b>' . $piSave . '</b></td>
	             <td><b>' . $piIP  . '</b></td>
	             <td><b>' . $piHits . '</b></td>
	             <td><b>' . $piRuns . '</b></td>
	             <td><b>' . $piER . '</b></td>
	             <td><b>' . $piWalks . '</b></td>
	             <td><b>' . $piSO . '</b></td>
	             <td><b>' . $ERA . '</b></td> </tr>';
  }
  $bbnuke_content .= '</table>';
}
  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}







function  bbnuke_widget_top5stats( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $erainnings = bbnuke_get_option('bbnuke_era_innings');

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  $bbnuke_content = NULL;

  #
  # bat stats
  #

  $heading_arr = array(
      __('Team Leader In Hits', 'bbnuke'),
      __('Team Leader In Home Runs', 'bbnuke'),
      __('Team Leader In RBI`s', 'bbnuke'),
      __('Team Leader In Best Batting Average', 'bbnuke'),
      __('Team Leader In Slugging Percentage', 'bbnuke'),
      __('Team Leader In On Base Percentage', 'bbnuke')
      ); 

  for ( $i=0; $i < 6; $i++)
  {
    $bbnuke_content .= '<table class="bbnuke-results-table">';
    $bbnuke_content .= '<tr><th colspan="20">'.$heading_arr[$i].'</th></tr>';
 
    $bbnuke_content .= '     <tr>
       	       <td width="25"><b>#</b></td>
               <td width="125"><b>' . __('Batting', 'bbnuke') . '</b></td>
               <td width="25"><b>AB</b></td>
               <td width="25"><b>R</b></td>
               <td width="25"><b>H</b></td>
               <td width="25"><b>2B</b></td>
               <td width="25"><b>3B</b></td>
               <td width="25"><b>HR</b></td>
               <td width="25"><b>RE</b></td>
               <td width="25"><b>FC</b></td>
               <td width="25"><b>HP</b></td>

               <td width="25"><b>RBI</b></td>
               <td width="35" align="center"><b>BA</b></td>
               <td width="35" align="center"><b>OBP</b></td>
	       <td width="35" align="center"><b>SLG</b></td>
	       <td width="35" align="center"><b>OPS</b></td>
	       <td width="25" align="center"><b>BB</b></td>
               <td width="25" align="center"><b>K</b></td>
               <td width="25" align="center"><b>LOB</b></td>
               <td width="25" align="center"><b>SB</b></td>
            </tr>';

    //BATTING STATS
    //order of most home hits.
    switch ($i)
    {
      case 0:
        $query = 'SELECT p.playerID, lastname, firstname, middlename, jerseyNum, sum(ba1b+ba2b+ba3b+baHR) as baH ' .
                 '  FROM ' . $wpdb->prefix . 'baseballNuke_players p, ' . $wpdb->prefix . 'baseballNuke_stats st, ' . $wpdb->prefix . 'baseballNuke_schedule s ' .
                 ' WHERE teamName = "' . $dteam . '" AND DATE_FORMAT(gameDate,"%Y") = "' . $dseason . '" AND ' .
                 '       p.playerID=st.playerID AND st.gameID=s.gameID  AND p.season=DATE_FORMAT(gameDate,"%Y") ' .
                 ' GROUP BY p.playerID ORDER BY baH DESC';
        break;
      case 1:
        //order of most home runs.
        $query = "SELECT p.playerID, lastname, firstname, middlename, jerseyNum, sum(baHR) as baHR " . 
                 "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_schedule  s " .
                 " WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND p.playerID=st.playerID AND " .
                 "       st.gameID=s.gameID AND p.season=DATE_FORMAT(gameDate,'%Y') " .
                 " GROUP BY p.playerID ORDER BY baHR DESC";
        break;
      case 2:
        //order of most RBI.
        $query = "SELECT p.playerID, lastname, firstname, middlename, jerseyNum, sum(baRBI) as baRBI " .
                 "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
                 " WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND p.playerID=st.playerID AND " .
                 "       st.gameID=s.gameID  AND p.season=DATE_FORMAT(gameDate,'%Y') " .
                 " GROUP BY p.playerID ORDER BY baRBI DESC";
        break;
      case 3:
        //order of most best Batting Average. ba = (hits/ab) & hits=ba1b+ba2b+ba3b+bahr.
        $query = "SELECT p.playerID, lastname, firstname, middlename, jerseyNum, sum(ba1b+ba2b+ba3b+baHR)/sum(baAB) as baBA " .
                 "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
                 " WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND p.playerID=st.playerID AND " .
                 "       st.gameID=s.gameID AND p.season=DATE_FORMAT(gameDate,'%Y') GROUP BY p.playerID ORDER BY baBA DESC";
        break;
      case 4:
        //order of best SP. sp = (ba1b+ba2b*2+ba3b*3+bahr*4/ab)
        $query  = "SELECT p.playerID, lastname, firstname, middlename, jerseyNum, sum(ba1b+ba2b*2+ba3b*3+baHR*4)/sum(baAB) as baSP " .
                   "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
                   " WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND p.playerID=st.playerID AND " .
                   "       st.gameID=s.gameID  AND p.season=DATE_FORMAT(gameDate,'%Y') GROUP BY p.playerID ORDER BY baSP DESC";
        break;
      case 5:
        //order of best OBP. OBP = ($hits+$baBB+$baRE+$baFC+$baHP)/($baAB+$baBB)
        $query = "SELECT p.playerID, lastname, firstname, middlename, jerseyNum,sum(ba1b+ba2b+ba3b+baHR+baBB+baRE+baFC+baHP)/sum(baAB+baBB) as baOBP " .
                 "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
                 " WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND p.playerID=st.playerID AND " .
                 "       st.gameID=s.gameID  AND p.season=DATE_FORMAT(gameDate,'%Y') GROUP BY p.playerID ORDER BY baOBP DESC";
        break;
    }

    $result = mysql_query($query);
    if ( $result )
      while ( $row = mysql_fetch_array($result) )
        $presults[] = $row;

    for ($m=0; $m < $team_leaders; $m++) 
    {
      list($playerID, $lastname, $firstname, $middlename, $jerseyNum, $notused) = $presults[$m];
      $query = "SELECT sum(baRuns) as baR, sum(baAb) as baAB, sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b, " .
               "       sum(baHR) as baHR, sum(baRE) as baRE, sum(baFC) as baFC, sum(baHP) as baHP, sum(baRBI) as baRBI, " .
               "       sum(baBB) as baBB, sum(baK) as baK, sum(baLOB)as baLOB, sum(baSB) as baSB " .
               "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
               " WHERE teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND p.playerID=".$playerID." AND " . 
               "       p.playerID=st.playerID AND st.gameID=s.gameID  AND p.season=DATE_FORMAT(gameDate,'%Y') " .
               " GROUP BY p.playerID";
               // ORDER BY lastname,firstname ASC";
      $result = mysql_query($query);
      if( $result )
        while ( $row = mysql_fetch_array($result) )
          $gresults[] = $row;

      list($baR, $baAB, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baHP, $baRBI, $baBB, $baK, $baLOB, $baSB) = $gresults[0];
      $hits=$ba1b+$ba2b+$ba3b+$baHR;
      if ( $baAB )
        $slg=round((($ba1b+($ba2b*2)+($ba3b*3)+($baHR*4))/$baAB),3);
      $slg=str_pad($slg,5,"0");
      if($slg=="1000"){
        $slg=substr($slg,-1);
      }else{
        $slg=substr($slg,1);
        $slg=str_replace("0000","0",$slg);
      }
      if ( ($baAB+$baBB) ) 
        $obp= str_pad(str_replace("0.",".",round(($hits+$baBB+$baRE+$baFC+$baHP)/($baAB+$baBB),3)),4,"0",STR_PAD_RIGHT);
      if ($obp == "1000") { $obp = "1.000";}
      if ($obp == "0") { $obp = ".000";}
      $ops=($obp+$slg);
      if ( $baAB )
        $ba=round($hits/$baAB,3);
      $ba=strval($ba);
      $ba=str_pad($ba,5,"0");
      if($ba=="10000"){
        $ba=substr($ba,0,-1);
      }else{
        $ba=substr($ba,1);
        $ba=str_replace("0000","0",$ba);
      }
    }

    $bbnuke_content .= '<tr><td width="25">'.$jerseyNum.'</td>';
    $bbnuke_content .= '<td width="125"><a href="" onclick="bbnuke_show_players_info(' . $playerID . ')" title="' . __('Show Players Info', 'bbnuke') . '" >'.$lastname.', '.$firstname.'</a></td>';
    if( $result )
    {
      $bbnuke_content .= '
			<td width="25">'.$baAB.'</td>
			<td width="25">'.$baR.'</td>
			<td width="25">';
      if ( $i == 0 ) 
        $bbnuke_content .= '<b>';
      $bbnuke_content .= $hits;
      if ( $i == 0 ) 
        $bbnuke_content .= '</b>';
      $bbnuke_content .= '</td>
			<td width="25">'.$ba2b.'</td>
			<td width="25">'.$ba3b.'</td>
			<td width="25">';
      if ($i == 1) 
        $bbnuke_content .= '<b>';
      $bbnuke_content .= $baHR;
      if ($i == 1) 
        $bbnuke_content .= '</b>';
      $bbnuke_content .= '</td>
			<td width="25">'.$baRE.'</td>
			<td width="25">'.$baFC.'</td>
			<td width="25">'.$baHP.'</td>
			<td width="25">';
      if ($i == 2 ) 
        $bbnuke_content .= '<b>';
      $bbnuke_content .= $baRBI;
      if ($i == 2) 
        $bbnuke_content .= '</b>';
      $bbnuke_content .= '</td>
			<td width="35">';
      if ($i == 3) 
        $bbnuke_content .= '<b>';
      $bbnuke_content .= $ba;
      if ($i == 3) 
        $bbnuke_content .= '</b>';
      $bbnuke_content .= '</td>	<td width="35">';
      if ($i == 5) 
        $bbnuke_content .= '<b>';
      $bbnuke_content .=  $obp;
      if ($i == 5) 
        $bbnuke_content .= '</b>';
      $bbnuke_content .= '</td>	<td width="25">';
      if ($i == 4) 
        $bbnuke_content .= '<b>';
      $bbnuke_content .= $slg;
      if ($i == 4) 
        $bbnuke_content .= '</b>';
      $bbnuke_content .= '</td>
			<td width="35">'.$ops.'</td>
			<td width="25" align="center">'.$baBB.'</td>
			<td width="25" align="center">'.$baK.'</td>
			<td width="25" align="center">'.$baLOB.'</td>
			<td width="25" align="center">'.$baSB.'</td>';
    }
    $bbnuke_content .= '</tr>';

    //removed totals, check out batStats to see what was here.
    $bbnuke_content .= '</table><br /><br />';
  }


  #
  # field stats
  #
  $heading_arr = array(
      __('Team Leader In Fewest Errors', 'bbnuke'),
      __('Team Leader In Most Put Outs', 'bbnuke'),
      __('Team Leader In Best Fielding Percentage', 'bbnuke')
    );

  for ( $i=0; $i <= 2; $i++)
  {
    $bbnuke_content .= '<table class="bbnuke-results-table">';
    $bbnuke_content .= '<tr><th colspan="6">' . $heading_arr[$i] . '</th></tr>';

    $bbnuke_content .= '   <tr>
               <td width="25"><b>#</b></td>
               <td width="245"><b>' . __('Fielding', 'bbnuke') . '</b></td>
               <td width="25"><b>PO</b></td>
               <td width="25"><b>A</b></td>
               <td width="25"><b>E</b></td>
               <td width="35"><b>FP</b></td>
             </tr>';

    //Fielding STATS
    switch ($i)	
    {
      case 0:
        // least amount of errors
	$query = "SELECT p.playerID, p.lastname, p.firstname, p.middlename, p.jerseyNum, sum(fiE) as fiE FROM ".$prefix."_baseballNuke_players p left join ".$prefix."_baseballNuke_stats s on p.playerID=s.playerID where season='".$_COOKIE["season"]."' group by p.lastname ORDER BY fiE ASC";
        break;
      case 1:
        // most put outs
	$query = "SELECT p.playerID, p.lastname, p.firstname, p.middlename, p.jerseyNum, sum(fiPO) as fiPO FROM ".$prefix."_baseballNuke_players p left join ".$prefix."_baseballNuke_stats s on p.playerID=s.playerID where season='".$_COOKIE["season"]."' group by p.lastname ORDER BY fiPO DESC";
        break;
      case 2:
        //best fielding percentage : fp = ($fiPO+$fiA)/($fiPO+$fiA+$fiE)
        $query = "SELECT p.playerID, p.lastname, p.firstname, p.middlename, p.jerseyNum, sum(fiPO+fiA)/sum(fiPO+fiA+fiE) as fiFP FROM ".$prefix."_baseballNuke_players p left join ".$prefix."_baseballNuke_stats s on p.playerID=s.playerID where season='".$_COOKIE["season"]."' group by p.lastname ORDER BY fiFP DESC";
        break;
    }

    $result = mysql_query($query);
    if ( $result )
    while ( $row = mysql_fetch_array($result) )
      $presults[] = $row;

    for ( $members=0; $members < $team_leaders; $members++) 
    {
      list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $UselessNumber) = $presults[$members];

      $query = "SELECT sum(fiPO)as fiPO, sum(fiA) as fiA, sum(fiE) as fiE " .
               "  FROM ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_schedule s " .
               " WHERE p.playerID=".$playerID." AND teamName='".$dteam."' AND DATE_FORMAT(gameDate,'%Y')='".$dseason."' AND " .
               "       p.playerID=st.playerID AND st.gameID=s.gameID AND p.season=DATE_FORMAT(gameDate,'%Y')";
      $result = mysql_query($query);
      if ( $result )
      {
        $row = mysql_fetch_array($result);
        list($fiPO,$fiA, $fiE) = $row;

        $SumfiPO += $fiPO;
        $SumfiA  += $fiA;
        $SumfiE  += $fiE;

        for ($m=0; $m < 1; $m++)
        {
          if ( ($fiPO+$fiA+$fiE) )
            $FP= str_pad(str_replace("0.",".",round(($fiPO+$fiA)/($fiPO+$fiA+$fiE),3)),4,"0",STR_PAD_RIGHT);
          if ($FP == "1000") 
            $FP = "1.000";
          if (!$FP) 
            $FP =0;
          $bbnuke_content .= '<tr>
			    <td>'.$jerseyNum.'</td>
	    		    <td align="left"><a href="" onclick="bbnuke_show_players_info('.$playerID.')" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  	    <td>';
          if ($i ==1) 
            $bbnuke_content .= '<b>';
          $bbnuke_content .= $fiPO;
          if ($i ==1) 
            $bbnuke_content .= '</b>';
          $bbnuke_content .= '</td><td>'.$fiA.'</td>
		            <td>';
          if ($i ==0) 
            $bbnuke_content .= '<b>';
          $bbnuke_content .= $fiE;
          if ($i ==0) 
            $bbnuke_content .= '</b>';
          $bbnuke_content .= '</td>
		            <td>';
          if ($i ==2) 
            $bbnuke_content .= '<b>';
          $bbnuke_content .= $FP;
          if ($i == 2) 
            $bbnuke_content .= '</b>';
          $bbnuke_content .= '</td>  </tr>';
        }
      }
    }

    $bbnuke_content .= '</table><br /><br />';
  }



  #
  # pitch stats
  #

  for ($i=0; $i<=1; $i++)
  {
    $bbnuke_content .= '<table class="bbnuke-results-table">';
    switch ($i)
    {
      case 0:
        $bbnuke_content .= '<tr><th colspan="20">' . __('Team Leader In Least ERA', 'bbnuke') . '</th></tr>';
        break;
      case 1:
        $bbnuke_content .= '<tr><td>&nbsp;</td></tr><tr><th colspan="20">' . __('Team Leader In Most Strikeouts', 'bbnuke') . '</th></tr>';
        break;
    }

    $bbnuke_content .= '   <tr>
               <td width="25"><b>#</b></td>
               <td width="245"><b>' . __('Pitching', 'bbnuke') . '</b></td>
               <td width="25"><b>W</b></td>
               <td width="25"><b>L</b></td>
               <td width="25"><b>S</b></td>
               <td width="35"><b>IP</b></td>
               <td width="25"><b>H</b></td>
               <td width="25"><b>R</b></td>
               <td width="25"><b>ER</b></td>
               <td width="25"><b>BB</b></td>
               <td width="25"><b>K</b></td>
               <td width="35"><b>ERA</b></td>
            </tr>';

    //PITCHING STATS
    if ($i == 0) 
    {
      $query = "SELECT DISTINCT p.playerID, lastname, firstname, middlename, jerseyNum, ".
		" sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave,sum(piIP) as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns,".
		"  sum(piER) as piER,sum(piWalks) as piWalks, sum(piSO) as piSO, round(sum((piER/piIP)*".$erainnings."),2) as ERA ".
		" FROM ".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_schedule s ".
		" WHERE s.gameID=st.gameID AND p.season='".$dseason."' AND DATE_FORMAT(gameDate, '%Y')='".$dseason."' ".
		" AND piIP>0 AND st.playerID=p.playerID GROUP BY playerID ORDER BY ERA ASC LIMIT ".$team_leaders;
    }
    else if($i==1)
    {
      $query = "SELECT DISTINCT p.playerID, lastname, firstname, middlename, jerseyNum, ".
		" sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave,sum(piIP) as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns,".
		"  sum(piER) as piER,sum(piWalks) as piWalks, sum(piSO) as piSO, round(sum((piER/piIP)*".$erainnings."),2) as ERA ".
		" FROM ".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_schedule s ".
		" WHERE s.gameID=st.gameID AND p.season='".$dseason."' AND DATE_FORMAT(gameDate, '%Y')='".$dseason."' ".
		" AND piIP>0 AND st.playerID=p.playerID GROUP BY playerID ORDER BY piSO DESC LIMIT ".$team_leaders;
    }
	
    unset($presults);
    $result = mysql_query($query);
    if ( $result )
      while ( $row = mysql_fetch_array($result) )
        $presults[] = $row;

    for ($m=0; $m < count($presults); $m++) 
    {
      list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $piWin,$piLose, $piSave, $piIP, $piHits, $piRuns, $piER, $piWalks, $piSO,$ERA) = $presults[$m];
      $bbnuke_content .= '<tr>
			    <td>'.$jerseyNum.'</td>
	    		    <td align="left"><a href="" onclick="show_players_info('.$playerID.')" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  	    <td>'.$piWin.'</td>
		            <td>'.$piLose.'</td>
		            <td>'.$piSave.'</td>
		            <td>'.$piIP.'</td>
		            <td>'.$piHits.'</td>
		            <td>'.$piRuns.'</td>
		            <td>'.$piER.'</td>
		            <td>'.$piWalks.'</td>
		            <td>'.$piSO.'</td>
		            <td>'.$ERA.'</td>
			</tr>';
    }
	
    $bbnuke_content .= "</table>";
  }

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}


function  bbnuke_widget_team_schedule( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $game_results_page = get_permalink(bbnuke_get_option('bbnuke_game_results_page'));
  $locations_page = get_permalink(bbnuke_get_option('bbnuke_locations_page'));
  $timeformat = get_option('time_format');
  $dateformat = get_option('date_format');
  $bbnuke_content = NULL;

  $bbnuke_content = 
	'<table class="bbnuke-schedule-table">
	<tr>  
	  <th>' . __('Game Date', 'bbnuke') . '</th>
 	  <th>' . __('Home', 'bbnuke') . '</th>
	  <th>' . __('Visitor', 'bbnuke') . '</th>
	  <th>' . __('Field', 'bbnuke') . '</th>
	</tr>';
		
  $query = "SELECT s.gameID,gameTime,gameDate,homeTeam,visitingTeam, field, vruns, hruns " .
           "FROM " . $wpdb->prefix . "baseballNuke_schedule s " . 
                 " LEFT JOIN " .$wpdb->prefix . "baseballNuke_boxscores b ON s.gameID = b.gameID " .
                 " WHERE DATE_FORMAT(gameDate,'%Y')= '" . $dseason . "' " .
                 " AND (homeTeam='" . $dteam . "' OR visitingTeam='" . $dteam . "') AND (visitingTeam != 'practice') AND (visitingTeam != 'tournament') " .
		 "ORDER BY gameDate ASC";
  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
  {
    $schedule[] = $row;
  }

  for ($m=0; $m < count($schedule); $m++) 
  {
    list($gameID,$gameTime,$gameDate,$homeTeam,$visitingTeam,$field,$vruns,$hruns) = $schedule[$m];
    list($year, $month, $day) = split("-", $gameDate);
    $modGameDate = date('M d', mktime(0, 0, 0, $month, $day, $year));
 
    $date =date_create("$gameDate $gameTime");
    $bbnuke_content .= "<tr>";
    $wt = ($hruns > $vruns) ? 1 : 2;

    if($dteam == $homeTeam)
    {
         $result = ($wt == 1) ? 'Win' : 'Loss';
         $score = ($wt == 1) ? $hruns.' - '.$vruns : $vruns.' - '.$hruns;
    }
    else {
         $result = ($wt == 2) ? 'Win' : 'Loss';
         $score = ($wt == 1) ? $hruns.' - '.$vruns : $vruns.' - '.$hruns;
    }

    if(!is_null($hruns))
    {
      $bbnuke_content .= '<td><a href="'.$game_results_page.'?gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'.$result.' '.$score.'</a></td>';
    }
    else
    {
      $bbnuke_content .= '<td>'.date_format($date,"$dateformat $timeformat").'</td>';
    }
      $bbnuke_content .= '<td>'.$homeTeam.'</td>';
      $bbnuke_content .= '<td>'.$visitingTeam.'</td>';
    if(!is_null($hruns))
    {
       $bbnuke_content .= '<td><a href="' . $game_results_page . '?gameID=' . $gameID . '">Game Recap / Box Score</a></td>';
    }
    else
    {
            $bbnuke_content .= '<td><a href="' . $locations_page . '?field=' . $field . '" title="' . __('Show Locations Info', 'bbnuke') . '">'.$field.'</a></td>';
        }
    $bbnuke_content .= '</tr>';
  }
  $bbnuke_content .= "</table>";

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_team_practices( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $locations_page = get_permalink(bbnuke_get_option('bbnuke_locations_page'));
  $bbnuke_content = NULL;

  $bbnuke_content .= '<table class="bbnuke-schedule-table">
	<tr>
	  <th><b>' . __('Practice Date', 'bbnuke') . '</b></td>
	  <th><b>' . __('Field', 'bbnuke') . '</b></td>
	  <th><b>' . __('Notes', 'bbnuke') . '</b></td>
	</tr>';

  $query = "SELECT s.gameID, DATE_FORMAT(gameDate,'%c-%d-%Y') Gdate, TIME_FORMAT(gameTime,'%h:%i') Gtime, field, Notes " .
           "FROM " . $wpdb->prefix . "baseballNuke_schedule s WHERE DATE_FORMAT(gameDate,'%Y') = '" . $dseason . 
           "' AND visitingTeam = 'practice' ORDER BY gameDate ASC";
  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
  {
    $practices[] = $row;
  }

  for ($m=0; $m < count($practices); $m++) 
  {
    list($gameID,$Gdate,$Gtime,$field, $Notes) = $practices[$m];
    $bbnuke_content .= '<tr><td>'.$Gdate.' @ '.$Gtime.'</td>';
    $bbnuke_content .= '<td><a href="' . $locations_page . '?field=' . $field . '" title="' . __('Show Locations Info', 'bbnuke') . '" >'.$field.'</a></td>';
    $bbnuke_content .= '<td>'.$Notes.'</td></tr>';
  }

  $bbnuke_content .= "</table>";

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_team_tournament( $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $locations_page = get_permalink(bbnuke_get_option('bbnuke_locations_page'));
  $bbnuke_content = NULL;

  $bbnuke_content .= '<table class="bbnuke-schedule-table">
	<tr>
	  <th><b>' . __('Tournament Date', 'bbnuke') . '</b></td>
	  <th><b>' . __('Type', 'bbnuke') . '</b></td>
	  <th><b>' . __('Location', 'bbnuke') . '</b></td>
	  <th><b>' . __('Notes', 'bbnuke') . '</b></td>
	</tr>';

  $query = "SELECT s.gameID, DATE_FORMAT(gameDate,'%c-%d-%Y') Gdate, TIME_FORMAT(gameTime,'%h:%i') Gtime, " .
           " field, Type, Notes " . 
           " FROM " . $wpdb->prefix . "baseballNuke_schedule s " .
           " WHERE DATE_FORMAT(gameDate,'%Y') = '" . $dseason . "' AND visitingTeam = 'tournament' ORDER BY gameDate ASC";
  $resultSchedule = mysql_query($query);
  while ( $row = mysql_fetch_array($resultSchedule) )
  {
    $tournaments[] = $row;
  }

  for ($m=0; $m < count($tournaments); $m++) 
  {
    list($gameID,$Gdate,$Gtime,$field, $Type, $Notes) = $tournaments[$m];

    $bbnuke_content .= '<tr><td>'.$Gdate.' @ '.$Gtime.'</td>';
    $bbnuke_content .= '<td>'.$Type.'</td>';
    $bbnuke_content .= '<td><a href="' . $locations_page . '?field=' . $field . '" title="' . __('Show Locations Info', 'bbnuke') . '">'.$field.'</a></td>';
    $bbnuke_content .= '<td>'.$Notes.'</td></tr>';
  }

  $bbnuke_content .= "</table>";

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_locations_info( $bbnuke_echo = true )
{
  global $wpdb;

  $bbnuke_content = NULL;

  $field = $_GET['field'];

  $query = "SELECT DISTINCT fieldname, directions FROM ".$wpdb->prefix."baseballNuke_locations ";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
      $field_arr[] = $row;
  else
    return false;

  if (empty($field_arr))
    return false;

  $bbnuke_content .= '<form action="" name="name" method="get">
        <table>
        <tr>
          <td>
            <select size="1" name="field">';

  for ($i=0; $i < count($field_arr); $i++ )
  {
    if ( $field_arr[$i]['fieldname'] == $field )
    {
      $bbnuke_content .= '<option selected="selected" value="' . $field_arr[$i]['fieldname'] . '">' . $field_arr[$i]['fieldname'] . '</option>' . "\n";
      $field_key = $i;
    }
    else
      $bbnuke_content .= '<option value="' . $field_arr[$i]['fieldname'] . '">' . $field_arr[$i]['fieldname'] . '</option>' . "\n";
  }

  $bbnuke_content .= '    </select>&nbsp;
            <input type="submit" value="' . __('Set Location', 'bbnuke') . '" />
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">
          <h3><b>'.$field.'</b></h3> 
          </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>';

  if ( $field_arr[$field_key]['directions'] )
    $bbnuke_content .= $field_arr[$field_key]['directions'];
  else
    $bbnuke_content .= __('No info for that field were found.', 'bbnuke') . "\n";

  $bbnuke_content .= "  </td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr></table></form>" . "\n";

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_game_results( $game_id = NULL, $player_id = NULL, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $bbnuke_content = NULL;
  $game_id = $_COOKIE["gameID"];

  if ( ($game_id == NULL) AND ($player_id == NULL) )	
  {
    $game_id = bbnuke_get_option('bbnuke_widget_game_results_game_id');
    $player_id = bbnuke_get_option('bbnuke_widget_game_results_player_id');
  }
	
  $query = 'SELECT visitingTeam, homeTeam, DATE_FORMAT(gameDate,"%c-%d-%Y") Gdate, TIME_FORMAT(gameTime,"%h:%i") Gtime ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_schedule where gameID=' . $game_id . ' ';
  $result = mysql_query($query);
  if ($result)
    $game   = mysql_fetch_array($result);
  list($VISITTEAM, $HOMETEAM, $GAMEDATE, $GAMETIME) = $game;
		
  $query  = 'SELECT * FROM ' . $wpdb->prefix . 'baseballNuke_boxscores WHERE gameID=' . $game_id . ' ';
  $result = mysql_query($query);
  if ($result)
    $score  = mysql_fetch_array($result);
  list($gameID,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$vhits,$vruns,$verr,$hhits,$hruns,$herr,$notes) = $score;
		
  $bbnuke_content .= '<table>
        <tr>
          <td><h2>' . $VISITTEAM . ' vs. ' . $HOMETEAM . ' on ' . $GAMEDATE . '</h2></td>
   </tr>
   <tr>
      <td>&nbsp;</td>
   </tr>
   <tr>
      <td align="left"> 
        <table border="1">
           <tr bgcolor="' . $bgcolor2 . '"> 
              <td width="170"></td>
              <td width="20" align="center">1</td>
              <td width="20" align="center">2</td>
              <td width="20" align="center">3</td>
              <td width="20" align="center">4</td>
              <td width="20" align="center">5</td>
              <td width="20" align="center">6</td>
              <td width="20" align="center">7</td>
              <td width="20" align="center">8</td>
              <td width="20" align="center">9</td>
              <td width="20" align="center">R</td>
              <td width="20" align="center">H</td>
              <td width="20" align="center">E</td>
           </tr>
           <tr> 
              <td width="170">' . $VISITTEAM . '</td>
              <td width="20">' . $v1 . '</td>
              <td width="20">' . $v2 . '</td>
              <td width="20">' . $v3 . '</td>
              <td width="20">' . $v4 . '</td>
              <td width="20">' . $v5 . '</td>
              <td width="20">' . $v6 . '</td>
              <td width="20">' . $v7 . '</td>
              <td width="20">' . $v8 . '</td>
              <td width="20">' . $v9 . '</td>            
              <td width="20">' . $vruns . '</td>
	      <td width="20">' . $vhits . '</td>
              <td width="20">' . $verr . '</td>
           </tr>
           <tr> 
              <td width="170">' . $HOMETEAM . '</td>
              <td width="20">' . $h1 . '</td>
              <td width="20">' . $h2 . '</td>
              <td width="20">' . $h3 . '</td>
              <td width="20">' . $h4 . '</td>
              <td width="20">' . $h5 . '</td>
              <td width="20">' . $h6 . '</td>
              <td width="20">' . $h7 . '</td>
              <td width="20">' . $h8 . '</td>
              <td width="20">' . $h9 . '</td>            
              <td width="20">' . $hruns . '</td>
	      <td width="20">' . $hhits . '</td>
              <td width="20">' . $herr . '</td>
           </tr>
	   <tr>
              <td>&nbsp;</td>
              <td colspan="12">' . $notes . '</td></tr>
        </table>
    </td>
   </tr>
   <tr><td>&nbsp;</td></tr> 
   <tr>
      <td>
         <table class="bbnuke-schedule-table">
           <tr>
              <th><b>' . __('Hitters', 'bbnuke') . '</b></td>
              <th>AB</th>
              <th>R</th>
              <th>1B</th>
              <th>2B</th>
              <th>3B</th>
              <th>HR</th>
              <th>RE</th>
              <th>FC</th>
              <th>HP</th>
              <th>RBI</th>
              <th>BB</th>
              <th>K</th>
              <th>LOB</th>
              <th>SB</th>
           </tr>
           ';

  //Lookup players
  $query = "SELECT st.gameID,st.playerID,battOrd,pitchOrd, " .
                   " baAB,ba1b,ba2b,ba3b,baHR,baRE,baFC,baHP,baRBI,baBB,baK,baLOB,baSB,baRuns,fiPO,fiA,fiE, " .
                   " piWin,piLose,piSave, piIP,piHits,piRuns,piER,piWalks,piSO,firstname, middlename,lastname " .
                   " FROM ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_stats st, " . 
                   " " . $wpdb->prefix."baseballNuke_schedule s " .
                   " WHERE battOrd > 0 AND teamName='$dteam' AND st.gameID=$game_id AND p.playerID=st.playerID " .
                   " AND p.season=left(gameDate,4) AND st.gameID=s.gameID ORDER BY battOrd ASC";
  $result = mysql_query($query);
  if ($result)
    while( $row = mysql_fetch_array($result) )
    {
      $gresults[] = $row;
    }
  for ($m=0; $m < count($gresults); $m++) 
  {
    list($gameID,$playerID,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR, $baRE, $baFC, $baHP, $baRBI, $baBB,$baK, $baLOB, $baSB,$baRuns,
         $fiPO, $fiA, $fiE, $piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$firstname,$middlename,$lastname) = $gresults[$m];

    $bbnuke_content .= ' <tr>
	      <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td> 
              <td> '.$baAB.'</td>
              <td> '.$baRuns.'</td>
              <td> '.$ba1b.'</td>
              <td> '.$ba2b.'</td>
              <td> '.$ba3b.'</td>
              <td> '.$baHR.'</td>
              <td> '.$baRE.'</td>
              <td> '.$baFC.'</td>
              <td> '.$baHP.'</td>
              <td> '.$baRBI.'</td>
              <td> '.$baBB.'</td>
              <td> '.$baK.'</td>
              <td> '.$baLOB.'</td>
              <td> '.$baSB.'</td>
           </tr>';
  }
  $bbnuke_content .= '</table></td>
        </tr>
   <tr><td><p>&nbsp;</p></td></tr>
   <tr>
      <td>
         <table class="bbnuke-schedule-table">
            <tr>
               <th><b>' . __('Pitchers', 'bbnuke') . '</b></th>
	       <th>W</th>
               <th>L</th>
               <th>S</th>
               <th>IP</th>
               <th>H</th>
               <th>R</th>
               <th>ER</th>
               <th>BB</th>
               <th>K</th>
               </tr>
                ';

  //Lookup players
  $query = "SELECT st.*, p.firstname, p.middlename,p.lastname " .
           "  FROM ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_stats st, " . 
           "       ".$wpdb->prefix."baseballNuke_schedule s " .
           " WHERE pitchOrd > 0 AND teamName='$dteam' AND st.gameID=$game_id AND p.playerID=st.playerID and " .
           "       p.season=left(gameDate,4) and st.gameID=s.gameID ORDER BY pitchOrd ASC";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $presults[] = $row;
    }
  for ($m=0; $m < count($presults); $m++) 
  {
    list($gameID,$playerID,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,
         $piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE, $baFC, $baHP, $baLOB, $fiPO, $fiA, $fiE,
						$firstname,$middlename,$lastname) = $presults[$m];
    $bbnuke_content .= '<tr><td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . '?playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
       <td>  <b> 
       <input type="checkbox" name="'.$playerID.piWIN.'" value="1" ';

    if($piWin){
			$bbnuke_content .= ' checked="checked" ';
		}
    $bbnuke_content .= ' />
               </b> </td>
               <td>  
               <input type="checkbox" name="'.$playerID.piLose.'" value="1" ';
    if($piLose){
      $bbnuke_content .= ' checked="checked" ';
                }
    $bbnuke_content .= ' />
               </td>
               <td>  
               <input type="checkbox" name="'.$playerID.piSave.'" value="1" ';
    if($piSave){
      $bbnuke_content .= ' checked="checked" ';
                }
    $bbnuke_content .= ' />
               </td>
               <td> '.$piIP.'</td>
               <td> '.$piHits.'</td>
               <td> '.$piRuns.'</td>
               <td> '.$piER.'</td>
               <td> '.$piWalks.'</td>
               <td> '.$piSO.'</td>
            </tr>';
  }

  $bbnuke_content .= '</table></td></tr>
   <tr><td>&nbsp;</td></tr>
   <tr>
      <td>';
  $bbnuke_content .= "</td></tr></table>";

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}
?>
