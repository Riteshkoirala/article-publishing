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
				<li><a href="#">Article</a>
					<ul>
						<li><a class="articleLink" href="adminArticles.php">Manage Article </a></li>
						<li><a class="articleLink" href="addArticle.php">add Article</a></li>


					</ul>
				</li>
				<li><a href="#">Select Category</a>
					<ul>
						<?php
						//bringing the database 
						require 'dbconnection.php';

						//setting the category for the selection
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
						<li><a class="articleLink" href="adminCategories.php">Manage Category </a></li>
					</ul>
				</li>
				
				<?php
				// this only appear if the admin user is logged in
				if(isset($_SESSION["adminemail"])){
				echo '<li><a class="hero" href="#" >		<img src="images/ava.jpg" width = "20px" height="15px" />';
										require 'cssadd.php';
					require 'dbconnection.php';
					$adminemail = $_SESSION["adminemail"];
					$selectQuery = "SELECT admin_name FROM Admins WHERE admin_email = '$adminemail'";
                $smkt=$dbcon->prepare($selectQuery);
                $smkt->execute();

				$result = $smkt->fetch(PDO::FETCH_COLUMN);

                print_r($result);
				echo '</a>';
				// this appear when u click on the profile
				echo '<ul>
				<li><a class="articleLink" href="logout.php">Log out</a></li>
				<li><a class="articleLink" href="profile.php">Profile</a></li>
                <li><a class="articleLink" href="manageAdmins.php">Manage Admin</a></li>
				<li><a class="articleLink" href="manageUser.php">Manage user</a></li>


			</ul></li>';
				}
				
				elseif(isset($_SESSION['LOGOUT'])){
					//this happens when u logout
					echo '<li><a href="#">Members</a>
					<ul>
						<li><a class="articleLink" href="register.php">Sign Up</a></li>
						<li><a class="articleLink" href="login.php">Sign In</a></li>
						<li><a class="articleLink" href="adminLogin.php">admin sign In</a></li>

					</ul>
				</li>';	
					
				}
					
				?>
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />