<?
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
* Description: player saving

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

include("../config.php");
include("../resources.php");

$errors = 0;

$M2_acc = "";
$M2_pass = "";
$M2_acc = $_SESSION['M2_account'];
$M2_pass = $_SESSION['M2_password'];

if ($M2_acc != "" && $M2_acc != null && $M2_pass != "" && $M2_pass != null)
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

	if($SQLUSE == "no") // XML
	{
		if ($namein != "" && $vocin != "" && $sexin != "" && !file_exists("../" . $playerdir . $namein . ".xml"))
		{
			$temp = strspn("$namein", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM -");

			if ($temp != strlen($namein))
			{
				header("location: accountAddCharacter.php?result=char_failed&error=malformed_name");
				$errors++;
			}
			if (strlen($namein) < 2 || strlen($namein) > 20)
			{
				header("location: accountAddCharacter.php?result=char_failed&error=wrong_length");
				$errors++;
			}

			if ($errors == 0)
			{
				$file = $accdir . $M2_acc . ".xml";

				if (file_exists($file))
				{
					$contents = file("$file");
					$shallbreak = false;
					$row;
					for($i = 0; $contents[$i];$i++)
					{
						$endchar = strstr($contents[$i], "</characters>");
						if($endchar)
						{
							$row = $i;
						}
					}

					if(isset($row) && $row != "" && $row != null)
					{
						$f = fopen("$file","w");
						for($i = 0; ($contents[$i] || $contents[$i-1]);$i++)
						{
							if ($i < $row)
								fwrite($f, "$contents[$i]");
							if ($i == $row)
								fwrite($f, "<character name=\"$namein\" />
");
							if ($i > $row)
								fwrite($f, $contents[$i-1]);
		
						}
						fclose($f);
			
						//include("makeplayerxml/" . $vocin . ".php"); // FIX THIS TO WORK WITH DISTRO SELECTION // DONE
			
						switch($vocin)
						{
							case 1:
								include '../distro_templates/'.$SERV_DISTRO.'/make_sorc.php';
			
								$playerfile = $playerdir . $namein . ".xml";
								$f2 = fopen("$playerfile","w");
								fwrite($f2, $playerdata);
								break;
							case 2:
								include '../distro_templates/'.$SERV_DISTRO.'/make_druid.php';
			
								$playerfile = $playerdir . $namein . ".xml";
								$f2 = fopen("$playerfile","w");
								fwrite($f2, $playerdata);
								break;
							case 3:
								include '../distro_templates/'.$SERV_DISTRO.'/make_paladin.php';
			
								$playerfile = $playerdir . $namein . ".xml";
								$f2 = fopen("$playerfile","w");
								fwrite($f2, $playerdata);
								break;
							case 4:
								include '../distro_templates/'.$SERV_DISTRO.'/make_knight.php';
			
								$playerfile = $playerdir . $namein . ".xml";
								$f2 = fopen("$playerfile","w");
								fwrite($f2, $playerdata);
								break;
							default:
								include '../distro_templates/'.$SERV_DISTRO.'/make_novoc.php';

								$playerfile = $playerdir . $namein . ".xml";
								$f2 = fopen("$playerfile","w");
								fwrite($f2, $playerdata);
								break;
						}
					}
					else
					{
						// header("Location: accountManager.php");
						// $errors++;
						die("EXIT (1) OF SAVER");
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
			header("Location: accountAddCharacter.php?result=char_failed&error=exists");
			$errors++;
		}
	}
	else // SQL
	{
		$sqlconnect = mysql_connect($SQLHOST, $SQLUSER, $SQLPASS) or die("MySQL Error: mysql_error (mysql_errno()).\n");
		mysql_select_db($SQLDB, $sqlconnect);

		$result = sqlquery("SELECT * FROM players WHERE name='$namein'");
		$rowz = mysql_num_rows($result);
		if ($namein != "" && $vocin != "" && $sexin != "" && $rowz == 0)
		{
			$temp = strspn("$namein", "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM -");

			if ($temp != strlen($namein))
			{
				header("location: accountAddCharacter.php?result=char_failed&error=malformed_name");
				$errors++;
			}
			if (strlen($namein) < 2 || strlen($namein) > 20)
			{
				header("location: accountAddCharacter.php?result=char_failed&error=wrong_length");
				$errors++;
			}

			if ($errors == 0)
			{
				$result = sqlquery("SELECT * FROM accounts WHERE accno='$M2_acc'");
				$rowz = mysql_num_rows($result);
				if($rowz == 1)
				{
					switch($vocin)
					{
						case 1: // Sorcerer
							include '../distro_templates/'.$SERV_DISTRO.'/make_sorc.php';
							break;
						case 2: // Druid
							include '../distro_templates/'.$SERV_DISTRO.'/make_druid.php';
							break;
						case 3: // Paladin
							include '../distro_templates/'.$SERV_DISTRO.'/make_paladin.php';
							break;
						case 4: // Knight
							include '../distro_templates/'.$SERV_DISTRO.'/make_knight.php';
							break;
						default: // Error? voc 0
							include '../distro_templates/'.$SERV_DISTRO.'/make_novoc.php';
							break;
					}
					sqlquery("$sqlplayer");
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
			header("Location: accountAddCharacter.php?result=char_failed&error=exists");
			$errors++;
		}
	}

	if($errors == 0)
	{
		header("Location: accountManager.php");
	}}
?>