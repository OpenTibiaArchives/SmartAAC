<?PHP
include "../conf.php";
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
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Player Levels';
	$name = 'Admin Panel';
	$bodySpecial = 'onload="NOTHING"';

	include_once('../Includes/Templates/bTemplate.php');
	$tpl = new bTemplate();

	$tpl->set('title', $title);
	$tpl->set('strayline', $name);
	$tpl->set('bodySpecial', $bodySpecial);
	$tpl->set('stats', $global_stats);
	$tpl->set('AAC_Version', $aac_version);
	$tpl->set('Total_Visits', $total);
	$tpl->set('Unique_Visits', $total_uniques);

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');

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

		<form action=\"save.php?save=switchplayerlvls\" method=\"POST\">
		<label for=\"SwitchLevels\">Using Rook?</label>
			<input type=\"checkbox\" name=\"SwitchLevels\" class=\"boxes\" /><br />
			<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Change\" />
		<br />
		</form>
		
		<br /><br />
		
		<form action=\"save.php?save=playerlvls\" method=\"POST\">
";
		if($char_rook == true)
		{
			echo "
			<label for=\"char_maglevel_none\">No vocation Magic Level:</label>
			<input type=\"text\" name=\"char_maglevel_none\" value=\"$char_maglevel_none\" /><br />
			<label for=\"char_health_none\">No vocation Health:</label>
			<input type=\"text\" name=\"char_health_none\" value=\"$char_health_none\" /><br />
			<label for=\"char_mana_none\">No vocation Mana:</label>
			<input type=\"text\" name=\"char_mana_none\" value=\"$char_mana_none\" /><br />
			";
		}
		elseif($char_rook == false)
		{
			echo "
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
			<br /><br />
			";
		}
		echo "			<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Change\" />
			<br />
		</form>
		";

	$adminSidebar = true;
	include "../Includes/Templates/$aac_layout/sidebar.php";
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>