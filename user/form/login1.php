<?php 
// Get the submitted username/email and password from the login form
$Name = $_POST["name"];
$Password = $_POST["password"];

// Connect to the MySQL database
$con = mysqli_connect("localhost","root","","ecommerce",3307);

// Query the database to check if a user exists with the entered username/email and password
$result = mysqli_query($con,"SELECT * FROM `tbluser` WHERE (UserName='$Name' OR Email='$Name') AND Password='$Password'");

// Start a new session or resume existing session
session_start();

// If a matching user is found
if (mysqli_num_rows($result) > 0) {
    // Store the username/email in session to keep the user logged in
    $_SESSION['user'] = $Name;

    // Show success message and redirect to homepage
    echo "
        <script>
        alert('Login Successfully');
        window.location.href='../index.php';
        </script>
        ";
    exit; // Stop further execution
} else {
    // If no matching user is found, show error and redirect back to login page
    echo "
        <script>
        alert('Invalid Username or Password');
        window.location.href='login.php';
        </script>
        ";
    exit; // Stop further execution
}
?>
