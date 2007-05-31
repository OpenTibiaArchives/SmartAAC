<?php
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


//header("location: start.php");

$act = $_GET['act'];

switch($act)
{
	case "login":
	include "loginInterface.php";
	break;
	
	case "auth":
	include "login.php";
	break;
	
	case "manager":
	include "accountManager.php";
	break;
	
	case "delete":
	include "deletePlayer.php";
	break;
	
	case "addchar":
	include "accountAddCharacter.php";
	break;
	
	case "savechar":
	include "accountSaveCharacter.php";
	break;
	
	case "changepassword":
	include "accountPassChange.php";
	break;
	
	case "register":
	include "accountCreate.php";
	break;
	
	default:
	include "loginInterface.php";
	break;
}

?>