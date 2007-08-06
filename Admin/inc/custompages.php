<?PHP
include "../conf.php";
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
include '../Includes/counter/counter.php';
include("../Includes/fckeditor/fckeditor.php") ;
define("CUSTOM_DIRECTORY", "../Custom");

// Not logged in
if((!isset($_COOKIE["logged_in_user"]) || $_COOKIE["logged_in_user"] != md5($admin_user)) || (!isset($_COOKIE["logged_in_pass"]) || $_COOKIE["logged_in_pass"] != md5($admin_pass)))
{
	header("location: login.php?message=notloggedin");
}
// Logged in
else
{
	$title = 'Maintenance';
	$name = 'Admin Panel';
	$bodySpecial = 'onload="NOTHING"';
	$editPage = $_GET['edit'];

	include_once('../Includes/Templates/bTemplate.php');
	$tpl = new bTemplate();

	$tpl->set('title', $title);
	$tpl->set('strayline', $name);
	$tpl->set('bodySpecial', $bodySpecial);
	$tpl->set('stats', $global_stats);
	$tpl->set('AAC_Version', $aac_version);
	$tpl->set('Total_Visits', $total);
	$tpl->set('Unique_Visits', $total_uniques);

	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/top.tpl');
		

	
	if(isset($editPage) == false)
	{
		echo "<h2>Create a page</h2><br />";
		echo '<form action="save.php?save=newcustompage" method="post" enctype="multipart/form-data">
	<label>Page name:</label> <input type="text" name="PageName"><br>
	<input type="submit" value="Create">
	</form><br /><br />';
	
		$d = opendir(CUSTOM_DIRECTORY);
	
		$total_pages = 0;
		echo "<h2>Your current custom pages:</h2><br /><ul>";
		while($f = readdir($d))
		{
			if(is_dir($f))
			continue;

			if(eregi("\.inc$", $f)) // Cause we only want the inc files with html content ;], as we only want to list editable content after all and not the breadcrumb
			{
				$frox = str_replace(".inc", "", $f);
			
				echo "<li>$frox - <a href=\"admin.php?action=CustomPages&edit=$f\">Edit</a> / <a href=\"save.php?save=deletecustompage&file=$f\">Delete</a></li>";
				$total_pages++;
			}
		}
		echo "</ul>";
		
		if($total_pages == 0)
		{
			echo "<p>You haven't got any custom pages, create one?</p>";
		}
	}
	else
	{
		$editpagerox = str_replace(".inc", "", $editPage);
	
		echo "
		<h1>Editing $editpagerox</h1><br /><br />
		
		<style type=\"text/css\">

		label{
		float: left;
		width: 220px;
		font-weight: bold;
		font-size: 12px;
		}

		input, textarea{
		width: 180px;
		margin-bottom: 5px;
		}

		textarea{
		width: 250px;
		height: 150px;
		}

		.boxes{
		width: 3em;
		}

		#submitbutton{
		margin-left: 120px;
		margin-top: 5px;
		width: 90px;
		}

		br{
		clear: left;
		}
		</style>

		<form action=\"save.php?save=savecustompage\" method=\"POST\">
		";
		
		$oFCKeditor = new FCKeditor('PageContent') ;
		$oFCKeditor->BasePath = '../Includes/fckeditor/';
		$oFCKeditor->ToolbarSet = 'MyToolbar';
		$oFCKeditor->Value = file_get_contents(CUSTOM_DIRECTORY . "/$editPage");
		$oFCKeditor->Create() ;

		echo "
		<br />
		
		<input type=\"hidden\" name=\"pagefile\" value=\"$editPage\" />
		<input type=\"submit\" name=\"submitbutton\" id=\"submitbutton\" value=\"Save\" />
		</form>
		
		<br />
		<a href=\"admin.php?action=CustomPages\">Cancel editing</a>
		<br /><br />
		";
	}

	$adminSidebar = true;
	include "../Includes/Templates/$aac_layout/sidebar.php";
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/footer.tpl');
	echo $tpl->fetch('../Includes/Templates/'.$aac_layout.'/bottom.tpl');
}
?>