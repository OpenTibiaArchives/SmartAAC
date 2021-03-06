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
$error = 0;
$created_Account = false;

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

$M2_account = $_POST['M2_account'];
$M2_password = $_POST['M2_password'];
$M2_email = $_POST['M2_email'];


if ( (isset($M2_account) && !empty($M2_account)) && (isset($M2_password) && !empty($M2_password)) && (isset($M2_email) && !empty($M2_email)) )
{
	if($aac_imgver)
	{
		// New system for image verification; CAPTCHA
		$string = strtoupper($_SESSION['string']);
		$userstring = strtoupper($_POST['userstring']); 
		session_destroy();   

		if ($string != $userstring) 
		{
			die("The image verification code you entered is <b>not</b> correct!");
		}
	}

	if ( !$aac_randomaccnum && (strlen($M2_account) < $aac_minacclen || strlen($M2_account) > $aac_maxacclen) )
	{
		echo "<font color=\"red\">Error! Your account number is either too short or too long!</font><br><br>";
		$error = 1;
	}
	elseif ( !$aac_randomaccnum && !is_numeric($M2_account) )
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
		if($aac_md5passwords)
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
				if($aac_randomaccnum) {
					$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error 								(mysql_errno()).\n");
					mysql_select_db($sql_db, $sqlconnect);
					$random = rand(0, 999999);
					$accno = $random;
					$query = sqlquery('SELECT `id` FROM `accounts`');
					$used = array();
					while($row = mysql_fetch_array($query)){
						$used[ $row['id'] ] = true;
					}

					while(true)
					{
						if($used[$accno])
						{
							$accno++;
						}
						// If we have got to an account number that doesn't exist, break the while statement, YAY we got a number!
						elseif(!$used[$accno])
						{
							break;
						}
		
						// we need to re-set
						if($accno > 999999)
						{
							$accno = 0;
						}

						// we checked all possibilities
						if($accno == $random)
						{
							die('Sorry... there are no free account number at the moment, lol :D.');
						}
					}
					$M2_account = $accno;
				}
				sqlquery('INSERT INTO `accounts` ( id, password , email , blocked )
					VALUES ( ' . intval($M2_account) . ', \'' . mysql_real_escape_string($M2_password) . '\', \'' . mysql_real_escape_string($M2_email) . '\', 0 );');
				
				$reckey = createRecoveryKey();
				while(true)
				{
					$result = sqlquery("SELECT * FROM `accounts` WHERE `recovery` = '$reckey';");
					$rowz = mysql_num_rows($result);
					if($rowz == 1)
					{
						$reckey = createRecoveryKey();
					}
					elseif($rowz == 0)
					{
						break;
					}
				}
			
				sqlquery('UPDATE `'.$sql_db.'`.`accounts` SET `recovery` = \''.$reckey.'\' WHERE `accounts`.`id` ='.intval($M2_account).' LIMIT 1 ;');
			
				$created_Account = true;
				session_unset();
			//	doInfoBox("Your account has been successfully created. Login <a href=\"loginInterface.php\">here</a> to create your first character in the account!<br><br>
			//		Your account number is: $M2_account</font>");
				echo '<meta http-equiv="refresh" content="0;url=index.php?act=login&key='.$reckey.'&acc='.$M2_account.'" />';
			}
		}
	}
}

if (!$created_Account)
{

$title = 'Register';
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

echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');
?>

<h2>Please fill out the appropriate fields:</h2>
<br />

<form action="<?php echo $PHP_SELF; ?>" method="POST">

	<table style="text-align: left; width: 492px;" border="0"
	 cellpadding="2" cellspacing="2">
	  <tbody>
	    <tr>
	      <td>Account Number: </td>
<?php

if(!$aac_randomaccnum)
{
	echo '<td><input name="M2_account" type="text" maxlength="' . $aac_maxacclen . '" class="textfield"></td>
	<td style="width: 218px;"><font color="red">* <i>('.$aac_minacclen .' - '. $aac_maxacclen.' numbers)</i></font></td>';
}
?>

	     	      
	    </tr>
	    <tr>
	      <td>Password: </td>
	      <td><input name="M2_password" type="password" maxlength="<?php echo $aac_maxpasslen; ?>" class="textfield"></td>
	      <td style="width: 218px;"><font color="red">* <i>(<?php echo "$aac_minpasslen - $aac_maxpasslen characters"; ?>)</i></font></td>
	    </tr>
	    <tr>
	      <td>Email: </td>
	      <td><input name="M2_email" type="text" class="textfield"></td>
	      <td style="width: 218px;"></td>
	    </tr>
	  </tbody>
	</table>
<br />

<?PHP
if($aac_imgver)
{
echo '<br />
      <p><img src="../Includes/imgverification/imagebuilder.php" border="1" alt="Image Verification is missing, please contact the administrator">
      <p>Enter the verification code:<br>
        <input MAXLENGTH=8 SIZE=8 name="userstring" type="text" value="">
        <br>	
';
}
?>
	
	<br />
	<input type="Submit" value="Register">
	</form>



<?PHP
include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>