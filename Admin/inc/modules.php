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
	$title = 'Modules';
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

		<form action=\"save.php?save=modules\" method=\"POST\">
		<label for=\"CharSearch\">Char search:</label>
		<input type=\"checkbox\" name=\"CharSearch\" class=\"boxes\" "; if($modules_charsearch) { echo "checked"; } echo "/><br />
		<label for=\"Feedback\">Feedback page:</label>
		<input type=\"checkbox\" name=\"Feedback\" class=\"boxes\" "; if($modules_feedback) { echo "checked"; } echo "/><br />
		<label for=\"Affliates\">Affliates page:</label>
		<input type=\"checkbox\" name=\"Affliates\" class=\"boxes\" "; if($modules_affliates) { echo "checked"; } echo "/><br />
		<label for=\"Guilds\">Guilds:</label>
		<input type=\"checkbox\" name=\"Guilds\" class=\"boxes\" "; if($modules_guilds) { echo "checked"; } echo "/><br />
		<label for=\"Houses\">Houses:</label>
		<input type=\"checkbox\" name=\"Houses\" class=\"boxes\" "; if($modules_houses) { echo "checked"; } echo "/><br />
		<label for=\"Highscores\">Highscores:</label>
		<input type=\"checkbox\" name=\"Highscores\" class=\"boxes\" "; if($modules_highscores) { echo "checked"; } echo "/><br />
		<label for=\"InfoPage\">Info page:</label>
		<input type=\"checkbox\" name=\"InfoPage\" class=\"boxes\" "; if($modules_infopage) { echo "checked"; } echo "/><br />
		<label for=\"ServerStats\">Server stats:</label>
		<input type=\"checkbox\" name=\"ServerStats\" class=\"boxes\" "; if($modules_serverstats) { echo "checked"; } echo "/><br />
		<label for=\"DownloadsPage\">Downloads page:</label>
		<input type=\"checkbox\" name=\"DownloadsPage\" class=\"boxes\" "; if($modules_downloads) { echo "checked"; } echo "/><br />
		<label for=\"BannedPlayers\">Banned players:</label>
		<input type=\"checkbox\" name=\"BannedPlayers\" class=\"boxes\" "; if($modules_bannedplayers) { echo "checked"; } echo "/><br />
		<label for=\"InGameCommands\">In-game commands page:</label>
		<input type=\"checkbox\" name=\"InGameCommands\" class=\"boxes\" "; if($modules_commands) { echo "checked"; } echo "/><br />
		<label for=\"RulesPage\">Rules page:</label>
		<input type=\"checkbox\" name=\"RulesPage\" class=\"boxes\" "; if($modules_rules) { echo "checked"; } echo "/><br />
		<label for=\"VotePage\">Voting:</label>
		<input type=\"checkbox\" name=\"VotePage\" class=\"boxes\" "; if($modules_voting) { echo "checked"; } echo "/><br />
		<label for=\"Custom\">Custom page:</label>
		<input type=\"checkbox\" name=\"Custom\" class=\"boxes\" "; if($modules_custom) { echo "checked"; } echo "/><br />
		<label for=\"Videos\">Videos page:</label>
		<input type=\"checkbox\" name=\"Videos\" class=\"boxes\" "; if($modules_videos) { echo "checked"; } echo "/><br />
		<label for=\"Gallery\">Gallery page:</label>
		<input type=\"checkbox\" name=\"Gallery\" class=\"boxes\" "; if($modules_gallery) { echo "checked"; } echo "/><br />
		<label for=\"Monsters\">Monsters page:</label>
		<input type=\"checkbox\" name=\"Monsters\" class=\"boxes\" "; if($modules_monsters) { echo "checked"; } echo "/><br />
		<label for=\"Spells\">Spells page:</label>
		<input type=\"checkbox\" name=\"Spells\" class=\"boxes\" "; if($modules_spells) { echo "checked"; } echo "/><br /><br />
		
		<br />
		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Change\" />
		</form>
		";

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>