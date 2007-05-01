<?php
// M2 LOGIN SMART-ASS
// Author: Pekay/Jiddo
// Renew comments later (DEV)

// We forgot that for 1.0 xd

include "../Includes/resources.php";
include "../conf.php";
session_start();

$M2_account = $_REQUEST['M2_account'];
$M2_password = $_REQUEST['M2_password'];

if($md5_passwords_accounts)
{
	$M2_password = md5($M2_password);
}

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
			header ("location: accountManager.php");
		}
		else
		{
			header ("location: loginInterface.php");
			//die("Error! Wrong password.");
		}
	}
	else
	{
		header ("location: loginInterface.php");
		//echo "Debug Msg: EXIT (2)";
	}
}
else
{
	//header ("location: index.php");
	echo "Debug Msg: EXIT (3)";
}
?>