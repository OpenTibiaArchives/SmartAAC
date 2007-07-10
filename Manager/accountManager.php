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

include "../Includes/resources.php";
include '../conf.php';
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

$title = 'Account Details';
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


echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');
?>
<h1>Your Account</h1><br>

<h2>Characters:</h2><br />
<table style="text-align: left; width: 348px;" border="0"
 cellpadding="2" cellspacing="2">
  <tbody>
<?php

$vocations = array("None", "Sorcerer", "Druid", "Paladin", "Knight", "Master Sorcerer", "Elder Druid", "Royal Paladin", "Elite Knight");

$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error (mysql_errno()).\n");
mysql_select_db($sql_db, $sqlconnect);

$result = sqlquery('SELECT * FROM `accounts` WHERE `id` = ' . intval($M2_acc) . '');
$rowz = mysql_num_rows($result);
if($rowz == 1)
{
	$chars = sqlquery('SELECT `name` FROM `players` WHERE `account_id` = ' . intval($M2_acc) . '');
	$char_count = 0;
	while ($line = mysql_fetch_array($chars, MYSQL_ASSOC))
	{
		foreach ($line as $char)
		{
			$query = sqlquery('SELECT * FROM `players` WHERE `name` = \''. mysql_real_escape_string($char) .'\' LIMIT 1;');
			if(mysql_num_rows($query) == 1)
			{
				echo "
					<tr>
				      <td style=\"width: 231px; height: 20px;\" class=\"lolhovermanager\"><a href=\"../Main/character.php?char=$char\" target=\"_blank\"><b>$char</b></a></td>
				      <td style=\"width: 106px; text-align: center; background: #EFFFF0;\"><a href=\"index.php?act=delete&char=$char\">Delete?</a></td>
				    </tr>
					<tr>
				      <td>&nbsp;</td>
				      <td>&nbsp;</td>
					</tr>

					";
				$char_count++;
			
			}
		}
	}
}

// Extra
//<br /><i>Level: $level<br />Vocation: $vocations[$vocation]<br />Town: $main_towns[$town]</i>

?>
  </tbody>
</table>
<?php
if($char_count == 0)
{
	echo "<b>You have no characters in your account. Why not <a href=\"index.php?act=addchar\">create</a> one?</b><br />";
}
elseif($char_count == 1)
{
	echo "You have 1 character in this account.";
}
else
{
	echo "You have $char_count characters in this account.";
}
?>



<!-- menu -->
<br /><br />
<h2>Dashboard:</h2><br />

<ul>
<li><a title="Create a new character on <?php echo $aac_servername; ?>" href="index.php?act=addchar">Create a new character</a></li>
<li><a title="Logout your account" href="index.php?act=logout">Logout</a></li>
<li><a title="Change your password" href="index.php?act=changepassword">Change password</a></li>
</ul>




<?php
}
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarManagerLoggedIn.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>