<?php

$root = dirname(__FILE__);
$scriptpath = realpath($root.'/../../../wp-load.php');
//if (file_exists($root.'/wp-load.php')) {
require_once($scriptpath);
//}

global $wpdb;

$season = $_GET['season'];
$noload = $_GET['load'];

header("Content-type: text/plain");

$teams = array();
if (isset($season)){
    $query = 'SELECT teamname FROM ' . $wpdb->prefix . 'baseballNuke_teams WHERE season="'.$season.'" ORDER BY teamname asc';
} else {
    $query = 'SELECT distinct(teamname) FROM ' . $wpdb->prefix . 'baseballNuke_teams ORDER BY teamname asc';
}

$teamresult = $wpdb->get_results($query);

foreach($teamresult as $team) {
    $teams[] = $team->teamname;
}

echo json_encode($teams);