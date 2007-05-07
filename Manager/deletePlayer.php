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
* Description: Delete players for SQL and XML, check the note
* NOTE: Not finished yet

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

include '../Includes/resources.php';
include '../conf.php';
include '../Includes/stats/stats.php';

$title = 'Frontpage';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);
$tpl->set('stats', $global_stats);

$M2_acc = "";
$M2_pass = "";
$M2_acc = $_SESSION['M2_account'];
$M2_pass = $_SESSION['M2_password'];

if ($M2_acc != "" && $M2_acc != null && $M2_pass != "" && $M2_pass != null) {
	$char = $_GET['char'];
	
	$temp = strspn("$char", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM -");

	if ($temp != strlen($char))
	{
		die("Error! Your char name is not valid.");
	}

	$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error (mysql_errno()).\n");
	mysql_select_db($sql_db, $sqlconnect);

	$result = sqlquery('SELECT * FROM `players` WHERE `name` = \'' . mysql_real_escape_string($char) . '\'');
	$rowz = mysql_num_rows($result);
	if($rowz == 1)
	{
		$result = sqlquery('SELECT `account_id` FROM `players` WHERE `name` = \'' . mysql_real_escape_string($char) . '\'');
		while ($row = mysql_fetch_assoc($result)) {
			$acc = $row["account_id"];
		}
		
		if(isset($acc) && $acc != "" && $acc == $M2_acc)
		{
			$passin = $_POST['M2_password'];
			if (!isset($passin) || $passin == "")
			{
			echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');
?>
<font color="red" size="+2">Character deletion!</font><br><br>
To delete your character we must ask you to enter your password for this account.
<br>
<form action="<?php echo $PHP_SELF; ?>?char=<?php echo $char; ?>" method="POST">
Password: <input type="password" name="M2_password"><br>
<input type="submit" value="Continue"> <font color="red"><i>Note. By pressing this you agree that your character (<?php echo $char; ?>) will be permanently deleted from our servers.</i></font>
</form>
<?php
			echo $tpl->fetch('../Includes/Templates/Indigo/sidebarOutterMain.tpl');
			echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
			echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
			}
			else
			{
				$result = sqlquery('SELECT `password` FROM `accounts` WHERE `id` = ' . intval($M2_acc) . '');
				while ($row = mysql_fetch_assoc($result)) {
					$temp = $row["password"];
				}
				
				if (isset($temp) && $temp != "" && $passin == $M2_pass)
				{
					sqlquery('DELETE FROM `players` WHERE `name` = \'' . mysql_real_escape_string($char) . '\' LIMIT 1 ;');
							echo "<font color=\"green\">The character '$char' was successfully deleted from the Server.</font>\n\n<br><br>\n<a href=\"accountManager.php\">Return home</a>";
				}
			}
		}
		else
		{
			echo "<font color\"red\">This character does not exist or could not be read!</font>\n\n<br><br>\n<a 							href=\"accountManager.php\">Return home</a>";
		}
	}
	else
	{
		echo "<font color\"red\">This character does not exist or could not be read!</font>\n\n<br><br>\n<a 							href=\"accountManager.php\">Return home</a>";
	}
}

?>