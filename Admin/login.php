<?
	/*
	Silentum LoginSys v1.0.0
	Modified May 1, 2007
	login.php copyright 2007 "HyperSilence"
	*/
	include "../conf.php";
	$message = $_GET['message'];

	if((isset($_COOKIE["logged_in_user"]) && $_COOKIE["logged_in_user"] == md5($admin_user)) && (isset($_COOKIE["logged_in_pass"]) && $_COOKIE["logged_in_pass"] == md5($admin_pass)) && $_GET["logout"] != "yes")
	{
	header("Location: index.php");
	exit;
	}
	if($_GET["logout"] == "yes") {
	setcookie("logged_in_user", "", time()+1);
	setcookie("logged_in_pass", "", time()+1);
	header("Location: index.php");
	exit;
	}
	if($message == "notloggedin") {
	echo "Error: You are not logged in.";
	}
	if($message == "Invalid") {
	echo "Error: Invalid username or password.";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>

  <meta content="text/html; charset=ISO-8859-1" http-equiv="content-type">
  <title>Login to the admin panel</title>


  <style type="text/css">
body { font-family: Verdana,Helvetica,sans-serif;
font-size: small;
}
a { text-decoration:none; }
a:hover { text-decoration:underline; }
  </style>
</head>
<body>
<br /><br /><br />


  <table style="width: 450px; text-align: left; margin-left: auto; margin-right: auto;" cellpadding="0" cellspacing="0">
<form action="processlogin.php" name="Login" method="post">
    <tbody>
      <tr align="center">
        <td style="border: 1px solid rgb(129, 162, 196); width: 450px;"><img style="width: 450px; height: 55px;" alt="" src="../Includes/admin_imgs/logo.png"></td>
      </tr>

      <tr align="center">
        <td style="border: 1px solid rgb(129, 162, 196); width: 450px;"><img style="width: 450px; height: 25px;" alt="" src="../Includes/admin_imgs/login.png"></td>
      </tr>

      <tr>
        <td style="border: 1px solid rgb(129, 162, 196); background: rgb(239, 239, 239) none repeat scroll 0% 50%; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; width: 450px;">
        <div align="center">
        <table style="text-align: left; width: 446px; margin-left: 0px;" border="0" cellpadding="2" cellspacing="2">

          <tbody>
            <tr>
              <td style="text-align: left; width: 282px;"><small style="font-weight: bold;"><label>Username:</label></small><br>
            </td>
			
              <td style="text-align: left; width: 64px;"><input name="login_user_name" tabindex="1" type="text"></td>

            </tr>

            <tr>

              <td style="text-align: left; width: 282px;"><small style="font-weight: bold;"><label>Password:</label></small><br>

              </td>

              <td style="text-align: left; width: 64px;"><input name="login_password" tabindex="2" type="password"></td>

            </tr>
			          <tr>
            <td
 style="text-align: left; width: 64px; font-weight: bold;"><small><label>Stay
logged in for:</label></small></td>
            <td>
            <select tabindex="3" name="logged_in_for">
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


          </tbody>
        </table>

        </div>

        </td>

      </tr>

      <tr align="center">

        <td style="border: 1px solid rgb(129, 162, 196); background: rgb(239, 239, 239) none repeat scroll 0% 50%; -moz-background-clip: initial; -moz-background-origin: initial; -moz-background-inline-policy: initial; height: 29px;"><input value="Login" type="submit"><input value="Clear" type="reset"></td>

      </tr>

    </tbody>
  </table>

</form>

<br>

<div style="text-align: center;"><a href="../">Back
to AAC</a></div>

</body>
</html>
