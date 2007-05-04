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

function highscore($skill, $shown)
{
	for($i = 1; $i <= 5; $i++)
	{
		echo '
		<tr>
		<td style="width: 56px;">1</td>
		<td style="width: 207px;">2</td>
		<td style="width: 95px;x">3</td>
		<td style="width: 171px;">4</td>
		</tr>
		';
	}
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