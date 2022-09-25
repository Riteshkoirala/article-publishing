<?php
//starting the session
session_start();

//checking when the submit button is clicked
if(isset($_POST['submit'])){
	require 'dbconnection.php';

	//select query to check if the email is dublicate
	$useremail = $_POST['email'];
	$selectQuery = "SELECT * FROM Users WHERE email = '$useremail'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();

	//checking for the username field
	if($_POST['fullname']=="" ){
	}//checking for the email field
	elseif($_POST['email']=="" ){
	}//checking for the number field
	elseif($_POST['number']=="" ){
	}//checking for the gender field
	elseif($_POST['gender']=="" ){
	}//checking for the password field
	elseif($_POST['password']=="" ){
	}//checking for the repassword field
	elseif($_POST['repassword']==""){
	}//checking for the introduce field
	elseif($_POST['introduce']==""){
		}//checking for the repassword field
	elseif($_POST['repassword']!= $_POST['password']){
	}
	//checking for the duplicate email
	elseif (count($record) > 0) {
		
	}// this happens after their is no field empty and duplicate email
	else{
	$_SESSION['Message'] = 'Now you have successfully registered yourself so, login to access further information';
     header("Location: login.php");	
	}
}
?>
<?php
//getting the required file
require 'cssadd.php';
  require 'main.php';


    ?>
<title>Northampton News - Home</title>
<!-- some html code for the stating what the page is for -->
		<main>
			<nav>
				<article>If you are already member of the Northampton News,<br><br> You can
					Click below link to login...
					<a href="login.php">Login Here</a>
				</article>
			</nav>

			<article>
				<h2>New Registration</h2>
				<h4>Welcome to Northampton News.</h4>
			<!-- creating for for the field that will be needed for the login for admin user -->
				<form  method=POST>
					<p class="one"> All the fiels are compulsory to be filled with accurate detail.....Thank you!</p><br><br>	
					<p><div class="validate">			<?php

if(isset($_POST['submit'])){
	require 'dbconnection.php';

	$useremail = $_POST['email'];
	$selectQuery = "SELECT * FROM Users WHERE email = '$useremail'";
	$smkt=$dbcon->prepare($selectQuery);
	$result = $smkt->execute();
	$record = $smkt->fetchAll();
//checking for the username field
if($_POST['fullname']=="" ){
echo 'Username field is empty....';
}//checking for the email field
elseif($_POST['email']=="" ){
echo 'email field is empty....';
}//checking for the number field

elseif($_POST['number']=="" ){
echo 'number field is empty....';
}//checking for the gender field
elseif($_POST['gender']=="" ){
echo 'gender field is empty....';
}//checking for the password field
elseif($_POST['password']=="" ){
echo 'password field is empty....';
}//checking for the repassword field
elseif($_POST['repassword']==""){
echo 'repassowrd field is empty....';
}//checking for the introduce field
elseif($_POST['introduce']==""){
	echo 'introduce yourself is empty....';
	}//checking for the repassword field
elseif($_POST['repassword']!= $_POST['password']){
echo 'repassword and password field should be same....';
}//checking for the dublicate email
elseif (count($record) > 0) {
	
echo 'email already exists';	
}
// this happens after their is no field empty and duplicate email
else{
	require 'dbconnection.php';
   // these are the detail that have been brought from the form filled by user
	$username = $_POST['fullname'];
	$email = $_POST['email'];
	$phonenumber = $_POST['number'];
	$gender = $_POST['gender'];
	$introduce = $_POST['introduce'];
	$salt="23g427r2fb232fb3fv873f3f87fg3f384";
	$password= $_POST['password'].$salt;
	$password =sha1($password);

	// query for the insertion of the user in the database
$insertquery=$dbcon->prepare("INSERT INTO Users (username,email, phonenumber, gender, password_user,introduction) VALUES(:username,:email, :phonenumber, :gender, :password_user, :introduction)");
$insertquery->bindparam(':username',$username);
$insertquery->bindParam(':email',$email);
$insertquery->bindParam(':phonenumber',$phonenumber);
$insertquery->bindParam(':gender',$gender);
$insertquery->bindParam(':password_user',$password);
$insertquery->bindParam(':introduction',$introduce);
// executing the query
$insertquery->execute();
echo 'Registration Successfull now you can go to the sign in page to login to the northampton news.........';

$_SESSION['MESSAGE'] = 'Registration Successfull now you can go to the sign in page to login to the northampton news.........';
}

}
?></div>
					</p>
<!-- html form for taking the value from the user -->
					<label>Name</label> <input type="text" name="fullname"/>
					<label>EMail</label> <input type="email"  name="email"/>
					<label>Phone-Number</label> <input type="Number" name="number"/>
					<label>Gender</label> 
					<p>
					<label>Male</label> <input type="radio" name="gender" value="Male"/>
					<label>Female</label> <input type="radio" name="gender" value="Female"/>
					<label>Other</label> <input type="radio" name="gender" value="Other"/>
</p>
					<label>Password</label> <input type="Password" name="password"/>
					<label>Re-Password</label> <input type="Password" name="repassword"/>

					<label>Indroduce Yourself</label> <textarea name="introduce"></textarea><br><br>
					
					<p class="check"><br>I agree all the condition of th Northampton </label><input type="checkbox" name="check"/></p>
					<button type="submit" name="submit" value="Submit" >Register</button>

				</form>

				<?php
				// footer displayed in the page
				require 'footer.php';
				?>





