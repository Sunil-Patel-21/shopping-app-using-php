<?php 
// Get the 'ID' parameter from URL query string
$id = $_GET['ID'];    

// Connect to the MySQL database
$con = mysqli_connect("localhost", "root", "", "ecommerce",3307);

// Execute DELETE query to remove the user with the specified ID
mysqli_query($con,"DELETE FROM tbluser WHERE Id=$id");

// Redirect back to the users page after deletion
header("location:user.php");
?>
