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
* Description: Add character file to add characters to the current account

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

include "../conf.php";
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';

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

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

?>
<h2>Create a new character:</h2><br>

<form action="index.php?act=savechar" method="POST">
<table>
<tr>
<td><p><b>Name:</b></td><td><input type="text" name="name" maxlength="<?php echo $aac_maxplayerlen; ?>" class="textfield"><font color="red"><i> (<?php echo "$aac_minplayerlen - $aac_maxplayerlen"; ?> letters and blankspaces)</p></i></font><br><hr></td>
</tr>
<tr>
<td><p><b>Vocation:</b></p></td>
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
<br><hr>
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
</tr>

</table>
<?PHP

echo $tpl->fetch('../Includes/Templates/Indigo/sidebarOutterMain.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
}
?>