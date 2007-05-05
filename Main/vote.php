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

$title = 'Voting';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

	/*
	Begin options
	*/

	$poll_file = "../Includes/vote/poll_script.php"; // Change this to the name of the other PHP file downloaded

	$poll_cookie_name = "poll_cookie"; // This is the cookie name that is set so that the "Vote" button is hidden on the form - you should change this name each time you change the poll so that previous voters may vote again in the new poll

	$poll_results_file = "../Includes/vote/results.txt"; // Change this to the file that holds the poll results

	$poll_redirect_page = "vote.php"; // Change this to the page you want to redirect the visitor to after he/she votes

	$poll_cookie_expires = 604800; // Change this to the amount of time, in seconds, the cookie stays in the visitor's browser so that he/she may vote again after the cookie expires. 604800 seconds is equal to one week

	/*
	End options
	*/

	if(isset($_COOKIE["$poll_cookie_name"]) && $_GET["message"] != "1" && $_GET["message"] != "2" && $_GET["message"] != "3") $message = "<ins>Results</ins><br />";
	elseif(!isset($_COOKIE["$poll_cookie_name"]) && !isset($_GET["message"]) || $_GET["message"] < "1" || $_GET["message"] > "3") $message = "<ins>Cast your vote below.</ins><br />";
	elseif($_GET["message"] == "1") $message = "<ins>Your vote has been added.</ins><br />";
	elseif($_GET["message"] == "2") $message = "<ins>You must select a choice.</ins><br />";
	elseif($_GET["message"] == "3") $message = "<ins>You can only vote once per week.</ins><br />";
	$choices_file = fopen($poll_results_file, "r");
	$choices = fread($choices_file, 1024);
	$choices = explode("\t", $choices);
	fclose($choices_file);
?>

<p>Voting for the server is very simple, except...</p><br /><br />

<table border="0" cellpadding="15" cellspacing="5">
	<tr>
		<td style="background: #eee; color: #000; text-align: center">
		<h1>&nbsp;<?=$main_votequestion?>&nbsp;</h2>
		</td>
	</tr>
	<tr>
		<td>
		<br />
		<br /><font size="+1"><?=$message?></font><br />

		<form action="<?=$poll_file?>" method="post">
		<hr /><br />
		<p><input name="choice" type="radio" value="0" /> <?=$main_voteanswer1?> (<strong><?=$choices[0]?> votes</strong>)</p>
		<p><input name="choice" type="radio" value="1" /> <?=$main_voteanswer2?> (<strong><?=$choices[1]?> votes</strong>)</p>
		<p><input name="choice" type="radio" value="2" /> <?=$main_voteanswer3?> (<strong><?=$choices[2]?> votes</strong>)</p>
		<p><input name="choice" type="radio" value="3" /> <?=$main_voteanswer4?> (<strong><?=$choices[3]?> votes</strong>)</p>

		
		<hr />
		<p><input name="cookie_name" type="hidden" value="<?=$poll_cookie_name?>" />
		<input name="results_file" type="hidden" value="<?=$poll_results_file?>" />
		<input name="redirect_page" type="hidden" value="<?=$poll_redirect_page?>" /></p>
		<p><input name="cookie_expires" type="hidden" value="<?=$poll_cookie_expires?>" /></p>	<p><strong><?=$choices[0]+$choices[1]+$choices[2]+$choices[3]+$choices[4]+$choices[5]+$choices[6]+$choices[7]+$choices[8]+$choices[9]?></strong> total votes</p>
		<?PHP if(!isset($_COOKIE["$poll_cookie_name"])) { ?>
<p><input name="submit" style="margin: 0 0 10px 0; padding: 0 15px 0 15px" type="submit" value="Vote" /></p>
		<?PHP } else { ?>
<p style="margin: -5px 0 0 0; text-align: left"><em>You have already voted.</em></p>
		<?PHP } ?>
</form>
		</td>
	</tr>
</table>

<?PHP
echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>