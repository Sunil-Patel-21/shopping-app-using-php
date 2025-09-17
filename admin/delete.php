<?php 
$id = $_GET['ID'];    
$con = mysqli_connect("localhost", "root", "", "ecommerce",3307);

mysqli_query($con,"DELETE FROM tbluser WHERE Id=$id");
header("location:user.php");

?>