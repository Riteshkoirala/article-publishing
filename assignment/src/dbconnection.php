<?php
// connecting the database

$server = 'db';
$username='root';
$password='example';
$db = 'assignment1';
$port ='8080';
$dbcon = new PDO("mysql:host=$server;dbname=$db",$username,$password);


?>