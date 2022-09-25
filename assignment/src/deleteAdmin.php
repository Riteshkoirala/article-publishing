<?php
session_start();
// connecting to the database file
require('dbconnection.php');
// for deleating the file of the admin
if(isset($_GET['id']))
{
     $sql = "DELETE FROM Admins WHERE admin_id=".$_GET['id'];
$skmt = $dbcon->prepare($sql);
$skmt->execute();
// to go in this page after the deletion is complete
header('Location:manageAdmin.php');
}


?>