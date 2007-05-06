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
include '../Includes/resources.php';

$title = 'Guilds';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

$act = $_REQUEST['act']; // Action
if(isset($act)) // Manage/View/Create blabla
{
	switch($act)
	{
		case "manage":
			if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
				die("<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>");
			}
			else { // logged in
			
			}
			break;
		case "view":
			if(isset($_REQUEST['guild'])) { // Show guild
				
			}
			else { // List of guilds
				echo '
<center>
<table style="text-align: left; width: 20%;" border="1" cellpadding="0" cellspacing="2">
<tbody>
<tr>
<td style="width: 10%;">Guild Name</td>
<td style="width: 10%;">Owner</td>
<td style="width: 10%;">View</td>
</tr>
</tbody>';
				$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
				mysql_select_db($sql_db, $sqlconnect);
				
				$query = sqlquery('SELECT `name`, `ownerid` FROM `guilds` ORDER BY `name` ASC');
				while($row = mysql_fetch_array($query)) {
					echo '
					<tr>
					<td><center>'. $row['name'] .'</center></td>
					<td><center><a href="character.php?char='. userFromID($row['ownerid']) .'">'. userFromID($row['ownerid']) .'</a></center></td>
					<td><center><a href="guilds.php?act=view&guild='.$row['name'].'">View</a></center></td>
					</tr>
					';
					$i++;
				}
				echo '</table></center>';
			}
			break;
		case "create":
			
			break;
		case "leave":
			
			break;
		case "disband":
			
			break;
		default:
			die("Error! Please contact an admin by using the feedback function <a href=\"feedback.php\">HERE</a>!");
			break;
	}
}
?>
<td width="13%" valign="top"><table width="130" border="0" align="right" cellpadding="2" cellspacing="1">
<tr><td><div align="center"><a href="guilds.php?act=manage">Manage</a></td></div></tr>
<tr><td><div align="center"><a href="guilds.php?act=view">View</a></td></div></tr>
<tr><td><div align="center"><a href="guilds.php?act=create">Create</a></td></div></tr>
<tr><td><div align="center"><a href="guilds.php?act=leave">Leave</a></td></div></tr>
<tr><td><div align="center"><a href="guilds.php?act=disband">Disband</a></td></div></tr>
</table>
<?php
echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>