=== baseballNuke ===
Contributors: Shawn Grimes, Christian Gnoth
Author Uri: http://claimid.com/shawn
Plugin Uri: http://www.flyingdogsbaseball.com/wp-plugins/baseballNuke
Tags: phpnuke, baseball, team management, baseballNuke
Requires at least: 2.7
Tested up to: WP 3.0.1
Stable tag: 1.0.3



== Description ==

Tested with **Wordpress 3.0.1**

baseballNuke is a wordpress plugin based on the phpNuke module for the CMS phpnuke (<a href="http://phpnuke.org" target="_blank">http://phpnuke.org</a>) for the administration of a single baseball team.  It may in the future be extended to manage an entire league, but that won’t be coming down any time soon. baseballNuke is a complete team management tool and information source.  It provides team and individual information about the players including schedule, field directions, player stats, team stats, player profiles and game results.

== Support ==

Please post your question in the forum under **[Support forum](http://wordpress.org/tags/baseballNuke?forum_id=10#postform)** .  


== Installation ==

1) Extract the file 
2) Copy the files to your wp-content/plugins directory 
2) Activate the plugin under the wp admin plugins page


3) Go to the plugin option page and add team and initial season
4) go to Baseball Settings and set default team and season 
and select whether or not you would like the module to display 
the menu.  If you have not added you default team or season yet, 
you must create them before you configure them as defaults.
4) add teams
5) add fields
6) add schedule (you must enter teams, fields and season first)
7) select Edit players to enter your roster.  If you already have 
it in a flat file, you can upload it as a .csv 
(teamName,firstname,middlename,lastname, positions,bats,throws,height,weight,address,city,state,zip,homePhone,workPhone, cellphone,jerseyNum,picLocation,season,profile)


== Frequently Asked Questions ==

= If I try to activate the plugin, I get a 404 error message =

You must login to wordpress with an administrator user.


== Screenshots ==

1. WP Admin Backend - Plugin Option Page
2. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the directory of the stable readme.txt, so in this case, `/tags/4.3/screenshot-1.png` (or jpg, jpeg, gif)
3. This is the second screen shot

= Licensse =

Created by Shawn Grimes http://claimid.com/shawn

baseballNuke is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

baseballNuke is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with baseballNuke; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA


= History =

baseballNuke originated as a baseball team website written in php.  
The bulk of the code was written in 2004 and has been improved, 
modified and tweaked every season since.  This spring the code was 
ported to phpNuke as baseballNuke.

baseballNuke is a phpNuke module for the administration of a single 
baseball team.  It may in the future be extended to manage an entire 
league, but that won’t be coming down any time soon. baseballNuke is 
a complete team management tool and information source.  It provides 
team and individual information about the players including schedule, 
field directions, player stats, team stats, player profiles and game 
results.

Programmer/Technical Genious -- Shawn Grimes (http://claimid.com/shawn)
Designer/Baseball expertise -- Nick (http://caimid.com/nickcollingham)

Submit all bugs, issues, and feature requests to:
http://bugs.baseballnuke.com

= Administration =

Add new season - Select Add Season.  
	You will first enter the year of the new season and click submit.  
	You will then be prompted to select the Returning teams from previous 
	seasons to they do not need to be reentered, check the box next to the 
	returning teams and click submit.  Then you will be prompted for the 
	players returning to the default team.  Select the check box next to 
	each returning player and then click submit.  Be sure to go back and 
	enter the new schedule, the new season will not appear until there is 
	at least 1 game entered for that season.

Game Results - Select Game Results from the baseballNuke Menu.  Verify 
	the season is correct and select the game you wish to enter results for 
	from the drop down menu.  Only games for the current date and older will 
	be displayed in the drop down (you can't enter results for a game that has 
	not been played), the games will be listed in decending order.

	You will have 2 sections in the game results, the box score and the player 
	results.  The player results are what will be used to calculate the players 
	statistics.  When entering the player results, be sure to uncheck the 
	"Did not Play"box for each player that did participate in the game.  Also, 
	be sure to enter a number in the "batt. order" column and/or if the player 
	pitched the "Pi. order" column.  This will determine the 


== Translations ==
* German (de_DE) (next release)
* English (default)
* other must be translated

== Changelog ==

= 1.0.0 =
- first version of the plugin released 

= 1.0.1 =
- problem with delete season in settings page fixed
- error on fields page: update of locations fixed
- error on schedule, practise, tournaments page: add has not set the season in the INSERT sql
- screenshot added
- game results admin page: update of game results added + add of game results added

= 1.0.2 =
- error fixed: CREATE VIEWS not working during plugin activation
- widget type locations changed - no mysql error if no location is defined
- widget playerstats and game results changed - option added for game id and player id
- frontend language support added

= 1.0.3 =
- error fixed: if empty tables game results show mysql error
- error fixed: locations info did not dhow correct directions
- error fixed: delete of location not working properly
- error fixed: playerstats widget did not show hometeam correctly
- error fixed: delete season not working; fill tbales with defaults only at plugin activation
- design changes

`<?php code(); // goes in backticks ?>`
