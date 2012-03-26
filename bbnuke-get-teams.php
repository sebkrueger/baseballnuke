<?php
require( '/home/nickcollingham/baseballnuke.flyingdogsbaseball.com/wp-load.php' );
global $wpdb;

//require_once('/wp-includes/wp-db.php');
//require_once('/wp-config.php');

$season = $_GET['season'];
$noload = $_GET['load'];

header("Content-type: text/plain");

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

  echo json_encode($teams);

?>
