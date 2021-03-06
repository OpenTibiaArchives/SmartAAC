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
define("VID_DIRECTORY", "video/flvs");

$title = 'Videos';
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

if($modules_videos)
{

echo "<h1>Videos</h1><br />";
$total_vids = 0;

$d = opendir(VID_DIRECTORY);
	
while($f = readdir($d))
{
	if(is_dir($f))
	continue;

	echo "<p id=\"player1\"><a href=\"http://www.macromedia.com/go/getflashplayer\">Get the Flash Player</a> to see this player.</p>
<script type=\"text/javascript\">
	var s1 = new SWFObject(\"mediaplayer.swf\",\"single\",\"400\",\"300\",\"7\");
	s1.addParam(\"allowfullscreen\",\"true\");
	s1.addVariable(\"file\",\"video/flvs/$f\");
	s1.addVariable(\"image\",\"video/preview.png\");
	s1.write(\"player1\");
</script> ";
	$total_vids++;
}

	if($total_vids == 0)
	{
		echo "<p>There's no videos available :(</p>";
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