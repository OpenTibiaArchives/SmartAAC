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
include "../Includes/resources.php";

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Admin Credentials';
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

	$random_password = createRandomPassword();
	
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');

		echo "
		<style type=\"text/css\">

		label{
		float: left;
		width: 220px;
		font-weight: bold;
		font-size: 12px;
		}

		input, textarea{
		width: 180px;
		margin-bottom: 5px;
		}

		textarea{
		width: 250px;
		height: 150px;
		}

		.boxes{
		width: 3em;
		}

		#submitbutton{
		margin-left: 120px;
		margin-top: 5px;
		width: 90px;
		
		#submitbutton2{
		margin-left: 120px;
		margin-top: 5px;
		width: 200px;
		}

		br{
		clear: left;
		}
		</style>

		<p>This section can update your admin panel & news system user and password.</p>
		
		<form action=\"save.php?save=changeadmincreds\" method=\"POST\">
		<label for=\"adminuser\">Username:</label>
		<input type=\"text\" name=\"adminuser\" value=\"$admin_user\" /><br />
		<label for=\"adminpass\">Password:</label>
		<input type=\"password\" name=\"adminpass\" /><br /><br />
		
		
		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Change\" />
			<br />
		</form>
		
		
		<br /><br /><br />
		<p>Random password: <i>$random_password</i> <br />Press 'Change to new password' for a new random password.</p>
		<form action=\"save.php?save=resetadminpass\" method=\"POST\">
		<input type=\"hidden\" name=\"hiddenrandpass\" value=\"$random_password\">
		<input type=\"submit\" name=\"submitbutton2\" id=\"submitbutton2\" value=\"Change to new password\" />
		</form>
		";

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>