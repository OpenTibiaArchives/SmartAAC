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
if($aac_status == "Maintenance")
{
	header("location: maintenance.php");
}


$xml_data = file_get_contents($aac_dataDir . '/world/'. $aac_mapname .'-house.xml');

$title = 'Houses';
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

if($modules_houses)
{
	$xml = simplexml_load_string($xml_data);
	$xml2 = new SimpleXMLElementExtended($xml_data);

	echo "<h1>Houses</h1><br />";

	if (file_exists($aac_dataDir . '/world/'. $aac_mapname .'-house.xml'))
	{
		echo '
		<div class="tableforme">
		<table style="text-align: left; width: 500px; font-size:14px;" border="0"
		 cellpadding="4" cellspacing="3">
		  <tbody>
		    <tr class="tableheaders">
		      <td style="width: 139px; text-align: center;"><b>ID</b></td>
		      <td style="width: 124px; text-align: center;"><b>House name</b></td>
		      <td style="width: 124px; text-align: center;"><b>Town</b></td>
		      <td style="width: 124px; text-align: center;"><b>Rent</b></td>
		      <td style="width: 124px; text-align: center;"><b>Size</b></td>
		    </tr>
			<tr>
		      <td style="width: 139px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		    </tr>
		';

		$scan_limit = $xml2->getChildrenCount();

		for($i = 0; $i < $scan_limit; $i++)
		{
			echo '<tr class="lolhover">';
			echo '<td style="width: 135px; text-align: center;">#' . $xml2->house[$i]->getAttribute('houseid') . '</td>';
			echo '<td style="width: 200px;">' . $xml2->house[$i]->getAttribute('name') . '</td>';
			echo '<td style="width: 124px; text-align: center;">' . $main_towns[$xml2->house[$i]->getAttribute('townid')] . '</td>';
			echo '<td style="width: 124px; text-align: center;">' . $xml2->house[$i]->getAttribute('rent') . ' gp</td>';
			echo '<td style="width: 124px; text-align: center;">' . $xml2->house[$i]->getAttribute('size') . ' sqm</td>';
			echo '</tr>';
		}
	echo "</tbody></table></div>";
	echo "<br /><p><b>There are $i houses for this server.</b></p><br />";
	}
	else
	{
	    exit('Failed to open the houses file.');
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