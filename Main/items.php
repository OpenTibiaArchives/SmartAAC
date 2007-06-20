<?PHP
include '../conf.php';
include '../Includes/resources.php';

$xml_data = file_get_contents($aac_dataDir . '/items/items.xml');

$xml = simplexml_load_string($xml_data);
$xml2 = new SimpleXMLElementExtended($xml_data);

echo "<h1>Items</h1><br />";


$scan_limit = $xml2->getChildrenCount();

/* for($i = 0; $i < $scan_limit; $i++)
{
	echo $xml2->item[$i]->attribute[1]->getAttribute('weight') . '<br />';
} */

// XPATH 
/* foreach ($xml->xpath('//character') as $character) {
    echo $character->name, 'played by ', $character->actor, '<br />';
} */

foreach ($xml->item[0] as $item) { // ONLY CHECKING THE FIRST ITEM ATM, CHECK BELOW FOR THAT XML...

	//echo $item->getAttribute('name'), '<br />';	
	switch((string) $item['value']) {
    case 'backpack':
        echo $item, ' thumbs up';
        break;
    }
	
}

/*
XML from items.xml is as follows..

<?xml version="1.0"?>
<items>
<item id="100" name="void">
	<attribute key="weight" value="800"/>
	<attribute key="containerSize" value="8"/>
	<attribute key="slotType" value="backpack"/>
</item>
.... and so on

We need to make it so it checks the next item xd
*/
?>