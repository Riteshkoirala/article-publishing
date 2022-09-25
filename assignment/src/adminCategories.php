<?php
//starting the session
session_start();
?>
<?php
// including the required file for the process
   require 'cssadd.php';
   ?>
	<title>Northampton News - Home</title>
	<?php
    // giving condition for desplaying the gic=ven in the time what they have

    //for users
if(isset($_SESSION['useremail'])){
    require 'main1.php';
}//for admins
elseif(isset($_SESSION['adminemail'])){
	require 'main2.php';
}
//for general
else{
	require 'main.php';
}
    ?>
		<main>
			<nav>
                <!-- general text desplayed in the page -->
            <article>You can click here to view  Northampton News ,<br><br> You can
					Click below link to fo to home  page...
					<a href="index.php">Home Page</a>
				</article>
			</nav>
			<article>
				<h2>Manage Category</h2>
				<p>Carry out all the activities regarding the admin</p>

				<ul>
                    <!-- a url to navigate to the next page -->
					<li><a href='addCategory.php' >Click here to add new category</a></li>

				</ul>
				<form>
                    <p>List of all the categories present in the database...</p>
                <!-- creating table for displaying data -->
				</form>
                <table class="but">
  <tr>
    <th>ID</th>
    <th>Name</th>

  </tr>
<?php
//this will select all the data that was in the database and display them
$sql = "SELECT categoryId, name, description_c FROM category";
$smkt = $dbcon->prepare($sql);
$result = $smkt->execute();
if ($result) {
    $record = $smkt->fetchAll();
    if (count($record) > 0) {
        foreach ($record as $row) {
            print '<tr>
            <td>'.$row["categoryId"].'</td>
            <td>'.$row["name"]."</td>
            <td><a href='editCategory.php?id=$row[categoryId] & name=$row[name] & des=$row[description_c]'> <button  class ='edit' type='submit' name='edit' value='edit'>Edit</button></a></td>;
            <td><a href='deleteCategory.php?id=$row[categoryId]'> <button  class ='delete' type='submit' name='Delete' value='Delete' onclick = 'return checkdelete()'>Delete</button></a></td>";
         }
    }
  else {
    //when there is no data this will be displayed
      print "No rows matched the query.";
    }
}
?>
                </table>
         <!-- javascript function to alert when the data is being delete -->
                <script>
        function checkdelete(){
            return confirm('Are you sure u want to delete this record ?');
        }
    </script>
                    <?php
                    // footer of the page
				require 'footer.php';
				?>