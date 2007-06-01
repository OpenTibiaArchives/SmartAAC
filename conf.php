<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	Configuration Created: Fri, 01 Jun 2007 00:58:14 +0100
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

$aac_status = 			"Not Installed";
$aac_version = 			"2.0 Alpha 2";
$aac_versioncode = 		199;
$aac_dataDir =			"C:\\Dev-Cpp\\otserv\\data";
$aac_mapname =			"map";

$aac_minacclen = 		6;
$aac_maxacclen = 		8;
$aac_minpasslen = 		3;
$aac_maxpasslen = 		15;
$aac_minplayerlen =	4;
$aac_maxplayerlen =	20;

$aac_servername = 		"TestName";
$net_ipaddress =		"localhost";
$net_port = 			"7171";

$aac_md5passwords =	false;
$aac_imgver = 			false;
$main_downloads_warning = false;

$sql_host =			"localhost";
$sql_user =			"root";
$sql_pass = 			"";
$sql_db = 				"otserv";

$main_highscores_result = 	20;
$main_ugrp_nolist =		2;
$main_votequestion = "What should the server add?";
$main_voteanswer1 = "More monsters";
$main_voteanswer2 = "More hunting areas";
$main_voteanswer3 = "More houses";
$main_voteanswer4 = "New towns";
$main_enable_feedback = false;
$main_mail = "none@none.nodomain";
$main_towns = array(1 => 'Town 1', 2 => 'Town 2', 3 => 'Town 3', 4 => 'Town 4', 5 => 'Town 5');

$info_os =				"Windows XP";
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

$char_rook =			false;
$char_group =			1;
$char_exp =			98800;
$char_cap =			500;
$char_level =			20;
$char_lookhead =		10;
$char_lookbody =		10;
$char_looklegs =		10;
$char_lookfeet =		10;
$char_town =			1;

$char_maglevel_none = "";
$char_health_none = "";
$char_mana_none = "";

$char_maglevel_sorcerer = 100;
$char_health_sorcerer = 100;
$char_mana_sorcerer = 100;

$char_maglevel_druid = 100;
$char_health_druid = 100;
$char_mana_druid = 100;

$char_maglevel_paladin = 100;
$char_health_paladin = 100;
$char_mana_paladin = 100;

$char_maglevel_knight = 100;
$char_health_knight = 100;
$char_mana_knight = 100;
?>
