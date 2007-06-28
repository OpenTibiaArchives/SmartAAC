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
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';
if($aac_status == "Maintenance")
{
	header("location: maintenance.php");
}

$title = 'Guilds';
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

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

if($modules_guilds)
{
	?>
	<td width="13%" valign="top"><table width="130" border="0" align="right" cellpadding="2" cellspacing="1">
	<tr><td><div align="center"><a href="guilds.php?act=manage">Manage</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php?act=view">View</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php?act=create">Create</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php?act=leave">Leave</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php?act=disband">Disband</a></td></div></tr>
	</table>
	<?php
	$act = $_GET['act'];
	if(isset($act))
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
				if(isset($_GET['guild'])) { // Show guild
					$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
					mysql_select_db($sql_db, $sqlconnect);
					
					$query = sqlquery('SELECT * FROM `guilds` WHERE `name` = \''. mysql_real_escape_string($_GET['guild']) .'\'');
					if(mysql_num_rows($query) == 1) {
						$guild = mysql_fetch_array($query);
						
						$guild_rank = array();
						$query = sqlquery('SELECT `id`, `name`, `level` FROM `guild_ranks` WHERE `guild_id` = '. $guild['id'] .'');
						while($row = mysql_fetch_array($query)) {
							$guild_rank[$row['id']] = array('name' => $row['name'], 'level' => $row['level']);
						}

					echo '
	<center>
	<h4>The guild was founded on '. date('M d Y, H:i:s T', $guild['creationdata']) .' by <a href="character.php?char='. userFromID($guild['ownerid']) .'">'. userFromID($guild['ownerid']) .'</a></h4>
	<table style="text-align: left; width: 35%;" border="1" cellpadding="0" cellspacing="2">
	<tbody>
	<tr>
	<td style="width: 40%;">Rank</td>
	<td style="width: 60%;">Name (Title)</td>
	</tr>
	</tbody>';
						foreach($guild_rank as $id => $info)
						{
							$query = sqlquery('SELECT `name`, `rank_id`, `guildnick` FROM `players` WHERE `rank_id` = '. $id .'');
							while($row = mysql_fetch_array($query)) {
								echo '
								<tr>
								<td><center>'. $info['name'] .'</center></td>
								<td><center><a href="character.php?char='. $row['name'] .'">'. $row['name'] .'</a>';
								if($row['guildnick'])
									echo ' ('. $row['guildnick'] .')';
								echo '</center></td>
								</tr>
								';
							}
						}
						echo '</table></center>';
					}
				}
				else { // List of guilds
	echo '
	<center>
	<table style="text-align: left; width: 30%;" border="1" cellpadding="0" cellspacing="2">
	<tbody>
	<tr>
	<td style="width: 50%;">Guild Name</td>
	<td style="width: 40%;">Owner</td>
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
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					die("<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>");
				}
				else { // logged in
				
				}
				break;
			case "leave":
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					die("<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>");
				}
				else { // logged in
				
				}
				break;
			case "disband":
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					die("<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>");
				}
				else { // logged in
					$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
					mysql_select_db($sql_db, $sqlconnect);
					
					//$query = sqlquery('SELECT * FROM `guilds` WHERE `ownerid` = '.  .'');
				}
				break;
			default:
				die("Error! Please contact an admin by using the feedback function <a href=\"feedback.php\">HERE</a>!");
				break;
		}
	}
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>