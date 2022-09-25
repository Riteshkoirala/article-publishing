<?php
//starting of the session
session_start();
//checking as needed validation of the form
if(isset($_POST['submit'])){
    require 'dbconnection.php';
    	//selecting the admin who is logged in
    $adminemail = $_SESSION["adminemail"];
    $selectQuery = "SELECT admin_id FROM Admins WHERE admin_email = '$adminemail'";
	$smkt=$dbcon->prepare($selectQuery);
    $smkt->execute();
    $result = $smkt->fetch(PDO::FETCH_COLUMN);
	//checking hether the field are empty or not 

        if($_POST['title']=="" ){
            }
            elseif($_POST['categoryi']=="" ){
            } elseif($_POST['description']=="" ){
            } elseif($_POST['image']=="" ){
            }
            else{
		// if every condition is correct adding the user and sending the user to the next page
$_SESSION['MESSAGE'] = 'New article added.........';
header("Location: index.php");
            }
}
?>
<?php
// bringing the css connecting file and the nav bar for the required panal
require 'cssadd.php';
if(isset($_SESSION['useremail'])){
    require 'main1.php';
}
elseif(isset($_SESSION['adminemail'])){
	require 'main2.php';
}
else{
	require 'main.php';
}
?>
<!-- some html code for the stating what the page is for -->
<title>Northampton News - Home</title>
		<main>
			<nav>
            <article>for going to the managearticle of the Northampton News,<br><br> You can
					Click below link to go to manage admin page...
					<a href="adminArticles.php">manage article</a>
				</article>
			</nav>
			<article>
				<h2>Article </h2>
				<h4>Welcome to Northampton News.</h4>
            <!-- creating for for the field that will be needed add a new article by admin user -->
				<form  method=POST>
					<p class="one"> Welcome to the Northampton News. Please ladd article using below field...</p><br><br>	
					<p><div class="validate">			<?php

if(isset($_POST['submit'])){
    require 'dbconnection.php';
    	//selecting the admin who is logged in
    $adminemail = $_SESSION["adminemail"];
    $selectQuery = "SELECT admin_id FROM Admins WHERE admin_email = '$adminemail'";
	$smkt=$dbcon->prepare($selectQuery);
	$smkt->execute();
    $result = $smkt->fetch(PDO::FETCH_COLUMN);
	//checking whether the field are empty or not and dublication of the email
        if($_POST['title']=="" ){
            echo 'title field is empty';
            }// for category
            elseif($_POST['categoryi']=="" ){
                echo $_POST['categoryi'];
                echo 'category field is empty';
             // for post description
            }  elseif($_POST['description']=="" ){
                echo 'content field is empty';
            // for image
            } elseif($_POST['image']=="" ){
                echo 'image field is empty';

            }
            else{
                	// connecting to the database
                require 'dbconnection.php';
                $title = $_POST['title'];
                $category = $_POST['categoryi'];
                $desc = $_POST['description'];
                $image = $_POST['image'];

	           // insert value to insert into the database
                $insertquery=$dbcon->prepare("INSERT INTO article (title, categoryId, admin_id, content, image_a) VALUES(:title, :categories_id, :admin_id, :content, :image_a)");

                $insertquery->bindparam(':title',$title);
                $insertquery->bindParam(':categories_id',$category);
                $insertquery->bindparam(':admin_id',$result);
                $insertquery->bindparam(':content',$desc);
                $insertquery->bindparam(':image_a',$image);
//executing the above statement
                $insertquery->execute();
            }
}
?>
       </div>
             </p>
             	   <!-- forms for filling the form needed for the adimin registration -->
					<label>Title</label> <input type="text" name="title"/>
                    <label>Category</label> <select name="categoryi" id="categoryi">
                        <?php
                        // for getting the select for the category in article
                    $selectQuery = "SELECT categoryId,name FROM category";
						$smkt=$dbcon->prepare($selectQuery);
						$result = $smkt->execute();
						if ($result) {
							$record = $smkt->fetchAll();
							if (count($record) > 0) {
								foreach ($record as $row) {
									print "<option value='$row[categoryId]'>".$row['name']."</option>";	
								}
							}
							else{

							}
                        }
                            ?>  
      </select>
      <!-- for uploading image -->
      <label>Upload Image</label> <input type="file" name="image" accept="image/*" />
					<label>Content</label> <textarea name="description" ></textarea><br><br>
					<button type="submit" name="submit" value="Submit" >Add</button>
				</form>
				</p>
                <?php
                // footer of this page 
				require 'footer.php';
				?>