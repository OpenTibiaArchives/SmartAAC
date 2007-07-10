<?PHP
include "../conf.php";
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
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Items';
	$name = 'Admin Panel';
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

		echo "
		<style type=\"text/css\">

		label{
		float: left;
		width: 220px;
		font-weight: bold;
		font-size: 12px;
		}

		input, textarea{
		width: 180px;
		margin-bottom: 5px;
		}

		textarea{
		width: 250px;
		height: 150px;
		}

		.boxes{
		width: 3em;
		}

		#submitbutton{
		margin-left: 120px;
		margin-top: 5px;
		width: 90px;
		
		#submitbutton2{
		margin-left: 120px;
		margin-top: 5px;
		width: 200px;
		}

		br{
		clear: left;
		}
		</style>

";
echo "<h1>Items</h1><br />";

$xml = new DOMDocument();
$xml->load($aac_dataDir . '/items/items.xml');

$items = array();
foreach( $xml->getElementsByTagName('item') as $tag)
{
	$slot = false;
	$container = false;
	$slotType = '';
	foreach( $tag->getElementsByTagName('attribute') as $attribute)
	{
		if( $attribute->getAttribute('key') == 'slotType')
		{
			$slot = true;
			$slotType = $attribute->getAttribute('value');
		}
		elseif( $attribute->getAttribute('key') == 'containerSize')
		{
			$container = true;
		}
	}

 // not wearable
	if(!$slot)
	{
		continue;
	}

	$items[ $slotType ][ $tag->getAttribute('id') ] = array('name' => $tag->getAttribute('name'), 'container' => $container);
}
echo "<form action=\"save.php?save=items\" method=\"POST\">";

echo '<select name="head">';
echo '<optgroup label="Head">';
echo '<option value=0>-None-</option>';
foreach($items['head'] as $id => $item){
	echo '<option value='.$id.'>'.$item['name'].'</option>';
}
echo '</select><br />';

echo '<select name="neck">';
echo '<optgroup label="Neck">';
echo '<option value=0>-None-</option>';
foreach($items['necklace'] as $id => $item){
	echo '<option value='.$id.'>'.$item['name'].'</option>';
}
echo '</select><br />';

echo '<select name="armor">';
echo '<optgroup label="Armor">';
echo '<option value=0>-None-</option>';
foreach($items['body'] as $id => $item){
	echo '<option value='.$id.'>'.$item['name'].'</option>';
}
echo '</select><br />';

echo '<select name="legs">';
echo '<optgroup label="Legs">';
echo '<option value=0>-None-</option>';
foreach($items['legs'] as $id => $item){
	echo '<option value='.$id.'>'.$item['name'].'</option>';
}
echo '</select><br />';

echo '<select name="feet">';
echo '<optgroup label="Feet">';
echo '<option value=0>-None-</option>';
foreach($items['feet'] as $id => $item){
	echo '<option value='.$id.'>'.$item['name'].'</option>';
}
echo '</select><br />';

echo '<select name="ring">';
echo '<optgroup label="Ring">';
echo '<option value=0>-None-</option>';
foreach($items['ring'] as $id => $item){
	echo '<option value='.$id.'>'.$item['name'].'</option>';
}
echo '</select><br />';

echo '<select name="ammo">';
echo '<optgroup label="Ammo">';
echo '<option value=0>-None-</option>';
foreach($items as $item){
	foreach($item as $id => $name){
		echo '<option value='.$id.'>'.$name['name'].'</option>';
	}
}
echo '</select><br />';

echo '<select name="left">';
echo '<optgroup label="Left Hand">';
echo '<option value=0>-None-</option>';
foreach($items as $item){
	foreach($item as $id => $name){
		echo '<option value='.$id.'>'.$name['name'].'</option>';
	}
}
echo '</select><br />';

echo '<select name="right">';
echo '<optgroup label="Right Hand">';
echo '<option value=0>-None-</option>';
foreach($items as $item){
	foreach($item as $id => $name){
		echo '<option value='.$id.'>'.$name['name'].'</option>';
	}
}
echo '</select><br />';

echo '<select name="container">';
echo '<optgroup label="Container">';
echo '<option value=0>-None-</option>';
foreach($items as $item){
	foreach($item as $id => $name){
		echo '<option value='.$id.'>'.$name['name'].'</option>';
	}
}
echo '</select>';

echo "
		<br /><br />
		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Change\" />
			<br />
		</form>
";

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarAdmin.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>