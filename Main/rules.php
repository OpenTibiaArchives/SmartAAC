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

$title = 'Server Rules';
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

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

if($modules_rules)
{
	echo "
	<p>
	When you enter to <b>$aac_servername</b> server you accept the rules, and you will must follow them at any moment.<br>
	<br>
	<br>
	<b>Fundamental rights:</b><br>
	<br>
	1. All the players of the <b>$aac_servername</b> are equal, not depending about the sex (man or woman). Nobody will be discriminated or favored depending by sex, race, language, religion, politics beliefs, opinions...<br>
	2. Players have the right to express his opinion orally and in writing, within a limits (no insults and so..)<br>
	<br>
	<br>
	<b>Rules of Conduct:</b><br>
	<br>
	All player must use the sense common when being related to Serskelander players of Serskeland.<br>
	Responsible for your acts.<br>
	<br>
	1. Don't do anything to an $aac_servername player that you wouldn't like for you. Respect.<br>
	2. Don't insult.<br>
	3. Don't spamm.<br>
	4. Don't use cheats like \"auto-alls\". If you use them it is your problem. We will act.<br>
	5. You do not like GameMaster, Administrators or any $aac_servername\'er who could give to understand that you are of the staff if you are not on it.<br>
	6. Don't use offensive player names.<br>
	7. Don't abuse of PKing. With 5 injustified kills you will be baned automaticaly.<br>
	8. Don't abuse possible of bugs. This is considered serious offense and depending on bug it can mean an delete of the account and chacracter/s.<br>
	9. The Account Sharing is prohibited. One account by person.<br>
	<br>
	<br>
	There are three degrees of lacks: light lack, serious and very serious. The Staff is the one who evaluate the gravity of the lack.<br>
	Each person has 3 serious light offenses, 2 serious and 1 very serious one.<br>
	<br>
	<br>
	<b>There are three types of bans:</b><br>
	The first one, ban of 1 to 3 days.<br>
	The second, ban of 3 days to one week or 14 days maximum.<br>
	Third one, baned a month or delete of character(s)/account.<br>
	<br>
	<br>
	<b>Staff rules:</b><br>
	a) The staff is responsable for the pursuit of the norms contained in this page on the part of all the players and is represented by the Game Masters (GM) and Administrators. Gamemasters are authorized to jail characters, to give negative points to them, or ask the Administrators for a temporal or permanent ban.<br>
	b) All the players have the right of being listened by an Administrator in case that he believes that has treated to him/her unjustly by some GM.<br>
	c) The decisions done by the Administrators are always finals and non-cuestionables.<br>
	d) Threatening a gamemaster and administrator because of his or her actions or position as a gamemaster.<br>
	e) Intentionally giving wrong or misleading information or making false reports about rule violations to a gamemaster concerning his or her investigations.<br>
	</p>
	";
}
else
{
	echo "<h1>Module has been disabled by the admin</h1>";
}

if(isset($_SESSION['M2_account']) && isset($_SESSION['M2_password']))
	echo $tpl->fetch('../Includes/Templates/Indigo/sidebarManagerLoggedIn.tpl');
else
	echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>