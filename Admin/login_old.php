<?
	/*
	Silentum LoginSys v1.0.0
	Modified May 1, 2007
	login.php copyright 2007 "HyperSilence"
	*/

	if(isset($message))
	{
		$message = "<tr>
			<td style=\"background: #ff0; color: #000\">
			<strong>Such invalid</strong>
			</td>
		</tr>
		";
	}
	if(isset($_COOKIE["logged_in"]) && $_COOKIE["logged_in"] != "" && $_GET["logout"] != "yes") {
	header("Location: index.php");
	exit;
	}
	if($_GET["logout"] == "yes") {
	setcookie("logged_in", "", time()+60*60*24*30, "/");
	header("Location: index.php");
	exit;
	}
?>
<form action="processlogin.php" method="post">
<table border="2" cellpadding="15" cellspacing="5" style="width: 20%">
	<?=$message?>
<tr>
		<td style="background: #eee; color: #000">
		<strong>User Name</strong>:<br />
		<input maxlength="25" name="login_user_name" size="20" tabindex="1" type="text" /><br /><br />
		<strong>Password</strong>:<br />
		<input maxlength="25" name="login_password" size="20" tabindex="2" type="password" />
		</td>
	</tr>
	<tr>
		<td>
		<strong>Stay logged in for</strong>:<br />
		<select name="logged_in_for" tabindex="3">
			<option value="1">1 day</option>
			<option value="2">2 days</option>
			<option value="3">3 days</option>
			<option value="7">1 week</option>
			<option value="14">2 weeks</option>
			<option value="21">3 weeks</option>
			<option value="31">1 month</option>
			<option value="180">6 months</option>
			<option value="365">1 year</option>
		</select>
		</td>
	</tr>
	<tr>
		<td>
		<input name="submit" tabindex="4" type="submit" value="Login" />
		</td>
	</tr>
</table>
</form>