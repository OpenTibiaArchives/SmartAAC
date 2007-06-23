<?php
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

include "../Includes/resources.php";
include "../conf.php";
session_start();

if($aac_status == "Not Installed")
{
	die("Your AAC is not yet installed, please goto the installer");
}

$M2_account = $_REQUEST['M2_account'];
$M2_password = $_REQUEST['M2_password'];

if (isset($M2_account) && is_numeric($M2_account) && isset($M2_password))
{
	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error (mysql_errno()).\n");
	mysql_select_db($sql_db, $sqlconnect);

	$result = sqlquery('SELECT * FROM `accounts` WHERE `id` = ' . intval($M2_account) . '');
	$rowz = mysql_num_rows($result);
	if($rowz == 1) // Check if the file exists first
	{
		$pass = sqlquery('SELECT * FROM `accounts` WHERE `id` = ' . intval($M2_account) . '');
		while ($row = mysql_fetch_assoc($pass))
		{
			$passw = $row["password"];
		}

		if($aac_md5passwords)
		{
			$M2_password = md5($M2_password);
		}
		
		if($M2_password == $passw)
		{
			$_SESSION["M2_account"] = "$M2_account";
			$_SESSION["M2_password"] = "$M2_password";
			//die("TEMP DEBUG 1:<br><br>Entered password: " . $M2_password . "<br>Actual Password:  " . $passw);
			header ("location: index.php?act=manager");
			
			$ipAddress = GetHostByName($REMOTE_ADDR);
			$hostName = GetHostByAddr($REMOTE_ADDR);
			$timeNow = date('r');
			$appendedManagerFile = fopen("../Admin/logs/manager.txt", "a");
			$write2 = "-------
SUCCESSFUL login to account $M2_account from IP: $ipAddress || Hostname: $hostName
At time: $timeNow
-------
";
			fwrite($appendedManagerFile, $write2);
			fclose($appendedManagerFile);
		}
		else
		{
			header ("location: index.php?act=login");
			
			$ipAddress = GetHostByName($REMOTE_ADDR);
			$hostName = GetHostByAddr($REMOTE_ADDR);
			$timeNow = date('r');
			$appendedManagerFile = fopen("../Admin/logs/manager.txt", "a");
			$write2 = "-------
ATTEMPTED login to account $M2_account from IP: $ipAddress || Hostname: $hostName
At time: $timeNow
-------
";
			fwrite($appendedManagerFile, $write2);
			fclose($appendedManagerFile);
			//die("Error! Wrong password.");
		}
	}
	else
	{
		header ("location: index.php?act=login");
		//echo "Debug Msg: EXIT (2)";
	}
}
else
{
	//header ("location: index.php");
	echo "There is no data. (Message 3)";
}
?>