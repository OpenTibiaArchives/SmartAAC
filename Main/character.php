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
	header("location: ../Main/maintenance.php");
}


$xml_data = file_get_contents($aac_dataDir . '/world/'. $aac_mapname .'-house.xml');

$title = 'Search Character';
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

if($modules_charsearch)
{
	$xml = simplexml_load_string($xml_data);
	$xml2 = new SimpleXMLElementExtended($xml_data);

	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
	mysql_select_db($sql_db, $sqlconnect);

	$char = $_REQUEST['char'];
	echo '<center>';
	if(isset($char)) {
		$query = sqlquery('SELECT * FROM `players` WHERE `name` = \''. mysql_real_escape_string($char) .'\' LIMIT 1;');
		if(mysql_num_rows($query) == 1) {
			while($row = mysql_fetch_array($query)) {
				$pid = $row['id'];
				$accno = $row['account_id'];
				$name = $row['name'];
				$groupid = $row['group_id'];
				$sex = $row['sex'];
				$vocation = $row['vocation'];
				$level = $row['level'];
				$town = $row['town_id'];
				$guild = $row['rank_id'];
				$guild_nick = $row['guildnick'];
				$lastlogin = $row['lastlogin'];
			}
			echo '<h2>Character Information:</h2>';
			echo '<table width=350px><tr><tr><td width=200px>Name: </td><td width=300px>'.$name.'<br/></td></tr>';
			$getsex = array("Female", "Male", "Male");
			echo '<tr><td width=200px>Sex:</td><td width=300px>'.$getsex[$sex].'<br /></td></tr>';
			$vocations = array("None", "Sorcerer", "Druid", "Paladin", "Knight", "Master Sorcerer", "Elder Druid", "Royal Paladin", "Elite Knight");
			echo '<tr><td width=200px>Profession:</td><td width=300px>'.$vocations[$vocation].'<br /></td></tr>';
			echo '<tr><td width=200px>Level:</td><td width=300px>'.$level.'<br /></td></tr>';
			echo '<tr><td width=200px>Residence:</td><td width=300px>'.$main_towns[$town].'<br /></td></tr>';

			$query = sqlquery('SELECT `id` FROM `houses` WHERE `owner` = '. $pid .'');
			if(mysql_num_rows($query) >= 1) {
				while($row = mysql_fetch_array($query)) {
					$hid = $row['id'];
				}
				if(file_exists($aac_dataDir . '/world/'. $aac_mapname .'-house.xml'))
				{
					$scan_limit = $xml2->getChildrenCount();
		
					for($i = 0; $i < $scan_limit; $i++)
					{
						if($xml2->house[$i]->getAttribute('houseid') == $hid)
							echo '<tr><td width=200px>House:</td><td width=300px>'.$xml2->house[$i]->getAttribute('name').'<br /></td></tr>';
					}
				}
			}
			
			$query = sqlquery('SELECT `guilds`.`name` AS `guildname`, `guild_ranks`.`name` AS `guildrank` FROM `guilds`, `guild_ranks` WHERE `guild_ranks`.`id` = '.intval($guild).' AND `guild_ranks`.`guild_id` = `guilds`.`id`');
			while($guildrow = mysql_fetch_array($query)) {
				$guild_name = $guildrow['guildname'];
				$guild_rank = $guildrow['guildrank'];
			}
			if($guild_name && $guild_rank) {
				echo '<tr><td width=200px>Guild membership:</td><td width=300px> '. $guild_rank .' of the <a href="guilds.php?act=view&guild='.$guild_name.'">'.$guild_name.'</a>';
				if(!empty($guild_nick))
					echo ' ('. $guild_nick .')';
				echo '<br /></td></tr>';
			}
			if($lastlogin == 0)
			{
				$lastlog = "Never";
			}
			else
			{
				$lastlog = date('M d Y, H:i:s T', $lastlogin);
			}
			echo '<tr><td width=200px>Last login:</td><td width=300px>'.$lastlog.'<br /></td></tr>';
			echo '</table>';
			echo '<br><br>';
			echo '<h2>Account Information:</h2>';
			$query = sqlquery('SELECT * FROM `accounts` WHERE `id` = '. intval($accno) .' LIMIT 1;');
			if(mysql_num_rows($query) == 1) {
				while($row = mysql_fetch_array($query)) {
					$email = $row['email'];
					$premdays = $row['premdays'];
				}
			}
			echo '<table width=350px><tr>';
			if($email) {
			if($main_showemails) {
				echo '<tr><td width=200px>Email:</td><td width=300px>'.$email.'<br /></td></tr>';
			} }
			if($premdays >= 1)
				echo '<tr><td width=200px>Account Status:</td><td width=300px>Premium Account<br /></td></tr>';
			else
				echo '<tr><td width=200px>Account Status:</td><td width=300px>Free Account<br /></td></tr>';
			$query = sqlquery('SELECT `name` FROM `groups` WHERE `id` = '. intval($groupid) .' LIMIT 1;');
			if(mysql_num_rows($query) == 1) {
				while($row = mysql_fetch_array($query)) {
					$groupname = $row['name'];
				}
			}
			echo '<tr><td width=200px>Position:</td><td width=300px>'.$groupname.'<br /></td></tr>';
			$query = sqlquery('SELECT `time` FROM `bans` WHERE `player` = \''. mysql_real_escape_string($name) .'\' OR `account` = '. intval($accno) .' LIMIT 1;');
			while($row = mysql_fetch_array($query)) {
				$bantime = $row['time'];
			}
			if($bantime > 0)
				echo '<tr><td width=200px><font color="red">Banned until:</font></td><td width=300px><font color="red">'.date('M d Y, H:i:s T', $bantime).'</font><br /></td></tr>';
			echo '</table>';
			echo '<br><br>';
			echo '<table width=350px><tr>';
			echo '<h2>Characters:</h2>';
			$query = sqlquery('SELECT `name` FROM `players` WHERE `account_id` = '. intval($accno) .'');
			while($row = mysql_fetch_array($query)) {
				echo '<tr><td width=200px>'.$row['name'].'</td><td width=300px><a href="character.php?char='.$row['name'].'">View</a><br /></td></tr>';
			}
			echo '</table>';
		}
		else {
			$query = sqlquery('SELECT * FROM `players` WHERE `name` like \'%'. mysql_real_escape_string($char) .'%\'');
			if(mysql_num_rows($query) != 0) {
				echo '
	<center>
	<h2>Character not found, here are similar matches:</h2><br />
	
	<table style="text-align: left; width: 20%;" border="0" cellpadding="0" cellspacing="2">
	<tbody>
	<tr>
	<td style="width: 25%;">Name</td>
	<td style="width: 20%;">Level</td>
	<td style="width: 30%;">Vocation</td>
	</tr>
	</tbody>';
				$vocations = array("None", "Sorcerer", "Druid", "Paladin", "Knight", "Master Sorcerer", "Elder Druid", "Royal Paladin", "Elite Knight");
				while($row = mysql_fetch_array($query)) {
					echo '<tr>
					<td><center><a href="character.php?char='.$row['name'].'">'. $row['name'] .'</a></center></td>
					<td><center>'. $row['level'] .'</center></td>
					<td><center>'. $vocations[$row['vocation']] .'</center></td>
					</tr>';
				}

				echo '</table></center>';
			}
			else {
				echo '<center><h3>Character does not exist.</h3></center>';
			}
		}
	}
	echo '
	<br>
	<h1><font color="black">Search Character</font></h1><br>
	<form action="character.php" method="get">	
	<input type="text" name="char" maxlength="'.$aac_maxplayerlen.'" />
	<input type="submit" value="Search" />
	</form>
	</center>
	';
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>