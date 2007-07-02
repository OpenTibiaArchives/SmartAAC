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

$xml_data = file_get_contents($aac_dataDir . '/spells/spells.xml');

$title = 'Spells';
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

if($modules_spells)
{
	$xml = simplexml_load_string($xml_data);

	echo "<h1>Spells</h1><br /><br />";

	if (file_exists($aac_dataDir . '/spells/spells.xml'))// Check the data dir later on
	{
		// Instant spells
		echo "<h2>Instant Spells</h2><br />";
		echo '
		<table style="text-align: left; width: 720px; font-size:14px;" border="0" cellpadding="4" cellspacing="2"><tbody>
		<tr class="tableheaders">
	    <td style="width: 280px; text-align: center;"><b>Spell name:</b></td>
	    <td style="width: 400px; text-align: center;"><b>Words:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Mana:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Level:</b></td>
	    <td style="width: 150px; text-align: center;"><b>Magic Level:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Premium:</b></td>
		</tr>
		<tr>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 124px; background: #FFFFFF;">&nbsp;</td>
		</tr>
		';
	
		foreach($xml->instant as $spell)
		{
			if($spell['enabled'] == true)
			{
				echo "<tr class=\"lolhover\">";
				echo "<td style=\"width: 280px;\">".$spell['name']."</td>";
				echo "<td style=\"width: 400px;\">".$spell['words']."</td>";
				if(isset($spell['mana'])) { echo "<td style=\"text-align: center;\">".$spell['mana']."</td>"; } else { echo "<td style=\"text-align: center;\"><i>N/A</i></td>"; }
				if(isset($spell['lvl'])) { echo "<td style=\"text-align: center;\">".$spell['lvl']."</td>"; } else { echo "<td style=\"text-align: center;\"><i>N/A</i></td>"; }
				if(isset($spell['maglv'])) { echo "<td style=\"text-align: center;\">".$spell['maglv']."</td>"; } else { echo "<td style=\"text-align: center;\"><i>N/A</i></td>"; }
				if($spell['prem']==true) { echo "<td style=\"text-align: center;\">Yes</td>"; } else { echo "<td style=\"text-align: center;\">No</td>"; }
				echo "</tr>";
			}
		}
	
		echo '</tbody></table><br /><br />';
		
		// Conjure spells		
		echo "<h2>Conjure Spells</h2><br />";
		echo '
		<table style="text-align: left; width: 720px; font-size:14px;" border="0" cellpadding="4" cellspacing="2"><tbody>
		<tr class="tableheaders"> 
	    <td style="width: 139px; text-align: center;"><b>Spell name:</b></td> 
	    <td style="width: 139px; text-align: center;"><b>Words:</b></td> 
	    <td style="width: 139px; text-align: center;"><b>Mana:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Level:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Magic Level:</b></td> 
	    <td style="width: 139px; text-align: center;"><b>Premium:</b></td>
		</tr>
		<tr>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 124px; background: #FFFFFF;">&nbsp;</td>
		</tr>
		';
	
		foreach($xml->conjure as $spell)
		{
			if($spell['enabled'] == true)
			{
				echo "<tr class=\"lolhover\">";
				echo "<td style=\"width: 280px;\">".$spell['name']."</td>";
				echo "<td style=\"width: 400px;\">".$spell['words']."</td>";
				if(isset($spell['mana'])) { echo "<td style=\"text-align: center;\">".$spell['mana']."</td>"; } else { echo "<td style=\"text-align: center;\">N/A</td>"; }
				if(isset($spell['lvl'])) { echo "<td style=\"text-align: center;\">".$spell['lvl']."</td>"; } else { echo "<td style=\"text-align: center;\">N/A</td>"; }
				if(isset($spell['maglv'])) { echo "<td style=\"text-align: center;\">".$spell['maglv']."</td>"; } else { echo "<td style=\"text-align: center;\">N/A</td>"; }
				if($spell['prem']==true) { echo "<td style=\"text-align: center;\">Yes</td>"; } else { echo "<td style=\"text-align: center;\">No</td>"; }
				echo "</tr>";
			}
		}
	
		echo '</tbody></table><br /><br />';
		
		// Runes available		
		echo "<h2>Runes Available</h2><br />";
		echo '
		<table style="text-align: left; width: 720px; font-size:14px;" border="0" cellpadding="4" cellspacing="2"><tbody>
		<tr class="tableheaders"> 
	    <td style="width: 139px; text-align: center;"><b>Spell name:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Charges:</b></td> 
	    <td style="width: 139px; text-align: center;"><b>Mana:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Level:</b></td>
	    <td style="width: 139px; text-align: center;"><b>Magic Level:</b></td> 
	    <td style="width: 139px; text-align: center;"><b>Premium:</b></td> 
		</tr>
		<tr>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 139px; background: #FFFFFF;">&nbsp;</td>
		      <td style="width: 124px; background: #FFFFFF;">&nbsp;</td>
		</tr>
		';
	
		foreach($xml->rune as $spell)
		{
			if($spell['enabled'] == true)
			{
				echo "<tr class=\"lolhover\">";
				echo "<td style=\"width: 280px;\">".$spell['name']."</td>";
				echo "<td style=\"width: 400px; text-align: center;\">".$spell['charges']."</td>";
				if(isset($spell['mana'])) { echo "<td style=\"text-align: center;\">".$spell['mana']."</td>"; } else { echo "<td style=\"text-align: center;\">N/A</td>"; }
				if(isset($spell['lvl'])) { echo "<td style=\"text-align: center;\">".$spell['lvl']."</td>"; } else { echo "<td style=\"text-align: center;\">N/A</td>"; }
				if(isset($spell['maglv'])) { echo "<td style=\"text-align: center;\">".$spell['maglv']."</td>"; } else { echo "<td style=\"text-align: center;\">N/A</td>"; }
				if($spell['prem']==true) { echo "<td style=\"text-align: center;\">Yes</td>"; } else { echo "<td style=\"text-align: center;\">No</td>"; }
				echo "</tr>";
			}
		}
	
		echo '</tbody></table><br /><br />';
	}
	else
	{
	    exit('Failed to open spells.xml.');
	}
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

if(isset($_SESSION['M2_account']) && isset($_SESSION['M2_password']))
	echo $tpl->fetch('../Includes/Templates/Indigo/sidebarManagerLoggedIn.tpl');
else
	echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>