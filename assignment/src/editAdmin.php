<?php
//session started
session_start();
//getting the value from the previous page
$na = $_GET['name'];
$em = $_GET['email'];
$pa = $_GET['passw'];
//when the submit button is pressed by the user
if(isset($_POST['submit'])){
	require 'dbconnection.php';
//checking the validaition as below
	$useremail = $_POST['adminemail'];
	$selectQuery = "SELECT * FROM Admins WHERE admin_email = '$useremail'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();
//for name
	if($_POST['adminname']=="" ){
	}//for email
	elseif($_POST['adminemail']=="" ){
	}
// for password
	elseif($_POST['password']=="" ){
	}//for repassword
	elseif($_POST['repassword']==""){
	}
      //for repassowrd and password
	elseif($_POST['repassword']!= $_POST['password']){
	}// for dublicate record

    else{
 // to get into another page
    header("Location: manageAdmins.php");
	}
    
    }

?>
<?php
//taking the required file needed for these page
require 'cssadd.php';
require 'main2.php';
    ?>
<title>Northampton News - editAdmin</title>
<!-- code that specify the page info -->
		<main>
			<nav>
				<article>You can go back to manage admin to the Northampton News,<br><br> You can
					Click below link to login...
					<a href="manageAdmins.php">Manage Admin</a>
				</article>
			</nav>

			<article>
				<h2>Edit Admin</h2>
				<h4>Welcome to Northampton News.</h4>
				<!-- form which is shown to the user to fill-->
				<form  method=POST>
					<p class="one"> All the fiels are compulsory to be filled.....Thank you!</p><br><br>	
					<p><div class="validate">			<?php

if(isset($_POST['submit'])){

	require 'dbconnection.php';
// selecting the email to check that one user gave is already is in database or not
	$useremail = $_POST['adminemail'];
	$selectQuery = "SELECT * FROM Admins WHERE admin_email = '$useremail'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();
//validating name field
if($_POST['adminname']=="" ){
echo 'Username field is empty....';
}//validating email field
elseif($_POST['adminemail']=="" ){
echo 'email field is empty....';
}
//validating the password field
elseif($_POST['password']=="" ){
echo 'password field is empty....';
}//validating the repassword field
elseif($_POST['repassword']==""){
echo 'repassowrd field is empty....';
}
//checking whether the password and repassword is same or not
elseif($_POST['repassword']!= $_POST['password']){
echo 'repassword and password field should be same....';
}//checking if the data already exist

else{
	require 'dbconnection.php';
// data taken from the user when they updated the data 
	$username = $_POST['adminname'];
	$email = $_POST['adminemail'];
	$salt="23g427r2fb232fb3fv873f3f87fg3f384";
	$password= $_POST['password'].$salt;
	$password =sha1($password);
// query to update the admin table in the database
    $updateQuery=$dbcon->prepare("UPDATE Admins SET admin_name='$username',admin_email='$email', admin_password='$password'WHERE admin_id =". $_GET['id']);

//executing the query
$updateQuery->execute();
echo 'Successfully updated admin.........';

$_SESSION['MESSAGE'] = 'Successfully updated  admin.........';

}

}
?></div>
					</p>
                   <!-- form to get the data from the user and pre given value to them -->
					<label>FullName</label> <input type="text" value="<?php  echo "$na" ?>" name="adminname"/>
					<label>E-Mail</label> <input type="email"  value="<?php  echo "$em" ?>" name="adminemail"/>
					<label>Password</label> <input type="Password" value="<?php  echo "$pa" ?>" name="password"/>
					<label>Re-Password</label> <input type="Password" value="<?php  echo "$pa" ?>" name="repassword"/>

					<button type="submit" name="submit" value="Submit" >ADD</button>

				</form>

				<?php
				//footer of this page
				require 'footer.php';
				?>