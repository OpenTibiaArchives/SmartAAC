<?php
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
* Description: Main manager of an account

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

include "../Includes/resources.php";
include '../conf.php';

$M2_acc = "";
$M2_pass = "";
$M2_acc = $_SESSION['M2_account'];
$M2_pass = $_SESSION['M2_password'];

if ($M2_acc != "" && $M2_acc != null && $M2_pass != "" && $M2_pass != null) {


$login = $_GET['login'];
if ($login == "true") {
	echo "<font color=\"green\">You have successfully logged in!</font><br><br>";
}

$result = $_GET['result'];
if (isset($result) && result != "" && result != null) {

if ($result == "char_success") {
	echo "<font color=\"green\">Your character was successfully created!</font><br><br>";
}
else if ($result == "pass_success") {
	echo "<font color=\"green\">Your password has been changed.</font><br><br>";
}
}


/* 	$sqlconnect = mysql_connect($SQLHOST, $SQLUSER, $SQLPASS) or die("MySQL Error: mysql_error (mysql_errno()).\n");
	mysql_select_db($SQLDB, $sqlconnect);

	$result = sqlquery("SELECT * FROM accounts WHERE accno='$M2_acc'"); */

?>
<h2>Your Account</h2><br><br>

<p><b>Characters:</b></p>
<table>
<?

$sqlconnect = mysql_connect($SQLHOST, $SQLUSER, $SQLPASS) or die("MySQL Error: mysql_error (mysql_errno()).\n");
mysql_select_db($SQLDB, $sqlconnect);

$result = sqlquery('SELECT * FROM `accounts` WHERE `id` = \'' . mysql_real_escape_string($M2_acc) . '\'');
$rowz = mysql_num_rows($result);
if($rowz == 1)
{
	$chars = sqlquery('SELECT `name` FROM `players` WHERE `account_id` = \'' . mysql_real_escape_string($M2_acc) . '\'');
	while ($line = mysql_fetch_array($chars, MYSQL_ASSOC))
	{
		foreach ($line as $char)
		{
				echo "<tr><td><p>$char </p></td><td><p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"deletePlayer.php?char=$char\">Delete?</a></p></td></tr>";
		}
	}
}


?>
</table>

<br><br>
<hr>

<!-- menu -->

<p><b>Services:</b></p>
<p>
<ul>
<li><a title="Create a new character on <?phpecho $aac_servername;?>" href="accountAddCharacter.php">Create a new character</a></li>
<li><a title="Logout your account" href="accountLogout.php">Logout</a></li>
<li><a title="Change your password" href="accountPassChange.php">Change password</a></li>
</ul>
</p>



<?php
}
?>