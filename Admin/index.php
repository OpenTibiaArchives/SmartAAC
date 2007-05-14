<?
	if(!isset($_COOKIE["logged_in"]) || $_COOKIE["logged_in"] == "") {
?>
You are not logged in.<br /><br />
<a href="login.php" title="Login">Login</a>
<?
	} else {
?>
You are logged in as <strong><?=$_COOKIE["logged_in"]?></strong>.<br /><br />
<a href="login.php?logout=yes" title="Logout">Logout</a>
<?
	}
?>