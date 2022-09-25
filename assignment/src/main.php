<!-- main part of the layout which is consistance as provided by the university -->
<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Latest Articles</a></li>
				<li><a href="#">Select Category</a>
					<ul>
						<?php
						// connecting to the database
						require 'dbconnection.php';

						// selecting to bring the category present in the database to here
						$selectQuery = "SELECT categoryId, name FROM category";
						$smkt=$dbcon->prepare($selectQuery);
						$result = $smkt->execute();
						if ($result) {
							$record = $smkt->fetchAll();
							if (count($record) > 0) {
								foreach ($record as $row) {
									print "<a href='index.php?catid=$row[categoryId]'> <button  class ='sel' type='onclick' name='sel' value='sel'>.$row[name].</button></a></td>";									
								}
							}
							else{

							}
						}
						?>
					</ul>
				</li>
				<li><a href="#">Members</a>
					<ul>
						<!-- link for their respective pages -->
						<li><a class="articleLink" href="register.php">user Sign Up</a></li>
						<li><a class="articleLink" href="login.php">user Sign In</a></li>
						<li><a class="articleLink" href="adminLogin.php">admin sign In</a></li>

					</ul>
				</li>
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />