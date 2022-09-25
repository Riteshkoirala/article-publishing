<?php
//starting of the session
session_start();


//checking as needed validation of the form
if(isset($_POST['submit'])){
	//bringing next php file here
	require 'dbconnection.php';

	//selecting the username for no dublication of the email
	$useremail = $_POST['adminemail'];
	$selectQuery = "SELECT * FROM Admins WHERE admin_email = '$useremail'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();

	//checking whether the field are empty or not and dublication of the email
	if($_POST['adminname']=="" ){}
	elseif($_POST['adminemail']=="" ){}
	elseif($_POST['password']=="" ){}
	elseif($_POST['repassword']==""){}
	elseif($_POST['repassword']!= $_POST['password']){}
	elseif (count($record) > 0) {}
    else{
		// if every condition is correct adding the user and sending the user to the next page
    header("Location: manageAdmins.php");
    }
    }
?>
<?php
// bringing the css connecting file and the nav bar for the required panal
require 'cssadd.php';
 require 'main2.php';
?>
<!-- some html code for the stating what the page is for -->
<title>Northampton News - add-Admin</title>
		<main>
			<nav>
				<article>You can manage admin from here to the Northampton News admin panal,<br><br> You can
					Click below link to manage admin...
					<a href="manageAdmins.php">manage admin</a>
				</article>
			</nav>
			<article>
				<h2>New Admin Registration</h2>
				<h4>Welcome to Northampton News.</h4>
				<!-- creating for for the field that will be needed add a new admin user -->
				<form  method=POST>
					<p class="one"> All the fiels are compulsory to be filled.....Thank you!</p><br><br>	
					<p><div class="validate"><?php

if(isset($_POST['submit'])){
	require 'dbconnection.php';
	//selecting the username for no dublication of the email

	$useremail = $_POST['adminemail'];
	$selectQuery = "SELECT * FROM Admins WHERE admin_email = '$useremail'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();

	//checking whether the field are empty or not and dublication of the email
if($_POST['adminname']=="" ){
echo 'Username field is empty....';
}//for email
elseif($_POST['adminemail']=="" ){
echo 'email field is empty....';
}
// for password
elseif($_POST['password']=="" ){
echo 'password field is empty....';
}// for repassword
elseif($_POST['repassword']==""){
echo 'repassowrd field is empty....';
}
// for repassword
elseif($_POST['repassword']!= $_POST['password']){
echo 'repassword and password field should be same....';
}
// for duplicate email
elseif (count($record) > 0) {
	
	echo 'email already exists';	
	}
else{
	// connecting to the database
	require 'dbconnection.php';

	$username = $_POST['adminname'];
	$email = $_POST['adminemail'];
	$salt="23g427r2fb232fb3fv873f3f87fg3f384";
	$password= $_POST['password'].$salt;
	$password =sha1($password);

	// insert value to insert into the database
$insertquery=$dbcon->prepare("INSERT INTO Admins (admin_name,admin_email, admin_password) VALUES(:admin_name,:admin_email, :admin_password)");
$insertquery->bindparam(':admin_name',$username);
$insertquery->bindParam(':admin_email',$email);

$insertquery->bindParam(':admin_password',$password);
//executing the above statement
$insertquery->execute();
echo 'Successfully created new admin.........';
// message sent form this page to an another
$_SESSION['MESSAGE'] = 'Successfully created new admin.........';
}
}
?>
    </div>
	   </p>
	   <!-- forms for filling the form needed for the adimin registration -->
		  <label>FullName</label> <input type="text" name="adminname"/>
		  <label>E-Mail</label> <input type="email"  name="adminemail"/>
		  <label>Password</label> <input type="Password" name="password"/>
		  <label>Re-Password</label> <input type="Password" name="repassword"/>

		  <button type="submit" name="submit" value="Submit" >ADD</button>
	</form>
<?php
// footer of this page 
require 'footer.php';
?>





