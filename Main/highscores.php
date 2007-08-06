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

session_start();
include '../conf.php';
include '../Includes/resources.php';
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';
if($aac_status == "Maintenance")
{
	header("location: maintenance.php");
}

$title = 'Highscores';
$name = $aac_servername;
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

if($modules_highscores)
{
	echo "<h1>Highscores</h1><br />";
	
	if(isset($_GET['page']) && is_numeric($_GET['page']) && is_numeric($main_highscores_result)) {
		$page = $_GET['page'];
	}
	else {
		$page = 1;
	}

	$tempskill = $_GET['skill'];

	if(isset($tempskill)) {
		$skill = skills($tempskill);
	}
	else {
		$skill = "level";
	}
	?>

	<td width="13%" valign="top"><table width="130" border="0" align="right" cellpadding="2" cellspacing="1">
	<tr><td><div align="center"><a href="highscores.php">Level</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=magic">Magic level</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=fist">Fist fighting</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=club">Club fighting</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=sword">Sword fighting</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=axe">Axe fighting</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=distance">Distance fighting</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=shielding">Shielding</a></td></div></tr>
	<tr><td><div align="center"><a href="highscores.php?skill=fishing">Fishing</a></td></div></tr>
	</table>

	<table style="text-align: left; width: 50%; font-size:14px;" border="0"
	 cellpadding="0" cellspacing="2">
	  <tbody>
	    <tr class="tableheaders">
	      <td style="width: 14%; text-align: center;"><b>Rank</b></td>
	      <td style="width: 50%; text-align: center;"><b>Player Name</b></td>
	      <td style="width: 15%; text-align: center;"><b>Level</b></td>
		  <?php if($skill == "level"){
	      echo '<td style="width: 25%; text-align: center;"><b>Points</b></td>';
		   } ?>
	    </tr>
	  </tbody>
	<?php
	highscore($skill, $page);
	echo '</table><br />';
	if ($page != 1)
	echo "<a href=\"highscores.php?skill=$skill&page=". intval($page - 1) ."\">Rank ". intval(($page - 2) * $main_highscores_result + 1) ." - ". intval(($page - 1) * $main_highscores_result) ."</a> -- ";
	echo "<a href=\"highscores.php?skill=$skill&page=". intval($page + 1) ."\">Rank ". intval($page * $main_highscores_result + 1) ." - ". intval(($page + 1) * $main_highscores_result) ."</a>";
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>