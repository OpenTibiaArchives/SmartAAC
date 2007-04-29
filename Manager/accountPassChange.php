<?
/**********************************
* Smart-Ass
* http://smart.pekay.co.uk
**********************************
* 
*
* Author: Pekay, Jiddo, Rifle
* Version: 1.0
* Package otaac
*
* 
* Description: Password change of SQL and XML accounts

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/
session_start();

include "../config.php";
include "../resources.php";
include '../template.php';

$template = new Template();
$template->set_rootdir("../$template_dir");

$template->set_filenames(array(
		'Top' => 'Top.tpl',
		'Bottom' => 'Bottom.tpl')
		);
		
$template->assign_vars(array(
		'CSS' => "../template/$template_curr/style.css",
		'TITLE' => "$SITETITLE",
		'TOP_HEAD' => 'Change password',
		'LINK_HOME' => '../',
		'LINK_HSCORES' => '../') );
		
		
$errors = 0;

$M2_acc = "";
$M2_pass = "";
$M2_acc = $_SESSION['M2_account'];
$M2_pass = $_SESSION['M2_password'];

if ($M2_acc != "" && $M2_acc != null && $M2_pass != "" && $M2_pass != null)
{
	$result = $_GET['result'];

	if (isset($result) && $result != "" && $result != null)
	{

		if ($result == "pass_failed")
		{
			$error = $_GET['error'];
			if (isset($error) && $error == "blank")
			{
				echo "<font color=\"red\">You have to enter both old and new password.</font><br><br>";
			}
			else if(isset($error) && $error == "wrong_old")
			{
				echo "<font color=\"red\">Your old password is not correct.</font><br><br>" . "Password entered: " . $oldpass;
			}
			else if (isset($error) && $error == "wrong_new")
			{
				echo "<font color=\"red\">Your new password is not correct.</font><br><br>";
			}
			else if (isset($error) && $error == "pass")
			{
				echo "<font color=\"red\">Error! Your new password must consist of more then 5 letters or numbers (ABC, abc, 123 and 				blankspaces)!</font><br><br>";
			}
			else
			{
				echo "<font color=\"red\">WARNING! An unknown error was returned: $error. If this happens again, please contact a gamemaster or an administrator.</font><br><br>";
			}
		}
		elseif ($result == "change")
		{
			$oldpass = $_POST['oldpass'];
				if($md5_passwords_accounts)
				{
					$oldpass = md5($oldpass);
				}
			$newpass = $_POST['newpass'];
			$newpass2 = $_POST['newpass2'];
			$temp = strspn("$newpass", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890 ");

			if (!isset($oldpass) || !isset($newpass) || !isset($newpass2))
			{
				header("location: accountPassChange.php?result=pass_failed&error=blank");
			}
			elseif ($oldpass != $M2_pass)
			{
				header("location: accountPassChange.php?result=pass_failed&error=wrong_old&entered=" . $oldpass);
			}
			elseif ($newpass != $newpass2)
			{
				header("location: accountPassChange.php?result=pass_failed&error=wrong_new");
			}
			elseif ($temp != strlen($newpass))
			{
				header("location: accountPassChange.php?result=pass_failed&error=pass");
			}
			else {
				if($SQLUSE == "no") // XML
				{
					@$filen = file_get_contents("$accdir$M2_acc.xml");
					$patterns[0] = "/pass=\"$oldpass\"/";
					
				// Check if we should encrypt the password
				if($md5_passwords_accounts)
				{
					$newpass = md5($newpass);
				}
					$replacements[0] = 'pass="'. $newpass .'"';

					$files = preg_replace($patterns, $replacements, $filen);
					$file_name = "$accdir$M2_acc.xml";
					$fp = fopen ($file_name,"w");
					fwrite ($fp,$files);
					fclose ($fp);
					session_unset();
					header("Location: index.php");
					//header("location: accountManager.php?result=pass_success");
				}
				else // SQL
				{
				if($md5_passwords_accounts)
				{
					$newpass = md5($newpass);
				}
					$sqlconnect = mysql_connect($SQLHOST, $SQLUSER, $SQLPASS) or die("MySQL Error: mysql_error (mysql_errno()).\n");
					mysql_select_db($SQLDB, $sqlconnect);

					$result = sqlquery("UPDATE accounts SET password='$newpass' WHERE accno='$M2_acc'");
					session_unset();
					header("Location: index.php");
					//header("location: accountManager.php?result=pass_success");
				}
			}
		}
		else
		{
			echo "<font color=\"orange\">Unknown contents of the result variable.</font><br><br>";
		}
	}

$template->pparse('Top');	
?>


<h2>Change password:</h2><br>

<form action="accountPassChange.php?result=change" method="POST">
<table>
<tr>
<td><p><b>Old Password:</b></td><td><input type="password" name="oldpass" maxlength="20" class="textfield"></p><br><hr></td>
</tr>
<tr>
<td><p><b>New Password:</b></td><td><input type="password" name="newpass" maxlength="20" class="textfield"></p><br><hr></td>
</tr>
<tr>
<td><p><b>New Password (again):</b></td><td><input type="password" name="newpass2" maxlength="20" class="textfield"></p><br><hr></td>
</tr>

<tr>
<td><p><input type="submit" value="Create"></p></td>
</tr>

</table>
<?
$template->pparse('Bottom');
}
?>