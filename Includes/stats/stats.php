<?

$ip = $net_ipaddress;
$port = $net_port;

$info = chr(6).chr(0).chr(255).chr(255).'info'; 
$sock = @fsockopen($ip, $port, $errno, $errstr, 1); 

if ($sock) 
{ 
    fwrite($sock, $info); 
    $data=''; 

    while (!feof($sock)) 
        $data .= fgets($sock, 1024); 
    fclose($sock); 
}
else
{
    //echo '<span style="float: right;">Off</span>' . $worldname . '<br>'; 
	//What here? It seems to work anyway :p
}

$info = array();

function startElement($parser, $name, $attributes)
{
    global $info;

    switch($name)
    {
		case 'serverinfo':
		$info['uptime'] = $attributes['uptime'];
		$info['location'] = $attributes['location'];
		$info['version'] = $attributes['version'];
		
		case 'owner':
		$info['name'] = $attributes['name'];
		$info['email'] = $attributes['email'];
		
        case 'players':
		$info['online'] = $attributes['online'];
		$info['max'] = $attributes['max'];
		$info['peak'] = $attributes['peak'];
        break;
		
		case 'monsters':
		$info['totalmonsters'] = $attributes['total'];
		break;
    }
	// Just debugging of output
	//echo $name;
	//print_r($attributes);
}

function endElement($parser, $name)
{
// MUST have me to end the elements of the output
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


@$fp = fsockopen ($ip, $port, $errno, $errstr, 1);
if (!$fp)
{
	$global_stats = '<b>Server Offline</b>';
}
else
{
	$global_stats = "<b>Online</b><br /><br /> Players: " . $info['online'] . "/" . $info['max'] . "<br />Uptime: " . $days . "d " . $hours . "h " . $minutes . "m " . $seconds . "s.<br />";
}
?>