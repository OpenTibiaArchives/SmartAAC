<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" 
       "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
  <head>
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Revisit-After" content="5 Days">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <title>Thank you for voteing</title>
  </head>
  <body bgcolor="#FFFFFF" text="#000000" link="#0000FF" alink="#0000FF" vlink="#0000FF">
   <h1>Results</h1>

    <!-- Put Your HTML Here -->

<?php


$question = "Votes For Do You Like This Site"; // change this to your question
$questionoptionone = "Yes"; // change this to the first option
$questionoptiontwo = "No"; // change this to the secound option
if(isset($_POST['vote'])){
     if (!empty($_POST['vote'])){
          $vote = $_POST['vote'];
          if($vote == "yes") {
               $votegd = 'plus.txt';
               $votebd = 'neg.txt';
               $abab = $questionoptionone;
               $baba = $questionoptiontwo;
          } elseif($vote == "no") {
               $votegd = "neg.txt";
               $votebd = "plus.txt";
               $abab = $questionoptiontwo;
               $baba = $questionoptionone;
          } else {
               echo "<h3>Sorry there was an error.</h3>";
          }
$fpb = fopen("vote/$votebd","r");
          $numa = fgets($fp,9999); 
          fclose($fp); 
$fpb = fopen("vote/$votebd","w");
          $numa += 1; 
          fputs($fp, $numa); 
          fclose($fp); 
$fpb = fopen("vote/$votebd","r");
          $numb = fgets($fpb,9999); 
          fclose($fpb); 
$fpb = fopen("vote/$votebd","w");
          fputs($fpb, $numb); 
          fclose($fpb);
          $a = $numa;
          $b = $numb;
          $num = $a + $b;
          $numaa = round($a/$num * 100);
          $numbb = round($b/$num * 100);
          $anumaa = round($a/$num * 300);
          $anumbb = round($b/$num * 300);
          $numnum = $a + $b;
?>
<font size="4" face="arial">
<?php
print "".$question."";
?>
</font><br><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20%">
<?php
          print "".$abab."";
          print "</td>\n";
          print "<td width=\"80%\">\n";
          print "<img src=\"vote/bar.gif\" WIDTH=".$anumaa." HEIGHT=15> ".$numaa."%<br>\n";
          print "</td>\n";
          print "</tr>\n";
          print "<tr>\n";
          print "<td width=\"20%\">\n";
          print "".$baba."\n";
          print "</td>\n";
          print "<td width=\"80%\">\n";
          print "<img src=\"vote/bar.gif\" WIDTH=".$anumbb." HEIGHT=15> ".$numbb."%<br>\n";
          print "</td>\n";
          print "</tr>\n";
          print "</table><br>\n";
          print "out of ".$numnum." people who voted\n";
          print "</font>\n";
     } elseif (empty($_POST['vote'])){
          print "<font size=\"4\" face=\"arial\">Sorry you need to check one of the boxes</font>\n";
     } else {
          print "<font size=\"4\" face=\"arial\">Sorry there was an error</font>\n";
     }
} else {
     $votegd = "plus.txt";
     $votebd = "neg.txt";
     $abab = $questionoptionone;
     $baba = $questionoptiontwo;
     $fp = fopen("vote/" . $votegd,"r"); 
     $numa = fgets($fp,9999); 
     fclose($fp);
     $fpb = fopen("vote/" . $votebd,"r"); 
     $numb = fgets($fpb,9999); 
     fclose($fpb); 
     $a = $numa;
     $b = $numb;
     $num = $a + $b;
     if($a > 0 || $b > 0) {
          $numaa = round($a/$num * 100);
          $numbb = round($b/$num * 100);
          $anumaa = round($a/$num * 300);
          $anumbb = round($b/$num * 300);
     } else {
          $numaa = 0;
          $numbb = 0;
          $anumaa = 0;
          $anumbb = 0;
     }
     $numnum = $a + $b;
?>
<font size="4" face="arial">
<?php
print "".$question."";
?>
</font><br><br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="20%">
<?php
     print "".$abab."";
     print "</td>\n";
     print "<td width=\"80%\">\n";
     print "<img src=\"vote/bar.gif\" WIDTH=".$anumaa." HEIGHT=15> ".$numaa."%<br>\n";
     print "</td>\n";
     print "</tr>\n";
     print "<tr>\n";
     print "<td width=\"20%\">\n";
     print "".$baba."\n";
     print "</td>\n";
     print "<td width=\"80%\">\n";
     print "<img src=\"vote/bar.gif\" WIDTH=".$anumbb." HEIGHT=15> ".$numbb."%<br>\n";
     print "</td>\n";
     print "</tr>\n";
     print "</table><br>\n";
     print "out of ".$numnum." people who voted\n";
     print "</font>\n";
}
?>

    <!-- Put Your HTML Here -->

  </body>
</html>