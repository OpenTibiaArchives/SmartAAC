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
if($aac_status == "Maintenance")
{
	header("location: maintenance.php");
}

$title = 'Calculator';
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

if($modules_rules)
{

// Credits to Samir.se on OTFans.net for this calculation script
?>
<script language='JavaScript' type='text/javascript'>
		    function UHRCalc()
		   { 
			var UHR = 0;
			var mlvl;
			var x;
			var lvl = 0;
			mlvl = window.document.UHR.malvl.value;
			lvl = window.document.UHR.UHRlvl.value;
				x = (lvl*2)+(mlvl*3);
					x = Math.floor(x);
						UHR =+x;
			window.document.UHR.Display.value = UHR;

			// UH Rune
			var UH;
			UH = window.document.UHR.UH.value;
				UH = (Math.max (250, (((lvl*2)+(mlvl*3))*250)/100));
					UH = Math.floor(UH);
						xx =+UH;
			window.document.UHR.UH.value = xx + " hp";

			// SD Rune on Monsters
			var SD;
			SD = window.document.UHR.SD.value;
				SD = (Math.max (12, (((lvl*2)+(mlvl*3))*160)/105));
					UH = Math.floor(SD);
						xxx =+SD;
			window.document.UHR.SD.value = xxx + " hp";

			// SD Rune on Players
			var SDm;
			SDm = window.document.UHR.SD.value;
				SDm = (Math.max (12, (((lvl*2)+(mlvl*3))*160)/210));
					UH = Math.floor(SDm);
						xxxx =+SDm;
			window.document.UHR.SDm.value = xxxx + " hp";
      		}
</script>

<h1>Damage/Healing Calculator</h1><br />

<form name='UHR' action='#'>
<h2>Level</h2><br />
<input type='text' name='UHRlvl' size='30' class='textbox' style='width:33px;'><br />

<h2>Magic Level</h2><br /><input type='text' name='malvl' size='30' class='textbox' style='width:33px;'><br /><br />
<input type='button' value='Calculate' name='Calculate' onClick='UHRCalc();' class='button'><input  type='hidden' value='Calculate' Name='Calculate'><br /><br />

<br /><br />
<hr>
<br /><br />

<h2>Result</h2><br />

<b>Spellpower (%): </b><br><input type='text' name='Display' size='30' readonly="readonly" class='textbox' style='width:200px; border: 0px; background: #FFF;'><p></p>
<b>UH rune heals: </b><br><input type='text' name='UH' size='30' readonly="readonly" class='textbox' style='width:200px; border: 0px; background: #FFF;'><br /><p></p>
<p><b>SD rune damage (monster): </b><br><input type='text' name='SD' readonly="readonly" size='100' class='textbox' style='width:200px; background: #FFF; border: 0px;'></p>
<p><b>SD rune damage (player): </b><br><input type='text' name='SDm' readonly="readonly" size='100' class='textbox' style='width:200px; background: #FFF; border: 0px;'></p>
</form>

<?PHP
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>