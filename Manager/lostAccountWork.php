<?php

include '../conf.php';
include '../Includes/resources.php';

$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error 								(mysql_errno()).\n");
			  mysql_select_db($sql_db, $sqlconnect);

$reckey = $_POST['key'];
while(true)
{
	$result = sqlquery("SELECT * FROM `accounts` WHERE `recovery` = '$reckey';");
	$rowz = mysql_num_rows($result);
	if($rowz == 1)
	{
		$foundKey = true;
		break;
	}
	elseif($rowz == 0)
	{
		$foundKey = false;
		break;
	}
}

if($foundKey)
{
	$accNo = sqlquery('SELECT * FROM `accounts` WHERE `recovery` = \''.$reckey.'\'');
	while ($row = mysql_fetch_assoc($accNo))
	{
		$accountNo = $row["id"];
	}
	$newPass = createRandomPassword();
	sqlquery('UPDATE `'.$sql_db.'`.`accounts` SET `password` = \''.$newPass.'\' WHERE `accounts`.`id` ='.$accountNo.';');
	
	//echo "The key you entered is: $reckey <br /><br />";
	echo "Account reset, here are the credentials <br /><br />";
	echo "Account Number: $accountNo<br />";
	echo "Password: $newPass";
}
else
{
	echo "Key doesn't exist";
}

?>