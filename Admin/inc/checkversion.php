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

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Check Version';
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

	$currVersion = file_get_contents("http://otaac.sourceforge.net/smartass_version");
	// if($currVersion > $aac_versioncode)
	// {
		// echo "<p>Smart-Ass isn't up to date. Updates are there to bring new features, security fixes and other stuff.</p>";
		// echo '<form action="http://smart.pekay.co.uk/upgrade.php?version='.$aac_versioncode.'" method="post"><input name="submit" tabindex="4" type="submit" value="Upgrade to '.$currVersion.'" /></form> <br /><a href=\"admin.php\">Go back</a>';
	// }
	// elseif($currVersion < $aac_versioncode)
	// {
		// echo "<p><b>This is version of Smart-Ass appears to be a development version either from the SVN respository or via some other method.</b><br /> <br /><a href=\"admin.php\">Go back</a>";
	// }
	// elseif($currVersion == $aac_versioncode)
	// {
		// echo "<p>Your version of Smart-Ass is up to date. Panic over! <br /><a href=\"admin.php\">Go back</a></p>";
	// }
	// else
	// {
		// echo "<p>Unable to determine version numbers, fatal. <br /><a href=\"admin.php\">Go back</a></p>";
	//}
	
	switch(version_compare($aac_version, $currVersion))
	{
		case -1:
			echo "<p>Smart-Ass isn't up to date. Updates are there to bring new features, security fixes and other stuff.</p>";
			echo '<form action="http://smart.pekay.co.uk/upgrade.php?version='.$aac_versioncode.'" method="post"><input name="submit" tabindex="4" type="submit" value="Upgrade to '.$currVersion.'" /></form> <br /><a href=\"admin.php\">Go back</a>';
		break;
		
		case 0:
			echo "<p>Your version of Smart-Ass is up to date. Panic over! <br /><a href=\"admin.php\">Go back</a></p>";
		break;
		
		case 1:
			echo "<p><b>This is version of Smart-Ass appears to be a development version either from the SVN respository or via some other method.</b><br /> <br /><a href=\"admin.php\">Go back</a>";
		break;
		
		default:
			echo "<p>Unable to determine version numbers, error. <br /><a href=\"admin.php\">Go back</a></p>";
		break;
	}
	
	$adminSidebar = true;
	include "../Includes/Templates/$aac_layout/sidebar.php";
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>