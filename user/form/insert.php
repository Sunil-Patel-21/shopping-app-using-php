<?php 

// Check if the form has been submitted
if(isset($_POST['submit'])){
    // Connect to the MySQL database
    $con = mysqli_connect("localhost","root","","ecommerce",3307);

    // Retrieve form data from POST request
    $Name = $_POST["name"];
    $Email = $_POST["email"];
    $Number = $_POST["number"];
    $Password = $_POST["password"];

    // Check if the email already exists in the database
    $Dup_Email = mysqli_query($con,"SELECT * FROM `tbluser` WHERE Email='$Email'");
    // Check if the username already exists in the database
    $Dup_username = mysqli_query($con,"SELECT * FROM `tbluser` WHERE UserName='$Name'");

    // If email exists, show alert and redirect to register page
    if (mysqli_num_rows($Dup_Email) > 0) {
        echo "
            <script>
            alert('Email already exist');
            window.location.href='register.php';
            </script>
            ";
            exit; // Stop further execution
    }

    // If username exists, show alert and redirect to register page
    if (mysqli_num_rows($Dup_username) > 0) {
        echo "
            <script>
            alert('Username already exist');
            window.location.href='register.php';
            </script>
            ";
            exit; // Stop further execution
    }

    // If email and username are unique, insert the new user into the database
    $result = mysqli_query($con,"INSERT INTO `tbluser`( `UserName`, `Email`, `Number`, `Password`) 
    VALUES ('$Name','$Email','$Number','$Password')");

    // Show success alert and redirect to login page
    echo "
            <script>
            alert('User register successfully');
            window.location.href='login.php';
            </script>
            ";
}
?>
