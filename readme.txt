=== baseballNuke ===
Contributors: Shawn Grimes, Christian Gnoth, Nick Collingham, Dawn Wallis, Bobby Downs
Plugin Uri: http://dev.flyingdogsbaseball.com/baseballNuke
Tags: phpnuke, baseball, team management, baseballNuke, softball, league
Requires at least: 2.7
Tested up to: WP 3.3.1
Stable tag: 1.2


== Description ==

Tested with **Wordpress 3.1**

baseballNuke is a wordpress plugin for the administration of a single baseball team or league.  baseballNuke is a complete team management tool and information source.  It provides team and individual information about the players including schedule, field directions, player stats, team stats, player profiles and game results.


== Support ==

Please post your questions in the forum under **[Support forum](http://wordpress.org/tags/baseballNuke?forum_id=10#postform)** or email Nick Collingham 
manager@flyingdogsbaseball.com


== Installation ==

1) Extract the file 
2) Copy the files to your wp-content/plugins directory 
3) Activate the plugin under the wp admin plugins page

== Getting Started ==

1) Go to the plugin option page in wp-admin and add team and initial season
2) go to Baseball Settings and set default team and season 
and select whether or not you would like the module to display 
the menu.  If you have not added your default team or season yet, 
you must create them before you configure them as defaults.
3) add teams
4) add fields
5) add schedule (you must enter teams, fields and season first).  The schedule may be loaded as a csv.
6) select Edit players to enter your roster.  If you already have 
it in a flat file, you can upload it as a .csv 
(teamName,firstname,middlename,lastname, positions,bats,throws,height,weight,address,city,state,zip,homePhone,workPhone, 
cellphone,jerseyNum,picLocation,season,profile)

for additional tips, visit http://dev.flyingdogsbaseball.com/baseballNuke

== Usage ==
From admin console, drag baseballNuke widget to desired sidebar.  Then, select which baseballNuke widget you would like to display from the dropdown in the sidbar.

To use in a page, use the following shortcodes in the content of your page:
     [bbnuke_topbatters team=teamname season=seasonname] - Top Batters*
     [bbnuke_toppitchers team=teamname season=seasonname] - Top Pitchers*
     [bbnuke_lastgame] - Last Game
     [bbnuke_nextgame] - Next Game
     [bbnuke_batstats team=teamname season=seasonname] - Batting Stats*
     [bbnuke_roster team=teamname season=seasonname] - Roster*
     [bbnuke_pitchstats team=teamname season=seasonname] - Pitching Stats*
     [bbnuke_fieldstats team=teamname season=seasonname] - Fielding Stats*
     [bbnuke_playerstats] - Player Stats
     [bbnuke_schedule team=teamname season=seasonname] - Schedule*
     [bbnuke_practice team=teamname season=seasonname] - Practice Schedule*
     [bbnuke_tournament team=teamname season=seasonname] - Tournament Schedule*
     [bbnuke_fields] - Field Locations
     [bbnuke_gameresults] - Game Results
* team and season attributes are optional.  If not included the default team and season will be used
* a value of "league" in the team attribute will display all teams.

== Frequently Asked Questions ==

= If I try to activate the plugin, I get a 404 error message =
You must login to wordpress with an administrator user.

= When I click on the player link to see the profile, nothing happens =
You must create a player profile page (shortcode [bbnuke_playerstats]) and specify it on the settings page of the baseballNuke admin console.  

= After upgrading, my previously defined shortcodes are not being displayed. =
Before changing anyting, first try disabling then re-enabling the plugin.
 
== Screenshots ==
1. WP Admin Backend - Plugin Option Page

= License =

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

baseballNuke originated as a baseball team website written in php
designed by Nick Collingham and coded by Shawn Grimes. The bulk of the code 
was written in 2004 and has been improved, modified and tweaked every season 
since.  In 2005 the code was ported to CMS phpNuke as a module named 
baseballNuke. In late fall of 2010, the phpNuke module was ported to a 
WordPress plugin by Christian Gnoth.


Programmer/Technical Genious (original phpNuke version) -- Shawn Grimes (http://claimid.com/shawn)
Programmer/Port to WordPress -- Christian Gnoth (http://it-gnoth.de/en/)
Designer/Baseball expertise/improvements -- Nick Collingham (http://claimid.com/nickcollingham)
Programmer/Technical Genious - Dawn Wallis


== Translations ==
* German (de_DE)
* Frentch (fr_FR)
* English (default)
* other must be translated

== Changelog ==

= 1.0.0 =
- first version of the plugin released 

= 1.0.1 =
- problem with delete season in settings page fixed
- error on fields page: update of locations fixed
- error on schedule, practice, tournaments page: add has not set the season in the INSERT sql
- screenshot added
- game results admin page: update of game results added + add of game results added

= 1.0.2 =
- error fixed: CREATE VIEWS not working during plugin activation
- widget type locations changed - no mysql error if no location is defined
- widget player stats and game results changed - option added for game id and player id
- front end language support added

= 1.0.3 =
- error fixed: if empty tables game results show mysql error
- error fixed: locations info did not dhow correct directions
- error fixed: delete of location not working properly
- error fixed: player stats widget did not show home team correctly
- error fixed: delete season not working; fill tables with defaults only at plugin activation
- design changes

= 1.0.4 =
- NEW WIDGET: Roster, this widget will display all users on the current seasons roster along with their age, city/state, positions and bat/throw and school.
- FIX: Batting stats widget was updated to correct the display of the OPS and SLG statistics for values => 1.000.
- FIX: updated "Next Game" widget time to include AM/PM and to properly display opponent name.
- ENHANCEMENT: table rows are highlighted on mouseover
- ENHANCEMENT: Table row format CSS has been cleaned up.
- ENHANCEMENT: links now open in same page rather than in a popup.
- ENHANCEMENT: widget output colors configurable through wp-admin
- DB ADDITION: added "school" to the player profile table to support the new Roster widget

= 1.0.4.1 =
- BUG FIX - added admin option to specify page location for Game Results, Player Stats and Locations Info widgets.

= 1.0.5 =
- ENHANCEMENT: added shortcodes for Widgets
- ENHANCEMENT: added color palette in admin settings
- ENHANCEMENT: created dropdown page selector for the Game Results, Player Stats and Locations in admin settings.

= 1.0.5.1 =
- BUG Fix: corrected missing references for color palette

= 1.0.5.2 = 
- BUG Fix: corrected error in footer

= 1.0.6 =
- BUG Fix: corrected bug for table color selections
- Bug Fix: Corrected height/weight problem when entering player info in admin console
- UPDATE: Added height/weight to player profile page if values exist
- UPDATE: Update player profile page to show pitching stats only if IP > 0
- UPDATE: change player image path on player profile page to accept any url/relative link

= 1.0.7 =
- BUG FIX: Cannot Edit Existing Games
- BUG FIX: Import does not set season in schedule table
- BUG FIX: Cannot enter game results (because season not set in schedule table)
- ENHANCEMENT: Added French language support (thanks Roland Reinhart)
- UPDATE: Updated German language support (thanks Roland Reinhart)

= 1.0.7.1 =
- BUG FIX: Correct date header title on schedule widget.

= 1.0.8 =
- CHANGE: removed Age column from Roster
- UPDATE: removed comma (,) from Home field on roster when city/state are null
- BUG Fix: fixed dropdown field select on locations widget.

= 1.0.8.1 =
- BUG FIX: Next Game, Last Game widgets showing current date/time instead of schedule date/time
- UPDATE: The date/time format was changed in 1.0.8.  It now uses the format specified in Wordpress settings instead of a fixed format.  This is to support international formats.

= 1.0.9 =
- ENHANCEMENT: updated game result admin console to create seperate tabs for offense, pitching and fielding.
- ENHANCEMENT: added some verification on schedule upload to strip extra characters and verify home or away team matched default team.
- ENHANCEMENT: integrated player profile picture field with WordPress Media Library.
- ENHANCEMENT: integrated notes box on game results admin with wysiwyg editor
- MODIFICATION: box score in game results admin changed from H | R | E to R | H | E
- MODIFICATION: added additional tournament types to tournament admin page

= 1.1 =
- NEW: GameChanger.io webstats import in game results admin
- NEW: GameChanger.io MaxPreps file import in game results admin
- NEW: iScore Batting and Pitching CSV import
- NEW: shortcode attribute support for team and season.
- ENHANCEMENT: Option to attach post to game results
- ENHANCEMENT: Added game status field to game results (completed, postponed, cancelled, suspended)
- ENHANCEMENT: Added game length option in settings for calculating ERA
- ENHANCEMENT: Added Sac Fly stat (SF)
- ENHANCEMENT: Schedule now shows Win/Loss/Tie instead of date for completed games
- ENHANCEMENT: Schedule now shows Game Results/Boxscores instead of location for completed games
- ENHANCEMENT: Table sorting now also works on calculated stats for the batting stats, pitching stats and player stats widgets
- FIX: Corrected OBP stat calculation
- REMOVED: removed notes section from game results.

= 1.2 =
- BUG FIX: Top Batters widget not working (batting leaders view error)
- BUG FIX: When game is deleted, related stats are not removed
- BUG FIX: Player/Game/Location links require permalinks, this is no longer a requirement
- BUG FIX: cannot enter stats for both home and visiting team for same game
- ENHANCEMENT: Top batters and top pitchers widget modified to work by season rather than current calendar year.
- ENHANCEMENT: Added confirmation page for uninstall
- ENHANCEMENT: Added confirmation for major deletes (season, all games, all players)
- ENHANCEMENT: added team and season option to widget admin page
- ENHANCEMENT: added game date to game results widget
- ENHANCEMENT: cookie plugin (cookiemonster) is no longer needed.
- MODIFICATON: consolidated schedule/practice/tournament admin pages
- MODIFICATION: created tabs for offense/pitching/defence on player stats page
- MODIFICATION: modified css for stats tables
- NEW: added option to select which columns to display on stats tables
- NEW: added career stats to player stats page
- NEW: added league value for team in shortcodes.  a value of league will return results for all teams.
- NEW: added WHIP stat to pitching stats widget
- REMOVED: Deleted admin_bbnuke user.  This account was only needed in early versions of bbnuke and is no longer needed.
- RETIRED: Top 5 stats widget. 
- RETIRED: Gamechanger import

= 1.2.1 =
- BUG FIX: new database column for game status was not added to existing bbnuke installations that were upgrading causing issues with the schedule widget.
- BUG FIX: schedule did not display properly for games in complete status
- BUG FIX: player profile showed multiple profiles if player exists in seasons with similar names, ex: "2012" and "2012 Preseason"

= 1.2.2 =
- BUG FIX: Assign players to season does not add most recent player entries.
- BUG FIX: Batting and pitching widgets do not support the "league" value for team attribute in shortcode.
- BUG FIX: schedules that are imported do not show on schedule.
- BUB FIX: schedules uploaded from CSV dont show up on schedule widget.
