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

$step = $_GET['step']; // Grab the variable from the url

if(file_exists("installLock.txt"))
{
    header("location: inc/forbidden.php");
}
else
{
	// This is for telling which step we are on in the installation of Smart-Ass
	switch($step)
	{
		case 1:
		include 'inc/servercheck.php';
		break;
		
		case 2:
		include 'inc/licenseagreement.php';
		break;
		
		case 3:
		include 'inc/prequestions.php';
		break;
		
		case 4:
		include 'inc/maininstall.php';
		break;
		
		case 5:
		include 'inc/savesettings.php';
		break;
		
		case 6:
		include 'inc/finish.php';
		break;
		
		default:
		die("Wrong setup step given. Please try step 1 or index.php");
	}
}

?>