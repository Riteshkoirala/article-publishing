<?php
//session started
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
        <?php
         //geeting the file that is required for this page
        require 'cssadd.php';
        ?>
		<title>Northampton News - Home</title>
	</head>
	<?php
    // this page run when user is logged in
if(isset($_SESSION['useremail'])){
    require 'main1.php';
} // this page run when admin is logged in
elseif(isset($_SESSION['adminemail'])){
	require 'main2.php';
}
else{//for general user
	require 'main.php';

}

    ?>
        <!-- These are the general outline of the code helps to specify  the page we are in -->
		<main>
			<nav>
            <article>You can click here to view  Northampton News ,<br><br> You can
					Click below link to fo to home  page...
					<a href="index.php">Home Page</a>
				</article>
			</nav>

			<article>
				<h2>Manage User</h2>
				<p>Carry out all the activities regarding the user</p>
                <!-- form to provide  a design -->
				<form>
                    <p>List of all the Users present in the database...</p>
				</form>
                <table class="but">
  <tr>
        <!-- table to showcase the data -->
    <th>ID</th>
    <th>Name</th>
    <th>E-mail</th>

  </tr>
<?php
//this are the data which are displayed to the admin and allow them to delete or edit them
//selecting the required field
$sql = "SELECT user_id, username, email FROM Users";
$smkt = $dbcon->prepare($sql);
$result = $smkt->execute();
if ($result) {
    $record = $smkt->fetchAll();
    if (count($record) > 0) {
        foreach ($record as $row) {
            print '<tr>
            <td>'.$row["user_id"].'</td>
            <td>'.$row["username"].'</td>
            <td>'.$row["email"]."</td>
            <td> <button type='submit' name='Edit' value='Edit' >Edit</button></td>
<td><a href='deleteUser.php?id=$row[user_id]'> <button  class ='delete' type='submit' name='Delete' value='Delete' onclick = 'return checkdelete()'>Delete</button></a></td>";
         }
    }
  else {
    // if there are no data this is selected
      print "No rows matched the query.";
    }
}
?>

                </table>
         
                <script>
        function checkdelete(){
             //javascrip function to give the conform message before deleting
        function checkdelete(){
            return confirm('Are you sure u want to delete this record ?');
        }
    </script>
                    <?php
                    //footer of the page
				require 'footer.php';
				?>