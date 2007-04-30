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

// IMPLEMENT FOR SQL
// FOR 2.0 RELEASE

/* session_start();

include '../resources.php';
include '../config.php';
include '../template.php';

$template = new Template();
$template->set_rootdir("../$template_dir");

$template->set_filenames(array(
		'Top' => 'Top.tpl',
		'Bottom' => 'Bottom.tpl')
		);
		
$template->assign_vars(array(
		'CSS' => "../template/$template_curr/style.css",
		'TITLE' => "$SITETITLE",
		'TOP_HEAD' => 'Delete a character',
		'LINK_HOME' => '../',
		'LINK_HSCORES' => '../') );

$M2_acc = "";
$M2_pass = "";
$M2_acc = $_SESSION['M2_account'];
$M2_pass = $_SESSION['M2_password'];

if ($M2_acc != "" && $M2_acc != null && $M2_pass != "" && $M2_pass != null) {
$char = $_GET['char'];

	if($SQLUSE == "no") // XML
	{
		if (file_exists($playerdir . $char . ".xml") && is_readable($playerdir . $char . ".xml"))
		{
			$contents = file($playerdir . $char . ".xml");
			$temp = strstr($contents[1],"account=\"$M2_acc\"");

			if (isset($temp) && $temp != "")
			{
				$passin = $_POST['M2_password'];

				if (!isset($passin) || $passin == "")
				{
					$template->pparse('Top');
?>
<font color="red" size="+2">Character deletion!</font><br><br>
To delete your character we must ask you to enter your password for this account.
<br>
<form action="<?=$PHP_SELF?>?char=<?=$char?>" method="POST">
Password: <input type="password" name="M2_password"><br>
<input type="submit" value="Continue"> <font color="red"><i>Note. By pressing this you agree that your character (<?echo "$char";?>) will be permanently deleted from our servers.</i></font>
</form>

<?
					$template->pparse('Bottom');
				}
				else
				{
					$acccontents = file($accdir . $M2_acc . ".xml");
					$temp2 = strstr($acccontents[1],"pass=\"$passin\"");

					if (isset($temp2) && $temp2 != "" && $passin == $M2_pass)
					{

						if(!(unlink($playerdir . $char . ".xml")))
						{
							echo "ERROR! The char could not be deleted!";
						}
						else
						{
							$file = $accdir . $M2_acc . ".xml";
							if (file_exists($file))
							{
								$contents = file("$file");
								$shallbreak = false;
								$row;
								for($i = 0; $contents[$i];$i++)
								{
									$endchar = strstr($contents[$i], "<character name=\"$char\" />");
									if($endchar)
									{
										$row = $i;
										$contents[$i] = "--removethisline";
									}
								}
								$f = fopen("$file","w");
								for($i = 0; $contents[$i];$i++)
								{
									if ($contents[$i] != "--removethisline")
									fwrite($f, "$contents[$i]"); 
								}
								fclose($f);
	
								echo "<font color=\"green\">The character '$char' was successfully deleted from the Server.</font>\n\n<br><br>\n<a href=\"accountManager.php\">Return home</a>";
							}
						}
					}
					else
					{
						echo "<font color=\"red\">ERROR! Wrong password supplied!</font>\n\n<br><br>\n<a href=\"accountManager.php\">Return home</a>";
					}
				}
			}
		}
		else
		{
			echo "<font color\"red\">This character does not exist or could not be red!</font>\n\n<br><br>\n<a href=\"accountManager.php\">Return home</a>";
		}
	}
	else // SQL
	{
		$sqlconnect = mysql_connect($SQLHOST, $SQLUSER, $SQLPASS) or die("MySQL Error: mysql_error (mysql_errno()).\n");
		mysql_select_db($SQLDB, $sqlconnect);

		$result = sqlquery("SELECT * FROM players WHERE name='$char'");
		$rowz = mysql_num_rows($result);
		if($rowz == 1)
		{
			$result = sqlquery("SELECT account FROM players WHERE name='$char'");
			while ($row = mysql_fetch_assoc($result)) {
				$acc = $row["account"];
			}

			if(isset($acc) && $acc != "")
			{
				$passin = $_POST['M2_password'];
				if (!isset($passin) || $passin == "")
				{
?>
<font color="red" size="+2">Character deletion!</font><br><br>
To delete your character we must ask you to enter your password for this account.
<br>
<form action="<?=$PHP_SELF?>?char=<?=$char?>" method="POST">
Password: <input type="password" name="M2_password"><br>
<input type="submit" value="Continue"> <font color="red"><i>Note. By pressing this you agree that your character (<?echo "$char";?>) will be permanently deleted from our servers.</i></font>
</form>

<?
				}
				else
				{
					$result = sqlquery("SELECT password FROM account WHERE accno='$M2_acc'");
					while ($row = mysql_fetch_assoc($result)) {
						$temp = $row["password"];
					}

					if (isset($temp) && $temp != "" && $passin == $M2_pass)
					{
						sqlquery("DELETE FROM players WHERE name='$char' LIMIT 1 ;");
								echo "<font color=\"green\">The character '$char' was successfully deleted from the Server.</font>\n\n<br><br>\n<a href=\"accountManager.php\">Return home</a>";
					}
				}
			}
			else
			{
				echo "<font color\"red\">This character does not exist or could not be read!</font>\n\n<br><br>\n<a 							href=\"accountManager.php\">Return home</a>";
			}
		}
	}
} */


die("Sorry, delete player is not yet implemented");
?>