<?
	/*
	Silentum Counter v1.5.0
	Modified March 26, 2007
	counter.php copyright 2005-2007 "HyperSilence"
	*/ 
	
	//echo "<font style=\"font-size: 14px; color: red; padding-left: 5px; padding-top: 5px;\"><b>The visits.txt file is empty, please ask an admin to add a value to it.</b></font>";

	$visits_file = "../Includes/counter/visits.txt";
	$uniques_file = "../Includes/counter/uniques.txt";

	$counter = fopen($visits_file, "r");
	$total = @fread($counter, filesize($visits_file));
	if($total == NULL) { $total = 1; } // Reset..
	fclose($counter);
	$total++;
	$counter = fopen($visits_file, "w");
	fwrite($counter, $total);
	fclose($counter);

	$unique_hits = fopen($uniques_file, "r");
	$total_uniques = fread($unique_hits, filesize($uniques_file));
	if($_COOKIE["unique_hit"] != "set") {
	setcookie("unique_hit", "set", time()+2419200);
	$total_uniques++;
	}
	$uniques_hits = fopen($uniques_file, "w");
	fwrite($uniques_hits, $total_uniques);
	fclose($uniques_hits);
?>