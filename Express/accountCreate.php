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
$M2_char = $_POST['name'];
$vocin = $_POST['voc'];
$sexin = $_POST['sex'];

if ( (isset($M2_account) && !empty($M2_account)) && (isset($M2_password) && !empty($M2_password)) && (isset($M2_char) && !empty($M2_char)) )
{
	$temp = strspn("$M2_char", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM -");
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
	elseif ($temp != strlen($M2_char))
	{
		echo "<font color=\"red\">Your character's name is not valid. Keep in mind that only letters and blankspaces are permitted. Please choose another one.</font><br><br>";
		$error = 1;
	}
	elseif (strlen($M2_char) < $aac_minplayerlen || strlen($M2_char) > $aac_maxplayerlen)
	{
		echo "<font color=\"red\">Your character's name is not valid. You must use a name with at least 2 letters and at most 20 letters. Please choose another one.</font><br><br>";
		$error = 1;
	}
	
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
			$resultp = sqlquery('SELECT * FROM `players` WHERE `name` = \'' . mysql_real_escape_string($namein) . '\'');
			$rowp = mysql_num_rows($resultp);
			if ($rowp != 0) {
				echo "<font color=\"red\">Error! That character already exist!</font><br><br>";
				return;
			}
			else {
				sqlquery('INSERT INTO `accounts` ( id, password , blocked , premdays )
					VALUES ( ' . intval($M2_account) . ', \'' . mysql_real_escape_string($M2_password) . '\', 0, 0 );');
					
				if ($sexin == 0)
				{
					$looktype = 136;
				}
				elseif ($sexin == 1)
				{
					$looktype = 128;
				}
				else
				{
					die("Invalid sex id");
				}
					
				switch($vocin)
				{
					case 1: // Sorcerer
						sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
											   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_account) . ', ' . $char_group . ', ' . intval($sexin) . ', 1, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_sorcerer . ', ' . $char_health_sorcerer . ', ' . $char_health_sorcerer . ', ' . $char_mana_sorcerer . ', ' . $char_mana_sorcerer . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
						break;
					case 2: // Druid
						sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
											   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_account) . ', ' . $char_group . ', ' . intval($sexin) . ', 2, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_druid . ', ' . $char_health_druid . ', ' . $char_health_druid . ', ' . $char_mana_druid . ', ' . $char_mana_druid . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
						break;
					case 3: // Paladin
						sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
											   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_account) . ', ' . $char_group . ', ' . intval($sexin) . ', 3, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_paladin . ', ' . $char_health_paladin . ', ' . $char_health_paladin . ', ' . $char_mana_paladin . ', ' . $char_mana_paladin . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
						break;
					case 4: // Knight
						sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
											   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_account) . ', ' . $char_group . ', ' . intval($sexin) . ', 4, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_knight . ', ' . $char_health_knight . ', ' . $char_health_knight . ', ' . $char_mana_knight . ', ' . $char_mana_knight . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
						break;
					default: // Error? voc 0 aka no vocation ;p
						sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
											   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_account) . ', ' . $char_group . ', ' . intval($sexin) . ', 0, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_sorcerer . ', ' . $char_health_none . ', ' . $char_health_none . ', ' . $char_mana_none . ', ' . $char_mana_none . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
						break;
				}
					
				$created_Account = true;
				session_unset();
			//	doInfoBox("Your account has been successfully created. Login <a href=\"loginInterface.php\">here</a> to create your first character in the account!<br><br>
			//		Your account number is: $M2_account</font>");
			}
		}
	}
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
	<td><p><b>Name:</b></td><td><input type="text" name="name" maxlength="<?php echo $aac_maxplayerlen; ?>" class="textfield"><font color="red"><i> (<?php echo "$aac_minplayerlen - $aac_maxplayerlen"; ?> letters and blankspaces)</p></i></font><br><hr></td>
	</tr>
	<tr>
	<td><p><b>Vocation:</b></p></td>
	<td>
	<?php
	if($aac_rook) {
		echo "<p><input type=\"radio\" name=\"voc\" value=\"0\" style=\"border: 0;\" checked> None</p>";
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
	</table>
	<br>
	<input type="Submit" value="Create Account">
	<input type="Reset" value="Clear Form">
	</form>



<?php
}
?>