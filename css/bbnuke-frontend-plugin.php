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

table.bbnuke-boxscore-table
{
  border: 0px;
  border-spacing: 1px 1px;
  border-collapse: collapse;
  font-size:13px;
  line-height: 15px;
  text-align: center;

}

table.bbnuke-boxscore-table th
{
  border: 0px;
  font-weight:bold;
  padding:2px;
}

table.bbnuke-boxscore-table td
{
  border: 1px solid grey;
  padding:2px;
}


table.bbnuke-schedule-table
{
  border:0px;
  border-spacing: 0px 0px;
  border-collapse: collapse;
  font-size:11px;
  margin: 0;
  padding:4px;
}

table.bbnuke-schedule-table tr.over
{
  background: <?php echo "#$hover_color"; ?>;
}

table.bbnuke-schedule-table tr
{
  background: <?php echo "#$bg_color"; ?>;
}

table.bbnuke-schedule-table td
{
  border-top: 1px solid #DDD;
  border-bottom: 0px none;
  border-left: 0px none;
  border-right: 0px none;
  padding:4px;
  text-align:left;
  line-height: 13px;
  color: <?php echo "#$txt_color"; ?>;
}

table.bbnuke-schedule-table th
{
  background-color: <?php echo "#$header_bg_color"; ?>;
  line-height: 15px;
  text-align:left;
  border-left: 0px none;
  border-right: 0px none;
  color: <?php echo "#$header_txt_color"; ?>;
}

table.bbnuke-results-table
{
  border:0px;
  border-spacing: 0px 0px;
  border-collapse: collapse;
  font-size:11px;
}

table.bbnuke-results-table tr.over
{
        background: <?php echo "#$hover_color"; ?>;
}

table.bbnuke-results-table tr
{
  background: <?php echo "#$bg_color"; ?>;
}

table.bbnuke-results-table td
{
  border-top: 1px solid #DDD;
  border-bottom: 0px none;
  border-left: 0px none;
  border-right: 0px none;
  padding:4px;
  text-align:right;
  line-height: 13px;
  color: <?php echo "#$txt_color"; ?>;
}

table.bbnuke-results-table th
{
  text-align:center;
  border-left: 0px none;
  border-right: 0px none;
  background-color: <?php echo "#$header_bg_color"; ?>;
  line-height: 15px;
  color: <?php echo "#$header_txt_color"; ?>;
  padding:4px
}

table.bbnuke-leaders-table
{
  border:0px;
  border-spacing: 0px 0px;
  border-collapse: collapse;
  font-size:11px;
  width:200px;
  padding:20px;
}

table.bbnuke-leaders-table tr.over
{
        background: <?php echo "#$hover_color"; ?>;
}

table.bbnuke-leaders-table tr
{
  background: <?php echo "#$bg_color"; ?>;
}

table.bbnuke-leaders-table td
{
  border-top: 1px solid #DDD;
  border-bottom: 0px none;
  border-left: 0px none;
  border-right: 0px none;
  padding:4px;
  text-align:right;
  line-height: 13px;
  color: <?php echo "#$txt_color"; ?>;
}

table.bbnuke-leaders-table th
{
  text-align:center;
  border-left: 0px none;
  border-right: 0px none;
  background-color: <?php echo "#$header_bg_color"; ?>;
  line-height: 15px;
  color: <?php echo "#$header_txt_color"; ?>;
}

table.bbnuke-stat-key td
{
  border:0px;
  border-spacing: 0px 0px;
  border-collapse: collapse;
  font-size:11px;
  padding:4px;
  text-align:left;
  line-height: 10px;
}

input#bbnuke_input_link 
{
  font-weight:bold;
  background-color:  transparent;
  position:          relative;
  padding:           0px;
  margin:            none;
  border:            2px;
  font-size: 11px;
  line-height: 14px;
  margin: 0px 0px 0px;
  color: <?php echo "#$header_txt_color"; ?>;
}

form#bbnuke_form
{
  background-color:  transparent;
  position:          relative;
  padding:           0px;
  margin:            none;
  border:            0px;
  font-weight:bold;
  text-align:center;
  line-height: 14px;
}


#bbnuke_players_img
{
  vertical-align:    bottom;
  padding:	0px 25px 10px 5px;
  border:	0px;
}

table.bbnuke_players_profile
{
  width: 100%;
  padding: 5px 5px 25px 5px;
  border: 0px;
}

table.bbnuke_players_profile td
{
  width: 100%;
  border: 0px;
  padding: 0px;
  vertical-align: top;
}

div.bbnuke_widget {
  background-color: #fff
}

div.tabs {
  font-size: 11px;
  font-weight: bold;
}

a.tab {
  background-color: #f0f0f0;
  border: 1px solid #000000;
  border-bottom-width: 0px;
  padding: 2px 1em 2px 1em;
  text-decoration: none;
}

a.tab, a.tab:visited {
  color: #808080;
}

a.tab:hover {
  background-color: #d0d0d0;
  color: #606060;
}

