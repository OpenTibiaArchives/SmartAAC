		</div>
		<div class="sidenav">
		
		
		<?php
		if($adminSidebar == false)
		{
			if(isset($_SESSION['M2_account']) && isset($_SESSION['M2_password']))
			{
				echo '
						<h1>My Account</h1>
						<ul>
							<li><a href="../Manager/index.php?act=manager">My Account</a></li>
							<li><a href="../Manager/index.php?act=logout">Logout</a></li>
						</ul>
						
						<h1>Status</h1>
						<br />
						<div style="font-size: 14px;" align="center">
						'.$global_stats.'
						</div>
				';
			}
			else
			{
				echo '
					<h1>Login</h1>
							<div>			
					<form method="post" action="../Manager/login.php" name="Login">
					  <table style="text-align: left; height: 112px; width: 296px;" border="0" cellpadding="2" cellspacing="2">
						<tbody>
						  <tr>
							<td style="width: 90px;">
							<label>Account Number: </label></td>
							<td style="width: 157px;"><input name="M2_account" type="password"></td>
						  </tr>
						  <tr>
							<td style="width: 90px;"><label>Password: </label></td>
							<td style="width: 157px;"><input name="M2_password" type="password"></td>
						  </tr>
						  <tr>
							<td style="width: 90px;"></td>
							<td style="width: 157px;"><a href="../Manager/index.php?act=lost">Lost Account</a></td>
						  </tr>
						  <tr>
							<td style="width: 90px;"><input type="Submit" value="Login"></a></td>
							<td style="width: 157px;"></td>
						  </tr>
						</tbody>
						</form>
					  </table>
					  <a href="../Manager/index.php?act=register">Not got an account? Register Here</a>
							</div>
							
						<h1>Status</h1>
						<br />
						<div style="font-size: 14px;" align="center">
						'.$global_stats.'
						</div>
				';		
			}
		}
		elseif($adminSidebar) // (TRUE)
		{
			echo '			
			<h1>Main Status</h1>
			<br />
			<div style="font-size: 14px;" align="center">
			'.$global_stats.'
			</div>

			
			<h1>Main Menu</h1>
			<ul>
				<li><a href="admin.php">Index</a></li>
				<li><a href="../">Back to AAC</a></li>
				<li><a href="login.php?logout=yes">Logout</a></li>
			</ul>
			';
		}

		if($adminSidebar == false) {
			echo '<h1>Pages</h1>			<ul>';
			$d = opendir("../Custom");
			while($f = readdir($d))
			{
			  if(is_dir($f))
			  continue;

			  if(eregi("\.php$", $f))
				{
					$frox = str_replace(".php", "", $f);
					echo "<li><a href=\"../Custom/$f\" title=\"$f\">$frox</a></li>";
					$total_customs++;
				}
			}
			if($total_customs == 0) {
				echo '<li><i>There are no custom pages</i></li>';
			}
			echo '</ul>';
			
			if($modules_charsearch || $modules_guilds || $modules_houses || $modules_highscores || $modules_bannedplayers || $modules_voting)
			{
			echo '<h1>Community</h1>
			<ul> ';			
				if($modules_charsearch) echo '<li><a href="../Main/character.php">Search Characters</a></li>';
				if($modules_guilds) echo '<li><a href="../Main/guilds.php">Guild List</a></li>';
				if($modules_houses) echo '<li><a href="../Main/houses.php">House List</a></li>';
				if($modules_highscores) echo '<li><a href="../Main/highscores.php">Highscores</a></li>';
				if($modules_bannedplayers) echo '<li><a href="../Main/banned.php">Banned Players</a></li>';
				if($modules_voting) echo '<li><a href="../Main/vote.php">Voting</a></li>';
			echo '</ul>';
			}
			
			if($modules_infopage || $modules_serverstats || $modules_affliates || $modules_commands)
			{
			echo '<h1>Information</h1>
			<ul> ';
				if($modules_infopage) echo '<li><a href="../Main/information.php">General Information</a></li>';
				if($modules_serverstats) echo '<li><a href="../Main/serverstats.php">Server Statistics</a></li>';
				if($modules_affliates) echo '<li><a href="../Main/affiliates.php">Affiliates</a></li>';
				if($modules_commands) echo '<li><a href="../Main/commands.php">In-game Commands</a></li>';
			echo '</ul>';
			}
			?>
			
			<h1>Extras</h1>
			<ul>
			<?php
				if($modules_downloads) echo '<li><a href="../Main/downloads.php">Downloads</a></li>';
				if($modules_custom) echo '<li><a href="../Main/custom.php">Custom Pages</a></li>';
				if($modules_monsters) echo '<li><a href="../Main/monsters.php">Monsters</a></li>';
				if($modules_spells) echo '<li><a href="../Main/spells.php">Spells</a></li>';
				if($modules_gallery) echo '<li><a href="../Main/gallery.php">Gallery</a></li>';
				if($modules_videos) echo '<li><a href="../Main/videos.php">Videos</a></li>';
				if($modules_rules) echo '<li><a href="../Main/rules.php">Rules</a></li>';
				if($modules_feedback) echo '<li><a href="../Main/feedback.php">Feedback</a></li>';
			?>
				<li><a href="../Admin/">Admin Panel</a></li>
			</ul>
			<?php
			}
			?>
			<br /><br /><br />
			
			<div align="right">
			<table style="text-align: right; width: 200px;" border="0" cellpadding="2" cellspacing="2">
			  <tbody>
			    <tr>
			      <td style="width: 250px;"><b>AAC Version</b>: <?php echo $aac_version; ?></td>
				</tr>
				<tr>
				  <td style="width: 250px;"><b>Total Visits</b>: <?php echo $total; ?></td>
			    </tr>
				<tr>
				  <td style="width: 250px;"><b>Unique Visits</b>: <?php echo $total_uniques; ?></td>
			    </tr>
			  </tbody>
			</table>
			</div>
			
			<br /><br />

		</div>
	
		<div class="clearer"><span></span></div>

	</div>

</div>