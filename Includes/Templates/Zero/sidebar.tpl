		</div>
		
		
<div id="leftColumn"> 
			<h2>Community</h2>
			<ul>
				<li><a href="character.php">Search Characters</a></li>
				<li><a href="guilds.php">Guild List</a></li>
				<li><a href="houses.php">House List</a></li>
				<li><a href="highscores.php">Highscores</a></li>
				<li><a href="banned.php">Banned Players</a></li>
				<li><a href="../Main/vote.php">Voting</a></li>
			</ul>
			<br />
			
			<h2>Information</h2>
			<ul>
				<li><a href="information.php">General Information</a></li>
				<li><a href="serverstats.php">Server Statistics</a></li>
				<li><a href="../Main/affiliates.php">Affiliates</a></li>
				<li><a href="commands.php">In-game Commands</a></li>
			</ul>
			<br />
			
			<h2>Extras</h2>
			<ul>
				<li><a href="downloads.php">Downloads</a></li>
				<li><a href="custom.php">Custom Pages</a></li>
				<li><a href="monsters.php">Monsters</a></li>
				<li><a href="spells.php">Spells</a></li>
				<li><a href="gallery.php">Gallery</a></li>
				<li><a href="videos.php">Videos</a></li>
				<li><a href="rules.php">Rules</a></li>
				<li><a href="feedback.php">Feedback</a></li>
				<li><a href="../Admin/">Admin Panel</a></li>
			</ul>
		</div>
</div><!--//end #leftColumn//-->

<div id="rightColumn"> 
			
			<h2>Status</h2>
			<br />
			<div style="font-size: 14px;" align="center">
			<tag:stats />
			</div>
			
			<br />
			
			<h2>Login</h2>
			<div>			
				<form method="post" action="../Manager/login.php" name="Login">
				  <table style="text-align: left; height: 112px; width: 296px;" border="0" cellpadding="2" cellspacing="2">
				    <tbody>
				      <tr>
				        <label>Account Number: </label></td>
					  </tr>
					  <tr>
				        <td style="width: 157px;"><input name="M2_account" type="password"></td>
				      </tr>
				      <tr>
				        <td style="width: 90px;"><label>Password: </label></td>
					  </tr>
					  <tr>
				        <td style="width: 157px;"><input name="M2_password" type="password"></td>
				      </tr>
				      <tr>
				        <td style="width: 90px;"><input type="Submit" value="Login"></a></td>
				        <td style="width: 157px;"></td>
				      </tr>
				    </tbody>
					</form>
				  </table>
				  
				  <div align="right">
				  <a href="../Manager/index.php?act=register">Register</a>
				  <br />
				  <a href="../Manager/index.php?act=lost">Lost Account</a>
				  </div>
				  
			</div>
			
			<br /><br />
			
			<table style="text-align: left; width: 200px;" border="0" cellpadding="2" cellspacing="2">
			  <tbody>
			    <tr>
			      <td style="width: 250px;"><b>AAC Version</b>: <tag:AAC_Version /></td>
				</tr>
				<tr>
				  <td style="width: 250px;"><b>Total Visits</b>: <tag:Total_Visits /></td>
			    </tr>
				<tr>
				  <td style="width: 250px;"><b>Unique Visits</b>: <tag:Unique_Visits /></td>
			    </tr>
			  </tbody>
			</table>
</div><!--//end #rightColumn//-->