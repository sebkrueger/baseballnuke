<?php

class bbnuke_Widget extends WP_Widget 
{

  public $display_types = array();

  function bbnuke_Widget() 
  {
    $this->display_types = array(
        0  => __('Top Batters', 'bbnuke'),
        1  => __('Top Pitchers', 'bbnuke'),
        2  => __('Last Game', 'bbnuke'),
        3  => __('Next Game', 'bbnuke'),
        4  => __('Bat Stats', 'bbnuke'),
        5  => __('Roster', 'bbnuke'),
        6  => __('Pitch Stats', 'bbnuke'),
        7  => __('Field Stats', 'bbnuke'),
        8  => __('Player Stats', 'bbnuke'),
        9  => __('Top 5 Stats', 'bbnuke'),
       10  => __('Team Schedule', 'bbnuke'),
       11  => __('Team Practices', 'bbnuke'),
       12  => __('Team Tournaments', 'bbnuke'),
       13  => __('Locations Info', 'bbnuke'),
       14  => __('Game Results', 'bbnuke')
      );

    /* Widget settings. */
    $widget_ops = array('classname' => 'bbnuke', 'description' => __('Displays various stats and results.','bbnuke') );

    /* Widget control settings. */
    $control_ops = array('width' => 420, 'height' => 510);

    /* Create the widget. */
    $this->WP_Widget('bbnuke', __('BaseballNuke Stats View','bbnuke'), $widget_ops, $control_ops);
  }
	

  function widget($args, $instance) 
  {
    extract($args);

    if ( empty($instance['title']) AND $instance['display_def_title'] )
      $instance['title'] = $this->display_types[$instance['display_type']];
    $title = apply_filters('widget_title', $instance['title']);

    if (!isset($instance['display_def_title']))
      $instance['display_def_title'] = false;

    echo $before_widget;
    echo $before_title.$title.$after_title;
    echo '<div class="bbnuke_widget">';
    bbnuke_display_widget($instance);
    echo '</div>';
    echo $after_widget;
  }
	

  function update($new_instance, $old_instance) 
  {
    $instance = $old_instance;
    if ($new_instance['display_def_title'] = 'on'){
      $instance['title']           = $this->display_types[$instance['display_type']];
    }else{
    $instance['title']             = strip_tags($new_instance['title']);
    }
    $instance['display_type']      = (int) $new_instance['display_type'];
    $instance['display_def_title'] = $new_instance['display_def_title'];
    $instance['team']              = $new_instance['team'];
    $instance['season']            = $new_instance['season'];

    return $instance;
  }

  function form($instance) 
  {
    /* Set up some default widget settings. */
    $defaults = array(
			'title' => '', 'display_type' => 0, 'display_def_title' => 'on', 'team' => 'Flying Dogs', 
			'season' => '2008'
		);
    $defs = bbnuke_get_defaults();
    $seasons_list = bbnuke_get_seasons();
    $team_list    = bbnuke_get_teams();

    $instance = wp_parse_args((array) $instance, $defaults);

    $display_types = array(
        0  => __('Top Batters', 'bbnuke'),
        1  => __('Top Pitchers', 'bbnuke'),
        2  => __('Last Game', 'bbnuke'),
        3  => __('Next Game', 'bbnuke'),
        4  => __('Bat Stats', 'bbnuke'),
        5  => __('Roster', 'bbnuke'),
        6  => __('Pitch Stats', 'bbnuke'),
        7  => __('Field Stats', 'bbnuke'),
        8  => __('Player Stats', 'bbnuke'),
        9  => __('Top 5 Stats', 'bbnuke'),
       10  => __('Team Schedule', 'bbnuke'),
       11  => __('Team Practices', 'bbnuke'),
       12  => __('Team Tournaments', 'bbnuke'),
       13  => __('Locations Info', 'bbnuke'),
       14  => __('Game Results', 'bbnuke')
      );


    echo 
    '  <div style="text-align:center">
         <h3>' . __('Display Stats and Results', 'bbnuke') . '</h3>
         <span style="line-height:15px"><br /><br /></span>
         <table>
         <tr>
           <td style="text-align:left;"><strong>' . __('Title', 'bbnuke') . '</strong></td>
           <td><input style="text-align:right" type="text" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" value="' . esc_attr($instance['title']) . '" /></td>
           <td style="font-size:0.75em">' . __('Custom Title - shown in sidebar.', 'bbnuke') . '</td>
         </tr>
         <tr>
           <td style="text-align:left;"><strong>' . __('Display default title', 'bbnuke') . '</strong></td>
           <td><input class="checkbox" type="checkbox" ' . checked( $instance['display_def_title'], 'on', false ) . ' id="' . $this->get_field_id('display_def_title') . '" name="' . $this->get_field_name('display_def_title') . '" /></td>
           <td style="font-size:0.75em">' . __('Display the default title or the custom title.', 'bbnuke') . '</td>
         </tr>
         <tr>
           <td style="text-align:left;"><strong>' . __('Display Type', 'bbnuke') . '</strong></td>
           <td style="text-align:right;">
             <select id="' . $this->get_field_id('display_type') . '" name="' . $this->get_field_name('display_type') . '" size="1">';

    for ( $i=0; $i < count($this->display_types); $i++ )
    {
      if ( $instance['display_type'] == $i )
        echo '    <option value="' . $i . '" selected="selected">' . $this->display_types[$i] . '</option>';
      else
        echo '    <option value="' . $i . '">' . $this->display_types[$i] . '</option>';
    }

    echo 
    '
             </select>
           </td>
           <td style="font-size:0.75em">' . __('What type of statistic should be displayed', 'bbnuke') . '</td> 
         </tr>
         <tr>
           <td style="text-align:left;"><strong>' . __('Team', 'bbnuke') . '</strong></td>
           <td style="text-align:right;">
             <select id="' . $this->get_field_id('team') . '" name="' . $this->get_field_name('team') . '" size="1">';
  for ( $i=0; $i < count($team_list); $i++ )
  {
    if ( $team_list[$i] == $defs['defaultTeam'] )
    echo '<option value="' . $team_list[$i] . '" selected="yes">' . $team_list[$i] . '</option>';
    else
    echo '<option value="' . $team_list[$i] . '">' . $team_list[$i] . '</option>';
  }

    echo '
           </td>
         </tr>
         <tr>
           <td style="text-align:left;"><strong>' . __('Season', 'bbnuke') . '</strong></td>
           <td style="text-align:right;">
             <select id="' . $this->get_field_id('season') . '" name="' . $this->get_field_name('season') . '" size="1">';
  for ( $i=0; $i < count($seasons_list); $i++ )
  {
    if ( $seasons_list[$i] == $defs['defaultSeason'] )
    echo '<option value="' . $seasons_list[$i] . '" selected="yes">' . $seasons_list[$i] . '</option>';
    else
    echo '<option value="' . $seasons_list[$i] . '">' . $seasons_list[$i] . '</option>';
  }

    echo '
           </td>
         </tr>
       </table>
     </div>';
  }
}



?>
