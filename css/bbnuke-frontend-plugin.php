<?php

global $plugin_url;

require_once('../../../../wp-load.php');

header('Content-type: text/css');


?>




.bbnuke-result-table
{
  rules:    rows;
}

.bbnuke-result-table td
{
  padding:  0 2px;
}



.bbnuke_input_link
{
  position:          relative;
  border:            none;
  padding:           none;
  margin:            none;
  background-color:  transparent;
  font-weight:       bold;
  cursor:            pointer;
}

.bbnuke_tb_head_asc
{
  background:        url(<?php echo $plugin_url . '/images/asc.gif'; ?>) no-repeat;
  padding-left: 10px;
}

.bbnuke_tb_head_desc
{
  background:        url(<?php echo $plugin_url . '/images/desc.gif'; ?>) no-repeat;
  padding-left: 10px;
}



.bbnuke_players_img
{
  vertical-align:    bottom;
}




<?php




?>