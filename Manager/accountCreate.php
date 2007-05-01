<?php
/**********************************
* Smart-Ass
* http://smart.pekay.co.uk
**********************************
* 
*
* Author: Pekay
* Version: 1.0
* Package otaac
*
* 
* Description: account saving

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

$error = 0;
$created_Account = false;
include "../conf.php";
include "../Includes/resources.php";

$M2_account = $_POST['M2_account'];
$M2_password = $_POST['M2_password'];
$M2_email = $_POST['M2_email'];

if ( (isset($M2_account) && !empty($M2_account)) && (isset($M2_password) && !empty($M2_password)) && (isset($M2_email) && !empty($M2_email)) )
{
	if ( strlen($M2_account) < $aac_minacclen || strlen($M2_account) > $aac_maxacclen )
	{
		echo "<font color=\"red\">Error! Your account number is either too short or too long!</font><br><br>";
		$error = 1;
	}
	elseif ( !is_numeric($M2_account) )
	{
		echo "<font color=\"red\">Error! Your account number must be a number!</font><br><br>";
	}
	elseif (strlen($M2_password) < $aac_minpasslen || strlen($M2_password) > $aac_maxpasslen)
	{
		echo "<font color=\"red\">Error! Your password is either too short or too long!</font><br><br>";
		$error = 1;
	}
	elseif( !preg_match('/^[a-z0-9 ]{5,}$/', $M2_password) )
	{
		echo "<font color=\"red\">Error! Your password must consist of more then 4 letters or numbers (ABC, abc, 123 and blankspaces)!</font><br><br>";
		$error = 1;
	}
/* 	elseif( !preg_match('^([a-zA-Z0-9_\-\.])+@(([0-2]?[0-5]?[0-5]\.[0-2]?[0-5]?[0-5]\.[0-2]?[0-5]?[0-5]\.[0-2]?[0-5]?[0-5])|((([a-zA-Z0-9\-])+\.)+([a-zA-Z\-])+))$', $M2_email) )
	{
		echo "<font color=\"red\">Error! Email address is not valid!</font><br><br>";
		$error = 1;
	} */
// NO WORX
	else
	{
		if($aac_md5passwords == true)
		{
			$M2_password = md5($M2_password);
		}

		if ($error == 0)
		{
			$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error 								(mysql_errno()).\n");
			mysql_select_db($sql_db, $sqlconnect);

			$result = sqlquery('SELECT * FROM `accounts` WHERE `id` = ' . intval($M2_account) . ';');
			$rowz = mysql_num_rows($result);

			if($rowz == 1)
			{
				echo "<font color=\"red\">Error! That account already exist!</font><br><br>";
				return;
			}
			else {
				sqlquery('INSERT INTO `accounts` ( id, password , email , blocked , premdays )
					VALUES ( ' . intval($M2_account) . ', \'' . mysql_real_escape_string($M2_password) . '\', \'' . mysql_real_escape_string($M2_email) . '\', \'0\', \'0\' );');
					
				$created_Account = true;
				session_unset();
			//	doInfoBox("Your account has been successfully created. Login <a href=\"loginInterface.php\">here</a> to create your first character in the account!<br><br>
			//		Your account number is: $M2_account</font>");
			}
		}
	}
}
else
{
	// What to do here? lol :P
}

if ($created_Account != true)
{
?>
<h2>Please fill out the appropiate fields:</h2>
<br />

	<form action="<?php echo $PHP_SELF; ?>" method="POST">
	<table>
	<tr>
	<td><p>Account Number: </p></td><td><input name="M2_account" type="text" maxlength="<?php echo $aac_maxacclen; ?>" class="textfield"> <font color="red">* <i>(<?php echo "$aac_minacclen - $aac_maxacclen numbers"; ?>)</i></font></td>
	<td><p>Password: </p></td><td><input name="M2_password" type="password" maxlength="<?php echo $aac_maxpasslen; ?>" class="textfield"> <font color="red">* <i>(<?php echo "$aac_minpasslen - $aac_maxpasslen characters"; ?>)</i></font></td>
	<td><p>Email: </p></td><td><input name="M2_email" type="text" class="textfield"></td>
	</tr>
	</table>
	<br>
	<input type="Submit" value="Create Account">
	<input type="Reset" value="Clear Form">
	</form>



<?
}
?>