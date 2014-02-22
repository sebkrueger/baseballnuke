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
  if (isset($_POST['bbnuke_plugin_option_roster_num']))
    $roster_num = 'true';
  else
    $roster_num = 'false';
  if (isset($_POST['bbnuke_plugin_option_roster_name']))
    $roster_name = 'true';
  else
    $roster_name = 'false';
  if (isset($_POST['bbnuke_plugin_option_roster_pos']))
    $roster_pos = 'true';
  else
    $roster_pos = 'false';
  if (isset($_POST['bbnuke_plugin_option_roster_bats']))
    $roster_bats = 'true';
  else
    $roster_bats = 'false';
  if (isset($_POST['bbnuke_plugin_option_roster_throws']))
    $roster_throws = 'true';
  else
    $roster_throws = 'false';
  if (isset($_POST['bbnuke_plugin_option_roster_home']))
    $roster_home = 'true';
  else
    $roster_home = 'false';
  if (isset($_POST['bbnuke_plugin_option_roster_school']))
    $roster_school = 'true';
  else
    $roster_school = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_num']))
    $batting_num = 'true';
  else
    $batting_num = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_name']))
    $batting_name = 'true';
  else
    $batting_name = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_ab']))
    $batting_ab = 'true';
  else
    $batting_ab = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_r']))
    $batting_r = 'true';
  else
    $batting_r = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_h']))
    $batting_h = 'true';
  else
    $batting_h = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_2b']))
    $batting_2b = 'true';
  else
    $batting_2b = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_3b']))
    $batting_3b = 'true';
  else
    $batting_3b = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_hr']))
    $batting_hr = 'true';
  else
    $batting_hr = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_re']))
    $batting_re = 'true';
  else
    $batting_re = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_fc']))
    $batting_fc = 'true';
  else
    $batting_fc = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_sf']))
    $batting_sf = 'true';
  else
    $batting_sf = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_hp']))
    $batting_hp = 'true';
  else
    $batting_hp = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_rbi']))
    $batting_rbi = 'true';
  else
    $batting_rbi = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_ba']))
    $batting_ba = 'true';
  else
    $batting_ba = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_obp']))
    $batting_obp = 'true';
  else
    $batting_obp = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_slg']))
    $batting_slg = 'true';
  else
    $batting_slg = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_ops']))
    $batting_ops = 'true';
  else
    $batting_ops = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_bb']))
    $batting_bb = 'true';
  else
    $batting_bb = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_k']))
    $batting_k = 'true';
  else
    $batting_k = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_lob']))
    $batting_lob = 'true';
  else
    $batting_lob = 'false';
  if (isset($_POST['bbnuke_plugin_option_batting_sb']))
    $batting_sb = 'true';
  else
    $batting_sb = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_num']))
    $pitching_num = 'true';
  else
    $pitching_num = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_name']))
    $pitching_name = 'true';
  else
    $pitching_name = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_w']))
    $pitching_w = 'true';
  else
    $pitching_w = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_l']))
    $pitching_l = 'true';
  else
    $pitching_l = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_s']))
    $pitching_s = 'true';
  else
    $pitching_s = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_ip']))
    $pitching_ip = 'true';
  else
    $pitching_ip = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_h']))
    $pitching_h = 'true';
  else
    $pitching_h = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_r']))
    $pitching_r = 'true';
  else
    $pitching_r = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_er']))
    $pitching_er = 'true';
  else
    $pitching_er = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_bb']))
    $pitching_bb = 'true';
  else
    $pitching_bb = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_k']))
    $pitching_k = 'true';
  else
    $pitching_k = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_era']))
    $pitching_era = 'true';
  else
    $pitching_era = 'false';
  if (isset($_POST['bbnuke_plugin_option_pitching_whip']))
    $pitching_whip = 'true';
  else
    $pitching_whip = 'false';



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
  bbnuke_update_option('bbnuke_roster_num', $roster_num);
  bbnuke_update_option('bbnuke_roster_name', $roster_name);
  bbnuke_update_option('bbnuke_roster_pos', $roster_pos);
  bbnuke_update_option('bbnuke_roster_bats', $roster_bats);
  bbnuke_update_option('bbnuke_roster_throws', $roster_throws);
  bbnuke_update_option('bbnuke_roster_home', $roster_home);
  bbnuke_update_option('bbnuke_roster_school', $roster_school);
  bbnuke_update_option('bbnuke_batting_num', $batting_num);
  bbnuke_update_option('bbnuke_batting_name', $batting_name);
  bbnuke_update_option('bbnuke_batting_ab', $batting_ab);
  bbnuke_update_option('bbnuke_batting_r', $batting_r);
  bbnuke_update_option('bbnuke_batting_h', $batting_h);
  bbnuke_update_option('bbnuke_batting_2b', $batting_2b);
  bbnuke_update_option('bbnuke_batting_3b', $batting_3b);
  bbnuke_update_option('bbnuke_batting_hr', $batting_hr);
  bbnuke_update_option('bbnuke_batting_re', $batting_re);
  bbnuke_update_option('bbnuke_batting_fc', $batting_fc);
  bbnuke_update_option('bbnuke_batting_sf', $batting_sf);
  bbnuke_update_option('bbnuke_batting_hp', $batting_hp);
  bbnuke_update_option('bbnuke_batting_rbi', $batting_rbi);
  bbnuke_update_option('bbnuke_batting_ba', $batting_ba);
  bbnuke_update_option('bbnuke_batting_obp', $batting_obp);
  bbnuke_update_option('bbnuke_batting_slg', $batting_slg);
  bbnuke_update_option('bbnuke_batting_ops', $batting_ops);
  bbnuke_update_option('bbnuke_batting_bb', $batting_bb);
  bbnuke_update_option('bbnuke_batting_k', $batting_k);
  bbnuke_update_option('bbnuke_batting_lob', $batting_lob);
  bbnuke_update_option('bbnuke_batting_sb', $batting_sb);
  bbnuke_update_option('bbnuke_pitching_num', $pitching_num);
  bbnuke_update_option('bbnuke_pitching_name', $pitching_name);
  bbnuke_update_option('bbnuke_pitching_w', $pitching_w);
  bbnuke_update_option('bbnuke_pitching_l', $pitching_l);
  bbnuke_update_option('bbnuke_pitching_s', $pitching_s);
  bbnuke_update_option('bbnuke_pitching_ip', $pitching_ip);
  bbnuke_update_option('bbnuke_pitching_h', $pitching_h);
  bbnuke_update_option('bbnuke_pitching_r', $pitching_r);
  bbnuke_update_option('bbnuke_pitching_er', $pitching_er);
  bbnuke_update_option('bbnuke_pitching_bb', $pitching_bb);
  bbnuke_update_option('bbnuke_pitching_k', $pitching_k);
  bbnuke_update_option('bbnuke_pitching_era', $pitching_era);
  bbnuke_update_option('bbnuke_pitching_whip', $pitching_whip);
  return;
}

function bbnuke_set_cookies() {
  global $attribute;

  $cookies = array('playerID','gameID','field','playerTeam','playerSeason');
        foreach($cookies as $cookie) {
	  $attribute = $_COOKIE[$cookie];

          if(isset($_GET[$cookie]) ) {
                setcookie($cookie, $_GET[$cookie], 0, COOKIEPATH, COOKIE_DOMAIN);
                $attribute = $_GET[$cookie];
                $_COOKIE[$cookie] = $attribute;
            }
        }
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

  $query = "DELETE " . $wpdb->prefix . "baseballNuke_schedule, " . $wpdb->prefix . "baseballNuke_boxscores, " . $wpdb->prefix . "baseballNuke_stats FROM " . $wpdb->prefix . "baseballNuke_schedule LEFT OUTER JOIN (" . $wpdb->prefix . "baseballNuke_boxscores, " . $wpdb->prefix . "baseballNuke_stats) ON " . $wpdb->prefix . "baseballNuke_schedule.gameID=" . $wpdb->prefix . "baseballNuke_boxscores.gameID AND " . $wpdb->prefix . "baseballNuke_schedule.gameID=" . $wpdb->prefix . "baseballNuke_stats.gameID WHERE " . $wpdb->prefix . "baseballNuke_schedule.gameID= $game_id ";
   $result = mysql_query($query);

  return;
}


function  bbnuke_delete_all_schedules($season)
{
  global $wpdb;

  $query = "DELETE " . $wpdb->prefix . "baseballNuke_schedule, " . $wpdb->prefix . "baseballNuke_boxscores, " . $wpdb->prefix . "baseballNuke_stats FROM " . $wpdb->prefix . "baseballNuke_schedule LEFT OUTER JOIN (" . $wpdb->prefix . "baseballNuke_boxscores, " . $wpdb->prefix . "baseballNuke_stats) ON " . $wpdb->prefix . "baseballNuke_schedule.gameID=" . $wpdb->prefix . "baseballNuke_boxscores.gameID AND " . $wpdb->prefix . "baseballNuke_schedule.gameID=" . $wpdb->prefix . "baseballNuke_stats.gameID WHERE " . $wpdb->prefix . "baseballNuke_schedule.season='$season'";
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

  $query = 'SELECT pl.playerID, pl.firstname, pl.middlename, pl.lastname, pl.teamName
              FROM ' . $wpdb->prefix . 'baseballNuke_players AS pl
             WHERE teamName = "' . $team . '" AND season = "' . $season . '" 
	     ORDER BY pl.lastname,pl.firstname ASC';
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

function  bbnuke_get_playerID_from_jersey( $jersey,$season,$team )
{
    global $wpdb;

  $query = 'SELECT playerID
              FROM ' . $wpdb->prefix . 'baseballNuke_players 
             WHERE jerseyNum = "' . $jersey . '" AND teamName = "' . $team . '" AND season = "' . $season . '" ';
  $result = mysql_query ($query);
  $pIDs = mysql_fetch_array($result);
  $playerID = $pIDs[playerID];

  return $playerID;
}


function  bbnuke_get_season_from_gameid( $gameID )
{
    global $wpdb;

  $query = 'SELECT season
              FROM ' . $wpdb->prefix . 'baseballNuke_schedule
             WHERE gameID = "' . $gameID . '"';
  $result = mysql_query ($query);
  $seasons = mysql_fetch_array($result);
  $season = $seasons[season];

  return $season;
}



function  bbnuke_get_game_results_all($game_id, $season)
{
  global $wpdb;

  $query = "SELECT pl.playerID, pl.firstname, pl.middlename, pl.lastname, pl.teamName, 
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
                   st.fiE,
		   st.baSF
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


function  bbnuke_get_game_player_results($game_id, $playerID)
{
  global $wpdb;

  $query = "SELECT playerID
            FROM " . $wpdb->prefix . "baseballNuke_stats
            WHERE gameID=$game_id AND playerID=$playerID";
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
if (isset($_POST['bbnuke_include_post']))
  $postID = $_POST['bbnuke_wordpress_posts'];
else
  $postID = 'NULL';
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
           '  postID  = ' . $postID . ', ' .
	   '  status  = "' . $_POST['bbnuke_game_status'] . '", ' .
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
           '  status  = "' . $_POST['bbnuke_game_status'] . '", ' .
           '  postID = ' . $postID . 
           '  WHERE gameID = ' . $game_id . ' ';
    $result = mysql_query($query);
    if (mysql_error())
      $error_flag = 1;
  }

  //  get players with id's
  $players = bbnuke_get_players( $season );
  //  check if entries exists
  $presults    = bbnuke_get_game_results_all($game_id, $season);
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
		   baSF     = ' . (int)$_POST[$player_id . '_baSF'] . ',
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
                   fiE      = ' . (int)$_POST[$player_id . '_fiE'] . ',
                   baSF     = ' . (int)$_POST[$player_id . '_baSF'] . '
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
    
/*
function  bbnuke_upload_gamechanger_stats($game_id,$season)
{
  global $wpdb;
  $def      = bbnuke_get_defaults();
  $defaultTeam = $def['defaultTeam'];

  $lines = file($_FILES['bbnuke_plugin_gamechanger_upload_file']['tmp_name']);

  foreach ($lines as $line_num => $line)
  {
    list($jersey,$baR,$baSB,$baH,$baK,$baSacF,$ba2b,$baHR,$baBB,$baRBI,$ba3b,$baAB,$baSacB,$baHBP,$piHRA,$piER,$piBF,$piNum,$piWP,$piHB,$piRA,$piA,$piK,$piBB,$piH,$piSBA,$piIP,$piPartIP)=explode("|",$line);

    $ba1b=$baH-$ba2b-$ba3b-$baHR;
    $inningPitched=$piIP+($piPartIP*.33);
    $playerID=bbnuke_get_playerID_from_jersey($jersey,$season,$defaultTeam);
    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_stats
        SET gameID='$game_id',
	    playerID='$playerID',
            baAB='$baAB',
            ba1b='$ba1b',
            ba2b='$ba2b',
            ba3b='$ba3B',
            baHR='$baHR',
            baRBI='$baRBI',
            baBB='$baBB',
            baK='$baK',
            baSB='$baSB',
            baRuns='$baR',
            baHP='$baHBP',
            piIP='$piIP',
	    piHits='$piH',
	    piRuns='$piRA',
	    piER='$piER',
	    piWalks='$piBB',
	    piSO='$piK'";

    $result = mysql_query($query);
    if(!$result)
    {
      echo "Failed to import GameChanger stats for game $game_id ($query)";
    }
  }

  return;
}
*/

function  bbnuke_upload_stats($game_id,$team)
{
  global $wpdb;
  $season = bbnuke_get_season_from_gameid($game_id);

  $lines = file($_FILES['bbnuke_plugin_stats_upload_file']['tmp_name']);
  
  foreach ($lines as $line_num => $line)
  {
    list($jersey,$battOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$baRuns,$baRE,$baFC,$baHP,$baLOB,$baSF,$pitchOrd,$piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$fiPO,$fiA,$fiE)=explode(",",$line);
  $playerID="0";
  $playerID=bbnuke_get_playerID_from_jersey($jersey,$season,$team);
  $presults    = bbnuke_get_game_player_results ($game_id,$playerID);
  if (!$presults)
   $new_entry = true;
  else
   $new_entry = false;
  if ($playerID && $new_entry)
  {
    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_stats
         SET gameID='$game_id',
             playerID='$playerID',
             battOrd ='$battOrd',
             baAB='$baAB',
             ba1b='$ba1b',
             ba2b='$ba2b',
             ba3b='$ba3b',
             baHR='$baHR',
             baRBI='$baRBI',
             baBB='$baBB',
             baK='$baK',
             baSB='$baSB',
             baRuns='$baRuns',
             baRE='$baRE',
             baFC='$baFC',
             baHP='$baHP',
             baLOB='$baLOB',
             baSF='$baSF',
             pitchOrd='$pitchOrd',
             piWin='$piWin',
             piLose='$piLose',
             piSave='$piSave',
             piIP='$piIP',
             piHits='$piHits',
             piRuns='$piRuns',
             piER='$piER',
             piWalks='$piWalks',
             piSO='$piSO',
             fiPO='$fiPO',
             fiA='$fiA',
             fiE='$fiE'";
  }
    if (!$new_entry && $playerID){
    $query = "UPDATE " . $wpdb->prefix . "baseballNuke_stats
         SET gameID='$game_id',
             playerID='$playerID',
             battOrd ='$battOrd',
             baAB ='$baAB',
             ba1b ='$ba1b',
             ba2b ='$ba2b',
             ba3b ='$ba3b',
             baHR ='$baHR',
             baRBI ='$baRBI',
             baBB ='$baBB',
             baK ='$baK',
             baSB ='$baSB',
             baRuns ='$baRuns',
             baRE ='$baRE',
             baFC ='$baFC',
             baHP ='$baHP',
             baLOB ='$baLOB',
             baSF ='$baSF',
             pitchOrd ='$pitchOrd',
             piWin ='$piWin',
             piLose ='$piLose',
             piSave ='$piSave',
             piIP ='$piIP',
             piHits ='$piHits',
             piRuns ='$piRuns',
             piER ='$piER',
             piWalks ='$piWalks',
             piSO ='$piSO',
             fiPO ='$fiPO',
             fiA ='$fiA',
             fiE ='$fiE'
	     WHERE gameID='$game_id' and playerID='$playerID'";
  }
echo $query;
    $result = mysql_query($query);
    if(!$result)
    {
      echo "Failed to import stats for game $game_id ($query)";
    }
  }
  return;
}


function  bbnuke_upload_iScore_battingstats($game_id,$season)
{
  global $wpdb;
  $def      = bbnuke_get_defaults();
  $defaultTeam = $def['defaultTeam'];

  $lines = file($_FILES['bbnuke_plugin_iScore_batting_upload']['tmp_name']);

  foreach ($lines as $line_num => $line)
  {
    list($jersey,$baName,$baG,$baPA,$baAB,$baR,$baH,$baB,$ba1B,$ba2B,$ba3B,$baHR,$baRBI,$baBB,$baKc,$baKs,$baSO,$baHBP,$baSB,$baCS,$baSCB,$baSF,$baSAC,$baRPA,$baOBP,$baSLG,$baOPS,$baAVG,$baROE,$baFC,$baCI,$baGDP,$baGTP,$baABRSP,$baHRSP,$baBARSP)=explode(",",$line);

    $playerID=bbnuke_get_playerID_from_jersey($jersey,$season,$defaultTeam);
   $presults    = bbnuke_get_game_results_all($game_id, $season);
   if (!$presults)
     $new_entry = true;
   else
     $new_entry = false;
  if ($new_entry && $playerID!="0")
  {
    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_stats
        SET gameID='$game_id',
            playerID='$playerID',
            baAB='$baAB',
            ba1b='$ba1B',
            ba2b='$ba2B',
            ba3b='$ba3B',
            baHR='$baHR',
            baRBI='$baRBI',
            baBB='$baBB',
            baK='$baSO',
            baSB='$baSB',
            baRuns='$baR',
	    baSF='$baSF',
            baHP='$baHBP'";
	    
  }
  if (!$new_entry && $playerID!="0"){
    $query = "UPDATE " . $wpdb->prefix . "baseballNuke_stats
        SET gameID='$game_id',
            playerID='$playerID',
            baAB='$baAB',
            ba1b='$ba1B',
            ba2b='$ba2B',
            ba3b='$ba3B',
            baHR='$baHR',
            baRBI='$baRBI',
            baBB='$baBB',
            baK='$baSO',
            baSB='$baSB',
            baRuns='$baR',
            baSF='$baSF',
            baHP='$baHBP'";
  }
    $result = mysql_query($query);
    if(!$result)
    {
      echo "Failed to import iScore batting stats for game $game_id ($query)";
    }
  }

  return;
}


function  bbnuke_upload_iScore_pitchingstats($game_id,$season)
{
  global $wpdb;
  $def      = bbnuke_get_defaults();
  $defaultTeam = $def['defaultTeam'];

  $lines = file($_FILES['bbnuke_plugin_iScore_pitching_upload']['tmp_name']);

  foreach ($lines as $line_num => $line)
  {
    list($jersey,$piName,$piG,$piW,$piL,$piSV,$piIP,$piBF,$piBalls,$piStrikes,$piPIT,$piR,$piRA,$piER,$piERA9,$piERA,$piK,$piH,$piBB,$piIBB,$piKBB,$piHB,$piBK,$piWP,$piHR,$piWHIP,$piOBP,$piBAA,$piAO,$piGO,$piFPS,$piFPB,$piFPS)=explode(",",$line);

    $playerID=bbnuke_get_playerID_from_jersey($jersey,$season,$defaultTeam);

    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_stats
        SET gameID='$game_id',
            playerID='$playerID',
            piWin='$piW',
            piLose='$piL',
            piSave='piSV',
            piIP='$piIP',
            piHits='$piH',
            piRuns='$piRA',
            piER='$piER',
            piWalks='$piBB',
            piSO='$piK'";


    $result = mysql_query($query);
    if(!$result)
    {
      echo "Failed to import iScore pitching stats for game $game_id ($query)";
    }
  }

  return;
}


function bbnuke_import_data()
{



return;
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
  $type  = $_POST['bbnuke_schedules_edit_type_select'];

  $query  = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='$vteam', homeTeam='$hteam', gameDate='$gdate', gameTime='$gtime', field='$field', type='$type', season='$season' ";
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
  $type  = $_POST['bbnuke_schedules_edit_type_select'];

  $query  = "UPDATE " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='$vteam', homeTeam='$hteam', gameDate='$gdate', gameTime='$gtime', field='$field', type='$type' WHERE gameID=$game_id ";
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
    $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='$visitingTeam', homeTeam='$homeTeam', gameDate='$gameDate', gameTime='$gameTime',field='$field',season='$season',type='game'";
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

  $query = "INSERT INTO " . $wpdb->prefix . "baseballNuke_schedule SET visitingTeam='tournament',homeTeam='$hteam',gameDate='$gdate',gameTime='$gtime',field='$field',type='$type',notes='$notes',season='$season' ";
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

  $query  = "SELECT gameID, visitingTeam, homeTeam, gameDate, gameTime, field, Notes, season FROM " . $wpdb->prefix . "baseballNuke_schedule WHERE season='$season' AND visitingTeam='tournament' AND homeTeam='$hometeam' ORDER BY gameDate desc ";
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

  $query  = 'SELECT gameID, gameDate, gameTime, field, notes FROM ' . $wpdb->prefix . 'baseballNuke_schedule WHERE season= "' . $season . '" AND visitingTeam="practice" AND homeTeam = "' . $hometeam . '" ORDER BY gameDate desc ';
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



function  bbnuke_get_teams($season)
{
  global $wpdb;
  $teams = array();
  if (isset($season)){
  $query = 'SELECT teamname FROM ' . $wpdb->prefix . 'baseballNuke_teams WHERE season="'.$season.'" ORDER BY teamname asc';
  }else{
  $query = 'SELECT distinct(teamname) FROM ' . $wpdb->prefix . 'baseballNuke_teams ORDER BY teamname asc';
  }
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
    $playerid    = $players[$indx]['playerID'];
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
        		playerID='$playerid',firstname='$firstname',middlename='$middlename',
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

  $query = "SELECT * FROM (SELECT * FROM " . $wpdb->prefix ."baseballNuke_players ORDER BY season DESC) as uniquePlayers
        GROUP BY playerID
        ORDER BY lastname ASC,firstname ASC";

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


function  bbnuke_delete_season($season)
{
  global $wpdb;

  $defs = bbnuke_get_defaults();

  if ( $defs['defaultSeason'] == $season )
    return -10;
  
  $seasons_list = bbnuke_get_seasons();
  if ( count($seasons_list) <= 1 )
    return -20;

  $query = 'DELETE FROM ' . $wpdb->prefix . 'baseballNuke_teams WHERE ' . $wpdb->prefix . 'baseballNuke_teams.season = "' . $season . '"';
  $result = mysql_query($query);

  $query = 'DELETE FROM ' . $wpdb->prefix . 'baseballNuke_players WHERE ' . $wpdb->prefix . 'baseballNuke_players.season = "' . $season . '"';
  $result = mysql_query($query);

  bbnuke_delete_all_schedules($season);
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



function  bbnuke_get_batting_avg($season,$team)
{
  global $wpdb;
  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,
                round((baTotH/baTotAB),3) as BA
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE baTotAB>10 AND season='".$season."'
                GROUP BY playerID
                ORDER BY BA desc
                LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum, 
    		round((baTotH/baTotAB),3) as BA 
		FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE baTotAB>10 AND season='".$season."' AND teamName='".$team."'
		GROUP BY playerID
		ORDER BY BA desc
		LIMIT ".$team_leaders;
  }
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_hit_leaders($season,$team)
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotH
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE baTotH > 0 AND season='".$season."'
                GROUP BY playerID
                ORDER BY baTotH desc
                LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotH
                FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE baTotH > 0 AND season='".$season."' AND teamName='".$team."'
                GROUP BY playerID
                ORDER BY baTotH desc
                LIMIT ".$team_leaders;
  }
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function bbnuke_get_homerun_leaders($season,$team)
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotHR
                FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE baTotHR > 0 AND season='".$season."'
                GROUP BY playerID
                ORDER BY baTotHR desc
                LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotHR
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE baTotHR > 0 AND season='".$season."' AND teamName='".$team."'
                GROUP BY playerID
                ORDER BY baTotHR desc
                LIMIT ".$team_leaders;
  }
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_rbi($season,$team)
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotRBI 
                FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE season='".$season."'
                GROUP BY playerID
                ORDER BY baTotRBI desc
                LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,baTotRBI
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE season='".$season."' AND teamName='".$team."'
                GROUP BY playerID
                ORDER BY baTotRBI desc
                LIMIT ".$team_leaders;
  }
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}


function  bbnuke_get_era_leaders($season,$team)
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');
  $erainnings = bbnuke_get_option('bbnuke_era_innings'); 

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum, 
    		round(sum((piTotER/piTotIP)*".$erainnings."),2) as ERA 
		FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE piTotIP>5 AND season='".$season."'
		GROUP BY playerID
		ORDER BY ERA asc
		LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,
                round(sum((piTotER/piTotIP)*".$erainnings."),2) as ERA
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE piTotIP>5 AND season='".$season."' AND teamName='".$team."'
                GROUP BY playerID
                ORDER BY ERA asc
                LIMIT ".$team_leaders;
  }
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}



function  bbnuke_get_strikeout_leaders($season,$team)
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotSO
                FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE piTotSO > 0 AND season='".$season."'
                GROUP BY playerID
                ORDER BY piTotSO desc
                LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotSO
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE piTotSO > 0 AND season='".$season."' AND teamName='".$team."'
                GROUP BY playerID
                ORDER BY piTotSO desc
                LIMIT ".$team_leaders;
  }
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}



function  bbnuke_get_innings_pitched_leaders($season,$team)
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotIP
                FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE piTotIP > 0 AND season='".$season."'
                GROUP BY playerID
                ORDER BY piTotIP desc
                LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotIP
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE piTotIP > 0 AND season='".$season."' AND teamName='".$team."'
                GROUP BY playerID
                ORDER BY piTotIP desc
                LIMIT ".$team_leaders;
  }
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $players[] = $row;
    }

  return $players;
}



function  bbnuke_get_wins_leaders($season,$team)
{
  global $wpdb;

  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');

  if($team == 'league'){
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotWin
                FROM ".$wpdb->prefix."baseballNuke_statTotals
		WHERE piTotWin > 0 AND season='".$season."'
                GROUP BY playerID
                ORDER BY piTotWin desc
                LIMIT ".$team_leaders;
  }else{
    $query = "SELECT DISTINCT playerID,lastname,firstname,middlename,jerseyNum,piTotWin
                FROM ".$wpdb->prefix."baseballNuke_statTotals
                WHERE piTotWin > 0 AND season='".$season."'AND teamName='".$team."'
                GROUP BY playerID
                ORDER BY piTotWin desc
                LIMIT ".$team_leaders;
  }
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


function bbnuke_display_post_selectbox() {
 
    global $wpdb, $post;
    $table_prefix = $wpdb->prefix;
 
    $the_output = NULL;
    $last_posts = (array)$wpdb->get_results("
        SELECT {$table_prefix}terms.name, {$table_prefix}terms.term_id
        FROM {$table_prefix}terms, {$table_prefix}term_taxonomy
        WHERE {$table_prefix}terms.term_id = {$table_prefix}term_taxonomy.term_id
                AND {$table_prefix}term_taxonomy.taxonomy = 'category'
        {$hide_check}
    ");
    if (empty($last_posts)) {
        return NULL;
    }
    $used_cats = array();;
    $i = 0;
    foreach ($last_posts as $posts) {
        if (in_array($posts->name, $used_cats)) {
            unset($last_posts[$i]);
        } else {
            $used_cats[] = $posts->name;
        }
        $i++;
    }
    $last_posts = array_values($last_posts);
 
    $the_output .= '<select name="bbnuke_wordpress_posts">';
    foreach ($last_posts as $posts) {
 
      $the_output .= '<optgroup label="'.apply_filters('list_cats', $posts->name, $posts).'">';
 
          $where = apply_filters('getarchives_where', "WHERE post_type = 'post' AND post_status = 'publish'" , $r );
 
          $arcresults = $wpdb->get_results("SELECT * FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish' AND ID IN (Select object_id FROM {$table_prefix}term_relationships, {$table_prefix}terms WHERE {$table_prefix}term_relationships.term_taxonomy_id =" . $posts->term_id . ") ORDER BY post_date DESC");
      foreach ( $arcresults as $arcresult ) {
           $the_output .= '<option label="'.apply_filters('the_title', $arcresult->post_title).'" value="'.apply_filters('the_post', $arcresult->ID).'">'.apply_filters('the_title', $arcresult->post_title) . '</option>';
       }
 
          $the_output .= '</optgroup>';
       }
       $the_output .= '</select>';
       echo $the_output;
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
//      add_shortcode(bbnuke_top5stats,bbnuke_widget_top5stats);
      add_shortcode(bbnuke_schedule,bbnuke_widget_team_schedule);
      add_shortcode(bbnuke_practice,bbnuke_widget_team_practices);
      add_shortcode(bbnuke_tournament,bbnuke_widget_team_tournament);
      add_shortcode(bbnuke_fields,bbnuke_widget_locations_info);
      add_shortcode(bbnuke_gameresults,bbnuke_widget_game_results);

function  bbnuke_display_widget( $bbnuke_w_args )
{
  global $wpdb;
  $team = ($bbnuke_w_args['team']);
  $season = ($bbnuke_w_args['season']);
  switch  ($bbnuke_w_args['display_type'])
  {
    case 0:
      echo do_shortcode('[bbnuke_topbatters team="'.$team.'" season="'.$season.'"]');
      break;
    case 1:
      echo do_shortcode('[bbnuke_toppitchers team="'.$team.'" season="'.$season.'"]');
      break;
    case 2:
      echo do_shortcode('[bbnuke_lastgame team="'.$team.'" season="'.$season.'"]');
      break;
    case 3:
      echo do_shortcode('[bbnuke_nextgame team="'.$team.'" season="'.$season.'"]');
      break;
    case 4:
      echo do_shortcode('[bbnuke_batstats team="'.$team.'" season="'.$season.'"]');
      break;
    case 5:
      echo do_shortcode('[bbnuke_roster team="'.$team.'" season="'.$season.'"]');
      break;
    case 6:
      echo do_shortcode('[bbnuke_pitchstats team="'.$team.'" season="'.$season.'"]');
      break;
    case 7:
      echo do_shortcode('[bbnuke_fieldstats team="'.$team.'" season="'.$season.'"]');
      break;
    case 8:
      echo do_shortcode('[bbnuke_playerstats team="'.$team.'" season="'.$season.'"]');
      break;
//    case 9:
//      echo do_shortcode('[bbnuke_top5stats team="'.$team.'" season="'.$season.'"]');
//      break;
    case 9:
      echo do_shortcode('[bbnuke_schedule team="'.$team.'" season="'.$season.'"]');
      break;
    case 10:
      echo do_shortcode('[bbnuke_practice team="'.$team.'" season="'.$season.'"]');
      break;
    case 11:
      echo do_shortcode('[bbnuke_tournament team="'.$team.'" season="'.$season.'"]');
      break;
    case 12:
      echo do_shortcode('[bbnuke_fields team="'.$team.'" season="'.$season.'"]');
      break;
    case 13:
      echo do_shortcode('[bbnuke_gameresults team="'.$team.'" season="'.$season.'"]');
      break;
  }

  return;
}



function  bbnuke_widget_top_batters( $atts, $bbnuke_echo = true )
{
  global $wpdb;
  $defs    = bbnuke_get_defaults();
  $team   = $defs['defaultTeam'];
  $season = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $team,
              'season' => $season,
      ), $atts));
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $heading_arr = array(
             __('Batting Avg', 'bbnuke'),
             __('Hits', 'bbnuke'),
             __('Home Runs', 'bbnuke'),
             __('RBI', 'bbnuke')
          );

  $bbnuke_content = NULL;

  for ( $i=0; $i < 4; $i++ )
  {
    $bbnuke_content .= 
    '   <table width="140px" class="bbnuke-results-table" id="bbnuke-results-table">
        <tr>
          <th style="text-align:left;">' . $heading_arr[$i] . '</th>
          <th>&nbsp;</th></tr>' . "\n";

    switch ($i)        
    {
      case 0:
        #Batting Average Leaders
        $players = bbnuke_get_batting_avg($season,$team);
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
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $bAvg . '</td>
                </tr>';
        }	
        break;
      case 1:
        #Hits Leaders    
        $players = bbnuke_get_hit_leaders($season,$team);
        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotH) = $players[$m];
          $bbnuke_content .= '<tr>
                 <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $baTotH . '</td>
                </tr>';
        }
        break;
      case 2:
        #Homerun Leaders
        $players = bbnuke_get_homerun_leaders($season,$team);
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotHR) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $baTotHR . '</td>
                </tr>';
        }
        break;
      case 3:
        $players = bbnuke_get_rbi($season,$team);
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotRBI) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
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



function  bbnuke_widget_top_pitchers($atts, $bbnuke_echo = true)
{
  global $wpdb;
  $defs    = bbnuke_get_defaults();
  $team   = $defs['defaultTeam'];
  $season = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $team,
              'season' => $season,
      ), $atts));
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';
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
        $players = bbnuke_get_era_leaders($season,$team);
        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $ERA) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
                  <td>' . $ERA . '</td>
                </tr>';
        }	
        break;
      case 1:
        #Strikeout Leaders    
        $players = bbnuke_get_strikeout_leaders($season,$team);
        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $piTotSO) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		  <td>' . $piTotSO . '</td>
                </tr>';
        }
        break;
      case 2:
        #Innings Pitched Leaders
        $players = bbnuke_get_innings_pitched_leaders($season,$team);
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $piTotIP) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
	          <td>' . $piTotIP . '</td>
                </tr>';
        }
        break;
      case 3:
        #Wins Leader
        $players = bbnuke_get_wins_leaders($season,$team);
        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $piTotWin) = $players[$m];
          $bbnuke_content .= '<tr>
                  <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
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
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';

  $bbnuke_content = NULL;

  if ( $game )
  {
    list($gameID, $Gdate, $Gtime, $homeTeam, $visitingTeam, $field, $hruns, $vruns) = $game;
    $date =date_create("$Gdate $Gtime");
    $bbnuke_content .= '<a class="game_results-page-link" href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'.date_format($date,"$dateformat $timeformat").'</a><br />';
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
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';

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
    $bbnuke_content .= '</b><br /> at <a href="' . $locations_page . $qstring . 'field='.$field.'" title="">'.$field.'</a>';
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



function  bbnuke_widget_batstats( $atts, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $team   = $defs['defaultTeam'];
  $season = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $team,
              'season' => $season,
      ), $atts));
  $batting_num = bbnuke_get_option('bbnuke_batting_num');
  $batting_name = bbnuke_get_option('bbnuke_batting_name');
  $batting_ab = bbnuke_get_option('bbnuke_batting_ab');
  $batting_r = bbnuke_get_option('bbnuke_batting_r');
  $batting_h = bbnuke_get_option('bbnuke_batting_h');
  $batting_2b = bbnuke_get_option('bbnuke_batting_2b');
  $batting_3b = bbnuke_get_option('bbnuke_batting_3b');
  $batting_hr = bbnuke_get_option('bbnuke_batting_hr');
  $batting_re = bbnuke_get_option('bbnuke_batting_re');
  $batting_fc = bbnuke_get_option('bbnuke_batting_fc');
  $batting_sf = bbnuke_get_option('bbnuke_batting_sf');
  $batting_hp = bbnuke_get_option('bbnuke_batting_hp');
  $batting_rbi = bbnuke_get_option('bbnuke_batting_rbi');
  $batting_ba = bbnuke_get_option('bbnuke_batting_ba');
  $batting_obp = bbnuke_get_option('bbnuke_batting_obp');
  $batting_slg = bbnuke_get_option('bbnuke_batting_slg');
  $batting_ops = bbnuke_get_option('bbnuke_batting_ops');
  $batting_bb = bbnuke_get_option('bbnuke_batting_bb');
  $batting_k = bbnuke_get_option('bbnuke_batting_k');
  $batting_lob = bbnuke_get_option('bbnuke_batting_lob');
  $batting_sb = bbnuke_get_option('bbnuke_batting_sb');
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));

  $bbnuke_content = NULL;
  $bbnuke_content .= '<table class="bbnuke-results-table">
		    <thead>
		      <tr>';
		      if ($batting_num == 'true')
                        $bbnuke_content .= '<th>#</th>';
                      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_name == 'true')                      
                        $bbnuke_content .= '<th>' .__('Batter', 'bbnuke') . '</th>';
                      else $bbnuke_content .= '<th style="display:none"></th>';  
		      if ($batting_ab == 'true')                        
                        $bbnuke_content .= '<th>AB</th>';
                      else $bbnuke_content .= '<th style="display:none"></th>';  
		      if ($batting_r == 'true')                        
                        $bbnuke_content .= '<th>R</th>';
                      else $bbnuke_content .= '<th style="display:none"></th>';  
		      if ($batting_h == 'true')                        
                        $bbnuke_content .= '<th>H</th>';
                      else $bbnuke_content .= '<th style="display:none"></th>';  
		      if ($batting_2b == 'true')
		      	$bbnuke_content .= '<th>2B</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_3b == 'true')
		      	$bbnuke_content .= '<th>3B</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_hr == 'true')
		      	$bbnuke_content .= '<th>HR</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_re == 'true')
		      	$bbnuke_content .= '<th>RE</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_fc == 'true')
		      	$bbnuke_content .= '<th>FC</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_sf == 'true')
		      	$bbnuke_content .= '<th>SF</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_hp == 'true')
		      	$bbnuke_content .= '<th>HP</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_rbi == 'true')
		      	$bbnuke_content .= '<th>RBI</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_ba == 'true')                        
                        $bbnuke_content .= '<th>BA</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_obp == 'true')                        
                        $bbnuke_content .= '<th>OBP</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_slg == 'true')                        
                        $bbnuke_content .= '<th>SLG</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_ops == 'true')                        
                        $bbnuke_content .= '<th>OPS</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_bb == 'true')                        
                        $bbnuke_content .= '<th>BB</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_k == 'true')                        
                        $bbnuke_content .= '<th>K</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_lob == 'true')                        
                        $bbnuke_content .= '<th>LOB</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
		      if ($batting_sb == 'true')                        
                        $bbnuke_content .= '<th>SB</th>';
		      else $bbnuke_content .= '<th style="display:none"></th>';
  $bbnuke_content .= '
		      </tr>
		    </thead>
		    <tbody>
';
  //////////////////////////////////
  //BATTING STATS FOR CURRENT SEASON
  //////////////////////////////////
  if ( $team == 'league' )
  {
  $query = "SELECT p.playerID,p.lastname,p.firstname,p.middlename,p.jerseyNum,".
        " sum(baRuns) as baR, sum(baAb) as baAB, sum(ba1b+ba2b+ba3b+baHR) as baH,sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b,".
        " sum(baHR) as baHR, sum(baRE) as baRE, sum(baFC) as baFC, sum(baSF) as baSF, sum(baHP) as baHP, sum(baRBI) as baRBI,".
        " sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB, sum(baSB) as baSB".
        " FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s".
        " WHERE s.season='".$season."' ".
        " AND p.playerID=st.playerID AND st.gameID=s.gameID AND p.season=s.season ".
        " GROUP BY p.playerID ORDER BY lastname,firstname ASC";
  } else {
  $query = "SELECT p.playerID,p.lastname,p.firstname,p.middlename,p.jerseyNum,".
      	" sum(baRuns) as baR, sum(baAb) as baAB, sum(ba1b+ba2b+ba3b+baHR) as baH,sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b,".
      	" sum(baHR) as baHR, sum(baRE) as baRE, sum(baFC) as baFC, sum(baSF) as baSF, sum(baHP) as baHP, sum(baRBI) as baRBI,".
      	" sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB, sum(baSB) as baSB".
      	" FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s".
      	" WHERE teamName='".$team."' AND s.season='".$season."' ".
      	" AND p.playerID=st.playerID AND st.gameID=s.gameID AND p.season=s.season ".
      	" GROUP BY p.playerID ORDER BY lastname,firstname ASC";
  }
  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
    $presults[] = $row;

  for ($m=0; $m < count($presults); $m++) 
  {
    if( count($presults) )
    {
      list($playerID, $lastname, $firstname, $middlename, $jerseyNum,$baR, $baAB, $baH,$ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baSF, $baHP, $baRBI, $baBB, $baK, $baLOB, $baSB) = $presults[$m];
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
        $obp=($hits+$baBB+$baHP)/($baAB+$baBB+$baHP+$baSF);
        $obp=number_format("$obp", 3);
        $obp = ltrim($obp,"0");
      if (($baAB+$baBB) == 0)
	{$obp = ".000";}
      if ($obp == 0)
	{$obp=".000";}

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
	{$ba = ".000";}
      if ($ba == 0)
	{$ba = ".000";}
      else
      {
	$ba=substr($ba,1);
	$ba=str_replace("0000","0",$ba); 
     }
    }

$bbnuke_content .= '<tr>';
		      if ($batting_num == 'true')
                        $bbnuke_content .= '<td>'.$jerseyNum.'</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_name == 'true')                      
                        $bbnuke_content .= '<td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  

    if( count($presults) )
    {
		      if ($batting_ab == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baAB.'</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  
		      if ($batting_r == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baR.'</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  
		      if ($batting_h == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baH.'</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  
		      if ($batting_2b == 'true')
		      	$bbnuke_content .= '<td align="center">'.$ba2b.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_3b == 'true')
		      	$bbnuke_content .= '<td align="center">'.$ba3b.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_hr == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baHR.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_re == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baRE.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_fc == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baFC.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_sf == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baSF.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_hp == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baHP.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_rbi == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baRBI.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_ba == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$ba.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_obp == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$obp.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_slg == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$slg.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_ops == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$ops.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_bb == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baBB.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_k == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baK.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_lob == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baLOB.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_sb == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baSB.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
    }

    $bbnuke_content .= '</tr>';
  }
///////////////////////////////////////
//CALCULATE BATTING STATS TOTALS FOR CURRENT SEASON
///////////////////////////////////////
  if ( $team == 'league' )
  {
  $query = "SELECT sum(baRuns) as baR, sum(baAb) as baAB, sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b,  " .
           "       sum(baHR) as baHR, sum(baRE) as baRE, sum(baFC) as baFC, sum(baSF) as baSF, sum(baHP) as baHP, sum(baRBI) as baRBI, " .
           "       sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB, sum(baSB) as baSB " .
           "  FROM ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
           " WHERE s.season='".$season."' AND st.gameID=s.gameID AND " .
           "       p.playerID=st.playerID AND p.season=s.season";
  } else {
  $query = "SELECT sum(baRuns) as baR, sum(baAb) as baAB, sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b,  " . 
           "       sum(baHR) as baHR, sum(baRE) as baRE, sum(baFC) as baFC, sum(baSF) as baSF, sum(baHP) as baHP, sum(baRBI) as baRBI, " .
           "       sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB, sum(baSB) as baSB " .
           "  FROM ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
           " WHERE teamName='".$team."' AND s.season='".$season."' AND st.gameID=s.gameID AND " .
           "       p.playerID=st.playerID AND p.season=s.season";
  }
  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
    $gresults[] = $row;

  for ($m=0; $m < count($gresults); $m++) 
  {
    // see above  $baLOB,
    list($baR, $baAB, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baSF, $baHP, $baRBI, $baBB, $baK, $baLOB, $baSB) = $gresults[$m];
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
        $obp=($hits+$baBB+$baHP)/($baAB+$baBB+$baHP+$baSF);
        $obp=number_format("$obp", 3);
        $obp = ltrim($obp,"0");
      if (($baAB+$baBB) == 0)
        {$obp = ".000";}
      if ($obp == 0)
        {$obp=".000";}

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
        {$ba = ".000";}
      if ($ba == 0)
        {$ba = ".000";}
      else
      {
        $ba=substr($ba,1);
        $ba=str_replace("0000","0",$ba);
     }

    $bbnuke_content .= '</tbody><tr>';
		      if ($batting_num == 'true')
                        $bbnuke_content .= '<td>&nbsp;</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_name == 'true')                      
                        $bbnuke_content .= '<td style="text-align:left;"><b>TOTAL</b></td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  
		      if ($batting_ab == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baAB.'</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  
		      if ($batting_r == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baR.'</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  
		      if ($batting_h == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baH.'</td>';
                      else $bbnuke_content .= '<td style="display:none"></td>';  
		      if ($batting_2b == 'true')
		      	$bbnuke_content .= '<td align="center">'.$ba2b.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_3b == 'true')
		      	$bbnuke_content .= '<td align="center">'.$ba3b.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_hr == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baHR.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_re == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baRE.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_fc == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baFC.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_sf == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baSF.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_hp == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baHP.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_rbi == 'true')
		      	$bbnuke_content .= '<td align="center">'.$baRBI.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_ba == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$ba.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_obp == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$obp.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_slg == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$slg.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_ops == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$ops.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_bb == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baBB.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_k == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baK.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_lob == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baLOB.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
		      if ($batting_sb == 'true')                        
                        $bbnuke_content .= '<td align="center">'.$baSB.'</td>';
		      else $bbnuke_content .= '<td style="display:none"></td>';
  }

  $bbnuke_content .= '</tr></table>
      <div><a href="#TB_inline?height=300&width=300&inlineId=bbnuke_batting_stat_key_popup" class="thickbox">' . __('Stat Key', 'bbnuke') . '</a></div>
      <div id="bbnuke_batting_stat_key_popup" style="display:none">
      <h2>' . __('Batting Stats Key', 'bbnuke') . '</h2>
        <div>
        <table class="bbnuke-stat-key">
	  <tr><th><u>' . __('Key', 'bbnuke') . '</u></th><th><u>' . __('Meaning', 'bbnuke') . '</u></th></tr>
	  <tr><td colspan="2"><hr /></td></tr>
	  <tr><td>AB</td><td>' . __('At Bat', 'bbnuke') . '</td></tr>
	  <tr><td>R</td><td>' . __('Runs', 'bbnuke') . '</td></tr>
    	  <tr><td>H</td><td>' . __('Hits', 'bbnuke') . '</td></tr>
	  <tr><td>2B</td><td>' . __('Doubles', 'bbnuke') . '</td></tr>
	  <tr><td>3B</td><td>' . __('Triples', 'bbnuke') . '</td></tr>
	  <tr><td>HR</td><td>' . __('Home Runs', 'bbnuke') . '</td></tr>
	  <tr><td>RE</td><td>' . __('Reach on Error', 'bbnuke') . '</td></tr>
	  <tr><td>FC</td><td>' . __('Fielders Choice', 'bbnuke') . '</td></tr>
          <tr><td>SF</td><td>' . __('Sacrifice Fly', 'bbnuke') . '</td></tr>
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
        </table>
        </div>
        <br>&nbsp;<br>
        <strong>Just click outside the pop-up to close it.</strong>
    </div>';

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_roster( $atts, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $team   = $defs['defaultTeam'];
  $season = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $team,
              'season' => $season,
      ), $atts));
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $roster_num = bbnuke_get_option('bbnuke_roster_num');
  $roster_name = bbnuke_get_option('bbnuke_roster_name');
  $roster_pos = bbnuke_get_option('bbnuke_roster_pos');
  $roster_bats = bbnuke_get_option('bbnuke_roster_bats');
  $roster_throws = bbnuke_get_option('bbnuke_roster_throws');
  $roster_home = bbnuke_get_option('bbnuke_roster_home');
  $roster_school = bbnuke_get_option('bbnuke_roster_school');
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';
  $bbnuke_content = NULL;
  $bbnuke_content .= '<table class="bbnuke-schedule-table">
        <thead>
	<tr>';
	  if ($roster_num == 'true')
            $bbnuke_content .= '<th>' . __('#', 'bbnuke') . '</th>';
	  else $bbnuke_content .= '<th style="display:none">' . __('#', 'bbnuke') . '</th>';
	  if ($roster_name == 'true')
            $bbnuke_content .= '<th style="text-align:left;">' . __('Player', 'bbnuke') . '</th>';
	  else $bbnuke_content .= '<th style="text-align:left; display:none">' . __('Player', 'bbnuke') . '</th>';
          if ($roster_pos == 'true')
	    $bbnuke_content .= '<th>' . __('Pos', 'bbnuke') . '</th>';
          else $bbnuke_content .= '<th style="display:none">' . __('Pos', 'bbnuke') . '</th>';
          if ($roster_bats == 'true')
	    $bbnuke_content .= '<th>' . __('Bats', 'bbnuke') . '</th>';
          else $bbnuke_content .= '<th style="display:none">' . __('Bats', 'bbnuke') . '</th>';
          if ($roster_throws == 'true')
	    $bbnuke_content .= '<th>' . __('Throws', 'bbnuke') . '</th>';
          else $bbnuke_content .= '<th style="display:none">' . __('Throws', 'bbnuke') . '</th>';
          if ($roster_home == 'true')
	    $bbnuke_content .= '<th style="text-align:left;">' . __('Home', 'bbnuke') . '</th>';
	  else '<th style="text-align:left; display:none;">' . __('Home', 'bbnuke') . '</th>';
          if ($roster_school == 'true')
	    $bbnuke_content .= '<th style="text-align:left;">' . __('School', 'bbnuke') . '</th>';
	  else '<th style="text-align:left; display:none;">' . __('School', 'bbnuke') . '</th>';
  $bbnuke_content .= '
        </tr>
	</thead>
	<tbody>';
  $query = "SELECT playerID,lastname,firstname,middlename,jerseyNum,positions,bats,throws,city,state,school,".
	   "((date_format(now(),'%Y') - date_format(bdate,'%Y')) - (date_format(now(),'00-%m-%d') < date_format(bdate,'00-%m-%d'))) AS age".
           " FROM ".$wpdb->prefix."baseballNuke_players".
	   " WHERE season='".$season."' AND teamName='".$team."'".
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

    $bbnuke_content .= '<tr>';
          		    if ($roster_num == 'true')
            		      $bbnuke_content .= '<td>'.$jerseyNum.'</td>';
                            else $bbnuke_content .= '<td style="text-align:left; display:none"></td>';
		            if ($roster_name == 'true') {
 		              $bbnuke_content .= '<td style="text-align:left;"><a class="players-page-link" ';
 		              $bbnuke_content .= 'href="' . $player_stats_page .  $qstring . 'playerID=' . $playerID;
                      $bbnuke_content .= '&playerTeam='.urldecode($team).'&playerSeason='.urldecode($season).'" ';
                      $bbnuke_content .= 'title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>';
                    } else $bbnuke_content .= '<td style="text-align:left; display:none"></td>';
		            if ($roster_pos == 'true')
		              $bbnuke_content .= '<td>'.$positions.'</td>';
                            else $bbnuke_content .= '<td style="text-align:left; display:none"></td>';
		            if ($roster_bats == 'true')
		              $bbnuke_content .= '<td style="text-align:center;">'.$bats.'</td>';
                            else $bbnuke_content .= '<td style="text-align:left; display:none"></td>';
		            if ($roster_throws == 'true')
		              $bbnuke_content .= '<td style="text-align:center;">'.$throws.'</td>';
                            else $bbnuke_content .= '<td style="text-align:left; display:none"></td>';
		            if ($roster_home == 'true')
		              $bbnuke_content .= '<td style="text-align:left;">'.$location.'</td>';
                            else $bbnuke_content .= '<td style="text-align:left; display:none"></td>';
		            if ($roster_school == 'true')
		              $bbnuke_content .= '<td style="text-align:left;">'.$school.'</td>';
                            else $bbnuke_content .= '<td style="text-align:left; display:none"></td>';
  $bbnuke_content .= '
                        </tr>';
  }
     $bbnuke_content .= '</tbody></table>';
  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;


}


function  bbnuke_widget_pitchstats( $atts, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $team   = $defs['defaultTeam'];
  $season = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $team,
              'season' => $season,
      ), $atts));
  $pitching_num = bbnuke_get_option('bbnuke_pitching_num');
  $pitching_name = bbnuke_get_option('bbnuke_pitching_name');
  $pitching_w = bbnuke_get_option('bbnuke_pitching_w');
  $pitching_l = bbnuke_get_option('bbnuke_pitching_l');
  $pitching_s = bbnuke_get_option('bbnuke_pitching_s');
  $pitching_ip = bbnuke_get_option('bbnuke_pitching_ip');
  $pitching_h = bbnuke_get_option('bbnuke_pitching_h');
  $pitching_r = bbnuke_get_option('bbnuke_pitching_r');
  $pitching_er = bbnuke_get_option('bbnuke_pitching_er');
  $pitching_bb = bbnuke_get_option('bbnuke_pitching_bb');
  $pitching_k = bbnuke_get_option('bbnuke_pitching_k');
  $pitching_era = bbnuke_get_option('bbnuke_pitching_era');
  $pitching_whip = bbnuke_get_option('bbnuke_pitching_whip');
  $erainnings = bbnuke_get_option('bbnuke_era_innings');
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $SORTBY    = $_POST['bbnuke_widget_tb_head_pitchstats_sortby'];
  $SORTORDER = $_POST['bbnuke_widget_tb_head_pitchstats_sortorder'];
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';

  $bbnuke_content = NULL;
		
  $bbnuke_content .= '<table class="bbnuke-results-table">
		<thead>
		  <tr>';
   		  if ( $pitching_num == 'true')
   		    $bbnuke_content .= '<th>#</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
   		  if ( $pitching_name == 'true')
                    $bbnuke_content .= '<th>' . __('Pitching', 'bbnuke') . '</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_w == 'true')
                    $bbnuke_content .= '<th>W</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_l == 'true')
                    $bbnuke_content .= '<th>L</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_s == 'true')
                    $bbnuke_content .= '<th>S</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_ip == 'true')
                    $bbnuke_content .= '<th>IP</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_h == 'true')
                    $bbnuke_content .= '<th>H</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_r == 'true')
                    $bbnuke_content .= '<th>R</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_er == 'true')
                    $bbnuke_content .= '<th>ER</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_bb == 'true')
                    $bbnuke_content .= '<th>BB</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_k == 'true')
                    $bbnuke_content .= '<th>K</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_era == 'true')
                    $bbnuke_content .= '<th>ERA</th>';
   		  else $bbnuke_content .= '<th style="display:none"></th>';
                  if ( $pitching_whip == 'true')
                    $bbnuke_content .= '<th>WHIP</th>';
                  else $bbnuke_content .= '<th style="display:none"></th>';
  $bbnuke_content .= '</tr>
		</thead> 
		<tbody>';	

  //PITCHING STATS
  if ( $team == 'league' ) 
  {
  $query = "SELECT p.playerID, lastname,firstname,middlename,jerseyNum,sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, ".
                 "sum(piIP) as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, ".
                 "sum(piWalks) as piWalks, sum(piSO) as piSO ".
           "  FROM ".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_schedule s ".
           " WHERE s.gameID=st.gameID AND s.season='".$season."' AND p.season=s.season AND piIP>0 ".
                " AND st.playerID=p.playerID GROUP BY p.playerID ORDER BY lastname,firstname ASC";
  } else {
  $query = "SELECT p.playerID, lastname,firstname,middlename,jerseyNum,sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, ".
		 "sum(piIP) as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, ".
		 "sum(piWalks) as piWalks, sum(piSO) as piSO ".
           "  FROM ".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_schedule s ".		
           " WHERE s.gameID=st.gameID AND s.season='".$season."' AND teamName='".$team."' AND p.season=s.season AND piIP>0 ".
		" AND st.playerID=p.playerID GROUP BY p.playerID ORDER BY lastname,firstname ASC";
  }

  $result = mysql_query($query);
  if ( $result )
    while ( $row = mysql_fetch_array($result) )
      $presults[] = $row;

  for ($m=0; $m < count($presults); $m++) 
  {
    list($playerID,$lastname, $firstname, $middlename, $jerseyNum,$piWin,$piLose, $piSave, $piIP, $piHits, $piRuns, $piER, $piWalks, $piSO) = $presults[$m];
    if ($piIP){
      $ERA=($piER/$piIP)*$erainnings;
      $ERA=number_format($ERA, 2, '.', '');
      $WHIP=(($piWalks + $piHits) / $piIP);
      $WHIP=number_format($WHIP, 2, '.', '');
    }
    $bbnuke_content .= '<tr>'; 
                  if ( $pitching_num == 'true')
                    $bbnuke_content .= '<td>'.$jerseyNum.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_name == 'true')
                    $bbnuke_content .= '<td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_w == 'true')
                    $bbnuke_content .= '<td>'.$piWin.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_l == 'true')
                    $bbnuke_content .= '<td>'.$piLose.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_s == 'true')
                    $bbnuke_content .= '<td>'.$piSave.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_ip == 'true')
                    $bbnuke_content .= '<td>'.$piIP.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_h == 'true')
                    $bbnuke_content .= '<td>'.$piHits.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_r == 'true')
                    $bbnuke_content .= '<td>'.$piRuns.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_er == 'true')
                    $bbnuke_content .= '<td>'.$piER.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_bb == 'true')
                    $bbnuke_content .= '<td>'.$piWalks.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_k == 'true')
                    $bbnuke_content .= '<td>'.$piSO.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_era == 'true')
                    $bbnuke_content .= '<td>'.$ERA.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_whip == 'true')
                    $bbnuke_content .= '<td>'.$WHIP.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
$bbnuke_content .= '</tr>';
  }
		
  //SEASON PITCHING TOTAL
  unset($presults);
  
  if ( $team == 'league' ) 
  {
  $query="SELECT sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, sum(piIP) "
                        ."as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, "
                        ."sum(piWalks) as piWalks, sum(piSO) as piSO " .
         "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
         " WHERE pitchOrd>0 AND s.season='".$season."' AND p.playerID=st.playerID AND " .
         "       st.gameID=s.gameID AND p.season=s.season";
  } else {
  $query="SELECT sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave, sum(piIP) "
                        ."as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns, sum(piER) as piER, "
                        ."sum(piWalks) as piWalks, sum(piSO) as piSO " .
         "  FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s " .
         " WHERE pitchOrd>0 AND teamName='".$team."' AND s.season='".$season."' AND p.playerID=st.playerID AND " .
         "       st.gameID=s.gameID AND p.season=s.season";
  }
  $result = mysql_query($query);
    while ( $row = mysql_fetch_array($result) )
      $presults[] = $row;
  
  for ($m=0; $m < count($presults); $m++) 
  {
    list($piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO) = $presults[$m];
    if ($piIP){
      $ERA=($piER/$piIP)*$erainnings;
      $ERA=number_format($ERA, 2, '.', '');
      $WHIP=(($piWalks + $piHits) / $piIP);
      $WHIP=number_format($WHIP, 2, '.', '');
    }
    $bbnuke_content .= '</tbody><tr>';
                  if ( $pitching_num == 'true')
                    $bbnuke_content .= '<td>&nbsp;</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_name == 'true')
                    $bbnuke_content .= '<td style="text-align:left;"><b>TOTAL</b></td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_w == 'true')
                    $bbnuke_content .= '<td>'.$piWin.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_l == 'true')
                    $bbnuke_content .= '<td>'.$piLose.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_s == 'true')
                    $bbnuke_content .= '<td>'.$piSave.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_ip == 'true')
                    $bbnuke_content .= '<td>'.$piIP.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_h == 'true')
                    $bbnuke_content .= '<td>'.$piHits.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_r == 'true')
                    $bbnuke_content .= '<td>'.$piRuns.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_er == 'true')
                    $bbnuke_content .= '<td>'.$piER.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_bb == 'true')
                    $bbnuke_content .= '<td>'.$piWalks.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_k == 'true')
                    $bbnuke_content .= '<td>'.$piSO.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_era == 'true')
                    $bbnuke_content .= '<td>'.$ERA.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';
                  if ( $pitching_whip == 'true')
                    $bbnuke_content .= '<td>'.$WHIP.'</td>';
                  else $bbnuke_content .= '<td style="display:none"></td>';

$bbnuke_content .= ' </tr>
		 </table>';
  } 

  $bbnuke_content .= '
    <div><a href="#TB_inline?height=300&width=300&inlineId=bbnuke_pitching_stat_key_popup" class="thickbox">' . __('Stat Key', 'bbnuke') . '</a></div>
    <div id="bbnuke_pitching_stat_key_popup" style="display:none">
    <h2>' . __('Pitching Stats Key', 'bbnuke') . '</h2>
     <div>
      <table class="bbnuke-stat-key">
	<tr><td><u>' . __('Key', 'bbnuke') . '</u></td><td><u>' . __('Meaning', 'bbnuke') . '</u></td></tr>
	<tr><td colspan="2"><hr /></td></tr>
	<tr><td>W</td><td>' . __('Wins', 'bbnuke') . '</td></tr>
	<tr><td>L</td><td>' . __('Losses', 'bbnuke') . '</td></tr>
        <tr><td>S</td><td>' . __('Save', 'bbnuke') . '</td></tr>
	<tr><td>IP</td><td>' . __('Innings Pitched', 'bbnuke') . '</td></tr>
	<tr><td>H</td><td>' . __('Hits', 'bbnuke') . '</td></tr>
	<tr><td>R</td><td>' . __('Runs', 'bbnuke') . '</td></tr>
	<tr><td>ER</td><td>' . __('Earned Runs', 'bbnuke') . '</td></tr>
	<tr><td>BB</td><td>' . __('Walks (Bases on Balls)', 'bbnuke') . '</td></tr>
	<tr><td>K</td><td>' . __('Strikeouts', 'bbnuke') . '</td></tr>
	<tr><td>ERA</td><td>' . __('Earned Run Average', 'bbnuke') . '</td></tr>
        <tr><td>WHIP</td><td>' . __('Walks plus Hits per Inning Pitched', 'bbnuke') . '</td></tr>
      </table>
      </div>
      <br>&nbsp;<br>
      <strong>Just click outside the pop-up to close it.</strong>
   </div>';

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_fieldstats( $atts, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $dteam,
              'season' => $dseason,
      ), $atts));
  
  $bbnuke_content = NULL;

  $bbnuke_content .= '<table class="bbnuke-results-table">
		<thead>
		<tr>
		  <th>#</th>
                  <th>Fielder</th>
                  <th>PO</th>
                  <th>A</th>
                  <th>E</th>
                  <th>FP</th>
		</tr>
		</thead>
		<tbody
';

  //Fielding STATS
  $query = "SELECT p.playerID,p.lastname,p.firstname,p.middlename,p.jerseyNum,".
		" sum(st.fiPO)as fiPO, sum(st.fiA) as fiA, sum(st.fiE) as fiE ".
		" FROM ".$wpdb->prefix."baseballNuke_players p,".$wpdb->prefix."baseballNuke_stats st,".$wpdb->prefix."baseballNuke_schedule s ".
		" WHERE p.playerID=st.playerID AND teamName='".$team."' AND DATE_FORMAT(gameDate,'%Y')='".$season."'".
		" AND st.gameID=s.gameID AND p.season=DATE_FORMAT(gameDate,'%Y') GROUP BY p.playerID ORDER BY lastname,firstname ASC";
	
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

  $bbnuke_content .= '</tbody><tr><td></td><td><strong>TOTALS</strong></td>
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
  $dseason = $defs['defaultSeason'];
  $dteam   = $defs['defaultTeam'];
  $erainnings = bbnuke_get_option('bbnuke_era_innings');
  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');
  $player_id = $_COOKIE["playerID"];

  if($_COOKIE["playerTeam"]!=null) {
      // Override the default Team with roster page player team
      $dteam = $_COOKIE["playerTeam"];
  }
  if($_COOKIE["playerSeason"]!=null) {
      // Override the default Team with roster page player season
      $dseason = $_COOKIE["playerSeason"];
  }

  $game_results_page = get_permalink(bbnuke_get_option('bbnuke_game_results_page'));
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';
  $bbnuke_content = NULL;
	
  if(!$player_id)
    $player_id = bbnuke_get_option('bbnuke_widget_playerstats_player_id');

  $query = 'SELECT playerID,teamname,firstname, middlename,lastname,positions,bats,throws,height,weight,jerseyNum,picLocation,profile ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_players WHERE playerID = ' . $player_id . ' AND season="' . $dseason . '"';


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
    $bbnuke_content .= '<table class="bbnuke_players_profile"><tr><td>';
    if($picLocation)
      $bbnuke_content .= '<img src="' . $picLocation . '" align="left" alt="Player Image" id="bbnuke_players_img" />';
    $bbnuke_content .= '<b>#' . $jerseyNum . '</b><br />';
    $bbnuke_content .= '<br /><b>' . $lastname . ', ' . $firstname . '</b><br />';
    $bbnuke_content .= '<br /><b>' . __('Positions:', 'bbnuke') . '</b> ' . $positions . '<br />';
    $bbnuke_content .= '<b>' . __('Schl&aumlgt:', 'bbnuke') . '</b> ' . $bats . '    <b>' . __('Wirft:', 'bbnuke') . '</b>' . $throws . '<br />';
    if($height)
      $bbnuke_content .= '<b>' . __('Gr&oumlsse:', 'bbnuke') . '</b> ' . $usheight . '';
    if($weight)
      $bbnuke_content .= ' <b>' . __('Gewicht:', 'bbnuke') . '</b>' . $weight . '';
    if($profile)
      $bbnuke_content .= '<p><b>' . __('', 'bbnuke') . '</b> ' . $profile . '</p>';
    $bbnuke_content .= '</td></tr></table>
                     <div style="width:100%">
                         <div class="tabs">
                           <a class="tab" onclick=showTab("#Offense")>Offense</a>  <a class="tab" onclick=showTab("#Pitching")>Pitching</a>  <a class="tab" onclick=showTab("#Fielding")>Fielding</a>
                           <hr>
                         </div>
		<div id="Offense" class="tabContent" style="display:block;width:100%">';

  }

  $bbnuke_content .= '<br /><b>' . __('Batting Statistics', 'bbnuke') . ' &nbsp; ' . $dseason . '</b><br />
		<table class="bbnuke-results-table">
		  <thead>
		  <tr>
		    <th>' . __('Opponent', 'bbnuke') . '</th>
                    <th>AB</th>
                    <th>R</th>
                    <th>H</th>
                    <th>2B</th>
                    <th>3B</th>
                    <th>HR</th>
                    <th>RE</th>
                    <th>FC</th>
                    <th>SF</th>
                    <th>HP</th>
                    <th>RBI</th>
                    <th>BA</th>
                    <th>OBP</th>
                    <th>SLG</th>
                    <th>OPS</th>
                    <th>BB</th>
                    <th>K</th>
                    <th>LOB</th>
                    <th>SB</th>
		</thead>
		</tr>
		<tbody>
 ';
///////////////////////////////
//GET PLAYER PER GAME STATS
///////////////////////////////
  $query = 'SELECT baAB, baRuns, ba1b, ba2b, ba3b, baHR, baRE, baFC, baSF, baHP, baRBI, baBB, baK, baLOB, baSB,homeTeam,visitingTeam, hruns, vruns, gameDate, gameTime, s.gameID ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_boxscores b, ' . $wpdb->prefix . 'baseballNuke_stats st ' .
           ' LEFT JOIN ' . $wpdb->prefix . 'baseballNuke_schedule s ON st.gameID=s.gameID ' .
           ' WHERE playerID=' . $player_id . ' AND b.gameID=s.gameID AND battOrd>0 ' .
           ' AND season = "' . $dseason . '" ORDER BY gameDate';

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
    list($baAB, $baRuns, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baSF, $baHP, $baRBI, $baBB, $baK, $baLOB, $baSB, $homeTeam,
	$visitingTeam, $hruns, $vruns, $gameDate, $gameTime, $gameID) = $bresults[$m];
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
        $obp=($hits+$baBB+$baHP)/($baAB+$baBB+$baHP+$baSF);
        $obp=number_format("$obp", 3);
        $obp = ltrim($obp,"0");
      if (($baAB+$baBB) == 0)
        {$obp = ".000";}
      if ($obp == 0)
        {$obp=".000";}

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
        {$ba = ".000";}
      if ($ba == 0)
        {$ba = ".000";}
      else
      {
        $ba=substr($ba,1);
        $ba=str_replace("0000","0",$ba);
     }

    list($year, $month, $day) = split("-", $gameDate);
    $modGameDate = date('M d', mktime(0, 0, 0, $month, $day, $year));

    $bbnuke_content .= '<tr><td style="text-align:left;"><a href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'; 
    if($homeTeam==$dteam)
       $bbnuke_content .= $visitingTeam; 	 
    else
       $bbnuke_content .= ' @ ' . $homeTeam; 	 
         	 
    $bbnuke_content .= '</a></td>
                        <td>' . $baAB . '</td>
                        <td>' . $baRuns . '</td>
                        <td>' . $hits . '</td>
                        <td>' . $ba2b . '</td>
                        <td>' . $ba3b . '</td>
                        <td>' . $baHR . '</td>
                        <td>' . $baRE . '</td>
                        <td>' . $baFC . '</td>
                        <td>' . $baSF . '</td>
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
    $bbnuke_content .= '</tbody>';

  unset($gresults);

///////////////////////////////////////////
//GET CURRENT SEASON TOTALS
//////////////////////////////////////////
    $query = 'SELECT baTotAB,baTotH,baTotRuns,baTot1b,baTot2b,baTot3b,baTotHR,baTotRE, ' .
            '       baTotFC,baTotSF,baTotHP,baTotRBI,baTotBB,baTotK,baTotLOB,baTotSB ' .
            '  FROM ' . $wpdb->prefix . 'baseballNuke_statTotals' .
            ' WHERE season = "' . $dseason. '" AND playerID = ' . $player_id . ' ';
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
    list($baAB, $baH, $baR, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baSF, $baHP, $baRBI, $baBB, $baK, $baLOB,$baSB) = $gresults[$m];
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
        $obp=($baH+$baBB+$baHP)/($baAB+$baBB+$baHP+$baSF);
        $obp=number_format("$obp", 3);
        $obp = ltrim($obp,"0");
      if (($baAB+$baBB) == 0)
        {$obp = ".000";}
      if ($obp == 0)
        {$obp=".000";}

      if ( $baAB > 0 )
        $ops=($obp+$slg);
        $ops=number_format("$ops",3);
        $ops = ltrim($ops,"0");
      if ( $baAB == 0)
      {
        $ops = ".000";
      }
      if ( $baAB > 0)
        $ba=round($baH/$baAB,3);
      $ba=strval($ba);
      $ba=str_pad($ba,5,"0");
      if($ba=="10000")
      {
        $ba=substr($ba,0,-1);
      }
      if ( $baAB == 0)
        {$ba = ".000";}
      if ($ba == 0)
        {$ba = ".000";}
      else
      {
        $ba=substr($ba,1);
        $ba=str_replace("0000","0",$ba);
     }

    $bbnuke_content .= '<tr><td style="text-align:left;"><b>' . __('TOTAL FOR ', 'bbnuke') . $dseason . __(' Season', 'bbnuke') . '</b></td>
	          <td><b>' . $baAB . '</b></td>
	          <td><b>' . $baR  . '</b></td>
	          <td><b>' . $baH . '</b></td>
	          <td><b>' . $ba2b . '</b></td>
	          <td><b>' . $ba3b . '</b></td>
	          <td><b>' . $baHR . '</b></td>
	          <td><b>' . $baRE . '</b></td>
	          <td><b>' . $baFC . '</b></td>
                  <td><b>' . $baSF . '</b></td>
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


  $bbnuke_content .= '</tbody></table>
		<br /><b>' . __('Batting Statistics CAREER', 'bbnuke') . '</b><br />
                <table class="bbnuke-results-table">
                  <thead>
                  <tr>
                    <th>' . __('Season', 'bbnuke') . '</th>
                    <th>AB</th>
                    <th>R</th>
                    <th>H</th>
                    <th>2B</th>
                    <th>3B</th>
                    <th>HR</th>
                    <th>RE</th>
                    <th>FC</th>
                    <th>SF</th>
                    <th>HP</th>
                    <th>RBI</th>
                    <th>BA</th>
                    <th>OBP</th>
                    <th>SLG</th>
                    <th>OPS</th>
                    <th>BB</th>
                    <th>K</th>
                    <th>LOB</th>
                    <th>SB</th>
                </thead>
                </tr>
                <tbody>
 ';
/////////////////////////////////////////
//GET TOTAL BATTING STATS FOR EACH SEASON
/////////////////////////////////////////

 //GET LIST OF ALL SEASONS FOR PLAYER
   $query = 'SELECT season FROM ' . $wpdb->prefix . 'baseballNuke_players WHERE playerID=' . $player_id . ' ';
   $result = mysql_query($query);
   if ( $result )
   {
     while ( $row = mysql_fetch_array($result) )
     {
       $past_season[] = $row;
     }
   }
   for ($m=0; $m < count($past_season); $m++){
     list($p_season) = $past_season[$m];
     $query = 'SELECT baTotAB,baTotH,baTotRuns,baTot1b,baTot2b,baTot3b,baTotHR,baTotRE, ' .
             ' baTotFC,baTotSF,baTotHP,baTotRBI,baTotBB,baTotK,baTotLOB,baTotSB,season ' .
             ' FROM ' . $wpdb->prefix . 'baseballNuke_statTotals' .
             ' WHERE season = "' . $p_season. '" AND playerID = ' . $player_id . ' ';
     $result = mysql_query($query);
     if ( $result )
     {
       while ( $row = mysql_fetch_array($result) )
       {
         $results[] = $row;
       }
     }
   }
   for ($n=0; $n < count($results); $n++)
   {
     list($baAB,$baH,$baR,$ba1b,$ba2b,$ba3b,$baHR,$baRE,$baFC,$baSF,$baHP,$baRBI,$baBB,$baK,$baLOB,$baSB,$c_season) = $results[$n];
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
          $obp=($baH+$baBB+$baHP)/($baAB+$baBB+$baHP+$baSF);
          $obp=number_format("$obp", 3);
          $obp = ltrim($obp,"0");
       if (($baAB+$baBB) == 0)
          {$obp = ".000";}
       if ($obp == 0)
          {$obp=".000";}
  
       if ( $baAB > 0 )
          $ops=($obp+$slg);
          $ops=number_format("$ops",3);
          $ops = ltrim($ops,"0");
       if ( $baAB == 0)
        {
          $ops = ".000";
        }
       if ( $baAB > 0)
          $ba=round($baH/$baAB,3);
        $ba=strval($ba);
        $ba=str_pad($ba,5,"0");
       if($ba=="10000")
        {
          $ba=substr($ba,0,-1);
        }
       if ( $baAB == 0)
          {$ba = ".000";}
       if ($ba == 0)
          {$ba = ".000";}
       else
        {
          $ba=substr($ba,1);
          $ba=str_replace("0000","0",$ba);
        }
  
      $bbnuke_content .= '<tr><td style="text-align:left;">' . $c_season . __(' Season', 'bbnuke') . '</td>
                    <td>' . $baAB . '</td>
                    <td>' . $baR  . '</td>
                    <td>' . $baH . '</td>
                    <td>' . $ba2b . '</td>
                    <td>' . $ba3b . '</td>
                    <td>' . $baHR . '</td>
                    <td>' . $baRE . '</td>
                    <td>' . $baFC . '</td>
                    <td>' . $baSF . '</td>
                    <td>' . $baHP . '</td>
                    <td>' . $baRBI . '</td>
                    <td>' . $ba .  '</td>
                    <td>' . $obp . '</td>
                    <td>' . $slg . '</td>
                    <td>' . $ops . '</td>
                    <td align="center">' . $baBB . '</td>
                    <td align="center">' . $baK . '</td>
                    <td align="center">' . $baLOB . '</td>
                    <td align="center">' . $baSB . '</td>
                  </tr>';
    }



////////////////////////////////
//GET CAREER TOTAL BATTING STATS
////////////////////////////////
  $query = 'SELECT sum(baAb) as baAB, sum(baRuns) as baR,sum(ba1b) as ba1b, sum(ba2b) as ba2b, sum(ba3b) as ba3b, ' .
           '       sum(baHR) as baHR,sum(baRE) as baRE,sum(baFC) as baFC, sum(baSF) as baSF, sum(baHP) as baHP, ' .
           '       sum(baRBI) as baRBI, sum(baBB) as baBB, sum(baK) as baK, sum(baLOB) as baLOB,sum(baSB) as baSB ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_stats st ' .
           ' WHERE st.playerID = ' . $player_id . ' ';
  $result = mysql_query($query);
  if ( $result )
  {
    $row = mysql_fetch_array($result);
  }

  list($baAB, $baR, $ba1b, $ba2b, $ba3b, $baHR, $baRE, $baFC, $baSF, $baHP, $baRBI, $baBB, $baK, $baLOB,$baSB) = $row;
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
        $obp=($hits+$baBB+$baHP)/($baAB+$baBB+$baHP+$baSF);
        $obp=number_format("$obp", 3);
        $obp = ltrim($obp,"0");
      if (($baAB+$baBB) == 0)
        {$obp = ".000";}
      if ($obp == 0)
        {$obp=".000";}

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
        {$ba = ".000";}
      if ($ba == 0)
        {$ba = ".000";}
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
                      <td><b>' . $baSF . '</b></td>
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
    
  $bbnuke_content .= '</tbody>
		   </table>
		 </div>';


//////////////////////////
//	PITCHING STATS
//////////////////////////
  $query = 'SELECT piWin,piLose,piSave,piIP,piHits,piRuns,piER,piWalks,piSO,homeTeam,visitingTeam,hruns,vruns,gameDate,gameTime,s.gameID ' .
           '  FROM ' . $wpdb->prefix . 'baseballNuke_boxscores b, ' . $wpdb->prefix . 'baseballNuke_stats st ' .
           ' LEFT JOIN ' . $wpdb->prefix . 'baseballNuke_schedule s ON st.gameID=s.gameID ' .
           ' WHERE playerID = ' . $player_id . ' AND b.gameID=s.gameID AND season = "' . $dseason . '" AND pitchOrd>0 ORDER BY gameDate';

  $result = mysql_query($query);
  if ($result)
  {
    while ( $row = mysql_fetch_array($result) )
    {
      $pitchresults[] = $row;
      $showPitchingStats+=$row['piIP'];
    }
  }
  $bbnuke_content .= '<div id="Pitching" class="tabContent" style="display:none;width:100%">';
if ($showPitchingStats>0)
{
  $bbnuke_content .= '<b>' . __('Pitching Statistics', 'bbnuke') . '&nbsp;' .$dseason . '</b><br />
		<table class="bbnuke-results-table">
		  <thead>
		  <tr>
		    <th>' . __('Game', 'bbnuke') . '</th>
                    <th>W</th>
                    <th>L</th>
                    <th>S</th>
                    <th>IP</th>
                    <th>H</th>
                    <th>R</th>
                    <th>ER</th>
                    <th>BB</th>
                    <th>K</th>
                    <th>ERA</th>
		  </tr>
		  </thead>
		  <tbody> ';

  for ($m=0; $m < count($pitchresults); $m++) 
  {
    list($piWin,$piLose, $piSave, $piIP, $piHits, $piRuns, $piER, $piWalks, $piSO, $homeTeam, $visitingTeam, $hruns, $vruns, 
	  	$gameDate, $gameTime, $gameID) = $pitchresults[$m];
    $hits=$ba1b+$ba2b+$ba3b+$baHR;
    if ($piIP > 0)
      $ERA=($piER/$piIP)*$erainnings;
      $ERA=number_format($ERA, 2, '.', '');
    $bbnuke_content .= '<tr><td style="text-align:left;"><a href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'; 
    if($homeTeam==$dteam) 	 
      $bbnuke_content .= $visitingTeam; 	 
    else 	 
      $bbnuke_content .=  ' @ ' . $homeTeam;
         	 
    $bbnuke_content .= '</a></td>
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
	
////////////////////////////////
// PITCHING TOTAL FOR SEASON
////////////////////////////////
  unset($pitchresults);
  $query = 'SELECT piTotWin,piTotLose,piTotSave,piTotIP,piTotHits,piTotRuns,piTotER,piTotWalks,piTotSO ' .
           'FROM ' . $wpdb->prefix . 'baseballNuke_statTotals ' .
           'WHERE (piTotIP>0 OR piTotHits>0 OR piTotWalks>0) AND season = "' . $dseason . '" AND playerID = ' . $player_id . ' ';
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
    list($piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO) = $pitchresults[$m];
    if ($piIP > 0)
      $ERA=($piER/$piIP)*$erainnings;
      $ERA=number_format($ERA, 2, '.', '');
    $bbnuke_content .= '</tbody><tr><td style="text-align:left;"><b>' . __('TOTAL FOR ', 'bbnuke') . $dseason . __(' Season', 'bbnuke') . '</b></td>
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
  $bbnuke_content .= '</table><br>';
unset($pitchresults);

/////////////////////////////////////
// PITCHING TOTALS FOR EACH SEASON
/////////////////////////////////////
  $bbnuke_content .= '<b>' . __('Pitching Statistics', 'bbnuke') . ' Career</b><br />
                <table class="bbnuke-results-table">
                  <thead>
                  <tr>
                    <th>' . __('Game', 'bbnuke') . '</th>
                    <th>W</th>
                    <th>L</th>
                    <th>S</th>
                    <th>IP</th>
                    <th>H</th>
                    <th>R</th>
                    <th>ER</th>
                    <th>BB</th>
                    <th>K</th>
                    <th>ERA</th>
                  </tr>
                  </thead>
                  <tbody> ';

   for ($m=0; $m < count($past_season); $m++){
     list($p_season) = $past_season[$m];
           $query = 'SELECT piTotWin,piTotLose,piTotSave,piTotIP,piTotHits,piTotRuns,piTotER,piTotWalks,piTotSO,season ' .
           'FROM ' . $wpdb->prefix . 'baseballNuke_statTotals ' .
           'WHERE (piTotIP>0 OR piTotHits>0 OR piTotWalks>0) AND season = "' . $p_season . '" AND playerID = ' . $player_id . ' ';
     $result = mysql_query($query);
     if ( $result )
     {
       while ( $row = mysql_fetch_array($result) )
       {
         $pitchresults[] = $row;
       }
     }
   }
  for ($m=0; $m < count($pitchresults); $m++)
  {
    list($piWin,$piLose,$piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$c_season) = $pitchresults[$m];
    if ($piIP > 0)
      $ERA=($piER/$piIP)*$erainnings;
      $ERA=number_format($ERA, 2, '.', '');
    $bbnuke_content .= '<tr><td style="text-align:left;">' . $c_season . ' Season</a></td>
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
unset($pitchresults);

//////////////////////////
//  CAREER PITCHING TOTAL
//////////////////////////
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
      $ERA=number_format($ERA, 2, '.', '');
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
}else{
  $bbnuke_content .= 'No pitching stats available';
}
  $bbnuke_content .= '</table>
		   </div>
		   <div id="Defense" class="tabContent" style="display:none;width:100%">
			&nbsp;
		   </div></div>';

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}

/*
function  bbnuke_widget_top5stats( $atts, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $team   = $defs['defaultTeam'];
  $season = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $team,
              'season' => $season,
     ), $atts));
  $erainnings = bbnuke_get_option('bbnuke_era_innings');
  $player_stats_page = get_permalink(bbnuke_get_option('bbnuke_player_stats_page'));
  $team_leaders = bbnuke_get_option('bbnuke_team_leaders');
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';

  $bbnuke_content = NULL;

  #
  # bat stats
  #

  $heading_arr = array(
      __('Batting Average', 'bbnuke'),
      __('Hits', 'bbnuke'),
      __('Home Runs', 'bbnuke'),
      __('RBI', 'bbnuke'),
      __('Team Leader In Slugging Percentage', 'bbnuke'),
      __('Team Leader In On Base Percentage', 'bbnuke')
      ); 
     $bbnuke_content .= '<div style="display:inline;"> <h2> '.__('Offensive Leaders', 'bbnuke').' </h2><br>';

////////////////////////////////////////////

  for ( $i=0; $i < 6; $i++ )
  {
    switch ($i)        
    {
      case 0:
        #Batting Average Leaders
        $players = bbnuke_get_batting_avg($season,$team);
          $bbnuke_content .= '
                <table class="bbnuke-leaders-table">
                  <tr>
                    <th>&nbsp;</th>
                    <th>' . $heading_arr[$i] . '</th>
                  </tr>';

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
          $bbnuke_content .= '
		  <tr>
                    <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
		    <td>' . $bAvg . '</td>
                  </tr>';
        }	
          $bbnuke_content .= '</table>';

        break;
      case 1:
        #Hits Leaders    
        $players = bbnuke_get_hit_leaders($season,$team);
          $bbnuke_content .= '
                <table class="bbnuke-leaders-table">
                  <tr>
                    <th>&nbsp;</th>
                    <th>' . $heading_arr[$i] . '</th>
                  </tr>';

        for ( $m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotH) = $players[$m];
          $bbnuke_content .= '
                  <tr>
                    <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
                    <td>' . $baTotH . '</td>
                  </tr>';
        }
          $bbnuke_content .= '</table>';
        break;
      case 2:
//        Homerun Leaders
        $players = bbnuke_get_homerun_leaders($season,$team);
          $bbnuke_content .= '
                <table class="bbnuke-leaders-table">
                  <tr>
                    <th>&nbsp;</th>
                    <th>' . $heading_arr[$i] . '</th>
                  </tr>';

        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotHR) = $players[$m];
          $bbnuke_content .= '
                  <tr>
                    <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
                    <td>' . $baTotHR . '</td>
                  </tr>';
        }
          $bbnuke_content .= '</table>';
        break;
      case 3:
        $players = bbnuke_get_rbi($season,$team);
          $bbnuke_content .= '
                <table class="bbnuke-leaders-table">
                  <tr>
                    <th>&nbsp;</th>
                    <th>' . $heading_arr[$i] . '</th>
                  </tr>';

        for ($m=0; $m < count($players); $m++) 
        {
          list($playerID,$lastname, $firstname, $middlename, $jerseyNum, $baTotRBI) = $players[$m];
          $bbnuke_content .= '
                  <tr>
                    <td style="text-align:left;"><a class="players-page-link" href="' . $player_stats_page . $qstring . 'playerID=' . $playerID . '" title="' . __('Show Players Info', 'bbnuke') . '">'.$lastname.', '.$firstname.'</a></td>
                    <td>' . $baTotRBI . '</td>
                  </tr>';
        }
          $bbnuke_content .= '</table>
                </div>';
        break;
    }

  }





 



///////////////////////////////////
/// field stats
//////////////////////////////////
/*
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
               " WHERE p.playerID=".$playerID." AND teamName='".$dteam."' AND season='".$dseason."' AND " .
               "       p.playerID=st.playerID AND st.gameID=s.gameID";
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
		" WHERE s.gameID=st.gameID AND p.season='".$dseason."'".
		" AND piIP>0 AND st.playerID=p.playerID GROUP BY playerID ORDER BY ERA ASC LIMIT ".$team_leaders;
    }
    else if($i==1)
    {
      $query = "SELECT DISTINCT p.playerID, lastname, firstname, middlename, jerseyNum, ".
		" sum(piWin)as piWin, sum(piLose) as piLose, sum(piSave) as piSave,sum(piIP) as piIP, sum(piHits) as piHits, sum(piRuns) as piRuns,".
		"  sum(piER) as piER,sum(piWalks) as piWalks, sum(piSO) as piSO, round(sum((piER/piIP)*".$erainnings."),2) as ERA ".
		" FROM ".$wpdb->prefix."baseballNuke_stats st, ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_schedule s ".
		" WHERE s.gameID=st.gameID AND p.season='".$dseason."' ".
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
*/


function  bbnuke_widget_team_schedule( $atts, $bbnuke_echo = true )
{
  global $wpdb;
  $defs    = bbnuke_get_defaults();
  $team   = $defs['defaultTeam'];
  $season = $defs['defaultSeason'];
     extract(shortcode_atts(array(
	      'team' => $team,
	      'season' => $season,
     ), $atts));
  $game_results_page = get_permalink(bbnuke_get_option('bbnuke_game_results_page'));
  $locations_page = get_permalink(bbnuke_get_option('bbnuke_locations_page'));
  $timeformat = get_option('time_format');
  $dateformat = get_option('date_format');
  $wins = 0;
  $loses = 0;
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';

  $bbnuke_content = NULL;
  $bbnuke_content = 
	'<table class="bbnuke-schedule-table">
	<tr>  
	  <th>' . __('Game Date', 'bbnuke') . '</th>
 	  <th>' . __('Home', 'bbnuke') . '</th>
	  <th>' . __('Visitor', 'bbnuke') . '</th>
	  <th>' . __('Field', 'bbnuke') . '</th>
	</tr>';

  if($team == 'league'){
      $query = "SELECT s.gameID,gameTime,gameDate,homeTeam,visitingTeam, field, vruns, hruns, b.status " .
           "FROM " . $wpdb->prefix . "baseballNuke_schedule s " .
                 " LEFT JOIN " .$wpdb->prefix . "baseballNuke_boxscores b ON s.gameID = b.gameID " .
                 " WHERE season= '" . $season . "' AND type='game'" .
                 "ORDER BY gameDate ASC";
  }else{		
  $query = "SELECT s.gameID,gameTime,gameDate,homeTeam,visitingTeam, field, vruns, hruns, b.status " .
           "FROM " . $wpdb->prefix . "baseballNuke_schedule s " . 
                 " LEFT JOIN " .$wpdb->prefix . "baseballNuke_boxscores b ON s.gameID = b.gameID " .
                 " WHERE season= '" . $season . "' " .
                 " AND (homeTeam='" . $team . "' OR visitingTeam='" . $team . "') AND type='game'" .
		 "ORDER BY gameDate ASC";
  }
  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
  {
    $schedule[] = $row;
  }

  for ($m=0; $m < count($schedule); $m++) 
  {
    list($gameID,$gameTime,$gameDate,$homeTeam,$visitingTeam,$field,$vruns,$hruns,$status) = $schedule[$m];
    list($year, $month, $day) = split("-", $gameDate);
 
    $date =date_create("$gameDate $gameTime");
    $bbnuke_content .= "<tr>";
   $wt = ($hruns > $vruns) ? 1 : 2;
    if ($hruns > $vruns) { $wt = 1; } elseif ( $hruns == $vruns) { $wt = 3; } else { $wt = 2; }

    if(strtolower($team) == strtolower($homeTeam))
    {
         if ($wt == 1) { $result = "Win"; } elseif ($wt ==2) { $result = "Loss"; } else { $result = "Tie"; }
         $score = ($wt == 1) ? $hruns.' - '.$vruns : $vruns.' - '.$hruns;
    }
    else {
         if ($wt == 2) { $result = "Win"; } elseif ($wt ==1) { $result = "Loss"; } else { $result = "Tie"; }
         $score = ($wt == 1) ? $hruns.' - '.$vruns : $vruns.' - '.$hruns;
    }

    if(($status === "Complete") && ($team != 'league'))
    {
      $bbnuke_content .= '<td><a href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">'.$result.' '.$score.'</a></td>';
    }
    elseif(($status === "Complete") && ($team == 'league'))
    {
      $bbnuke_content .= '<td><a href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">Final '.$score.'</a></td>';
    }
     elseif($status === "Suspended")
     {
       $bbnuke_content .= '<td><a href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">Suspended '.$score.'</a></td>';
     }

     elseif($status === "Cancelled")
     {
       $bbnuke_content .= '<td><a href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">Cancelled</a></td>';
     }
     elseif($status === "Postponed")
     {
       $bbnuke_content .= '<td><a href="'.$game_results_page.$qstring.'gameID='.$gameID.'" title="' . __('Show Game Results', 'bbnuke') . '">Postponed</a></td>';
     }
    else
    {
      $bbnuke_content .= '<td>'.date_format($date,"$dateformat $timeformat").'</td>';
    }
      $bbnuke_content .= '<td>'.$homeTeam.'</td>';
      $bbnuke_content .= '<td>'.$visitingTeam.'</td>';
    if($status === "Complete" || $status === "Suspended")
    {
       $bbnuke_content .= '<td><a href="' . $game_results_page . $qstring . 'gameID=' . $gameID . '">Game Recap / Box Score</a></td>';
    }
    else
    {
            $bbnuke_content .= '<td><a href="' . $locations_page . $qstring .'field=' . $field . '" title="' . __('Show Locations Info', 'bbnuke') . '">'.$field.'</a></td>';
        }
    $bbnuke_content .= '</tr>';
  }
  $bbnuke_content .= "</table>";
//echo 'Wins = '.$wins.' and Loses = '.$loses;
  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_team_practices( $atts, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $dteam,
              'season' => $dseason,
      ), $atts));
  $locations_page = get_permalink(bbnuke_get_option('bbnuke_locations_page'));
  $timeformat = get_option('time_format');
  $dateformat = get_option('date_format');
  if ( get_option('permalink_structure') != '' )
    $qstring='?';
  else
    $qstring='&';
  $bbnuke_content = NULL;
  $bbnuke_content .= '<table class="bbnuke-schedule-table">
	<tr>
	  <th><b>' . __('Practice Date', 'bbnuke') . '</b></td>
	  <th><b>' . __('Field', 'bbnuke') . '</b></td>
	  <th><b>' . __('Notes', 'bbnuke') . '</b></td>
	</tr>';
  if($dteam == 'league'){
    $query = "SELECT s.gameID, gameTime,gameDate, field, Notes ".
             "FROM " . $wpdb->prefix . "baseballNuke_schedule s ".
             "WHERE season = '" . $season ."' AND type = 'practice' ORDER BY gameDate ASC";
  }else{
    $query = "SELECT s.gameID, gameTime,gameDate, field, Notes ". 
             "FROM " . $wpdb->prefix . "baseballNuke_schedule s ". 
             "WHERE homeTeam='" . $dteam . "' AND season = '" . $season ."' AND type = 'practice' ORDER BY gameDate ASC"; 
  }

  $result = mysql_query($query);
  while ( $row = mysql_fetch_array($result) )
  {
    $practices[] = $row;
  }

  for ($m=0; $m < count($practices); $m++) 
  {
    list($gameID,$Gtime,$Gdate,$field,$Notes) = $practices[$m];
    $date =date_create("$Gdate $Gtime");
    $bbnuke_content .= '<tr><td>'.date_format($date,"$dateformat $timeformat").'</td>';
    $bbnuke_content .= '<td><a href="' . $locations_page . $qstring . 'field=' . $field . '" title="' . __('Show Locations Info', 'bbnuke') . '" >'.$field.'</a></td>';
    $bbnuke_content .= '<td>'.$Notes.'</td></tr>';
  }

  $bbnuke_content .= "</table>";

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}



function  bbnuke_widget_game_results( $atts, $game_id = NULL, $player_id = NULL, $bbnuke_echo = true )
{
  global $wpdb;

  $defs    = bbnuke_get_defaults();
  $dteam   = $defs['defaultTeam'];
  $dseason = $defs['defaultSeason'];
     extract(shortcode_atts(array(
              'team' => $dteam,
              'season' => $dseason,
      ), $atts));
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
  list($gameID,$v1,$v2,$v3,$v4,$v5,$v6,$v7,$v8,$v9,$h1,$h2,$h3,$h4,$h5,$h6,$h7,$h8,$h9,$vhits,$vruns,$verr,$hhits,$hruns,$herr,$notes,$postID) = $score;
		
  $bbnuke_content .= '<table align="center">
        <tr>
          <td align="center"><h2>' . $VISITTEAM . ' ' . $vruns . ' , ' . $HOMETEAM . ' ' . $hruns . '</h2></td>
   </tr>
   <tr>
      <td>&nbsp;</td>
   </tr>
   <tr>
      <td align="center"> 
        <table align="center" class="bbnuke-boxscore-table">
           <tr bgcolor="' . $bgcolor2 . '"> 
              <th></th>
              <th width="20">1</th>
              <th width="20">2</th>
              <th width="20">3</th>
              <th width="20">4</th>
              <th width="20">5</th>
              <th width="20">6</th>
              <th width="20">7</th>
              <th width="20">R</th>
              <th width="20">H</th>
              <th width="20">E</th>
           </tr>
           <tr> 
              <td style="text-align:left;">' . $VISITTEAM . '&nbsp;&nbsp;</td>
              <td width="20">' . $v1 . '</td>
              <td width="20">' . $v2 . '</td>
              <td width="20">' . $v3 . '</td>
              <td width="20">' . $v4 . '</td>
              <td width="20">' . $v5 . '</td>
              <td width="20">' . $v6 . '</td>
              <td width="20">' . $v7 . '</td>         
              <td width="20">' . $vruns . '</td>
	      <td width="20">' . $vhits . '</td>
              <td width="20">' . $verr . '</td>
           </tr>
           <tr> 
              <td style="text-align:left;">' . $HOMETEAM . '&nbsp;&nbsp;</td>
              <td width="20">' . $h1 . '</td>
              <td width="20">' . $h2 . '</td>
              <td width="20">' . $h3 . '</td>
              <td width="20">' . $h4 . '</td>
              <td width="20">' . $h5 . '</td>
              <td width="20">' . $h6 . '</td>
              <td width="20">' . $h7 . '</td>           
              <td width="20">' . $hruns . '</td>
	      <td width="20">' . $hhits . '</td>
              <td width="20">' . $herr . '</td>
           </tr>
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
              <th>SF</th>
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
                   " baAB,ba1b,ba2b,ba3b,baHR,baRE,baFC,baSF,baHP,baRBI,baBB,baK,baLOB,baSB,baRuns,fiPO,fiA,fiE, " .
                   " piWin,piLose,piSave, piIP,piHits,piRuns,piER,piWalks,piSO,firstname, middlename,lastname " .
                   " FROM ".$wpdb->prefix."baseballNuke_players p, ".$wpdb->prefix."baseballNuke_stats st, " . 
                   " " . $wpdb->prefix."baseballNuke_schedule s " .
                   " WHERE battOrd > 0 AND teamName='$team' AND st.gameID=$game_id AND p.playerID=st.playerID " .
                   " AND p.season='$season' AND st.gameID=s.gameID ORDER BY battOrd ASC";
  $result = mysql_query($query);
  if ($result)
    while( $row = mysql_fetch_array($result) )
    {
      $gresults[] = $row;
    }
  for ($m=0; $m < count($gresults); $m++) 
  {
    list($gameID,$playerID,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR, $baRE, $baFC, $baSF, $baHP, $baRBI, $baBB,$baK, $baLOB, $baSB,$baRuns,
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
              <td> '.$baSF.'</td>
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
           " WHERE pitchOrd > 0 AND teamName='$team' AND st.gameID=$game_id AND p.playerID=st.playerID and " .
           "       p.season='$season' and st.gameID=s.gameID ORDER BY pitchOrd ASC";
  $result = mysql_query($query);
  if ($result)
    while ( $row = mysql_fetch_array($result) )
    {
      $presults[] = $row;
    }
  for ($m=0; $m < count($presults); $m++) 
  {
    list($gameID,$playerID,$battOrd,$pitchOrd,$baAB,$ba1b,$ba2b,$ba3b,$baHR,$baRBI,$baBB,$baK,$baSB,$piWin,$piLose,
         $piSave,$piIP,$piHits,$piRuns,$piER,$piWalks,$piSO,$baRuns,$baRE, $baFC, $baSF, $baHP, $baLOB, $fiPO, $fiA, $fiE,
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
   <tr>
      <td>';

  $bbnuke_content .= "</td></tr></table><br><hr>";
  
  if($postID){
  $bnuke_content .= query_posts( 'p='.$postID );
  } 

  if ( $bbnuke_echo )
    echo $bbnuke_content;
  else
    return $bbnuke_content;

  return;
}
?>
