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
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';

// Not logged in
if(!isset($_COOKIE["logged_in"]) || $_COOKIE["logged_in"] == "")
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Towns';
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

	echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

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
		
		#submitbutton2{
		margin-left: 120px;
		margin-top: 5px;
		width: 200px;
		}

		br{
		clear: left;
		}
		</style>

		<form action=\"save.php?save=others\" method=\"POST\">
		<label for=\"ServerName\">Servername:</label>
		<input type=\"text\" name=\"ServerName\" value=\"$aac_servername\" /><br />
		<label for=\"HighscoresResult\">Highscores results:</label>
		<input type=\"text\" name=\"HighscoresResult\" value=\"$main_highscores_result\" /><br />
		<label for=\"StartEXP\">Start EXP:</label>
		<input type=\"text\" name=\"StartEXP\" value=\"$char_exp\" /><br />
		<label for=\"StartCAP\">Start CAP:</label>
		<input type=\"text\" name=\"StartCAP\" value=\"$char_cap\" /><br />
		<label for=\"StartLevel\">Start Level:</label>
		<input type=\"text\" name=\"StartLevel\" value=\"$char_level\" /><br />
		<label for=\"StartLookhead\">Look->Head:</label>
		<input type=\"text\" name=\"StartLookhead\" value=\"$char_lookhead\" /><br />
		<label for=\"StartLookbody\">Look->Body:</label>
		<input type=\"text\" name=\"StartLookbody\" value=\"$char_lookbody\" /><br />
		<label for=\"StartLooklegs\">Look->Legs:</label>
		<input type=\"text\" name=\"StartLooklegs\" value=\"$char_looklegs\" /><br />
		<label for=\"StartLookfeet\">Look->Feet:</label>
		<input type=\"text\" name=\"StartLookfeet\" value=\"$char_lookfeet\" /><br />
		<label for=\"StartTown\">Start town:</label>
		<input type=\"text\" name=\"StartTown\" value=\"$char_town\" /><br />
		<br />
		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Change\" />
		</form>
		";

	echo $tpl->fetch('../Includes/Templates/Indigo/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
}
?>