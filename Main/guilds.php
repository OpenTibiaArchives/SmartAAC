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

echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');

if($modules_guilds)
{
	?>
	<td width="13%" valign="top"><table width="130" border="0" align="right" cellpadding="2" cellspacing="1">
	<tr><td><div align="center"><a href="guilds.php?act=manage">Manage</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php">View</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php?act=join">Join</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php?act=create">Create</a></td></div></tr>
	<tr><td><div align="center"><a href="guilds.php?act=leave">Leave</a></td></div></tr>
	</table>
	<?php
	$act = $_GET['act'];
		switch($act)
		{
			case "manage": // kick, change rank-names, promote/demote
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					echo "<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>";
				}
				else { // logged in
					if($_POST['char']){
						$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
						mysql_select_db($sql_db, $sqlconnect);
						$query = sqlquery('SELECT `guild_ranks`.`level`, `guild_ranks`.`id`, `guild_ranks`.`guild_id` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['char']) .'\' AND `guild_ranks`.`id` = `players`.`rank_id`');
						if(mysql_num_rows($query) == 1)
							$level = mysql_fetch_array($query);
							
						if($level && intval($level['level']) >= 2){
							echo '<form action="guilds.php?act=manage&sub=disband" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Disband"/></form>';
							echo '<form action="guilds.php?act=manage&sub=invite" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Invite"/></form>';
							echo '<form action="guilds.php?act=manage&sub=revoke" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Revoke Invitation"/></form>';
							echo '<form action="guilds.php?act=manage&sub=kick" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Kick"/></form>';
							echo '<form action="guilds.php?act=manage&sub=alter" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Alter Positions"/></form>';
							echo '<form action="guilds.php?act=manage&sub=title" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Set Title"/></form>';
							echo '<form action="guilds.php?act=manage&sub=pass" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Pass Leadership"/></form>';
							echo '<form action="guilds.php?act=manage&sub=rank" method="post"><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Edit Ranks"/></form>';
							
							// Load guild-ids
							$guild_rank = array();
							$query = sqlquery('SELECT `id`, `name`, `level` FROM `guild_ranks` WHERE `guild_id` = '. $level['guild_id'] .'');
							while($row = mysql_fetch_array($query)) {
								$guild_rank[$row['id']] = array('name' => $row['name'], 'level' => $row['level']);
							}
							
							switch($_GET['sub']){
								case "disband":
									if(($_POST['agreeacc'] == $_SESSION['M2_account']) && ($_POST['agreepass'] == $_SESSION['M2_password'])){
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
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
										echo '<center><h4>Please type your account number and password to <b>disband</b> the guild.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=disband" method="post">';
										echo 'Account Number: <input type="password" name="agreeacc" /><br />';
										echo 'Account Password: <input type="password" name="agreepass" /><br />';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
										echo '<br /><br /><input type="submit" value="Delete" />';
										echo '</form></center>';
									}
									break;
								case "invite":
									if($_POST['invchar']){
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
											$query = sqlquery('SELECT `rank_id` FROM `players` WHERE `name` = \''. mysql_real_escape_string($_POST['invchar']) .'\'');
											$check = mysql_fetch_array($query);
											if($check && $check['rank_id'] == 0){
												$query = sqlquery('SELECT `guild_ranks`.`guild_id` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['char']) .'\' AND `players`.`rank_id` = `guild_ranks`.`id`');
												$guild_id = mysql_fetch_array($query);
												$query = sqlquery('SELECT `player_id`, `guild_id` FROM `guild_invites` WHERE `player_id` = '. intval(userByID($_POST['invchar'])) .' AND `guild_id` = '. intval($guild_id['guild_id']) .'');
												if(mysql_num_rows($query) == 0){
													sqlquery('INSERT INTO `guild_invites` (`player_id`, `guild_id`) VALUES ('. intval(userByID($_POST['invchar'])) .', '. intval($guild_id['guild_id']) .')') or die('Couldn\'t invite to the guild, please contact the webmaster! (Error: '.mysql_error().' ('.mysql.errno().'))');
													echo '<center><h4>Successfully invited '. $_POST['invchar'] .' to the guild.</h4></center>';
												}
												else {
													echo '<center><h4>'. $_POST['invchar'] .' is already invited to this guild!</h4></center>';
												}
											}
											else {
												echo '<center><h4>Sorry, this character is already in a guild.</h4></center>';
											}
										}
										else {
											die('Nice hack-attempt, but didn\'t work =)');
										}
									}
									else {
										echo '<center><h4>Please type the name of the character you want to invite.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=invite" method="post">';
										echo 'Character: <input type="text" name="invchar" /><br />';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
										echo '<br /><br /><input type="submit" value="Invite" />';
										echo '</form></center>';
									}
									break;
								case "revoke":
									if($_POST['revokechar']){
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
											$query = sqlquery('DELETE FROM `guild_invites` WHERE `player_id` = '. intval($_POST['revokechar']) .' AND `guild_id` = '. intval($level['guild_id']) .'');
											echo '<center><h4>Successfully revoked the invitation of '. userFromID($_POST['revokechar']) .'.</h4></center>';
										}
										else {
											die('Nice hack-attempt, but didn\'t work =)');
										}
									}
									else {
										echo '<center><h4>Please select the character you want to revoke the invitation of.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=revoke" method="post">';
										echo 'Character: <select name="revokechar">';
										$query = sqlquery('SELECT `player_id` FROM `guild_invites` WHERE `guild_id` = '. $level['guild_id'] .'');
										while($row = mysql_fetch_array($query))
										{
											echo '<option value="'. $row['player_id'] .'">'. userFromID($row['player_id']) .'</option>';
										}
										echo '</select>';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'"/>';
										echo '<br /><br /><input type="submit" value="Revoke" />';
										echo '</form></center>';
									}
									break;
								case "kick":
									if($_POST['kickchar']){
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
											$query = sqlquery('SELECT `guild_ranks`.`guild_id` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['char']) .'\' AND `players`.`rank_id` = `guild_ranks`.`id`');
											$check = mysql_fetch_array($query);
											$query2 = sqlquery('SELECT `guild_ranks`.`guild_id`, `guild_ranks`.`level` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['kickchar']) .'\' AND `players`.`rank_id` = `guild_ranks`.`id`');
											$check2 = mysql_fetch_array($query2);
											if($check && $check2 && $check['guild_id'] == $check2['guild_id']){
												if($check2['level'] == 3) {
													echo '<center><h4>Sorry, you can\'t kick the leader of the guild.</h4></center>';
												}
												else {
													if(intval($level['level']) == 3){
														sqlquery('UPDATE `players` SET `rank_id` = 0 WHERE `name` = \''. mysql_real_escape_string($_POST['kickchar']) .'\'') or die('Couldn\'t kick player, please contact the webmaster! (Error: '.mysql_error().' ('.mysql_errno().'))');
														echo '<center><h4>Successfully kicked '. $_POST['kickchar'] .' from the guild.</h4></center>';
													}
													else {
														echo '<center><h4>Sorry, only the leader can kick players.</h4></center>';
													}
												}
											}
											else {
												echo '<center><h4>'. $_POST['kickchar'] .' is not in your guild!</h4></center>';
											}
										}
										else {
											die('Nice hack-attempt, but didn\'t work =)');
										}
									}
									else {
										echo '<center><h4>Please select the character you want to kick.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=kick" method="post">';
										echo 'Character: <select name="kickchar">';
										foreach($guild_rank as $id => $info)
										{
											$query = sqlquery('SELECT `name`, `rank_id`, `guildnick` FROM `players` WHERE `rank_id` = '. $id .'');
											while($row = mysql_fetch_array($query)) {
												echo '<option value="'. $row['name'] .'">'. $row['name'] .'</option>';
											}
										}
										echo '</select>';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'"/>';
										echo '<br /><br /><input type="submit" value="Kick" />';
										echo '</form></center>';
									}
									break;
								case "alter":
									if($_POST['alterchar'] && $_POST['pos']){
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
											if(intval($level['level']) == 3){
												$query = sqlquery('SELECT `guild_ranks`.`level` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['alterchar']) .'\' AND `guild_ranks`.`id` = `players`.`rank_id`');
												if(mysql_num_rows($query) == 1)
													$alterlevel = mysql_fetch_array($query);
												else
													die('ERROR!');

												if((int)$alterlevel['level'] == 3){
													echo '<center><h4>Sorry, you can\'t promote or demote yourself!</h4></center>';
												}
												elseif((int)$alterlevel['level'] == 2 && $_POST['pos'] == 'promote'){
													echo '<center><h4>Sorry, you can only have one leader.</h4></center>';
												}
												elseif((int)$alterlevel['level'] == 1 && $_POST['pos'] == 'demote'){
													echo '<center><h4>Sorry, this character is already at the lowest rank.</h4></center>';
												}
												elseif((int)$alterlevel['level'] == 1 && $_POST['pos'] == 'promote'){
													sqlquery('UPDATE `players` SET `rank_id` = `rank_id` - 1 WHERE `name` = \''. mysql_real_escape_string($_POST['alterchar']) .'\'');
													echo '<center><h4>Successfully promoted player '. $_POST['alterchar'] .'.</h4></center>';
												}
												elseif((int)$alterlevel['level'] == 2 && $_POST['pos'] == 'demote'){
													sqlquery('UPDATE `players` SET `rank_id` = `rank_id` + 1 WHERE `name` = \''. mysql_real_escape_string($_POST['alterchar']) .'\'');
													echo '<center><h4>Successfully demoted player '. $_POST['alterchar'] .'.</h4></center>';
												}
												else {
													echo '<center><h4>Error! Please contact your webmaster!</h4></center>';
												}
											}
											else {
												echo '<center><h4>Sorry, only the leader can promote or demote players.</h4></center>';
											}
										}
										else {
											die('Nice hack-attempt, but didn\'t work =)');
										}
									}
									else {
										echo '<center><h4>Please type the name of the character you want to change position of.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=alter" method="post">';
										echo 'Character: <select name="alterchar">';
										foreach($guild_rank as $id => $info)
										{
											$query = sqlquery('SELECT `name`, `rank_id`, `guildnick` FROM `players` WHERE `rank_id` = '. $id .'');
											while($row = mysql_fetch_array($query)) {
												echo '<option value="'. $row['name'] .'">'. $row['name'] .'</option>';
											}
										}
										echo '</select><br />';
										echo 'Promote <input type="radio" name="pos" value="promote" /><br />';
										echo 'Demote <input type="radio" name="pos" value="demote" /><br />';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
										echo '<br /><br /><input type="submit" value="Change" />';
										echo '</form></center>';
									}
									break;
								case "title":
									if($_POST['char'] && $_POST['titlechar'] && $_POST['title']){
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
											$query = sqlquery('SELECT `guild_ranks`.`guild_id` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['char']) .'\' AND `players`.`rank_id` = `guild_ranks`.`id`');
											$check = mysql_fetch_array($query);
											$query2 = sqlquery('SELECT `guild_ranks`.`guild_id` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['titlechar']) .'\' AND `players`.`rank_id` = `guild_ranks`.`id`');
											$check2 = mysql_fetch_array($query2);
											if($check && $check2 && $check['guild_id'] == $check2['guild_id']){
												$newtitle = "";
												if(isset($_POST['title']))
													$newtitle = $_POST['title'];
												sqlquery('UPDATE `players` SET `guildnick` = \''. mysql_real_escape_string($newtitle) .'\' WHERE `name` = \''. mysql_real_escape_string($_POST['titlechar']) .'\'') or die('Couldn\'t change title, please contact the webmaster. (Error: '.mysql_error().' ('.mysql_errno().'))');
												if($newtitle == "")
													echo '<center><h4>Successfully cleared the title of '. $_POST['titlechar'] .'.</h4></center>';
												else
													echo '<center><h4>Successfully changed the title of '. $_POST['titlechar'] .' to '. $newtitle .'</h4></center>';
											}
											else {
												echo '<center><h4>'. $_POST['titlechar'] .' is not in your guild!</h4></center>';
											}
										}
										else {
											die('Nice hack-attempt, but didn\'t work =)');
										}
									}
									else {
										echo '<center><h4>Please select the character you want to change title of.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=title" method="post">';
										echo 'Character: <select name="titlechar">';
										foreach($guild_rank as $id => $info)
										{
											$query = sqlquery('SELECT `name`, `rank_id`, `guildnick` FROM `players` WHERE `rank_id` = '. $id .'');
											while($row = mysql_fetch_array($query)) {
												echo '<option value="'. $row['name'] .'">'. $row['name'] .'</option>';
											}
										}
										echo '</select><br />';
										echo 'Title(leave empty to remove): <input type="text" name="title" /><br />';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
										echo '<br /><br /><input type="submit" value="Change" />';
										echo '</form></center>';
									}
									break;
								case "pass":
									if($_POST['newleader']){
										if(($_POST['agreeacc'] == $_SESSION['M2_account']) && ($_POST['agreepass'] == $_SESSION['M2_password'])){
											$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
											mysql_select_db($sql_db, $sqlconnect);
											if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
												$query = sqlquery('SELECT `guild_ranks`.`level` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['char']) .'\' AND `guild_ranks`.`id` = `players`.`rank_id`');
												if(mysql_num_rows($query) == 1)
													$passlevel = mysql_fetch_array($query);
												else
													die('ERROR!');

												if((int)$passlevel['level'] == 3){
													$query = sqlquery('SELECT `guild_ranks`.`guild_id` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['char']) .'\' AND `players`.`rank_id` = `guild_ranks`.`id`');
													$check = mysql_fetch_array($query);
													$query2 = sqlquery('SELECT `guild_ranks`.`guild_id` FROM `guild_ranks`, `players` WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['newleader']) .'\' AND `players`.`rank_id` = `guild_ranks`.`id`');
													$check2 = mysql_fetch_array($query2);
													if($check && $check2 && $check['guild_id'] == $check2['guild_id']){
														sqlquery('UPDATE `players` SET `rank_id` = '. intval($level['id']) .' WHERE `players`.`name` = \''. mysql_real_escape_string($_POST['newleader']) .'\' ');
														sqlquery('UPDATE `guilds` SET `ownerid` = '. userByID(mysql_real_escape_string($_POST['newleader'])) .' WHERE `ownerid` = '. userByID(mysql_real_escape_string($_POST['char'])) .'');
														sqlquery('UPDATE `players` SET `rank_id` = `rank_id` + 1 WHERE `name` = \''. mysql_real_escape_string($_POST['char']) .'\'');
														echo '<center><h4>Successfully made '. $_POST['newleader'] .' as the new leader of the guild.';
													}
													else {
														echo '<center><h4>Sorry, that character is not in your guild.</h4></center>';
													}
												}
												else {
													echo '<center><h4>Sorry, only the leader can pass the leadership.</h4></center>';
												}
											}
											else {
												die('Nice hack-attempt, but didn\'t work =)');
											}
										}
										else {
											echo '<center><h4>Please type your account number and password to pass the leadership.</h4><br />';
											echo '<form action="guilds.php?act=manage&sub=pass" method="post">';
											echo 'Account Number: <input type="password" name="agreeacc" /><br />';
											echo 'Account Password: <input type="password" name="agreepass" /><br />';
											echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
											echo '<input type="hidden" name="newleader" value="'. $_POST['newleader'] .'" />';
											echo '<br /><br /><input type="submit" value="Pass Leadership" />';
											echo '</form></center>';
										}
									}
									else {
										echo '<center><h4>Please select the character you want to pass the leadership to.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=pass" method="post">';
										echo 'New Leader: <select name="newleader">';
										foreach($guild_rank as $id => $info)
										{
											$query = sqlquery('SELECT `name`, `rank_id`, `guildnick` FROM `players` WHERE `rank_id` = '. $id .'');
											while($row = mysql_fetch_array($query)) {
												echo '<option value="'. $row['name'] .'">'. $row['name'] .'</option>';
											}
										}
										echo '</select><br />';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
										echo '<br /><br /><input type="submit" value="Pass Leadership" />';
										echo '</form></center>';
									}
									break;
								case "rank":
									if($_POST['rank_leader'] && $_POST['rank_vice'] && $_POST['rank_member']){
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
											if($level['level'] == 3){
												sqlquery('UPDATE `guild_ranks` SET `name` = \''. mysql_real_escape_string($_POST['rank_leader']) .'\' WHERE `guild_id` = '. intval($level['guild_id']) .' AND `level` = 3');
												sqlquery('UPDATE `guild_ranks` SET `name` = \''. mysql_real_escape_string($_POST['rank_vice']) .'\' WHERE `guild_id` = '. intval($level['guild_id']) .' AND `level` = 2');
												sqlquery('UPDATE `guild_ranks` SET `name` = \''. mysql_real_escape_string($_POST['rank_member']) .'\' WHERE `guild_id` = '. intval($level['guild_id']) .' AND `level` = 1');
												echo '<center><h4>Successfully changed the rank names.</h4></center>';
											}
											else {
												echo '<center><h4>Sorry, only the guild leader can edit ranks.</h4></center>';
											}
										}
										else {
											die('Nice hack-attempt, but didn\'t work =)');
										}
									}
									else {
										$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
										mysql_select_db($sql_db, $sqlconnect);
										$query = sqlquery('SELECT `name` FROM `guild_ranks` WHERE `guild_id` = '. intval($level['guild_id']) .' AND `level` = 3');
										$leader = mysql_fetch_array($query);
										$query = sqlquery('SELECT `name` FROM `guild_ranks` WHERE `guild_id` = '. intval($level['guild_id']) .' AND `level` = 2');
										$vice = mysql_fetch_array($query);
										$query = sqlquery('SELECT `name` FROM `guild_ranks` WHERE `guild_id` = '. intval($level['guild_id']) .' AND `level` = 1');
										$member = mysql_fetch_array($query);
										
										echo '<center><h4>Please fill this form to edit rank-names.</h4><br />';
										echo '<form action="guilds.php?act=manage&sub=rank" method="post">';
										echo 'Leader: <input type="text" name="rank_leader" value="'.$leader['name'].'" /><br />';
										echo 'Vice-Leader: <input type="text" name="rank_vice" value="'.$vice['name'].'" /><br />';
										echo 'Member: <input type="text" name="rank_member" value="'.$member['name'].'" /><br />';
										echo '<input type="hidden" name="char" value="'. $_POST['char'] .'" />';
										echo '<br /><br /><input type="submit" value="Edit" />';
										echo '</form></center>';
									}
									break;
							}
						}
						else {
							echo '<center><h4>Sorry, your rank in the guild is not high enough.</h4></center>';
						}
					}
					else {
						$chars = getChars($_SESSION['M2_account']);
						echo '<center><form action="guilds.php?act=manage" method="post">';
						echo 'Character: <select name="char">';
						foreach($chars as $char){
							echo '<option value="'. $char .'">'. $char .'</option>';
						}
						echo '</select>';
						echo '<br /><br /><input type="submit" value="Continue" />';
						echo '</form></center>';
					}
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
							echo '<center><h4>That character is already in a guild!</h4></center>';
						}
						else {
							$query = sqlquery('SELECT `name` FROM `guilds` WHERE `name` = \''. mysql_real_escape_string($_POST['guildname']) .'\'');
							$guildcheck = mysql_fetch_array($query);
							if($guildcheck[0]) {
								echo 'That guildname already exist.';
							}
							else {
								$query = sqlquery('INSERT INTO `guilds` (`name`, `ownerid`, `creationdata`) VALUES(\''. mysql_real_escape_string($_POST['guildname']) .'\', '. userByID(mysql_real_escape_string($_POST['char'])) .', '. time() .')') or die('<center>Couldn\'t create the guild, please contact the webmaster!</center> ('.mysql_error().' ('.mysql_errno().'))');
								$query2 = sqlquery('UPDATE `players`, `guild_ranks`, `guilds` SET `players`.`rank_id` = `guild_ranks`.`id` WHERE `players`.`id` = '. userByID(mysql_real_escape_string($_POST['char'])) .' AND `guilds`.`ownerid` = `players`.`id` AND `guild_ranks`.`guild_id` = `guilds`.`id` AND `guild_ranks`.`level` = 3') or die('<center>Couldn\'t create the guild, please contact the webmaster!</center> ('.mysql_error().' ('.mysql_errno().'))');
								echo '<center><h4>The guild has been made. <a href="guilds.php?act=manage">Click here</a> to manage it.</h4></center>';
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
							
								sqlquery('UPDATE `players` SET `rank_id` = 0 WHERE `id` = '. userByID(mysql_real_escape_string($_POST['char'])) .'');
								echo '<center><h4>You have left your guild.</h4></center>';
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
			case "join":
				if(!$_SESSION['M2_account'] || !$_SESSION['M2_password']){ // not logged in
					echo "<center><a href=\"../Manager/loginInterface.php\">Please login first!</a></center>";
				}
				else { // logged in
					if($_POST['char']){
						if($_POST['guild_id']){
							$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
							mysql_select_db($sql_db, $sqlconnect);
							if(in_array($_POST['char'], getChars($_SESSION['M2_account']))){
								sqlquery('UPDATE `players`, `guild_ranks`, `guild_invites` SET `players`.`rank_id` = `guild_ranks`.`id` WHERE `players`.`id` = `guild_invites`.`player_id` AND `guild_invites`.`guild_id` = '. intval($_POST['guild_id']) .' AND `guild_ranks`.`guild_id` = `guild_invites`.`guild_id` AND `guild_ranks`.`level` = 1') or die('<center><h4>Error! Couldn\'t join the guild, please contact the webmaster! ('.mysql_error().' ('.mysql_errno().'))</h4></center>');
								sqlquery('DELETE FROM `guild_invites` WHERE `player_id` = '. userByID(mysql_real_escape_string($_POST['char'])) .' AND `guild_id` = '. intval($_POST['guild_id']) .'') or die('<center><h4>Error! Couldn\'t join the guild, please contact the webmaster! ('.mysql_error().' ('.mysql_errno().'))</h4></center>');
								
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
									<td><center><form action="guilds.php?act=join" method="post"><input type="hidden" name="guild_id" value="'. $row['guild_id'] .'" /><input type="hidden" name="char" value="'. $_POST['char'] .'"/><input type="submit" value="Join"/></form></center></td>
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
		}
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>