<?php
session_start();
//unsetting the user that is login
//for user
unset($_SESSION['useremail']);
//for admin
unset($_SESSION['adminemail']);
// setting to this location after logout
header("Location: index.php");
?>