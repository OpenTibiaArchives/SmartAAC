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
	$use_rook = $_POST['char_rook'];

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
		width: 145px;
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

		<form action=\"install.php?step=5\" method=\"post\">
		<h1>MySQL Database Details</h1>
		<label for=\"SQL_Host\">MySQL Host:</label>
		<input type=\"text\" name=\"SQL_Host\" value=\"\" /><br />

		<label for=\"SQL_User\">MySQL User:</label>
		<input type=\"text\" name=\"SQL_User\" value=\"\" /><br />

		<label for=\"SQL_Pass\">MySQL Password:</label>
		<input type=\"password\" name=\"SQL_Pass\" value=\"\" /><br />

		<label for=\"SQL_DB\">MySQL Database:</label>
		<input type=\"text\" name=\"SQL_DB\" value=\"\" /><br />
		<br /><br />

		<h1>Directories</h1>
		<label for=\"dataDir\">Data dir:</label>
		<input type=\"text\" name=\"dataDir\" value=\"data/\" /><br /><br />

		<h1>Security Options</h1>
		<label for=\"HashPass\">Use MD5 passwords?</label>
		<input type=\"checkbox\" name=\"HashPass\" class=\"boxes\" /><br /><br />

		<label for=\"ImgVer\">Image verification?</label>
		<input type=\"checkbox\" name=\"ImgVer\" class=\"boxes\" /><br />
		<br /><br />

		<h1>Other Server Details</h1>
		<label for=\"ServerName\">Server Name:</label>
		<input type=\"text\" name=\"ServerName\" value=\"\" /><br />

		<label for=\"HostName\">IP/Hostname:</label>
		<input type=\"text\" name=\"HostName\" value=\"\" /><br />

		<label for=\"HostPort\">Port:</label>
		<input type=\"text\" name=\"HostPort\" value=\"\" /><br />

		<label for=\"HostOS\">Operating System:</label>
		<input type=\"text\" name=\"HostOS\" value=\"\" /><br />

		<label for=\"HostConnection\">Connection Type:</label>
		<input type=\"text\" name=\"HostConnection\" value=\"\" /><br />

		<label for=\"HostUptime\">Uptime Aim:</label>
		<input type=\"text\" name=\"HostUptime\" value=\"\" /><br />
		<br /><br />

		<h1>Common Fields</h1>
		<label for=\"MinAccLen\">Min Account Number Length:</label>
		<input type=\"text\" name=\"MinAccLen\" value=\"6\" /><br />
		<label for=\"MaxAccLen\">Max Account Number Length:</label>
		<input type=\"text\" name=\"MaxAccLen\" value=\"8\" /><br /><br />

		<label for=\"MinPassLen\">Min Password Length:</label>
		<input type=\"text\" name=\"MinPassLen\" value=\"3\" /><br />
		<label for=\"MaxPassLen\">Max Password Length:</label>
		<input type=\"text\" name=\"MaxPassLen\" value=\"15\" /><br /><br />

		<label for=\"MinPlayerLen\">Min Playername Length:</label>
		<input type=\"text\" name=\"MinPlayerLen\" value=\"4\" /><br />
		<label for=\"MaxPlayerLen\">Max Playername Length:</label>
		<input type=\"text\" name=\"MaxPlayerLen\" value=\"20\" /><br />
		<br /><br />
		
		<h1>Character settings</h1>
		<label for=\"char_group\">Group ID:</label>
		<input type=\"text\" name=\"char_group\" value=\"1\" /><br />
		<label for=\"char_exp\">Experience:</label>
		<input type=\"text\" name=\"char_exp\" value=\"98800\" /><br />
		<label for=\"char_cap\">Cap:</label>
		<input type=\"text\" name=\"char_cap\" value=\"500\" /><br />
		<label for=\"char_level\">Level:</label>
		<input type=\"text\" name=\"char_level\" value=\"20\" /><br />
		<label for=\"char_lookhead\">Head color:</label>
		<input type=\"text\" name=\"char_lookhead\" value=\"10\" /><br />
		<label for=\"char_lookbody\">Body color:</label>
		<input type=\"text\" name=\"char_lookbody\" value=\"10\" /><br />
		<label for=\"char_looklegs\">Legs color:</label>
		<input type=\"text\" name=\"char_looklegs\" value=\"10\" /><br />
		<label for=\"char_lookfeet\">Feet color:</label>
		<input type=\"text\" name=\"char_lookfeet\" value=\"10\" /><br />
		<label for=\"char_town\">Town ID:</label>
		<input type=\"text\" name=\"char_town\" value=\"1\" /><br /><br />
		";

		if($use_rook == "true")
		{
			echo "	
			<label for=\"char_maglevel_none\">No vocation Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_none\" value=\"\" /><br />
			<label for=\"char_health_none\">No vocation Health:</label>
			<input type=\"text\" name=\"char_health_none\" value=\"\" /><br />
			<label for=\"char_mana_none\">No vocation Mana:</label>
			<input type=\"text\" name=\"char_mana_none\" value=\"\" /><br />
		";
		}
		elseif($use_rook == "false")
		{
			echo "	
			<label for=\"char_maglevel_sorcerer\">Sorcerer Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_sorcerer\" value=\"\" /><br />
			<label for=\"char_health_sorcerer\">Sorcerer Health:</label>
			<input type=\"text\" name=\"char_health_sorcerer\" value=\"\" /><br />
			<label for=\"char_mana_sorcerer\">Sorcerer Mana:</label>
			<input type=\"text\" name=\"char_mana_sorcerer\" value=\"\" /><br />
			
			<label for=\"char_maglevel_druid\">Druid Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_druid\" value=\"\" /><br />
			<label for=\"char_health_druid\">Druid Health:</label>
			<input type=\"text\" name=\"char_health_druid\" value=\"\" /><br />
			<label for=\"char_mana_druid\">Druid Mana:</label>
			<input type=\"text\" name=\"char_mana_druid\" value=\"\" /><br />
			
			<label for=\"char_maglevel_paladin\">Paladin Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_paladin\" value=\"\" /><br />
			<label for=\"char_health_paladin\">Paladin Health:</label>
			<input type=\"text\" name=\"char_health_paladin\" value=\"\" /><br />
			<label for=\"char_mana_paladin\">Paladin Mana:</label>
			<input type=\"text\" name=\"char_mana_paladin\" value=\"\" /><br />
			
			<label for=\"char_maglevel_knight\">Knight Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_knight\" value=\"\" /><br />
			<label for=\"char_health_knight\">Knight Health:</label>
			<input type=\"text\" name=\"char_health_knight\" value=\"\" /><br />
			<label for=\"char_mana_knight\">Knight Mana:</label>
			<input type=\"text\" name=\"char_mana_knight\" value=\"\" /><br />
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