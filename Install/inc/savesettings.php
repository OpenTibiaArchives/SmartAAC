<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
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

if(file_exists("../installLock.txt"))
{
    header("location: forbidden.php");
}
else
{
	$title = 'Installation->Configuration Saving';
	$name = 'Smart-Ass';
	$bodySpecial = 'onload="openAlert()"';
	$documentation = file_get_contents('inc/savesettings.inc');

	include_once('../Includes/Templates/bTemplate.php');
	$tpl = new bTemplate();


	$conf_dataDir =			$_POST["dataDir"];
	$conf_mapname =		$_POST["MapName"];

	$conf_minacclen = 		$_POST["MinAccLen"];
	$conf_maxacclen = 		$_POST["MaxAccLen"];
	$conf_minpasslen = 		$_POST["MinPassLen"];
	$conf_maxpasslen = 		$_POST["MaxPassLen"];
	$conf_minplayerlen =	$_POST["MinPlayerLen"];
	$conf_maxplayerlen =	$_POST["MaxPlayerLen"];

	$conf_servername = 		$_POST["ServerName"];
	$conf_ipaddress =		$_POST["HostName"];
	$conf_port = 			$_POST["HostPort"];

	$conf_md5passwords =	($_POST["HashPass"]) ? "true" : "false";
	$conf_imgver = 			($_POST["ImgVer"]) ? "true" : "false";
	$conf_downloadswarning =($_POST["DownloadsWarning"]) ? "true" : "false";
	$conf_enable_feedback =	$_POST['main_enable_feedback'];
	$conf_main_email = 		$_POST['main_email'];
	
	$conf_modules_CharSearch =			($_POST['CharSearch']) ? "true" : "false";
	$conf_modules_Feedback =			($_POST['Feedback']) ? "true" : "false";
	$conf_modules_Affliates =			($_POST['Affliates']) ? "true" : "false";
	$conf_modules_Guilds =				($_POST['Guilds']) ? "true" : "false";
	$conf_modules_Houses =				($_POST['Houses']) ? "true" : "false";
	$conf_modules_Highscores =			($_POST['Highscores']) ? "true" : "false";
	$conf_modules_InfoPage =			($_POST['InfoPage']) ? "true" : "false";
	$conf_modules_ServerStats =			($_POST['ServerStats']) ? "true" : "false";
	$conf_modules_DownloadsPage =		($_POST['DownloadsPage']) ? "true" : "false";
	$conf_modules_BannedPlayers =		($_POST['BannedPlayers']) ? "true" : "false";
	$conf_modules_InGameCommands =		($_POST['InGameCommands']) ? "true" : "false";
	$conf_modules_RulesPage =			($_POST['RulesPage']) ? "true" : "false";
	$conf_modules_VotePage =			($_POST['VotePage']) ? "true" : "false";

	$char_rook_use = 		$_POST['char_rook'];
	$conf_char_town =		$_POST["char_town"];
	$conf_char_group =		$_POST["char_group"];
	$conf_char_exp =		$_POST["char_exp"];
	$conf_char_cap =		$_POST["char_cap"];
	$conf_char_level =		$_POST["char_level"];
	$conf_char_lookhead =	$_POST["char_lookhead"];
	$conf_char_lookbody =	$_POST["char_lookbody"];
	$conf_char_looklegs =	$_POST["char_looklegs"];
	$conf_char_lookfeet =	$_POST["char_lookfeet"];
	
	if($char_rook_use == "true")
	{
		$conf_char_maglevel_none = $_POST["char_maglevel_none"];
		$conf_char_health_none = $_POST["char_health_none"];
		$conf_char_mana_none = $_POST["char_mana_none"];
		
		$conf_char_maglevel_sorcerer = '""';
		$conf_char_health_sorcerer = '""';
		$conf_char_mana_sorcerer = '""';
		$conf_char_maglevel_druid = '""';
		$conf_char_health_druid = '""';
		$conf_char_mana_druid = '""';
		$conf_char_maglevel_paladin = '""';
		$conf_char_health_paladin = '""';
		$conf_char_mana_paladin = '""';
		$conf_char_maglevel_knight = '""';
		$conf_char_health_knight = '""';
		$conf_char_mana_knight = '""';
	}
	elseif($char_rook_use == "false")
	{
		$conf_char_maglevel_none = '""';
		$conf_char_health_none = '""';
		$conf_char_mana_none = '""';
		
		$conf_char_maglevel_sorcerer = $_POST["char_maglevel_sorcerer"];
		$conf_char_health_sorcerer = $_POST["char_health_sorcerer"];
		$conf_char_mana_sorcerer = $_POST["char_mana_sorcerer"];
	
		$conf_char_maglevel_druid = $_POST["char_maglevel_druid"];
		$conf_char_health_druid = $_POST["char_health_druid"];
		$conf_char_mana_druid = $_POST["char_mana_druid"];
	
		$conf_char_maglevel_paladin = $_POST["char_maglevel_paladin"];
		$conf_char_health_paladin = $_POST["char_health_paladin"];
		$conf_char_mana_paladin = $_POST["char_mana_paladin"];
	
		$conf_char_maglevel_knight = $_POST["char_maglevel_knight"];
		$conf_char_health_knight = $_POST["char_health_knight"];
		$conf_char_mana_knight = $_POST["char_mana_knight"];
	}

	if(isset($_POST['SQL_Pass']))
	{
		$conf_host =			$_POST["SQL_Host"];
		$conf_user =			$_POST["SQL_User"];
		$conf_pass = 			$_POST["SQL_Pass"];
		$conf_db = 			$_POST["SQL_DB"];
	}
	else
	{
		$conf_host =		"";
		$conf_user =		"";
		$conf_user =		"";
		$conf_db =		"";
	}

	$conf_os =			    $_POST["HostOS"];
	$conf_connection =		$_POST["HostConnection"];
	$conf_uptimetype =		$_POST["HostUptime"];

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

\$aac_status = 			\"Installed\";
\$aac_version = 			\"2.0 Alpha 2\";
\$aac_versioncode = 		199;
\$aac_dataDir =			\"$conf_dataDir\";
\$aac_mapname =			\"$conf_mapname\";

\$aac_minacclen = 		$conf_minacclen;
\$aac_maxacclen = 		$conf_maxacclen;
\$aac_minpasslen = 		$conf_minpasslen;
\$aac_maxpasslen = 		$conf_maxpasslen;
\$aac_minplayerlen =	$conf_minplayerlen;
\$aac_maxplayerlen =	$conf_maxplayerlen;

\$aac_servername = 		\"$conf_servername\";
\$net_ipaddress =		\"$conf_ipaddress\";
\$net_port = 			\"$conf_port\";

\$aac_md5passwords =	$conf_md5passwords;
\$aac_imgver = 			$conf_imgver;
\$main_downloads_warning = $conf_downloadswarning;

\$sql_host =			\"$conf_host\";
\$sql_user =			\"$conf_user\";
\$sql_pass = 			\"$conf_pass\";
\$sql_db = 				\"$conf_db\";

\$main_highscores_result = 	20;
\$main_ugrp_nolist =		2;
\$main_votequestion = \"What should the server add?\";
\$main_voteanswer1 = \"More monsters\";
\$main_voteanswer2 = \"More hunting areas\";
\$main_voteanswer3 = \"More houses\";
\$main_voteanswer4 = \"New towns\";
\$main_enable_feedback = $conf_enable_feedback;
\$main_mail = \"$conf_main_email\";
\$main_towns = array(1 => 'Town 1', 2 => 'Town 2', 3 => 'Town 3', 4 => 'Town 4', 5 => 'Town 5');

\$info_os =				\"$conf_os\";
\$info_connection =		\"$conf_connection\";
\$info_uptimetype =		\"$conf_uptimetype\";

\$modules_charsearch = $conf_modules_CharSearch;
\$modules_feedback = $conf_modules_Feedback;
\$modules_affliates = $conf_modules_Affliates;
\$modules_guilds = $conf_modules_Guilds;
\$modules_houses = $conf_modules_Houses;
\$modules_highscores = $conf_modules_Highscores;
\$modules_infopage = $conf_modules_InfoPage;
\$modules_serverstats = $conf_modules_ServerStats;
\$modules_downloads = $conf_modules_DownloadsPage;
\$modules_bannedplayers = $conf_modules_BannedPlayers;
\$modules_commands = $conf_modules_InGameCommands;
\$modules_rules = $conf_modules_RulesPage;
\$modules_voting = $conf_modules_VotePage;

\$char_rook =			$char_rook_use;
\$char_group =			$conf_char_group;
\$char_exp =			$conf_char_exp;
\$char_cap =			$conf_char_cap;
\$char_level =			$conf_char_level;
\$char_lookhead =		$conf_char_lookhead;
\$char_lookbody =		$conf_char_lookbody;
\$char_looklegs =		$conf_char_looklegs;
\$char_lookfeet =		$conf_char_lookfeet;
\$char_town =			$conf_char_town;

\$char_maglevel_none = $conf_char_maglevel_none;
\$char_health_none = $conf_char_health_none;
\$char_mana_none = $conf_char_mana_none;

\$char_maglevel_sorcerer = $conf_char_maglevel_sorcerer;
\$char_health_sorcerer = $conf_char_health_sorcerer;
\$char_mana_sorcerer = $conf_char_mana_sorcerer;

\$char_maglevel_druid = $conf_char_maglevel_druid;
\$char_health_druid = $conf_char_health_druid;
\$char_mana_druid = $conf_char_mana_druid;

\$char_maglevel_paladin = $conf_char_maglevel_paladin;
\$char_health_paladin = $conf_char_health_paladin;
\$char_mana_paladin = $conf_char_mana_paladin;

\$char_maglevel_knight = $conf_char_maglevel_knight;
\$char_health_knight = $conf_char_health_knight;
\$char_mana_knight = $conf_char_mana_knight;
?>
";

	fwrite($confFile, $write);
	fclose($confFile);
	
	// End: Saving
	
	// Start: End Interface, if successful
	
	$tpl->set('title', $title);
	$tpl->set('strayline', $name);
	$tpl->set('bodySpecial', $bodySpecial);
	$tpl->set('documentation', $documentation);

	echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');

	echo "
	<h2>Saved</h2>
	
	<p>Go forward</p>
	<div align=\"center\">
	<form action=\"install.php?step=6\" method=\"post\">
	<br><input type=\"submit\" value=\"Next\" class=\"btn\"/>
	</form></div>
	";

	echo '
	<script type="text/javascript">
	  function openAlert() {
	   Dialog.alert("<h1>Saved</h1><br><p>The Smart-Ass configuration has been saved successfully.</p>", {windowParameters: {className: "alphacube"}})
	  }
		</script>
	';

	echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
	echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
}
?>