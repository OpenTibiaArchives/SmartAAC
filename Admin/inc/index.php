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

	$currVersion = file_get_contents("http://otaac.sourceforge.net/smartass_version");
	switch(version_compare($aac_version, $currVersion))
	{
		case -1:
			echo "<p>Smart-Ass isn't up to date. <a href=\"admin.php?action=CheckVersion\">Instructions for upgrading</a>";
		break;
		
		case 1:
			echo "<p><b>This is version of Smart-Ass appears to be a development version either from the SVN respository or via some other method.</b><br /> <br /><a href=\"admin.php\">Go back</a>";
		break;
	}
	
function get_server_load($windows = 0) {
	$os = strtolower(PHP_OS);
	
	if(strpos($os, "win") === false) {
		if(file_exists("/proc/loadavg")) {
		$load = file_get_contents("/proc/loadavg");
		$load = explode(' ', $load);
		return $load[0];
	}
	elseif(function_exists("shell_exec")) {
		$load = explode(' ', `uptime`);
		return $load[count($load)-1];
	}
	else {
		return "NONE";
}
    }
    elseif($windows) {
 if(class_exists("COM")) {
     $wmi = new COM("WinMgmts:\\\\.");
     $cpus = $wmi->InstancesOf("Win32_Processor");
     
     $cpuload = 0;
     $i = 0;
     while ($cpu = $cpus->Next()) {
   $cpuload += $cpu->LoadPercentage;
   $i++;
     }
     
     $cpuload = round($cpuload / $i, 2);
     return "$cpuload%";
 }
 else {
     return "NONE";
 }
    }
}

//echo get_server_load();

echo "<h1>Checking</h1><br />
<p>Main AAC Status: $aac_status<br />
<i>Version: $aac_version<br />
OS: ". PHP_OS . "<br /></i></p><br />";

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
<li><a href="admin.php?action=Remote">Remote otserv start/stop</a></li>
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

	$adminSidebar = true;
	include "../Includes/Templates/$aac_layout/sidebar.php";
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>