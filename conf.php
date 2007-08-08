<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0.0
//	Configuration Created: Thu, 12 Jul 2007 19:24:25 +0100
//	
//
//	Main configuration for the AAC system
// ===========================================================
// ===========================================================
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// ===========================================================

# The basic and sane settings for the AAC to run properly
$aac_status = 					"Not Installed";
$aac_version = 					"2.0.2";
$aac_versioncode = 				202;
$aac_dataDir =					"C:/Dev-Cpp/otserv/data";
$aac_worldDirName = 			"world";
$aac_monstersDirName =			"monster";
$aac_spellsDirName =			"spells";
$aac_mapname =					"map";
$aac_maintenanceReason = 		"<p>No reason set.</p>";
$aac_layout =					"Indigo";

# Lengths of commonly used fields in the AAC
$aac_maxplayers = 				25;
$aac_minacclen = 				4;
$aac_maxacclen = 				10;
$aac_minpasslen = 				4;
$aac_maxpasslen = 				20;
$aac_minplayerlen =				3;
$aac_maxplayerlen =				20;

# Used to get statistical information for your site. E.G. Players online, peak, max, etc
$aac_servername = 				"TestName";
$net_ipaddress =				"127.0.0.1";
$net_port = 					"7171";

# Security switches and username/password
$aac_md5passwords =				false;
$aac_imgver = 					false;
$main_downloads_warning = 		false;
$main_showemails = 				false;
$aac_randomaccnum =				false;
$admin_user =					"admin";
$admin_pass = 					"df7d3jju";

# MySQL Server connection credentials to get into the MySQL server and use your otserv database
$sql_host =						"localhost";
$sql_user =						"root";
$sql_pass = 					"";
$sql_db = 						"otserv";

# Settings for Highscores, Voting, Feedback mail, Towns
$main_highscores_result = 		20;
$main_ugrp_nolist =				2;
$main_votequestion = 			"What should the server add?";
$main_voteanswer1 = 			"More monsters";
$main_voteanswer2 = 			"More hunting areas";
$main_voteanswer3 = 			"More houses";
$main_voteanswer4 = 			"New towns";
$main_enable_mailer = 			false;
$main_mail = 					"none@none.nodomain";
$main_towns = 					array(1 => 'Town 1', 2 => 'Town 2', 3 => 'Town 3', 4 => 'Town 4', 5 => 'Town 5', );

# Information for the statistics page, is not used with the AAC, and not exactly important
$info_os =						"Debian Linux";
$info_connection =				"5 Mbit";
$info_uptimetype =				"24/7";

# Modules for the AAC, can be enabled/disabled from the admin panel
$modules_charsearch = 			false;
$modules_feedback = 			false;
$modules_affliates = 			false;
$modules_guilds = 				false;
$modules_houses = 				false;
$modules_highscores = 			false;
$modules_infopage = 			false;
$modules_serverstats = 			false;
$modules_downloads = 			false;
$modules_bannedplayers = 		false;
$modules_commands = 			false;
$modules_rules = 				false;
$modules_voting = 				false;
$modules_custom = 				false;
$modules_videos = 				false;
$modules_gallery = 				false;
$modules_monsters = 			false;
$modules_spells = 				false;

# Character settings
$char_rook =					false;
$char_group =					1;
$char_exp =						98800;
$char_cap =						2000;
$char_level =					20;
$char_lookhead =				10;
$char_lookbody =				10;
$char_looklegs =				10;
$char_lookfeet =				10;
$char_town =					1;

# Character item settings
$pids = 						array(1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$sid = 							10; 	 
$char_items = 					array();
$char_items[11] = 				array('slot' => 3, 'item_type' => 1988, 'count' => 1);
$char_items[12] = 				array('slot' => 4, 'item_type' => 2650, 'count' => 1);
$char_items[13] = 				array('slot' => 5, 'item_type' => 2382, 'count' => 1);
$char_items[14] = 				array('slot' => 6, 'item_type' => 2050, 'count' => 1);
$char_items[15] = 				array('slot' => 11, 'item_type' => 2674, 'count' => 2);

# Character levels (Magic, HP, Mana)
$char_maglevel_none = 			"";
$char_health_none = 			"";
$char_mana_none = 				"";

$char_maglevel_sorcerer = 		100;
$char_health_sorcerer = 		100;
$char_mana_sorcerer = 			100;

$char_maglevel_druid = 			100;
$char_health_druid = 			100;
$char_mana_druid = 				100;

$char_maglevel_paladin = 		100;
$char_health_paladin = 			100;
$char_mana_paladin = 			100;

$char_maglevel_knight = 		100;
$char_health_knight = 			100;
$char_mana_knight = 			100;
?>
