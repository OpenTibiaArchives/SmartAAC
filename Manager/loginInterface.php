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

$title = 'Login';
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

$reckey = $_GET['key'];
$creatednumber = $_GET['acc'];
$M2_account = $_SESSION['M2_account'];
$M2_password = $_SESSION['M2_password'];

if (!(isset($M2_account) && isset($M2_password) && $M2_account != null && $M2_account != "" && $M2_password != null && $M2_password != ""))
{
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');
?>
<h2>Login to your account:</h2><br />
<?php
if(isset($reckey)) {
	if(isset($creatednumber)) {
		echo "<b>Account created!<br /><br />Your recovery key is: <font size=\"+1\">$reckey</font>. <br />Your account number is<font size=\"+1\">$creatednumber</font></b>.<br /><br />";
	}
	else {
	echo "<b>Account created!<br /><br />Your recovery key is: <font size=\"+1\">$reckey</font>. <br />Please keep this safe and discreet.</b><br /><br />";
	}
}
?>

	<form action="index.php?act=auth" method="POST">
	<table>
	<tr>
	<td><label>Account number: </label></td><td><input name="M2_account" type="password" maxlength="<?php echo $aac_maxacclen; ?>"></td>
	</tr>
	<tr>
	<td><label>Password: </label></td><td><input name="M2_password" type="password" maxlength="<?php echo $aac_maxpasslen; ?>"></td>
	</tr>
	</table>
	<br>
	<input type="submit" name="submit" class="plswhy" value="Login">
	</form>
<?
include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
else
{
	header("Location: accountManager.php");
}
?>