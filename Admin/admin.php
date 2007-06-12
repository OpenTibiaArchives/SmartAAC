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
	
	default:
	include 'inc/index.php';
	break;
}

?>
	