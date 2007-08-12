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
include '../Includes/resources.php';
include("../Includes/fckeditor/fckeditor.php") ;

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Remote server management';
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

	if($_POST['submitbutton'] == "Start Server")
	{
		$otserv_binary = $_POST['otservbinary'];
	
		if(file_exists(str_replace("data", "", $aac_dataDir) . $otserv_binary)) {
			echo "<p>Starting $otserv_binary...<br />";
			$starttime = explode(' ', microtime());
			$starttime = $starttime[1] + $starttime[0];
			
			$thisDir = getcwd();
			execInBackground(str_replace("data", "", $aac_dataDir), $otserv_binary);
			chdir($thisDir);
			echo "Started</p><br />";
			
			$mtime = explode(' ', microtime());
			$totaltime = $mtime[0] + $mtime[1] - $starttime;
			printf('This action took %.3f seconds.', $totaltime);
		}
		else {
			echo "$otserv_binary does not exist!";
		}
		echo "<br /><br /><br /><a href=\"admin.php?action=Remote\">Back</a>";
	}
	elseif($_POST['submitbutton'] == "Stop Server")
	{
		$otserv_binary = $_POST['otservbinary'];
		
		echo "<p>Stopping $otserv_binary...<br />";
		$starttime = explode(' ', microtime());
		$starttime = $starttime[1] + $starttime[0];
		
		$cmd = "pv -f -k $otserv_binary -q";
		exec($cmd,$output,$rv);
		echo "Stopped</p><br />";
		
		$mtime = explode(' ', microtime());
		$totaltime = $mtime[0] + $mtime[1] - $starttime;
		printf('This action took %.3f seconds.', $totaltime);
		echo "<br /><br /><br /><a href=\"admin.php?action=Remote\">Back</a>";
	}
	elseif($_POST['submitbutton'] == "Restart Server")
	{
		$otserv_binary = $_POST['otservbinary'];
		
		echo "<p>Restarting $otserv_binary...<br />";
		$starttime = explode(' ', microtime());
		$starttime = $starttime[1] + $starttime[0];
		
		$cmd = "pv -f -k $otserv_binary -q";
		exec($cmd,$output,$rv);
		sleep(4);
		$thisDir = getcwd();
		execInBackground(str_replace("data", "", $aac_dataDir), $otserv_binary);
		chdir($thisDir);
		echo "Restarted</p><br />";
		
		$mtime = explode(' ', microtime());
		$totaltime = $mtime[0] + $mtime[1] - $starttime;
		printf('This action took %.3f seconds.', $totaltime);
		echo "<br /><br /><br /><a href=\"admin.php?action=Remote\">Back</a>";
	}
	else
	{
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

		<p>Here you can start, kill and restart the server.<br /><font color=\"red\"><b>NOTE</font>: This is only available for Windows at the moment.</b><br /><font color=\"red\"><b>NOTE</font>: The server will NOT save if you close the server this way.</b></p><br />
		
		<form action=\"admin.php?action=Remote\" method=\"POST\">
		Server Binary:<br /><input type=\"text\" name=\"otservbinary\" value=\"otserv.exe\" /><br />
		<i>You should use 'otserv.exe' for Windows and just 'otserv' for Linux.</i><br /><br /><br />
		<input type=\"submit\" name=\"submitbutton\" value=\"Start Server\" /><br />
		<input type=\"submit\" name=\"submitbutton\" value=\"Stop Server\" /><br />
		<input type=\"submit\" name=\"submitbutton\" value=\"Restart Server\" />
		</form>
		<br /><br />
		";
	}

	$adminSidebar = true;
	include "../Includes/Templates/$aac_layout/sidebar.php";
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>