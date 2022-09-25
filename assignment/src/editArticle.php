<?php
//session started
session_start();
//getting the value from the previous page
$ti = $_GET['ti'];
$ca = $_GET['ca'];
$co = $_GET['co'];

//when the submit button is pressed by the user
if(isset($_POST['submit'])){
    require 'dbconnection.php';
//checking the validaition as below
    $adminemail = $_SESSION["adminemail"];
    $selectQuery = "SELECT admin_id FROM Admins WHERE admin_email = '$adminemail'";
	$smkt=$dbcon->prepare($selectQuery);
    $smkt->execute();
    $result = $smkt->fetch(PDO::FETCH_COLUMN);
//for title
        if($_POST['title']=="" ){
            }//category
            elseif($_POST['categoryi']=="" ){
                //description
            } elseif($_POST['description']=="" ){
                //for image
            } elseif($_POST['image']=="" ){
            }//after alll the requirenment is met
            else{
             //this message is sent to the next page
                $_SESSION['MESSAGE'] = 'Successfully updated  admin.........';
                //then sent to this page
                header("Location: adminArticles.php");
            }
}
?>
<?php
//taking the required file needed for these page
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
<title>Northampton News - editArticle</title>
<!-- code that specify the page info -->
		<main>
			<nav>
				<article>for going to the managearticle of the Northampton News,<br><br> You can
					Click below link ..
					<a href="adminArticles.php">manageArticle here</a>
				</article>
			</nav>
			<article>
				<h2>edit Article </h2>
				<h4>Welcome to Northampton News.</h4>
				<!-- form which is shown to the user to fill-->
				<form  method=POST>
					<p class="one"> Welcome to the Northampton News. Please edit the article ...</p><br><br>	
					<p><div class="validate">			<?php





if(isset($_POST['submit'])){
    require 'dbconnection.php';
// selecting the email to check that one user gave is already is in database or not
    $adminemail = $_SESSION["adminemail"];
    $selectQuery = "SELECT admin_id FROM Admins WHERE admin_email = '$adminemail'";
	$smkt=$dbcon->prepare($selectQuery);
	$smkt->execute();
    $result = $smkt->fetch(PDO::FETCH_COLUMN);
//validating title field
        if($_POST['title']=="" ){
            echo 'title field is empty';
            }//validating category field
            elseif($_POST['categoryi']=="" ){
                echo 'category field is empty';
            //validating description field
            } elseif($_POST['description']=="" ){
                echo 'content field is empty';
            // validating image field
            } elseif($_POST['image']=="" ){
                echo 'image field is empty';

            }//if all the requirenment is met
            else{
             //getting the value from the form
                $title = $_POST['title'];
                $category = $_POST['categoryi'];
                $desc = $_POST['description'];
                $image = $_POST['image'];
                //updating the record using the current form data
                $updateQuery=$dbcon->prepare("UPDATE article SET title='$title',categoryId='$category', admin_id='$result'  WHERE article_id =".$_GET['id']);
                $updateQuerya=$dbcon->prepare("UPDATE article SET content='$desc', image_a = '$image' WHERE article_id =".$_GET['id']);
                //executing the query
                $updateQuery->execute();
                $updateQuerya->execute();
               // this message is sent to next page
                $_SESSION['MESSAGE'] = 'Successfully updated  admin.........';
            }
}
?></div>
</p>
<!-- html form which give user space to fill the form -->
					<label>Title</label> <input type="text" value="<?php  echo "$ti" ?>" name="title"/>
                    <label>Category</label> <select name="categoryi" value="<?php  echo "$ca" ?>" id="categoryi">
                        <?php
                        //bringing the category from the database
                    $selectQuery = "SELECT categoryId,name FROM category";
						$smkt=$dbcon->prepare($selectQuery);
						$result = $smkt->execute();
						if ($result) {
							$record = $smkt->fetchAll();
							if (count($record) > 0) {
								foreach ($record as $row) {
									print '<option value='.$row["categoryId"].'>'.$row["name"].'</option>.';
									
								}
							}
							else{

							}
                        }
                            ?>
                    
      </select>
      <!-- for uploading image file -->
      <label>Upload Image</label> <input type="file" name="image" accept="image/*" />


					<label>Content</label> <textarea name="description" ><?php  echo "$co" ?></textarea><br><br>


					<button type="submit" name="submit" value="Submit" >Update</button>

				</form>

                <?php
                //footer for this page
				require 'footer.php';
				?>