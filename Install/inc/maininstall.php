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
$documentation = file_get_contents('inc/maininstall.inc');

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);
$tpl->set('documentation', $documentation);

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
echo '
<style type="text/css">

label{
float: left;
width: 145px;
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
}

br{
clear: left;
}

</style>

<form>
<h1>MySQL Database Details</h1>
<label for="SQL_Host">MySQL Host:</label>
<input type="text" name="SQL_Host" value="" /><br />

<label for="SQL_User">MySQL User:</label>
<input type="text" name="SQL_User" value="" /><br />

<label for="SQL_Pass">MySQL Password:</label>
<input type="password" name="SQL_Pass" value="" /><br />

<label for="SQL_DB">MySQL Database:</label>
<input type="text" name="SQL_DB" value="" /><br />
<br /><br />

<h1>Security Options</h1>
<label for="HashPass">Hash account passwords?</label>
<input type="checkbox" name="HashPass" class="boxes" /><br /><br />

<label for="ImgVer">Image verification?</label>
<input type="checkbox" name="ImgVer" class="boxes" /><br />
<br /><br />

<h1>Spawn and Temple</h1>
<h2>Spawn</h2><br />
<label for="Spawn_X">X Position:</label>
<input type="text" name="Spawn_X" value="" /><br />

<label for="Spawn_Y">Y Position:</label>
<input type="text" name="Spawn_Y" value="" /><br />

<label for="Spawn_Z">Z Position:</label>
<input type="text" name="Spawn_Z" value="" /><br />
<h2>Temple</h2><br />
<label for="Temple_X">X Position:</label>
<input type="text" name="Temple_X" value="" /><br />

<label for="Temple_Y">Y Position:</label>
<input type="text" name="Temple_Y" value="" /><br />

<label for="Temple_Z">Z Position:</label>
<input type="text" name="Temple_Z" value="" /><br />
<br /><br />

<h1>Other Server Details</h1>
<label for="ServerName">Server Name:</label>
<input type="text" name="ServerName" value="" /><br />

<label for="HostName">IP/Hostname:</label>
<input type="text" name="HostName" value="" /><br />

<label for="HostPort">Port:</label>
<input type="text" name="HostPort" value="" /><br />

<label for="HostOS">Operating System:</label>
<input type="text" name="HostOS" value="" /><br />

<label for="HostConnection">Connection Type:</label>
<input type="text" name="HostConnection" value="" /><br />

<label for="HostUptime">Uptime Aim:</label>
<input type="text" name="HostUptime" value="" /><br />
<br /><br />

<h1>Common Fields</h1>
<label for="MaxAccLen">Max Account Number Length:</label>
<input type="text" name="MaxAccLen" value="" /><br />

<label for="MaxPassLen">Max Password Length:</label>
<input type="text" name="MaxPassLen" value="" /><br />

<label for="MaxPlayerLen">Max Playername Length:</label>
<input type="text" name="MaxPlayerLen" value="" /><br />

<input type="submit" name="submitbutton" id="submitbutton" value="Submit" />

</form>
';
}



echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
?>