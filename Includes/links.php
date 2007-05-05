<?PHP
// We should make this more flexible :p

$link_url[1] = "http://otfans.net";
$link_url[2] = "http://otfans.net";
$link_url[3] = "http://otfans.net";
$link_url[4] = "http://otfans.net";
$link_url[5] = "http://otfans.net";

$link_desc[1] = "OTFans.Net - Home of OTServ";
$link_desc[2] = "OTFans.Net - Home of OTServ";
$link_desc[3] = "OTFans.Net - Home of OTServ";
$link_desc[4] = "OTFans.Net - Home of OTServ";
$link_desc[5] = "OTFans.Net - Home of OTServ";

echo "<br />";
for($i = 1; $i <= 5; $i++)
{
	echo "<ul>";
	echo "<li><a href=\"$link_url[$i]\">$link_desc[$i]</a></li>";
	echo "</ul>";
}
?>