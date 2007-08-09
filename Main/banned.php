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

$title = 'Banned Players';
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

if($modules_bannedplayers)
{
	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
	mysql_select_db($sql_db, $sqlconnect);

	echo '
	<h1>Banned Players</h1><br />
	<table style="text-align: left; width: 50%; font-size:14px;" border="0" cellpadding="1" cellspacing="2">
	  <tbody>
	    <tr class="tableheaders">
	      <td style="width: 20%; text-align: center;"><b>Ban Type</b></td>
	      <td style="width: 50%; text-align: center;"><b>Player Name</b></td>
	      <td style="width: 40%; text-align: center;"><b>Until</b></td>
	    </tr>
	  </tbody>';
		$query = sqlquery('SELECT `type`, `player`, `time` FROM `bans` ORDER BY `time` ASC');
		$types = array(1 => 'IP', 2 => 'Account', 3 => 'Player');
		$total_bans = 0;
		while($row = mysql_fetch_array($query)) {
			echo '
			<tr class="lolhover">
			<td><center>'. $types[$row['type']] .'</center></td>
			<td><center><a href="character.php?char='. userFromID($row['player']) .'">'. userFromID($row['player']) .'</a></center></td>
			<td><center>'. date('M d Y, H:i:s T', $row['time']) .'</center></td>
			</tr>
			';
			$total_bans++;
		}
		if($total_bans == 0) {
			echo '<tr class="lolhover"><td><center>(None)</center></td></tr>';
		}
	echo '</table>';
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>