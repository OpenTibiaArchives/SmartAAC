<?
/**********************************
* Smart-Ass
* http://smart.pekay.co.uk
**********************************
* 
*
* Author: Pekay
* Version: 1.0
* Package otaac
*
* 
* Description: account saving

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

$error = 0;
include "../config.php";
include "../resources.php";
include '../template.php';

$template = new Template();
$template->set_rootdir("../$template_dir");

$template->set_filenames(array(
		'Top' => 'Top.tpl',
		'Bottom' => 'Bottom.tpl')
		);
		
$template->assign_vars(array(
		'CSS' => "../template/$template_curr/style.css",
		'TITLE' => "$SITETITLE",
		'TOP_HEAD' => 'Create an account',
		'LINK_HOME' => '../',
		'LINK_HSCORES' => '../') );
		
		

$M2_password = $_POST['M2_password'];

if ( isset($M2_password) && !empty($M2_password) )
{
	if (strlen($M2_password) < 5)
	{
		echo "<font color=\"red\">Error! Please fill out the form correctly!</font><br><br>";
		$error = 1;
	}
	elseif( !preg_match('/^[a-z0-9 ]{5,}$/', $M2_password) )
	{
            echo "<font color=\"red\">Error! Your password must consist of more then 4 letters or numbers (ABC, abc, 123 and blankspaces)!</font><br><br>";
            $error = 1;
        }
	else
	{
/*
    Account number generation part by Wrzasq [wrzasq@gmail.com] (C) 2006.

    http://www.wrzasq.com/
*/
            $exist = array();

            $directory = opendir($accdir);

            // reads accounts
            while($account = readdir($directory) )
            {
                // checks if the file is valid acocunt file name
                if( eregi('^[0-9]*\.xml$', $account) )
                {
                    $exist[] = str_replace('.xml', '', $account);
                }
            }

            // generates random account number
            $random = rand(0, 999999);
            $accno = $random;

            // finds unused number
            while(true)
            {
                // unused - found
                //if( !isset($exist[$accno]) )
                //{
                //    break;
                //}
				$accountfile = $accdir . $accno . ".xml";
				if(!file_exists($accountfile))
				{
				break;
				}
				else
				{
				$accno++;
				}

                // used - next one
                //$accno++;

                // we need to re-set
                if($accno > 999999)
                {
                    $accno = 0;
                }

                // we checked all possibilities
                if($accno == $random)
                {
                    echo "<font color=\"red\">Sorry... there are no free account number at the moment, lol :D.</font><br><br>";
                    $error = 1;
                }
            }
			
			
			
if($md5_passwords_accounts == true)
{
	$M2_password = md5($M2_password);
}
			
			
	
			if ($error == 0)
			{
				if($SQLUSE == "no") // XML
				{
						$file = fopen(/*"../" . */$accdir . $accno . ".xml", "w");
						$output = 
"<?xml version=\"1.0\"?>
<account pass=\"" . $M2_password . "\" type=\"1\" premDays=\"15\">
<characters>
</characters>
</account>";

						fwrite($file, $output);
						$created_Account = true;
						session_unset();
		
						doInfoBox("Your account has been successfully created. Login <a href=\"loginInterface.php\">here</a> to create your first character in the account!<br><br><b>Your account number is $accno</b></font>");
				
				}
				else // SQL
				{
					$sqlconnect = mysql_connect($SQLHOST, $SQLUSER, $SQLPASS) or die("MySQL Error: mysql_error 								(mysql_errno()).\n");
					mysql_select_db($SQLDB, $sqlconnect);
					
					
					while(true)
						{
							$result = sqlquery("SELECT * FROM accounts WHERE accno='$accno'");
							$rowz = mysql_num_rows($result);
							if($rowz == 1)
							{
								$accno++;
							}
							elseif($rowz == 0)
							{
								break;
							}
							
							// we need to re-set
						    if($accno > 999999)
						    {
						        $accno = 0;
						    }

						    // we checked all possibilities
						    if($accno == $random)
						    {
						        die('Sorry... there are no free account number at the moment, lol :D.');
						    }
						}
	
					sqlquery("INSERT INTO accounts ( id , accno , password , type , premDays , email , blocked ) 
						VALUES ( '', '$accno', '$M2_password', '0', '0', '', '0' );");

					$created_Account = true;
					session_unset();
					doInfoBox("Your account has been successfully created. Login <a href=\"loginInterface.php\">here</a> to create your first character in the account!<br><br>
					Your account number is: $accno</font>");
					
				}
			}
		}
	}

else
{
	if ($account != "")
	{
		doInfoBox("Sorry, but that account number is not available at the moment. Please use another one.<br><br>");
	}
}

if ($created_Account != true)
{
$template->pparse('Top');
?>
<h2>Please fill out the appropiate fields:</h2>
<br />

	<form action="<?=$PHP_SELF?>" method="POST">
	<table>
	<tr>
	<td><p>Password: </p></td><td><input name="M2_password" type="password" maxlength="<? echo $PASSWORDMAXNUM; ?>" class="textfield"> <font color="red">* <i>(at least 5 characters)</i></font></td>
	</tr>
	</table>
	<br>
	<input type="Submit" value="Create Account">
	<input type="Reset" value="Clear Form">
	</form>



<?
$template->pparse('Bottom');
}
?>