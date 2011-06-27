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
ignore{}

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
  padding:4px;
  text-align:right;
  line-height: 13px;
  color: <?php echo "#$txt_color"; ?>;
}

table.bbnuke-results-table th
{
  text-align:center;
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


.bbnuke_players_img
{
  vertical-align:    bottom;
}

