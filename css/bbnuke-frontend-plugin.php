<?php

global $plugin_url;

require_once('../../../../wp-load.php');

header('Content-type: text/css');

$options = get_option('bbnuke_plugin_options');
$bg_color     = $options['bbnuke_widget_bg_color'];
$hover_color     = $options['bbnuke_widget_hover_color'];
$txt_color    = $options['bbnuke_widget_txt_color'];
$header_bg_color    = $options['bbnuke_widget_header_bg_color'];
$header_txt_color    = $options['bbnuke_widget_header_txt_color'];

?>

TABLE.bbnuke-boxscore-table
{
	border: 0px;
	border-spacing: 1px 1px;
	border-collapse: collapse;
	font-size: 13px;
	line-height: 15px;
	text-align: center;
}
TABLE.bbnuke-boxscore-table TH
{
	border: 0px;
	font-weight: bold;
	padding: 2px;
}
TABLE.bbnuke-boxscore-table TD
{
	border: 1px solid #808080;
	padding: 2px;
}
TABLE.bbnuke-schedule-table
{
	border: 0px;
	border-spacing: 0px 0px;
	border-collapse: collapse;
	font-size: 11px;
	margin: 0;
	padding: 4px;
	width: 100%;
}
TABLE.bbnuke-schedule-table-score
{
	border: 0;
	font-size: 11px;
	margin: 0;
	padding: 4px;
	width: 100%;
	background-color: #E0E0E0;
}
TABLE.bbnuke-schedule-table TR.over
{
	background: #E0E0E0;
}
TABLE.bbnuke-schedule-table TR
{
	background: #FFFFFF;
}
TABLE.bbnuke-schedule-table TD
{
	border-top: 1px solid #DDD;
	border-bottom: 0px none;
	border-left: 0px none;
	border-right: 0px none;
	padding: 4px;
	text-align: left;
	line-height: 13px;
	color: #000000;
}
TABLE.bbnuke-schedule-table TH
{
	background-color: #E0E0E0;
	line-height: 15px;
	text-align: justify;
	border-left: 0px none;
	border-right: 0px none;
	color: #044927;
}
TABLE.bbnuke-results-table
{
	border: 0px;
	border-spacing: 0px 0px;
	border-collapse: collapse;
	font-size: 11px;
	width: 100%;
}
TABLE.bbnuke-results-table TR.over
{
	background: #E0E0E0;
}
TABLE.bbnuke-results-table TR
{
	background: #FFFFFF;
}
TABLE.bbnuke-results-table TD
{
	border-top: 1px solid #DDD;
	border-bottom: 0px none;
	border-left: 0px none;
	border-right: 0px none;
	padding: 4px;
	text-align: center;
	line-height: 13px;
	color: #000000;
}
TABLE.bbnuke-results-table TH
{
	text-align: center;
	border-left: 0px none;
	border-right: 0px none;
	background-color: #E0E0E0;
	line-height: 15px;
	color: #044927;
	padding: 4px;
}
TABLE.bbnuke-leaders-table
{
	border: 0px;
	border-spacing: 0px 0px;
	border-collapse: collapse;
	font-size: 11px;
	width: 200px;
	padding: 20px;
}
TABLE.bbnuke-leaders-table TR.over
{
	background: #E0E0E0;
}
TABLE.bbnuke-leaders-table TR
{
	background: #FFFFFF;
}
TABLE.bbnuke-leaders-table TD
{
	border-top: 1px solid #DDD;
	border-bottom: 0px none;
	border-left: 0px none;
	border-right: 0px none;
	padding: 4px;
	text-align: right;
	line-height: 13px;
	color: #000000;
}
TABLE.bbnuke-leaders-table TH
{
	text-align: center;
	border-left: 0px none;
	border-right: 0px none;
	background-color: #E0E0E0;
	line-height: 15px;
	color: #044927;
}
TABLE.bbnuke-stat-key TD
{
	border: 0px;
	border-spacing: 0px 0px;
	border-collapse: collapse;
	font-size: 11px;
	padding: 4px;
	text-align: left;
	line-height: 10px;
}
INPUT#bbnuke_input_link
{
	font-weight: bold;
	background-color: transparent;
	position: relative;
	padding: 0px;
	margin: none;
	border: 2px;
	font-size: 11px;
	line-height: 14px;
	margin: 0px;
	color: #044927;
}
FORM#bbnuke_form
{
	background-color: transparent;
	position: relative;
	padding: 0px;
	margin: none;
	border: 0px;
	font-weight: bold;
	text-align: center;
	line-height: 14px;
}
#bbnuke_players_img
{
	vertical-align: bottom;
	padding: 0px 25px 10px 5px;
	border: 0px;
}
TABLE.bbnuke_players_profile
{
	color: #044927;
	margin: 10px 0 0;
	font-size: 14px;
	font-family: Ubuntu, Arial, "Arial Unicode MS", Helvetica, Sans-Serif;
	text-align: left;
	width: 100%;
	border: 0px;
	margin-top: 14px;
	margin-bottom: 17px;
	font-weight: normal;
	height: 0px;
}
TABLE.bbnuke_players_profile TD
{
	width: 100%;
	border: 0px;
	padding: 0px;
	vertical-align: top;
}
DIV.bbnuke_widget
{
	background-color: #E0E0E0;
	line-height: 1.2;
}
DIV.tabs
{
	font-size: 11px;
	font-weight: bold;
}
A.tab
{
	background-color: #F0F0F0;
	border: 1px solid #000000;
	border-bottom-width: 0px;
	padding: 2px 1em;
	text-decoration: none;
}
A.tab, A.tab:visited
{
	color: #808080;
}
A.tab:hover
{
	background-color: #D0D0D0;
	color: #606060;
}
