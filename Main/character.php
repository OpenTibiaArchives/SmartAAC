<?PHP

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
include '../Includes/resources.php';

$title = 'Search Character';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

$sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
mysql_select_db($sql_db, $sqlconnect);

$char = $_REQUEST['char'];
echo '<center>';
echo '<h2>Character Information:</h2>';
if(isset($char)) {
	$query = sqlquery('SELECT * FROM `players` WHERE `name` = \''. mysql_real_escape_string($char) .'\' LIMIT 1;');
	if(mysql_num_rows($query) == 1) {
		while($row = mysql_fetch_array($query)) {
			$name = $row['name'];
			$sex = $row['sex'];
			$vocation = $row['vocation'];
			$level = $row['level'];
			$town = $row['town_id'];
			//house
			$guild = $row['rank_id'];
			$guild_nick = $row['guildnick'];
			$lastlogin = $row['lastlogin'];
		}
		echo '<table width=400px><tr><tr><td width=100px>Name: </td><td width=300px>'.$name.'<br/></td></tr>';
		$getsex = array("Female", "Male");
		echo '<tr><td width=100px>Sex:</td><td width=300px>'.$getsex[$sex].'<br /></td></tr>';
		$vocations = array("None", "Sorcerer", "Druid", "Paladin", "Knight", "Master Sorcerer", "Elder Druid", "Royal Paladin", "Elite Knight");
		echo '<tr><td width=100px>Profession:</td><td width=300px>'.$vocations[$vocation].'<br /></td></tr>';
		echo '<tr><td width=100px>Level:</td><td width=300px>'.$level.'<br /></td></tr>';
		echo '<tr><td width=100px>Residence:</td><td width=300px>'.$town.'<br /></td></tr>';
		echo '<tr><td width=100px>House:</td><td width=300px>aew<br /></td></tr>';
		echo '<tr><td width=100px>Guild membership:</td><td width=300px>aew<br /></td></tr>';
		$lastlog = date('M d Y, H:i:s T', $lastlogin);
		echo '<tr><td width=100px>Last login:</td><td width=300px>'.$lastlog.'<br /></td></tr>';
		echo '</table>';
		echo 'br';
		echo '<br><br>';
		echo '<h2>Account Information</h2>';
		
		echo '</center>';
	}
	else {
		// Todo(?): % %
	}
}
echo '
<br><br><br>
<form action="character.php" method="get">	
<input type="text" name="char" maxlength="'.$aac_maxplayerlen.'" />
<input type="submit" value="Search" />
</form>
</center>
';

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>