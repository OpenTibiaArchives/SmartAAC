<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	Configuration Created: Wed, 02 May 2007 00:09:19 +0100
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
$aac_version = 		"2.0 Alpha1";
$aac_dataDir =			"data/";

$aac_minacclen = 		6;
$aac_maxacclen = 		8;
$aac_minpasslen = 		3;
$aac_maxpasslen = 		15;
$aac_minplayerlen =	4;
$aac_maxplayerlen =	20;

$aac_servername = 		"";
$net_ipaddress =		"";
$net_port = 			"";

$aac_md5passwords =	false;
$aac_imgver = 			false;

$aac_type =			"Manager";
$sql_host =			"127.0.0.1";
$sql_user =			"root";
$sql_pass = 			"PASSWORD";
$sql_db = 				"otserv";

$info_os =				"";
$info_connection =		"";
$info_uptimetype =		"";

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