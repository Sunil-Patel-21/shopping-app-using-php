<?php 
$id = $_GET['ID'];    
$con = mysqli_connect("localhost", "root", "", "ecommerce");

mysqli_query($con,"DELETE FROM tbluser WHERE Id=$id");
header("location:user.php");

?>