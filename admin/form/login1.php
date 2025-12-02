<?php
// Connect to the MySQL database (host, username, password, database, port)
$con = mysqli_connect("localhost", "root", "", "ecommerce",3307);

// Get submitted username and password from POST request
$A_name = $_POST["username"];
$A_password = $_POST["userpassword"];

// Query the 'admin' table to check for matching username and password
$result = mysqli_query($con, "SELECT * FROM `admin` WHERE username='$A_name' AND userpassword='$A_password'");

// Start a session to store admin login info
session_start();

// Check if any row matches the username and password
if (mysqli_num_rows($result) > 0) {
    // Login successful: store username in session
    $_SESSION['admin'] = $A_name;
    
    // Alert success and redirect to admin dashboard (myStore.php)
    echo "
    <script>
    alert('Login Successfully');
    window.location.href='../myStore.php';
    </script>
    ";
} else {
    // Login failed: show alert and redirect back to login page
    echo "
    <script>
    alert('Invalid Username or Password');
    window.location.href='login.php';
    </script>
    ";
}
?>
