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
include '../Includes/stats/stats.php';
include '../Includes/counter/counter.php';
if($aac_status == "Maintenance")
{
	header("location: maintenance.php");
}

$title = 'Feedback';
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

if($modules_feedback)
{
	echo "<p>You can give feedback about your experiences with $aac_servername by this form</p>
<form action=\"processmail.php\" method=\"post\">
<table style=\"text-align: left; width: 300px;\" border=\"0\" cellpadding=\"2\" cellspacing=\"4\">
  <tbody>
    <tr>
      <td>Name:</td>
      <td><input type=\"text\" name=\"name\" size=\"30\" maxlength=\"20\" /></td>
    </tr>
    <tr>
      <td>Email:</td>
      <td><input type=\"text\" name=\"email\" size=\"30\" maxlength=\"30\" /></td>
    </tr>
    <tr>
      <td>Subject:</td>
      <td><input type=\"text\" name=\"subject\" size=\"30\" maxlength=\"30\" /></td>
    </tr>
    <tr>
      <td>Message:</td>
      <td><textarea name=\"text\" name=\"text\" cols=\"50\" rows=\"10\"></textarea></td>
	</tr>
	<tr>
	<td><input type=\"submit\" name=\"submit\" value=\"Send\" /></td>
	<td>&nbsp;</td>
	</tr>
	  </tbody>
</table>

	
	</form>
	";
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}


if(isset($_SESSION['M2_account']) && isset($_SESSION['M2_password']))
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebarManagerLoggedIn.tpl');
else
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
?>