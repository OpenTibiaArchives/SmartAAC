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
	
	case "Modules":
	include 'inc/modules.php';
	break;
	
	case "SQL":
	include 'inc/SQL.php';
	break;
	
	case "Stats":
	include 'inc/stats.php';
	break;
	
	case "Voting":
	include 'inc/voting.php';
	break;
	
	case "FieldLens":
	include 'inc/fieldlens.php';
	break;
	
	case "PlayerLvls":
	include 'inc/playerlvls.php';
	break;
	
	case "Towns":
	include 'inc/towns.php';
	break;
	
	case "Maintenance":
	include 'inc/maintenance.php';
	break;
	
	case "ImportDB":
	include 'inc/importdb.php';
	break;
	
	case "AdminCreds":
	include 'inc/admincreds.php';
	break;
	
	case "Others":
	include 'inc/others.php';
	break;
	
	case "Videos":
	include 'inc/videos.php';
	break;
	
	case "Gallery":
	include 'inc/gallery.php';
	break;
	
	case "Items":
	include 'inc/items.php';
	break;
	
	case "Dirs":
	include 'inc/directories.php';
	break;

	default:
	include 'inc/index.php';
	break;
}

?>
	