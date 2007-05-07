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
include '../Includes/stats/stats.php';

$title = 'Feedback';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);
$tpl->set('stats', $global_stats);

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

if($aac_enable_feedback)
{
	echo "<p>You can give feedback about your experiences with $aac_servername by this form</p>

	<form action=\"processmail.php\" method=\"post\">
	Name: <input type=\"text\" name=\"name\" size=\"20\" maxlength=\"20\" /><br />
	Email: <input type=\"text\" name=\"email\" size=\"30\" maxlength=\"30\" /><br />
	Subject: <input type=\"text\" name=\"subject\" size=\"30\" maxlength=\"30\" /><br />
	Text:<textarea name=\"text\" name=\"text\" cols=\"50\" rows=\"10\"></textarea><br />
	<input type=\"submit\" name=\"submit\" value=\"Send\" />
	</form>
	";
}
else
{
	echo "<p>Sorry, this feature has been disabled by the administrator</p>";
}


echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>