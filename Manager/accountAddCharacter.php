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
include "../conf.php";
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

$title = 'Add Character';
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

if ($M2_acc != "" && $M2_acc != null && $M2_pass != "" && $M2_pass != null)
{
	$result = $_GET['result'];

	if (isset($result) && $result != "" && $result != null)
	{

		if ($result == "char_failed")
		{
			$error = $_GET['error'];
			if (isset($error) && $error == "exists")
			{
				echo "<font color=\"red\">There already exists another character with that name. Please choose another one.</font><br><br>";
			}
			else if(isset($error) && $error == "malformed_name")
			{
				echo "<font color=\"red\">Your character's name is not valid. Keep in mind that only letters and blankspaces are permitted. Please choose another one.</font><br><br>";
			}
			else if (isset($error) && $error == "wrong_length")
			{
				echo "<font color=\"red\">Your character's name is not valid. You must use a name with at least 2 letters and at most 20 letters. Please choose another one.</font><br><br>";
			}
			else
			{
				echo "<font color=\"red\">WARNING! An unknown error was returned: $error. If this happens again, please contact a gamemaster or an administrator.</font><br><br>";
			}
		}
		else
		{
			echo "<font color=\"orange\">Unknown contents of the result varibale.</font><br><br>";
		}
	}

echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');

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
				$char_count++;
			}
		}
	}
}

?>
<h2>Create a new character:</h2><br /><br />
<?php
if($char_count >= $aac_maxplayers)
{
	echo "Sorry! You are not allowed to make more than $aac_maxplayers players.
	<br /><a href=\"index.php?act=manager\">Go back</a>";
}
else
{
?>
<form action="index.php?act=savechar" method="POST">
<table>
<tr>
<td><p><b>Name:</b></td><td><input type="text" name="name" maxlength="<?php echo $aac_maxplayerlen; ?>" class="textfield"><font color="red"><i> (<?php echo "$aac_minplayerlen - $aac_maxplayerlen"; ?> letters and blankspaces)</p></i></font><br></td>
</tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr>
<td style="width: 110px;"><p><b>Vocation:</b></p></td>
<td>
<?php
if($char_rook) {
	echo "<p><input type=\"hidden\" name=\"voc\" value=\"0\" style=\"border: 0;\" checked> Rook Mode Enabled</p>";
}
else {
	echo "
	<p><input type=\"radio\" name=\"voc\" value=\"1\" style=\"border: 0;\" checked> Sorcerer</p>
	<p><input type=\"radio\" name=\"voc\" value=\"2\" style=\"border: 0;\"> Druid</p>
	<p><input type=\"radio\" name=\"voc\" value=\"3\" style=\"border: 0;\"> Paladin</p>
	<p><input type=\"radio\" name=\"voc\" value=\"4\" style=\"border: 0;\"> Knight</p>
	";
}
?>
<br />
</td>
</tr>

<tr>
<td><p><b>Sex:</b></p></td>
<td>
<p><input type="radio" name="sex" value="1" style="border: 0;" checked> Male</p>
<p><input type="radio" name="sex" value="0" style="border: 0;"> Female</p>
</td>
</tr>
<tr>
<td><p><input type="submit" value="Create"></p></td>
</form>
</tr>
</table>
<?PHP
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>