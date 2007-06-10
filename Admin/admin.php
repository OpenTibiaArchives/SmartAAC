<?

$action = $_GET['action'];

switch($action)
{
	case "CheckVersion":
	include 'inc/checkversion.php';
	break;
	
	case "Security":
	include 'inc/security.php';
	break;
	
	default:
	include 'inc/index.php';
	break;
}

?>
	