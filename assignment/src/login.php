<?php
//starting session
session_start();
//validating
if(isset($_POST['submit'])){
    //db connection
    require 'dbconnection.php';
    //checking username
	if($_POST['useremail']=="" ){
        $usererr= 'Useremail field is empty....';
        }//checking password
        elseif($_POST['password']=="" ){
        $passerr = 'password field is empty....';
        } // if all the condition is right this will be executed
            else{
                // for the admin checking
                $adminemail = $_POST['useremail'];
                $salt="23g427r2fb232fb3fv873f3f87fg3f384";
                $password= $_POST['password'].$salt;
                $password =sha1($password);

                // checking if this data is present in the database or not
                $selectQuery = "SELECT * FROM Admins WHERE admin_email = '$adminemail' AND admin_password ='$password'";
                $smkt=$dbcon->prepare($selectQuery);
                $smkt->execute();
                $count = $smkt->rowCount();
 
                // checking for the user
                $useremail = $_POST['useremail'];
                $password1= $_POST['password'].$salt;
                $password1 =sha1($password1);
                $selectQuery1 = "SELECT * FROM Users WHERE email = '$useremail' AND password_user ='$password1'";
                $smkt1=$dbcon->prepare($selectQuery1);
                $smkt1->execute();
                $count1 = $smkt1->rowCount();
                if($count >0){
                    // if admin condition is right
                    header("Location:index.php");

                }
                if($count1 >0){
                    // if user condition is right
                    header("Location:index.php");

                }
                else{
                }
                }
            }
?>
<?php
// needed files for this page
require 'cssadd.php';
    require 'main.php';

    ?>
<title>Northampton News - login</title>
<!-- some html code for the stating what the page is for -->
		<main>
			<nav>
				<article>If you are not the register member of the Northampton News,<br><br> You can
					Click below link to register as a user...
					<a href="register.php">New registration Here</a>
				</article>
			</nav>
			<article>
				<h2>User/Admin Login</h2>
				<h4>Welcome to Northampton News.</h4>
                <!-- creating for for the field that will be needed for the login for admin user -->
				<form  method=POST>
					<p class="one"> Welcome to the Northampton News. Please login to have access to various thing...</p><br><br>	
					<p><div class="validate">			<?php
                    // showing the message after the successful registration
                    if(isset($_SESSION['Message'])){
                        echo $_SESSION['Message'];
                        unset($_SESSION['Message']);
                    }

if(isset($_POST['submit'])){
    //connecting to db
    require 'dbconnection.php';
    // checking email
        if($_POST['useremail']=="" ){
            echo 'Useremail field is empty....';
            }
            // checking password
            elseif($_POST['password']=="" ){
            echo 'password field is empty....';
            }
            // checking whether they are in database or not
            else{
                // for the admin checking
                $adminemail = $_POST['useremail'];
                $salt="23g427r2fb232fb3fv873f3f87fg3f384";
                $password= $_POST['password'].$salt;
                $password =sha1($password);

               // checking if this data is present in the database or not
                $selectQuery = "SELECT * FROM Admins WHERE admin_email = '$adminemail' AND admin_password ='$password'";
                $smkt=$dbcon->prepare($selectQuery);
                $smkt->execute();
                $count = $smkt->rowCount();

                // checking for the user
                $useremail = $_POST['useremail'];
                $password1= $_POST['password'].$salt;
                $password1 =sha1($password1);
                $selectQuery1 = "SELECT * FROM Users WHERE email = '$useremail' AND password_user ='$password1'";
                $smkt1=$dbcon->prepare($selectQuery1);
                $smkt1->execute();
                $count1 = $smkt1->rowCount();
                if($count >0){
              // if admin condition is right
                    $_SESSION["adminemail"]=$_POST["useremail"];
                    header("Location:index.php");

                }
                if($count1 >0){
                 // if user condition is right
                    $_SESSION["useremail"]=$_POST["useremail"];
                    header("Location:index.php");

                }
                else{
                    echo 'Username or password is invalid';
                }
                }
            }
?>             	   <!-- forms for filling the form needed for the adimin / user login -->

					<label>Email</label> <input type="text" name="useremail"/>
					<label>Password</label> <input type="Password" name="password"/>

					<button type="submit" name="submit" value="Submit" >submit</button>

				</form>

                <?php
                // footer page
				require 'footer.php';
				?>