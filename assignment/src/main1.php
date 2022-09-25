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
						//connecting database
						require 'dbconnection.php';
                       // selecting for the category present in the database
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
				
				<?php
				// this appears only if the registered user is loggged in
				if(isset($_SESSION["useremail"])){
				echo '<li><a class="hero" href="#" >		<img src="images/ava.jpg" width = "20px" height="15px" />';
										require 'cssadd.php';
					require 'dbconnection.php';
					$useremail = $_SESSION['useremail'];
					$selectQuery = "SELECT username FROM Users WHERE email = '$useremail'";
                $smkt=$dbcon->prepare($selectQuery);
                $smkt->execute();

				$result = $smkt->fetch(PDO::FETCH_COLUMN);

                print_r($result);
				echo '</a>';
				//apear after u touch your profile in the nav bar
				echo '<ul>
				
				<li><a class="articleLink" href="logout.php">Log out</a></li>
				<li><a class="articleLink" href="profile.php">Profile</a></li>
			</ul></li>';
				}
				// this happens if the logout is pressed
				elseif(isset($_SESSION['LOGOUT'])){
					echo '<li><a href="#">Members</a>
					<ul>
				
						<li><a class="articleLink" href="register.php">Sign Up</a></li>
						<li><a class="articleLink" href="login.php">Sign In</a></li>
						<li><a class="articleLink" href="adminloginin.php">admin sign In</a></li>

					</ul>
				</li>';	
					
				}
					
				?>
			</ul>
		</nav>
		<!-- photo banner appear everywhere -->
		<img src="images/banners/randombanner.php" />