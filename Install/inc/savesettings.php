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
	$conf_mapname =			$_POST["MapName"];

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
	$conf_showemails =		($_POST["ShowEmails"]) ? "true" : "false";
	$conf_pickaccno =		($_POST["PickAccNo"]) ? "true" : "false";
	$conf_enable_mailer =	$_POST['main_enable_mailer'];
	$conf_main_email = 		$_POST['main_email'];
	$conf_admin_user = 		$_POST['AdminUser'];
	$conf_admin_pass = 		$_POST['AdminPass'];
	
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
	$conf_modules_Custom =				($_POST['Custom']) ? "true" : "false";
	$conf_modules_Videos =				($_POST['Videos']) ? "true" : "false";
	$conf_modules_Gallery =				($_POST['Gallery']) ? "true" : "false";
	$conf_modules_Monsters =			($_POST['Monsters']) ? "true" : "false";
	$conf_modules_Spells =				($_POST['Spells']) ? "true" : "false";

	$char_rook_use = 		$_POST['char_rook'];
	$conf_char_town =		$_POST["char_town"];
	$conf_char_group =		$_POST["char_group"];
	$conf_char_max =		$_POST["MaxChars"];
	$conf_char_exp =		$_POST["char_exp"];
	$conf_char_cap =		$_POST["char_cap"];
	$conf_char_level =		$_POST["char_level"];
	$conf_char_lookhead =	$_POST["char_lookhead"];
	$conf_char_lookbody =	$_POST["char_lookbody"];
	$conf_char_looklegs =	$_POST["char_looklegs"];
	$conf_char_lookfeet =	$_POST["char_lookfeet"];
	
	if($char_rook_use == "true")
	{

		$conf_char_maglevel_none = (int)$_POST["char_maglevel_none"];
		$conf_char_health_none = (int)$_POST["char_health_none"];
		$conf_char_mana_none = (int)$_POST["char_mana_none"];
		
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
		
		
		$conf_char_maglevel_sorcerer = (int)$_POST["char_maglevel_sorcerer"];
		$conf_char_health_sorcerer = (int)$_POST["char_health_sorcerer"];
		$conf_char_mana_sorcerer = (int)$_POST["char_mana_sorcerer"];
	
	
		$conf_char_maglevel_druid = (int)$_POST["char_maglevel_druid"];
		$conf_char_health_druid = (int)$_POST["char_health_druid"];
		$conf_char_mana_druid = (int)$_POST["char_mana_druid"];
		
	
		$conf_char_maglevel_paladin = (int)$_POST["char_maglevel_paladin"];
		$conf_char_health_paladin = (int)$_POST["char_health_paladin"];
		$conf_char_mana_paladin = (int)$_POST["char_mana_paladin"];
	
	
		$conf_char_maglevel_knight = (int)$_POST["char_maglevel_knight"];
		$conf_char_health_knight = (int)$_POST["char_health_knight"];
		$conf_char_mana_knight = (int)$_POST["char_mana_knight"];
	}

	$conf_host =			$_POST["SQL_Host"];
	$conf_user =			$_POST["SQL_User"];
	$conf_pass =			$_POST["SQL_Pass"];
	$conf_db =				$_POST["SQL_DB"];

	$conf_os =			    $_POST["HostOS"];
	$conf_connection =		$_POST["HostConnection"];
	$conf_uptimetype =		$_POST["HostUptime"];
	
	$sqlconnect = mysql_connect($conf_host, $conf_user, $conf_pass) or die('Couldn\'t connect to MySQL server: '.mysql_error().' ('.mysql_errno().')');
	mysql_select_db($conf_db, $sqlconnect) or die('Couldn\'t select MySQL database: '.mysql_error().' ('.mysql_errno().')');
	
	// Create table "guild_invites"
	$guild_invites_drop = 'DROP TABLE IF EXISTS `guild_invites`';
	$guild_invites = 'CREATE TABLE `guild_invites` (
	`player_id` INT NOT NULL ,
	`guild_id` INT NOT NULL,
	FOREIGN KEY (`player_id`) REFERENCES `players` (`id`),
	FOREIGN KEY (`guild_id`) REFERENCES `guilds` (`id`)
	)';
	$recoveryExist = 1;
	mysql_query('SELECT `recovery` FROM `accounts LIMIT 1 ;`') or $recoveryExist = 0;
	$recoveryField = 'ALTER TABLE `accounts` ADD `recovery` VARCHAR(255) NULL ;';

	mysql_query($guild_invites_drop) or die('MySQL error: '.mysql_error().'('.mysql_errno().')');
	mysql_query($guild_invites) or die('Couldn\'t create MySQL table guild_invites: '.mysql_error().' ('.mysql_errno().')');
	if($recoveryExist = 1)
		mysql_query($recoveryField) or die('Couldn\'t create MySQL field in accounts table, "recovery": '.mysql_error().' ('.mysql_errno().')<br /><br />(Already got a field called "recovery"? Drop it, empty or something. And go back a step.)');
	
	// End: Create table "guild_invites"

	$confFile = fopen("../conf.php", "w");
	$timeCreated = date('r');

	$write = "<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0.0
//	Configuration Created: $timeCreated
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
\$aac_status = 					\"Installed\";
\$aac_version = 					\"2.0.2\";
\$aac_versioncode = 				202;
\$aac_dataDir =					\"$conf_dataDir\";
\$aac_worldDirName = 			\"world\";
\$aac_monstersDirName =			\"monster\";
\$aac_spellsDirName =			\"spells\";
\$aac_mapname =					\"$conf_mapname\";
\$aac_maintenanceReason =		\"<p>No reason set.</p>\";
\$aac_layout = 					\"Indigo\";

# Lengths of commonly used fields in the AAC
\$aac_maxplayers =				$conf_char_max;
\$aac_minacclen = 				$conf_minacclen;
\$aac_maxacclen = 				$conf_maxacclen;
\$aac_minpasslen = 				$conf_minpasslen;
\$aac_maxpasslen = 				$conf_maxpasslen;
\$aac_minplayerlen =				$conf_minplayerlen;
\$aac_maxplayerlen =				$conf_maxplayerlen;

# Used to get statistical information for your site. E.G. Players online, peak, max, etc
\$aac_servername = 				\"$conf_servername\";
\$net_ipaddress =				\"$conf_ipaddress\";
\$net_port = 					\"$conf_port\";

# Security switches and username/password
\$aac_md5passwords =				$conf_md5passwords;
\$aac_imgver = 					$conf_imgver;
\$main_downloads_warning =		$conf_downloadswarning;
\$main_showemails = 				$conf_showemails;
\$aac_randomaccnum =				$conf_pickaccno;
\$admin_user =					\"$conf_admin_user\";
\$admin_pass = 					\"$conf_admin_pass\";

# MySQL Server connection credentials to get into the MySQL server and use your otserv database
\$sql_host =						\"$conf_host\";
\$sql_user =						\"$conf_user\";
\$sql_pass = 					\"$conf_pass\";
\$sql_db = 						\"$conf_db\";

# Settings for Highscores, Voting, Feedback mail, Towns
\$main_highscores_result =		20;
\$main_ugrp_nolist =				2;
\$main_votequestion = 				\"What should the server add?\";
\$main_voteanswer1 = 				\"More monsters\";
\$main_voteanswer2 = 				\"More hunting areas\";
\$main_voteanswer3 = 				\"More houses\";
\$main_voteanswer4 = 				\"New towns\";
\$main_enable_mailer = 			$conf_enable_mailer;
\$main_mail = 					\"$conf_main_email\";
\$main_towns =					array(1 => 'Town 1', 2 => 'Town 2', 3 => 'Town 3', 4 => 'Town 4', 5 => 'Town 5');

# Information for the statistics page, is not used with the AAC, and not exactly important
\$info_os =						\"$conf_os\";
\$info_connection =				\"$conf_connection\";
\$info_uptimetype =				\"$conf_uptimetype\";

# Modules for the AAC, can be enabled/disabled from the admin panel
\$modules_charsearch = 			$conf_modules_CharSearch;
\$modules_feedback = 			$conf_modules_Feedback;
\$modules_affliates = 			$conf_modules_Affliates;
\$modules_guilds = 				$conf_modules_Guilds;
\$modules_houses = 				$conf_modules_Houses;
\$modules_highscores = 			$conf_modules_Highscores;
\$modules_infopage = 			$conf_modules_InfoPage;
\$modules_serverstats = 			$conf_modules_ServerStats;
\$modules_downloads = 			$conf_modules_DownloadsPage;
\$modules_bannedplayers = 		$conf_modules_BannedPlayers;
\$modules_commands = 			$conf_modules_InGameCommands;
\$modules_rules = 				$conf_modules_RulesPage;
\$modules_voting = 				$conf_modules_VotePage;
\$modules_custom = 				$conf_modules_Custom;
\$modules_videos = 				$conf_modules_Videos;
\$modules_gallery = 				$conf_modules_Gallery;
\$modules_monsters = 			$conf_modules_Monsters;
\$modules_spells = 				$conf_modules_Spells;

# Character settings
\$char_rook =					$char_rook_use;
\$char_group =					$conf_char_group;
\$char_exp =						$conf_char_exp;
\$char_cap =						$conf_char_cap;
\$char_level =					$conf_char_level;
\$char_lookhead =				$conf_char_lookhead;
\$char_lookbody =				$conf_char_lookbody;
\$char_looklegs =				$conf_char_looklegs;
\$char_lookfeet =				$conf_char_lookfeet;
\$char_town =					$conf_char_town;

# Character item settings
// head, neck, container, armor, right hand, left hand, legs, feet, ring, ammo 	 
\$pids = 						array(1 => 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
\$sid = 							10; 	 
\$char_items = 					array(); 	 
\$char_items[11] = 				array('slot' => 3, 'item_type' => 1988, 'count' => 1); 	 
\$char_items[12] = 				array('slot' => 4, 'item_type' => 2650, 'count' => 1); 	 
\$char_items[13] = 				array('slot' => 5, 'item_type' => 2382, 'count' => 1); 	 
\$char_items[14] = 				array('slot' => 6, 'item_type' => 2050, 'count' => 1); 	 
\$char_items[15] = 				array('slot' => 11, 'item_type' => 2674, 'count' => 2); 	 

# Character levels (Magic, HP, Mana)
\$char_maglevel_none = 			$conf_char_maglevel_none;
\$char_health_none =				$conf_char_health_none;
\$char_mana_none = 				$conf_char_mana_none;

\$char_maglevel_sorcerer = 		$conf_char_maglevel_sorcerer;
\$char_health_sorcerer = 		$conf_char_health_sorcerer;
\$char_mana_sorcerer = 			$conf_char_mana_sorcerer;

\$char_maglevel_druid = 			$conf_char_maglevel_druid;
\$char_health_druid = 			$conf_char_health_druid;
\$char_mana_druid = 				$conf_char_mana_druid;

\$char_maglevel_paladin = 		$conf_char_maglevel_paladin;
\$char_health_paladin = 			$conf_char_health_paladin;
\$char_mana_paladin = 			$conf_char_mana_paladin;

\$char_maglevel_knight =			$conf_char_maglevel_knight;
\$char_health_knight = 			$conf_char_health_knight;
\$char_mana_knight = 			$conf_char_mana_knight;
?>
";

	fwrite($confFile, $write);
	fclose($confFile);
	
	////// End Conf saving
	////// Start News user/pass saving in con-junction
	
	$encryptedAdminPass = crypt($conf_admin_pass);
	$newsUserFile = fopen("../Admin/news/data/users.txt", "w");
	$write2 = "
<user>
0
$conf_admin_user
$encryptedAdminPass
</user>";
	
	fwrite($newsUserFile, $write2);
	fclose($newsUserFile);
	
	$enc_pass = crypt($conf_admin_pass);
	$htpasswdFile = fopen("../Admin/logs/.htpasswd", "w");
	$write2 = "$conf_admin_user:$enc_pass";
	fwrite($htpasswdFile, $write2);
	fclose($htpasswdFile);
	
	// End: Saving
	
	// Start: End Interface, if successful
	
	$tpl->set('title', $title);
	$tpl->set('strayline', $name);
	$tpl->set('bodySpecial', $bodySpecial);
	$tpl->set('documentation', $documentation);

	echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');

	echo "
	<h2>Installed</h2>
	<p><b>- Made guild_invites table in database<br />
	- Made recovery field in accounts table in database<br />
	- Wrote configuration (conf.php)</b><br /></p>
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