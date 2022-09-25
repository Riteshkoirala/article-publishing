<?php
session_start();
// connecting to the database file
require('dbconnection.php');
// for deleating the file of the admin
if(isset($_GET['id']))
{
     $deletequery = "DELETE FROM article WHERE article_id=".$_GET['id'];
$skmt = $dbcon->prepare($deletequery);
$skmt->execute();
// to go in this page after the deletion is complete
header('Location:adminArticles.php');
}

?>