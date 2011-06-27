<?php

global $wpdb;

require_once(ABSPATH . 'wp-includes/pluggable.php');
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');


function  bbnuke_db_delta()
{
  global $wpdb;

  if ($wpdb->supports_collation())
  {
    if ( ! empty($wpdb->charset) )
      $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
    if ( ! empty($wpdb->collate) )
      $charset_collate .= " COLLATE $wpdb->collate";
  }

  $query = "CREATE TABLE `" . $wpdb->prefix . "baseballNuke_boxscores` (
           `gameID` int(11) NOT NULL default '0',
           `v1` int(11) default NULL,
           `v2` int(11) default NULL,
           `v3` int(11) default NULL,
           `v4` int(11) default NULL,
           `v5` int(11) default NULL,
           `v6` int(11) default NULL,
           `v7` int(11) default NULL,
           `v8` int(11) default NULL,
           `v9` int(11) default NULL,
           `h1` int(11) default NULL,
           `h2` int(11) default NULL,
           `h3` int(11) default NULL,
           `h4` int(11) default NULL,
           `h5` int(11) default NULL,
           `h6` int(11) default NULL,
           `h7` int(11) default NULL,
           `h8` int(11) default NULL,
           `h9` int(11) default NULL,
           `vhits` int(11) default NULL,
           `vruns` int(11) default NULL,
           `verr` int(11) default NULL,
           `hhits` int(11) default NULL,
           `hruns` int(11) default NULL,
           `herr` int(11) default NULL,
	   `postID` int(11) default NULL,
	   `status` varchar(20) default NULL,
           PRIMARY KEY  (`gameID`)
           ) ENGINE=MyISAM " . $charset_collate . ";";
  dbDelta($query);

  $query = "CREATE TABLE `" . $wpdb->prefix . "baseballNuke_locations` (
            `fieldname` mediumtext NOT NULL,
            `directions` longtext
            ) ENGINE=MyISAM " . $charset_collate . ";";
  dbDelta($query);

  $query = "CREATE TABLE `" . $wpdb->prefix . "baseballNuke_players` (
           `playerID` int(11) NOT NULL auto_increment,
           `teamName` varchar(255) default NULL,
           `firstname` varchar(255) default NULL,
           `middlename` varchar(255) default NULL,
           `lastname` varchar(255) default NULL,
           `positions` mediumtext,
           `bats` tinytext,
           `throws` tinytext,
           `height` int(11) default NULL,
           `weight` int(11) default NULL,
           `address` varchar(255) default NULL,
           `city` varchar(255) default NULL,
           `state` tinytext,
           `zip` int(11) default NULL,
           `homePhone` varchar(255) default NULL,
           `workPhone` varchar(255) default NULL,
           `cellphone` varchar(255) default NULL,
           `jerseyNum` int(10) unsigned default NULL,
           `picLocation` varchar(255) default NULL,
           `season` varchar(20) NOT NULL default '',
           `profile` text,
           `bdate` date default NULL,
	   `school` varchar(255) default NULL,
           `email` varchar(255) default NULL,
           PRIMARY KEY  (`playerID`,`season`)
           ) ENGINE=MyISAM AUTO_INCREMENT=141 " . $charset_collate . ";";
  dbDelta($query);

  $query = "CREATE TABLE `" . $wpdb->prefix . "baseballNuke_schedule` (
            `gameID` int(11) NOT NULL auto_increment,
            `visitingTeam` varchar(255) default NULL,
            `homeTeam` varchar(255) default NULL,
            `gameDate` date default NULL,
            `field` mediumtext,
            `umpire` varchar(255) default NULL,
            `homeScore` int(11) default NULL,
            `visitScore` int(11) default NULL,
            `gameTime` time default NULL,
            `notes` varchar(255) default NULL,
            `type` text,
            `season` varchar(20) default NULL,
            PRIMARY KEY  (`gameID`)
            ) ENGINE=MyISAM AUTO_INCREMENT=748 " . $charset_collate . ";";
  dbDelta($query);

  $query = "CREATE TABLE `" . $wpdb->prefix . "baseballNuke_settings` (
            `defaultTeam` varchar(255) default NULL,
            `defaultSeason` varchar(20) default NULL,
            `displayMenu` char(1) default '1',
            `ID` tinyint(4) NOT NULL auto_increment,
            `version` varchar(20) NOT NULL default '',
            PRIMARY KEY  (`ID`)
            ) ENGINE=MyISAM AUTO_INCREMENT=2 " . $charset_collate . ";";
  dbDelta($query);

  $query = "CREATE TABLE `" . $wpdb->prefix . "baseballNuke_stats` (
            `gameID` int(11) NOT NULL default '0',
            `playerID` int(11) NOT NULL default '0',
            `battOrd` int(11) default NULL,
            `pitchOrd` int(11) default NULL,
            `baAB` int(11) default NULL,
            `ba1b` int(11) default NULL,
            `ba2b` int(11) default NULL,
            `ba3b` int(11) default NULL,
            `baHR` int(11) default NULL,
            `baRBI` int(11) default NULL,
            `baBB` int(11) default NULL,
            `baK` int(11) default NULL,
            `baSB` int(11) default NULL,
            `piWin` int(11) default NULL,
            `piLose` int(11) default NULL,
            `piSave` int(11) default NULL,
            `piIP` float(3,2) default NULL,
            `piHits` int(11) default NULL,
            `piRuns` int(11) default NULL,
            `piER` int(11) default NULL,
            `piWalks` int(11) default NULL,
            `piSO` int(11) default NULL,
            `baRuns` int(11) default NULL,
            `baRE` int(11) default '0',
            `baFC` int(11) default '0',
	    `baSF` int(11) default '0',
            `baHP` int(11) NOT NULL default '0',
            `baLOB` int(11) NOT NULL default '0',
            `fiPO` int(11) NOT NULL default '0',
            `fiA` int(11) NOT NULL default '0',
            `fiE` int(11) NOT NULL default '0'
            ) ENGINE=MyISAM " . $charset_collate . ";";
  dbDelta($query);

  $query = "CREATE TABLE `" . $wpdb->prefix . "baseballNuke_teams` (
            `teamname` varchar(255) NOT NULL default '',
            `wins` int(11) default NULL,
            `losses` int(11) default NULL,
            `winPer` float default NULL,
            `season` varchar(20) NOT NULL default '',
            PRIMARY KEY  (`teamname`,`season`)
            ) ENGINE=MyISAM " . $charset_collate . ";";
  dbDelta($query);

  $wpdb->query = "DROP VIEW `" . $wpdb->prefix . "baseballNuke_batTotals` ";
  $query = "CREATE VIEW `" . $wpdb->prefix . "baseballNuke_batTotals` AS select `" . $wpdb->prefix . "baseballNuke_players`.`playerID` AS `playerID`,`" . $wpdb->prefix . "baseballNuke_players`.`lastname` AS `lastname`,`" . $wpdb->prefix . "baseballNuke_players`.`firstname` AS `firstname`,`" . $wpdb->prefix . "baseballNuke_players`.`middlename` AS `middlename`,`" . $wpdb->prefix . "baseballNuke_players`.`jerseyNum` AS `jerseyNum`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baRuns`) AS `baTotRuns`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baAB`) AS `baTotAB`,sum((((`" . $wpdb->prefix . "baseballNuke_stats`.`ba1b` + `" . $wpdb->prefix . "baseballNuke_stats`.`ba2b`) + `" . $wpdb->prefix . "baseballNuke_stats`.`ba3b`) + `" . $wpdb->prefix . "baseballNuke_stats`.`baHR`)) AS `baTotH`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`ba1b`) AS `baTot1b`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`ba2b`) AS `baTot2b`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`ba3b`) AS `baTot3b`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baHR`) AS `baTotHR`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baRE`) AS `baTotRE`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baFC`) AS `baTotFC`, ,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baSF`) AS `baTotSF`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baHP`) AS `baTotHP`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baRBI`) AS `baTotRBI`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baBB`) AS `baTotBB`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baK`) AS `baTotK`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baLOB`) AS `baTotLOB`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`baSB`) AS `baTotSB` from ((`" . $wpdb->prefix . "baseballNuke_players` join `" . $wpdb->prefix . "baseballNuke_stats`) join `" . $wpdb->prefix . "baseballNuke_schedule`) where ((`" . $wpdb->prefix . "baseballNuke_players`.`playerID` = `" . $wpdb->prefix . "baseballNuke_stats`.`playerID`) and (year(`" . $wpdb->prefix . "baseballNuke_schedule`.`gameDate`) = year(now())) and (`" . $wpdb->prefix . "baseballNuke_stats`.`gameID` = `" . $wpdb->prefix . "baseballNuke_schedule`.`gameID`) and (`" . $wpdb->prefix . "baseballNuke_players`.`season` = year(now()))) group by `" . $wpdb->prefix . "baseballNuke_players`.`playerID`;";
  mysql_query($query);

  $wpdb->query = "DROP VIEW `" . $wpdb->prefix . "baseballNuke_pitchTotals` ";
  $query = "CREATE VIEW `" . $wpdb->prefix . "baseballNuke_pitchTotals` AS select `" . $wpdb->prefix . "baseballNuke_players`.`playerID` AS `playerID`,`" . $wpdb->prefix . "baseballNuke_players`.`lastname` AS `lastname`,`" . $wpdb->prefix . "baseballNuke_players`.`firstname` AS `firstname`,`" . $wpdb->prefix . "baseballNuke_players`.`middlename` AS `middlename`,`" . $wpdb->prefix . "baseballNuke_players`.`jerseyNum` AS `jerseyNum`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piWin`) AS `piTotWin`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piLose`) AS `piTotLose`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piSave`) AS `piTotSave`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piIP`) AS `piTotIP`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piHits`) AS `piTotHits`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piRuns`) AS `piTotRuns`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piER`) AS `piTotER`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piWalks`) AS `piTotWalks`,sum(`" . $wpdb->prefix . "baseballNuke_stats`.`piSO`) AS `piTotSO`,year(now()) AS `year` from ((`" . $wpdb->prefix . "baseballNuke_stats` join `" . $wpdb->prefix . "baseballNuke_players`) join `" . $wpdb->prefix . "baseballNuke_schedule`) where ((`" . $wpdb->prefix . "baseballNuke_schedule`.`gameID` = `" . $wpdb->prefix . "baseballNuke_stats`.`gameID`) and (`" . $wpdb->prefix . "baseballNuke_stats`.`playerID` = `" . $wpdb->prefix . "baseballNuke_players`.`playerID`) and (year(`" . $wpdb->prefix . "baseballNuke_schedule`.`gameDate`) = year(now())) and (`" . $wpdb->prefix . "baseballNuke_players`.`season` = year(now())) and (`" . $wpdb->prefix . "baseballNuke_stats`.`piIP` > 0)) group by `" . $wpdb->prefix . "baseballNuke_players`.`playerID`;";
  mysql_query($query);

  $wpdb->flush();

  return;
}


function  bbnuke_drop_tables()
{
  global $wpdb;

  $wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}baseballNuke_pitchTotals,
                         {$wpdb->prefix}baseballNuke_batTotals,
                         {$wpdb->prefix}baseballNuke_teams,
                         {$wpdb->prefix}baseballNuke_stats,
                         {$wpdb->prefix}baseballNuke_players,
                         {$wpdb->prefix}baseballNuke_locations,
                         {$wpdb->prefix}baseballNuke_boxscores,
                         {$wpdb->prefix}baseballNuke_settings,
                         {$wpdb->prefix}baseballNuke_schedule" );
  $wpdb->query( "DROP VIEW IF EXISTS {$wpdb->prefix}baseballNuke_pitchTotals,{$wpdb->prefix}baseballNuke_batTotals" );

  return;
}


function  bbnuke_check_tables()
{
  global $wpdb;

  //  check if tables are empty
  $query  = "SELECT Count(*) FROM " . $wpdb->prefix . "baseballnuke_teams";
  $result = mysql_query($result);
  if ( $result )
    $count = mysql_num_rows($result);

  if ( ($count == 0) OR (!$result) )
  {
    //  tables are empty
//    $query = mysql_real_escape_string("INSERT INTO `" . $wpdb->prefix . "baseballNuke_players` (`playerID`, `teamName`, `firstname`, `middlename`, `lastname`, `positions`, `bats`, `throws`, `height`, `weight`, `address`, `city`, `state`, `zip`, `homePhone`, `workPhone`, `cellphone`, `jerseyNum`, `picLocation`, `season`, `profile`, `bdate`, `email`) VALUES
    $query = "INSERT INTO `" . $wpdb->prefix . "baseballNuke_players` (`playerID`, `teamName`, `firstname`, `middlename`, `lastname`, `positions`, `bats`, `throws`, `height`, `weight`, `address`, `city`, `state`, `zip`, `homePhone`, `workPhone`, `cellphone`, `jerseyNum`, `picLocation`, `season`, `profile`, `bdate`, `school`, `email`) VALUES
			(51, 'Flying Dogs', 'Steve', '', 'Canale', 'INF, P', 'L', 'R', 0, 0, '', '', '', 0, '', '', '', 22, 'images/profiles/Canale.jpg', '2008', 'Played high school ball for Frederick High School from ''94-''96. As a senior, led his team to the state semifinals where he threw a 1 hitter, striking out 15 in a loss that sent them home. It was the farthest a team from Frederick HS had advanced since 1976, and earned him a spot as starting pitcher for the Crown All Star game (which he declined to pursue opportunity at Penn State). Played for a couple years at Penn State, first at Altoona, and then walking on at State College, where he didn''t do much at all. Stopped playing for several years, before coming back to the Frederick Flying Dogs.<br /> <br />His days are numbered, he has hurt his arm, began boozing pretty heavily, developed serious problems with gambling, cocaine, and hookers, before waking up in a pool of his own blood, and urine, and becoming a born again Christian, where he will begin a pilgrimage to the holy land later this year. In his own words &quot;can''t stop, won''t stop, bad boy, come on...&quot; ', '0000-00-00', 'State College', ''),
			(4, 'Flying Dogs', 'Nick', '', 'Collingham', 'P', 'R', 'R', 0, 190, '429 Megan Ct', 'Frederick', 'MD', 21701, '301-620-1239', '410-558-58031', '240-409-6337', 19, 'images/profiles/collingham.jpg', '2008', 'Has been a member of the Frederick Flying Dogs since their inaugural season in 1999, becoming manager in 2000. Prior to becoming a Flying Dog, Nick played High School Baseball at Galena High School in Reno, NV.', '0000-00-00', 'Capitol College', ''),
			(42, 'Flying Dogs', 'Heath', '', 'Gibson', 'OF', 'L', 'R', 0, 0, '', '', '', 0, '', '', '', 3, 'images/profiles/Gibson.jpg', '2008', 'Heath compiled several honors in baseball growing up in Arkansas, including: All Conference 4yrs, All Regional team 2yrs Soph/Senior, All Regional MVP (Senior), All State 2yrs (Soph/Senior), and AAU All American in high school. In college he was selected to the All Conference Team 3 times (Fresh/Soph/Senior). At Carl Albert Junior College Heath set records for: doubles (season and career), runs scored (season and career), and triples (season and career). Over his 4 year college baseball career at Carl Albert JC and Southern Arkansas Univ. Heath recorded a .371 batting average and also holds the unofficial JR College National Record for being hit by a pitch (21 &ndash; season, 38 career).', '0000-00-00', 'Southern Arkansas Univ', '');";
    mysql_query($query);

//    $query = mysql_real_escape_string("INSERT INTO `" . $wpdb->prefix . "baseballNuke_settings` (`defaultTeam`, `defaultSeason`, `displayMenu`, `ID`, `version`) VALUES
    $query = "INSERT INTO `" . $wpdb->prefix . "baseballNuke_settings` (`defaultTeam`, `defaultSeason`, `displayMenu`, `ID`, `version`) VALUES
			('Flying Dogs', '2008', '', 1, '1.0.9');";
    mysql_query($query);


//    $query = mysql_real_escape_string("INSERT INTO `" . $wpdb->prefix . "baseballNuke_teams` (`teamname`, `wins`, `losses`, `winPer`, `season`) VALUES
    $query = "INSERT INTO `" . $wpdb->prefix . "baseballNuke_teams` (`teamname`, `wins`, `losses`, `winPer`, `season`) VALUES
			('Flying Dogs', NULL, NULL, NULL, '2008'),
			('Team 2', NULL, NULL, NULL, '2008');";
    mysql_query($query);
  }

  return;
}


?>
