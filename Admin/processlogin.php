<?
	/*
	Silentum LoginSys v1.0.0
	Modified May 1, 2007
	login2.php copyright 2007 "HyperSilence"
	*/
	include '../conf.php';

	$login_user_name = $_POST["login_user_name"];
	$login_password = $_POST["login_password"];
	$logged_in_for = $_POST["logged_in_for"];

	if($login_user_name != $admin_user || $login_password != $admin_pass) {
		header("Location: login.php?message=Invalid");
		
		$ipAddress = GetHostByName($REMOTE_ADDR);
		$hostName = GetHostByAddr($REMOTE_ADDR);
		$timeNow = date('r');
		$appendedAdminFile = fopen("logs/admin.txt", "a");
		$write2 = "-------
ATTEMPTED login to the admin panel from IP: $ipAddress || Hostname: $hostName
At time: $timeNow
-------
";
		fwrite($appendedAdminFile, $write2);
		fclose($appendedAdminFile);
	
		exit;
	}
	else {
		setcookie("logged_in_user", md5($login_user_name), time()+60*60*24*$logged_in_for);
		setcookie("logged_in_pass", md5($login_password), time()+60*60*24*$logged_in_for);
		header("Location: index.php");
		
		$ipAddress = GetHostByName($REMOTE_ADDR);
		$hostName = GetHostByAddr($REMOTE_ADDR);
		$timeNow = date('r');
		$appendedAdminFile = fopen("logs/admin.txt", "a");
		$write2 = "-------
SUCCESSFUL login to the admin panel from IP: $ipAddress || Hostname: $hostName
At time: $timeNow
-------
";
		fwrite($appendedAdminFile, $write2);
		fclose($appendedAdminFile);
		exit;
	}
?>