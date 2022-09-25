<?php
//starting session
session_start();
//validating
if(isset($_POST['submit'])){
        //db connection
    require 'dbconnection.php';
	if($_POST['adminemail']=="" ){
            //checking username
        $usererr= 'Useremail field is empty....';
        }//checking password
        elseif($_POST['password']=="" ){
        $passerr = 'password field is empty....';
        } // if all the condition is right this will be executed
            else{
                // for the admin checking
                $adminemail = $_POST['adminemail'];
                $salt="23g427r2fb232fb3fv873f3f87fg3f384";
                $password= $_POST['password'].$salt;
                $password =sha1($password);
                // checking if this data is present in the database or not
                $selectQuery = "SELECT * FROM Admins WHERE admin_email = '$adminemail' AND admin_password ='$password'";
                $smkt=$dbcon->prepare($selectQuery);
                $smkt->execute();
                $count = $smkt->rowCount();
                if($count >0){
                    // if admin condition is right
                    header("Location:index.php");
                }
                else{
                    // echo 'Username or password is invalid';
                }
                }
            }
?>
<?php
// needed files for this page
require 'cssadd.php';
    require 'main.php';

    ?>
<title>Northampton News - Home</title>
<!-- some html code for the stating what the page is for -->
		<main>
			<nav>
				<article>If you are not the register member of the Northampton News,<br><br> You can
					Click below link to register as a user...
					<a href="register.php">new registration</a>
				</article>
			</nav>
			<article>
				<h2>Admin </h2>
				<h4>Welcome to Northampton News.</h4>
                <!-- creating for for the field that will be needed for the login for admin user -->
				<form  method=POST>
					<p class="one"> Welcome to the Northampton News. Please login to have access to various thing...</p><br><br>	
					<p><div class="validate">			<?php
            //when you click the submit button
if(isset($_POST['submit'])){
        //connecting to db
    require 'dbconnection.php';
        // checking email
        if($_POST['adminemail']=="" ){
            echo 'admin
            email field is empty....';
            }  // checking password

            elseif($_POST['password']=="" ){
            echo 'password field is empty....';
            }
         // checking whether they are in database or not
            else{
               // for the admin checking
                $adminemail = $_POST['adminemail'];
                $salt="23g427r2fb232fb3fv873f3f87fg3f384";
                $password= $_POST['password'].$salt;
                $password =sha1($password);
                // checking if this data is present in the database or not
                $selectQuery = "SELECT * FROM Admins WHERE admin_email = '$adminemail' AND admin_password ='$password'";
                $smkt=$dbcon->prepare($selectQuery);
                $smkt->execute(
                );
                $count = $smkt->rowCount();
                if($count >0){
              // if admin condition is right
                    $_SESSION["adminemail"]=$_POST["adminemail"];
                }
                else{
                    echo 'adminemail or password is invalid';
                }
                }
            }
?><!-- forms for filling the form needed for the adimin / user login -->
					<label>User Email</label> <input type="text" name="adminemail"/>
					<label>Password</label> <input type="Password" name="password"/>

					<button type="submit" name="submit" value="Submit" >Log in</button>

				</form>
                <?php
               // footer page
				require 'footer.php';
				?>