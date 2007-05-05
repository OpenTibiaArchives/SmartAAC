<?
	/*
	Begin options
	*/

	$poll_file = "poll_script.php"; // Change this to the name of the other PHP file downloaded

	$poll_cookie_name = "poll_cookie"; // This is the cookie name that is set so that the "Vote" button is hidden on the form - you should change this name each time you change the poll so that previous voters may vote again in the new poll

	$poll_results_file = "results.txt"; // Change this to the file that holds the poll results

	$poll_redirect_page = "form.php"; // Change this to the page you want to redirect the visitor to after he/she votes

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

<!-- -->
<!-- -->
<!-- The following block of code is the only HTML necessary to change on your poll -->
<!-- -->
<!-- -->
<table border="2" cellpadding="15" cellspacing="5">
	<tr>
		<td style="background: #eee; color: #000; text-align: center">
		<em>Date goes here</em>
		</td>
	</tr>
	<tr>
		<td>
		<em>Poll #1</em><br />
		<strong>Is this a poll question?</strong><br /><br />
		<?=$message?>

		<form action="<?=$poll_file?>" method="post">
		<hr />
		<p><input name="choice" type="radio" value="0" /> Choice 0 (<strong><?=$choices[0]?></strong>)</p>
		<p><input name="choice" type="radio" value="1" /> Choice 1 (<strong><?=$choices[1]?></strong>)</p>
		<p><input name="choice" type="radio" value="2" /> Choice 2 (<strong><?=$choices[2]?></strong>)</p>
		<p><input name="choice" type="radio" value="3" /> Choice 3 (<strong><?=$choices[3]?></strong>)</p>
<!-- -->
<!-- -->
<!-- It is not necessary to change anything after this -->
<!-- -->
<!-- -->
		<hr />
		<p><input name="cookie_name" type="hidden" value="<?=$poll_cookie_name?>" /></p>
		<p><input name="results_file" type="hidden" value="<?=$poll_results_file?>" /></p>
		<p><input name="redirect_page" type="hidden" value="<?=$poll_redirect_page?>" /></p>
		<p><input name="cookie_expires" type="hidden" value="<?=$poll_cookie_expires?>" /></p>	<p><strong><?=$choices[0]+$choices[1]+$choices[2]+$choices[3]+$choices[4]+$choices[5]+$choices[6]+$choices[7]+$choices[8]+$choices[9]?></strong> total votes<br /><br /></p>
		<? if(!isset($_COOKIE["$poll_cookie_name"])) { ?>
<p><input name="submit" style="margin: 0 0 10px 0; padding: 0 15px 0 15px" type="submit" value="Vote" /></p>
		<? } else { ?>
<p style="margin: -5px 0 0 0; text-align: left"><em>Already voted.</em></p>
		<? } ?>
</form>
		<hr />
		<p>Powered by:<br /><a href="http://hypersilence.net" title="Silentum Poll v1.0.0">Silentum Poll v1.0.0</a></p>
		</td>
	</tr>
</table>
