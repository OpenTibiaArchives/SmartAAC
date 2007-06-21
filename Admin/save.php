<?
include "../conf.php";
// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	echo 'You are not logged in.<br /><br />
	<a href="login.html" title="Login">Login</a>';
}
// Logged in
else
{
	include_once('../conf.php');
	include "../Includes/resources.php";
	$save = $_GET['save'];

	$aac_status = "Installed";
	/* Evaluation of booleans */
	$aac_md5passwords = ($aac_md5passwords) ? "true" : "false";
	$aac_imgver = ($aac_imgver) ? "true" : "false";
	$main_downloads_warning = ($main_downloads_warning) ? "true" : "false";
	$modules_charsearch = ($modules_charsearch) ? "true" : "false";
	$modules_feedback = ($modules_feedback) ? "true" : "false";
	$modules_affliates = ($modules_affliates) ? "true" : "false";
	$modules_guilds = ($modules_guilds) ? "true" : "false";
	$modules_houses = ($modules_houses) ? "true" : "false";
	$modules_highscores = ($modules_highscores) ? "true" : "false";
	$modules_infopage = ($modules_infopage) ? "true" : "false";
	$modules_serverstats = ($modules_serverstats) ? "true" : "false";
	$modules_downloads = ($modules_downloads) ? "true" : "false";
	$modules_bannedplayers = ($modules_bannedplayers) ? "true" : "false";
	$modules_commands = ($modules_commands) ? "true" : "false";
	$modules_rules = ($modules_rules) ? "true" : "false";
	$modules_voting = ($modules_voting) ? "true" : "false";
	$modules_custom = ($modules_custom) ? "true" : "false";
	$modules_videos = ($modules_videos) ? "true" : "false";
	$modules_gallery = ($modules_gallery) ? "true" : "false";
	$modules_monsters = ($modules_monsters) ? "true" : "false";
	$modules_spells = ($modules_spells) ? "true" : "false";
	$main_enable_feedback = ($main_enable_feedback) ? "true" : "false";
	$char_rook = ($char_rook) ? "true" : "false";
	
	$new_main_towns = 'array(';
	foreach($main_towns as $id => $town) {
		$new_main_towns .= $id . ' => \'' . $town . '\', ';
	}
	$new_main_towns .= ')';
	
	$new_char_items = array();
	foreach($char_items as $arr) {
		foreach($arr as $k) {
			$new_char_items[$arr] = "array('slot' => ". $k['slot'] .", 'item_type' => ". $k['item_type'] .", 'count' => ". $k['count'] .")";
		}
	}
	
	if($char_rook == "true")
	{
			$char_maglevel_none = $char_maglevel_none;
			$char_health_none = $char_health_none;
			$char_mana_none = $char_mana_none;
			
			$char_maglevel_sorcerer = '""';
			$char_health_sorcerer = '""';
			$char_mana_sorcerer = '""';
			$char_maglevel_druid = '""';
			$char_health_druid = '""';
			$char_mana_druid = '""';
			$char_maglevel_paladin = '""';
			$char_health_paladin = '""';
			$char_mana_paladin = '""';
			$char_maglevel_knight = '""';
			$char_health_knight = '""';
			$char_mana_knight = '""';
	}
	elseif($char_rook == "false")
	{
			$char_maglevel_none = '""';
			$char_health_none = '""';
			$char_mana_none = '""';
					
			$char_maglevel_sorcerer = $char_maglevel_sorcerer;
			$char_health_sorcerer = $char_health_sorcerer;
			$char_mana_sorcerer = $char_mana_sorcerer;
			
			$char_maglevel_druid = $char_maglevel_druid;
			$char_health_druid = $char_health_druid;
			$char_mana_druid = $char_mana_druid;
				
			$char_maglevel_paladin = $char_maglevel_paladin;
			$char_health_paladin = $char_health_paladin;
			$char_mana_paladin = $char_mana_paladin;
		
			$char_maglevel_knight = $char_maglevel_knight;
			$char_health_knight = $char_health_knight;
			$char_mana_knight = $char_mana_knight;
	}
		
	// Change variables here if we wanted it to happen
	switch($save)
	{
		case "security":
		$aac_md5passwords =				($_POST["HashPass"]) ? "true" : "false";
		$aac_imgver = 					($_POST["ImgVer"]) ? "true" : "false";
		$main_downloads_warning =		($_POST["DownloadsWarning"]) ? "true" : "false";
		break;
		
		case "modules":
		$modules_charsearch =			($_POST['CharSearch']) ? "true" : "false";
		$modules_feedback =				($_POST['Feedback']) ? "true" : "false";
		$modules_affliates =			($_POST['Affliates']) ? "true" : "false";
		$modules_guilds =				($_POST['Guilds']) ? "true" : "false";
		$modules_houses =				($_POST['Houses']) ? "true" : "false";
		$modules_highscores =			($_POST['Highscores']) ? "true" : "false";
		$modules_infopage =				($_POST['InfoPage']) ? "true" : "false";
		$modules_serverstats =			($_POST['ServerStats']) ? "true" : "false";
		$modules_downloads =			($_POST['DownloadsPage']) ? "true" : "false";
		$modules_bannedplayers =		($_POST['BannedPlayers']) ? "true" : "false";
		$modules_commands =				($_POST['InGameCommands']) ? "true" : "false";
		$modules_rules =				($_POST['RulesPage']) ? "true" : "false";
		$modules_voting =				($_POST['VotePage']) ? "true" : "false";
		$modules_custom =				($_POST['Custom']) ? "true" : "false";
		$modules_videos =				($_POST['Videos']) ? "true" : "false";
		$modules_gallery =				($_POST['Gallery']) ? "true" : "false";
		$modules_monsters =				($_POST['Monsters']) ? "true" : "false";
		$modules_spells =				($_POST['Spells']) ? "true" : "false";
		break;
		
		case "sql":
		$sql_host =			$_POST["SQL_Host"];
		$sql_user =			$_POST["SQL_User"];
		$sql_pass = 		$_POST["SQL_Pass"];
		$sql_db = 			$_POST["SQL_DB"];
		break;
		
		case "stats":
		$aac_servername = 		$_POST["ServerName"];
		$net_ipaddress =		$_POST["HostName"];
		$net_port = 			$_POST["HostPort"];
		$info_os =			    $_POST["HostOS"];
		$info_connection =		$_POST["HostConnection"];
		$info_uptimetype =		$_POST["HostUptime"];
		break;
		
		case "renewvote":
		$main_votequestion = 	$_POST["VoteQuestion"];
		$main_voteanswer1 = 	$_POST["Answer1"];
		$main_voteanswer2 = 	$_POST["Answer2"];
		$main_voteanswer3 = 	$_POST["Answer3"];
		$main_voteanswer4 = 	$_POST["Answer4"];
		break;
		
		case "resetvotestat":
		$voteFile = fopen("../Includes/vote/results.txt", "w");
		$writeVote = "0	0	0	0	0	0	0	0	0	";
		fwrite($voteFile, $writeVote);
		fclose($voteFile);
		break;
		
		case "fieldlens":
		$aac_minacclen = 		$_POST["MinAccLen"];
		$aac_maxacclen = 		$_POST["MaxAccLen"];
		$aac_minpasslen = 		$_POST["MinPassLen"];
		$aac_maxpasslen = 		$_POST["MaxPassLen"];
		$aac_minplayerlen =		$_POST["MinPlayerLen"];
		$aac_maxplayerlen =		$_POST["MaxPlayerLen"];
		break;
		
		case "playerlvls":
		if($char_rook == "true")
		{
			$char_maglevel_none = $_POST["char_maglevel_none"];
			$char_health_none = $_POST["char_health_none"];
			$char_mana_none = $_POST["char_mana_none"];
			
			$char_maglevel_sorcerer = '""';
			$char_health_sorcerer = '""';
			$char_mana_sorcerer = '""';
			$char_maglevel_druid = '""';
			$char_health_druid = '""';
			$char_mana_druid = '""';
			$char_maglevel_paladin = '""';
			$char_health_paladin = '""';
			$char_mana_paladin = '""';
			$char_maglevel_knight = '""';
			$char_health_knight = '""';
			$char_mana_knight = '""';
		}
		elseif($char_rook == "false")
		{
			$char_maglevel_none = '""';
			$char_health_none = '""';
			$char_mana_none = '""';
						
			$char_maglevel_sorcerer = $_POST["char_maglevel_sorcerer"];
			$char_health_sorcerer = $_POST["char_health_sorcerer"];
			$char_mana_sorcerer = $_POST["char_mana_sorcerer"];
		
			$char_maglevel_druid = $_POST["char_maglevel_druid"];
			$char_health_druid = $_POST["char_health_druid"];
			$char_mana_druid = $_POST["char_mana_druid"];
		
			$char_maglevel_paladin = $_POST["char_maglevel_paladin"];
			$char_health_paladin = $_POST["char_health_paladin"];
			$char_mana_paladin = $_POST["char_mana_paladin"];
		
			$char_maglevel_knight = $_POST["char_maglevel_knight"];
			$char_health_knight = $_POST["char_health_knight"];
			$char_mana_knight = $_POST["char_mana_knight"];
		}
		break;
		
		case "switchplayerlvls":
		$char_rook = ($_POST['SwitchLevels']) ? "true" : "false";
		break;
			
		case "towns":
		$new_main_towns = 'array(';
		for($i=1; $i <= $_POST['Towns']; $i++) {
			$new_main_towns .= $i . ' => \'' . $_POST["Town$i"] . '\', ';
		}
		$new_main_towns .= ')';
		break;

		case "items":
		$new_char_items = array();
		$slots = array(1 => 'head', 'neck', 'container', 'armor', 'right', 'left', 'legs', 'feet', 'ring', 'ammo');
		$x = 11;
		for($i=1; $i <= 10; $i++) {
			if((int)$_POST[$slots[$i]] == 0)
				continue;
			$new_char_items[$x] = "array('slot' => $i, 'item_type' => ". (int)$_POST[$slots[$i]] .", 'count' => 1)";
			$x++;
		}
		// Todo: BP-items
		break;
		
		case "maintenance":
		$aac_status_1a =	($_POST['MaintenanceMode']) ? "true" : "false";
		if($aac_status_1a == "true")
		{
			$aac_status = "Maintenance";
		}
		else
		{
			$aac_status = "Installed";
		}
		break;
		
		case "changeadmincreds":
		$admin_user = $_POST['adminuser'];
		$admin_pass = $_POST['adminpass'];
		break;
		
		case "resetadminpass":
		$admin_pass = createRandomPassword();
		break;
		
		case "dirs":
		$aac_dataDir = $_POST['DirPath'];
		break;
		
		case "others":
		$aac_servername = $_POST['ServerName'];
		$main_highscores_result = $_POST['HighscoresResult'];
		$char_exp = $_POST['StartEXP'];
		$char_cap = $_POST['StartCAP'];
		$char_level = $_POST['StartLevel'];
		$char_lookhead = $_POST['StartLookhead'];
		$char_lookbody = $_POST['StartLookbody'];
		$char_looklegs = $_POST['StartLooklegs'];
		$char_lookfeet = $_POST['StartLookfeet'];
		$char_town = $_POST['StartTown'];
		$aac_mapname = $_POST['MapName'];
		break;
	}

	$confFile = fopen("../conf.php", "w");
	$timeCreated = date('r');

	$write = "<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	Configuration Created: $timeCreated
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

\$aac_status = 			\"$aac_status\";
\$aac_version = 			\"2.0 Alpha 2\";
\$aac_versioncode = 		199;
\$aac_dataDir =			\"$aac_dataDir\";
\$aac_mapname =			\"$aac_mapname\";

\$aac_minacclen = 		$aac_minacclen;
\$aac_maxacclen = 		$aac_maxacclen;
\$aac_minpasslen = 		$aac_minpasslen;
\$aac_maxpasslen = 		$aac_maxpasslen;
\$aac_minplayerlen =	$aac_minplayerlen;
\$aac_maxplayerlen =	$aac_maxplayerlen;

\$aac_servername = 		\"$aac_servername\";
\$net_ipaddress =		\"$net_ipaddress\";
\$net_port = 			\"$net_port\";

\$aac_md5passwords =	$aac_md5passwords;
\$aac_imgver = 			$aac_imgver;
\$main_downloads_warning = $main_downloads_warning;
\$admin_user =			\"$admin_user\";
\$admin_pass = 			\"$admin_pass\";

\$sql_host =			\"$sql_host\";
\$sql_user =			\"$sql_user\";
\$sql_pass = 			\"$sql_pass\";
\$sql_db = 				\"$sql_db\";

\$main_highscores_result = 	20;
\$main_ugrp_nolist =		2;
\$main_votequestion = \"$main_votequestion\";
\$main_voteanswer1 = \"$main_voteanswer1\";
\$main_voteanswer2 = \"$main_voteanswer2\";
\$main_voteanswer3 = \"$main_voteanswer3\";
\$main_voteanswer4 = \"$main_voteanswer4\";
\$main_enable_feedback = $main_enable_feedback;
\$main_mail = \"$main_mail\";
\$main_towns = $new_main_towns;

\$info_os =				\"$info_os\";
\$info_connection =		\"$info_connection\";
\$info_uptimetype =		\"$info_uptimetype\";

\$modules_charsearch = $modules_charsearch;
\$modules_feedback = $modules_feedback;
\$modules_affliates = $modules_affliates;
\$modules_guilds = $modules_guilds;
\$modules_houses = $modules_houses;
\$modules_highscores = $modules_highscores;
\$modules_infopage = $modules_infopage;
\$modules_serverstats = $modules_serverstats;
\$modules_downloads = $modules_downloads;
\$modules_bannedplayers = $modules_bannedplayers;
\$modules_commands = $modules_commands;
\$modules_rules = $modules_rules;
\$modules_voting = $modules_voting;
\$modules_custom = $modules_custom;
\$modules_videos = $modules_videos;
\$modules_gallery = $modules_gallery;
\$modules_monsters = $modules_monsters;
\$modules_spells = $modules_spells;

\$char_rook =			$char_rook;
\$char_group =			$char_group;
\$char_exp =			$char_exp;
\$char_cap =			$char_cap;
\$char_level =			$char_level;
\$char_lookhead =		$char_lookhead;
\$char_lookbody =		$char_lookbody;
\$char_looklegs =		$char_looklegs;
\$char_lookfeet =		$char_lookfeet;
\$char_town =			$char_town;

\$pids = array(1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
\$sid = 10; 	 
\$char_items = array();
";
foreach($new_char_items as $arr) {
	$write .= "\$char_items[$arr] = $new_char_items[$arr];";
}
// head, neck, container, armor, right hand, left hand, legs, feet, ring, ammo 	 

$write .= "
\$char_maglevel_none = $char_maglevel_none;
\$char_health_none = $char_health_none;
\$char_mana_none = $char_mana_none;

\$char_maglevel_sorcerer = $char_maglevel_sorcerer;
\$char_health_sorcerer = $char_health_sorcerer;
\$char_mana_sorcerer = $char_mana_sorcerer;

\$char_maglevel_druid = $char_maglevel_druid;
\$char_health_druid = $char_health_druid;
\$char_mana_druid = $char_mana_druid;

\$char_maglevel_paladin = $char_maglevel_paladin;
\$char_health_paladin = $char_health_paladin;
\$char_mana_paladin = $char_mana_paladin;

\$char_maglevel_knight = $char_maglevel_knight;
\$char_health_knight = $char_health_knight;
\$char_mana_knight = $char_mana_knight;
?>
";

	fwrite($confFile, $write);
	fclose($confFile);

	echo "File written <a href=\"index.php\">Go to index</a>";
}
?>