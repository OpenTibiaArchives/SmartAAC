<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	
//	USE OF THIS PROGRAM TO RELY ON IT FOR SERVER USE IS NOT
// 	RECOMMENDED! THIS IS FOR TESTING ONLY.
//
//	Main setup for the system
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
include '../conf.php';
include '../Includes/resources.php';

if(file_exists("../installLock.txt"))
{
    header("location: forbidden.php");
}
else
{
	$title = 'Installation->Main Installation';
	$name = 'Smart-Ass';
	$bodySpecial = 'onload="openAlert()"';
	$documentation = file_get_contents('inc/maininstall.inc');

	include_once('../Includes/Templates/bTemplate.php');
	$tpl = new bTemplate();

	$tpl->set('title', $title);
	$tpl->set('strayline', $name);
	$tpl->set('bodySpecial', $bodySpecial);
	$tpl->set('documentation', $documentation);

	echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');


	$license_decide = $_POST['agreeordisagree'];
	$char_rook = $_POST['char_rook'];
	$main_enable_mailer = $_POST['main_enable_mailer'];
	$admin_pass_generated = createRandomPassword();
	$currentWorkingDir = getcwd();
	
 	if($license_decide == "Disagree")
	{
		echo '<script type="text/javascript">
	  function openAlert() {
	   Dialog.alert("<h1>You cannot use this software</h1><br><p>You have declined to agree with the license this software is with, therefore you cannot use this software.</p>", {windowParameters: {className: "alphacube"}})
	  }
	  openAlert();
		</script>';
	}
	elseif($license_decide == "Agree")
	{ 
 		$error = $_GET['error'];
		$errors =
		array(
			'noTown' => 'You have to type in a Town ID!',
			'ble' => 'bla'
		);
		
		if(strlen($errors[$error]) > 0){
			echo "<font color=\"red\" size=\"4\">Error: $errors[$error]</font>";
		}

		echo "
		<style type=\"text/css\">

		label{
		float: left;
		width: 220px;
		font-weight: bold;
		font-size: 12px;
		}

		input, textarea{
		width: 180px;
		margin-bottom: 5px;
		}

		textarea{
		width: 250px;
		height: 150px;
		}

		.boxes{
		width: 3em;
		}

		#submitbutton{
		margin-left: 120px;
		margin-top: 5px;
		width: 90px;
		}

		br{
		clear: left;
		}
		</style>

		<form action=\"install.php?step=5\" method=\"POST\">
		<input type=\"hidden\" name=\"char_rook\" value=\"$char_rook\">
		<input type=\"hidden\" name=\"main_enable_mailer\" value=\"$main_enable_mailer\">
		
		<h1>MySQL Database Details</h1>
		<label for=\"SQL_Host\">MySQL Host:</label>
		<input type=\"text\" name=\"SQL_Host\" value=\"$sql_host\" /><br />

		<label for=\"SQL_User\">MySQL User:</label>
		<input type=\"text\" name=\"SQL_User\" value=\"$sql_user\" /><br />

		<label for=\"SQL_Pass\">MySQL Password:</label>
		<input type=\"password\" name=\"SQL_Pass\" value=\"$sql_pass\" /><br />

		<label for=\"SQL_DB\">MySQL Database:</label>
		<input type=\"text\" name=\"SQL_DB\" value=\"$sql_db\" /><br />
		<br /><br />

		<h1>Directories</h1>
		<label for=\"dataDir\">OTServ data dir:</label>
		<input type=\"text\" name=\"dataDir\" value=\"$aac_dataDir\" /><br />
		<i>Current working directory: $currentWorkingDir</i><br /><br />

		<h1>Security Options</h1>
		<label for=\"HashPass\">Use MD5 hash passwords?</label>
		<input type=\"checkbox\" name=\"HashPass\" class=\"boxes\" /><br />

		<label for=\"ImgVer\">Image verification?</label>
		<input type=\"checkbox\" name=\"ImgVer\" class=\"boxes\" /><br />
		
		<label for=\"DownloadsWarning\">Display downloads warnings?</label>
		<input type=\"checkbox\" name=\"DownloadsWarning\" class=\"boxes\" /><br />
		
		<label for=\"ShowEmails\">Show players emails?</label>
		<input type=\"checkbox\" name=\"ShowEmails\" class=\"boxes\" /><br />
		
		<label for=\"PickAccNo\">Auto generate acc numbers?</label>
		<input type=\"checkbox\" name=\"PickAccNo\" class=\"boxes\" /><br /><br />
		
		<label for=\"AdminUser\">Admin Username:</label>
		<input type=\"text\" name=\"AdminUser\" value=\"$admin_user\" /><br />
		
		<label for=\"AdminPass\">Admin Password:</label>
		<input type=\"text\" name=\"AdminPass\" value=\"$admin_pass_generated\" /><br /><br />
		<br /><br />
		";
		
		if($main_enable_feedback == "true")
		{
			echo "
			<h1>Feedback Settings:</h2>
			<label for=\"main_email\">Your email:</label>
			<input type=\"text\" name=\"main_email\" value=\"$main_email\" /><br /><br />
			";
		}
		elseif($main_enable_feedback == "false")
		{
			echo "
			<input type=\"hidden\" name=\"main_email\" value=\"none@none.nodomain\" />
			";
		}
		
		echo "
		<h1>Other Server Details</h1>
		<label for=\"ServerName\">Server Name:</label>
		<input type=\"text\" name=\"ServerName\" value=\"$aac_servername\" /><br />

		<label for=\"HostName\">IP/Hostname:</label>
		<input type=\"text\" name=\"HostName\" value=\"$net_ipaddress\" /><br />

		<label for=\"HostPort\">Port:</label>
		<input type=\"text\" name=\"HostPort\" value=\"$net_port\" /><br />

		<label for=\"HostOS\">Operating System:</label>
		<input type=\"text\" name=\"HostOS\" value=\"$info_os\" /><br />

		<label for=\"HostConnection\">Connection Type:</label>
		<input type=\"text\" name=\"HostConnection\" value=\"$info_connection\" /><br />

		<label for=\"HostUptime\">Uptime Aim:</label>
		<input type=\"text\" name=\"HostUptime\" value=\"$info_uptimetype\" /><br />
		<br /><br />

		<h1>Common Fields</h1>
		<label for=\"MinAccLen\">Min Account Number Length:</label>
		<input type=\"text\" name=\"MinAccLen\" value=\"$aac_minacclen\" /><br />
		<label for=\"MaxAccLen\">Max Account Number Length:</label>
		<input type=\"text\" name=\"MaxAccLen\" value=\"$aac_maxacclen\" /><br /><br />

		<label for=\"MinPassLen\">Min Password Length:</label>
		<input type=\"text\" name=\"MinPassLen\" value=\"$aac_minpasslen\" /><br />
		<label for=\"MaxPassLen\">Max Password Length:</label>
		<input type=\"text\" name=\"MaxPassLen\" value=\"$aac_maxpasslen\" /><br /><br />

		<label for=\"MinPlayerLen\">Min Playername Length:</label>
		<input type=\"text\" name=\"MinPlayerLen\" value=\"$aac_minplayerlen\" /><br />
		<label for=\"MaxPlayerLen\">Max Playername Length:</label>
		<input type=\"text\" name=\"MaxPlayerLen\" value=\"$aac_maxplayerlen\" /><br />
		<br /><br />
		
		<h1>Map name</h1>
		<label for=\"MapName\">Name:</label>
		<input type=\"text\" name=\"MapName\" value=\"$aac_mapname\" /><br />
		
		<h1>Character settings</h1>
		<label for=\"char_group\">Group ID:</label>
		<input type=\"text\" name=\"char_group\" value=\"$char_group\" /><br />
		<label for=\"MaxChars\">Max chars allowed:</label>
		<input type=\"text\" name=\"MaxChars\" value=\"$aac_maxplayers\" /><br />
		<label for=\"char_exp\">Experience:</label>
		<input type=\"text\" name=\"char_exp\" value=\"$char_exp\" /><br />
		<label for=\"char_cap\">Cap:</label>
		<input type=\"text\" name=\"char_cap\" value=\"$char_cap\" /><br />
		<label for=\"char_level\">Level:</label>
		<input type=\"text\" name=\"char_level\" value=\"$char_level\" /><br />
		<label for=\"char_lookhead\">Head color:</label>
		<input type=\"text\" name=\"char_lookhead\" value=\"$char_lookhead\" /><br />
		<label for=\"char_lookbody\">Body color:</label>
		<input type=\"text\" name=\"char_lookbody\" value=\"$char_lookbody\" /><br />
		<label for=\"char_looklegs\">Legs color:</label>
		<input type=\"text\" name=\"char_looklegs\" value=\"$char_looklegs\" /><br />
		<label for=\"char_lookfeet\">Feet color:</label>
		<input type=\"text\" name=\"char_lookfeet\" value=\"$char_lookfeet\" /><br />
		<label for=\"char_town\">Town ID:</label>
		<input type=\"text\" name=\"char_town\" value=\"$char_town\" /><br /><br />
		
		<h1>Modules</h1>
		<label for=\"CharSearch\">Char search:</label>
		<input type=\"checkbox\" name=\"CharSearch\" class=\"boxes\" /><br />
		<label for=\"Feedback\">Feedback page:</label>
		<input type=\"checkbox\" name=\"Feedback\" class=\"boxes\" /><br />
		<label for=\"Affliates\">Affliates page:</label>
		<input type=\"checkbox\" name=\"Affliates\" class=\"boxes\" /><br />
		<label for=\"Guilds\">Guilds:</label>
		<input type=\"checkbox\" name=\"Guilds\" class=\"boxes\" /><br />
		<label for=\"Houses\">Houses:</label>
		<input type=\"checkbox\" name=\"Houses\" class=\"boxes\" /><br />
		<label for=\"Highscores\">Highscores:</label>
		<input type=\"checkbox\" name=\"Highscores\" class=\"boxes\" /><br />
		<label for=\"InfoPage\">Info page:</label>
		<input type=\"checkbox\" name=\"InfoPage\" class=\"boxes\" /><br />
		<label for=\"ServerStats\">Server stats:</label>
		<input type=\"checkbox\" name=\"ServerStats\" class=\"boxes\" /><br />
		<label for=\"DownloadsPage\">Downloads page:</label>
		<input type=\"checkbox\" name=\"DownloadsPage\" class=\"boxes\" /><br />
		<label for=\"BannedPlayers\">Banned players:</label>
		<input type=\"checkbox\" name=\"BannedPlayers\" class=\"boxes\" /><br />
		<label for=\"InGameCommands\">In-game commands page:</label>
		<input type=\"checkbox\" name=\"InGameCommands\" class=\"boxes\" /><br />
		<label for=\"RulesPage\">Rules page:</label>
		<input type=\"checkbox\" name=\"RulesPage\" class=\"boxes\" /><br />
		<label for=\"VotePage\">Voting:</label>
		<input type=\"checkbox\" name=\"VotePage\" class=\"boxes\" /><br />
		<label for=\"Custom\">Custom page:</label>
		<input type=\"checkbox\" name=\"Custom\" class=\"boxes\" /><br />
		<label for=\"Videos\">Videos page:</label>
		<input type=\"checkbox\" name=\"Videos\" class=\"boxes\" /><br />
		<label for=\"Gallery\">Gallery page:</label>
		<input type=\"checkbox\" name=\"Gallery\" class=\"boxes\" /><br />
		<label for=\"Monsters\">Monsters page:</label>
		<input type=\"checkbox\" name=\"Monsters\" class=\"boxes\" /><br />
		<label for=\"Spells\">Spells page:</label>
		<input type=\"checkbox\" name=\"Spells\" class=\"boxes\" /><br /><br />
		";

		if($char_rook == "true")
		{
			echo "
			<h1>Character Values</h1>
			<label for=\"char_maglevel_none\">No vocation Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_none\" value=\"$char_maglevel_none\" /><br />
			<label for=\"char_health_none\">No vocation Health:</label>
			<input type=\"text\" name=\"char_health_none\" value=\"$char_health_none\" /><br />
			<label for=\"char_mana_none\">No vocation Mana:</label>
			<input type=\"text\" name=\"char_mana_none\" value=\"$char_mana_none\" /><br />
		";
		}
		elseif($char_rook == "false")
		{
			echo "
			<h1>Character Values</h1>
			<label for=\"char_maglevel_sorcerer\">Sorcerer Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_sorcerer\" value=\"$char_maglevel_sorcerer\" /><br />
			<label for=\"char_health_sorcerer\">Sorcerer Health:</label>
			<input type=\"text\" name=\"char_health_sorcerer\" value=\"$char_health_sorcerer\" /><br />
			<label for=\"char_mana_sorcerer\">Sorcerer Mana:</label>
			<input type=\"text\" name=\"char_mana_sorcerer\" value=\"$char_mana_sorcerer\" /><br />
			
			<label for=\"char_maglevel_druid\">Druid Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_druid\" value=\"$char_maglevel_druid\" /><br />
			<label for=\"char_health_druid\">Druid Health:</label>
			<input type=\"text\" name=\"char_health_druid\" value=\"$char_health_druid\" /><br />
			<label for=\"char_mana_druid\">Druid Mana:</label>
			<input type=\"text\" name=\"char_mana_druid\" value=\"$char_mana_druid\" /><br />
			
			<label for=\"char_maglevel_paladin\">Paladin Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_paladin\" value=\"$char_maglevel_paladin\" /><br />
			<label for=\"char_health_paladin\">Paladin Health:</label>
			<input type=\"text\" name=\"char_health_paladin\" value=\"$char_health_paladin\" /><br />
			<label for=\"char_mana_paladin\">Paladin Mana:</label>
			<input type=\"text\" name=\"char_mana_paladin\" value=\"$char_mana_paladin\" /><br />
			
			<label for=\"char_maglevel_knight\">Knight Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_knight\" value=\"$char_maglevel_knight\" /><br />
			<label for=\"char_health_knight\">Knight Health:</label>
			<input type=\"text\" name=\"char_health_knight\" value=\"$char_health_knight\" /><br />
			<label for=\"char_mana_knight\">Knight Mana:</label>
			<input type=\"text\" name=\"char_mana_knight\" value=\"$char_mana_knight\" /><br />
			";
		}

		echo "
		<br /><br />

		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Install\" />
		</form>
		";
		
	}

	echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
	echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
}
?>