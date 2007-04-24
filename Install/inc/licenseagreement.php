<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	
//	USE OF THIS PROGRAM TO RELY ON IT FOR SERVER USE IS NOT
// 	RECOMMENDED! THIS IS FOR TESTING ONLY.
//
//	Main configuration for the AAC system
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


$title = 'Installation->GPL License';
$name = 'Smart-Ass';
//$bodySpecial = 'onload="openAlert()"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');
?>


<div align="center">
<h2>Please read the license:<br><br></h2><center>
<textarea rows="17" cols="70" readonly="readonly"><? include '../LICENSE' ?></textarea>

	<br><br>
	<form action="install.php?step=3" method="POST">
	<input type="submit" name="agreeordisagree" value="Disagree">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type="submit" name="agreeordisagree" value="Agree">
	</form>
</div>

 
<?
echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
?>