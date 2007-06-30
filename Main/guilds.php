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

session_start();

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
	<tr><td><div align="center"><a href="guilds.php?act=join">Join</a></td></div></tr>
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
			case "manage": // kick, change rank-names, promote/demote
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					echo "<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>";
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
						echo '<br /><br />';
						$query = sqlquery('SELECT `player_id` FROM `guild_invites` WHERE `guild_id` = '. $guild['id'] .'');
						if(mysql_num_rows($query) != 0) {
							echo '
							<center>
							<h4>Invited Players:</h4>
							<table style="text-align: left; width: 15%;" border="1" cellpadding="0" cellspacing="2">
							<tbody>
							<tr>
							<td style="width: 10%;">Name</td>
							</tr>
							</tbody>';
							while($row = mysql_fetch_array($query)){
								echo '
								<tr>
								<td><center><a href="character.php?char='. userFromID($row['player_id']) .'">'. userFromID($row['player_id']) .'</a></center></td>
								</tr>
								';
							}
							echo '</table><center><a href="guilds.php?act=join">Join</a></center>';
						}
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
					echo "<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>";
				}
				else { // logged in
					if($_POST['guildname'] && $_POST['char']){
						$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
						mysql_select_db($sql_db, $sqlconnect);
						$query = sqlquery('SELECT `rank_id` FROM `players` WHERE `name` = \''. mysql_real_escape_string($_POST['char']) .'\'');
						$rank_id = mysql_fetch_array($query);
						if($rank_id[0] != 0) {
							echo 'That character is already in a guild!';
						}
						else {
							$query = sqlquery('SELECT `name` FROM `guilds` WHERE `name` = \''. mysql_real_escape_string($_POST['guildname']) .'\'');
							$guildcheck = mysql_fetch_array($query);
							if($guildcheck[0]) {
								echo 'That guildname already exist.';
							}
							else {
								$query = sqlquery('INSERT INTO `guilds` (`name`, `ownerid`, `creationdata`) VALUES(\''. mysql_real_escape_string($_POST['guildname']) .'\', '. userByID(mysql_real_escape_string($_POST['char'])) .', '. time() .')') or die('Error: '.mysql_error().' ('.mysql_errno().')');
								$query2 = sqlquery('UPDATE `players`, `guild_ranks`, `guilds` SET `players`.`rank_id` = `guild_ranks`.`id` WHERE `players`.`id` = '. userByID(mysql_real_escape_string($_POST['char'])) .' AND `guilds`.`ownerid` = `players`.`id` AND `guild_ranks`.`guild_id` = `guilds`.`id` AND `guild_ranks`.`level` = 3');
								if(mysql_num_rows($query) == 1 && mysql_num_rows($query2) == 1)
									echo '<center>The guild has been made. <a href="guilds.php?act=manage">Click here</a> to manage it.</center>';
								else
									echo '<center>Couldn\'t create the guild, please contact the webmaster!</center>';
							}
						}
					}
					else {
						$chars = getChars($_SESSION['M2_account']);
						echo '<center><form action="guilds.php?act=create" method="post">';
						echo 'Character: <select name="char">';
						foreach($chars as $char){
							echo '<option value="'. $char .'">'. $char .'</option>';
						}
						echo '</select><br />';
						echo 'Guild Name: <input type="text" name="guildname" />';
						echo '<br /><br /><input type="submit" value="create" />';
						echo '</form></center>';
					}
				}
				break;
			case "leave":
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					echo "<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>";
				}
				else { // logged in
					if($_POST['char']){
						if(($_POST['agreeacc'] == $_SESSION['M2_account']) && ($_POST['agreepass'] == $_SESSION['M2_password'])){
							if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
								$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
								mysql_select_db($sql_db, $sqlconnect);
							
								$query = sqlquery('UPDATE `players` SET `rank_id` = 0 WHERE `id` = '. userByID(mysql_real_escape_string($_POST['char'])) .'');
								if(mysql_num_rows($query) == 1)
									echo '<center>You have left your guild.</center>';
								else
									echo '<center>Error! Couldn\'t leave the guild!</center>';
							}
							else {
								die('Nice hack-attempt, but didn\'t work =)');
							}
						}
						else {
							echo '<center><h4>Please type your account number and password to leave the guild.</h4><br />';
							echo '<form action="guilds.php?act=leave" method="post">';
							echo 'Account Number: <input type="password" name="agreeacc" /><br />';
							echo 'Account Password: <input type="password" name="agreepass" /><br />';
							echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
							echo '<br /><br /><input type="submit" value="Delete" />';
							echo '</form></center>';
						}
					}
					else {
						$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
						mysql_select_db($sql_db, $sqlconnect);
						
						$chars = getChars($_SESSION['M2_account']);
						echo '<center><form action="guilds.php?act=leave" method="post">';
						echo 'Select a Character: <select name="char">';
						foreach($chars as $char){
							echo '<option value="'. $char .'">'. $char .'</option>';
						}
						echo '</select>';
						echo '<br /><br /><input type="submit" value="Continue" />';
						echo '</form></center>';
					}
				}
				break;
			case "disband":
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					echo "<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>";
				}
				else { // logged in
					if($_POST['char']){
						if(($_POST['agreeacc'] == $_SESSION['M2_account']) && ($_POST['agreepass'] == $_SESSION['M2_password'])){
							if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
								$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
								mysql_select_db($sql_db, $sqlconnect);
							
								if(sqlquery('DELETE FROM `guilds` WHERE `ownerid` = '. userByID(mysql_real_escape_string($_POST['char'])) .''))
									echo '<center>Your guild has been deleted.</center>';
								else
									echo '<center>Error! Your guild could not be deleted!</center>';
							}
							else {
								die('Nice hack-attempt, but didn\'t work =)');
							}
						}
						else {
							echo '<center><h4>Please type your account number and password to disband the guild.</h4><br />';
							echo '<form action="guilds.php?act=disband" method="post">';
							echo 'Account Number: <input type="password" name="agreeacc" /><br />';
							echo 'Account Password: <input type="password" name="agreepass" /><br />';
							echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
							echo '<br /><br /><input type="submit" value="Delete" />';
							echo '</form></center>';
						}
					}
					else {
						$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
						mysql_select_db($sql_db, $sqlconnect);
						
						$chars = getChars($_SESSION['M2_account']);
						echo '<center><form action="guilds.php?act=disband" method="post">';
						echo 'Select a Character: <select name="char">';
						foreach($chars as $char){
							echo '<option value="'. $char .'">'. $char .'</option>';
						}
						echo '</select>';
						echo '<br /><br /><input type="submit" value="Continue" />';
						echo '</form></center>';
						
						//$query = sqlquery('SELECT * FROM `guilds` WHERE `ownerid` = '.  .'');
					}
				}
				break;
			case "join":
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					echo "<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>";
				}
				else { // logged in
					if($_POST['char']){
						if($_POST['guild']){
							$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
							mysql_select_db($sql_db, $sqlconnect);
							if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
								sqlquery('DELETE FROM `guild_invites` WHERE `player_id` = '. userByID(mysql_real_escape_string($_POST['char'])) .' AND `guild_id` = '. intval($_POST['guild_id']) .'') or die('<center><h4>Error! Couldn\'t join the guild, please contact the webmaster! ('.mysql_error().' ('.mysql_errno().'))</h4></center>');
								sqlquery('UPDATE `players`, `guilds`, `guild_ranks`, `guild_invites` SET `players`.`rank_id` = `guild_ranks`.`id` WHERE `players`.`id` = `guild_invites`.`player_id` AND `guild_invites`.`guild_id` = '. intval($_POST['guild_id']) .' AND `guild_ranks`.`level` = 1') or die('<center><h4>Error! Couldn\'t join the guild, please contact the webmaster! ('.mysql_error().' ('.mysql_errno().'))</h4></center>');
								
								echo '<center><h4>Successfully joined the guild.</h4></center>';
							}
							else {
								die('Nice hack-attempt, but didn\'t work =)');
							}
						}
						else {
							$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
							mysql_select_db($sql_db, $sqlconnect);
						
							$query = sqlquery('SELECT `guild_id` FROM `guild_invites` WHERE `player_id` = '. userByID(mysql_real_escape_string($_POST['char'])) .'');
							if(mysql_num_rows($query) != 0){
								echo '
								<center>
								<h4>Guilds:</h4>
								<table style="text-align: left; width: 20%;" border="1" cellpadding="0" cellspacing="2">
								<tbody>
								<tr>
								<td style="width: 80%;">Guild Name</td>
								<td style="width: 20%;"></td>
								</tr>
								</tbody>';
								while($row = mysql_fetch_array($query)){
									echo '
									<tr>
									<td><center><a href="guilds.php?act=view&guild='. getGuildFromID($row['guild_id']) .'">'. getGuildFromID($row['guild_id']) .'</a></center></td>
									<td><center><form action="guilds.php?act=join" method="post"><input type="hidden" name="guild" value="'. $row['guild_id'] .'" /><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Join"/></form></center></td>
									</tr>
									';
								}
								echo '</table></center>';
							}
							else {
								echo '<center><h4>You are not invited to any guilds.</h4></center>';
							}
						}
					}
					else {
						$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
						mysql_select_db($sql_db, $sqlconnect);
						
						$chars = getChars($_SESSION['M2_account']);
						echo '<center><form action="guilds.php?act=join" method="post">';
						echo 'Select a Character: <select name="char">';
						foreach($chars as $char){
							echo '<option value="'. $char .'">'. $char .'</option>';
						}
						echo '</select>';
						echo '<br /><br /><input type="submit" value="Continue" />';
						echo '</form></center>';
					}
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

if(isset($_SESSION['M2_account']) && isset($_SESSION['M2_password']))
	echo $tpl->fetch('../Includes/Templates/Indigo/sidebarManagerLoggedIn.tpl');
else
	echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>