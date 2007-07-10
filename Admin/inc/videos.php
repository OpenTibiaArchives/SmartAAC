<?PHP
include "../conf.php";
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
define("VID_DIRECTORY", "../Main/video/flvs");

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Videos';
	$name = 'Admin Panel';
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

		/*echo "
		<p>There is no management for Videos yet, but you can follow these instructions to add videos to your AAC</p>
		<p>1. Convert your video to FLV format and name it to something unique<br />
		2. Open Main/video/flvs, and put the file there<br />
		3. Smart-Ass should see the file and embed it to the page ;)</p><br /><br />
		";*/
		
	$d = opendir(VID_DIRECTORY);
	$total_vids = 0;
	$totalsize = 0;
	echo "<h2>Videos in videos/flvs directory</h2><br /><ul>";
	while($f = readdir($d))
	{
		if(is_dir($f))
		continue;

		$totalsize = $totalsize + filesize(VID_DIRECTORY . "/$f");
		echo "<li>$f - <a href=\"save.php?save=delvideo&delete=$f\">Delete?</a></li>";
		$total_vids++;
	}
	echo "</ul>";
	
	if($total_vids == 0)
	{
		echo "<p>You haven't got any videos, upload one?</p>";
	}
	
	$totalsize = round(($totalsize/1024),2);
	echo "<p>Total directory size: $totalsize kb</p>";
	
	echo "<br /><h2>Upload videos</h2><br />";
	echo '
		<form action="save.php?save=uploadvideo" method="post" enctype="multipart/form-data">
	File:&nbsp;<input type="file" name="uplfile"><br>
	<input type="submit" value="Upload">
	</form>
	';
	

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>