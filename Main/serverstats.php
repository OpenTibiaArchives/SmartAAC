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

$title = 'Server Statistics';
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

if($modules_serverstats)
{
	echo '<h1>Info</h1><br />';
	@$fp = fsockopen ($ip, 7171, $errno, $errstr, 1);
	if (!$fp)
	{
		echo '<p>The server is offline or there is a problem contacting the server, I cannot get information.</p>';
	}
	else
	{
		echo '
		<table style="text-align: left; width: 450px;" border="0"
		 cellpadding="2" cellspacing="2">
		  <tbody>
		    <tr>
		      <td style="width: 225px;"><b>Uptime</b></td>
		      <td style="width: 500px;"><b>' . $days . '</b> Days, <b>' . $hours . '</b> Hours, <b>' . $minutes . '</b> Minutes and <b>' . $seconds . '</b> Seconds</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Players online</b></td>
		      <td style="width: 300px;">' . $info['online'] . ' of ' . $info['max'] . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Peak</b></td>
		      <td style="width: 300px;">' . $info['peak'] . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Server location</b></td>
		      <td style="width: 300px;">' . $info['location'] . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Protocol version</b></td>
		      <td style="width: 300px;">' . $info['version'] . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Monsters Spawned</b></td>
		      <td style="width: 300px;">' . $info['totalmonsters'] . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;">&nbsp;</td>
		      <td style="width: 300px;">&nbsp;</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Administrator</b></td>
		      <td style="width: 300px;">' . $info['name'] . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Administrator email</b></td>
		      <td style="width: 300px;">' . $info['email'] . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;">&nbsp;</td>
		      <td style="width: 300px;">&nbsp;</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>OS</b></td>
		      <td style="width: 300px;">' . $info_os . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Connection</b></td>
		      <td style="width: 300px;">' . $info_connection . '</td>
		    </tr>
		    <tr>
		      <td style="width: 225px;"><b>Uptime Type</b></td>
		      <td style="width: 300px;">' . $info_uptimetype . '</td>
		    </tr>
		  </tbody>
		</table>
		';
	}
}
else
{
echo "<h1>Module has been disabled by the admin</h1>";
}

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>