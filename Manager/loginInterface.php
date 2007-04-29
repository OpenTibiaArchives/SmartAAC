<?
/**********************************
* Smart-Ass
* http://smart.pekay.co.uk
**********************************
* 
*
* Author: Pekay, Jiddo, Rifle
* Version: 1.0
* Package otaac
*
* 
* Description: The main login interface of the manager

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

include '../config.php';
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
		'TOP_HEAD' => 'Login',
		'LINK_HOME' => '../',
		'LINK_HSCORES' => '../') );

$M2_account = $_SESSION['M2_account'];
$M2_password = $_SESSION['M2_password'];

if (!(isset($M2_account) && isset($M2_password) && $M2_account != null && $M2_account != "" && $M2_password != null && $M2_password != ""))
{
	$template->pparse('Top');
?>
<h2>Login to your account:</h2>
	

	<form action="login.php" method="POST">
	<table>
	<tr>
	<td><p>Account number: </p></td><td><input name="M2_account" type="password" maxlength="<? echo $ACCOUNTMAXNUM; ?>"></td>
	</tr>
	<tr>
	<td><p>Password: </p></td><td><input name="M2_password" type="password" maxlength="<? echo $PASSWORDMAXNUM; ?>"></td>
	</tr>
	</table>
	<br>
	<input type="Submit" value="Login">
	<input type="Reset" value="Clear">
	</form>
<?
	$template->pparse('Bottom');
}
else
{
	header("Location: accountManager.php");
}
?>