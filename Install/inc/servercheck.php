<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	
//	USE OF THIS PROGRAM TO RELY ON IT FOR SERVER USE IS NOT
// 	RECOMMENDED! THIS IS FOR TESTING ONLY.
//
//	Main configuration for the AAC system
// ===========================================================
// ===========================================================
//
//    This program is free software; you can redistribute it and/or modify
//    it under the terms of the GNU General Public License as published by
//    the Free Software Foundation; either version 2 of the License, or
//    (at your option) any later version.
//
//    This program is distributed in the hope that it will be useful,
//    but WITHOUT ANY WARRANTY; without even the implied warranty of
//    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
//    GNU General Public License for more details.
//
//    You should have received a copy of the GNU General Public License
//    along with this program; if not, write to the Free Software
//    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
// ===========================================================

$title = 'Installation->Testing Your Server';
$name = 'Smart-Ass';
$bodySpecial = 'onload="openAlert()"';
$documentation = file_get_contents('inc/servercheck.inc');

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);
$tpl->set('documentation', $documentation);

echo $tpl->fetch('../Includes/Templates/Slick_minimal/top.tpl');

$tests_passed = 0;
$tests_to_pass = 7;

if( version_compare(phpversion(), "5.0.0", ">=") )
{
	$php_confirm = '<font color="green">Pass</font>';
	$tests_passed++;
	
}
else
{
	$php_confirm = '<font color="red">Fail</font><b> (' . phpversion() . ')</b>';
}

if (!extension_loaded('gd'))
{
	$gd_confirm = "<font color=\"red\">Fail</font>";
}
else
{
	$gd_confirm = "<font color=\"green\">Pass</font>";
	$tests_passed++;
}

if (!extension_loaded('simplexml'))
{
	$simplexml_confirm = "<font color=\"red\">Fail</font>";
}
else
{
	$simplexml_confirm = "<font color=\"green\">Pass</font>";
	$tests_passed++;
}

if(is_writable("../conf.php"))
{
	$conf_confirm = "<font color=\"green\">Pass</font>";
	$tests_passed++;
}
else
{
	$conf_confirm = "<font color=\"red\">Fail</font>";
}

if(is_writable("../Install/"))
{
	$lock_confirm = "<font color=\"green\">Pass</font>";
	$tests_passed++;
}
else
{
	$lock_confirm = "<font color=\"red\">Fail</font>";
}

if(is_writable("../Includes/counter/visits.txt") && is_writable("../Includes/counter/uniques.txt"))
{
	$counter_confirm = "<font color=\"green\">Pass</font>";
	$tests_passed++;
}
else
{
	$counter_confirm = "<font color=\"red\">Fail</font>";
}

if(is_writable("../Admin/logs"))
{
	$logs_confirm = "<font color=\"green\">Pass</font>";
	$tests_passed++;
}
else
{
	$logs_confirm = "<font color=\"red\">Fail</font>";
}

// Then all those confirm variables are stored in the confirms array to access
$confirms = array(	"PHP Version" => $php_confirm,
					"GD Enabled" => $gd_confirm,
					"SimpleXML" => $simplexml_confirm,
					"Conf writable" => $conf_confirm,
					"Setup Lock" => $lock_confirm,
					"Counter" => $counter_confirm,
					"Logs" => $logs_confirm
					);


echo '<h1>Testing</h1><p>Smart-Ass has tested out your server for testing. We do recommend you run Smart-Ass on an Apache server, since it was developed and tested on it.</p>';

echo "<div align=\"center\"><table style=\"text-align: left; height: 119px; width: 272px; font-size: 14px;\"
 border=\"0\" cellpadding=\"2\" cellspacing=\"2\">
  <tbody>
    <tr>
      <td style=\"width: 200px;\"><h2>Component</h2></td>
      <td style=\"width: 85px; text-align: center;\"><h2>Pass?</h2></td>
    </tr>
	<tr>
      <td style=\"width: 200px;\">&nbsp;</td>
      <td style=\"width: 85px; text-align: center;\">&nbsp;</td>
    </tr>
    <tr>
      <td style=\"width: 200px;\"><b>PHP 5 installed</b></td>
      <td style=\"width: 85px; text-align: center;\">{$confirms['PHP Version']}</td>
    </tr>
    <tr>
      <td style=\"width: 200px;\"><b>GD enabled</b></td>
      <td style=\"width: 85px; text-align: center;\">{$confirms['GD Enabled']}</td>
    </tr>
	<tr>
      <td style=\"width: 200px;\"><b>SimpleXML enabled</b></td>
      <td style=\"width: 85px; text-align: center;\">{$confirms['SimpleXML']}</td>
    </tr>
    <tr>
      <td style=\"width: 200px;\"><b>Configuration writable?</b></td>
      <td style=\"width: 85px; text-align: center;\">{$confirms['Conf writable']}</td>
    </tr>
	<tr>
      <td style=\"width: 200px;\"><b>Setup lock writable?</b></td>
      <td style=\"width: 85px; text-align: center;\">{$confirms['Setup Lock']}</td>
    </tr>
	<tr>
      <td style=\"width: 200px;\"><b>Counter stats writable?</b></td>
      <td style=\"width: 85px; text-align: center;\">{$confirms['Counter']}</td>
    </tr>
	<tr>
      <td style=\"width: 200px;\"><b>Logs writable?</b></td>
      <td style=\"width: 85px; text-align: center;\">{$confirms['Logs']}</td>
    </tr>
  </tbody>
</table></div>
";


//Alert  for when the page loads, this uses $bodySpecial to load this onload on <body>
if($tests_passed == $tests_to_pass)
{
	echo '
<script type="text/javascript">
  function openAlert() {
   Dialog.alert("<h1>Passed</h1><br><p>You have passed at least too tests which means you should be able to move on, go ahead.</p>", {windowParameters: {className: "alphacube"}})
  }
</script>
<br>
<div align="center">
<form action="install.php?step=2" method="post">
<br><input type="submit" value="Next" class="btn"/>
</form></div>
	';
}
elseif($tests_passed != $tests_to_pass)
{
	echo '
<script type="text/javascript">
  function openAlert() {
   Dialog.alert("<h1>Failed</h1><br><p>You have passed at least too tests which means you should be able to move on, go ahead.</p>", {windowParameters: {className: "alphacube"}})
  }
</script>
<div align="center"><br /><br />
<p>You can go forward if you know what you\'re doing however</p>
<form action="install.php?step=2" method="post">
<input type="submit" value="Keep going anyway" class="btn"/>
</form></div>
	';
}

		
echo $tpl->fetch('../Includes/Templates/Slick_minimal/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Slick_minimal/bottom.tpl');
?>