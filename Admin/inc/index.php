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
if(!isset($_COOKIE["logged_in"]) || $_COOKIE["logged_in"] == "")
{
	echo 'You are not logged in.<br /><br />
	<a href="login.html" title="Login">Login</a>';
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

	echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

	$currVersion = file_get_contents("http://smart.pekay.co.uk/smartass_version");
	if($currVersion != $aac_versioncode)
	{
		echo "<p>Smart-Ass isn't up to date. Updates are there to bring new features, security fixes and other stuff.</p>";
		echo '<p>Goto check version to upgrade</p>';
	}
	

echo "<h1>Checking</h1><br />
<p>Main AAC Status: $aac_status<br />
Version: $aac_version</p><br />";

?>
<h1>Select an admin action</h1>
<ul>
<li><a href="admin.php?action=CheckVersion">Check version</a></li>
<li><a href="admin.php?action=Security">Change security</a></li>
<li><a href="admin.php?action=PlayerItems">Change player items</a></li>
<li><a href="admin.php?action=Modules">Activate/Deactivate modules</a></li>
<li><a href="admin.php?action=SQL">Change MySQL settings</a></li>
<li><a href="admin.php?action=Stats">Change statistic info</a></li>
<li><a href="admin.php?action=Voting">Change voting questions/reset</a></li>
<li><a href="admin.php?action=Videos">Add/Delete videos</a></li>
<li><a href="admin.php?action=Gallery">Add/Delete images</a></li>
<li><a href="admin.php?action=FieldLens">Change field lengths</a></li>
<li><a href="admin.php?action=PlayerLvls">Change player levels (hp, mana, maglvl)</a></li>
<li><a href="admin.php?action=Towns">Change towns</a></li>
<li><a href="admin.php?action=Maintenance">Change in/out of maintenance mode</a></li>
<li><a href="admin.php?action=ImportDB">Import the Default OTServ DB</a></li>
<li><a href="admin.php?action=Others">Change other stuff</a></li>
<br />
<li><a href="admin.php?action=AdminCreds">Change admin credentials</a></li>
</ul>
<?

echo "<br /><br />";

	echo $tpl->fetch('../Includes/Templates/Indigo/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
}
?>