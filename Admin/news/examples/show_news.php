<?php
// include the script at the _top_
include('../news.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<!-- link to the basic template from _this_ file -->
<link rel="stylesheet" type="text/css" href="../display/basic/style.css" />

<title>show_news()</title>
</head>
<body>

<?php
// display 10 latest news entries
show_news(10);
?>

</body>
</html>
