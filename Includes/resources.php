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
	if (mysql_errno())
		echo "MySQL Error: " . mysql_error . " (" . mysql_errno() . "). Query: " . $query;

	return $result;
}

function config_newRecord($comment_explaination = "" ,$record)
{
// nothing yet
}

function customExit($errormsg)
{
	$whole_error = '<font color="red" face="Arial">' . $errormsg . '</font>';
	die($whole_error);
}

function normal($msg, $font, $size)
{
	echo '<font face="' . $font . '" size="' . $size . '" color="white">' . $msg . '</font>';
}

function heading($msg, $h_size)
{
	if ($h_size > 5)
	{
		echo "function 'heading' in font print is not correct, use less than 5";
	}
	else
	{
		echo '<h' . $h_size . '>' . $msg . '</h>';
	}
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

function doInfoBox($msg, $system_notice = true)
{
	echo '
	<table id="table1" style="border: 3px solid rgb(204, 204, 204); padding: 24px 67px; margin-top: 32px; font-size: 11px; color: rgb(51, 51, 51); font-family: Verdana; background-color: rgb(255, 255, 204);" align="center" cellpadding="0" cellspacing="0" width="450">

	<tbody><tr>
	<td valign="top" width="500">
	';
	
	if($system_notice)
	{
		echo '<center><font size="+1">System Notice</font></center><br><br>
		' . $msg . '
		</td>
		</tr>
		</tbody>

		</table>';
	}
	else
	{
		echo '
		' . $msg . '
		</td>
		</tr>
		</tbody>

		</table>';
	}
}

function displayNotification($msg)
{
	echo '<div style="BORDER-RIGHT: #6A92C9 1px dashed; BORDER-LEFT: #6A92C9 1px dashed; BORDER-TOP: #6A92C9 1px dashed; BORDER-BOTTOM: #6A92C9 1px dashed; padding-left: 6px; padding-right: 6px; padding-top: 2px; padding-bottom: 4px; background-color: #f7f7f7; font-family: Arial">
<font color="black">' . $msg . '</font>
</div>';
}

// For long breaks
function breakLines($howMany)
{
	for($i = 1; $i <= $howMany; $i++){
		echo "<br>";
	}
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

function keepCoolNotificationGo($msg)
{
	echo "<blockquote class=\"go\"><p>$msg</p></blockquote>";
}

function keepCoolNotificationExclam($msg)
{
	echo "<blockquote class=\"exclamation\"><p>$msg</p></blockquote><br>";
}
?>