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

include '../conf.php';
include '../Includes/stats/stats.php';

$title = 'Frontpage';
$name = $aac_servername;
$bodySpecial = 'onload="NOTHING"';


include_once('../Includes/Templates/bTemplate.php');
$tpl = new bTemplate();

$tpl->set('title', $title);
$tpl->set('strayline', $name);
$tpl->set('bodySpecial', $bodySpecial);
$tpl->set('stats', $global_stats);


echo $tpl->fetch('../Includes/Templates/Indigo/top.tpl');

include('../Admin/new_news/news.php');
$want = $_GET['want'];
$own_text = file_get_contents("FrontpageText.txt");

switch($want)
{
	case "archives":
		show_archives();
		echo "
		<br /><br /><b>
		<a href=\"frontpage.php\">Back to normal view</a><br />
		</b>
		";
	break;
	
	case "categories":
		show_categories();
		echo "
		<br /><br /><b>
		<a href=\"frontpage.php\">Back to normal view</a><br />
		</b>
		";
	break;
	
	default:
		echo $own_text;
	
		echo "<hr><br /><h1>News</h1>";
		show_news(5);
		echo "
		<br /><br /><div align=\"right\"><b>
		<a href=\"frontpage.php?want=archives\">News Archives</a><br />
		<a href=\"frontpage.php?want=categories\">News Catagories</a>
		</b></div>
		";
	break;
}


echo $tpl->fetch('../Includes/Templates/Indigo/sidebar.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/footer.tpl');
echo $tpl->fetch('../Includes/Templates/Indigo/bottom.tpl');
?>