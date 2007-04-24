
		<div class="right">

			<div class="subnav">

				<h1><u>Sidebar disabled</u></h1>
					<br><br>
				
						<h2>Access Account</h3>
										<ul>
						<form action="account.php?page=login" method="post">
						<li><a>Account</a></li>

						<li><input name="account" type="password" value="" DISABLED/></li>
						<li><a>Password</a></li>
						<li><input name="password" type="password" value="" DISABLED/></li><br>
						<li><input type="submit" value="Login" DISABLED/>
					<input type="reset" value="Clear" DISABLED/></li>
						</form>
					<li><a href="account.php?page=register">Create an account</a></li>
					</ul><br>
							
						
			<h2>Community</h2>
				<ul>
					<li><a>Player Search</a></li>
				<li>
				<form action="info.php" method="get">	
				<input type="hidden" name="act" value="players" />
				<input type="text" name="char" maxlength="30" DISABLED/>
				<input type="submit" value="Search" DISABLED/>

				</form>
				</li>					<li><a href="guild.php?page=list">Guild List</a></li>
					<li><a href="info.php?act=house">House List</a></li>
					<li><a href="info.php?act=deaths">Latest Deaths</a></li>
				</ul>


			</div>

		</div>

		<div class="clearer"><span></span></div>

	</div>