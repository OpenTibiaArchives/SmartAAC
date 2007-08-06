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


$xml_data = file_get_contents($aac_dataDir . '/commands.xml');

$title = 'Server Commands';
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

if($modules_commands)
{
	$xml = simplexml_load_string($xml_data);
	$xml2 = new SimpleXMLElementExtended($xml_data);

	echo "<h1>Commands</h1><br />";

	if (file_exists($aac_dataDir . '/commands.xml'))// Check the data dir later on
	{
		echo '
		<table style="text-align: left; width: 283px; font-size:14px;" border="0"
		 cellpadding="4" cellspacing="2">
		  <tbody>
		    <tr class="tableheaders">
		      <td style="width: 139px; text-align: center;"><b>Command</b></td>
		      <td style="width: 124px; text-align: center;"><b>Access Level</b></td>
		    </tr>
			<tr>
		      <td style="width: 139px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		    </tr>
		';
		$total_commands = 0;
		$scan_limit = $xml2->getChildrenCount();

		for($i = 0; $i < $scan_limit; $i++)
		{
			if($xml2->command[$i]->getAttribute('access') == 0)
			{
				echo "<tr class=\"lolhover\">";
				echo '<td style="width: 139px;">' . $xml2->command[$i]->getAttribute('cmd') . '</td>';
				echo '<td style="width: 124px; text-align: center;">' . $xml2->command[$i]->getAttribute('access') . '</td>';
				echo "</tr>";
				
				$total_commands++;
			}
		}
	echo "</tbody></table>";
		if($total_commands == 1)
		{
			echo "<br /><b>There is $total_commands command for this server.</b>";
		}
		else
		{
			echo "<br /><b>There are $total_commands commands for this server.</b>";
		}
	}
	else
	{
	    exit('Failed to open commands.xml.');
	}
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>