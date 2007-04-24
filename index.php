<?php

require("conf.php");

if($aac_status == "Installed")
{
	echo '<meta http-equiv="refresh" content="0;url=main.php" />';
}
elseif($aac_status == "Maintenance")
{
	echo '<meta http-equiv="refresh" content="0;url=maintenance.php" />';
}
elseif($aac_status == "Not Installed")
{
	echo '<meta http-equiv="refresh" content="0;url=./Install/index.php" />';
}

?>