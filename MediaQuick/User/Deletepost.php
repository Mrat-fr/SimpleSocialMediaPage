<?php
include("../dbConfig.php");

$id = $_GET["uid"];
$Decision = $_POST['Decision'];
$insert = $db->query("DELETE FROM posts WHERE ID = '$id'"); 
header('Location: UserPage.php');


?>