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


$title = 'Installation->Pre-Questions';
$name = 'Smart-Ass';
//$bodySpecial = 'onload="openAlert()"';
$documentation = file_get_contents('inc/prequestions.inc');


include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);
$tpl->set('documentation', $documentation);

echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');

$license_decide = $_POST['agreeordisagree'];

?>

<h2>Please answer this one question:<br><br></h2>
<br><br>

	<form action="install.php?step=4" method="POST">
	<label for="char_rook">Enable rook settings</label>
	<input type="radio" name="char_rook" value="true"> <br />
	<label for="char_rook" selected>Disable rook settings</label>
	<input type="radio" name="char_rook" value="false"><br /><br />
	<label for="main_enable_feedback">Enable Feedback system (requires a SMTP server)</label>
	<input type="radio" name="main_enable_feedback" value="true"> <br />
	<label for="main_enable_feedback" selected>Disable Feedback system</label>
	<input type="radio" name="main_enable_feedback" value="false">
	
	<input type="hidden" name="agreeordisagree" value="<?PHP echo $license_decide; ?>">
		
	<br /><br /><br />
	<input type="submit" value="Next" class="btn"/>
	</form>

	<?
//}
echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
?>