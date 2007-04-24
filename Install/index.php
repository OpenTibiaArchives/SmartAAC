<?PHP

//echo "Welcome to the Start Page of Smart-Ass 2 (Codename: Trickie Dickie)";

$title = 'Installation';
$name = 'Smart-Ass';
$bodySpecial = 'onload="openAlert()"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');

echo '				
		<h1>Goto installation</h1>
				<p>Please click continue to go onto the installation of the AAC system. There are <i>two</i> editions Smart-Ass offers, which are:</p>
				<ul>
					<li>Express</li>
					<li>Manager</li>
				</ul>
				<center>
				<form action="install?step=1" method="post">
				<br><input type="submit" value="Proceed" class="btn"/>
				</center>
			</div>

		</div>
		
';
		

echo '<script type="text/javascript">
  function openAlert() {
   Dialog.alert("<h1>Welcome!</h1><br><p>Thank you for choosing our software to apply to your otserver as an AAC! The AAC is designed to be easy to use for anyone, and user friendly too coming together with an stylish interface and design too.</p>", {windowParameters: {className: "alphacube"}})
  }
</script>
';
		
		
echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');


?>