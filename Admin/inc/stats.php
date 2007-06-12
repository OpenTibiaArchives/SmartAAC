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
	$title = 'Statistical';
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

	echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

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
		}

		br{
		clear: left;
		}
		</style>

		<form action=\"save.php?save=stats\" method=\"POST\">
		<label for=\"ServerName\">Server Name:</label>
		<input type=\"text\" name=\"ServerName\" value=\"$aac_servername\" /><br />

		<label for=\"HostName\">IP/Hostname:</label>
		<input type=\"text\" name=\"HostName\" value=\"$net_ipaddress\" /><br />

		<label for=\"HostPort\">Port:</label>
		<input type=\"text\" name=\"HostPort\" value=\"$net_port\" /><br />

		<label for=\"HostOS\">Operating System:</label>
		<input type=\"text\" name=\"HostOS\" value=\"$info_os\" /><br />

		<label for=\"HostConnection\">Connection Type:</label>
		<input type=\"text\" name=\"HostConnection\" value=\"$info_connection\" /><br />

		<label for=\"HostUptime\">Uptime Aim:</label>
		<input type=\"text\" name=\"HostUptime\" value=\"$info_uptimetype\" /><br />
		<br /><br />
		
		<br />
		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Change\" />
		</form>
		";

	echo $tpl->fetch('../Includes/Templates/Indigo/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
}
?>