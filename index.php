<?php

require("conf.php");

if($aac_status == "Installed")
{
	header('Location: ./main.php');
}
elseif($aac_status == "Maintenance")
{
	header('Location: ./maintenance.php');
}
elseif($aac_status == "Not Installed")
{
	header('Location: ./Install/index.php');
}

?>