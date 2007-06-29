<?PHP
include '../conf.php';

@extract($_POST);
$name = stripslashes($name);
$email = stripslashes($email);
$subject = stripslashes($subject);
$text = stripslashes($text);

if($main_enable_mailer)
{
	mail('$main_email',$subject,$text,"From: $name <$email>");
}
else
{
	$ipAddress = $_SERVER['REMOTE_ADDR'];
	$appendedFeedbackFile = fopen("../Admin/logs/feedback.txt", "a");
		
	$write2 = "-------
IP: $ipAddress
Feedback by $name at $email..
Subject: $subject..

Message: $text
-------
";
	
	fwrite($appendedFeedbackFile, $write2);
	fclose($appendedFeedbackFile);
}
echo "<meta http-equiv=\"refresh\" content=\"0;url=feedback.php\" />";
?>