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
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';

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

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

if($modules_bannedplayers)
{
	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
	mysql_select_db($sql_db, $sqlconnect);

	echo '
	<center><h2>Banned Players:</h2><br><br>
	<table style="text-align: left; width: 50%;" border="1" cellpadding="0" cellspacing="2">
	  <tbody>
	    <tr>
	      <td style="width: 10%;">Ban Type</td>
	      <td style="width: 50%;">Player Name</td>
	      <td style="width: 40%;">Until</td>
	    </tr>
	  </tbody>';
		$query = sqlquery('SELECT `type`, `player`, `time` FROM `bans` ORDER BY `time` ASC');
		$types = array(1 => 'IP', 2 => 'Account', 3 => 'Player');
		while($row = mysql_fetch_array($query)) {
			echo '
			<tr>
			<td><center>'. $types[$row['type']] .'</center></td>
			<td><center><a href="character.php?char='. userFromID($row['player']) .'">'. userFromID($row['player']) .'</a></center></td>
			<td><center>'. date('M d Y, H:i:s T', $row['time']) .'</center></td>
			</tr>
			';
		}
	echo '</table></center>';
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>