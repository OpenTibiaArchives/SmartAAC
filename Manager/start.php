<?php
/**********************************
* Smart-Ass
* http://smart.pekay.co.uk
**********************************
* 
*
* Author: Pekay
* Version: 1.0
* Package otaac
*
* 
* Description: Main terminal of manager

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

include '../conf.php';
include '../Includes/resources.php';

$title = 'Manager';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

// Check if its a new setup first!

/*
$ip = $IP;
$port = 7171;

$info = chr(6).chr(0).chr(255).chr(255).'info'; 
$sock = @fsockopen($ip, $port, $errno, $errstr, 1); 

if ($sock) 
{ 
    fwrite($sock, $info); 
    $data=''; 

    while (!feof($sock)) 
        $data .= fgets($sock, 1024); 
    fclose($sock); 

// The following script shows how many players online

    preg_match('/players online="(\d+)"/', $data, $matches); 
    //print "  _START__  " . $matches[1] . "  __END__  ";
    //print $matches[1]; 
    //print "<br>";
}
else
{
    //echo '<span style="float: right;">Off</span>' . $worldname . '<br>'; 
}


$info = array();

function startElement($parser, $name, $attributes)
{
    global $info;

    switch($name)
    {
		case 'serverinfo':
		$info['uptime'] = $attributes['uptime'];
		
        case 'players':
		$info['online'] = $attributes['online'];
		$info['max'] = $attributes['max'];
		$info['peak'] = $attributes['peak'];
        break;
		
		case 'monsters':
		$info['totalmonsters'] = $attributes['total'];
		break;
    }
//	echo $name;
//	print_r($attributes);
}

function endElement($parser, $name)
{
}

$parser = xml_parser_create();
xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
xml_set_element_handler($parser, 'startElement', 'endElement');
xml_parse($parser, $data);
xml_parser_free($parser);


$seconds = $info['uptime'] % 60;
$uptime = floor($info['uptime'] / 60);

$minutes = $uptime % 60;
$uptime = floor($uptime / 60);

$hours = $uptime % 24;
$uptime = floor($uptime / 24);

$days = $uptime % 365;

*/


// Checks if setup.php still exists
/*
if(file_exists('../setup/setup.php'))
{
	if($template_curr == "keepcool")
		{
		
			$SetupNotice = keepCoolNotificationExclam("Please delete <u>or</u> rename setup.php as this may pose a risk to your current setup!");
		}
	else
	{
		echo "<b><font color=\"red\">Please delete <u>or</u> rename setup.php as this may pose a risk to your current setup!</font></b></p>";
	}
}
*/
echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');
?>
<h1>Manager Start</h1><br />
<p>This is the start of the management to accounts and creation of accounts...</p>

<center>
<h2><a href="loginInterface.php">Login</a> --- <a href="accountCreate.php">Create Account</a></h2>
<br><p>Dev: CREATE LIVE.COM ACCOUNTS/WORDPRESS LOGIN INTERFACE
</center>

<br><br><br><br>

<!--<h2>Server Stats and Smart-Ass Version</h2>-->
<?php /*
@$fp = fsockopen ($IP, 7171, $errno, $errstr, 1);
		if (!$fp) {
		echo '<p>The server is currently offline, unable to get information.</p>';
		}
			else
			{

echo '<p><b>Uptime</b>: <b>' . $days . '</b> Days, <b>' . $hours . '</b> Hours, <b>' . $minutes . '</b> Minutes and <b>' . $seconds . '</b> Seconds<br />';
echo '<b>Players Online</b>: ' . $info['online'] . ' of ' . $info['max'] . '<br />';
echo '<b>Peak</b>: ' . $info['peak'] . '<br />';
echo '<b>Monsters Spawned</b>: ' . $info['totalmonsters'] . '<br /><br />';
echo '<b>OS</b>: ' . $OS_Host . '<br />';

	@$fp = fsockopen ("$IP", 80, $errno, $errstr, 1);
		if (!$fp)
		{
			$APACHE_STATUS = 'Error (Server not contactable)';
		}
		else
		{
			$APACHE_STATUS = 'Working Fine';
		}
echo '<b>Apache</b>: ' . $APACHE_STATUS . '<br />';

	@$fp = fsockopen ("$IP", 3306, $errno, $errstr, 1);
		if (!$fp)
		{
			$MYSQL_STATUS = 'Error (Server not contactable)';
		}
		else
		{
			$MYSQL_STATUS = 'Working Fine';
		}
echo '<b>MySQL</b>: ' . $MYSQL_STATUS . '<br /><br />';
}
*/
echo $tpl->fetch('../Includes/Templates/Indigo/sidebarOutterMain.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>