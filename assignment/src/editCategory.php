<?php
//session started
session_start();
//getting the value from the previous page
$nam = $_GET['name'];
$de = $_GET['des'];
//when the submit button is pressed by the user
if(isset($_POST['submit'])){
    require 'dbconnection.php';
//checking the validaition as below
	$name = $_POST['name'];
	$selectQuery = "SELECT * FROM category WHERE name = '$name'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();
//for name 
        if($_POST['name']=="" ){
            }//for dispription
            elseif($_POST['description']=="" ){
            }//for dublicate category name
			elseif($record==1){
			}//if all the condition meets its requirenment
            else{
    //message sent to next page
    $_SESSION['MESSAGE'] = 'Successfully updated  Category.........';
    //redirectiong to next page
	header("Location: adminCategories.php");
            }
}
?>
<?php
//getting the required file as per the user logged in.
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
<title>Northampton News - editCategory</title>
<!-- code that specify the page info -->

		<main>
			<nav>
				<article>you can go back to adminCategories Northampton News,<br><br> You can
					Click below link to register as a user...
					<a href="adminCategories.php"></a>Manage Category
				</article>
			</nav>

			<article>
				<h2>Admin </h2>
				<h4>Welcome to Northampton News.</h4>
<!-- form which is shown to the user to fill-->
				<form  method=POST>
					<p class="one"> Welcome to the Northampton News. Please login to have access to various thing...</p><br><br>	
					<p><div class="validate">			<?php
//while user submit the post
if(isset($_POST['submit'])){
    require 'dbconnection.php';
// selecting the email to check that one user gave is already is in database or not
    $name = $_POST['name'];
	$selectQuery = "SELECT * FROM category WHERE name = '$name'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();
//validating name field
        if($_POST['name']=="" ){
            echo 'category name field is empty....';
            }//validating discription
            elseif($_POST['description']=="" ){
            echo 'description field is empty....';
            }//checking for dublicate name
			elseif($record==1){
          echo 'name already exicts';
			}
            else{
           // data taken from the user when they updated the data 
                $name = $_POST['name'];
                $des = $_POST['description'];
                // query to update the admin table in the database
                $updateQuery=$dbcon->prepare("UPDATE category SET name='$name',description_c='$des' WHERE categoryId =".$_GET['id']);

                //executing the query
                $updateQuery->execute();
                echo 'Successfully updated admin.........';
}
                }
            
?></div>
</p>                   <!-- form to get the data from the user and pre given value to them -->
					<label>Name</label> <input type="text" value="<?php  echo "$nam" ?>" name="name"/>
					<label>Description</label> <textarea name="description" ><?php  echo "$de" ?></textarea><br><br>
					<button type="submit" name="submit" value="Submit" >Update</button>
				</form>
				<?php
				//footer of this page
				require 'footer.php';
				?>