<?php
//starting session
session_start();
?>
        <?php
        //getting the required file
        require 'cssadd.php';
        ?>
		<title>Northampton News - Home</title>
	<?php
    //checking the nav bar function for the normal user and admin
if(isset($_SESSION['useremail'])){
    require 'main1.php';
}// for admin
elseif(isset($_SESSION['adminemail'])){
	require 'main2.php';
}
else{//general
	require 'main.php';

}

    ?>
    <!-- this are the point regarding the page  -->
		<main>
			<nav>
            <article>You can click here to view  Northampton News ,<br><br> You can
					Click below link to fo to home  page...
					<a href="index.php">Home Page</a>
				</article>
			</nav>

			<article>
				<h2>Manage Article</h2>
				<p>Carry out all the activities regarding the article...</p>

				<ul>
					<li><a href='addArticle.php' >Click here to add new article</a></li>

				</ul>
                <!-- this is to design line -->
				<form>
                    <p>List of all the article present in the database...</p>
				</form>
                <table class="but">
  <tr>
    <!-- table used in to display records -->
    <th>ID</th>
    <th>Title</th>
    <th>Published-date</th>
    <th>categories_id</th>


  </tr>
<?php
//selecting data from the article table
$sql = "SELECT article_id, title, publishDate, categoryId, content FROM article";
$smkt = $dbcon->prepare($sql);
$result = $smkt->execute();
if ($result) {
    $record = $smkt->fetchAll();
    if (count($record) > 0) {
        foreach ($record as $row) {
            print '<tr>
            <td>'.$row["article_id"].'</td>
            <td>'.$row["title"].'</td>
            <td>'.$row["publishDate"].'</td>
            <td>'.$row["categoryId"]."</td>
            <td><a href='editArticle.php?id=$row[article_id] & ti=$row[title] & ca=$row[categoryId] & co=$row[content]'> <button  class ='edit' type='submit' name='edit' value='edit'>Edit</button></a></td>
            <td><a href='deleteArticle.php?id=$row[article_id]'> <button  class ='delete' type='submit' name='Delete' value='Delete' onclick = 'return checkdelete()'>Delete</button></a></td>";
         }
    }
  else {
    //if there is no data present
      print "No rows matched the query.";
    }
}
?>

                </table>
         

    <script>
        // javascript function to ask user before deleting
        function checkdelete(){
            return confirm('Are you sure u want to delete this record ?');
        }
    </script>
                    <?php
                    //footer of the page
				require 'footer.php';
				?>
