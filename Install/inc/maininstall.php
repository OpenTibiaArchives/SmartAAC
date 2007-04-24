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

$title = 'Installation->Main Installation';
$name = 'Smart-Ass';
$bodySpecial = 'onload="openAlert()"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');



$license_decide = $_POST['agreeordisagree'];
if($license_decide == "Disagree")
{
	echo '<script type="text/javascript">
  function openAlert() {
   Dialog.alert("<h1>You cannot use this software</h1><br><p>You have declined to agree with the license this software is with, therefore you cannot use this software.</p>", {windowParameters: {className: "alphacube"}})
  }
  openAlert();
	</script>';
}
elseif($license_decide == "Agree")
{
	//the setup, tableless fields: http://www.quirksmode.org/css/forms.html
}



echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
?>