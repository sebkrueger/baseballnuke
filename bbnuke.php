<?php
/*
Plugin Name: baseballNuke 
Plugin URI: http://dev.flyingdogsbaseball.com/baseballnuke
Description: baseballNuke is a wordpress plugin based on the original module for the CMS phpnuke for the administration of a single baseball team.  baseballNuke is a complete team management tool and information source.  It provides team and individual information about the players including schedule, field directions, player stats, team stats, player profiles and game results.
Version: 1.0.4
Author: Nick Collingham, Shawn Grimes, Christian Gnoth, Dawn Wallis 
License: GPL2
*/


global $wpdb,
       $responses;

define('BBNPURL', WP_PLUGIN_URL . '/' . str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) );
define('BBNPDIR', WP_PLUGIN_DIR . '/' . str_replace(basename( __FILE__),"",plugin_basename(__FILE__)) );

// relative path to WP_PLUGIN_DIR where the translation files will sit:
$plugin_path = dirname(plugin_basename(__FILE__)) . '/language';
load_plugin_textdomain( 'bbnuke', false, $plugin_path );


if ( function_exists('load_plugin_textdomain') ) 
{
  if ( !defined('WP_PLUGIN_DIR') ) 
  {
    load_plugin_textdomain( 'bbnuke', str_replace( ABSPATH, '', dirname(__FILE__)) . '/lang');
  } 
  else 
  {
    load_plugin_textdomain( 'bbnuke', false, dirname(plugin_basename(__FILE__)) . '/lang');
  }
}



require_once( dirname(__FILE__) . '/bbnuke-db.php');
require_once( dirname(__FILE__) . '/bbnuke-functions.php');
require_once( dirname(__FILE__) . '/bbnuke-widgets.php');
require_once( dirname(__FILE__) . '/bbnuke-option-page.php');



register_activation_hook(   __FILE__, 'bbnuke_plugin_activation'  );   
register_deactivation_hook( __FILE__, 'bbnuke_plugin_deactivation'); 

//add_action( 'wp_head',      'bbnuke_wp_head');
//add_action( 'init',         'bbnuke_init_method');
add_action( 'wp_print_scripts', 'bbnuke_print_scripts');
add_action( 'wp_print_styles',  'bbnuke_print_styles');
add_action( 'admin_init',   'bbnuke_admin_init_method');
add_action( 'admin_menu',   'bbnuke_plugin_add_option_page');
//add_action( 'admin_head',   'bbnuke_plugin_load_header_tags');
add_action( 'widgets_init', create_function('', 'return register_widget("bbnuke_Widget");'));
add_action( 'wp_footer', 'bbnuke_wp_footer');

add_filter( 'cron_schedules', 'bbnuke_more_reccurences');

//  ajax calls
add_action( 'wp_ajax_bbnuke_ajax_action', 'bbnuke_ajax_func');
add_action( 'wp_ajax_nopriv_bbnuke_ajax_action', 'bbnuke_ajax_func');

$plugin_url = BBNPURL;


////////////////////////////////////////////////////////////////////////////////
// plugin activation hook
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_activation() 
{
  global $wpdb;

  //   check if tables exists and create
  bbnuke_db_delta();

  //   check if tables are empty and fill with default values
  bbnuke_check_tables();

  add_option( 'bbnuke_plugin_options', array(), '', 'no');
  bbnuke_set_option_defaults();

  return; 
}

////////////////////////////////////////////////////////////////////////////////
// plugin deactivation hook
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_deactivation() 
{
  delete_option('bbnuke_plugin_options');

  return;
}


function bbnuke_plugin_uninstall() 
{
  global $wpdb;

  // Deactivate Plugin
  $current = get_settings('active_plugins');
  array_splice($current, array_search( "baseballNuke/bbnuke.php", $current), 1 );
  update_option('active_plugins', $current);
  do_action('deactivate_' . trim( $_GET['plugin'] ));

  // Drop MySQL Tables
  bbnuke_drop_tables();

  // Delete Options
  delete_option('bbnuke_plugin_options');

  wp_redirect(get_option('siteurl').'/wp-admin/plugins.php?deactivate=true');

  return;
}


////////////////////////////////////////////////////////////////////////////////
// add plugin option page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_add_option_page()
{
//  $bbnuke_admin_page = 
  add_menu_page   (                       'baseballNuke Plugin Options', 'baseballNuke', 8, 'bbnuke-option-page',  'bbnuke_plugin_create_option_page', BBNPURL . 'images/baseballNuke_16x16.gif');
  add_submenu_page( 'bbnuke-option-page', 'Players',                     'Players',      8, 'bbnuke-players',      'bbnuke_plugin_create_players_page');
  add_submenu_page( 'bbnuke-option-page', 'Fields',                      'Fields',       5, 'bbnuke-fields',       'bbnuke_plugin_create_fields_page');
  add_submenu_page( 'bbnuke-option-page', 'Schedule',                    'Schedule',     5, 'bbnuke-schedule',     'bbnuke_plugin_create_schedules_page');
  add_submenu_page( 'bbnuke-option-page', 'Tournaments',                 'Tournaments',  5, 'bbnuke-tournaments',  'bbnuke_plugin_create_tournaments_page');
  add_submenu_page( 'bbnuke-option-page', 'Practices',                   'Practices',    5, 'bbnuke-practice',     'bbnuke_plugin_create_practice_page');
  add_submenu_page( 'bbnuke-option-page', 'Game Results',                'Game Results', 5, 'bbnuke-game-results', 'bbnuke_plugin_create_game_results_page');
  add_submenu_page( 'bbnuke-option-page', 'Uninstsll',                   'Uninstall',    5, 'bbnuke-uninstall',    'bbnuke_plugin_uninstall');

//  add_action( 'admin_print_scripts-' . $bbnuke_admin_page, 'bbnuke_admin_head' );

  return;
}


function  bbnuke_admin_head()
{
}


function  bbnuke_wp_head()
{
}



////////////////////////////////////////////////////////////////////////////////
// load plugin wp-admin css and js
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_load_header_tags()
{
}


function  bbnuke_init_method()
{
}


function  bbnuke_print_scripts()
{
  if ( is_admin() )
  {
  }
  else
  {
    //  print scripts for the public and frontend
    wp_enqueue_script( 'json2' ); 
    wp_enqueue_script( 'bbnuke_script', plugin_dir_url( __FILE__ ) . 'includes/js/bbnuke_scripts.js', array('jquery', 'json2'), false, false);

    echo 
    '
      <script type="text/javascript" language="javascript">
      //<![CDATA[
        var ajaxurl  = "' . admin_url('admin-ajax.php') . '";
      //]]>
      </script>
    ';
  }

  return;
}


function  bbnuke_print_styles()
{
  if ( is_admin() )
  {
//  wp_register_style('bbnuke_admin_styles', BBNPURL . 'css/bbnuke-admin-plugin.css');
    wp_enqueue_style( 'bbnuke_admin_styles', BBNPURL . 'css/bbnuke-admin-plugin.css');
  }
  else
  {
    wp_register_style('bbnuke_frontend_styles', BBNPURL . 'css/bbnuke-frontend-plugin.php');
    wp_enqueue_style( 'bbnuke_frontend_styles' );
  }

  return;
}


////////////////////////////////////////////////////////////////////////////////
// plugin init method
////////////////////////////////////////////////////////////////////////////////
function bbnuke_admin_init_method()
{
  if ( get_magic_quotes_gpc() ) 
  {
    $_POST      = array_map( 'stripslashes_deep', $_POST );
    $_GET       = array_map( 'stripslashes_deep', $_GET );
    $_COOKIE    = array_map( 'stripslashes_deep', $_COOKIE );
    $_REQUEST   = array_map( 'stripslashes_deep', $_REQUEST );
  }

  wp_enqueue_style( 'bbnuke_admin_styles', BBNPURL . 'css/bbnuke-admin-plugin.css');

  wp_enqueue_script('dashboard');
  wp_enqueue_script('postbox');
  wp_enqueue_script('jquery-ui-resizable');
  wp_enqueue_script('jquery-ui-droppable');
  wp_enqueue_script('wp-ajax-response');
  wp_enqueue_script('tiny_mce');

  register_widget('bbnuke_Widget');

/*
  if ( function_exists('wp_tiny_mce') ) 
  {
    wp_tiny_mce( 
                  true , // true makes the editor "teeny"
                  array(
                          "editor_selector" => "bbnuke_textarea",
                          'width'           => '75%',
                          'theme_advanced_resize_horizontal' => ture,
                          'theme'           => 'advanced'
                       )
             );
  }
*/

  //  check if user admin_bbnuke exists
  $user_name = 'admin_bbnuke';
  $user_id = username_exists( $user_name );
  if ( !$user_id ) 
  {
    //  create user if not exists
    $random_password = wp_generate_password( 12, false );
    $user_id = wp_create_user( $user_name, $random_password );
    update_user_meta( $user_id, 'user_level', 10 );
  } 
  bbnuke_update_option('bbnuke_post_user', $user_id);

  return;
}

////////////////////////////////////////////////////////////////////////////////
// plugin options functions
////////////////////////////////////////////////////////////////////////////////
function bbnuke_get_option($field) 
{
  if (!$options = wp_cache_get('bbnuke_plugin_options')) 
  {
    $options = get_option('bbnuke_plugin_options');
    wp_cache_set('bbnuke_plugin_options',$options);
  }
  return $options[$field];
}

function bbnuke_update_option($field, $value) 
{
  bbnuke_update_options(array($field => $value));
}

function bbnuke_update_options($data) 
{
  $options = array_merge(get_option('bbnuke_plugin_options'),$data);
  update_option('bbnuke_plugin_options',$options);
  wp_cache_set('bbnuke_plugin_options',$options);
}

function bbnuke_migrate_old_options() 
{
  global $wpdb;

  //  check for a old Option
  if ( (get_option('bbnuke_plugin_version') === false) ) 
  {
    return;
  }

  $old_fields = array(
       '0'   => 'bbnuke_plugin_version',
       '1'   => 'bbnuke_players_season',
       '2'   => 'bbnuke_players_team',
       '3'   => 'bbnuke_players_edit_id',
       '4'   => 'bbnuke_location_edit_name',
       '5'   => 'bbnuke_game_edit_id',
       '6'   => 'bbnuke_schedules_season',
       '7'   => 'bbnuke_practice_season',
       '8'   => 'bbnuke_tournaments_season',
       '9'   => 'bbnuke_results_season',
       '10'  => 'bbnuke_team_leaders',
       '11'  => 'bbnuke_post_user',
       '12'  => 'bbnuke_widget_bg_color',
       '13'  => 'bbnuke_widget_txt_color'
       );

  $new_fields = array(
       '0'   => 'bbnuke_plugin_version',
       '1'   => 'bbnuke_players_season',
       '2'   => 'bbnuke_players_team',
       '3'   => 'bbnuke_players_edit_id',
       '4'   => 'bbnuke_location_edit_name',
       '5'   => 'bbnuke_game_edit_id',
       '6'   => 'bbnuke_schedules_season',
       '7'   => 'bbnuke_practice_season',
       '8'   => 'bbnuke_tournaments_season',
       '9'   => 'bbnuke_results_season',
       '10'  => 'bbnuke_team_leaders',
       '11'  => 'bbnuke_post_user',
       '12'  => 'bbnuke_widget_bg_color',
       '13'  => 'bbnuke_widget_txt_color'
       );

  foreach($old_fields as $index=>$field) 
  {
    if ( $index == 3 )
    {
      $cats = get_option($old_fields[$index]);
      if ( is_array($cats) )
        bbnuke_update_option($new_fields[$index], $cats);
      else
        bbnuke_update_option($new_fields[$index], array($cats));
    }
    else
      bbnuke_update_option($new_fields[$index], get_option($old_fields[$index]));
    delete_option($old_fields[$index]);
  }
  $wpdb->query("OPTIMIZE TABLE `" . $wpdb->options . "`");

  return;
}

function bbnuke_set_option_defaults()
{
  $current_user_id=1;
  global $current_user;    
  get_currentuserinfo();

  if ( $current_user->ID != '' ) 
    $current_user_id=$current_user->ID;

  $default_options = array(
       'bbnuke_plugin_version'           => '1.0.0',
       'bbnuke_players_season'           => '2008',
       'bbnuke_players_team'             => 'Flying Dogs',
       'bbnuke_players_edit_id'          => 0,
       'bbnuke_location_edit_name'       => '',
       'bbnuke_game_edit_id'             => 0,
       'bbnuke_schedules_season'         => '2008',
       'bbnuke_practice_season'          => '2008',
       'bbnuke_tournaments_season'       => '2008',
       'bbnuke_results_season'           => '2008',
       'bbnuke_team_leaders'             => 3,
       'bbnuke_post_user'                => 1,
       'bbnuke_widget_playerstats_player_id'  => NULL,
       'bbnuke_widget_game_results_player_id' => NULL,
       'bbnuke_widget_game_results_game_id'   => NULL,
       'bbnuke_widget_bg_color'          => 'white',
       'bbnuke_widget_txt_color'         => 'black'
        );

  $bbnuke_options = get_option('bbnuke_plugin_options');

  foreach ($default_options as $def_option => $value )
  {
    if ( !$bbnuke_options[$def_option] )
    {
      bbnuke_update_option( $def_option, $value );
    }
  }

  return;
}



////////////////////////////////////////////////////////////////////////////////
// print players page
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_create_players_page()
{
  if ( $_POST['bbnuke_set_season_team_btn'] )
  {
    //  set season and team for players list
    $team   = $_POST['bbnuke_select_season_team'];
    $season = $_POST['bbnuke_select_season'];
    bbnuke_update_option('bbnuke_players_team', $team);
    bbnuke_update_option('bbnuke_players_season', $season);
  }

  //  check if one edit button is pressed
  $edit_player = false;
    foreach( $_POST as $key => $value )
    {
      if ( !(strpos( $key, 'bbnuke_edit_player_') === false) )
      {
        $pos = strpos( $key, 'bbnuke_edit_player_');
        $pos1= strpos( $key, '_btn', $pos);
        $id = (int)substr( $key, ($pos + 19), ($pos1 - ($pos + 19)) );
        bbnuke_update_option('bbnuke_players_edit_id', $id);
        $edit_player = true;
        break;
      }
   }
   {
     if ( !(strpos( $key, 'bbnuke_delete_player_') === false) )
      {
        $pos = strpos( $key, 'bbnuke_delete_player_');
        $pos1= strpos( $key, '_btn', $pos);
        $id = (int)substr( $key, ($pos + 21), ($pos1 - ($pos + 21)) );
	$season  = bbnuke_get_option('bbnuke_players_season');
    	bbnuke_delete_player($id, $season);
    echo '<div id="message" class="updated fade">';
    echo '<strong>Player deleted !!!</strong></div>';
      }
   }
  { 
  if ( $_POST['bbnuke_save_player_btn'] )
  {
      //  new player
      $player_id = $_POST['bbnuke_delete_player_id'];
      $season    = $_POST['bbnuke_player_edit_season'];
      $ret       = bbnuke_add_player($player_id, $season);
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Player added !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Player not added !!!</strong></div>';
      }
   }
  }
  {
      //  player update
    if ( !(strpos( $key, 'bbnuke_update_player_') === false) )
    {
        $pos = strpos( $key, 'bbnuke_update_player_');
        $pos1= strpos( $key, '_btn', $pos);
        $player_id = (int)substr( $key, ($pos + 21), ($pos1 - ($pos + 21)) );
        $season  = bbnuke_get_option('bbnuke_players_season');
        $ret = bbnuke_update_player($player_id, $season);
        if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Player updated !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Player not updated !!!' . $player_id . ',' . $season . '</strong></div>'; 
echo mysql_error();
      }
    }
  }

  if ( $_POST['bbnuke_players_file_upload_btn'] )
  {
    $ret = bbnuke_upload_file();
    if ($ret)
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>Error during file uploaded - players not added !!!</strong></div>';
    }
    else
    {
      echo '<div id="message" class="updated fade">';
      echo '<strong>File uploaded and players added !!!</strong></div>';
    }
  }

  if ( $_POST['bbnuke_assign_players_team_btn'] )
  {
    if ( empty($_POST['bbnuke_players_assign_select']) )
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>No players selected !!!</strong></div>';
    }
    else
    {
      $season = $_POST['bbnuke_players_select_season'];
      $team   = $_POST['bbnuke_players_select_season_team'];
      $players_selected = $_POST['bbnuke_players_assign_select'];
      bbnuke_assign_players_team($team, $season, $players_selected);

      echo '<div id="message" class="updated fade">';
      echo '<strong>Players added to team !!!</strong></div>';
echo mysql_error();
    }
  }

  if ( $_POST['bbnuke_del_players_season_team_btn'] )
  {
    $team   = $_POST['bbnuke_select_season_team'];
    $season = $_POST['bbnuke_select_season'];
    bbnuke_delete_all_players_team($team, $season);
  }


  $ret = bbnuke_plugin_print_players_option_page($edit_player);

  switch ($ret)
  {
    case -1:
      echo '<div id="message" class="error fade">';
      echo '<strong>No Players assigned to team !!!</strong></div>';
      break;
    default:
      break;
  }

  return;
}




////////////////////////////////////////////////////////////////////////////////
// print tournaments page
////////////////////////////////////////////////////////////////////////////////
function  bbnuke_plugin_create_tournaments_page()
{
  //  check if one edit button is pressed
  $edit_tournament = false;
  foreach( $_POST as $key => $value )
  {
    if ( !(strpos( $key, 'bbnuke_edit_tournament_') === false) )
    {
      $pos = strpos( $key, 'bbnuke_edit_practise_');
      $pos1= strpos( $key, '_btn', $pos);
      $id = (int)substr( $key, ($pos + 23), ($pos1 - ($pos + 23)) );
      bbnuke_update_option('bbnuke_game_edit_id', $id);
      $edit_tournament = true;
      break;
    }
  }

  //  check if one delete button is pressed
  $tournament_deleted = false;
  if ( $_POST['bbnuke_game_delete_id'] == 'none' )
  {
    foreach( $_POST as $key => $value )
    {
      if ( !(strpos( $key, 'bbnuke_delete_tournament_') === false) )
      {
        $pos = strpos( $key, 'bbnuke_delete_tournament_');
        $pos1= strpos( $key, '_btn');
        $id = (int)substr( $key, ($pos + 25), ($pos1 - ($pos + 25)) );

        bbnuke_delete_game( $id );
        $tournament_deleted = true;
        $game_id = $id;
        break;
      }
    }
  }
  if ($tournament_deleted)
  {
    echo '<div id="message" class="updated fade">';
    echo '<strong>Tournament entry deleted !!!</strong></div>';
  }

  if ( $_POST['bbnuke_tournaments_list_set_season_btn'] )
  {
    //  set season for practises list
    $season = $_POST['bbnuke_tournaments_edit_select_season'];
    bbnuke_update_option('bbnuke_tournaments_season', $season);
  }



  if ( $_POST['bbnuke_save_tournament_btn'] )
  {
    //  check if new tournament or edit
    if ( $_POST['bbnuke_game_delete_id'] == 'none' )
    {
      //  new tournament
      $ret        = bbnuke_add_tournament($fieldname, $directions);
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Tournament added !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Tournament not added !!!</strong></div>';
      }
    }
    else
    {
      //  practise update
      $game_id = $_POST['bbnuke_game_delete_id'];
      $ret        = bbnuke_update_tournament($game_id);
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Tournament updated !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Tournament not updated !!!</strong></div>';
      }
    }
  }

  bbnuke_plugin_print_tournaments_page($edit_tournament);

  return;
}



////////////////////////////////////////////////////////////////////////////////
// print practise page
////////////////////////////////////////////////////////////////////////////////
function  bbnuke_plugin_create_practice_page()
{
  //  check if one edit button is pressed
  $edit_practice = false;
  foreach( $_POST as $key => $value )
  {
    if ( !(strpos( $key, 'bbnuke_edit_practice_') === false) )
    {
      $pos = strpos( $key, 'bbnuke_edit_practice_');
      $pos1= strpos( $key, '_btn', $pos);
      $id = (int)substr( $key, ($pos + 21), ($pos1 - ($pos + 21)) );
      bbnuke_update_option('bbnuke_game_edit_id', $id);
      $edit_practice = true;
      break;
    }
  }

  //  check if one delete button is pressed
  $practice_deleted = false;
  if ( $_POST['bbnuke_game_delete_id'] == 'none' )
  {
    foreach( $_POST as $key => $value )
    {
      if ( !(strpos( $key, 'bbnuke_delete_practice_') === false) )
      {
        $pos = strpos( $key, 'bbnuke_delete_practice_');
        $pos1= strpos( $key, '_btn');
        $id = (int)substr( $key, ($pos + 23), ($pos1 - ($pos + 23)) );

        bbnuke_delete_game( $id );
        $practice_deleted = true;
        $game_id = $id;
        break;
      }
    }
  }
  if ($practice_deleted)
  {
    echo '<div id="message" class="updated fade">';
    echo '<strong>Practice entry deleted !!!</strong></div>';
  }


  if ( $_POST['bbnuke_practice_file_upload_btn'] )
  {
    bbnuke_upload_practices();

    echo '<div id="message" class="updated fade">';
    echo '<strong>Practices uploaded !!!</strong></div>';
  }

  if ( $_POST['bbnuke_save_practice_btn'] )
  {
    //  check if new practice or edit practice
    if ( $_POST['bbnuke_game_delete_id'] == 'none' )
    {
      //  new practice
      $ret        = bbnuke_add_practice();
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Practice added !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Practice not added !!!</strong></div>';
      }
    }
    else
    {
      //  practice update
      $game_id = $_POST['bbnuke_game_delete_id'];
      $ret        = bbnuke_update_practice($game_id);
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Practice updated !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Practice not updated !!!</strong></div>';
      }
    }
  }

  if ( $_POST['bbnuke_del_all_practice_btn'] )
  {
    $ret = bbnuke_delete_all_practices();
    if ($ret)
    {
      echo '<div id="message" class="updated fade">';
      echo '<strong>All practices deleted !!!</strong></div>';
    }
    else
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>Error during delete process of practices !!!</strong></div>';
    }
  }

  if ( $_POST['bbnuke_practices_list_set_season_btn'] )
  {
    //  set season for practices list
    $season = $_POST['bbnuke_practice_edit_select_season'];
    bbnuke_update_option('bbnuke_practice_season', $season);
  }


  bbnuke_plugin_print_practice_page($edit_practise);

  return;
}




////////////////////////////////////////////////////////////////////////////////
// print locations page
////////////////////////////////////////////////////////////////////////////////
function  bbnuke_plugin_create_fields_page()
{
  //  check if one edit button is pressed
  $edit_field = false;
  foreach( $_POST as $key => $value )
  {
    if ( !(strpos( $key, 'bbnuke_edit_field_') === false) )
    {
      $pos = strpos( $key, 'bbnuke_edit_field_');
      $pos1= strpos( $key, '_btn', $pos);
      $id = (int)substr( $key, ($pos + 18), ($pos1 - ($pos + 18)) );
      bbnuke_update_option('bbnuke_location_edit_id', $id);
      $edit_field = true;
      break;
    }
  }

  //  check if one delete button is pressed
  $field_deleted = false;
  if ( !($_POST['bbnuke_delete_field_id'] == 'none') )
  {
    foreach( $_POST as $key => $value )
    {
      if ( !(strpos( $key, 'bbnuke_delete_field_') === false) )
      {
        $pos = strpos( $key, 'bbnuke_delete_field_');
        if ( !(strpos( $key, '_btn') === false) )
        {
          $pos1= strpos( $key, '_btn');
          $id = (int)substr( $key, ($pos + 20), ($pos1 - ($pos + 20)) );

          $fields = bbnuke_get_locations();
          bbnuke_delete_location( $fields[$id]['fieldname'] );
          $field_deleted = true;
          break;
        }
      }
    }
  }
  if ($field_deleted)
  {
    echo '<div id="message" class="updated fade">';
    echo '<strong>Location deleted !!!</strong></div>';
  }

  if ( $_POST['bbnuke_save_location_btn'] )
  {
    //  check if new field or edit field
    if ( $_POST['bbnuke_delete_field_id'] == 'none' )
    {
      //  new player
      $fieldname  = $_POST['bbnuke_field_edit_fieldname'];
      $directions = $_POST['bbnuke_field_edit_directions'];
      $ret        = bbnuke_add_location($fieldname, $directions);
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Location added !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Location not added !!!</strong></div>';
      }
    }
    else
    {
      //  location update
      $field_id = $_POST['bbnuke_delete_field_id'];
      $fieldname  = $_POST['bbnuke_field_edit_fieldname'];
      $directions = $_POST['bbnuke_field_edit_directions'];
      $ret        = bbnuke_update_location($fieldname, $directions);
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Location updated !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Location not updated !!!</strong></div>';
      }
    }
  }

  if ( $_POST['bbnuke_del_all_fields_btn'] )
  {
    $ret = bbnuke_delete_all_locations();
    if ($ret)
    {
      echo '<div id="message" class="updated fade">';
      echo '<strong>Locations deleted !!!</strong></div>';
    }
    else
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>Error during delete process of locations !!!</strong></div>';
    }
  }

  bbnuke_plugin_print_fields_page($edit_field);

  return;
}


////////////////////////////////////////////////////////////////////////////////
// print schedules page
////////////////////////////////////////////////////////////////////////////////
function  bbnuke_plugin_create_schedules_page()
{
  if ( $_POST['bbnuke_schedules_set_season_btn'] )
  {
    //  set season and team for players list
    $season = $_POST['bbnuke_schedules_list_select_season'];
    bbnuke_update_option('bbnuke_schedules_season', $season);
  }

  //  check if one edit button is pressed
  $edit_game = false;
  foreach( $_POST as $key => $value )
  {
    if ( !(strpos( $key, 'bbnuke_edit_game_') === false) )
    {
      $pos = strpos( $key, 'bbnuke_edit_game_');
      $pos1= strpos( $key, '_btn');
      $id = (int)substr( $key, ($pos + 17), ($pos1 - ($pos + 17)) );
      bbnuke_update_option('bbnuke_game_edit_id', $id);
      $edit_game = true;
      break;
    }
  }

  //  check if one delete button is pressed
  $game_deleted = false;
  if ( $_POST['bbnuke_game_delete_id'] != 'none' )
  {
    foreach( $_POST as $key => $value )
    {
      if ( !(strpos( $key, 'bbnuke_delete_game_') === false) )
      {
        $pos = strpos( $key, 'bbnuke_delete_game_');
        $pos1= strpos( $key, '_btn');
        $id = (int)substr( $key, ($pos + 19), ($pos1 - ($pos + 19)) );

        bbnuke_delete_game( $id );
        $game_deleted = true;
        break;
      }
    }
  }
  if ($game_deleted)
  {
    echo '<div id="message" class="updated fade">';
    echo '<strong>Game entry deleted !!!</strong></div>';
  }

  if ( $_POST['bbnuke_save_game_btn'] )
  {
    //  check if new player or edit player
    if ( $_POST['bbnuke_game_delete_id'] == 'none' )
    {
      //  new entry
      $ret       = bbnuke_add_schedule();
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Game entry added !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Game entry not added !!!</strong></div>';
      }
    }
    else
    {
      //  schedule update
      $ret = bbnuke_update_schedule($_POST['bbnuke_delete_game_id']);
      if ($ret)
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>Game entry updated !!!</strong></div>';
      }
      else
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>Game entry not updated !!!</strong></div>';
      }
    }
  }

  if ( $_POST['bbnuke_schedules_file_upload_btn'] )
  {
    $ret = bbnuke_upload_schedules();
    if ($ret)
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>Error during file uploaded - players not added !!!</strong></div>';
    }
    else
    {
      echo '<div id="message" class="updated fade">';
      echo '<strong>File uploaded and players added !!!</strong></div>';
    }
  }

  if ( $_POST['bbnuke_del_all_schedules_btn'] )
  {
    $season = $_POST['bbnuke_schedules_list_select_season'];
    bbnuke_delete_all_schedules($season);
  }

  bbnuke_plugin_print_schedules_page($edit_game);

  return;
}




////////////////////////////////////////////////////////////////////////////////
// print game results page
////////////////////////////////////////////////////////////////////////////////
function  bbnuke_plugin_create_game_results_page()
{
  $edit_results = false;

  if ( $_POST['bbnuke_results_list_set_season_btn'] )
  {
    //  set season for games list
    $season = $_POST['bbnuke_results_list_select_season'];
    bbnuke_update_option('bbnuke_results_season', $season);

    echo '<div id="message" class="updated fade">';
    echo '<strong>Season set sucessfully !!!</strong></div>';
  }

  if ( $_POST['bbnuke_save_results_btn'] )
  {
    $ret = bbnuke_update_game_results();
    if (!$ret)
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>Error - game results not updated !!!</strong></div>';
    }
    else
    {
      echo '<div id="message" class="updated fade">';
      echo '<strong>Game results updated!!!</strong></div>';
    }
  }

  if ( $_POST['bbnuke_edit_game_btn'] )
  {
    $edit_results = true;
    $game_id = $_POST['bbnuke_results_edit_game_select'];
    bbnuke_update_option('bbnuke_game_edit_id', $game_id);
  }

  if ( $_POST['bbnuke_del_all_games_btn'] )
  {
    $season = $_POST['bbnuke_results_list_select_season'];
    bbnuke_delete_all_schedules($season);
  }

  bbnuke_plugin_print_game_results_page($edit_results);

  return;
}


////////////////////////////////////////////////////////////////////////////////
// print plugin option page and check post data
////////////////////////////////////////////////////////////////////////////////
function bbnuke_plugin_create_option_page()
{
  $seasons_list = bbnuke_get_seasons();

  if ( $_POST['bbnuke_add_season_btn'] )
  {
    if ( empty($_POST['bbnuke_season_new']) )
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>' . __('No season - please fill the season input field!', 'bbnuke') . '</strong></div>';
    }
    else
    {
      $year = $_POST['bbnuke_season_new'];
      $ret = bbnuke_addSeason($year);
      if ( $ret === false )
      {
        echo '<div id="message" class="error fade">';
        echo '<strong>' . __('season already exists!', 'bbnuke') . '</strong></div>';
      }
      else
      {
        echo '<div id="message" class="updated fade">';
        echo '<strong>' . __('Season added!', 'bbnuke') . '</strong></div>';
      }
    }
  }

  if ( $_POST['bbnuke_del_season_btn'] )
  {
    $year = $seasons_list[$_POST['bbnuke_select_season']];
    if ( !empty($year) )
      $ret = bbnuke_delete_season($year);
    switch ($ret)
    {
      case -10:
        echo '<div id="message" class="error fade">';
        echo '<strong>' . __('Season not deleted - this is the default season!', 'bbnuke') . '</strong></div>';
        break;
      case -20:
        echo '<div id="message" class="error fade">';
        echo '<strong>' . __('Season not deleted - at least one season must exists!', 'bbnuke') . '</strong></div>';
        break;
      case 10:
        echo '<div id="message" class="updated fade">';
        echo '<strong>' . __('Season deleted!', 'bbnuke') . '</strong></div>';
        break;
    }
  }

  if ( $_POST['bbnuke_set_defs_btn'] )
  {
    $teams_list   = bbnuke_get_teams();
    $defs['defaultTeam']   = $teams_list[$_POST['bbnuke_def_team_select']];
    $defs['defaultSeason'] = $seasons_list[$_POST['bbnuke_def_season_select']];
    $ret = bbnuke_set_defaults($defs);
    echo '<div id="message" class="updated fade">';
    echo '<strong>' . __('Default values changed!', 'bbnuke') . '</strong></div>';
  }

  if ( $_POST['bbnuke_add_new_team_btn'] )
  {
    if ( empty($_POST['bbnuke_add_new_team']) )
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>' . __('No team name - please fill out the team name input field!', 'bbnuke') . '</strong></div>';
    }
    else
    {
      $team = $_POST['bbnuke_add_new_team'];
      bbnuke_add_team_season( $team, $season = NULL);
      echo '<div id="message" class="updated fade">';
      echo '<strong>' . __('Team added!', 'bbnuke') . '</strong></div>';
    }
  }

  if ( $_POST['bbnuke_select_team_delete_btn'] )
  {
    $team = $_POST['bbnuke_select_team_delete'];
    bbnuke_delete_team( $team );
    echo '<div id="message" class="updated fade">';
    echo '<strong>' . __('Team deleted!', 'bbnuke') . '</strong></div>';
  }

  if ( $_POST['bbnuke_add_season_teams_btn'] )
  {
    $season    = $seasons_list[$_POST['bbnuke_select_season']];
    $team_list = $_POST['bbnuke_select_season_teams'];
    if ( empty($season) OR empty($team_list) )
    {
      echo '<div id="message" class="error fade">';
      echo '<strong>' . __('Please select teams and season!', 'bbnuke') . '</strong></div>';
    }
    else
    {
      bbnuke_add_team_season( $team_list, $season);
      echo '<div id="message" class="updated fade">';
      echo '<strong>' . __('Teams added to season!', 'bbnuke') . '</strong></div>';
    }
  }


  if ( $_POST['bbnuke_update_options_btn'] )
  {
    bbnuke_save_plugin_options();

    echo '<div id="message" class="updated fade">';
    echo '<strong>Plugin Settings saved !!!</strong></div>';
  }


  bbnuke_plugin_print_option_page();

  return;
}



function bbnuke_is_min_wp($version) 
{
  return version_compare( $GLOBALS['wp_version'], $version. 'alpha', '>=');
}




function bbnuke_more_reccurences() 
{
    return array(
        'weekly' => array('interval' => 604800, 'display' => 'Once Weekly'),
        'monthly' => array('interval' => 2592000, 'display' => 'Once Monthly'),
        );
}





?>
