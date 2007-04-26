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

$title = 'Installation->Finish Installation';
$name = 'Smart-Ass';
$bodySpecial = 'onload="openAlert()"';
$documentation = file_get_contents('inc/finish.inc');

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);
$tpl->set('documentation', $documentation);

echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');


echo '
<font size="4" color="#17BF55">Congratulations! Your copy of Smart-Ass is fully installed!</font>
<div align="center">
<br />

<p><b>REMEMBER! To access this installation again you need to delete or rename the installLock.txt file in the Install directory. When you do this, Smart-Ass will go into Maintenance mode preventing users from accessing the site.</b></p>

<br /><br />

<form action="../index.php" method="post">
<br><input type="submit" value="Goto your AAC" class="btn"/>
</form></div>
';


echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');

// write the lock file, so no one can get in here, unless someone can delete this file
$installLockFile = fopen("installLock.txt", "w");
$write = "";
fwrite($installLockFile, $write);
fclose($installLockFile);
?>