<?php
//starting of the session
session_start();
//checking as needed validation of the form
if(isset($_POST['submit'])){
		//bringing next php file here
    require 'dbconnection.php';
	//selecting the category
	$name = $_POST['name'];
	$selectQuery = "SELECT * FROM category WHERE name = '$name'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();
	//checking whether the field are empty or not and dublication of the category name
        if($_POST['name']=="" ){
            }//for description
            elseif($_POST['description']=="" ){
            }//checking the dublication
            elseif (count($record) > 0) {
	
                }

            else{
		// if every condition is correct adding the user and sending the user to the next page
$_SESSION['MESSAGE'] = 'Registration Successfull now you can go to the sign in page to login to the northampton news.........';
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
<title>Northampton News - addCategory</title>

		<main>
			<nav>
				<article>If you are not the register member of the Northampton News,<br><br> You can
					Click below link to register as a user...
					<a href="adminCategories.php">manage categories</a>
				</article>
			</nav>
			<article>
				<h2>Admin </h2>
				<h4>Welcome to Northampton News.</h4>
				<!-- creating for for the field that will be needed add a new admin user -->
				<form  method=POST>
					<p class="one"> Welcome to the Northampton News. Please add categories using below field..</p><br><br>	
					<p><div class="validate">			<?php

if(isset($_POST['submit'])){
    require 'dbconnection.php';
	//selecting the username for no dublication of the email
    $name = $_POST['name'];
	$selectQuery = "SELECT * FROM category WHERE name = '$name'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();

		//checking whether the field are empty or not and dublication of the email
        if($_POST['name']=="" ){
            echo 'category name field is empty....';
            }//for description
            elseif($_POST['description']=="" ){
            echo 'description field is empty....';
            }// for dublicate value
            elseif (count($record) > 0) {
	
                echo 'category already exists';	
                }
            else{

                $name = $_POST['name'];
                $des = $_POST['description'];
	// insert value to insert into the database
    $insertquery=$dbcon->prepare("INSERT INTO category (name,description_c) VALUES(:namee,:descrip)");
$insertquery->bindparam(':namee',$name);
$insertquery->bindParam(':descrip',$des);
//executing the above statement
$insertquery->execute();
session_start();
// message sent form this page to an another
$_SESSION['MESSAGE'] = 'Registration Successfull now you can go to the sign in page to login to the northampton news.........';
}
                }  
?>
      </div>
           </p>
		   	   <!-- forms for filling the form needed for the category  -->
				<label>Name</label> <input type="text" name="name"/>
				<label>Description</label> <textarea name="description"></textarea><br><br>
			 <button type="submit" name="submit" value="Submit" >Add</button>
				</form>
				<?php
				// footer of this page 
				require 'footer.php';
				?>