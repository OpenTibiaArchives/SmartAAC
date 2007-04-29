<?
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

include '../config.php';
include '../resources.php';
include '../template.php';

$template = new Template();
$template->set_rootdir("../$template_dir");

$template->set_filenames(array(
		'Top' => 'Top.tpl',
		'Bottom' => 'Bottom.tpl')
		);
		
$template->assign_vars(array(
		'CSS' => "../template/$template_curr/style.css",
		'TITLE' => "$SITETITLE",
		'TOP_HEAD' => 'Start',
		'LINK_HOME' => '../',
		'LINK_HSCORES' => '../') );

if($SITE_TYPE == "Express")
{
	header ("location: ../index.php");
}

// Check if its a new setup first!
if($newsetup == true)
{
	$template->pparse('Top');
	echo "<center>";
	doInfoBox('Redirecting to setup and server check in 5 seconds. <meta http-equiv="refresh" content="5; url=../server_check.php"><br>If your browser doesn\'t refresh, press <a href="../server_check.php">here</a>');
	echo "</center>";
	$template->pparse('Bottom');
}
else
{

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




$template->pparse('Top');
// Checks if setup.php still exists
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
?>
<h2>Welcome to <? echo $SITETITLE; ?></h2>
<p>This server is using the <acronym title="This is the package apart from the Express Package. Manager is aimed at RPG servers.">Manager Package</acronym> of Smart-Ass.<br />
The installation went successfully!<br /><br /> 

<center>
<h1>What do you want to do?</h1><br />
<a href="loginInterface.php"><img src="../images/Login.gif"/></a> <a href="accountCreate.php"><img src="../images/Register.gif"/></a>
</center>
<br><br><br><br>

<!--<h2>Server Stats and Smart-Ass Version</h2>-->
<?/*
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
echo '<br><br><br>Smart-Ass Version: ' . $accversion . '';

$template->pparse('Bottom');
}
?>