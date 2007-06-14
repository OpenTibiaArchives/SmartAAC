<?
	/*
	Silentum LoginSys v1.0.0
	Modified May 1, 2007
	login2.php copyright 2007 "HyperSilence"
	*/
	include '../conf.php';

	// Oki so we need something unique, like a hash!
	//(20:22:22) (+Bazetts) setcookie("logged_in_user", $login_user_name, time()+60*60*24*$logged_in_for); setcookie("logged_in_pass", $login_password, time()+60*60*24*$logged_in_for); then if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != $admin_user) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] == $admin_pass))
	
	$user_name = $admin_user;
	$password = $admin_pass;

	$login_user_name = $_POST["login_user_name"];
	$login_password = $_POST["login_password"];
	$logged_in_for = $_POST["logged_in_for"];

	if($login_user_name != $user_name || $login_password != $password) {
	header("Location: login.php?message=Invalid");
	exit;
	}
	else {
	setcookie("logged_in", $login_user_name, time()+60*60*24*$logged_in_for, "/");
	header("Location: index.php");
	exit;
	}
?>