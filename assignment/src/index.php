<?php
//starting session
session_start();
?>
<!DOCTYPE html>
<html>
	<head>

	<title>Northampton News - Home</title>
	</head>
	<?php
	require 'cssadd.php';
	//getting the required field for the required user
	require 'dbconnection.php';
//for registered users
if(isset($_SESSION['useremail'])){
    require 'main1.php';
}//for admin users
elseif(isset($_SESSION['adminemail'])){
	require 'main2.php';
}
else{//for general users
	require 'main.php';

}
    ?>
		<main>
			<nav>
				<!-- geeting the category list for the nav bar for all users  -->
			<li><a href="#"> Category List</a>
					<ul>
						<p>
						<?php
						require 'dbconnection.php';

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
					</ul>
				</li>
			</nav>
			<article>
				<h3>Article posted in the northampton news.</h3>
				<div id = 'prin'>
				<?php
				
if(isset($_GET['catid']))
{
// for getting the data which was in the selected category
	$id = $_GET["catid"];
	$sql = "SELECT article_id, title, categoryId, admin_id, publishDate FROM article WHERE categoryId = $id ORDER BY publishDate DESC";

	$smkt = $dbcon->prepare($sql);
	$result = $smkt->execute();

if ($result) {//from this we get the data displayed
    $record = $smkt->fetchAll();
    if (count($record) > 0) {
        foreach ($record as $row) {
			$sql1 = "SELECT admin_name FROM Admins WHERE admin_id =".$row["admin_id"];
			$sql2 = "SELECT name FROM category WHERE categoryId =".$row["categoryId"];
			$smkt1 = $dbcon->prepare($sql1);
			$result1 = $smkt1->execute();
			$smkt2 = $dbcon->prepare($sql2);
			$result2 = $smkt2->execute();
			$record1 = $smkt1->fetch(PDO::FETCH_COLUMN);
			$record2 = $smkt2->fetch(PDO::FETCH_COLUMN);

            print
            "<br><br><div id='prin'><a class ='prin' href='index.php?artid=$row[article_id]'><h2>".$row["title"]."</h2>
            <h5>".'Published By  :  '.$record1.'</h5>
            <h6>'.'ON  : '.$row["publishDate"].'</h6>
			<h6>'.'OF  :  '.$record2."</h6><br>
			If you want to read further click the article...</a></div><br><br><br><br><form></form>";

         }
		
		}
		else{
			//if there is no data found
			echo 'There is no record';
		}
		
	}
	
}//when we select the specific artic,e
 elseif(isset($_GET['artid'])){
	$id = $_GET["artid"];
	$sql = "SELECT article_id, title, categoryId, admin_id, content, publishDate, image_a FROM article WHERE article_id =$id ";

	$smkt = $dbcon->prepare($sql);
	$result = $smkt->execute();

if ($result) {//when we search for the data in database and we get it
    $record = $smkt->fetchAll();
// this is where we can see the full article
    if (count($record) > 0) {
        foreach ($record as $row) {
			$sql1 = "SELECT admin_name FROM Admins WHERE admin_id =".$row["admin_id"];
			$sql2 = "SELECT name FROM category WHERE categoryId =".$row["categoryId"];
			$smkt1 = $dbcon->prepare($sql1);
			$result1 = $smkt1->execute();
			$smkt2 = $dbcon->prepare($sql2);
			$result2 = $smkt2->execute();
			$record1 = $smkt1->fetch(PDO::FETCH_COLUMN);
			$record2 = $smkt2->fetch(PDO::FETCH_COLUMN);
           //printing the article
            print
            "<br><br><h1>".$row["title"]."</h1>
            <h5>".'Published By  :  '.$record1.'</h5>
            <em>'.'ON  : '.$row["publishDate"].'</em>
			<h6>'.'OF  :  '.$record2."</h6><br>
			<article>".$row["image_a"]."</article>
			<article>".$row["content"]."</article>
			<form></form>";		
	}

	}
}//in this section logged in user will be able to see the comment
echo '<H3>COMMENTS</H3>';
$select5 = "SELECT DISTINCT username,article_id FROM comment WHERE article_id =".$_GET['artid'];
$smt5 = $dbcon->prepare($select5);
$smt5->execute();
$record5 = $smt5->fetchAll();
if (count($record5) > 0) {
	foreach ($record5 as $row) {  
		print
		"</li><a href='index.php?artid=$row[article_id]&name=$row[username]'> $row[username]</a><br><br>";
}
echo '<form></form>';
require 'userComments.php';

}
//in this section logged in user will be able to write the comment and post it
			if(isset($_SESSION['adminemail'])){

				echo '<form method="POST"><h4>COMMENT FORM</h4>';

				echo '
				<label>CommentText</label> <textarea name="comment"></textarea>
	
				<button type="submit" name="submit" value="Submit" >Comment</button>';
	
				echo '</form>';
				//this is for the admin user when they submit the comment
				if(isset($_POST['submit'])){


					$adminemail = $_SESSION["adminemail"];



					$select = "SELECT admin_name FROM Admins WHERE admin_email ='$adminemail'";
					$smt = $dbcon->prepare($select);
					$smt->execute();
					$show = $smt->fetch(PDO::FETCH_COLUMN);
		
					$arid = $_GET['artid'];
					$name = $show;
					$comment = $_POST['comment'];
	
					$insertquery=$dbcon->prepare("INSERT INTO comment (username,article_id, comment) VALUES(:username,:article_id, :comment)");
	
	$insertquery->bindparam(':username',$name);
	$insertquery->bindparam(':article_id',$arid);

	$insertquery->bindParam(':comment',$comment);
	$insertquery->execute();

	
	$_SESSION['MESSAGE'] = 'New comment added.........';
				}


			}
			elseif(isset($_SESSION['useremail'])){
				//this is for the  user when they submit the comment

				echo '<form method="POST"><h4>COMMENT FORM</h4>';

				echo '
				<label>Comment</label> <textarea name="comment"></textarea>
	
				<button type="submit" name="submit" value="Submit" >Comment</button>';
	
				echo '</form>';
	
				if(isset($_POST['submit'])){

					$useremail = $_SESSION["useremail"];



					$select1 = "SELECT username FROM Users WHERE email ='$useremail'";
					$smt1 = $dbcon->prepare($select1);
					$smt1->execute();
					$show1 = $smt1->fetch(PDO::FETCH_COLUMN);

	
					$arid = $_GET['artid'];

					$name = $show1;
					$comment = $_POST['comment'];
	
	
					$insertquery=$dbcon->prepare("INSERT INTO comment (username,article_id, comment) VALUES(:username,:article_id, :comment)");
	
	$insertquery->bindparam(':username',$name);
	$insertquery->bindparam(':article_id',$arid);

	$insertquery->bindParam(':comment',$comment);
	$insertquery->execute();

	
	$_SESSION['MESSAGE'] = 'New comment added.........';
				}
			}
         }
else{
	//this is for displaying the article in index page
$sql = "SELECT article_id, title, categoryId, admin_id, publishDate, image_a FROM article ORDER BY publishDate DESC";

$smkt = $dbcon->prepare($sql);
$result = $smkt->execute();
if ($result) {
    $record = $smkt->fetchAll();
    if (count($record) > 0) {
        foreach ($record as $row) {
			$sql1 = "SELECT admin_name FROM Admins WHERE admin_id =".$row["admin_id"];
			$sql2 = "SELECT name FROM category WHERE categoryId =".$row["categoryId"];
			$smkt1 = $dbcon->prepare($sql1);
			$result1 = $smkt1->execute();
			$smkt2 = $dbcon->prepare($sql2);
			$result2 = $smkt2->execute();
			$record1 = $smkt1->fetch(PDO::FETCH_COLUMN);
			$record2 = $smkt2->fetch(PDO::FETCH_COLUMN);

            print 
            "<br><br><a href='index.php?artid=$row[article_id]'><h2>".$row["title"]."</h2>
            <h5>".'Published By  :  '.$record1.'</h5>
            <h6>'.'ON  : '.$row["publishDate"].'</h6>
			
			<h6>'.'OF  :  '.$record2."</h6><br>
			If you want to read further click the article...</a><br><br><form></form>";

         }
		}
		else{
			//if there is no data found
			echo 'There is no record';
		}
	}
    }
?>
<?php
//footer of the page
require 'footer.php';
?>
