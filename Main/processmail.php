<?PHP

@extract($_POST);
$name = stripslashes($name);
$email = stripslashes($email);
$subject = stripslashes($subject);
$text = stripslashes($text);


mail('$main_email',$subject,$text,"From: $name <$email>");
echo "<meta http-equiv=\"refresh\" content=\"0;url=feedback.php\" />";
?>