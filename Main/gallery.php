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
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';
if($aac_status == "Maintenance")
{
	header("location: maintenance.php");
}
define("PIC_DIRECTORY", "pictures");

$title = 'Gallery';
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

if($modules_gallery)
{
	echo "<h1>Gallery</h1><br />";
	
	$total_pics = 0;
	
	// START PICTURE FOLDER SCAN =)
	$d = opendir(PIC_DIRECTORY);
		while($f = readdir($d))
		{
		  if(is_dir($f))
		  continue;

		  echo "<a href=\"pictures/$f\" title=\"$f\" class=\"thickbox\"><img src=\"pictures/$f\" alt=\"$f\" width=\"260\" height=\"220\" border=\"0\"/></a>&nbsp;";
		  $total_pics++;
		}
	// END
	
	if($total_pics == 0)
	{
		echo "<p>There are no pictures to display on the gallery.</p>";
	}

	echo "<br /><br />";
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

if(isset($_SESSION['M2_account']) && isset($_SESSION['M2_password']))
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarManagerLoggedIn.tpl');
else
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>
