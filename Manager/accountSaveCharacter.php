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

if($aac_status == "Not Installed")
{
	die("Your AAC is not yet installed, please goto the installer");
}
if($aac_status == "Maintenance")
{
	header("location: ../Main/maintenance.php");
}

$errors = 0;

$M2_acc = "";
$M2_pass = "";
$M2_acc = $_SESSION['M2_account'];
$M2_pass = $_SESSION['M2_password'];
$M2_char = $_POST['name'];

if ($M2_acc != "" && $M2_acc != null && is_numeric($M2_acc) && $M2_pass != "" && $M2_pass != null)
{
	$namein = "";
	$vocin = "";
	$sexin = "";

	$namein = $_POST['name'];
	$player = $namein;
	
	$vocin = $_POST['voc'];
	$sexin = $_POST['sex'];
	
	$player = $namein;
	$sex = $sexin;
	$accno = $M2_acc;

		$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die("MySQL Error: mysql_error (mysql_errno()).\n");
		mysql_select_db($sql_db, $sqlconnect);

		$result = sqlquery('SELECT * FROM `players` WHERE `name` = \'' . mysql_real_escape_string($namein) . '\'');
		$rowz = mysql_num_rows($result);
		if ($namein != "" && $vocin != "" && $sexin != "" && $rowz == 0)
		{
			$temp = strspn("$namein", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM -");

			if ($temp != strlen($namein))
			{
				header("location: index.php?act=addchar&result=char_failed&error=malformed_name");
				$errors++;
			}
			if (strlen($namein) < $aac_minplayerlen || strlen($namein) > $aac_maxplayerlen)
			{
				header("location: index.php?act=addchar&result=char_failed&error=wrong_length");
				$errors++;
			}

			if ($errors == 0)
			{
				$result = sqlquery('SELECT * FROM `accounts` WHERE `id` = ' . intval($M2_acc) . '');
				$rowz = mysql_num_rows($result);
				if($rowz == 1)
				{
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
												   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_acc) . ', ' . $char_group . ', ' . intval($sexin) . ', 1, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_sorcerer . ', ' . $char_health_sorcerer . ', ' . $char_health_sorcerer . ', ' . $char_mana_sorcerer . ', ' . $char_mana_sorcerer . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
							break;
						case 2: // Druid
							sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
												   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_acc) . ', ' . $char_group . ', ' . intval($sexin) . ', 2, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_druid . ', ' . $char_health_druid . ', ' . $char_health_druid . ', ' . $char_mana_druid . ', ' . $char_mana_druid . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
							break;
						case 3: // Paladin
							sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
												   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_acc) . ', ' . $char_group . ', ' . intval($sexin) . ', 3, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_paladin . ', ' . $char_health_paladin . ', ' . $char_health_paladin . ', ' . $char_mana_paladin . ', ' . $char_mana_paladin . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
							break;
						case 4: // Knight
							sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
												   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_acc) . ', ' . $char_group . ', ' . intval($sexin) . ', 4, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_knight . ', ' . $char_health_knight . ', ' . $char_health_knight . ', ' . $char_mana_knight . ', ' . $char_mana_knight . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
							break;
						default: // Error? voc 0 aka no vocation ;p
							sqlquery('INSERT INTO `players` (`name`, `account_id`, `group_id`, `sex`, `vocation`, `experience`, `level`, `maglevel`, `health`, `healthmax`, `mana`, `manamax`, `manaspent`, `soul`, `lookbody`, `lookfeet`, `lookhead`, `looklegs`, `looktype`, `cap`, `town_id`) 
												   VALUES(\'' . mysql_real_escape_string($M2_char) . '\', ' . intval($M2_acc) . ', ' . $char_group . ', ' . intval($sexin) . ', 0, ' . $char_exp . ', ' . $char_level . ', ' . $char_maglevel_none . ', ' . $char_health_none . ', ' . $char_health_none . ', ' . $char_mana_none . ', ' . $char_mana_none . ', 0, 100, ' . $char_lookbody . ', ' . $char_lookfeet . ', ' . $char_lookhead . ', ' . $char_looklegs . ', ' . $looktype . ', ' . $char_cap . ', ' . $char_town . ')');
							break;
					}
					
foreach($char_items as $id => $item)
{
    ++$sid;
    $pids[$id] = $sid;
    $pid = $pids[ $item['slot'] ];

    sqlquery('INSERT INTO `player_items` (`player_id`, `sid`, `pid`, `itemtype`, `count`) VALUES ('.intval(userByID($M2_char)).', '.$sid.', '.$pid.', '.$item['item_type'].', '.$item['count'].')');
}
				}
				else
				{
					// header("Location: accountManager.php");
					// $errors++;
					die("EXIT (2) OF SAVER");
				}
			}
		}
		else
		{
			//header("Location: accountAddCharacter.php?result=char_failed&error=exists");
			echo "EXISTS";
			$errors++;
		}


	if($errors == 0)
	{
		header("Location: index.php?act=manager");
	}
}
?>