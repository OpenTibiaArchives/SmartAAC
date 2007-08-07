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

session_start();
include '../conf.php';
include '../Includes/resources.php';
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';
if($aac_status == "Maintenance")
{
	header("location: maintenance.php");
}


$xml_data = file_get_contents("$aac_dataDir/$aac_worldDirName/$aac_mapname-house.xml");

$title = 'Houses';
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

echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');

if($modules_houses)
{
	$xml = simplexml_load_string($xml_data);
	$xml2 = new SimpleXMLElementExtended($xml_data);

        $sqlconnect = mysql_connect($sql_host, $sql_user, $sql_pass) or die('Error: '.mysql_error().' ('.mysql_errno().')');
        mysql_select_db($sql_db, $sqlconnect);

	echo "<h1>Houses</h1><br />";
	$houseid = $_GET['house'];

	if (file_exists("$aac_dataDir/$aac_worldDirName/$aac_mapname-house.xml"))
	{
	if ($_GET['page']=="view" && $_GET['house']!="") {
        $query = sqlquery("SELECT `owner` FROM `houses` WHERE `id`='{$_GET['house']}'");
	$array = mysql_fetch_array($query);
	$owner = $array['owner'];
	if($owner!=0) {
		$query = sqlquery("SELECT `name` FROM `players` WHERE `id` = '$owner'");
		$array = mysql_fetch_array($query);
		$owner = $array['name'];
		echo '<br>Name: '.$xml2->house[(int)$houseid]->getAttribute('name').'</br>';
		echo '<br>Owner: <font color="red">'.$owner.'</font></br>';
		echo '<br>Rent: '.$xml2->house[(int)$houseid]->getAttribute('rent').'</br>';
		echo '<br>This house is <font color="red">not available</font> for rent.</br>';
	}
	else
	{
		echo '<br>Name: '.$xml2->house[(int)$houseid]->getAttribute('name').'</br>';
		echo '<br>Owner: <font color="green">Nobody</font></br>';
		echo '<br>Rent: '.$xml2->house[(int)$houseid]->getAttribute('rent').'</br>';
		echo '<br>This house is <font color="green"><a href="houses.php?page=buy&&house='.(int)$houseid.'">available</a></font> for rent.</br>';
	}
	}
	elseif($_GET['page']=="buy" && $_GET['house']!="") {
	$query = sqlquery("SELECT `owner` FROM `houses` WHERE `id`='{$_GET['house']}'");
	$array = mysql_fetch_array($query);
	if($array['owner']!=0) die("This house already has an owner!");
	echo '
		<center><b>You must login to do that!</b></center>
		<form action="houses.php" method="POST">
		<br>Account number: <input type="password" name="account"></br>
		<br>Password: <input type="password" name="pass"></br>
		<br>Character: <input type="text" name="char"></br>
		<input type="hidden" name="house" value="'.$_GET['house'].'">
		<br><input type="submit" name="buy" value="Login"></br>
		</form>
	';
	}
	elseif($_POST['buy']) {
	$account = $_POST['account'];
	$password = $_POST['pass'];
	$character = $_POST['char'];
	$houseid = $_POST['house'];
	$rent = $xml2->house[(int)$houseid]->getAttribute('rent');
	$query = sqlquery("SELECT `owner` FROM `houses` WHERE `id`='$house'");
	$array = mysql_fetch_array($query);
	if($array['owner']!=0) die("This house already has an owner!");
	$query = sqlquery("SELECT `password` FROM `accounts` WHERE `id` = '$account'");
	$array = mysql_fetch_array($query);
	if($array['password']!=$password) die("Incorrect account number or password!");
	if(!in_array($character,getChars($account))) die("You do not own this character!");
	$query = sqlquery("SELECT `id` FROM `players` WHERE `name` = '$character'");
	$array = mysql_fetch_array($query);
	$id = $array['id'];
	$query = sqlquery("SELECT `id` FROM `houses` WHERE `owner` = '$id'");
	if(mysql_num_rows($query)!=0) die("This character already owns a house!");

function GetMoney($character,$from="dp") {
switch($from) {
case "dp":
	$table = "depotitems";
	break;
case "inventory":
	$table = "items";
	break;
case "all":
	return GetMoney($character) + GetMoney($character,"inventory");
	break;
}
$playermoney = 0;
$query = sqlquery("SELECT `id` FROM `players` WHERE `name` = '$character'");
$array = mysql_fetch_array($query);
$playerid = $array['id'];
$query = sqlquery("SELECT * FROM `player_$table` WHERE `player_id` = '$playerid'");
while($row = mysql_fetch_array($query)) {
switch($row['itemtype']) {
case 2160:
	$playermoney += 10000 * $row['count'];
	break;
case 2152:
	$playermoney += 100 * $row['count'];
	break;
case 2148:
	$playermoney += $row['count'];
	break;
}
}
return $playermoney;
}

function ConvertMoney($money) {
$array = array();
$array[0] = 0;
$array[1] = 0;
$array[2] = 0;
while($money>10000) {
$array[0]++;
$money = $money - 10000;
}
while($money>100) {
$array[1]++;
$money = $money - 100;
}
$array[2] = $money;
return $array;
}

function TakeMoney($character,$money) {
$playermoney = GetMoney($character);
if($playermoney<$money) { return false; }
$moneyarray = ConvertMoney($money);
$crystalstaken = $moneyarray[0];
$platinumtaken = $moneyarray[1];
$gpstaken = $moneyarray[2];
sqlquery("DELETE FROM `player_depotitems` WHERE `itemtype` = '2160'");
sqlquery("DELETE FROM `player_depotitems` WHERE `itemtype` = '2152'");
sqlquery("DELETE FROM `player_depotitems` WHERE `itemtype` = '2148'");
$moneyleft = $playermoney - $money;
$moneyleftarray = ConvertMoney($moneyleft);
$crystals = $moneyleftarray[0];
$platinum = $moneyleftarray[1];
$gps = $moneyleftarray[2];
$query = sqlquery("SELECT * FROM `players` WHERE `name` = '$character'");
$array = mysql_fetch_array($query);
$playerid = $array['id'];
if($crystals!=0) { $query = sqlquery("INSERT INTO `player_depotitems` VALUES('$playerid','1','101','0','2160','$crystals','')"); }
if($platinum!=0) { $query = sqlquery("INSERT INTO `player_depotitems` VALUES('$playerid','1','102','0','2152','$platinum','')"); }
if($gps!=0) { $query = sqlquery("INSERT INTO `player_depotitems` VALUES('$playerid','1','103','0','2148','$gps','')"); }
return true;
}
	if(TakeMoney($character,$rent)) {
		sqlquery("UPDATE `houses` SET `owner` = '$id', `paid` = '1' WHERE `id` = '$house'");
		echo '<br>You have successfully bought this house!</br>';
	}
	else
	{
		echo '<br>You have insufficient money in your depot! You need '.$rent.'gp to buy this house.';
	}
	}
	else
	{
		echo '
		<div class="tableforme">
		<table style="text-align: left; width: 600px; font-size:14px;" border="0"
		 cellpadding="4" cellspacing="3">
		  <tbody>
		    <tr class="tableheaders">
		      <td style="width: 124px; text-align: center;"><b>ID</b></td>
		      <td style="width: 160px; text-align: center;"><b>House name</b></td>
		      <td style="width: 124px; text-align: center;"><b>Town</b></td>
		      <td style="width: 124px; text-align: center;"><b>Rent</b></td>
		      <td style="width: 124px; text-align: center;"><b>Size</b></td>
			  <td style="width: 124px; text-align: center;"><b>Owner</b></td>
		    </tr>
			<tr>
		      <td style="width: 139px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
		      <td style="width: 124px;">&nbsp;</td>
			  <td style="width: 124px;">&nbsp;</td>
		    </tr>
		';

        $query = sqlquery('SELECT `id`, `owner` FROM `houses` ORDER BY `id`');
		$owners = array();
        while($row = mysql_fetch_array($query)) {
                if($row['owner'] == 0)
                        $owners[$row['id']] = 'Nobody';
                else   
                        $owners[$row['id']] = $row['owner'];
        }

		$scan_limit = $xml2->getChildrenCount();

		for($i = 0; $i < $scan_limit; $i++)
		{
			echo '<tr class="lolhover">';
			echo '<td style="width: 135px; text-align: center;">#' . $xml2->house[$i]->getAttribute('houseid') . '</td>';
			echo '<td style="width: 200px;"><a href="houses.php?page=view&&house='.$xml2->house[$i]->getAttribute('houseid').'">' . $xml2->house[$i]->getAttribute('name') . '</a></td>';
			echo '<td style="width: 124px; text-align: center;">' . $main_towns[$xml2->house[$i]->getAttribute('townid')] . '</td>';
			echo '<td style="width: 124px; text-align: center;">' . $xml2->house[$i]->getAttribute('rent') . ' gp</td>';
			echo '<td style="width: 124px; text-align: center;">' . $xml2->house[$i]->getAttribute('size') . ' sqm</td>';
			echo '<td style="width: 124px; text-align: center;">' . $owners[$xml2->house[$i]->getAttribute('houseid')] . '</td>';
			echo '</tr>';
		}
	echo "</tbody></table></div>";
		if($i == 1)
		{
			echo "<br /><p><b>There is 1 house for this server.</b></p><br />";
		}
		else
		{
			echo "<br /><p><b>There are $i houses for this server.</b></p><br />";
		}
	}
	}
	else
	{
	    exit('Failed to open the houses file.');
	}
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

include "../Includes/Templates/$aac_layout/sidebar.php";
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>