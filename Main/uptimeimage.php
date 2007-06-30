<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	
//	USE OF THIS PROGRAM TO RELY ON IT FOR SERVER USE IS NOT
// 	RECOMMENDED! THIS IS FOR TESTING ONLY.
//
//	Uptime image for forums, websites, whatever
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
include '../Includes/stats/stats.php';

$act = $_GET['mode'];

if($act == 1)
{
	$offline = "Server is offline";
	$image = imagecreatefrompng('sysuptime3.png');
	header("Content-type: image/png");
	$black = imagecolorallocate($image, 0, 0, 0);
	Imagestring($image,2,(imagesy+5),(imagesy+23),$offline,$black);
	imagepng($image);
	imagedestroy($image);
}
elseif($act == 2)
{
	$players = 'Players online: '.$info['online'].' / '.$info['max'];
	$owner = 'Owner Name: '.$info['name'];
	$uptime = 'Uptime: '.$hours.'h '.$minutes.'m';
	//uncomment for debug
	//print "$owner <br /> $uptime <br /> $players";
	$image = imagecreatefrompng('sysuptime3.png');
	header("Content-type: image/png");
	$black = imagecolorallocate($image, 0, 0, 0);
	Imagestring($image,2,(imagesy+5),(imagesy+9),$owner,$black);
	Imagestring($image,2,(imagesy+5),(imagesy+23),$uptime,$black);
	Imagestring($image,2,(imagesy+5),(imagesy+37),$players,$black);
	imagepng($image);
	imagedestroy($image);

}
else
{
	echo "Nothing";
}
		
?>