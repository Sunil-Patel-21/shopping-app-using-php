<?php 
include 'Config.php';
$id = $_GET['ID'];
mysqli_query($con,"DELETE FROM tblproduct WHERE Id=$id");
header("location:index.php");
?>