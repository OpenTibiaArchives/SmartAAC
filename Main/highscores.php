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

$title = 'Highscores';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

if(isset($_GET['page']) && is_numeric($_GET['page']) && is_numeric($main_highscores_result)) {
	$show = intval($_GET['page'] * $main_highscores_result);
}
else {
	$show = 20;
}

$tempskill = $_GET['skill'];

if(isset($tempskill)) {
	$skill = skills($tempskill);
}
else {
	$skill = "level";
}
?>

<table style="text-align: right; width: 563px;" border="1" cellpadding="2" cellspacing="2">
Skill: <!-- <br> ??? -->
<a href="highscores.php">Level</a>
<a href="highscores.php?skill=magic">Magic level</a>
<a href="highscores.php?skill=fist">Fist fighting</a>
<a href="highscores.php?skill=club">Club fighting</a>
<a href="highscores.php?skill=sword">Sword fighting</a>
<a href="highscores.php?skill=axe">Axe fighting</a>
<a href="highscores.php?skill=distance">Distance fighting</a>
<a href="highscores.php?skill=shielding">Shielding</a>
<a href="highscores.php?skill=fishing">Fishing</a>
</select>
</table>

<table style="text-align: left; width: 563px;" border="1"
 cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="width: 56px;">Rank</td>
      <td style="width: 207px;">Player Name</td>
      <td style="width: 95px;">Level</td>
      <td style="width: 171px;">Points</td>
    </tr>
  </tbody>
</table>
<?php

highscore($skill, $show);

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>