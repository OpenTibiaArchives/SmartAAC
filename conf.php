<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	Configuration Created: Tue, 12 Jun 2007 00:56:54 +0100
//	
//	USE OF THIS PROGRAM TO RELY ON IT FOR SERVER USE IS NOT
// 	RECOMMENDED! THIS IS FOR TESTING ONLY.
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

$aac_status = 			"Installed";
$aac_version = 			"2.0 Alpha 2";
$aac_versioncode = 		199;
$aac_dataDir =			"C:\Dev-Cpp\otserv\data";
$aac_mapname =			"map";

$aac_minacclen = 		4;
$aac_maxacclen = 		20;
$aac_minpasslen = 		4;
$aac_maxpasslen = 		20;
$aac_minplayerlen =	3;
$aac_maxplayerlen =	10;

$aac_servername = 		"TestName";
$net_ipaddress =		"127.0.0.1";
$net_port = 			"7171";

$aac_md5passwords =	false;
$aac_imgver = 			true;
$main_downloads_warning = false;
$admin_user =			"admin";
$admin_pass = 			"877113";

$sql_host =			"localhost";
$sql_user =			"root";
$sql_pass = 			"";
$sql_db = 				"loltest";

$main_highscores_result = 	20;
$main_ugrp_nolist =		2;
$main_votequestion = "What should the server add?";
$main_voteanswer1 = "More monsterssss";
$main_voteanswer2 = "More hunting areasssss";
$main_voteanswer3 = "More housessss";
$main_voteanswer4 = "New townssss";
$main_enable_feedback = false;
$main_mail = "none@none.nodomain";
$main_towns = array(1 => '', 2 => '', 3 => '', 4 => '', 5 => '');

$info_os =				"Debian Linux";
$info_connection =		"5 Mbit";
$info_uptimetype =		"24/7";

$modules_charsearch = true;
$modules_feedback = true;
$modules_affliates = true;
$modules_guilds = false;
$modules_houses = true;
$modules_highscores = true;
$modules_infopage = true;
$modules_serverstats = true;
$modules_downloads = true;
$modules_bannedplayers = true;
$modules_commands = true;
$modules_rules = true;
$modules_voting = true;
$modules_custom = true;
$modules_calculator = true;
$modules_videos = true;
$modules_gallery = true;

$char_rook =			true;
$char_group =			1;
$char_exp =			98800;
$char_cap =			700;
$char_level =			20;
$char_lookhead =		10;
$char_lookbody =		10;
$char_looklegs =		10;
$char_lookfeet =		10;
$char_town =			1;

// head, neck, container, armor, right hand, left hand, legs, feet, ring, ammo 	 
$pids = array(1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$sid = 10; 	 
$char_items = array(); 	 
$char_items[11] = array('slot' => 3, 'item_type' => 1988, 'count' => 1); 	 
$char_items[12] = array('slot' => 4, 'item_type' => 2650, 'count' => 1); 	 
$char_items[13] = array('slot' => 5, 'item_type' => 2382, 'count' => 1); 	 
$char_items[14] = array('slot' => 6, 'item_type' => 2050, 'count' => 1); 	 
$char_items[15] = array('slot' => 11, 'item_type' => 2674, 'count' => 2); 	 

$char_maglevel_none = 25;
$char_health_none = 8;
$char_mana_none = 4;

$char_maglevel_sorcerer = "";
$char_health_sorcerer = "";
$char_mana_sorcerer = "";

$char_maglevel_druid = "";
$char_health_druid = "";
$char_mana_druid = "";

$char_maglevel_paladin = "";
$char_health_paladin = "";
$char_mana_paladin = "";

$char_maglevel_knight = "";
$char_health_knight = "";
$char_mana_knight = "";
?>
