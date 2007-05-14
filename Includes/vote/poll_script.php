<?
	/*
	Silentum Poll v1.0.0
	Modified March 4, 2007
	poll_script.php copyright 2006, 2007 "HyperSilence"
	*/

	$choice = $_POST["choice"];
	$cookie_name = $_POST["cookie_name"];
	$results_file = $_POST["results_file"];
	$redirect_page = $_POST["redirect_page"];
	$cookie_expires = $_POST["cookie_expires"];

	// The following code should not be changed unless you know PHP

	if(isset($choice) && !isset($_COOKIE["$cookie_name"])) {
	$choices_file = fopen("results.txt", "r");
	$choices = fread($choices_file, 1024);
	$choices = explode("\t", $choices);
	fclose($choices_file);

	$choices[$choice] = $choices[$choice]+1;

	$file_write = $choices[0]."\t".$choices[1]."\t".$choices[2]."\t".$choices[3]."\t".$choices[4]."\t".$choices[5]."\t".$choices[6]."\t".$choices[7]."\t".$choices[8]."\t".$choices[9];

	$choices_file = fopen("results.txt", "w");
	fwrite($choices_file, $file_write);
	fclose($choices_file);

	setcookie("$cookie_name", "true", time()+$cookie_expires);
	header("Location: ../../Main/vote.php?message=1#poll");
	}

	elseif(!isset($choice)) {
	header("Location: ../../Main/vote.php?message=2#poll");
	}

	elseif(isset($_COOKIE["$cookie_name"])) {
	header("Location: ../../Main/vote.php?message=3#poll");
	}
?>