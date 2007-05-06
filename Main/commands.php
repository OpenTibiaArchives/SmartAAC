<?PHP

// ===========================================================
//	Smart-Ass: The Userfriendly AAC
//	Version: 2.0 Development Only
//	
//	USE OF THIS PROGRAM TO RELY ON IT FOR SERVER USE IS NOT
// 	RECOMMENDED! THIS IS FOR TESTING ONLY.
//
//	Main setup for the system
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

$xml_data = file_get_contents("commands.xml");

class SimpleXMLElementExtended extends SimpleXMLElement{
   
    public function getAttribute($name){
        foreach($this->attributes() as $key=>$val){
            if($key == $name){
                return (string)$val;
            }// end if
        }// end foreach
    }// end function getAttribute
   
    public function getAttributeNames(){
        $cnt = 0;
        $arrTemp = array();
        foreach($this->attributes() as $a => $b) {
            $arrTemp[$cnt] = (string)$a;
            $cnt++;
        }// end foreach
        return (array)$arrTemp;
    }// end function getAttributeNames
   
    public function getChildrenCount(){
        $cnt = 0;
        foreach($this->children() as $node){
            $cnt++;
        }// end foreach
        return (int)$cnt;
    }// end function getChildrenCount
   
    public function getAttributeCount(){
        $cnt = 0;
        foreach($this->attributes() as $key=>$val){
            $cnt++;
        }// end foreach
        return (int)$cnt;
    }// end function getAttributeCount
   
    public function getAttributesArray($names){
        $len = count($names);
        $arrTemp = array();
        for($i = 0; $i < $len; $i++){
            $arrTemp[$names[$i]] = $this->getAttribute((string)$names[$i]);
        }// end for
        return (array)$arrTemp;
    }// end function getAttributesArray
   
}

include '../conf.php';

$title = 'Server Commands';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';

include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);

echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

$xml = simplexml_load_string($xml_data);
$xml2 = new SimpleXMLElementExtended($xml_data);

echo "<h1>Commands</h1><br />";

if (file_exists($aac_dataDir . '/commands.xml'))// Check the data dir later on
{
	echo '
	<table style="text-align: left; width: 283px; font-size:14px;" border="0"
	 cellpadding="4" cellspacing="3">
	  <tbody>
	    <tr>
	      <td style="width: 139px; text-align: center;"><b>Command</b></td>
	      <td style="width: 124px; text-align: center;"><b>Access Level</b></td>
	    </tr>
		<tr>
	      <td style="width: 139px;">&nbsp;</td>
	      <td style="width: 124px;">&nbsp;</td>
	    </tr>
	';

	$scan_limit = $xml2->getChildrenCount();

	for($i = 0; $i < $scan_limit; $i++)
	{
		echo "<tr>";
		echo '<td style="width: 139px;">' . $xml2->command[$i]->getAttribute('cmd') . '</td>';
		echo '<td style="width: 124px; text-align: center;">' . $xml2->command[$i]->getAttribute('access') . '</td>';
		echo "</tr>";
	}
echo "</tbody></table>";
echo "<br /><b>There are $i commands for this server.</b>";
}
else
{
    exit('Failed to open commands.xml.');
}

echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>