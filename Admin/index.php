<?PHP

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php");
}
// Logged in
else
{
	/*echo 'You are <strong><?=$_COOKIE["logged_in"]?></strong>.<br /><br />
	<a href="login.php?logout=yes" title="Logout">Logout</a>';
	
	echo "<br /><br /><a href=\"checkversion.php\">Check Version here</a>";*/
	
	header("location: admin.php");
}

?>