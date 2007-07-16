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

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Index';
	$name = "Admin Panel";
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

	$currVersion = file_get_contents("http://smart.pekay.co.uk/smartass_version");
	if($currVersion > $aac_versioncode)
	{
		echo "<p><b>Smart-Ass isn't up to date. Updates are there to bring new features, security fixes and other stuff.<br />";
		echo 'Goto check version to upgrade</b></p>';
	}
	elseif($currVersion < $aac_versioncode)
	{
		echo "<p><b>This is version of Smart-Ass appears to be a development version.</b><br />";
	}
	

echo "<h1>Checking</h1><br />
<p>Main AAC Status: $aac_status<br />
<i>Version: $aac_version<br />
Version Code: $aac_versioncode</i></p><br />";

?>
<h1>Administration</h1><br />
<ul>
<li><a href="admin.php?action=Items">Player items</a></li>
<li><a href="admin.php?action=FrontpageText">Frontpage text</a></li>
<li><a href="admin.php?action=Security">Security settings</a></li>
<li><a href="admin.php?action=SQL">MySQL settings</a></li>
<li><a href="admin.php?action=Stats">Statistic info</a></li>
<li><a href="admin.php?action=Dirs">OtServ Data Directory & Related directories</a></li>
<br />
<li><a href="admin.php?action=Voting">Voting questions/reset</a></li>
<li><a href="admin.php?action=FieldLens">AAC field lengths</a></li>
<li><a href="admin.php?action=PlayerLvls">Player levels (hp, mana, maglvl)</a></li>
<li><a href="admin.php?action=Maintenance">In/out of maintenance mode</a></li>
<li><a href="admin.php?action=MassSpawnChange">Mass spawn changer</a></li>
<li><a href="admin.php?action=Layout">Site/AAC Layout</a></li>
<li><a href="admin.php?action=Others">Change other stuff</a></li>
<br />
<li><a href="admin.php?action=Towns">Detect Towns</a></li>
<li><a href="admin.php?action=CheckVersion">Check version</a></li>
<!--<li><a href="admin.php?action=ImportDB">Import the Default OTServ DB</a></li>-->
<li><a href="admin.php?action=Videos">Add/Delete videos</a></li>
<li><a href="admin.php?action=Gallery">Add/Delete images</a></li>
<li><a href="admin.php?action=CustomPages">Manage custom pages</a></li>
<li><a href="admin.php?action=Modules">Activate/Deactivate modules</a></li>
<li><a href="admin.php?action=AdminCreds">Change admin credentials</a></li>
<li><a href="news/">Goto the news panel</a></li>
</ul>
<?

echo "<br /><br />";

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>