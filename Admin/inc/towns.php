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
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
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

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');

	$actNow = $_GET['now'];
	if(isset($actNow))
	{
		$total_towns = count($main_towns);
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

		<h1>Towns</h1>
		<p>Towns have been successfully detected in your mapfile.</p>
		
		<br />
		<h2>Detected towns</h2>
		<br />
		<form action=\"save.php?save=towns\" method=\"POST\">
		";
		include '../Includes/SpawnsReader.php';
		include '../conf.php';
		$mapfile = $aac_dataDir.'/world/'.$aac_mapname.'.otbm';
		$towns = new SpawnsReader($mapfile);
		$town = 0;
		foreach($towns as $id => $name) {
			echo "Town $id: $name\n";
			echo "<label for=\"Town$id\"></label><input type=\"hidden\" name=\"Town$id\" value=\"$name\" /><br />";
			$town++;
		}
		echo "
		<label for=\"Towns\"></label><input type=\"hidden\" name=\"Towns\" value=\"".$town."\" /><br />

		<br /><br />
		
		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Update\" />
			<br />
		</form>
		";
	}
	else
	{
		echo '<p>Smart-Ass can detect what towns you have in your map which is situated in your data directory, press detect below to get the towns.<br /><br /><b>Note: This could take time (depending on the size of the mapfile), also please ensure maximum execution time is enough.</b><br /><br /></p>';
	
		echo '<form action="admin.php?action=Towns&now=now" method="POST">
		<input type="submit" value="Detect" />
		</form>';
	}

	$adminSidebar = true;
	include "../Includes/Templates/$aac_layout/sidebar.php";
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>