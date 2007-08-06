<?php

include '../conf.php';
include '../Includes/resources.php';
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';

if($aac_status == "Not Installed")
{
	die("Your AAC is not yet installed, please goto the installer");
}

if($aac_status == "Maintenance")
{
	header("location: ../Main/maintenance.php");
}

$title = 'Lost Account';
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

$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error 								(mysql_errno()).\n");
			  mysql_select_db($sql_db, $sqlconnect);

$reckey = $_POST['key'];
$foundKey = false;
$result = sqlquery('SELECT * FROM `accounts` WHERE `recovery` = \''. mysql_real_escape_string($reckey) .'\';');
$rowz = mysql_num_rows($result);
if($rowz == 1)
{
	$foundKey = true;
}


echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');

if($foundKey)
{
	$accNo = sqlquery('SELECT * FROM `accounts` WHERE `recovery` = \''.$reckey.'\'');
	while ($row = mysql_fetch_assoc($accNo))
	{
		$accountNo = $row["id"];
	}
	$newPass = createRandomPassword();
	if($aac_md5passwords) {
		$newPass2 = md5($newPass);
		sqlquery('UPDATE `'.$sql_db.'`.`accounts` SET `password` = \''.$newPass2.'\' WHERE `accounts`.`id` ='.$accountNo.';');
	}
	else
	{
		sqlquery('UPDATE `'.$sql_db.'`.`accounts` SET `password` = \''.$newPass.'\' WHERE `accounts`.`id` ='.$accountNo.';');
	}
	
	
	//echo "The key you entered is: $reckey <br /><br />";
	echo "<p>Account reset, here are the credentials <br /><br />";
	echo "Account Number: $accountNo<br />";
	echo "Password: $newPass</p>";
}
else
{
	echo "<p>Sorry, the key you entered doesn't exist. <a href=\"lostAccount.php\">Go Back</a></p>";
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');

?>