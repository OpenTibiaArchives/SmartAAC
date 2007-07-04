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



$accNo = sqlquery('SELECT `id` FROM `accounts` WHERE `recovery` = \'X28BU8EV-FR8UM5IK-VKFX8MPA-3BIEHBOO\'');

echo "The key you entered is: $reckey <br /><br />";
echo "Account Number: $aacNo<br />";
echo "Password: ";

?>