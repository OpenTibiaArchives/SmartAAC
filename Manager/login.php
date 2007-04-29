<?
// M2 LOGIN SMART-ASS
// Author: Pekay/Jiddo
// Renew comments later (DEV)

include "../resources.php";
include "../config.php";
session_start();

$M2_account = $_REQUEST['M2_account'];
$M2_password = $_REQUEST['M2_password'];

if($md5_passwords_accounts)
{
	$M2_password = md5($M2_password);
}

if (isset($M2_account) && isset($M2_password))
{
	if($SQLUSE == "no") // XML
	{
		$file = $accdir . $M2_account . ".xml";

		if (file_exists($file)) // Check if the file exists first
		{

			if (is_readable($file)) // Then check if it's readable
			{
		
				$filecontents = fopen("$file", "r");
				while(!feof($filecontents))
				{
					$line = fgets($filecontents);
					$passpos = strstr($line,"pass=");
				
					if(!($passpos === false)) break;
				}
			
				if(!($passpos === false))
				{
					$passtemp = explode("\"" ,$passpos); //explode from "
					$pass = $passtemp[1]; // password after " and before next "

					if ($M2_password == $pass)
					{
						$_SESSION["M2_account"] = "$M2_account";
						$_SESSION["M2_password"] = "$M2_password";
						header ("location: accountManager.php");
						//echo "GOT THROUGH SUCCESSFULLY INTO ACCOUNT";
					}
					else
					{
						header ("location: index.php");
						echo "Debug Msg: EXIT (1)";
					}
				}
			}
		}
		else
		{
			//header ("location: loginInterface.php");
			echo "Debug Msg: EXIT (2)";
		}
	}
	else // SQL
	{
		$sqlconnect = mysql_connect($SQLHOST, $SQLUSER, $SQLPASS) or die("MySQL Error: mysql_error (mysql_errno()).\n");
		mysql_select_db($SQLDB, $sqlconnect);

		$result = sqlquery("SELECT * FROM accounts WHERE accno='$M2_account'");
		$rowz = mysql_num_rows($result);
		if($rowz == 1) // Check if the file exists first
		{
			$pass = sqlquery("SELECT * FROM accounts WHERE accno='$M2_account'");
			while ($row = mysql_fetch_assoc($pass)) {
				$passw = $row["password"];
			}

/* 			if($md5_passwords_accounts)
			{
				$M2_password = md5($M2_password);
			} */
			if($M2_password == $passw)
			{
				$_SESSION["M2_account"] = "$M2_account";
				$_SESSION["M2_password"] = "$M2_password";
				//die("TEMP DEBUG 1:<br><br>Entered password: " . $M2_password . "<br>Actual Password:  " . $passw);
				header ("location: accountManager.php");
			}
			else
			{
				//header ("location: index.php");
				die("Entered password:" . $M2_password . " Actual Password:" . $passw);
				echo "Debug Msg: EXIT (1)";
			}
		}
		else
		{
			//header ("location: loginInterface.php");
			echo "Debug Msg: EXIT (2)";
		}
	}
}
else
{
	//header ("location: index.php");
	echo "Debug Msg: EXIT (3)";
}
?>