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
		<table width="500" bordercolor="black" border="1"> 
		<tr> 
	    <th>Spell name:</th> 
	    <th>Words:</th> 
	    <th>Mana:</th> 
	    <th>Level:</th> 
	    <th>Magic Level:</th> 
	    <th>Premium:</th> 
		</tr>
		';
	
		foreach($xml->instant as $spell)
		{
			if($spell['enabled'] == true)
			{
				echo "<tr>";
				echo "<td>".$spell['name']."</td>";
				echo "<td>".$spell['words']."</td>";
				if(isset($spell['mana'])) { echo "<td>".$spell['mana']."</td>"; } else { echo "<td>N/A</td>"; }
				if(isset($spell['lvl'])) { echo "<td>".$spell['lvl']."</td>"; } else { echo "<td>N/A</td>"; }
				if(isset($spell['maglv'])) { echo "<td>".$spell['maglv']."</td>"; } else { echo "<td>N/A</td>"; }
				if($spell['prem']==true) { echo "<td>Yes</td>"; } else { echo "<td>No</td>"; }
				echo "</tr>";
			}
		}
	
		echo '</table><br />';
		
		// Conjure spells		
		echo "<h2>Conjure Spells</h2><br />";
		echo '
		<table width="500" bordercolor="black" border="1"> 
		<tr> 
	    <th>Spell name:</th> 
	    <th>Words:</th> 
	    <th>Mana:</th> 
	    <th>Level:</th> 
	    <th>Magic Level:</th> 
	    <th>Premium:</th> 
		</tr>
		';
	
		foreach($xml->conjure as $spell)
		{
			if($spell['enabled'] == true)
			{
				echo "<tr>";
				echo "<td>".$spell['name']."</td>";
				echo "<td>".$spell['words']."</td>";
				if(isset($spell['mana'])) { echo "<td>".$spell['mana']."</td>"; } else { echo "<td>N/A</td>"; }
				if(isset($spell['lvl'])) { echo "<td>".$spell['lvl']."</td>"; } else { echo "<td>N/A</td>"; }
				if(isset($spell['maglv'])) { echo "<td>".$spell['maglv']."</td>"; } else { echo "<td>N/A</td>"; }
				if($spell['prem']==true) { echo "<td>Yes</td>"; } else { echo "<td>No</td>"; }
				echo "</tr>";
			}
		}
	
		echo '</table><br />';
		
		// Runes available		
		echo "<h2>Runes Available</h2><br />";
		echo '
		<table width="500" bordercolor="black" border="1"> 
		<tr> 
	    <th>Spell name:</th> 
	    <th>Charges:</th> 
	    <th>Mana:</th> 
	    <th>Level:</th> 
	    <th>Magic Level:</th> 
	    <th>Premium:</th> 
		</tr>
		';
	
		foreach($xml->rune as $spell)
		{
			if($spell['enabled'] == true)
			{
				echo "<tr>";
				echo "<td>".$spell['name']."</td>";
				echo "<td>".$spell['charges']."</td>";
				if(isset($spell['mana'])) { echo "<td>".$spell['mana']."</td>"; } else { echo "<td>N/A</td>"; }
				if(isset($spell['lvl'])) { echo "<td>".$spell['lvl']."</td>"; } else { echo "<td>N/A</td>"; }
				if(isset($spell['maglv'])) { echo "<td>".$spell['maglv']."</td>"; } else { echo "<td>N/A</td>"; }
				if($spell['prem']==true) { echo "<td>Yes</td>"; } else { echo "<td>No</td>"; }
				echo "</tr>";
			}
		}
	
		echo '</table>';
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

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>