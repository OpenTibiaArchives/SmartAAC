<?php
// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	
//	USE OF THIS PROGRAM TO RELY ON IT FOR SERVER USE IS NOT
// 	RECOMMENDED! THIS IS FOR TESTING ONLY.
//
//	Main setup for the system
// ===========================================================
// ===========================================================
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// ===========================================================

session_start();

include "../conf.php";
include "../Includes/resources.php";
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

$title = 'Change Password';
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
			if (isset($error))
			{
				switch($error){
					case "blank":
						echo "<font color=\"red\">You have to enter both old and new password.</font><br><br>";
					case "wrong_old":
						echo "<font color=\"red\">Your old password is not correct.</font><br><br>" . "Password entered: " . $oldpass;
						break;
					case "wrong_new":
						echo "<font color=\"red\">Your new password is not correct.</font><br><br>";
						break;
					case "pass":
						echo "<font color=\"red\">Error! Your new password must consist of between $aac_minpasslen and $aac_maxpasslen letters or numbers (ABC, abc, 123 and 				blankspaces)!</font><br><br>";
						break;
					default:
						echo "<font color=\"red\">WARNING! An unknown error was returned: $error. If this happens again, please contact a gamemaster or an administrator.</font><br><br>";
						break;
				}
			}
		}
		elseif ($result == "change")
		{
			$oldpass = $_POST['oldpass'];
			if($aac_md5passwords)
			{
				$oldpass = md5($oldpass);
			}
			$newpass = $_POST['newpass'];
			$newpass2 = $_POST['newpass2'];
			
			$temp = strspn("$newpass", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890 ");

			if (!isset($oldpass) || !isset($newpass) || !isset($newpass2))
			{
				header("location: index.php?act=changepassword&result=pass_failed&error=blank");
			}
			elseif ($oldpass != $M2_pass)
			{
				header("location: index.php?act=changepassword&result=pass_failed&error=wrong_old&entered=" . $oldpass);
			}
			elseif ($newpass != $newpass2)
			{
				header("location: index.php?act=changepassword&result=pass_failed&error=wrong_new");
			}
			elseif ($temp != strlen($newpass))
			{
				header("location: index.php?act=changepassword&result=pass_failed&error=pass");
			}
			elseif (strlen($newpass) < $aac_minpasslen || strlen($newpass) > $aac_maxpasslen)
			{
				header("location: index.php?act=changepassword&result=pass_failed&error=pass");
			}
			else {
				if($aac_md5passwords)
				{
					$newpass = md5($newpass);
				}
					$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error (mysql_errno()).\n");
					mysql_select_db($sql_db, $sqlconnect);

					$result = sqlquery('UPDATE `accounts` SET `password` = \'' . mysql_real_escape_string($newpass) . '\' WHERE `id` = ' . intval($M2_acc) . '');
					session_unset();
					//header("Location: index.php?act=login");
					echo '<meta http-equiv="refresh" content="0;url=index.php?act=login">';
			}
		}
		else
		{
			echo "<font color=\"orange\">Unknown contents of the result variable.</font><br><br>";
		}
	}
	
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');
?>
<h2>Change password:</h2><br>

<form action="accountPassChange.php?result=change" method="POST">
<table>
<tr>
<td><p><b>Old Password:</b></td><td><input type="password" name="oldpass" maxlength="<?php echo $aac_maxpasslen; ?>" class="textfield"></p><br></td>
</tr>
<tr>
<td><p><b>New Password:</b></td><td><input type="password" name="newpass" maxlength="<?php echo $aac_maxpasslen; ?>" class="textfield"></p><br></td>
</tr>
<tr>
<td><p><b>New Password (again):</b></td><td><input type="password" name="newpass2" maxlength="<?php echo $aac_maxpasslen; ?>" class="textfield"></p><br></td>
</tr>

<tr>
<td><p><input type="submit" value="Create"></p></td>
</tr>

</table>
<?php
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarManagerLoggedIn.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>