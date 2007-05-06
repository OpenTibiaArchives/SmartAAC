<?
/**********************************
* Smart-Ass
* http://smart.pekay.co.uk
**********************************
* 
*
* Author: Pekay
* Version: 1.0
* Package otaac
*
* 
* Description: resources for coding Smart-Ass

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

function sqlquery($query) {
	$result = mysql_query($query);
	if(!$result)
	{
	echo '<font style="font-family: Verdana; size: 12px;">';
	echo 'MySQL error #' . mysql_errno() . '.<br><br> ' . mysql_error();
	echo '</font>';
	}

	return $result;
}

function appendData($file, $content)
{
	$myFile = $file;
	$fh = fopen($myFile, 'a') or die("can't open file");


	fwrite($fh, $content);
	fclose($fh);
}

function writeData($file, $content)
{
	$myFile = $file;
	$fh = fopen($myFile, 'w') or die("can't open file");


	fwrite($fh, $content);
	fclose($fh);
}

function readOutData($file)
{
	$fh = fopen($file, 'r');
	$theData = fgets($fh);
	fclose($fh);

	// echo $theData;
}


function status($ip,$port,$timeout = 10)
{
	$connect =  @fsockopen("$server", $port, $errno, $errstr, $timeout); 
   
	if(!$connect)
	{ 
		echo "<font color=red>$servername is offline</font>"; 
	} 
	else
	{ 
		echo "<font color=green>$servername is online</font>"; 
	} 

}

function highscore($skill, $page)
{
	include '../conf.php';
	if(!is_numeric($page) || $page == 0)
		$page = 1;
	$show = intval($page * $main_highscores_result);
	if($page == 1)
		$from = 0;
	else
		$from = intval($show - $main_highscores_result + 1);
	$i = 1;
	
	switch($skill){
		case "fist":
			$id = 0;
			break;
		case "club":
			$id = 1;
			break;
		case "sword":
			$id = 2;
			break;
		case "axe":
			$id = 3;
			break;
		case "distance":
			$id = 4;
			break;
		case "shielding":
			$id = 5;
			break;
		case "fishing":
			$id = 6;
			break;
	}
	
	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
	mysql_select_db($sql_db, $sqlconnect);
	if($skill == "level")
	{
		$query = sqlquery('SELECT `name`, `group_id`, `level`, `experience` FROM `players` WHERE `group_id` < '.$main_ugrp_nolist.' ORDER BY `experience` DESC LIMIT '.$from.','.$show.' ;');
		while($row = mysql_fetch_array($query)) {
			echo '
			<tr>
			<td><center>'. $i .'</center></td>
			<td><center><a href="character.php?name='.$row['name'].'">'. $row['name'] .'</a></center></td>
			<td><center>'. $row['level'] .'</center></td>
			<td><center>'. $row['experience'] .'</center></td>
			</tr>
			';
			$i++;
		}
	}
	elseif($skill == "magic")
	{
		$query = sqlquery('SELECT `name`, `group_id`, `maglevel` FROM `players` WHERE `group_id` < '.$main_ugrp_nolist.' ORDER BY `maglevel` DESC LIMIT '.$from.','.$show.' ;');
		while($row = mysql_fetch_array($query)) {
			echo '
			<tr>
			<td><center>'. $i .'</center></td>
			<td><center><a href="character.php?name='.$row['name'].'">'. $row['name'] .'</a></center></td>
			<td><center>'. $row['maglevel'] .'</center></td>
			</tr>
			';
			$i++;
		}
	}
	else //skills
	{ // Todo: check player group_id
		$query = sqlquery('SELECT * FROM `player_skills` WHERE `skillid` = '.$id.' ORDER BY `player_skills`.`value` DESC LIMIT '.$from.','.$show.' ;');
		while($row = mysql_fetch_array($query)) {
			echo '
			<tr>
			<td><center>'. $i .'</center></td>
			<td><center><a href="character.php?name='.userFromID($row['player_id']).'">'. userFromID($row['player_id']) .'</a></center></td>
			<td><center>'. $row['value'] .'</center></td>
			</tr>
			';
			$i++;
		}
	}
}

function userFromID($id)
{
	include '../conf.php';

	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
	mysql_select_db($sql_db, $sqlconnect);
	$query = sqlquery('SELECT `name` FROM `players` WHERE `id` = '.$id.'');
	while($row = mysql_fetch_array($query)) {
		return $row['name'];
	}
	return false;
}

function userByID($name)
{
	include '../conf.php';
	
	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
	mysql_select_db($sql_db, $sqlconnect);
	$query = sqlquery('SELECT `id` FROM `players` WHERE `name` = '.$name.'');
	while($row = mysql_fetch_array($query)) {
		return $row['id'];
	}
	return false;
}

function skills($skill)
{
	if($skill == "level" || $skill == "magic" || $skill == "fist" || $skill == "club" || $skill == "sword" || $skill == "axe" || $skill == "distance" || $skill == "shielding" || $skill == "fishing")
	{
		return "$skill";
	}

	return "level";
}

?>