<?PHP

if(file_exists("installLock.txt"))
{
    header("location: inc/forbidden.php");
}
else
{
	$title = 'Installation->Start';
	$name = 'Smart-Ass';
	$bodySpecial = 'onload="openAlert()"';
	$documentation = file_get_contents('inc/start.inc');

	include_once('../Includes/Templates/bTemplate.php');
	$tpl = new bTemplate();

	$tpl->set('title', $title);
	$tpl->set('strayline', $name);
	$tpl->set('bodySpecial', $bodySpecial);
	$tpl->set('documentation', $documentation);

	echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');
	?>
		
				<h1>Welcome!</h1>
				<br>
				<p>Thank you for choosing our software to apply to your otserver as an AAC! The AAC is designed to be easy
				to use for anyone, and user friendly too coming together with an stylish interface and design too.</p>
				
				<br /><h2>Before we start..</h2><br />
				<p>Before you install the Smart-Ass AAC site, please make sure you have the <u>OtServ database strucuture</u> already imported into your MySQL server so there is already a structure for Smart-Ass to work with (such as managing the accounts, players, etc). <br />If you haven't yet imported this, goto the wikipage <a href="http://smart.pekay.co.uk/wiki/index.php?title=Database_Format">here</a> to find out how.</p>
				<center>
					<form action="install.php?step=1" method="post">
						<br><input type="submit" value="Proceed" class="btn"/>
					</form>
				</center>
	<?php
			
	echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
	echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
}

?>