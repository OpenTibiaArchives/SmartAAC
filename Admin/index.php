<?PHP

// Not logged in
if(!isset($_COOKIE["logged_in"]) || $_COOKIE["logged_in"] == "")
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