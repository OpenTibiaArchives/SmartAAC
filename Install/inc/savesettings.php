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

$conf_dataDir =			$_POST["dataDir"];

$conf_minacclen = 		$_POST["MinAccLen"];
$conf_maxacclen = 		$_POST["MaxAccLen"];
$conf_minpasslen = 		$_POST["MinPassLen"];
$conf_maxpasslen = 		$_POST["MaxPassLen"];
$conf_minplayerlen =		$_POST["MinPlayerLen"];
$conf_maxplayerlen =		$_POST["MaxPlayerLen"];

$conf_servername = 		$_POST["ServerName"];
$conf_ipaddress =		$_POST["HostName"];
$conf_port = 			$_POST["HostPort"];

$conf_md5passwords =		($_POST["HashPass"]) ? "true" : "false";
$conf_imgver = 			($_POST["ImgVer"]) ? "true" : "false";

$conf_townId =			$_POST["Town_ID"];

if(isset($_POST['SQL_Pass'])){
	$conf_host =			$_POST["SQL_Host"];
	$conf_user =			$_POST["SQL_User"];
	$conf_pass = 			$_POST["SQL_Pass"];
	$conf_db = 			$_POST["SQL_DB"];
}
else {
	$conf_host =		"";
	$conf_user =		"";
	$conf_user =		"";
	$conf_db =		"";
}

$conf_os =			$_POST["HostOS"];
$conf_connection =		$_POST["HostConnection"];
$conf_uptimetype =		$_POST["HostUptime"];

$confFile = fopen("../conf.php", "w");

$write = "
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

\$aac_status = 			\"Installed\";
\$aac_version = 		\"2.0 Alpha1\";

\$aac_dataDir =			\"$conf_dataDir\";


\$aac_minacclen = 		$conf_minacclen;
\$aac_maxacclen = 		$conf_maxacclen;
\$aac_minpasslen = 		$conf_minpasslen;
\$aac_maxpasslen = 		$conf_maxpasslen;
\$aac_minplayerlen =		$conf_minplayerlen;
\$aac_maxplayerlen =		$conf_maxplayerlen;

\$aac_servername = 		\"$conf_servername\";
\$net_ipaddress =		\"$conf_ipaddress\";
\$net_port = 			\"$conf_port\";

\$aac_md5passwords =		$conf_md5passwords;
\$aac_imgver = 			$conf_imgver;

\$aac_townId =			$conf_townId;
\$aac_type =			\"Manager\";

\$sql_host =			\"$conf_host\";
\$sql_user =			\"$conf_user\";
\$sql_pass = 			\"$conf_pass\";
\$sql_db = 			\"$conf_db\";

\$info_os =			\"$conf_os\";
\$info_connection =		\"$conf_connection\";
\$info_uptimetype =		\"$conf_uptimetype\";
?>
";

fwrite($confFile, $write);

fclose($confFile);

echo "
<div align=\"center\">
<form action=\"install.php?step=5\" method=\"post\">
<br><input type=\"submit\" value=\"Next\" class=\"btn\"/>
</form></div>
";

?>