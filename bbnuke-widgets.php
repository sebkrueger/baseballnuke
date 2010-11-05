<?php


class bbnuke_Widget extends WP_Widget 
{
  public $display_types = array(
        0 => 'Top Batters',
        1 => 'Top Pitchers',
        2 => 'Last Game',
        3 => 'Next Game',
        4 => 'Bat Stats',
        5 => 'Team Stats',
        6 => 'Pitch Stats',
        7 => 'Field Stats',
        8 => 'Player Stats',
        9 => 'Top 5 Stats',
       10 => 'Team Schedule',
       11 => 'Team Practises',
       12 => 'Team Tournaments',
       13 => 'Locations Info',
       14 => 'Game Results'
      );

  function bbnuke_Widget() 
  {
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

    $instance['title']             = strip_tags($new_instance['title']);
    $instance['display_type']      = (int) $new_instance['display_type'];
    $instance['display_def_title'] = $new_instance['display_def_title'];
    $instance['team']              = strip_tags($new_instance['team']);
    $instance['season']            = (int) $new_instance['season'];

    return $instance;
  }

  function form($instance) 
  {
    /* Set up some default widget settings. */
    $defaults = array(
			'title' => '', 'display_type' => 0, 'display_def_title' => 'on', 'team' => 'Flying Dogs', 
			'season' => '2008'
		);

    $instance = wp_parse_args((array) $instance, $defaults);

    echo 
    '  <div style="text-align:center">
         <h3>Display Stats and Results</h3>
         <span style="line-height:15px"><br /><br /></span>
         <table>
         <tr>
           <td><strong>' . __('Title', 'bbnuke') . '</strong></td>
           <td><input style="text-align:right" type="text" id="' . $this->get_field_id('title') . '" name="' . $this->get_field_name('title') . '" value="' . esc_attr($instance['title']) . '" /></td>
           <td style="font-size:0.75em">' . __('Custom Title - shown in sidebar.', 'bbnuke') . '</td>
         </tr>
         <tr>
           <td><strong>' . __('Display default title', 'bbnuke') . '</strong></td>
           <td><input class="checkbox" type="checkbox" ' . checked( $instance['display_def_title'], 'on', false ) . ' id="' . $this->get_field_id('display_def_title') . '" name="' . $this->get_field_name('display_def_title') . '" /></td>
           <td style="font-size:0.75em">' . __('Display the default title or the custom title.', 'bbnuke') . '</td>
         </tr>
         <tr>
           <td><strong>' . __('Display Type', 'bbnuke') . '</strong></td>
           <td style="text-align:right;">
             <select id="' . $this->get_field_id('display_type') . '" name="' . $this->get_field_name('display_type') . '" size="1">' . "\n";

    for ( $i=0; $i < count($this->display_types); $i++ )
    {
      if ( $instance['display_type'] == $i )
        echo '    <option value="' . $i . '" selected="selected">' . $this->display_types[$i] . '</option>' . "\n";
      else
        echo '    <option value="' . $i . '">' . $this->display_types[$i] . '</option>' . "\n";
    }

    echo 
    '
             </select>
           </td>
           <td style="font-size:0.75em">' . __('What type of statistic should be displayed', 'bbnuke') . '</td> 
         </tr>
         </table>
       </div>' . "\n";


/*
			<tr>
				<td><strong>' . __('Min. Number of Posts') . '</strong></td>
				<td><input style="text-align:right" type="text" id="' . $this->get_field_id('minnum') . '" name="' . $this->get_field_name('minnum') . '" value="' . esc_attr($instance['minnum']) . '" /></td>
				<td style="font-size:0.75em">' . __('Tags with less than this number of posts will not be displayed.') . '</td>
			</tr>
			<tr>
				<td><strong><?php _e('Max. Number of Posts') ?></strong></td>
				<td><input style="text-align:right" type="text" id="<?php echo $this->get_field_id('maxnum'); ?>" name="<?php echo $this->get_field_name('maxnum'); ?>" value="<?php echo esc_attr($instance['maxnum']); ?>" /></td>
				<td style="font-size:0.75em"><?php _e('Tags with more than this number of posts will not be displayed.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Font Display Unit') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('unit'); ?>" name="<?php echo $this->get_field_name('unit'); ?>">
						<option value="px" <?php if ('px' == $instance['unit']) echo 'selected="selected"'; ?>>Pixel</option>
						<option value="pt" <?php if ('pt' == $instance['unit']) echo 'selected="selected"'; ?>>Point</option>
						<option value="em" <?php if ('em' == $instance['unit']) echo 'selected="selected"'; ?>>Em</option>
						<option value="%" <?php if ('%' == $instance['unit']) echo 'selected="selected"'; ?>>Percent</option>
					</select>
				</td>
				<td style="font-size:0.75em"><?php _e('What unit to use for font sizes.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Smallest Font Size') ?></strong></td>
				<td><input style="text-align:right" type="text" id="<?php echo $this->get_field_id('smallest'); ?>" name="<?php echo $this->get_field_name('smallest'); ?>" value="<?php echo esc_attr($instance['smallest']); ?>" /></td>
				<td style="font-size:0.75em"><?php _e('Tags will be displayed no smaller than this value.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Largest Font Size') ?></strong></td>
				<td><input style="text-align:right" type="text" id="<?php echo $this->get_field_id('largest'); ?>" name="<?php echo $this->get_field_name('largest'); ?>" value="<?php echo esc_attr($instance['largest'], true); ?>" /></td>
				<td style="font-size:0.75em"><?php _e('Tags will be displayed no larger that this value.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Min. Tag Color') ?></strong></td>
				<td><input style="text-align:right" type="text" id="<?php echo $this->get_field_id('mincolor'); ?>" name="<?php echo $this->get_field_name('mincolor'); ?>" value="<?php echo esc_attr($instance['mincolor'], true); ?>" /></td>
				<td style="font-size:0.75em"><?php _e('Beginning color for tag gradient.  Please include the #.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Max. Tag Color') ?></strong></td>
				<td><input style="text-align:right" type="text" id="<?php echo $this->get_field_id('maxcolor'); ?>" name="<?php echo $this->get_field_name('maxcolor'); ?>" value="<?php echo esc_attr($instance['maxcolor'], true); ?>" /></td>
				<td style="font-size:0.75em"><?php _e('Ending color for tag gradient.  Please include the #.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Cloud Format') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>" size="1" value="">
						<option value="flat" <?php if ('flat' == $instance['format']) echo 'selected="selected"'; ?>>Flat</option>
						<option value="list" <?php if ('list' == $instance['format']) echo 'selected="selected"'; ?>>List</option>
						<option value="drop" <?php if ('drop' == $instance['format']) echo 'selected="selected"'; ?>>Dropdown</option>
		   			</select>
				</td>
				<td style="font-size:0.75em"><?php _e('How to display the cloud.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Show Tags') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('showtags'); ?>" name="<?php echo $this->get_field_name('showtags'); ?>" size="1" value="">
						<option value="yes" <?php if ('yes' == $instance['showtags']) echo 'selected="selected"'; ?>>Yes</option>
						<option value="no" <?php if ('no' == $instance['showtags']) echo 'selected="selected"'; ?>>No</option>
		   			</select>
				</td>
				<td style="font-size:0.75em"><?php _e('Display tags in cloud.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Show Categories') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('showcats'); ?>" name="<?php echo $this->get_field_name('showcats'); ?>" size="1" value="">
						<option value="no" <?php if ('no' == $instance['showcats']) echo 'selected="selected"'; ?>>No</option>
						<option value="yes" <?php if ('yes' == $instance['showcats']) echo 'selected="selected"'; ?>>Yes</option>
		   			</select>
				</td>
				<td style="font-size:0.75em"><?php _e('Display categories in cloud.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Show Empty') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('empty'); ?>" name="<?php echo $this->get_field_name('empty'); ?>" size="1" value="">
						<option value="no" <?php if ('no' == $instance['empty']) echo 'selected="selected"'; ?>>No</option>
						<option value="yes" <?php if ('yes' == $instance['empty']) echo 'selected="selected"'; ?>>Yes</option>
		   			</select>
				</td>
				<td style="font-size:0.75em"><?php _e('Display empty categories in cloud.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Display Post Count?') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('showcount'); ?>" name="<?php echo $this->get_field_name('showcount'); ?>" size="1" value="">
						<option value="no" <?php if ('no' == $instance['showcount']) echo 'selected="selected"'; ?>>No</option>
						<option value="yes" <?php if ('yes' == $instance['showcount']) echo 'selected="selected"'; ?>>Yes</option>
		   			</select>
				</td>
				<td style="font-size:0.75em"><?php _e('Show number of posts for each tag.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Sort By') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" size="1" value="">
						<option value="name" <?php if ('name' == $instance['orderby']) echo 'selected="selected"'; ?>>Name</option>
						<option value="count" <?php if ('count' == $instance['orderby']) echo 'selected="selected"'; ?>>Count</option>
						<option value="rand" <?php if ('rand' == $instance['orderby']) echo 'selected="selected"'; ?>>Random</option>
		   			</select>
				</td>
				<td style="font-size:0.75em"><?php _e('What field to sort by.') ?></td>
			</tr>
			<tr>
				<td><strong><?php _e('Sort Order') ?></strong></td>
				<td style="text-align:right;">
					<select id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>" size="1" value="">
						<option value="ASC" <?php if ('ASC' == $instance['order']) echo 'selected="selected"'; ?>>Ascending</option>
						<option value="DESC" <?php if ('DESC' == $instance['order']) echo 'selected="selected"'; ?>>Descending</option>
		   			</select>
				</td>
				<td style="font-size:0.75em"><?php _e('Direction of sort.') ?></td>
			</tr>
		</table>
	</div>' . "\n";
*/
  }
}



?>